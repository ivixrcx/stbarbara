<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchaseorder_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function create_purchase_order( $project_id, $supplier_id, $requested_by, $requested_date, $prepared_by, $prepared_date, $user_note )
	{
		$data = array(
			'project_id' 	=> $project_id,
			'supplier_id' 	=> $supplier_id,
			'requested_by' 	=> $requested_by,
			'requested_date'=> $requested_date,
			'prepared_by' 	=> $prepared_by,
			'prepared_date' => $prepared_date,
			'user_note' 	=> $user_note,
			'status_id' 	=> 9, // for approval
		);

		$this->db->insert( 'purchase_order', $data);
		return $this->db->insert_id();
	}


	public function update_purchase_order( $purchase_order_id, $supplier_id, $requested_by, $user_note )
	{
		$data = array(
			'supplier_id' 	=> $supplier_id,
			'requested_by' 	=> $requested_by,
			'requested_date'=> $requested_date,
			'prepared_by' 	=> $prepared_by,
			'prepared_date' => $prepared_date,
			'user_note' 	=> $user_note,
		);

		$where = array( 
			'purchase_order_id' => $purchase_order_id ,
			'status_id' => 9, // can update PO if still status 9 - for approval
		);

		$this->db->update( 'purchase_order', $data, $where );
		return $this->db->affected_rows();
	}

	public function delete_purchase_order( $purchase_order_id )
	{
		$status_id = $this->db->select( 'status_id' )
		->from( 'purchase_order' )
		->where( 'purchase_order_id', $purchase_order_id )
		->get()->result()[0]->status_id;

		if($status_id == 9){ // check if PO is for approval
			$data = array( 'status_id' => 5 ); // void
		}
		else{
			$data = array( 'status_id' => 10 ); // for deletion
		}

		$where = array( 'purchase_order_id' => $purchase_order_id );

		$this->db->update( 'purchase_order', $data, $where );
		return $this->db->affected_rows();
	}

	public function get_purchase_order( $purchase_order_id )
	{
		return $this->db->select( 'purchase_order.*, status.name as status_name, color' )
		->from( 'purchase_order' )
		->join( 'status', 'status.status_id=purchase_order.status_id', 'left' )
		->where( 'purchase_order_id', $purchase_order_id )
		->get()->result()[0];
	}

	public function get_purchase_order_details( $purchase_order_id )
	{
		return $this->db->select( 'purchase_order.*, req.full_name as req_full_name, prep.full_name as prep_full_name, appr.full_name as appr_full_name, project.name as project_name, supplier.name as supplier_name, supplier.description, supplier.address, supplier.contact_no, status.name as status_name, color' )
		->from( 'purchase_order' )
		->join( 'user as req', 'req.user_id=purchase_order.requested_by', 'left' )
		->join( 'user as prep', 'prep.user_id=purchase_order.prepared_by', 'left' )
		->join( 'user as appr', 'appr.user_id=purchase_order.approved_by', 'left' )
		->join( 'supplier', 'supplier.supplier_id=purchase_order.supplier_id', 'left' )
		->join( 'project', 'project.project_id=purchase_order.project_id', 'left' )
		->join( 'status', 'status.status_id=purchase_order.status_id', 'left' )
		->where( 'purchase_order_id', $purchase_order_id )
		->get()->result()[0];
	}

	public function create_purchase_order_item( $purchase_order_id, $quantity, $description, $unit_price, $total)
	{
		$data = array(
			'purchase_order_id' => $purchase_order_id, 
			'quantity' 		=> $quantity,
			'description' 	=> $description,
			'unit_price' 	=> $unit_price,
			'total' 		=> $total,
			'status_id' 	=> 1, // active
		);

		$this->db->insert( 'purchase_order_item', $data );
		return $this->db->affected_rows();
	}

	public function update_purchase_order_item( $purchase_order_item_id, $purchase_order_id, $quantity, $description, $unit_price, $total, $supplier_id )
	{
		$status_id = $this->db->select( 'status_id' )
		->from( 'purchase_order' )
		->where( 'purchase_order_id', $purchase_order_id )
		->get()->result()[0]->status_id;

		if($status_id == 9){ // check if PO is for approval
		
			$data = array(
				'quantity' 		=> $quantity,
				'description' 	=> $description,
				'unit_price' 	=> $unit_price,
				'total' 		=> $total,
				'supplier_id' 	=> $supplier_id,
				'status_id' 	=> 1, // active
			);

			$where = array( 'purchase_order_item_id' => $purchase_order_item_id );

			$this->db->update( 'purchase_order_item', $data, $where );
		}

		return $this->db->affected_rows();
	}

	public function recompute_purchase_order_grand_total( $purchase_order_id )
	{
		$grand_total = $this->db->select_sum( 'total' )
		->from( 'purchase_order_item' )
		->where( 'purchase_order_id', $purchase_order_id )
		->where( 'status_id !=', 5 )
		->get()->result()[0]->total;

		$data  = array( 'grand_total' => $grand_total );
		$where = array( 'purchase_order_id' => $purchase_order_id );

		$this->db->update( 'purchase_order', $data, $where );
		return $this->db->affected_rows();
	}

	public function delete_purchase_order_item( $purchase_order_item_id )
	{
		$status_id = $this->db->select( 'purchase_order.status_id' )
		->from( 'purchase_order_item' )
		->join( 'purchase_order', 'purchase_order.purchase_order_id=purchase_order_item.purchase_order_id', 'left' )
		->where( 'purchase_order_item_id', $purchase_order_item_id )
		->get()->result()[0]->status_id;

		if($status_id == 9){ // check if PO is for approval
			$data = array( 'status_id' => 5 ); // void
			$where = array( 'purchase_order_item_id' => $purchase_order_item_id );
			$this->db->update( 'purchase_order_item', $data, $where );
		}
		
		return $this->db->affected_rows();
	}

	public function list_purchase_order_items( $purchase_order_id )
	{
		return $this->db->select( 'purchase_order_item.purchase_order_item_id, purchase_order.purchase_order_id, quantity, purchase_order_item.description, unit_price, total, status.status_id, status.name as status_name' )
		->from( 'purchase_order_item' )
		->join( 'purchase_order', 'purchase_order.purchase_order_id = purchase_order_item.purchase_order_id', 'left' )
		->join( 'status', 'status.status_id = purchase_order_item.status_id', 'left' )
		->where( 'purchase_order_item.purchase_order_id', $purchase_order_id )
		->where( 'purchase_order_item.status_id', 1) // active
		->get()->result();
	}

	public function approve_purchase_order( $purchase_order_id )
	{
		$data = array( 'status_id' => 6 ); // approved
		$where = array( 'purchase_order_id' => $purchase_order_id );

		$this->db->update( 'purchase_order', $data, $where );
		return $this->db->affected_rows();
	}

	public function disapprove_purchase_order( $purchase_order_id, $admin_note )
	{
		$data = array( 
			'admin_note' => $admin_note, 
			'status_id' => 6, // disapproved
		);

		$where = array( 'purchase_order_id' => $purchase_order_id );

		$this->db->update( 'purchase_order', $data, $where );
		return $this->db->affected_rows();
	}
}
