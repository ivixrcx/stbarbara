<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'project_model' );
		$this->load->model( 'account_model' );
		$this->load->library( 'API', NULL, 'API' );
	}

	public function index()
	{
		$this->list_view();
	}

	public function list_view()
	{
		$data = array();
		$data['title'] = 'Projects';
		$data['nav_projects'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/project.js';

		$this->load->view( 'page-header', $data );
		$this->load->view( 'page-navbar', $data );
		$this->load->view( 'page-title', $data  );
		$this->load->view( 'project', $data );
		$this->load->view( 'page-footer', $data );
	}

	public function list()
	{
		$this->API->ajax_only();

		$data = $this->project_model->list();

		return $this->API->emit_json( $data );
	}

	public function get_project_view( $project_id ) 
	{

	}

	public function get_project( $project_id )
	{
		$this->API->ajax_only();

	}

	public function create_view()
	{
		$data = array();
		$data['title'] = 'Create Project';
		$data['nav_projects'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/create_project.js';

		$this->load->view( 'page-header', $data );
		$this->load->view( 'page-navbar', $data );
		$this->load->view( 'page-title', $data  );
		$this->load->view( 'create_project' );
		$this->load->view( 'page-footer', $data );
	}

	public function create()
	{
		$this->API->ajax_only();

		$name 		 = $this->input->post( 'name' );
		$total_area  = $this->input->post( 'total_area' );
		$total_units = $this->input->post( 'total_units' );
		$location  	 = $this->input->post( 'location' );

		$create = $this->project_model->create( $name, $total_area, $total_units, $location);

		if($create){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
	}

	public function update_view( $project_id )
	{
		$data = array();
		$data['title'] = 'Update Project';
		$data['nav_projects'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/update_project.js';

		$this->load->view( 'page-header', $data );
		$this->load->view( 'page-navbar', $data );
		$this->load->view( 'page-title', $data  );
		$this->load->view( 'update_project' );
		$this->load->view( 'page-footer', $data );
	}

	public function update()
	{
		$this->API->ajax_only();

		$project_id  = $this->input->post( 'project_id' );
		$name 		 = $this->input->post( 'name' );
		$total_area  = $this->input->post( 'total_area' );
		$total_units = $this->input->post( 'total_units' );
		$location  	 = $this->input->post( 'location' );

		$update = $this->project_model->update( $project_id, $name, $total_area, $total_units, $location );

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

		$project_id = $this->input->post( 'project_id' );
		if(empty($project_id)) return false;

		$delete = $this->project_model->delete( $project_id );

		if($delete){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: delete');	
		}

	}
}
