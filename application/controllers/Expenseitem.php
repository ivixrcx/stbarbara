<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenseitem extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'Expenseitem_model' );
		$this->load->model( 'account_model' );
		$this->load->library( 'API', NULL, 'API' );
		// $this->load->library( 'UserAccess', array( $this ) );
		// $this->API->auth_required();
		// $this->useraccess->check_permissions();
	}

	public function index()
	{
		$this->list_view();
	}

	public function list_view()
	{
		$data = array();
		$data['title'] = 'Expense Items';
		$data['nav_expenses'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = array(
			'./scripts/deletion.js',
			'./scripts/expense_item.js'
		);
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'expense-item', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function list()
	{
		$this->API->ajax_only();

		$data = $this->Expenseitem_model->list();

		return $this->API->emit_json( $data );
	}

	public function list_ssp()
	{
		$this->API->ajax_only();

		$this->SSP->table( 'expense_item' )
		->column( 'expense_item.expense_item_id' )
		->column( 'expense_item.description' )
		->column( 'expense_category.description', 'category' )
		->join( 'expense_category', 'expense_category.expense_category_id=expense_item.expense_category_id','left' )
		->where( 'expense_item.status_id', 1 ) // active
		->output();
	}


	public function list_by_category($id)
	{
		$this->API->ajax_only();

		$data = $this->Expenseitem_model->list_by_category($id);

		return $this->API->emit_json( $data );
	}

	public function create_view()
	{
		$data = array();
		$data['title'] = 'Add Expense Item';
		$data['nav_expense'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/create_expense_item.js';
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_expense_item' );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create()
	{
		$categoryId = $this->input->post( 'categoryId' );
		$item  		= $this->input->post( 'item' );

		$create = $this->Expenseitem_model->create( $categoryId, $item);

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
		$data['title'] = 'Edit Expense Item';
		$data['nav_expense'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = './scripts/update_expense_item.js';

		$get = $this->Expenseitem_model->get($id);
		if(empty($get)) exit('No Data.');
		
		$data['expense_item_id'] = $get[0]->expense_item_id;
		$data['category'] = $get[0]->category;
		$data['description'] = $get[0]->description;

		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'update_expense_item', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function update()
	{
		$this->API->ajax_only();

		$expense_item_id	= $this->input->post( 'expense_item_id' );
		$description		= $this->input->post( 'description' );

		$update = $this->Expenseitem_model->update( $expense_item_id, $description );

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

		$expense_item_id = $this->input->post( 'expense_item_id' );
		if(empty($expense_item_id)) return false;

		$delete = $this->Expenseitem_model->delete( $expense_item_id );

		if($delete){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: delete');	
		}

	}
}
