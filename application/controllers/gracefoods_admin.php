<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gracefoods_admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('admin_model');
		$this->load->model('validate_model');
	}

	public function index()
	{
		$data = $this->admin_model->get_info();
		$data['is_adminlogged_in'] = '';
		$data['main_content'] = 'admin/index';
		
		$this->load->view('includes/template', $data);
	}

	public function validate_credentials()
	{
		$query = $this->validate_model->a_validate();
		if($query) // if user's credentials validated...
		{
			$data = array(
						'admin_username' => $this->input->post('myuser'),
						'is_adminlogged_in' => true
					);

			$this->session->set_userdata($data);
			redirect('profile_admin/');
		}
		else
		{
			$this->session->set_flashdata('the_error','Incorrect Username or Password.');
			redirect('gracefoods_admin');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();

		//Logging out
		$data = $this->admin_model->get_info();	
		$data['reg_success'] = 'You have been successfully logged out.';
		$data['is_adminlogged_in'] = '';
		$data['main_content'] = 'admin/index';
					
		$this->load->view('includes/template', $data);				
	}
}

/* End of file stitchastyle_admin.php */
/* Location: ./application/controllers/stitchastyle_admin.php */