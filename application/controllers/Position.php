<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Position extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'position_model' );
        $this->load->model( 'account_model' );
		$this->load->model( 'usermodule_model' );        
		$this->load->library( 'API', NULL, 'API' );
		$this->load->library( 'UserAccess', array( $this ) );
		$this->useraccess->check_permissions();
	}

	public function index()
	{
		$this->list_view();
	}

	public function list_view()
	{
		$data = array();
		$data['title'] = 'Positions';
		$data['nav_positions'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = array('./scripts/deletion.js','./scripts/position.js');
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'position', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function list()
	{
		$this->API->ajax_only();

		$data = $this->position_model->list();

		return $this->API->emit_json( $data );
	}

	public function create_view()
	{
		$data = array();
		$data['title'] = 'Create Position';
		$data['nav_positions'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['usermodules'] = $this->usermodule_model->get_user_modules();
		$data['script'] = './scripts/create_position.js';
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_position' );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create()
	{
		$this->API->ajax_only();

		$name = $this->input->post( 'name' );
		$default_user_modules = $this->input->post( 'default_user_modules' );

		$create = $this->position_model->create( $name, $default_user_modules );

		if($create){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
	}

	public function update_view( $user_type_id="" )
	{
		if( !isset($user_type_id) ){
			redirect($_SERVER['HTTP_REFERER']);
		}

		$data = array();
		$data['title'] = 'Update Position';
		$data['nav_positions'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/update_position.js';
		$data['position'] = $this->position_model->get( $user_type_id );
		
		if( empty($data['position']) ){
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'update_position', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function update()
	{
		$this->API->ajax_only();

		$user_type_id = $this->input->post( 'user_type_id' );
		$name = $this->input->post( 'name' );

		$update = $this->position_model->update( $user_type_id, $name );

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

		$user_type_id = $this->input->post( 'user_type_id' );
		if(empty($user_type_id)) return false;

		$delete = $this->position_model->delete( $user_type_id );

		if($delete){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: delete');	
		}

	}

	public function view( $user_type_id="" )
	{
		if( !isset($user_type_id) ){
			redirect($_SERVER['HTTP_REFERER']);
		}

		$data = array();
		$data['nav_positions'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['user_type_id'] = $user_type_id;

		$data['permissions'] = $this->position_model->get_permissions( $user_type_id );
		$data['users'] = $this->position_model->get_users( $user_type_id );
		$data['position'] = $this->position_model->get( $user_type_id );

		if( empty($data['position']) ){
			redirect($_SERVER['HTTP_REFERER']);
		}

		$data['title'] = ucwords($data['position'][0]->name);

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'view_position', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function update_permissions_view( $user_type_id="" )
	{
		if( !isset($user_type_id) ){
			redirect($_SERVER['HTTP_REFERER']);
		}

		$data = array();
		$data['nav_positions'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['user_type_id'] = $user_type_id;
		$data['usermodules'] = $this->usermodule_model->get_user_modules();
		$data['permissions'] = $this->position_model->get_permissions( $user_type_id );
		$data['users'] = $this->position_model->get_users( $user_type_id );
		$data['position'] = $this->position_model->get( $user_type_id );

		if( empty($data['position']) ){
			redirect($_SERVER['HTTP_REFERER']);
		}

		$data['title'] = 'Modify ' . ucwords($data['position'][0]->name) . '  Default Permissions';
		$data['script'] = './scripts/update_position_permissions.js';

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'update_position_permissions', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function get_permissions()
	{
		$this->API->ajax_only();
		
		$user_type_id = $this->input->post( 'user_type_id', TRUE );
		
		if( empty($user_type_id) ){
			redirect($_SERVER['HTTP_REFERER']);
		}

		$permissions = $this->position_model->get_permissions( $user_type_id );

		$this->API->emit_json( $permissions );
	}

	public function update_permissions()
	{
		$this->API->ajax_only();
		
		$user_type_id = $this->input->post( 'user_type_id', TRUE );
		$user_modules = $this->input->post( 'user_modules', TRUE );
		
		if( empty($user_type_id) ||  empty($user_modules) ){
			redirect($_SERVER['HTTP_REFERER']);
		}

		$update = $this->position_model->update_permissions( $user_type_id, $user_modules );

		if( $update ){
			$this->API->emit_json( $update );
		}
		else{
			$this->API->emit_json( false, 'Error: update_permissions' );
		}
	}
}
