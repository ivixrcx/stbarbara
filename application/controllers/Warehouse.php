<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'warehouse_model' );
		$this->load->model( 'account_model' );
		$this->load->library( 'API', NULL, 'API' );
		$this->load->library( 'UserAccess', array( $this ) );
		$this->API->auth_required();
		$this->useraccess->check_permissions();
	}

	public function index()
	{
		$this->list_view();
	}

	public function list()
	{
		$this->API->ajax_only();

		$data = $this->warehouse_model->list();

		return $this->API->emit_json( $data );
	}

	public function list_view()
	{
		$data = array();
		$data['title'] = 'Warehouses';
		$data['nav_warehouses'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/warehouse.js';

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'warehouse', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function get( $warehouse_id )
	{
		$this->API->ajax_only();

		$data = $this->warehouse_model->get( $warehouse_id );

		return $this->API->emit_json( $data );
	}

	public function view( $warehouse_id )
	{
		$data = array();
		$data['nav_warehouses'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['warehouse'] 	= $this->warehouse_model->get( $warehouse_id );
		$data['title'] = ucwords($data['warehouse'][0]->name) . ' warehouses';

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'warehouse_view', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create_view()
	{
		$data = array();
		$data['title'] = 'Create Warehouse';
		$data['nav_warehouses'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/create_warehouse.js';

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_warehouse' );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create()
	{
		$this->API->ajax_only();

		$name 		= $this->input->post( 'name' );
		$location  	= $this->input->post( 'location' );
		$contact_no = $this->input->post( 'contact_no' );

		$create = $this->warehouse_model->create( $name, $location, $contact_no );

		if($create){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
	}

	public function update_view( /*$warehouse_id*/ )
	{
		$data = array();
		$data['title'] = 'Update Warehouse';
		$data['nav_warehouses'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/update_warehouse.js';
		$data['warehouse_id'] = $warehouse_id;

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'update_warehouse', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function update()
	{
		$this->API->ajax_only();

		$warehouse_id  	= $this->input->post( 'warehouse_id' );
		$name 		 	= $this->input->post( 'name' );
		$location  		= $this->input->post( 'location' );
		$contact_no 	= $this->input->post( 'contact_no' );

		$update = $this->warehouse_model->update( $warehouse_id, $name, $location, $contact_no );

		if($update){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: update');	
		}
	}

	public function delete()
	{
		$this->API->ajax_only();

		$warehouse_id = $this->input->post( 'warehouse_id' );
		if(empty($warehouse_id)) return false;

		$delete = $this->warehouse_model->delete( $warehouse_id );

		if($delete){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: delete');	
		}
	}
}
