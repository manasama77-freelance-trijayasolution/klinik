<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class f_home extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
 }
 
 function index(){
   if($this->session->userdata('logged_in'))
   {
	 $this->load->model('m_login');
     $session_data = $this->session->userdata('logged_in');
     $data['username']  = $session_data['username'];
     $data['fullname'] 	= $session_data['fullname'];
     $data['id'] 		= $session_data['id'];
	 $data['users']		= $this->m_login->data_login();
	 $this->template->set('title','Klinik | Admin Area');
	 $this->template->load('template_fin','fintech/index', $data);
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