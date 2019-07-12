<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function search( $search, $sort="asc" )
	{
		return $this->db->select( 'material.*, status.name as status_name' )
		->from( 'material' )
		->join( 'status', 'status.status_id=material.status_id', 'left' )
		->like( 'material.particular', $search )
		->where( 'material.status_id', 1 )
		->get()->result();
	}

	public function list()
	{
		return $this->db->select( 'material.*, status.name as status_name' )
		->from( 'material' )
		->join( 'status', 'status.status_id=material.status_id', 'left' )
		->where( 'material.status_id', 1 )
		->get()->result();
	}

	public function get( $material_id )
	{
		return $this->db->select( 'material.*, status.name as status_name' )
		->from( 'material' )
		->join( 'status', 'status.status_id=material.status_id', 'left' )
		->where( 'material.material_id', $material_id )
		->where( 'material.status_id', 1 )
		->get()->result();
	}

	public function create( $particular, $unit , $material_category_id )
	{
		$data = array(
			'particular' 			=> $particular,
			'unit' 					=> $unit,
			'material_category_id' 	=> $material_category_id,
			'status_id' 			=> 1 // active
		);

		$this->db->insert( 'material', $data );
		return $this->db->insert_id();
	}

	public function delete( $material_id )
	{
		$data  = array( 'status_id' => 2 ); // inactive
		$where = array( 'material_id' => $material_id);

		$this->db->update( 'material', $data, $where );
		return $this->db->affected_rows();
	}
}
