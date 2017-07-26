<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_admin_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

	}

	public function get_info()
	{
		$data['title'] = 'Administrator | Gracefoods';

		$this->db->where('admin_username', $this->session->userdata('admin_username'));
		$data['regquery'] = $this->db->get('admin');		

		$data['page_title'] = '';

		$this->db->order_by("admin_surname", "asc");
		$this->db->where_not_in('admin_username', $this->session->userdata('admin_username'));
		$this->db->where_not_in('admin_status', 'deleted');
		$data['adminquery'] = $this->db->get('admin');

		$this->db->where_not_in('user_status', 'deleted');
		$data['custquery'] = $this->db->get('regusers');

		$data['socquery'] = $this->db->get('social');

		$this->db->where('id', $this->uri->segment(3));
		$data['soceditquery'] = $this->db->get('social');

		$data['aboutquery'] = $this->db->get('about');

		$this->db->where('id', $this->uri->segment(3));
		$data['abouteditquery'] = $this->db->get('about');

		$this->db->order_by("slide_number", "asc");
		$data['slidequery'] = $this->db->get('slide');

		$this->db->where('slide_code', $this->uri->segment(3));
		$data['slideeditquery'] = $this->db->get('slide');

		$data['faqquery'] = $this->db->get('faq');

		$this->db->where('id', $this->uri->segment(3));
		$data['faqeditquery'] = $this->db->get('faq');

		$data['privacyquery'] = $this->db->get('privacy');

		$this->db->where('id', $this->uri->segment(3));
		$data['privacyeditquery'] = $this->db->get('privacy');

		$data['termsquery'] = $this->db->get('terms');

		$this->db->where('id', $this->uri->segment(3));
		$data['termseditquery'] = $this->db->get('terms');

		$data['changesquery'] = $this->db->get('changes');

		$this->db->where('id', $this->uri->segment(3));
		$data['changeseditquery'] = $this->db->get('changes');

		$data['contactquery'] = $this->db->get('contact');

		$this->db->where('id', $this->uri->segment(3));
		$data['contacteditquery'] = $this->db->get('contact');

		$data['welcomequery'] = $this->db->get('welcome_message');

		$this->db->where('id', $this->uri->segment(3));
		$data['welcomeeditquery'] = $this->db->get('welcome_message');

		$this->db->select('*');		
		$this->db->from('orders');
		$this->db->join('products', 'orders.order_product = products.product_code');
		$this->db->order_by("orders.id", "desc");
		$this->db->order_by("order_date", "desc");
        $data['orders'] = $this->db->get();

        $this->db->order_by("id", "desc");
        $data['careers_vacancy'] = $this->db->get('careers');

        $this->db->where('id', $this->uri->segment(3));
        $data['careers_vacancy_edit_query'] = $this->db->get('careers');

        $data['shipping'] = $this->db->get('shipcharge')->result();

        $this->db->order_by("mname", "asc");
        $data['prodtypequery'] = $this->db->get('menu');

        $this->db->where('mid', $this->uri->segment(3));
        $data['prodtypeeditquery'] = $this->db->get('menu');

        $this->db->join('menu', 'menu.themid = submenu.menuid');
        $this->db->order_by("mname", "asc");
        $data['prodsubtypequery'] = $this->db->get('submenu');

        $this->db->where('smid', $this->uri->segment(3));
        $this->db->join('menu', 'menu.themid = submenu.menuid');
        $data['prodsubtypeeditquery'] = $this->db->get('submenu');

        $this->db->select('*');		
		$this->db->from('products');
		$this->db->where_not_in('product_status','deleted');
		$this->db->join('submenu', 'submenu.thesmid = products.product_cat');
		$this->db->join('menu', 'menu.themid = submenu.menuid');			
		$this->db->order_by("product_id", "desc");
		$data['prodquery'] = $this->db->get();

		$this->db->select('*');		
		$this->db->from('products');
		$this->db->where('product_code', $this->uri->segment(3));
		$this->db->where_not_in('product_status','deleted');
		$this->db->join('submenu', 'submenu.thesmid = products.product_cat');
		$this->db->join('menu', 'menu.themid = submenu.menuid');			
		$this->db->order_by("product_id", "desc");
		$data['prodeditquery'] = $this->db->get();

		$this->db->select('*');		
		$this->db->from('products');
		$this->db->where('product_code', $this->uri->segment(3));
		$this->db->where_not_in('product_status','deleted');
		$this->db->join('reviews', 'reviews.review_prod = products.product_code');
		$this->db->order_by("review_id", "desc");
		$data['reviewquery'] = $this->db->get();

		$data['newsquery'] = $this->db->get('newletters');

        return $data;
	}

    public function get_shipping_update(){
        //get_shipping_update
        $shipping_fee = $this->input->post('shipping_fee');

        $update_shipping_fee = array(
            'ship_amount' => $shipping_fee
        );

        $this->db->where('id',1);
        $create['details'] = $this->db->update('shipcharge', $update_shipping_fee );

        return $create;
    }

	public function update_admin()
	{
			$ulast = $this->input->post('user_last');
			$ufirst = $this->input->post('user_first');

			$update_admin_details = array(
				'admin_surname' => $ulast,
				'admin_firstname' => $ufirst
			);

			$this->db->where('admin_username', $this->session->userdata('admin_username'));
			$create['details'] = $this->db->update('admin', $update_admin_details);
			
			return $create;
	}

	// Manage Admin delete
	public function get_admin_delete()
	{	
		$delete_admin = array(
				'admin_status' => 'deleted'
			);

		$this->db->where('admin_id', $this->uri->segment(3));
		$delete = $this->db->update('admin', $delete_admin);

		return $delete;
	}

	// Manage Admin add
	public function get_admins_insert()
	{
		$admin_account_insert = array(
			'admin_surname' => $this->input->post('user_last'),
			'admin_firstname' => $this->input->post('user_first'),
			'admin_username' => $this->input->post('user_name'),
			'admin_password' => sha1($this->config->item('salt').$this->input->post('user_pass'))	
			);

		$insert = $this->db->insert('admin', $admin_account_insert);
		return $insert;
	}

	// Manage product Type delete
	public function get_product_type_delete()
	{	
		$this->db->where('mid', $this->uri->segment(3));
		$delete = $this->db->delete('menu');
		return $delete;
	}

	// Manage product type add
	public function get_product_type_insert()
	{
		$product_type_insert = array(
			'mname' => $this->input->post('thename'),
			'themid' => rand(100000,900000)	
			);

		$insert = $this->db->insert('menu', $product_type_insert);
		return $insert;
	}

	// Manage product type update
	public function get_product_type_update()
	{
		$product_type_update = array(
			'mname' => $this->input->post('thename')	
			);

		$this->db->where('mid', $this->input->post('theid'));
		$update = $this->db->update('menu', $product_type_update);
		return $update;
	}

	// Manage product subType delete
	public function get_product_subtype_delete()
	{	
		$this->db->where('smid', $this->uri->segment(3));
		$delete = $this->db->delete('submenu');
		return $delete;
	}

	// Manage product type add
	public function get_product_subtype_insert()
	{
		$product_subtype_insert = array(
			'menuid' => $this->input->post('thetype'),
			'smname' => $this->input->post('thename'),
			'thesmid' => rand(100000,900000)	
			);

		$insert = $this->db->insert('submenu', $product_subtype_insert);
		return $insert;
	}

	// Manage product subtype update
	public function get_product_subtype_update()
	{
		$product_subtype_update = array(
			'menuid' => $this->input->post('thetype'),
			'smname' => $this->input->post('thename')	
			);

		$this->db->where('smid', $this->input->post('theid'));
		$update = $this->db->update('submenu', $product_subtype_update);
		return $update;
	}

	public function get_product_insert()
	{
		$file_data = $this->upload->data();
		$product_code = rand(1000000,9999999);

		$product_quantity = $this->input->post('prodquantity');		
		$product_price = $this->input->post('prodprice');		
		$product_oldprice = $this->input->post('prodoldprice');

		$prod_insert = array(
			'product_cat' => $this->input->post('thesubtype'),
			'product_name' => $this->input->post('prodname'),
			// 'product_quantity' => $this->input->post('prodquantity'),
			// 'product_price' => $this->input->post('prodprice'),
			// 'product_oldprice' => $this->input->post('prodoldprice'),
			'product_summ' => $this->input->post('prodsumm'),
			'product_desc' => $this->input->post('proddesc'),
			'product_code' => $product_code,
			'thedate' => date('Y-m-d'),
			'product_image' => $file_data['file_name']
			);

		for($i = 0; $i < count($product_quantity); $i++)
		{
			if($product_quantity[$i] != '' && $product_price[$i] != '')
			{
				$quant_insert = array(
				'quant_quantity' => $product_quantity[$i],
				'quant_price' => $product_price[$i],
				'quant_oldprice' => $product_oldprice[$i],
				'quant_code' => $product_code
				);

				$prod['quant'] = $this->db->insert('quantities', $quant_insert);
			}
		}

		$prod['insert'] = $this->db->insert('products', $prod_insert);
		return $prod;
	}

	public function get_product_update()
	{
		$product_code = $this->input->post('prodcode');

		$product_quantity = $this->input->post('prodquantity');		
		$product_price = $this->input->post('prodprice');		
		$product_oldprice = $this->input->post('prodoldprice');

		$prod_update1 = array(
			'product_cat' => $this->input->post('thesubtype'),
			'product_name' => $this->input->post('prodname'),
			// 'product_quantity' => $this->input->post('prodquantity'),
			// 'product_price' => $this->input->post('prodprice'),
			// 'product_oldprice' => $this->input->post('prodoldprice'),
			'product_summ' => $this->input->post('prodsumm'),
			'product_desc' => $this->input->post('proddesc')
			);

		if(!empty($_FILES['prodimage']['name']))
		{
			$file_data = $this->upload->data();

			$prod_update2 = array(
				'product_image' => $file_data['file_name']
			);

			$this->db->where('product_code', $product_code);
			$prod['update2'] = $this->db->update('products', $prod_update2);
		}

		$this->db->where('quant_code', $product_code);
		$prod['delete2'] = $this->db->delete('quantities');

		for($i = 0; $i < count($product_quantity); $i++)
		{
			if($product_quantity[$i] != '' && $product_price[$i] != '')
			{
				$quant_insert = array(
				'quant_quantity' => $product_quantity[$i],
				'quant_price' => $product_price[$i],
				'quant_oldprice' => $product_oldprice[$i],
				'quant_code' => $product_code
				);

				$prod['quant'] = $this->db->insert('quantities', $quant_insert);
			}
		}

		$this->db->where('product_code', $product_code);
		$prod['update1'] = $this->db->update('products', $prod_update1);		

		return $prod;
	}

	// Manage product delete
	public function get_product_delete()
	{	
		$product_code = $this->uri->segment(3);

		$delete_product = array(
				'product_status' => 'deleted'
			);

		$this->db->where('product_code', $product_code);
		$delete['delete1'] = $this->db->update('products', $delete_product);

		$this->db->where('quant_code', $product_code);
		$delete['delete2'] = $this->db->delete('quantities');

		return $delete;
	}

	// Get customer export
	public function get_customer_export()
	{
		$this->db->select('user_last AS Surname, user_first AS Firstname, user_mail AS Email, user_phone AS Phone');		
		$this->db->from('regusers');
		$this->db->where_not_in('user_status', 'deleted');
		$custexport = $this->db->get();

		return $custexport;
	}

	// Manage customer delete
	public function get_customers_delete()
	{	
		$delete_user = array(
				'user_status' => 'deleted'
			);

		$this->db->where('id', $this->uri->segment(3));
		$delete = $this->db->update('regusers', $delete_user);

		return $delete;
	}

	// Get Newsletter export
	public function get_newsletter_export()
	{
		$this->db->select('newletter_mail AS Email');		
		$this->db->from('newletters');
		$newsexport = $this->db->get();

		return $newsexport;
	}

	// Manage Newsletter delete
	public function get_newsletter_delete()
	{	
		$this->db->where('newletter_id', $this->uri->segment(3));
		$delete = $this->db->delete('newletters');

		return $delete;
	}
	
	public function get_social_edit_update()
	{
		$social_update = array(
			'link' => $this->input->post('link')
			);

		$this->db->where('id', $this->input->post('id'));
		$update = $this->db->update('social', $social_update);
		return $update;
	}

	public function get_about_edit_update()
	{
		$about_update = array(
			'description' => $this->input->post('description')
			);

		$this->db->where('id', $this->input->post('id'));
		$update = $this->db->update('about', $about_update);
		return $update;
	}

	// Manage Slide Show
	public function get_slide_insert()
	{
		$file_data = $this->upload->data();
		$slide_code = 'SL'.rand(1000000,9999999);

		$slide_insert = array(
			'picture' => $file_data['file_name'],
			'slide_number' => $this->input->post('slidenum'),
			'caption1' => $this->input->post('caption1'),
			'caption2' => $this->input->post('caption2'),
			'caption3' => $this->input->post('caption3'),
			'slide_code' => $slide_code
			);

		$insert = $this->db->insert('slide', $slide_insert);
		return $insert;
	}

	public function get_slide_update()
	{	
		$slide_code = $this->input->post('slidecode');

		$slide_update = array(
			'slide_number' => $this->input->post('slidenum'),
			'caption1' => $this->input->post('caption1'),
			'caption2' => $this->input->post('caption2'),
			'caption3' => $this->input->post('caption3')
			);

		$this->db->where('slide_code', $slide_code);
		$update = $this->db->update('slide', $slide_update);
		return $update;
	}

	public function get_slide_delete()
	{	
		$this->db->where('slide_code', $this->uri->segment(3));
		$delete = $this->db->delete('slide');
		return $delete;
	}

	public function get_reviews_delete()
	{	
		$this->db->where('review_id', $this->uri->segment(3));
		$delete = $this->db->delete('reviews');
		return $delete;
	}

	// Manage FAQ
	public function get_faq_insert()
	{
		$faq_insert = array(
			'question' => $this->input->post('question'),
			'answer' => $this->input->post('answer')
			);

		$insert = $this->db->insert('faq', $faq_insert);
		return $insert;
	}

	public function get_faq_update()
	{	
		$faq_update = array(
			'question' => $this->input->post('question'),
			'answer' => $this->input->post('answer')
			);

		$this->db->where('id', $this->input->post('theid'));
		$faq['update'] = $this->db->update('faq', $faq_update);
		return $faq;
	}

	public function get_faq_delete()
	{	
		$this->db->where('id', $this->uri->segment(3));
		$delete = $this->db->delete('faq');
		return $delete;
	}

	public function get_privacy_update()
	{	
		$privacy_update = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
			);

		$this->db->where('id', $this->input->post('theid'));
		$privacy['update'] = $this->db->update('privacy', $privacy_update);
		return $privacy;
	}

	public function get_terms_update()
	{	
		$terms_update = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
			);

		$this->db->where('id', $this->input->post('theid'));
		$terms['update'] = $this->db->update('terms', $terms_update);
		return $terms;
	}

	public function get_changes_update()
	{	
		$changes_update = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
			);

		$this->db->where('id', $this->input->post('theid'));
		$changes['update'] = $this->db->update('changes', $changes_update);
		return $changes;
	}

	public function get_contact_update()
	{	
		$contact_update = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
			);

		$this->db->where('id', $this->input->post('theid'));
		$contact['update'] = $this->db->update('contact', $contact_update);
		return $contact;
	}

	public function get_welcome_update()
	{	
		$welcome_update = array(
			'subject' => $this->input->post('subject'),
			'message' => $this->input->post('message'),
			'signature' => $this->input->post('signature')
			);

		$this->db->where('id', $this->input->post('theid'));
		$welcome['update'] = $this->db->update('welcome_message', $welcome_update);
		return $welcome;
	}

	public function get_old_password()
	{
		$username = $this->session->userdata('admin_username');
		$sql = "SELECT admin_password FROM admin WHERE admin_username='{$username}' LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->row();

		return ($result->num_rows() === 1) ? $row->admin_password : false;
	}

	public function get_password_update()
	{	
		$new_pass = sha1($this->config->item('salt').$this->input->post('new_pass'));

		$password_update = array(
			'admin_password' => $new_pass
			);

		$this->db->where('admin_username', $this->session->userdata('admin_username'));
		$pass['update'] = $this->db->update('admin', $password_update);
		return $pass;
	}

    public function get_careers_update()
    {
        $career_update1= array(
            'position' => $this->input->post('vacancy_subject'),
            'description' => $this->input->post('vacancy_body'),
            'closing_date' => $this->input->post('vacancy_date')
        );

        $this->db->where('id', $this->input->post('theid'));
        $career['update1'] = $this->db->update('careers', $career_update1);
        return $career;
    }

    public  function  get_careers_insert(){

        $vacancy_insert = array(
            'position' => $this->input->post('vacancy_subject'),
            'description' => $this->input->post('vacancy_body'),
            'closing_date' => $this->input->post('vacancy_date')
        );

        $this->db->insert('careers', $vacancy_insert);
    }

    // Manage Careers/Vacancy delete
    public function get_careers_delete()
    {
        $this->db->where('id', $this->uri->segment(3));
        $delete = $this->db->delete('careers');
        return $delete;
    }

    public function get_orders_update()
    {
        $order_update = array(
            'order_status' => $this->uri->segment(3)
        );

        $this->db->where('id', $this->uri->segment(4));
        $order['update'] = $this->db->update('orders', $order_update);
        return $order;
    }
} 
