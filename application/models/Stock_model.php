<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function lists( $warehouse_id )
	{
		return $this->db->select( 'stock_id, stock_in_id, stock_out_id, stock_in.particular as stock_in_material, stock_out.particular as stock_out_material, quantity, date, remarks, warehouse.warehouse_id, warehouse.name as warehouse_name, status.name as status_name' )
		->from( 'stock' )
		->join( 'warehouse', 'warehouse.warehouse_id=stock.warehouse_id', 'left' )
		->join( 'material as stock_in', 'stock_in.material_id=stock.stock_in_id', 'left' )
		->join( 'material as stock_out', 'stock_out.material_id=stock.stock_out_id', 'left' )
		->join( 'status', 'status.status_id=stock.status_id', 'left' )
		->where( 'stock.warehouse_id', $warehouse_id )
		->where( 'stock.status_id', 1 ) // active
		->get()->result();	
	}

	public function get( $stock_id )
	{
		return $this->db->select( 'stock_id, stock_in_id, stock_out_id, stock_in.particular as stock_in_material, stock_out.particular as stock_out_material, quantity, date, remarks, warehouse.warehouse_id, warehouse.name as warehouse_name, status.name as status_name' )
		->from( 'stock' )
		->join( 'warehouse', 'warehouse.warehouse_id=stock.warehouse_id', 'left' )
		->join( 'material as stock_in', 'stock_in.material_id=stock.stock_in_id', 'left' )
		->join( 'material as stock_out', 'stock_out.material_id=stock.stock_out_id', 'left' )
		->join( 'status', 'status.status_id=stock.status_id', 'left' )
		->where( 'stock.warehouse_id', $warehouse_id )
		->where( 'stock_id', $stock_id )
		->where( 'stock.status_id', 1 ) // active
		->get()->result();
	}

	public function create_stock_in( $stock_in_id, $warehouse_id, $date , $quantity , $remarks )
	{
		$data = array(
			'stock_in_id' 	=> $stock_in_id,
			'date' 			=> $date,
			'quantity' 		=> $quantity,
			'remarks' 		=> $remarks,
			'warehouse_id' 	=> $warehouse_id,
			'status_id' 	=> 1 // active
		);

		$this->db->insert( 'stock', $data );
		return $this->db->insert_id();
	}

	public function create_stock_out( $stock_out_id, $warehouse_id, $date , $quantity , $remarks )
	{
		$data = array(
			'stock_out_id' 	=> $stock_out_id,
			'date' 			=> $date,
			'quantity' 		=> $quantity,
			'remarks' 		=> $remarks,
			'warehouse_id' 	=> $warehouse_id,
			'status_id' 	=> 1 // active
		);

		$this->db->insert( 'stock', $data );
		return $this->db->insert_id();
	}

	public function delete( $stock_id )
	{
		$data  = array( 'status_id' => 2 ); // inactive
		$where = array( 'stock_id' => $stock_id);

		$this->db->update( 'stock', $data, $where );
		return $this->db->affected_rows();
	}
}
