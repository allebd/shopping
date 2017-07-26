<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Return_policy extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('return_model');
	}

	public function index()
	{
		$data = $this->return_model->get_info();
		$data['query'] = '';	
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$data['main_content'] = 'return/index';
		
		$this->load->view('includes/template', $data);
	}
}

/* End of file return_policy.php */
/* Location: ./application/controllers/return_policy.php */