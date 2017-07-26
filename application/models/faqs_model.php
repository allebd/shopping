<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class faqs_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

	}

	public function get_info()
	{
		$data['title'] = 'Faqs | Gracefoods';
		
		$this->db->limit(6);
		$data['menuquery'] = $this->db->get('menu');

		$data['social'] = $this->db->get('social');

		$this->db->where('id', '1');
		$data['contact1query1'] = $this->db->get('contact');

		$this->db->where('id', '2');
		$data['contact1query2'] = $this->db->get('contact');

		$this->db->where('id', '3');
		$data['contact1query3'] = $this->db->get('contact');
				
		$data['page'] = '';
		$this->db->where('user_mail', $this->session->userdata('username'));
		$data['regquery'] = $this->db->get('regusers');

		$this->db->select('*');		
		$this->db->from('cart');
		$this->db->where('cart_user', $this->session->userdata('current_reg_id'));
		$this->db->where_not_in('product_status','deleted');
		$this->db->join('products', 'cart.cart_product = products.product_code');	
		$this->db->join('quantities', 'cart.cart_measure = quantities.quant_id');	
		$this->db->order_by("cart_id", "desc");
		$this->db->limit(2);
		$data['cartquery']= $this->db->get();

		$data['faqquery'] = $this->db->get('faq');

		return $data;
	}

	public function sending_msg()
	{
		$dfullname = $this->input->post('dfullname');
		$demail = $this->input->post('demail');
		$dmessage = $this->input->post('dmessage');

		$this->load->library('email');

		$this->email->set_mailtype('html');
		$this->email->set_newline("\r\n");

		$this->email->from($demail, 'Gracefoods Customer');
		$this->email->to('enquiry@gracefoodsonline.com');
		$this->email->subject('Customer FAQ');

		$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
								"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html><head>
								<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
								</head><body>';
		$message .= '<p>'.$dmessage.'</p>';		
		$message .= '<p>Customer Name:'.$dfullname.'</p>';
		$this->email->message($message);
		$this->email->send();

		return true;
	}
} 
