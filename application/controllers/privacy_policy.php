<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privacy_policy extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('privacy_model');
	}

	public function index()
	{
		$data = $this->privacy_model->get_info();
		$data['query'] = '';	
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$data['main_content'] = 'privacy/index';
		
		$this->load->view('includes/template', $data);
	}
}

/* End of file privacy_policy.php */
/* Location: ./application/controllers/privacy_policy.php */