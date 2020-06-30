<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materialcategory extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'materialcategory_model' );
		$this->load->model( 'account_model' );
		$this->load->library( 'API', NULL, 'API' );
		// $this->load->library( 'UserAccess', array( $this ) );
		// $this->API->auth_required();
		// $this->useraccess->check_permissions();
	}
    
    public function list()
    {
        $this->API->ajax_only();

        $list = $this->materialcategory_model->list();

        $this->API->emit_json( $list );   
	}
	
	public function index()
	{
		$this->list_view();
	}

	public function search()
	{
		$search = $this->input->post( 'search' );

		$data = $this->material_model->search( $search );
		
		$this->API->emit_json( $data );
	}

	public function search_particular_unit()
	{
		$particular = $this->input->post( 'particular', true );
		$priority_level = $this->input->post( 'priority_level', true );

		$data = $this->materialcategory_model->search_particular_unit( $particular, $priority_level );
		
		$this->API->emit_json( $data );
	}

	public function list_view()
	{
		$data = array();
		$data['title'] = 'Materials';
		$data['nav_materials'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = array(
			'./scripts/deletion.js',
			'./scripts/material_category.js'
		);

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'material_category', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function get()
	{
		$material_category_id = $this->input->post( 'material_category_id', true );

		$data = $this->materialcategory_model->get( $material_category_id );
		
		$this->API->emit_json( $data );
	}

	public function create_view()
	{
		$data = array();
		$data['title'] = 'Create Material';
		$data['nav_materials'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/create_material_category.js';
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_material_category' );
		$this->load->view( 'page-frame-footer', $data );
	}
	
	public function create()
	{
		$this->API->ajax_only();

		$particular			= $this->input->post( 'particular', true );
		$priority_level  	= $this->input->post( 'priority_level', true );

		$create = $this->materialcategory_model->create( $particular, $priority_level );

		if($create){
			$this->API->emit_json( $create );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
	}

	public function update_view( $material_category_id )
	{
		$data = array();
		$data['title'] = 'Update Material Category';
		$data['nav_materials'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/update_material_category.js';

		$get = $this->materialcategory_model->get($material_category_id);
		if(empty($get)) exit('No Data.');
		
		$data['material_category_id'] = $get[0]->material_category_id;
		$data['particular'] = $get[0]->particular;
		$data['priority_level'] = $get[0]->priority_level;

		$this->load->view( 'page-frame', $data );
		$this->load->view( 'update_material_category', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function update()
	{
		$this->API->ajax_only();

		$material_category_id = $this->input->post( 'material_category_id' );
		$particular  	= $this->input->post( 'particular' );
		$priority_level = $this->input->post( 'priority_level' );

		if( empty($material_category_id) || empty($particular) || empty($priority_level) ){
			return false;
		}

		$update = $this->materialcategory_model->update( $material_category_id, $particular, $priority_level );

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

		$material_category_id = $this->input->post( 'material_category_id' );
		if(empty($material_category_id)) return false;

		$delete = $this->materialcategory_model->delete( $material_category_id );

		if($delete){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: delete');	
		}

	}
}
