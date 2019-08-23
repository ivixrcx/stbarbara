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

	public function emit($data, $error="", $code="")
	{
		return (object)array(
			'code'      => $code,
			'has_data' 	=> !empty($data) ?: false,
			'data' 		=> $data,
			'error' 	=> $error
		);
	}

	public function emit_json($data, $error="", $code="200")
	{
		header('content-type: application/json; charset=utf-8;');
		echo json_encode($this->emit( $data, $error, $code ));
	}

	public function ajax_only()
	{
		// the best practice to filter non-ajax request
		if(!$this->input->is_ajax_request()){
			die( @file_get_contents(VIEWPATH . '401.html') );
		}
	}

	public function auth_required()
	{
		$location = base_url() . 'login';
		$is_logged_in = false;

		if($this->session->has_userdata('login_data')){
			$is_logged_in = true;
		}

		if(!$this->input->is_ajax_request()) {
			if(!$is_logged_in){
				redirect($location, 'refresh');
			}
		}
		else{
			if(!$is_logged_in){
				$this->output->set_status_header(401);
				$this->emit_json( true, 'login is required.', 102 );
				die();
			}
		}
	}
}
