<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		define("HOOSK_ADMIN",1);
		$this->load->model('Hoosk_model');
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->helper('admincontrol');
		$this->load->library('session');
		define ('LANG', $this->Hoosk_model->getLang());
		$this->lang->load('admin', LANG);
		//Define what page we are on for nav
		$this->data['current'] = $this->uri->segment(2);
		define ('SITE_NAME', $this->Hoosk_model->getSiteName());
		define('THEME', $this->Hoosk_model->getTheme());
		define ('THEME_FOLDER', BASE_URL.'/theme/'.THEME);
	}
	
	public function index()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		$this->load->library('pagination');

        $result_per_page =15;  // the number of result per page

        $config['base_url'] = BASE_URL. '/admin/posts/categories/';
        $config['total_rows'] = $this->Hoosk_model->countCategories();
		$config['uri_segment'] = 4;
        $config['per_page'] = $result_per_page;
		$config['full_tag_open'] = '<div class="form-actions">';
		$config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);

		//Get categorys from database
		$this->data['categories'] = $this->Hoosk_model->getCategoriesAll($result_per_page, $this->uri->segment(4)); 
		//Load the view
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/categories', $this->data);
	}
	
	public function addCategory()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Load the form helper
		$this->load->helper('form');
		//Load the view
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/newcategory', $this->data);
	}
	
	public function confirm()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Load the form validation library
		$this->load->library('form_validation');
		//Set validation rules
		$this->form_validation->set_rules('categorySlug', 'category slug', 'trim|alpha_dash|required|is_unique[post_category.categorySlug]');
		$this->form_validation->set_rules('categoryTitle', 'category title', 'trim|required');
		
		if($this->form_validation->run() == FALSE) {
			//Validation failed
			$this->addCategory();
		}  else  {
			//Validation passed
			//Add the category
			$this->Hoosk_model->createCategory();
			//Return to category list
			redirect('/admin/posts/categories', 'refresh');
	  	}
	}
	
	public function editCategory()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Load the form helper
		$this->load->helper('form');
		//Get category details from database
		$this->data['category'] = $this->Hoosk_model->getCategory($this->uri->segment(5)); 
		//Load the view
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/editcategory', $this->data);
	}
	
	public function edited()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Load the form validation library
		$this->load->library('form_validation');
		//Set validation rules
		$this->form_validation->set_rules('categorySlug', 'category slug', 'trim|alpha_dash|required|is_unique[post_category.categorySlug.categoryID.'.$this->uri->segment(5).']');
		$this->form_validation->set_rules('categoryTitle', 'category title', 'trim|required');
		
		if($this->form_validation->run() == FALSE) {
			//Validation failed
			$this->editCategory();
		}  else  {
			//Validation passed
			//Update the category
			$this->Hoosk_model->updateCategory($this->uri->segment(5));
			//Return to category list
			redirect('/admin/posts/categories', 'refresh');
	  	}
	}
	
	
	
	public function delete()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Delete the category account
		$this->Hoosk_model->removeCategory($this->uri->segment(5));
		//Return to category list
		redirect('/admin/posts/categories', 'refresh');
	}
	
	
	
}
