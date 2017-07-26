<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('error_model');
	}

	public function index()
	{
		$data = $this->error_model->get_info();
		$data['query'] = '';	
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$data['main_content'] = 'error/index';
		
		$this->load->view('includes/template', $data);
	}
}

/* End of file error.php */
/* Location: ./application/controllers/error.php */