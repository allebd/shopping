<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

	}

	public function get_info()
	{
		$data['title'] = 'Admin | Gracefoods';

		$data['page'] = '';
		$data['query'] = $this->db->get('admin');

		return $data;
	}


} 
