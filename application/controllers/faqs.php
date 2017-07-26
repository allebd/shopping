<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faqs extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('faqs_model');
	}

	public function index()
	{
		$data = $this->faqs_model->get_info();
		$data['query'] = '';	
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$data['main_content'] = 'faqs/index';
		
		$this->load->view('includes/template', $data);
	}

	public function sendmsg()
	{
		$this->form_validation->set_rules('dfullname', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('demail', 'Email Address', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('dmessage', 'Question', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE)
		{
			//validation with errors
			$this->session->set_flashdata('the_error','Sorry, error occured this time sending your question.');
			redirect('faqs');
		}
		else
		{	
			if($query = $this->faqs_model->sending_msg())
			{ 
				$this->session->set_flashdata('the_success','Your Question has been sent successfully.');
				redirect('faqs');
			}
		}
	}
}

/* End of file faqs.php */
/* Location: ./application/controllers/faqs.php */