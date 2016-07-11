<?php

class Hoosk_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
	
	/*     * *************************** */
    /*     * ** Dash Querys ************ */
    /*     * *************************** */
	function getSiteName() {
        // Get Theme
        $this->db->select("*");
       	$this->db->where("siteID", 0);
		$query = $this->db->get('settings');
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
        	foreach ($results as $u): 
				return $u['siteTitle'];			
			endforeach; 
		}
        return array();
    }
	
	function getTheme() {
        // Get Theme
        $this->db->select("*");
       	$this->db->where("siteID", 0);
		$query = $this->db->get('settings');
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
        	foreach ($results as $u): 
				return $u['siteTheme'];			
			endforeach; 
		}
        return array();
    }
	function getLang() {
        // Get Theme
        $this->db->select("*");
       	$this->db->where("siteID", 0);
		$query = $this->db->get('settings');
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
        	foreach ($results as $u): 
				return $u['siteLang'];			
			endforeach; 
		}
        return array();
    }
    function getUpdatedPages() {
        // Get most recently updated pages
        $this->db->select("pageTitle, page_attributes.pageID, pageUpdated, pageContentHTML");
        $this->db->join('page_content', 'page_content.pageID = page_attributes.pageID');
        $this->db->join('page_meta', 'page_meta.pageID = page_attributes.pageID');
		$this->db->order_by("pageUpdated", "desc");
		$this->db->limit(5);
        $query = $this->db->get('page_attributes');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    /*     * *************************** */
    /*     * ** User Querys ************ */
    /*     * *************************** */
	function countUsers(){
        return $this->db->count_all('user');
   	}
	
    function getUsers($limit, $offset=0) {
        // Get a list of all user accounts
        $this->db->select("userName, email, userID, roleDescription");
        $this->db->join('user_role', 'user_role.roleID = user.roleID'); 
        $this->db->where('user.status',1);
        $this->db->order_by("userName", "asc");
		$this->db->limit($limit, $offset);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    
    function getUsersNonAdm($limit, $offset=0) {
        // Get a list of all user accounts
        $this->db->select("userName, email, userID, roleDescription");
        $this->db->join('user_role', 'user_role.roleID = user.roleID'); 
        $this->db->where('user.status',1);
        $this->db->where('user.roleID <> 1');
        $this->db->order_by("userName", "asc");
		$this->db->limit($limit, $offset);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }    
    
    function getNewUsers() {
        // Get a list of all user accounts
        $this->db->select("userName, email, userID, roleDescription");
        $this->db->join('user_role', 'user_role.roleID = user.roleID'); 
        $this->db->where('user.status',0);
        $this->db->order_by("userName", "asc");
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }    

    function getUser($id) {
        // Get the user details
        $this->db->select("*");
        $this->db->join('user_role', 'user_role.roleID = user.roleID');        
        $this->db->where("userID", $id);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    function getUserEmail($id) {
        // Get the user email address
        $this->db->select("email");
        $this->db->where("userID", $id);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $email = $rows->email;
                return $email;
            }
        }
    }

    function createUser() {
        // Create the user account
        $data = array(
            'userName' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'status' => 0,
            'roleID' => 5,
            'password' => md5($this->input->post('password').SALT),
        );
        $this->db->insert('user', $data);
    }

    function updateUser($id) {
        // update the user account
        $data = array(
            'email' => $this->input->post('email'),
            'firstName' => $this->input->post('firstName'),
            'midName' => $this->input->post('midName'),
            'lastName' => $this->input->post('lastName'),
            'roleID' => $this->input->post('role'),
            'password' => md5($this->input->post('password').SALT),
        );
        $this->db->where('userID', $id);
        $this->db->update('user', $data);
    }

    function getUserRole(){
        $this->db->select("*");
        $query = $this->db->get('user_role');
        if ($query->num_rows() > 0) {
            foreach($query->result_array() as $row){
                
                $data[$row['roleID']]=$row['roleDescription'];
            }
            return $data;
        }
        return array();        
    }
    function getUserRoleNA(){
        $this->db
            ->select("*")
            ->where('roleID <> 1');
        
        $query = $this->db->get('user_role');
        if ($query->num_rows() > 0) {
            foreach($query->result_array() as $row){
                
                $data[$row['roleID']]=$row['roleDescription'];
            }
            return $data;
        }
        return array();        
    }    
    
    function removeUser($id) {
        // Delete a user account
        $this->db->delete('user', array('userID' => $id));
    }
    
    function activateUser($id) {
        // activate a user account
       
        $this->db->where('userID', $id);
        $this->db->update('user', array('status' => 1));         

    }    

    function login($username, $password) {
        $this->db->select("*");
        $this->db->where("userName", $username);
        $this->db->where("password", $password);
        $query = $this->db->get("user");
        
        return $query->result();
//        if ($query->num_rows() > 0) {
//            foreach ($query->result() as $rows) {
//                if($rows->roleID == 1 or $rows->roleID == 2 ){
//                    $data = array(
//                        'userID' => $rows->userID,
//                        'userName' => $rows->userName,
//                        'logged_in' => TRUE,
//                        'roleID' => $rows->roleID,
//                    );
//                }else{
//                    return false;
//                }
//
//                $this->session->set_userdata($data);
//                return true;
//            }
//        } else {
//            return false;
//        }
    }
    function CheckExist($username, $password) {
        $this->db->select("*");
        $this->db->where("userName", $username);
        $this->db->where("password", $password);
        $query = $this->db->get("user");
        
        //return $query->result();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $data = array(
                    'userID' => $rows->userID,
                    'userName' => $rows->userName,
                    'logged_in' => TRUE,
                    'roleID' => $rows->roleID,
                );

                $this->session->set_userdata($data);
                return true;
            }
        } else {
            return false;
        }
    }

    /*     * *************************** */
    /*     * ** Partner Querys ********* */
    /*     * *************************** */

	function countPartners(){
        return $this->db->count_all('partner');
   	}
    
    function getPartners($limit, $offset=0) {
        // Get a list of all partner accounts
        $this->db->select("*");
        $this->db->order_by("partnerName", "asc");
		$this->db->limit($limit, $offset);
        $query = $this->db->get('partner');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }    
    
    function createPartner() {
        // Create the partner account
        $data = array(
            'partnerName' => $this->input->post('partnerName'),
            'partnerLink' => $this->input->post('partnerLink'),
        );
			if ($this->input->post('partnerImg') != ""){
				$data['partnerImg'] = $this->input->post('file_upload');
			}        
        $this->db->insert('partner', $data);
    }    
    
    function updatePartner($id) {
        // update the partner account
        $data = array(
            'partnerName' => $this->input->post('partnerName'),
            'partnerLink' => $this->input->post('partnerLink'),
        );
			if ($this->input->post('partnerImg') != ""){
				$data['partnerImg'] = $this->input->post('file_upload');
			} 
        $this->db->where('partnerID', $id);
        $this->db->update('partner', $data);
    }    

    function getPartner($id) {
        // Get the partner details
        $this->db->select("*");
        $this->db->where("partnerID", $id);
        $query = $this->db->get('partner');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }    
    

    function removePartner($id) {
        // Delete a partner account
        $this->db->delete('partner', array('partnerID' => $id));
    }    
    /*     * *************************** */
    /*     * ** Page Querys ************ */
    /*     * *************************** */

	function countPages(){
        return $this->db->count_all('page_attributes');
    }
    function getPages($limit, $offset=0) {  
        // Get a list of all pages
        $this->db->select("*");
        $this->db->join('page_content', 'page_content.pageID = page_attributes.pageID');
        $this->db->join('page_meta', 'page_meta.pageID = page_attributes.pageID');
		$this->db->limit($limit, $offset);
        $query = $this->db->get('page_attributes');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    function getPagesAll() {  
        // Get a list of all pages
        $this->db->select("*");
        $this->db->join('page_content', 'page_content.pageID = page_attributes.pageID');
        $this->db->join('page_meta', 'page_meta.pageID = page_attributes.pageID');
        $query = $this->db->get('page_attributes');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
    function createPage() {
        // Create the page
        $data = array(
            'pagePublished' => $this->input->post('pagePublished'),
			'pageTemplate' => $this->input->post('pageTemplate'),
            'pageURL' => $this->input->post('pageURL'),
        );
        $this->db->insert('page_attributes', $data);
		if ($this->input->post('content') != ""){
        $sirTrevorInput = $this->input->post('content');
        $converter = new Converter();
        $HTMLContent = $converter->toHtml($sirTrevorInput);} else {
		$HTMLContent = "";	
		}

        $this->db->select("*");
        $this->db->where("pageURL", $this->input->post('pageURL'));
        $query = $this->db->get("page_attributes");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $contentdata = array(
                    'pageID' => $rows->pageID,
                    'pageTitle' => $this->input->post('pageTitle'),
            		'navTitle' => $this->input->post('navTitle'),
                    'pageContent' => $this->input->post('content'),
                    'pageContentHTML' => $HTMLContent,
                );
                $this->db->insert('page_content', $contentdata);
                $metadata = array(
                    'pageID' => $rows->pageID,
                    'pageKeywords' => $this->input->post('pageKeywords'),
                    'pageDescription' => $this->input->post('pageDescription'),
                );
                $this->db->insert('page_meta', $metadata);
            }
        }
    }

    function getPage($id) {
        // Get the page details
        $this->db->select("*");
        $this->db->where("page_attributes.pageID", $id);
        $this->db->join('page_content', 'page_content.pageID = page_attributes.pageID');
        $this->db->join('page_meta', 'page_meta.pageID = page_attributes.pageID');
		$query = $this->db->get('page_attributes');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

	function getPageBanners($id) {
        // Get the page banners
        $this->db->select("*");
        $this->db->where("pageID", $id);
        $this->db->order_by("slideOrder ASC");
       	$query = $this->db->get('banner');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
	
    function removePage($id) {
        // Delete a page
        $this->db->delete('page_content', array('pageID' => $id));
        $this->db->delete('page_meta', array('pageID' => $id));
        $this->db->delete('page_attributes', array('pageID' => $id));
    }

    function getPageURL($id) {
        // Get the page URL
        $this->db->select("pageURL");
        $this->db->where("pageID", $id);
        $query = $this->db->get('page_attributes');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $pageURL = $rows->pageURL;
                return $pageURL;
            }
        }
    }

    function updatePage($id) {
        // Update the page

       	if ($this->input->post('content') != ""){
        $sirTrevorInput = $this->input->post('content');
        $converter = new Converter();
        $HTMLContent = $converter->toHtml($sirTrevorInput);} else {
		$HTMLContent = "";	
		}
		
		if ($id != 1){
        	$data = array(
            'pagePublished' => $this->input->post('pagePublished'),
            'pageURL' => $this->input->post('pageURL'),
			'pageTemplate' => $this->input->post('pageTemplate'),
        );
		} else {
			$data = array(
            'pagePublished' => $this->input->post('pagePublished'),
			'pageTemplate' => $this->input->post('pageTemplate'),
       		);			
		}
        $this->db->where("pageID", $id);
        $this->db->update('page_attributes', $data);
        $contentdata = array(
            'pageTitle' => $this->input->post('pageTitle'),
            'navTitle' => $this->input->post('navTitle'),
            'pageContent' => $this->input->post('content'),
            'pageContentHTML' => $HTMLContent,
        );
        $this->db->where("pageID", $id);
        $this->db->update('page_content', $contentdata);
        $metadata = array(
            'pageKeywords' => $this->input->post('pageKeywords'),
            'pageDescription' => $this->input->post('pageDescription'),
        );
        $this->db->where("pageID", $id);
        $this->db->update('page_meta', $metadata);
    }

	 function updateJumbotron($id) {
        // Update the jumbotron
		if ($this->input->post('jumbotron') != ""){
        $sirTrevorInput = $this->input->post('jumbotron');
        $converter = new Converter();
        $HTMLContent = $converter->toHtml($sirTrevorInput);} else {
		$HTMLContent = "";	
		}
		$data = array(
		'enableJumbotron' => $this->input->post('enableJumbotron'),
		'enableSlider' => $this->input->post('enableSlider'),
       	);			
		
        $this->db->where("pageID", $id);
        $this->db->update('page_attributes', $data);
        $contentdata = array(
			'jumbotron' => $this->input->post('jumbotron'),
			'jumbotronHTML' => $HTMLContent,
        );
        $this->db->where("pageID", $id);
        $this->db->update('page_content', $contentdata);
       
	  	// Clear the sliders
		$this->db->delete('banner', array('pageID' => $id));

		/*for($i=0;$i<=$_POST['total_upload_pics'];$i++)
		{
			if(isset($_POST['slide' . $i]))
			{
				$slidedata = array(
				'pageID' => $id,
				'slideImage' => $this->input->post('slide'.$i),
				'slideLink' => $this->input->post('link'.$i),
				'slideOrder' => $i,
				);
                $this->db->insert('hoosk_banner', $slidedata));
			}
		}*/
		
		$sliders = explode('{', $this->input->post('pics'));
		
		for($i=1;$i<count($sliders);$i++)
		{
			$div = explode('|', $sliders[$i]);
			print_r($div);
			$slidedata = array(
				'pageID' => $id,
				'slideImage' => $div[0],
				'slideLink' => $div[1],
				'slideAlt' => substr($div[2],0,-1),
                'slideTitle' => $div[3],
                'slideText' => $div[4],
				'slideOrder' => $i-1,
			);
			
			$this->db->insert('banner', $slidedata);
		}
    }
	
    /*     * *************************** */
    /*     * ** Navigation Querys ****** */
    /*     * *************************** */
	function countNavigation(){
        return $this->db->count_all('navigation');
    }	

    function getAllNav($limit, $offset=0) {
        // Get a list of all pages
        $this->db->select("*");
		$this->db->limit($limit, $offset);
        $query = $this->db->get('navigation');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
	
    function getNav($id) {
        // Get a list of all pages
        $this->db->select("*");
		$this->db->where("navSlug", $id);
        $query = $this->db->get('navigation');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }	
    //Get page details for building nav
    function getPageNav($url) {
        // Get the page details
        $this->db->select("*");
        $this->db->where("page_attributes.pageURL", $url);
        $this->db->join('page_content', 'page_content.pageID = page_attributes.pageID');
        $this->db->join('page_meta', 'page_meta.pageID = page_attributes.pageID');
        $query = $this->db->get('page_attributes');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
	
	function insertNav() {
		$navigationHTML = $this->input->post('convertedNav');
		$navigationHTML = str_replace("<ul></ul>", "", $navigationHTML);
		$navigationEdit = $this->input->post('seriaNav');
		$navigationEdit = str_replace('<button data-action="collapse" type="button">Collapse</button><button style="display: none;" data-action="expand" type="button">Expand</button>', "", $navigationEdit);
		
        $data = array(
            'navSlug' => $this->input->post('navSlug'),
            'navTitle' => $this->input->post('navTitle'),
            'navEdit' => $navigationEdit,
            'navHTML' => $navigationHTML,
        );
        $this->db->insert('navigation', $data);
	}
	
	function updateNav($id) {
		$navigationHTML = $this->input->post('convertedNav');
		$navigationHTML = str_replace("<ul>", "", $navigationHTML);
		$navigationEdit = $this->input->post('seriaNav');
		$navigationEdit = str_replace('<button data-action="collapse" type="button">Collapse</button><button style="display: none;" data-action="expand" type="button">Expand</button>', "", $navigationEdit);
		
        $data = array(
            'navTitle' => $this->input->post('navTitle'),
            'navEdit' => $navigationEdit,
            'navHTML' => $navigationHTML,
        );
		$this->db->where("navSlug", $id);
        $this->db->update('navigation', $data);
	}
	
	function removeNav($id) {
        // Delete a nav
        $this->db->delete('navigation', array('navSlug' => $id));
    }
	
	
	
	function getSettings() {
        // Get the settings
        $this->db->select("*");
        $this->db->where("siteID", 0);
        $query = $this->db->get('settings');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
	
	
	function updateSettings() {
		$data = array(
			'siteTheme' => stripslashes($this->input->post('siteTheme')),
			'siteLang' => stripslashes($this->input->post('siteLang')),
			'siteFooter' => $this->input->post('siteFooter')
		);
		
		if ($this->input->post('siteTitle') != "")
				 $data['siteTitle'] = $this->input->post('siteTitle');
	
			if ($this->input->post('siteLogo') != ""){
				$data['siteLogo'] = $this->input->post('siteLogo');
			}	
			$this->db->where("siteID", 0);
			$this->db->update('settings', $data);
	}
	
	
	/*     * *************************** */
    /*     * ** Post Querys ************ */
    /*     * *************************** */
	
		function countPosts(){
			return $this->db->count_all('post');
		}    
		function getPosts($limit, $offset=0) { 	
        // Get a list of all posts
        $this->db->select("*");
        $this->db->join('post_category', 'post_category.categoryID = post.categoryID');
		$this->db->order_by("unixStamp", "desc");
		$this->db->limit($limit, $offset);
        $query = $this->db->get('post');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    function createPost() {
        // Create the post
		if ($this->input->post('content') != ""){
        $sirTrevorInput = $this->input->post('content');
        $converter = new Converter();
        $HTMLContent = $converter->toHtml($sirTrevorInput);} else {
		$HTMLContent = "";	
		}
        $data = array(
		    'postTitle' => $this->input->post('postTitle'),
			'categoryID' => $this->input->post('categoryID'),
            'postURL' => $this->input->post('postURL'),
			'postContent' => $this->input->post('content'),
            'postContentHTML' => $HTMLContent,
			'postExcerpt' => $this->input->post('postExcerpt'),
			'datePosted' => $this->input->post('datePosted'),
			'unixStamp' => $this->input->post('unixStamp'),
        );
		if ($this->input->post('postImage') != ""){
				$data['postImage'] = $this->input->post('postImage');
		}	
        $this->db->insert('post', $data);
    }

    function getPost($id) {
        // Get the post details
        $this->db->select("*");
        $this->db->where("postID", $id);
        $this->db->join('post_category', 'post_category.categoryID = post.categoryID');
        $query = $this->db->get('post');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    function removePost($id) {
        // Delete a post
        $this->db->delete('post', array('postID' => $id));
    }

    function updatePost($id) {
        // Update the post

       	if ($this->input->post('content') != ""){
        $sirTrevorInput = $this->input->post('content');
        $converter = new Converter();
        $HTMLContent = $converter->toHtml($sirTrevorInput);} else {
		$HTMLContent = "";	
		}
	 	$data = array(
		    'postTitle' => $this->input->post('postTitle'),
			'categoryID' => $this->input->post('categoryID'),
            'postURL' => $this->input->post('postURL'),
			'postContent' => $this->input->post('content'),
            'postContentHTML' => $HTMLContent,
			'postExcerpt' => $this->input->post('postExcerpt'),
			'datePosted' => $this->input->post('datePosted'),
			'unixStamp' => $this->input->post('unixStamp'),
        );
		if ($this->input->post('postImage') != ""){
				$data['postImage'] = $this->input->post('postImage');
		}	
		$this->db->where("postID", $id);
        $this->db->update('post', $data);
    }
	
	
	/*     * *************************** */
    /*     * ** Category Querys ******** */
    /*     * *************************** */
		function countCategories(){
        return $this->db->count_all('post_category');
   		 }
	    function getCategories() {
        // Get a list of all categories
        $this->db->select("*");
        $query = $this->db->get('post_category');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
	
		
		 function getCategoriesAll($limit, $offset=0) {
        // Get a list of all categories
        $this->db->select("*");
		$this->db->limit($limit, $offset);
        $query = $this->db->get('post_category');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }
	function createCategory() {
        // Create the category

        $data = array(
		    'categoryTitle' => $this->input->post('categoryTitle'),
			'categorySlug' => $this->input->post('categorySlug'),
            'categoryDescription' => $this->input->post('categoryDescription')
        );

        $this->db->insert('post_category', $data);
    }

    function getCategory($id) {
        // Get the category details
        $this->db->select("*");
        $this->db->where("categoryID", $id);
        $query = $this->db->get('post_category');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    function removeCategory($id) {
        // Delete a category
        $this->db->delete('post_category', array('categoryID' => $id));
    }

    function updateCategory($id) {
        // Update the category
	 	$data = array(
		    'categoryTitle' => $this->input->post('categoryTitle'),
			'categorySlug' => $this->input->post('categorySlug'),
            'categoryDescription' => $this->input->post('categoryDescription')
        );

		$this->db->where("categoryID", $id);
        $this->db->update('post_category', $data);
    }
	
	/*     * *************************** */
    /*     * ** Social Querys ********** */
    /*     * *************************** */
	
	function getSocial(){
		$this->db->select("*");
        $query = $this->db->get('social');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
	}
	
	
	function updateSocial() {
		$this->db->select("*");
        $query = $this->db->get("social");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
				$data = array();
				$data['socialLink'] = $this->input->post($rows->socialName);
				if (isset($_POST['checkbox'.$rows->socialName])){
					$data['socialEnabled'] = $this->input->post('checkbox'.$rows->socialName);
				} else {
					$data['socialEnabled'] = 0;
				}
				$this->db->where("socialName", $rows->socialName);
        		$this->db->update('social', $data);
			}
		}
	}
}
?>