<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchaseorder extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'purchaseorder_model' );
		$this->load->model( 'project_model' );
		$this->load->model( 'account_model' );
		$this->load->library( 'API', NULL, 'API' );
		$this->load->library( 'dompdf/Dompdf_api', '', 'dompdf' );
		$this->index();
	}

	public function index()
	{
		$loggedin = $this->session->userdata('login_data');
		if(empty($loggedin)){
			redirect( base_url() . 'account/login' );
		}
	}

	public function purchase_order_view(){
		$data = array();
		$data['title'] = 'Purchase Orders';
		$data['nav_po'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/purchase_order.js';

		$this->load->view( 'page-header', $data );
		$this->load->view( 'page-navbar', $data );
		$this->load->view( 'page-title'  );
		$this->load->view( 'purchase_order' );
		$this->load->view( 'page-footer', $data );
	}

	public function purchase_orders($status_id=6)
	{
		$this->API->ajax_only();

		$this->SSP->table( 'purchase_order' )
		->column( 'purchase_order_id' )
		->column( 'project_id' )
		->column( 'invoice_no' )
		->column( 'grand_total' )
		->column( 'req.full_name', 'requested_by' )
		->column( 'requested_date' )
		->column( 'prep.full_name', 'prepared_by' )
		->column( 'prepared_date' )
		->column( 'user_note' )
		->column( 'deletion_note' )
		->column( 'admin_note' )
		->column( 'appr.full_name', 'approved_by' )
		->column( 'approved_date' )
		->column( 'status.status_id' )
		->column( 'status.name', 'status_name' )
		->column( 'status.color', 'status_color' )
		->join( 'user as req', 'req.user_id = purchase_order.requested_by' )
		->join( 'user as prep', 'prep.user_id = purchase_order.prepared_by' )
		->join( 'user as appr', 'appr.user_id = purchase_order.approved_by' )
		->join( 'status', 'status_id', 'purchase_order' )
		->where( 'purchase_order.status_id', $status_id )
		->where_in( 'purchase_order.status_id', array( 1, 6, 9 ) ) //active, approved, for approval
		->output();
	}

	public function get_purchase_order()
	{
		$this->API->ajax_only();

		$purchase_order_id = $this->input->post( 'purchase_order_id' );

		$data = $this->get_purchase_order( $purchase_order_id );

		return $this->API->emit_json( $data );
	}

	public function create_purchase_order_view()
	{
		$data = array();
		$data['title'] = 'Create Purchase Order';
		$data['nav_po'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['style'] = './assets/css/autocomplete.css';
		$data['script'] = array(
			'./assets/js/autocomplete1.js',
			'./scripts/create_purchase_order.js',
		);

		$this->load->view( 'page-header', $data );
		$this->load->view( 'page-navbar', $data );
		$this->load->view( 'page-title', $data  );
		$this->load->view( 'create_purchase_order' );
		$this->load->view( 'page-footer', $data );
	}

	public function create_purchase_order()
	{
		$this->API->ajax_only();

		$project_id	 	 = $this->input->post( 'project_id' );
		$supplier_id	 = $this->input->post( 'supplier_id' );
		$requested_by	 = $this->input->post( 'requested_by' );
		$requested_date	 = $this->input->post( 'requested_date' );
		$user_note	 	 = $this->input->post( 'user_note' );
		$prepared_by 	 = $this->session->userdata('login_data')->user_id;
		$prepared_date 	 = date('Y-m-d');

		$insert_id = $this->purchaseorder_model->create_purchase_order( $project_id, $supplier_id, $requested_by, $requested_date, $prepared_by, $prepared_date, $user_note );
		$this->API->emit_json( $insert_id );
	}

	public function active_projects()
	{
		$this->API->ajax_only();

		$list = $this->project_model->list(1);

		$this->API->emit_json( $list );
	}

	public function active_staffs()
	{
		$list = $this->account_model->list_of_users( 2, 1 );
		
		$this->API->emit_json( $list);	
	}

	public function delete_purchase_order()
	{
		$this->API->ajax_only();

		$purchase_order_id = $this->input->post( 'purchase_order_id' );

		$delete = $this->purchaseorder_model->delete_purchase_order($purchase_order_id);

		if($delete){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: delete');	
		}
	}

	public function purchase_order_item_view($purchase_order_id)
	{
		$data = array();
		$data['title'] = 'Purchase order items';
		$data['nav_po'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/purchase_order_item.js';
		$data['items'] = $this->purchaseorder_model->list_purchase_order_items( $purchase_order_id );
		$data['purchase_order'] = $this->purchaseorder_model->get_purchase_order( $purchase_order_id );
		$data['purchase_order_id'] = $purchase_order_id;


		$this->load->view( 'page-header', $data );
		$this->load->view( 'page-navbar', $data );
		$this->load->view( 'page-title', $data  );
		$this->load->view( 'purchase_order_item', $data );
		$this->load->view( 'page-footer', $data );
	}

	public function set_session_userdata()
	{
		$this->API->ajax_only();

		$name  = $this->input->post( 'name' );
		$value = $this->input->post( 'value' );
		$this->session->set_userdata( $name, $value );
	}

	public function purchase_order_items()
	{
		$this->API->ajax_only();

		$purchase_order_id = $this->input->post( 'purchase_order_id' );

		$list = $this->purchaseorder_model->list_purchase_order_items( $purchase_order_id );

		if(!empty($list)){
			$this->API->emit_json( $list );
		}
		else{
			$this->API->emit_json( false, 'Error: select' );	
		}
	}

	public function create_purchase_order_item_view($purchase_order_id)
	{
		$data = array();
		$data['title'] = 'Create purchase order item';
		$data['nav_po'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/create_purchase_order_item.js';
		$data['purchase_order_id'] = $purchase_order_id;

		$this->load->view( 'page-header', $data );
		$this->load->view( 'page-navbar', $data );
		$this->load->view( 'page-title', $data  );
		$this->load->view( 'create_purchase_order_item', $data );
		$this->load->view( 'page-footer', $data );
	}

	public function create_purchase_order_item()
	{
		$this->API->ajax_only();

		$purchase_order_id = $this->input->post( 'purchase_order_id' );
		$quantity 		= $this->input->post( 'quantity' );
		$description 	= $this->input->post( 'description' );
		$unit_price 	= $this->input->post( 'unit_price' );
		$total 			= $this->input->post( 'total' );

		$insert = $this->purchaseorder_model->create_purchase_order_item( $purchase_order_id, $quantity, $description, $unit_price, $total );

		if($insert){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
	}

	public function update_purchase_order_item()
	{
		$this->API->ajax_only();

		$purchase_order_id 		= $this->input->post( 'purchase_order_id' );
		$purchase_order_item_id = $this->input->post( 'purchase_order_item_id' );

		$update = $this->purchaseorder_model->update_purchase_order_item( $purchase_order_item_id, $purchase_order_id, $quantity, $description, $unit_price, $total, $supplier_id );

		if($update){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: update');	
		}
	}

	public function delete_purchase_order_item()
	{
		$this->API->ajax_only();

		$purchase_order_item_id = $this->input->post( 'purchase_order_item_id' );

		$delete = $this->purchaseorder_model->delete_purchase_order_item( $purchase_order_item_id );

		if($delete){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: delete');	
		}
	}

	public function test_print($purchase_order_id)
	{
		$data['purchase_order'] = $this->purchaseorder_model->get_purchase_order_details( $purchase_order_id );
		$data['items'] = $this->purchaseorder_model->list_purchase_order_items( $purchase_order_id );

		$this->load->view('table', $data);
	}

	public function print($purchase_order_id)
	{
		// echo $this->dompdf->get_option('default_font');exit;

		// $this->API->ajax_only();
		
		$data['purchase_order'] = $this->purchaseorder_model->get_purchase_order_details( $purchase_order_id );
		$data['items'] = $this->purchaseorder_model->list_purchase_order_items( $purchase_order_id );

		$this->load->view('table', $data);

		$html = $this->output->get_output();

		$this->dompdf->load_html($html);
		$this->dompdf->render();// $this->dompdf->get_canvas()->get_cpdf()->setEncryption('12345');

		// Output the generated PDF to Browser
		$this->dompdf->stream("test.pdf", array("Attachment" => 0));
	}
}