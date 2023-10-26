<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function lists()
	{
		return $this->SSP->table( 'staff' )
		->column( 'staff.staff_id')
		->column( 'staff.first_name')
		->column( 'staff.last_name')
		->column( 'staff.full_name')
		->column( 'staff.address')
		->column( 'staff.contact_no')
		->column( 'staff.gender')
		->column( 'staff.employee_id')
		->column( 'staff.start_date')
		->column( 'staff.daily_compensation')
		->column( 'staff.daily_cola')
		->column( 'status.name', 'status_name')
		->join( 'status', 'status_id', 'staff')
		->where( 'staff.status_id', 1 )
		->output();
	}

	public function get_staff( $staff_id )
	{
		return $this->db->select( '*' )
		->from( 'staff' )
		->where( 'staff.staff_id', $staff_id )
		->get()->result();
	}

	public function create( $first_name, $last_name, $full_name, $address, $contact_no, $gender, $birth_date, $start_date, $daily_compensation, $daily_cola, $job_description, $sss, $pagibig, $tin )
	{
		$data = array(
			'first_name' 			=> $first_name,
			'last_name' 			=> $last_name,
			'full_name' 			=> $full_name,
			'address' 				=> $address,
			'contact_no' 			=> $contact_no,
			'gender' 				=> $gender,
			'birth_date' 			=> $birth_date,
			'start_date' 			=> $start_date,
			'daily_compensation' 	=> $daily_compensation,
			'daily_cola' 			=> $daily_cola,
			'job_description' 		=> $job_description,
			'sss' 					=> $sss,
			'pagibig' 				=> $pagibig,
			'tin' 					=> $tin,
			'status_id'				=> 1 //active 
		);

		$this->db->insert( 'staff', $data );
		return $this->db->affected_rows();
	}

	public function delete($staff_id)
	{
		$data  = array( 'status_id' => 2 );
		$where = array( 'staff_id' => $staff_id);

		$this->db->update( 'staff', $data, $where );
		return $this->db->affected_rows();
	}

	public function update( $staff_id, $first_name, $last_name, $full_name, $address, $contact_no, $gender, $birth_date, $start_date, $daily_compensation, $daily_cola, $job_description, $sss, $pagibig, $tin )
	{
		$data = array(
			'first_name' 			=> $first_name,
			'last_name' 			=> $last_name,
			'address' 				=> $address,
			'contact_no' 			=> $contact_no,
			'gender' 				=> $gender,
			'birth_date' 			=> $birth_date,
			'start_date' 			=> $start_date,
			'daily_compensation' 	=> $daily_compensation,
			'daily_cola' 			=> $daily_cola,
			'job_description' 		=> $job_description,
			'sss' 					=> $sss,
			'pagibig' 				=> $pagibig,
			'tin' 					=> $tin
		);

		$where = array( 'staff_id' => $staff_id );

		$this->db->update( 'staff', $data, $where );
		return $this->db->affected_rows();
	}
	
	public function search( $search, $sort="asc" )
	{
		return $this->db->select( 'staff.*' )
		->from( 'staff' )
		->like( 'staff.full_name', $search,'both' )
		->where( 'staff.status_id', 1 )
		// ->order_by('staff.last_name', $sort)
		->get()->result();
	}
}
