<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'supplier_model' );
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

	public function list_view()
	{
		$data = array();
		$data['title'] = 'Suppliers';
		$data['nav_suppliers'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = array(
			'./scripts/deletion.js',
			'./scripts/supplier.js'
		);

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'supplier', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function lists()
	{
		$this->API->ajax_only();

		$data = $this->supplier_model->lists();

		return $this->API->emit_json( $data );
	}

	public function list_ss()
	{
		$this->API->ajax_only();
		
		$this->supplier_model->list_ss();
	}

	public function get_supplier_view( $supplier_id ) 
	{

	}

	public function get_supplier( $supplier_id )
	{
		$this->API->ajax_only();

	}

	public function create_view()
	{
		$data = array();
		$data['title'] = 'Create supplier';
		$data['nav_suppliers'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/create_supplier.js';
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_supplier' );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create()
	{
		$this->API->ajax_only();

		$name 		 = $this->input->post( 'name' );
		$description = $this->input->post( 'description' );
		$address 	 = $this->input->post( 'address' );
		$contact_no  = $this->input->post( 'contact_no' );

		$create = $this->supplier_model->create( $name, $description, $address, $contact_no );

		if($create){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
	}

	public function update_view( $supplier_id )
	{
		$data = array();
		$data['title'] = 'Update Supplier';
		$data['nav_suppliers'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/update_supplier.js';
		$data['supplier'] = $this->supplier_model->get( $supplier_id );

		// display nothing if no data found for now
		if( count($data['supplier']) == 0 ){
			return false;
		}

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'update_supplier', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function update()
	{
		$this->API->ajax_only();

		$supplier_id	= $this->input->post( 'supplier_id', true );
		$name 		  	= $this->input->post( 'name', true );
		$description  	= $this->input->post( 'description', true );
		$address 	 	= $this->input->post( 'address', true );
		$contact_no 	= $this->input->post( 'contact_no', true );

		$update = $this->supplier_model->update( $supplier_id, $name, $description, $address, $contact_no );

		if($update){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'No changes.');	
		}

	}

	public function delete()
	{
		$this->API->ajax_only();

		$supplier_id = $this->input->post( 'supplier_id' );
		if(empty($supplier_id)) return false;

		$delete = $this->supplier_model->delete( $supplier_id );

		if($delete){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: delete');	
		}

	}
}
