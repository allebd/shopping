<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('home_model');
		$this->load->model('filter_model');
	}

	public function index()
	{
		$data = $this->home_model->get_info();
		$data['query'] = '';
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$data['currentUrl'] = $this->config->config['base_url'];
		$data['cartDetails'] = $this->session->userdata('cart_items');
		$data['main_content'] = 'home/index';
		$this->load->view('includes/template', $data);

	}

	public function review_add()
	{
		$data = $this->home_model->get_review_add();	

		$this->session->set_flashdata('the_success','Review successfully added to product.');
		redirect('category');
	}

	public function newsletter_add()
	{
		//field name, error message, validation rules
		$this->form_validation->set_rules('newletter', 'Newsletter', 'trim|is_unique[newletters.newletter_mail]|required|xss_clean');
		$this->form_validation->set_message('is_unique', 'Already in use!');

		if($this->form_validation->run() == FALSE)
		{
			//validation with errors
			$this->session->set_flashdata('the_error','Email has Already been added for Newsletter Subscription.');
			redirect('category');
		}else{
			$data = $this->home_model->get_newsletter_add();	

			$this->session->set_flashdata('the_success','Email successfully added for Newsletter Subscription.');
			redirect('category');
		}
	}

	public function getprodprice()
    {
        $quant_id = $_POST['action'];
		$quant_options = $this->filter_model->quant_options($quant_id);

		if($quant_options != '')
		{
			echo "₦".number_format($quant_options);
 		} 
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */