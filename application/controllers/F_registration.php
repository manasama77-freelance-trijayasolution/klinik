<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class f_registration extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
 }
 
 function new_regist(){
   if($this->session->userdata('logged_in'))
   {
	 $this->load->model('m_login');
	 $this->load->model('m_fin');
     $session_data = $this->session->userdata('logged_in');
     $data['username']  = $session_data['username'];
     $data['fullname'] 	= $session_data['fullname'];
     $data['id'] 		= $session_data['id'];
	 $data['users']		= $this->m_login->data_login();
	 $data['filex']		= $this->m_fin->get_registration_today();
	 $this->template->set('title','Klinik | New Registration');
	 $this->template->load('template_fin','fintech/new_regist', $data);
     //$this->load->view('');
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }
 
}
?>