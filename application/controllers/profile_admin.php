<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_admin extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
		$this->is_adminlogged_in();
		$this->load->model('filter_model');
		$this->load->model('profile_admin_model');
		$this->load->helper("generalusage");
	}

	public function index()
	{
		if(isset($_POST['profilesubmit']))
		{
			//field name, error message, validation rules
			$this->form_validation->set_rules('user_last', 'Last Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('user_first', 'First Name', 'trim|required|xss_clean');

			if($this->form_validation->run() == FALSE)
			{
					//validation with errors
					$data = $this->profile_admin_model->get_info();
					$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
                    $data['my_side_link'] = getCurrentUrl();
                    $data['admin_dashboard_side_content'] = 'admin/dashboard_index';
					$data['main_content'] = 'admin/dashboard';
					$this->load->view('includes/template',$data);
			}
			else
			{
				//update without errors
				if($query = $this->profile_admin_model->update_admin())
				{ 
					//profile update successful
					$this->session->set_flashdata('the_success','Profile has been successfully updated.');
					redirect('profile_admin');
				}
				else{
					//profile update not successful
					$this->session->set_flashdata('the_error','Profile update not successful.');
					redirect('profile_admin');
				}
			}
		}else{

           	$data = $this->profile_admin_model->get_info();
            $data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
			$data['my_side_link'] = getCurrentUrl();
			$data['admin_dashboard_side_content'] = 'admin/dashboard_index';
			$data['main_content'] = 'admin/dashboard';
            $this->load->view('includes/template',$data);
		}
	}

	public function manage_admins()
	{
		$data = $this->profile_admin_model->get_info();
		$data['incorrect_login'] = '';	
		$data['reg_success'] = '';
        $data['admin_dashboard_side_content'] = 'admin/manage_admins';
        $data['my_side_link'] = getCurrentUrl();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
		 $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function admin_delete()
	{
		$data = $this->profile_admin_model->get_admin_delete();

		$this->session->set_flashdata('the_success','Admin was successfully deleted.');
		$data['my_side_link'] = getCurrentUrl();
		redirect('profile_admin/manage_admins');
	}

	public function admins_insert()
	{
		//field name, error message, validation rules
		$this->form_validation->set_rules('user_last', 'Last Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('user_first', 'First Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('user_name', 'Username', 'trim|required|is_unique[admin.admin_username]|xss_clean');
		$this->form_validation->set_rules('user_pass', 'Password', 'trim|required|min_length[4]|max_length[32]|xss_clean');
		$this->form_validation->set_message('is_unique', 'Already in use!');		


		if($this->form_validation->run() == FALSE)
		{
			//validation with errors
			$this->session->set_flashdata('the_error','Error in adding admin, try again.');
			redirect('profile_admin/manage_admins');
		}
		else
		{
			//update without errors
			if($data = $this->profile_admin_model->get_admins_insert())
			{ 
				//profile update successful
				$this->session->set_flashdata('the_success','Admin was successfully added.');
				redirect('profile_admin/manage_admins');
			}
			else{
				//profile update not successful
				$this->session->set_flashdata('the_error','Admin could not be added, please try again.');
				redirect('profile_admin/manage_admins');
			}
		}
	}

	public function manage_product_type()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
		$data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_product_type';
		$data['main_content'] = 'admin/dashboard';

		$this->load->view('includes/template',$data);
	}

	public function manage_product_type_delete()
	{
		$data = $this->profile_admin_model->get_product_type_delete();	

		$this->session->set_flashdata('the_success','Product type successfully deleted.');
		redirect('profile_admin/manage_product_type');
	}

	public function manage_product_type_insert()
	{
		//field name, error message, validation rules
		$this->form_validation->set_rules('thename', 'Type', 'trim|required|is_unique[menu.mname]|xss_clean');
		$this->form_validation->set_message('is_unique', 'Type already exist!');		


		if($this->form_validation->run() == FALSE)
		{
			//validation with errors	
			$this->session->set_flashdata('the_error','Error in adding product type, please try again.');
			redirect('profile_admin/manage_product_type');
		}
		else
		{
			//update without errors
			if($data = $this->profile_admin_model->get_product_type_insert())
			{ 
				//update successful
				$this->session->set_flashdata('the_success','Product type successfully added.');
				redirect('profile_admin/manage_product_type');
			}
			else{
				//profile update not successful
				$this->session->set_flashdata('the_error','Product type could not be added, please try again.');
				redirect('profile_admin/manage_product_type');
			}
		}
	}

	public function manage_product_type_edit()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		 $data['main_content'] = 'admin/dashboard';
        $data['admin_dashboard_side_content'] = 'admin/manage_product_type_edit';

        $this->load->view('includes/template',$data);
	}

	public function manage_product_type_editing()
	{
		
		//field name, error message, validation rules
		$this->form_validation->set_rules('thename', 'Type', 'trim|required|is_unique[menu.mname]|xss_clean');
		$this->form_validation->set_message('is_unique', 'Type already exist!');		


		if($this->form_validation->run() == FALSE)
		{
			//validation with errors	
			$this->session->set_flashdata('the_error','Error in updating product type, please try again.');
			redirect('profile_admin/manage_product_type');
		}
		else
		{
			//update without errors
			if($data = $this->profile_admin_model->get_product_type_update())
			{ 
				//update successful
				$this->session->set_flashdata('the_success','Product type successfully updated.');
				redirect('profile_admin/manage_product_type');
			}
			else{
				//profile update not successful
				$this->session->set_flashdata('the_error','Product type could not be updated, please try again.');
				redirect('profile_admin/manage_product_type');
			}
		}
	}

	public function manage_product_subtype()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
		$data['my_side_link'] = getCurrentUrl();
		$data['menu_options'] = $this->filter_model->menu_options();
		$data['admin_dashboard_side_content'] = 'admin/manage_product_subtype';
		$data['main_content'] = 'admin/dashboard';

		$this->load->view('includes/template',$data);
	}

	public function manage_product_subtype_delete()
	{
		$data = $this->profile_admin_model->get_product_subtype_delete();	

		$this->session->set_flashdata('the_success','Product subtype successfully deleted.');
		redirect('profile_admin/manage_product_subtype');
	}

	public function manage_product_subtype_insert()
	{
		//field name, error message, validation rules
		$this->form_validation->set_rules('thename', 'Product Sub Type', 'trim|required|is_unique[submenu.smname]|xss_clean');
		$this->form_validation->set_rules('thetype', 'Product Type', 'trim|required|xss_clean');
		$this->form_validation->set_message('is_unique', 'Product Sub Type already exist!');		


		if($this->form_validation->run() == FALSE)
		{
			//validation with errors	
			$this->session->set_flashdata('the_error','Error in adding product subtype, please try again.');
			redirect('profile_admin/manage_product_subtype');
		}
		else
		{
			//update without errors
			if($data = $this->profile_admin_model->get_product_subtype_insert())
			{ 
				//update successful
				$this->session->set_flashdata('the_success','Product subtype successfully added.');
				redirect('profile_admin/manage_product_subtype');
			}
			else{
				//profile update not successful
				$this->session->set_flashdata('the_error','Product subtype could not be added, please try again.');
				redirect('profile_admin/manage_product_subtype');
			}
		}
	}

	public function manage_product_subtype_edit()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
		$data['menu_options'] = $this->filter_model->menu_options();
        $data['my_side_link'] = getCurrentUrl();
		 $data['main_content'] = 'admin/dashboard';
        $data['admin_dashboard_side_content'] = 'admin/manage_product_subtype_edit';

        $this->load->view('includes/template',$data);
	}

	public function manage_product_subtype_editing()
	{
		
		//field name, error message, validation rules
		$this->form_validation->set_rules('thename', 'Product Sub Type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('thetype', 'Product Type', 'trim|required|xss_clean');
		$this->form_validation->set_message('is_unique', 'Product Sub Type already exist!');	


		if($this->form_validation->run() == FALSE)
		{
			//validation with errors	
			$this->session->set_flashdata('the_error','Error in updating product subtype, please try again.');
			redirect('profile_admin/manage_product_subtype');
		}
		else
		{
			//update without errors
			if($data = $this->profile_admin_model->get_product_subtype_update())
			{ 
				//update successful
				$this->session->set_flashdata('the_success','Product subtype successfully updated.');
				redirect('profile_admin/manage_product_subtype');
			}
			else{
				//profile update not successful
				$this->session->set_flashdata('the_error','Product subtype could not be updated, please try again.');
				redirect('profile_admin/manage_product_subtype');
			}
		}
	}

	public function manage_products()
	{
		$data = $this->profile_admin_model->get_info();
		$data['menu_options'] = $this->filter_model->menu_options();
		$data['submenu_options'] = $this->filter_model->submenu_options();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_product';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function getsubmenu()
    {
        $menuid = $_POST['action'];
		$submenu_options = $this->filter_model->submenu_options2($menuid);
		$the_submenu = array('' => '' );

		if(!empty($submenu_options))
		{
			foreach($submenu_options as $row)
			{
				$the_submenu[$row->thesmid] = $row->smname;
			}
			echo form_dropdown('thesubtype', $the_submenu, set_value('thesubtype'), 'id="thesubtype" class="form-control" required');
 		}else{
    		echo "<select class='form-control' ></select>";
    	}   
    }

	public function product_insert()
	{
		//field name, error message, validation rules
		$this->form_validation->set_rules('thetype', 'Product Type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('thesubtype', 'Product Sub-Type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('prodname', 'Product Name', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('prodquantity', 'Product Quantity', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('prodprice', 'Product Price', 'trim|integer|required|xss_clean');
		//$this->form_validation->set_rules('prodoldprice', 'Product Old Price', 'trim|xss_clean');
		$this->form_validation->set_rules('prodsumm', 'prodsumm', 'trim|required|xss_clean');
		$this->form_validation->set_rules('proddesc', 'proddesc', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			//validation with errors
			$this->session->set_flashdata('the_error','Error in adding product, please try again.');
			redirect('profile_admin/manage_products');
		}else
		{
			$config['upload_path'] = './assets/products/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size']	= '2000';
			$config['max_width']  = '500';
			$config['max_height']  = '500';
		    $config['overwrite']     = FALSE;

			$this->load->library('upload',$config);

			$field_name = 'prodimage';
		
			if (!$this->upload->do_upload($field_name))
			{
				$this->session->set_flashdata('the_error',$this->upload->display_errors());
				redirect('profile_admin/manage_products');
			}else if($this->upload->do_upload($field_name))
			{
				$data = $this->profile_admin_model->get_product_insert();

				$this->session->set_flashdata('the_success','Product successfully added.');
				redirect('profile_admin/manage_products');
			}
		}
	}

	public function product_edit()
	{
		$data = $this->profile_admin_model->get_info();		
		$data['menu_options'] = $this->filter_model->menu_options();
		$data['submenu_options'] = $this->filter_model->submenu_options();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_product_edit';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function product_editing()
	{
		//field name, error message, validation rules
		$this->form_validation->set_rules('thetype', 'Product Type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('thesubtype', 'Product Sub-Type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('prodname', 'Product Name', 'trim|required|xss_clean');
		// $this->form_validation->set_rules('prodquantity', 'Product Quantity', 'trim|required|xss_clean');
		// $this->form_validation->set_rules('prodprice', 'Product Price', 'trim|integer|required|xss_clean');
		// $this->form_validation->set_rules('prodoldprice', 'Product Old Price', 'trim|xss_clean');
		$this->form_validation->set_rules('prodsumm', 'prodsumm', 'trim|required|xss_clean');
		$this->form_validation->set_rules('proddesc', 'proddesc', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			//validation with errors
			$this->session->set_flashdata('the_error','Error in updating product, please try again.');
			redirect('profile_admin/manage_products');
		}else
		{
			if(!empty($_FILES['prodimage']['name']))
			{
				$config['upload_path'] = './assets/products/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size']	= '2000';
				$config['max_width']  = '500';
				$config['max_height']  = '500';
			    $config['overwrite']     = FALSE;

				$this->load->library('upload',$config);

				$field_name = 'prodimage';
			
				if (!$this->upload->do_upload($field_name))
				{
					$this->session->set_flashdata('the_error',$this->upload->display_errors());
					redirect('profile_admin/manage_products');
				}else if($this->upload->do_upload($field_name))
				{
					$data = $this->profile_admin_model->get_product_update();

					$this->session->set_flashdata('the_success','Product successfully updated.');
					redirect('profile_admin/manage_products');
				}	
			}else{
				$data = $this->profile_admin_model->get_product_update();

				$this->session->set_flashdata('the_success','Product successfully updated.');
				redirect('profile_admin/manage_products');
			}			
		}
	}

	public function product_delete()
	{
		$data = $this->profile_admin_model->get_product_delete();	

		$this->session->set_flashdata('the_success','Product successfully deleted.');
		redirect('profile_admin/manage_products');
	}

	public function reviews()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/reviews';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function reviews_delete()
	{
		$data = $this->profile_admin_model->get_reviews_delete();	

		$this->session->set_flashdata('the_success','Review has been successfully deleted.');
		redirect('profile_admin/manage_products');
	}
	

	public function manage_customers()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_customers';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function customers_export()
	{
		$this->load->dbutil();
		$report = $this->profile_admin_model->get_customer_export();
		$delimiter = ",";
	    $newline = "\r\n";
	    $new_report = $this->dbutil->csv_from_result($report, $delimiter, $newline);
		write_file('assets/export/Customers.csv',$new_report);
		$thepath = base_url().'assets/export/Customers.csv';
		$data = file_get_contents($thepath); // Read the file's contents
		$name = 'Customers.csv';

		return force_download($name, $data);
	}

	public function customers_delete()
	{
		$data = $this->profile_admin_model->get_customers_delete();	

		$this->session->set_flashdata('the_success','Customer has been successfully deleted.');
		redirect('profile_admin/manage_customers');
	}

    public function update_shipping_fee(){

        if($this->profile_admin_model->get_shipping_update()){

            $this->session->set_flashdata('the_success','Shipping fee successfully updated');

        }
        else{
            $this->session->set_flashdata('the_error','Shipping fee not updated');
        }
        redirect('profile_admin');
    }

    public function manage_newsletter()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_newsletter';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function newsletter_export()
	{
		$this->load->dbutil();
		$report = $this->profile_admin_model->get_newsletter_export();
		$delimiter = ",";
	    $newline = "\r\n";
	    $new_report = $this->dbutil->csv_from_result($report, $delimiter, $newline);
		write_file('assets/export/Newsletter.csv',$new_report);
		$thepath = base_url().'assets/export/Newsletter.csv';
		$data = file_get_contents($thepath); // Read the file's contents
		$name = 'Newsletter.csv';

		return force_download($name, $data);
	}

	public function newsletter_delete()
	{
		$data = $this->profile_admin_model->get_newsletter_delete();	

		$this->session->set_flashdata('the_success','Customer Subscription for Newsletter has been successfully deleted.');
		redirect('profile_admin/manage_newsletter');
	}

	public function manage_social()
	{
		$data = $this->profile_admin_model->get_info();
		$data['incorrect_login'] = '';	
		$data['reg_success'] = '';
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_social';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	// Manage Social
	public function manage_social_edit()
	{
		$data = $this->profile_admin_model->get_info();
		$data['incorrect_login'] = '';	
		$data['reg_success'] = '';
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_social_edit';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function social_editing()
	{
		$data = $this->profile_admin_model->get_social_edit_update();

		$this->session->set_flashdata('the_success','Social Media Link has been successfully updated.');		
		redirect('profile_admin/manage_social');
	}

	public function manage_about()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_about';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function manage_about_edit()
	{
		$data = $this->profile_admin_model->get_info();
		$data['incorrect_login'] = '';	
		$data['reg_success'] = '';
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_about_edit';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function about_editing()
	{
		if($query = $this->profile_admin_model->get_about_edit_update())
		{
			$this->session->set_flashdata('the_success','Update successful');
			redirect('profile_admin/manage_about');
		}else{
			$this->session->set_flashdata('the_error','Update not successful');
			redirect('profile_admin/manage_about');
		}
	}

	public function manage_slide()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_slide';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	// Manage Slide Show
	public function slide_insert()
	{	
		//field name, error message, validation rules
		$this->form_validation->set_rules('slidenum', 'Slide Number', 'trim|required|integer|is_unique[slide.slide_number]|xss_clean');
		$this->form_validation->set_message('is_unique', 'Slide Number already exist!');		


		if($this->form_validation->run() == FALSE)
		{
			//validation with errors
			$this->session->set_flashdata('the_error','Slide Number already exist!');
			redirect('profile_admin/manage_slide');
		}else{
			$config['upload_path'] = './assets/img/backgrounds/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size']	= '2000';
			$config['max_width']  = '1000';
			$config['max_height']  = '600';

			$this->load->library('upload',$config);

			$field_name = 'slidefile';
			
			if (!$this->upload->do_upload($field_name))
			{
				$this->session->set_flashdata('the_error',$this->upload->display_errors());
				redirect('profile_admin/manage_slide');
			}else{

				$data = $this->profile_admin_model->get_slide_insert();	
				
				$this->session->set_flashdata('the_success','Slide successfully added!');
				redirect('profile_admin/manage_slide');
			}
		}		
	}

	public function slide_edit()
	{
		$data = $this->profile_admin_model->get_info();
		$data['incorrect_login'] = '';	
		$data['reg_success'] = '';
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_slide_edit';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function slide_editing()
	{
		//field name, error message, validation rules
		$this->form_validation->set_rules('slidenum', 'Slide Number', 'trim|required|integer|xss_clean');
		$this->form_validation->set_message('is_unique', 'Slide Number already exist!');		

		if($this->form_validation->run() == FALSE)
		{
			//validation with errors	
			$this->session->set_flashdata('the_error','Slide Number already exist!');
			redirect('profile_admin/manage_slide');
		}else{
			$data = $this->profile_admin_model->get_slide_update();	

			$this->session->set_flashdata('the_success','Slide successfully updated.');
			redirect('profile_admin/manage_slide');
		}		
	}

	public function slide_delete()
	{
		$data = $this->profile_admin_model->get_slide_delete();	
		
		$this->session->set_flashdata('the_success','Slide successfully deleted.');
		redirect('profile_admin/manage_slide');
	}

	public function manage_faq()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_faq';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	// Add FAQ
	public function faq_insert()
	{	
		//field name, error message, validation rules
		$this->form_validation->set_rules('question', 'Question', 'trim|required|xss_clean');
		$this->form_validation->set_rules('answer', 'Answer', 'trim|required|xss_clean');		


		if($this->form_validation->run() == FALSE)
		{
			//validation with errors
			$this->session->set_flashdata('the_error','Error in adding FAQ, try again');
			redirect('profile_admin/manage_faq');
		}else{
			$data = $this->profile_admin_model->get_faq_insert();	
				
			$this->session->set_flashdata('the_success','FAQ successfully added!');
			redirect('profile_admin/manage_faq');
		}		
	}

	public function faq_edit()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_faq_edit';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function faq_editing()
	{
		//field name, error message, validation rules
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');	
		$this->form_validation->set_rules('description', 'Faq', 'trim|required|xss_clean');		

		if($this->form_validation->run() == FALSE)
		{
			//validation with errors
			$this->session->set_flashdata('the_error','Error in editing FAQ, try again.');
			redirect('profile_admin/manage_faq');
		}
		else
		{
			//update without errors
			if($data = $this->profile_admin_model->get_faq_update())
			{ 
				//fabric type update successful
				$this->session->set_flashdata('the_success','FAQ successfully updated.');
				redirect('profile_admin/manage_faq');
			}
			else{
				//profile update not successful	
				$this->session->set_flashdata('the_error','FAQ could not be edited, please try again.');
				redirect('profile_admin/manage_faq');
			}
		}
	}

	public function faq_delete()
	{
		$data = $this->profile_admin_model->get_faq_delete();	
		
		$this->session->set_flashdata('the_success','FAQ successfully deleted.');
		redirect('profile_admin/manage_faq');
	}

	public function manage_privacy()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_privacy';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function privacy_edit()
	{
		$data = $this->profile_admin_model->get_info();
		$data['incorrect_login'] = '';	
		$data['reg_success'] = '';
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
        $data['main_content'] = 'admin/dashboard';
		$data['admin_dashboard_side_content'] = 'admin/manage_privacy_edit';
		$this->load->view('includes/template',$data);
	}

	public function privacy_editing()
	{
		//field name, error message, validation rules
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('description', 'Privacy policy', 'trim|required|xss_clean');		

		if($this->form_validation->run() == FALSE)
		{
			//validation with errors
			$this->session->set_flashdata('the_error','Error in editing privacy policy, try again.');
			redirect('profile_admin/manage_privacy');
		}
		else
		{
			//update without errors
			if($data = $this->profile_admin_model->get_privacy_update())
			{ 
				$this->session->set_flashdata('the_success','Privacy policy successfully updated.');
				redirect('profile_admin/manage_privacy');
			}
			else{
				//profile update not successful
			$this->session->set_flashdata('the_error','Privacy policy could not be edited, try again.');
			redirect('profile_admin/manage_privacy');
			}
		}
	}

	public function manage_terms()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_terms';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function terms_edit()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_terms_edit';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function terms_editing()
	{
		//field name, error message, validation rules
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');		
		$this->form_validation->set_rules('description', 'Terms', 'trim|required|xss_clean');		

		if($this->form_validation->run() == FALSE)
		{
			//validation with errors	
			$this->session->set_flashdata('the_error','Error in editing terms, try again.');
			redirect('profile_admin/manage_terms');
		}
		else
		{
			//update without errors
			if($data = $this->profile_admin_model->get_terms_update())
			{ 
				//fabric type update successful
				$this->session->set_flashdata('the_success','Terms has been successfully updated.');			
				redirect('profile_admin/manage_terms');
			}else{
				//profile update not successful	
			$this->session->set_flashdata('the_error','Terms could not be edited, try again.');
			redirect('profile_admin/manage_terms');
			}
		}
	}

	public function manage_changes()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_changes';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function changes_edit()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_changes_edit';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function changes_editing()
	{
		//field name, error message, validation rules
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('description', 'Changes', 'trim|required|xss_clean');		

		if($this->form_validation->run() == FALSE)
		{
			//validation with errors	
			$this->session->set_flashdata('the_error','Error in editing policy, try again.');
			redirect('profile_admin/manage_changes');
		}
		else
		{
			//update without errors
			if($data = $this->profile_admin_model->get_changes_update())
			{ 
				//fabric type update successful
				redirect('profile_admin/manage_changes');
			}
			else{
				//profile update not successful
				$this->session->set_flashdata('the_error','Error in editing policy, try again.');
				redirect('profile_admin/manage_changes');
			}
		}
	}

	public function manage_contact()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_contact';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function contact_edit()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_contact_edit';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function contact_editing()
	{
		//field name, error message, validation rules
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('description', 'Contact', 'trim|required|xss_clean');		

		if($this->form_validation->run() == FALSE)
		{
			//validation with errors	
			$this->session->set_flashdata('the_error','Error in editing contact, try again');
			redirect('profile_admin/manage_contact');
		}
		else
		{
			//update without errors
			if($data = $this->profile_admin_model->get_contact_update())
			{ 
				//fabric type update successful
				$this->session->set_flashdata('the_success','Contact was successfully updated.');
				redirect('profile_admin/manage_contact');
			}
			else{
				//profile update not successful
				$this->session->set_flashdata('the_error','Contact could not be edited, please try again.');
				redirect('profile_admin/manage_contact');
			}
		}
	}

	public function manage_welcome()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_welcome';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function welcome_edit()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/manage_welcome_edit';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function welcome_editing()
	{
		//field name, error message, validation rules
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');	
		$this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');
		$this->form_validation->set_rules('signature', 'Signature', 'trim|required|xss_clean');	

		if($this->form_validation->run() == FALSE)
		{
			//validation with errors
			$this->session->set_flashdata('the_error','Error in editing welcome message, try again.');
			redirect('profile_admin/manage_welcome');
		}
		else
		{
			//update without errors
			if($data = $this->profile_admin_model->get_welcome_update())
			{ 
				//fabric type update successful
				$this->session->set_flashdata('the_success','Welcome message successfully updated.');
				redirect('profile_admin/manage_welcome');
			}
			else{
				//profile update not successful
				$this->session->set_flashdata('the_error','Welcome message could not be edited, try again.');
				redirect('profile_admin/manage_welcome');
			}
		}
	}

	public function change_password()
	{
		$data = $this->profile_admin_model->get_info();
		$data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
		$data['admin_dashboard_side_content'] = 'admin/change_password';
        $data['main_content'] = 'admin/dashboard';
		$this->load->view('includes/template',$data);
	}

	public function password_change()
	{
		//field name, error message, validation rules
		$this->form_validation->set_rules('old_pass', 'Old Password', 'trim|required|min_length[4]|max_length[32]|xss_clean');	
		$this->form_validation->set_rules('new_pass', 'New Password', 'trim|required|min_length[4]|max_length[32]|xss_clean');
		$this->form_validation->set_rules('confirm_pass', 'Confirm New Password', 'trim|required|min_length[4]|max_length[32]|matches[new_pass]|xss_clean');	

		if($this->form_validation->run() == FALSE)
		{
			//validation with errors
			$this->session->set_flashdata('the_error','Error in changing password, try again.');
			redirect('profile_admin/change_password');
		}
		else
		{
			$old_pass = $this->profile_admin_model->get_old_password();
			$old_pass_post = sha1($this->config->item('salt').$this->input->post('old_pass'));
			//update without errors
			if($old_pass !== $old_pass_post)
			{ 
				$this->session->set_flashdata('the_error','Old password incorrect, try again.');
				redirect('profile_admin/change_password');
			}
			else{
				//update without errors
				if($data = $this->profile_admin_model->get_password_update())
				{ 
					//profile update not successful
					$this->session->set_flashdata('the_success','Password change successful.');
					redirect('profile_admin/change_password');
				}
				else{
					//profile update not successful
					$this->session->set_flashdata('the_error','Error in changing password, try again.');
					redirect('profile_admin/change_password');
				}				
			}
		}
	}

	
    //Get customer Orders
    public function manage_orders()
    {
        $data = $this->profile_admin_model->get_info();
        $data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
        $data['admin_dashboard_side_content'] = 'admin/manage_orders';
        $data['main_content'] = 'admin/dashboard';
        $this->load->view('includes/template',$data);
    }

    public function manage_orders_update()
    {
       $data = $this->profile_admin_model->get_orders_update();

       redirect('profile_admin/manage_orders');
    }

    public function manage_careers()
    {
        $data = $this->profile_admin_model->get_info();
        $data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
        $data['admin_dashboard_side_content'] = 'admin/manage_careers';
        $data['main_content'] = 'admin/dashboard';
        $this->load->view('includes/template',$data);
    }

    public function getViewContent ($side_content)
    {
         $data['my_side_link'] = getCurrentUrl();
         $data['admin_dashboard_side_content'] = 'admin/dashboard';
         $data['admin_dashboard_side_content'] =$side_content;

    }
  // manage careers/vacancy editing
    public function manage_careers_edit()
    {
        $data = $this->profile_admin_model->get_info();
        $data['is_adminlogged_in'] = $this->session->userdata('is_adminlogged_in');
        $data['my_side_link'] = getCurrentUrl();
        $data['admin_dashboard_side_content'] = 'admin/manage_careers_edit';
        $data['main_content'] = 'admin/dashboard';
        $this->load->view('includes/template',$data);
    }

    public function manage_careers_editing()
    {
        //field name, error message, validation rules
        $this->form_validation->set_rules('vacancy_subject', 'Position', 'trim|required|xss_clean');
        $this->form_validation->set_rules('vacancy_body', 'Description', 'trim|required|xss_clean');
        $this->form_validation->set_rules('vacancy_date', 'Closing Date', 'trim|required|xss_clean');

        if($this->form_validation->run() == FALSE)
        {
            //validation with errors
            $this->session->set_flashdata('the_error','Error in editing Vacancy/Careers, try again.');
			redirect('profile_admin/manage_careers');
        }else
        {
        	$this->profile_admin_model->get_careers_update();
            
            $this->session->set_flashdata('the_success','Job Opening successfully updated.');
            redirect('profile_admin/manage_careers');
        }
    }


    public function manage_careers_upload()
    {
        //field name, error message, validation rules
        $this->form_validation->set_rules('vacancy_subject', 'Position', 'trim|required|xss_clean');
        $this->form_validation->set_rules('vacancy_body', 'Description', 'trim|required|xss_clean');
        $this->form_validation->set_rules('vacancy_date', 'Closing Date', 'trim|required|xss_clean');

        if($this->form_validation->run() == FALSE)
        {
            //validation with errors
            $this->session->set_flashdata('the_error','Error in adding Vacancy/Careers, try again.');
			redirect('profile_admin/manage_careers');
        }else
        {
        	$this->profile_admin_model->get_careers_insert();

        	$this->session->set_flashdata('the_success','Job Opening successfully added.');
            redirect('profile_admin/manage_careers');
        }
    }

    public function manage_careers_delete()
    {
       $data = $this->profile_admin_model->get_careers_delete();

        redirect('profile_admin/manage_careers');
    }


	// Check if Admin is logged in
	public function is_adminlogged_in()
	{
		$is_adminlogged_in = $this->session->userdata('is_adminlogged_in');

		if(!isset($is_adminlogged_in) || $is_adminlogged_in != true)
		{
			redirect('gracefoods_admin');
		}
	}

}

/* End of file profile_admin.php */
/* Location: ./application/controllers/profile_admin.php */