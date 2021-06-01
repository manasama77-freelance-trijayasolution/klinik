<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lab extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->library('pagination');
 }
 
 function index(){
   if($this->session->userdata('logged_in'))
   {
     $session_data			 = $this->session->userdata('logged_in');
     $data['username']		 = $session_data['username'];
     $this->load->view('menu/index.php', $data);
   } else {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }

 //fungsi load Master Lab Item
 function mst_lab_item(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_lab');	
		$this->load->model('m_patient');			
		$this->load->model('m_quotation');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_lab->get_list_group();
		$data['gender'] 		= $this->m_patient->get_list_gender();
		$data['sv_mark'] 		= $this->m_quotation->get_list_mark();
		$data['item'] 			= $this->m_lab->get_list_item();
	    $this->template->set('title','Klinik | Master Lab Item');
		$this->template->load('template','menu/mst_lab_item', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi load Master Lab Item
 function new_lab_item(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_lab');	
		$this->load->model('m_patient');			
		$this->load->model('m_quotation');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_lab->get_list_group();
		$data['gender'] 		= $this->m_patient->get_list_gender();
		$data['sv_mark'] 		= $this->m_quotation->get_list_mark();
	    $this->template->set('title','Klinik | New Lab Item');
		$this->template->load('template','menu/new_lab_item', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function save_item(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		
			$data_item			= array(
				'lab_item_desc'		=>$this->input->post('lab_item_desc'),
				'lab_item_abbr'		=>$this->input->post('item_abbr'),
				'lab_item_unit'		=>$this->input->post('item_unit'),
				'lab_item_group'	=>$this->input->post('item_group'),
				'lab_item_seq_no'	=>$this->input->post('item_seq'),
				'lab_item_case'		=>$this->input->post('case'),
			);
			$this->load->model('m_lab');
			$this->m_lab->save_item($data_item);
			
			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d H:i:s"),
						'log_desc' 						=>"Create Item Lab : ".$this->input->post('lab_item_desc')."",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
			
			redirect('lab/mst_lab_item/ok');
 }


 function save_item2(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		
			$data_item			= array(
				'lab_item_desc'		=>$this->input->post('lab_item_desc'),
				'lab_item_abbr'		=>$this->input->post('item_abbr'),
				'lab_item_unit'		=>$this->input->post('item_unit'),
				'lab_item_group'	=>$this->input->post('item_group'),
				'lab_item_seq_no'	=>$this->input->post('item_seq'),
				'lab_item_case'		=>$this->input->post('case'),
			);
			$this->load->model('m_lab');
			$this->m_lab->save_item($data_item);
			
			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d H:i:s"),
						'log_desc' 						=>"Create Item Lab : ".$this->input->post('lab_item_desc')."",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
			
		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
 }

 function list_lab_item(){
    if($this->session->userdata('logged_in')){
		$this->load->model('m_lab');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['find'] 			= $this->m_lab->get_list_item_aktif();
	    $this->template->set('title','Klinik | list Services');
		$this->template->load('template','menu/list_lab_item', $data);
	} else {
     //If no session, redirect to login page
     redirect('login', 'refresh');
	}	
 }

 function list_lab_item_excel(){
    if($this->session->userdata('logged_in')){
		$this->load->model('m_lab');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_lab->get_list_item_aktif();
		$this->load->view('menu/list_lab_item_excel', $data);
	} else {
     //If no session, redirect to login page
     redirect('login', 'refresh');
	}	
 }

 function list_lab_item_excel2(){
    if($this->session->userdata('logged_in')){
		$this->load->model('m_lab');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_lab->get_lab_non_unit_range();
		$this->load->view('menu/list_lab_item_excel2', $data);
	} else {
     //If no session, redirect to login page
     redirect('login', 'refresh');
	}	
 }

 function update_lab_item(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_lab');	
		$this->load->model('m_patient');			
		$this->load->model('m_quotation');			
		$id_item 			= $this->uri->segment(3);
		$session_data 		= $this->session->userdata('logged_in');
	    $data['username'] 	= $session_data['username'];
		$data['data'] 		= $this->m_lab->get_list_group();
		$data['gender'] 	= $this->m_patient->get_list_gender();
		$data['sv_mark'] 	= $this->m_quotation->get_list_mark();
		$data['item'] 		= $this->m_lab->get_list_item();
		$hasil 				= $this->m_lab->get_list_item_id($id_item);
		foreach ($hasil->result() as $row) {
			$data['id_lab_item']			= $row->id_lab_item;
			$data['lab_item_desc']			= $row->lab_item_desc;
			$data['lab_item_name_j']		= $row->lab_item_name_j;
			$data['lab_item_abbr']			= $row->lab_item_abbr;
			$data['lab_item_unit']			= $row->lab_item_unit;
			$data['lab_item_group']			= $row->lab_item_group;
			$data['lab_item_seq_no']		= $row->lab_item_seq_no;
			$data['lab_item_case']			= $row->lab_item_case;
			$data['lab_item_sampling']		= $row->lab_item_sampling;
			$data['group_name']				= $row->group_name;
			$data['group_name_j']			= $row->group_name_j;
			$data['group_mark']				= $row->group_mark;
			$data['group_seq_no']			= $row->group_seq_no;
			$data['is_active']				= $row->is_active;
		}
	    $this->template->set('title','Klinik | Master Lab Item');
		$this->template->load('template','menu/update_lab_item', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function process_update_lab_item(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$id						= $this->input->post('id_lab_item');
		
			$data_item			= array(
				'lab_item_desc'		=>$this->input->post('lab_item_desc'),
				'lab_item_abbr'		=>$this->input->post('item_abbr'),
				'lab_item_unit'		=>$this->input->post('item_unit'),
				'lab_item_group'	=>$this->input->post('item_group'),
				'lab_item_seq_no'	=>$this->input->post('item_seq'),
				'lab_item_case'		=>$this->input->post('case'),
				'lab_item_seq_no'	=>$this->input->post('urutan'),
			);
			$this->load->model('m_lab');
			$this->m_lab->update_group_lab($id,$data_item);

			//Cek Ip / cara membuat ip
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
			$ip = $_SERVER['REMOTE_ADDR'];
			}
			//End Cek Ip
			
			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'	=>$user_id,
						'log_date'	=>date("Y-m-d H:i:s"),
						'log_desc' 	=>"Update Item Lab | ID Lab : ".$id." | IP : ".$ip,
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
			
			// echo "<script>alert('Success update !!');window.close(this); </script>";
			echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";

 }



 function del_lab_item(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$id 					= $this->uri->segment(3);

		$data_item			= array(
			'is_active'		=>1,
		);
		$this->load->model('m_lab');
		$this->m_lab->update_group_lab($id,$data_item);

		//Cek Ip / cara membuat ip
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		$ip = $_SERVER['REMOTE_ADDR'];
		}
		//End Cek Ip
		
		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$data_log = array(
					'id_user'	=>$user_id,
					'log_date'	=>date("Y-m-d H:i:s"),
					'log_desc' 	=>"Del Item Lab | ID Lab : ".$id." | IP : ".$ip,
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log
		
		// echo "<script>alert('Success update !!');window.close(this); </script>";
		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";

 }

function mst_lab_item_excel(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_lab');				
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_lab->get_list_item();
		$this->load->view('menu/mst_lab_item_excel', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //fungsi load Master Lab Item
 function find_range_lab(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_lab');	
		$this->load->model('m_patient');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['list'] 			= $this->m_lab->get_item();
		$data['gender'] 		= $this->m_patient->get_list_gender();
		$data['data'] 			= $this->m_lab->get_list_range_2();
	    $this->template->set('title','Klinik | Find Lab Range');
		$this->template->load('template','menu/find_range_lab', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //fungsi load Master Lab Item
 function mst_lab_range(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_lab');	
		$this->load->model('m_patient');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['list'] 			= $this->m_lab->get_item();
		$data['gender'] 		= $this->m_patient->get_list_gender();
		$data['data'] 			= $this->m_lab->get_list_range_2();
	    $this->template->set('title','Klinik | Master Lab Range');
		$this->template->load('template','menu/mst_lab_range', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 function change_range(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_lab');	
		$this->load->model('m_patient');			
	  	$id 					= $this->uri->segment(3);
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['list'] 			= $this->m_lab->get_item();
		$data['gender'] 		= $this->m_patient->get_list_gender();
		$data['dodol']			= $this->m_lab->get_range_by_id($id);

	    $this->template->set('title','Klinik | Update Lab Range');
		$this->template->load('template','menu/change_lab_range', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //fungsi load Master Lab group
 function mst_lab_group(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_lab');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data']			= $this->m_lab->get_list_group();
	    $this->template->set('title','Klinik | Master Lab Group');
		$this->template->load('template','menu/mst_lab_group', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function mst_lab_group_excel(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_lab');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data']			= $this->m_lab->get_list_group();
		$this->load->view('menu/mst_lab_group_excel', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function update_mst_lab_group(){
 	if($this->session->userdata('logged_in')){	
		$this->load->model('m_lab');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $data['user_id'] 		= $session_data['id'];
		$data['id_group']		= $this->uri->segment(3);
		$get_data				= $this->m_lab->get_list_group_id($data['id_group']);

		foreach ($get_data->result() as $row) {
			$data['group_mark']			= $row->group_mark;
			$data['group_seq_no']		= $row->group_seq_no;
			$data['is_active']			= $row->is_active;
			$data['group_name']			= $row->group_name;
		}

	    $this->template->set('title','Klinik | Master Lab Group');
		$this->template->load('template','menu/update_mst_lab_group', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function process_update_mst_lab_group(){

	$id						= $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$id						= $this->input->post('id_group');
	$g_name					= $this->input->post('g_name');
	$g_number				= $this->input->post('g_number');

	// Update status
	$data_delete			= array(
	'group_name'			=>$g_name,		
	'group_seq_no'			=>$g_number,		
	);
	$this->load->model('m_lab');
	$this->m_lab->update_mst_lab_group($id,$data_delete);
	// End Update 

	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log 				= array(
	'id_user'				=>$user_id,
	'log_date'				=>date("Y-m-d H:i:s"),
	'log_desc' 				=>"Update Group Lab, id : ".$id." , By ". $user_id,
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log

	echo "<script>window.close(this); window.onunload = refreshParent; function refreshParent() { window.opener.location.assign('mst_lab_group/change'); }</script>";
 }

 function delete_group_lab(){

	$id						= $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	

	// Update status
	$data_delete			= array(
	'is_active'				=>1,		
	);
	$this->load->model('m_lab');
	$this->m_lab->update_mst_lab_group($id,$data_delete);
	// End Update 

	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log 				= array(
	'id_user'				=>$user_id,
	'log_date'				=>date("Y-m-d H:i:s"),
	'log_desc' 				=>"Delete Group Lab, id : ".$id." , Delete By ". $user_id,
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log


	redirect('lab/mst_lab_group/del');
 }

 function delete_service(){

	$id_price				= $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	

	// Update status
	$data_delete			= array(
	'is_active'				=>1,		
	);
	$this->load->model('m_quotation');
	$this->m_inv->delete_service_price($id_price,$data_delete);
	// End Update 

	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log 				= array(
	'id_user'				=>$user_id,
	'log_date'				=>date("Y-m-d H:i:s"),
	'log_desc' 				=>"Delete Service Price, id : ".$id_price." , Delete By ". $user_id,
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log


	redirect('marketing/mst_service/del');
 }
 
 //fungsi load Lab order
 function order_lab(){
    if($this->session->userdata('logged_in')){	
	  $this->load->model('m_lab');		
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['lab_item'] 		= $this->m_lab->get_lab_item2();
	  // $data['lab_item'] 		= $this->m_docter->get_mst_lab_item($id_reg);
	  $this->template->set('title','Klinik | Lab Order');
	  $this->template->load('template','menu/order_lab', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //fungsi load 

 function fetch_data(){
    if($this->session->userdata('logged_in')){	
	  $this->load->model('m_lab');		
	  $session_data 			= $this->session->userdata('logged_in');
	  $this->template->set('title','Klinik | Lab Order');
	  $this->template->load('template','menu/fetch_data');
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 
 function del_lab_order(){
    if($this->session->userdata('logged_in')){	
	  $session_data 			= $this->session->userdata('logged_in');
	  $this->load->model('m_lab');		
	  $data['id']				= $this->uri->segment(3);
	  $data['group']			= $this->uri->segment(4);

	  $this->template->set('title','Klinik | Delete Lab');
	  $this->template->load('template','menu/del_lab_order');
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 
 //fungsi simpan Lab order
 function save_order_lab(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$rowC					= $this->input->post('rowC');
		$data_lab				= array(
			'id_reg'		=>$this->input->post('id_reg'),
			'id_pat'		=>$this->input->post('id_pat'),
			'order_type'	=>1,
			'order_date'	=>date("Y-m-d h:i:s"),
			'order_status'	=>1,
			'user_id'		=>$user_id,
		);
		$this->load->model('m_lab');
		$this->m_lab->order_lab_h($data_lab);
		
			include './design/koneksi/file.php';
			$query 		="SELECT id_order id FROM pat_order_h ORDER BY id_order DESC LIMIT 1";  
			if($result 	=mysqli_query($con,$query))
			{
				$row 	=mysqli_fetch_assoc($result);
				$count 	=$row['id'];
			}
			
		for($i=1; $i<=$rowC; $i++)
		{			
			$uservalue = $this->input->post('lab_'.$i.'');
			$uservalue = explode(":", $uservalue);
			
			if ($uservalue[0] != ""){
			$sql = "INSERT INTO pat_order_d (id_order_header, id_service, seq_no, service_qty, id_dr, acct_code) VALUES ('".$count."', '".$uservalue[0]."', '1', '1', '1','1')";
			$this->db->query($sql);
			//echo $this->db->affected_rows();
			}else{
				
			}
		}
		
		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$data_log = array(
					'id_user'						=>$user_id,
					'log_date'						=>date("Y-m-d H:i:s"),
					'log_desc' 						=>"Create Order Lab : ".$this->input->post('id_reg')."",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log
		
		redirect('lab/order_lab/ok');
 }
 //fungsi simpan lab Group
 function save_group(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
			$data_group			= array(
				'group_name'	=>$this->input->post('g_name'),
				'group_seq_no'	=>$this->input->post('g_number'),
			);
			$this->load->model('m_lab');
			$this->m_lab->save_group($data_group);
		
			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d"),
						'log_desc' 						=>"Create Order Lab Group : ".$this->input->post('g_name')."",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log

			echo "<script>alert('Success! Update Data Master Services'); history.back();</script>";	
			// redirect('lab/mst_lab_group');
 }
 //fungsi update range lab
 function update_item_range(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$id_lab_item_range		= $this->input->post('id_lab_item_range');
		$idx					= explode(":",$this->input->post('lab_item'));

			$data_item_1			= array(
				'id_lab_item'		=>$idx[0],
				'low_limit'			=>$this->input->post('low_limit'),
				'type_lab'			=>$this->input->post('typ'),
				'name_type'			=>$this->input->post('dtl'),	
				'std_value'			=>$this->input->post('std_value'),
				'high_limit'		=>$this->input->post('high_limit'),
				'min_limit'			=>$this->input->post('min_limit'),
				'max_limit'			=>$this->input->post('max_limit'),
				'age_range_1'		=>$this->input->post('range_1'),
				'age_range_2'		=>$this->input->post('range_2'),
				'pat_gender'		=>$this->input->post('pat_gender'),
			);
			$this->load->model('m_lab');
			$this->m_lab->update_range_lab($id_lab_item_range,$data_item_1);
			
			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
		    $now					= date("Y-m-d H:i:s");
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>$now,
						'log_desc' 						=>"Update Range Lab : ".$this->input->post('id_lab_item_range')."",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
			
			echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";

 }

 function delete_item_range(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	

			$data_item_1			= array(
				'is_active'			=>1,
			);
			$this->load->model('m_lab');
			$this->m_lab->update_range_lab($id_lab_item_range,$data_item_1);
			
			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
		    $now					= date("Y-m-d H:i:s");
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>$now,
						'log_desc' 						=>"Delete Range Lab : ".$this->input->post('id_lab_item_range')."",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
			
			echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";

 }
 
 function delete_lab_order(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$id 					= $this->uri->segment(3);

		$data_process 		= array(
            'order_status'  =>3,
        );
        $this->load->model('m_lab');
        $this->m_lab->status_order($data_process,$id);
		
		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
	    $now					= date("Y-m-d H:i:s");
		$user_id				= $session_data['id'];	
		$data_log = array(
					'id_user'						=>$user_id,
					'log_date'						=>$now,
					'log_desc' 						=>"Delete Order Lab, table pat_order_h id : ".$id."",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log
		
		// echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
		redirect('lab/lab_job/1/del');

 }

 //fungsi simpan lab item range
 function save_item_range(){
			$filter					= $this->input->post('pat_gender');
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$idx					= explode(":",$this->input->post('lab_item'));
			
			if($filter=="yes"){
			$data_item_1			= array(
				'id_lab_item'		=>$idx[0],
				'low_limit'			=>$this->input->post('low_limit'),
				'type_lab'			=>$this->input->post('typ'),
				'name_type'			=>$this->input->post('dtl'),	
				'std_value'			=>$this->input->post('std_value'),
				'high_limit'		=>$this->input->post('high_limit'),
				'min_limit'			=>$this->input->post('min_limit'),
				'max_limit'			=>$this->input->post('max_limit'),
				'age_range_1'		=>$this->input->post('range_1'),
				'age_range_2'		=>$this->input->post('range_2'),
				'pat_gender'		=>1,
			);
			$this->load->model('m_lab');
			$this->m_lab->save_item_range($data_item_1);
			
			$data_item_2			= array(
				'id_lab_item'		=>$idx[0],
				'low_limit'			=>$this->input->post('low_limit'),
				'type_lab'			=>$this->input->post('typ'),
				'name_type'			=>$this->input->post('dtl'),	
				'std_value'			=>$this->input->post('std_value'),
				'high_limit'		=>$this->input->post('high_limit'),
				'min_limit'			=>$this->input->post('min_limit'),
				'max_limit'			=>$this->input->post('max_limit'),
				'age_range_1'		=>$this->input->post('range_1'),
				'age_range_2'		=>$this->input->post('range_2'),
				'pat_gender'		=>2,
			);
			$this->load->model('m_lab');
			$this->m_lab->save_item_range($data_item_2);
			}else{
			$data_item				= array(
				'id_lab_item'		=>$idx[0],
				'low_limit'			=>$this->input->post('low_limit'),
				'type_lab'			=>$this->input->post('typ'),
				'name_type'			=>$this->input->post('dtl'),	
				'std_value'			=>$this->input->post('std_value'),
				'high_limit'		=>$this->input->post('high_limit'),
				'min_limit'			=>$this->input->post('min_limit'),
				'max_limit'			=>$this->input->post('max_limit'),
				'age_range_1'		=>$this->input->post('range_1'),
				'age_range_2'		=>$this->input->post('range_2'),
				'pat_gender'		=>$this->input->post('pat_gender'),
			);
			$this->load->model('m_lab');
			$this->m_lab->save_item_range($data_item);
			}
			
			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d"),
						'log_desc' 						=>"Create Item Lab Range",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
			
			redirect('lab/mst_lab_range/ok');
 }
 //fungsi load Lab Job List
 function lab_job(){
    if($this->session->userdata('logged_in')){	
	  $this->load->model('m_lab');		
	  $id 						= $this->uri->segment(3);
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['data'] 			= $this->m_lab->get_lab_order($id);
	  $this->template->set('title','Klinik | Lab Order List');
	  $this->template->load('template','menu/lab_job', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //fungsi load Action Lab
 function lab_act(){
    if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_lab');	
	  $this->load->model('m_master');	

		$data_process = array(
				'order_status'	=>4,
		);
		$this->load->model('m_lab');
		$this->m_lab->status_order($data_process,$id);

	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $user_id					= $session_data['id'];	
	  $now						= date("Y-m-d H:i:s");
	  $cek_timer				= $this->m_master->cek_timer($id, 1);
	  $jml_timer				= $cek_timer->num_rows();
	  if ($jml_timer == 0) {
	  	
	  	$masuk_timer 		= array(
			'id_order'		=>$id,
			'group_id'		=>1,
			'open_time'		=>$now,
			'open_by'		=>$user_id,
			'is_status'		=>0,

		);
		$this->m_master->insert_timer($masuk_timer,$id);

	  }else{
	  	foreach ($cek_timer->result() as $keyt) {
	  		$id_timer		= $keyt->id_timer;
			$id_order		= $keyt->id_order;
			$group_id		= $keyt->group_id;
			$open_time		= $keyt->open_time;
			$open_by		= $keyt->open_by;
			$process_time	= $keyt->process_time;
			$process_by		= $keyt->process_by;
			$finish_time	= $keyt->finish_time;
			$finish_by		= $keyt->finish_by;
			$is_status		= $keyt->is_status;
	  	}
		
		$update_timer 		= array(
			'process_time'	=>$now,
			'process_by'	=>$user_id,
			'is_status'		=>1,
		);
		$this->m_master->update_timer($id_timer,$update_timer);
	  	
	  }


	  $data['data'] 			= $this->m_lab->get_lab_act_h($id);
	  foreach($data['data']->result() as $row)
		{
			$birth 	= $row->pat_dob;
			$gender = $row->pat_gender;
			//Function Convertion Age to Months
			$birthday = new DateTime($birth);
			$diff = $birthday->diff(new DateTime());
			$months = $diff->format('%m') + 12 * $diff->format('%y');
			//echo $months;
			//End of Function

		}
	  $data['detail'] 			= $this->m_lab->get_lab_act_d($id,$months,$gender);
	  $data['comment'] 			= $this->m_lab->get_lab_act_comment($id,$months,$gender);
	  $this->template->set('title','Klinik | Lab Process');
	  $this->template->load('template','menu/lab_act', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //fungsi load view Lab
 function lab_view(){
    if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_lab');		
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['data'] 			= $this->m_lab->get_lab_act_h($id);
	  foreach($data['data']->result() as $row)
		{
			$birth 	= $row->pat_dob;
			$gender = $row->pat_gender;
			//Function Convertion Age to Months
			$birthday = new DateTime($birth);
			$diff = $birthday->diff(new DateTime());
			$months = $diff->format('%m') + 12 * $diff->format('%y');
			//echo $months;
			//End of Function
		}
	  $data['detail'] 			= $this->m_lab->get_lab_result($id);
	  $this->load->view('menu/lab_view', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //fungsi load view Lab
 function lab_view_cancel(){
    if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_lab');		
	  $this->load->model('m_master');		
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['data'] 			= $this->m_lab->get_lab_act_h($id);
	  $data['notes'] 			= $this->m_master->cek_notes($id,1);
	  foreach($data['data']->result() as $row)
		{
			$birth 	= $row->pat_dob;
			$gender = $row->pat_gender;
			//Function Convertion Age to Months
			$birthday = new DateTime($birth);
			$diff = $birthday->diff(new DateTime());
			$months = $diff->format('%m') + 12 * $diff->format('%y');
			//echo $months;
			//End of Function
		}
	  $data['detail'] 			= $this->m_lab->get_lab_result($id);
	  $this->load->view('menu/lab_view_cancel', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
  //fungsi load view Lab
 function lab_view_mcu(){
    if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_lab');		
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['data'] 			= $this->m_lab->get_lab_act_h_mcu($id);
	  foreach($data['data']->result() as $row)
		{
			$birth 	= $row->pat_dob;
			$gender = $row->pat_gender;
			//Function Convertion Age to Months
			$birthday = new DateTime($birth);
			$diff = $birthday->diff(new DateTime());
			$months = $diff->format('%m') + 12 * $diff->format('%y');
			//echo $months;
			//End of Function
		}
	  $data['detail'] 			= $this->m_lab->get_lab_result_mcu($id);
	  $this->load->view('menu/lab_view_mcu', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //fungsi simpan Lab order
 function save_lab_act(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$rowC					= $this->input->post('rowC');
		$rowCin					= $this->input->post('rowCyin');
		$id						= $this->input->post('pat_order');
		$logaritma				= 0;
		$iscomplete				= 0;
		
		for($a=1; $a<=$rowC; $a++)
		{
		$min					= $this->input->post('min_range['.$a.']');
		$max					= $this->input->post('max_range['.$a.']');
		$result					= $this->input->post('result['.$a.']');
		$uservalue 				= $this->input->post('lab['.$a.']');
		$desc	   				= $this->input->post('id_lab_item['.$a.']');
		$name	   				= $this->input->post('name['.$a.']');
		$desc	   				= explode(":", $desc);
		$uservalue 				= explode(":", $uservalue);
		
		/*
		if($min == 0 && $max == 0 ){
					//$logaritma=0;		
		}else{
			if($result < $min || $result > $max ){
				echo "<script>if(confirm('Lab Results ".$name." : ".$result.", have exceeded the limit !') == false){location=history.go(-1)};</script>";
					//$logaritma=2;
			}else{
				if($logaritma == 2){
					//$logaritma=2;
				}else{
					$logaritma=0;		
				}
			}
		}
		*/	

	  $this->load->model('m_master');
	  $now						= date("Y-m-d H:i:s");
	  $cek_timer				= $this->m_master->cek_timer($id, 1);
	  $jml_timer				= $cek_timer->num_rows();
	  if ($jml_timer == 0) {
	  	
	  	$masuk_timer 		= array(
			'id_order'		=>$id,
			'group_id'		=>1,
			'open_time'		=>$now,
			'open_by'		=>$user_id,
			'is_status'		=>0,

		);
		$this->m_master->insert_timer($masuk_timer,$id);

	  }else{
	  	foreach ($cek_timer->result() as $keyt) {
	  		$id_timer		= $keyt->id_timer;
			$id_order		= $keyt->id_order;
			$group_id		= $keyt->group_id;
			$open_time		= $keyt->open_time;
			$open_by		= $keyt->open_by;
			$process_time	= $keyt->process_time;
			$process_by		= $keyt->process_by;
			$finish_time	= $keyt->finish_time;
			$finish_by		= $keyt->finish_by;
			$is_status		= $keyt->is_status;
	  	}
		
		$update_timer 		= array(
			'process_time'	=>$now,
			'process_by'	=>$user_id,
			'is_status'		=>1,
		);
		$this->m_master->update_timer($id_timer,$update_timer);
	  	
	  }

		
		if($this->input->post('complete') == ""){
				$iscomplete	=1;
				$logaritma	=4;
		}else{
				$iscomplete	=0;
				$logaritma	=0;

				$update_timer 		= array(
					'finish_time'	=>$now,
					'finish_by'		=>$user_id,
					'is_status'		=>2,
				);
				$this->m_master->update_timer($id_timer,$update_timer);

		}
		

				$sql = "INSERT INTO pat_lab_result (id_order, id_reg, id_pat, id_lab_item, result_value, lab_item_group, seq_no, is_normal,	remarks, ref_no, std_value, name_type, id_lab_range) VALUES ('".$this->input->post('pat_order')."', '".$this->input->post('pat_reg')."', '".$this->input->post('pat_id')."', '".$desc[0]."', '".$this->input->post('result['.$a.']')."','".$desc[1]."','".$desc[4]."','".$this->input->post('mark['.$a.']')."','".$desc[2]."','".$desc[3]."','".$desc[5]."','".$desc[6]."','".$desc[7]."')";
		
				//echo $sql;
				//die();
				//if($this->input->post('result['.$a.']') !==""){
				$this->db->query($sql);
				//}
		}
		
		for($b=1; $b<=$rowCin; $b++)
		{
			if($this->input->post('package') !=""){
				$sql = "INSERT INTO mst_mcu_comment (id_regist, order_type, id_group, id_group_seq) VALUES ('".$this->input->post('pat_reg')."','1', '".$this->input->post('id_lab['.$b.']')."', '".$this->input->post('group_seq['.$b.']')."')";
				
				echo $sql;
				//die();
				$this->db->query($sql);
				//echo $this->db->affected_rows();
			}
		}
		
		$data_process = array(
				'order_status'	=>$logaritma,
				'is_complete'	=>$iscomplete,
		);
		$this->load->model('m_lab');
		$this->m_lab->status_order($data_process,$id);

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$data_log = array(
					'id_user'						=>$user_id,
					'log_date'						=>date("Y-m-d"),
					'log_desc' 						=>"Process Lab Result : ".$this->input->post('pat_reg')."",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log
		
		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
		//redirect('lab/order_lab/ok');
 }
 //fungsi load view Lab
 function lab_app(){
   if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_lab');		
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['data'] 			= $this->m_lab->get_lab_act_h($id);
		{
	  foreach($data['data']->result() as $row)
			$gender = $row->pat_gender;
			$birth 	= $row->pat_dob;
			//Function Convertion Age to Months
			$birthday = new DateTime($birth);
			$diff = $birthday->diff(new DateTime());
			$months = $diff->format('%m') + 12 * $diff->format('%y');
			//echo $months;
			//End of Function
		}
	  $data['detail'] 			= $this->m_lab->get_lab_edit($id,$months,$gender);
	  $this->template->set('title','Klinik | Lab Approval');
	  $this->template->load('template','menu/lab_app', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
  //fungsi load view Lab
 function lab_edit(){
   if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_lab');		
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['data'] 			= $this->m_lab->get_lab_act_h($id);
		{
	  foreach($data['data']->result() as $row)
			$gender = $row->pat_gender;
			$birth 	= $row->pat_dob;
			//Function Convertion Age to Months
			$birthday = new DateTime($birth);
			$diff = $birthday->diff(new DateTime());
			$months = $diff->format('%m') + 12 * $diff->format('%y');
			//echo $months;
			//End of Function
		}
	  $data['detail'] 			= $this->m_lab->get_lab_edit($id,$months,$gender);
	  $data['comment'] 			= $this->m_lab->get_lab_act_comment($id,$months,$gender);
	  $this->template->set('title','Klinik | Lab Entry');
	  $this->template->load('template','menu/lab_edit', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //LAB revisi
  function lab_rev(){
   if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_lab');		
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['data'] 			= $this->m_lab->get_lab_act_h($id);
		{
	  foreach($data['data']->result() as $row)
			$gender = $row->pat_gender;
			$birth 	= $row->pat_dob;
			//Function Convertion Age to Months
			$birthday = new DateTime($birth);
			$diff = $birthday->diff(new DateTime());
			$months = $diff->format('%m') + 12 * $diff->format('%y');
			//echo $months;
			//End of Function
		}
	  $data['detail'] 			= $this->m_lab->get_lab_edit($id,$months,$gender);
	  $data['comment'] 			= $this->m_lab->get_lab_act_comment($id,$months,$gender);
	  $this->template->set('title','Klinik | Lab Revision');
	  $this->template->load('template','menu/lab_rev', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //fungsi approval lab
 function app_lab(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$rowC					= $this->input->post('rowC');
		$id						= $this->input->post('pat_order');
		$logaritma				= 1;
		
		for($a=1; $a<=$rowC; $a++)
		{
			
		$result					= $this->input->post('result['.$a.']');
		$uservalue 				= $this->input->post('lab['.$a.']');
		$desc	   				= $this->input->post('id_lab_item['.$a.']');
		$name	   				= $this->input->post('name['.$a.']');
		$desc	   				= explode(":", $desc);
		$uservalue 				= explode(":", $uservalue);
			
			//echo $logaritma;
			//die();
				//$sql = "INSERT INTO pat_lab_result (id_order, id_reg, id_pat, id_lab_item, result_value, lab_item_group, seq_no, is_normal,	remarks, ref_no) VALUES ('".$this->input->post('pat_order')."', '".$this->input->post('pat_reg')."', '".$this->input->post('pat_id')."', '".$desc[0]."', '".$this->input->post('result['.$a.']')."','".$desc[1]."','".$desc[4]."','".$this->input->post('mark['.$a.']')."','".$desc[2]."','".$desc[3]."')";
				
				//$sql = "UPDATE pat_lab_result SET result_value='".$this->input->post('result['.$a.']')."',is_normal='".$this->input->post('mark['.$a.']')."',spesial_char='".$this->input->post('char['.$a.']')."' WHERE id_order='".$this->input->post('pat_order')."' and id_lab_item='".$desc[0]."'";
				//echo $sql;
				//die();
				//$this->db->query($sql);
				//echo $this->db->affected_rows();
		}
		
		$data_process = array(
				'order_status'	=>0,
				'user_id'		=>$user_id,
		);
		$this->load->model('m_lab');
		$this->m_lab->status_order($data_process,$id);

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$data_log = array(
					'id_user'						=>$user_id,
					'log_date'						=>date("Y-m-d"),
					'log_desc' 						=>"Approval Lab : ".$this->input->post('pat_reg')."",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log
		
		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
		//redirect('lab/order_lab/ok');
 }
 //fungsi edit Lab
 function lab_update(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$rowC					= $this->input->post('rowC');
		$id						= $this->input->post('pat_order');
		$iscomplete				= 0;
		$logaritma				= 0;
		
		for($a=1; $a<=$rowC; $a++)
		{			
		$result					= $this->input->post('result['.$a.']');
		$uservalue 				= $this->input->post('lab['.$a.']');
		$desc	   				= $this->input->post('id_lab_item['.$a.']');
		$name	   				= $this->input->post('name['.$a.']');
		$desc	   				= explode(":", $desc);
		$uservalue 				= explode(":", $uservalue);
			
			//echo $logaritma;
			//die();
				//$sql = "INSERT INTO pat_lab_result (id_order, id_reg, id_pat, id_lab_item, result_value, lab_item_group, seq_no, is_normal,	remarks, ref_no) VALUES ('".$this->input->post('pat_order')."', '".$this->input->post('pat_reg')."', '".$this->input->post('pat_id')."', '".$desc[0]."', '".$this->input->post('result['.$a.']')."','".$desc[1]."','".$desc[4]."','".$this->input->post('mark['.$a.']')."','".$desc[2]."','".$desc[3]."')";
				include './design/koneksi/file.php';		
				$query="select * from pat_lab_result where id_order='".$this->input->post('pat_order')."' and id_lab_item='".$desc[0]."'";  
				if($result 	=mysqli_query($con,$query)){
				$sql = "UPDATE pat_lab_result SET result_value='".$this->input->post('result['.$a.']')."',is_normal='".$this->input->post('mark['.$a.']')."' WHERE id_order='".$this->input->post('pat_order')."' and id_lab_item='".$desc[0]."'";
				$this->db->query($sql);	
				}else{
				$update = "INSERT INTO pat_lab_result (id_order, id_reg, id_pat, id_lab_item, result_value, lab_item_group, seq_no, is_normal,	remarks, ref_no) VALUES ('".$this->input->post('pat_order')."', '".$this->input->post('pat_reg')."', '".$this->input->post('pat_id')."', '".$desc[0]."', '".$this->input->post('result['.$a.']')."','".$desc[1]."','".$desc[4]."','".$this->input->post('mark['.$a.']')."','".$desc[2]."','".$desc[3]."')";
		
				//echo $sql;
				//die();
				if($this->input->post('result['.$a.']') !==""){
				$this->db->query($update);
				}
				}
				

				//echo $this->db->affected_rows();
		}
		//die();
					
		if($this->input->post('complete') == ""){
					$iscomplete	=1;
					$logaritma	=4;
		}else{
					$iscomplete	=0;
					$logaritma	=0;
		}
		
		$data_process = array(
				'order_status'	=>$logaritma,
				'is_complete'	=>$iscomplete,
		);
		$this->load->model('m_lab');
		$this->m_lab->status_order($data_process,$id);
		
		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$data_log = array(
					'id_user'						=>$user_id,
					'log_date'						=>date("Y-m-d"),
					'log_desc' 						=>"Update Lab : ".$this->input->post('pat_reg')."",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log
		
		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
		//redirect('lab/order_lab/ok');
 }
//fungsi edit Lab
 function lab_rev_update(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$rowC					= $this->input->post('rowC');
		$id						= $this->input->post('pat_order');
		$iscomplete				= 0;
		$logaritma				= 0;
		
		for($a=1; $a<=$rowC; $a++){			
		$result					= $this->input->post('result['.$a.']');
		$uservalue 				= $this->input->post('lab['.$a.']');
		$desc	   				= $this->input->post('id_lab_item['.$a.']');
		$name	   				= $this->input->post('name['.$a.']');
		$desc	   				= explode(":", $desc);
		$uservalue 				= explode(":", $uservalue);
			
			//echo $logaritma;
			//die();
				//$sql = "INSERT INTO pat_lab_result (id_order, id_reg, id_pat, id_lab_item, result_value, lab_item_group, seq_no, is_normal,	remarks, ref_no) VALUES ('".$this->input->post('pat_order')."', '".$this->input->post('pat_reg')."', '".$this->input->post('pat_id')."', '".$desc[0]."', '".$this->input->post('result['.$a.']')."','".$desc[1]."','".$desc[4]."','".$this->input->post('mark['.$a.']')."','".$desc[2]."','".$desc[3]."')";
		if($this->input->post('result['.$a.']') !=""){		
		
			if($desc[5]==""){
				$sql = "UPDATE pat_lab_result SET result_value='".$this->input->post('result['.$a.']')."',is_normal='".$this->input->post('mark['.$a.']')."',revision=revision+1 WHERE id_order='".$this->input->post('pat_order')."' and id_lab_item='".$desc[0]."'";
			}else{
				$sql = "UPDATE pat_lab_result SET result_value='".$this->input->post('result['.$a.']')."',is_normal='".$this->input->post('mark['.$a.']')."',revision=revision+1 WHERE id_order='".$this->input->post('pat_order')."' and id_lab_item='".$desc[0]."' and id_lab_range='".$desc[5]."'";
			}
				//echo $sql;
				$this->db->query($sql);
				//echo $this->db->affected_rows();
				$sql_insert = "insert into pat_lab_result_old (id_order, id_lab_item, lab_result, is_normal, datetime) values ('".$id."', '".$desc[0]."', '".$this->input->post('result_old['.$a.']')."', '".$this->input->post('normal_old['.$a.']')."', '".date("Y-m-d H:i:s")."')";
				$this->db->query($sql_insert);
				//echo $sql_insert;
				//die();
			}
		}
		
				
	//	die();
		
		$data_process = array(
				'order_status'	=>2,
				'is_complete'	=>1,
		);
		$this->load->model('m_lab');
		$this->m_lab->status_order($data_process,$id);
		
		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$data_log = array(
					'id_user'						=>$user_id,
					'log_date'						=>date("Y-m-d"),
					'log_desc' 						=>"Update Lab Revision : ".$this->input->post('pat_reg')."",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log
		
		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
		//redirect('lab/order_lab/ok');
 }

//fungsi upload range lab
 function upload_range(){ 
   if($this->session->userdata('logged_in'))
   {
	 // tamplate default  
     $this->load->model('m_lab');	
		$this->load->model('m_patient');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_lab->get_list_group();
		$data['item'] 			= $this->m_lab->get_list_item();
		$data['gender'] 		= $this->m_patient->get_list_gender();
	    $this->template->set('title','Klinik | Upload Range'); //sesuikan title dengan namanya
		$this->template->load('template','menu/upload_range', $data); //sesuikan viewnya
   } else {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }
 
  //Upload Range Excel
 function upload_range_insert(){
		$this->load->library('form_validation');
		$this->load->helper('security');
		
	 
            // config upload
            $config['upload_path'] = "design/file/";
            $config['allowed_types'] = "xls";
            $config['max_size'] = "10000";
			//$config['file_name']= "judul.xls";
            $this->load->library("upload", $config);

//            if ( ! $this->upload->do_upload('gambar')) {
//                // jika validasi file gagal, kirim parameter error ke index
//                $error = array('error' => $this->upload->display_errors());
//                $this->index($error);
//            } else {
              // jika berhasil upload ambil data dan masukkan ke database
              $upload_data = $this->upload->data();
              // load library Excell_Reader
              $this->load->library('Excel_reader');

              //tentukan file
              $this->excel_reader->setOutputEncoding('230787');
              $file = $upload_data['full_path'];
              $this->excel_reader->read($file);
              error_reporting(E_ALL ^ E_NOTICE);

              // array data
              $data = $this->excel_reader->sheets[0];
              $dataexcel = Array();
              for ($i = 1; $i <= $data['numRows']; $i++) {
                   if ($data['cells'][$i][1] == '')
                       break;
                   $dataexcel[$i - 1]['id_lab_item'] 			= $data['cells'][$i][1];
                   $dataexcel[$i - 1]['low_limit'] 				= $data['cells'][$i][2];
                   $dataexcel[$i - 1]['high_limit'] 			= $data['cells'][$i][3];
                   $dataexcel[$i - 1]['min_limit'] 				= $data['cells'][$i][4];
                   $dataexcel[$i - 1]['max_limit'] 				= $data['cells'][$i][5];
                   $dataexcel[$i - 1]['age_range_1'] 			= $data['cells'][$i][6];
                   $dataexcel[$i - 1]['age_range_2'] 			= $data['cells'][$i][7];
                   $dataexcel[$i - 1]['pat_gender'] 			= $data['cells'][$i][8];
				   
				  
              }
              
              //load model
              $this->load->model('m_lab');
              $this->m_lab->loaddata($dataexcel);

              //delete file
              $file = $upload_data['file_name'];
              $path = './temp_upload/' . $file;
              unlink($path);
			  redirect(site_url('out'));
//            }
        //redirect ke halaman awal
       
        
 }
 //fungsi load update group lab
 function update_lab_2(){
	  $id 	= $this->uri->segment(3);
	  $val 	= $this->uri->segment(4);
	  $data = array(
				'lab_item_group'  =>$val,	    
	  );
	  $this->load->model('m_lab');	
	  $session_data 			= $this->session->userdata('logged_in');
	  $user						= $session_data['id'];
	  $data['data'] 			= $this->m_lab->update_group_lab($id,$data);
	  include './design/koneksi/file.php';
      $find=mysqli_query($con,"select lab_item_seq_no+1 id from mst_lab_item where lab_item_group='$val' order by lab_item_seq_no desc limit 1");
		if(mysqli_num_rows($find)== 0){
			$nilai = 0;
		}else{
			while($row=mysqli_fetch_array($find))
			if($val=="0"){
			$nilai = $val;
			}else{
			$nilai = $row['id'];
			}
			
		}
	  $datanya = array(
			'lab_item_seq_no'  =>$nilai,	    
	  );
	   $data['data'] 			= $this->m_lab->update_group_lab($id,$datanya);
 }
 //fungsi update lab case
 function update_lab_3(){
	  $id 	= $this->uri->segment(3);
	  $val 	= $this->uri->segment(4);
	  $data = array(
		'lab_item_case'  =>$val,	    
	  );
	  $this->load->model('m_lab');	
	  $session_data 			= $this->session->userdata('logged_in');
	  $user						= $session_data['id'];
	  $data['data'] 			= $this->m_lab->update_group_lab($id,$data);
 }

//fungsi update lab case
 function update_lab_4(){
	  $id 	= $this->uri->segment(3);
	  $val 	= $this->uri->segment(4);
	  $data = array(
		'lab_item_sampling'  =>$val,	    
	  );
	  $this->load->model('m_lab');	
	  $session_data 			= $this->session->userdata('logged_in');
	  $user						= $session_data['id'];
	  $data['data'] 			= $this->m_lab->update_group_lab($id,$data);
 }
 
}
?>