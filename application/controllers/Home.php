<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model( 'account_model' );
		$this->load->library( 'API', NULL, 'API' );
		$this->API->auth_required();
	}

	public function index()
	{
		$data = array();
		$data['nav_home'] = 'active';
		$data['login_data'] = $this->session->userdata( 'login_data' );

		$this->load->view( 'page-frame', $data );
		$this->load->view( 'home', $data );
		$this->load->view( 'page-frame-footer', $data ); 
	}
}
