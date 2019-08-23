<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function list($status_id="1")
	{
		$list = $this->db->select( 'project.*, status.name as status_name' )
		->from( 'project')
		->join( 'status', 'status.status_id=project.status_id', 'left');

		if(!empty($status_id)){
			$list->where( 'project.status_id', $status_id );
		}

		return $list->get()->result();
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
}
