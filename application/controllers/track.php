<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Track extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('track_model');
	}

	public function index()
	{
		$data = $this->track_model->get_info();
		$data['query'] = '';	
		$data['incorrect_login'] = '';	
		$data['reg_success'] = '';
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$data['main_content'] = 'track/index';
		
		$this->load->view('includes/template', $data);
	}

	public function search()
	{
		$this->form_validation->set_rules('tracker', 'Order Number', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			//validation with errors
			$data = $this->track_model->get_info();
			$data['incorrect_login'] = 'Please try again later. ';	
			$data['reg_success'] = '';
			$data['query'] = '';	
			$data['is_logged_in'] = $this->session->userdata('is_logged_in');
			$data['main_content'] = 'track/index';
	
			$this->load->view('includes/template',$data);
		}else{
			$data = $this->track_model->get_info();
			$data['incorrect_login'] = 'Please try again later, we are waiting for your tracking information from carrier Thank you. ';	
			$data['reg_success'] = '';
			$data['query'] = '';	
			$data['is_logged_in'] = $this->session->userdata('is_logged_in');
			$data['main_content'] = 'track/index';
	
			$this->load->view('includes/template',$data);
		}
	}
}

/* End of file track.php */
/* Location: ./application/controllers/track.php */