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
		return $this->db->select( 'material.*, CONCAT(material.particular, "/", unit, " - ", material_category.particular) as "particular_unit", status.name as status_name' )
		->from( 'material' )
		->join( 'material_category', 'material_category.material_category_id=material.material_category_id', 'left' )
		->join( 'status', 'status.status_id=material.status_id', 'left' )
		->like( 'material.particular', $search )
		->where( 'material.status_id', 1 )
		->order_by('material.material_id', $sort)
		->get()->result();
	}

	public function search_particular_unit( $particular, $unit )
	{
		return $this->db->select( 'material.*, CONCAT(particular, "/", unit) as "particular_unit", status.name as status_name' )
		->from( 'material' )
		->join( 'status', 'status.status_id=material.status_id', 'left' )
		->where( 'material.particular', $particular )
		->where( 'material.unit', $unit )
		->where( 'material.status_id', 1 )
		->get()->result();
	}

	public function list()
	{
		return $this->db->select( 'material.*, material.particular material_particular, material_category.particular material_category_particular, status.name as status_name' )
		->from( 'material' )
		->join( 'material_category', 'material_category.material_category_id=material.material_category_id','left' )
		->join( 'status', 'status.status_id=material.status_id', 'left' )
		->where( 'material.status_id', 1 )
		->get()->result();
	}

	public function list_ss()
	{
		return $this->SSP->table( 'material' )
		->column( 'material.*' )
		->column( 'material.particular', 'material_particular' )
		->column( 'material_category.particular', 'material_category_particular' )
		->column( 'status.name', 'status_name' )
		->join( 'material_category', 'material_category_id', 'material' )
		->join( 'status', 'status_id', 'material' )
		->where( 'material.status_id', 1 ) // active
		->output();
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

	public function create( $particular, $unit, $stock_level, $material_category_id )
	{
		$data = array(
			'particular' 			=> $particular,
			'unit' 					=> $unit,
			'stock_level'			=> $stock_level,
			'material_category_id' 	=> $material_category_id,
			'status_id' 			=> 1 // active
		);

		$this->db->insert( 'material', $data );
		return $this->db->insert_id();
	}

	public function add_stock( $material_id, $no_of_stocks )
	{
		$this->db->set( 'no_of_stocks', 'no_of_stocks+' . $no_of_stocks, false );
		$this->db->where( 'material_id', $material_id );
		$this->db->update( 'material' );
		return $this->db->affected_rows();
	}

	public function update( $material_id, $particular, $unit, $stock_level )
	{
		$data = array(
			'particular' => $particular,
			'unit' 		 => $unit,
			'stock_level'=> $stock_level
		);

		$where = array( 'material_id' => $material_id );

		$this->db->update( 'material', $data, $where );
		return $this->db->affected_rows();
	}
	

	public function delete( $material_id )
	{
		$data  = array( 'status_id' => 2 ); // inactive
		$where = array( 'material_id' => $material_id);

		$this->db->update( 'material', $data, $where );
		return $this->db->affected_rows();
	}
}
