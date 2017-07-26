<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class How_to_shop extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('howtoshop_model');
	}

	public function index()
	{
		$data = $this->howtoshop_model->get_info();
		$data['query'] = '';	
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$data['main_content'] = 'howtoshop/index';
		
		$this->load->view('includes/template', $data);
	}
}

/* End of file how_to_shop.php */
/* Location: ./application/controllers/how_to_shop.php */