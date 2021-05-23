<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Smart extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
 }
/*  	var $limit = 10;
	var $reg = 'reg_patien';
  */
	function index(){
	if($this->session->userdata('logged_in'))
	{
	 $this->load->library('session');
	 $session_data = $this->session->userdata('logged_in');
	 $data['username'] = $session_data['username'];
	 $this->load->view('menu/index.php', $data);
	}else{
	 //If no session, redirect to login page
	 redirect('login', 'refresh');
	}
	}


	function list_notif(){
	    if($this->session->userdata('logged_in')){
		$this->load->model('m_smart');
		$session_data                  	= $this->session->userdata('logged_in');
	    $data['username']              	= $session_data['username'];
	    $data['user_id']               	= $session_data['id'];
		$data['userlevel']				= $session_data['userlevel'];
		$loc 	                      	= $session_data['location'];
		$jobs 						 	= $session_data['jobs'];
		$data['get_list_1']            	= $this->m_smart->get_list_1(); 
		$data['get_list_2']            	= $this->m_smart->get_list_2($jobs); 
		$data['get_list_3']            	= $this->m_smart->get_list_3($jobs); 
		$data['get_list_4']            	= $this->m_smart->get_list_4($jobs); 
		$data['get_list_5']            	= $this->m_smart->get_list_5($jobs); 
		$data['get_list_6']            	= $this->m_smart->get_list_6($jobs); 
		$data['get_list_7']            	= $this->m_smart->get_list_7($data['user_id']); 
		$data['get_list_8']            	= $this->m_smart->get_list_8($jobs); 
		$data['get_list_9']            	= $this->m_smart->get_list_9($jobs); 
		$data['get_list_10']            = $this->m_smart->get_list_10(); 
	    $this->template->set('title','Klinik | List Notification');
		$this->template->load('template','menu/list_notif', $data);
		}else{
		//If no session, redirect to login page
		redirect('login', 'refresh');
		}	
	}


	//fungsi Load Detail Request Item
	function price_n(){
		if($this->session->userdata('logged_in')){	
			$this->load->model('m_smart');			
			$this->load->model('m_inv');			
			$this->load->model('m_quotation');		
			$id 					= $this->uri->segment(3);
			$ic						= $this->uri->segment(4);
			$data['id_smart']		= $this->uri->segment(3);
			$session_data 			= $this->session->userdata('logged_in');
		    $data['username'] 		= $session_data['username'];
			$user_id		 		= $session_data['id'];
			$jobs 					= $session_data['jobs'];
			$get_smartid 			= $this->m_smart->get_smartid($id); 
			$data['list'] 			= $this->m_smart->get_list_6($jobs); 
			$data['sv_group'] 		= $this->m_inv->get_list_ig();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			$data['pay_type'] 		= $this->m_quotation->get_type2($ic);
			$data['branch'] 		= $this->m_quotation->get_branch();
			foreach ($get_smartid->result() as $row) {$id_item = $row->id_trouble;}
			$data['get_items']		= $this->m_smart->get_items($id_item);
		    
		    $this->template->set('title','Klinik | Transfer Item List');
			$this->template->load('template','menu/price_n', $data);
		} else {
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}	
	}

	function save_mst_items_price(){		
		$session_data 			= $this->session->userdata('logged_in');		
		$user_id		 		= $session_data['id'];
		$rowC					= $this->input->post('count_ant');			
		$id_smart				= $this->input->post('id_smart');			
		$data_update 			= array('status' => 0, );
		$this->load->model('m_smart');			
		$this->m_smart->update_smart_sts($id_smart,$data_update);

		if($rowC==""){				
			$rowC="1";			
		}else{				
			$rowC=$rowC;			
		}

		for($i=1; $i<=$rowC; $i++){			
			$sql = "INSERT INTO mst_item_price (id_item, price_type, price, currency, id_branch,create_by) VALUES ('".$this->input->post('id_item')."', '".$this->input->post('type_'.$i.'')."', '".str_replace(",","",$this->input->post('price_'.$i.''))."', '".$this->input->post('curr_type_'.$i.'')."', '".$this->input->post('branch')."','$user_id')";			
			$this->db->query($sql);
		}			

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$data_log = array(
					'id_user'	=>$user_id,
					'log_date'	=>date("Y-m-d"),
					'log_desc' 	=>"Save item price, id smart : ".$this->input->post('id_smart')."",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log

		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
	}

	//fungsi Load Detail Request Item
	function price_n2(){
		if($this->session->userdata('logged_in')){	
			$this->load->model('m_smart');			
			$this->load->model('m_inv');			
			$this->load->model('m_quotation');		
			$id 						= $this->uri->segment(3);
			$ic 						= $this->uri->segment(4);
			$data['id_smart']			= $this->uri->segment(3);
			$session_data 				= $this->session->userdata('logged_in');
		    $data['username'] 			= $session_data['username'];
			$user_id		 			= $session_data['id'];
			$jobs 						= $session_data['jobs'];
			$get_smartid 				= $this->m_smart->get_smartid($id); 
			$get_rad_items 				= $this->m_smart->get_rad_items($id); 

			foreach ($get_smartid->result() as $row) {
			$data['id_item']			= $row->id_trouble;
			$data['id_department']		= $row->id_department;
			$data['id_source_trouble']	= $row->id_source_trouble;
			$data['type_id']			= $row->type_id;
			$data['notes']				= $row->notes;
			$data['create_date']		= $row->create_date;
			}
			
			foreach ($get_rad_items->result() as $row2) {
			$data['rad_item']			= $row2->rad_item;
			}

			$data['pay_type'] 			= $this->m_quotation->get_type3($data['id_source_trouble']);
			$data['branch'] 			= $this->m_quotation->get_branch();
		    
		    $this->template->set('title','Klinik | Smart Notification');
			$this->template->load('template','menu/price_n2', $data);
		} else {
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}	
	}
	
	function price_lab(){
		if($this->session->userdata('logged_in')){	
			$this->load->model('m_smart');			
			$this->load->model('m_inv');			
			$this->load->model('m_quotation');		
			$id 						= $this->uri->segment(3);
			$ic 						= $this->uri->segment(4);
			$data['id_smart']			= $this->uri->segment(3);
			$session_data 				= $this->session->userdata('logged_in');
		    $data['username'] 			= $session_data['username'];
			$user_id		 			= $session_data['id'];
			$jobs 						= $session_data['jobs'];
			$get_smartid 				= $this->m_smart->get_smartid($id); 
			$get_lab_items 				= $this->m_smart->get_lab_items($id); 

			foreach ($get_smartid->result() as $row) {
			$data['id_item']			= $row->id_trouble;
			$data['id_department']		= $row->id_department;
			$data['id_source_trouble']	= $row->id_source_trouble;
			$data['type_id']			= $row->type_id;
			$data['notes']				= $row->notes;
			$data['create_date']		= $row->create_date;
			}
			
			foreach ($get_lab_items->result() as $row2) {
			$data['lab_items']			= $row2->lab_item_desc;
			}

			$data['pay_type'] 			= $this->m_quotation->get_type3($data['id_source_trouble']);
			// $data['pay_type'] 			= $this->m_quotation->get_type2($ic);
			$data['branch'] 			= $this->m_quotation->get_branch();
		    
		    $this->template->set('title','Klinik | Smart Notification');
			$this->template->load('template','menu/price_lab', $data);
		} else {
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}	
	}

		
	function price_other(){
		if($this->session->userdata('logged_in')){	
			$this->load->model('m_smart');			
			$this->load->model('m_inv');			
			$this->load->model('m_quotation');		
			$id 						= $this->uri->segment(3);
			$ic 						= $this->uri->segment(4);
			$ig 						= $this->uri->segment(5);
			$data['id_smart']			= $this->uri->segment(3);
			$session_data 				= $this->session->userdata('logged_in');
		    $data['username'] 			= $session_data['username'];
			$user_id		 			= $session_data['id'];
			$jobs 						= $session_data['jobs'];
			$get_smartid 				= $this->m_smart->get_smartid($id); 
			$get_lab_items 				= $this->m_smart->get_other_items($id); 

			foreach ($get_smartid->result() as $row) {
			$data['id_item']			= $row->id_trouble;
			$data['id_department']		= $row->id_department;
			$data['id_source_trouble']	= $row->id_source_trouble;
			$data['type_id']			= $row->type_id;
			$data['notes']				= $row->notes;
			$data['create_date']		= $row->create_date;
			}
			
			foreach ($get_lab_items->result() as $row2) {
			$data['serv_name']			= $row2->serv_name;
			$data['type_id']			= $row2->type_id;
			$data['group_desc']			= $row2->group_desc;
			}

			$data['pay_type'] 			= $this->m_quotation->get_type3($ig);
			$data['branch'] 			= $this->m_quotation->get_branch();
		    
		    $this->template->set('title','Klinik | Smart Notification');
			$this->template->load('template','menu/price_other', $data);
		} else {
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}	
	}
	
	function save_item_aja(){

		$this->load->model('m_smart');
		$this->load->model('m_quotation');

		$session_data 			= $this->session->userdata('logged_in');		
		$user_id		 		= $session_data['id'];
		$rowC					= $this->input->post('count_ant');			
		$id_smart				= $this->input->post('id_smart');			
		$id_group				= $this->input->post('id_group');			
		$grp_services			= $this->input->post('grp_services');			
		$serv_name				= $this->input->post('serv_name');			
		$serv_code				= $this->input->post('serv_code');			
		$branch					= $this->input->post('branch');			
		$serv_code				= $this->input->post('serv_code');			
		$now					= date("Y-m-d H:i:s");
		$get_smartid 			= $this->m_smart->get_smartid($id_smart);

		// Proses cek data
		foreach ($get_smartid->result() as $row) {
		$id_item				= $row->id_trouble;
		$id_department			= $row->id_department;
		$id_source_trouble		= $row->id_source_trouble;
		$type_id				= $row->type_id;
		$notes					= $row->notes;
		$create_date			= $row->create_date;
		}		

		$get_mst_services		= $this->m_smart->get_mst_services($type_id,$id_item);
		$jml_a					= $get_mst_services->num_rows();

		if ($jml_a == 0) {

			$data_service 		= array(
				'id_group_serv'	=>$id_group,
				'serv_name'		=>$this->input->post('serv_name'),
				'order_id'		=>$id_item,
				'serv_code'		=>$this->input->post('serv_code'),
				'order_type' 	=>$type_id,
			);
			$this->m_quotation->save_mst_service($data_service);
			$max_a				= $this->m_smart->get_max_mst_services();
			
			foreach ($max_a->result() as $row2) {$id_service = $row2->id_service;}

		}else{

			foreach ($get_mst_services->result() as $row1) {
			$id_service			= $row1->id_service;
			$id_group_serv		= $row1->id_group_serv;
			$order_type			= $row1->order_type;
			$order_id			= $row1->order_id;
			$serv_seq_no		= $row1->serv_seq_no;
			$cof				= $row1->coa;
			$serv_name			= $row1->serv_name;
			$serv_type			= $row1->serv_type;
			$serv_code			= $row1->serv_code;
			}
			
		}


		if($rowC==""){				
			$rowC="1";			
		}else{				
			$rowC=$rowC;			
		}

		for($i=1; $i<=$rowC; $i++){			
			$sql = "INSERT INTO mst_service_price (id_service, price_type, price, currency, id_branch, create_date) VALUES ('".$id_item."', '".$this->input->post('type_'.$i.'')."', '".str_replace(",","",$this->input->post('price_'.$i.''))."', '".$this->input->post('curr_type_'.$i.'')."', '".$this->input->post('branch')."','$now')";			
			$this->db->query($sql);
			// echo $sql;
		}			

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$data_log = array(
					'id_user'	=>$user_id,
					'log_date'	=>$now,
					'log_desc' 	=>"Save item price, id smart : ".$this->input->post('id_smart')."",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log

		$this->m_smart->update_smart_sts($id_smart,array('status' => 0, ));


		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
		exit();
	}
	
	function save_item_lab(){

		$this->load->model('m_smart');
		$this->load->model('m_quotation');

		$session_data 			= $this->session->userdata('logged_in');		
		$user_id		 		= $session_data['id'];
		$rowC					= $this->input->post('count_ant');			
		$id_smart				= $this->input->post('id_smart');			
		$id_group				= $this->input->post('id_group');			
		$grp_services			= $this->input->post('grp_services');			
		$serv_name				= $this->input->post('serv_name');			
		$serv_code				= $this->input->post('serv_code');			
		$branch					= $this->input->post('branch');			
		$serv_code				= $this->input->post('serv_code');			
		$now					= date("Y-m-d H:i:s");
		$get_smartid 			= $this->m_smart->get_smartid($id_smart);

		// Proses cek data
		foreach ($get_smartid->result() as $row) {
		$id_item				= $row->id_trouble;
		$id_department			= $row->id_department;
		$id_source_trouble		= $row->id_source_trouble;
		$type_id				= $row->type_id;
		$notes					= $row->notes;
		$create_date			= $row->create_date;
		}		

		$get_mst_services		= $this->m_smart->get_mst_services_lab($type_id,$id_item);
		$jml_a					= $get_mst_services->num_rows();

		if ($jml_a == 0) {

			$data_service 		= array(
				'id_group_serv'	=>$id_group,
				'serv_name'		=>$this->input->post('serv_name'),
				'order_id'		=>$id_item,
				'serv_code'		=>$this->input->post('serv_code'),
				'order_type' 	=>$type_id,
			);
			$this->m_quotation->save_mst_service($data_service);
			$max_a				= $this->m_smart->get_max_mst_services();
			
			foreach ($max_a->result() as $row2) {$id_service = $row2->id_service;}

		}else{

			foreach ($get_mst_services->result() as $row1) {
			$id_service			= $row1->id_service;
			$id_group_serv		= $row1->id_group_serv;
			$order_type			= $row1->order_type;
			$order_id			= $row1->order_id;
			$serv_seq_no		= $row1->serv_seq_no;
			$cof				= $row1->coa;
			$serv_name			= $row1->serv_name;
			$serv_type			= $row1->serv_type;
			$serv_code			= $row1->serv_code;
			}
			
		}

		if($rowC==""){				
			$rowC="1";			
		}else{				
			$rowC=$rowC;			
		}

		for($i=1; $i<=$rowC; $i++){			
			$sql = "INSERT INTO mst_service_price (id_service, price_type, price, currency, id_branch, create_date) VALUES ('".$id_service."', '".$this->input->post('type_'.$i.'')."', '".str_replace(",","",$this->input->post('price_'.$i.''))."', '".$this->input->post('curr_type_'.$i.'')."', '".$this->input->post('branch')."','$now')";			
			$this->db->query($sql);
			// echo $sql;
		}			

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$data_log = array(
					'id_user'	=>$user_id,
					'log_date'	=>$now,
					'log_desc' 	=>"Save item price, id smart : ".$this->input->post('id_smart')."",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log

		$this->m_smart->update_smart_sts($id_smart,array('status' => 0, ));


		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
		exit();
	}


}
?>