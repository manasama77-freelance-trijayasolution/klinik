<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Registration extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_patient');
		$this->load->model('m_registration');
		$this->load->model('m_lab');
		$this->load->model('m_login');
		$this->load->model('m_doctor');
	}

	function index()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->library('session');
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$this->load->view('menu/index', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	public function reg_patien()
	{

		if ($this->session->userdata('logged_in')) {
			$session_data                  = $this->session->userdata('logged_in');
			$data['username']              = $session_data['username'];
			$loc 	                       = $session_data['location'];
			$data['refe']     			   = $this->m_registration->get_reference();
			$data['get_charge_rule']       = $this->m_registration->get_mst_charge_rule(); // $data['get_charge_rule'] parameter di kirim ke view /menu/registration php
			$data['get_paytype']           = $this->m_registration->get_mst_paytype(); // ---                    """ " ---- Paytype
			$data['get_client']            = $this->m_registration->get_mst_client(); // ---                      """ " ---- Paytype	
			$data['get_client_dept']       = $this->m_registration->get_mst_client_dept(); // ---            """ " ---- mst_client_dept	
			$data['get_client_job']        = $this->m_registration->get_mst_client_job(); // ---              """ " ---- mst_client_dept	
			// $data['get_doctor']            = $this->m_registration->get_mst_doctor();
			$data['get_doctor2']           = $this->m_registration->get_doctor_by_user();
			$data['get_sales']	           = $this->m_registration->get_sales_by_user();
			$data['get_insurance']         = $this->m_registration->get_mst_insurance(); // ---                """ " ---- mst_client_dept	
			$data['get_project']           = $this->m_registration->get_mst_project(); // ---                    """ " ---- mst_client_dept	
			$data['get_services']          = $this->m_registration->get_mst_services(); // ---                  """ " ---- mst_client_dept	
			$data['get_reg_type']          = $this->m_registration->get_reg_type(); // ---                      """ " ---- mst_client_dept	
			$data['get_service_package_h'] = $this->m_registration->get_mst_service_package_h(); // ---""" " ---- mst_client_dept		
			$data['get_branch']            = $this->m_registration->get_mst_branch($loc); // ---                  """ " ---- mst_client_dept		

			$data['title']      = $this->m_patient->get_mst_title();
			$data['gender']     = $this->m_patient->get_list_gender();
			$data['marital']    = $this->m_patient->get_list_marital();
			$data['marital']    = $this->m_patient->get_list_marital();
			$data['arr_doctor'] = $this->m_doctor->get_list();

			$this->template->set('title', 'Klinik | Registration');
			$this->template->load('template', 'menu/registration', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}


	function reg_update()
	{

		if ($this->session->userdata('logged_in')) {
			$id_reg             		   = $this->uri->segment(3);
			$session_data                  = $this->session->userdata('logged_in');
			$data['username']              = $session_data['username'];
			$loc 	                       = $session_data['location'];
			$data['refe']     			   = $this->m_registration->get_reference();
			$data['get_charge_rule']       = $this->m_registration->get_mst_charge_rule();
			$data['get_paytype']           = $this->m_registration->get_mst_paytype();
			$data['get_client']            = $this->m_registration->get_mst_client();
			$data['get_client_dept']       = $this->m_registration->get_mst_client_dept();
			$data['get_client_job']        = $this->m_registration->get_mst_client_job();
			$data['get_doctor2']           = $this->m_registration->get_doctor_by_user();
			$data['get_insurance']         = $this->m_registration->get_mst_insurance();
			$data['get_project']           = $this->m_registration->get_mst_project();
			$data['get_services']          = $this->m_registration->get_mst_services();
			$data['get_reg_type']          = $this->m_registration->get_reg_type();
			$data['get_service_package_h'] = $this->m_registration->get_mst_service_package_h();
			$data['get_branch']            = $this->m_registration->get_mst_branch($loc);
			$data['get_doctor']            = $this->m_registration->get_mst_doctor();
			$data['get_data']              = $this->m_registration->get_data_reg($id_reg);
			$data['get_order']       	   = $this->m_registration->get_order_patient($id_reg);

			$this->template->set('title', 'Klinik | Cancel Data Registration');
			$this->template->load('template', 'menu/registration_update', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function print_detail_regpatient()
	{
		if ($this->session->userdata('logged_in')) {
			$id_reg                = $this->uri->segment(3);
			$session_data          = $this->session->userdata('logged_in');
			$data['username']      = $session_data['username'];
			$loc 	               = $session_data['location'];
			$data['regdetpatient'] = $this->m_registration->get_regdetpatient($id_reg); // ---""" " ---- mst_client_dept
			$data['get_branch']    = $this->m_registration->get_mst_branch($loc); // ---""" " ---- mst_client_dept
			$this->template->set('title', 'Klinik | Print Registration');
			$this->load->view('menu/print_detail_regpatient', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi load form patient data
	/*  function pat_charge_rule(){
    if($this->session->userdata('logged_in')){	
		$this->load->model('m_patient');		
		$session_data 			= $this->session->userdata('logged_in');
	    $data['username'] 		= $session_data['username'];
		$data['gender'] 		= $this->m_patient->get_list_gender();
		$data['marital'] 		= $this->m_patient->get_list_marital();
		$data['province'] 		= $this->m_patient->get_list_province();
		$data['city'] 			= $this->m_patient->get_list_city();
		$data['relative'] 		= $this->m_patient->get_list_relative();
		$data['national'] 		= $this->m_patient->get_list_nationality();
	    $this->template->set('title','Klinik | Patient Data');
		$this->template->load('template','menu/data_patient', $data);
	} else {
	  //If no session, redirect to login page
      redirect('login', 'refresh');
	}	
 } */

	public function save_reg2()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$user_id      = $session_data['id'];

			$id_reg           = $this->input->post('id_reg');
			$reg_date         = $this->input->post('reg_date');
			$appointment_date = $this->input->post('appointment_date');
			$appointment_time = $this->input->post('appointment_time');
			$id_pat           = $this->input->post('id_pat');
			$pat_charge_rule  = 2;
			$id_dr            = $this->input->post('id_dr');
			$current_datetime = date("Y-m-d H:i:s");



			$data_reg 			= array(
				'id_reg'           => $id_reg,
				'reg_date'         => $reg_date,
				'appointment_date' => $appointment_date,
				'appointment_time' => $appointment_time,
				'id_pat'           => $id_pat,
				'pat_charge_rule'  => $pat_charge_rule,
				'payment_type'     => null,
				'id_client'        => null,
				'id_client_dept'   => null,
				'id_client_job'    => null,
				'id_sales'         => null,
				'reference'        => null,
				'id_dr'            => $id_dr,
				'insurance_comp'   => 0,
				'id_project'       => 0,
				'misc_notes'       => $this->input->post('misc_notes'),
				'pat_sign'         => null,
				'reg_type'         => null,
				'id_service'       => null,
				'id_package'       => 0,
				'fingerid'         => 0,
				'status_reg'       => 0,
				'create_by'        => $user_id,
				'create_date'      => $current_datetime,
			);

			$exec = $this->m_registration->save_registration($data_reg);

			if ($exec) {
				$this->session->set_flashdata('registration_success', '<i class="icon-info-sign"></i> Registration Patient, Success!');
			} else {
				$this->session->set_flashdata('registration_danger', '<i class="icon-info-sign"></i> Registration Patient, Failed!');
			}
			redirect('registration/reg_patien');
		} else {
			redirect('login', 'refresh');
		}
	}
	function save_reg()
	{
		if ($this->session->userdata('logged_in')) {
			$id_reg 	= $this->input->post('id_reg');
			$aa 		= $this->input->post('id_service');
			$package 	= $this->input->post('package');
			$a			= date("Y-m-d", strtotime($this->input->post('reg_date')));
			$id_paket_combo = "0";
			if ($package == "1") {
				$service 		= 0;
				$id_package 	= $this->input->post('package_id');
				$mcubilling		= 1;

				$cars = $this->input->post('package_id');
				if (isset($cars)) {
					$id_paket_combo = implode(',', $cars);
				}

				$data['all_pisik'] 		= $this->m_registration->get_data_pisik($cars);
				$data['all_data'] 		= $this->m_registration->send_job_lab($cars);
				$data['all_radiology'] 	= $this->m_registration->send_job_radio($cars);
				$row_cnt 	= $data['all_data']->num_rows();
				$row_cnta 	= $data['all_radiology']->num_rows();
				$row_cntak 	= $data['all_pisik']->num_rows();

				if ($row_cntak != 0) {
					foreach ($data['all_pisik']->result() as $rows) {
						$data_pisik				= array(
							'id_reg'		=> $this->input->post('id_reg'),
							'id_pat'		=> $this->input->post('id_pat'),
							'order_type'	=> $rows->id_group_serv,
							'order_date'	=> date("Y-m-d h:i:s"),
							'order_status'	=> 1,
							'mcu'			=> 1,
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
						'order_date'	=> date("Y-m-d h:i:s"),
						'order_status'	=> 1,
						'user_id'		=> $user_id,
						'mcu'			=> $mcubilling,

					);
					$this->m_lab->order_lab_h($data_lab);

					foreach ($data['all_data']->result() as $row) {

						$type 					= $row->order_type;
						$id_service				= $row->order_id;
						include './design/koneksi/file.php';
						$query 		= "SELECT id_order id FROM pat_order_h ORDER BY id_order DESC LIMIT 1";

						if ($result 	= mysqli_query($con, $query)) {
							$row 	= mysqli_fetch_assoc($result);
							$count 	= $row['id'];
						}
						$sql = "INSERT INTO pat_order_d (id_order_header, id_service, seq_no, service_qty, id_dr, acct_code) VALUES ('" . $count . "', '" . $id_service . "', '" . $id_service . "', '1', '1','1')";
						$this->db->query($sql);
					}
				}
				if ($row_cnta != 0) {
					$data_lab		= array(
						'id_reg'		=> $this->input->post('id_reg'),
						'id_pat'		=> $this->input->post('id_pat'),
						'order_type'	=> 2,
						'order_date'	=> date("Y-m-d h:i:s"),
						'order_status'	=> 1,
						'user_id'		=> $user_id,
						'mcu'			=> $mcubilling,
					);
					$this->m_lab->order_lab_h($data_lab);

					foreach ($data['all_radiology']->result() as $row2) {
						$type 					= $row2->order_type;
						$id_service2			= $row2->order_id;
						include './design/koneksi/file.php';
						$query 		= "SELECT id_order id FROM pat_order_h ORDER BY id_order DESC LIMIT 1";
						if ($result 	= mysqli_query($con, $query)) {
							$row 	= mysqli_fetch_assoc($result);
							$count 	= $row['id'];
						}

						$sql = "INSERT INTO pat_order_d (id_order_header, id_service, seq_no, service_qty, id_dr, acct_code) VALUES ('" . $count . "', '" . $id_service2 . "', '" . $id_service2 . "', '1', '1','1')";
						$this->db->query($sql);
						echo $this->db->affected_rows();
					}
				}
			} elseif ($package == "0") {
				$service 		= 1;
				$id_package 	= 0;
				$mcubilling		= 0;
			}

			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data_reg 			= array(
				'id_reg'			=> $this->input->post('id_reg'),
				'reg_date' 			=> date("Y-m-d", strtotime($this->input->post('reg_date'))),
				'id_pat'			=> $this->input->post('id_pat'),
				'pat_charge_rule' 	=> $this->input->post('pat_charge_rule'),
				'id_client' 		=> $this->input->post('id_client'),
				'id_client_dept'	=> $this->input->post('id_client_dept'),
				'id_client_job' 	=> $this->input->post('id_client_job'),
				'reference'			=> $this->input->post('reference'),
				'id_dr' 			=> $this->input->post('id_dr'),
				'insurance_comp'	=> $this->input->post('insurance_comp'),
				'misc_notes'		=> $this->input->post('misc_notes'),
				'reg_type' 			=> $this->input->post('reg_type'),
				'id_sales' 			=> $this->input->post('id_sal'),
				'id_service' 		=> $service,
				'id_package' 		=> $id_paket_combo,
				'create_by' 		=> $user_id,
			);
			//$this->m_registration->send_job($id_package);
			$this->m_registration->save_registration($data_reg);  // load dari model/function save_registration($data_reg)
			redirect('registration/reg_patien/ok/' . $id_reg);
		} else {
			redirect('login', 'refresh');
		}
	}

	///---------------- Registration and Appointment ------------- //
	function reg_app()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data     = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$loc 	          = $session_data['location'];
			$data['apptoday'] = $this->m_registration->get_get_apptoday($loc);

			$this->template->set('title', 'Klinik | Registration');
			$this->template->load('template', 'menu/reg_app', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi load add_fingerid
	function add_fingerid()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$this->template->set('title', 'Klinik | Add Finger ID');
			$this->template->load('template', 'menu/add_fingerid', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function add_camera()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data     = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$loc 	          = $session_data['location'];
			$this->template->set('title', 'Klinik | Photo Patient');
			$this->template->load('template', 'menu/add_camera', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi load form patient data
	function pat_update()
	{
		if ($this->session->userdata('logged_in')) {
			$id 						= $this->uri->segment(3);
			$data['pat_mrn'] 			= $this->uri->segment(3);
			$session_data 				= $this->session->userdata('logged_in');
			$data['username'] 			= $session_data['username'];
			$data['loc'] 				= $session_data['location'];
			$data['gender'] 			= $this->m_patient->get_list_gender();
			$data['marital'] 			= $this->m_patient->get_list_marital();
			$data['province'] 			= $this->m_patient->get_list_province();
			$data['city'] 				= $this->m_patient->get_list_city();
			$data['relative'] 			= $this->m_patient->get_list_relative();
			$data['national'] 			= $this->m_patient->get_list_nationality();
			$data['get_client'] 		= $this->m_registration->get_mst_client();  // ---""" " ---- Paytype
			$data['title'] 				= $this->m_patient->get_mst_title(); // ---""" " ---- Paytype		
			$data['get_client_dept'] 	= $this->m_patient->get_mst_client_dept(); // ---""" " ---- mst_client_dept	
			$data['get_client_job'] 	= $this->m_patient->get_mst_client_job(); // ---""" " ---- mst_client_dept
			$data['pasien'] 			= $this->m_patient->get_patient($id);

			$this->template->set('title', 'Klinik | Patient Data');
			$this->template->load('template', 'menu/update_patient', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function registration_update()
	{

		if ($this->session->userdata('logged_in')) {
			$id_reg             		   = $this->uri->segment(3);
			$session_data                  = $this->session->userdata('logged_in');
			$data['username']              = $session_data['username'];
			$loc 	                       = $session_data['location'];
			$data['refe']     			   = $this->m_registration->get_reference();
			$data['get_charge_rule']       = $this->m_registration->get_mst_charge_rule();
			$data['get_paytype']           = $this->m_registration->get_mst_paytype();
			$data['get_client']            = $this->m_registration->get_mst_client();
			$data['get_client_dept']       = $this->m_registration->get_mst_client_dept();
			$data['get_client_job']        = $this->m_registration->get_mst_client_job();
			$data['get_doctor2']           = $this->m_registration->get_doctor_by_user();
			$data['get_insurance']         = $this->m_registration->get_mst_insurance();
			$data['get_project']           = $this->m_registration->get_mst_project();
			$data['get_services']          = $this->m_registration->get_mst_services();
			$data['get_reg_type']          = $this->m_registration->get_reg_type();
			$data['get_service_package_h'] = $this->m_registration->get_mst_service_package_h();
			$data['get_branch']            = $this->m_registration->get_mst_branch($loc);
			$data['get_doctor']            = $this->m_registration->get_mst_doctor();
			$data['get_data']              = $this->m_registration->get_data_reg($id_reg);
			$data['get_order']       	   = $this->m_registration->get_order_patient($id_reg);
			$data['get_sales']	           = $this->m_registration->get_sales_by_user();
			$data['get_doctor2']           = $this->m_registration->get_doctor_by_user();

			$this->template->set('title', 'Klinik | Cancel Data Registration');
			$this->template->load('template', 'menu/registration_update2', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function reg_update_process2()
	{

		$session_data 					= $this->session->userdata('logged_in');
		$data['userlevel']				= $session_data['userlevel'];
		$data['menu_level']				= $session_data['jobs'];
		$user_id						= $session_data['id'];
		$data['fullname'] 				= $session_data['fullname'];
		$data['username'] 				= $session_data['username'];
		$data['loc'] 					= $session_data['location'];
		$now							= date("Y-m-d H:i:s");
		$reg_date						= date("Y-m-d", strtotime($this->input->post('reg_date')));

		$id_reg 						= $this->input->post('id_reg');
		$insurance_comp					= $this->input->post('insurance_comp');
		$id_client						= $this->input->post('id_client');
		$id_client_dept					= $this->input->post('id_client_dept');
		$id_client_job					= $this->input->post('id_client_job');
		$misc_notes						= $this->input->post('misc_notes');
		$id_dr							= $this->input->post('id_dr');

		$data_update 			= array(
			'id_client' 		=> $this->input->post('id_client'),
			'id_client_dept'	=> $this->input->post('id_client_dept'),
			'id_client_job' 	=> $this->input->post('id_client_job'),
			'insurance_comp'	=> $this->input->post('insurance_comp'),
			'misc_notes'		=> $this->input->post('misc_notes'),
			'id_sales'			=> $this->input->post('id_sal'),
			'id_dr'				=> $this->input->post('id_dr'),
			'reg_date'			=> $reg_date,
		);
		$this->m_registration->reg_update($id_reg, $data_update);

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_log = array(
			'id_user'						=> $user_id,
			'log_date'						=> date("Y-m-d H:i:s"),
			'log_desc' 						=> "Update Registration | ID Registration : " . $id_reg . " | ID user : " . $user_id . " | Fullname : " . $data['fullname'] . " ",
		);
		$this->m_login->log($data_log);
		//Endless Log

		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
	}

	function reg_update_process()
	{

		$session_data 					= $this->session->userdata('logged_in');
		$data['userlevel']				= $session_data['userlevel'];
		$data['menu_level']				= $session_data['jobs'];
		$user_id						= $session_data['id'];
		$data['fullname'] 				= $session_data['fullname'];
		$data['username'] 				= $session_data['username'];
		$data['loc'] 					= $session_data['location'];
		$now							= date("Y-m-d H:i:s");

		$id_reg 						= $this->input->post('id_reg');
		$insurance_comp					= $this->input->post('insurance_comp');
		$id_client						= $this->input->post('id_client');
		$id_client_dept					= $this->input->post('id_client_dept');
		$id_client_job					= $this->input->post('id_client_job');
		$misc_notes						= $this->input->post('misc_notes');
		$reg_date						= date("Y-m-d", strtotime($this->input->post('reg_date')));

		$data_update 			= array(
			'id_client' 		=> $this->input->post('id_client'),
			'id_client_dept'	=> $this->input->post('id_client_dept'),
			'id_client_job' 	=> $this->input->post('id_client_job'),
			'insurance_comp'	=> $this->input->post('insurance_comp'),
			'misc_notes'		=> $this->input->post('misc_notes'),
			'reg_date'			=> $reg_date,
		);
		$this->m_registration->reg_update($id_reg, $data_update);

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_log = array(
			'id_user'						=> $user_id,
			'log_date'						=> date("Y-m-d H:i:s"),
			'log_desc' 						=> "Update Registration | ID Registration : " . $id_reg . " | ID user : " . $user_id . " | Fullname : " . $data['fullname'] . " ",
		);
		$this->m_login->log($data_log);
		//Endless Log

		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
	}
}
