<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// This filter is used by select statements

class Filter_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

	}

	public function country_options()
	{
		$rows = $this->db->select('country,countryid')
				->from('countries')
				->order_by("country", "asc")
				->get()->result();

		$country_options = array('' => '' );
		foreach ($rows as $row) {
					$country_options[$row->countryid] = $row->country;
				}

		return $country_options;
	}

	public function state_options2()
	{
		$rows = $this->db->select('state_name,state_id')
				->from('states')
				->get()->result();

		$state_options = array('' => '' );
		foreach ($rows as $row) {
					$state_options[$row->state_id] = $row->state_name;
				}

		return $state_options;
	}

	public function state_options($country_id="")
	{	
		$data = array();
		$this->db->select('state_name,state_id');		
		$this->db->from('states');
		$this->db->where('countrycode', $country_id);
		$this->db->order_by("state_name", "asc");
		$state_options = $this->db->get();

		if($state_options->num_rows > 0) 
		{
            $data = $state_options->result();
        }
        return $data;
	}

	public function menu_options()
	{
		$rows = $this->db->select('mname,themid')
				->from('menu')
				->order_by("mname", "asc")
				->get()->result();

		$menu_options = array('' => '' );
		foreach ($rows as $row) {
					$menu_options[$row->themid] = $row->mname;
				}

		return $menu_options;
	}

	public function submenu_options()
	{
		$rows = $this->db->select('smname,thesmid')
				->from('submenu')
				->order_by("smname", "asc")
				->get()->result();

		$submenu_options = array('' => '' );
		foreach ($rows as $row) {
					$submenu_options[$row->thesmid] = $row->smname;
				}

		return $submenu_options;
	}

	public function submenu_options2($menuid="")
	{	
		$data = array();
		$this->db->select('smname,thesmid');		
		$this->db->from('submenu');
		$this->db->where('menuid', $menuid);
		$this->db->order_by("smname", "asc");
		$submenu_options = $this->db->get();

		if($submenu_options->num_rows > 0) 
		{
            $data = $submenu_options->result();
        }
        return $data;
	}

	public function quant_options($quant_id="")
	{
		$rows = $this->db->select('quant_price')
				->from('quantities')
				->where('quant_id', $quant_id)
				->get()->result();

		foreach($rows as $row){
			$quant_options = $row->quant_price;
		}

		return $quant_options;
	}
}