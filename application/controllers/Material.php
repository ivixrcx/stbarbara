<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'material_model' );
		$this->load->model( 'account_model' );
		$this->load->library( 'API', NULL, 'API' );
		// $this->load->library( 'UserAccess', array( $this ) );
		// $this->API->auth_required();
		// $this->useraccess->check_permissions();
	}

	public function index()
	{
		$this->list_view();
	}

	public function list()
	{
		$this->API->ajax_only();

		$data = $this->material_model->list();

		return $this->API->emit_json( $data );
	}

	public function list_ss()
	{
		$this->API->ajax_only();
		
		$this->material_model->list_ss();
	}

	public function search()
	{
		$search = $this->input->post( 'search' );

		$data = $this->material_model->search( $search );
		
		$this->API->emit_json( $data );
	}

	public function search_particular_unit()
	{
		$particular = $this->input->post( 'particular', true );
		$unit = $this->input->post( 'unit', true );

		$data = $this->material_model->search_particular_unit( $particular, $unit );
		
		$this->API->emit_json( $data );
	}

	public function list_view()
	{
		$data = array();
		$data['title'] = 'Materials';
		$data['nav_materials'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = array(
			'./scripts/deletion.js',
			'./scripts/material.js'
		);

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'material', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create_view()
	{
		$data = array();
		$data['title'] = 'Create Material';
		$data['nav_materials'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/create_material.js';
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_material' );
		$this->load->view( 'page-frame-footer', $data );
	}
	
	public function create()
	{
		$this->API->ajax_only();

		$particular 		 	 = $this->input->post( 'particular', true );
		$unit  		 			 = $this->input->post( 'unit', true );
		$stock_level  		 	 = $this->input->post( 'stock_level', true );
		$material_category_id 	 = $this->input->post( 'material_category_id', true );

		$create = $this->material_model->create( $particular, $unit , $stock_level, $material_category_id );

		if($create){
			$this->API->emit_json( $create );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
	}

	public function add_stock()
	{
		$this->API->ajax_only();

		$material_id = $this->input->post( 'material_id' );
		$no_of_stocks = $this->input->post( 'no_of_stocks' );

		$update = $this->material_model->add_stock( $material_id, $no_of_stocks );

		if($update){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: update');	
		}
	}

	public function update_view( $material_id )
	{
		$data = array();
		$data['title'] = 'Update House';
		$data['nav_materials'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/update_material.js';

		$get = $this->material_model->get($material_id);
		$data['material_id'] = $get[0]->material_id;
		$data['particular'] = $get[0]->particular;
		$data['unit'] = $get[0]->unit;
		$data['stock_level'] = $get[0]->stock_level;

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'update_material', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function update()
	{
		$this->API->ajax_only();

		$material_id = $this->input->post( 'material_id' );
		$particular  = $this->input->post( 'particular' );
		$unit 		 = $this->input->post( 'unit' );
		$stock_level = $this->input->post( 'stock_level' );

		if( empty($material_id) || empty($particular) || empty($unit) ){
			return false;
		}

		$update = $this->material_model->update( $material_id, $particular, $unit, $stock_level );

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

		$material_id = $this->input->post( 'material_id' );
		if(empty($material_id)) return false;

		$delete = $this->material_model->delete( $material_id );

		if($delete){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: delete');	
		}

	}
}
