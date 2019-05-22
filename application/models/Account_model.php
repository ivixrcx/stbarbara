<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

	private $current_user_data;

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function auth_login($user_name, $password)
	{
		$data = $this->db->select('user.*, CONCAT(user.first_name," ",user.last_name)as `full_name`, user_type.name as `user_type`, status.name as `status_name`')
		->from('user')
		->join('user_type', 'user_type.user_type_id = user.user_type_id', 'left')
		->join('status', 'status.status_id = user.status_id', 'left')
		->where( 
			array(
				'user_name' => $user_name,
				'password' 	=> $password
			)
		)
		->limit(1)
		->get()
		->result();

		if(!empty($data)){
			$this->current_user_data = $data[0];			
		}


		return $this->API->emit( $data );
	}

	public function current_user_data()
	{
		return $this->current_user_data;
	}

}
