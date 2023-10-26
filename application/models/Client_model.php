<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function lists()
	{
		return $this->db->select( 'client.*, status.name AS status_name' )
		->from( 'client')
		->join( 'status', 'status.status_id=client.status_id', 'left' )
		->where( 'client.status_id', 1 ) // active
		->get()->result();
	}

	public function list_ss()
	{
		return $this->SSP->table( 'client' )
		->column( 'client.*' ) 
		->column( 'status.name', 'status_name' )
		->join( 'status', 'status_id', 'client' )
		->where( 'client.status_id', '1' )
		->output();
	}

	public function get( $client_id )
	{
		return $this->db->select( '*' )
		->from( 'client' )
		->where( 'client.client_id', $client_id )
		->get()->result();
	}

	public function get_spouse( $client_id )
	{
		return $this->db->select( '*' )
		->from( 'spouse' )
		->where( 'spouse.client_id', $client_id )
		->get()->result();
	}

	public function create( $last_name, $first_name, $middle_name, $birth_date, $birth_place, $gender, $civil_status, $religion, $nationality, $tin, $sss, $pagibig, $drivers_license, $occupation, $spouse_last_name, $spouse_first_name, $spouse_middle_name, $spouse_birth_date, $spouse_birth_place, $spouse_occupation, $spouse_nationality, $spouse_sss, $spouse_tin, $spouse_pagibig, $spouse_drivers_license, $spouse_id_name, $spouse_id_no, $spouse_id_date_issued, $spouse_id_place_issued, $residence_address, $provincial_address, $landline_no, $cellphone_no, $email )
	{
		$data = array(
        	// Personal Details
			'last_name'=> $last_name,
			'first_name'=> $first_name,
			'middle_name'=> $middle_name,
			'birth_date'=> $birth_date,
			'birth_place'=> $birth_place,
			'gender'=> $gender,
			'civil_status'=> $civil_status,
			'religion'=> $religion,
			'nationality'=> $nationality,
			'tin'=> $tin,
			'sss'=> $sss,
			'pagibig'=> $pagibig,
			'drivers_license'=> $drivers_license,
			'occupation'=> $occupation,
        	// Contact Information
			'residence_address'=> $residence_address,
			'provincial_address'=> $provincial_address,
			'landline_no'=> $landline_no,
			'cellphone_no'=> $cellphone_no,
			'email'=> $email
		);

		$this->db->insert( 'client', $data );
		$client_id = $this->db->insert_id();

		$data_spouse = array(
        	// Spouse Details
			'last_name'=> $spouse_last_name,
			'first_name'=> $spouse_first_name,
			'middle_name'=> $spouse_middle_name,
			'birth_date'=> $spouse_birth_date,
			'birth_place'=> $spouse_birth_place,
			'occupation'=> $spouse_occupation,
			'nationality'=> $spouse_nationality,
			'sss'=> $spouse_sss,
			'tin'=> $spouse_tin,
			'pagibig'=> $spouse_pagibig,
			'drivers_license'=> $spouse_drivers_license,
			'spouse_id_name'=> $spouse_id_name,
			'spouse_id_no'=> $spouse_id_no,
			'spouse_id_date_issued'=> $spouse_id_date_issued,
			'spouse_id_place_issued'=> $spouse_id_place_issued,
			'client_id'=> $client_id
		);

		if(!empty($data_spouse['last_name']))
		{
			$this->db->insert( 'spouse', $data_spouse );
			return $this->db->affected_rows();
		}
		
		return $this->db->affected_rows();
	}

	public function update( $client_id, $first_name, $last_name, $full_name, $address, $contact_no, $gender, $birth_date, $start_date, $daily_compensation, $daily_cola, $job_description, $sss, $pagibig, $tin )
	{
		// $data = array(
		// 	'first_name' 			=> $first_name,
		// 	'last_name' 			=> $last_name,
		// 	'address' 				=> $address,
		// 	'contact_no' 			=> $contact_no,
		// 	'gender' 				=> $gender,
		// 	'birth_date' 			=> $birth_date,
		// 	'start_date' 			=> $start_date,
		// 	'daily_compensation' 	=> $daily_compensation,
		// 	'daily_cola' 			=> $daily_cola,
		// 	'job_description' 		=> $job_description,
		// 	'sss' 					=> $sss,
		// 	'pagibig' 				=> $pagibig,
		// 	'tin' 					=> $tin
		// );
        $data = [];

		$where = array( 'client_id' => $client_id );

		$this->db->update( 'client', $data, $where );
		return $this->db->affected_rows();
	}

	public function delete($client_id)
	{
		$data  = array( 'status_id' => 2 );
		$where = array( 'client_id' => $client_id);

		$this->db->update( 'client', $data, $where );
		return $this->db->affected_rows();
	}
	
	public function search( $search, $sort="asc" )
	{
		return $this->db->select( 'client.*' )
		->from( 'client' )
		->like( 'client.full_name', $search,'both' )
		->where( 'client.status_id', 1 )
		// ->order_by('client.last_name', $sort)
		->get()->result();
	}
}
