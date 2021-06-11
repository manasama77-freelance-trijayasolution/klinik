<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

use Spipu\Html2Pdf\Html2Pdf;

class Cashier extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_cashier');
		$this->load->model('m_docter');
		$this->load->model('m_registration');
		$this->load->model('m_inv');
		$this->load->model('m_pharmacy');
		$this->load->model('m_quotation');

		$this->load->helper('date');
	}

	function index()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data			 = $this->session->userdata('logged_in');
			$data['username']		 = $session_data['username'];
			$this->load->view('menu/index.php', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function save_doctor_fee()
	{
		if ($this->session->userdata('logged_in')) {
			$rowC	 				= $this->input->post('rowc');
			$idreg 					= $this->input->post('id_reg');
			$aa 					= $this->input->post('id_service');
			$package 				= $this->input->post('package');
			$a						= date("Y-m-d", strtotime($this->input->post('reg_date')));
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];

			$data_fee	 			= array(
				'id_reg'			=> $this->input->post('id_reg'),
				'create_by' 		=> $user_id,
				'type'				=> $this->input->post('charge'),
				'status' 			=> 1,
			);

			$reg		= "0";
			include './design/koneksi/file.php';
			$query 		= "SELECT * FROM dr_fee_h where id_reg='" . $idreg . "' ORDER BY id DESC LIMIT 1";
			if ($result 	= mysqli_query($con, $query)) {
				$row 	= mysqli_fetch_assoc($result);
				$count 	= $row['id'];
				$reg	= $row['id_reg'];
			}

			if ($reg != $idreg) {
				$this->m_cashier->save_doctor_fee_h($data_fee);
				include './design/koneksi/file.php';
				$query 		= "SELECT id id FROM dr_fee_h ORDER BY id DESC LIMIT 1";
				if ($result 	= mysqli_query($con, $query)) {
					$row 		= mysqli_fetch_assoc($result);
					$countx 	= $row['id'];
				}

				for ($i = 1; $i <= $rowC; $i++) {
					$idx = $this->input->post('id_service_' . $i . '');
					$idy = $this->input->post('id_dr_' . $i . '');

					$sql = "INSERT INTO dr_fee_d (id_fee_h, id_service, group_service, id_dr) VALUES ('" . $countx . "', '" . $idx . "', '1', '" . $idy . "')";
					$this->db->query($sql);
				}
			}

			redirect('cashier/doctor_fee/ok/' . $idreg);
		} else {
			redirect('login', 'refresh');
		}
	}


	function update_doctor_fee()
	{
		if ($this->session->userdata('logged_in')) {
			$rowC	 				= $this->input->post('rowc');
			$idreg 					= $this->input->post('id_reg');
			$aa 					= $this->input->post('id_service');
			$package 				= $this->input->post('package');
			$a						= date("Y-m-d", strtotime($this->input->post('reg_date')));
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];

			$reg		= "0";
			include './design/koneksi/file.php';
			$query 		= "SELECT * FROM dr_fee_h where id_reg='" . $idreg . "' ORDER BY id DESC LIMIT 1";
			if ($result 	= mysqli_query($con, $query)) {
				$row 	= mysqli_fetch_assoc($result);
				$count 	= $row['id'];
				$reg	= $row['id_reg'];
			}

			include './design/koneksi/file.php';
			$query 		= "SELECT id id FROM dr_fee_h ORDER BY id DESC LIMIT 1";
			if ($result 	= mysqli_query($con, $query)) {
				$row 		= mysqli_fetch_assoc($result);
				$countx 	= $row['id'];
			}

			for ($i = 1; $i <= $rowC; $i++) {
				$idx = $this->input->post('id_fee_' . $i . '');
				$idy = $this->input->post('id_dr_' . $i . '');

				$sql = "update dr_fee_d set id_dr='" . $idy . "' where id_fee_d='" . $idx . "' ";
				//echo $sql;
				//die();
				$this->db->query($sql);
			}


			redirect('cashier/doctor_fee/update/' . $idreg);
		} else {
			redirect('login', 'refresh');
		}
	}


	public function find_reg_patient()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_cashier->get_patient_data_now();
			$this->template->set('title', 'Klinik | Find Patient Data');
			$this->template->load('template', 'menu/find_patient_data4', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function counter()
	{
		if ($this->session->userdata('logged_in')) {

			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['sv_lab'] 		= $this->m_quotation->get_list_lab();
			$data['sv_rad'] 		= $this->m_quotation->get_list_rad();
			$data['sv_mark'] 		= $this->m_quotation->get_list_mark();
			$data['get_client']     = $this->m_registration->get_mst_client();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();

			$this->template->set('title', 'Klinik | Counter');
			$this->template->load('template', 'menu/counter', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}


	public function input_billing()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data     = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['loc']      = $session_data['location'];
			$this->template->set('title', 'Klinik | Input Billing');
			$this->template->load('template', 'menu/input_billing', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function doctor_fee_act()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data 		= $this->session->userdata('logged_in');
			$data['username'] 	= $session_data['username'];
			$branch 	 		= $session_data['location'];
			$type				= $this->input->post('type');
			$id_reg				= $this->input->post('id_reg');
			$data['lab_item'] = $this->m_docter->get_mst_lab_item($branch, $type);
			$data['rad_item'] = $this->m_docter->get_mst_rad_item($branch, $type);
			$data['others']	  = $this->m_docter->get_other_service($branch, $type);
			$data['mcu']	  = $this->m_registration->get_mst_service_package_h();
			// $data['get_doctor']             = $this->m_registration->get_mst_doctor(); // query lama
			$data['get_doctor']             = $this->m_cashier->get_doctor_by_user();
			$data['get_regist']             = $this->m_registration->get_data_reg($id_reg);
			$data['get_history_doctor']     = $this->m_docter->get_hst_doctor($id_reg);
			$data['detaillab'] 				= $this->m_docter->print_detaillab_order($id_reg);
			$data['detailrad'] 				= $this->m_docter->print_detailrad_order($id_reg);
			$data['detailPhar'] 			= $this->m_docter->print_detailphar_order($id_reg);
			$data['detailother'] 			= $this->m_docter->print_detailother_order($id_reg);
			$this->template->set('title', 'Klinik | Doctor Fee');
			$this->template->load('template', 'menu/doctor_fee_act', $data);
		} else {
			redirect('login', 'refresh');
		}
	}

	function doctor_fee()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['loc'] 			= $session_data['location'];
			// $data['get_doctor']     = $this->m_registration->get_mst_doctor();
			$data['others']	  		= $this->m_docter->get_other_service_fee();
			$this->template->set('title', 'Klinik | Doctor Fee');
			$this->template->load('template', 'menu/doctor_fee', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	public function input_billing_process()
	{

		if ($this->session->userdata('logged_in')) {

			$session_data 					= $this->session->userdata('logged_in');
			$data['userlevel']				= $session_data['userlevel'];
			$data['menu_level']				= $session_data['jobs'];
			$user_id						= $session_data['id'];
			$data['username'] 				= $session_data['username'];
			$data['loc'] 					= $session_data['location'];
			$now_date_time					= date("Y-m-d H:i:s");

			$data['id_reg'] 				= $this->input->post('id_reg');
			$data['id_pat']					= $this->input->post('id_pat');
			$data['pat_name']				= $this->input->post('pat_name');
			$data['age']					= $this->input->post('age');
			$data['client_name']			= $this->input->post('client_name');
			$data['id_client']				= $this->input->post('id_client');
			$data['package_name']			= $this->input->post('package_name');
			$data['id_package']				= $this->input->post('id_package');
			$id_reg 						= $this->input->post('id_reg');
			$reg_date		 				= $this->input->post('reg_date');

			// Cek data dahulu, Jika Belum ada datanya maka kembalikan lagi..
			$isi_pat						= $this->m_cashier->cek_data_billing($id_reg);
			$cek_isi						= $isi_pat->num_rows();
			$isi_pat2						= $this->m_cashier->cek_data_billing2($id_reg);
			$cek_isi2						= $isi_pat2->num_rows();

			// Jika belum ada order pada table pat_order_h, maka tidak bisa lanjut
			if ($cek_isi == 0 && $cek_isi2 == 0) {

				echo "<script>alert('No orders'); 
						window.location.href = ('" . base_url() . "cashier/input_billing');	
					  </script>";
				exit();
			}


			// Mendapatkan kurs paling update....
			$updatekurs 		= $this->m_cashier->update_fix_usd();
			$ambilkurs			= $this->m_cashier->get_kurs_dollar_by_date($reg_date);
			$kursakhir			= $this->m_cashier->get_kurs_dollar_limit1();
			$cambilkurs			= $ambilkurs->num_rows();
			$ckursakhir			= $kursakhir->num_rows();
			$nk 				= 0;
			$nka 				= 0;
			$nilaikurs			= 0;

			if ($cambilkurs > 0) {
				foreach ($ambilkurs->result() as $row) {
					$nk = $row->amount;
				}
				$nilaikurs = $nk;
			} else {
				foreach ($kursakhir->result() as $row) {
					$nka = $row->amount;
				}
				$nilaikurs = $nka;
			}
			// Batas Mendapatkan kurs paling update....

			// khusus generate billing dibawah ini...
			$seq_bill						= $this->m_cashier->get_num_billing();
			$nobilll						= $seq_bill->num_rows();
			$numbilling						= $this->m_cashier->get_list_billing($id_reg);
			$jumlahbill						= $numbilling->num_rows();
			$data['numbilling']				= $numbilling;
			$data['jumlahbill']				= $jumlahbill;

			foreach ($numbilling->result() as $rowb) {
				$data['id_billing']			= $rowb->id_billing;
				$data['bill_no']			= $rowb->bill_no;
				$data['seq_no']				= $rowb->seq_no;
			}

			$tambahan						= $nobilll + 1;
			$nomorbill						= "BN/" . date("Y") . "/" . date("m") . "/" . $tambahan;

			if ($jumlahbill == 0) {

				$insert_billing = array(
					'id_reg'           => $id_reg,
					'id_bh'            => null,
					'bill_no'          => $nomorbill,
					'bill_date'        => $now_date_time,
					'seq_no'           => $tambahan,
					'type_charge_rule' => null,
					'status'           => 0,
					'total'            => 0,
					'create_by'        => $user_id,
					'create_date'      => $now_date_time,
					'percent'          => 0,
					'disc'             => 0,
					'grand_total'      => 0,
				);
				$this->m_cashier->insert_trx_billing($insert_billing);
			}
			// khusus generate billing diatas ini...

			$data['get_charge_rule']    	= $this->m_registration->get_mst_charge_rule();
			$data['find'] 					= $this->m_cashier->get_data_patien_reg($data['id_reg']);
			$data['data_fisik']				= $this->m_cashier->get_data_patien($data['id_reg']); //Fisik
			$data['data_grp']				= $this->m_cashier->print_detailgrp_order($data['id_reg']); //Fisik
			$data['data_lab']				= $this->m_cashier->get_data_lab_patien($data['id_reg']); //Lab
			$data['data_rad']				= $this->m_cashier->get_data_rad_patien($data['id_reg']); //Rad
			$babydragon						= array();

			foreach ($data['find']->Result() as $row) {
				$id_service 				= $row->id_service;
				$dodol 						= $row->dodol;
				$babydragon 				= $dodol;
			}

			$data_mcu						= $this->m_cashier->get_billing_mcu($data['id_reg'], $babydragon);
			$cek							= $this->m_cashier->get_list_trx_bh($data['id_reg']);
			$jml							= $cek->num_rows();
			$status 						= "";
			$id_bh 							= "";
			$create_by 						= $user_id;
			$create_date 					= date("Y-m-d H:i:s");

			foreach ($cek->result() as $rows) {
				$id_bh 				= $rows->id_bh;
				$id_reg_bh 			= $rows->id_reg;
				$age				= $rows->age;
				$status 			= $rows->status;
				$create_by 			= $rows->create_by;
				$create_date 		= $rows->create_date;
			}

			$data['status_bh'] 		= $status;

			// Jika data masih kosong maka masuk ke bawah ini..
			if ($jml == 0) {

				$max_billing = $this->m_cashier->get_max_trx_billing($id_reg);

				foreach ($max_billing->result() as $rowb) {
					$data['id_billing'] = $rowb->id_billing;
				}

				$id_billing = $data['id_billing'];

				$data_insert				= array(
					'id_reg'				 	=> $data['id_reg'],
					'id_pat'				 	=> $data['id_pat'],
					'age'						=> $data['age'],
					'status' 					=> 0,
					'create_by' 				=> $create_by,
					'create_date' 				=> $create_date,
				);
				$this->m_cashier->insert_trx_bh($data_insert);

				$cek2	= $this->m_cashier->get_list_trx_bh($data['id_reg']);

				foreach ($cek2->result() as $rows) {
					$id_bh 				= $rows->id_bh;
					$id_reg_bh 			= $rows->id_reg;
					$status 			= $rows->status;
				}

				foreach ($data_mcu->result() as $row_mcu) {
					$id_package 		= $row_mcu->id_quot;
					$type_charge_rule 	= $row_mcu->pat_charge_rule;
					$grand_total 		= $row_mcu->grand_price;

					if ($grand_total == "") {
						$price = 0;
					}

					//insert ke table trx_bd
					$data_insert				= array(
						'id_bh'				 		=> $id_bh,
						'id_service'				=> $id_package,
						'code_service' 				=> 12,
						'name_service' 				=> null,
						'type_charge_rule' 			=> $type_charge_rule,
						'id_serv_group' 			=> null,
						'split' 					=> 1,
						'price' 					=> $grand_total,
						'price_old' 				=> $grand_total,
						'id_billing' 				=> $id_billing,
					);
					$this->m_cashier->insert_trx_bd($data_insert);
				}


				foreach ($data['data_fisik']->result() as $row_fisik) {
					$id_service 		= $row_fisik->id_service;
					$code_service 		= $row_fisik->order_type;
					$type_charge_rule 	= $row_fisik->pat_charge_rule;
					$price 				= $row_fisik->Price;
					$Currency			= $row_fisik->Currency;

					// Convert USD TO IDR
					if ($Currency == "USD") {
						$price = $nilaikurs * $price;
					}
					// BATAS CONVERT USD TO IDR


					//insert ke table trx_bd
					$data_insert				= array(
						'id_bh'				 		=> $id_bh,
						'id_service'				=> $id_service,
						'code_service' 				=> $code_service,
						'type_charge_rule' 			=> $type_charge_rule,
						'split' 					=> 1,
						'price' 					=> $price,
						'price_old'					=> $price,
						'id_billing' 				=> $id_billing,
					);
					$this->m_cashier->insert_trx_bd($data_insert);
				}

				foreach ($data['data_grp']->result() as $row_grp) {
					$id_service 		= $row_grp->id_service;
					$code_service 		= $row_grp->id_order;
					$name_service 		= $row_grp->name_service;
					$base_price 		= $row_grp->base_price;
					$normal_price		= $row_grp->normal_price;
					$insurance_price	= $row_grp->insurance_price;
					$company_price		= $row_grp->company_price;

					if ($type_charge_rule == 1) {
						# Base / Employee
						$price = $base_price;
					} elseif ($type_charge_rule == 2) {
						# Normal / Local
						$price = $normal_price;
					} elseif ($type_charge_rule ==  3) {
						# Insurance / Japanese
						$price = $insurance_price;
					} elseif ($type_charge_rule == 5) {
						# Company / Japanese Non Insurance
						$price = $company_price;
					}

					//insert ke table trx_bd
					$data_insert				= array(
						'id_bh'				 		=> $id_bh,
						'id_service'				=> $id_service,
						'name_service'				=> $name_service,
						'code_service' 				=> 14,
						'type_charge_rule' 			=> $type_charge_rule,
						'split' 					=> 1,
						'price' 					=> $price,
						'price_old'					=> $price,
						'id_billing' 				=> $id_billing,
					);
					$this->m_cashier->insert_trx_bd($data_insert);
				}

				foreach ($data['data_lab']->result() as $row_lab) {
					$id_service 		= $row_lab->id_service;
					$code_service 		= $row_lab->order_type;
					$type_charge_rule 	= $row_lab->pat_charge_rule;
					$price 				= $row_lab->Price;

					if ($price == "") {
						$price = 0;
					}

					//insert ke table trx_bd
					$data_insert				= array(
						'id_bh'				 		=> $id_bh,
						'id_service'				=> $id_service,
						'code_service' 				=> $code_service,
						'type_charge_rule' 			=> $type_charge_rule,
						'split' 					=> 1,
						'price' 					=> $price,
						'price_old' 				=> $price,
						'id_billing' 				=> $id_billing,
					);
					$this->m_cashier->insert_trx_bd($data_insert);
				}

				foreach ($data['data_rad']->result() as $row_rad) {
					$id_service 		= $row_rad->id_service;
					$code_service 		= $row_rad->order_type;
					$type_charge_rule 	= $row_rad->pat_charge_rule;
					$price 				= $row_rad->Price;

					if ($price == "") {
						$price = 0;
					}

					//insert ke table trx_bd
					$data_insert				= array(
						'id_bh'				 		=> $id_bh,
						'id_service'				=> $id_service,
						'code_service' 				=> $code_service,
						'type_charge_rule' 			=> $type_charge_rule,
						'split' 					=> 1,
						'price' 					=> $price,
						'price_old' 				=> $price,
						'id_billing' 				=> $id_billing,
					);
					$this->m_cashier->insert_trx_bd($data_insert);
				}

				$get_data_pharmacy			= $this->m_cashier->get_data_pharmacy($data['id_reg']);

				foreach ($get_data_pharmacy->result() as $row_pharmacy) {
					$id_service 		= $row_pharmacy->drug_id;
					$code_service 		= 13;
					$type_charge_rule 	= $row_pharmacy->pat_charge_rule;
					$price 				= $row_pharmacy->Price;
					$id_price 			= $row_pharmacy->id_price;
					$id_source_trouble 	= $row_pharmacy->pat_charge_rule;

					if ($price == "" || $id_price == "") {
						// echo "msuk notif"; exit();
						$price = 0;
						$get_smart_notification	= $this->m_cashier->get_smart_notification($id_reg, $id_service, $id_source_trouble, 13);
						$num_oi					= $get_smart_notification->num_rows();

						if ($num_oi == 0) {
							$data_insert				= array(
								'id_reg'				 	=> $id_reg,
								'id_trouble'				=> $id_service,
								'type_id'					=> 13,
								'notes' 					=> 'Open Billing',
								'id_source_trouble' 		=> $id_source_trouble,
							);
							$this->m_cashier->save_smart_notif($data_insert);
						}
					}

					$data_insert				= array(
						'id_bh'				 		=> $id_bh,
						'id_service'				=> $id_service,
						'code_service' 				=> $code_service,
						'type_charge_rule' 			=> $type_charge_rule,
						'split' 					=> 1,
						'price' 					=> $price,
						'price_old' 				=> $price,
						'id_billing' 				=> $id_billing,
					);
					$this->m_cashier->insert_trx_bd($data_insert);
				}


				foreach ($cek->result() as $rows) {
					$id_bh 				= $rows->id_bh;
					$id_reg_bh 			= $rows->id_reg;
					$age				= $rows->age;
					$status 			= $rows->status;
					$create_by 			= $rows->create_by;
					$create_date 		= $rows->create_date;
				}

				$cek_harga					= $this->m_cashier->cek_harga($id_bh);
				foreach ($cek_harga->result() as $row) {


					if ($row->order_id == 0) {
						$id_trouble = $row->id_service;
					} else {
						$id_trouble = $row->order_id;
					}

					$get_smart_rad	= $this->m_cashier->get_smart_rad($row->id_service, $row->type_charge_rule);
					$num_rowsrad	= $get_smart_rad->num_rows();

					if ($num_rowsrad == 0) {
						$get_smart_notification	= $this->m_cashier->get_smart_notification($id_reg, $id_trouble, $row->type_charge_rule, $row->code_service);
						$num_oi					= $get_smart_notification->num_rows();

						if ($num_oi == 0) {
							$data_insert				= array(
								'id_reg'				 	=> $id_reg,
								'id_trouble'				=> $id_trouble,
								'type_id'					=> 2,
								'notes' 					=> 'Open Billing',
								'id_source_trouble' 		=> $row->type_charge_rule,
							);
							$this->m_cashier->save_smart_notif($data_insert);
						}
					}
				}

				//Create Log Start
				$session_data 			= $this->session->userdata('logged_in');
				$user_id				= $session_data['id'];
				$data_log = array(
					'id_user'						=> $user_id,
					'log_date'						=> date("Y-m-d H:i:s"),
					'log_desc' 						=> "Input Billing ke table trx_bh | ID Registration : " . $data['id_reg'] . "",
				);
				$this->load->model('m_login');
				$this->m_login->log($data_log);
				//Endless Log

				// Jika sudah ada data maka masuk kedalam else yang dibawah ini..
			} else {

				foreach ($cek->result() as $rows) {
					$id_bh 				= $rows->id_bh;
					$id_reg_bh 			= $rows->id_reg;
					$age				= $rows->age;
					$status 			= $rows->status;
					$create_by 			= $rows->create_by;
					$create_date 		= $rows->create_date;
				}

				$cek_harga					= $this->m_cashier->cek_harga($id_bh);
				foreach ($cek_harga->result() as $row) {


					if ($row->order_id == 0) {
						$id_trouble = $row->id_service;
					} else {
						$id_trouble = $row->order_id;
					}

					$get_smart_rad	= $this->m_cashier->get_smart_rad($row->id_service, $row->type_charge_rule);
					$num_rowsrad	= $get_smart_rad->num_rows();

					if ($num_rowsrad == 0) {
						$get_smart_notification	= $this->m_cashier->get_smart_notification($id_reg, $id_trouble, $row->type_charge_rule, $row->code_service);
						$num_oi					= $get_smart_notification->num_rows();

						if ($num_oi == 0) {
							$data_insert				= array(
								'id_reg'				 	=> $id_reg,
								'id_trouble'				=> $id_trouble,
								'type_id'					=> $row->code_service,
								'notes' 					=> 'Open Billing',
								'id_source_trouble' 		=> $row->type_charge_rule,
							);
							$this->m_cashier->save_smart_notif($data_insert);
						}
					}
				}


				// Jika statusnya masih kosong maka di hapus dan di masukan data baru seperti dibawah ini
				if ($status == 0) {

					$max_billing					= $this->m_cashier->get_max_trx_billing($id_reg);

					foreach ($max_billing->result() as $rowb) {
						$data['id_billing']			= $rowb->id_billing;
					}

					$id_billing						= $data['id_billing'];

					$this->m_cashier->del_list_trx_bh($id_bh);
					$this->m_cashier->del_list_trx_bd($id_bh);

					$data_insert				= array(
						'id_reg'				 	=> $data['id_reg'],
						'id_pat'				 	=> $data['id_pat'],
						'age'						=> $data['age'],
						'status' 					=> 0,
						'create_by' 				=> $create_by,
						'create_date' 				=> $create_date,
					);
					$this->m_cashier->insert_trx_bh($data_insert);

					$cek2	= $this->m_cashier->get_list_trx_bh($data['id_reg']);

					foreach ($cek2->result() as $rows) {
						$id_bh 				= $rows->id_bh;
						$id_reg_bh 			= $rows->id_reg;
						$status 			= $rows->status;
					}

					foreach ($data_mcu->result() as $row_mcu) {
						$id_package 		= $row_mcu->id_quot;
						$type_charge_rule 	= $row_mcu->pat_charge_rule;
						$grand_total 		= $row_mcu->grand_price;

						//insert ke table trx_bd
						$data_insert				= array(
							'id_bh'				 		=> $id_bh,
							'id_service'				=> $id_package,
							'code_service' 				=> 12,
							'type_charge_rule' 			=> $type_charge_rule,
							'split' 					=> 1,
							'price' 					=> $grand_total,
							'price_old' 				=> $grand_total,
							'id_billing' 				=> $id_billing,
						);
						$this->m_cashier->insert_trx_bd($data_insert);
					}


					foreach ($data['data_fisik']->result() as $row_fisik) {
						$id_service 		= $row_fisik->id_service;
						$code_service 		= $row_fisik->order_type;
						$type_charge_rule 	= $row_fisik->pat_charge_rule;
						$price 				= $row_fisik->Price;
						$Currency			= $row_fisik->Currency;

						// Convert USD TO IDR
						if ($Currency == "USD") {
							$price = $nilaikurs * $price;
						}
						// BATAS CONVERT USD TO IDR


						//insert ke table trx_bd
						$data_insert				= array(
							'id_bh'				 		=> $id_bh,
							'id_service'				=> $id_service,
							'code_service' 				=> $code_service,
							'type_charge_rule' 			=> $type_charge_rule,
							'split' 					=> 1,
							'price' 					=> $price,
							'price_old'					=> $price,
							'id_billing' 				=> $id_billing,
						);
						$this->m_cashier->insert_trx_bd($data_insert);
					}

					foreach ($data['data_grp']->result() as $row_grp) {
						$id_service 		= $row_grp->id_service;
						$code_service 		= $row_grp->id_order;
						$name_service 		= $row_grp->name_service;
						$base_price 		= $row_grp->base_price;
						$normal_price		= $row_grp->normal_price;
						$insurance_price	= $row_grp->insurance_price;
						$company_price		= $row_grp->company_price;

						if ($type_charge_rule == 1) {
							# Base / Employee
							$price = $base_price;
						} elseif ($type_charge_rule == 2) {
							# Normal / Local
							$price = $normal_price;
						} elseif ($type_charge_rule ==  3) {
							# Insurance / Japanese
							$price = $insurance_price;
						} elseif ($type_charge_rule == 5) {
							# Company / Japanese Non Insurance
							$price = $company_price;
						}

						//insert ke table trx_bd
						$data_insert				= array(
							'id_bh'				 		=> $id_bh,
							'id_service'				=> $id_service,
							'name_service'				=> $name_service,
							'code_service' 				=> 14,
							'type_charge_rule' 			=> $type_charge_rule,
							'split' 					=> 1,
							'price' 					=> $price,
							'price_old'					=> $price,
							'id_billing' 				=> $id_billing,
						);
						$this->m_cashier->insert_trx_bd($data_insert);
					}

					foreach ($data['data_lab']->result() as $row_lab) {
						$id_service 		= $row_lab->id_service;
						$code_service 		= $row_lab->order_type;
						$type_charge_rule 	= $row_lab->pat_charge_rule;
						$price 				= $row_lab->Price;

						//insert ke table trx_bd
						$data_insert				= array(
							'id_bh'				 		=> $id_bh,
							'id_service'				=> $id_service,
							'code_service' 				=> $code_service,
							'type_charge_rule' 			=> $type_charge_rule,
							'split' 					=> 1,
							'price' 					=> $price,
							'price_old' 				=> $price,
							'id_billing' 				=> $id_billing,
						);
						$this->m_cashier->insert_trx_bd($data_insert);
					}

					foreach ($data['data_rad']->result() as $row_rad) {
						$id_service 		= $row_rad->id_service;
						$code_service 		= $row_rad->order_type;
						$type_charge_rule 	= $row_rad->pat_charge_rule;
						$price 				= $row_rad->Price;

						//insert ke table trx_bd
						$data_insert				= array(
							'id_bh'				 		=> $id_bh,
							'id_service'				=> $id_service,
							'code_service' 				=> $code_service,
							'type_charge_rule' 			=> $type_charge_rule,
							'split' 					=> 1,
							'price' 					=> $price,
							'price_old' 				=> $price,
							'id_billing' 				=> $id_billing,
						);
						$this->m_cashier->insert_trx_bd($data_insert);
					}

					$get_data_pharmacy			= $this->m_cashier->get_data_pharmacy($data['id_reg']);

					foreach ($get_data_pharmacy->result() as $row_pharmacy) {
						$id_service 		= $row_pharmacy->drug_id;
						$code_service 		= 13;
						$type_charge_rule 	= $row_pharmacy->pat_charge_rule;
						$price 				= $row_pharmacy->Price;
						$id_price 			= $row_pharmacy->id_price;
						$id_source_trouble	= $row_pharmacy->pat_charge_rule;

						if ($price == "" || $id_price == "") {
							// echo "msuk notif"; exit();
							$price = 0;
							$get_smart_notification	= $this->m_cashier->get_smart_notification($id_reg, $id_service, $id_source_trouble, 13);
							$num_oi					= $get_smart_notification->num_rows();

							if ($num_oi == 0) {
								$data_insert				= array(
									'id_reg'				 	=> $id_reg,
									'id_trouble'				=> $id_service,
									'type_id'					=> 13,
									'notes' 					=> 'Open Billing',
									'id_source_trouble' 		=> $id_source_trouble,
								);
								$this->m_cashier->save_smart_notif($data_insert);
							}
						}

						$data_insert				= array(
							'id_bh'				 		=> $id_bh,
							'id_service'				=> $id_service,
							'code_service' 				=> $code_service,
							'type_charge_rule' 			=> $type_charge_rule,
							'split' 					=> 1,
							'price' 					=> $price,
							'price_old' 				=> $price,
							'id_billing' 				=> $id_billing,
						);
						$this->m_cashier->insert_trx_bd($data_insert);
					}


					//Create Log Start
					$session_data 			= $this->session->userdata('logged_in');
					$user_id				= $session_data['id'];
					$data_log = array(
						'id_user'						=> $user_id,
						'log_date'						=> date("Y-m-d H:i:s"),
						'log_desc' 						=> "Input Billing ke table trx_bh | ID Registration : " . $data['id_reg'] . "",
					);
					$this->load->model('m_login');
					$this->m_login->log($data_log);
					//Endless Log
				} // Tutup Status 0
			} // Tutup Else

			$data['bill_date1']			= date("Y-m-d H:i:s");
			$data['bill_date2']			= date("Y-m-d H:i:s");
			$data['bill_date3']			= date("Y-m-d H:i:s");

			$ambilnobill1				= $this->m_cashier->get_billing_split($data['id_reg'], 1);
			$ambilnobill2				= $this->m_cashier->get_billing_split($data['id_reg'], 2);
			$ambilnobill3				= $this->m_cashier->get_billing_split($data['id_reg'], 3);

			$data['id_billing1']		= "";
			$data['id_billing2']		= "";
			$data['id_billing3']		= "";

			foreach ($ambilnobill1->result() as $row1) {
				$data['id_billing1']		= $row1->id_billing;
				$data['bill_no1']			= $row1->bill_no;
				$data['bill_date1']			= $row1->bill_date;
			}

			foreach ($ambilnobill2->result() as $row2) {
				$data['id_billing2']		= $row2->id_billing;
				$data['bill_no2']			= $row2->bill_no;
				$data['bill_date2']			= $row2->bill_date;
			}

			foreach ($ambilnobill3->result() as $row3) {
				$data['id_billing3']		= $row3->id_billing;
				$data['bill_no3']			= $row3->bill_no;
				$data['bill_date3']			= $row3->bill_date;
			}


			$data['get_billing_mcu_list']	= $this->m_cashier->get_billing_data_mcu($data['id_reg']);
			$data['get_max_split_trx_bd']	= $this->m_cashier->get_max_split_trx_bd($data['id_reg']);
			$data['giant']					= $this->m_cashier->get_list_trx_bh($data['id_reg']);
			$data['get_order_type']    		= $this->m_cashier->get_order_type($id_bh);

			// Untuk split yang pertama
			$data['get_order_type_urut']    = $this->m_cashier->get_order_type_urut($id_bh, 1);
			$data['fisik_billing']  		= $this->m_cashier->get_data_billing($data['id_reg'], 0, 1); // seperti fisik
			$data['group_billing']  		= $this->m_cashier->get_billing_group_item($data['id_reg'], 14, 1); // Group Items
			$data['lab_billing']   			= $this->m_cashier->get_data_billing($data['id_reg'], 1, 1); // seperti lab
			$data['rad_billing']   			= $this->m_cashier->get_data_billing($data['id_reg'], 2, 1); // seperti rad
			$data['pharmacy']   			= $this->m_cashier->get_view_pharmacy($data['id_reg'], 13, 1); // seperti pharmacy
			$data['lain']   				= $this->m_cashier->get_data_billing_other($data['id_reg'], 1); // lainnya
			$data['other']   				= $this->m_cashier->get_billing_item_request($data['id_reg'], 1); // lainnya
			$data['total']   				= $this->m_cashier->get_billing_reg($data['id_reg'], $data['id_billing1']); // Total 
			//Untuk split yang kedua
			$data['get_order_type_urut2']   = $this->m_cashier->get_order_type_urut($id_bh, 2);
			$data['fisik_billing2']  		= $this->m_cashier->get_data_billing($data['id_reg'], 0, 2); // seperti fisik
			$data['group_billing2']  		= $this->m_cashier->get_billing_group_item($data['id_reg'], 14, 2); // Group Items
			$data['lab_billing2']   		= $this->m_cashier->get_data_billing($data['id_reg'], 1, 2); // seperti lab
			$data['rad_billing2']   		= $this->m_cashier->get_data_billing($data['id_reg'], 2, 2); // seperti rad
			$data['pharmacy2']   			= $this->m_cashier->get_view_pharmacy($data['id_reg'], 13, 2); // seperti pharmacy
			$data['lain2']   				= $this->m_cashier->get_data_billing_other($data['id_reg'], 2); // lainnya
			$data['other2']   				= $this->m_cashier->get_billing_item_request($data['id_reg'], 2); // lainnya
			$data['total2']   				= $this->m_cashier->get_billing_reg($data['id_reg'], $data['id_billing2']); // Total 
			//Untuk split yang ketiga
			$data['get_order_type_urut3']   = $this->m_cashier->get_order_type_urut($id_bh, 3);
			$data['fisik_billing3']  		= $this->m_cashier->get_data_billing($data['id_reg'], 0, 3); // seperti fisik
			$data['group_billing3']  		= $this->m_cashier->get_billing_group_item($data['id_reg'], 14, 3); // Group Items
			$data['lab_billing3']   		= $this->m_cashier->get_data_billing($data['id_reg'], 1, 3); // seperti lab
			$data['rad_billing3']   		= $this->m_cashier->get_data_billing($data['id_reg'], 2, 3); // seperti rad
			$data['pharmacy3']   			= $this->m_cashier->get_view_pharmacy($data['id_reg'], 13, 3); // seperti pharmacy
			$data['lain3']   				= $this->m_cashier->get_data_billing_other($data['id_reg'], 3); // lainnya
			$data['other3']   				= $this->m_cashier->get_billing_item_request($data['id_reg'], 3); // lainnya
			$data['total3']   				= $this->m_cashier->get_billing_reg($data['id_reg'], $data['id_billing3']); // Total 

			$this->template->set('title', 'Klinik | Input Billing');
			$this->template->load('template', 'menu/input_billing_process', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	} // tutup function

	function upgrade_billing()
	{

		if ($this->session->userdata('logged_in')) {

			$id_bh 							= $this->uri->segment(3);
			$type_charge_rule 				= $this->uri->segment(4);
			$cek							= $this->m_cashier->get_list_trx_bh2($id_bh);

			foreach ($cek->result() as $rows) {
				$id_bh 				= $rows->id_bh;
				$id_reg_bh 			= $rows->id_reg;
				$id_pat_bh			= $rows->id_pat;
				$pat_name			= $rows->pat_name;
				$id_client			= $rows->id_client;
				$client_name		= $rows->client_name;
				$id_package			= $rows->id_package;
				$package_name		= $rows->package_name;
				$age				= $rows->age;
				$status 			= $rows->status;
				$create_by 			= $rows->create_by;
				$create_date 		= $rows->create_date;
			}

			$session_data 					= $this->session->userdata('logged_in');
			$data['userlevel']				= $session_data['userlevel'];
			$data['menu_level']				= $session_data['jobs'];
			$user_id						= $session_data['id'];
			$data['username'] 				= $session_data['username'];
			$data['loc'] 					= $session_data['location'];
			$now							= date("Y-m-d H:i:s");

			$data['id_reg'] 				= $id_reg_bh;
			$data['id_pat']					= $id_pat_bh;
			$data['pat_name']				= $pat_name;
			$data['age']					= $age;
			$data['client_name']			= $client_name;
			$data['id_client']				= $id_client;
			$data['package_name']			= $package_name;
			$data['id_package']				= $id_package;
			$id_reg 						= $id_reg_bh;

			$cek_bill 						= $this->m_cashier->get_billing_reg1($id_reg);

			foreach ($cek_bill->result() as $row) {
				$id_billing 				= $row->id_billing;
			}

			$data['get_charge_rule']    	= $this->m_registration->get_mst_charge_rule();
			$data['find'] 					= $this->m_cashier->get_data_patien_reg($data['id_reg']);
			$data['data_fisik']				= $this->m_cashier->get_data_patien($data['id_reg']); //Fisik
			$data['data_lab']				= $this->m_cashier->get_data_lab_patien($data['id_reg']); //Lab
			$data['data_rad']				= $this->m_cashier->get_data_rad_patien($data['id_reg']); //Rad
			$babydragon						= array();

			foreach ($data['find']->Result() as $row) {
				$id_service 				= $row->id_service;
				$dodol 						= $row->dodol;
				$babydragon 				= $dodol;
			}

			$data_mcu						= $this->m_cashier->get_billing_mcu($data['id_reg'], $babydragon);
			$cek							= $this->m_cashier->get_list_trx_bh($data['id_reg']);
			$jml							= $cek->num_rows();
			$status 						= "";
			$id_bh 							= "";
			$create_by 						= $user_id;
			$create_date 					= date("Y-m-d H:i:s");

			foreach ($cek->result() as $rows) {
				$id_bh 				= $rows->id_bh;
				$id_reg_bh 			= $rows->id_reg;
				$age				= $rows->age;
				$status 			= $rows->status;
				$create_by 			= $rows->create_by;
				$create_date 		= $rows->create_date;
			}

			$update_trx_bh = array(
				'status' => 1,
			);
			$this->m_cashier->update_status_trx_bh($id_bh, $update_trx_bh);

			$update_trx_bd = array(
				'type_charge_rule' => $type_charge_rule,
			);
			$this->m_cashier->update_status_trx_bd($id_bh, $update_trx_bd);

			$this->m_cashier->sys_data_billing($id_reg, 0);
			$this->m_cashier->sys_data_billing($id_reg, 1);
			$this->m_cashier->sys_data_billing($id_reg, 2);

			$data['status_bh'] 			= $status;
			$data['bill_date1']			= date("Y-m-d H:i:s");
			$data['bill_date2']			= date("Y-m-d H:i:s");
			$data['bill_date3']			= date("Y-m-d H:i:s");

			$ambilnobill1				= $this->m_cashier->get_billing_split($data['id_reg'], 1);
			$ambilnobill2				= $this->m_cashier->get_billing_split($data['id_reg'], 2);
			$ambilnobill3				= $this->m_cashier->get_billing_split($data['id_reg'], 3);

			$data['id_billing1']		= "";
			$data['id_billing2']		= "";
			$data['id_billing3']		= "";

			foreach ($ambilnobill1->result() as $row1) {
				$data['id_billing1']		= $row1->id_billing;
				$data['bill_no1']			= $row1->bill_no;
				$data['bill_date1']			= $row1->bill_date;
			}

			foreach ($ambilnobill2->result() as $row2) {
				$data['id_billing2']		= $row2->id_billing;
				$data['bill_no2']			= $row2->bill_no;
				$data['bill_date2']			= $row2->bill_date;
			}

			foreach ($ambilnobill3->result() as $row3) {
				$data['id_billing3']		= $row3->id_billing;
				$data['bill_no3']			= $row3->bill_no;
				$data['bill_date3']			= $row3->bill_date;
			}


			$data['get_billing_mcu_list']	= $this->m_cashier->get_billing_data_mcu($data['id_reg']);
			$data['get_max_split_trx_bd']	= $this->m_cashier->get_max_split_trx_bd($data['id_reg']);
			$data['giant']					= $this->m_cashier->get_list_trx_bh($data['id_reg']);
			$data['get_order_type']    		= $this->m_cashier->get_order_type($id_bh);

			// Untuk split yang pertama
			$data['get_order_type_urut']    = $this->m_cashier->get_order_type_urut($id_bh, 1);
			$data['fisik_billing']  		= $this->m_cashier->get_data_billing($data['id_reg'], 0, 1); // seperti fisik
			$data['lab_billing']   			= $this->m_cashier->get_data_billing($data['id_reg'], 1, 1); // seperti lab
			$data['rad_billing']   			= $this->m_cashier->get_data_billing($data['id_reg'], 2, 1); // seperti rad
			$data['pharmacy']   			= $this->m_cashier->get_view_pharmacy($data['id_reg'], 13, 1); // seperti pharmacy
			$data['lain']   				= $this->m_cashier->get_data_billing_other($data['id_reg'], 1); // lainnya
			$data['other']   				= $this->m_cashier->get_billing_item_request($data['id_reg'], 1); // lainnya
			$data['total']   				= $this->m_cashier->get_billing_reg($data['id_reg'], $data['id_billing1']); // Total 
			//Untuk split yang kedua
			$data['get_order_type_urut2']   = $this->m_cashier->get_order_type_urut($id_bh, 2);
			$data['fisik_billing2']  		= $this->m_cashier->get_data_billing($data['id_reg'], 0, 2); // seperti fisik
			$data['lab_billing2']   		= $this->m_cashier->get_data_billing($data['id_reg'], 1, 2); // seperti lab
			$data['rad_billing2']   		= $this->m_cashier->get_data_billing($data['id_reg'], 2, 2); // seperti rad
			$data['pharmacy2']   			= $this->m_cashier->get_view_pharmacy($data['id_reg'], 13, 2); // seperti pharmacy
			$data['lain2']   				= $this->m_cashier->get_data_billing_other($data['id_reg'], 2); // lainnya
			$data['other2']   				= $this->m_cashier->get_billing_item_request($data['id_reg'], 2); // lainnya
			$data['total2']   				= $this->m_cashier->get_billing_reg($data['id_reg'], $data['id_billing2']); // Total 
			//Untuk split yang ketiga
			$data['get_order_type_urut3']   = $this->m_cashier->get_order_type_urut($id_bh, 3);
			$data['fisik_billing3']  		= $this->m_cashier->get_data_billing($data['id_reg'], 0, 3); // seperti fisik
			$data['lab_billing3']   		= $this->m_cashier->get_data_billing($data['id_reg'], 1, 3); // seperti lab
			$data['rad_billing3']   		= $this->m_cashier->get_data_billing($data['id_reg'], 2, 3); // seperti rad
			$data['pharmacy3']   			= $this->m_cashier->get_view_pharmacy($data['id_reg'], 13, 3); // seperti pharmacy
			$data['lain3']   				= $this->m_cashier->get_data_billing_other($data['id_reg'], 3); // lainnya
			$data['other3']   				= $this->m_cashier->get_billing_item_request($data['id_reg'], 3); // lainnya
			$data['total3']   				= $this->m_cashier->get_billing_reg($data['id_reg'], $data['id_billing3']); // Total 

			$this->template->set('title', 'Klinik | Input Billing');
			$this->template->load('template', 'menu/input_billing_process', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	} // tutup function


	function split_billing()
	{
		if ($this->session->userdata('logged_in')) {

			$session_data			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data['userlevel']		= $session_data['userlevel'];
			$data['username']		= $session_data['username'];
			$now					= date("Y-m-d H:i:s");
			$params					= $this->input->post('params');
			$var					= explode(",", $params);
			$id_bd					= $var[0];
			$type_charge_rule		= $var[1];
			$split					= $var[2];
			$jml 					= $split + 1;
			$id_bh					= $var[3];
			$cek					= $this->m_cashier->get_list_trx_bh($id_bh);


			foreach ($cek->result() as $rows) {
				$id_bh 				= $rows->id_bh;
				$id_reg 			= $rows->id_reg;
				$id_pat				= $rows->id_pat;
				$age				= $rows->age;
				$status 			= $rows->status;
				$create_by 			= $rows->create_by;
				$create_date 		= $rows->create_date;
			}


			// khusus generate billing dibawah ini...
			$seq_bill						= $this->m_cashier->get_num_billing();
			$numbilling						= $this->m_cashier->get_billing_split($id_reg, $jml);
			$jumlahbill						= $numbilling->num_rows();
			$nobilll						= $seq_bill->num_rows();

			$tambahan						= $nobilll + 1;
			$nomorbill						= "BN/" . date("Y") . "/" . date("m") . "/" . $tambahan;

			if ($jumlahbill == 0) {

				$insert_billing					= array(
					'id_reg'				 		=> $id_reg,
					'bill_no'				 		=> $nomorbill,
					'seq_no'				 		=> $tambahan,
					'create_by' 					=> $user_id,
					'create_date' 					=> date("Y-m-d H:i:s"),
					'bill_date' 					=> date("Y-m-d H:i:s"),
				);
				$this->m_cashier->insert_trx_billing($insert_billing);
			}

			$max_billing					= $this->m_cashier->get_max_trx_billing($id_reg);

			foreach ($max_billing->result() as $rowb) {
				$data['id_billing']			= $rowb->id_billing;
			}

			$id_billing						= $data['id_billing'];

			// khusus generate billing diatas ini...



			if ($jml < 4) { //Membataskan split

				$update_trx_bh = array(
					'status' => 3,
				);
				$this->m_cashier->update_status_trx_bh($id_bh, $update_trx_bh);

				$data_update 			= array(
					'type_charge_rule' 		=> $type_charge_rule,
					'split' 				=> $jml,
					'id_billing' 			=> $id_billing,
				);
				$this->m_cashier->update_status_trx_bd2($id_bd, $data_update);

				//Untuk syscrone harga

			}


			$this->m_cashier->sys_data_billing($id_reg, 0);
			$this->m_cashier->sys_data_billing($id_reg, 1);
			$this->m_cashier->sys_data_billing($id_reg, 2);

			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data_log = array(
				'id_user'						=> $user_id,
				'log_date'						=> date("Y-m-d H:i:s"),
				'log_desc' 						=> "Split Billing, dengan id billing : " . $data['id_billing'] . "",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log

		} else {

			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	} // Tutup Function

	function bill_other()
	{
		if ($this->session->userdata('logged_in')) {

			$data['id_reg']			= $this->uri->segment(3);
			$data['id_split']		= $this->uri->segment(4);
			$data['id_billing']		= $this->uri->segment(5);
			$session_data			= $this->session->userdata('logged_in');
			$data['id']				= $session_data['id'];
			$data['username']		= $session_data['username'];
			$data['userlevel']		= $session_data['userlevel'];

			$this->template->set('title', 'Klinik | Add Other Billing');
			$this->template->load('template', 'menu/bill_other', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi mencari medical services
	function find_services()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_cashier->get_list_services();
			$this->template->set('title', 'Klinik | Find Services');
			$this->template->load('template', 'menu/find_services_cashier', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function save_other_bill()
	{
		if ($this->session->userdata('logged_in')) {

			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data['userlevel']		= $session_data['userlevel'];
			$data['username']		= $session_data['username'];
			$data['find'] 			= $this->m_cashier->get_list_services();
			$rowcount				= $this->input->post('rowcount');
			$id_reg					= $this->input->post('id_reg');
			$id_split				= $this->input->post('id_split');
			$id_billing				= $this->input->post('id_billing');
			$cek					= $this->m_cashier->get_list_trx_bh($id_reg);

			foreach ($cek->result() as $rows) {
				$id_bh 				= $rows->id_bh;
				$id_reg_bh 			= $rows->id_reg;
				$id_pat_bh			= $rows->id_pat;
				$age				= $rows->age;
				$status 			= $rows->status;
				$create_by 			= $rows->create_by;
				$create_date 		= $rows->create_date;
			}

			$detail					= $this->m_cashier->get_type_change_rule($id_bh, $id_split);

			foreach ($detail->result() as $rowd) {
				$type_charge_rule 	= $rowd->type_charge_rule;
			}

			$id_item_request_h 	= "";

			for ($a = 1; $a <= $rowcount; $a++) {

				// Untuk yang sudah ada datanya..
				if ($this->input->post('cadangan[' . $a . ']') == 0) {

					$service_name		= $this->input->post('service[' . $a . ']');
					$price				= $this->input->post('jumlah[' . $a . ']');
					$id_service			= $this->input->post('id_service[' . $a . ']');

					//insert ke table trx_bd
					$data_insert				= array(
						'id_bh'				 		=> $id_bh,
						'id_service'				=> $id_service,
						'code_service' 				=> 4,
						'type_charge_rule' 			=> $type_charge_rule,
						'split' 					=> $id_split,
						'price' 					=> $price,
						'id_billing' 				=> $id_billing,
					);
					$this->m_cashier->insert_trx_bd($data_insert);
				} // Tutup, Untuk yang sudah ada datanya..

				// Untuk yang belum ada datanya...
				if ($this->input->post('cadangan[' . $a . ']') == 1) {


					$data_insert 			= array(
						'id_pr_no'			=> 0,
						'source'			=> "Billing Request",
						'create_by'			=> $user_id,
						'create_date'		=> date("Y-m-d H:i:s"),
					);
					$this->m_inv->insert_item_request_header($data_insert);

					$cekheader 		= $this->m_inv->get_max_item_request_header();
					foreach ($cekheader->result() as $rows) {
						$id_item_request_h	= $rows->id_item_request_h;
					}

					// if ($id_item_request_h == "") {


					// 	$data_insert 			= array(
					// 		'id_pr_no'			=> 0,
					// 		'source'			=>"Billing Request",
					// 		'create_by'			=>$user_id,
					// 		'create_date'		=>date("Y-m-d H:i:s"),			
					// 	);
					// 	$this->m_inv->insert_item_request_header($data_insert);
					// }

					$data_insert 			= array(
						'id_item_request_h'	=> $id_item_request_h,
						'item_product'		=> $this->input->post('service[' . $a . ']'),
						'item_qty'			=> $this->input->post('qty[' . $a . ']'),
						'item_uom'			=> $this->input->post('base[' . $a . ']'),
						'price'				=> $this->input->post('fulus[' . $a . ']'),
						'remarks'			=> $this->input->post('remarks[' . $a . ']'),
					);
					$this->m_inv->insert_item_request_detail($data_insert);

					//insert ke table trx_bd
					$data_insert				= array(
						'id_bh'				 		=> $id_bh,
						'name_service'				=> $this->input->post('service[' . $a . ']'),
						'type_charge_rule' 			=> $type_charge_rule,
						'split' 					=> $id_split,
						'price' 					=> $this->input->post('jumlah[' . $a . ']'),
						'id_item_request_h'			=> $id_item_request_h,
					);
					$this->m_cashier->insert_trx_bd($data_insert);
				} // Tutup, Untuk yang belum ada datanya..
			} //Tutup Looping

			$update_trx_bh = array(
				'status' => 5,
			);
			$this->m_cashier->update_status_trx_bh($id_bh, $update_trx_bh);


			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data_log = array(
				'id_user'						=> $user_id,
				'log_date'						=> date("Y-m-d H:i:s"),
				'log_desc' 						=> "Menambahkan Tindakan lainnya, dengan id billing : " . $id_billing . "",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log

			// echo "test";

			echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function save_bill()
	{
		if ($this->session->userdata('logged_in')) {

			$session_data			= $this->session->userdata('logged_in');
			$data['id']				= $session_data['id'];
			$data['username']		= $session_data['username'];
			$data['userlevel']		= $session_data['userlevel'];
			$id_reg					= $this->input->post('id_reg');
			$pat_name				= $this->input->post('pat_name');
			$age					= $this->input->post('age');
			$client_name			= $this->input->post('client_name');
			$id_client				= $this->input->post('id_client');
			$package_name			= $this->input->post('package_name');
			$id_package				= $this->input->post('id_package');
			$price_type				= $this->input->post('price_type');
			$price_type1			= $this->input->post('price_type1');
			$price_type2			= $this->input->post('price_type2');
			$price_type3			= $this->input->post('price_type3');
			$grand_total			= $this->input->post('grand_total');
			$grand_total2			= $this->input->post('grand_total2');
			$grand_total3			= $this->input->post('grand_total3');
			$tot_grand_total3		= $grand_total + $grand_total2 + $grand_total3;
			$simpan					= $this->input->post('simpan');
			$cek					= $this->m_cashier->get_list_trx_bh($id_reg);

			foreach ($cek->result() as $rows) {
				$id_bh 				= $rows->id_bh;
				$id_reg 			= $rows->id_reg;
				$age				= $rows->age;
				$status 			= $rows->status;
				$create_by 			= $rows->create_by;
				$create_date 		= $rows->create_date;
			}


			$data['id_reg'] 				= $this->input->post('id_reg');
			$data['id_pat']					= $this->input->post('id_pat');
			$data['pat_name']				= $this->input->post('pat_name');
			$data['age']					= $this->input->post('age');
			$data['client_name']			= $this->input->post('client_name');
			$data['id_client']				= $this->input->post('id_client');
			$data['package_name']			= $this->input->post('package_name');
			$data['id_package']				= $this->input->post('id_package');
			$data['id_billing']				= $this->input->post('id_billing');
			$data['bill_no']				= $this->input->post('bill_no1');
			$id_reg 						= $this->input->post('id_reg');

			$id_billing 		= "";
			$id_billing 		= 0;
			$sumharga 			= 0;
			$jmldisc 			= 0;
			$sumtot 			= 0;

			for ($a = 1; $a <= 3; $a++) {

				if ($a == 1) {
					$price					= $this->input->post('price[]');
					$amount_total			= $this->input->post('amount_total[]');
					$id_bd					= $this->input->post('id_bd[]');
					$type_charge_rule		= $this->input->post('type_charge_rule1');
					$jmlloop				= count($price);
				}
				if ($a == 2) {
					$price					= $this->input->post('price2[]');
					$amount_total			= $this->input->post('amount_total2[]');
					$id_bd					= $this->input->post('id_bd2[]');
					$type_charge_rule		= $this->input->post('type_charge_rule2');
					$jmlloop				= count($price);
				}
				if ($a == 3) {
					$price					= $this->input->post('price3[]');
					$amount_total			= $this->input->post('amount_total3[]');
					$id_bd					= $this->input->post('id_bd3[]');
					$type_charge_rule		= $this->input->post('type_charge_rule3');
					$jmlloop				= count($price);
				}

				$id_billing 		= $this->input->post('id_billing' . $a . '');
				$sumharga 			= $this->input->post('sumharga' . $a . '');
				$jmldisc 			= $this->input->post('jmldisc' . $a . '');
				$sumtot 			= $this->input->post('sumtot' . $a . '');
				$sumtot 			= $this->input->post('sumtot' . $a . '');

				if ($a == 1) {
					$percent		= $this->input->post('disc');
				}
				if ($a == 2) {
					$percent		= $this->input->post('discb');
				}
				if ($a == 3) {
					$percent		= $this->input->post('discc');
				}

				$save_update = array(
					'id_bh' 			=> $id_bh,
					'total' 			=> $sumharga,
					'disc' 				=> $jmldisc,
					'grand_total' 		=> $sumtot,
					'type_charge_rule' 	=> $type_charge_rule,
					'percent' 			=> $percent,
					'status' 			=> 3,
				);
				$this->m_cashier->save_billing($id_billing, $save_update);

				$update_trx_bh = array(
					'status' 		=> 4,
					'update_by'		=> $data['id'],
					'update_date'	=> date("Y-m-d H:i:s"),
				);
				$this->m_cashier->update_status_trx_bh($id_bh, $update_trx_bh);

				for ($x = 0; $x < $jmlloop; $x++) {

					$update_trx_bd 	= array(
						'price' 	=> $amount_total[$x],
					);
					$this->m_cashier->update_trx_bd($id_bd[$x], $update_trx_bd);
				}

				if ($id_billing != "") {
					//delete dahulu invoice yang sudah ada berdasarkan billing
					$this->m_cashier->del_invoice($id_reg, $id_billing);

					//Buat Invoice baru..
					$inv_no							= "IV/" . date("Y/m/");

					$insert_invoice 				= array(
						'inv_no'					=> $inv_no,
						'inv_date'					=> date("Y-m-d H:i:s"),
						'id_billing'				=> $id_billing,
						'id_reg'					=> $id_reg,
						'inv_status'				=> 0,
					);
					$this->m_cashier->save_invoice($insert_invoice);
				}
			} // Tutup Looping

			$data['find'] 					= $this->m_cashier->get_data_patien_reg($id_reg);
			$data['bill'] 					= $this->m_cashier->get_list_billing($id_billing);
			$data['ch_bill']				= $this->m_cashier->get_type_ch_payment($id_billing);
			$data['kurs']					= $this->m_cashier->get_kurs_dollar();
			$data['bank']					= $this->m_cashier->get_list_bank();

			if ($simpan == "update") {

				//Create Log Start
				$session_data 			= $this->session->userdata('logged_in');
				$user_id				= $session_data['id'];
				$data_log = array(
					'id_user'						=> $user_id,
					'log_date'						=> date("Y-m-d H:i:s"),
					'log_desc' 						=> "Update Harga Billing, dengan no registrasi :" . $id_reg,
				);
				$this->load->model('m_login');
				$this->m_login->log($data_log);
				//Endless Log

				$this->session->set_flashdata('success', 'Process Complete');
			} else {

				//Create Log Start
				$session_data 			= $this->session->userdata('logged_in');
				$user_id				= $session_data['id'];
				$data_log = array(
					'id_user'						=> $user_id,
					'log_date'						=> date("Y-m-d H:i:s"),
					'log_desc' 						=> "Input Harga Billing, dengan no registrasi :" . $id_reg,
				);
				$this->load->model('m_login');
				$this->m_login->log($data_log);
				//Endless Log

				$this->session->set_flashdata('success', 'Process Complete');
			}

			// --------- proses update status registration ---------
			$data_update = array('status_reg' => 2);
			$this->m_registration->reg_update($id_reg, $data_update);
			// --------- batas proses update status registration ---------


			$this->template->set('title', 'Klinik | Input Billing');
			$this->template->load('template', 'menu/input_billing', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function reset_billing()
	{
		if ($this->session->userdata('logged_in')) {

			$id_reg					= $this->input->post('id_reg');
			$session_data			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data['username']		= $session_data['username'];
			$data['userlevel']		= $session_data['userlevel'];
			$now					= date("Y-m-d H:i:s");
			$alasan					= $this->input->post('alasan');
			$cek					= $this->m_cashier->get_list_trx_bh($id_reg);

			foreach ($cek->result() as $rows) {
				$id_bh 				= $rows->id_bh;
				$id_reg 			= $rows->id_reg;
				$age				= $rows->age;
				$status 			= $rows->status;
				$create_by 			= $rows->create_by;
				$create_date 		= $rows->create_date;
			}


			$update_trx_bh = array(
				'status' 			=> 0,
			);
			$this->m_cashier->update_status_trx_bh($id_bh, $update_trx_bh);


			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data_log = array(
				'id_user'						=> $user_id,
				'log_date'						=> date("Y-m-d H:i:s"),
				'log_desc' 						=> "Reset Billing, dengan id registrasi : " . $id_reg . " dan alasan : " . $alasan,
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log

			$this->m_cashier->del_trx_bd($id_bh);
			$this->m_cashier->del_trx_bh($id_bh);
			$this->m_cashier->del_billing($id_reg);


			$this->template->set('title', 'Klinik | Input Billing');
			$this->template->load('template', 'menu/input_billing', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}


	function payment_list()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data['userlevel']		= $session_data['userlevel'];
			$data['username'] 		= $session_data['username'];
			$data['loc'] 			= $session_data['location'];
			$data['id_bh']          = $this->uri->segment(3);
			$data['id_billing']     = $this->uri->segment(4);

			$this->template->set('title', 'Klinik | Input Payment');
			$this->template->load('template', 'menu/payment_list', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function list_billing()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_cashier->get_list_payment();
			$this->template->set('title', 'Klinik | Find Patient Data');
			$this->template->load('template', 'menu/list_billing', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function invoice_list()
	{
		if ($this->session->userdata('logged_in')) {

			$session_data 							= $this->session->userdata('logged_in');
			$user_id								= $session_data['id'];
			$data['userlevel']						= $session_data['userlevel'];
			$data['username'] 						= $session_data['username'];
			$data['loc'] 							= $session_data['location'];

			$act      								= $this->input->post('act');
			$datereg1 								= date("Y-m-d", strtotime($this->input->post('datereg1')));
			$datereg2 								= date("Y-m-d", strtotime($this->input->post('datereg2')));
			$data['jml'] 							= 0;
			$data['tglawal']						= date("m/d/Y");
			$data['tglakhir']						= date("m/d/Y");


			if ($this->input->post('bf') == "1") {
				$data['nama']  						= $this->input->post('nama');
				$data['divisi']      				= $this->input->post('divisi');
			} else {
				$data['nama']						=  $data['username'];
				$data['divisi']      				=  "";
			}



			if ($act == "View") {

				$data['tglawal'] 					= nice_date($this->input->post('datereg1'), 'm/d/Y');
				$data['tglakhir'] 					= nice_date($this->input->post('datereg2'), 'm/d/Y');
				$data['list_invoice']			 	= $this->m_cashier->get_list_invoice($datereg1, $datereg2);
				$data['jml'] 						= 1;
			}

			$this->template->set('title', 'Klinik | List Invoice');
			$this->template->load('template', 'menu/invoice_list', $data);
		} else {
			redirect('login', 'refresh');
		}
	}

	function list_billing2()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_cashier->get_list_payment2();
			$this->template->set('title', 'Klinik | Find Patient Data');
			$this->template->load('template', 'menu/list_billing', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function print_invoice()
	{
		if ($this->session->userdata('logged_in')) {

			$session_data 					= $this->session->userdata('logged_in');
			$data['username'] 				= $session_data['username'];
			$data['id'] 					= $session_data['id'];


			if ($this->input->post('dev_date') == "") { //Belum input tanggal pengiriman

				$data['id_bh']				= $this->uri->segment(3);
				$data['id_billing']			= $this->uri->segment(4);
				$data['nama'] 				= $this->uri->segment(5);
				$data['divisi'] 			= $this->uri->segment(6);
				$nama						= $this->input->post('nama');
				$divisi						= $this->input->post('divisi');
				$data['sts']				= "no";
				$id_bh 						= $data['id_bh'];
				$id_billing 				= $data['id_billing'];
				$cek						= $this->m_cashier->get_list_trx_bh3($id_bh);

				foreach ($cek->result() as $rows) {
					$id_bh 					= $rows->id_bh;
					$id_reg 				= $rows->id_reg;
					$id_pat_bh				= $rows->id_pat;
					$pat_name				= $rows->pat_name;
					$id_client				= $rows->id_client;
					$client_name			= $rows->client_name;
					$id_package				= $rows->id_package;
					$package_name			= $rows->package_name;
					$age					= $rows->age;
					$status 				= $rows->status;
					$create_by 				= $rows->create_by;
					$create_date 			= $rows->create_date;
				}

				$data['id_reg'] 			= $id_reg;
				$data['id_pat']				= $id_pat_bh;
				$data['pat_name']			= $pat_name;
				$data['age']				= $age;
				$data['client_name']		= $client_name;
				$data['id_client']			= $id_client;
				$data['package_name']		= $package_name;
				$data['id_package']			= $id_package;

				$get_invoice				= $this->m_cashier->get_invoice($id_reg, $id_billing);
				$patient					= $this->m_cashier->get_data_patien_reg($id_reg);
				$get_or						= $this->m_cashier->get_or($id_reg, $id_billing);
				$data['orno'] 				= "";
				$data['invno'] 				= "";
				$data['namatamu'] 			= "-";
				$data['type'] 				= "MCU";

				foreach ($get_invoice->result() as $row_iv) {
					$data['invno'] 		= $row_iv->inv_no;
					$data['inv_date'] 	= $row_iv->delivery_date;

					if ($row_iv->delivery_date == "") {
						$data['invno'] 			= $row_iv->inv_no . "" . str_pad($row_iv->id_invoice, 4, "0", STR_PAD_LEFT);
					}
				}
				foreach ($get_or->result() as $row_or) {
					if ($row_or->id_or != "") {
						$data['orno']  			= $row_or->or_no . "" . str_pad($row_or->id_or, 4, "0", STR_PAD_LEFT);
					}
				}

				foreach ($patient->result() as $row) {
					if ($row->id_package == 0) {
						$type = "Outpatient";
					}
					$data['namatamu'] = $row->client_name;
				}
			} else { // Jika sudah input tanggal pengiriman..

				$data['sts']			= "yes";
				$data['dev_date']		= date("Y-m-d", strtotime($this->input->post('dev_date')));
				$data['id_reg'] 		= $this->input->post('id_reg');
				$data['invno'] 			= $this->input->post('no_invoice');
				$data['id_bh'] 			= $this->input->post('id_bh');
				$data['id_billing'] 	= $this->input->post('id_billing');
				$data['id_pat'] 		= $this->input->post('id_pat');
				$data['age'] 			= $this->input->post('age');
				$data['client_name']	= $this->input->post('client_name');
				$data['id_client'] 		= $this->input->post('id_client');
				$data['package_name'] 	= $this->input->post('package_name');
				$data['id_package'] 	= $this->input->post('id_package');
				$data['pat_name'] 		= $this->input->post('pat_name');
				$data['orno'] 			= $this->input->post('orno');
				$data['namatamu'] 		= $this->input->post('namatamu');
				$data['jenis'] 			= $this->input->post('jenis');
				$data['nama'] 			= $this->input->post('nama');
				$data['divisi']			= $this->input->post('divisi');

				$data_update 			= array(
					'inv_no' 			=> $data['invno'],
					'delivery_date' 	=> $data['dev_date'],
					'updated_by' 		=> $data['id'],
				);
				$this->m_cashier->update_invoice($data['id_reg'], $data['id_billing'], $data_update);

				$data['get_billing_mcu_list']	= $this->m_cashier->get_billing_data_mcu($data['id_reg']);
				$data['patient']				= $this->m_cashier->get_data_patien_reg($data['id_reg']);
				$data['get_order_type_urut']    = $this->m_cashier->get_order_type_urut($data['id_bh'], 1);
				$data['fisik_billing']  		= $this->m_cashier->get_data_billing($data['id_reg'], 0, 1);
				$data['lab_billing']   			= $this->m_cashier->get_data_billing($data['id_reg'], 1, 1);
				$data['rad_billing']   			= $this->m_cashier->get_data_billing($data['id_reg'], 2, 1);
				$data['pharmacy']   			= $this->m_cashier->get_view_pharmacy($data['id_reg'], 13, 1);
				$data['lain']   				= $this->m_cashier->get_data_billing_other($data['id_reg'], 1);
				$data['other']   				= $this->m_cashier->get_billing_item_request($data['id_reg'], 1);
				$data['total']   				= $this->m_cashier->get_billing_reg($data['id_reg'], $data['id_billing']);
			} // Batas else

			$this->load->view('menu/print_invoice', $data);
		} else {
			redirect('login', 'refresh');
		}
	}

	function print_or()
	{
		if ($this->session->userdata('logged_in')) {

			$session_data 					= $this->session->userdata('logged_in');
			$data['username'] 				= $session_data['username'];
			$data['peri'] 					= 1;
			$data['id_bh']					= $this->uri->segment(3);
			$data['id_billing']				= $this->uri->segment(4);
			$data['nama'] 					= $this->uri->segment(5);
			$data['divisi'] 				= $this->uri->segment(6);
			$nama							= $this->input->post('nama');
			$divisi							= $this->input->post('divisi');
			$id_bh 							= $data['id_bh'];
			$id_billing 					= $data['id_billing'];

			$cek							= $this->m_cashier->get_list_trx_bh3($id_bh);

			foreach ($cek->result() as $rows) {
				$id_bh 							= $rows->id_bh;
				$id_reg_bh 						= $rows->id_reg;
				$id_pat_bh						= $rows->id_pat;
				$pat_name						= $rows->pat_name;
				$id_client						= $rows->id_client;
				$client_name					= $rows->client_name;
				$id_package						= $rows->id_package;
				$package_name					= $rows->package_name;
				$age							= $rows->age;
				$status 						= $rows->status;
				$create_by 						= $rows->create_by;
				$create_date 					= $rows->create_date;
			}

			$data['id_reg'] 				= $id_reg_bh;
			$data['id_pat']					= $id_pat_bh;
			$data['pat_name']				= $pat_name;
			$data['age']					= $age;
			$data['client_name']			= $client_name;
			$data['id_client']				= $id_client;
			$data['package_name']			= $package_name;
			$data['id_package']				= $id_package;
			$data['id_billing']				= $id_billing;
			$id_reg 						= $id_reg_bh;

			$data['get_invoice']			= $this->m_cashier->get_invoice($id_reg, $id_billing);
			foreach ($data['get_invoice']->result() as $row_iv) {
				$data['invno'] 				= "";
				if ($row_iv->id_invoice != "") {
					$data['invno'] 			= $row_iv->inv_no . "" . str_pad($row_iv->id_invoice, 4, "0", STR_PAD_LEFT);
				}
			}
			$data['get_or']					= $this->m_cashier->get_or($id_reg, $id_billing);
			foreach ($data['get_or']->result() as $row_or) {
				$data['orno'] 				= "";
				if ($row_or->id_or != "") {
					$data['orno']  			= $row_or->or_no . "" . str_pad($row_or->id_or, 4, "0", STR_PAD_LEFT);
				}
			}


			$data['get_kurs_dollar']		= $this->m_cashier->get_kurs_dollar();
			$data['get_billing_mcu_list']	= $this->m_cashier->get_billing_data_mcu($id_reg);
			$data['patient']				= $this->m_cashier->get_data_patien_reg($id_reg);
			// Untuk split yang pertama
			$data['get_order_type_urut']    = $this->m_cashier->get_order_type_urut($id_bh, 1);
			$data['fisik_billing']  		= $this->m_cashier->get_data_billing($data['id_reg'], 0, 1); // seperti fisik
			$data['lab_billing']   			= $this->m_cashier->get_data_billing($data['id_reg'], 1, 1); // seperti lab
			$data['rad_billing']   			= $this->m_cashier->get_data_billing($data['id_reg'], 2, 1); // seperti rad
			$data['pharmacy']   			= $this->m_cashier->get_view_pharmacy($data['id_reg'], 13, 1); // seperti pharmacy
			$data['lain']   				= $this->m_cashier->get_data_billing_other($data['id_reg'], 1); // lainnya
			$data['other']   				= $this->m_cashier->get_billing_item_request($data['id_reg'], 1); // lainnya
			$data['total']   				= $this->m_cashier->get_billing_reg($data['id_reg'], $id_billing); // Total 

			$this->load->view('menu/print_or', $data);
		} else {
			redirect('login', 'refresh');
		}
	}

	function print_receipt()
	{
		if ($this->session->userdata('logged_in')) {

			$session_data       = $this->session->userdata('logged_in');
			$data['username']   = $session_data['username'];
			$data['peri']       = 1;
			$id_billing         = $this->uri->segment(4);
			$data['id_bh']      = $this->uri->segment(3);
			$data['id_billing'] = $id_billing;
			$nama               = $this->input->post('nama');
			$divisi             = $this->input->post('divisi');
			$id_bh              = $data['id_bh'];
			$data['tgl']        = date("Y-m-d H:i:s");


			$cek							= $this->m_cashier->get_list_trx_bh3($id_bh);

			foreach ($cek->result() as $rows) {
				$id_bh 							= $rows->id_bh;
				$id_reg_bh 						= $rows->id_reg;
				$id_pat_bh						= $rows->id_pat;
				$pat_name						= $rows->pat_name;
				$id_client						= $rows->id_client;
				$client_name					= $rows->client_name;
				$id_package						= $rows->id_package;
				$package_name					= $rows->package_name;
				$age							= $rows->age;
				$status 						= $rows->status;
				$create_by 						= $rows->create_by;
				$create_date 					= $rows->create_date;
			}

			$data['id_reg'] 				= $id_reg_bh;
			$data['id_pat']					= $id_pat_bh;
			$data['pat_name']				= $pat_name;
			$data['age']					= $age;
			$data['client_name']			= $client_name;
			$data['id_client']				= $id_client;
			$data['package_name']			= $package_name;
			$data['id_package']				= $id_package;
			$data['id_billing']				= $id_billing;
			$id_reg 						= $id_reg_bh;
			$data['orno'] 					= "";
			$data['invno'] 					= "";


			$data['get_invoice']			= $this->m_cashier->get_invoice($id_reg, $id_billing);
			foreach ($data['get_invoice']->result() as $row_iv) {
				if ($row_iv->id_invoice != "") {
					$data['invno'] 			= $row_iv->inv_no . "" . str_pad($row_iv->id_invoice, 4, "0", STR_PAD_LEFT);
				}
			}
			$data['get_or']					= $this->m_cashier->get_or($id_reg, $id_billing);
			foreach ($data['get_or']->result() as $row_or) {
				if ($row_or->id_or != "") {
					$data['orno']  			= $row_or->or_no . "" . str_pad($row_or->id_or, 4, "0", STR_PAD_LEFT);
				}
			}


			$data['get_kurs_dollar']		= $this->m_cashier->get_kurs_dollar();
			$data['get_billing_mcu_list']	= $this->m_cashier->get_billing_data_mcu($id_reg);
			$data['patient']				= $this->m_cashier->get_data_patien_reg($id_reg);
			// Untuk split yang pertama
			$data['get_order_type_urut']    = $this->m_cashier->get_order_type_urut($id_bh, 1);
			$data['fisik_billing']  		= $this->m_cashier->get_data_billing($data['id_reg'], 0, 1); // seperti fisik
			$data['lab_billing']   			= $this->m_cashier->get_data_billing($data['id_reg'], 1, 1); // seperti lab
			$data['rad_billing']   			= $this->m_cashier->get_data_billing($data['id_reg'], 2, 1); // seperti rad
			$data['pharmacy']   			= $this->m_cashier->get_view_pharmacy($data['id_reg'], 13, 1); // seperti pharmacy
			$data['lain']   				= $this->m_cashier->get_data_billing_other($data['id_reg'], 1); // lainnya
			$data['other']   				= $this->m_cashier->get_billing_item_request($data['id_reg'], 1); // lainnya
			$data['total']   				= $this->m_cashier->get_billing_reg($data['id_reg'], $data['id_billing']); // Total 

			$data['trx_pat_payment_d'] = $this->m_cashier->trx_pat_payment_d($id_billing);

			$this->load->view('menu/print_receipt', $data);
		} else {
			redirect('login', 'refresh');
		}
	}

	function print_invoice_all()
	{
		if ($this->session->userdata('logged_in')) {

			$session_data 							= $this->session->userdata('logged_in');
			$session_data 							= $this->session->userdata('logged_in');
			$user_id								= $session_data['id'];
			$data['userlevel']						= $session_data['userlevel'];
			$data['username'] 						= $session_data['username'];
			$data['loc'] 							= $session_data['location'];

			$act      								= $this->input->post('act');
			$datereg1 								= date("Y-m-d", strtotime($this->input->post('datereg1')));
			$datereg2 								= date("Y-m-d", strtotime($this->input->post('datereg2')));
			$data['jml'] 							= 0;
			$data['tglawal']						= date("m/d/Y");
			$data['tglakhir']						= date("m/d/Y");


			if ($this->input->post('bf') == "1") {
				$data['nama']  						= $this->input->post('nama');
				$data['divisi']      				= $this->input->post('divisi');
			} else {
				$data['nama']						=  $data['username'];
				$data['divisi']      				=  $data['userlevel'];
			}

			if ($act == "View") {

				$data['tglawal'] 					= nice_date($this->input->post('datereg1'), 'm/d/Y');
				$data['tglakhir'] 					= nice_date($this->input->post('datereg2'), 'm/d/Y');
				$data['list_invoice']			 	= $this->m_cashier->get_list_invoice($datereg1, $datereg2);
				$data['jml'] 						= 1;
			}


			$list_invoice 						= $this->m_cashier->get_list_invoice($datereg1, $datereg2);
			$jmldata	   						= $list_invoice->num_rows();
			$data['jmldata']					= $list_invoice->num_rows();
			foreach ($list_invoice->result() as $row) {
				$arid_bh[]						= $row->id_bh;
				$arid_billing[]					= $row->id_billing;
			}

			for ($i = 0; $i < $jmldata; $i++) {
				$id_billing 							= $arid_billing[$i];
				$cek									= $this->m_cashier->get_list_trx_bh3($arid_bh[$i]);
				foreach ($cek->result() as $rows) {
					$id_bh 									= $rows->id_bh;
					$id_reg_bh 								= $rows->id_reg;
					$id_pat_bh								= $rows->id_pat;
					$pat_name								= $rows->pat_name;
					$id_client								= $rows->id_client;
					$client_name							= $rows->client_name;
					$id_package								= $rows->id_package;
					$package_name							= $rows->package_name;
					$age									= $rows->age;
					$status 								= $rows->status;
					$create_by 								= $rows->create_by;
					$create_date 							= $rows->create_date;
				}

				$data['id_reg'] 						= $id_reg_bh;
				$data['id_pat']							= $id_pat_bh;
				$data['pat_name']						= $pat_name;
				$data['age']							= $age;
				$data['client_name']					= $client_name;
				$data['id_client']						= $id_client;
				$data['package_name']					= $package_name;
				$data['id_package']						= $id_package;
				$data['id_billing']						= $id_billing;
				$id_reg 								= $id_reg_bh;

				$ambilnobill1							= $this->m_cashier->get_billing_split($data['id_reg'], 1);
				$ambilnobill2							= $this->m_cashier->get_billing_split($data['id_reg'], 2);
				$ambilnobill3							= $this->m_cashier->get_billing_split($data['id_reg'], 3);

				$data['get_billing_mcu_list']		= $this->m_cashier->get_billing_data_mcu($id_reg);
				$data['patient']					= $this->m_cashier->get_data_patien_reg($id_reg);
				$data['get_order_type_urut']    	= $this->m_cashier->get_order_type_urut($id_bh, 1);
				$data['fisik_billing']  			= $this->m_cashier->get_data_billing($data['id_reg'], 0, 1);
				$data['lab_billing']   				= $this->m_cashier->get_data_billing($data['id_reg'], 1, 1);
				$data['rad_billing']   				= $this->m_cashier->get_data_billing($data['id_reg'], 2, 1);
				$data['pharmacy']   				= $this->m_cashier->get_view_pharmacy($data['id_reg'], 13, 1);
				$data['lain']   					= $this->m_cashier->get_data_billing_other($data['id_reg'], 1);
				$data['other']   					= $this->m_cashier->get_billing_item_request($data['id_reg'], 1);
				$data['total']   					= $this->m_cashier->get_billing_reg($data['id_reg'], $id_billing);

				$this->load->view('menu/print_invoice_all', $data);
			}
		} else {
			redirect('login', 'refresh');
		}
	}
	function invoice_process()
	{
		if ($this->session->userdata('logged_in')) {


			$session_data 					= $this->session->userdata('logged_in');
			$data['userlevel']				= $session_data['userlevel'];
			$data['menu_level']				= $session_data['jobs'];
			$user_id						= $session_data['id'];
			$data['username'] 				= $session_data['username'];
			$data['loc'] 					= $session_data['location'];
			$now							= date("Y-m-d H:i:s");
			$data['id_reg'] 				= $this->input->post('id_reg');
			$data['id_pat']					= $this->input->post('id_pat');
			$data['pat_name']				= $this->input->post('pat_name');
			$data['age']					= $this->input->post('age');
			$data['client_name']			= $this->input->post('client_name');
			$data['id_client']				= $this->input->post('id_client');
			$data['package_name']			= $this->input->post('package_name');
			$data['id_package']				= $this->input->post('id_package');
			$data['id_billing']				= $this->input->post('id_billing');
			$data['bill_no']				= $this->input->post('bill_no');
			$id_reg 						= $this->input->post('id_reg');
			$data['find'] 					= $this->m_cashier->get_data_patien_reg($data['id_reg']);
			$data['bill'] 					= $this->m_cashier->get_list_billing($data['id_billing']);
			$data['ch_bill']				= $this->m_cashier->get_type_ch_payment($data['id_billing']);
			$data['kurs']					= $this->m_cashier->get_kurs_dollar();
			$data['bank']					= $this->m_cashier->get_list_bank();
			$id 							= $data['id_reg'];
			$data['data'] 					= $this->m_inv->get_po_header($id);
			$data['main'] 					= $this->m_inv->get_po_main($id);
			$data['grand'] 					= $this->m_inv->get_po_grand($id);
			$data['footer'] 				= $this->m_inv->get_po_footer($id);

			$this->template->set('title', 'Klinik | Invoice ');
			$this->template->load('template', 'menu/add_label', $data);
			// $this->template->load('template','menu/invoice_process', $data);

		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function payment_process()
	{
		if ($this->session->userdata('logged_in')) {


			$session_data 					= $this->session->userdata('logged_in');
			$data['userlevel']				= $session_data['userlevel'];
			$data['menu_level']				= $session_data['jobs'];
			$user_id						= $session_data['id'];
			$data['username'] 				= $session_data['username'];
			$data['loc'] 					= $session_data['location'];
			$now							= date("Y-m-d H:i:s");

			$data['id_bh'] 					= $this->input->post('id_bh');
			$data['id_reg'] 				= $this->input->post('id_reg');
			$data['id_pat']					= $this->input->post('id_pat');
			$data['pat_name']				= $this->input->post('pat_name');
			$data['age']					= $this->input->post('age');
			$data['client_name']			= $this->input->post('client_name');
			$data['id_client']				= $this->input->post('id_client');
			$data['package_name']			= $this->input->post('package_name');
			$data['id_package']				= $this->input->post('id_package');
			$data['id_billing']				= $this->input->post('id_billing');
			$data['bill_no']				= $this->input->post('bill_no');
			$id_reg 						= $this->input->post('id_reg');

			$data['payment_before'] 		= $this->m_cashier->get_payment_list_before($data['id_reg'], $data['id_billing']);
			$data['payment'] 				= $this->m_cashier->get_payment_list($data['id_reg'], $data['id_billing']);
			$data['find'] 					= $this->m_cashier->get_data_patien_reg($data['id_reg']);
			$data['bill'] 					= $this->m_cashier->get_list_billing($data['id_billing']);
			$data['ch_bill']				= $this->m_cashier->get_type_ch_payment($data['id_billing']);
			$data['kurs']					= $this->m_cashier->get_kurs_dollar();
			$data['bank']					= $this->m_cashier->get_list_bank2();
			$data['insurance']				= $this->m_cashier->get_list_ins();

			$this->template->set('title', 'Klinik | Payment');
			$this->template->load('template', 'menu/payment_process', $data);
		} else {
			redirect('login', 'refresh');
		}
	}

	function save_payment()
	{
		if ($this->session->userdata('logged_in')) {

			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data['userlevel']		= $session_data['userlevel'];
			$data['username'] 		= $session_data['username'];
			$data['loc'] 			= $session_data['location'];
			$now					= date("Y-m-d H:i:s");

			$id_bh					= $this->input->post('id_bh');
			$id_reg					= $this->input->post('id_reg');
			$id_pat					= $this->input->post('id_pat');
			$pat_name				= $this->input->post('pat_name');
			$age					= $this->input->post('age');
			$client_name			= $this->input->post('client_name');
			$id_client				= $this->input->post('id_client');
			$package_name			= $this->input->post('package_name');
			$id_package				= $this->input->post('id_package');
			$id_billing				= $this->input->post('id_billing');
			$bill_no				= $this->input->post('bill_no');
			$jumlah					= $this->input->post('jumlah');
			$billx					= $this->input->post('billx');
			$outstanding			= $this->input->post('outstanding');
			$kursx					= $this->input->post('kursx');
			$usdx					= $this->input->post('usdx');
			$idrx					= $this->input->post('idrx');
			$ccx					= $this->input->post('ccx');
			$nocc					= $this->input->post('nocc');
			$bank_cc				= $this->input->post('bank_cc');
			$nodc					= $this->input->post('nodc');
			$dcx					= $this->input->post('dcx');
			$bank_dc				= $this->input->post('bank_dc');
			$noins					= $this->input->post('noins');
			$insx					= $this->input->post('insx');
			$bank_ins				= $this->input->post('bank_ins');
			$is_complete			= 3;
			$status_billing			= 3;

			if ($outstanding == 0) {
				$is_complete		= 2;
				$status_billing		= 2;

				// --------- proses update status registration ---------
				$data_update = array('status_reg' => 3);
				$this->m_registration->reg_update($id_reg, $data_update);
				// --------- batas proses update status registration ---------

			}

			$data_insert 			= array(
				'id_reg'				=> $id_reg,
				'id_pat' 				=> $id_pat,
				'id_billing'			=> $id_billing,
				'payment_date' 			=> date("Y-m-d H:i:s"),
				'amount' 				=> $jumlah,
				'total_billing' 		=> $billx,
				'outstanding' 			=> $outstanding,
				'is_complete' 			=> $is_complete,
				'create_by' 			=> $user_id,
				'create_date' 			=> date("Y-m-d H:i:s"),
			);
			$this->m_cashier->insert_trx_pat_payment_h($data_insert);

			$id_payment = $this->db->insert_id();

			/**
				Type Payment :
				0	Cash
				1	Credit Card
				2	Insurce
				3	Company
				4	Cheque
			 **/
			if ($usdx > 0) {

				$insert_detail 			= array(
					'id_payment_header'	 	=> $id_payment,
					'kurs' 					=> $kursx,
					'amount' 				=> $usdx,
					'type_payment' 			=> 0,
					'card_no' 				=> '',
					'bank_id' 				=> 0,
				);
				$this->m_cashier->insert_trx_pat_payment_d($insert_detail);
			}

			if ($idrx > 0) {

				$insert_detail 			= array(
					'id_payment_header'	 	=> $id_payment,
					'kurs' 					=> $kursx,
					'amount' 				=> $idrx,
					'type_payment' 			=> 0,
					'card_no' 				=> '',
					'bank_id' 				=> 0,
				);
				$this->m_cashier->insert_trx_pat_payment_d($insert_detail);
			}

			if ($ccx > 0) {

				$insert_detail 			= array(
					'id_payment_header'	 	=> $id_payment,
					'kurs' 					=> $kursx,
					'amount' 				=> $ccx,
					'type_payment' 			=> 1,
					'card_no' 				=> $nocc,
					'bank_id' 				=> $bank_cc,
				);
				$this->m_cashier->insert_trx_pat_payment_d($insert_detail);
			}

			if ($dcx > 0) {

				$insert_detail 			= array(
					'id_payment_header'	 	=> $id_payment,
					'kurs' 					=> $kursx,
					'amount' 				=> $dcx,
					'type_payment' 			=> 5,
					'card_no' 				=> $nodc,
					'bank_id' 				=> $bank_dc,
				);
				$this->m_cashier->insert_trx_pat_payment_d($insert_detail);
			}

			if ($insx > 0) {

				$insert_detail 			= array(
					'id_payment_header'	 	=> $id_payment,
					'kurs' 					=> $kursx,
					'amount' 				=> $insx,
					'type_payment' 			=> 2,
					'card_no' 				=> $noins,
					'bank_id' 				=> $bank_ins,
				);
				$this->m_cashier->insert_trx_pat_payment_d($insert_detail);
			}

			$data_update = array(
				'status' 			=> $status_billing,
			);
			$this->m_cashier->update_trx_billing($id_billing, $data_update);

			if ($status_billing == 2) {

				$data_update = array(
					'is_complete' 			=> $status_billing,
				);
				$this->m_cashier->update_trx_pat_payment_h($id_billing, $data_update);
			}


			$this->m_cashier->del_or($id_reg, $id_billing);

			$inv_no							= "OR/" . date("Y/m/");
			$insert_invoice 				= array(
				'or_no'						=> $inv_no,
				'or_date'					=> date("Y-m-d H:i:s"),
				'id_billing'				=> $id_billing,
				'id_reg'					=> $id_reg,
				'or_status'					=> 0,
			);
			$this->m_cashier->save_or($insert_invoice);


			$this->template->set('title', 'Klinik | Payment');
			// $this->template->load('template','menu/payment_list/'.$id_bh.'/'.$id_billing.'', $data);
			redirect('cashier/payment_list/' . $id_bh . '/' . $id_billing . '');
		} else {
			redirect('login', 'refresh');
		}
	}



	public function report_patient()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data 		= $this->session->userdata('logged_in');
			$data['username'] 	= $session_data['username'];
			$loc 	 			= $session_data['location'];
			$this->template->set('title', 'Klinik | Doctor Order');
			$this->template->load('template', 'menu/report_patient', $data);
		} else {
			redirect('login', 'refresh');
		}
	}

	public function report_patient_excel()
	{
		$this->load->model('m_regreport');
		$session_data 				= $this->session->userdata('logged_in');
		$data['username'] 			= $session_data['username'];
		$act      					= $this->input->post('act');
		$id_reg1  					= $this->input->post('id_reg1');
		$id_reg2  					= $this->input->post('id_reg2');
		$datereg1 					= $this->input->post('datereg1');
		$datereg2 					= $this->input->post('datereg2');
		$data['datereg1']			= $this->input->post('datereg1');
		$data['datereg2']			= $this->input->post('datereg2');

		$from = $this->input->post('datereg1');
		$to = $this->input->post('datereg2');


		$arr1 = $this->m_cashier->report_patient_1($from, $to);

		$result = [];
		$grand_total = 0;

		if ($arr1->num_rows() > 0) {
			$no = 1;
			foreach ($arr1->result() as $key) {
				$id_reg      = $key->id_reg;
				$reg_date    = $key->reg_date;
				$pat_name    = $key->pat_name;
				$doctor_name = $key->doctor_name;

				$arr2 = $this->m_cashier->report_patient_2($id_reg);

				$odo = "";

				if ($arr2->num_rows() > 0) {
					foreach ($arr2->result() as $key2) {
						$odo_value = $key2->odo_value;
						$odo_desc = $key2->odo_desc;

						$odo .= "" . $odo_value . " (" . $odo_desc . ") <br>" . PHP_EOL;
					}
				} else {
					$odo .= '-';
				}

				$arr3 = $this->m_cashier->report_patient_3($id_reg);

				$serv = "";
				$sub_total = 0;

				if ($arr3->num_rows() > 0) {
					foreach ($arr3->result() as $key3) {
						$serv_name = $key3->serv_name;
						$price     = $key3->price;

						$serv .= "" . $serv_name . " (" . number_format($price, 0) . ") <br>" . PHP_EOL;

						$sub_total = $sub_total + $price;
						$grand_total = $grand_total + $price;
					}
				} else {
					$serv .= '-';
				}

				$arr4 = $this->m_cashier->report_patient_4($id_reg);

				$type_payment = "Cash";
				$card_no = '';

				if ($arr4->num_rows() > 0) {
					if ($arr4->row()->type_payment == '1') {
						$type_payment = "Credit Card";
						$card_no = $arr4->row()->card_no;
					} elseif ($arr4->row()->type_payment == '5') {
						$type_payment = "Debit Card";
						$card_no = $arr4->row()->card_no;
					}
				}

				$nested = [
					'no'           => $no,
					'id_reg'       => $id_reg,
					'reg_date'     => $reg_date,
					'pat_name'     => $pat_name,
					'odo'          => $odo,
					'serv'         => $serv,
					'doctor_name'  => $doctor_name,
					'type_payment' => $type_payment,
					'card_no'      => $card_no,
					'sub_total'    => $sub_total,
				];

				array_push($result, $nested);

				$no++;
			}
		}

		$data['result']      = $result;
		$data['grand_total'] = $grand_total;

		$this->load->view('menu/report_patient_excel', $data);
	}

	public function report_patient_pdf($from, $to)
	{
		$this->load->model('m_regreport');
		$session_data 				= $this->session->userdata('logged_in');
		$data['username'] 			= $session_data['username'];
		$data['datereg1']			= $from;
		$data['datereg2']			= $to;

		$arr1 = $this->m_cashier->report_patient_1($from, $to);

		$result = [];
		$grand_total = 0;

		if ($arr1->num_rows() > 0) {
			$no = 1;
			foreach ($arr1->result() as $key) {
				$id_reg      = $key->id_reg;
				$reg_date    = $key->reg_date;
				$pat_name    = $key->pat_name;
				$doctor_name = $key->doctor_name;

				$arr2 = $this->m_cashier->report_patient_2($id_reg);

				$odo = "";

				if ($arr2->num_rows() > 0) {
					foreach ($arr2->result() as $key2) {
						$odo_value = $key2->odo_value;
						$odo_desc = $key2->odo_desc;

						$odo .= "" . $odo_value . " (" . $odo_desc . ") <br>" . PHP_EOL;
					}
				} else {
					$odo .= '-';
				}

				$arr3 = $this->m_cashier->report_patient_3($id_reg);

				$serv = "";
				$sub_total = 0;

				if ($arr3->num_rows() > 0) {
					foreach ($arr3->result() as $key3) {
						$serv_name = $key3->serv_name;
						$price     = $key3->price;

						$serv .= "" . $serv_name . " (" . number_format($price, 0) . ") <br>" . PHP_EOL;

						$sub_total = $sub_total + $price;
						$grand_total = $grand_total + $price;
					}
				} else {
					$serv .= '-';
				}

				$arr4 = $this->m_cashier->report_patient_4($id_reg);

				$type_payment = "Cash";
				$card_no = '';

				if ($arr4->num_rows() > 0) {
					if ($arr4->row()->type_payment == '1') {
						$type_payment = "Credit Card";
						$card_no = $arr4->row()->card_no;
					} elseif ($arr4->row()->type_payment == '5') {
						$type_payment = "Debit Card";
						$card_no = $arr4->row()->card_no;
					}
				}

				$nested = [
					'no'           => $no,
					'id_reg'       => $id_reg,
					'reg_date'     => $reg_date,
					'pat_name'     => $pat_name,
					'odo'          => $odo,
					'serv'         => $serv,
					'doctor_name'  => $doctor_name,
					'type_payment' => $type_payment,
					'card_no'      => $card_no,
					'sub_total'    => $sub_total,
				];

				array_push($result, $nested);

				$no++;
			}
		}

		$data['result']      = $result;
		$data['grand_total'] = $grand_total;

		$html2pdf = new Html2Pdf('L', 'A4', 'en');
		$result = $this->load->view('menu/report_patient_pdf', $data, true);
		$html2pdf->writeHTML($result);
		$html2pdf->output();
	}


	public function report_expense()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data 		= $this->session->userdata('logged_in');
			$data['username'] 	= $session_data['username'];
			$loc 	 			= $session_data['location'];
			$this->template->set('title', 'Klinik | Doctor Order');
			$this->template->load('template', 'menu/report_expense', $data);
		} else {
			redirect('login', 'refresh');
		}
	}

	public function report_expense_excel()
	{
		$this->load->model('m_regreport');
		$session_data 				= $this->session->userdata('logged_in');
		$data['username'] 			= $session_data['username'];
		$act      					= $this->input->post('act');
		$id_reg1  					= $this->input->post('id_reg1');
		$id_reg2  					= $this->input->post('id_reg2');
		$datereg1 					= $this->input->post('datereg1');
		$datereg2 					= $this->input->post('datereg2');
		$data['datereg1']			= $this->input->post('datereg1');
		$data['datereg2']			= $this->input->post('datereg2');
		$data['data'] 				= $this->m_regreport->report_expense_as_date($datereg1, $datereg2);
		$this->load->view('menu/report_expense_excel', $data);
	}

	public function report_expense_pdf($from, $to)
	{
		$this->load->model('m_regreport');
		$session_data 				= $this->session->userdata('logged_in');
		$data['username'] 			= $session_data['username'];
		$act      					= $this->input->post('act');
		$id_reg1  					= $this->input->post('id_reg1');
		$id_reg2  					= $this->input->post('id_reg2');
		$datereg1 					= $from;
		$datereg2 					= $to;
		$data['datereg1']			= $from;
		$data['datereg2']			= $to;
		$data['data'] 				= $this->m_regreport->report_expense_as_date($datereg1, $datereg2);

		$html2pdf = new Html2Pdf();
		$result = $this->load->view('menu/report_expense_pdf', $data, true);
		$html2pdf->writeHTML($result);
		$html2pdf->output();
	}


	function report_income()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data 		= $this->session->userdata('logged_in');
			$data['username'] 	= $session_data['username'];
			$loc 	 			= $session_data['location'];
			$this->template->set('title', 'Klinik | Doctor Order');
			$this->template->load('template', 'menu/report_income', $data);
		} else {
			redirect('login', 'refresh');
		}
	}

	function report_income_excel()
	{
		$this->load->model('m_regreport');
		$session_data 				= $this->session->userdata('logged_in');
		$data['username'] 			= $session_data['username'];
		$act      					= $this->input->post('act');
		$id_reg1  					= $this->input->post('id_reg1');
		$id_reg2  					= $this->input->post('id_reg2');
		$datereg1 					= date("Y-m-d", strtotime($this->input->post('datereg1')));
		$datereg2 					= date("Y-m-d", strtotime($this->input->post('datereg2')));
		$data['data'] 				= $this->m_regreport->report_reg_as_date($datereg1, $datereg2);
		$this->load->view('menu/report_income_excel', $data);
	}


	public function report_profit()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data 		= $this->session->userdata('logged_in');
			$data['username'] 	= $session_data['username'];
			$loc 	 			= $session_data['location'];
			$this->template->set('title', 'Klinik | Doctor Order');
			$this->template->load('template', 'menu/report_profit', $data);
		} else {
			redirect('login', 'refresh');
		}
	}

	public function report_profit_excel()
	{
		$this->load->model('m_regreport');
		$session_data 				= $this->session->userdata('logged_in');
		$data['username'] 			= $session_data['username'];
		$act      					= $this->input->post('act');
		$id_reg1  					= $this->input->post('id_reg1');
		$id_reg2  					= $this->input->post('id_reg2');
		$datereg1 					= $this->input->post('datereg1');
		$datereg2 					= $this->input->post('datereg2');
		$data['datereg1']			= $this->input->post('datereg1');
		$data['datereg2']			= $this->input->post('datereg2');
		$render_profit = $this->m_regreport->report_profit_as_date_adam($datereg1, $datereg2);
		$data['arr_data'] = $render_profit;
		$this->load->view('menu/report_profit_excel', $data);
	}

	public function report_profit_pdf($from, $to)
	{
		$this->load->model('m_regreport');
		$session_data 				= $this->session->userdata('logged_in');
		$data['username'] 			= $session_data['username'];
		$data['datereg1']			= $from;
		$data['datereg2']			= $to;

		$render_profit = $this->m_regreport->report_profit_as_date_adam($from, $to);
		$data['arr_data'] = $render_profit;

		$html2pdf = new Html2Pdf('L', 'A4', 'en');
		$result = $this->load->view('menu/report_profit_pdf', $data, true);
		$html2pdf->writeHTML($result);
		$html2pdf->output();
	}
}
