<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	private $permissions;

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'account_model' );
		$this->load->model( 'usermodule_model' );
		$this->load->library( 'API', NULL, 'API' );
		$this->load->library( 'UserAccess', array( $this ) );
		// default permissions
		$this->useraccess->set_permission('account/index');
		$this->useraccess->set_permission('account/login');
		$this->useraccess->set_permission('account/login_process');
		$this->useraccess->set_permission('account/logout');
		$this->useraccess->set_permission('account/get_session_permissions');
		$this->useraccess->set_permission('account/list_of_user_types');
		// check permissions onload
		$this->useraccess->check_permissions();
	}

	public function index()
	{
		$loggedin = $this->session->userdata('login_data');
		if(empty($loggedin)){
			$this->login();
		}
		else{
			redirect(base_url() . 'home/', 'refresh');
		}
	}

	// default login page
	public function login()
	{
		$this->load->view('login');
	}

	// process login
	public function login_process()
	{
		$this->API->ajax_only();

		$user_name 	= $this->input->post('user_name', true);
		$password 	= $this->input->post('password', true);

		$auth_login = 	$this->account_model->auth_login($user_name, $password);
		if(empty($auth_login->data)){
			// login failed
			$this->API->emit_json( false );
		}
		else{
			// login success
			$user_data = $this->account_model->current_user_data();
			
			// permission section
			$pluck_modules = explode( ',', $user_data->user_modules ); 

			$permissions = $this->usermodule_model->get_user_permissions( $pluck_modules );

			$this->register_permissions( $permissions );

			$this->session->set_userdata('login_data', $user_data);
			$this->API->emit_json( [ 'user_data'=>$user_data, 'modules'=>$this->permissions ] );
		}
	}

	public function get_session_permissions()
	{
		$this->API->ajax_only();
		$this->API->auth_required();
		$this->API->emit_json( $this->useraccess->get_session_permissions() );
		
	}

	/**
	 * @return 	void
	 */
	protected function register_permissions( $permissions )
	{
		$modules = [];
		foreach( $permissions as $permission ){
			//shorten variable
			$module_link = $permission->user_module_link;
			// if it has comma ',' then pluck
			if( strpos( $module_link, ',' ) !== false ){
				$_module_links = explode( ',', $module_link );
				foreach($_module_links as $_module_link) $modules[] = trim($_module_link);
			}
			else{
				$modules[] = $permission->user_module_link;
			}
		}

		$this->permissions = $modules;
		$this->useraccess->set_permission( $modules );
	}

	public function logout()
	{
		// unset session of login
		$this->session->unset_userdata('login_data');

		// unset session of User Permissions
		$this->useraccess->unset_permission();

		// redirect to login page
		redirect(base_url() . 'login', 'refresh');
	}

	public function list( $user_type_id, $status_id, $sort="asc" )
	{
		$this->API->ajax_only();

		$list = $this->account_model->list( $user_type_id, $status_id, $sort );

		$this->API->emit_json( $list );
	}

	public function users()
	{
		// check if user logged in
		if(!$this->session->has_userdata('login_data')){
			redirect(base_url() . 'account/login', 'refresh');
		}

		$data = array();
		$data['title'] = 'Users';
		$data['nav_users'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/user.js';

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'user', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function get_user_view( $user_id )
	{
		// check if user logged in
		if(!$this->session->has_userdata('login_data')){
			redirect(base_url() . 'account/login', 'refresh');
		}

		$data = array();
		$data['title'] = 'Account';
		$data['nav_users'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['user'] = $this->account_model->get_user( $user_id );
		$data['usermodules'] = $this->usermodule_model->get_user_modules( $user_id );
		$data['user_id'] = $user_id;

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'get_user', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function list_of_active_users()
	{
		$this->API->ajax_only();

		$this->SSP->table( 'user' )
		->column( 'user_id' )
		->column( 'first_name' )
		->column( 'last_name' )
		->column( 'user_name' )
		->column( 'user_modules' )
		->column( 'user_type.name', 'user_type' )
		->column( 'status.name', 'status_name' )
		->join( 'user_type', 'user_type_id', 'user' )
		->join( 'status', 'status_id', 'user' )
		->where( 'status.status_id', 1 ) // active
		->output();
	}

	public function create_user_view()
	{
		$data = array();
		$data['title'] = 'Create User';
		$data['nav_users'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/create_user.js';
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_user', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create_user_process()
	{
		
		$this->API->ajax_only();

		$first_name 	= $this->input->post('first_name');
		$last_name 		= $this->input->post('last_name');
		$user_name 		= $this->input->post('user_name');
		$password 		= $this->input->post('password');
		$user_type_id 	= $this->input->post('user_role');
		$full_name 		= $first_name . ' ' . $last_name;

		$is_taken = $this->account_model->check_user_name($user_name);

		// check if user_name if taken 
		if($is_taken){
			$this->API->emit_json( false, 'Username has been taken.' );
		}
		else{
			$user_id = $this->account_model->create_user( $first_name, $last_name,$full_name, $user_name, $password, $user_type_id );
			$this->account_model->apply_default_user_modules( $user_id, $user_type_id );
			$this->API->emit_json( true );
		}		
	}

	public function update_user_process()
	{

		$this->API->ajax_only();

		$user_id 		= $this->input->post('user_id');
		$first_name 	= $this->input->post('first_name');
		$last_name 		= $this->input->post('last_name');
		$user_name 		= $this->input->post('user_name');
		$password 		= $this->input->post('password');
		$user_type_id 	= $this->input->post('user_role');
		$full_name 		= $first_name . ' ' . $last_name;

		$update = $this->account_model->update_user( $first_name, $last_name, $full_name, $user_name, $password, $user_type_id );

		if($update){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( 'Nothing changed.' );
		}
	}

	public function delete_user_process()
	{		
		$this->API->ajax_only();

		$user_id = $this->input->post('user_id');

		$delete = $this->account_model->delete_user( $user_id );

		if($delete){
			$this->API->emit_json( true );
		}
		else{
			// error logs
			$this->API->emit_json( 'Error: delete' );
		}
	}

	public function list_of_user_types()
	{
		$list = $this->account_model->list_of_user_types();
		$this->API->emit_json( $list );
	}
}
