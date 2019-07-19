<?php

/**
 * User Access Class
 * 
 * A class that set, unset, checks permissions
 * 
 * @package     UserAccess
 * @subpackage  library
 * @author      Mark Daryl Jerezon
 */
class UserAccess {

    private $ci;
    private $session_name;

    function __construct( $params )
    {
        $this->ci = $params[0];
        $this->session_name = "permissions";
    }

    public function has_access()
    {
        // return has permission flag
    }

    /**
     * @return  bool
     */
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

    /**
     * @param   $data 
     * @return  void
     */
    public function set_permission( $data )
    {
        // set user modules to session
        $this->ci->session->set_userdata( $this->session_name, $data );
    }

    /**
     * @return  void
     */
    public function unset_permission()
    {
        $this->ci->session->unset_userdata( $this->session_name );
    }
}


?>