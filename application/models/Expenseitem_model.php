<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenseitem_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function list()
	{
		return $this->db->select( 'expense_item_id, description' )
		->from( 'expense_item')
		->where( 'expense_item.status_id', 1 )
		->get()->result();
	}

	public function list_by_category($id)
	{
		return $this->db->select( 'expense_item.expense_item_id, expense_category.category_name AS category, expense_item.item_name' )
		->from( 'expense_item')
		->join( 'expense_category', 'expense_category.expense_category_id=expense_item.expense_category_id', 'left' )
		->where( 'expense_category.expense_category_id', $id )
		->where( 'expense_item.status_id', 1 )
		->get()->result();
	}

	public function get( $id )
	{
		return $this->db->select( 'expense_item.expense_item_id, expense_item.description, expense_category.description as category' )
		->from( 'expense_item')
		->join( 'expense_category', 'expense_category.expense_category_id=expense_item.expense_category_id', 'left' )
		->where( 'expense_item_id', $id )
		->get()->result();
	}

	public function create( $categoryId, $item )
	{
		$data = array(
			'expense_category_id' 	=> $categoryId,
			'item_name' 			=> $item,
			'status_id'				=> 1 // active
		);

		$this->db->insert( 'expense_item', $data );
		return $this->db->affected_rows();
	}

	public function update( $id, $description )
	{
		$data = array(
			'description' => $description,
		);

		$where = array( 'expense_item_id' => $id );

		$this->db->update( 'expense_item', $data, $where );
		return $this->db->affected_rows();
	}

	public function delete( $id )
	{
		$where = array( 'expense_item_id' => $id);

		$this->db->delete( 'expense_item', $where );
		return true;
	}
}
