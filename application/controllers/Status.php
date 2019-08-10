<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Controller {

	function __construct()
	{
        parent::__construct();        
    }

    public function index( $code )
    {
        switch ($code) {
            case 101:
                $this->load->view('101.html');
                break;
                
            case 401:
                $this->load->view('401.html');
                break;

            case 403:
                $this->load->view('403.html');
                break;

            default:
                $this->load->view('404.html');
                break;
        }
    }
}
