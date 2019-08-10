<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermodule_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function list( $user_module_category_id, $status_id="1" )
	{
		$list = $this->db->select( 'user_module.*, user_module_category.*, status.name as status_name' )
		->from( 'user_module')
		->join( 'user_module_category', 'user_module_category.user_module_category_id=user_module.user_module_category_id', 'left' )
		->join( 'status', 'status.status_id=user_module.status_id', 'left' )
		->where( 'user_module_category.user_module_category_id', $user_module_category_id );

		if(!empty($status_id)){
			$list->where( 'user_module.status_id', $status_id );
		}
		
		// $list->group_by( array( 'user_module_category.user_module_category_name', 'user_module.user_module_id' ) );
		
		$list->order_by( 'user_module.user_module_name', 'ASC' );

		return $list->get()->result();
	}

	public function get_user_permissions($modules)
	{
		return $this->db->select( 'user_module.user_module_link' )
		->from( 'user_module' )
		->where_in( 'user_module.user_module_id', $modules )
		->get()->result();
	}

	public function create( $user_module_name, $user_module_link, $user_module_description, $user_module_category_id )
	{
		$data = array(
			'user_module_name' 		  	=> $user_module_name,
			'user_module_link' 		  	=> $user_module_link,
			'user_module_description' 	=> $user_module_description,
			'user_module_category_id' 	=> $user_module_category_id,
			'status_id'   	            => 1 // active
		);

		$this->db->insert( 'user_module', $data );
		return $this->db->affected_rows();
	}

	public function update( $user_module_id, $user_module_name, $user_module_link, $user_module_description )
	{
		$data = array(
			'user_module_name' 		  	=> $user_module_name,
			'user_module_link' 			=> $user_module_link,
			'user_module_description' 	=> $user_module_description
		);

		$where = array( 'user_module_id' => $user_module_id );

		$this->db->update( 'user_module', $data, $where );
		return $this->db->affected_rows();
	}

	public function delete( $user_module_id )
	{
		$data  = array( 'status_id' => 2 ); // inactive
		$where = array( 'user_module_id' => $user_module_id);

		$this->db->update( 'user_module', $data, $where );
		return $this->db->affected_rows();
	}

	public function get_user_modules( $user_id="" )
	{
		$usermodule = $this->db->select( 'user_module_category.user_module_category_id' )
		->select( 'user_module_category.user_module_category_name' )
		->select( 'user_module_category.module_count' )
		->select( 'user_module.user_module_id' )
		->select( 'user_module.user_module_name' )
		->select( 'user_module.user_module_link' )
		->from( array( 'user', 'user_module_category' ) )
		->join( 'user_module', 'user_module.user_module_category_id=user_module_category.user_module_category_id', 'left' )
		->where( 'user_module.user_module_id !=', '' );
		
		if( !empty($user_id) ){
			$usermodule->where( 'FIND_IN_SET(user_module.user_module_id, user.user_modules)');
			$usermodule->where( 'user.user_id', $user_id );
		}

		return $usermodule->group_by( 'user_module_category.user_module_category_name' )
		->group_by( 'user_module_category.user_module_category_id' )
		->group_by( 'user_module.user_module_id' )
		->order_by( 'user_module_category.user_module_category_name' )
		// ->get_compiled_select();
		->get()->result();
		
	}

	public function assign_user_modules( $user_id, $user_modules )
	{
		$data = array( 'user_modules' => $user_modules );
		$where = array( 'user_id' => $user_id );

		$this->db->update( 'user', $data, $where );
		return $this->db->affected_rows();
	}

	public function get( $user_module_id )
	{
		return $this->db->select( '*' )
		->from( 'user_module' )
		->where( 'user_module_id', $user_module_id )
		->get()->result();
	}
}
