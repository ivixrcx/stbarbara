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

		return $list->get()->result();
	}

	public function create( $user_module_name, $user_module_category_id )
	{
		$data = array(
			'user_module_name' 		  	=> $user_module_name,
			'user_module_category_id' 	=> $user_module_category_id,
			'status_id'   	            => 1 // active
		);

		$this->db->insert( 'user_module', $data );
		return $this->db->affected_rows();
	}

	public function update( $user_module_id, $user_module_name, $user_module_category_id )
	{
		$data = array(
			'user_module_name' 		  	=> $user_module_name,
			'user_module_category_id' 	=> $user_module_category_id
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
}
