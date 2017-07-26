<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('home_model');
		$this->load->model('validate_model');
	}

	public function index()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if(isset($is_logged_in) && $is_logged_in == true)
		{			
			redirect('profile');
		}else{			
			redirect('account/login');
		}	
	}

	public function register()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if(isset($is_logged_in) && $is_logged_in == true)
		{			
			redirect('profile');
		}else{			
			$data = $this->home_model->get_info();	
			$data['query'] = '';	
			$data['is_logged_in'] = '';
			$data['main_content'] = 'home/register';
					
			$this->load->view('includes/template', $data);
		}				
	}

	public function login()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if(isset($is_logged_in) && $is_logged_in == true)
		{
			redirect('profile');			
		}else{			
			$data = $this->home_model->get_info();	
			$data['query'] = '';	
			$data['is_logged_in'] = '';	
			$data['main_content'] = 'home/login';

			$this->load->view('includes/template', $data);			
		}					
	}

	public function registration()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if(isset($is_logged_in) && $is_logged_in == true)
		{
			redirect('profile');			
		}else{			
			//field name, error message, validation rules
			$this->form_validation->set_rules('user_last', 'Last Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('user_first', 'First Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('user_phone', 'Phone', 'trim|required|integer|xss_clean');
			$this->form_validation->set_rules('user_mail', 'Email Address', 'trim|required|valid_email|is_unique[regusers.user_mail]|xss_clean');
			$this->form_validation->set_rules('user_pass', 'Password', 'trim|required|min_length[4]|max_length[32]|xss_clean');
			$this->form_validation->set_rules('user_passconfirm', 'Password Confirmation', 'trim|required|matches[user_pass]|xss_clean');
			$this->form_validation->set_message('is_unique', 'Already in use!');		

			if ($this->form_validation->run() == FALSE)
			{
					//validation with errors
					$this->session->set_flashdata('the_error','Error in filling form, kindly fill again');
					redirect('account/register');
					// $data = $this->home_model->get_info();	
					// $data['query'] = '';	
					// $data['is_logged_in'] = '';
					// $data['main_content'] = 'home/register';
					// $this->load->view('includes/template', $data);
			}
			else
			{	
				//validation without errors
				if($query = $this->validate_model->create_user())
				{ 
					//registration successful
					$this->session->set_flashdata('the_success','Registration successful, Click on the link sent to your mail to activate your account');
					redirect('account/login');
				}
				else{
					//registration not successful
					$this->session->set_flashdata('the_error','Registration not successful');
					redirect('account/register');
				}
			}			
		}		
		
	}
	
	public function validate_email($email_address, $email_code)
	{
		$email_code = trim($email_code);

		$validated = $this->validate_model->validate_email($email_address, $email_code);

		if($validated == true)
		{
			$this->session->set_flashdata('the_success',"Your email address ".$email_address.", has been activated. You may now login to the site.");
			redirect('account/login');
		}else{
			// this should never happen
			$this->session->set_flashdata('the_error',"Error giving email activated confirmation, please contact ".$this->config->item('admin_email'));
			redirect('account/login');
		}
	}

	public function incorrect()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if(isset($is_logged_in) && $is_logged_in == true)
		{			
			redirect('profile');
		}else{			
			//Incorrect login details
			$this->session->set_flashdata('the_error','Invalid Username or Password');
			redirect('account/login');
		}				
	}

	public function not_activated()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if(isset($is_logged_in) && $is_logged_in == true)
		{			
			redirect('profile');			
		}else{	
			//Account not activated
			$this->session->set_flashdata('the_error','Activate your account with the link sent to your mail.');
			redirect('account/login');
		}			
	}

	public function forgot_password()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if(isset($is_logged_in) && $is_logged_in == true)
		{			
			redirect('profile');
		}else{
			$data = $this->home_model->get_info();	
			$data['incorrect_login'] = '';
			$data['reg_success'] = '';
			$data['query'] = '';	
			$data['is_logged_in'] = '';
			$data['main_content'] = 'home/reset_password';

			$this->load->view('includes/template', $data);	
		}
	}

	public function reset_password()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if(isset($is_logged_in) && $is_logged_in == true)
		{			
			redirect('profile');
		}else{
			if(isset($_POST['mymail']) && !empty($_POST['mymail']))
			{
				// first check if its a valid email or not
				$this->form_validation->set_rules('mymail', 'Email Address', 'trim|required|valid_email|xss_clean');

				if($this->form_validation->run() == FALSE)
				{
					//email didn't validate, send back to reset password form and show errors
					//this will likely never occur due to front end validation done on type="email"
					$this->session->set_flashdata('the_error','Please supply a valid email address.');
					redirect('account/forgot_password');
				}else{
					$email = trim($this->input->post('mymail'));
					$result = $this->validate_model->email_exists($email);

					if($result)
					{
						// If we found the email, $result is now their first name
						$this->send_reset_password_email($email, $result);
						
						$this->session->set_flashdata('the_success','A link to reset your password has been sent to '.$email);
						redirect('account/forgot_password');
					}else{
						$this->session->set_flashdata('the_error','Email address not registered with Gracefoods');
						redirect('account/forgot_password');
					}
				}
			}else{
				//Forgot login details
				redirect('account/forgot_password');
			}	
		}	
	}

	public function reset_password_form($email, $email_code)
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if(isset($is_logged_in) && $is_logged_in == true)
		{			
			redirect('profile');
		}else{
			if(isset($email, $email_code))
			{
				$email = trim($email);
				$email_hash = sha1($email . $email_code);
				$verified = $this->validate_model->verify_reset_password_code($email, $email_code);

				if($verified)
				{
					$data = $this->home_model->get_info();
					$data['query'] = '';	
					$data['is_logged_in'] = '';
					$data['email_hash'] = $email_hash;
					$data['email_code'] = $email_code;
					$data['email'] = $email;
					$data['main_content'] = 'home/update_password';
					
					$this->load->view('includes/template', $data);
				}else{
					$this->session->set_flashdata('the_error','There was a problem with your link. Please click it again or request to reset your password again.');
					redirect('account/forgot_password');
				}
			}
		}
	}

	public function update_password()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if(isset($is_logged_in) && $is_logged_in == true)
		{			
			redirect('profile');
		}else{
			if(!isset($_POST['mymail'], $_POST['email_hash']) || $_POST['email_hash'] !== sha1($_POST['mymail'].$_POST['email_code']))
			{
				// Either a hacker or they changed their email in the email field, just die.
				$this->session->set_flashdata('the_error','Error updating your password.');
				redirect('account/forgot_password');
			}

			$this->form_validation->set_rules('email_hash', 'Email hash', 'trim|required');
			$this->form_validation->set_rules('mymail', 'Email Address', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('mypass', 'Password', 'trim|required|min_length[4]|max_length[32]|xss_clean');
			$this->form_validation->set_rules('user_passconfirm', 'Password Confirmation', 'trim|required|matches[mypass]|xss_clean');

			if($this->form_validation->run() == FALSE)
			{
				// user didn't validate, send back to update password form and show errors
				$this->session->set_flashdata('the_error','Error updating your password, Try again');
				redirect('account/forgot_password');	
			}else{
				//successful update
				// return users first name if successful
				$result = $this->validate_model->update_password();

				if($result)
				{
					$this->session->set_flashdata('the_success','Your password has been updated! You may now login to the site.');
					redirect('account/login');
				}else{
					// this should never happen
					$this->session->set_flashdata('the_error','Problem updating your password. Please contact '.$this->config->item('admin_email'));
					redirect('account/login');
				}
			}
		}
	}	

	public function send_reset_password_email($email, $firstname)
	{
		$this->load->library('email');
		$email_code = md5($this->config->item("salt").$firstname);

		$this->email->set_mailtype('html');		
		$this->email->set_newline("\r\n");

		$this->email->from($this->config->item('bot_email'), 'Gracefoods');
		$this->email->to($email);
		$this->email->subject("Please reset your password at Gracefoods");

		$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
					"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html><head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					</head><body>';
		$message .= '<p>Dear '.$firstname.',</p>';
		// the link we send will look like  /account/reset_password_form/john@doe.com/d27c56yubbuyhyuiyy77y76676g
		$message .= '<p>We want to help you reset your password! Please <strong><a href="'.base_url().'account/reset_password_form/'.$email.'/'.$email_code.'">click here</a></strong> to reset your password.</p><br>';
		$message .= '<p>Thank you!</p>';
		$message .= '<p>The Gracefoods Team</p>';
		$message .= '</body></html>';

		$this->email->message($message);
		$this->email->send();
	}

	public function validate_credentials()
	{
		$query = $this->validate_model->validate();
		if($query) // if user's credentials validated...
		{
			$this->db->select('regusers.user_first AS user_first,access.user_mail AS user_mail,regusers.id, activated, myid');
			$this->db->from('access');
			$this->db->where('access.user_mail', $this->input->post('mymail'));
			$this->db->join('regusers', 'regusers.user_mail = access.user_mail');
			$theusername = $this->db->get();
			foreach($theusername->result() as $from){
			$actstatus = $from->activated;

				if($actstatus == 1)
				{
					$this->load->helper('string');
					$cartId = random_string('alpha', 2) . "" . random_string('numeric', 10);
					$cartObj = array(
						'cart_id' => $cartId,
					);
					$data = array(
						'username' => $from->user_mail,
						'cart_items' => $cartObj,
						'is_logged_in' => true
					);

					$this->session->set_userdata($data);
					$this->session->set_userdata('current_reg_id',$from->myid);
					$this->session->set_userdata('current_user_first',$from->user_first);
					$this->session->set_userdata('current_user_mail',$from->user_mail);
                    redirect(base_url());
				}
                else {
					redirect('account/not_activated');
				}				
			}		
		}
		else
		{
			redirect('account/incorrect');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();

		//Logging out 
		$data = $this->home_model->get_info();	
		$data['query'] = '';	
		$data['is_logged_in'] = '';	
		$data['reg_success'] = 'You have been successfully logged out.';
		$data['main_content'] = 'home/login';

		$this->load->view('includes/template', $data);
	}

}

/* End of file account.php */
/* Location: ./application/controllers/account.php */