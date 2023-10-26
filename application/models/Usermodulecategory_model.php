<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermodulecategory_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function lists( $user_module_category_id="", $status_id="1")
	{
		$list = $this->db->select( 'user_module_category.*, status.name as status_name' )
		->from( 'user_module_category')
        ->join( 'status', 'status.status_id=user_module_category.status_id', 'left' );

		if(!empty($user_module_category_id)){
			$list->where( 'user_module_category.user_module_category_id', $user_module_category_id );
        }

		if(!empty($status_id)){
			$list->where( 'user_module_category.status_id', $status_id );
        }

        $list->order_by( 'user_module_category_name', 'ASC' );

		return $list->get()->result();
	}

	public function create( $user_module_category_name )
	{
		$data = array(
			'user_module_category_name' => $user_module_category_name,
			'status_id'   	            => 1 // active
		);

		$this->db->insert( 'user_module_category', $data );
		return $this->db->affected_rows();
	}

	public function update( $user_module_category_id, $user_module_category_name )
	{
		$data = array(
			'user_module_category_name' => $user_module_category_name,
		);

		$where = array( 'user_module_category_id' => $user_module_category_id );

		$this->db->update( 'user_module_category', $data, $where );
		return $this->db->affected_rows();
	}

	public function delete( $user_module_category_id )
	{
		$data  = array( 'status_id' => 2 ); // inactive
		$where = array( 'user_module_category_id' => $user_module_category_id);

		$this->db->update( 'user_module_category', $data, $where );
		return $this->db->affected_rows();
	}

	public function update_module_count( $user_module_category_id )
	{

		$module_count = $this->db->select( 'COUNT(user_module.user_module_id) as count' )
		->from( 'user_module_category' )
		->join( 'user_module', 'user_module.user_module_category_id=user_module_category.user_module_category_id', 'left' )
		->where( 'user_module_category.user_module_category_id', $user_module_category_id )
		->get()->result()[0]->count;

		$data = array(
			'module_count' => $module_count,
		);

		$where = array( 'user_module_category_id' => $user_module_category_id );

		$this->db->update( 'user_module_category', $data, $where );
		return $this->db->affected_rows();
	}

	public function get( $user_module_category_id )
	{
		return $this->db->select( '*' )
		->from( 'user_module_category' )
		->where( 'user_module_category_id', $user_module_category_id ) 
		->get()->result();
	}
}
