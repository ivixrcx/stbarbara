<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}

	public function auth_login($user_name, $password)
	{
		return $this->db->select('*')
		->from('user')
		->where( 
			array(
				'user_name' => $user_name,
				'password' => $password
			) 
		)
		->count_all();
	}
}
