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

        if( !isset($_SESSION[$this->session_name]) ){
            $_SESSION[$this->session_name] = array();
        }
    }

    public function check_permissions()
    {
        // return has permission flag
        $request = $this->ci->router->class . '/' . $this->ci->router->method;
        $permissions = $this->ci->session->userdata( $this->session_name );

        if( $this->is_permission_set() ){
            if( !in_array( $request, $permissions ) ){
                ob_clean();
                ob_start();
                
                if( $this->is_ajax() ){

                    $array = array(
                        'code'      => '101',
                        'module'    => $request,
                        'error'     => 'Access Denied on module "' . $request . '"',
                        'error_html'=> 'Access Denied on module <code class="text-warning">' . $request . '</code>'
                    );

                    $this->emit_json( $array, 'No permission' ); // permission denied
                }
                else{
                    $this->ci->load->view( '101.html' ); exit;
                }
            }
        }
    }

    /**
     * @return  string
     */
    public function get_session_permissions()
    {
        $permissions = $this->ci->session->userdata( $this->session_name );
        $this->emit_json( $permissions );
    }

    /**
     * @return  string
     */
	protected function emit_json( $data, $error="" )
	{
		header('content-type: application/json; charset=utf-8;');
		echo json_encode(
            (object)array(
                'has_data' 	=> !empty($data) ?: false,
                'data' 		=> $data,
                'error' 	=> $error
            )
        );

        die;
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
     * @return  bool
     */
    public function is_permission_set()
    {
        // check session
        $session = $this->ci->session->userdata( $this->session_name );
        if( !empty($session) ){
            return true;
        }
        
        return false;
    }

    /**
     * @param   $data 
     * @return  void
     */
    public function set_permission( $modules )
    {
        // set user modules to session
        $session = $_SESSION[$this->session_name];

        if( is_array($modules) ){
            foreach($modules as $module){
                if( !in_array($module, $session) ){
                    $_SESSION[$this->session_name][] = $module;
                }
            }
        }
        else{
            if( !in_array($modules, $session) ){
                $_SESSION[$this->session_name][] = $modules;
            }
        }
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