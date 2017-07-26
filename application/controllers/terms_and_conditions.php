<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terms_and_conditions extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('terms_model');
	}

	public function index()
	{
		$data = $this->terms_model->get_info();
		$data['query'] = '';	
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$data['main_content'] = 'terms/index';
		
		$this->load->view('includes/template', $data);
	}
}

/* End of file terms_of_use.php */
/* Location: ./application/controllers/terms_of_use.php */