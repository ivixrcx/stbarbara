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

	public function list_ss()
	{		
		return $this->SSP->table( 'expense_category' )
		->column( 'expense_category.expense_category_id')
		->column( 'expense_category.category_name')
		->column( 'expense_category.status_id')
		->where( 'expense_category.status_id', 1 )
		->order_by('expense_category.expense_category_id', 'ASC')
		->output();
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
			'category_name' => $description,
			'status_id'	 	=> 1 // active
		);

		$this->db->insert( 'expense_category', $data );
		return $this->db->affected_rows();
	}

	public function update( $id, $description )
	{
		$data = array(
			'category_name' => $description
		);

		$where = array( 'expense_category_id' => $id );

		$this->db->update( 'expense_category', $data, $where );
		return $this->db->affected_rows();
	}

	public function delete( $id )
	{
		$data  = array( 'status_id' => 2 );
		$where = array( 'expense_category_id' => $id);

		$this->db->update( 'expense_category', $data, $where );
		return $this->db->affected_rows();
	}
}
