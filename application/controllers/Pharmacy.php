<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pharmacy extends CI_Controller {
 
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


/** MANUFAKTUR DIBAWAH INI **/
// tambah manufaktur
 function add_manufaktur(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_pharmacy');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['jobs'];
		$data['data'] 			= $this->m_pharmacy->get_item_drug();
	    $this->template->set('title','Klinik | Manufaktur Order');
		$this->template->load('template','menu/add_manufaktur', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi load List Received Items
 function list_manufaktur(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_pharmacy');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		$data['list'] 			= $this->m_pharmacy->get_list_manufaktur_header();
	    $this->template->set('title','Klinik | Manufaktur List');
		$this->template->load('template','menu/list_manufaktur', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi load List Received Items
 function list_detail_manufaktur(){
    if($this->session->userdata('logged_in')){	
		$id_manufaktur_h = $this->uri->segment(3);
		$this->load->model('m_pharmacy');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		$data['list'] 			= $this->m_pharmacy->get_list_manufaktur_detail($id_manufaktur_h);
	    $this->template->set('title','Klinik | Manufaktur List');
		$this->template->load('template','menu/list_detail_manufaktur', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi mencari pasien data
 function choose_patient_data_reg(){
    if($this->session->userdata('logged_in')){
		$this->load->model('m_patient');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['find'] 			= $this->m_patient->get_patient_data();
	    $this->template->set('title','Klinik | Find Patient');
		$this->template->load('template','menu/find_patient_data5', $data);
	} else {
     //If no session, redirect to login page
     redirect('login', 'refresh');
	}	
 }
 //fungsi simpan master Manufaktur
 function save_manufaktur(){

		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$name					= $this->input->post('name');
		$remark					= $this->input->post('remark');
		$rowC					= $this->input->post('rowC');
		$now					= date("Y-m-d H:i:s");
		
		
		$data_insert_h		= array(
			'name_drug'		=>$name,
			'remark'		=>$remark,
			'create_by'		=>$user_id,
			'create_date'	=>$now,				
			'status'		=>0,
		);

		// insert manufaktur header
			$this->load->model('m_pharmacy');
			$this->m_pharmacy->save_manufaktur_h($data_insert_h);

		// cara mudah mengambil id manufaktur tertinggi atau terbaru..
			$data['data'] 	= $this->m_pharmacy->get_max_id_manufaktur();
			foreach($data['data']->result() as $row){
				$id_manufaktur = $row->id_manufaktur;
			}

		$items 					= $this->input->post('item');
		$jml					= count($items);	

		// proses insert manufaktur detail
		for($i=1; $i<=$jml; $i++){
			
			$id_item				= $this->input->post('id_item['.$i.']');
			$id_base				= $this->input->post('id_base['.$i.']');
			$qty					= $this->input->post('qty['.$i.']');
			$id_drug_dosage			= $this->input->post('id_drug_dosage['.$i.']');

				$data_insert_d			= array(
				'id_manufaktur_h'		=>$id_manufaktur,
				'id_item'				=>$id_item,
				'qty'					=>$qty,
				'base_unit'				=>$id_base,
				'create_by'				=>$user_id,
				'create_date'			=>$now,				
				'status'				=>0,
				);

				$this->m_pharmacy->save_manufaktur_d($data_insert_d);

		}



 		//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d H:i:s"),
						'log_desc' 						=>"Create Master Manufaktur (id_manufaktur) : ".$id_manufaktur."",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
		//Endless Log

		redirect('Pharmacy/add_manufaktur/ok');
 }

 //fungsi simpan master Manufaktur
 function save_manufaktur_old(){

		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$name					= $this->input->post('name');
		$remark					= $this->input->post('remark');
		$rowC					= $this->input->post('rowC');
		$now					= date("Y-m-d H:i:s");
		
		
		$data_insert_h		= array(
			'name_drug'		=>$name,
			'remark'		=>$remark,
			'create_by'		=>$user_id,
			'create_date'	=>$now,				
			'status'		=>0,
		);

		// insert manufaktur header
			$this->load->model('m_pharmacy');
			$this->m_pharmacy->save_manufaktur_h($data_insert_h);

		// cara mudah mengambil id manufaktur tertinggi atau terbaru..
			$data['data'] 	= $this->m_pharmacy->get_max_id_manufaktur();
			foreach($data['data']->result() as $row){
				$id_manufaktur = $row->id_manufaktur;
			}

		// proses insert manufaktur detail
		for($i=1; $i<=$rowC; $i++){
			
			$id_item				= $this->input->post('id_item'.$i.'');
			$id_baseunit			= $this->input->post('id_baseunit'.$i.'');
			$qty					= $this->input->post('qty'.$i.'');
			$foo					= $this->input->post('foo'.$i.'');

			if ($foo == "on") {

				$data_insert_d			= array(
				'id_manufaktur_h'		=>$id_manufaktur,
				'id_item'				=>$id_item,
				'qty'					=>$qty,
				'base_unit'				=>$id_baseunit,
				'create_by'				=>$user_id,
				'create_date'			=>$now,				
				'status'				=>0,
				);

				$this->m_pharmacy->save_manufaktur_d($data_insert_d);
			}

			


		}



 		//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d H:i:s"),
						'log_desc' 						=>"Create Master Manufaktur (id_manufaktur) : ".$id_manufaktur."",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
		//Endless Log

		redirect('Pharmacy/add_manufaktur/ok');
 }

 function delete_manufaktur(){

	$id = $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	

	$data_delete			= array(
	'status'				=>1,		
	);

	$this->load->model('m_pharmacy');
	$this->m_pharmacy->delete_manufaktur($id,$data_delete);


	$data['item']		= $this->m_pharmacy->get_id_item($id);
	foreach ($data['item']->result() as $row) {
		$id_item = $row->id_item;
	}


	$data_delete_item			= array(
	'is_active'					=>1,			
	'created_by'				=>$user_id,			
	'create_update'				=>date("Y-m-d H:i:s"),		
	);
	$this->m_pharmacy->delete_mst_item($id_item,$data_delete_item);


	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log = array(
	'id_user'						=>$user_id,
	'log_date'						=>date("Y-m-d H:i:s"),
	'log_desc' 						=>"Delete Manufaktur, id : ".$id." , Delete By ". $user_id,
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log

	redirect('Pharmacy/list_manufaktur/del');

}

/** BATAS MANUFAKTUR **/



 // tambah label
 function add_label(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_pharmacy');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $id						= $session_data['id'];
		$data['data'] 			= $this->m_pharmacy->get_list_label();
		$data['dosis'] 			= $this->m_pharmacy->get_list_dosage();
	    $this->template->set('title','Klinik | Manufaktur Order');
		$this->template->load('template','menu/add_label', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

function update_master_label(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_pharmacy');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $user_id				= $session_data['id'];
	    $data['id_label']		= $this->uri->segment(3);
		$data['dosis'] 			= $this->m_pharmacy->get_list_dosage();
		$get_label				= $this->m_pharmacy->get_list_label_id($data['id_label']);

		foreach ($get_label->result() as $row) {
			$data['id_drug_dosage']		= $row->id_drug_dosage;
			$data['drug_name']			= $row->drug_name;
			$data['description']		= $row->description;
		}

	    $this->template->set('title','Klinik | Manufaktur Order');
		$this->template->load('template','menu/update_master_label', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function process_update_master_label(){

	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$id 					= $this->input->post('id_label');
	$items 					= explode(":",$this->input->post('items'));
	$id_drug_dosage			= $items[0];
	$drug_name				= $items[1];
	$remark					= $this->input->post('remark');
	$main					= $this->input->post('main');
	$day					= $this->input->post('day');
	$day					= $this->input->post('day');
	$now					= date("Y-m-d H:i:s");

	// Update status
	$data_update			= array(
	'id_drug_dosage'		=>$id_drug_dosage,
	'drug_name'				=>$drug_name,
	'description'			=>$remark,
	'update_by'				=>$user_id,
	'update_date'			=>$now,		
	);
	$this->load->model('m_pharmacy');
	$this->m_pharmacy->delete_label($id,$data_update);
	// End Update 

	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log 				= array(
	'id_user'				=>$user_id,
	'log_date'				=>date("Y-m-d H:i:s"),
	'log_desc' 				=>"Update Label, id : ".$id." , By ". $user_id,
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log

	echo "<script>window.close(this); window.onunload = refreshParent; function refreshParent() { window.opener.location.assign('add_label/change'); }</script>";
 }

//fungsi simpan master label
function save_label(){

	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$items 					= explode(":",$this->input->post('items'));
	$id_drug_dosage			= $items[0];
	$drug_name				= $items[1];
	$remark					= $this->input->post('remark');
	$main					= $this->input->post('main');
	$day					= $this->input->post('day');
	$now					= date("Y-m-d H:i:s");

	$data_insert			= array(
	'id_drug_dosage'		=>$id_drug_dosage,
	'drug_name'				=>$drug_name,
	'description'			=>$remark,
	'status'				=>0,
	'create_by'				=>$user_id,
	'create_date'			=>$now,				
	);

	$this->load->model('m_pharmacy');
	$this->m_pharmacy->save_label($data_insert);

	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log = array(
	'id_user'						=>$user_id,
	'log_date'						=>date("Y-m-d H:i:s"),
	'log_desc' 						=>"Create Master Label (id_drug_dosage) : ".$id_drug_dosage."",
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log

	redirect('Pharmacy/add_label/ok');

}

function delete_label(){

	$id = $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	

	$data_delete			= array(
	'status'				=>1,		
	);

	$this->load->model('m_pharmacy');
	$this->m_pharmacy->delete_label($id,$data_delete);

	//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d H:i:s"),
						'log_desc' 						=>"Delete label, id : ".$id." , Delete By ". $user_id,
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
		//Endless Log


	redirect('Pharmacy/add_label/del');

}


 // tambah dosage
 function add_dosage(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$this->load->model('m_pharmacy');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $id						= $session_data['id'];
		$data['item'] 			= $this->m_pharmacy->get_list_drugs();
		$data['data'] 			= $this->m_pharmacy->get_list_dosage();
	    $this->template->set('title','Klinik | Master Dosage');
		$this->template->load('template','menu/add_dosage', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
}

function update_master_dosage(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$this->load->model('m_pharmacy');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $user_id				= $session_data['id'];
		$data['id_drug_dosage']	= $this->uri->segment(3);
		$data['item'] 			= $this->m_pharmacy->get_list_drugs();
		$get_list_dosage		= $this->m_pharmacy->get_list_dosage_id($data['id_drug_dosage']);

		foreach ($get_list_dosage->result() as $row) {
			$data['id_drug']			= $row->id_drug;
			$data['drug_name']			= $row->drug_name;
			$data['dosage_main']		= $row->dosage_main;
			$data['dosage_days']		= $row->dosage_days;
			$data['dossage_remarks']	= $row->dossage_remarks;
		}

	    $this->template->set('title','Klinik | Master Dosage');
		$this->template->load('template','menu/update_master_dosage', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
}

function process_update_master_dosage(){

	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$id						= $this->input->post('id_drug_dosage');
	$id_drug				= $this->input->post('id_drug');
	$drug_name				= $this->input->post('items');
	$remark					= $this->input->post('remark');
	$main					= $this->input->post('main');
	$day					= $this->input->post('day');
	$now					= date("Y-m-d H:i:s");

	// Update status
	$data_update			= array(
	'id_drug'				=>$id_drug,
	'drug_name'				=>$drug_name,
	'dosage_main'			=>$main,
	'dosage_days'			=>$day,
	'dossage_remarks'		=>$remark,
	'update_by'				=>$user_id,
	'update_date'			=>$now,				
	);
	$this->load->model('m_pharmacy');
	$this->m_pharmacy->delete_dosage($id,$data_update);
	// End Update 

	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log 				= array(
	'id_user'				=>$user_id,
	'log_date'				=>date("Y-m-d H:i:s"),
	'log_desc' 				=>"Update Dosage, id : ".$id." , By ". $user_id,
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log

	echo "<script>window.close(this); window.onunload = refreshParent; function refreshParent() { window.opener.location.assign('add_dosage/change'); }</script>";	
}

function add_eticket(){
	if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$this->load->model('m_pharmacy');			
		$this->load->model('m_regreport');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['instruction']	= $this->m_pharmacy->get_list_instruction();
		$data['warehouse'] 		= $this->m_inv->get_list_wh();
		$data['data'] 			= $this->m_inv->get_list_it();
		$data['group'] 			= $this->m_inv->get_list_ig();
		$data['supplier'] 		= $this->m_inv->get_list_sp();
		$data['base']	 		= $this->m_inv->get_list_bu();
		$data['trx_registration'] = $this->m_regreport->get_report_reg(); // 		

	    $this->template->set('title','Klinik | Input E-Ticket');
		$this->template->load('template','menu/add_eticket', $data);
	} else {
	  //If no session, redirect to login page
	  redirect('login', 'refresh');
	}	
}

function print_eticket(){
	if($this->session->userdata('logged_in')){	
		$this->load->model('m_pharmacy');			
		$id_reg				= $this->uri->segment(3);
		if (!isset($id_reg)) {
			$id_reg			= $this->input->post('id_reg');
		}
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['instruction']	= $this->m_pharmacy->get_list_instruction();
		$data['list_phar'] 		= $this->m_pharmacy->get_data_pharmacy($id_reg);
	    $this->template->set('title','Klinik | Input E-Ticket');
		$this->load->view('menu/print_eticket', $data);
	} else {
	  //If no session, redirect to login page
	  redirect('login', 'refresh');
	}	
}


function report_prescription(){
	if($this->session->userdata('logged_in')){	
		$this->load->model('m_pharmacy');			
		$id_reg					= $this->uri->segment(3);
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['list']			= $this->m_pharmacy->get_list_instruction();
	    $this->template->set('title','Klinik | Input E-Ticket');
		$this->load->view('menu/report_prescription', $data);
	} else {
	  //If no session, redirect to login page
	  redirect('login', 'refresh');
	}	
}

//fungsi simpan master Manufaktur
function save_dosage(){

	$this->load->model('m_pharmacy');

	$goals 					= $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$items 					= explode(":",$this->input->post('items'));
	$jml_items 				= count($items);
	$id_drug				= $items[0];
	$remark					= $this->input->post('remark');
	$main					= $this->input->post('main');
	$day					= $this->input->post('day');
	$now					= date("Y-m-d H:i:s");

	if ($jml_items  == 1 ) {
		
		$get_nama			= $this->m_pharmacy->get_item_drug_by_id($id_drug);
		
		foreach ($get_nama->result() as $row) {
			$drug_name 		= $row->item_name;
		}

	}else{
		$drug_name			= $items[1];
	}

	$data_insert			= array(
	'id_drug'				=>$id_drug,
	'drug_name'				=>$drug_name,
	'dosage_main'			=>$main,
	'dosage_days'			=>$day,
	'dossage_remarks'		=>$remark,
	'status'				=>0,
	'create_by'				=>$user_id,
	'create_date'			=>$now,				
	);
	$this->m_pharmacy->save_dosage($data_insert);

	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log = array(
	'id_user'						=>$user_id,
	'log_date'						=>date("Y-m-d H:i:s"),
	'log_desc' 						=>"Create Master Dosage (id_drug) : ".$id_drug."",
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log
	
	if($goals!=""){
	redirect('Pharmacy/find_dosage/'.$goals.'/'.$id_drug.'');	
	}else{
	redirect('Pharmacy/add_dosage/ok');
	}

}

function delete_dosage(){

	$id = $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	

	$data_delete			= array(
	'status'				=>1,		
	);

	$this->load->model('m_pharmacy');
	$this->m_pharmacy->delete_dosage($id,$data_delete);

	//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d H:i:s"),
						'log_desc' 						=>"Delete dosis, id : ".$id." , Delete By ". $user_id,
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
	//Endless Log


	// redirect('Pharmacy/add_dosage/del');

}

/** BATAS DOSIS **/

//fungsi load Purchase Order
 function Prescription_order(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['jobs'];
	    $this->template->set('title','Klinik | Prescription Order');
		$this->template->load('template','menu/Prescription_order', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }
 //fungsi load Find Item
 function find_item_drug(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_pharmacy');				
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_pharmacy->get_find_item_drug();
	    $this->template->set('title','Klinik | Find Item');
		// $this->template->load('template','menu/find_item_drug', $data);
		$this->template->load('template','menu/find_item_drug2', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 } 
 //fungsi load Find Item
 function find_drug(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_inv');				
		$this->load->model('m_pharmacy');				
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['dosis'] 			= $this->m_pharmacy->get_list_dosage();
		$data['data'] 			= $this->m_inv->get_find_item_drug();
	    $this->template->set('title','Klinik | Find Item');
		$this->template->load('template','menu/find_drug', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi load Find Item
 function find_dosage(){
    if($this->session->userdata('logged_in')){	
		$id_item	= $this->uri->segment(4);
		$this->load->model('m_inv');				
		$this->load->model('m_pharmacy');				
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['data'] 			= $this->m_pharmacy->get_list_dosageBy_Iditem($id_item);
	    $this->template->set('title','Klinik | Find Dosage');
		$this->template->load('template','menu/find_dosage2', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi mencari pasien data
 function find_patient_data(){
    if($this->session->userdata('logged_in')){
		$this->load->model('m_pharmacy');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['find'] 			= $this->m_pharmacy->get_patient_data_all();
	    $this->template->set('title','Klinik | Find Patient Data');
		$this->template->load('template','menu/find_patient_data2', $data);
	} else {
     //If no session, redirect to login page
     redirect('login', 'refresh');
	}	
 }

 //fungsi simpan master Manufaktur
function save_prescription(){

	$this->load->model('m_pharmacy');

	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$pat_mrn 				= $this->input->post('pat_mrn');
	$id_pat					= $this->input->post('id_pat');
	$id_reg 				= $this->input->post('id_reg');
	$tgl 					= date("Y-m-d");
	$now					= date("Y-m-d H:i:s");
	$cek_data 				= $this->m_pharmacy->get_pat_prescription_h_data($id_reg);
	$cek_jml 				= $cek_data->num_rows();
	$tambah					= $cek_jml+1;

	$data_insert			= array(
	'presc_date'			=>$tgl,
	'id_reg'				=>$id_reg,
	'id_pat'				=>$id_pat,
	'id_dr'					=>$user_id,
	'presc_status'			=>0,
	'create_by'				=>$user_id,
	'create_date'			=>$now,
	);
	$this->m_pharmacy->save_prescription($data_insert);

	$items 					= $this->input->post('item');
	$jml					= count($items);

	// cara mudah mengambil id manufaktur tertinggi atau terbaru..
	$data['data'] 	= $this->m_pharmacy->get_max_id_prescription();
	foreach($data['data']->result() as $row){
		$id_presc = $row->id_presc;
	}

	// proses insert manufaktur detail
	for($i=1; $i<=$jml; $i++){
		
		$id_item				= $this->input->post('id_item['.$i.']');
		$id_base				= $this->input->post('id_base['.$i.']');
		$qty					= $this->input->post('qty['.$i.']');
		$id_drug_dosage			= $this->input->post('id_drug_dosage['.$i.']');

	
			$data_insert_d			= array(
			'id_presc_h'			=>$id_presc,
			'drug_id'				=>$id_item,
			'drug_qty'				=>$qty,
			'drug_uom'				=>$id_base,
			'drug_dosage'			=>$id_drug_dosage,
			);

			$this->m_pharmacy->save_prescription_d($data_insert_d);

	}

	//Create Log Start
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	
	$data_log = array(
	'id_user'						=>$user_id,
	'log_date'						=>date("Y-m-d H:i:s"),
	'log_desc' 						=>"Create Prescription Order : ".$id_presc."",
	);
	$this->load->model('m_login');
	$this->m_login->log($data_log);
	//Endless Log
	redirect('Pharmacy/Prescription_order/ok');
}

//fungsi load List Received Items
function list_prescription(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_pharmacy');			
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		$data['list'] 			= $this->m_pharmacy->get_list_resep_header();
	    $this->template->set('title','Klinik | Prescription List');
		$this->template->load('template','menu/list_prescription', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 function delete_prescription(){
	$id = $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	

	$data_delete					= array(
		'presc_status'				=>1,		
	);
	$this->load->model('m_pharmacy');
	$this->m_pharmacy->delete_prescription($id,$data_delete);

		//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d H:i:s"),
						'log_desc' 						=>"Delete Prescription, id : ".$id." , Delete By ". $user_id,
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
		//Endless Log
	redirect('Pharmacy/list_prescription/del');

}

 function stop_pharmacy(){
	$id 					= $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	

	$data_update			= array(
		'end_time'			=>date("Y-m-d H:i:s"),		
		'is_completed'		=>5,
	);
	$this->load->model('m_pharmacy');
	$this->m_pharmacy->update_trx_pharmacy_h2($id,$data_update);

	$data_update			= array(
		'presc_status'		=>5,
	);
	$this->load->model('m_pharmacy');
	$this->m_pharmacy->update_prescription($id,$data_update);

		//Create Log Start
			$session_data 					= $this->session->userdata('logged_in');
			$user_id						= $session_data['id'];	
			$data_log = array(
						'id_user'			=>$user_id,
						'log_date'			=>date("Y-m-d H:i:s"),
						'log_desc' 			=>"Sudah selesai meracik obat, dengan id : ".$id." , Dilakukan oleh ". $user_id,
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
		//Endless Log

	redirect('Pharmacy/list_prescription/stop');

}

 function archive_prescription(){

	$id = $this->uri->segment(3);
	$session_data 			= $this->session->userdata('logged_in');
	$user_id				= $session_data['id'];	

	$data_delete					= array(
		'presc_status'				=>4,		
	);

	$this->load->model('m_pharmacy');
	$this->m_pharmacy->delete_prescription($id,$data_delete);

	//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
						'id_user'						=>$user_id,
						'log_date'						=>date("Y-m-d H:i:s"),
						'log_desc' 						=>"Archive Prescription, id : ".$id." , Archive By ". $user_id,
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
		//Endless Log

	redirect('Pharmacy/list_prescription/arc');

}

 //fungsi load List Received Items
function list_detail_prescription(){
    if($this->session->userdata('logged_in')){
		$this->load->model('m_pharmacy');			
    	$id_presc 				= $this->uri->segment(3);
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		$data['list'] 			= $this->m_pharmacy->get_list_resep_detail($id_presc);
	    $this->template->set('title','Klinik | Prescription Detail');
		$this->template->load('template','menu/list_detail_prescription', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi transfer item ke gudang - gudang
 function find_werehouse_list(){
    if($this->session->userdata('logged_in')){	
	  	$id_item = $this->uri->segment(4);
	  	$jml = $this->uri->segment(5);
		$this->load->model('m_pharmacy');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
	    $data['data'] 			= $this->m_pharmacy->get_warehouse_stock($id_item,$jml);
	    $this->template->set('title','Klinik | Transfer Item List');
		$this->template->load('template','menu/find_werehouse_list2', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

//fungsi simpan master pharmacy
function save_trx_pharmacy(){
		
		$this->load->model('m_pharmacy');		

		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$tgl 					= date("Y-m-d");
		$now					= date("Y-m-d H:i:s");
		$rowCount	 			= $this->input->post('rowCount');
		$id_presc				= $this->input->post('id_presc');
		$id_reg 				= $this->input->post('id_reg');
		$id_pat 				= $this->input->post('id_pat');
		$amount 				= str_replace(",","",$this->input->post('amount_total'));
		$ppn 					= str_replace(",","",$this->input->post('amount_ppn'));
		$total 					= str_replace(",","",$this->input->post('amount_grand'));
		$is_paid 				= 0;
		$is_completed			= 3;

		// ---------- cek data jik sudah ada delete ----------

		$cekdata 				= $this->m_pharmacy->get_trx_pharmacy2($id_reg);
		$jmldata 				= $cekdata->num_rows();
		if ($jmldata > 0) {
			foreach ($cekdata->result() as $row) {
				$id_delete 	= $row->id_phar_trx;
				$this->m_pharmacy->del_trx_pharmacy_h($id_delete);
				$this->m_pharmacy->del_trx_pharmacy_d($id_delete);
			}
		}
		
		// ---------- batas delete ----------

		$data_insert			= array(
		'presc_no'				=>$id_presc,
		'id_reg'				=>$id_reg,
		'id_pat'				=>$id_pat,
		'is_paid'				=>$is_paid,
		'is_completed'			=>$is_completed,
		'user_id'				=>$user_id,
		'amount'				=>$amount,
		'ppn'					=>$ppn,
		'total'					=>$total,
		'start_time'			=>$now,
		);
		$this->m_pharmacy->save_trx_pharmacy_h($data_insert);


		// cara mudah mengambil id manufaktur tertinggi atau terbaru..
			$data['data'] 	= $this->m_pharmacy->get_max_id_phar_trx();
			foreach($data['data']->result() as $row){
				$id_phar_trx = $row->id_phar_trx;
			}

		// proses insert manufaktur detail
		for($i=1; $i<=$rowCount; $i++){
			
			$id_warehouse				= $this->input->post('id_warehouse'.$i.'');
			$warehouse_name				= $this->input->post('warehouse'.$i.'');
			$stock_warehouse			= $this->input->post('stock_warehouse'.$i.'');
			$qty						= $this->input->post('qty['.$i.']');
			$id_drug_dosage				= $this->input->post('id_drug_dosage['.$i.']');
			$jml						= $this->input->post('jml'.$i.'');
			$unit						= str_replace(",","",$this->input->post('unit['.$i.']'));
			$disc						= $this->input->post('disc['.$i.']');
			$disc_2						= $this->input->post('disc_2['.$i.']');
			$total						= $this->input->post('total['.$i.']');
			$drug_id					= $this->input->post('drug_id'.$i.'');
			$drug_uom					= $this->input->post('drug_uom'.$i.'');
			$total2						= $this->input->post('total2['.$i.']');
			$id_manufaktur				= $this->input->post('id_manufaktur'.$i.'');
			$balance					= $stock_warehouse-$jml;
		
				$data_insert_d			= array(
				'id_phar_h'				=>$id_phar_trx, 
				'drug_id' 				=>$drug_id, 
				'drug_code' 			=>'', 
				'drug_qty' 				=>$jml, 
				'drug_uom' 				=>$drug_uom, 
				'price' 				=>$unit, 
				'disc1' 				=>$disc, 
				'disc2' 				=>$disc_2, 
				'amount' 				=>$total2, 
				'is_dispensed' 			=>0, 
				'is_manufactured' 		=>$id_manufaktur, 
				'item_seq_no'			=>0, 
				'id_warehouse'			=>$id_warehouse,
				'warehouse_name'		=>$warehouse_name,
				'stock'					=>$stock_warehouse,
				'balance'				=>$balance,
				);
				$this->m_pharmacy->save_trx_pharmacy_d($data_insert_d);


		}

		// Update Status..
		$data_delete					= array(
			'presc_status'				=>3,		
		);
		$this->m_pharmacy->delete_prescription($id_presc,$data_delete);

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$data_log = array(
		'id_user'						=>$user_id,
		'log_date'						=>date("Y-m-d H:i:s"),
		'log_desc' 						=>"Create Master Pharmacy (id_phar_trx) : ".$id_phar_trx."",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log

		// redirect('Pharmacy/list_prescription/ok');
		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
		

 }

 //fungsi load List Received Items
function update_detail_prescription(){
    if($this->session->userdata('logged_in')){
		$this->load->model('m_pharmacy');			
    	$id_presc 				= $this->uri->segment(3);
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$id				 		= $session_data['id'];
		$data['list'] 			= $this->m_pharmacy->get_list_update_resep_detail($id_presc);
	    $this->template->set('title','Klinik | Prescription Detail');
		$this->template->load('template','menu/update_detail_prescription', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

 //fungsi simpan master pharmacy
function update_trx_pharmacy(){

		$this->load->model('m_inv');
		$this->load->model('m_pharmacy');		
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$tgl 					= date("Y-m-d");
		$now					= date("Y-m-d H:i:s");
		$rowCount	 			= $this->input->post('rowCount');
		$id_presc				= $this->input->post('id_presc');
		$id_reg 				= $this->input->post('id_reg');
		$id_pat 				= $this->input->post('id_pat');
		$id_phar_h 				= $this->input->post('id_phar_h');
		// Post array dibawah ini...
		$id_phar_d				= $this->input->post('id_phar_d[]');
		$id_warehouse			= $this->input->post('id_warehouse[]');
		$warehouse_name			= $this->input->post('warehouse[]');
		$stock_warehouse		= $this->input->post('stock_warehouse[]');
		$qty					= $this->input->post('qty[]');
		$id_drug_dosage			= $this->input->post('id_drug_dosage[]');
		$jml					= $this->input->post('jml[]');
		$unit					= str_replace(",","",$this->input->post('unit[]'));
		$disc					= $this->input->post('disc[]');
		$disc_2					= $this->input->post('disc_2[]');
		$total					= $this->input->post('total[]');
		$drug_id				= $this->input->post('drug_id[]');
		$drug_uom				= $this->input->post('drug_uom[]');
		$total2					= $this->input->post('total2[]');
		$id_manufaktur			= $this->input->post('id_manufaktur[]');

		$amount 				= str_replace(",","",$this->input->post('amount_total'));
		$ppn 					= str_replace(",","",$this->input->post('amount_ppn'));
		$total 					= str_replace(",","",$this->input->post('amount_grand'));
		$is_paid 				= 1;
		$is_completed			= 4;
		$id_phar_trx 			= $id_phar_h;

		// proses insert manufaktur detail
		for($i=0; $i<$rowCount; $i++){

			// Update stock yang bukan manufaktur
			if ($id_manufaktur[$i] == 0) {

				$data['detail'] 			= $this->m_inv->get_list_trx_item_wh($drug_id[$i],$id_warehouse[$i]);
				$countwh					= $data['detail']->num_rows();

				if ($countwh == 0) {
					$data_insert			= array(
					'id_item'				=> $drug_id[$i],
					'id_warehouse'			=> $id_warehouse[$i],		
					'stock'					=> 0,
					'update_by'				=> $user_id,
					);
					$this->m_inv->save_master_trx_item_wh($data_insert);
				}

				$data_warehouse				= array(
				'update_by'					=> $user_id,
				'stock'						=> $stock_warehouse[$i],
				'update_date'				=> date("Y-m-d H:i:s"), 
				);
				$this->m_pharmacy->update_stock_itemwh($drug_id[$i],$id_warehouse[$i],$data_warehouse);

				$data_pharmacy				= array(
				'balance'					=> $stock_warehouse[$i],
				);
				$this->m_pharmacy->update_trx_pharmacy_d($id_phar_d[$i],$data_pharmacy);

				$data_input 				= array(
				'id_item'					=>$drug_id[$i],
				'trx_type'		 			=>'C',
				'amount'					=>$jml[$i],
				'from'						=>$id_warehouse[$i],
				'to'						=>0,
				'created_date'				=>date("Y-m-d H:i:s"),
				'user_id'					=>$user_id,
				);
				$this->m_inv->save_trx($data_input); //Input transaksi..


			}else{ // Update stock yang manufaktur...

				$data['data'] = $this->m_pharmacy->get_iditem_manufaktur($id_manufaktur[$i]);
				
				foreach($data['data']->result() as $row){

					$drug_id		= $row->drug_id;
					$id_warehouse	= $row->warehouse_id;
					$jml2			= $jml * $row->qty;

					$data['detail'] 		= $this->m_inv->get_list_trx_item_wh($drug_id,$id_warehouse);
					$countwh				= $data['detail']->num_rows();

					if ($countwh == 0) {

						// echo "insert data";
					
						$data_insert			= array(
						'id_item'				=> $drug_id,
						'id_warehouse'			=> $id_warehouse,
						'stock'					=> 0,
						'update_by'				=> $user_id,
						);
						$this->m_inv->save_master_trx_item_wh($data_insert);

					}

					$data_warehouse				= array(
					'update_by'					=> $user_id,
					'update_date'				=> date("Y-m-d H:i:s"), 
					);
					$this->m_pharmacy->update_werehouse_stock($drug_id,$id_warehouse,$jml2,$data_warehouse);

					$data_input 				= array(
					'id_item'					=>$drug_id,
					'trx_type'		 			=>'C',
					'amount'					=>$jml2,
					'from'						=>$id_warehouse,
					'to'						=>0,
					'created_date'				=>date("Y-m-d H:i:s"),
					'user_id'					=>$user_id,
					);
					$this->m_inv->save_trx($data_input); //Input transaksi..

				} // Batas Foreach


			} // Batas IF else 

		} // Batas looping for


		// Update Status trx_pharmacy_h
		$data_update			= array(
		'is_paid'				=>1,
		'is_completed'			=>4,
		);
		$this->m_pharmacy->update_trx_pharmacy_h($id_phar_h,$data_update);
		
		// Update Status trx_pharmacy_d
		$data_update_d			= array(
		'is_dispensed' 			=>1, 
		);
		$this->m_pharmacy->update_trx_pharmacy_d2($id_phar_h,$data_update_d);

		// Update Status pat_prescription_h
		$data_delete					= array(
			'presc_status'				=>2,		
		);
		$this->m_pharmacy->delete_prescription($id_presc,$data_delete);


		$this->m_inv->sys_master_item(); // syscrone ke table master..

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$data_log 				= array(
		'id_user'				=>$user_id,
		'log_date'				=>date("Y-m-d H:i:s"),
		'log_desc' 				=>"Dispense Pharmacy (id_phar_trx) : ".$id_phar_trx."",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log

		echo "<script>window.close(this); window.onunload = refreshParent; function refreshParent() { window.opener.location.assign('list_prescription/ok'); }</script>";
		

 }


// Untuk menu returnt items pada pharmacy ..
	function returnt_items(){
	    if($this->session->userdata('logged_in')){	
			$this->load->model('m_pharmacy');			
			$session_data 			= $this->session->userdata('logged_in');
		    $data['username'] 		= $session_data['username'];
			$id				 		= $session_data['id'];
			$data['list'] 			= $this->m_pharmacy->get_list_resep_header_all();
		    $this->template->set('title','Klinik | Prescription List');
			$this->template->load('template','menu/returnt_items', $data);
		} else {
		  //If no session, redirect to login page
	      redirect('login', 'refresh');
		}	
	 }

	function returnt_items_detail(){
	    if($this->session->userdata('logged_in')){
			$this->load->model('m_pharmacy');			
	    	$id_presc 				= $this->uri->segment(3);
			$session_data 			= $this->session->userdata('logged_in');
		    $data['username'] 		= $session_data['username'];
			$id				 		= $session_data['id'];
			$data['list'] 			= $this->m_pharmacy->get_list_resep_detail($id_presc);
		    $this->template->set('title','Klinik | Prescription Detail');
			$this->template->load('template','menu/returnt_items_detail', $data);
		} else {
		  //If no session, redirect to login page
	      redirect('login', 'refresh');
		}	
	 }

	function save_trx_undispensed(){
			
			$this->load->model('m_pharmacy');			
			$this->load->model('m_inv');

			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$tgl 					= date("Y-m-d");
			$now					= date("Y-m-d H:i:s");
			$rowCount	 			= $this->input->post('rowCount');
			$id_presc				= $this->input->post('id_presc');
			$id_presc_d				= $this->input->post('id_presc_d[]');
			$id_reg 				= $this->input->post('id_reg');
			$id_pat 				= $this->input->post('id_pat');
			$amount 				= str_replace(",","",$this->input->post('amount_total'));
			$ppn 					= str_replace(",","",$this->input->post('amount_ppn'));
			$total 					= str_replace(",","",$this->input->post('amount_grand'));
			$is_paid 				= 0;
			$is_completed			= 3;
			$urut					= 0;
			$get_trx_pharmacy		= $this->m_pharmacy->get_trx_pharmacy($id_presc);

			foreach ($get_trx_pharmacy->result() as $row) {
				$id_phar_trx 		= $row->id_phar_trx;
				$start_time 		= $row->start_time;
				$end_time 			= $row->end_time;
			}

			for($i=1; $i<=$rowCount; $i++){
				
				$id_warehouse				= $this->input->post('id_warehouse'.$i.'');
				$warehouse_name				= $this->input->post('warehouse'.$i.'');
				$stock_warehouse			= $this->input->post('stock_warehouse'.$i.'');
				$qty						= $this->input->post('qty['.$i.']');
				$id_drug_dosage				= $this->input->post('id_drug_dosage['.$i.']');
				$jml						= $this->input->post('jml'.$i.'');
				$unit						= str_replace(",","",$this->input->post('unit['.$i.']'));
				$disc						= $this->input->post('disc['.$i.']');
				$disc_2						= $this->input->post('disc_2['.$i.']');
				$total						= $this->input->post('total['.$i.']');
				$drug_id					= $this->input->post('drug_id'.$i.'');
				$drug_uom					= $this->input->post('drug_uom'.$i.'');
				$total2						= $this->input->post('total2['.$i.']');
				$id_manufaktur				= $this->input->post('id_manufaktur'.$i.'');
				$balance					= $stock_warehouse-$jml;
				$get_list_trx_item_wh		= $this->m_inv->get_list_trx_item_wh($drug_id,$id_warehouse);
				$countwh					= $get_list_trx_item_wh->num_rows();

				foreach ($get_list_trx_item_wh->result() as $row) {
					$stock 					= $row->stock;
					$sisa					= $stock + $qty;
				}


				if ($countwh == 0) {
					$data_insert			= array(
					'id_item'				=> $drug_id,
					'id_warehouse'			=> $id_warehouse,		
					'stock'					=> 0,
					'update_by'				=> $user_id,
					);
					$this->m_inv->save_master_trx_item_wh($data_insert);
				}

				$data_warehouse				= array(
				'update_by'					=> $user_id,
				'stock'						=> $sisa,
				'update_date'				=> date("Y-m-d H:i:s"), 
				);
				$this->m_pharmacy->update_stock_itemwh($drug_id,$id_warehouse,$data_warehouse);
			
				$data_insert_d			= array(
				'id_phar_h'				=>$id_phar_trx, 
				'id_phar_d'				=>$id_presc_d[$urut], 
				'id_reg' 				=>$id_reg, 
				'id_warehouse'			=>$id_warehouse,
				'id_item' 				=>$drug_id, 					
				);
				$this->m_pharmacy->save_trx_undispensed($data_insert_d);

				$data_input 					= array(
					'id_item'					=>$drug_id,
					'trx_type'		 			=>'D',
					'amount'					=>$unit,
					'from'						=>0,
					'to'						=>$id_warehouse,
					'created_date'				=>date("Y-m-d H:i:s"),
					'user_id'					=>$user_id,
				);
				$this->m_inv->save_trx($data_input);
				

				$urut++;
			}


			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
			$data_log = array(
			'id_user'				=>$user_id,
			'log_date'				=>date("Y-m-d H:i:s"),
			'log_desc' 				=>"Mengembalikan Item / Obat dengan nomor pharmacy : ".$id_phar_trx."",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log

			// redirect('Pharmacy/list_prescription/ok');
			echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
			

	 }
// Batas menu returnt items pada pharmacy
 


}
?>