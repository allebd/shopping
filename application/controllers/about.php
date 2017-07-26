<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('about_model');
	}

	public function index()
	{
		$data = $this->about_model->get_info();
		$data['query'] = '';	
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$data['main_content'] = 'about/index';
		$this->load->view('includes/template', $data);
	}
}

/* End of file about.php */
/* Location: ./application/controllers/about.php */