<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Careers extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('careers_model');
    }

    public function index()
    {
        $data = $this->careers_model->get_info();
        $data['query'] = '';
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');
        $data['main_content'] = 'careers/index';
        $this->load->view('includes/template', $data);
    }
}

/* End of file careers.php */
/* Location: ./application/controllers/careers.php */