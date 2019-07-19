<?php

class Access extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        echo $this->is_ajax();
    }

    public function has_access()
    {
        // return has permission flag
    }

    protected function is_ajax()
    {
        // checks what kind of request is passed
        // is json request?

        // the best practice to filter non-ajax request
		if(isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
			return true;
        }
        
        return false;
    }

    public function set_permissions()
    {
        // set user modules to session
    }
}


?>