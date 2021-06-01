<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Radiology extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
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
 //fungsi load order radiology
 function order_radiology(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_rad');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['item'] 			= $this->m_rad->get_rad_item();
	    $this->template->set('title','Klinik | Order Radiology');
		$this->template->load('template','menu/order_radiology', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //fungsi simpan Radiology Order
 function save_order_rad(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$rowC					= $this->input->post('rowC');
		$data_lab				= array(
			'id_reg'		=>$this->input->post('id_reg'),
			'id_pat'		=>$this->input->post('id_pat'),
			'order_type'	=>2,
			'order_date'	=>date("Y-m-d h:i:s"),
			'order_status'	=>1,
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
			error_reporting(0);
			
			if ($this->input->post('dat'.$i.'') == ""){
				$iscomp = "0";
			}else{
				$iscomp = $this->input->post('dat'.$i.'');
			}
			
			$uservalue = $this->input->post('rad_'.$i.'');
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
					'log_date'						=>date("Y-m-d"),
					'log_desc' 						=>"Create Order Radiology : ".$this->input->post('id_reg')."",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log
		
		redirect('radiology/order_radiology/ok');
 }
 
 //fungsi load Radiology Job List
 function radiology_job(){
    if($this->session->userdata('logged_in')){	
	  $this->load->model('m_rad');		
	  $data['id'] 						= $this->uri->segment(3);
	  if($data['id'] == ""){$data['id'] = 1;}
	  // echo $data['id'];
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['data'] 			= $this->m_rad->get_rad_order_print($data['id']);
	  // if($id==1){
	  // $data['data'] 			= $this->m_rad->get_rad_order();
	  // }else{
	  // $data['data'] 			= $this->m_rad->get_rad_order_print($id);
	  // }
	  $this->template->set('title','Klinik | Radiology Order List');
	  $this->template->load('template','menu/rad_job', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 
 function radiology_job_excel(){
    if($this->session->userdata('logged_in')){	
	  $this->load->model('m_rad');		
	  $id 						= $this->uri->segment(3);
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  if($id==1){
	  $data['data'] 			= $this->m_rad->get_rad_order($id);
	  }else{
	  $data['data'] 			= $this->m_rad->get_rad_order_print($id);
	  }
	  $this->load->view('menu/radiology_job_excel', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 
  //fungsi load Group Radiology List
 function input_radiology_group(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_rad');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data']			= $this->m_rad->get_list_group();
	    $this->template->set('title','Klinik | Master Radiology Group');
		$this->template->load('template','menu/input_radiology_group', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

function input_radiology_group_excel(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_rad');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data']			= $this->m_rad->get_list_group();
		$this->load->view('menu/input_radiology_group_excel', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function update_radiology_group(){
 	if($this->session->userdata('logged_in')){	
		$this->load->model('m_rad');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['id_group']		= $this->uri->segment(3);
		$get_data				= $this->m_rad->get_list_group_id($data['id_group']);

		foreach ($get_data->result() as $row) {
			$data['group_seq_no']	= $row->group_seq_no;
			$data['group_desc']		= $row->group_desc;
		}

	    $this->template->set('title','Klinik | Master Radiology Group');
		$this->template->load('template','menu/update_radiology_group', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function process_update_radiology_group(){

	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$id 					= $this->input->post('id_group');
	$g_name 				= $this->input->post('g_name');
	$g_number 				= $this->input->post('g_number');

	// Update status
	$data_update			= array(
	'group_desc'			=>$g_name,		
	'group_seq_no'			=>$g_number,		
	);
	$this->load->model('m_rad');
	$this->m_rad->update_mst_rad_group($id,$data_update);
	// End Update 

	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log 				= array(
	'id_user'				=>$user_id,
	'log_date'				=>date("Y-m-d H:i:s"),
	'log_desc' 				=>"Update Group Radiology, id : ".$id." , Delete By ". $user_id,
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log

	echo "<script>window.close(this); window.onunload = refreshParent; function refreshParent() { window.opener.location.assign('input_radiology_group/change'); }</script>";
 }

 function delete_group_radiology(){

	$id						= $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	

	// Update status
	$data_delete			= array(
	'is_active'				=>1,		
	);
	$this->load->model('m_rad');
	$this->m_rad->update_mst_rad_group($id,$data_delete);
	// End Update 

	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log 				= array(
	'id_user'				=>$user_id,
	'log_date'				=>date("Y-m-d H:i:s"),
	'log_desc' 				=>"Delete Group Radiology, id : ".$id." , Delete By ". $user_id,
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log


	redirect('radiology/input_radiology_group/del');
 }
 
  function update_rad_2(){
	  $id 	= $this->uri->segment(3);
	  $val 	= $this->uri->segment(4);
	
	  $data 	= array(
				'rad_item_group' =>$val,	    
				);
	  $this->load->model('m_rad');	
	  $session_data 			= $this->session->userdata('logged_in');
	  $user						= $session_data['id'];
	  $data['data'] 			= $this->m_rad->update_group_rad($id,$data);
 }
 
  //fungsi load Group Radiology List
 function input_radiology_items(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_rad');	
		$this->load->model('m_patient');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_rad->get_list_group();
		$data['item'] 			= $this->m_rad->get_rad_item();
		$data['gender'] 		= $this->m_patient->get_list_gender();
	    $this->template->set('title','Klinik | Master Radiology Item');
		$this->template->load('template','menu/input_radiology_items', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 
 function input_radiology_items_excel(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_rad');	
		$this->load->model('m_patient');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_rad->get_list_group();
		$data['item'] 			= $this->m_rad->get_rad_item();
		$data['gender'] 		= $this->m_patient->get_list_gender();
		$this->load->view('menu/input_radiology_items_excel', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 
  function delete_items(){
	 $id = $this->uri->segment(3);
	 $this->load->model('m_rad');
	 	 $data_app 	= array(
				'status'			=>1,
			);
	 $this->m_rad->delete_items($id,$data_app);
	 // kembalikan ke halaman user
	 redirect('/radiology/input_radiology_items/del');
 } 

  //fungsi load 
 function fetch_data_rad(){
    if($this->session->userdata('logged_in')){	
	  $this->load->model('m_rad');		
	  $session_data 			= $this->session->userdata('logged_in');
	  $this->template->set('title','Klinik | Radiology Order');
	  $this->template->load('template','menu/fetch_data_rad');
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 
  //fungsi simpan lab item
 function save_item(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
			$data_item			= array(
				'rad_item'		=>$this->input->post('lab_item_desc'),
				//'lab_item_abbr'		=>$this->input->post('item_abbr'),
				//'lab_item_unit'		=>$this->input->post('item_unit'),
				'rad_item_group'	=>$this->input->post('item_group'),
				'seq_no'	=>$this->input->post('item_seq'),
				//'lab_item_case'		=>$this->input->post('case'),
			);
			$this->load->model('m_rad'); 
			$this->m_rad->save_item($data_item);
			
			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d"),
						'log_desc' 						=>"Create Item Lab : ".$this->input->post('lab_item_desc')."",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
			
			redirect('radiology/input_radiology_items/ok');
 }
 
 //fungsi simpan lab Group
 function save_group(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
			$data_group			= array(
				'group_desc'	=>$this->input->post('g_name'),
				'group_seq_no'	=>$this->input->post('g_number'),
			);
			$this->load->model('m_rad');
			$this->m_rad->save_group($data_group);
		
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
			
			redirect('radiology/input_radiology_group/ok');
 }


 function delete_rad_order(){
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
					'log_desc' 						=>"Delete Order Radiology, table pat_order_h id : ".$id."",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log
		
		// echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
		redirect('radiology/radiology_job/1/del');

 }

 
 //fungsi load Action Radiology
 function rad_act(){
    if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_lab');		
	  $this->load->model('m_rad');
	  $this->load->model('m_patient');		  
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['data'] 			= $this->m_lab->get_lab_act_h($id);
	  $data['detail'] 			= $this->m_rad->get_rad_act_d($id);
	  $data['comment'] 			= $this->m_rad->get_rad_act_comment($id);
	  $data['comment_doc']		= $this->m_patient->get_data_comment();
	  $this->template->set('title','Klinik | Radiology Process');
	  $this->template->load('template','menu/rad_act', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi load Update Radiology
 function rad_rev(){
    if($this->session->userdata('logged_in')){	
	  $id 			= $this->uri->segment(3);
	  $id_reg 		= $this->uri->segment(4);
	  $this->load->model('m_lab');		
	  $this->load->model('m_rad');
	  $this->load->model('m_patient');		  
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['data'] 			= $this->m_lab->get_lab_act_h($id);
	  $data['detail'] 			= $this->m_rad->get_rad_act_d($id);
	  $data['comment'] 			= $this->m_rad->get_rad_act_comment($id);
	  $data['comment_doc']		= $this->m_patient->get_data_comment();
	  $hasil					= $this->m_rad->get_list_pat_rad_result($id_reg);
	  $data['id_rad_result']	= array();
	  $data['id_reg']			= array();
	  $data['id_pat']			= array();
	  $data['id_order']			= array();
	  $data['id_rad_item']		= array();
	  $data['nama_value']		= array();
	  $data['result']			= array();
	  $data['seq_no']			= array();
	  $data['doctor_exam']		= array();

	  foreach ($hasil->result() as $row) {
	  	  $data['id_rad_result'][]	= $row->id_rad_result;
		  $data['id_reg'][]			= $row->id_reg;
		  $data['id_pat'][]			= $row->id_pat;
		  $data['id_order'][]		= $row->id_order;
		  $data['id_rad_item'][]	= $row->id_rad_item;
		  $data['nama_value'][]		= $row->nama_value;
		  $data['result'][]			= $row->result;
		  $data['seq_no'][]			= $row->seq_no;
		  $data['doctor_exam'][]	= $row->doctor_exam;
	  }


	  $this->template->set('title','Klinik | Radiology Process');
	  $this->template->load('template','menu/rad_rev', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }


 function rad_approval(){
    if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_rad');	
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['header'] 			= $this->m_rad->get_rad_report_h($id);
	  $data['detail'] 			= $this->m_rad->get_rad_report_d($id);
	  $this->load->view('menu/rad_app', $data);
	  
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 } 
 
 
 //fungsi load Action Radiology
 function rad_report(){
    if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_rad');	
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['header'] 			= $this->m_rad->get_rad_report_h($id);
	  $data['detail'] 			= $this->m_rad->get_rad_report_d($id);
	  $this->load->view('menu/rad_report', $data);
	  
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 } 
 
  //fungsi load Action Radiology
 function rad_report_mcu(){
    if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_rad');	
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['header'] 			= $this->m_rad->get_rad_report_mcu_h($id);
	  $data['detail'] 			= $this->m_rad->get_rad_report_d($id);
	  $this->load->view('menu/rad_report_mcu', $data);
	  
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 } 
 
  //fungsi load Action Radiology
 function rad_report2(){
    if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_rad');	
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['data'] 			= $this->m_rad->get_rad_report();
	  $data['detail'] 			= $this->m_rad->get_rad_report_d($id);
	  $this->load->view('menu/rad_report2', $data);
	  
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 } 
 
 //fungsi load Action Radiology
 function rad_report_order(){
    if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_rad');	
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['data'] 			= $this->m_rad->rad_order_report_h();
	  $this->template->set('title','Klinik | Radiology Process');
	  $this->template->load('template','menu/rad_order_report', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
	
 }
 //fungsi load Action Radiology
 function save_rad_act(){
    if($this->session->userdata('logged_in')){	
	  $this->load->model('m_lab');		
	  $this->load->model('m_rad');
	  $idx 			=$this->uri->segment(3);
	  $id_reg 		=$this->input->post('id_reg');
	  $id_pat 		=$this->input->post('id_pat');
	  $id_rad_item 	=$this->input->post('id_rad_item');
	  $result		=$this->input->post('result');
	  $id_order		=$idx;
	  $seq_no 		=$this->input->post('seq_no');		
	  $id 			=$this->input->post('id_segment');
	  $rowCyin		=$this->input->post('rowCyin');
	  $rowC 		=$this->input->post('rowC');
		
		//echo $rowC;
		for($a=1; $a<=$rowC; $a++)
		{
			$hasil_comment_rad = "";
			$cars = $this->input->post('comment_rad_'.$a.'');
			//$pemisah = $cars[$a];
			//echo $pemisah;
			$hasil = explode(":", $cars);
			//echo $hasil[1];
			//echo $hasil;
			if (isset($cars)){
				//$hasil_comment_rad = implode(':', $cars);
       		}
			$sql = "INSERT INTO pat_rad_result (id_reg, id_pat, id_order, id_rad_item, result, seq_no, doctor_exam, nama_value) VALUES ('$id_reg', '$id_pat', '$id_order','".$this->input->post('id_rad_item['.$a.']')."', '".$hasil[1]."', '".$this->input->post('seq_no['.$a.']')."', '".$this->input->post('dr_'.$a.'')."', '".$this->input->post('nama_value['.$a.']')."')";
			$this->db->query($sql);
			//echo $hasil[$a];
			//echo $sql;
			//echo $sql."</br>";
		}
			
			
			//die();
		//for($b=1; $b<=$rowCyin; $b++)
		//{
		//	$sql = "INSERT INTO mst_mcu_comment (id_regist, order_type, id_group, id_group_seq) VALUES ('".$this->input->post('id_reg')."','2', '".$this->input->post('id_rad['.$b.']')."', '".$this->input->post('group_seq['.$b.']')."')";
		//	$this->db->query($sql);
		//} 		

		$data_process = array(
			'order_status'	=>0,
		);

 		$this->load->model('m_lab');
		$s = $this->m_lab->status_order($data_process,$id); 
		
		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

  //fungsi load Action Update Radiology
 function update_rad_act(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_lab');		
		$this->load->model('m_rad');
		$idx 					= $this->uri->segment(3);
		$id_reg 				= $this->input->post('id_reg');
		$id_pat 				= $this->input->post('id_pat');
		$id_rad_item 			= $this->input->post('id_rad_item');
		$result					= $this->input->post('result');
		$id_order				= $idx;
		$seq_no 				= $this->input->post('seq_no');		
		$id 					= $this->input->post('id_segment');
		$rowCyin				= $this->input->post('rowCyin');
		$rowC 					= $this->input->post('rowC');
		$id_rad_result 			= $this->input->post('id_rad_result');
		$nomor 					= 0;
		$hasil_comment_rad 		= "";
		
		
		for($a=1; $a<=$rowC; $a++)
		{
			$cars 					= $this->input->post('comment_rad_'.$a.'');
			$hasil 					= explode(":", $cars);
			
			$data_update = array(
			'result' 		=> $hasil[1], 
			'doctor_exam' 	=> $this->input->post('dr_'.$a.''), 
			);
	 		$this->load->model('m_rad');
			$this->m_rad->update_pat_rad_result_byid($id_rad_result[$nomor],$data_update); 

			$nomor++;
		}
			
		$data_process = array(
			'order_status'	=>2,
		);
 		$this->load->model('m_lab');
		$s = $this->m_lab->status_order($data_process,$id); 


		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function radiology_app(){
    if($this->session->userdata('logged_in')){	
		$idx		= $this->uri->segment(3);
		$data_process = array(
			'order_status'	=>0,
		);
 		$this->load->model('m_lab');
		$this->m_lab->status_order($data_process,$idx); 
		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }


 
}
?>