<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materialcategory_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
    }    

	public function list( $sort="asc" )
	{
		return $this->db->select( 'material_category.*, status.name as status_name' )
		->from( 'material_category' )
		->join( 'status', 'status.status_id=material_category.status_id', 'left' )
        ->where( 'material_category.status_id', 1 )
        ->order_by( 'material_category.particular', $sort )
		->get()->result();
	}

	public function search_particular_unit( $particular )
	{
		return $this->db->select( 'material_category.*, status.name as status_name' )
		->from( 'material_category' )
		->join( 'status', 'status.status_id=material_category.status_id', 'left' )
		->where( 'material_category.particular', $particular )
		->where( 'material_category.status_id', 1 )
		->get()->result();
	}

	public function get( $material_category_id )
	{
		return $this->db->select( 'material_category.*, status.name as status_name' )
		->from( 'material_category' )
		->join( 'status', 'status.status_id=material_category.status_id', 'left' )
		->where( 'material_category.material_category_id', $material_category_id )
        ->where( 'material_category.status_id', 1 )
        ->limit( 1 )
		->get()->result();
	}

	public function create( $particular, $priority_level )
	{
		$data = array(
			'particular' 	 => $particular,
			'priority_level' => $priority_level,
			'status_id' 	 => 1 // active
		);

		$this->db->insert( 'material_category', $data );
		return $this->db->insert_id();
	}

	public function update( $material_category_id, $particular, $priority_level )
	{
		$data = array(
			'particular'     => $particular,
			'priority_level' => $priority_level
		);

		$where = array( 'material_category_id' => $material_category_id );

		$this->db->update( 'material_category', $data, $where );
		return $this->db->affected_rows();
	}
	

	public function delete( $material_category_id )
	{
		$data  = array( 'status_id' => 2 ); // inactive
		$where = array( 'material_category_id' => $material_category_id);

		$this->db->update( 'material_category', $data, $where );
		return $this->db->affected_rows();
	}
}
