<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'account_model' );
		$this->load->library( 'API', NULL, 'API' );
		// $this->api->auth_required();
	}

	public function index()
	{
		$loggedin = $this->session->userdata('login_data');

		if($loggedin){
			redirect(base_url() . 'home', 'refresh');
		}
		else{
			redirect('account/login', 'refresh');
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

	public function list_of_users()
	{

	}

	public function create_user_process()
	{
		/**
		* @return json
		*
		*/
		
	}

	public function update_user_process()
	{
		/**
		* @return json
		*
		*/
		
	}

	public function delete_user_process()
	{
		/**
		* @return json
		*
		*/
		
	}
}
