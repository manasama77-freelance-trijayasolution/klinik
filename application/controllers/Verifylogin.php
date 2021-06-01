<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->model('M_login','',TRUE);
 }
 
 function index()
 {
   //This method will have the credentials validation
   $this->load->library('form_validation');
   $this->load->helper('security');
   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
   //Validasi Password atau Username yang tidak ada di database dibawah ini
   $this->form_validation->set_rules('userpass', 'Password', 'trim|required|xss_clean|callback_check_database');
 
   if($this->form_validation->run() == FALSE)
   {
     //Field validation failed.  User redirected to login page
	 $data['login_info']="Username & Password Required";
     $this->load->view('login_view',$data);
   }
   else
   {
	 //Create Log Start
	 $session_data 			= $this->session->userdata('logged_in');
   $now               = date("Y-m-d H:i:s");
	 $user_id				    = $session_data['id'];	
	 $data_log          = array(
				'id_user'			=>$user_id,
				'log_date'		=>$now,
				'log_desc' 		=>"Login Success",
	 );
	 $this->load->model('m_login');
	 $this->m_login->log($data_log);
	 //Endless Log
	 //Go to private area
     redirect('home');
   }
 }
 
 function check_database($password)
 {
   //Field validation succeeded.  Validate against database
   $username = $this->input->post('username');
   $this->load->library('session');
   $result = $this->M_login->login($username, $password);
   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array          = array(
		'id' 			              => $row->id,
    'fullname'              => $row->fullname,
		'username' 	            => $row->username,
		'userlevel'	            => $row->userlevel,
		'location'		          => $row->location,
		'jobs'                  => $row->menu_level,
		'ats1'                  => $row->atasan_1,
		'ats2'                  => $row->atasan_2,
    'ats3'                  => $row->atasan_3,
		'agama'                 => $row->agama,
    'logged_in'             => TRUE, 
		'masterpt'   			      => 'Klinik drg. Magista Lutfia', 
       );
       $this->session->set_userdata('logged_in', $sess_array);
	   $data = array();
	   $data            	    = array(
		'online' 			    =>1,
       );
	   $update = $this->M_login->user_login($username,$data);
     }
     return TRUE;
   }
   else
   {
	 // Error validation to database
     $this->form_validation->set_message('check_database', 'Invalid username or password');
     return false;
   }
 }
}
?>