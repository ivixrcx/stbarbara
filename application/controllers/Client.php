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

	public function list()
	{
		$this->API->ajax_only();

		$list = $this->client_model->list();

		$this->API->emit_json( $list );
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

	public function client_view( $client_id )
	{
		$data = array();
		$data['title'] = 'Client Details';
		$data['nav_clients'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['client'] = $this->client_model->get($client_id);
		$data['client_id'] = $client_id;
		$data['script'] = array(
			'./scripts/client_view.js',
			'./scripts/deletion.js'
		);

		$this->load->view( 'page-frame', $data );
		$this->load->view( 'client_view', $data );
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

		// $staff_id = $this->input->post('staff_id');
		// $paydate = $this->input->post('paydate');
		// $no_of_days = $this->input->post('no_of_days');
		// $note = $this->input->post('note');
		// $project_id = $this->input->post('project_id');

		// $staff = $this->staff_model->get_staff($staff_id);
		// $daily_compensation = $staff[0]->daily_compensation;
		// $basepay = $daily_compensation * $no_of_days;
		// $net_pay = $basepay;

		// $create = $this->client_model->create( $staff_id, $project_id, $paydate, $daily_compensation, $no_of_days, $basepay, $net_pay, $note );
        $create = '';

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
