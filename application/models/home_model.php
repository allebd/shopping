<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

	}

	public function get_info()
	{
		$data['title'] = 'Gracefoods';
				
		$data['page'] = 'home';

		$this->db->limit(6);
		$data['menuquery'] = $this->db->get('menu');

		$data['social'] = $this->db->get('social');

		$this->db->where('id', '1');
		$data['contact1query1'] = $this->db->get('contact');

		$this->db->where('id', '2');
		$data['contact1query2'] = $this->db->get('contact');

		$this->db->where('id', '3');
		$data['contact1query3'] = $this->db->get('contact');

		$this->db->where('user_mail', $this->session->userdata('username'));
		$data['regquery'] = $this->db->get('regusers');

        $this->db->where('cart_user', $this->session->userdata('username'));
		$data['cartquery'] = $this->db->get('cart');

		$data['menu1query'] = $this->db->get('menu');

		$this->db->select('*');		
		$this->db->from('cart');
		$this->db->where('cart_user', $this->session->userdata('current_reg_id'));
		$this->db->where_not_in('product_status','deleted');
		$this->db->join('products', 'cart.cart_product = products.product_code');	
		$this->db->join('quantities', 'cart.cart_measure = quantities.quant_id');	
		$this->db->order_by("cart_id", "desc");
		$this->db->limit(2);
		$data['cartquery']= $this->db->get();

		$this->db->select('*');		
		$this->db->from('products');
		$this->db->where_not_in('product_status','deleted');
		$this->db->join('submenu', 'submenu.thesmid = products.product_cat');
		$this->db->join('menu', 'menu.themid = submenu.menuid');			
		$this->db->order_by("product_id", "desc");
		$this->db->limit(3);
		$data['latestquery'] = $this->db->get();

		$this->db->select('*');		
		$this->db->from('products');
		$this->db->where_not_in('product_status','deleted');
		$this->db->join('submenu', 'submenu.thesmid = products.product_cat');
		$this->db->join('menu', 'menu.themid = submenu.menuid');			
		$this->db->order_by("counter", "desc");
		$this->db->limit(3);
		$data['popularquery'] = $this->db->get();

		$this->db->select('*');		
		$this->db->from('products');
		$this->db->where_not_in('product_status','deleted');
		$this->db->join('submenu', 'submenu.thesmid = products.product_cat');
		$this->db->join('menu', 'menu.themid = submenu.menuid');			
		$this->db->order_by("rand()");
		$this->db->limit(4);
		$data['weekquery'] = $this->db->get();

		$this->db->select('*');		
		$this->db->from('products');
		$this->db->where_not_in('product_status','deleted');
		$this->db->join('submenu', 'submenu.thesmid = products.product_cat');
		$this->db->join('menu', 'menu.themid = submenu.menuid');			
		$this->db->order_by("product_id", "desc");
		$this->db->limit(4);
		$data['arrivequery'] = $this->db->get();

		$this->db->order_by("slide_number", "asc");
		$data['slidequery'] = $this->db->get('slide');
		
        return $data;
	}

	public function get_review_add()
	{		
		date_default_timezone_set("Africa/Lagos");
		
		$rev_insert = array(
			'review_prod' => $this->input->post('revcode'),
			'review_user' => $this->input->post('revname'),
			'review_mail' => $this->input->post('revmail'),
			'review_text' => $this->input->post('revtext')
			);

		$rev['insert'] = $this->db->insert('reviews', $rev_insert);
		return $rev;
	}

	public function get_newsletter_add()
	{		
		date_default_timezone_set("Africa/Lagos");
		
		$new_insert = array(
			'newletter_mail' => $this->input->post('newletter')
			);

		$news['insert'] = $this->db->insert('newletters', $new_insert);
		return $news;
	}
} 
