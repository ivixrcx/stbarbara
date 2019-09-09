<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materialcategory extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'materialcategory_model' );
		$this->load->model( 'account_model' );
		$this->load->library( 'API', NULL, 'API' );
		$this->load->library( 'UserAccess', array( $this ) );
		// $this->API->auth_required();
		// $this->useraccess->check_permissions();
	}
    
    public function list()
    {
        $this->API->ajax_only();

        $list = $this->materialcategory_model->list();

        $this->API->emit_json( $list );   
    }
}
