<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function lists()
	{
		return $this->db->select( 'project_id, name' )
		->from( 'project')
		->where( 'project.status_id', 1 )
		->get()->result();
	}

	public function list_ss()
	{	
		return $this->SSP->table( 'project' )
		->column( 'project.project_id')
		->column( 'project.name')
		->column( 'project.total_area')
		->column( 'project.total_units')
		->column( 'project.location')
		->column( 'status.name', 'status_name')
		->join( 'status', 'status_id', 'project')
		->where( 'project.status_id', 1 )
		->output();
	}

	public function create( $name, $total_area, $total_units, $location)
	{
		$data = array(
			'name' 		  	=> $name,
			'total_area' 	=> $total_area,
			'total_units' 	=> $total_units,
			'location'  	=> $location,
			'status_id'   	=> 1 // active
		);

		$this->db->insert( 'project', $data );
		return $this->db->affected_rows();
	}

	public function update( $project_id, $name, $total_area, $total_units, $location )
	{
		$data = array(
			'name' 		  	=> $name,
			'total_area' 	=> $total_area,
			'total_units' 	=> $total_units,
			'location'  	=> $location,
		);

		$where = array( 'project_id' => $project_id );

		$this->db->update( 'project', $data, $where );
		return $this->db->affected_rows();
	}

	public function delete( $project_id )
	{
		$data  = array( 'status_id' => 2 ); // inactive
		$where = array( 'project_id' => $project_id);

		$this->db->update( 'project', $data, $where );
		return $this->db->affected_rows();
	}

	public function get( $project_id )
	{
		return $this->db->select( '*' )
		->from( 'project' )
		->where( 'project_id', $project_id )
		->get()->result();
	}

	public function get_staff_in_project( $project_id )
	{
		$staffs = $this->db->select( 'project.*, staff.*' )
		->from( 'project' )
		->join( 'staff', 'staff.project_id=project.project_id', 'left')
		->where( 'project.project_id', $project_id )
		->get()->result();

		if(!empty($staffs[0]->full_name))
			return $staffs;
		return false;
	}

	public function create_staff_in_project( $staff_id, $project_id )
	{
		$data  = array( 'project_id' => $project_id );
		$where = array( 'staff_id' => $staff_id);

		$this->db->update( 'staff', $data, $where );
		return $this->db->affected_rows();
	}

	public function remove_staff_in_project( $staff_id )
	{
		$data  = array( 'project_id' => 0 ); // None
		$where = array( 'staff_id' => $staff_id);

		$this->db->update( 'staff', $data, $where );
		return $this->db->affected_rows();
	}
}
