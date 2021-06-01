<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Master extends CI_Controller {
 
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


	function list_sysparam(){
	    if($this->session->userdata('logged_in')){
			$this->load->model('m_master');		
			$session_data 			= $this->session->userdata('logged_in');
		    $data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_master->get_list_sysparam();
		    $this->template->set('title','Klinik | List Parameter');
			$this->template->load('template','menu/list_sysparam', $data);
		} else {
	     //If no session, redirect to login page
	     redirect('login', 'refresh');
		}	
	 }

	function list_kriteria(){
	    if($this->session->userdata('logged_in')){
			$this->load->model('m_master');		
			$session_data 			= $this->session->userdata('logged_in');
		    $data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_master->get_kriteria();
		    $this->template->set('title','Klinik | List Parameter');
			$this->template->load('template','menu/list_kriteria', $data);
		} else {
	     //If no session, redirect to login page
	     redirect('login', 'refresh');
		}	
	 }

	function add_new_kriteria(){
	    if($this->session->userdata('logged_in')){
			$this->load->model('m_master');		
			$session_data 			= $this->session->userdata('logged_in');
		    $data['username'] 		= $session_data['username'];
			$data['user_id']		= $session_data['id'];	
		    $this->template->set('title','Klinik | Add Paramter');
			$this->template->load('template','menu/add_new_kriteria', $data);
		} else {
	     //If no session, redirect to login page
	     redirect('login', 'refresh');
		}	
	 }

	function save_add_new_kriteria(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$tgl					= date("Y-m-d");
		$now					= date("Y-m-d H:i:s");
		
		$data_client 				= array(
			'name'				=>$this->input->post('sgroup'),
			'createby'				=>$user_id,
			'createdate'			=>$now,
			'lastby'				=>$user_id,
			'lasupdate'				=>$now,
		);
		$this->load->model('m_master'); 
		$this->m_master->save_kriteria($data_client); 

		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";

	}

 function edit_kriteria(){
	if($this->session->userdata('logged_in')){	
	 $this->load->library('form_validation');
	 $this->load->model('m_user');
	 $id 					 = $this->uri->segment(3);
	 $session_data 			 = $this->session->userdata('logged_in');
	 $data['username']		 = $session_data['username'];
	 $data['user']			 = $this->m_user->get_kriteria_id($id);
	 $data['userx']			 = $this->m_user->get_list_user();
	 $this->template->set('title','Klinik | User Edit');
	 $this->template->load('template','menu/edit_kriteria', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 }

	function cek_sysparam(){
	    if($this->session->userdata('logged_in')){
			$this->load->model('m_master');		
			$data['isi'] 			= $this->uri->segment(3);
			$session_data 			= $this->session->userdata('logged_in');
		    $data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_master->cek_sysparam($data['isi']);
		    $this->template->set('title','Klinik | View Paramter');
			$this->template->load('template','menu/cek_sysparam', $data);
		} else {
	     //If no session, redirect to login page
	     redirect('login', 'refresh');
		}	
	 }
	
	function update_sysparam(){
	    if($this->session->userdata('logged_in')){
			$this->load->model('m_master');		
			$session_data 			= $this->session->userdata('logged_in');
			$id 					= $this->uri->segment(3);
		    $data['username'] 		= $session_data['username'];
			$data['user_id']		= $session_data['id'];	
			$sysparam 				= $this->m_master->view_sysparam($id);
			foreach ($sysparam->result() as $row) {
				$data['id_param'] 	= $row->id;
				$data['isi'] 		= $row->sgroup;
				$data['skey'] 		= $row->skey;
				$data['svalue'] 	= $row->svalue;
				$data['lvalue'] 	= $row->lvalue;
				$data['remark'] 	= $row->remark;
			}
		    $this->template->set('title','Klinik | Update Paramter');
			$this->template->load('template','menu/update_sysparam', $data);
		} else {
	     //If no session, redirect to login page
	     redirect('login', 'refresh');
		}	
	 }

	function update_sysparam_process(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$tgl					= date("Y-m-d");
		$now					= date("Y-m-d H:i:s");
		$id 					= $this->input->post('id_param');
		
		$data_client 				= array(
			'sgroup'				=>$this->input->post('sgroup'),
			'skey'					=>$this->input->post('skey'),
			'svalue'				=>$this->input->post('svalue'),
			'lvalue'				=>$this->input->post('lvalue'),
			'remark'				=>$this->input->post('remark'),
			'updated_time' 			=>$now,
			'updated_by'			=>$user_id,
		);
		$this->load->model('m_master'); 
		$this->m_master->update_sysparam($id,$data_client); 

		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";

	}

	function add_sysparam(){
	    if($this->session->userdata('logged_in')){
			$this->load->model('m_master');		
			$session_data 			= $this->session->userdata('logged_in');
			$data['isi'] 			= $this->uri->segment(3);
		    $data['username'] 		= $session_data['username'];
			$data['user_id']		= $session_data['id'];	
			$cekdata 				= $this->m_master->cek_sysparam($data['isi']);
			$data['jml']			= $cekdata->num_rows()+1;
		    $this->template->set('title','Klinik | Add Paramter');
			$this->template->load('template','menu/add_sysparam', $data);
		} else {
	     //If no session, redirect to login page
	     redirect('login', 'refresh');
		}	
	 }

	function input_sysparam(){
	    if($this->session->userdata('logged_in')){
			$this->load->model('m_master');		
			$session_data 			= $this->session->userdata('logged_in');
			$data['isi'] 			= $this->uri->segment(3);
		    $data['username'] 		= $session_data['username'];
			$data['user_id']		= $session_data['id'];	
			$cekdata 				= $this->m_master->cek_sysparam($data['isi']);
			$data['jml']			= $cekdata->num_rows()+1;
		    $this->template->set('title','Klinik | Add Paramter');
			$this->template->load('template','menu/add_sysparam2', $data);
		} else {
	     //If no session, redirect to login page
	     redirect('login', 'refresh');
		}	
	 }

	function add_new_sysparam(){
	    if($this->session->userdata('logged_in')){
			$this->load->model('m_master');		
			$session_data 			= $this->session->userdata('logged_in');
		    $data['username'] 		= $session_data['username'];
			$data['user_id']		= $session_data['id'];	
		    $this->template->set('title','Klinik | Add Paramter');
			$this->template->load('template','menu/add_new_sysparam', $data);
		} else {
	     //If no session, redirect to login page
	     redirect('login', 'refresh');
		}	
	 }

	function save_add_new_sysparam(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$tgl					= date("Y-m-d");
		$now					= date("Y-m-d H:i:s");
		
		$data_client 				= array(
			'sgroup'				=>$this->input->post('sgroup'),
			'skey'					=>$this->input->post('skey'),
			'svalue'				=>$this->input->post('svalue'),
			'lvalue'				=>$this->input->post('lvalue'),
			'remark'				=>$this->input->post('remark'),
			'created_time' 			=>$now,
			'created_by'			=>$user_id,
		);
		$this->load->model('m_master'); 
		$this->m_master->save_sysparam($data_client); 

		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";

	}

	function save_add_new_sysparam2(){
		$session_data 				= $this->session->userdata('logged_in');
		$user_id					= $session_data['id'];	
		$tgl						= date("Y-m-d");
		$now						= date("Y-m-d H:i:s");
		
		$data_client 				= array(
			'sgroup'				=>$this->input->post('sgroup'),
			'skey'					=>$this->input->post('skey'),
			'svalue'				=>$this->input->post('svalue'),
			'lvalue'				=>$this->input->post('lvalue'),
			'remark'				=>$this->input->post('remark'),
			'created_time' 			=>$now,
			'created_by'			=>$user_id,
		);
		$this->load->model('m_master'); 
		$this->m_master->save_sysparam($data_client); 

		// echo "<script>setTimeout(function () { window.close();}, 1);</script>";

	}

	function update_status(){
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$id 					= $this->uri->segment(3);
		$group 					= $this->uri->segment(4);
		$tgl					= date("Y-m-d");
		$now					= date("Y-m-d H:i:s");
		
		$data_update 				= array(
			'status' 			 	=>1,
			'updated_time' 			=>$now,
			'updated_by'			=>$user_id,
		);
		$this->load->model('m_master'); 
		$this->m_master->update_sysparam($id,$data_update); 

		redirect('master/cek_sysparam/'.$group);

	}

	function list_service_bahasa(){
	    if($this->session->userdata('logged_in')){
			$this->load->model('m_master');		
			$session_data 			= $this->session->userdata('logged_in');
		    $data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_master->get_list_services_bahasa();
			$data['jml'] 			= $data['find']->num_rows();
		    $this->template->set('title','Klinik | List Services');
			$this->template->load('template','menu/list_service_b', $data);
		} else {
	     //If no session, redirect to login page
	     redirect('login', 'refresh');
		}	
	 }

	 function expoert_list_language(){
	    if($this->session->userdata('logged_in')){
			$this->load->model('m_master');		
			$session_data 			= $this->session->userdata('logged_in');
		    $data['username'] 		= $session_data['username'];
		    $data['now']			= date("Y-m-d H:i:s");
			$data['find'] 			= $this->m_master->get_list_services_bahasa_xl();
			$data['tanggal']		= date("m/d/Y");
			$data['id_currency']	= 0;
			$data['amount']			= 0;
			$data['code']			= 0;
			$data['create_by']		= 0;
			$data['create_date']	= 0;
			$this->load->view('menu/expoert_list_language', $data);
		} else {
	     //If no session, redirect to login page
	     redirect('login', 'refresh');
		}	
	 }

	function update_service_japan(){
		$this->load->model('m_master'); 
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$tgl					= date("Y-m-d");
		$now					= date("Y-m-d H:i:s");
		$jml					= $this->input->post('jml');
		$data['kode_tabel']		= $this->uri->segment(3);
		$data['nama_tabel']		= $this->uri->segment(4);
		$data['id_service']		= $this->uri->segment(5);
		
		if ($data['kode_tabel'] == 1) {
			$data['find'] 		= $this->m_master->cek_mst_item_value($data['id_service']); 
			foreach ($data['find']->result() as $row) {
				$data['inggris'] = $row->nama_value;
				$data['jepang'] = $row->nama_value_j;
			}
		}elseif ($data['kode_tabel'] == 2) {
			$data['find'] 		=$this->m_master->cek_mst_lab_item($data['id_service']); 
			foreach ($data['find']->result() as $row) {
				$data['inggris'] = $row->lab_item_desc;
				$data['jepang'] = $row->lab_item_name_j;
			}
		}elseif ($data['kode_tabel'] == 3) {
			$data['find'] 		=$this->m_master->cek_mst_rad_item($data['id_service']); 
			foreach ($data['find']->result() as $row) {
				$data['inggris'] = $row->rad_item;
				$data['jepang'] = $row->rad_item_j;
			}
		}elseif ($data['kode_tabel'] == 4) {
			$data['find'] 		=$this->m_master->cek_mst_services($data['id_service']); 
			foreach ($data['find']->result() as $row) {
				$data['inggris'] = $row->serv_name;
				$data['jepang'] = $row->serv_name_j;
			}
		}elseif ($data['kode_tabel'] == 5) {
			$data['find'] 		=$this->m_master->cek_mst_lab_group($data['id_service']); 
			foreach ($data['find']->result() as $row) {
				$data['inggris'] = $row->group_name;
				$data['jepang'] = $row->group_name_j;
			}
		}elseif ($data['kode_tabel'] == 6) {
			$data['find'] 		=$this->m_master->cek_mst_rad_group($data['id_service']); 
			foreach ($data['find']->result() as $row) {
				$data['inggris'] = $row->group_desc;
				$data['jepang'] = $row->group_desc_j;
			}
		}elseif ($data['kode_tabel'] == 7) {
			$data['find'] 		=$this->m_master->cek_mst_lab_range($data['id_service']); 
			foreach ($data['find']->result() as $row) {
				$data['inggris'] = $row->name_type;
				$data['jepang'] = $row->name_j;
			}
		}

  		$this->template->set('title','Klinik | Update Language');
		$this->template->load('template','menu/update_service_l', $data);

	}

	function update_service_bahasa(){
		$this->load->model('m_master'); 
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];	
		$tgl					= date("Y-m-d");
		$now					= date("Y-m-d H:i:s");
		$kode_tabel				= $this->input->post('kode_tabel');
		$nama_tabel				= $this->input->post('nama_tabel');
		$id						= $this->input->post('id_service');
		$inggris				= $this->input->post('inggris');
		$jepang					= $this->input->post('jepang');

		// echo $kode_tabel; echo "<br>";
		// echo $nama_tabel; echo "<br>";
		// echo $id; echo "<br>";
		// echo $inggris; echo "<br>";
		// echo $jepang; echo "<br>";
		// echo urldecode($inggris); echo "<br>";
		// echo urldecode($jepang); echo "<br>";
		// exit();
		

		if ($kode_tabel == 1) {
			$data_update = array('nama_value_j'=>$jepang,);
			$this->m_master->update_mst_item_value($id,$data_update); 
			echo "masuk nomor 1 <br>";
		}elseif ($kode_tabel == 2) {
			$data_update = array('lab_item_name_j'=>$jepang,);
			$this->m_master->update_mst_lab_item($id,$data_update); 
			echo "masuk nomor 2 <br>";
		}elseif ($kode_tabel == 3) {
			$data_update = array('rad_item_j'=>$jepang,);
			$this->m_master->update_mst_rad_item($id,$data_update); 
			echo "masuk nomor 3 <br>";
		}elseif ($kode_tabel == 4) {
			$data_update = array('serv_name_j'=>$jepang,);
			$this->m_master->update_mst_services($id,$data_update); 
			echo "masuk nomor 4 <br>";
		}elseif ($kode_tabel == 5) {
			$data_update = array('group_name_j'=>$jepang,);
			$this->m_master->update_mst_lab_group($id,$data_update); 
			echo "masuk nomor 5 <br>";
		}elseif ($kode_tabel == 6) {
			$data_update = array('group_desc_j'=>$jepang,);
			$this->m_master->update_mst_rad_group($id,$data_update); 
			echo "masuk nomor 6 <br>";
		}


		// echo "<script>alert('update'); window.close();</script>"; 
		echo "<script>window.close();</script>"; 
		// echo "<script>setTimeout(function () {window.close();}, 1);</script>";
		// redirect('master/list_service_bahasa/'.$group);

	}

	 function view_notes(){
	    if($this->session->userdata('logged_in')){	
		  $this->load->model('m_master');		
		  $group					= $this->uri->segment(3);
		  $id 						= $this->uri->segment(4);
		  $session_data 			= $this->session->userdata('logged_in');
		  $data['username'] 		= $session_data['username'];
		  $note 					= $this->m_master->get_trx_note($group,$id);

		  foreach ($note->result() as $row) {
		  	$data['group_notes']	= $row->group_notes;
			$data['id_order']		= $row->id_order;
			$data['id_reg']			= $row->id_reg;
			$data['id_pat']			= $row->id_pat;
			$data['note']			= $row->note;
			$data['ip_address']		= $row->ip_address;
			$data['created_by']		= $row->created_by;
			$data['created_date']	= $row->created_date;
		  }

		  // $this->load->view('menu/view_notes', $data);
		  $this->template->set('title','Klinik | View Notes');
		  $this->template->load('template','menu/view_notes', $data);
		} else {
		  //If no session, redirect to login page
	      redirect('login', 'refresh');
		}	
	 }

	 function add_notes(){
		if($this->session->userdata('logged_in')){
			$this->load->model('m_master');		
			$session_data 						= $this->session->userdata('logged_in');
			$data['group_notes']				= $this->uri->segment(3);
			$data['id_order']					= $this->uri->segment(4);
			$data['id_reg']						= $this->uri->segment(5);
			$data['user_id']					= $session_data['id'];
		    $data['username'] 					= $session_data['username'];
			$data['ip']							= getenv('REMOTE_ADDR');
			$data['kodenya']					= 0;
			// $data['notes']						= $_POST['variable'];

			if ($data['group_notes'] == 1 || $data['group_notes'] == 2) {
				
				$pat_data							= $this->m_master->get_patient2($data['id_reg']);
				$data['kodenya'] 					= $data['id_reg'];
				foreach ($pat_data->result() as $row) {
					$data['reg_date']				= $row->reg_date;
					$data['id_pat']					= $row->id_pat;
					$data['pat_charge_rule']		= $row->pat_charge_rule;
					$data['pat_name']				= $row->pat_name;
					$data['pat_gender']				= $row->pat_gender;
					$data['pat_dob']				= $row->pat_dob;
				}

			}elseif ($data['group_notes'] == 3 || $data['group_notes'] == 5) {

				$cek_pr 							= $this->m_master->get_pr($data['id_order']);
				foreach ($cek_pr->result() as $row) {
					$data['id_pr_no']				= $row->id_pr_no;
					$data['pr_no']					= $row->pr_no;
					$data['pr_date']				= $row->pr_date;
					$data['is_finalized']			= $row->is_finalized;
					$data['user_id']				= $row->user_id;
					$data['user_app']				= $row->user_app;
					$data['dept_id']				= $row->dept_id;
					$data['create_date']			= $row->create_date;
				}

				$data['kodenya'] 					= $data['pr_no'];
				$data['id_reg']						= 0;
				$data['reg_date']					= 0;
				$data['id_pat']						= 0;
				$data['pat_charge_rule']			= 0;
				$data['pat_name']					= 0;
				$data['pat_gender']					= 0;
				$data['pat_dob']					= 0;
			}
				
			$this->template->set('title','Klinik | Add Notes');
			$this->template->load('template','menu/add_notes', $data);
		} else {
	     //If no session, redirect to login page
	     redirect('login', 'refresh');
		}	
	 } 

	 function save_notes(){
		if($this->session->userdata('logged_in')){
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];	
		    $username				= $session_data['username'];
			$now					= date("Y-m-d H:i:s");
			$tanggal				= date("m/d/Y");
			$group_notes			= $this->input->post('group_notes');
			$id_order				= $this->input->post('id_order');
			$id_reg					= $this->input->post('id_reg');
			$id_pat					= $this->input->post('id_pat');
			$ip						= $this->input->post('ip');
			$notes					= $this->input->post('notes');
			
			//Insert Notes..
			$data_process 		= array(
	            'group_notes'	=> $group_notes,
				'id_order'		=> $id_order,
				'id_reg'		=> $id_reg,
				'id_pat'		=> $id_pat,
				'note'			=> $notes,
				'ip_address'	=> $ip,
				'created_by'	=> $user_id,
				'created_date'	=> $now,
	        );
	        $this->load->model('m_master');
	        $this->m_master->save_trx_notes($data_process);
			//Endless Insert

			if ($group_notes == 1 || $group_notes == 2) {

				//Update status Cancel..
				$data_process 		= array(
		            'order_status'  =>3,
		        );
	        	$this->load->model('m_lab');
		        $this->m_lab->status_order($data_process,$id_order);
				//Endless Update
				
				//Create Log Start
				$session_data 			= $this->session->userdata('logged_in');
			    $now					= date("Y-m-d H:i:s");
				$user_id				= $session_data['id'];	
				$data_log = array(
							'id_user'	=>$user_id,
							'log_date'	=>$now,
							'log_desc' 	=>"Delete Order Lab, table pat_order_h id : ".$id_order."",
				);
				$this->load->model('m_login');
				$this->m_login->log($data_log);
				//Endless Log

			}elseif ($group_notes == 3 ) {

				$data_app 				= array(
					'is_finalized'		=>2,
					'user_app'			=>$user_id,
				);
				$this->load->model('m_inv');
				$this->m_inv->app_pr($id_order,$data_app);


				//Create Log Start
				$session_data 			= $this->session->userdata('logged_in');
			    $now					= date("Y-m-d H:i:s");
				$user_id				= $session_data['id'];	
				$data_log = array(
							'id_user'	=>$user_id,
							'log_date'	=>$now,
							'log_desc' 	=>"Reject Purchase Request, id : ".$id_order."",
				);
				$this->load->model('m_login');
				$this->m_login->log($data_log);
				//Endless Log

			}elseif ($group_notes == 5 ) {

				$data_app 				= array(
					'is_finalized'		=>5,
					'user_app'			=>$user_id,
				);
				$this->load->model('m_inv');
				$this->m_inv->app_pr($id_order,$data_app);


				//Create Log Start
				$session_data 			= $this->session->userdata('logged_in');
			    $now					= date("Y-m-d H:i:s");
				$user_id				= $session_data['id'];	
				$data_log = array(
							'id_user'	=>$user_id,
							'log_date'	=>$now,
							'log_desc' 	=>"Close Purchase Request, id : ".$id_order."",
				);
				$this->load->model('m_login');
				$this->m_login->log($data_log);
				//Endless Log

			}

			echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
		} else {
	     //If no session, redirect to login page
	     redirect('login', 'refresh');
		}	

	 }
 

	 function sys_result(){
	    if($this->session->userdata('logged_in')){
			$this->load->model('m_master');		
			$session_data 			= $this->session->userdata('logged_in');
		    $data['username'] 		= $session_data['username'];
			$data['level']			= $session_data['userlevel'];
		    $data['now']			= date("Y-m-d H:i:s");
			$data['tanggal']		= date("m/d/Y");

			// SYS lab ...
			$arr_tbl				= array();
			$arr_idpat				= array();
			$arr_idreg				= array();
			$arr_idlab				= array();
			$find 					= $this->m_master->find_labresult_idrange_null();
			$find_row 				= $find->num_rows();
			if ($find_row > 0) { //Jika tidak ada range
				foreach ($find->result() as $row) {
					$arr_tbl[] 			= $row->id_lab_result;
					$arr_idpat[] 		= $row->id_pat;
					$arr_idreg[] 		= $row->id_reg;
					$arr_idlab[] 		= $row->id_lab_item;
				}
				$arr_jumlah 			= count($arr_idpat);
				for ($i=0; $i <$arr_jumlah ; $i++) { 
					// echo "test".$i."<br>";
					$cek_pat = $this->m_master->get_patient($arr_idpat[$i]);
					foreach ($cek_pat->result() as $row) {
						$birth 	= $row->pat_dob;
						$gender = $row->pat_gender;
						//Function Convertion Age to Months
						$birthday = new DateTime($birth);
						$diff = $birthday->diff(new DateTime());
						$months = $diff->format('%m') + 12 * $diff->format('%y');
						//End of Function
					}

					$ambil_range 		= $this->m_master->get_lab_range($arr_idlab[$i],$gender,$months);
					$ambil_range_jml	= $ambil_range->num_rows();
					$id_lab_item_range 	= 0;
					$nama_type 			= null;
					foreach ($ambil_range->result() as $row) {
						$id_lab_item_range 	= $row->id_lab_item_range;
						if (isset($row->nama_type)) {$nama_type = "test";}
					}
					echo $id_lab_item_range."<br>";
					echo $nama_type."<br>";
					if ($ambil_range_jml > 0) {
						$data_update = array('id_lab_range' => $id_lab_item_range,);
						$this->m_master->update_pat_lab_result($arr_tbl[$i],$data_update); 
						$id_lab_item_range 	= 0;
					}

				}

				// echo "<pre>";
				// print_r($arr_tbl);
				// print_r($arr_idpat);
				// print_r($arr_idreg);
				// print_r($arr_idlab);
				// echo "</pre>";
			} // batas pencarian range...

			$group_lab				= $this->m_master->sys_group_lab(); //singkron group result dari mst_lab_item...
			$std_value				= $this->m_master->sys_stdvalue_lab(); //singkron range...
			// BATAS SYS lab ...
			$std_value				= $this->m_master->sys_namavalue_rad(); //singkron rad nama value...
			echo "<script>alert('update successfully!'); window.close();</script>"; 

		} else {
	     //If no session, redirect to login page
	     redirect('login', 'refresh');
		}	
	 }

	 function view_detail_pr(){
	    if($this->session->userdata('logged_in')){	
		  $id = $this->uri->segment(3);
		  $this->load->model('m_inv');		
		  $this->load->model('m_master');		
		  $session_data 			= $this->session->userdata('logged_in');
		  $data['username'] 		= $session_data['username'];
		  $data['data'] 			= $this->m_inv->get_pr_header($id);
		  $data['main'] 			= $this->m_inv->get_pr_main($id);
		  $vnote 					= $this->m_master->get_trx_note(4,$id);
		  $jnote 					= $vnote->num_rows();
		  $is_status 				= $this->m_master->get_sysparam('is_status','trx_item_pr_d');
	  	  $data['skey'] 			= array();
	  	  $data['svalue'] 			= array();
	  	  $data['lvalue'] 			= array();

		  foreach ($is_status->result() as $row) {
		  	$data['skey'][]			= $row->skey;
		  	$data['svalue'][]		= $row->svalue;
		  	$data['lvalue'][]		= $row->lvalue;
		  }

		  if ($jnote > 0) {

			foreach ($vnote->result() as $row) {
				$data['group_notes']	= $row->group_notes;
				$data['id_order']		= $row->id_order;
				$data['id_reg']			= $row->id_reg;
				$data['id_pat']			= $row->id_pat;
				$data['note']			= $row->note;
				$data['ip_address']		= $row->ip_address;
				$data['created_by']		= $row->created_by;
				$data['created_date']	= $row->created_date;
			}

		  }else{
		  		$data['group_notes']	= "";
				$data['id_order']		= "";
				$data['id_reg']			= "";
				$data['id_pat']			= "";
				$data['note']			= "";
				$data['ip_address']		= "";
				$data['created_by']		= "";
				$data['created_date']	= "";
		  }



		  // $this->load->view('menu/view_detail_pr', $data);
		  $this->template->set('title','Klinik | View Notes');
		  $this->template->load('template','menu/view_detail_pr', $data);
		} else {
		  //If no session, redirect to login page
	      redirect('login', 'refresh');
		}	
	 }

	 function del_pr_item(){
	 	if($this->session->userdata('logged_in')){	
		  $this->load->model('m_inv');		
		  $session_data 			= $this->session->userdata('logged_in');
		  $data['username'] 		= $session_data['username'];
		  $now						= date("Y-m-d H:i:s");
		  $user_id					= $session_data['id'];	
		  $pr_id 					= $this->input->post('pr_id');
		  $pr_no 					= $this->input->post('pr_no');
		  $notes 					= $this->input->post('notes');
		  $id_pr_d 					= $this->input->post('id_pr_d[]');
		  $jml 						= count($id_pr_d);
		  $ip						= getenv('REMOTE_ADDR');

		  for ($i=0; $i < $jml ; $i++) { 
		  
			// update tabel trx_item_pr_d		    
			$update_detail 		= array(
			'is_status'			=>3,
			);
			$this->load->model('m_inv');
			$this->m_inv->update_trx_item_pr_d($id_pr_d[$i],$update_detail);
			//Endless Log


				//Create Log Start
				$session_data 			= $this->session->userdata('logged_in');
			    $now					= date("Y-m-d H:i:s");
				$user_id				= $session_data['id'];	
				$data_log = array(
							'id_user'	=>$user_id,
							'log_date'	=>$now,
							'log_desc' 	=>"Update Detail Purchase Request, id : ".$pr_id."",
				);
				$this->load->model('m_login');
				$this->m_login->log($data_log);
				//Endless Log
	
		  }
		  
		  //Insert Notes..
			$data_process 		= array(
	            'group_notes'	=> 4,
				'id_order'		=> $pr_id,
				'id_reg'		=> "",
				'id_pat'		=> "",
				'note'			=> $notes,
				'ip_address'	=> $ip,
				'created_by'	=> $user_id,
				'created_date'	=> $now,
	        );
	        $this->load->model('m_master');
	        $this->m_master->save_trx_notes($data_process);
			//Endless Insert


		  echo "<script>alert('delete successfully!'); window.close();</script>"; 
		} else {
		  //If no session, redirect to login page
	      redirect('login', 'refresh');
		}	
	 }

	 function log_user(){
	  if($this->session->userdata('logged_in')){	
		$this->load->model('m_master');			
		$session_data 			= $this->session->userdata('logged_in');
		$data['username'] 		= $session_data['username'];
		$id				 		= $session_data['jobs'];
		$level					= $session_data['userlevel'];
		$data['list'] 			= $this->m_master->get_list_log();

		$this->template->set('title','Klinik | Log User');
		$this->template->load('template','menu/log_user', $data);
	 } else {				
		  //If no session, redirect to login page
	      redirect('login', 'refresh');
		}	
	 }



}
?>