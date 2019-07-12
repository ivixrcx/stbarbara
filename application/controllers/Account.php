<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'account_model' );
		$this->load->library( 'API', NULL, 'API' );
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

		$user_name 	= $this->input->post('user_name');
		$password 	= $this->input->post('password');

		$auth_login = 	$this->account_model->auth_login($user_name, $password);

		if(empty($auth_login->data)){
			$this->API->emit_json( false );
		}
		else{
			$user_data = $this->account_model->current_user_data();
			$this->session->set_userdata('login_data', $user_data);
			$this->API->emit_json( true );
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('login_data');
		redirect(base_url() . 'account/login', 'refresh');
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

		$this->load->view( 'page-header', $data );
		$this->load->view( 'page-navbar', $data );
		$this->load->view( 'page-title', $data  );
		$this->load->view( 'user' );
		$this->load->view( 'page-footer', $data );
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

		$this->load->view( 'page-header', $data );
		$this->load->view( 'page-navbar', $data );
		$this->load->view( 'page-title', $data  );
		$this->load->view( 'create_user', $data );
		$this->load->view( 'page-footer', $data );
	}

	public function create_user_process()
	{
		/**
		* @return json
		*
		*/

		$this->API->ajax_only();

		$first_name 	= $this->input->post('first_name');
		$last_name 		= $this->input->post('last_name');
		$user_name 		= $this->input->post('user_name');
		$password 		= $this->input->post('password');
		$user_type_id 	= $this->input->post('user_role');

		$is_taken = $this->account_model->check_user_name($user_name);

		// check if user_name if taken 
		if($is_taken){
			$this->API->emit_json( false, 'Username has been taken.' );
		}
		else{
			$insert = $this->account_model->create_user( $first_name, $last_name, $user_name, $password, $user_type_id );

			if($insert){
				$this->API->emit_json( true );
			}
			else{
				// error logs
				$this->API->emit_json( 'Error: insert' );
			}
		}		
	}

	public function update_user_process()
	{
		/**
		* @return json
		*
		*/

		$this->API->ajax_only();

		$user_id 		= $this->input->post('user_id');
		$first_name 	= $this->input->post('first_name');
		$last_name 		= $this->input->post('last_name');
		$user_name 		= $this->input->post('user_name');
		$password 		= $this->input->post('password');
		$user_type_id 	= $this->input->post('user_role');

		$update = $this->account_model->update_user( $first_name, $last_name, $user_name, $password, $user_type_id );

		if($update){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( 'Nothing changed.' );
		}
	}

	public function delete_user_process()
	{
		/**
		* @return json
		*
		*/
		
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