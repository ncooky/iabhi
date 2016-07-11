<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hoosk_default extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Hoosk_page_model');
		$this->load->helper('hoosk_page_helper');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
		define ('SITE_NAME', $this->Hoosk_page_model->getSiteName());
		define ('THEME', $this->Hoosk_page_model->getTheme());
		define ('THEME_FOLDER', BASE_URL.'/theme/'.THEME);
        //define ('LANG', $this->Hoosk_model->getLang());
		$this->data['settings']=$this->Hoosk_page_model->getSettings();
	}
	
	
	public function index()
	{
		$totSegments = $this->uri->total_segments();
		if(!is_numeric($this->uri->segment($totSegments))){
		$pageURL = $this->uri->segment($totSegments);
		} else if(is_numeric($this->uri->segment($totSegments))){
		$pageURL = $this->uri->segment($totSegments-1);
		}
		if ($pageURL == ""){ $pageURL = "home"; }
		$this->data['page']=$this->Hoosk_page_model->getPage($pageURL);
		if ($this->data['page']['pageTemplate'] != ""){
		$this->data['header'] = $this->load->view('templates/header', $this->data, true);
		$this->data['footer'] = $this->load->view('templates/footer', '', true);
		$this->load->view('templates/'.$this->data['page']['pageTemplate'], $this->data);
		} else {
			$this->error();
		}
	}
	
		public function category()
	{
		$catSlug = $this->uri->segment(2);
		$this->data['page']=$this->Hoosk_page_model->getCategory($catSlug);
		if ($this->data['page']['categoryID'] != ""){
		$this->data['header'] = $this->load->view('templates/header', $this->data, true);
		$this->data['footer'] = $this->load->view('templates/footer', '', true);
		$this->load->view('templates/category', $this->data);
		} else {
			$this->error();
		}
	}
	
		public function article()
	{
		$articleURL = $this->uri->segment(2);
		$this->data['page']=$this->Hoosk_page_model->getArticle($articleURL);
		if ($this->data['page']['postID'] != ""){
		$this->data['header'] = $this->load->view('templates/header', $this->data, true);
		$this->data['footer'] = $this->load->view('templates/footer', '', true);
		$this->load->view('templates/article', $this->data);
		} else {
			$this->error();
		}
	}
	
	public function error()
	{
		$this->data['page']['pageTitle']="Oops, Error";
		$this->data['page']['pageDescription']="Oops, Error";
		$this->data['page']['pageKeywords']="Oops, Error";
		$this->data['page']['pageID']="0";
		$this->data['header'] = $this->load->view('templates/header', $this->data, true);
		$this->data['footer'] = $this->load->view('templates/footer', '', true);
		$this->load->view('templates/error', $this->data);
	}

    public function login()
	{

		//Load the form helper
		$this->load->helper('form');
		$this->data['page']['pageTitle']="Log in member";
		$this->data['header'] = $this->load->view('templates/header', $this->data, true);
		$this->data['footer'] = $this->load->view('templates/footer', '', true);
		$this->load->view('templates/login', $this->data);
	}
	
	public function loginCheck()
 	{
		$username=$this->input->post('username');
		$password=md5($this->input->post('password').SALT);
        $check = $this->Hoosk_page_model->CheckExist($username,$password);
		$result=$this->Hoosk_page_model->login($username,$password);
        
		if($check) {
		  foreach($result as $rows){
		      if ($rows->status == 1){
                    $data = array(
                        'userID' => $rows->userID,
                        'userName' => $rows->userName,
                        'status' => $rows->status,
                        'logged_in' => TRUE,
                        'roleID' => $rows->roleID,
                    );
                    
                    $this->session->set_userdata($data);
                    
                    redirect('/', 'refresh');		          
		      }else{
                $this->data['error'] = "2";    
                $this->login();		          
		      }

		  }
			//redirect('/admin', 'refresh');
		}
		else
		{

            $this->data['error'] = "1";    
			$this->login();
		}
	}
	
	public function logout()
	{
		$data = array(
				'userID'    => 	'',
				'userName'  => 	'',
                'roleID'  => 	'',
	            'logged_in'	=> 	FALSE,
		);
		$this->session->unset_userdata($data);
		$this->session->sess_destroy();
        redirect('/login', 'refresh');
		//$this->login();
	}      
}

