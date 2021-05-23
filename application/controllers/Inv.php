<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inv extends CI_Controller {
 
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

 //fungsi load Master Warehouse
 function inv_warehouse(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');	
		$this->load->model('m_user');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		// $data['data'] 			= $this->m_inv->get_list_wh();
		$data['data'] 			= $this->m_inv->get_list_wh_dep();
	 	$data['job']			= $this->m_user->get_job();
	    $this->template->set('title','Klinik | Master Warehouse');
		$this->template->load('template','menu/inv_warehouse', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 
 function inv_warehouse_excel(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');	
		$this->load->model('m_user');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_inv->get_list_wh_dep();
	 	$data['job']			= $this->m_user->get_job();
		$this->load->view('menu/inv_warehouse_excel', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function update_inv_warehouse(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');	
		$this->load->model('m_user');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['id_wh']			= $this->uri->segment(3);
	 	$data['job']			= $this->m_user->get_job();
		$get_data 				= $this->m_inv->get_list_wh_dep_id($data['id_wh']);
		
		foreach ($get_data->result() as $row) {
			$data['warehouse_name']		= $row->warehouse_name;
			$data['warehouse_code']		= $row->warehouse_code;
			$data['kode_dep']			= $row->kode_dep;
		}

	    $this->template->set('title','Klinik | Master Warehouse');
		$this->template->load('template','menu/update_inv_warehouse', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

function process_update_inv_warehouse(){

	$id						= $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$id						= $this->input->post('id_wh');
	$w_name					= $this->input->post('w_name');
	$w_code					= $this->input->post('w_code');
	$department				= $this->input->post('department');

	// Update status
	$data_delete			= array(
	'warehouse_name'		=>$w_name,		
	'warehouse_code'		=>$w_code,		
	'kode_dep'				=>$department,		
	);
	$this->load->model('m_inv');
	$this->m_inv->delete_Warehouse($id,$data_delete);
	// End Update 

	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log 				= array(
	'id_user'				=>$user_id,
	'log_date'				=>date("Y-m-d H:i:s"),
	'log_desc' 				=>"Update Warehouse, id : ".$id." , By ". $user_id,
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log

	// echo "<script>window.close(this); window.onunload = refreshParent; function refreshParent() { window.opener.location.assign('inv_warehouse/change'); }</script>";

	echo "<script>
			setTimeout(function () { 
				    window.opener.location = 'inv_warehouse/change';
				    window.close();
			}, 1);
	</script>";

 } 

  //fungsi load Master Delivery Address
 function inv_delivery(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');	
		$this->load->model('m_patient');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_inv->get_delivery_data();
	    $this->template->set('title','Klinik | Master Delivery Address');
		$this->template->load('template','menu/inv_delivery', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function add_inv_delivery(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');	
		$this->load->model('m_patient');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$max 					= $this->m_inv->get_max_mst_delivery_address();
		foreach ($max->result() as $row) { 
			$data['id_delivery'] = $row->id_delivery+1;  
		}
	    $this->template->set('title','Klinik | Master Delivery Address');
		$this->template->load('template','menu/add_inv_delivery', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

function inv_delivery_excel(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');	
		$this->load->model('m_patient');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_inv->get_delivery_data();
		$this->load->view('menu/inv_delivery_excel', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function update_inv_delivery(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');	
		$this->load->model('m_patient');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['id_delivery']	= $this->uri->segment(3);
		$get_data				= $this->m_inv->get_delivery_data_id($data['id_delivery']);
		foreach ($get_data->result() as $row) {$data['delivery_address'] = $row->delivery_address;}
	    $this->template->set('title','Klinik | Master Delivery Address');
		$this->template->load('template','menu/update_inv_delivery', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function process_update_inv_delivery(){
 	

	$session_data 			= $this->session->userdata('logged_in');
	$id						= $this->input->post('id_delivery');
	$delivery				= $this->input->post('delivery');

	// Update status
 	$data_app 				= array(
		'delivery_address'	=>$delivery,
	);
	$this->load->model('m_inv');
	$this->m_inv->delete_DeliveryAddress($id,$data_app);
	// End Update 

	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log 				= array(
	'id_user'				=>$user_id,
	'log_date'				=>date("Y-m-d H:i:s"),
	'log_desc' 				=>"Update Master Delivery Address, id : ".$id." , By ". $user_id,
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log

	// echo "<script>window.close(this); window.onunload = refreshParent; function refreshParent() { window.opener.location.assign('inv_delivery/change'); }</script>";

	echo "<script>
			setTimeout(function () { 
				    window.opener.location = 'inv_delivery/change';
				    window.close();
			}, 1);
	</script>";
 }

  //fungsi simpan master delivery address
 function save_del_addr(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
			$data_group			= array(
				'delivery_address'	=>$this->input->post('delivery'),
			);
			$this->load->model('m_inv');
			$this->m_inv->save_master_delivery($data_group);
		
			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d H:i:s"),
						'log_desc' 						=>"Create Master Delivery Address : ".$this->input->post('delivery')."",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
			
			redirect('inv/inv_delivery/ok');
 }

  //fungsi simpan master delivery address
 function save_del_addr2(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
			
			$data_group			= array(
				'id_delivery'		=>$this->input->post('id_delivery'),
				'delivery_address'	=>$this->input->post('delivery'),
			);
			$this->load->model('m_inv');
			$this->m_inv->save_master_delivery($data_group);
		
			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d H:i:s"),
						'log_desc' 						=>"Create Master Delivery Address : ".$this->input->post('delivery')."",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
			
			// redirect('inv/inv_delivery/ok');
			echo "<script>window.close(this);</script>";
 }
 //fungsi simpan master warehouse
 function save_wh(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
			
			$data_group			= array(
				'warehouse_name'	=>$this->input->post('w_name'),
				'warehouse_code'	=>$this->input->post('w_code'),
				'kode_dep'			=>$this->input->post('department'),
				'create_by'			=>$user_id,
			);
			$this->load->model('m_inv');
			$this->m_inv->save_master_warehouse($data_group);
		
			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d"),
						'log_desc' 						=>"Create Master Warehouse : ".$this->input->post('w_name')."",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
			
			redirect('inv/inv_warehouse/ok');
 }

 //fungsi simpan master Item Group
 function save_g(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
			$data_group			= array(
				'item_group'		=>$this->input->post('g_item'),
				'remarks'			=>$this->input->post('g_desc'),
			);
			$this->load->model('m_inv');
			$this->m_inv->save_master_ig($data_group);
		
			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d"),
						'log_desc' 						=>"Create Master Item Group : ".$this->input->post('w_name')."",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
			
			redirect('inv/inv_item_group/ok');
 }
 //fungsi load Master Limit
 function inv_limit(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_inv->get_list_wh();
	    $this->template->set('title','Klinik | Master Limit');
		$this->template->load('template','menu/inv_warehouse', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
  //fungsi load Master Suppliers
 function inv_supplier(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');				
		$this->load->model('m_patient');				
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $data['gender'] 		= $this->m_patient->get_list_gender();
		$data['marital'] 		= $this->m_patient->get_list_marital();
		$data['province'] 		= $this->m_patient->get_list_province();
		$data['city'] 			= $this->m_inv->get_list_city();
		$data['relative'] 		= $this->m_patient->get_list_relative();
		$data['national'] 		= $this->m_patient->get_list_nationality();
		$data['data'] 			= $this->m_inv->get_list_sp();
	    $this->template->set('title','Klinik | Master Supplier');
		$this->template->load('template','menu/inv_supplier', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
function add_inv_supplier(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');				
		$this->load->model('m_patient');				
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $data['gender'] 		= $this->m_patient->get_list_gender();
		$data['marital'] 		= $this->m_patient->get_list_marital();
		$data['province'] 		= $this->m_patient->get_list_province();
		$data['city'] 			= $this->m_inv->get_list_city();
		$data['relative'] 		= $this->m_patient->get_list_relative();
		$data['national'] 		= $this->m_patient->get_list_nationality();
		$supplier 				= $this->m_inv->get_max_mst_supplier();
		foreach ($supplier->result() as $row) {
			$data['id_supplier']	= $row->id_supplier+1;
		}
	    $this->template->set('title','Klinik | Master Supplier');
		$this->template->load('template','menu/add_inv_supplier', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi simpan master Supplier
 function save_sp(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$tgl					= date("Y-m-d");
		$now					= date("Y-m-d H:i:s");
		
		$data_group			= array(
			'supp_code'			=>$this->input->post('s_code'),
			'supp_name'			=>$this->input->post('s_name'),
			'supp_address1'		=>$this->input->post('s_address'),
			'supp_address2'		=>$this->input->post('s_address2'),
			'term_payment'		=>str_replace("","0",$this->input->post('t_pay')),
			'supp_province'		=>$this->input->post('pat_province'),
			'supp_city'			=>$this->input->post('city'),
			'supp_nationality'	=>$this->input->post('pat_nationality'),
			'supp_pos_code'		=>$this->input->post('zipcode'),
			'supp_phone'		=>$this->input->post('phone'),
			'supp_fax'			=>$this->input->post('fax'),
			'supp_email'		=>$this->input->post('email'),
			'supp_npwp1'		=>$this->input->post('s_npwp1'),
			'supp_npwp2'		=>$this->input->post('s_npwp2'),
			'supp_contact1'		=>$this->input->post('kontak1'),
			'supp_contact2'		=>$this->input->post('kontak2'),
			'supp_balance'		=>0,
			'balance_date'		=>$tgl,
			'memo'				=>$this->input->post('memo'),
			'created_by'		=>$user_id,
			'created_date'		=>$now,
		);
		$this->load->model('m_inv');
		$this->m_inv->save_master_supplier($data_group);
	
		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$data_log = array(
					'id_user'						=>$user_id,
					'log_date'						=>$now,
					'log_desc' 						=>"Create Master Supplier : ".$this->input->post('s_name')."",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log
		
		redirect('inv/inv_supplier/ok');
 }


 //fungsi simpan master Supplier
 function save_sp2(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$tgl					= date("Y-m-d");
		$now					= date("Y-m-d H:i:s");
		
		$data_group				= array(
			'id_supplier'		=>$this->input->post('id_supplier'),
			'supp_code'			=>$this->input->post('spcode'),
			'supp_name'			=>$this->input->post('s_name'),
			'supp_address1'		=>$this->input->post('s_address'),
			'supp_address2'		=>$this->input->post('s_address2'),
			'term_payment'		=>str_replace("","0",$this->input->post('t_pay')),
			'supp_province'		=>$this->input->post('pat_province'),
			'supp_city'			=>$this->input->post('city'),
			'supp_nationality'	=>$this->input->post('pat_nationality'),
			'supp_pos_code'		=>$this->input->post('zipcode'),
			'supp_phone'		=>$this->input->post('phone'),
			'supp_fax'			=>$this->input->post('fax'),
			'supp_email'		=>$this->input->post('email'),
			'supp_npwp1'		=>$this->input->post('s_npwp1'),
			'supp_npwp2'		=>$this->input->post('s_npwp2'),
			'supp_contact1'		=>$this->input->post('kontak1'),
			'supp_contact2'		=>$this->input->post('kontak2'),
			'supp_balance'		=>0,
			'balance_date'		=>$tgl,
			'memo'				=>$this->input->post('memo'),
			'created_by'		=>$user_id,
			'created_date'		=>$now,
		);
		$this->load->model('m_inv');
		$this->m_inv->save_master_supplier($data_group);
	
		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$data_log = array(
					'id_user'						=>$user_id,
					'log_date'						=>$now,
					'log_desc' 						=>"Create Master Supplier : ".$this->input->post('s_name')."",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log
		
	echo "<script>window.close(this);</script>";
 }

function inv_supplier_excel(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');				
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_inv->get_list_sp();
		$this->load->view('menu/inv_supplier_excel2', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

function view_supplier(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');				
		$this->load->model('m_patient');				
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];

	    $data['gender'] 		= $this->m_patient->get_list_gender();
		$data['marital'] 		= $this->m_patient->get_list_marital();
		$data['province'] 		= $this->m_patient->get_list_province();
		$data['city'] 			= $this->m_inv->get_list_city();
		$data['relative'] 		= $this->m_patient->get_list_relative();
		$data['national'] 		= $this->m_patient->get_list_nationality();

	    $data['id_supplier']	= $this->uri->segment(3);
		$get_data 				= $this->m_inv->get_list_sp_id($data['id_supplier']);

		foreach ($get_data->result() as $row) {
			$data['supp_code']			= $row->supp_code;
			$data['supp_name']			= $row->supp_name;
			$data['supp_address1']		= $row->supp_address1;
			$data['supp_address2']		= $row->supp_address2;
			$data['supp_contact1']		= $row->supp_contact1;
			$data['supp_contact2']		= $row->supp_contact2;
			$data['supp_phone']			= $row->supp_phone;
			$data['supp_npwp1']			= $row->supp_npwp1;
			$data['supp_npwp2']			= $row->supp_npwp2;
			$data['term_payment']		= $row->term_payment;
			$data['supp_pos_code']		= $row->supp_pos_code;
			$data['supp_fax']			= $row->supp_fax;
			$data['supp_email']			= $row->supp_email;
			$data['supp_province']		= $row->supp_province;
			$data['supp_city']			= $row->supp_city;
			$data['supp_nationality']	= $row->supp_nationality;
			$data['supp_pos_code']	= $row->supp_pos_code;
			$data['supp_pos_code']	= $row->supp_pos_code;
			$data['supp_pos_code']	= $row->supp_pos_code;
			$data['supp_pos_code']	= $row->supp_pos_code;
		}

	    $this->template->set('title','Klinik | Master Supplier');
		$this->template->load('template','menu/view_supplier', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

function update_supplier(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');				
		$this->load->model('m_patient');				
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];

	    $data['gender'] 		= $this->m_patient->get_list_gender();
		$data['marital'] 		= $this->m_patient->get_list_marital();
		$data['province'] 		= $this->m_patient->get_list_province();
		$data['city'] 			= $this->m_inv->get_list_city();
		$data['relative'] 		= $this->m_patient->get_list_relative();
		$data['national'] 		= $this->m_patient->get_list_nationality();

	    $data['id_supplier']	= $this->uri->segment(3);
		$get_data 				= $this->m_inv->get_list_sp_id($data['id_supplier']);

		foreach ($get_data->result() as $row) {
			$data['supp_code']			= $row->supp_code;
			$data['supp_name']			= $row->supp_name;
			$data['supp_address1']		= $row->supp_address1;
			$data['supp_address2']		= $row->supp_address2;
			$data['supp_contact1']		= $row->supp_contact1;
			$data['supp_contact2']		= $row->supp_contact2;
			$data['supp_phone']			= $row->supp_phone;
			$data['supp_npwp1']			= $row->supp_npwp1;
			$data['supp_npwp2']			= $row->supp_npwp2;
			$data['term_payment']		= $row->term_payment;
			$data['supp_pos_code']		= $row->supp_pos_code;
			$data['supp_fax']			= $row->supp_fax;
			$data['supp_email']			= $row->supp_email;
			$data['supp_province']		= $row->supp_province;
			$data['supp_city']			= $row->supp_city;
			$data['supp_nationality']	= $row->supp_nationality;
			$data['supp_pos_code']	= $row->supp_pos_code;
			$data['supp_pos_code']	= $row->supp_pos_code;
			$data['supp_pos_code']	= $row->supp_pos_code;
			$data['supp_pos_code']	= $row->supp_pos_code;
		}

	    $this->template->set('title','Klinik | Master Supplier');
		$this->template->load('template','menu/update_supplier', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function process_update_supplier (){
              
 	// Process Update...
	$session_data 		= $this->session->userdata('logged_in');
	$user_id			= $session_data['id'];	
	$id_supplier		= $this->input->post('id_supplier');
	$tgl				= date("Y-m-d");
	$now				= date("Y-m-d H:i:s");

 	$data_udpate		= array(
			'supp_code'			=>$this->input->post('s_code'),
			'supp_name'			=>$this->input->post('s_name'),
			'supp_address1'		=>$this->input->post('s_address'),
			'supp_address2'		=>$this->input->post('s_address2'),
			'term_payment'		=>str_replace("","0",$this->input->post('t_pay')),
			'supp_province'		=>$this->input->post('pat_province'),
			'supp_city'			=>$this->input->post('city'),
			'supp_nationality'	=>$this->input->post('pat_nationality'),
			'supp_pos_code'		=>$this->input->post('zipcode'),
			'supp_phone'		=>$this->input->post('phone'),
			'supp_fax'			=>$this->input->post('fax'),
			'supp_email'		=>$this->input->post('email'),
			'supp_npwp1'		=>$this->input->post('s_npwp1'),
			'supp_npwp2'		=>$this->input->post('s_npwp2'),
			'supp_contact1'		=>$this->input->post('kontak1'),
			'supp_contact2'		=>$this->input->post('kontak2'),
			'supp_balance'		=>0,
			'balance_date'		=>$tgl,
			'memo'				=>$this->input->post('memo'),
			'updated_by'		=>$user_id,
			'updated_date'		=>$now,
	);
	$this->load->model('m_inv');
	$this->m_inv->delete_Supplier($id_supplier,$data_udpate);
	// End Update...


	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log = array(
		'id_user'			=> $user_id,
		'log_date'			=> date("Y-m-d H:i:s"),
		'log_desc' 			=> "Update Supplier, id ".$id_supplier,
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log
			
	// echo "<script>window.close(this); window.onunload = refreshParent; function refreshParent() { window.opener.location.assign('inv_supplier/change'); }</script>";

	echo "<script>
			setTimeout(function () { 
				    window.opener.location = 'inv_supplier/change';
				    window.close();
			}, 1);
	</script>";

 }


 //fungsi load Find Supplier
 function find_supplier(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');				
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_inv->get_list_sp();
	    $this->template->set('title','Klinik | Find Supplier');
		$this->template->load('template','menu/find_supplier', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //fungsi load Find Manufacture
 function find_manufacture(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');	
		$this->load->model('m_pharmacy');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_pharmacy->get_list_manufaktur_header();
	    $this->template->set('title','Klinik | Find Manufacture');
		$this->template->load('template','menu/find_manufacture', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //fungsi load Find Delivery
 function find_delivery(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');				
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_inv->get_delivery_data();
	    $this->template->set('title','Klinik | Find Delivery');
		$this->template->load('template','menu/find_delivery', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi load Find Item
 function find_item(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');				
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_inv->get_find_item();
	    $this->template->set('title','Klinik | Find Item');
		$this->template->load('template','menu/find_item', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

function find_item_by_pr(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');				
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $id_pr 					= $this->uri->segment(4);
		$data['data'] 			= $this->m_inv->get_find_item_pr();
		$data['data2'] 			= $this->m_inv->get_find_item_by_pr($id_pr);
	    $this->template->set('title','Klinik | Find Item');
		$this->template->load('template','menu/find_item_pr', $data);
		// $this->template->load('template','menu/find_item', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

function view_history_item(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');				
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $id_item 				= $this->uri->segment(3);
		$item_data				= $this->m_inv->get_list_item($id_item);
		$data['data'] 			= $this->m_inv->get_hitory_item_po($id_item);
	    $this->template->set('title','Klinik | Find Item');
		$this->template->load('template','menu/view_history_item', $data);
		// $this->template->load('template','menu/find_item', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi load Find Item PR
 function find_item_pr(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');				
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_inv->get_find_item_for_pr();
	    $this->template->set('title','Klinik | Find Item');
		$this->template->load('template','menu/find_item_for_pr', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 
 //fungsi load Find Item PR
 function find_item_mi(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');				
		$this->load->model('m_master');				
		$link 					= $this->uri->segment(3);
		$id 					= $this->uri->segment(4);
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $item_group 			= $this->m_master->cek_sysparam('item_request_group');
	    $skey					= array();
	    foreach ($item_group->result() as $row) {$skey[] = $row->skey;}
		$data['data'] 			= $this->m_inv->get_find_item3($id,$skey);
	    $this->template->set('title','Klinik | Find Item');
		$this->template->load('template','menu/find_item_mi', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 
 function find_item_in_warehouse(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');				
		$this->load->model('m_master');				
		$id 					= $this->uri->segment(3);
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $item_group 			= $this->m_master->cek_sysparam('item_request_group');
	    $skey					= array();
	    foreach ($item_group->result() as $row) {$skey[] = $row->skey;}
		$data['data'] 			= $this->m_inv->get_find_item3($id,$skey);
	    $this->template->set('title','Klinik | Find Item');
		$this->template->load('template','menu/find_item_in_warehouse', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //fungsi load Find PR
 function find_pr(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');				
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_inv->get_find_pr_approve();
	    $this->template->set('title','Klinik | Find Purchase Request');
		$this->template->load('template','menu/find_pr', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

function find_pr_info(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');				
		$id 					= $this->uri->segment(3);
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_inv->get_find_pr_approve_info($id);
	    $this->template->set('title','Klinik | Find Purchase Request');
		$this->template->load('template','menu/find_pr', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

function find_pr_detail_info(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');				
		$id 					= $this->uri->segment(3);
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_inv->get_find_pr_approve_detail_info($id);
	    $this->template->set('title','Klinik | Find Purchase Request');
		$this->template->load('template','menu/find_pr_detail_info', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi load Find PR
 function find_conversion(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');				
		$link 								= $this->uri->segment(3);
		$id 								= $this->uri->segment(4);
		$session_data 						= $this->session->userdata('logged_in');
	    $data['username'] 					= $session_data['username'];
		$data['conversion_base'] 			= $this->m_inv->get_listconvbyid($id);
	    $this->template->set('title','Klinik | Find Conversion');
		$this->template->load('template','menu/find_conversion', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }


 //fungsi load Master item
 function inv_item(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$param					= $this->uri->segment(3);
		
		if ($param == "update") {
			$data['id_item']		= $this->uri->segment(4);
			$get_data 				= $this->m_inv->get_list_it_by_id($data['id_item']);
			foreach ($get_data->result() as $row) {
			$data['id_item_group']	= $row->id_item_group;
			$data['item_name']		= $row->item_name;
			}
		}else{
			$data['id_item_group']	= 0;
			$data['item_name']		= "";
		}
		
		$data['accno']		= $this->m_inv->get_list_coa();
		$data['warehouse']	= $this->m_inv->get_list_wh();
		$data['group'] 		= $this->m_inv->get_list_ig();
		$data['supplier'] 	= $this->m_inv->get_list_sp();
		$data['base']	 	= $this->m_inv->get_list_bu();
		// $data['data'] 		= $this->m_inv->get_list_it();
	    
	    $this->template->set('title','Klinik | Master Item');
		$this->template->load('template','menu/inv_item', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi load Master item
 function add_request_item(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$param					= $this->uri->segment(3);
		$data['id_item_group']	= 0;
		$data['item_name']		= "";

		$data['accno']		= $this->m_inv->get_list_coa();
		$data['warehouse']	= $this->m_inv->get_list_wh();
		$data['group'] 		= $this->m_inv->get_list_ig();
		$data['supplier'] 	= $this->m_inv->get_list_sp();
		$data['base']	 	= $this->m_inv->get_list_bu();
		// $data['data'] 		= $this->m_inv->get_list_it();
	    
	    $this->template->set('title','Klinik | Request New Item');
		$this->template->load('template','menu/add_request_item', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi simpan master Item
 function save_request_item(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
			$data_group			= array(
				'id_manufaktur'		=>$this->input->post('i_manuid'),
				'item_group'		=>$this->input->post('i_group'),
				'item_group'		=>$this->input->post('i_group'),
				'item_name'			=>$this->input->post('i_name'),
				'coa'				=>$this->input->post('i_coa'),
				'inv_coa'			=>$this->input->post('i_invcoa'),
				'cost_coa'			=>$this->input->post('i_costcoa'),
				'batch_code'		=>str_replace("DOESN'T HAVE BATCH CODE!","0",$this->input->post('i_batchcode')),
				'expired_date'		=>date("Y-m-d",strtotime($this->input->post('i_expired'))),
				'baseunit'			=>$this->input->post('i_baseunit'),
				'batch_date'		=>date("Y-m-d",strtotime($this->input->post('i_batchdate'))),
				'item_curr_qty'		=>0,
				'supplier_id'		=>$this->input->post('i_supplier'),
				'warehouse_id'		=>$this->input->post('i_warehouse'),
				'item_remarks'		=>$this->input->post('i_remarks'),
				'is_active'			=>2,
				'created_by'		=>$user_id,
			);
			$this->load->model('m_inv');
			$this->m_inv->save_master_item($data_group);
		
			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d"),
						'log_desc' 						=>"Create Master Item : ".$this->input->post('i_name')."",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
			
		echo "<script>setTimeout(function () {window.close();}, 1);</script>";
 }

 function list_inv_item(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_inv->get_list_it();
	    
	    $this->template->set('title','Klinik | Master Item');
		$this->template->load('template','menu/list_inv_item', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function list_inv_item_request(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_inv->get_list_item_request();
	    $this->template->set('title','Klinik | Master Item Request');
		$this->template->load('template','menu/list_inv_item_request', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function list_inv_all_item(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_inv->get_list_all_it();
	    
	    $this->template->set('title','Klinik | Master Item');
		$this->template->load('template','menu/list_inv_all_item', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

function inv_item_excel(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$param					= $this->uri->segment(3);
		
		if ($param == "update") {
			$data['id_item']		= $this->uri->segment(4);
			$get_data 				= $this->m_inv->get_list_it_by_id($data['id_item']);
			foreach ($get_data->result() as $row) {
			$data['id_item_group']	= $row->id_item_group;
			$data['item_name']		= $row->item_name;
			}
		}else{
			$data['id_item_group']	= 0;
			$data['item_name']		= "";
		}

		$data['warehouse']	= $this->m_inv->get_list_wh();
		$data['data'] 		= $this->m_inv->get_list_it();
		$data['group'] 		= $this->m_inv->get_list_ig();
		$data['supplier'] 	= $this->m_inv->get_list_sp();
		$data['base']	 	= $this->m_inv->get_list_bu();
	    
		$this->load->view('menu/inv_item_excel', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

function export_eazy(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		
		$this->m_inv->hapus_eazy();
		$this->m_inv->masuk_data_eazy();
		$data['data']	 	= $this->m_inv->get_eazy();

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_log 				= array(
			'id_user'			=>$user_id,
			'log_date'			=>date("Y-m-d"),
			'log_desc'			=>"Export Eazy Accounting",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log

	    
		$this->load->view('menu/export_eazy_excel', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }


 //fungsi load Master item
 function update_inv_item(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	
		$data['id_item']		= $this->uri->segment(3);
		$get_data 				= $this->m_inv->get_list_it_by_id($data['id_item']);
	
		foreach ($get_data->result() as $row) {
			$data['id_item_group']	= $row->id_item_group;
			$data['item_name']		= $row->item_name;
			$data['batch_code']		= $row->batch_code;
			$data['batch_date']		= $row->batch_date;
			$data['expired_date']	= $row->expired_date;
			$data['baseunit']		= $row->baseunit;
			$data['supplier_id']	= $row->supplier_id;
			$data['warehouse_id']	= $row->warehouse_id;
			$data['item_remarks']	= $row->item_remarks;
			$data['item_curr_qty']	= $row->item_curr_qty;
		}
		
		$data['accno']		= $this->m_inv->get_list_coa();
		$data['warehouse']	= $this->m_inv->get_list_wh();
		$data['group'] 		= $this->m_inv->get_list_ig();
		$data['supplier'] 	= $this->m_inv->get_list_sp();
		$data['base']	 	= $this->m_inv->get_list_bu();
	    
	    $this->template->set('title','Klinik | Master Item');
		$this->template->load('template','menu/update_inv_item', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi load Master item
 function app_item_request(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	
		$data['id_item']		= $this->uri->segment(3);
		$get_data 				= $this->m_inv->get_list_it_by_id($data['id_item']);
	
		foreach ($get_data->result() as $row) {
			$data['id_item_group']	= $row->id_item_group;
			$data['item_name']		= $row->item_name;
			$data['batch_code']		= $row->batch_code;
			$data['batch_date']		= $row->batch_date;
			$data['expired_date']	= $row->expired_date;
			$data['baseunit']		= $row->baseunit;
			$data['supplier_id']	= $row->supplier_id;
			$data['warehouse_id']	= $row->warehouse_id;
			$data['item_remarks']	= $row->item_remarks;
			$data['item_curr_qty']	= $row->item_curr_qty;
		}
		
		$data['accno']		= $this->m_inv->get_list_coa();
		$data['warehouse']	= $this->m_inv->get_list_wh();
		$data['group'] 		= $this->m_inv->get_list_ig();
		$data['supplier'] 	= $this->m_inv->get_list_sp();
		$data['base']	 	= $this->m_inv->get_list_bu();
	    
	    $this->template->set('title','Klinik | Master Item');
		$this->template->load('template','menu/app_item_request', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function update_master_item(){
 	if($this->session->userdata('logged_in')){	
	
		$this->load->model('m_inv');			
	
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $user_id 				= $session_data['id'];
	    $id_item 				= $this->input->post('id_item');
		
		$data_update 			= array(
			'id_manufaktur'		=>$this->input->post('i_manuid'),
			'item_group'		=>$this->input->post('i_group'),
			'item_group'		=>$this->input->post('i_group'),
			'item_name'			=>$this->input->post('i_name'),
			'batch_code'		=>str_replace("DOESN'T HAVE BATCH CODE!","0",$this->input->post('i_batchcode')),
			'expired_date'		=>date("Y-m-d",strtotime($this->input->post('i_expired'))),
			'baseunit'			=>$this->input->post('i_baseunit'),
			'batch_date'		=>date("Y-m-d",strtotime($this->input->post('i_batchdate'))),
			'item_curr_qty'		=>$this->input->post('item_curr_qty'),
			'supplier_id'		=>$this->input->post('i_supplier'),
			'warehouse_id'		=>$this->input->post('i_warehouse'),
			'item_remarks'		=>$this->input->post('i_remarks'),
		);
		$this->m_inv->update_mst_item($id_item,$data_update);

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_log 				= array(
			'id_user'			=>$user_id,
			'log_date'			=>date("Y-m-d"),
			'log_desc'			=>"Update Master Item Name : ".$this->input->post('i_name')." And id Item : ".$id_item,
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log

		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
	
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}
 }

 function update_item_request(){
 	if($this->session->userdata('logged_in')){	
	
		$this->load->model('m_inv');			
	
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $user_id 				= $session_data['id'];
	    $id_item 				= $this->input->post('id_item');
	    $btn 					= $this->input->post('btn');

	    // Membedakan app dan reject
	    if ($btn == "app") { $aktifnya = 0;}else{$aktifnya = 3;}
	    // echo $aktifnya;
	    // exit();
		
		$data_update 			= array(
			'id_manufaktur'		=>$this->input->post('i_manuid'),
			'item_group'		=>$this->input->post('i_group'),
			'item_group'		=>$this->input->post('i_group'),
			'item_name'			=>$this->input->post('i_name'),
			'batch_code'		=>str_replace("DOESN'T HAVE BATCH CODE!","0",$this->input->post('i_batchcode')),
			'expired_date'		=>date("Y-m-d",strtotime($this->input->post('i_expired'))),
			'baseunit'			=>$this->input->post('i_baseunit'),
			'batch_date'		=>date("Y-m-d",strtotime($this->input->post('i_batchdate'))),
			'item_curr_qty'		=>$this->input->post('item_curr_qty'),
			'supplier_id'		=>$this->input->post('i_supplier'),
			'warehouse_id'		=>$this->input->post('i_warehouse'),
			'item_remarks'		=>$this->input->post('i_remarks'),
			'is_active'			=>$aktifnya,
		);
		$this->m_inv->update_mst_item($id_item,$data_update);

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$now					= date("Y-m-d H:i:s");
		$data_log 				= array(
			'id_user'			=>$user_id,
			'log_date'			=>$now,
			'log_desc'			=>$btn." Request Item : ".$this->input->post('i_name')." And id Item : ".$id_item,
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log

		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
	
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}
 }

 //fungsi load List Item Price
 function list_item_price(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_quotation');			
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $data['userlevel'] 		= $session_data['userlevel'];
		$data['warehouse'] 		= $this->m_inv->get_list_wh();
		$data['data'] 			= $this->m_inv->get_list_it_price();
		$data['group'] 			= $this->m_inv->get_list_ig();
		$data['supplier'] 		= $this->m_inv->get_list_sp();
		$data['base']	 		= $this->m_inv->get_list_bu();
		$data['sv_group'] 		= $this->m_inv->get_list_ig();
		$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
		$data['pay_type'] 		= $this->m_quotation->get_type();
		$data['branch'] 		= $this->m_quotation->get_branch();
	    $this->template->set('title','Klinik | Master Item Price');
		// $this->template->load('template','menu/list_item_price', $data);
		$this->template->load('template','menu/list_item_price_new', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

function list_item_price_excel(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_quotation');			
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_inv->get_list_it_price();
		$this->load->view('menu/list_item_price_excel', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }


 function update_item_price(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');		
		$session_data 				= $this->session->userdata('logged_in');
	    $data['username'] 			= $session_data['username'];
		$id				 			= $session_data['id'];
		$data['id_price']			= $this->uri->segment(3);
		$data['data'] 				= $this->m_inv->get_list_it_price_id($data["id_price"]);
		
		foreach($data['data']->result() as $row){
			$data['id_item']		= $row->id_item;
			$data['price_type']		= $row->id_price_type;
			$data['item_name']		= $row->item_name;
			$data['Price']			= $row->Price;
			$data['code_item']		= $row->code_item;
		}

	    $this->template->set('title','Klinik | Update Master Item Price');
		$this->template->load('template','menu/update_item_price', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function save_update_item_price(){
		              
		$this->load->model('m_inv');	

		//Cek Ip / cara membuat ip
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		//End Cek Ip

		$session_data 	= $this->session->userdata('logged_in');
		$user_id		= $session_data['id'];	
		$id_price 		= $this->input->post('id_price');
		$id_item 		= $this->input->post('id_item');
		$price_type 	= $this->input->post('price_type');
		$item_name 		= $this->input->post('item_name');
		$hargalama 		= $this->input->post('lama');
		$hargabaru 		= $this->input->post('baru');
		$code_item 		= $this->input->post('code_item');

		$data_update 		= array(
			'Price' 		=> $hargabaru,
			'update_by'		=> $user_id,
			'update_date'	=> date("Y-m-d H:i:s"),
			'code_item'		=> $code_item,
		);
		$this->m_inv->update_mst_item_price($id_price,$data_update);
		
		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$data_log = array(
			'id_user'			=> $user_id,
			'log_date'			=> date("Y-m-d H:i:s"),
			'log_desc' 			=> "Update Item Price ".$item_name.", IP : ".$ip." and id item ".$id_item." Price from : ".$hargalama." To : ".$hargabaru,
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log

		echo "<script>window.close(this); </script>";		
 }

 function save_update_item_price_old(){
		              
		$this->load->model('m_inv');	

		$session_data 	= $this->session->userdata('logged_in');
		$user_id		= $session_data['id'];	
		$id_price 		= $this->input->post('id_price');
		$id_item 		= $this->input->post('id_item');
		$price_type 	= $this->input->post('price_type');
		$item_name 		= $this->input->post('item_name');
		$hargalama 		= $this->input->post('lama');
		$hargabaru 		= $this->input->post('baru');
		$code_item 		= $this->input->post('code_item');

		// Untuk proses harga base..
		$cekharga1 			= $this->m_inv->cekpriceitem($id_item,$price_type);
		$cekharga2 			= $this->m_inv->cekpriceitem_temp($id_item,$price_type);
		$jml 				= $cekharga2->num_rows();

		if ($jml == 0) { //Jika tidak ada maka akan di insert..

			$data_insert 		= array(
				'status' 		=> 1,
				'id_item' 		=> $id_item, 
				'price_type' 	=> $price_type, 
				'price' 		=> $hargabaru, 
				'currency' 		=> 'IDR', 
				'updated_by' 	=> $user_id, 
			);
			$this->m_inv->save_master_price_temp($data_insert);

			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
				'id_user'			=> $user_id,
				'log_date'			=> date("Y-m-d H:i:s"),
				'log_desc' 			=> "Insert Item Price ".$item_name." and id item ".$id_item." To : ".$hargabaru,
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log

		}else{ //Jika id item sudah pernah ada, maka data akan di update..

			$data_update 		= array(
				'status' 		=> 1,
				'Price' 		=> $hargabaru,
				'updated_by'	=> $user_id,
				'updated_date'	=> date("Y-m-d H:i:s"),
			);
			$this->m_inv->update_hrg_temp($id_item,$price_type,$data_update);


			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
				'id_user'			=> $user_id,
				'log_date'			=> date("Y-m-d H:i:s"),
				'log_desc' 			=> "Update Item Price ".$item_name." and id item ".$id_item." Price from : ".$hargalama." To : ".$hargabaru,
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
		
		} // Batas Else..
			
		// echo "<script>window.close(this); window.onunload = refreshParent; function refreshParent() { window.opener.location.assign('list_item_price/change'); }</script>";

	echo "<script>
			setTimeout(function () { 
				    window.opener.location = 'list_item_price/change';
				    window.close();
			}, 1);
	</script>";

 }


function delete_item_price(){

	// Update status menjadi delete
	$id						= $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_update 			= array(
		'status' 			=> 1,
	);
	$this->load->model('m_inv');
	$this->m_inv->update_mst_item_price($id,$data_update);
	// End update 

	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log = array(
		'id_user'			=> $user_id,
		'log_date'			=> date("Y-m-d H:i:s"),
		'log_desc' 			=> "Delete item price, id item ".$id,
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log

	// redirect('inv/list_item_price/del');
 } 


  //fungsi load Master item
 function step_2(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');	
		$session_data 			= $this->session->userdata('logged_in');
		$data["name_item"]		= $this->uri->segment(3);
		$data["baseunit"]		= $this->uri->segment(4);
		$data["id_request"]		= $this->uri->segment(5);
	    $data['username'] 		= $session_data['username'];
		$data['warehouse'] 		= $this->m_inv->get_list_wh();
		$data['data'] 			= $this->m_inv->get_list_it();
		$data['group'] 			= $this->m_inv->get_list_ig();
		$data['supplier'] 		= $this->m_inv->get_list_sp();
		$data['base']	 		= $this->m_inv->get_list_bu();
	    $this->template->set('title','Klinik | Master Item');
		$this->template->load('template','menu/step_2', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi load Master Convertion
 function inv_conversion(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 					= $this->session->userdata('logged_in');
	    $data['username'] 				= $session_data['username'];
		$data['warehouse'] 				= $this->m_inv->get_list_wh();
		$data['data'] 					= $this->m_inv->get_list_it();
		$data['group'] 					= $this->m_inv->get_list_ig();
		$data['supplier'] 				= $this->m_inv->get_list_sp();
		$data['base']	 				= $this->m_inv->get_list_bu();
		$data['conversion']	 			= $this->m_inv->get_list_conversion();
		$data['conversion_base']	 	= $this->m_inv->get_list_conversion_join_base();
	    $this->template->set('title','Klinik | Master Conversion');
		$this->template->load('template','menu/inv_conversion', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

  //fungsi simpan master Item
 function save_conversion(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
			$data_group			= array(
				'source_baseunit'	=>$this->input->post('sbu'),
				'conv_factor'		=>$this->input->post('convfactor'),
				'dest_baseunit'		=>$this->input->post('dest'),
				'remarks'			=>$this->input->post('remarks'),				
			);
			$this->load->model('m_inv');
			$this->m_inv->save_master_conversion($data_group);
		
			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d"),
						'log_desc' 						=>"Create Master Item : ".$this->input->post('i_name')."",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
			
			redirect('inv/inv_conversion/ok');
 }

 //fungsi load Master Convertion
 function add_conversion_popup(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 					= $this->session->userdata('logged_in');
	    $data['username'] 				= $session_data['username'];
		$data['warehouse'] 				= $this->m_inv->get_list_wh();
		$data['data'] 					= $this->m_inv->get_list_it();
		$data['group'] 					= $this->m_inv->get_list_ig();
		$data['supplier'] 				= $this->m_inv->get_list_sp();
		$data['base']	 				= $this->m_inv->get_list_bu();
		$data['conversion']	 			= $this->m_inv->get_list_conversion();
		$data['conversion_base']	 	= $this->m_inv->get_list_conversion_join_base();
	    $this->template->set('title','Klinik | Master Conversion');
		$this->template->load('template','menu/inv_conversion_popup', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

  //fungsi simpan master Item
 function save_conversion2(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
			$data_group			= array(
				'source_baseunit'	=>$this->input->post('sbu'),
				'conv_factor'		=>$this->input->post('convfactor'),
				'dest_baseunit'		=>$this->input->post('dest'),
				'remarks'			=>$this->input->post('remarks'),				
			);
			$this->load->model('m_inv');
			$this->m_inv->save_master_conversion($data_group);
		
			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d"),
						'log_desc' 						=>"Create Master Item : ".$this->input->post('i_name')."",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
			
			echo "<script> setTimeout(function () { window.close(); }, 1); </script>";

 }

 function inv_group_coa(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 					= $this->session->userdata('logged_in');
	    $data['username'] 				= $session_data['username'];
		$get_max						= $this->m_inv->get_max_group_coa();
		$data['matauang']				= $this->m_inv->get_mst_currency();
		$data['group_coa'] 				= $this->m_inv->get_master_group_coa();
		foreach ($get_max->result() as $rows) {$skey	= $rows->skey+1;}
		$data['skey'] 					= $skey;
	    $this->template->set('title','Klinik | Master Group Coa');
		$this->template->load('template','menu/inv_group_coa', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function inv_type_coa_excel(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 					= $this->session->userdata('logged_in');
	    $data['username'] 				= $session_data['username'];
		$data['hasil']  				= $this->m_inv->get_master_group_coa();
		$this->load->view('menu/inv_type_coa_excel', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function save_group_coa(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$now					= date("Y-m-d H:i:s");

			$data_group			= array(
				'sgroup'		=>'master_group_coa',
				'skey'			=>$this->input->post('skey'),
				'svalue'		=>$this->input->post('svalue'),
				'lvalue'		=>$this->input->post('svalue'),
				'remark'		=>$this->input->post('remarks'),
				'status'		=>1,				
				'created_time'	=>$now,	
				'created_by'	=>$user_id,	
			);
			$this->load->model('m_inv');
			$this->m_inv->save_sysparam($data_group);
		
			
			redirect('inv/inv_group_coa/ok');
 }

 function delete_group_coa(){

	$id						= $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$now					= date("Y-m-d H:i:s");
	$user_id				= $session_data['id'];	

	// Update status
	$data_group			= array(
				'status'		=>0,				
				'updated_time'	=>$now,	
				'updated_by'	=>$user_id,	
	);
	$this->load->model('m_inv');
	$this->m_inv->update_sysparam($id,$data_group);
	// End Update 


	redirect('inv/inv_group_coa/del');
 }

 function inv_coa(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 					= $this->session->userdata('logged_in');
	    $data['username'] 				= $session_data['username'];
		$data['matauang']				= $this->m_inv->get_mst_currency();
		$data['group_coa'] 				= $this->m_inv->get_master_group_coa();
		$data['coa_list']			 	= $this->m_inv->get_mst_coa();
	    $this->template->set('title','Klinik | Master Conversion');
		$this->template->load('template','menu/inv_coa', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function update_coa(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$data['order']					= $this->uri->segment(3);
		$session_data 					= $this->session->userdata('logged_in');
	    $data['username'] 				= $session_data['username'];
		$data['matauang']				= $this->m_inv->get_mst_currency();
		$data['group_coa'] 				= $this->m_inv->get_master_group_coa();
		$coa_list			 			= $this->m_inv->get_coa($data['order']);

		foreach ($coa_list->result() as $row) {
			$data['id_coa']				= $row->id_coa;
			$data['desc1']				= $row->desc1;
			$data['desc2']				= $row->desc2;
			$data['currency']			= $row->currency;
			$data['type']				= $row->type;
			$data['group']				= $row->group;
			$data['year']				= $row->year;
		}


	    $this->template->set('title','Klinik | Master Conversion');
		$this->template->load('template','menu/update_coa', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 
 function update_coa_process(){

	$id						= $this->input->post('urutan');
	$session_data 			= $this->session->userdata('logged_in');
	$now					= date("Y-m-d H:i:s");
	$user_id				= $session_data['id'];	

	// Update status
	$data_group				= array(
			'id_coa'		=>$this->input->post('idakun'),
			'desc1'			=>$this->input->post('desc1'),
			'desc2'			=>$this->input->post('desc2'),
			'currency'		=>$this->input->post('matauang'),
			'type'			=>$this->input->post('tipe'),
			'group'			=>$this->input->post('ortu'),
			'year'			=>$this->input->post('tahun'),
			'is_active'		=>0,	
			'updated_date'	=>$now,	
			'updated_by'	=>$user_id,	
	);
	$this->load->model('m_inv');
	$this->m_inv->update_coa($id,$data_group);
	// End Update 

	echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
 }


 function inv_coa_excel(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 					= $this->session->userdata('logged_in');
	    $data['username'] 				= $session_data['username'];
		$data['hasil']			 		= $this->m_inv->get_mst_coa();
		$this->load->view('menu/inv_coa_excel', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function save_coa(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$now					= date("Y-m-d H:i:s");

			$data_group			= array(
				'id_coa'		=>$this->input->post('idakun'),
				'desc1'			=>$this->input->post('desc1'),
				'desc2'			=>$this->input->post('desc2'),
				'currency'		=>$this->input->post('matauang'),
				'type'			=>$this->input->post('tipe'),
				'group'			=>$this->input->post('ortu'),
				'year'			=>$this->input->post('tahun'),
				'is_active'		=>0,				
				'created_date'	=>$now,	
				'created_by'	=>$user_id,	
			);
			$this->load->model('m_inv');
			$this->m_inv->save_mst_coa($data_group);
		
			
			redirect('inv/inv_coa/ok');
 }
 
 function delete_coa(){

	$id						= $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$now					= date("Y-m-d H:i:s");
	$user_id				= $session_data['id'];	

	// Update status
	$data_group				= array(
			'is_active'		=>1,				
			'updated_date'	=>$now,	
			'updated_by'	=>$user_id,	
	);
	$this->load->model('m_inv');
	$this->m_inv->update_coa($id,$data_group);
	// End Update 


	redirect('inv/inv_coa/del');
 }

function inv_conversion_excel(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 					= $this->session->userdata('logged_in');
	    $data['username'] 				= $session_data['username'];
		$data['warehouse'] 				= $this->m_inv->get_list_wh();
		$data['data'] 					= $this->m_inv->get_list_it();
		$data['group'] 					= $this->m_inv->get_list_ig();
		$data['supplier'] 				= $this->m_inv->get_list_sp();
		$data['base']	 				= $this->m_inv->get_list_bu();
		$data['conversion']	 			= $this->m_inv->get_list_conversion();
		$data['conversion_base']	 	= $this->m_inv->get_list_conversion_join_base();
		$this->load->view('menu/inv_conversion_excel', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function delete_conversion(){

	$id						= $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	

	// Update status
	$data_delete			= array(
	'is_active'				=>1,		
	);
	$this->load->model('m_inv');
	$this->m_inv->update_mst_conversion($id,$data_delete);
	// End Update 

	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log 				= array(
	'id_user'				=>$user_id,
	'log_date'				=>date("Y-m-d H:i:s"),
	'log_desc' 				=>"Delete Conversion, id : ".$id." , Delete By ". $user_id,
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log


	redirect('inv/inv_conversion/del');
 }
 

function update_inv_conversion(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 					= $this->session->userdata('logged_in');
	    $data['username'] 				= $session_data['username'];
	    $data['id_conversion']			= $this->uri->segment(3);
		$data['warehouse'] 				= $this->m_inv->get_list_wh();
		$data['data'] 					= $this->m_inv->get_list_it();
		$data['group'] 					= $this->m_inv->get_list_ig();
		$data['supplier'] 				= $this->m_inv->get_list_sp();
		$data['base']	 				= $this->m_inv->get_list_bu();
		$data['conversion']	 			= $this->m_inv->get_list_conversion();
		$get_data 					 	= $this->m_inv->get_list_conversion_join_base_id($data['id_conversion']);

		foreach ($get_data->result() as $row) {
			$data['source_baseunit'] 	= $row->source_baseunit;
			$data['conv_factor'] 		= $row->conv_factor;
			$data['dest_baseunit'] 		= $row->dest_baseunit;
			$data['remarks'] 			= $row->remarks;
		}

	    $this->template->set('title','Klinik | Master Conversion');
		$this->template->load('template','menu/update_inv_conversion', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 } 

 function process_update_inv_conversion(){

	$id						= $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$id 					= $this->input->post('id_conversion');
	
	// Update status
	$data_update			= array(
	'source_baseunit'		=>$this->input->post('sbu'),
	'conv_factor'			=>$this->input->post('convfactor'),
	'dest_baseunit'			=>$this->input->post('dest'),
	'remarks'				=>$this->input->post('remarks'),	
	);
	$this->load->model('m_inv');
	$this->m_inv->update_mst_conversion($id,$data_update);
	// End Update 

	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log 				= array(
	'id_user'				=>$user_id,
	'log_date'				=>date("Y-m-d H:i:s"),
	'log_desc' 				=>"Update Conversion, id : ".$id." , By ". $user_id,
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log

	// echo "<script>window.close(this); window.onunload = refreshParent; function refreshParent() { window.opener.location.assign('inv_conversion/change'); }</script>";


	echo "<script>
			setTimeout(function () { 
				    window.opener.location = 'inv_conversion/change';
				    window.close();
			}, 1);
	</script>";
 }

 //fungsi load Master item group
 function inv_item_group(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_inv->get_list_ig();
	    $this->template->set('title','Klinik | Master Item Group');
		$this->template->load('template','menu/inv_item_group', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

function inv_item_group_excel(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_inv->get_list_ig();
		$this->load->view('menu/inv_item_group_excel', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function update_inv_item_group(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['id_group']		= $this->uri->segment(3);
		$get_group 				= $this->m_inv->get_list_ig_id($data['id_group']);

		foreach ($get_group->result() as $row) {
			$data['item_group']	= $row->item_group;
			$data['remarks']	= $row->remarks;
		}

	    $this->template->set('title','Klinik | Master Item Group');
		$this->template->load('template','menu/update_inv_item_group', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function process_update_inv_item_group(){

	$id						= $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$id						= $this->input->post('id_group');
	$g_name					= $this->input->post('g_item');
	$g_desc					= $this->input->post('g_desc');

	// Update status
	$data_delete			= array(
	'item_group'			=>$g_name,		
	'remarks'				=>$g_desc,		
	);
	$this->load->model('m_inv');
	$this->m_inv->update_mst_item_group($id,$data_delete);
	// End Update 

	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log 				= array(
	'id_user'				=>$user_id,
	'log_date'				=>date("Y-m-d H:i:s"),
	'log_desc' 				=>"Update Group Inv Item, id : ".$id." , Delete By ". $user_id,
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log

	// echo "<script>window.close(this); window.onunload = refreshParent; function refreshParent() { window.opener.location.assign('inv_item_group/change'); }</script>";
	
	echo "<script>
			setTimeout(function () { 
				    window.opener.location = 'inv_item_group/change';
				    window.close();
			}, 1);
	</script>";
 }

 function delete_inv_item_group(){

	$id						= $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	

	// Update status
	$data_delete			= array(
	'is_active'				=>1,		
	);
	$this->load->model('m_inv');
	$this->m_inv->update_mst_item_group($id,$data_delete);
	// End Update 

	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log 				= array(
	'id_user'				=>$user_id,
	'log_date'				=>date("Y-m-d H:i:s"),
	'log_desc' 				=>"Delete Group Inv Item, id : ".$id." , Delete By ". $user_id,
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log


	redirect('inv/inv_item_group/del');
 }

 //fungsi simpan master Item
 function save_it(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
			$data_group			= array(
				'id_manufaktur'		=>$this->input->post('i_manuid'),
				'item_group'		=>$this->input->post('i_group'),
				'item_group'		=>$this->input->post('i_group'),
				'item_name'			=>$this->input->post('i_name'),
				'coa'				=>$this->input->post('i_coa'),
				'inv_coa'			=>$this->input->post('i_invcoa'),
				'cost_coa'			=>$this->input->post('i_costcoa'),
				'batch_code'		=>str_replace("DOESN'T HAVE BATCH CODE!","0",$this->input->post('i_batchcode')),
				'expired_date'		=>date("Y-m-d",strtotime($this->input->post('i_expired'))),
				'baseunit'			=>$this->input->post('i_baseunit'),
				'batch_date'		=>date("Y-m-d",strtotime($this->input->post('i_batchdate'))),
				'item_curr_qty'		=>0,
				'supplier_id'		=>$this->input->post('i_supplier'),
				'warehouse_id'		=>$this->input->post('i_warehouse'),
				'item_remarks'		=>$this->input->post('i_remarks'),
				'created_by'		=>$user_id,
			);
			$this->load->model('m_inv');
			$this->m_inv->save_master_item($data_group);
		
			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d"),
						'log_desc' 						=>"Create Master Item : ".$this->input->post('i_name')."",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
			
			redirect('inv/inv_item/ok');
 }


 //fungsi simpan master Item
 function save_it2(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$id_item_request_d 		= $this->input->post('id_item_request_d');
			
			$data_group				= array(
				'id_manufaktur'		=>$this->input->post('i_manuid'),
				'item_group'		=>$this->input->post('i_group'),
				'item_group'		=>$this->input->post('i_group'),
				'item_name'			=>$this->input->post('i_name'),
				'batch_code'		=>str_replace("DOESN'T HAVE BATCH CODE!","0",$this->input->post('i_batchcode')),
				'expired_date'		=>date("Y-m-d",strtotime($this->input->post('i_expired'))),
				'baseunit'			=>$this->input->post('i_baseunit'),
				'batch_date'		=>date("Y-m-d",strtotime($this->input->post('i_batchdate'))),
				'item_curr_qty'		=>0,
				'supplier_id'		=>$this->input->post('i_supplier'),
				'warehouse_id'		=>$this->input->post('i_warehouse'),
				'item_remarks'		=>$this->input->post('i_remarks'),
				'created_by'		=>$user_id,
			);
			$this->load->model('m_inv');
			$this->m_inv->save_master_item($data_group);

			$data_update			= array(
				'is_complete'		=>1,
			);
			$this->m_inv->update_request_item_d($id_item_request_d,$data_update);

			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d"),
						'log_desc' 						=>"Create Master Item : ".$this->input->post('i_name')."",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
			
			echo "Item Save !!"; exit();
 }

 //fungsi load Purchase Request
 function purchase_req(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$this->load->model('m_master');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['jobs'];
		$pr_no 					= $this->m_inv->get_max_trx_item_pr_h();
		$data['depart'] 		= $this->m_inv->get_list_depart($id);
		$data['base']	 		= $this->m_inv->get_list_bu();
		
		
		foreach ($pr_no->result() as $row1) {
			$data['code_no'] 	= $row1->id_pr_no+1;
		}
		
		foreach ($data['depart']->result() as $row2) {
			$data['kode_dep'] 	= $row2->kode_dep;
			$data['nama_dep'] 	= $row2->nama_dep;
		}
		
		// Create Number PR...
		$this->load->model('m_master');			
		$number 				= $this->m_master->get_number_param('pr_order');
		$data['tahun'] 			= date('Y');
		$data['bulan'] 			= date('m');
		
		foreach ($number->result() as $row3) {
			$data['id_sysp']		= $row3->id;
			$data['sgroup']			= $row3->sgroup;
			$data['skey']			= (int)$row3->skey+1;
			$data['svalue']			= (int)$row3->svalue;
			$data['lvalue']			= $row3->lvalue;
			$data['status']			= $row3->status;
			$data['created_time']	= $row3->created_time;
			$data['created_by']		= $row3->created_by;
			$data['updated_time']	= $row3->updated_time;
			$data['updated_by']		= $row3->updated_by;
			$data['remark']			= $row3->remark;
		}

        if ($data['svalue'] <> $data['bulan']) {$data['skey'] = 1;}
			
		$data['urutan'] 	= str_pad($data['skey'], 4, "0", STR_PAD_LEFT);
		// End Create Number PR...

	    $this->template->set('title','Klinik | Purchase Request Entry');
		$this->template->load('template','menu/inv_pr', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi simpan save purchase request
 function save_pr(){
		
		$this->load->model('m_inv');
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$rowC					= $this->input->post('rowcount');
		$id_item_request_h		= "";
	
		if ($rowC==0){
			$rowC="1";
		}else{
			$rowC=$rowC;
		}

		// Create Number PR...
		$this->load->model('m_master');			
		$number 				= $this->m_master->get_number_param('pr_order');
		$data['tahun'] 			= date('Y');
		$data['bulan'] 			= date('m');
		
		foreach ($number->result() as $row3) {
			$data['id_sysp']		= $row3->id;
			$data['sgroup']			= $row3->sgroup;
			$data['skey']			= (int)$row3->skey+1;
			$data['svalue']			= (int)$row3->svalue;
			$data['lvalue']			= $row3->lvalue;
			$data['status']			= $row3->status;
			$data['created_time']	= $row3->created_time;
			$data['created_by']		= $row3->created_by;
			$data['updated_time']	= $row3->updated_time;
			$data['updated_by']		= $row3->updated_by;
			$data['remark']			= $row3->remark;
		}

       
        if ($data['svalue'] <> $data['bulan']) {$data['skey'] = 1;}
			
		$urutan 			= str_pad($data['skey'], 4, "0", STR_PAD_LEFT);
			
		$data_update 		= array(
			'skey'			=>$data['skey'],
			'svalue'		=>$data['bulan'],
			'lvalue'		=>$data['tahun'],
		);
		$this->load->model('m_master');			
		$this->m_master->update_sysparam($data['id_sysp'],$data_update);
		// End Create Number PR...

		$data_pack 			= array(
			'pr_no'			=>$this->input->post('no')."/".$urutan,
			'pr_date'		=>date("Y-m-d",strtotime($this->input->post('date'))),
			'dept_id'		=>$this->input->post('department'),
			'user_id'		=>$user_id,
			'is_finalized'	=>1,
		);
		$this->m_inv->save_pr_header($data_pack);

		$header 				= $this->m_inv->get_max_trx_item_pr_h();
		foreach ($header->result() as $row) {
			$id_pr_no = $row->id_pr_no;
		}

		// 	include './design/koneksi/file.php';
		// 	$query 		="SELECT id_pr_no id FROM trx_item_pr_h ORDER BY id_pr_no DESC LIMIT 1";  
		// 	if($result 	=mysqli_query($con,$query))
		// 	{
		// 		//$date	=date('ym');
		// 		$row 	=mysqli_fetch_assoc($result);
		// 		$count 	=$row['id'];
		// 	}


		for($i=1; $i<=$rowC; $i++){

			$data_pack 					= array(
				'id_item_pr_h'			=>$id_pr_no,
				'id_item'			 	=>$this->input->post('id_item['.$i.']'),
				'item_product'			=>$this->input->post('item['.$i.']'),
				'item_qty'				=>$this->input->post('qty['.$i.']'),
				'vestige'				=>$this->input->post('qty['.$i.']'),
				'item_uom'				=>$this->input->post('base['.$i.']'),
				'delevery_date'			=>date("Y-m-d",strtotime($this->input->post('deliv['.$i.']'))),
				'remarks'				=>$this->input->post('remarks['.$i.']'),
				'seq_no'				=>$i,
			);
			$this->load->model('m_inv');
			$this->m_inv->save_pr_detail($data_pack);

			if ($this->input->post('cadangan['.$i.']') == 1) {
				
				$cekheader 		= $this->m_inv->get_max_item_request_header();
				foreach ($cekheader->result() as $rows) {
					$id_item_request_h	= $rows->id_item_request_h+1;
				}

				if ($id_item_request_h == "") {
					$data_insert 			= array(
						'id_pr_no'			=>$count,
						'source'			=>"Purchase Request",
						'create_by'			=>$user_id,
						'create_date'		=>date("Y-m-d H:i:s"),			
					);
					$this->m_inv->insert_item_request_header($data_insert);
				}

				$data_insert 				= array(
					'id_item_request_h'		=>$id_item_request_h,
					'item_product'			=>$this->input->post('item['.$i.']'),
					'item_qty'				=>$this->input->post('qty['.$i.']'),			
					'item_uom'				=>$this->input->post('base['.$i.']'),			
					'remarks'				=>$this->input->post('remarks['.$i.']'),
				);
				$this->m_inv->insert_item_request_detail($data_insert);

			}
		}

		redirect('inv/purchase_req/ok');
 }

 //fungsi load print purchase request
 function print_pr(){
    if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_inv');		
	  $this->load->model('m_master');		
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['data'] 			= $this->m_inv->get_pr_header($id);
	  $data['main'] 			= $this->m_inv->get_pr_main_ap($id);
	  // $data['main'] 			= $this->m_inv->get_pr_main($id);
	  
	  $this->load->view('menu/print_pr', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

/** Modul Transfer Item Di Bawah ini **/

 function transfer_items_request(){
    if($this->session->userdata('logged_in')){	

		$this->load->model('m_inv');			
		$this->load->model('m_user');			

		// $this->m_inv->sys_gudang(); // syscrone gudang trx_item_wh dari mst_warehouse
		// $this->m_inv->sys_item_to_wh(); // syscrone tabel trx_item_wh pada table mst_item
		// $this->m_inv->sys_transfer_item(); // syscrone tabel trx_item_wh pada table mst_item
		// $this->m_inv->sys_item_min_stock(); // syscrone tabel trx_item_wh pada table mst_minmax (PENTING)
		// $this->m_inv->sys_item_minus_stock(); // syscrone tabel trx_item_wh pada table mst_minmax (PENTIG)
		// $this->m_inv->sys_item_min_stock(); // syscrone tabel trx_item_wh pada table mst_minmax

		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$department		 		= $session_data['jobs'];
		$data['depart'] 		= $this->m_inv->get_list_depart($department);
		$data['gudang'] 		= $this->m_inv->get_warehouse_dep($department);
	 	$data['job']			= $this->m_user->get_job();
	 	$goblin					= $this->m_inv->get_mi_jumlah_dept($department);
	 	$jumlah 				= $goblin->num_rows();
	 	$data['code_no']		= $jumlah+1;
		$data['urutan'] 		= str_pad($data['code_no'], 4, "0", STR_PAD_LEFT);

	 	foreach($data['depart']->result() as $rows){
	 		$data['nama_dep']	= $rows->nama_dep;
	 		$data['kode_dep']	= $rows->kode_dep;
	 		$data['ket']		= $rows->ket;
	 		$data['id_comp']	= $rows->id_comp;
	 		$data['nama_dep']	= $rows->nama_dep;
	 	}


	    $this->template->set('title','Klinik | Transfer Item Request');
		$this->template->load('template','menu/transfer_items_request', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function save_mi(){

	$this->load->model('m_inv');

	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];
	$department				= $session_data['id'];
	$now					= date("Y-m-d H:i:s");
	$goblin					= $this->m_inv->get_mi_jumlah_dept($department);
	$jumlah 				= $goblin->num_rows();
	$code_no				= $jumlah+1;
	$to_dep					= $this->input->post('to_dep');
	$rowC					= $this->input->post('rowcount');
	$tanggal				= $this->input->post('date');
	$nomortrf1				= $this->input->post('no');
	$nomortrf				= $this->input->post('nomortrf');
	$mi_no 					= $code_no.$nomortrf;
	$ipno 					= getenv('REMOTE_ADDR');

	if ($rowC==0){
		$rowC="1";
	}else{
		$rowC=$rowC;
	}


	$cekheader 		= $this->m_inv->get_max_trx_item_transfer_h();
	foreach ($cekheader->result() as $rows) {
		$count	= $rows->id_mi_no+1;
	}


	$data_pack 					= array(
	'mi_no'						=>$nomortrf1,
	'mi_date'			 		=>$now,
	'from_wh'					=>$this->input->post('move'),
	'from_dept'					=>$this->input->post('from_dept'),
	'to_wh'						=>$this->input->post('to_wh'),
	'to_dept'					=>$this->input->post('to_dep'),
	'user_id'					=>$user_id,
	'create_by'					=>$user_id,
	'is_finalized'				=>0,
	'ipno'						=>$ipno,
	);
	$this->m_inv->save_mi_header($data_pack);

			// include './design/koneksi/file.php';
			// $query 		="SELECT id_mi_no id FROM trx_item_transfer_h ORDER BY id_mi_no DESC LIMIT 1";  
			// if($result 	=mysqli_query($con,$query))
			// {
			// 	//$date	=date('ym');
			// 	$row 	=mysqli_fetch_assoc($result);
			// 	$count 	=$row['id'];
			// }

	for($i=1; $i<=$rowC; $i++){
		$sql = "INSERT INTO trx_item_transfer_d (id_item_mi_h, id_item, item_product, item_qty, item_uom, remarks, create_by) VALUES ('".$count."', '".$this->input->post('id_item['.$i.']')."', '".$this->input->post('item['.$i.']')."', '".$this->input->post('qty['.$i.']')."', '".$this->input->post('base['.$i.']')."','".$this->input->post('remarks['.$i.']')."', '".$user_id."')";
		$this->db->query($sql);
	}


	$insert_notif				= array(
	'id_reg'			 		=>$nomortrf1,
	'id_trouble'				=>$count,
	'id_source_trouble'			=>$count,
	'type_id'					=>$count,
	'id_department'				=>$this->input->post('from_dept'),
	'notes'						=>'Transfer Items',
	'status'					=>0,
	'create_date'				=>$now,
	);
	$this->m_inv->insert_smart_notification($insert_notif);

	$cekdata					= $this->m_inv->get_mi_cek_nomor($to_dep,$nomortrf1);
	// $cekdata					= $this->m_inv->get_mi_cek_nomor($to_dep,$mi_no);
	$jumlahdata					= $cekdata->num_rows();
	$rowC 						= $jumlahdata-1;
	$pertama					= 1;
	$tambahan					= 1;

	// echo $jumlahdata."<br>"; 
	// echo $rowC."<br>"; 
	// exit();

	// $babydragon						= array();
	// foreach ($cekdata->result() as $row) {
	// 	$babydragon		= $row->id_mi_no;
	// }
	
	// print_r($babydragon); 
	// exit();
	foreach ($cekdata->result() as $row) {
		$id_mi_nos		= $row->id_mi_no;
		
		if ($pertama <= $rowC) {
			
			$nomortambahan			= $tambahan.$nomortrf;


			$data_update			= array(
			'mi_no'			 		=>$nomortambahan,
			);
			$this->m_inv->update_trx_item_transfer_h($id_mi_nos,$data_update);

			// echo $id_mi_nos." - "; 
			// echo $nomortambahan."<br>"; 

			$tambahan = $tambahan+1;
		}

	}

	redirect('inv/transfer_items_request/ok');
 }



 function list_mi(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		$data['depart'] 		= $this->m_inv->get_list_depart($id);
		$data['list'] 			= $this->m_inv->get_list_mi($id);
	    $this->template->set('title','Klinik | Purchase Request List');
		$this->template->load('template','menu/list_mi', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi load print purchase request
 function print_ir(){
    if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_inv');		
	  $this->load->model('m_master');		
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['location'] 		= $session_data['location'];
	  $data['data'] 			= $this->m_inv->get_mi_header($id);
	  $data['main'] 			= $this->m_inv->get_mi_main($id);
	  $cabang 					= $this->m_inv->get_cabang($data['location']);
	  foreach ($cabang->result() as $row) {
	  	$data['nama_branch'] 	= $row->nama_branch;
	  }
	  
	  $this->load->view('menu/print_ir', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function trf_item_app(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$id_mi_no				= $this->uri->segment(3);
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		$data['header']			= $this->m_inv->get_header_trf_items($id_mi_no);
		$data['detail']			= $this->m_inv->get_detail_trf_items($id_mi_no);
	    $this->template->set('title','Klinik | Request Transfer Items');
		$this->template->load('template','menu/trf_item_app', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function save_trf_item_app(){
 	if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		$id_mi_no 				= $this->input->post('id_mi_no');
		$id_mi_d 				= $this->input->post('id_mi_d');
		$id_wh 					= $this->input->post('id_wh');
		$sisa 					= $this->input->post('sisa');
		$jumlah					= $this->input->post('jumlah');
		$id_item				= $this->input->post('id_item');
		$jml_from 				= $this->input->post('jml_from');
		$from_wh 				= $this->input->post('from_wh');
		$to_wh 					= $this->input->post('to_wh');
		$simpan 				= $this->input->post('simpan');

		if ($simpan == 0) {
			// pindah ke window reject;
			redirect('/inv/trf_item_app_reject/'.$id_mi_no.'');
			exit();
		}

		if ($simpan == 1) {
			// Membuat id pada table trx_item_wh jika belum ada id-nya....
			$cek_stock_towh = $this->m_inv->get_detail_trf_items2($id_mi_no);
			foreach ($cek_stock_towh->result() as $rowx) {
				if ($rowx->id_wh == 0) {
					$data_insert 		= array(
						'id_item'		=> $rowx->id_item,
						'id_warehouse'	=> $to_wh,
						'stock'			=> 0,
					);
					$this->m_inv->insert_trx_item_wh($data_insert);
				}
			}
			// Update data table trx_item_transfer_h...
		   	$data_updateh = array(
				'is_finalized'		=> 0, 
				'status' 			=> 1, 
				'user_app' 			=> $id, 
				'app_date' 			=> date("Y-m-d H:i:s"), 
			);
			$this->m_inv->update_header_trf_items($id_mi_no,$data_updateh);
			// Update data table trx_item_transfer_d....
		   	$data_updated = array(
				'status' 			=> 1, 
				'approve' 			=> 1, 
			);
			$this->m_inv->update_detail_trf_items($id_mi_no,$data_updated);

			for ($i=0; $i < $jml_from ; $i++) { 
			
				$data_kurang		= array(
					'stock'			=> $sisa[$i],
					'update_by'		=> $session_data['id'],
					'update_date'	=> date("Y-m-d H:i:s"), 
				);
				$this->m_inv->update_trx_item_wh2($id_wh[$i],$data_kurang);

				$data_tambah		= array(
					'update_by'		=> $session_data['id'],
					'update_date'	=> date("Y-m-d H:i:s"), 
				);
				$this->m_inv->update_trx_item_wh3($id_item[$i],$to_wh,$data_tambah,$jumlah[$i]);

			}

			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log 				= array(
			'id_user'				=>$user_id,
			'log_date'				=>date("Y-m-d H:i:s"),
			'log_desc' 				=>"Approval Transfer Item pada table trx_item_transfer_h, id : ".$id_mi_no." , Approval By ". $user_id,
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
		}


		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
		exit();

	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 
 function trf_item_app_reject(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$id_mi_no				= $this->uri->segment(3);
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		$data['header']			= $this->m_inv->get_header_trf_items($id_mi_no);
		$data['detail']			= $this->m_inv->get_detail_trf_items($id_mi_no);
	    $this->template->set('title','Klinik | Reject Transfer Items');
		$this->template->load('template','menu/trf_item_app_reject', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }


 function listmi_app(){
	$session_data 			= $this->session->userdata('logged_in');
	$data['username'] 		= $session_data['username'];
	$id				 		= $session_data['jobs'];
	$level					= $session_data['userlevel'];
		
		$this->load->model('m_inv');			
		$data['list'] 		= $this->m_inv->get_list_app_mi($id);
	    $this->template->set('title','Klinik | Purchase Request Approval');
		$this->template->load('template','menu/inv_mi_app', $data);

 }

 function app_mi(){
 	$this->load->model('m_inv');
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data['username'] 		= $session_data['username'];
	$jobs			 		= $session_data['jobs'];
	$level					= $session_data['userlevel'];
	$id_mi_no				= $this->uri->segment(3);
	$datatf					= $this->m_inv->get_request_item($id_mi_no);

	foreach ($datatf->result() as $row) {
		$id_mi_no			= $row->id_mi_no;
		$mi_no 				= $row->mi_no;
		$from_wh			= $row->from_wh;
		$to_wh 				= $row->to_wh;
		$id_mi_d			= $row->id_mi_d;
		$id_item			= $row->id_item;
		$item_qty 			= $row->item_qty;
		$list_from 			= $this->m_inv->get_list_trx_item_wh($id_item,$from_wh);
		$jml_from			= $list_from->num_rows();

		$data_update 			= array(
	  	'approve'				=> $item_qty,
	  	'status'				=> 1,
	  	);	
	  	$this->m_inv->update_trfmid($id_mi_d,$data_update);

		foreach ($list_from->result() as $row_from) {
			$id_wh 			= $row_from->id;
			$stock 			= $row_from->stock;
			$sisa 			= $stock - $item_qty;
		}


		if ($jml_from == 0) {
			echo "<script>
			 alert('Not Found id item ".$id_item." In id warehouse ".$id_warehouse." ');
			 history.back();
			</script>";
			exit();
		}elseif ($sisa == 0) {
			echo "<script>
			 alert('Insufficient number of items, please check again');
			 history.back();
			</script>";
			exit();
		}
			
		$data_update		= array(
		'stock'				=> $sisa,
		'update_by'			=> $user_id,
		);
		$this->m_inv->update_trx_item_wh($id_item,$from_wh,$data_update);

		$data_input					= array(
		'id_item'					=>$id_item,
		'trx_type'		 			=>'M',
		'amount'					=>$item_qty,
		'from'						=>$from_wh,
		'to'						=>$to_wh,
		'created_date'				=>date("Y-m-d H:i:s"),
		'user_id'					=>$user_id,
		);
		$this->m_inv->save_trx($data_input);
		

		$list_to 			= $this->m_inv->get_list_trx_item_wh($id_item,$to_wh);
		$jml_to	 			= $list_to->num_rows();

		foreach ($list_to->result() as $row_to) {
			$id_wh_to		= $row_to->id;
			$stock 			= $row_to->stock;
			$tambah			= $stock + $item_qty;
		}

		if ($jml_to == 0) {
		
			$data_insert			= array(
				'id_item'			=> $id_item,
				'id_warehouse'		=> $to_wh,
				'stock'				=> $item_qty,				
				'update_by'			=> $user_id,
			);

 			$this->load->model('m_inv');			
			$this->m_inv->save_master_trx_item_wh($data_insert);


		}else{

			$data_update		= array(
			'stock'				=> $tambah,
			'update_by'			=> $user_id,
			);
			$this->m_inv->update_trx_item_wh($id_item,$to_wh,$data_update);

		}
	}

	$data['sys'] 			= $this->m_inv->sys_master_item();

	 $this->load->model('m_inv');
	 $data_app 				= array(
	'is_finalized'			=>1,
	'user_app'			 	=>$user_id,
	);
	 $this->m_inv->app_mi($id_mi_no,$data_app);
	 redirect('/inv/listmi_app/app');
 }

 function decl_mi(){
	 $session_data 			= $this->session->userdata('logged_in');
	 $id_user 				= $session_data['id'];
	 $id 					= $this->uri->segment(3);
	 
	 $this->load->model('m_inv');
	 $data_app 							= array(
				'is_finalized'			=>2,
				'user_app'			 	=>$id_user,
			);
	 $this->m_inv->app_mi($id,$data_app);

	 $data_app 							= array(
				'approve'				=>0,
				'status'			 	=>2,
			);
	 $this->m_inv->update_trfmid2($id,$data_app);

	 redirect('/inv/listmi_app/del');
 } 

 function print_mi(){
    if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_inv');		
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['data'] 			= $this->m_inv->get_mi_header($id);
	  $data['main'] 			= $this->m_inv->get_mi_main($id);
	  $this->load->view('menu/print_mi', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function app_one(){
    if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_inv');		
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['data'] 			= $this->m_inv->get_mi_header($id);
	  $data['main'] 			= $this->m_inv->get_mi_main($id);
	  $this->template->set('title','Klinik | Approval');
	  $this->template->load('template','menu/app_one', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function save_appmi(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');		
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$data['username'] 		= $session_data['username'];
		$id_mi_d 				= $this->input->post('id_mi_d[]');
		$loop 					= $this->input->post('loop');
		$jml 					= $this->input->post('jml[]');
		$id_mi_no 				= $this->input->post('id_mi_no');

		for($i=0; $i<$loop; $i++) {
			$data_update 			= array(
			'approve'				=> $jml[$i],
			'status'				=> 3,
			);	
			$this->m_inv->update_trfmid($id_mi_d[$i],$data_update);
		}

		$datatf					= $this->m_inv->get_request_item($id_mi_no);

		foreach ($datatf->result() as $row) {
			$mi_no 				= $row->mi_no;
			$from_wh			= $row->from_wh;
			$to_wh 				= $row->to_wh;
			$id_mi_d			= $row->id_mi_d;
			$id_item			= $row->id_item;
			$item_qty 			= $row->approve;
			$list_from 			= $this->m_inv->get_list_trx_item_wh($id_item,$from_wh);
			$jml_from			= $list_from->num_rows();


			foreach ($list_from->result() as $row_from) {
				$id_wh 			= $row_from->id;
				$stock 			= $row_from->stock;
				$sisa 			= $stock - $item_qty;
			}

			if ($jml_from == 0) {
				echo "<script>
				 alert('Not Found id item ".$id_item." In id warehouse ".$id_warehouse." ');
				 history.back();
				</script>";
				exit();
			}elseif ($sisa == 0) {
				echo "<script>
				 alert('Insufficient number of items, please check again');
				 history.back();
				</script>";
				exit();
			}
				
			$data_update		= array(
			'stock'				=> $sisa,
			'update_by'			=> $user_id,
			);
			$this->m_inv->update_trx_item_wh($id_item,$from_wh,$data_update);

			$data_input					= array(
			'id_item'					=>$id_item,
			'trx_type'		 			=>'M',
			'amount'					=>$item_qty,
			'from'						=>$from_wh,
			'to'						=>$to_wh,
			'created_date'				=>date("Y-m-d H:i:s"),
			'user_id'					=>$user_id,
			);
			$this->m_inv->save_trx($data_input);
			

			$list_to 			= $this->m_inv->get_list_trx_item_wh($id_item,$to_wh);
			$jml_to	 			= $list_to->num_rows();

			foreach ($list_to->result() as $row_to) {
				$id_wh_to		= $row_to->id;
				$stock 			= $row_to->stock;
				$tambah			= $stock + $item_qty;
			}

			if ($jml_to == 0) {
				
				$data_insert			= array(
					'id_item'			=> $id_item,
					'id_warehouse'		=> $to_wh,
					'stock'				=> $item_qty,				
					'update_by'			=> $user_id,
				);
				$this->m_inv->save_master_trx_item_wh($data_insert);

			}else{

				$data_update		= array(
				'stock'				=> $tambah,
				'update_by'			=> $user_id,
				);
				$this->m_inv->update_trx_item_wh($id_item,$to_wh,$data_update);

			}
		}

		$data['sys'] 			= $this->m_inv->sys_master_item();

		 $this->load->model('m_inv');
		 $data_app 				= array(
		'is_finalized'			=>3,
		'user_app'			 	=>$user_id,
		);
		 $this->m_inv->app_mi($id_mi_no,$data_app);

		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";

	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }


/** Modul Transfer Item Di Atas ini **/

 //fungsi load Find Item
 function find_item_drug(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_pharmacy');				
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_pharmacy->get_find_item_drug();
	    $this->template->set('title','Klinik | Find Item');
		$this->template->load('template','menu/find_item_drug3', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 } 

 //fungsi load List Purchase Request
 function list_pr(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$this->load->model('m_master');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $data['userlvl'] 		= $session_data['userlevel'];
		$id				 		= $session_data['id'];
		$data['depart'] 		= $this->m_inv->get_list_depart($id);
		$data['list'] 			= $this->m_inv->get_list_pr($id);
		$i 						= 1;
		foreach ($data['list']->result() as $row) {
			$data['detail'.$i] 	= $this->m_inv->get_pr_main($row->id_pr_no);
			$i++;
		}

		
		$is_status 				= $this->m_master->get_sysparam('is_status','trx_item_pr_d');
		$data['skey'] 			= array();
		$data['svalue'] 		= array();
		$data['lvalue'] 		= array();

		foreach ($is_status->result() as $row) {
		$data['skey'][]			= $row->skey;
		$data['svalue'][]		= $row->svalue;
		$data['lvalue'][]		= $row->lvalue;
		}


	    $this->template->set('title','Klinik | Purchase Request List');
		$this->template->load('template','menu/list_pr', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 
 function fetch_item(){
    if($this->session->userdata('logged_in')){	
	  $this->load->model('m_lab');		
	  $session_data 			= $this->session->userdata('logged_in');
	  $this->template->set('title','Klinik | Item');
	  $this->template->load('template','menu/fetch_item');
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }  

 function save_mst_items_price(){		
 	$session_data 			= $this->session->userdata('logged_in');		
 	$rowC					= $this->input->post('count_ant');			
 	if($rowC==""){				
 		$rowC="1";			
 	}else{				
 		$rowC=$rowC;			
 	}						
 		for($i=1; $i<=$rowC; $i++){			
 			$sql = "INSERT INTO mst_item_price (id_item, price_type, price, currency, id_branch) VALUES ('".$this->input->post('id_item')."', '".$this->input->post('type_'.$i.'')."', '".str_replace(",","",$this->input->post('price_'.$i.''))."', '".$this->input->post('curr_type_'.$i.'')."', '".$this->input->post('branch')."')";			$this->db->query($sql);			
 		}			

 	redirect('inv/list_item_price/ok'); 
 }
 
 function save_mst_items_price2(){		
 	$session_data 			= $this->session->userdata('logged_in');		
 	$rowC					= $this->input->post('count_ant');			
	$user_id		 		= $session_data['id'];
 	if($rowC==""){				
 		$rowC="4";			
 	}else{				
 		$rowC=$rowC;			
 	}						
 		for($i=1; $i<=$rowC; $i++){			
 			// $sql = "INSERT INTO mst_item_price (id_item, price_type, price, currency, id_branch, create_by) VALUES ('".$this->input->post('id_item')."', '".$this->input->post('type_'.$i.'')."', '".str_replace(",","",$this->input->post('price_'.$i.''))."', '".$this->input->post('curr_type_'.$i.'')."', '".$this->input->post('branch')."', '".$user_id."')";			
 			// $this->db->query($sql);			

 			$data_insert 		= array(
				'status' 		=> 0,
				'id_item' 		=> $this->input->post('id_item'), 
				'price_type' 	=> $this->input->post('type_'.$i.''), 
				'price' 		=> str_replace(",","",$this->input->post('price_'.$i.'')), 
				'currency' 		=> 'IDR', 
				'id_branch' 	=> $this->input->post('branch'), 
				'create_by' 	=> $user_id, 
			);
			$this->load->model('m_inv');		
			$this->m_inv->save_master_price($data_insert);
 		}			
 	redirect('inv/mst_item_price/ok'); 
 }
 
 function mst_item_price(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_quotation');		
		$this->load->model('m_inv');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		$data['sv_group'] 		= $this->m_inv->get_list_ig();
		$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
		$data['pay_type'] 		= $this->m_quotation->get_type();
		$data['branch'] 		= $this->m_quotation->get_branch();
		$data['item_all'] 		= $this->m_inv->get_list_item_all();
	    $this->template->set('title','Klinik | Master Item Price');
		$this->template->load('template','menu/mst_item_price', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function mst_item_price2(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_quotation');		
		$this->load->model('m_inv');		
		$data['id']				= $this->uri->segment(3);
		$data['id_notif']		= $this->uri->segment(4);
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['sv_group'] 		= $this->m_inv->get_list_ig();
		$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
		$data['pay_type'] 		= $this->m_quotation->get_type();
		$data['branch'] 		= $this->m_quotation->get_branch();
		$data['item_all'] 		= $this->m_inv->get_list_item_all();
		$data['cekisi'] 		= $this->m_inv->cekpriceitem1($data['id']);
		$jmlisi 				= $data['cekisi']->num_rows();

		// --- fungsi gabungkan dua array menjadi satu ---
		// function array_combine_($keys, $values){
		//     $result = array();
		//     foreach ($keys as $i => $k) {
		//         $result[$k][] = $values[$i];
		//     }
		//     array_walk($result, create_function('&$v', '$v = (count($v) == 1)? array_pop($v): $v;'));
		//     return    $result;
		// }
		
		// --- kumpulan array ---
		$data['price_type_arr']	= array();
		$data['price_arr'] 		= array();
		$data['id_price_arr'] 	= array();
		$data['jml_arr'] 		= 0;
		if ($jmlisi > 0) {
			// --- masukan data ke array ---
			foreach ($data['cekisi']->result() as $row) {
				$data['id_item']			= $row->id_item;
				$data['id_branch']			= $row->id_branch;
				$data['price_type_arr'][]	= $row->price_type;
				$data['Currency']			= $row->Currency;
				$data['price_arr'][]		= $row->Price;
				$data['id_price_arr'][]		= $row->id_price;
			}

			$data['jml_arr'] 		= count($data['price_type_arr']);
		}

	    $this->template->set('title','Klinik | Master Item Price');
		$this->template->load('template','menu/mst_item_price2', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }


 function save_mst_items_price3(){		

 	$session_data 			= $this->session->userdata('logged_in');		
 	$rowC					= $this->input->post('count_ant');			
	$user_id		 		= $session_data['id'];
	$jml 					= $this->input->post('jumlah');
	$id_notif 				= $this->input->post('id_notif');

	for($i=1; $i<=4; $i++){			
			$id_price 		= $this->input->post('id_price_'.$i.'');
		if ($id_price > 0) { // jika ada data maka update...
			$data_insert 	= array(
			'status' 		=> 0,
			'id_item' 		=> $this->input->post('id_item'), 
			'price_type' 	=> $this->input->post('type_'.$i.''), 
			'price' 		=> str_replace(",","",$this->input->post('price_'.$i.'')), 
			'currency' 		=> 'IDR', 
			'id_branch' 	=> $this->input->post('branch'), 
			'create_by' 	=> $user_id, 
			);
			$this->load->model('m_inv');
			$this->m_inv->update_mst_item_price($id_price,$data_insert);
		}else{ // jika belum ada maka insert
			$data_insert 	= array(
			'status' 		=> 0,
			'id_item' 		=> $this->input->post('id_item'), 
			'price_type' 	=> $this->input->post('type_'.$i.''), 
			'price' 		=> str_replace(",","",$this->input->post('price_'.$i.'')), 
			'currency' 		=> 'IDR', 
			'id_branch' 	=> $this->input->post('branch'), 
			'create_by' 	=> $user_id, 
			);
			$this->load->model('m_inv');
			$this->m_inv->save_master_price($data_insert);
		}
	}		

	// --- ubah status smart_notification -- 
	$data_update 	= array(
	'status' 		=> 0,
	);
	$this->load->model('m_smart');
	$this->m_smart->update_smart_sts($id_notif,$data_update);

	echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
 }
 

 //fungsi load Purchase Orde
 function purchase_order(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['jobs'];


		// Create Number PR...
		$this->load->model('m_master');			
		$number 				= $this->m_master->get_number_param('po_order');
		$data['tahun'] 			= date('Y');
		$data['bulan'] 			= date('m');
		
		foreach ($number->result() as $row3) {
			$data['id_sysp']		= $row3->id;
			$data['sgroup']			= $row3->sgroup;
			$data['skey']			= (int)$row3->skey+1;
			$data['svalue']			= (int)$row3->svalue;
			$data['lvalue']			= $row3->lvalue;
			$data['status']			= $row3->status;
			$data['created_time']	= $row3->created_time;
			$data['created_by']		= $row3->created_by;
			$data['updated_time']	= $row3->updated_time;
			$data['updated_by']		= $row3->updated_by;
			$data['remark']			= $row3->remark;
		}

        if ($data['svalue'] <> $data['bulan']) {$data['skey'] = 1;}
			
		$data['urutan'] 	= str_pad($data['skey'], 4, "0", STR_PAD_LEFT);
		// End Create Number PR...

	    $this->template->set('title','Klinik | Purchase Order');
		$this->template->load('template','menu/inv_po', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

/** BAGIAN RETURN ADA DI BAWAH INI **/

 // tambah return, add by rangga 18 Feb 2016
 function add_return($id_po){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		$data['depart'] 		= $this->m_inv->get_list_depart($id);	
	    $data['list'] 			= $this->m_inv->get_list_po_returnt($id_po);
		$data['data'] 			= $this->m_inv->get_list_sp();
	    $this->template->set('title','Klinik | Add Return');
		$this->template->load('template','menu/add_return', $data);		
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

   //fungsi simpan save return item
 function save_return(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$rowC					= $this->input->post('rowCount');
		$idd					= $this->input->post('id_po');
	

			$data_pack 						= array(
				'retur_no'					=>$this->input->post('no_receive'),
				'create_date'		 		=>date("Y-m-d H:i:s"),
				'po_id'						=>$this->input->post('id_po'),
				'user_id'					=>$user_id,
				'supplier_id'				=>$this->input->post('sup'),
				'return_remarks'			=>$this->input->post('comment'),
				'is_completed'				=>1,
			);
			
			$this->load->model('m_inv');
			$this->m_inv->save_return_header($data_pack);
			
			include './design/koneksi/file.php';
			$query 		="SELECT id_retur id FROM trx_item_return_h ORDER BY id_retur DESC LIMIT 1";  
			if($result 	=mysqli_query($con,$query))
			{
				//$date	=date('ym');
				$row 	=mysqli_fetch_assoc($result);
				$count 	=$row['id'];
			}
			//echo $rowC;
			//die();
			$rowxx						=mysqli_fetch_array($result);
			
		for($i=1; $i<=$rowC; $i++)
		{
			// Insert table  trx_item_return_d
			$sql = "INSERT INTO trx_item_return_d (id_return_h,item_id,item_qty,item_amount,return_date,uom,uom2) VALUES ('".$count."','".$this->input->post('item_id['.$i.']')."','".$this->input->post('qty['.$i.']')."','".$this->input->post('amount['.$i.']')."','".date("Y-m-d",strtotime($this->input->post('dates['.$i.']')))."','".$this->input->post('input['.$i.']')."','".$this->input->post('input_2['.$i.']')."')";			
			$this->db->query($sql);

			// Proses update mst_item, trx_item_receive_d dan insert table trx_transaction_move
			$item_idxx=$this->input->post('item_id['.$i.']');
			$amountxx=$this->input->post('amount['.$i.']');
			$amount_lamaxx=$this->input->post('amount_lama['.$i.']');
			$id_detail_rcv=$this->input->post('id_detail_rcv['.$i.']');
			$item_dest=$this->input->post('input_2['.$i.']');
			if ($amountxx == "") {$amountxx = 0; }
			if ($amount_lamaxx == "") {$amount_lamaxx = 0;}
			if ($amountxx == 0) {$item_dest=0;} // Jika tidak ada amount berarti tidka dikurang..

			$updateitem="UPDATE mst_item A LEFT JOIN trx_item_receive_d B ON B.item_id = A.id_item LEFT JOIN trx_item_receive_h C ON C.id_receive_h = B.id_receive LEFT JOIN trx_item_po_h D ON C.po_id = D.id_po  SET A.item_curr_qty = A.item_curr_qty - $amountxx WHERE A.id_item = '$item_idxx';";			
			$this->db->query($updateitem);
			// echo $updateitem."<br/>";

			$updatereceived123="UPDATE trx_item_receive_d SET item_dest=item_dest-$item_dest, item_amount=item_amount-$amountxx WHERE id_detail_rcv=$id_detail_rcv;    ";
			$this->db->query($updatereceived123);
			// echo $updatereceived123."<br/>";

			if ($amountxx > 0) {
				$data_input 					= array(
					'id_item'					=>$item_idxx,
					'trx_type'		 			=>'C',
					'amount'					=>$amountxx,
					'from'						=>1,
					'to'						=>0,
					'created_date'				=>date("Y-m-d H:i:s"),
					'user_id'					=>$user_id,
				);
				
				$this->load->model('m_inv');
				$this->m_inv->save_trx($data_input);
			}
		}
		// exit();
		//die();
		if($this->input->post('complete')==1){
			$datas 						= array(
				'is_completed'				=>4,
			);
			$this->m_inv->update_status_received($idd,$datas);
			echo "1";
			//die();
		}
		
		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
		//redirect('inv/purchase_order/ok');
 }

  //fungsi load List Received Items
 function return_items(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		$data['depart'] 		= $this->m_inv->get_list_depart($id);
		$data['list'] 			= $this->m_inv->get_list_returnt($id);		
	    $this->template->set('title','Klinik | Received Items');
		$this->template->load('template','menu/return_items', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi load Purchase Order, add by rangga 18 Feb 2016
 function update_return($id_po){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		$data['depart'] 		= $this->m_inv->get_list_depart($id);	
	    $data['list'] 			= $this->m_inv->get_list_po_returnt_update($id_po);
		$data['data'] 			= $this->m_inv->get_list_sp();
	    $this->template->set('title','Klinik | Update Return');
		$this->template->load('template','menu/update_return', $data);		
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi simpan update return item, add by rangga 18 Feb 2016
 function save_update_return(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$rowC					= $this->input->post('rowCount');
		$idd					= $this->input->post('id_retur');
	
		if($this->input->post('complete')==1){

			$data_pack 						= array(
				'retur_no'					=>$this->input->post('no_receive'),
				'create_date'		 		=>date("Y-m-d H:i:s"),
				'po_id'						=>$this->input->post('id_po'),
				'user_id'					=>$user_id,
				'supplier_id'				=>$this->input->post('sup'),
				'return_remarks'			=>$this->input->post('comment'),
				'is_completed'				=>4,
			);

		} else {

			$data_pack 						= array(				
				'update_date'		 		=>date("Y-m-d H:i:s"),
				'update_user'				=>$user_id,
				'return_remarks'			=>$this->input->post('comment'),
			);

		}
			
			$this->load->model('m_inv');
			$this->m_inv->update_return($idd,$data_pack);
			
			include './design/koneksi/file.php';
			$query 		="SELECT id_retur id FROM trx_item_return_h ORDER BY id_retur DESC LIMIT 1";  
			if($result 	=mysqli_query($con,$query))
			{
				$row 	=mysqli_fetch_assoc($result);
				$count 	=$row['id'];
			}
			
			
		for($i=1; $i<=$rowC; $i++)
		{
			$item_idxx=$this->input->post('item_id['.$i.']');
			$amountxx=$this->input->post('amount['.$i.']');
			$amount_lamaxx=$this->input->post('amount_lama['.$i.']');
			$id_detail_rcv=$this->input->post('id_detail_rcv['.$i.']');
			$item_dest=$this->input->post('input_2['.$i.']');
			if ($amountxx == "") {$amountxx = 0; }
			if ($amount_lamaxx == "") {$amount_lamaxx = 0;}
			if ($amountxx == 0) {$item_dest=0;} // Jika tidak ada amount berarti tidka dikurang..

			$updateitem="UPDATE mst_item A LEFT JOIN trx_item_receive_d B ON B.item_id = A.id_item LEFT JOIN trx_item_receive_h C ON C.id_receive_h = B.id_receive LEFT JOIN trx_item_po_h D ON C.po_id = D.id_po  SET A.item_curr_qty = A.item_curr_qty - $amountxx WHERE A.id_item = '$item_idxx';";			
			$this->db->query($updateitem);
			// echo $updateitem."<br/>";

			$updatereceived123="UPDATE trx_item_receive_d SET item_dest=item_dest-$item_dest, item_amount=item_amount-$amountxx WHERE id_detail_rcv=$id_detail_rcv;    ";
			$this->db->query($updatereceived123);
			// echo $updatereceived123."<br/>";



			if ($amountxx > 0) {

				$sql = "UPDATE trx_item_return_d SET item_id='".$this->input->post('item_id['.$i.']')."',item_qty='".$this->input->post('qty['.$i.']')."',item_amount='".$this->input->post('amount['.$i.']')."',return_date='".date("Y-m-d",strtotime($this->input->post('dates['.$i.']')))."',uom='".$this->input->post('input['.$i.']')."',uom2='".$this->input->post('input_2['.$i.']')."' WHERE id_return_d='".$this->input->post('id_return_d['.$i.']')."';";	
				// echo $sql; 		
				$this->db->query($sql);

				$data_input 					= array(
					'id_item'					=>$item_idxx,
					'trx_type'		 			=>'C',
					'amount'					=>$amountxx,
					'from'						=>1,
					'to'						=>0,
					'created_date'				=>date("Y-m-d H:i:s"),
					'user_id'					=>$user_id,
				);
				
				$this->load->model('m_inv');
				$this->m_inv->save_trx($data_input);
			}
		}
		// exit();
		
		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
		//redirect('inv/purchase_order/ok');
 }




/** BATAS RETURN  **/  

 	
 function mst_expense(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_quotation');
		$this->load->model('m_registration');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $this->template->set('title','Klinik | Master Services Package');
		$this->template->load('template','menu/mst_expense', $data);
	} else {
     //If no session, redirect to login page
     redirect('login', 'refresh');
	}	
 }

 function list_expense(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		$data['list'] 			= $this->m_inv->get_list_trx_item_po_h();
	    $this->template->set('title','Klinik | Expense List');
		$this->template->load('template','menu/list_expense', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function list_detail_expense(){
    if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_inv');		
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['data'] 			= $this->m_inv->get_expense_header($id);
	  $data['main'] 			= $this->m_inv->get_expense_main($id);	  
	  $this->load->view('menu/list_detail_expense', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi simpan save purchase order
 function save_po(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$rowC					= $this->input->post('rowcount');
		$now					= date("Y-m-d H:i:s");
		$tgl					= date("Y-m-d");
	
			if ($rowC==0){
				$rowC="1";
			}else{
				$rowC=$rowC;
			}

			$data_pack 						= array(
				'po_no'						=>$this->input->post('no'),
				'po_date'			 		=>date("Y-m-d",strtotime($this->input->post('date_delivery'))),
				'supplier_id'				=>$this->input->post('name_supplier'),
				'address_id'				=>$this->input->post('id_address'),
				'delivery_date'				=>date("Y-m-d",strtotime($this->input->post('date_delivery'))),
				'user_id'					=>$user_id,
				'total_amount'				=>str_replace(",","",$this->input->post('amount_total')),
				'ppn_amount'				=>str_replace(",","",$this->input->post('amount_ppn')),
				'grand_amount'				=>str_replace(",","",$this->input->post('amount_grand')),
				'is_completed'				=>1,
				'term_payment'				=>$this->input->post('term'),
				'created_date'				=>$now,
			);
			$this->load->model('m_inv');
			$this->m_inv->save_po_header($data_pack);
			
			$max_trx_item_po_h 				= $this->m_inv->get_max_trx_item_po_h();
			foreach ($max_trx_item_po_h->result() as $row) { $count = $row->id_po; }

		for($i=1; $i<=$rowC; $i++){

			// Insert table detail po
			$data_pack 						= array(
				'id_po_header' 				=>$count,
				'id_pr_header' 				=>$this->input->post('id_pr['.$i.']'),
				'item_id' 					=>$this->input->post('item['.$i.']'),
				'item_qty' 					=>$this->input->post('qty['.$i.']'),
				'item_uom' 					=>$this->input->post('qty['.$i.']'),
				'item_price'				=>str_replace(",","",$this->input->post('unit['.$i.']')),
				'item_disc_am'				=>str_replace(",","",$this->input->post('disc_2['.$i.']')),
				'item_disc' 				=>$this->input->post('disc['.$i.']'),
				'item_amount' 				=>$this->input->post('total2['.$i.']'),
			);
			$this->load->model('m_inv');
			$this->m_inv->save_po_detail($data_pack);

		}

		redirect('inv/mst_expense/ok');
 }

 //fungsi untuk delete purchase request
 function del_pr(){
		if($this->session->userdata('logged_in')){
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
		    $username				= $session_data['username'];
			$now					= date("Y-m-d H:i:s");
			$tanggal				= date("m/d/Y");
			$id 					= $this->uri->segment(3);
			
			//Update status Cancel..
			$data_process 		= array(
	            'is_finalized'  =>4,
	        );
	        $this->load->model('m_inv');
	        $this->m_inv->update_trx_item_pr_h($id,$data_process);
			//Endless Update
			
			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
		    $now					= date("Y-m-d H:i:s");
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'	=>$user_id,
						'log_date'	=>$now,
						'log_desc' 	=>"Delete Purchase Request, id : ".$id."",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log

			redirect('/inv/list_pr/del');

		} else {
	     //If no session, redirect to login page
	     redirect('login', 'refresh');
		}	

	 
 } 
 
  //fungsi untuk delete purchase order
 function del_po(){
	 $id = $this->uri->segment(3);
	 $this->load->model('m_inv');
	 	 $data_app 	= array(
			'is_completed'			=>5,
			);
	 $this->m_inv->del_po($id,$data_app);
	 // kembalikan ke halaman user
	 redirect('/inv/list_po/ok');
 } 
 
 //fungsi untuk delete purchase order
 function del_price_item(){
	 $this->load->model('m_inv');
	 $id 		= $this->uri->segment(3);
 	 $data_app 	= array('status' => 3,);
	 $this->m_inv->del_price_item($id,$data_app);
	 redirect('/inv/list_update_item/del');
 } 
 
 //fungsi untuk delete purchase order
 function app_price_item(){
	 $this->load->model('m_inv');
	 $id 		= $this->uri->segment(3);
 	 $data_app 	= array('status' => 1,);
	 $this->m_inv->del_price_item($id,$data_app);
	 redirect('/inv/list_update_item/ok');
 } 
 
  //fungsi untuk delete Delivery Address, Add by rangga 23 Feb 2016
  function delete_DeliveryAddress(){
	 $id = $this->uri->segment(3);
	 $this->load->model('m_inv');
	 	 $data_app 	= array(
				'status'			=>1,
			);
	 $this->m_inv->delete_DeliveryAddress($id,$data_app);
	 // kembalikan ke halaman user
	 redirect('/inv/inv_delivery/del');
 } 

 function delete_item(){

	$id_item				= $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	

	// Update status
	$data_delete			= array(
	'is_active'				=>1,		
	);
	$this->load->model('m_inv');
	$this->m_inv->delete_item($id_item,$data_delete);
	// End Update 

	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log 				= array(
	'id_user'				=>$user_id,
	'log_date'				=>date("Y-m-d H:i:s"),
	'log_desc' 				=>"Delete Item, id : ".$id_item." , Delete By ". $user_id,
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log


	redirect('inv/inv_item/del');
 }

 //fungsi untuk delete Supplier, Add by rangga 23 Feb 2016
  function delete_Supplier(){
	 $id = $this->uri->segment(3);
	 $this->load->model('m_inv');
	 	 $data_app 	= array(
				'status'			=>1,
			);
	 $this->m_inv->delete_Supplier($id,$data_app);
	 // kembalikan ke halaman user
	 redirect('/inv/inv_supplier/del');
 } 
 //fungsi untuk delete Warehouse, Add by rangga 23 Feb 2016
  function delete_Warehouse(){
	 $id = $this->uri->segment(3);
	 $this->load->model('m_inv');
	 	 $data_app 	= array(
				'status'			=>1,
			);
	 $this->m_inv->delete_Warehouse($id,$data_app);


				//Create Log Start
				$session_data 			= $this->session->userdata('logged_in');
			    $now					= date("Y-m-d H:i:s");
				$user_id				= $session_data['id'];	
				$data_log = array(
							'id_user'	=>$user_id,
							'log_date'	=>$now,
							'log_desc' 	=>"Delete Warehouse, ID Warehouse : ".$id."",
				);
				$this->load->model('m_login');
				$this->m_login->log($data_log);
				//Endless Log

	 // kembalikan ke halaman user
	 redirect('/inv/inv_warehouse/del');
 } 
 //fungsi untuk archive po, add by rangga 18 Feb 2016
 function update_arc(){
	 $id = $this->uri->segment(3);
	 $this->load->model('m_inv');
	 	 $data_app 	= array(
				'archive'			=>1,
			);
	 $this->m_inv->update_arc($id,$data_app);
	 // kembalikan ke halaman user
	 redirect('/inv/received_items/arc');
 } 

 function update_arc_rt(){
	 $id = $this->uri->segment(3);
	 $this->load->model('m_inv');
	 	 $data_app 	= array(
				'archive'			=>1,
			);
	 $this->m_inv->update_arc_rt($id,$data_app);
	 // kembalikan ke halaman user
	 redirect('/inv/return_items/ok');
 } 
 
 //fungsi load print purchase order
 function print_po(){
    if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_inv');		
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['data'] 			= $this->m_inv->get_po_header($id);
	  $data['main'] 			= $this->m_inv->get_po_main($id);
	  $data['grand'] 			= $this->m_inv->get_po_grand($id);
	  $data['footer'] 			= $this->m_inv->get_po_footer($id);
	  $this->load->view('menu/print_po', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //fungsi load List Purchase Request Approval
 function listpr_app(){
	$session_data 			= $this->session->userdata('logged_in');
	$data['username'] 		= $session_data['username'];
	$id				 		= $session_data['jobs'];
	$level					= $session_data['userlevel'];
		
    if($this->session->userdata('logged_in') && $level=="master" || $level=="supervisor"){	
		$this->load->model('m_inv');			
		$data['list'] 		= $this->m_inv->get_list_app_pr($id);
	    $this->template->set('title','Klinik | Purchase Request Approval');
		$this->template->load('template','menu/inv_pr_app', $data);
	} else {				
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function listpr_app_all(){
	$session_data 			= $this->session->userdata('logged_in');
	$data['username'] 		= $session_data['username'];
	$id				 		= $session_data['jobs'];
	$level					= $session_data['userlevel'];
		
    if($this->session->userdata('logged_in') && $level=="master"){	
		$this->load->model('m_inv');			
		$data['list'] 		= $this->m_inv->get_list_app_pr_all();
	    $this->template->set('title','Klinik | Purchase Request Approval');
		$this->template->load('template','menu/listpr_app_all', $data);
	} else {				
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function listpr_pur(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
		$data['username'] 		= $session_data['username'];
		$data['jobs']	 		= $session_data['jobs'];
		$data['userlevel']		= $session_data['userlevel'];
		$data['list'] 			= $this->m_inv->get_list_pr_pur();
	    $this->template->set('title','Klinik | Purchase Request Approval');
		$this->template->load('template','menu/listpr_pur', $data);
	} else {				
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi load List Purchase Order Approval
 function listpo_app(){
	$session_data 			= $this->session->userdata('logged_in');
	$data['username'] 		= $session_data['username'];
	$id				 		= $session_data['jobs'];
	$level					= $session_data['userlevel'];
		
    if($this->session->userdata('logged_in') && $level=="master" || $level=="supervisor"){	
		$this->load->model('m_inv');			
		$data['list'] 		= $this->m_inv->get_list_app_po($id);
	    $this->template->set('title','Klinik | Purchase Order Approval');
		$this->template->load('template','menu/inv_po_app', $data);
	} else {				
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 
 //fungsi untuk approve PR
 function app_pr(){
    if($this->session->userdata('logged_in')){	
		
		$this->load->model('m_inv');
		$session_data 			= $this->session->userdata('logged_in');
		$id_user 				= $session_data['id'];
		$id 					= $this->uri->segment(3);
		$all 					= $this->uri->segment(4);

		// Update status header
		$data_app 				= array(
		'is_finalized'		  	=>0,
		'user_app'		 	 	=>$id_user,
		);
		$this->m_inv->app_pr($id,$data_app);

				// Update status Detail
				$data_app 				= array(
				'is_status'				=>0,
				);
				$this->m_inv->update_detail_pr($id,$data_app);

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$data_log = array(
					'id_user'	=>$user_id,
					'log_date'	=>date("Y-m-d H:i:s"),
					'log_desc' 	=>"Approve Purchase Request, ID  : ".$id,
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);				

	
		if ($all == "all") {
			redirect('/inv/listpr_app_all/app');
		}else{
			redirect('/inv/listpr_app/app');
		}


	} else {				
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }


 //fungsi untuk Decline PR
 function decl_pr(){
	 $session_data 			= $this->session->userdata('logged_in');
	 $id_user 				= $session_data['id'];
	 $id 					= $this->uri->segment(3);
	 
	 //echo $id;
	 //die();
	 $this->load->model('m_inv');
	 $data_app 						= array(
				'is_finalized'			=>2,
				'user_app'			 	=>$id_user,
			);
	 $this->m_inv->app_pr($id,$data_app);
	 //echo $id;
	 //die();
	 redirect('/inv/listpr_app/app');
 } 

 //fungsi load List Purchase Order
 function list_po(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $data['userlvl'] 		= $session_data['userlevel'];
		$id				 		= $session_data['id'];
		$data['depart'] 		= $this->m_inv->get_list_depart($id);
		$data['list'] 			= $this->m_inv->get_list_po($id);
	    $this->template->set('title','Klinik | Purchase Order List');
		$this->template->load('template','menu/list_po', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

  //fungsi untuk approve PO
 function app_po(){
 	if($this->session->userdata('logged_in')){	
 	 $session_data 			= $this->session->userdata('logged_in');
	 $id_user 				= $session_data['id'];
	 $id 					= $this->uri->segment(3);
	 
	 // Update Status Approve
	 $this->load->model('m_inv');
	 $data_app 						= array(
				'is_completed'			=>0,
				'app_id'			 	=>$id_user,
			);
	 $this->m_inv->app_po($id,$data_app);
	 
			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d H:i:s"),
						'log_desc' 						=>"Approve Purchase Order, ID  : ".$id,
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);

	 redirect('/inv/listpo_app/app');
		
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 } 
 //fungsi untuk Decline PO
 function decl_po(){
	 $session_data 			= $this->session->userdata('logged_in');
	 $id_user 				= $session_data['id'];
	 $id 					= $this->uri->segment(3);
	 
	 //echo $id;
	 //die();
	 $this->load->model('m_inv');
	 $data_app 						= array(
				'is_completed'			=>2,
				'app_id'			 	=>$id_user,
			);
	 $this->m_inv->app_po($id,$data_app);
	 //echo $id;
	 //die();
	 redirect('/inv/listpo_app/app');
 } 
 
 //fungsi load List Received Items
 function received_items(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		$data['depart'] 		= $this->m_inv->get_list_depart($id);
		$data['list'] 			= $this->m_inv->get_list_received($id);
	    $this->template->set('title','Klinik | Received Items');
		$this->template->load('template','menu/received_items', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 
 
  //fungsi Input Check List Received Items
 function check_received(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id 					= $this->uri->segment(3);
		$data['depart'] 		= $this->m_inv->get_list_depart($id);
		$data['detail'] 		= $this->m_inv->get_list_received_detail($id);
		$data['header'] 		= $this->m_inv->get_list_po_header($id);
	    $this->template->set('title','Klinik | Received Items');
		$this->template->load('template','menu/check_received', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 
   //fungsi Input Update Received Items
 function update_received(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id 					= $this->uri->segment(3);
		$data['depart'] 		= $this->m_inv->get_list_depart($id);
		$data['detail'] 		= $this->m_inv->get_list_received_update($id);
		$data['pjv'] 			= $this->m_inv->get_pjv($id);
		$data['header'] 		= $this->m_inv->get_list_po_header($id);
	    $this->template->set('title','Klinik | Update Received Items');
		$this->template->load('template','menu/update_received', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi simpan save received item
 function save_received(){
		
		$this->load->model('m_inv');

		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$rowC					= $this->input->post('rowCount');
		$idd					= $this->input->post('id_po');
		$sumtothrg				= $this->input->post('sumtothrg');
		$supp_name				= $this->input->post('supp_name');
		$count 					= $this->m_inv->count_transmission();
		
		foreach ($count->result() as $row) {
			$kode				= "IP/".date('m')."/".date('Y')."/".$row->xyz;
		}
		
		$data_pack 				= array(
			'receive_no'		=>$this->input->post('no_receive'),
			'receive_date'		=>date("Y-m-d H:i:s"),
			'po_id'				=>$this->input->post('id_po'),
			'po_date'			=>date("Y-m-d",strtotime($this->input->post('po_date'))),
			'is_partial'		=>$this->input->post('complete'),
			'user_id'			=>$user_id,
			'supplier_id'		=>$this->input->post('sup'),
		);
		$this->m_inv->save_received_header($data_pack);

		include './design/koneksi/file.php';
		$count 		= 0;
		$query 		= "SELECT id_receive_h id FROM trx_item_receive_h ORDER BY id_receive_h DESC LIMIT 1";  
		if($result 	= mysqli_query($con,$query))
		{
			$row 	=mysqli_fetch_assoc($result);
			$count 	=$row['id'];
		}


		$insert_retur 						= array(
			'id_receive_h'					=> $count,
			'po_id'							=> $this->input->post('id_po'),
			'retur_no'						=> $this->input->post('no_receive'),
			'supp_name'						=> $supp_name,
			'amount'						=> $sumtothrg,
			'create_by'						=> $user_id,
			'term'							=> $this->input->post('term'),
			'invoice_no'					=> $kode,
		);
		$this->m_inv->save_trx_exchanges_inv_h($insert_retur);

		$query2 		= "SELECT id_retur_h id FROM trx_exchanges_inv_h ORDER BY id_retur_h DESC LIMIT 1";  
		if($result2 	= mysqli_query($con,$query2)){
			$row2 		= mysqli_fetch_assoc($result2);
			$count2 	= $row2['id'];
		}
			
		for($i=1; $i<=$rowC; $i++){

			$receive_fisik 			= str_replace("","0",$this->input->post('a['.$i.']'));
			$receive_expired 		= str_replace("","0",$this->input->post('b['.$i.']'));
			$receive_dosis 			= str_replace("","0",$this->input->post('c['.$i.']'));
			$receive_suhu 			= str_replace("","0",$this->input->post('d['.$i.']'));

			$data_insert 			= array(
				'id_receive' 		=> $count, 
				'item_id'			=> $this->input->post('item_id['.$i.']'), 
				'item_qty' 			=> $this->input->post('qty['.$i.']'), 
				'item_source' 		=> $this->input->post('input['.$i.']'), 
				'item_dest'			=> $this->input->post('input_2['.$i.']'), 
				'item_amount' 		=> $this->input->post('amount['.$i.']'), 
				'uom' 				=> $this->input->post('id_base_dest['.$i.']'), 
				'receive_fisik' 	=> $receive_fisik, 
				'receive_expired' 	=> $receive_expired, 
				'receive_dosis' 	=> $receive_dosis, 
				'receive_suhu' 		=> $receive_suhu, 
				'batch_code' 		=> $this->input->post('batch_code['.$i.']'), 
				'batch_date' 		=> $this->input->post('batch_date['.$i.']'), 
				'expired_date' 		=> $this->input->post('expired_date['.$i.']'), 
			);
			$this->m_inv->save_detail_receive($data_insert);

			// $sql = "INSERT INTO trx_item_receive_d (id_receive, item_id, item_qty, item_source, item_dest, item_amount, uom, receive_fisik, receive_expired, receive_dosis, receive_suhu, batch_code, batch_date, expired_date) VALUES ('".$count."', '".$this->input->post('item_id['.$i.']')."', '".$this->input->post('qty['.$i.']')."', '".$this->input->post('input['.$i.']')."', '".$this->input->post('input_2['.$i.']')."', '".$this->input->post('amount['.$i.']')."', '".$this->input->post('id_base_dest['.$i.']')."', '".str_replace("","0",$this->input->post('a['.$i.']'))."', '".str_replace("","0",$this->input->post('b['.$i.']'))."', '".str_replace("","0",$this->input->post('c['.$i.']'))."','".str_replace("","0",$this->input->post('d['.$i.']'))."', '".$this->input->post('batch_code['.$i.']')."','".$this->input->post('batch_date['.$i.']')."','".$this->input->post('expired_date['.$i.']')."')";
			// $this->db->query($sql);

			$item_idxx 				= $this->input->post('item_id['.$i.']');
			$amountxx 				= $this->input->post('amount['.$i.']');
			$amount_lamaxx 			= $this->input->post('amount_lama['.$i.']');

			if ($amountxx == "") 		{$amountxx = 0;}
			if ($amount_lamaxx == "") 	{$amount_lamaxx = 0;}

			$updateitem="UPDATE mst_item A LEFT JOIN trx_item_receive_d B ON B.item_id = A.id_item LEFT JOIN trx_item_receive_h C ON C.id_receive_h = B.id_receive LEFT JOIN trx_item_po_h D ON C.po_id = D.id_po  SET A.item_curr_qty = A.item_curr_qty + $amountxx WHERE A.id_item = '$item_idxx';";			
			$this->db->query($updateitem);

			if ($amountxx > 0) { //Memproses data yang ada harganya..
				$data_input 					= array(
					'id_item'					=>$item_idxx,
					'trx_type'		 			=>'D',
					'amount'					=>$amountxx,
					'from'						=>0,
					'to'						=>1,
					'created_date'				=>date("Y-m-d H:i:s"),
					'user_id'					=>$user_id,
				);
				$this->m_inv->save_trx($data_input);

				$data_insert 					= array(
					'id_retur_h' 				=> $count2, 
					'id_item' 					=> $this->input->post('item_id['.$i.']'), 
					'item_price' 				=> $this->input->post('item_price['.$i.']'), 
					'disc' 						=> $this->input->post('item_disc['.$i.']'), 
					'qty' 						=> $this->input->post('input_2['.$i.']'), 
					'item_amount' 				=> $this->input->post('totalhrg['.$i.']'), 
					'create_by' 				=> $user_id, 
				);
				$this->m_inv->save_detail_exchanges_inv($data_insert);

				//Proses Update harga..
				$id_item 			= $this->input->post('item_id['.$i.']');
				$harga 				= $this->input->post('item_price['.$i.']');

				// Untuk proses harga base..
				$cekharga1 			= $this->m_inv->cekpriceitem($id_item,1);
				$cekharga2 			= $this->m_inv->cekpriceitem_temp($id_item,1);
				$jml 				= $cekharga2->num_rows();

				foreach ($cekharga1->result() as $row) {
					$harga_awal = $row->Price;
				}

				if ($jml == 0) { //Jika tidak ada maka akan di insert..

					$data_insert 		= array(
						'id_item' 		=> $id_item, 
						'price_type' 	=> 1, 
						'price' 		=> $harga, 
						'currency' 		=> 'IDR', 
						'updated_by' 	=> $user_id, 
					);
					$this->m_inv->save_master_price_temp($data_insert);

				}else{ //Jika id item sudah pernah ada, maka data akan di update..

					if ($harga > $harga_awal ) { // Jika harga yang ada di PO lebih besar maka update harga..
						
						$data_update 		= array(
							'status' 		=> 0,
							'Price' 		=> $harga, 
							'updated_by'	=> $user_id,
						);
					$this->m_inv->update_hrg_temp($id_item,1,$data_update);

					//Create Log Start
					$session_data 			= $this->session->userdata('logged_in');
					$user_id				= $session_data['id'];	
					$data_log = array(
						'id_user'			=> $user_id,
						'log_date'			=> date("Y-m-d H:i:s"),
						'log_desc' 			=> "Update Item Price ".$item_name." and id item ".$id_item." Price from : ".$harga_awal." To : ".$harga,
					);
					$this->load->model('m_login');
					$this->m_login->log($data_log);
					//Endless Log

					} // Batas if update harga..
				} // Batas Else..
				// Batas proses harga base..

				// Proses harga selain base..
				$list_type_range	= $this->m_inv->get_list_type_range($harga);
				foreach ($list_type_range->result() as $rowxx) {
					$jenis			= $rowxx->range_type;
					$persen			= $rowxx->percent;
					$hrpersen		= $harga * ($persen/100);
					$total 			= $harga + $hrpersen;
					$cekharga3		= $this->m_inv->cekpriceitem($id_item,$jenis);
					$cekharga4		= $this->m_inv->cekpriceitem_temp($id_item,$jenis);
					$jml			= $cekharga4->num_rows();

					foreach ($cekharga3->result() as $row) {
						$harga_awal  = $row->Price;
					}

					if ($jml==0) { //Jika tidak ada maka akan di insert..

						$data_insert 		= array(
							'id_item' 		=> $id_item, 
							'price_type' 	=> $jenis, 
							'price' 		=> $total, 
							'currency' 		=> 'IDR', 
							'updated_by' 	=> $user_id, 
						);
						$this->m_inv->save_master_price_temp($data_insert);

					}else{ //Jika id item sudah pernah ada, maka data akan di update..

						if ($total > $harga_awal ) { // Jika harga yang ada di PO lebih besar maka update harga..
							
							$data_update 		= array(
								'status' 		=> 0,
								'Price' 		=> $total, 
								'updated_by'	=> $user_id,
							);
							$this->m_inv->update_hrg_temp($id_item,$jenis,$data_update);

						} // Batas if update harga
					} // Batas Else

					// echo $jenis." ) ". $harga." * ".$persen." / 100 = ".$hrpersen." <br> ";
					// echo $jenis." ) ". $harga." + ".$hrpersen." = ".$total." <br> ";


				}// Batas Foreach..

			}// Bata Proses data yang ada harganya..
		}//Batas Looping..

		$habis = $this->input->post('habis');

		if($habis=="on"){
			$datas 	= array('is_completed' =>4,);
			$this->m_inv->update_status_received($idd,$datas);
		}else{
			$datas 	= array('is_completed' =>3,);
			$this->m_inv->update_status_received($idd,$datas);
		}

		$this->m_inv->sys_transfer_item(); // syscrone tabel trx_item_wh pada table mst_item
		
		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
		//redirect('inv/purchase_order/ok');
 }

 //fungsi simpan update received item
 function save_update_received(){

		$this->load->model('m_inv');

		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$rowC					= $this->input->post('rowCount');
		$idd					= $this->input->post('id_po');
		$id_receive_h			= $this->input->post('id_receive_h');
		$rowC					= $this->input->post('rowCount');
		$sumtothrg				= $this->input->post('sumtothrg');
		$supp_name				= $this->input->post('supp_name');
		$count 					= $this->m_inv->count_transmission();

		foreach ($count->result() as $row) {
			$kode				= "IP/".date('m')."/".date('Y')."/".$row->xyz;
		}
		
		$insert_retur 						= array(
			'id_receive_h'					=> $id_receive_h,
			'po_id'							=> $this->input->post('id_po'),
			'retur_no'						=> $this->input->post('no_receive'),
			'supp_name'						=> $supp_name,
			'amount'						=> $sumtothrg,
			'create_by'						=> $user_id,
			'term'							=> $this->input->post('term'),
			'invoice_no'					=>$kode,
		);
		$this->m_inv->save_trx_exchanges_inv_h($insert_retur);
		
		include './design/koneksi/file.php';
		$query2 		= "SELECT id_retur_h id FROM trx_exchanges_inv_h ORDER BY id_retur_h DESC LIMIT 1";  
		if($result2 	= mysqli_query($con,$query2)){
			$row2 		= mysqli_fetch_assoc($result2);
			$count2 	= $row2['id'];
		}
			
		for($i=1; $i<=$rowC; $i++)
		{

			$item_idxx=$this->input->post('item_id['.$i.']');
			$amountxx=$this->input->post('amount['.$i.']');
			$amount_lamaxx=$this->input->post('amount_lama['.$i.']');
			if ($amountxx == "") {$amountxx = 0;}
			if ($amount_lamaxx == "") {$amount_lamaxx = 0;}

			$sql = "UPDATE trx_item_receive_d set batch_code='".$this->input->post('batch_code['.$i.']')."',batch_date='".$this->input->post('batch_date['.$i.']')."',expired_date='".$this->input->post('expired_date['.$i.']')."',receive_fisik='".$this->input->post('a['.$i.']')."',receive_expired='".$this->input->post('b['.$i.']')."',receive_dosis='".$this->input->post('c['.$i.']')."',receive_suhu='".$this->input->post('d['.$i.']')."',item_dest=item_dest+'".$this->input->post('input_2['.$i.']')."',item_source='".$this->input->post('input['.$i.']')."',item_amount=item_amount+'".$this->input->post('amount['.$i.']')."' where id_detail_rcv='".$this->input->post('id_detail_rcv['.$i.']')."' ";		
			$this->db->query($sql);

			$updateitem="UPDATE mst_item A INNER JOIN trx_item_receive_d B ON B.item_id = A.id_item INNER JOIN trx_item_receive_h C ON C.id_receive_h = B.id_receive INNER JOIN trx_item_po_h D ON C.po_id = D.id_po  SET A.item_curr_qty = A.item_curr_qty + $amountxx WHERE A.id_item = '$item_idxx';";			
			$this->db->query($updateitem);


			if ($amountxx > 0) {
				$data_input 					= array(
					'id_item'					=>$item_idxx,
					'trx_type'		 			=>'D',
					'amount'					=>$amountxx,
					'from'						=>0,
					'to'						=>1,
					'created_date'				=>date("Y-m-d H:i:s"),
					'user_id'					=>$user_id,
				);
				
				$this->load->model('m_inv');
				$this->m_inv->save_trx($data_input);	

				$data_insert 					= array(
					'id_retur_h' 				=> $count2, 
					'id_item' 					=> $this->input->post('item_id['.$i.']'), 
					'item_price' 				=> $this->input->post('item_price['.$i.']'), 
					'disc' 						=> $this->input->post('item_disc['.$i.']'), 
					'qty' 						=> $this->input->post('input_2['.$i.']'), 
					'item_amount' 				=> $this->input->post('totalhrg['.$i.']'), 
					'create_by' 				=> $user_id, 
				);
				$this->m_inv->save_detail_exchanges_inv($data_insert);

				// $insert_sql = "INSERT INTO trx_exchanges_inv_d (id_retur_h,id_item,item_price,disc,qty,item_amount,create_by) VALUES ('".$count2."','".$this->input->post('item_id['.$i.']')."','".$this->input->post('item_price['.$i.']')."','".$this->input->post('item_disc['.$i.']')."','".$this->input->post('input_2['.$i.']')."','".$this->input->post('totalhrg['.$i.']')."','".$user_id."')";
				// $this->db->query($insert_sql);


				//Proses Update harga..
				$id_item 		= $this->input->post('item_id['.$i.']');
				$harga 			= $this->input->post('item_price['.$i.']');
				
				// Untuk proses harga base..
				$cekharga1 			= $this->m_inv->cekpriceitem($id_item,1);
				$cekharga2 			= $this->m_inv->cekpriceitem_temp($id_item,1);
				$jml 				= $cekharga2->num_rows();

				foreach ($cekharga1->result() as $row) {
					$harga_awal = $row->Price;
				}

				if ($jml == 0) { //Jika tidak ada maka akan di insert..

					$data_insert 		= array(
						'id_item' 		=> $id_item, 
						'price_type' 	=> 1, 
						'price' 		=> $harga, 
						'currency' 		=> 'IDR', 
						'updated_by' 	=> $user_id, 
					);
					$this->m_inv->save_master_price_temp($data_insert);

				}else{ //Jika id item sudah pernah ada, maka data akan di update..

					if ($harga > $harga_awal ) { // Jika harga yang ada di PO lebih besar maka update harga..
						
						$data_update 		= array(
							'status' 		=> 0,
							'Price' 		=> $harga, 
							'updated_by'	=> $user_id,
						);
						$this->m_inv->update_hrg_temp($id_item,1,$data_update);

					} // Batas if update harga..
				} // Batas Else..
				// Batas proses harga base..

				// Proses harga selain base..
				$list_type_range	= $this->m_inv->get_list_type_range($harga);
				foreach ($list_type_range->result() as $rowxx) {
					$jenis			= $rowxx->range_type;
					$persen			= $rowxx->percent;
					$hrpersen		= $harga * ($persen/100);
					$total 			= $harga + $hrpersen;
					$cekharga3		= $this->m_inv->cekpriceitem($id_item,$jenis);
					$cekharga4		= $this->m_inv->cekpriceitem_temp($id_item,$jenis);
					$jml			= $cekharga4->num_rows();

					foreach ($cekharga3->result() as $row) {
						$harga_awal  = $row->Price;
					}

					if ($jml==0) { //Jika tidak ada maka akan di insert..

						$data_insert 		= array(
							'id_item' 		=> $id_item, 
							'price_type' 	=> $jenis, 
							'price' 		=> $total, 
							'currency' 		=> 'IDR', 
							'updated_by' 	=> $user_id, 
						);
						$this->m_inv->save_master_price_temp($data_insert);

					}else{ //Jika id item sudah pernah ada, maka data akan di update..

						if ($total > $harga_awal ) { // Jika harga yang ada di PO lebih besar maka update harga..
							
							$data_update 		= array(
								'status' 		=> 0,
								'Price' 		=> $total, 
								'updated_by'	=> $user_id,
							);
							$this->m_inv->update_hrg_temp($id_item,$jenis,$data_update);

						} // Batas if update harga
					} // Batas Else

					// echo $jenis." ) ". $harga." * ".$persen." / 100 = ".$hrpersen." <br> ";
					// echo $jenis." ) ". $harga." + ".$hrpersen." = ".$total." <br> ";


				}// Batas Foreach..

			}// Bata Proses data yang ada harganya..
		}//Batas Looping..

		$habis = $this->input->post('habis');

		if($habis=="on"){
			$datas 	= array('is_completed' =>4,);
			$this->m_inv->update_status_received($idd,$datas);
			$this->m_inv->received_update_mst_item();
		}else{
			$datas 	= array('is_completed' =>3,);
			$this->m_inv->update_status_received($idd,$datas);
		}

		$datap 	= array('is_partial'=>1,);
		$this->m_inv->update_status_received_partial($iddd,$datap);
		$this->m_inv->sys_transfer_item(); // syscrone tabel trx_item_wh pada table mst_item
		
		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
		//redirect('inv/purchase_order/ok');
 }
 
  //fungsi load print purchase order
 function print_received(){
    if($this->session->userdata('logged_in')){	
	  $id = $this->uri->segment(3);
	  $this->load->model('m_inv');		
	  $session_data 			= $this->session->userdata('logged_in');
	  $data['username'] 		= $session_data['username'];
	  $data['data'] 			= $this->m_inv->get_po_header($id);
	  $data['main'] 			= $this->m_inv->get_print_received_main($id);
	  $data['grand'] 			= $this->m_inv->get_po_grand($id);
	  $data['footer'] 			= $this->m_inv->get_po_footer($id);
	  $this->load->view('menu/print_received', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 
  //fungsi load print purchase order
 function transmission_form(){
    if($this->session->userdata('logged_in')){	
	  $this->load->model('m_inv');		
	  $id 						= $this->uri->segment(3);
	  $session_data 			= $this->session->userdata('logged_in');
	  $user_id			 		= $session_data['id'];
	  $data['username'] 		= $session_data['username'];
	  $data['data'] 			= $this->m_inv->get_list_transmission($id);
	  $jml 						= $data['data']->num_rows();

	  if ($jml == 0) {
	  	echo "<script>
	  		alert('data is still empty, please fill first');
	  		setTimeout(function () { 
				    window.opener.location = 'inv_warehouse/change';
				    window.close();
			}, 1);
	  		</script>";
	  }else{
	  	$this->load->view('menu/transmission_form', $data);
	  }
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //Fungsi Load Header Request Item
 function list_request_items(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		$data['list'] 			= $this->m_inv->get_list_request_item();
	    $this->template->set('title','Klinik | Transfer Item List');
		$this->template->load('template','menu/list_request_items', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

function list_request_items_excel(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		$data['list'] 			= $this->m_inv->get_list_request_item();
		$this->load->view('menu/list_request_items_excel', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi Load Detail Request Item
 function list_detail_request_items(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$id 					= $this->uri->segment(3);
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$user_id		 		= $session_data['id'];
		$data['warehouse'] 		= $this->m_inv->get_list_wh();
		$data['data'] 			= $this->m_inv->get_list_it();
		$data['group'] 			= $this->m_inv->get_list_ig();
		$data['supplier'] 		= $this->m_inv->get_list_sp();
		$data['base']	 		= $this->m_inv->get_list_bu();
		$data['list'] 			= $this->m_inv->get_detail_list_request_item($id);
		$data_update 			= array('is_complete' => 1, );
		$this->m_inv->update_requestitem($id,$data_update);
	    $this->template->set('title','Klinik | Update / Input item price');
		$this->template->load('template','menu/list_detail_request_items', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 
 //fungsi load Transfer Items   
 function transfer_items(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		
		$this->m_inv->sys_gudang(); // syscrone gudang trx_item_wh dari mst_warehouse
		$this->m_inv->sys_item_to_wh(); // syscrone tabel trx_item_wh pada table mst_item
		$this->m_inv->sys_transfer_item(); // syscrone tabel trx_item_wh pada table mst_item
		$this->m_inv->sys_item_min_stock(); // syscrone tabel trx_item_wh pada table mst_minmax (WARNING)
		$this->m_inv->sys_item_minus_stock(); // syscrone tabel trx_item_wh pada table mst_minmax (Importent)
		$this->m_inv->sys_item_min_stock(); // syscrone tabel trx_item_wh pada table mst_minmax

		// $data['warehouse'] 		= $this->m_inv->get_list_wh();
		// $data['group'] 			= $this->m_inv->get_list_ig();
		// $data['supplier'] 		= $this->m_inv->get_list_sp();
		// $data['base']	 		= $this->m_inv->get_list_bu();
		// $data['depart'] 		= $this->m_inv->get_list_depart($id);
		$data['list'] 			= $this->m_inv->select_transfer_item();
	    $this->template->set('title','Klinik | Transfer Item List');
		$this->template->load('template','menu/transfer_items', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

function transfer_items_excel(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		$this->m_inv->sys_gudang(); // syscrone gudang trx_item_wh dari mst_warehouse
		$this->m_inv->sys_item_to_wh(); // syscrone tabel trx_item_wh pada table mst_item
		$this->m_inv->sys_transfer_item(); // syscrone tabel trx_item_wh pada table mst_item
		$this->m_inv->sys_item_min_stock(); // syscrone tabel trx_item_wh pada table mst_minmax (WARNING)
		$this->m_inv->sys_item_minus_stock(); // syscrone tabel trx_item_wh pada table mst_minmax (Importent)
		$data['list'] 			= $this->m_inv->select_transfer_item();
		$this->load->view('menu/transfer_items_excel', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi load Update price Items   
 function list_update_item(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		$data['list'] 			= $this->m_inv->list_mst_item_price_temp();
		
	    $this->template->set('title','Klinik | Transfer Item List');
		$this->template->load('template','menu/list_update_item', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function save_transfer(){
 		$this->load->model('m_inv');	
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$id_item 				= $this->input->post('id_item');
		$item_name 				= $this->input->post('item_name');
		$id_warehouse 			= $this->input->post('id_warehouse');
		$warehouse_name 		= $this->input->post('warehouse_name');
		$stock 					= $this->input->post('stock');
		$id_warehouse2			= $this->input->post('move');
		$item_move 				= $this->input->post('item_move');
		$sisa					= $stock - $item_move;
		$data['detail'] 		= $this->m_inv->get_list_trx_item_wh($id_item,$id_warehouse2);
		$jml					= $data['detail']->num_rows();

		if ($item_move > $stock) {
			
			echo "<script>
			 alert('larger items of stock!');
			 history.back();
			</script>";
			exit();

		}else{

			include './design/koneksi/file.php';
			$sql="UPDATE `trx_item_wh` SET `stock` = $sisa,`update_by` = $user_id WHERE `id_item` = $id_item AND `id_warehouse` = $id_warehouse ";
			$query = mysqli_query($con,$sql);
			// echo $jml; 

			if ($jml == 0) {
				// echo "Jika belum ada maka Insert";
				
				$data_insert			= array(
					'id_item'			=> $id_item,
					'id_warehouse'		=> $id_warehouse2,
					'stock'				=> $item_move,				
					'update_by'			=> $user_id,
				);

	 			$this->load->model('m_inv');			
				$this->m_inv->save_master_trx_item_wh($data_insert);



			}else{ 

				// echo "Jika sudah ada maka Update data";
				foreach($data['detail']->result() as $row){}
				$tambah = $row->stock + $item_move;
				$data_update			= array(
					'id_item'			=> $id_item,
					'id_warehouse'		=> $id_warehouse2,
					'stock'				=> $tambah,
					'update_by'			=> $user_id,
				);

	 			$this->load->model('m_inv');			
				$this->m_inv->update_trx_item_wh($id_item,$id_warehouse2,$data_update);

			}
			// exit();

			// sys table
	 		$this->load->model('m_inv');			
			$data['sys'] 			= $this->m_inv->sys_master_item();

			//Create Transaksi
			$data_input 					= array(
						'id_item'					=>$id_item,
						'trx_type'		 			=>'M',
						'amount'					=>$item_move,
						'from'						=>$id_warehouse,
						'to'						=>$id_warehouse2,
						'created_date'				=>date("Y-m-d H:i:s"),
						'user_id'					=>$user_id,
					);
					
					$this->load->model('m_inv');
					$this->m_inv->save_trx($data_input);
			
				//Create Log Start
				$session_data 			= $this->session->userdata('logged_in');
				$user_id				= $session_data['id'];	
				$data_log = array(
							'id_user'						=>$user_id,
							'log_date'						=>date("Y-m-d"),
							'log_desc' 						=>"Transfer items : From $id_warehouse to $id_warehouse2 ",
				);
				$this->load->model('m_login');
				$this->m_login->log($data_log);
				//Endless Log
				
			// echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
				redirect('inv/transfer_items_warehouse/'.$id_item.'/ok');
				// redirect('inv/transfer_items/ok');
		}
 }


 function save_trx_transfer(){
 		$this->load->model('m_inv');	
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$id_item 				= $this->input->post('id_item');
		$item_name 				= $this->input->post('item_name');
		$id_warehouse 			= $this->input->post('id_warehouse');
		$warehouse_name 		= $this->input->post('warehouse_name');
		$stock 					= $this->input->post('stock');
		$id_warehouse2			= $this->input->post('move');
		$item_move 				= $this->input->post('item_move');
		$sisa					= $stock - $item_move;
		$data['detail'] 		= $this->m_inv->get_list_trx_item_wh($id_item,$id_warehouse2);
		$jml					= $data['detail']->num_rows();

		if ($item_move > $stock) {
			
			echo "<script>
			 alert('larger items of stock!');
			 history.back();
			</script>";
			exit();

		}else{

			include './design/koneksi/file.php';
			$sql="UPDATE `trx_item_wh` SET `stock` = $sisa,`update_by` = $user_id WHERE `id_item` = $id_item AND `id_warehouse` = $id_warehouse ";
			$query = mysqli_query($con,$sql);
			// echo $jml; 

			if ($jml == 0) {
				// echo "Jika belum ada maka Insert";
				
				$data_insert			= array(
					'id_item'			=> $id_item,
					'id_warehouse'		=> $id_warehouse2,
					'stock'				=> $item_move,				
					'update_by'			=> $user_id,
				);

	 			$this->load->model('m_inv');			
				$this->m_inv->save_master_trx_item_wh($data_insert);



			}else{ 

				// echo "Jika sudah ada maka Update data";
				foreach($data['detail']->result() as $row){}
				$tambah = $row->stock + $item_move;
				$data_update			= array(
					'id_item'			=> $id_item,
					'id_warehouse'		=> $id_warehouse2,
					'stock'				=> $tambah,
					'update_by'			=> $user_id,
				);

	 			$this->load->model('m_inv');			
				$this->m_inv->update_trx_item_wh($id_item,$id_warehouse2,$data_update);

			}
			// exit();

			// sys table
	 		$this->load->model('m_inv');			
			$data['sys'] 			= $this->m_inv->sys_master_item();

			//Create Transaksi
			$data_input 				= array(
			'id_item'					=>$id_item,
			'trx_type'		 			=>'M',
			'amount'					=>$item_move,
			'from'						=>$id_warehouse,
			'to'						=>$id_warehouse2,
			'created_date'				=>date("Y-m-d H:i:s"),
			'user_id'					=>$user_id,
			);
				
					$this->load->model('m_inv');
					$this->m_inv->save_trx($data_input);
			
				//Create Log Start
				$session_data 			= $this->session->userdata('logged_in');
				$user_id				= $session_data['id'];	
				$data_log = array(
							'id_user'						=>$user_id,
							'log_date'						=>date("Y-m-d"),
							'log_desc' 						=>"Transfer items : From $id_warehouse to $id_warehouse2 ",
				);
				$this->load->model('m_login');
				$this->m_login->log($data_log);
				//Endless Log
				
			echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
				// redirect('inv/transfer_items/ok');
		}
 }

 //fungsi Lihat gudang
 function inv_item_warehouse($id_item){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		// $data['warehouse'] 		= $this->m_inv->get_list_wh();
		$data['data'] 			= $this->m_inv->get_list_it_transfer($id_item);
		// $data['group'] 			= $this->m_inv->get_list_ig();
		// $data['supplier'] 		= $this->m_inv->get_list_sp();
		// $data['base']	 		= $this->m_inv->get_list_bu();
	    $this->template->set('title','Klinik | Transfer Item List');
		$this->template->load('template','menu/inv_item_warehouse', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi transfer item ke gudang - gudang
 function transfer_items_warehouse(){
    if($this->session->userdata('logged_in')){	
	  	$id_item = $this->uri->segment(3);
		$this->load->model('m_inv');				
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $data['warehouse'] 		= $this->m_inv->get_list_wh();
		// $data['data'] 			= $this->m_inv->get_list_it();
		// $data['group'] 			= $this->m_inv->get_list_ig();
		// $data['supplier'] 		= $this->m_inv->get_list_sp();
		// $data['base']	 		= $this->m_inv->get_list_bu();
		// $data['list_group'] 	= $this->m_lab->get_list_group();
		$data['item'] 			= $this->m_inv->get_list_item($id_item);
	    $this->template->set('title','Klinik | Transfer Item List');
		$this->template->load('template','menu/transfer_items_warehouse', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }


 //fungsi transfer item ke gudang - gudang
 function find_werehouse_list(){
    if($this->session->userdata('logged_in')){	
	  	$id_item = $this->uri->segment(3);
		$this->load->model('m_inv');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $data['data'] 			= $this->m_inv->get_warehouse_stock($id_item);
	    $this->template->set('title','Klinik | Transfer Item List');
		$this->template->load('template','menu/find_werehouse_list', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi transfer item ke gudang - gudang
 function find_werehouse(){
    if($this->session->userdata('logged_in')){	
	  	$id_item = $this->uri->segment(3);
		$this->load->model('m_inv');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $data['data'] 			= $this->m_inv->get_list_wh();
	    $this->template->set('title','Klinik | Transfer Item List');
		$this->template->load('template','menu/find_werehouse', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi transfer item ke gudang - gudang
 function find_werehouse2(){
    if($this->session->userdata('logged_in')){	
	  	$id_item = $this->uri->segment(3);
		$this->load->model('m_inv');		
		$this->load->model('m_master');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $item_group 			= $this->m_master->cek_sysparam('item_request_group');
	    $skey					= array();
	    foreach ($item_group->result() as $row) {$skey[] = $row->skey;}
	    $data['data'] 			= $this->m_inv->get_list_wh2($skey);
	    $this->template->set('title','Klinik | Transfer Item List');
		$this->template->load('template','menu/find_werehouse2', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi transfer item ke gudang - gudang
 function find_werehouse3(){
    if($this->session->userdata('logged_in')){	
	  	$id_item = $this->uri->segment(3);
		$this->load->model('m_inv');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $id 					= $session_data['jobs'];
	    $data['data'] 			= $this->m_inv->get_list_wh3($id);
	    $this->template->set('title','Klinik | Transfer Item List');
		$this->template->load('template','menu/find_werehouse3', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }



}
?>