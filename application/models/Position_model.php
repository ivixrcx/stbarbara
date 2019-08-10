<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Position_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function list()
	{
		return $this->db->select( 'user_type.*, status.name as status_name' )
		->select( '(SELECT COUNT(*) FROM user WHERE user.user_type_id = user_type.user_type_id) as no_of_users' )
		->from( 'user_type')
        ->join( 'status', 'status.status_id=user_type.status_id', 'left')
		->where( 'user_type.status_id', 1 ) // active
		->get()->result();
	}

	public function create( $name, $default_user_modules )
	{
		$data = array(
			'name' 		 	        => $name,
            'default_user_modules'  => $default_user_modules,
            'status_id'             => 1, // active
		);

		$this->db->insert( 'user_type', $data );
		return $this->db->affected_rows();
	}

	public function update( $user_type_id, $name )
	{
		$data = array(
			'name' 		  	        => $name,
		);

		$where = array( 'user_type_id' => $user_type_id );

		$this->db->update( 'user_type', $data, $where );
		return $this->db->affected_rows();
	}

	public function delete( $user_type_id )
	{
		$data  = array( 'status_id' => 2 ); // inactive
		$where = array( 'user_type_id' => $user_type_id);

		$this->db->update( 'user_type', $data, $where );
		return $this->db->affected_rows();
	}
	
	public function get_permissions( $user_type_id )
	{
		return $this->db->select( 'user_module_category.user_module_category_id' )
		->select( 'user_module_category.user_module_category_name' )
		->select( 'user_module_category.module_count' )
		->select( 'user_module.user_module_id' )
		->select( 'user_module.user_module_name' )
		->select( 'user_module.user_module_link' )
		->from( array( 'user_type', 'user_module_category' ) )
		->join( 'user_module', 'user_module.user_module_category_id=user_module_category.user_module_category_id', 'left' )
		->where( 'FIND_IN_SET(user_module.user_module_id, user_type.default_user_modules)')
		->where( 'user_type.user_type_id', $user_type_id )
		->group_by( 'user_module_category.user_module_category_name' )
		->group_by( 'user_module_category.user_module_category_id' )
		->group_by( 'user_module.user_module_id' )
		->order_by( 'user_module_category.user_module_category_name' )
		->get()->result();
	}
	
	public function get( $user_type_id )
	{
		return $this->db->select( '*' )
		->from( 'user_type' )
		->where( 'user_type_id', $user_type_id )
		->get()->result();
	}
	

	public function get_users( $user_type_id )
	{
		return $this->db->select( 'user.*, user_type.name as user_type' )
		->from( 'user' )
		->join( 'user_type', 'user_type.user_type_id=user.user_type_id', 'left' )
		->where( 'user.user_type_id', $user_type_id )
		->get()->result();
	}

	public function update_permissions( $user_type_id, $modules )
	{
		$data = array( 'default_user_modules' => $modules );
		$where = array( 'user_type_id' => $user_type_id );

		$this->db->update( 'user_type', $data, $where );
		return $this->db->affected_rows();
	}
}
