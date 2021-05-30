<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Docter extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_docter');
		$this->load->model('m_registration');
		$this->load->model('m_lab');
		$this->load->model('m_login');
	}

	function index()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$this->load->view('menu/index.php', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function update_lab()
	{
		$id  = $this->uri->segment(3);
		$idx = $this->uri->segment(4);
		$session_data 			= $this->session->userdata('logged_in');
		$user						= $session_data['id'];
		$data 					= array(
			'status' 				=> 1,
		);
		$data['data'] 			= $this->m_docter->update_check($id, $idx, $data);
	}

	public function docter_order()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data 		= $this->session->userdata('logged_in');
			$data['username'] 	= $session_data['username'];

			$data['arr_services'] = $this->m_docter->get_list_service();

			$this->template->set('title', 'Klinik | Doctor Order');
			$this->template->load('template', 'menu/docter_order', $data);
		} else {
			redirect('login', 'refresh');
		}
	}

	public function docter_order_backup()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data 		= $this->session->userdata('logged_in');
			$data['username'] 	= $session_data['username'];
			$loc 	 			= $session_data['location'];
			$this->template->set('title', 'Klinik | Doctor Order');
			$this->template->load('template', 'menu/docter_order_backup', $data);
		} else {
			redirect('login', 'refresh');
		}
	}

	public function doctor_order_act()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data 		= $this->session->userdata('logged_in');
			$data['username'] 	= $session_data['username'];
			$branch 	 		= $session_data['location'];
			$type				= $this->input->post('type');
			$id_reg			    = $this->input->post('id_reg');
			$data['soap'] 		= $this->m_docter->get_soap($id_reg);
			$data['lab_item'] 	= $this->m_docter->get_mst_lab_item($branch, $type, $id_reg);
			$data['group_item'] = $this->m_docter->get_mst_group_item();
			$data['rad_item']	= $this->m_docter->get_mst_rad_item($branch, $type, $id_reg);
			$data['others']	  	= $this->m_docter->get_other_service($branch, $type, $id_reg);
			$data['mcu']	 	= $this->m_registration->get_mst_service_package_h();
			$data['last_order'] = $this->m_docter->get_last_order($branch, $type, $id_reg);
			$data['last_presc'] = $this->m_docter->get_last_presc($branch, $type, $id_reg);

			$this->template->set('title', 'Klinik | Doctor Order');
			$this->template->load('template', 'menu/doctor_order_act', $data);
		} else {
			redirect('login', 'refresh');
		}
	}

	function find_services_2()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$id			 			= $this->uri->segment(3);
			$data['find'] 			= $this->m_quotation->get_list_services_2($id);
			$this->template->set('title', 'Klinik | Find Services');
			$this->template->load('template', 'menu/find_services_2', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function mst_item_value()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$this->load->model('m_inv');
			$this->load->model('m_patient');

			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['accno']			= $this->m_inv->get_list_coa();
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group_2();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			$data['pay_type'] 		= $this->m_quotation->get_type();
			$data['branch'] 		= $this->m_quotation->get_branch();
			$data['gender'] 		= $this->m_patient->get_list_gender();
			$data['find'] 			= $this->m_quotation->get_list_services_all();
			$this->template->set('title', 'Klinik | Master Item Value');
			$this->template->load('template', 'menu/mst_item_value', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function save_item_value()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$split			 		= explode(":", $this->input->post('grp_services'));
		$rowC					= $this->input->post('count_ant');
		$filter					= $this->input->post('gender');
		//if($rowC==""){
		//	$rowC="1";
		//}else{
		//	$rowC=$rowC;
		//}


		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_log = array(
			'id_user'						=> $user_id,
			'log_date'						=> date("Y-m-d"),
			'log_desc' 						=> "Create Master Item Value : " . $this->input->post('serv_name') . "",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log

		//echo $rowC;
		//die();
		if ($filter == "yes") {
			for ($i = 1; $i <= $rowC; $i++) {
				$sql_1 = "INSERT INTO mst_item_value (id_group_serv, id_service, nama_value, range_age_1, range_age_2, limit_1, limit_2, gender, formula, create_by, unit) VALUES ('" . $split[0] . "', '" . $this->input->post('serv_id') . "', '" . $this->input->post('nama_val_' . $i . '') . "', '" . $this->input->post('range_1_' . $i . '') . "', '" . $this->input->post('range_2_' . $i . '') . "', '" . $this->input->post('limit_1_' . $i . '') . "', '" . $this->input->post('limit_2_' . $i . '') . "', '1', '0', '" . $user_id . "','" . $this->input->post('unit_' . $i . '') . "')";
				$this->db->query($sql_1);

				$sql_2 = "INSERT INTO mst_item_value (id_group_serv, id_service, nama_value, range_age_1, range_age_2, limit_1, limit_2, gender, formula, create_by, unit) VALUES ('" . $split[0] . "', '" . $this->input->post('serv_id') . "', '" . $this->input->post('nama_val_' . $i . '') . "', '" . $this->input->post('range_1_' . $i . '') . "', '" . $this->input->post('range_2_' . $i . '') . "', '" . $this->input->post('limit_1_' . $i . '') . "', '" . $this->input->post('limit_2_' . $i . '') . "', '2', '0', '" . $user_id . "','" . $this->input->post('unit_' . $i . '') . "')";
				$this->db->query($sql_2);
			}
		} else {
			for ($i = 1; $i <= $rowC; $i++) {
				$sql = "INSERT INTO mst_item_value (id_group_serv, id_service, nama_value, range_age_1, range_age_2, limit_1, limit_2, gender, formula, create_by, unit) VALUES ('" . $split[0] . "', '" . $this->input->post('serv_id') . "', '" . $this->input->post('nama_val_' . $i . '') . "', '" . $this->input->post('range_1_' . $i . '') . "', '" . $this->input->post('range_2_' . $i . '') . "', '" . $this->input->post('limit_1_' . $i . '') . "', '" . $this->input->post('limit_2_' . $i . '') . "', '" . $this->input->post('gender') . "', '0', '" . $user_id . "','" . $this->input->post('unit_' . $i . '') . "')";
				$this->db->query($sql);
			}
		}
		redirect('docter/mst_item_value/ok');
	}

	function list_item_value()
	{
		if ($this->session->userdata('logged_in')) {

			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['list']			= $this->m_docter->get_list_item_value();


			$this->template->set('title', 'Klinik | List Item Value');
			$this->template->load('template', 'menu/list_item_value', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function list_item_value_input()
	{
		if ($this->session->userdata('logged_in')) {

			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['list']			= $this->m_docter->get_list_item_value();


			$this->template->set('title', 'Klinik | List Item Value Input');
			$this->template->load('template', 'menu/list_item_value_input', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function update_item_value()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$this->load->model('m_inv');
			$this->load->model('m_patient');

			$id 					= $this->uri->segment(3);
			$session_data 			= $this->session->userdata('logged_in');
			$data['id_item_value']	= $id;
			$data['username'] 		= $session_data['username'];
			$data['accno']			= $this->m_inv->get_list_coa();
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group_2();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			$data['pay_type'] 		= $this->m_quotation->get_type();
			$data['branch'] 		= $this->m_quotation->get_branch();
			$data['gender'] 		= $this->m_patient->get_list_gender();
			$data['find'] 			= $this->m_quotation->get_list_services_all();
			$list					= $this->m_docter->get_list_item_value_by_id($id);

			foreach ($list->result() as $value) {
				$data['id_group_serv']	= $value->id_group_serv;
				$data['group_seq_no']	= $value->group_seq_no;
				$data['id_service']		= $value->id_service;
				$data['serv_name']		= $value->serv_name;
				$data['nama_value']		= $value->nama_value;
				$data['range_age_1']	= $value->range_age_1;
				$data['range_age_2']	= $value->range_age_2;
				$data['limit_1']		= $value->limit_1;
				$data['limit_2']		= $value->limit_2;
				$data['group_desc']		= $value->group_desc;
				$data['jk']				= $value->gender;
				$data['unit'] 			= $value->unit;
			}



			$this->template->set('title', 'Klinik | Master Item Value');
			$this->template->load('template', 'menu/update_item_value', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function process_update_item_value()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$split			 		= explode(":", $this->input->post('grp_services'));
		$id_item_value			= $this->input->post('id_item_value');

		$data_udpate			= array(
			'id_group_serv'		=> $split[0],
			'id_service'		=> $this->input->post('serv_id'),
			'nama_value'		=> $this->input->post('nama_val_1'),
			'range_age_1'		=> $this->input->post('range_1_1'),
			'range_age_2'		=> $this->input->post('range_2_1'),
			'limit_1'			=> $this->input->post('limit_1_1'),
			'limit_2'			=> $this->input->post('limit_2_1'),
			'gender'			=> $this->input->post('gender'),
			'unit' 				=> $this->input->post('unit_1'),
		);

		$this->m_docter->update_item_value($id_item_value, $data_udpate);

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_log = array(
			'id_user'						=> $user_id,
			'log_date'						=> date("Y-m-d"),
			'log_desc' 						=> "Update Master Item Value, ID : " . $this->input->post('id_item_value') . "",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log

		// redirect('docter/mst_item_value/upd');


		echo "<script>
				setTimeout(function () { 
					    window.opener.location = 'list_item_value/upd';
					    window.close();
				}, 1);
		</script>";
	}



	function del_item_value()
	{
		$id 		= $this->uri->segment(3);
		$data_app 	= array('is_active'	=> 1,);
		$this->m_docter->update_item_value($id, $data_app);
		// kembalikan ke halaman user
		redirect('/docter/list_item_value');
	}

	function doctor_order_list()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data 				= $this->session->userdata('logged_in');
			$data['username'] 			= $session_data['username'];
			$act						= $this->input->post('act');
			$id_reg1					= $this->input->post('id_reg1');
			$id_reg2					= $this->input->post('id_reg2');
			$datereg1					= $this->input->post('datereg1');
			$datereg2					= $this->input->post('datereg2');
			$loc 	 					= $session_data['location'];
			$id 					= $this->uri->segment(3);

			//--- Search and Print ----------//

			if ($act == "View") {
				if (!empty($id_reg1) && !empty($id_reg2)) {

					$data['data'] = $this->m_docter->viewid_dokter_order_list($id_reg1, $id_reg2);
					$this->template->set('title', 'Klinik | Doctor Order List');
					$this->template->load('template', 'menu/order_list', $data);
				} elseif (!empty($datereg1) && !empty($datereg2)) {

					$data['data'] = $this->m_docter->viewdate_dokter_order_list($datereg1, $datereg2);
					$this->template->set('title', 'Klinik | Doctor Order List');
					$this->template->load('template', 'menu/order_list', $data);
				}
			} elseif ($act == "Print") {
				echo "Print ieu teh";
				$data['data'] = $this->m_docter->get_dokter_order_list($id);
				$this->template->set('title', 'Klinik | Doctor Order List');
				$this->template->load('template', 'menu/order_list', $data);
			} else {
				$data['data'] = $this->m_docter->get_dokter_order_list($id);
				$this->template->set('title', 'Klinik | Doctor Order List');
				$this->template->load('template', 'menu/order_list', $data);
			}

			//---End Search and Print ----------//

			//$data['recordsearch'] 			= $this->m_docter->search_dokter_order_list($id_reg1,$id_reg2,$datereg1,$datereg2);

		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function doctor_order_list_excel()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data 				= $this->session->userdata('logged_in');
			$data['username'] 			= $session_data['username'];
			$act						= $this->input->post('act');
			$id_reg1					= $this->input->post('id_reg1');
			$id_reg2					= $this->input->post('id_reg2');
			$datereg1					= $this->input->post('datereg1');
			$datereg2					= $this->input->post('datereg2');
			$loc 	 					= $session_data['location'];
			$id 						= $this->uri->segment(3);
			$data['data'] 				= $this->m_docter->get_dokter_order_list($id);
			$this->load->view('menu/doctor_order_list_excel', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	function doctor_order_report()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$loc 	 = $session_data['location'];
			$id 						= $this->uri->segment(3);
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['data'] 			= $this->m_docter->get_rad_order($id);
			$this->template->set('title', 'Klinik | Radiology Order List');
			$this->template->load('template', 'menu/doctor_order_report', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	function view_list_order()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$loc 	 = $session_data['location'];
			$id 						= $this->uri->segment(3);
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['data'] 			= $this->m_docter->get_rad_order($id);
			$this->template->set('title', 'Klinik | Radiology Order List');
			$this->template->load('template', 'menu/view_list_order', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	public function print_list_order()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$loc 	 = $session_data['location'];
			$id_reg 						= $this->uri->segment(3);
			$session_data 					= $this->session->userdata('logged_in');
			$data['username'] 				= $session_data['username'];
			$data['data'] 					= $this->m_docter->print_list_order($id_reg);
			$data['find'] 					= $this->m_docter->get_trx($id_reg);
			$data['detaillab'] 				= $this->m_docter->print_detaillab_order($id_reg);
			$data['detailgrp'] 				= $this->m_docter->print_detailgrp_order($id_reg);
			$data['detailrad'] 				= $this->m_docter->print_detailrad_order($id_reg);
			$data['detailusg'] 				= $this->m_docter->print_detailusg_order($id_reg);
			$data['detailPhar'] 			= $this->m_docter->print_detailphar_order($id_reg);
			$data['detailother'] 			= $this->m_docter->print_detailother_order($id_reg);
			$id_package						= array();
			foreach ($data['find']->Result() as $row) {
				$id_package = $row->id_package;
			}
			$data['detailmcu']	 			= $this->m_docter->print_mcu($id_reg, $id_package);

			$arr_odo = $this->m_docter->get_data_odo($id_reg);
			$data['arr_odo'] = $arr_odo;

			$this->template->set('title', 'Klinik | Radiology Order List');
			$this->load->view('menu/print_list_order', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi load Action Radiology
	function rad_act()
	{
		if ($this->session->userdata('logged_in')) {
			$id = 4;
			$this->load->model('m_rad');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['data'] 			= $this->m_lab->get_lab_act_h($id);
			$data['detail'] 			= $this->m_rad->get_rad_act_d($id);
			$this->template->set('title', 'Klinik | Radiology Process');
			$this->load->view('menu/print_list_order', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi Simpan Doctor Order
	function save_order_lab()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$rowC					= $this->input->post('rowC');
			$rowService				= $this->input->post('rowC_ser');
			$rowMCU					= $this->input->post('rowC_mcu');
			$rowGRP					= $this->input->post('rowC_grp');


			$parameter_soap  = $this->input->post('s') . $this->input->post('o') . $this->input->post('a') . $this->input->post('p');
			$parameter_soap_1 = $this->input->post('s1') . $this->input->post('o1') . $this->input->post('a1') . $this->input->post('p1');
			$parameter_lab	 = $this->input->post('lab_1');
			$parameter_rad	 = $this->input->post('rad_1');
			$parameter_par	 = $this->input->post('item[1]');
			$parameter_ser	 = $this->input->post('ser_1');
			$parameter_mcu	 = $this->input->post('mcu_1');
			$parameter_grp	 = $this->input->post('grp_1');
			$id_reg	 		 = $this->input->post('id_reg');
			$pilih	 		 = $this->input->post('satu');
			$odo 			 = implode(",", $pilih);

			if ($parameter_ser == "") {

				echo "<script>alert('Gagal Simpan, Wajib isi odontogram dan service'); 
							window.location.href = ('" . base_url() . "docter/docter_order');	
					  </script>";
				// window.history.back();
				exit();
			}

			if ($parameter_lab != "") {
				$data_lab			= array(
					'id_reg'		=> $this->input->post('id_reg'),
					'id_pat'		=> $this->input->post('id_pat'),
					'order_type'	=> 1,
					'order_date'	=> date("Y-m-d H:i:s"),
					'order_status'	=> 1,
					'user_id'		=> $user_id,
				);

				$this->m_docter->order_lab_h($data_lab);
				include './design/koneksi/file.php';

				$query 		= "SELECT id_order id FROM pat_order_h ORDER BY id_order DESC LIMIT 1";
				mysqli_query($con, "DELETE FROM mst_odo WHERE id_reg ='" . $id_reg . "' ");
				mysqli_query($con, "INSERT INTO mst_odo (id_reg, odo_value) VALUES ('" . $id_reg . "','" . $odo . "' ");
				if ($result 	= mysqli_query($con, $query)) {
					$row 	= mysqli_fetch_assoc($result);
					$count 	= $row['id'];
				} else {
					$row 	= mysqli_fetch_assoc($result);
					$count 	= 1;
				}

				for ($i = 1; $i <= $rowC; $i++) {
					$uservalue = $this->input->post('lab_' . $i . '');
					$uservalue = explode(":", $uservalue);
					if ($uservalue[0] != "") {
						$sqlfilter = "select * from pat_order_h a inner join pat_order_d b on a.id_order=b.id_order_header where id_service='" . $uservalue[0] . "' and id_reg='" . $this->input->post('id_reg') . "' and  status<>'1' ";
						if ($result_filter 	= mysqli_query($con, $sqlfilter)) {
							$num_rows 		= mysqli_num_rows($result_filter);

							if ($num_rows == 0) {
								$row 			= mysqli_fetch_assoc($result_filter);
								$sql 			= "INSERT INTO pat_order_d (id_order_header, id_service, seq_no, service_qty, id_dr, acct_code) VALUES ('" . $count . "', '" . $uservalue[0] . "', '1', '1', '" . $user_id . "','1')";
								$this->db->query($sql);

								$query_smart = "SELECT * FROM mst_service_price where id_service='" . $uservalue[1] . "' and price_type='" . $this->input->post('type') . "' ";

								if ($resultx 	= mysqli_query($con, $query_smart)) {
									$num_rowsx  	= mysqli_num_rows($resultx);

									if ($num_rowsx == 0) {
										$sql 	= "INSERT INTO smart_notification (id_reg, id_trouble, type_id, notes, id_source_trouble) VALUES ('" . $this->input->post('id_reg') . "', '" . $uservalue[0] . "', '1', 'Harga Lab', '" . $this->input->post('type') . "')";
										$this->db->query($sql);
									}
								} else {
								}
							} elseif ($num_rows != 0) {
								$sqlfilter1 = "select * from pat_order_h a inner join pat_order_d b on a.id_order=b.id_order_header where id_order='" . $count . "' and id_reg='" . $this->input->post('id_reg') . "' ";
								if ($result_filter1 	= mysqli_query($con, $sqlfilter1)) {
									$num_rowx 		= mysqli_num_rows($result_filter1);
								}

								if ($rowC <= 1) {
									$sqlfilter = "delete from pat_order_h where id_order='" . $count . "' and id_reg='" . $this->input->post('id_reg') . "' ";
									if ($result_filter 	= mysqli_query($con, $sqlfilter)) {
									}
								}
								echo	"<script>alert('Sorry, this service " . $uservalue[1] . " already exists for " . $this->input->post('id_reg') . "'); history.back(-2);</script>";
								//header("Location: ".base_url()."docter/docter_order");
								die();
							}
						} else {
						}

						//die();
						//Secho $this->db->affected_rows();
					} else {
					}
				}
			}

			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data_log = array(
				'id_user'						=> $user_id,
				'log_date'						=> date("Y-m-d"),
				'log_desc' 						=> "Create Order Lab from Doctor  : " . $this->input->post('id_reg') . "",
			);

			$this->m_login->log($data_log);
			//Endless Log

			// Insert For Rontgen
			$rowRont				= $this->input->post('rowC_rad');
			$data_rad				= array(
				'id_reg'		=> $this->input->post('id_reg'),
				'id_pat'		=> $this->input->post('id_pat'),
				'order_type'    => 2,
				'order_date'	=> date("Y-m-d H:i:s"),
				'order_status'	=> 1,
				'user_id'		=> $user_id,
			);

			if ($parameter_rad != "") {
				$this->m_docter->order_lab_h($data_rad);

				include './design/koneksi/file.php';
				$query 		= "SELECT id_order id FROM pat_order_h ORDER BY id_order DESC LIMIT 1";
				if ($result 	= mysqli_query($con, $query)) {
					$row 	= mysqli_fetch_assoc($result);
					$count 	= $row['id'];
				} else {
					$count 	= 1;
				}

				for ($ii = 1; $ii <= $rowRont; $ii++) {
					$uservalue_rad = $this->input->post('rad_' . $ii . '');
					$uservalue_rad = explode(":", $uservalue_rad);

					if ($uservalue_rad[0] != "") {
						$sql = "INSERT INTO pat_order_d (id_order_header, id_service, seq_no, service_qty, id_dr, acct_code) VALUES ('" . $count . "', '" . $uservalue_rad[0] . "', '1', '1','" . $user_id . "','1')";

						$sqlfilter = "select * from pat_order_h a inner join pat_order_d b on a.id_order=b.id_order_header where id_service='" . $uservalue_rad[0] . "' and id_reg='" . $this->input->post('id_reg') . "' and  status<>'1' ";
						if ($result_filter 	= mysqli_query($con, $sqlfilter)) {
							$num_rows 		= mysqli_num_rows($result_filter);


							if ($num_rows == 0) {
								//echo "tes";
								//die();
								$this->db->query($sql);

								$query_smart_rad = "SELECT * FROM mst_service_price where id_service='" . $uservalue_rad[1] . "' and price_type='" . $this->input->post('type') . "' ";
								//echo $query_smart_rad;
								//die();
								if ($resultrad 	= mysqli_query($con, $query_smart_rad)) {
								}
								$num_rowsrad  	= mysqli_num_rows($resultrad);
								if ($num_rowsrad == "") {
									$sql 	= "INSERT INTO smart_notification (id_reg, id_trouble, type_id, notes, id_source_trouble) VALUES ('" . $this->input->post('id_reg') . "', '" . $uservalue_rad[0] . "', '2', 'Harga Radiology', '" . $this->input->post('type') . "')";
									$this->db->query($sql);
									//echo "okke deh";
								}

								//die();
							} else {
								echo	"<script>alert('Sorry, this service " . $uservalue_rad[1] . " already exists for " . $this->input->post('id_reg') . "'); history.back(-1);</script>";
								//header("Location: ".base_url()."docter/docter_order");
								die();
							}
						}
					}
				}
			}

			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data_log = array(
				'id_user'						=> $user_id,
				'log_date'						=> date("Y-m-d"),
				'log_desc' 						=> "Create Order Rontgen from doctor  : " . $this->input->post('id_reg') . "",
			);
			$this->m_login->log($data_log);
			//Endless Log

			if ($parameter_par != "") {
				include './design/koneksi/file.php';
				$session_data 			= $this->session->userdata('logged_in');
				$user_id				= $session_data['id'];
				$pat_mrn 				= $this->input->post('pat_mrn');
				$id_pat					= $this->input->post('id_pat');
				$id_reg 				= $this->input->post('id_reg');
				$tgl 					= date("Y-m-d");
				$now					= date("Y-m-d H:i:s");

				$data_insert			= array(
					'presc_date'			=> $tgl,
					'id_reg'				=> $id_reg,
					'id_pat'				=> $id_pat,
					'id_dr'					=> $user_id,
					'presc_status'			=> 0,
					'create_by'				=> $user_id,
					'create_date'			=> $now,
				);

				$this->load->model('m_pharmacy');
				$this->m_pharmacy->save_prescription($data_insert);
				$items 					= $this->input->post('item');
				$jml					= count($items);

				//Create Log Start
				$session_data 			= $this->session->userdata('logged_in');
				$user_id				= $session_data['id'];
				$data_log = array(
					'id_user'						=> $user_id,
					'log_date'						=> date("Y-m-d"),
					'log_desc' 						=> "Create Order Pharmacy from doctor  : " . $this->input->post('id_reg') . "",
				);
				$this->load->model('m_login');
				$this->m_login->log($data_log);
				//Endless Log

				// cara mudah mengambil id manufaktur tertinggi atau terbaru..
				$data['data'] 	= $this->m_pharmacy->get_max_id_prescription();
				foreach ($data['data']->result() as $row) {
					$id_presc = $row->id_presc;
				}

				//proses insert manufaktur detail
				for ($i = 1; $i <= $jml; $i++) {
					$id_item				= $this->input->post('id_item[' . $i . ']');
					$id_base				= str_replace("", "0", $this->input->post('id_base[' . $i . ']'));
					$qty					= $this->input->post('qty[' . $i . ']');
					$id_drug_dosage			= str_replace("", "0", $this->input->post('id_drug_dosage[' . $i . ']'));
					$item_manu				= str_replace("", "0", $this->input->post('resep[' . $i . ']'));
					$data_insert_d			= array(
						'id_presc_h'			=> $id_presc,
						'drug_id'				=> $id_item,
						'drug_qty'				=> $qty,
						'drug_uom'				=> $id_base,
						'drug_dosage'			=> $id_drug_dosage,
						'drug_group'			=> $this->input->post('resep[' . $i . ']'),
						'drug_potekan'			=> $this->input->post('bagi[' . $i . ']'),
						'drug_dtd'				=> $this->input->post('hasil[' . $i . ']'),
					);

					$query_smart_pha = "SELECT * FROM mst_item_price where id_item='" . $this->input->post('id_item[' . $i . ']') . "' and price_type='" . $this->input->post('type') . "' ";
					//echo $query_smart;
					//die();
					if ($resultpha 	= mysqli_query($con, $query_smart_pha)) {
						$num_rowspha  	= mysqli_num_rows($resultpha);

						//echo $num_rowsx; 
						//die();
						if ($num_rowspha == 0) {
							$sql 	= "INSERT INTO smart_notification (id_reg, id_trouble, type_id, notes, id_source_trouble) VALUES ('" . $this->input->post('id_reg') . "', '" . $this->input->post('id_item[' . $i . ']') . "', '13', 'Harga Pharmacy', '" . $this->input->post('type') . "')";
							$this->db->query($sql);
						}
					} else {
					}

					$this->m_pharmacy->save_prescription_d($data_insert_d);
				}
			}

			if ($parameter_ser != "") {
				include './design/koneksi/file.php';

				for ($xxx = 1; $xxx <= $rowService; $xxx++) {
					$uservalue = $this->input->post('ser_' . $xxx . '');

					$uservalue = explode(":", $uservalue);

					$data_ser			= array(
						'id_reg'		=> $this->input->post('id_reg'),
						'id_pat'		=> $this->input->post('id_pat'), //terlanjur di prosedur pat_mrn walau sesungguhnya itu adalah id pat
						'order_type'	=> $uservalue[1],
						'order_date'	=> date("Y-m-d H:i:s"),
						'order_status'	=> 1,
						'user_id'		=> $user_id,
					);

					$this->m_docter->order_lab_h($data_ser);

					include './design/koneksi/file.php';
					$query 		= "SELECT id_order id FROM pat_order_h ORDER BY id_order DESC LIMIT 1";

					if ($result 	= mysqli_query($con, $query)) {
						$row 	= mysqli_fetch_assoc($result);
						$count 	= $row['id'];
					} else {
						$row 	= mysqli_fetch_assoc($result);
						$count 	= 1;
					}

					if ($uservalue[0] != "") {
						$sql = "INSERT INTO pat_order_d (id_order_header, id_service, seq_no, service_qty, id_dr, acct_code) VALUES ('" . $count . "', '" . $uservalue[0] . "', '1', '" . $this->input->post('qty_' . $xxx) . "', '" . $user_id . "','1')";
						$this->db->query($sql);
						echo $this->db->affected_rows();
					} else {
						//empty	
					}

					$query_smart_ser = "SELECT * FROM mst_item_price where id_item='" . $uservalue[0] . "' and price_type='" . $this->input->post('type') . "' ";

					//echo $query_smart;
					//die();
					if ($resultser 	= mysqli_query($con, $query_smart_ser)) {
						$num_rowsser  	= mysqli_num_rows($resultser);

						//echo $num_rowsx; 
						//die();
						// if($num_rowsser==0){
						// $sql 	="INSERT INTO smart_notification (id_reg, id_trouble, type_id, notes, id_source_trouble) VALUES ('".$this->input->post('id_reg')."', '".$uservalue[0]."', '".$uservalue[1]."', 'Harga Other Services', '".$this->input->post('type')."')";
						// $this->db->query($sql);
						// }

					} else {
					}
				}

				//Create Log Start
				$session_data 			= $this->session->userdata('logged_in');
				$user_id				= $session_data['id'];
				$data_log = array(
					'id_user'						=> $user_id,
					'log_date'						=> date("Y-m-d"),
					'log_desc' 						=> "Create Order Other Services from doctor  : " . $this->input->post('id_reg') . "",
				);
				$this->m_login->log($data_log);
				//Endless Log
			}

			if ($parameter_mcu != "") {
				$goblin			= array();


				for ($xx = 1; $xx <= $rowMCU; $xx++) {
					$mcu			= $this->input->post('mcu_' . $xx);
					$mcu			= explode(":", $mcu);
					$mcu_lagi		= $mcu[0];
					$goblin['spear'][$xx] = $mcu_lagi;
				}

				$pekka			= join(",", $goblin['spear']);

				$data['all_pisik'] 		= $this->m_registration->get_data_pisik($goblin['spear']);
				$data['all_data'] 		= $this->m_registration->send_job_lab($goblin['spear']);
				$data['all_radiology'] 	= $this->m_registration->send_job_radio($goblin['spear']);
				$row_cnt 	= $data['all_data']->num_rows();
				$row_cnta 	= $data['all_radiology']->num_rows();
				$row_cntak 	= $data['all_pisik']->num_rows();

				if ($row_cntak != 0) {
					foreach ($data['all_pisik']->result() as $rows) {
						$data_pisik				= array(
							'id_reg'		=> $this->input->post('id_reg'),
							'id_pat'		=> $this->input->post('id_pat'),
							'order_type'	=> $rows->id_group_serv,
							'order_date'	=> date("Y-m-d H:i:s"),
							'order_status'	=> 1,
							'mcu'			=> 1,
							'user_id'		=> $user_id,
						);
						$this->m_lab->order_lab_h($data_pisik);
						$aa = 1;
						$type 					= $rows->order_type;
						$id_service				= $rows->id_service;
						include './design/koneksi/file.php';
						$query 		= "SELECT id_order id FROM pat_order_h ORDER BY id_order DESC LIMIT 1";
						if ($result 	= mysqli_query($con, $query)) {
							$row 	= mysqli_fetch_assoc($result);
							$count 	= $row['id'];
						}

						$sql = "INSERT INTO pat_order_d (id_order_header, id_service, seq_no, service_qty, id_dr, acct_code) VALUES ('" . $count . "', '" . $id_service . "', '" . $aa++ . "', '1', '1','1')";
						$this->db->query($sql);
					}
				}
				if ($row_cnt != 0) {
					$data_lab				= array(
						'id_reg'		=> $this->input->post('id_reg'),
						'id_pat'		=> $this->input->post('id_pat'),
						'order_type'	=> 1,
						'order_date'	=> date("Y-m-d H:i:s"),
						'order_status'	=> 1,
						'mcu'			=> 1,
						'user_id'		=> $user_id,
					);
					$this->m_lab->order_lab_h($data_lab);
					$a = 1;
					foreach ($data['all_data']->result() as $row) {
						$type 					= $row->order_type;
						$id_service				= $row->order_id;
						include './design/koneksi/file.php';
						$query 		= "SELECT id_order id FROM pat_order_h ORDER BY id_order DESC LIMIT 1";
						if ($result 	= mysqli_query($con, $query)) {
							$row 	= mysqli_fetch_assoc($result);
							$count 	= $row['id'];
						}

						$sql = "INSERT INTO pat_order_d (id_order_header, id_service, seq_no, service_qty, id_dr, acct_code) VALUES ('" . $count . "', '" . $id_service . "', '" . $a++ . "', '1', '1','1')";
						$this->db->query($sql);
					}
				}
				if ($row_cnta != 0) {
					$data_lab		= array(
						'id_reg'		=> $this->input->post('id_reg'),
						'id_pat'		=> $this->input->post('id_pat'),
						'order_type'	=> 2,
						'order_date'	=> date("Y-m-d H:i:s"),
						'order_status'	=> 1,
						'mcu'			=> 1,
						'user_id'		=> $user_id,
					);
					$this->m_lab->order_lab_h($data_lab);
					$b = 1;
					foreach ($data['all_radiology']->result() as $row2) {
						$type 					= $row2->order_type;
						$id_service2			= $row2->order_id;
						include './design/koneksi/file.php';
						$query 		= "SELECT id_order id FROM pat_order_h ORDER BY id_order DESC LIMIT 1";
						if ($result 	= mysqli_query($con, $query)) {
							$row 	= mysqli_fetch_assoc($result);
							$count 	= $row['id'];
						}

						$sql = "INSERT INTO pat_order_d (id_order_header, id_service, seq_no, service_qty, id_dr, acct_code) VALUES ('" . $count . "', '" . $id_service2 . "', '" . $b++ . "', '1', '1','1')";
						$this->db->query($sql);
						echo $this->db->affected_rows();
					}
				}
				$query 		= "select id_package from trx_registration where id_reg='" . $this->input->post('id_reg') . "'";
				if ($result 	= mysqli_query($con, $query)) {
					$row 	= mysqli_fetch_assoc($result);
					$cs 	= $row['id_package'];
				}
				$sql_first = "update trx_registration set id_service=0, id_package='" . $cs . "," . $pekka . "' where id_reg='" . $this->input->post('id_reg') . "'";
				$this->db->query($sql_first);
			}

			if ($parameter_grp != "") {

				$data_pisik				= array(
					'id_reg'		=> $this->input->post('id_reg'),
					'id_pat'		=> $this->input->post('id_pat'),
					'order_type'	=> 14,
					'order_date'	=> date("Y-m-d H:i:s"),
					'order_status'	=> 1,
					'mcu'			=> 0,
					'user_id'		=> $user_id,
				);

				$this->m_lab->order_lab_h($data_pisik);

				include './design/koneksi/file.php';
				$query 		= "SELECT id_order id FROM pat_order_h ORDER BY id_order DESC LIMIT 1";
				if ($result 	= mysqli_query($con, $query)) {
					$row 	= mysqli_fetch_assoc($result);
					$count 	= $row['id'];
				}

				$nomor = 1;
				// echo $rowGRP;
				for ($aaxx = 1; $aaxx <= $rowGRP; $aaxx++) {
					$mcu			= $this->input->post('grp_' . $aaxx);
					$mcu			= explode(":", $mcu);

					$sqlx = "INSERT INTO pat_order_d (id_order_header, id_service, seq_no, service_qty, id_dr, acct_code) VALUES ('" . $count . "', '" . $mcu[1] . "', '" . $nomor++ . "', '1', '" . $user_id . "','1')";

					// echo $sqlx;
					$this->db->query($sqlx);
				}
			}

			if ($parameter_soap != "" && $parameter_soap_1 == "") {
				include './design/koneksi/file.php';
				$query 		= "SELECT id_order id FROM pat_order_h ORDER BY id_order DESC LIMIT 1";
				if ($result 	= mysqli_query($con, $query)) {
					$row 	= mysqli_fetch_assoc($result);
					$count 	= $row['id'];
				}
				$sql = "INSERT INTO doctor_soap (id_pat, id_reg, Subject, Object, Assessment, Plan, id_order, create_by) VALUES ('" . $this->input->post('id_pat') . "', '" . $this->input->post('id_reg') . "', '" . $this->input->post('s') . "', '" . $this->input->post('o') . "', '" . $this->input->post('a') . "','" . $this->input->post('p') . "', '" . $count . "','" . $user_id . "')";
				$this->db->query($sql);
				echo $this->db->affected_rows();
			} else {
				$sql_up = "update doctor_soap set subject='" . $this->input->post('s') . "',object='" . $this->input->post('o') . "',Assessment='" . $this->input->post('a') . "',Plan='" . $this->input->post('p') . "',update_date='" . date("Y-m-d H:i:s") . "' where id_reg='" . $this->input->post('id_reg') . "' ";
				$this->db->query($sql_up);
			}
			redirect('docter/docter_order/ok');
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}


	function report_mcu_list()
	{
		if ($this->session->userdata('logged_in')) {

			$session_data 		= $this->session->userdata('logged_in');
			$user_id			= $session_data['id'];
			$data['username'] 	= $session_data['username'];
			$data['list_data'] 	= $this->m_docter->get_report_mcu();

			$this->template->set('title', 'Klinik | List Of Client');
			$this->template->load('template', 'menu/list_report_mcu', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function list_report_mcu_year()
	{
		if ($this->session->userdata('logged_in')) {
			$data['id_company']	= $this->uri->segment(3);
			$data['id_package']	= $this->uri->segment(4);
			$session_data 		= $this->session->userdata('logged_in');
			$user_id			= $session_data['id'];
			$data['username'] 	= $session_data['username'];
			$data['list_data'] 	= $this->m_docter->get_report_mcu_year($data['id_company'], $data['id_package']);

			$this->template->set('title', 'Klinik | List Of Client');
			$this->template->load('template', 'menu/list_report_mcu_year', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function list_report_mcu_detail()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_client');
			$this->load->model('m_patient');
			// ---- mengambil data dari link ----
			$id_company							= $this->uri->segment(3);
			$id_package							= $this->uri->segment(4);
			$month								= $this->uri->segment(5);
			$year								= $this->uri->segment(6);
			// ---- session data ----
			$session_data 						= $this->session->userdata('logged_in');
			$user_id							= $session_data['id'];
			$data['username'] 					= $session_data['username'];
			// //  ----- query untuk header ----
			$data['client'] 					= $this->m_client->get_mst_client_by_id($id_company);
			$data['paket_h'] 					= $this->m_docter->get_mkt_posting_pack_h_id($id_package);
			// $data['paket'] 						= $this->m_docter->get_list_paket_detail($id_package);
			$data['list_data'] 					= $this->m_docter->get_report_mcu_detail($id_company, $id_package, $month, $year);
			// ----- membuat array ----
			$data['arr_group_service'] 			= array();
			$data['arr_list_reg_id'] 			= array();
			$data['arr_service_other'] 			= array();
			$data['arr_nama_value'] 			= array();
			$data['arr_name_type'] 				= array();
			$data['reg_id'] 					= array();
			$arr_idpat							= array();
			$reg_id								= array();
			$tgl_reg							= array();
			$package_id							= array();
			$arr_id_item_value					= array();
			$arr_id_lab							= array();
			$arr_id_rad							= array();
			$arr_id_service						= array();
			$arr_age							= array();
			$arr_gender							= array();
			$data['jml_fisik'] 					= 0;
			$data['jml_lab'] 					= 0;
			$y 									= 1;
			// ----- looping data client ----
			foreach ($data['client']->result() as $row) {
				$data['client_name'] 			= $row->client_name;
				$data['client_address1'] 		= $row->client_address1;
				$data['client_address2'] 		= $row->client_address2;
				$data['client_contact_name'] 	= $row->client_contact_name;
				$data['client_phone'] 			= $row->client_phone;
				$data['client_fax'] 			= $row->client_fax;
				$data['client_mobile'] 			= $row->client_mobile;
				$data['client_other'] 			= $row->client_other;
				$data['client_pic'] 			= $row->client_pic;
			}
			// ----- looping data paket header ----
			foreach ($data['paket_h']->result() as $row) {
				$data['quot_name']	 			= $row->quot_name;
				$data['qout_id']	 			= $row->qout_id;
				$data['quot_date_create']	 	= $row->quot_date_create;
				$data['quot_date_valid']	 	= $row->quot_date_valid;
				$data['quot_date_end']	 		= $row->quot_date_end;
				$data['quot_revision']	 		= $row->quot_revision;
				$data['qty_estimate']	 		= $row->qty_estimate;
				$data['notes_client']	 		= $row->notes_client;
				$data['notes']	 				= $row->notes;
			}
			// // ----- looping data paket detail ----
			// foreach ($data['paket']->result() as $row) {
			// 	$data['arr_group_service'][] 	= $row->group_service;
			// 	$data['arr_service_other'][] 	= $row->service_other;
			// 	$data['arr_nama_value'][] 		= $row->nama_value;
			// 	$data['arr_name_type'][] 		= $row->name_type;
			// }
			// $data['arr_jml']					= count($data['arr_group_service']);	


			// -------------- memasukan data ke temporary table -----------------
			// // -------------- Hapus semua data pada table temp --------------
			// $this->m_patient->tr_tmp_print_mcu_h();
			// $this->m_patient->tr_tmp_print_mcu_d();
			// $this->m_patient->hapus_tmp_print_mcu_d($value->id_pat);
			// -------------- Insert data temporary header --------------
			$jack						= $this->m_docter->get_patient_by_client($id_company);
			$data['jml_jack']			= $jack->num_rows();
			foreach ($jack->result() as $value) {

				$cek					= $this->m_patient->get_temp_print_mcu_h($value->id_reg);
				$jml_cek 				= $cek->num_rows();
				//  -- -Jika kosong maka insert -- 
				if (empty($jml_cek)) {
					$data_insert_h			= array(
						'id_pat'				=> $value->id_pat,
						'id_reg'				=> $value->id_reg,
						'reg_date'				=> $value->reg_date,
						'id_package'			=> $value->id_package,
					);
					$this->m_patient->insert_temp_print_mcu_h($data_insert_h);
				}
				// ---- insert arrray ---
				$arr_idpat[] 			= $value->id_pat;
				$reg_id[] 				= $value->id_reg;
				$data['reg_id'] 		= $value->id_reg;
				$tgl_reg[] 				= $value->reg_date;
				$package_id[] 			= $value->id_package;
				// ---- Function Convertion Age to Months ----
				$birth 					= $value->pat_dob;
				$arr_gender[]			= $value->pat_gender;
				$birthday 				= new DateTime($birth);
				$diff 					= $birthday->diff(new DateTime());
				$arr_age[] 				= $diff->format('%m') + 12 * $diff->format('%y');
				// ---- End of Function ----
			}
			$data['arr_reg_id']			= count($reg_id);
			$arr_reg_id 				= count($reg_id);
			$data['reg_date_now'] 		= $tgl_reg[0];
			$data['reg_date_previous'] 	= "";
			$data['reg_date_last'] 		= "";
			// ---- mengganti tanggal jika ada ----
			if (isset($tgl_reg[1])) {
				$data['reg_date_previous'] = date("d-m-Y", strtotime($tgl_reg[1]));
			}
			if (isset($tgl_reg[2])) {
				$data['reg_date_last'] = date("d-m-Y", strtotime($tgl_reg[2]));
			}
			// ---- Looping untuk memasukan data temporari untuk detailnya ----
			for ($x = 0; $x < $arr_reg_id; $x++) {
				// for($x = 0; $x < 10; $x++) {
				$cek					= $this->m_docter->get_temp_print_mcu_d_byID($arr_idpat[$x]);
				$jml_cek 				= $cek->num_rows();
				if (empty($jml_cek)) { // --- Jika data belum ada maka insert ---
					// ---- proses looping untuk memasukan data ke table temporary untuk detail ----
					$detailmcu							= $this->m_patient->get_data_mcu3($reg_id[$x], $package_id[$x], $arr_age[$x], $arr_gender[$x]);
					$detaillab 							= $this->m_docter->get_data_detail_lab($reg_id[$x], $package_id[$x]);
					$detailrad 							= $this->m_patient->print_detailrad_order($reg_id[$x], $package_id[$x]);
					$jml_detailmcu						= $detailmcu->num_rows();
					$jml_detaillab						= $detaillab->num_rows();
					$jml_detailrad						= $detailrad->num_rows();
					$data['package' . $x] 				= $this->m_patient->get_list_package($reg_id[$x], $package_id[$x]);
					$data['all_data_grade' . $x] 			= $this->m_patient->get_data_grade_result($reg_id[$x]);
					foreach ($detailmcu->result() as $value) {

						// $group_header = $value->group_desc;
						// if ($value->id_group_serv == 5) {$group_header = "Dental Hygiene";}
						// if ($value->id_group_serv == 11) {$group_header = "Cardiography";}

						$data_insert_d					= array(
							'id_pat'						=> $arr_idpat[$x],
							'id_reg'						=> $reg_id[$x],
							'reg_date'						=> $value->reg_date,
							'content_h'						=> $value->group_desc,
							'id_item_value'					=> $value->id_item_value,
							'stdvalue'						=> '-',
							'content_d'						=> $value->nama_value,
							'now'							=> $value->result,
							'unit'							=> $value->Unit,
							'id_serv_group'					=> $value->id_group_serv,
							'id_package'					=> $value->id_quot,
							'id_service'					=> $value->id_service,
							'name_package'					=> $value->quot_name,
						);
						$this->m_patient->insert_temp_print_mcu_d($data_insert_d);
					}
					foreach ($detaillab->result() as $v_lab) {


						if ($v_lab->name_type != "") {
							$content_d = $v_lab->name_type;
						} else {
							$content_d = $v_lab->lab_item_abbr;
						}

						$content_h = $v_lab->group_name;
						if ($content_h != "") {
							$content_h = $content_d;
						}

						$data_insert_d					= array(
							'id_pat'						=> $arr_idpat[$x],
							'id_reg'						=> $reg_id[$x],
							'reg_date'						=> $v_lab->reg_date,
							'content_h'						=> $v_lab->group_name,
							'id_item_value'					=> $v_lab->id_lab_item,
							'id_service'					=> $v_lab->id_service,
							'stdvalue'						=> $v_lab->std_value,
							'is_normal'						=> $v_lab->is_normal,
							'content_d'						=> $content_d,
							'now'							=> $v_lab->result_value,
							'unit'							=> '-',
							'id_serv_group'					=> 1,
							'id_package'					=> $v_lab->id_quot,
							'name_package'					=> $v_lab->quot_name,
						);
						$this->m_patient->insert_temp_print_mcu_d($data_insert_d);
					}
					foreach ($detailrad->result() as $v_rad) {
						$data_insert_d					= array(
							'id_pat'						=> $arr_idpat[$x],
							'id_reg'						=> $reg_id[$x],
							'reg_date'						=> $v_rad->reg_date,
							'content_h'						=> $v_rad->group_desc,
							'id_item_value'					=> $v_rad->id_rad_item,
							'id_service'					=> $v_rad->id_service,
							'stdvalue'						=> '-',
							'content_d'						=> $v_rad->rad_item,
							'now'							=> $v_rad->result,
							'unit'							=> '-',
							'id_serv_group'					=> 2,
							'id_package'					=> $v_rad->id_quot,
							'name_package'					=> $v_rad->quot_name,
						);
						$this->m_patient->insert_temp_print_mcu_d($data_insert_d);
					}
				} // --- tutup if masukan detail ----
				$y = $y + 1;
			} // Tutup Looping
			$this->m_patient->update_temp_print_mcu_d2(); // update...
			// --- memasukan array untuk header table---- 
			$cek_header_table = $this->m_docter->get_headers_table($arr_idpat);
			foreach ($cek_header_table->result() as $row) {
				$data['arr_service_other'][] 	= $row->content_d;
			}
			$data['arr_jml'] = count($data['arr_service_other']);
			// // ----- Cek array ----
			// echo "<pre>";
			//  echo $data['arr_jml']; echo "<br>";
			//  print_r($data['arr_service_other']); echo "<br>";
			// echo "</pre>";
			//  exit();

			// -------------- batas memasukan data ke temporary table ------------------

			// -------------- membuat data isi pegawai dari perusahan ------------------
			// $data['data_h'] 			= $this->m_patient->get_temp_print_mcu_h($id_pat);
			// $data['data_fisik']			= $this->m_patient->get_temp_print_mcu_d_fisik($id_pat);
			// $data['data_lab']			= $this->m_patient->get_temp_print_mcu_d($id_pat,1);
			// $data['data_rad']			= $this->m_patient->get_temp_print_mcu_d($id_pat,2);
			// $data['data_dental']		= $this->m_patient->get_temp_print_mcu_d_dental($id_pat);



			$this->template->set('title', 'Klinik | List Of Client');
			// $this->template->load('template','menu/list_report_mcu_detail', $data);
			$this->load->view('menu/list_report_mcu_detail', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	public function append_services()
	{
		$id_registration = $this->input->post('id_registration');
		$id_patient      = $this->input->post('id_patient');
		$id_service      = $this->input->post('id_service');
		$is_complete     = "no";

		$data = [
			'id_registration' => $id_registration,
			'id_patient'      => $id_patient,
			'id_service'      => $id_service,
			'is_complete'     => $is_complete,
		];

		$exec = $this->m_docter->append_services($data);

		if (!$exec) {
			$code = 500;
			$msg = 'Process Append Service Failed, please contact Web Admin';
		} else {
			$code = 200;
			$msg = 'Process Append Service Success';
		}

		echo json_encode([
			'code' => $code,
			'msg'  => $msg,
		]);
	}

	public function get_table_list_service()
	{
		$id_registration = $this->input->get('id_registration');
		$id_patient      = $this->input->get('id_patient');
		$num_rows        = 0;
		$result          = [];

		$exec = $this->m_docter->get_table_list_service($id_registration, $id_patient);

		if (!$exec) {
			$code = 500;
			$msg  = 'Process Get Data Table Services Failed, please contact Web Admin';
		} else {
			$code     = 200;
			$msg      = 'Process Get Data Table Services Success';
			$num_rows = $exec->num_rows();
			$result   = $exec->result();
		}

		echo json_encode([
			'code'     => $code,
			'msg'      => $msg,
			'num_rows' => $num_rows,
			'result'   => $result,
		]);
	}

	public function remove_services()
	{
		$id          = $this->input->post('id');
		$is_complete = "no";

		$data =  [
			'id'          => $id,
			'is_complete' => $is_complete,
		];

		$exec = $this->m_docter->remove_services($data);

		if (!$exec) {
			$code = 500;
			$msg = 'Process Remove Service Failed, please contact Web Admin';
		} else {
			$code = 200;
			$msg = 'Process Remove Service Success';
		}

		echo json_encode([
			'code' => $code,
			'msg'  => $msg,
		]);
	}

	public function truncate_list_services()
	{
		$id_registration = $this->input->post('id_registration');
		$id_patient      = $this->input->post('id_patient');
		$is_complete     = "no";

		$data = [
			'id_registration' => $id_registration,
			'id_patient'      => $id_patient,
			'is_complete'     => $is_complete,
		];

		$exec  = $this->m_docter->remove_services($data);
		$exec2 = $this->m_docter->remove_pat_order_h($id_registration, $id_patient);

		if (!$exec && !$exec2) {
			$code = 500;
			$msg = 'Process Truncate Service Failed, please contact Web Admin';
		} else {
			$code = 200;
			$msg = 'Process Truncate Service Success';
		}

		echo json_encode([
			'code' => $code,
			'msg'  => $msg,
		]);
	}

	public function save_doctor_order_ajax()
	{
		$code              = 500;
		$msg               = "Failed connect to Databases, please contact Web Admin";
		$current_date      = date('Y-m-d');
		$current_date_time = date('Y-m-d H:i:s');

		if ($this->session->userdata('logged_in')) {
			$this->db->trans_start();
			$session_data    = $this->session->userdata('logged_in');
			$user_id         = $session_data['id'];

			$id_registration = $this->input->post('id_registration');
			$id_patient      = $this->input->post('id_patient');

			// part odontogram start
			$array_odontogram = $this->generate_array_odontogram();
			$data_odontogram  = [];

			for ($a = 0; $a < count($array_odontogram); $a++) {
				$post = $this->input->post($a);
				$desc = $this->input->post('desc' . $a);

				if ($post == "on") {

					$nested = [
						'id_reg'     => $id_registration,
						'id_patient' => $id_patient,
						'odo_value'  => $a,
						'odo_desc'   => $desc,
					];
					array_push($data_odontogram, $nested);
				}
			}

			$exec_odontogram = $this->m_docter->insert_odontogram($data_odontogram);
			if (!$exec_odontogram) {
				$this->db->trans_rollback();
				echo json_encode(['code' => $code, 'msg' => '$exec_odontogram']);
				exit;
			}
			// part odontogram end

			// part services start
			$arr_selected_services = $this->m_docter->get_selected_services($id_registration, $id_patient);
			if ($arr_selected_services->num_rows() == 0) {
				$this->db->trans_rollback();
				echo json_encode(['code' => 404, 'msg' => "Data Service Can't Empty"]);
				exit;
			}

			foreach ($arr_selected_services->result() as $key) {
				$id_service = $key->id_service;

				$data_order_lab_h = array(
					'id_reg'       => $id_registration,
					'id_pat'       => $id_patient,
					'order_type'   => 0,
					'order_date'   => $current_date_time,
					'order_status' => 1,
					'user_id'      => $user_id,
				);

				$exec_data_order_lab_h = $this->m_docter->order_lab_h($data_order_lab_h);
				$id_order_header = $this->db->insert_id();

				if (!$exec_data_order_lab_h) {
					$this->db->trans_rollback();
					echo json_encode(['code' => $code, 'msg' => '$exec_data_order_lab_h']);
					exit;
				}

				$data_pat_order_d = [
					'id_order_header' => $id_order_header,
					'id_service'      => $id_service,
					'seq_no'          => '1',
					'service_qty'     => '1',
					'id_dr'           => $user_id,
					'acct_code'       => '1',
				];

				$exec_pat_order_d = $this->m_docter->store_pat_order_d($data_pat_order_d);

				if (!$exec_pat_order_d) {
					$this->db->trans_rollback();
					echo json_encode(['code' => $code, 'msg' => '$exec_pat_order_d']);
					exit;
				}
			}
			// part services end

			$data_log = array(
				'id_user'  => $user_id,
				'log_date' => $current_date_time,
				'log_desc' => "Create Order Lab from Doctor  : " . $id_registration,
			);

			$exec_log = $this->m_login->log($data_log);
			if (!$exec_log) {
				$this->db->trans_rollback();
				echo json_encode(['code' => $code, 'msg' => '$exec_log']);
				exit;
			}

			$data_trx_registration  = ['status_reg' => 1];
			$where_trx_registration = ['id_reg'     => $id_registration];
			$exec_trx_registration  = $this->m_docter->update_registration($data_trx_registration, $where_trx_registration);

			if (!$exec_trx_registration) {
				$this->db->trans_rollback();
				echo json_encode(['code' => $code, 'msg' => '$exec_trx_registration']);
				exit;
			}
			//adam

			$code = 200;
			$msg = "Process Create Order Complete";
			$this->db->trans_complete();
		}

		echo json_encode([
			'code' => $code,
			'msg'  => $msg
		]);
	}

	public function generate_array_odontogram()
	{
		// rules array odontogram
		// a. 11-18
		// b. 21-28
		// c. 31-38
		// d. 41-48
		// e. 51-55
		// f. 61-65
		// g. 71-75
		// h. 81-85

		$a = $this->_loop_odontogram(11, 18);
		$b = $this->_loop_odontogram(21, 28);
		$c = $this->_loop_odontogram(33, 38);
		$d = $this->_loop_odontogram(41, 48);
		$e = $this->_loop_odontogram(51, 55);
		$f = $this->_loop_odontogram(61, 65);
		$g = $this->_loop_odontogram(71, 75);
		$h = $this->_loop_odontogram(85, 85);
		$arr = array_merge($a, $b, $c, $d, $e, $f, $g, $h);
		return $arr;
	}

	public function _loop_odontogram($low, $high)
	{
		$arr = [];
		$x = 0;
		for ($a = $low; $a <= $high; $a++) {
			$arr[$x] = $a;
			$x++;
		}

		return $arr;
	}
}
