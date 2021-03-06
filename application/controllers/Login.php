<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
 function __construct()
 {
   parent::__construct();
 }
 
 function index()
 {
   $this->load->model('m_login');
   $session_data 	= $this->session->userdata('logged_in');
   $user_id			= $session_data['id'];	
   $data = array();
   $data            	    = array(
   'online' 			    =>0,
      );
   $update = $this->m_login->user_logout($user_id,$data);
   $this->session->unset_userdata('logged_in');
   $this->load->helper(array('form'));
   $this->load->view('login_view');
 }
}
