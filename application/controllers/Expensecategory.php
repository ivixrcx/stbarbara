<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expensecategory extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'Expensecategory_model' );
		$this->load->model( 'account_model' );
		$this->load->library( 'API', NULL, 'API' );
		$this->load->library( 'UserAccess', array( $this ) );
		$this->API->auth_required();
		$this->useraccess->check_permissions();
	}

	public function index()
	{
		$this->list_view();
	}

	public function list_view()
	{
		$data = array();
		$data['title'] = 'Expense Category';
		$data['nav_expenses'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = array(
			'./scripts/deletion.js',
			'./scripts/expense-category.js'
		);
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'expense-category', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function lists()
	{
		$this->API->ajax_only();

		$data = $this->Expensecategory_model->lists();

		return $this->API->emit_json( $data );
	}

	public function list_ss()
	{
		$this->API->ajax_only();

		$this->Expensecategory_model->list_ss();
	}

	public function create_view()
	{
		$data = array();
		$data['title'] = 'Add Expense Category';
		$data['nav_expense'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/create_expense_category.js';
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_expense_category' );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create()
	{
		$this->API->ajax_only();

		$description = $this->input->post( 'description' );

		$create = $this->Expensecategory_model->create( $description );

		if($create){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
	}

	public function update_view( $expense_category_id )
	{
		$data = array();
		$data['title'] = 'Edit Expense';
		$data['nav_expense'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/update_expense_category.js';

		$get = $this->Expensecategory_model->get($expense_category_id);
		if(empty($get)) exit('No Data.');
		
		$data['expense_category_id'] = $get[0]->expense_category_id;
		$data['description'] = $get[0]->category_name;

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'update_expense_category', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function update()
	{
		$this->API->ajax_only();

		$expense_category_id	= $this->input->post( 'expense_category_id' );
		$description			= $this->input->post( 'description' );

		$update = $this->Expensecategory_model->update( $expense_category_id, $description );

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

		$expense_category_id = $this->input->post( 'expense_category_id' );
		if(empty($expense_category_id)) return false;

		$delete = $this->Expensecategory_model->delete( $expense_category_id );

		if($delete){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: delete');	
		}

	}
}
