<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermodulecategory extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'usermodulecategory_model' );
		$this->load->model( 'account_model' );
		$this->load->library( 'API', NULL, 'API' );
		$this->load->library( 'UserAccess', array( $this ) );
		// $this->useraccess->check_permissions();
	}

	public function index()
	{
		$this->list_view();
	}

	public function list_view()
	{
		$data = array();
		$data['title'] = 'User Module Categories';
		$data['nav_usermodule'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/usermodule_category.js';
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'usermodule_category', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function list()
	{
		$this->API->ajax_only();

		$data = $this->usermodulecategory_model->list();

		return $this->API->emit_json( $data );
    }

	public function create_view()
	{
		$data = array();
		$data['title'] = 'Create Module Category';
		$data['nav_usermodule'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/create_usermodule_category.js';
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_usermodule_category', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create()
	{
		$this->API->ajax_only();

		$user_module_category_name = $this->input->post( 'user_module_category_name' );

		$create = $this->usermodulecategory_model->create( $user_module_category_name );

		if($create){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
	}

	public function update_view( $user_module_category_id )
	{
		$data = array();
		$data['title'] = 'Update Module Category';
		$data['nav_module'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/update_usermodule_category.js';
		$data['category'] = $this->usermodulecategory_model->get( $user_module_category_id );

		// display nothing if no data found for now
		if( count($data['category']) == 0 ){
			return false;
		}

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'update_usermodule_category', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function update()
	{
		$this->API->ajax_only();

		$user_module_category_id  = $this->input->post( 'user_module_category_id' );
		$user_module_category_name = $this->input->post( 'user_module_category_name' );
		
		$update = $this->usermodulecategory_model->update( $user_module_category_id, $user_module_category_name );
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

		$user_module_category_id = $this->input->post( 'user_module_category_id' );
		if(empty($user_module_category_id)) return false;

		$delete = $this->usermodulecategory_model->delete( $user_module_category_id );

		if($delete){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: delete');	
		}

	}
}
