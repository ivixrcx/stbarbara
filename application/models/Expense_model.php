<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function list_ss()
	{		
		return $this->SSP->table( 'expense' )
		->column( 'expense.expense_id')
		->column( 'expense.date')
		->column( 'expense.or_no')
		->column( 'expense.expense_name')
		->column( 'expense.total')
		->column( 'expense.note')
		->column( 'expense_category.category_name')
		->join( 'expense_category', 'expense_category_id', 'expense' )
		->where( 'expense.status_id', 1 )
		->order_by('expense.date', 'DESC')
		->output();
	}

	public function get( $id )
	{
		return $this->db->select( 'expense_id, amount, expense.description, expense_category.description as cat_desc, expense_item.description as item_desc' )
		->from( 'expense')
		->join( 'expense_category', 'expense_category.expense_category_id=expense.expense_category_id', 'left' )
		->join( 'expense_item', 'expense_item.expense_item_id=expense.expense_item_id', 'left' )
		->where( 'expense_id', $id )
		->get()->result();
	}

	public function create( $category_id, $item_id, $description, $amount )
	{
		$data = array(
			'expense_category_id' 	=> $category_id,
			'expense_item_id' 		=> $item_id,
			'description' 			=> $description,
			'amount'				=> $amount,
			'status_id'				=> 1 // active
		);

		$this->db->insert( 'expense', $data );
		return $this->db->affected_rows();
	}

	public function update( $id, $description, $amount )
	{
		$data = array(
			'description' 	=> $description,
			'amount'		=> $amount,
		);

		$where = array( 'expense_id' => $id );

		$this->db->update( 'expense', $data, $where );
		return $this->db->affected_rows();
	}

	public function delete( $id )
	{
		$data  = array( 'status_id' => 2 );
		$where = array( 'expense_id' => $id);

		$this->db->update( 'expense', $data, $where );
		return $this->db->affected_rows();
	}
}
