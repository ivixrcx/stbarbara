<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class House_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
	}

	public function list( $status_id="1" )
	{
		return $this->db->select( 'house.*, status.name as status_name' )
		->from( 'house')
		->join( 'status', 'status.status_id=house.status_id', 'left')
		->where( 'status.status_id', $status_id )
		->get()->result();
	}

	public function create( $name, $lot_area, $floor_area, $suggested_price )
	{
		$data = array(
			'name' 		 	 => $name,
			'lot_area' 		 => $lot_area,
			'floor_area' 	 => $floor_area,
			'suggested_price'=> $suggested_price,
			'status_id'   	 => 1 // active
		);

		$this->db->insert( 'house', $data );
		return $this->db->affected_rows();
	}

	public function update( $house_id, $name, $lot_area, $floor_area, $suggested_price )
	{
		$data = array(
			'name' 		  	 => $name,
			'lot_area' 		 => $lot_area,
			'floor_area' 	 => $floor_area,
			'suggested_price'=> $suggested_price,
		);

		$where = array( 'house_id' => $house_id );

		$this->db->update( 'house', $data, $where );
		return $this->db->affected_rows();
	}

	public function delete( $house_id )
	{
		$data  = array( 'status_id' => 2 ); // inactive
		$where = array( 'house_id' => $house_id);

		$this->db->update( 'house', $data, $where );
		return $this->db->affected_rows();
	}

	public function get( $house_id )
	{
		return $this->db->select( '*' )
		->from( 'house' )
		->where( 'house_id', $house_id )
		->get()->result();
	}
}
