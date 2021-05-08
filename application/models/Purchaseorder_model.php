<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchaseorder_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function create_purchase_order( $warehouse_id, $supplier_id, $requested_by, $requested_date, $prepared_by, $prepared_date, $user_note )
	{
		$this->db->set( 'warehouse_id', $warehouse_id );
		$this->db->set( 'supplier_id', $supplier_id );
		$this->db->set( 'requested_by', $requested_by );
		$this->db->set( 'requested_date', $requested_date );
		$this->db->set( 'prepared_by', $prepared_by );
		$this->db->set( 'prepared_date', $prepared_date );
		$this->db->set( 'user_note', $user_note );
		$this->db->set( 'status_id', 9 ); // for approval
		$this->db->insert( 'purchase_order' );

		$purchase_order_id = $this->db->insert_id();

		/**
		 * generate purchase order #
		 */
		$this->db->set( 'purchase_order_no', "CONCAT( DATE_FORMAT( NOW(), '%y%m' ), LPAD( $purchase_order_id, 3, '0') )", false );
		$this->db->where( 'purchase_order_id', $purchase_order_id );
		$this->db->update( 'purchase_order' );
		return $purchase_order_id;
	}

	public function update_purchase_order( $purchase_order_id, $supplier_id, $requested_by, $user_note )
	{
		$this->db->set( 'supplier_id', $supplier_id );
		$this->db->set( 'requested_by', $requested_by );
		$this->db->set( 'requested_date', $requested_date );
		$this->db->set( 'prepared_by', $prepared_by );
		$this->db->set( 'prepared_date', $prepared_date );
		$this->db->set( 'user_note', $user_note );
		$this->db->where( 'purchase_order_id', $purchase_order_id );
		$this->db->where( 'status_id', 9 ); // can update PO if still status 9 - for approval
		$this->db->update( 'purchase_order' );
		return $this->db->affected_rows();
	}

	public function delete_purchase_order( $purchase_order_id )
	{
		$status = $this->get_po_status( $purchase_order_id );

		if($status == 9){ // check if PO is for approval
			$this->db->set( 'status_id', 5 ); // void
		}
		else{
			$this->db->set( 'status_id', 10 ); // for deletion
		}

		$this->db->where( 'purchase_order_id', $purchase_order_id );
		$this->db->update( 'purchase_order' );
		return $this->db->affected_rows();
	}

	public function get_purchase_order( $purchase_order_id )
	{
		$this->db->select( 'purchase_order.*, status.name as status_name, color' );
		$this->db->from( 'purchase_order' );
		$this->db->join( 'status', 'status.status_id=purchase_order.status_id', 'left' );
		$this->db->where( 'purchase_order_id', $purchase_order_id );
		return $this->db->get()->result()[0];
	}

	public function get_purchase_order_details( $purchase_order_id )
	{
		$this->db->select( 'purchase_order.*, req.full_name as req_full_name, prep.full_name as prep_full_name, appr.full_name as appr_full_name, warehouse.name as warehouse_name, warehouse.location as warehouse_location, supplier.name as supplier_name, supplier.description, supplier.address, supplier.contact_no, status.name as status_name, color' );
		$this->db->from( 'purchase_order' );
		$this->db->join( 'user as req', 'req.user_id=purchase_order.requested_by', 'left' );
		$this->db->join( 'user as prep', 'prep.user_id=purchase_order.prepared_by', 'left' );
		$this->db->join( 'user as appr', 'appr.user_id=purchase_order.approved_by', 'left' );
		$this->db->join( 'supplier', 'supplier.supplier_id=purchase_order.supplier_id', 'left' );
		$this->db->join( 'warehouse', 'warehouse.warehouse_id=purchase_order.warehouse_id', 'left' );
		$this->db->join( 'status', 'status.status_id=purchase_order.status_id', 'left' );
		$this->db->where( 'purchase_order_id', $purchase_order_id );
		return $this->db->get()->result()[0];
	}

	public function create_purchase_order_item( $purchase_order_id, $quantity, $description, $unit_price, $total)
	{
		$this->db->set( 'purchase_order_id', $purchase_order_id );
		$this->db->set( 'quantity', $quantity );
		$this->db->set( 'description', $description );
		$this->db->set( 'unit_price', $unit_price );
		$this->db->set( 'total', $total );
		$this->db->set( 'status_id', 1 ); // active
		$this->db->insert( 'purchase_order_item' );
		return $this->db->insert_id();
	}

	public function update_purchase_order_item( $purchase_order_item_id, $purchase_order_id, $quantity, $description, $unit_price, $total, $supplier_id )
	{
		$status = $this->get_po_status( $purchase_order_id );

		if($status !== 9){ // check if PO is not for approval
			// just do nothing here
			return false;
		}

		$this->db->set( 'quantity', $quantity );
		$this->db->set( 'description', $description );
		$this->db->set( 'unit_price', $unit_price );
		$this->db->set( 'total', $total );
		$this->db->set( 'supplier_id', $supplier_id );
		$this->db->set( 'status_id', 1 ); //active
		$this->db->where( 'purchase_order_item_id', $purchase_order_item_id );
		$this->db->update( 'purchase_order_item' );
		return $this->db->affected_rows();
	}

	public function recompute_purchase_order_grand_total( $purchase_order_id )
	{
		$this->db->select_sum( 'total' );
		$this->db->from( 'purchase_order_item' );
		$this->db->where( 'purchase_order_id', $purchase_order_id );
		$this->db->where( 'status_id !=', 5 );
		$grand_total = $this->db->get()->result()[0]->total;

		$this->db->set( 'grand_total', $grand_total );
		$this->db->where( 'purchase_order_id', $purchase_order_id );
		$this->db->update( 'purchase_order' );
		return $this->db->affected_rows();
	}

	public function delete_purchase_order_item( $purchase_order_item_id )
	{
		$status = $this->get_po_item_status( $purchase_order_item_id );

		if($status === 9){ // check if PO is not for approval
			// just do nothing here
			return false;
		}

		$this->db->set( 'status_id', 5 ); // void
		$this->db->where( 'purchase_order_item_id', $purchase_order_item_id );
		$this->db->update( 'purchase_order_item' );
		return $this->db->affected_rows();
	}

	public function list_purchase_order_items( $purchase_order_id )
	{
		$this->db->select( 'purchase_order_item.purchase_order_item_id, purchase_order.purchase_order_id, quantity, purchase_order_item.description, unit_price, total, status.status_id, status.name as status_name' );
		$this->db->from( 'purchase_order_item' );
		$this->db->join( 'purchase_order', 'purchase_order.purchase_order_id = purchase_order_item.purchase_order_id', 'left' );
		$this->db->join( 'status', 'status.status_id = purchase_order_item.status_id', 'left' );
		$this->db->where( 'purchase_order_item.purchase_order_id', $purchase_order_id );
		$this->db->where( 'purchase_order_item.status_id', 1); // active
		return $this->db->get()->result();
	}

	public function approval_purchase_order( $purchase_order_id, $approved_by, $approved_date )
	{
		$this->db->set( 'approved_by', $approved_by );
		$this->db->set( 'approved_date', $approved_date );
		$this->db->set( 'status_id', 9 ); // for approval
		$this->db->where( 'purchase_order_id', $purchase_order_id );
		$this->db->update( 'purchase_order' );
		return $this->db->affected_rows();
	}

	public function approved_purchase_order( $purchase_order_id, $approved_by, $approved_date )
	{
		$this->db->set( 'approved_by', $approved_by );
		$this->db->set( 'approved_date', $approved_date );
		$this->db->set( 'status_id', 6 ); // approved
		$this->db->where( 'purchase_order_id', $purchase_order_id );
		$this->db->update( 'purchase_order' );
		return $this->db->affected_rows();
	}

	public function disapprove_purchase_order( $purchase_order_id, $admin_note )
	{
		$this->db->set( 'admin_note', $admin_note ); 
		$this->db->set( 'status_id', 7 ); // disapproved
		$this->db->where( 'purchase_order_id', $purchase_order_id );
		$this->db->update( 'purchase_order' );
		return $this->db->affected_rows();
	}

	public function get_po_status( $purchase_order_id )
	{
		$this->db->select( 'status_id' );
		$this->db->from( 'purchase_order' );
		$this->db->where( 'purchase_order_id', $purchase_order_id );
		return $this->db->get()->result()[0]->status_id;
	}

	public function get_po_item_status( $purchase_order_item_id )
	{
		$this->db->select( 'purchase_order.status_id' );
		$this->db->from( 'purchase_order_item' );
		$this->db->join( 'purchase_order', 'purchase_order.purchase_order_id=purchase_order_item.purchase_order_id', 'left' );
		$this->db->where( 'purchase_order_item_id', $purchase_order_item_id );
		return $this->db->get()->result()[0]->status_id;
	}
}