<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

	}

	public function get_info()
	{
		if(($this->uri->segment(2) == ''))
		{
			$data['title'] = ucwords(str_replace('_', ' ', str_replace('__', '(', str_replace('___', ')', $this->uri->segment(1))))).' | Gracefoods';
		}else if(($this->uri->segment(3) == '') && ($this->uri->segment(2) != ''))
		{
			$data['title'] = ucwords(str_replace('_', ' ', str_replace('__', '(', str_replace('___', ')', $this->uri->segment(2))))).' | Gracefoods';
		}else if(($this->uri->segment(4) == '') && ($this->uri->segment(3) != '') && ($this->uri->segment(2) != '') && ($this->uri->segment(2) != 'search'))
		{
			$data['title'] = ucwords(str_replace('_', ' ', str_replace('__', '(', str_replace('___', ')', $this->uri->segment(3))))).' | Gracefoods';
		}else if(($this->uri->segment(4) == '') && ($this->uri->segment(3) != '') && ($this->uri->segment(2) != '') && ($this->uri->segment(2) == 'search'))
		{
			$data['title'] = 'Search | Gracefoods';
		}else if(($this->uri->segment(5) == '') && ($this->uri->segment(4) != '') && ($this->uri->segment(3) != '') && ($this->uri->segment(2) != ''))
		{
			$data['title'] = ucwords(str_replace('_', ' ', str_replace('__', '(', str_replace('___', ')', $this->uri->segment(4))))).' | Gracefoods';
		}else if(($this->uri->segment(6) == '') && ($this->uri->segment(5) != '') && ($this->uri->segment(4) != '') && ($this->uri->segment(3) != '') && ($this->uri->segment(2) != ''))
		{
			$data['title'] = ucwords(str_replace('_', ' ', str_replace('__', '(', str_replace('___', ')', $this->uri->segment(5))))).' | Gracefoods';
		}else if(($this->uri->segment(7) == '') && ($this->uri->segment(6) != '') && ($this->uri->segment(5) != '') && ($this->uri->segment(4) != '') && ($this->uri->segment(3) != '') && ($this->uri->segment(2) != ''))
		{
			$data['title'] = ucwords(str_replace('_', ' ', str_replace('__', '(', str_replace('___', ')', $this->uri->segment(6))))).' | Gracefoods';
		}else 
		{
			$data['title'] = 'Category | Gracefoods';
		}
		
		$this->db->limit(6);
		$data['menuquery'] = $this->db->get('menu');

		$data['social'] = $this->db->get('social');

		$this->db->where('id', '1');
		$data['contact1query1'] = $this->db->get('contact');

		$this->db->where('id', '2');
		$data['contact1query2'] = $this->db->get('contact');

		$this->db->where('id', '3');
		$data['contact1query3'] = $this->db->get('contact');

		$data['menu1query'] = $this->db->get('menu');
		
		$data['page'] = 'about';
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


		if(($this->uri->segment(3) == '') && ($this->uri->segment(2) != '') && ($this->uri->segment(2) != 'search'))
		{	
			$theproduct = str_replace('_', ' ', str_replace('__', '(', str_replace('___', ')', $this->uri->segment(2))));

			$this->db->select('*');		
			$this->db->from('products');
			$this->db->like('mname',$theproduct);
			$this->db->where_not_in('product_status','deleted');
			$this->db->join('submenu', 'submenu.thesmid = products.product_cat');
			$this->db->join('menu', 'menu.themid = submenu.menuid');			
			$this->db->order_by("product_id", "desc");
			$data['arrivequery'] = $this->db->get();
		}else if(($this->uri->segment(4) == '') && ($this->uri->segment(3) != '') && ($this->uri->segment(2) != '') && ($this->uri->segment(2) != 'search'))
		{	
			$theproduct = str_replace('_', ' ', str_replace('__', '(', str_replace('___', ')', $this->uri->segment(3))));

			$this->db->select('*');		
			$this->db->from('products');
			$this->db->like('smname',$theproduct);
			$this->db->where_not_in('product_status','deleted');
			$this->db->join('submenu', 'submenu.thesmid = products.product_cat');
			$this->db->join('menu', 'menu.themid = submenu.menuid');			
			$this->db->order_by("product_id", "desc");
			$data['arrivequery'] = $this->db->get();
		}else if(($this->uri->segment(5) == '') && ($this->uri->segment(4) != '') && ($this->uri->segment(3) != '') && ($this->uri->segment(2) != '') && ($this->uri->segment(2) != 'search'))
		{	
			$theproduct = str_replace('_', ' ', str_replace('__', '(', str_replace('___', ')', $this->uri->segment(4))));

			$this->db->select('*');		
			$this->db->from('products');
			$this->db->like('product_code',$theproduct);
			$this->db->where_not_in('product_status','deleted');
			$this->db->join('submenu', 'submenu.thesmid = products.product_cat');
			$this->db->join('menu', 'menu.themid = submenu.menuid');			
			$this->db->order_by("product_id", "desc");
			$data['productquery'] = $this->db->get();

			$this->db->select('counter');		
			$this->db->from('products');
			$this->db->like('product_code',$theproduct);
			$thecounter = $this->db->get();
			foreach($thecounter->result() as $from){
				$thecounter = $from->counter + 1;

				$prod_update = array(
					'counter' => $thecounter
				);

			$this->db->where('product_code', $theproduct);
			$insert = $this->db->update('products', $prod_update);
			}

			$data['shippin'] = $this->db->get('shipcharge')->result();
		}else if(($this->uri->segment(2) == 'search'))
		{	
			if($this->uri->segment(3) == 'name')
			{
				$this->db->select('*');		
				$this->db->from('products');
				$this->db->where_not_in('product_status','deleted');
				$this->db->join('submenu', 'submenu.thesmid = products.product_cat');
				$this->db->join('menu', 'menu.themid = submenu.menuid');			
				$this->db->order_by("product_name", "asc");
				$data['arrivequery'] = $this->db->get();
			}else if($this->uri->segment(3) == 'price')
			{
				$this->db->select('*');		
				$this->db->from('products');
				$this->db->where_not_in('product_status','deleted');
				$this->db->join('submenu', 'submenu.thesmid = products.product_cat');
				$this->db->join('menu', 'menu.themid = submenu.menuid');			
				$this->db->order_by("product_price", "asc");
				$data['arrivequery'] = $this->db->get();
			}else if($this->uri->segment(3) == 'popular')
			{
				$this->db->select('*');		
				$this->db->from('products');
				$this->db->where_not_in('product_status','deleted');
				$this->db->join('submenu', 'submenu.thesmid = products.product_cat');
				$this->db->join('menu', 'menu.themid = submenu.menuid');			
				$this->db->order_by("counter", "desc");
				$data['arrivequery'] = $this->db->get();
			}else if($this->uri->segment(3) == 'latest')
			{
				$this->db->select('*');		
				$this->db->from('products');
				$this->db->where_not_in('product_status','deleted');
				$this->db->join('submenu', 'submenu.thesmid = products.product_cat');
				$this->db->join('menu', 'menu.themid = submenu.menuid');			
				$this->db->order_by("product_id", "desc");
				$data['arrivequery'] = $this->db->get();
			}else {
				if($this->input->post('searchall'))
				{
					$theproduct = $this->input->post('searchall');
					$this->db->select('*');		
					$this->db->from('products');
					$this->db->like('product_name',$theproduct);
					$this->db->or_like('smname',$theproduct);
					$this->db->or_like('mname',$theproduct);
					$this->db->where_not_in('product_status','deleted');
					$this->db->join('submenu', 'submenu.thesmid = products.product_cat');
					$this->db->join('menu', 'menu.themid = submenu.menuid');			
					$this->db->order_by("product_id", "desc");
					$data['arrivequery'] = $this->db->get();
				}else{
					$theproduct = '';
					$this->db->select('*');		
					$this->db->from('products');
					$this->db->like('product_name',$theproduct);
					$this->db->or_like('smname',$theproduct);
					$this->db->or_like('mname',$theproduct);
					$this->db->where_not_in('product_status','deleted');
					$this->db->join('submenu', 'submenu.thesmid = products.product_cat');
					$this->db->join('menu', 'menu.themid = submenu.menuid');			
					$this->db->order_by("product_id", "desc");
					$data['arrivequery'] = $this->db->get();
				}				
			}			
		}else{
			$this->db->select('*');		
			$this->db->from('products');
			$this->db->where_not_in('product_status','deleted');
			$this->db->join('submenu', 'submenu.thesmid = products.product_cat');
			$this->db->join('menu', 'menu.themid = submenu.menuid');			
			$this->db->order_by("product_id", "desc");
			$data['arrivequery'] = $this->db->get();
		}		

		return $data;
	}
} 
