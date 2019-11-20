<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->library('API');
		$this->API = new API();
    }
    
    public function list( $user_id, $limit=15 )
    {
        $this->db->select( 'user.full_name' );
        $this->db->select( 'notification.user_id' );
        $this->db->select( 'notification.scope' ); 
        $this->db->select( 'notification.message' ); 
        $this->db->select( 'notification.link' ); 
        $this->db->select( 'notification.datetime' ); 
        $this->db->select( 'notification.seen' ); 
        $this->db->from( 'notification' );
        $this->db->join( 'user', 'user_id', 'notification' );
        $this->db->where( 'user.user_id', $user_id );
        $this->db->order_by( 'notification.datetime', 'DESC' );
        $this->db->limit( $limit );
        return $this->db->get()->result();
    }

    public function unread_count( $user_id )
    {
        $this->db->select( 'notification.notification_id' );
        $this->db->from( 'notification' );
        $this->db->join( 'user', 'user_id', 'notification' );
        $this->db->where( 'user.user_id', $user_id );
        $this->db->where( 'seen', false );
        $this->db->order_by( 'notification.datetime', 'DESC' );
        return $this->db->count_all_results();
    }

    public function mark_all_as_read( $user_id )
    {
        $this->db->set( 'seen', true );
        $this->db->where( 'user_id', $user_id );
        $this->db->update( 'notification' );
        return $this->db->affected_rows();
    }

    public function create( $user_id, $user_type_id, $scope, $message, $link, $datetime, $seen )
    {
        $this->db->set( 'user_id', $user_id );
        $this->db->set( 'user_type_id', $user_type_id );
        $this->db->set( 'scope', $scope );
        $this->db->set( 'message', $message );
        $this->db->set( 'link', $link );
        $this->db->set( 'datetime', $datetime );
        $this->db->set( 'seen', $seen );
        $this->db->insert( 'notification' );
    }

    public function update()
    {
        
    }

    public function delete()
    {

    }
}
