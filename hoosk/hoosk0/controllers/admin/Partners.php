<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partners extends CI_Controller {
    
	function __construct()
	{
		parent::__construct();
		define("HOOSK_ADMIN",1);
		$this->load->model('Hoosk_model');
		$this->load->helper('url');
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

        $config['base_url'] = BASE_URL. '/admin/partners/';
        $config['total_rows'] = $this->Hoosk_model->countPartners();
        $config['per_page'] = $result_per_page;
		$config['full_tag_open'] = '<div class="form-actions">';
		$config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);

		//Get partners from database
		$this->data['partners'] = $this->Hoosk_model->getPartners($result_per_page, $this->uri->segment(3)); 
		
		//Load the view
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/partners', $this->data);
	}        
    
	public function addPartner()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Load the form helper
		$this->load->helper('form');
		//Load the view
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/newpartner', $this->data);
	}   
    
	public function uploadLogo()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		if($_FILES[0]['type']=='image/png' || $_FILES[0]['type']=='image/jpg' || $_FILES[0]['type']=='image/jpeg')
		{
			move_uploaded_file($_FILES[0]['tmp_name'], 'uploads/partners/' .basename($_FILES[0]['name']));
			echo json_encode(basename($_FILES[0]['name']));
		}
		else {
		echo 0;
		}
	} 
	public function confirm()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Load the form validation library
		$this->load->library('form_validation');
		//Set validation rules
		$this->form_validation->set_rules('partnerName', 'Partner Name', 'trim|required');
		$this->form_validation->set_rules('partnerLink', 'Partner Website', 'required|trim|max_length[256]|prep_url');

		
		if($this->form_validation->run() == FALSE) {
			//Validation failed
			$this->addPartner();
		}  else  {
			//Validation passed
			//Add the user
			$this->Hoosk_model->createPartner();
			//Return to user list
			redirect('/admin/partners', 'refresh');
	  	}
	}

	public function editPartner()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Load the form helper
		$this->load->helper('form');
		//Get user details from database
		$this->data['partners'] = $this->Hoosk_model->getPartner($this->uri->segment(4)); 
		//Load the view
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/editpartner', $this->data);
	}  
	public function edited()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Load the form validation library
		$this->load->library('form_validation');
		//Set validation rules
		$this->form_validation->set_rules('partnerName', 'Partner Name', 'trim|required');
		$this->form_validation->set_rules('partnerLink', 'Partner Website', 'required|trim|max_length[256]|prep_url');

		
		if($this->form_validation->run() == FALSE) {
			//Validation failed
			$this->editPartner();
		}  else  {
			//Validation passed
			//Update the user
			$this->Hoosk_model->updatePartner($this->uri->segment(4));
			//Return to user list
			redirect('/admin/partners', 'refresh');
	  	}
	}

	public function delete()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Delete the partners account
		$this->Hoosk_model->removePartner($this->uri->segment(4));
		//Return to partners list
		redirect('/admin/partners', 'refresh');
	}                  
}