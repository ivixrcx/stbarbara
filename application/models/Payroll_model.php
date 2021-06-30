<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function list( $staff_id )
	{
		return $this->SSP->table( 'payroll' )
		->column( 'payroll.*')
		->column( 'DATE_FORMAT(payroll.paydate, "%Y %M %d")', 'pay_date')
		->column( 'staff.full_name')
		->join( 'staff', 'staff_id', 'payroll')
		->where( 'payroll.staff_id', $staff_id )
		->where( 'payroll.status_id', 1 )
		->order_by('paydate', 'desc')
		->output();
	}

	public function list_ss( $staff_id )
	{
		return $this->SSP->table( 'payroll' )
		->column( 'payroll.payroll_id')
		->column( 'payroll.staff_id')
		->column( 'payroll.project_id')
		->column( 'payroll.paydate')
		->column( 'payroll.daily_compensation')
		->column( 'payroll.no_of_days')
		->column( 'payroll.basepay')
		->column( 'payroll.net_pay')
		->column( 'payroll.total_additionals')
		->column( 'payroll.total_deductions')
		->column( 'payroll.note')
		// ->column( 'DATE_FORMAT(payroll.paydate, "%Y %M %d")', 'pay_date')
		->column( 'staff.full_name')
		->join( 'staff', 'staff_id', 'payroll')
		->where( 'payroll.staff_id', $staff_id )
		->where( 'payroll.status_id', 1 )
		->order_by('paydate', 'desc')
		->output();
	}

	public function get_payroll( $payroll_id )
	{
		return $this->db->select( 'payroll.*, staff.*, project.name project_name' )
		->from( 'payroll' )
		->join('staff','staff.staff_id=payroll.staff_id','left')
		->join('project','project.project_id=payroll.project_id','left')
		->where( 'payroll.payroll_id', $payroll_id )
		->get()->result();
	}

	public function get_payroll_additionals( $payroll_id )
	{
		return $this->db->select( 'additional.*, additional_type.*' )
		->from( 'additional' )
		->join('additional_type', 'additional_type.additional_type_id=additional.additional_type_id', 'left')
		->where( 'additional.payroll_id', $payroll_id )
		->where( 'additional.status_id', 1 )
		->get()->result();
	}

	public function get_payroll_deductions( $payroll_id )
	{
		return $this->db->select( 'deduction.*, deduction_type.*' )
		->from( 'deduction' )
		->join('deduction_type', 'deduction_type.deduction_type_id=deduction.deduction_type_id', 'left')
		->where( 'deduction.payroll_id', $payroll_id )
		->where( 'deduction.status_id', 1 )
		->get()->result();
	}

	public function create( $staff_id, $project_id, $paydate, $daily_compensation, $no_of_days, $basepay, $net_pay, $note )
	{
		$data = array(
			'staff_id'              => $staff_id,
			'project_id'    		=> $project_id,
			'paydate'    			=> $paydate,
			'daily_compensation'    => $daily_compensation,
			'no_of_days' 	        => $no_of_days,
			'basepay'               => $basepay,
			'net_pay'               => $net_pay,
			'note'                  => $note,
			'status_id'             => 1 // active
		);

		$this->db->insert( 'payroll', $data );
		return $this->db->affected_rows();
	}

	public function create_additional( $payroll_id, $type_id, $date, $amount, $note )
	{
		$data = array(
			'payroll_id'            => $payroll_id,
			'additional_type_id'    => $type_id,
			'date'    				=> $date,
			'amount' 	        	=> $amount,
			'note'               	=> $note,
			'status_id'             => 1 // active
		);

		$this->db->insert( 'additional', $data );
		return $this->db->affected_rows();
	}

	public function create_deduction( $payroll_id, $type_id, $date, $amount, $note )
	{
		$data = array(
			'payroll_id'            => $payroll_id,
			'deduction_type_id'    	=> $type_id,
			'date'    				=> $date,
			'amount' 	        	=> $amount,
			'note'               	=> $note,
			'status_id'             => 1 // active
		);

		$this->db->insert( 'deduction', $data );
		return $this->db->affected_rows();
	}

	public function delete_payroll($payroll_id)
	{
		$data  = array( 'status_id' => 2 );
		$where = array( 'payroll_id' => $payroll_id);

		$this->db->update( 'payroll', $data, $where );
		return $this->db->affected_rows();
	}

	public function delete_additional($additional_id)
	{
		$data  = array( 'status_id' => 2 );
		$where = array( 'additional_id' => $additional_id);

		$this->db->update( 'additional', $data, $where );
		return $this->db->affected_rows();
	}

	public function delete_deduction($deduction_id)
	{
		$data  = array( 'status_id' => 2 );
		$where = array( 'deduction_id' => $deduction_id);

		$this->db->update( 'deduction', $data, $where );
		return $this->db->affected_rows();
	}

	public function compute_payroll( $payroll_id )
	{
		// Get total additionals
		$sql_additionals = "
			SELECT 
				SUM(additional.amount) total
			FROM 
				additional 
			WHERE 
				additional.payroll_id = '$payroll_id' AND 
				additional.status_id = 1;
			";

		$aa = $this->db->query($sql_additionals);
		$ta = $aa->result()[0]->total;


		// Get total deductions
		$sql_deductions = "
			SELECT 
				SUM(deduction.amount) total
			FROM 
				deduction 
			WHERE 
				deduction.payroll_id = '$payroll_id' AND 
				deduction.status_id = 1;
			";

		$dd = $this->db->query($sql_deductions);
		$td = $dd->result()[0]->total;

		$basepay = $this->get_payroll($payroll_id)[0]->basepay;
		$t_netpay = $basepay + $ta - $td;
		

		$data = array(
			'total_additionals'  => $ta,
			'total_deductions'  => $td,
			'net_pay'  => $t_netpay,
		);

		$where = array( 'payroll_id' => $payroll_id );
		$this->db->update( 'payroll', $data, $where );

		// return $result;
	}

	// CASH ADVANCE
	public function create_cash_advance( $staff_id, $date, $amount , $note )
	{
		$data = array(
			'staff_id'=> $staff_id,
			'date'=> $date,
			'amount'=> $amount,
			'note'=> $note,
		);

		$this->db->insert( 'cash_advance', $data );		
		return $this->db->affected_rows();
	}

	public function get_cash_advance( $staff_id )
	{
		return $this->db->select( '*' )
		->from( 'cash_advance' )
		->where( 'cash_advance.staff_id', $staff_id )
		->where( 'cash_advance.status_id', 1 )
		->order_by('date','desc')
		->get()->result();
	}

	public function get_cash_advance_ss( $staff_id )
	{		
		return $this->SSP->table( 'cash_advance' )
		->column( 'cash_advance.cash_advance_id' )
		->column( 'cash_advance.date' )
		->column( 'cash_advance.amount' )
		->column( 'cash_advance.note' )
		->where( 'cash_advance.staff_id', $staff_id )
		->where( 'cash_advance.status_id', 1 )
		->order_by('date','desc')
		->output();
	}

	public function delete_cash_advance($cash_advance_id)
	{
		$data  = array( 'status_id' => 2 );
		$where = array( 'cash_advance.cash_advance_id' => $cash_advance_id);

		$this->db->update( 'cash_advance', $data, $where );
		return $this->db->affected_rows();
	}

	public function get_total_cash_advance( $staff_id )
	{
		return $this->db->select( 'SUM(`amount`) total' )
		->from( 'cash_advance' )
		->where( 'cash_advance.staff_id', $staff_id )
		->where( 'cash_advance.status_id', 1 )
		->get()->result();
	}

	public function get_deducted_cash_advance( $staff_id )
	{
		return $this->db->select( 'SUM(deduction.amount) ca_paid' )
		->from( 'staff' )
		->join('payroll', 'payroll.staff_id=staff.staff_id', 'left')
		->join('deduction', 'deduction.payroll_id=payroll.payroll_id', 'left')
		->where( 'deduction.deduction_type_id', 13 )
		->where( 'staff.staff_id', $staff_id )
		->where( 'deduction.status_id', 1 )
		->get()->result();
	}
	
}
