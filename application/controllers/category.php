<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('category_model');
    }

    public function index()
    {
        // if(($this->uri->segment(1) != '') && ($this->uri->segment(2) != '') && ($this->uri->segment(3) != '') && ($this->uri->segment(4) == '') && ($this->uri->segment(2) == 'search'))
        if(($this->uri->segment(1) != '') && ($this->uri->segment(2) != '') && ($this->uri->segment(3) != '') && ($this->uri->segment(4) != ''))
        {   
            $data = $this->category_model->get_info();
            $data['query'] = '';    
            $data['is_logged_in'] = $this->session->userdata('is_logged_in');
            $data['main_content'] = 'category/product';
            
            $this->load->view('includes/template', $data);
        }else{
            $data = $this->category_model->get_info();
            $data['query'] = '';    
            $data['is_logged_in'] = $this->session->userdata('is_logged_in');
            $data['main_content'] = 'category/index';
            
            $this->load->view('includes/template', $data);   
        }        
    }
}

/* End of file category.php */
/* Location: ./application/controllers/category.php */