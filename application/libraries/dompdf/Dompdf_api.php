<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */

/* autoload classes */
require_once 'autoload.inc.php';

/* reference */
use Dompdf\Dompdf;
use Dompdf\Options;

class Dompdf_api extends Dompdf
{
	function __construct($config="")
	{
		$options = new Options();
		$options->set('defaultFont', 'courier, sans-serif');

		if(!empty($config)){
			
		}

		parent::__construct($options);
	}
}


?>