<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'material_model' );
		$this->load->model( 'account_model' );
		$this->load->library( 'API', NULL, 'API' );
		$this->load->library( 'UserAccess', array( $this ) );
		$this->useraccess->check_permissions();
	}

	public function index()
	{
		$this->list_view();
	}

	public function list()
	{
		$this->API->ajax_only();

		$this->SSP->table( 'material' )
		->column( 'material_id' )
		->column( 'material.particular', 'material_particular' )
		->column( 'unit' )
		->column( 'no_of_stocks' )
		->column( 'last_stock_date' )
		->column( 'stock_level' )
		->column( 'material.material_category_id' )
		->column( 'material.status_id' )
		->column( 'material_category.particular', 'material_category_particular' )
		->column( 'status.name', 'status_name' )
		->join( 'material_category', 'material_category.material_category_id=material.material_category_id','left' )
		->join( 'status', 'status.status_id=material.status_id', 'left' )
		->where( 'material.status_id', 1 ) // active
		->output();
	}

	public function create()
	{
		$this->API->ajax_only();

		$particular 		 	 = $this->input->post( 'particular' );
		$unit  		 			 = $this->input->post( 'unit' );
		$material_category_id 	 = $this->input->post( 'material_category_id' );

		$create = $this->material_model->create( $particular, $unit , $material_category_id );

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

	public function search()
	{
		$search = $this->input->post( 'search' );

		$data = $this->material_model->search( $search );
		
		$this->API->emit_json( $data );
	}

	public function list_view()
	{
		$data = array();
		$data['title'] = 'Houses';
		$data['nav_houses'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/house.js';

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'house', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create_view()
	{
		$data = array();
		$data['title'] = 'Create House';
		$data['nav_houses'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/create_house.js';
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_house' );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function update_view( $house_id )
	{
		$data = array();
		$data['title'] = 'Update House';
		$data['nav_houses'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/update_house.js';
		$data['house_id'] = $house_id;

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'update_house', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function update()
	{
		$this->API->ajax_only();

		$house_id  		 = $this->input->post( 'house_id' );
		$name 		 	 = $this->input->post( 'name' );
		$lot_area  		 = $this->input->post( 'lot_area' );
		$floor_area 	 = $this->input->post( 'floor_area' );
		$suggested_price = $this->input->post( 'suggested_price' );

		$update = $this->house_model->update( $house_id, $name, $lot_area, $floor_area, $suggested_price );

		if($update){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: update');	
		}

	}
}
