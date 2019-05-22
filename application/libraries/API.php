<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class API extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library( 'SSP', array($this->db), 'SSP' );
	}

	public function ssp()
	{
		return $this->SSP;
	}

	public function emit($data, $error="")
	{
		return (object)array(
			'has_data' 	=> !empty($data) ?: false,
			'data' 		=> $data,
			'error' 	=> $error
		);
	}

	public function emit_json($data, $error="")
	{
		header('content-type: application/json; charset=utf-8;');
		echo json_encode($this->emit( $data, $error ));
	}

	public function ajax_only()
	{
		// the best practice to filter non-ajax request
		if(!isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
			die( @file_get_contents(VIEWPATH . '401.html') );
		}
	}
}
