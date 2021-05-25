<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function list( $status_id="1" )
	{
		return $this->db->select( 'supplier.*, status.name as status_name' )
		->from( 'supplier')
		->join( 'status', 'status.status_id=supplier.status_id', 'left')
		->where( 'supplier.status_id', $status_id )
		->get()->result();
	}

	public function list_ss()
	{		
		return $this->SSP->table( 'supplier' )
		->column( 'supplier.*' ) 
		->column( 'status.name', 'status_name' )
		->join( 'status', 'status_id', 'supplier' )
		->where( 'supplier.status_id', '1' )
		->output();
	}


	public function create( $name, $description, $address, $contact_no )
	{
		$data = array(
			'name' 		  => $name,
			'description' => $description,
			'address' 	  => $address,
			'contact_no'  => $contact_no,
			'status_id'   => 1 // active
		);

		$this->db->insert( 'supplier', $data );
		return $this->db->affected_rows();
	}

	public function delete($supplier_id)
	{
		$data  = array( 'status_id' => 2 );
		$where = array( 'supplier_id' => $supplier_id);

		$this->db->update( 'supplier', $data, $where );
		return $this->db->affected_rows();
	}

	public function update( $supplier_id, $name, $description, $address, $contact_no )
	{
		$data = array(
			'name' 		  => $name,
			'description' => $description,
			'address' 	  => $address,
			'contact_no'  => $contact_no
		);

		$where = array( 'supplier_id' => $supplier_id );

		$this->db->update( 'supplier', $data, $where );
		return $this->db->affected_rows();
	}

	public function get( $supplier_id )
	{
		return $this->db->select( '*' )
		->from( 'supplier' )
		->where( 'supplier_id', $supplier_id )
		->get()->result();
	}
}
