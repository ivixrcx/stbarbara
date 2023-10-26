<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class House extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'house_model' );
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
		$data['title'] = 'Houses';
		$data['nav_houses'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = array(
			'./scripts/deletion.js',
			'./scripts/house.js'
		);
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'house', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function lists()
	{
		$this->API->ajax_only();

		$data = $this->house_model->lists();

		return $this->API->emit_json( $data );
	}

	public function list_ss()
	{
		$this->API->ajax_only();

		$this->house_model->list_ss();
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

	public function create()
	{
		$this->API->ajax_only();

		$name 		 	 = $this->input->post( 'name' );
		$lot_area  		 = $this->input->post( 'lot_area' );
		$floor_area 	 = $this->input->post( 'floor_area' );
		$suggested_price = $this->input->post( 'suggested_price' );

		$create = $this->house_model->create( $name, $lot_area, $floor_area, $suggested_price );

		if($create){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
	}

	public function update_view( $house_id )
	{
		$data = array();
		$data['title'] = 'Update House';
		$data['nav_houses'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/update_house.js';
		$data['house'] = $this->house_model->get( $house_id );

		// display nothing if no data found for now
		if( count($data['house']) == 0 ){
			return false;
		}

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
			$this->API->emit_json( false, 'No changes.');	
		}

	}

	public function delete()
	{
		$this->API->ajax_only();

		$house_id = $this->input->post( 'house_id' );
		if(empty($house_id)) return false;

		$delete = $this->house_model->delete( $house_id );

		if($delete){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: delete');	
		}

	}
}
