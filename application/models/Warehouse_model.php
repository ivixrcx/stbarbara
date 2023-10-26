<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function lists( $status_id=1 )
	{
		return $this->db->select( 'warehouse.*, status.name as status_name' )
		->from( 'warehouse' )
		->join( 'status', 'status.status_id=warehouse.status_id', 'left' )
		->where( 'warehouse.status_id', $status_id )
		->get()->result();
	}

	public function list_ss()
	{
		return $this->SSP->table( 'warehouse' )
		->column( 'warehouse.warehouse_id' ) 
		->column( 'warehouse.name' ) 
		->column( 'warehouse.location' ) 
		->column( 'warehouse.contact_no' ) 
		->column( 'status.name', 'status_name' )
		->join( 'status', 'status_id', 'warehouse' )
		->where( 'warehouse.status_id', '1' )
		->output();
	}

	public function get( $warehouse_id )
	{
		return $this->db->select( 'warehouse.*, status.name as status_name' )
		->from( 'warehouse' )
		->join( 'status', 'status.status_id=warehouse.status_id', 'left' )
		->where( 'warehouse_id', $warehouse_id )
		->get()->result();
	}

	public function create( $name, $location, $contact_no )
	{
		$data = array(
			'name' 		=> $name,
			'location' 	=> $location,
			'contact_no' 	=> $contact_no,
			'status_id' => 1 // active
		);

		$this->db->insert( 'warehouse', $data );
		return $this->db->affected_rows();
	}

	public function update( $warehouse_id, $name, $location, $contact_no )
	{
		$data = array(
			'name' 		=> $name,
			'location'	=> $location,
			'contact_no' 	=> $contact_no,
		);

		$where = array( 'warehouse_id' => $warehouse_id );

		$this->db->update( 'warehouse', $data, $where );
		return $this->db->affected_rows();
	}

	public function delete( $warehouse_id )
	{
		$data  = array( 'status_id' => 2 ); // inactive
		$where = array( 'warehouse_id' => $warehouse_id);

		$this->db->update( 'warehouse', $data, $where );
		return $this->db->affected_rows();
	}
}
