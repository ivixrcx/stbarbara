<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function list()
	{
		return $this->db->select( 'supplier.*, status.name as status_name' )
		->from( 'supplier')
		->join( 'status', 'status.status_id=supplier.status_id', 'left')
		->get()->result();
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
		$data  = array( 'status_id' => $status_id );
		$where = array( 'supplier_id' => $supplier_id);

		$this->db->update( 'supplier', $data, $where );
		return $this->db->affected_rows();
	}
}
