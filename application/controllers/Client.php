<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

	private $permissions;

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'account_model' );
		$this->load->model( 'client_model' );
		$this->load->library( 'API', NULL, 'API' );
		$this->load->library( 'dompdf/Dompdf_api', '', 'dompdf' );
		$this->load->library( 'UserAccess', array( $this ) );
		// // default permissions
		
		// // check permissions onload
		$this->useraccess->check_permissions();
	}

	public function index()
	{
		// check if user logged in
		if(!$this->session->has_userdata('login_data')){
			redirect(base_url() . 'account/login', 'refresh');
		}

		$this->list_view();
    }

	public function lists()
	{
		$this->API->ajax_only();

		$list = $this->client_model->list();

		$this->API->emit_json( $list );
	}

	public function list_ss()
	{
		$this->API->ajax_only();

		$list = $this->client_model->list_ss();
	}

	public function list_view()
	{
		$data = array();
		$data['title'] = 'Client';
		$data['nav_clients'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = array(
			'./scripts/deletion.js',
			'./scripts/client.js'
		);

		$this->load->view( 'page-frame', $data );
		$this->load->view( 'client', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function view( $client_id )
	{
		$data = array();
		$data['title'] = 'Client Details';
		$data['nav_clients'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['client'] = $this->client_model->get($client_id);
		$data['spouse'] = $this->client_model->get_spouse($client_id);
		$data['client_id'] = $client_id;
		$data['script'] = array(
			'./scripts/deletion.js'
		);

		$this->load->view( 'page-frame', $data );
		$this->load->view( 'view_client', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create_view()
	{
		$data = array();
		$data['title'] = 'Add Client';
		$data['nav_clients'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/create_client.js';
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_client' );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create_process()
	{
		$this->API->ajax_only();

        // Personal Details
		$last_name = $this->input->post('last_name');
		$first_name = $this->input->post('first_name');
		$middle_name = $this->input->post('middle_name');
		$birth_date = $this->input->post('birth_date');
		$birth_place = $this->input->post('birth_place');
		$gender = $this->input->post('gender');
		$civil_status = $this->input->post('civil_status');
		$religion = $this->input->post('religion');
		$nationality = $this->input->post('nationality');
		$tin = $this->input->post('tin');
		$sss = $this->input->post('sss');
		$pagibig = $this->input->post('pagibig');
		$drivers_license = $this->input->post('drivers_license');
		$occupation = $this->input->post('occupation');

        // Spouse Details
		$spouse_last_name = $this->input->post('spouse_last_name');
		$spouse_first_name = $this->input->post('spouse_first_name');
		$spouse_middle_name = $this->input->post('spouse_middle_name');
		$spouse_birth_date = $this->input->post('spouse_birth_date');
		$spouse_birth_place = $this->input->post('spouse_birth_place');
		$spouse_occupation = $this->input->post('spouse_occupation');
		$spouse_nationality = $this->input->post('spouse_nationality');
		$spouse_sss = $this->input->post('spouse_sss');
		$spouse_tin = $this->input->post('spouse_tin');
		$spouse_pagibig = $this->input->post('spouse_pagibig');
		$spouse_drivers_license = $this->input->post('spouse_drivers_license');
		$spouse_id_name = $this->input->post('spouse_id_name');
		$spouse_id_no = $this->input->post('spouse_id_no');
		$spouse_id_date_issued = $this->input->post('spouse_id_date_issued');
		$spouse_id_place_issued = $this->input->post('spouse_id_place_issued');

        // Contact Information
		$residence_address = $this->input->post('residence_address');
		$provincial_address = $this->input->post('provincial_address');
		$landline_no = $this->input->post('landline_no');
		$cellphone_no = $this->input->post('cellphone_no');
		$email = $this->input->post('email');

		$create = $this->client_model->create( $last_name, $first_name, $middle_name, $birth_date, $birth_place, $gender, $civil_status, $religion, $nationality, $tin, $sss, $pagibig, $drivers_license, $occupation, $spouse_last_name, $spouse_first_name, $spouse_middle_name, $spouse_birth_date, $spouse_birth_place, $spouse_occupation, $spouse_nationality, $spouse_sss, $spouse_tin, $spouse_pagibig, $spouse_drivers_license, $spouse_id_name, $spouse_id_no, $spouse_id_date_issued, $spouse_id_place_issued, $residence_address, $provincial_address, $landline_no, $cellphone_no, $email );
		if($create){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
	}

	public function update_view($client_id)
	{
		$data = array();
		$data['title'] = 'Update Client';
		$data['nav_clients'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['client'] = $this->client_model->get($client_id);
		$data['script'] = './scripts/update_client.js';
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'update_client', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function update_process()
	{
		$this->API->ajax_only();

		$client_id = $this->input->post('client_id');

		$update = $this->client_model->update( $client_id );

		if($update){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( 'Nothing changed.' );
		}
	}

	public function delete()
	{		
		$this->API->ajax_only();

		$client_id = $this->input->post('client_id');

		$delete = $this->client_model->delete( $client_id );

		if($delete){
			$this->API->emit_json( true );
		}
		else{
			// error logs
			$this->API->emit_json( 'Error: delete' );
		}
	}
}
