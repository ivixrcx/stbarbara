<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

require 'Ssp.php';

class Api extends CI_Model{

	function __construct()
	{
		parent::__construct();
	}

	public function serverside($table, $primary_key,$columns)
	{
		$connection = array(
		  'user'  => $this->db->username,
		  'pass'  => $this->db->password,
		  'db'    => $this->db->database,
		  'host'  => $this->db->hostname,
		);

		echo json_encode(
		    SSP::simple( $_POST, $connection, $table, $primary_key, $columns )
		);
	}
}
