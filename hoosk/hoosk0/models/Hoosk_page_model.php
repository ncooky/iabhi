<?php

class Hoosk_page_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }


	/*     * *************************** */
    /*     * ** Page Querys ************ */
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
	
    function getPage($pageURL) {
        // Get page
        $this->db->select("*");
        $this->db->join('page_content', 'page_content.pageID = page_attributes.pageID');
        $this->db->join('page_meta', 'page_meta.pageID = page_attributes.pageID');
		$this->db->where("pagePublished", 1);
		$this->db->where("pageURL", $pageURL);
        $query = $this->db->get('page_attributes');
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
        	foreach ($results as $u): 
				$page = array(
	   	   				'pageID'    			=> $u['pageID'],
	   	   				'pageTitle' 			=> $u['pageTitle'],
						'pageKeywords' 			=> $u['pageKeywords'],
						'pageDescription' 		=> $u['pageDescription'],
	   	   				'pageContentHTML'   	=> $u['pageContentHTML'],
						'pageTemplate'    		=> $u['pageTemplate'],
						'enableJumbotron'   	=> $u['enableJumbotron'],
						'enableSlider'   		=> $u['enableSlider'],
						'jumbotronHTML'    		=> $u['jumbotronHTML'],
                     );      	
			endforeach; 
			return $page;
		
		}
        return array();
    }
	function getCategory($catSlug) {
        // Get category
        $this->db->select("*");
		$this->db->where("categorySlug", $catSlug);
        $query = $this->db->get('post_category');
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
        	foreach ($results as $u): 
				$category = array(
	   	   				'pageID'    			=> $u['categoryID'],
						'categoryID'    		=> $u['categoryID'],
	   	   				'pageTitle' 			=> $u['categoryTitle'],
						'pageKeywords' 			=> '',
						'pageDescription' 		=> $u['categoryDescription'],
                     );      	
			endforeach; 
			return $category;
		
		}
        return array();
    }
	
	function getArticle($postURL) {
        // Get article
        $this->db->select("*");
		$this->db->where("postURL", $postURL);
        $this->db->join('post_category', 'post_category.categoryID = post.categoryID');
        $this->db->join('user', 'user.userID = post.postUserID');
        $query = $this->db->get('post');
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
        	foreach ($results as $u): 
				$category = array(
	   	   				'pageID'    			=> $u['postID'],
						'postID'    			=> $u['postID'],
	   	   				'pageTitle' 			=> $u['postTitle'],
						'pageKeywords' 			=> '',
						'pageDescription' 		=> $u['postExcerpt'],
						'postContent' 			=> $u['postContentHTML'],
						'datePosted' 			=> $u['datePosted'],
						'categoryTitle' 		=> $u['categoryTitle'],
						'categorySlug' 			=> $u['categorySlug'],
                        'firstName' 			=> $u['firstName'],
                        'midName' 		    	=> $u['midName'],
                        'lastName' 		    	=> $u['lastName'],
                     );      	
			endforeach; 
			return $category;
		
		}
        return array();
    }
	
	
   function getSettings() {
        // Get settings
        $this->db->select("*");
		$this->db->where("siteID", 0);
        $query = $this->db->get('settings');
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
        	foreach ($results as $u): 
				$page = array(
						'siteLogo'    			=> $u['siteLogo'],
						'siteTitle'    			=> $u['siteTitle'],
                        'siteAddress'    			=> $u['siteAddress'],
                        'sitePhone'    			=> $u['sitePhone'],
                        'siteFax'    			=> $u['siteFax'],
                        'siteEmail'    			=> $u['siteEmail'],
						'siteFooter'    		=> $u['siteFooter'],
                     );      	
			endforeach; 
			return $page;
		
		}
        return array();
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

}

?>