<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Client extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
 }
/*  	var $limit = 10;
	var $reg = 'reg_patien';
  */
 function index()
 {
   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
     $this->load->view('menu/index.php', $data);
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }

	function add_client(){
		if($this->session->userdata('logged_in')){	
		$this->load->model('m_client'); 
		$this->load->model('m_master');
		$session_data 		= $this->session->userdata('logged_in');
		$data['username'] 	= $session_data['username'];
		$data['dept']		= $this->m_master->cek_sysparam('dept_client');

		$this->template->set('title','Klinik | Input Client');
		$this->template->load('template','menu/client', $data);
		}
		 else {
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}	
	}

	function new_company(){
		if($this->session->userdata('logged_in')){	
		$this->load->model('m_client'); 
		$this->load->model('m_master');
		$session_data 		= $this->session->userdata('logged_in');
		$data['username'] 	= $session_data['username'];
		$data['dept']		= $this->m_master->cek_sysparam('dept_client');

		$this->template->set('title','Klinik | Input Client');
		$this->template->load('template','menu/client', $data);
		}
		 else {
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}	
	}

	function list_company(){
		if($this->session->userdata('logged_in')){	
			
			$this->load->model('m_client'); // load ke model m_registration mst_charge_rule
			
			$session_data 		= $this->session->userdata('logged_in');
			$user_id			= $session_data['id'];	
			$data['username'] 	= $session_data['username'];
			$data['list_data'] 	= $this->m_client->get_mst_client();
			
			$this->template->set('title','Klinik | Input Client');
			$this->template->load('template','menu/list_company', $data);

		}else{
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}	
	}

	function save_client(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$rowC					= $this->input->post('rowC');
		$client_name 			= $this->input->post('client_name');
		// $client_contact_name	= $this->input->post('pat_contact_home').$this->input->post('client_contact_name');
		// $client_phone			= $this->input->post('client_phone').$this->input->post('client_phone2').$this->input->post('client_phone3');
		// $data_client 				= array(
		// 	'id_Client'				=>$this->input->post('id_Client'),
		// 	'client_name'			=>$this->input->post('client_name'),
		// 	'client_pic'			=>$this->input->post('picname'),
		// 	'client_other'			=>$this->input->post('other'),
		// 	'client_address1' 		=>$this->input->post('client_address1'),
		// 	'client_address2'		=>$this->input->post('client_address2'),
		// 	'client_contact_name' 	=>$client_contact_name,
		// 	'client_phone'			=>$client_phone,
		// 	'client_fax' 			=>$this->input->post('client_fax'),
		// 	'client_mobile'			=>$this->input->post('client_mobile'),
		// );
		$data_client 				= array(
			'client_name'			=>$this->input->post('client_name'),
			'client_other'			=>$this->input->post('other'),
			'client_address1' 		=>$this->input->post('client_address1'),
			'client_address2'		=>$this->input->post('client_address2'),
			'client_fax' 			=>$this->input->post('client_fax'),
			'client_mobile'			=>$this->input->post('client_mobile'),
		);
		$this->load->model('m_client'); 
		$this->m_client->save_client($data_client);
		$this->m_client->update_client_code(); // Untuk update client code

		$max_client 				= $this->m_client->get_max_client();
		foreach ($max_client->result() as $row) { $id_client = $row->id_Client; }
	

		for($i=1 ; $i<=$rowC; $i++){				
			$departement		= $this->input->post('dept'.$i.'');
			$namepic			= $this->input->post('namepic'.$i.'');
			$piccont			= $this->input->post('piccont'.$i.'');
			$picother			= $this->input->post('picother'.$i.'');

			// echo $departement; echo "</br>";
			// echo $namepic; echo "</br>";
			// echo $piccont; echo "</br>";
			// echo $picother; echo "</br>";
			// echo $i; echo "</br>";

			$data_insert 		= array(
				'id_client'		=> $id_client,
				'id_dept'		=> $departement,
				'pic_name'		=> $namepic,
				'phone'			=> $piccont,
				'other'			=> $picother,
				'status'		=> 0,
			);
			$this->load->model('m_client'); 
			$this->m_client->save_pic_client($data_insert);  
		}

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$data_log 				= array(
		'id_user'				=>$user_id,
		'log_date'				=>date("Y-m-d H:i:s"),
		'log_desc' 				=>"Create Master Client, id : ".$id_client." , Name ". $client_name,
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log

		redirect('client/add_client/ok');
	}

	function detail_client(){
		if($this->session->userdata('logged_in')){	
			
			$this->load->model('m_client'); // load ke model m_registration mst_charge_rule
			
			$session_data 		= $this->session->userdata('logged_in');
			$user_id			= $session_data['id'];	
			$data['username'] 	= $session_data['username'];
			$id_client 			= $this->uri->segment(3);
			$data['list_data'] 	= $this->m_client->get_mst_client_by_id($id_client);
			
			$this->template->set('title','Klinik | Input Client');
			$this->template->load('template','menu/detail_client', $data);

		}else{
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}	
	}

	function update_client(){
		if($this->session->userdata('logged_in')){	
			
			$this->load->model('m_client'); // load ke model m_registration mst_charge_rule
			
			$session_data 		= $this->session->userdata('logged_in');
			$user_id			= $session_data['id'];	
			$data['username'] 	= $session_data['username'];
			$id_client 			= $this->uri->segment(3);
			$data['list_data'] 	= $this->m_client->get_mst_client_by_id($id_client);
			
			$this->template->set('title','Klinik | Input Client');
			$this->template->load('template','menu/update_client', $data);

		}else{
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}	
	}

	function update_client_process(){
		if($this->session->userdata('logged_in')){	
			
			$this->load->model('m_client'); // load ke model m_registration mst_charge_rule
			
			$session_data 					= $this->session->userdata('logged_in');
			$data['userlevel']				= $session_data['userlevel'];	
			$data['menu_level']				= $session_data['jobs'];	
			$user_id						= $session_data['id'];	
 			$data['username'] 				= $session_data['username'];
			$data['loc'] 					= $session_data['location'];
			$now							= date("Y-m-d H:i:s");
		
			$id_Client		 				= $this->input->post('id_Client');
			$picname						= $this->input->post('picname');
			$finance						= $this->input->post('finance');
			$marketing						= $this->input->post('marketing');
			$client_address1				= $this->input->post('client_address1');
			$client_address2				= $this->input->post('client_address2');
			$client_fax						= $this->input->post('client_fax');
			$client_mobile					= $this->input->post('client_mobile');
			$other	 						= $this->input->post('other');
			$client_name					= $this->input->post('client_name');

		   	$data_update 					= array(
					'id_Client'				=>$this->input->post('id_Client'),
					'client_name'			=>$this->input->post('client_name'),
					'client_pic'			=>$this->input->post('picname'),
					'client_other'			=>$this->input->post('other'),
					'client_address1' 		=>$this->input->post('client_address1'),
					'client_address2'		=>$this->input->post('client_address2'),
					'client_contact_name' 	=>$finance,
					'client_phone'			=>$marketing,
					'client_fax' 			=>$this->input->post('client_fax'),
					'client_mobile'			=>$this->input->post('client_mobile'),
			);
			$this->m_client->update_company($id_Client,$data_update);
			
			echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";

			
		}else {
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}	

	}

	function del_company(){
		if($this->session->userdata('logged_in')){	
			
			$this->load->model('m_client'); // load ke model m_registration mst_charge_rule
			
			$session_data 					= $this->session->userdata('logged_in');
			$data['userlevel']				= $session_data['userlevel'];	
			$data['menu_level']				= $session_data['jobs'];	
			$user_id						= $session_data['id'];	
 			$data['username'] 				= $session_data['username'];
			$data['loc'] 					= $session_data['location'];
			$now							= date("Y-m-d H:i:s");
			$id_Client 						= $this->uri->segment(3);
		
		   	$data_update 					= array(
					'status'				=>1,
			);
			$this->m_client->update_company($id_Client,$data_update);
			
			// $this->template->set('title','Klinik | Input Client');
			// $this->template->load('template','menu/client/del', $data);

			redirect('client/list_company/del');

			
		}else {
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}	

	}

	function add_insurance(){
		if($this->session->userdata('logged_in')){	
		$session_data = $this->session->userdata('logged_in');
		$data['username'] = $session_data['username'];
		
		$this->load->model('m_client'); // load ke model m_registration mst_charge_rule
		$this->template->set('title','Klinik | Input Insurance');
		$this->template->load('template','menu/add_insurance', $data);
		}
		 else {
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}	
	}

	function save_insurance(){
		$session_data 					= $this->session->userdata('logged_in');
		$user_id						= $session_data['id'];	
		$client_contact_name			= $this->input->post('pat_contact_home').$this->input->post('client_contact_name');
		$client_phone					= $this->input->post('client_phone').$this->input->post('client_phone2').$this->input->post('client_phone3');

		$data_client 				= array(
		'ins_name'				=>$this->input->post('client_name'),
		'client_pic'			=>$this->input->post('picname'),
		'client_other'			=>$this->input->post('other'),
		'client_address1' 		=>$this->input->post('client_address1'),
		'client_address2'		=>$this->input->post('client_address2'),
		'client_contact_name' 	=>$client_contact_name,
		'client_phone'			=>$client_phone,
		'client_fax' 			=>$this->input->post('client_fax'),
		'client_mobile'			=>$this->input->post('client_mobile'),
		);

		$this->load->model('m_client'); // go to model/m_registration patien dan kirim array data reg
		$this->m_client->save_insurance($data_client);  // load dari model/function save_registration($data_reg)
		redirect('client/add_insurance/ok');
	}


	function list_Insurance(){
		if($this->session->userdata('logged_in')){	
			
			$this->load->model('m_client'); // load ke model m_registration mst_charge_rule
			
			$session_data 		= $this->session->userdata('logged_in');
			$user_id			= $session_data['id'];	
			$data['username'] 	= $session_data['username'];
			$data['list_data'] 	= $this->m_client->get_mst_insurance();
			
			$this->template->set('title','Klinik | Input Client');
			$this->template->load('template','menu/list_Insurance', $data);

		}else{
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}	
	}

	function detail_insurance(){
		if($this->session->userdata('logged_in')){	
			
			$this->load->model('m_client'); // load ke model m_registration mst_charge_rule
			
			$session_data 		= $this->session->userdata('logged_in');
			$user_id			= $session_data['id'];	
			$data['username'] 	= $session_data['username'];
			$id_client 			= $this->uri->segment(3);
			$data['list_data'] 	= $this->m_client->get_mst_insurance_by_id($id_client);
			
			$this->template->set('title','Klinik | Input Client');
			$this->template->load('template','menu/detail_insurance', $data);

		}else{
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}	
	}


	function update_insurance(){
		if($this->session->userdata('logged_in')){	
			
			$this->load->model('m_client'); // load ke model m_registration mst_charge_rule
			
			$session_data 		= $this->session->userdata('logged_in');
			$user_id			= $session_data['id'];	
			$data['username'] 	= $session_data['username'];
			$id_client 			= $this->uri->segment(3);
			$data['list_data'] 	= $this->m_client->get_mst_insurance_by_id($id_client);
			
			$this->template->set('title','Klinik | Input Client');
			$this->template->load('template','menu/update_insurance', $data);

		}else{
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}	
	}

	function update_insurance_process(){
		if($this->session->userdata('logged_in')){	
			
			$this->load->model('m_client'); // load ke model m_registration mst_charge_rule
			
			$session_data 					= $this->session->userdata('logged_in');
			$data['userlevel']				= $session_data['userlevel'];	
			$data['menu_level']				= $session_data['jobs'];	
			$user_id						= $session_data['id'];	
 			$data['username'] 				= $session_data['username'];
			$data['loc'] 					= $session_data['location'];
			$now							= date("Y-m-d H:i:s");
		
			$id_Client		 				= $this->input->post('id_Client');
			$picname						= $this->input->post('picname');
			$finance						= $this->input->post('finance');
			$marketing						= $this->input->post('marketing');
			$client_address1				= $this->input->post('client_address1');
			$client_address2				= $this->input->post('client_address2');
			$client_fax						= $this->input->post('client_fax');
			$client_mobile					= $this->input->post('client_mobile');
			$other	 						= $this->input->post('other');
			$client_name					= $this->input->post('client_name');

		   	$data_update 					= array(
					'id_ins_comp'			=>$this->input->post('id_Client'),
					'ins_name'				=>$this->input->post('client_name'),
					'client_pic'			=>$this->input->post('picname'),
					'client_other'			=>$this->input->post('other'),
					'client_address1' 		=>$this->input->post('client_address1'),
					'client_address2'		=>$this->input->post('client_address2'),
					'client_contact_name' 	=>$finance,
					'client_phone'			=>$marketing,
					'client_fax' 			=>$this->input->post('client_fax'),
					'client_mobile'			=>$this->input->post('client_mobile'),
			);
			$this->m_client->update_insurance($id_Client,$data_update);
			
			echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";

			
		}else {
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}	

	}

	function del_insurance(){
		if($this->session->userdata('logged_in')){	
			
			$this->load->model('m_client'); // load ke model m_registration mst_charge_rule
			
			$session_data 					= $this->session->userdata('logged_in');
			$data['userlevel']				= $session_data['userlevel'];	
			$data['menu_level']				= $session_data['jobs'];	
			$user_id						= $session_data['id'];	
 			$data['username'] 				= $session_data['username'];
			$data['loc'] 					= $session_data['location'];
			$now							= date("Y-m-d H:i:s");
			$id_Client 						= $this->uri->segment(3);
		
		   	$data_update 					= array(
					'status'				=>1,
			);
			$this->m_client->update_insurance($id_Client,$data_update);
			
			// $this->template->set('title','Klinik | Input Client');
			// $this->template->load('template','menu/client/del', $data);

			redirect('client/list_Insurance/del');

			
		}else {
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}	

	}



 
}
 
?>