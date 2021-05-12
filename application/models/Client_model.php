<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function list()
	{
		return $this->db->select( 'client.*, status.name AS status_name' )
		->from( 'client')
		->join( 'status', 'status.status_id=client.status_id', 'left' )
		->where( 'client.status_id', 1 ) // active
		->get()->result();
	}

	public function get( $client_id )
	{
		return $this->db->select( '*' )
		->from( 'client' )
		->where( 'client.client_id', $client_id )
		->get()->result();
	}

	public function create( $first_name, $last_name, $full_name, $address, $contact_no, $gender, $birth_date, $start_date, $daily_compensation, $daily_cola, $job_description, $sss, $pagibig, $tin )
	{
		// $data = array(
		// 	'first_name' 			=> $first_name,
		// 	'last_name' 			=> $last_name,
		// 	'full_name' 			=> $full_name,
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
		// 	'tin' 					=> $tin,
		// 	'status_id'				=> 1 //active 
		// );
        $data = [];

		$this->db->insert( 'client', $data );
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
