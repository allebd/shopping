<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
		$this->is_logged_in();     //checks if user is logged in
		$this->load->model('filter_model');
		$this->load->model('profile_model');
	}

	public function index()
	{
        if(isset($_POST['profilesubmit']))
		{
			$this->form_validation->set_rules('user_last', 'Last Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('user_first', 'First Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('user_phone', 'Phone', 'trim|required|integer|xss_clean');

			if($this->form_validation->run() == FALSE)
			{
					//validation with errors
					$data = $this->profile_model->get_info();
					$data['is_logged_in'] = $this->session->userdata('is_logged_in');
					$data['my_side_link'] = getCurrentUrl();
                    $data['dashboard_side_content'] = 'profile/index';
					$data['main_content'] = 'profile/menu';

					$this->load->view('includes/template', $data);
			}
			else
			{	
				//update without errors
				if($query = $this->profile_model->update_user())
				{
                    //profile update successful
					$this->session->set_flashdata('the_success','Profile has been successfully updated.');
					redirect('profile');
				}
				else{
					//profile update not successful
					$this->session->set_flashdata('the_error','Profile update not successful.');
					redirect('profile');
				}
			}
		}
        else{
                $data = $this->profile_model->get_info();
                $data['is_logged_in'] = $this->session->userdata('is_logged_in');
                $data['my_side_link'] = getCurrentUrl();
                $data['dashboard_side_content'] = 'profile/index';
				$data['main_content'] = 'profile/menu';

                $this->load->view('includes/template', $data);
		}
	}

	public function address()
	{
		$data = $this->profile_model->get_info();
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$data['country_options'] = $this->filter_model->country_options();
		$data['state_options'] = $this->filter_model->state_options2();
		$data['my_side_link'] = getCurrentUrl();
        $data['dashboard_side_content'] = 'profile/address';
		$data['main_content'] = 'profile/menu';

        $this->load->view('includes/template', $data);
	}

	public function addaddress()
	{
		if(isset($_POST['addingaddress']))
		{
			//field name, error message, validation rules

			$this->form_validation->set_rules('countryadd', 'Country', 'trim|required|xss_clean');
			$this->form_validation->set_rules('theaddress', 'Address', 'trim|required|xss_clean');

			if ($this->form_validation->run() == FALSE)
			{
					//validation with errors
					$this->session->set_flashdata('the_error','Address could not be added, Try again.');
					redirect('profile/address');
			}
			else
			{	
				//insert without errors
				if($query = $this->profile_model->insert_user_add())
				{ 
					$this->session->set_flashdata('the_success','Address has been successfully added.');
					redirect("profile/address");
				}
				else{
					//address insertion not successful
					$this->session->set_flashdata('the_error','Address could not be added, Try again.');
					redirect('profile/address');
				}
			}
		}else{
			redirect('profile/address');
		}
	}

	public function editaddress()
	{
		if(isset($_POST['editingaddress']))
		{
			//field name, error message, validation rules

			$this->form_validation->set_rules('countryadd', 'Country', 'trim|required|xss_clean');
			$this->form_validation->set_rules('theaddress', 'Address', 'trim|required|xss_clean');

			if ($this->form_validation->run() == FALSE)
			{
					//validation with errors
					$this->session->set_flashdata('the_error','Address could not be saved, Try again.');
					redirect('profile/address');
			}
			else
			{	
				//update without errors
				if($query = $this->profile_model->update_user_add())
				{ 
					$this->session->set_flashdata('the_success','Address has been successfully updated.');
					redirect("profile/address");
				}
				else{
					//address updating not successful
					$this->session->set_flashdata('the_error','Address could not be saved, Try again.');
					redirect('profile/address');
				}
			}
		}else{
			redirect('profile/address');
		}
	}

	public function deleteadd()
	{
		//Deleting address
		if($query = $this->profile_model->delete_user_add())
		{ 
			redirect("profile/address");
		}
		else{
			//address deleting not successful
			$this->session->set_flashdata('the_error','Address could not be deleted, Try again.');
			redirect('profile/address');
		}
	}

	public function getstate()
    {
        $country_id = $_POST['action'];
		$state_options = $this->filter_model->state_options($country_id);
		$the_states = array('' => '' );

		if(!empty($state_options))
		{
			foreach($state_options as $row)
			{
				$the_states[$row->state_id] = $row->state_name;
			}
			echo form_dropdown('stateadd', $the_states, set_value('stateadd'), 'id="stateadd" class="form-control"');
 		}else{
    		echo "<select class='form-control' ></select>";
    	}   
    }

    public function addedit()
    {
        $addid = $_POST['action'];
        $add_edit = $this->profile_model->add_edit($addid);
        $country_options = $this->filter_model->country_options();
		$state_options = $this->filter_model->state_options2();

		$the_add = array('' => '' );

		if(!empty($add_edit))
		{
			$theeditadd = '';
			foreach($add_edit as $editrow)
			{
				$theeditadd .= "<script>
									$(document).ready(function(){
									var base_url = '".base_url()."';
									$('#countryadd2').on('change', function(){
									        $.ajax({
									            type:'POST',
									            url: base_url+'profile/getstate',
									            data:{action:$('#countryadd2').val()},
									            success:function(data){
									            $('#thestateadd2').html(data);
									            }
									        });
									    });
									});
								</script>";
				$theeditadd .= form_open('profile/editaddress');
				$theeditadd .= "<input type='hidden' name='theid' value='$editrow->id'>";
				$theeditadd .= "<div class='form-group'>
					                <label>Country</label>";
				$theeditadd .=      form_dropdown('countryadd', $country_options, set_value('countryadd',$editrow->countryid), 'id="countryadd2" class="form-control" required="required"');
				$theeditadd .= "</div>
								<div class='form-group'>
					                <label>State</label>
					                <div id='thestateadd2'>";
				$theeditadd .=      form_dropdown('stateadd', $state_options, set_value('stateadd',$editrow->state_id), 'id="stateadd" class="form-control"');
				$theeditadd .=      "</div>
					            </div>
					            <div class='form-group'>
					                <label>Address</label> 
					                <textarea class='form-control' name='theaddress' rows='4' required='required' value='$editrow->address'>$editrow->address</textarea>
					            </div>
					            <input type='submit' class='btn btn-primary' name='editingaddress' value='Save Changes' />";
				$theeditadd .=  form_close();
				$theeditadd .=  "<button title='Close (Esc)' type='button' class='mfp-close'>×</button>";
			}
			echo $theeditadd;
 		}else{
    		echo "Address not found.";
    	}   
    }

    public function updateprimaryadd()
    {
        $primaryadd = $_POST['action'];
		$primary_update = $this->profile_model->primaryadd_update($primaryadd);
    }

	public function orders()
	{
		$data = $this->profile_model->get_info();
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');				
		$data['my_side_link'] = getCurrentUrl();
        $data['dashboard_side_content'] = 'profile/orders';
		$data['main_content'] = 'profile/menu';

		$this->load->view('includes/template', $data);
	}

	public function myorders()
	{		
		$this->session->set_flashdata('the_success','Transaction Successful.');
		redirect("profile/orders");	
	}

	public function recordpayment()
	{
		$this->profile_model->get_paid();
		redirect("profile/myorders");
	}

	public function recordbankpayment()
	{
		$this->profile_model->get_paid();
		$this->session->set_flashdata('the_success','Order received, we are currently awaiting your bank payment.');
		redirect("profile/orders");
	}

	public function recorddeliverypayment()
	{
		$this->profile_model->get_paid();
		$this->session->set_flashdata('the_success','Order received, your order would be delivered within the next 24hrs.');
		redirect("profile/orders");
	}

	public function wishlist()
	{
		$data = $this->profile_model->get_info();
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$data['my_side_link'] = getCurrentUrl();
        $data['dashboard_side_content'] = 'profile/wishlist';
		$data['main_content'] = 'profile/menu';

		$this->load->view('includes/template', $data);
	}

	public function cart_add()
	{
		$data = $this->profile_model->get_cart_add();	

		redirect('profile/cart');
	}

	public function wish_add()
	{
		$data = $this->profile_model->get_wish_add();	

		$this->session->set_flashdata('the_success','Product successfully added to wishlist.');
		redirect('profile/wishlist');
	}

	public function wish_delete()
	{
		$data = $this->profile_model->get_wish_delete();	

		$this->session->set_flashdata('the_success','Product successfully removed from wishlist.');
		redirect('profile/wishlist');
	}

	public function cart()
	{
		$data = $this->profile_model->get_info();
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$data['main_content'] = 'profile/cart';

		$this->load->view('includes/template', $data);
	}

	public function cart_update()
	{
		$data = $this->profile_model->get_cart_update();

		$this->session->set_flashdata('the_success','Cart successfully updated.');
		redirect('profile/cart');
	}

	public function cart_delete()
	{
		$data = $this->profile_model->get_cart_delete();

		$this->session->set_flashdata('the_success','Product successfully removed from cart.');
		redirect('profile/cart');
	}

	public function check_out()
	{	
		$this->session->set_flashdata('the_success','Payment not Successful, Transaction ended, Kindly Try Again.');
		redirect('profile/checkout');
	}

	public function checkout()
	{
		$data = $this->profile_model->get_info();
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$data['main_content'] = 'profile/checkout';

		$this->load->view('includes/template', $data);
	}

	public function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			redirect(base_url());
		}
	}
}

/* End of file profile.php */
/* Location: ./application/controllers/profile.php */