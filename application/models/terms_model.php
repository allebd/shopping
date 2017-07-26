<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terms_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

	}

	public function get_info()
	{
		$data['title'] = 'Terms and Conditions | Gracefoods';
		
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
		
		$this->db->select('*');		
		$this->db->from('cart');
		$this->db->where('cart_user', $this->session->userdata('current_reg_id'));
		$this->db->where_not_in('product_status','deleted');
		$this->db->join('products', 'cart.cart_product = products.product_code');
		$this->db->join('quantities', 'cart.cart_measure = quantities.quant_id');		
		$this->db->order_by("cart_id", "desc");
		$this->db->limit(2);
		$data['cartquery']= $this->db->get();

		$data['termsquery'] = $this->db->get('terms');
		
		return $data;
	}
} 
