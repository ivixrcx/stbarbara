<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'notification_model' );
		$this->load->library( 'API', NULL, 'API' );
		$this->load->library( 'UserAccess', array( $this ) );
		$this->API->auth_required();
		// $this->useraccess->check_permissions();
	}

	public function create()
	{
		$this->API->ajax_only();

		$name 		 	 = $this->input->post( 'name' );
		$lot_area  		 = $this->input->post( 'lot_area' );
		$floor_area 	 = $this->input->post( 'floor_area' );
		$suggested_price = $this->input->post( 'suggested_price' );

		$create = $this->house_model->create();

		if($create){
			$this->API->emit_json( true );
		}
		else{
			$this->API->emit_json( false, 'Error: insert');	
		}
    }
    
    public function flush() 
    {
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');

		$list = $this->notification_model->list(2);
		$this->API->emit_json($list);
        flush();
    }
}
