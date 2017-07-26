<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validate_model extends CI_Model {
	private $email_code; // has value set within set_session method

	public function __construct()
	{
		parent::__construct();

	}

	public function validate()
	{
		$this->db->where('user_mail', $this->input->post('mymail'));
		$this->db->where('password', sha1($this->config->item('salt').$this->input->post('mypass')));
		$query = $this->db->get('access');
		if($query->num_rows == 1)
		{
			return true;
		}
	}

	public function create_user()
	{
			$ulast = $this->input->post('user_last');
			$ufirst = $this->input->post('user_first');
			$uphone = $this->input->post('user_phone');
			$umail = $this->input->post('user_mail');

			$myid = 'CUST'.rand(1000000,9999999);
			$userpass = sha1($this->config->item('salt').$this->input->post('user_pass'));

			$new_user_access = array(
				'user_mail' => $umail,
				'password' => $userpass,
				'regtime' => date('Y-m-d h:i:s')
			);

			$new_user_details = array(
				'user_mail' => $umail,
				'user_last' => $ulast,
				'user_first' => $ufirst,
				'user_phone' => $uphone,
				'myid' => $myid
			);

			$create['access'] = $this->db->insert('access', $new_user_access);
			$create['details'] = $this->db->insert('regusers', $new_user_details);

			if($this->db->affected_rows() == 1)
			{
				$this->set_session($ufirst,$ulast,$umail);
				$this->send_validation_email();
				return $ufirst;
			}else{
				//notify the admin by emailing the user registration isn't working
				//this should never occur because of the validation we did in the controller
				$this->load->library('email');
				$this->email->set_newline("\r\n");

				$this->email->from($this->config->item('bot_email'), 'Gracefoods');
				$this->email->to($this->config->item('admin_email'));
				$this->email->subject("Problem inserting user into database");

				if(isset($email))
				{
					$this->email->message('Unable to register and insert user with the email of '.$umail.'to the database.');
				}else{
					$this->email->message('Unable to register and insert user to the database.');
				}

				$this->email->send();
				return false;				
			}		
		return $create;
	}

	public function validate_email($email_address, $email_code)
	{
		$sql = "SELECT user_mail, regtime FROM access WHERE user_mail='{$email_address}' LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->row();
		if($result->num_rows() === 1)
		{
			if(md5((string)$row->regtime) === $email_code)
			{
				$result = $this->activate_account($email_address);
				if($result === true)
				{
					//Send New User Message
					$newsql = "SELECT user_first FROM regusers WHERE user_mail='{$email_address}' LIMIT 1";
					$newresult = $this->db->query($newsql);
					$newrow = $newresult->row();					

					$this->load->library('email');
					$email = $email_address;

					$this->email->set_mailtype('html');
					$this->email->set_newline("\r\n");

					$this->email->from($this->config->item('bot_email'), 'Gracefoods');
					$this->email->to($email);
					$this->email->subject('Welcome to Gracefoods');

					$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
								"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html><head>
								<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
								</head><body>';
					$message .= '<p>Dear '.$newrow->user_first.',</p>';
					$message .= $this->welcomemsg();
					$message .= $this->welcomesign();
					$this->email->message($message);
					$this->email->send();

					return true;
				}else{
					// this should never happen
					echo "<p>There was an error when activating your account. Please contact the admin at ".$this->config->item('admin_email')."</p>";
					return false;
				}
			}else{
				// this should never happen
				echo "<p>There was an error validating our email. Please contact the admin at ".$this->config->item('admin_email')."</p>";
			}
		}
	}

	private function set_session($user_first, $user_last, $user_mail)
	{

		//we select regtime too to set the private $email_code varregusers.user
		$sql = "SELECT access.id AS id, regtime FROM access INNER JOIN regusers ON regusers.user_mail = access.user_mail WHERE access.user_mail = '".$user_mail."' LIMIT 1";
		$result = $this->db->query($sql);

		foreach($result->result() as $row){
				$sess_data = array(
				'id' => $row->id,
				'firstname' => $user_first,
				'lastname' => $user_last,
				'email' => $user_mail,
				'logged_in' => 0
				);

			$this->email_code = md5((string)$row->regtime);
			$this->session->set_userdata($sess_data);
		}
	}

	private function send_validation_email()
	{
		$this->load->library('email');
		$email = $this->session->userdata('email');
		$email_code = $this->email_code;

		$this->email->set_mailtype('html');
		$this->email->set_newline("\r\n");

		$this->email->from($this->config->item('bot_email'), 'Gracefoods');
		$this->email->to($email);
		$this->email->subject('Please activate your account at Gracefoods');

		$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
					"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html><head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					</head><body>';
				
		$message .= '<p>Dear '.$this->session->userdata('firstname').',</p>';

		// the link we send will look like  /account/validate_email/john@doe.com/d27c56yubbuyhyuiyy77y76676g
		$message .= '<p>Thanks for registering on Gracefoods. Please <strong><a href="'.base_url().'account/validate_email/'.$email.'/'.$email_code.'">click here</a></strong> to activate your account. After you have activated your account, you will be able to log into Gracefoods.</p><br>';
		$message .= '<p>Thank you!</p>';
		$message .= '<p>The Gracefoods Team</p>';
		$message .= '</body></html>';

		$this->email->message($message);
		$this->email->send();
	}

	private function activate_account($email_address)
	{
		$sql = "UPDATE access SET activated = 1 WHERE user_mail = '".$email_address."' LIMIT 1";
		$this->db->query($sql);
		if($this->db->affected_rows() === 1)
		{
			return true;
		}else{
			// this should never happen
			// echo "Error when activating your account in the database, Please contact the admin at ".$this->config->item('admin_email');
			// return false;
			redirect(base_url());
		}
	}

	private function welcomemsg()
	{
		$sql = "SELECT * FROM welcome_message WHERE id='1'";
		$result = $this->db->query($sql);
		$row = $result->row();

		return ($result->num_rows() === 1 && $row->id) ? $row->message : false;
	}

	private function welcomesign()
	{
		$sql = "SELECT * FROM welcome_message WHERE id='1'";
		$result = $this->db->query($sql);
		$row = $result->row();

		return ($result->num_rows() === 1 && $row->id) ? $row->signature : false;
	}

	public function email_exists($email)
	{
		$sql = "SELECT user_first, user_mail FROM regusers WHERE user_mail = '{$email}' LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->row();

		return ($result->num_rows() === 1 && $row->user_mail) ? $row->user_first : false;
	}

	public function verify_reset_password_code($email, $code)
	{
		$sql = "SELECT user_first, user_mail FROM regusers WHERE user_mail = '{$email}' LIMIT 1";
		$result = $this->db->query($sql);
		$row = $result->row();

		if($result->num_rows() === 1)
		{
			return ($code == md5($this->config->item('salt').$row->user_first)) ? true : false;
		}else{
			return false;
		}
	}

	public function update_password()
	{
		$email = $this->input->post('mymail');
		$password = sha1($this->config->item('salt') . $this->input->post('mypass'));

		$sql = "UPDATE access SET password = '{$password}' WHERE user_mail = '{$email}' LIMIT 1";
		$this->db->query($sql);

		if($this->db->affected_rows() === 1)
		{
			return true;
		}else{
			return false;
		}
	}	

	public function a_validate()
	{
		$this->db->where('admin_username', $this->input->post('myuser'));
		$this->db->where('admin_password', sha1($this->config->item('salt').$this->input->post('mypass')));
		$query = $this->db->get('admin');
		if($query->num_rows == 1)
		{
			return true;
		}
	}
}