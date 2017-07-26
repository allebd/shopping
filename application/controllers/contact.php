<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('contact_model');
	}

	public function index()
	{
		$data = $this->contact_model->get_info();
		$data['query'] = '';	
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$data['reg_success'] = '';
		$data['main_content'] = 'contact/index';
		$this->load->view('includes/template', $data);
	}

	public function sendmsg()
	{
		$this->form_validation->set_rules('dfullname', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('demail', 'Email Address', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('dmessage', 'Message', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE)
		{
			//validation with errors
			$this->session->set_flashdata('the_error','Sorry, error occured this time sending your message.');
			redirect('contact');
		}
		else
		{	
			if($query = $this->contact_model->sending_msg())
			{ 
				$this->session->set_flashdata('the_success','Your message has been sent successfully.');
				redirect('contact');
			}
		}
	}
}

/* End of file contact.php */
/* Location: ./application/controllers/contact.php */