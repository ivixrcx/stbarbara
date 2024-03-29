<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends CI_Controller {

	private $permissions;

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'payment_model' );
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

	public function list_staff()
	{
		$this->API->ajax_only();

		$list = $this->staff_model->lists();

		$this->API->emit_json( $list );
	}

	public function lists()
	{
		$this->API->ajax_only();

		$staff_id = $_POST['staff_id'];

		$this->payroll_model->lists($staff_id);
	}

	public function list_ss()
	{
		$this->API->ajax_only();

		$staff_id = $_POST['staff_id'];

		$this->payroll_model->list_ss($staff_id);
	}

	public function list_view()
	{
		$data = array();
		$data['title'] = 'Payroll';
		$data['nav_payroll'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['script'] = array(
			'./scripts/deletion.js',
			'./scripts/payroll.js'
		);

		$this->load->view( 'page-frame', $data );
		$this->load->view( 'payroll', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function payroll_list_view( $staff_id )
	{
		$data = array();
		$data['title'] = 'Payroll';
		$data['nav_payroll'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['cash_advance'] = $this->payroll_model->get_cash_advance( $staff_id );
		$total_cash_advance = $this->payroll_model->get_total_cash_advance( $staff_id )[0]->total;
		$ca_paid= $this->payroll_model->get_deducted_cash_advance( $staff_id )[0]->ca_paid;
		$data['total_cash_advance'] = $total_cash_advance;
		$data['ca_balance'] = intval($total_cash_advance) - intval($ca_paid);
		$data['staff_id'] = $staff_id;
		$data['script'] = array(
			'./scripts/deletion.js',
			'./scripts/payroll_list.js',
			'./scripts/payroll_cash_advance_list.js'
		);

		$this->load->view( 'page-frame', $data );
		$this->load->view( 'payroll_list', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function payroll_details_view( $payroll_id )
	{
		$data = array();
		$data['title'] = 'Payroll Details';
		$data['nav_payroll'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['payroll'] = $this->payroll_model->get_payroll($payroll_id);
		$data['additionals'] = $this->payroll_model->get_payroll_additionals($payroll_id);
		$data['deductions'] = $this->payroll_model->get_payroll_deductions($payroll_id);
		$data['payroll_id'] = $payroll_id;
		$data['script'] = array(
			'./scripts/payroll_view.js',
			'./scripts/deletion.js'
		);

		$this->load->view( 'page-frame', $data );
		$this->load->view( 'payroll_view', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function get_payroll_additionals($payroll_id)
	{
		$this->API->ajax_only();

		$list = $this->payroll_model->get_payroll_additionals($payroll_id);

		$this->API->emit_json( $list );
	}

	public function get_payroll_deductions($payroll_id)
	{
		$this->API->ajax_only();

		$list = $this->payroll_model->get_payroll_deductions($payroll_id);

		$this->API->emit_json( $list );
	}
    
	public function create_view($staff_id)
	{
		$data = array();
		$data['title'] = 'Create Payroll';
		$data['nav_payroll'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['staff_id'] = $staff_id;
		$data['staff'] = $this->staff_model->get_staff($staff_id);
		$data['projects'] = $this->project_model->lists();
		$data['script'] = './scripts/create_payroll.js';
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_payroll', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create_payroll_process()
	{
		$this->API->ajax_only();

		$staff_id = $this->input->post('staff_id');
		$paydate = $this->input->post('paydate');
		$no_of_days = $this->input->post('no_of_days');
		$note = $this->input->post('note');
		$project_id = $this->input->post('project_id');

		$staff = $this->staff_model->get_staff($staff_id);
		$daily_compensation = $staff[0]->daily_compensation;
		$basepay = $daily_compensation * $no_of_days;
		$net_pay = $basepay;

		$create = $this->payroll_model->create( $staff_id, $project_id, $paydate, $daily_compensation, $no_of_days, $basepay, $net_pay, $note );

		if($create){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
	}

	public function delete()
	{		
		$this->API->ajax_only();

		$payroll_id = $this->input->post('payroll_id');

		$delete = $this->payroll_model->delete_payroll( $payroll_id );

		if($delete){
			$this->API->emit_json( true );
		}
		else{
			// error logs
			$this->API->emit_json( 'Error: delete' );
		}
	}
    
	public function create_addition_view($payroll_id)
	{
		$data = array();
		$data['title'] = 'Additional';
		$data['nav_payroll'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['payroll_id'] = $payroll_id;
		$data['script'] = './scripts/create_payroll_additional.js';
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_payroll_additional', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create_payroll_additional_process()
	{
		$this->API->ajax_only();

		$payroll_id = $this->input->post('payroll_id');
		$type_id = $this->input->post('type_id');
		$date = $this->input->post('date');
		$amount = $this->input->post('amount');
		$note = $this->input->post('note');

		$create = $this->payroll_model->create_additional( $payroll_id, $type_id, $date, $amount, $note );

		if($create){
			$this->compute_payroll($payroll_id);
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
	}
    
	public function create_deduction_view($payroll_id)
	{
		$data = array();
		$data['title'] = 'Deduction';
		$data['nav_payroll'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['payroll_id'] = $payroll_id;
		$data['script'] = './scripts/create_payroll_deduction.js';
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_payroll_deduction', $data );
		$this->load->view( 'page-frame-footer', $data );
	}

	public function create_payroll_deduction_process()
	{
		$this->API->ajax_only();

		$payroll_id = $this->input->post('payroll_id');
		$type_id = $this->input->post('type_id');
		$date = $this->input->post('date');
		$amount = $this->input->post('amount');
		$note = $this->input->post('note');

		$create = $this->payroll_model->create_deduction( $payroll_id, $type_id, $date, $amount, $note );

		if($create){
			$this->compute_payroll($payroll_id);
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
	}

	function compute_payroll($payroll_id)
	{
		$this->payroll_model->compute_payroll($payroll_id);
	}

	public function delete_payroll_additional_process($payroll_id)
	{		
		$this->API->ajax_only();

		$additional_id = $this->input->post('additional_id');

		$delete = $this->payroll_model->delete_additional( $additional_id );

		if($delete){
			$this->compute_payroll($payroll_id);
			$this->API->emit_json( true );
		}
		else{
			// error logs
			$this->API->emit_json( 'Error: delete' );
		}
	}

	public function delete_payroll_deduction_process($payroll_id)
	{		
		$this->API->ajax_only();

		$deduction_id = $this->input->post('deduction_id');

		$delete = $this->payroll_model->delete_deduction( $deduction_id );

		if($delete){
			$this->compute_payroll($payroll_id);
			$this->API->emit_json( true );
		}
		else{
			// error logs
			$this->API->emit_json( 'Error: delete' );
		}
	}

	public function to_print($payroll_id)
	{
		$data['payroll'] = $this->payroll_model->get_payroll( $payroll_id );
		$data['additionals'] = $this->payroll_model->get_payroll_additionals( $payroll_id );
		$data['deductions'] = $this->payroll_model->get_payroll_deductions( $payroll_id );
		
		$this->load->view('payslip_print', $data);
		$html = $this->output->get_output();

		$this->dompdf->loadHtml($html);
		$this->dompdf->render();// $this->dompdf->get_canvas()->get_cpdf()->setEncryption('12345');

		// Output the generated PDF to Browser
		$this->dompdf->stream("Payslip", array("Attachment" => 0));
	}
    
	// CASH ADVANCE
	public function create_cash_advance_view($staff_id)
	{
		$data = array();
		$data['title'] = 'Add Cash Advance';
		$data['nav_payroll'] = 'active';
		$data['login_data'] = $this->session->userdata('login_data');
		$data['staff_id'] = $staff_id;
		$data['script'] = './scripts/create_payroll_cash_advance.js';
		
		$this->load->view( 'page-frame', $data  );
		$this->load->view( 'create_payroll_cash_advance', $data );
		$this->load->view( 'page-frame-footer', $data );
	}
}
