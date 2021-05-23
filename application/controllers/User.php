<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
 }
 //security apabila belom login akan dikembalikan ke form login
 function index(){
   if($this->session->userdata('logged_in'))
   {
     $session_data			 = $this->session->userdata('logged_in');
     $data['username']		 = $session_data['username'];
     $this->load->view('menu/index.php', $data);
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }
 //daftar list user
 function list_us(){
	if($this->session->userdata('logged_in')){	
	 $this->load->model('m_user');
     $session_data 			 = $this->session->userdata('logged_in');
     $data['username']		 = $session_data['username'];
	 $data['user']			 = $this->m_user->get_list_user();
	 $data['data']			 = $this->m_user->get_list_user_leftjoin_demo_finger();
	 $this->template->set('title','Klinik | User List');
	 $this->template->load('template','menu/list_us', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }


 //fungsi untuk edit user
 function edit(){
	if($this->session->userdata('logged_in')){	
	 $this->load->library('form_validation');
	 $this->load->model('m_user');
	 $id 					 = $this->uri->segment(3);
	 $session_data 			 = $this->session->userdata('logged_in');
	 $data['username']		 = $session_data['username'];
	 $data['user']			 = $this->m_user->get_list_user_by_id($id);
	 $data['userx']			 = $this->m_user->get_list_user();
	 $this->template->set('title','Klinik | User Edit');
	 $this->template->load('template','menu/edit_user', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //setelah edit, fungsi simpan dibawah ini
 function save_edit(){
	if($this->session->userdata('logged_in')){	
	 $this->load->model('m_user');
	 $id 					 = $this->uri->segment(3);
	 $data_user = array(
		'userpass'	 		=> $this->input->post('userpass'),
		'username'	 		=> $this->input->post('username'),
		'fullname' 			=> $this->input->post('fullname'),
		'atasan_1' 			=> $this->input->post('man1'),
		'atasan_2' 			=> $this->input->post('man2'),
		'atasan_3' 			=> $this->input->post('man3')
	 );
	 $this->m_user->update_user($data_user,$id);
	 // kembalikan ke halaman user
	 redirect('user/list_us/ok');
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //fungsi untuk delete user
 function del(){
	if($this->session->userdata('logged_in')){	
	 $id 					 = $this->uri->segment(3);
	 $this->load->model('m_user');
	 $this->m_user->delete_user($id);
	 // kembalikan ke halaman user
	 redirect('user/list_us/del');
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //fungsi untuk add user
 function add(){
	if($this->session->userdata('logged_in')){	
	 $this->load->library('form_validation');
	 $this->load->model('m_user');
	 $session_data 			 = $this->session->userdata('logged_in');
	 $data['username']		 = $session_data['username'];
	 $data['job']			 = $this->m_user->get_job();
	 $data['branch']	     = $this->m_user->get_branch();
	 $data['user']	   		 = $this->m_user->get_list_user();
	 $this->template->set('title','Klinik | User Add');
	 $this->template->load('template','menu/add_user', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //fungsi simpan user
 function save_add(){
	if($this->session->userdata('logged_in')){	
	 $this->load->model('m_user');
	 $data_user = array(
		'username'	 		=> $this->input->post('username'),
		'userpass'	 		=> $this->input->post('userpass'),
		'userlevel'	 		=> $this->input->post('userlevel'),	
		'fullname' 			=> $this->input->post('fullname'),
		'menu_level'		=> $this->input->post('job'),
		'location'			=> $this->input->post('branch'),
		'atasan_1' 			=> $this->input->post('man1'),
		'atasan_2'			=> $this->input->post('man2'),
		'atasan_3'			=> $this->input->post('man3')
	 );
	 $this->m_user->add_user($data_user);
	 // kembalikan ke halaman user
	 redirect('user/list_us/add');
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function user_excel(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_user');			
		$session_data 				= $this->session->userdata('logged_in');
	    $data['username'] 			= $session_data['username'];
		$id				 			= $session_data['id'];
	 	$data['list']			 	= $this->m_user->get_list_user();
		$this->load->view('menu/user_excel', $data);
	} else {
      redirect('login', 'refresh');
	}	
 }

}
?>