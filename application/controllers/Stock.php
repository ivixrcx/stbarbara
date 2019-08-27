<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'stock_model' );
		$this->load->model( 'warehouse_model' );
		$this->load->model( 'account_model' );
		$this->load->library( 'API', NULL, 'API' );
		$this->load->library( 'UserAccess', array( $this ) );
		$this->API->auth_required();
		$this->useraccess->check_permissions();
	}

	public function index()
	{
		// $this->list_view();
	}

	public function list( $warehouse_id )
	{
		$this->API->ajax_only();

		$data = $this->stock_model->list( $warehouse_id );

		return $this->API->emit_json( $data );
	}

	public function get( $stock_id )
	{
		$this->API->ajax_only();

		$data = $this->stock_model->get( $stock_id );

		return $this->API->emit_json( $data );
	}

	public function all()
	{
		$this->API->ajax_only();

		$warehouse_id = $this->input->post( 'warehouse_id' );

		$this->SSP->table( 'stock' )
		->column( 'stock_id' )
		->column( 'stock_in_id' )
		->column( 'stock_out_id' )
		->column( 'stock_in.particular', 'stock_in_material' )
		->column( 'stock_out.particular', 'stock_out_material' )
		->column( 'quantity' )
		->column( 'date' )
		->column( 'remarks' )
		->column( 'warehouse.warehouse_id' )
		->column( 'warehouse.name', 'warehouse_name' )
		->column( 'status.name', 'status_name' )
		->join( 'warehouse', 'warehouse.warehouse_id=stock.warehouse_id', 'left' )
		->join( 'material as stock_in', 'stock_in.material_id=stock.stock_in_id', 'left' )
		->join( 'material as stock_out', 'stock_out.material_id=stock.stock_out_id', 'left' )
		->join( 'status', 'status.status_id=stock.status_id', 'left' )
		->where( 'stock.warehouse_id', $warehouse_id )
		->where( 'stock.status_id', 1 ) // active
		->output();
	}

	public function in()
	{
		$this->API->ajax_only();

		$warehouse_id = $this->input->post( 'warehouse_id' );

		$this->SSP->table( 'stock' )
		->column( 'stock_id' )
		->column( 'stock_in_id' )
		->column( 'stock_in.particular', 'stock_in_material' )
		->column( 'quantity' )
		->column( 'date' )
		->column( 'remarks' )
		->column( 'warehouse.warehouse_id' )
		->column( 'warehouse.name', 'warehouse_name' )
		->column( 'status.name', 'status_name' )
		->join( 'warehouse', 'warehouse.warehouse_id=stock.warehouse_id', 'left' )
		->join( 'material as stock_in', 'stock_in.material_id=stock.stock_in_id', 'left' )
		->join( 'status', 'status.status_id=stock.status_id', 'left' )
		->where_not( 'stock.stock_in_id', NULL )
		->where( 'stock.warehouse_id', $warehouse_id )
		->where( 'stock.status_id', 1 ) // active
		->output();
	}

	public function out()
	{
		$this->API->ajax_only();

		$warehouse_id = $this->input->post( 'warehouse_id' );

		$this->SSP->table( 'stock' )
		->column( 'stock_id' )
		->column( 'stock_out_id' )
		->column( 'stock_out.particular', 'stock_out_material' )
		->column( 'quantity' )
		->column( 'date' )
		->column( 'remarks' )
		->column( 'warehouse.warehouse_id' )
		->column( 'warehouse.name', 'warehouse_name' )
		->column( 'status.name', 'status_name' )
		->join( 'warehouse', 'warehouse.warehouse_id=stock.warehouse_id', 'left' )
		->join( 'material as stock_out', 'stock_out.material_id=stock.stock_out_id', 'left' )
		->join( 'status', 'status.status_id=stock.status_id', 'left' )
		->where_not( 'stock.stock_out_id', NULL )
		->where( 'stock.warehouse_id', $warehouse_id )
		->where( 'stock.status_id', 1 ) // active
		->output();
	}

	public function list_view( $warehouse_id )
	{
		$data = array();
		$data['nav_warehouses'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/stock.js';
		$data['warehouse_id'] = $warehouse_id;
		$data['warehouse'] = $this->warehouse_model->get( $warehouse_id );
		$data['title'] = "Stocks in " . ucwords($data['warehouse'][0]->name) . " warehouse";

		$this->load->view( 'page-frame', $data );
		$this->load->view( 'stock', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create_stock_in_view( $warehouse_id )
	{
		$data = array();
		$data['title'] = 'Stock In';
		$data['nav_warehouses'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['warehouse_id'] = $warehouse_id;
		$data['script'] = './scripts/create_stock_in.js';

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_stock_in', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create_stock_out_view( $warehouse_id )
	{
		$data = array();
		$data['title'] = 'Stock Out';
		$data['nav_warehouses'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['warehouse_id'] = $warehouse_id;
		$data['style'] = './assets/css/autocomplete.css';
		$data['script'] = array(
			'./assets/js/autocomplete1.js',
			'./scripts/create_stock_out.js',
		);

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_stock_out', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create_stock_in()
	{
		$this->API->ajax_only();

		$stock_in_id    = $this->input->post( 'stock_in_id' );
		$date  			= $this->input->post( 'date' );
		$quantity  		= $this->input->post( 'quantity' );
		$remarks 		= $this->input->post( 'remarks' );
		$warehouse_id   = $this->input->post( 'warehouse_id' );

		$create = $this->stock_model->create_stock_in( $stock_in_id, $warehouse_id, $date , $quantity , $remarks );

		if($create){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
	}

	public function create_stock_out()
	{
		$this->API->ajax_only();

		$stock_out_id   = $this->input->post( 'stock_out_id' );
		$date  			= $this->input->post( 'date' );
		$quantity  		= $this->input->post( 'quantity' );
		$remarks 		= $this->input->post( 'remarks' );
		$warehouse_id   = $this->input->post( 'warehouse_id' );

		$create = $this->stock_model->create_stock_out( $stock_out_id, $warehouse_id, $date , $quantity , $remarks );

		if($create){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
	}

	public function delete()
	{
		$this->API->ajax_only();

		$stock_id = $this->input->post( 'stock_id' );
		if(empty($stock_id)) return false;

		$delete = $this->stock_model->delete( $stock_id );

		if($delete){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: delete');	
		}
	}
}
