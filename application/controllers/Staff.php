<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

	private $permissions;

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'account_model' );
		$this->load->model( 'staff_model' );
		$this->load->library( 'API', NULL, 'API' );
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

	public function list()
	{
		$this->API->ajax_only();

		$list = $this->staff_model->list();

		$this->API->emit_json( $list );
	}

	public function list_view()
	{
		$data = array();
		$data['title'] = 'Staffs';
		$data['nav_staffs'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = array(
			'./scripts/deletion.js',
			'./scripts/staff.js'
		);

		$this->load->view( 'page-frame', $data );
		$this->load->view( 'staff', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function view( $staff_id="" )
	{
		// check if user logged in
		if(!$this->session->has_userdata('login_data')){
			redirect(base_url() . 'account/login', 'refresh');
		}

		$data = array();
		$data['title'] = 'Staff';
		$data['nav_staffs'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['staff'] = $this->staff_model->get_staff( $staff_id );

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'view_staff', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	// public function list_of_active_staff()
	// {
	// 	$this->API->ajax_only();

	// 	$this->SSP->table( 'staff' )
	// 	->column( 'user_id' )
	// 	->column( 'first_name' )
	// 	->column( 'last_name' )
	// 	->column( 'user_name' )
	// 	->column( 'user_modules' )
	// 	->column( 'user_type.name', 'user_type' )
	// 	->column( 'status.name', 'status_name' )
	// 	->join( 'user_type', 'user_type_id', 'user' )
	// 	->join( 'status', 'status_id', 'user' )
	// 	->where( 'status.status_id', 1 ) // active
	// 	->output();
	// }

	public function create_view()
	{
		$data = array();
		$data['title'] = 'Create Staff';
		$data['nav_staffs'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/create_staff.js';
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_staff', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create_staff_process()
	{
		
		$this->API->ajax_only();

		$first_name 		= $this->input->post('first_name');
		$last_name 			= $this->input->post('last_name');
		$full_name 			= $first_name . ' ' . $last_name;
		$address 			= $this->input->post('address');
		$contact_no 		= $this->input->post('contact_no');
		$gender 			= $this->input->post('gender');
		$birth_date 		= $this->input->post('birth_date');
		$start_date 		= $this->input->post('start_date');
		$daily_compensation = $this->input->post('daily_compensation');
		$daily_cola 		= $this->input->post('daily_cola');
		$job_description 	= $this->input->post('job_description');
		$sss 				= $this->input->post('sss');
		$pagibig 			= $this->input->post('pagibig');
		$tin 				= $this->input->post('tin');

		$create = $this->staff_model->create( $first_name, $last_name, $full_name, $address, $contact_no, $gender, $birth_date, $start_date, $daily_compensation, $daily_cola, $job_description, $sss, $pagibig, $tin );

		if($create){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
	}

	public function update_view($staff_id)
	{
		$data = array();
		$data['title'] = 'Update Staff';
		$data['nav_staffs'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['staff'] = $this->staff_model->get_staff( $staff_id );
		$data['script'] = './scripts/update_staff.js';
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'update_staff', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function update_staff_process()
	{

		$this->API->ajax_only();

		$staff_id 			= $this->input->post('staff_id');
		$first_name 		= $this->input->post('first_name');
		$last_name 			= $this->input->post('last_name');
		$full_name 			= $first_name . ' ' . $last_name;
		$address 			= $this->input->post('address');
		$contact_no 		= $this->input->post('contact_no');
		$gender 			= $this->input->post('gender');
		$birth_date 		= $this->input->post('birth_date');
		$start_date 		= $this->input->post('start_date');
		$daily_compensation = $this->input->post('daily_compensation');
		$daily_cola 		= $this->input->post('daily_cola');
		$job_description 	= $this->input->post('job_description');
		$sss 				= $this->input->post('sss');
		$pagibig 			= $this->input->post('pagibig');
		$tin 				= $this->input->post('tin');

		$update = $this->staff_model->update( $staff_id, $first_name, $last_name, $full_name, $address, $contact_no, $gender, $birth_date, $start_date, $daily_compensation, $daily_cola, $job_description, $sss, $pagibig, $tin );

		if($update){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( 'Nothing changed.' );
		}
	}

	public function delete_staff_process()
	{
		$this->API->ajax_only();

		$staff_id = $this->input->post('staff_id');

		$delete = $this->staff_model->delete( $staff_id );

		if($delete){
			$this->API->emit_json( true );
		}
		else{
			// error logs
			$this->API->emit_json( 'Error: delete' );
		}
	}

	public function search()
	{
		$search = $this->input->post( 'search' );

		$data = $this->staff_model->search( $search );
		
		$this->API->emit_json( $data );
	}
}
