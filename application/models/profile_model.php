<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

	}

	public function get_info()
	{
		$data['title'] = 'Gracefoods';
		$cartId = $this->session->userdata('cart_items')['cart_id'];
		
		$data['page'] = '';

		$this->db->limit(6);
		$data['menuquery'] = $this->db->get('menu');

		$data['social'] = $this->db->get('social');

		$this->db->where('id', '1');
		$data['contact1query1'] = $this->db->get('contact');

		$this->db->where('id', '2');
		$data['contact1query2'] = $this->db->get('contact');

		$this->db->where('id', '3');
		$data['contact1query3'] = $this->db->get('contact');
		
		$data['page'] = 'about';
		$this->db->where('myid', $this->session->userdata('current_reg_id'));
		$data['regquery'] = $this->db->get('regusers');

		$this->db->select('*');		
		$this->db->from('regusers');
		$this->db->where('myid', $this->session->userdata('current_reg_id'));;
		$data['profilequery']= $this->db->get();

		$this->db->select('*');		
		$this->db->from('regadd');
		$this->db->where('user_mail', $this->session->userdata('current_reg_id'));
		$this->db->where_not_in('addstatus', 'deleted');
		$this->db->join('countries', 'countries.countryid = regadd.country');
		$this->db->join('states', 'states.state_id = regadd.state');
		$data['addquery']= $this->db->get();

		$this->db->select('*');		
		$this->db->from('orders');
		$this->db->where('username', $this->session->userdata('current_reg_id'));
		$this->db->join('products', 'orders.order_product = products.product_code');
		$this->db->order_by("orders.id", "desc");
		$this->db->order_by("order_date", "desc");
		$data['orderquery']= $this->db->get();

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
		$this->db->from('cart');
		$this->db->where('cart_user', $this->session->userdata('current_reg_id'));
		$this->db->where_not_in('product_status','deleted');
		$this->db->join('products', 'cart.cart_product = products.product_code');
		$this->db->join('quantities', 'cart.cart_measure = quantities.quant_id');		
		$this->db->order_by("cart_id", "desc");
		$data['cartthequery']= $this->db->get();

		$this->db->select('*');		
		$this->db->from('wishlists');
		$this->db->where('wish_user', $this->session->userdata('current_reg_id'));		
		$this->db->where_not_in('product_status','deleted');
		$this->db->join('products', 'wishlists.wish_product = products.product_code');
		$this->db->join('submenu', 'submenu.thesmid = products.product_cat');
		$this->db->join('menu', 'menu.themid = submenu.menuid');	
		$this->db->order_by("wishlist_id", "desc");
		$data['wishquery']= $this->db->get();

		$this->db->select('*');		
		$this->db->from('cart');
		$this->db->where('cart_user', $this->session->userdata('current_reg_id'));
		$this->db->where_not_in('product_status','deleted');
		$this->db->join('products', 'cart.cart_product = products.product_code');		
		$this->db->order_by("cart_id", "desc");
		$data['thecartquery']= $this->db->get();

        $data['shippin'] = $this->db->get('shipcharge')->result();

        return $data;
	}

	public function update_user()
	{
			$ulast = $this->input->post('user_last');
			$ufirst = $this->input->post('user_first');
			$uphone = $this->input->post('user_phone');	

			$update_user_details = array(
				'user_last' => $ulast,
				'user_first' => $ufirst,
				'user_phone' => $uphone
			);

			$this->db->where('myid', $this->session->userdata('current_reg_id'));
			$create['details'] = $this->db->update('regusers', $update_user_details);
			return $create;
	}

	public function insert_user_add()
	{
			$countryadd = $this->input->post('countryadd');
			$stateadd = $this->input->post('stateadd');
			$theaddress = $this->input->post('theaddress');
			if(isset($_POST['primaryadd']) && $_POST['primaryadd'])
			{
				$primaryadd = 1;

				$allprimary_update = array(
					'primaryadd' => 0
					);

				$this->db->where('user_mail', $this->session->userdata('current_reg_id'));
				$create['all'] = $this->db->update('regadd', $allprimary_update);
			}else{
				$primaryadd = 0;
			}			

			$insert_user_details = array(
				'country' => $countryadd,
				'state' => $stateadd,
				'address' => $theaddress,
				'primaryadd' => $primaryadd,
				'user_mail' => $this->session->userdata('current_reg_id')
			);

			$create['details'] = $this->db->insert('regadd', $insert_user_details);
			
			return $create;
	}

	public function add_edit($addid="")
	{	
		$data = array();
		$this->db->select('*');		
		$this->db->from('regadd');
		$this->db->where('id', $addid);
		$this->db->where('user_mail', $this->session->userdata('current_reg_id'));
		$this->db->where_not_in('addstatus', 'deleted');
		$this->db->join('countries', 'countries.countryid = regadd.country');
		$this->db->join('states', 'states.state_id = regadd.state');
		$theadd = $this->db->get();

		if($theadd->num_rows > 0) 
		{
            $data = $theadd->result();
        }
        return $data;
	}

	public function update_user_add()
	{
			$theid = $this->input->post('theid');
			$countryadd = $this->input->post('countryadd');
			$stateadd = $this->input->post('stateadd');
			$theaddress = $this->input->post('theaddress');			

			$update_user_details = array(
				'country' => $countryadd,
				'state' => $stateadd,
				'address' => $theaddress
			);

			$this->db->where('id', $theid);
			$create['details'] = $this->db->update('regadd', $update_user_details);
			
			return $create;
	}

	public function delete_user_add()
	{
			$delete_user_add = array(
				'addstatus' => 'deleted'
			);

			$this->db->where('id', $this->uri->segment(3));
			$create['details'] = $this->db->update('regadd', $delete_user_add);
			
			return $create;
	}

	public function primaryadd_update($primaryadd)
	{
		$allprimary_update = array(
			'primaryadd' => 0
			);
		$oneprimary_update = array(
			'primaryadd' => 1
			);

		$this->db->where('user_mail', $this->session->userdata('current_reg_id'));
		$update['all'] = $this->db->update('regadd', $allprimary_update);

		$this->db->where('id', $primaryadd);
		$update['one'] = $this->db->update('regadd', $oneprimary_update);

		return $update;
	}

	public function get_paid()
	{
        $paymenttype = $this->uri->segment(3);
        $username = $this->session->userdata('username');
        $customer_id = $this->session->userdata('current_reg_id');

        $this->db->select('*');		
		$this->db->from('cart');
		$this->db->where('cart_user', $this->session->userdata('current_reg_id'));
		$this->db->where_not_in('product_status','deleted');
		$this->db->join('products', 'cart.cart_product = products.product_code');		
		$this->db->order_by("cart_id", "desc");
		$cartBasket = $this->db->get();

		$product_code = '';
		$cart_price = '';
		$product_image = '';
		$product_name = '';
		$cart_quantity = '';
		$theaddress = '';

		$this->db->select('*');		
		$this->db->from('regadd');
		$this->db->where('primaryadd', '1');
		$this->db->where('user_mail', $this->session->userdata('current_reg_id'));
		$this->db->where_not_in('addstatus', 'deleted');
		$this->db->join('countries', 'countries.countryid = regadd.country');
		$this->db->join('states', 'states.state_id = regadd.state');
		$theaddquery = $this->db->get();

		foreach($theaddquery->result() as $addrow){
			$theaddress = $addrow->address.' '.$addrow->state_name.' '.$addrow->country;
		}

		foreach($cartBasket->result() as $cb){
			$product_code = $cb->product_code;
			$product_name = $cb->product_name;
			$product_quantity = $cb->product_quantity;
			$cart_quantity = $cb->cart_quantity;
			$cart_price = $cb->product_price * $cb->cart_quantity;
			$product_image = $cb->product_image;

			date_default_timezone_set("Africa/Lagos");
			$order_insert1 = array(
				'username' => $customer_id,			
				'order_product' => $product_code,
				'order_quantity' => $cart_quantity,
				'order_price' => $cart_price,
				'order_type' => $paymenttype,
				'order_date' => date('Y-m-d'),
				'order_status' => ''
				);

			$style['insert1'] = $this->db->insert('orders', $order_insert1);		


			// Email Sending
	        $demail = $this->session->userdata('username');  

	        $this->load->library('email');

	        $this->email->set_mailtype('html');
	        $this->email->set_newline("\r\n");

	        $this->email->from($demail, 'Gracefoods Customer');

	        $this->email->to('info@gracefoodsonline.com');
	        $this->email->subject('New Order by Customer');

	        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	                                "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html><head>
	                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	                                </head><body>';
	        $message .= '<p>Customer Id: '.$customer_id.'</p>';
	        $message .= '<p>Customer Email: '.$username.'</p>';
	        $message .= '<p>Total Amount to be paid: '.$cart_price.'</p>';
	        $message .= '<p>Payment Type: '.ucwords($paymenttype).'</p>';

        	$message .= '<p>Product Code: '.$product_code.'</p>';
        	$message .= '<p>Product Name: '.$product_name.'</p>';
        	$message .= '<p>Product Quantity: '.$cart_quantity.'</p>';
        	$message .= '<p>Product Measure: '.$product_quantity.'</p>';
        	$message .= '<p>Delivery Address: '.$theaddress.'</p>';

	        $message .= '<p>Attached to this mail are the orders.</p>';
	        $this->email->message($message);

	        if($product_code != '')
	        {
	        	$attachment1 = set_realpath('assets/products');
	        	$this->email->attach($attachment1.''.$product_image);
	        }
	        
	        $this->email->send();
	        // Email Sending

	        $this->db->where('cart_product', $product_code);
			$this->db->where('cart_user', $customer_id);
			$style['delete'] = $this->db->delete('cart');
		}

		return true;
	}

	public function get_cart_add()
	{		
		date_default_timezone_set("Africa/Lagos");
		//$productId = $this->uri->segment(3);
		$productId = $this->input->post('product_code');
		$measure = $this->input->post('measure');

		if($measure == 'measure')
		{
			$this->db->select('*');     
            $this->db->from('quantities');
            $this->db->where('quant_code', $productId);
            $this->db->order_by("quant_price", "desc");
            $this->db->limit(1);
            $quant_ar = $this->db->get();

            foreach($quant_ar->result() as $quantarow)
            {
            	$measure = $quantarow->quant_id;
            }
		}
		
		$cart_insert = array(
			//'cart_product' => $this->uri->segment(3)
			'cart_measure' => $measure,
			'cart_product' => $productId,
			'cart_user' => $this->session->userdata('current_reg_id'),
			'cart_quantity' => '1',
			'cart_date' => date('Y-m-d')
			);

		$cart['insert'] = $this->db->insert('cart', $cart_insert);
		return $cart;
	}

	public function get_cart_update()
	{	
		$quantity = $_POST['quantity'];
        $theproduct = $_POST['theproduct'];
        $measure = $_POST['measure'];

        for($i = 0; $i < count($theproduct); $i++)
        {
            $newquantity = $quantity[$i];
            $dproduct = $theproduct[$i];
            $dmeasure = $measure[$i];

            $cart_update = array(
            	'cart_measure' => $dmeasure,
				'cart_quantity' => $newquantity
				);

            $this->db->where('cart_id', $dproduct);
			$update = $this->db->update('cart', $cart_update);
        }

		return $update;
	}

	public function get_cart_delete()
	{	
		$this->db->where('cart_id', $this->uri->segment(3));
		$delete = $this->db->delete('cart');
		return $delete;
	}

	public function get_wish_add()
	{		
		date_default_timezone_set("Africa/Lagos");
		$productId = $this->uri->segment(3);
		
		$wish_insert = array(
			'wish_product' => $this->uri->segment(3),
			'wish_user' => $this->session->userdata('current_reg_id')
			);

		$wish['insert'] = $this->db->insert('wishlists', $wish_insert);
		return $wish;
	}

	public function get_wish_delete()
	{	
		$this->db->where('wishlist_id', $this->uri->segment(3));
		$delete = $this->db->delete('wishlists');
		return $delete;
	}	
} 
