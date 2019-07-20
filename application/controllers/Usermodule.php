<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermodule extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'usermodule_model' );
		$this->load->model( 'usermodulecategory_model' );
		$this->load->model( 'account_model' );
		$this->load->library( 'API', NULL, 'API' );
		$this->load->library( 'UserAccess', array( $this ) );
		// header('content-type: application/json');
		// print_r($this->router->class . '/' . $this->router->method);exit;
	}

	public function index()
	{
		$this->list_view();
	}

	public function list_view( $user_module_category_id )
	{
		$this->usermodulecategory_model->update_module_count($user_module_category_id);
		$category = $this->usermodulecategory_model->list( $user_module_category_id );

		$data = array();
		$data['title'] = 'User Modules of "' . trim($category[0]->user_module_category_name) . '" category';
		$data['nav_usermodule'] = 'active';
		$data['login_data'] = $this->session->userdata( 'login_data' );
		$data['script'] = './scripts/usermodule.js';
		$data['user_module_category_id'] = $user_module_category_id;
		
		$this->load->view( 'page-frame', $data );
		$this->load->view( 'usermodule', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function list()
	{
		$this->API->ajax_only();

		$user_module_category_id  = $this->input->post( 'user_module_category_id' );

		$data = $this->usermodule_model->list( $user_module_category_id );

		return $this->API->emit_json( $data );
    }

	public function create_view( $user_module_category_id )
	{
		$category = $this->usermodulecategory_model->list( $user_module_category_id );

		$data = array();
		$data['title'] = 'Create Module for "' . trim($category[0]->user_module_category_name) . '" category';
		$data['nav_usermodule'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/create_usermodule.js';
		$data["user_module_category_id"] = $user_module_category_id;
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_usermodule', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create()
	{
		$this->API->ajax_only();

		$user_module_name = $this->input->post( 'user_module_name' );
		$user_module_category_id  = $this->input->post( 'user_module_category_id' );

		$create = $this->usermodule_model->create( $user_module_name, $user_module_category_id );

		// update module count 
		$this->usermodulecategory_model->update_module_count( $user_module_category_id );

		if($create){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
	}

	public function update_view( $user_module_id )
	{
		$data = array();
		$data['title'] = 'Update User Module';
		$data['nav_module'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/update_usermodule.js';
		$data['user_module_id'] = $user_module_id;
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'update_usermodule', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function update()
	{
		$this->API->ajax_only();

		$user_module_id  = $this->input->post( 'user_module_id' );
		$user_module_name = $this->input->post( 'user_module_name' );
		$user_module_category_id = $this->input->post( 'user_module_category_id' );

		$update = $this->usermodule_model->update( $user_module_id, $user_module_name, $user_module_category_id );

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

		$user_module_id = $this->input->post( 'user_module_id' );
		if(empty($user_module_id)) return false;

		$delete = $this->usermodule_model->delete( $user_module_id );
		
		// update module count 
		// $this->usermodulecategory_model->update_module_count( $user_module_category_id );

		if($delete){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: delete');	
		}

	}
}