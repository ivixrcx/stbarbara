<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expensecategory_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function list()
	{
		return $this->db->select( 'expense_category_id, description' )
		->from( 'expense_category')
		->where( 'expense_category.status_id', 1 )
		->get()->result();
	}

	public function get( $id )
	{
		return $this->db->select( '*' )
		->from( 'expense_category')
		->where( 'expense_category_id', $id )
		->get()->result();
	}

	public function create( $description )
	{
		$data = array(
			'description' 	=> $description,
			'status_id'	 	=> 1 // active
		);

		$this->db->insert( 'expense_category', $data );
		return $this->db->affected_rows();
	}

	public function update( $id, $description )
	{
		$data = array(
			'description' 	=> $description
		);

		$where = array( 'expense_category_id' => $id );

		$this->db->update( 'expense_category', $data, $where );
		return $this->db->affected_rows();
	}

	public function delete( $id )
	{
		$where = array( 'expense_category_id' => $id);

		$this->db->delete( 'expense_category', $where );
		return true;
	}
}
