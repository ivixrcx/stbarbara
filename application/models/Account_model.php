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

	public function auth_login( $user_name, $password )
	{
		$data = $this->db->select('user.*, CONCAT(user.first_name," ",user.last_name)as `full_name`, user_modules, user_type.name as `user_type`, status.name as `status_name`')
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

	public function get_user( $user_id )
	{
		return $this->db->select( 'user.*, CONCAT(user.first_name," ",user.last_name)as `full_name`, user_modules, user_type.name as `user_type`, status.name as `status_name`' )
		->from( 'user' )
		->join( 'user_type', 'user_type.user_type_id = user.user_type_id', 'left')
		->join( 'status', 'status.status_id = user.status_id', 'left')
		->where( 'user.user_id', $user_id )
		->get()->result()[0];

	}

	public function check_user_name( $user_name )
	{
		$is_taken = $this->db->select('user_name')
		->from('user')
		->where('user_name', $user_name)
		->limit(1)
		->count_all_results();

		return $is_taken ? true : false;
	}

	public function create_user( $first_name, $last_name, $user_name, $password, $user_type_id )
	{
		$data = array(
			'first_name' 	=> $first_name,
			'last_name' 	=> $last_name,
			'user_name' 	=> $user_name,
			'password' 		=> $password,
			'user_type_id' 	=> $user_type_id,
			'status_id' 	=> 1, // active
		);

		$this->db->insert('user', $data);
		return $this->db->affected_rows();
	}

	public function update_user( $user_id, $first_name, $last_name, $user_name, $password, $user_type_id )
	{
		$data = array(
			'first_name' 	=> $first_name,
			'last_name' 	=> $last_name,
			'user_name' 	=> $user_name,
			'password' 		=> $password,
			'user_type_id' 	=> $user_type_id,
		);

		$where = array( 'user_id' => $user_id );

		$this->db->update( 'user', $data, $where );
		return $this->db->affected_rows();
	}

	public function delete_user( $user_id )
	{
		$data  = array( 'status_id' => 2 ); // inactive
		$where = array( 'user_id' => $user_id );
		$this->db->update( 'user', $data, $where );
		return $this->db->affected_rows();
	}

	public function update_password( $user_id, $password )
	{	
		$data  = array( 'password' => md5(base64_encode($password)) );
		$where = array( 'user_id' => $user_id );
		$this->db->update( 'user', $data, $where );
		return $this->db->affected_rows();
	}

	public function activate_user($user_id)
	{
		$data  = array( 'status_id' => 3 ); // activated
		$where = array( 'user_id' => $user_id );
		$this->db->update('user', $data, $where);
		return $this->db->affected_rows();
	}

	public function deactivate_user($user_id)
	{
		$data  = array( 'status_id' => 4 ); // deactivated
		$where = array( 'user_id' => $user_id );
		$this->db->update( 'user', $data, $where );
		return $this->db->affected_rows();
	}

	public function list_of_user_types()
	{
		return $this->db->select( 'user_type_id, name' )
		->from( 'user_type' )
		->get()->result();
	}

	public function list_of_users( $user_type_id, $status_id, $sort="asc" )
	{
		return $this->db->select( 'user.*, user_type.name as uname' )
		->from( 'user' )
		->join( 'user_type', 'user_type_id', 'user' )
		->where( 'user_type_id', $user_type_id )
		->where( 'status_id', $status_id )
		->get()->result();
	}
	
}
