<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'expense_model' );
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
		$data['title'] = 'Expenses';
		$data['nav_expenses'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = array(
			'./scripts/deletion.js',
			'./scripts/expense.js'
		);
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'expense', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function list()
	{
		$this->API->ajax_only();

		$data = $this->expense_model->list_ss();
	}

	public function create_view()
	{
		$data = array();
		$data['title'] = 'Add Expense';
		$data['nav_expense'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = array(
			'./scripts/deletion.js',
			'./scripts/create_expense.js'
		);
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_expense' );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create()
	{
		$this->API->ajax_only();

		print_r($_POST);exit;

		$project_id  	= $this->input->post( 'project_id' );
		$project_name  	= $this->input->post( 'project' );
		$category_id  	= $this->input->post( 'category_id' );
		$category_name	= $this->input->post( 'category' );
		$item_id  		= $this->input->post( 'item_id' );
		$item_name		= $this->input->post( 'item' );
		$description 	= $this->input->post( 'description' );
		$note 			= $this->input->post( 'note' );

		$create = $this->expense_model->create( $project_id, $project_name, $category_id, $category_name, $item_id, $item_name, $description, $note );

		if($create){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
	}

	public function update_view( $id )
	{
		$data = array();
		$data['title'] = 'Edit Expense';
		$data['nav_expense'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/update_expense.js';
		$data['expense'] = $this->expense_model->get( $id );

		// display nothing if no data found for now
		if( count($data['expense']) == 0 ){
			return false;
		}

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'update_expense', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function update()
	{
		$this->API->ajax_only();

		$expenseId		= $this->input->post( 'expenseId' );
		$description	= $this->input->post( 'description' );
		$amount			= $this->input->post( 'amount' );

		$update = $this->expense_model->update( $expenseId, $description, $amount );

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

		$expense_id = $this->input->post( 'expense_id' );
		if(empty($expense_id)) return false;

		$delete = $this->expense_model->delete( $expense_id );

		if($delete){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: delete');	
		}

	}
}
