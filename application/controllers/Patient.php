<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Patient extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_patient');
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
	//fungsi hitung umur sampai dengan bulan *ex 23 years 18 months
	function findage($dob)
	{
		$localtime = getdate();
		$today = $localtime['mday'] . "-" . $localtime['mon'] . "-" . $localtime['year'];
		$dob_a = explode("-", $dob);
		$today_a = explode("-", $today);
		$dob_d = $dob_a[0];
		$dob_m = $dob_a[1];
		$dob_y = $dob_a[2];
		$today_d = $today_a[0];
		$today_m = $today_a[1];
		$today_y = $today_a[2];
		$years = $today_y - $dob_y;
		$months = $today_m - $dob_m;

		if ($today_m . $today_d < $dob_m . $dob_d) {
			$years--;
			$months = 12 + $today_m - $dob_m;
		}
		if ($today_d < $dob_d) {
			$months--;
		}
		$firstMonths = array(1, 3, 5, 7, 8, 10, 12);
		$secondMonths = array(4, 6, 9, 11);
		$thirdMonths = array(2);

		if ($today_m - $dob_m == 1) {
			if (in_array($dob_m, $firstMonths)) {
				array_push($firstMonths, 0);
			} elseif (in_array($dob_m, $secondMonths)) {
				array_push($secondMonths, 0);
			} elseif (in_array($dob_m, $thirdMonths)) {
				array_push($thirdMonths, 0);
			}
		}
		echo "<br><br> Age is $years years $months months.";
	}
	//fungsi hitung usia detail
	function findage_detail($dob)
	{
		$interval = date_diff(date_create(), date_create($dob));
		echo $interval->format("You are  %Y Year, %M Months, %d Days, %H Hours, %i Minutes, %s Seconds Old");
	}
	//fungsi load form patient data
	function data_patient()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data            = $this->session->userdata('logged_in');
			$data['username']        = $session_data['username'];
			$data['loc']             = $session_data['location'];
			$data['gender']          = $this->m_patient->get_list_gender();
			$data['marital']         = $this->m_patient->get_list_marital();
			$data['province']        = $this->m_patient->get_list_province();
			$data['city']            = $this->m_patient->get_list_city();
			$data['relative']        = $this->m_patient->get_list_relative();
			$data['national']        = $this->m_patient->get_list_nationality();
			$data['get_client']      = $this->m_patient->get_mst_client(); // ---""" " ---- Paytype
			$data['title']           = $this->m_patient->get_mst_title(); // ---""" " ---- Paytype
			$data['get_client_dept'] = $this->m_patient->get_mst_client_dept(); // ---""" " ---- mst_client_dept
			$data['get_client_job']  = $this->m_patient->get_mst_client_job(); // ---""" " ---- mst_client_dept

			$this->template->set('title', 'Klinik | Patient Data');
			$this->template->load('template', 'menu/data_patient', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi simpan pasien data
	public function save_pat()
	{
		// adam lanjut disini
		$session_data = $this->session->userdata('logged_in');
		$user_id      = $session_data['id'];

		$pat_mrn        = $this->input->post('pat_mrn');
		$pat_name       = $this->input->post('pat_name');
		$pat_dob        = $this->input->post('reg_date');
		$contact_phone  = null;
		$contact_mobile = $this->input->post('pat_contact_misc');

		include './design/koneksi/file.php';
		$query 		= "SELECT pat_mrn id,cast(left(pat_mrn,4) as decimal) dt FROM pat_data ORDER BY id_pat DESC LIMIT 1";
		if ($result 	= mysqli_query($con, $query)) {
			//$date	=date('ym');
			$row 	= mysqli_fetch_assoc($result);
			$count 	= $row['id'];
			$counts	= substr($count, 1, strlen($count) - 1);
			//$dater 	=$row['dt'];
			//if ($dater == $date) {
			$counts = $counts + 1;
			//}else{
			//	$count = 1;
			//}

			$code_no = str_pad($counts, 0, "0", STR_PAD_LEFT);
		}
		$id_mrn					= $pat_mrn . $code_no;
		$data_pat 				= array(
			'pat_mrn'			=> $id_mrn,
			'id_history'		=> $this->input->post('id_his'),
			'pat_name' 			=> ucwords($this->input->post('pat_name')),
			'pat_gender'		=> $this->input->post('pat_gender'),
			'pat_dob' 			=> $pat_dob,
			'pat_pob'			=> $this->input->post('pat_pob'),
			'pat_idtype'		=> $this->input->post('pat_idtype'),
			'pat_idno' 			=> $this->input->post('pat_idno'),
			'pat_marital_status' => $this->input->post('pat_marital_status'),
			'pat_address_home' 	=> $this->input->post('pat_address_home'),
			'pat_contact_home'	=> $contact_phone,
			'pat_address_misc' 	=> $this->input->post('pat_address_misc'),
			'pat_contact_misc'	=> $contact_mobile,
			'pat_rel_name' 		=> $this->input->post('pat_rel_name'),
			'pat_rel_type'		=> $this->input->post('pat_rel_type'),
			'pat_rel_contact' 	=> $this->input->post('pat_rel_contact'),
			'pat_nationality'	=> $this->input->post('pat_nationality'),
			'pos_code'			=> $this->input->post('pos_code'),
			'pat_email' 		=> $this->input->post('pat_email'),
			'pat_province'		=> $this->input->post('pat_province'),
			'pat_city' 			=> $this->input->post('pat_city'),
			'id_client'			=> $this->input->post('id_client'),
			'id_client_dept' 	=> $this->input->post('id_client_dept'),
			'id_client_job'		=> $this->input->post('id_client_job'),
			'id_title' 			=> $this->input->post('pat_title'),
			'religion' 			=> $this->input->post('religion'),
			'job' 				=> $this->input->post('jobs'),
		);
		$this->load->model('m_patient');
		$this->m_patient->save_patient($data_pat);

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_log = array(
			'id_user'						=> $user_id,
			'log_date'						=> date("Y-m-d"),
			'log_desc' 						=> "Create Patient Data : " . $this->input->post('pat_name') . " | Patient MRN : " . $this->input->post('pat_mrn') . "",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);


		include './design/koneksi/file.php';
		// Get all the data from the "example" table
		$result = mysqli_query($con, "SELECT id_Pat FROM pat_data ORDER BY id_Pat DESC LIMIT 1")
			or die($this->db->error());
		while ($row = mysqli_fetch_array($result)) {
			$last_id = $row['id_Pat'];
		}
		if ($reg_form == "/ci/registration/reg_patien") {
			echo "<script>window.opener.document.forms['quesioner_mcu'].elements['id_pat'].value='$last_id';window.opener.document.forms['quesioner_mcu'].elements['pat_mrn'].value='$pat_name';
				window.close(this);</script>";
			//redirect('registration/reg_patien/ok/'.$last_id.'/'.$pat_name.''); 
			//echo "$reg_form kondisi satu ngeklose";
		} else {
			echo "$reg_form kondisi kedua langsung";
			//Echo "From patient $last_id";
			redirect('patient/data_patient/ok');
			// redirect('patient/data_patient/ok/'.$last_id.'/'.$pat_name.''); 
		}
	}

	function add_patient()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data       = $this->session->userdata('logged_in');
			$data['username']   = $session_data['username'];
			$data['loc']        = $session_data['location'];
			$data['gender']     = $this->m_patient->get_list_gender();
			$data['marital']    = $this->m_patient->get_list_marital();
			$data['province']   = $this->m_patient->get_list_province();
			$data['city']       = $this->m_patient->get_list_city();
			$data['relative']   = $this->m_patient->get_list_relative();
			$data['national']   = $this->m_patient->get_list_nationality();
			$data['get_client'] = $this->m_patient->get_mst_client();
			$data['title']      = $this->m_patient->get_mst_title();

			$data['get_client_dept'] = $this->m_patient->get_mst_client_dept();

			$data['get_client_job'] = $this->m_patient->get_mst_client_job();
			$this->template->set('title', 'Klinik | Patient Data');
			$this->template->load('template', 'menu/add_patient', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi simpan pasien data
	function save_pat2()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$reg_form = $_SESSION["regsession"];

		$user_id				= $session_data['id'];
		$pat_mrn				= $this->input->post('pat_mrn');
		$pat_name				= $this->input->post('pat_name');
		$pat_dob				= date("Y-m-d", strtotime($this->input->post('reg_date')));
		$contact_phone			= $this->input->post('pat_contact_home[1]') . $this->input->post('pat_contact_home[2]') . $this->input->post('pat_contact_home[3]');
		$contact_mobile			= $this->input->post('pat_contact_misc[1]') . $this->input->post('pat_contact_misc[2]') . $this->input->post('pat_contact_misc[3]');

		include './design/koneksi/file.php';
		$query 		= "SELECT pat_mrn id,cast(left(pat_mrn,4) as decimal) dt FROM pat_data ORDER BY id_pat DESC LIMIT 1";
		if ($result 	= mysqli_query($con, $query)) {
			//$date	=date('ym');
			$row 	= mysqli_fetch_assoc($result);
			$count 	= $row['id'];
			$counts	= substr($count, 1, strlen($count) - 1);
			//$dater 	=$row['dt'];
			//if ($dater == $date) {
			$counts = $counts + 1;
			//}else{
			//	$count = 1;
			//}

			$code_no = str_pad($counts, 0, "0", STR_PAD_LEFT);
		}
		$id_mrn					= $pat_mrn . $code_no;
		$data_pat 				= array(
			'pat_mrn'			=> $id_mrn,
			'id_history'		=> $this->input->post('id_his'),
			'pat_name' 			=> ucwords($this->input->post('pat_name')),
			'pat_gender'		=> $this->input->post('pat_gender'),
			'pat_dob' 			=> $pat_dob,
			'pat_pob'			=> $this->input->post('pat_pob'),
			'pat_idtype'		=> $this->input->post('pat_idtype'),
			'pat_idno' 			=> $this->input->post('pat_idno'),
			'pat_marital_status' => $this->input->post('pat_marital_status'),
			'pat_address_home' 	=> $this->input->post('pat_address_home'),
			'pat_contact_home'	=> $contact_phone,
			'pat_address_misc' 	=> $this->input->post('pat_address_misc'),
			'pat_contact_misc'	=> $contact_mobile,
			'pat_rel_name' 		=> $this->input->post('pat_rel_name'),
			'pat_rel_type'		=> $this->input->post('pat_rel_type'),
			'pat_rel_contact' 	=> $this->input->post('pat_rel_contact'),
			'pat_nationality'	=> $this->input->post('pat_nationality'),
			'pos_code'			=> $this->input->post('pos_code'),
			'pat_email' 		=> $this->input->post('pat_email'),
			'pat_province'		=> $this->input->post('pat_province'),
			'pat_city' 			=> $this->input->post('pat_city'),
			'id_client'			=> $this->input->post('id_client'),
			'id_client_dept' 	=> $this->input->post('id_client_dept'),
			'id_client_job'		=> $this->input->post('id_client_job'),
			'id_title' 			=> $this->input->post('pat_title'),
			'religion' 			=> $this->input->post('religion'),
			'job' 				=> $this->input->post('jobs'),
		);
		$this->load->model('m_patient');
		$this->m_patient->save_patient($data_pat);

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_log = array(
			'id_user'						=> $user_id,
			'log_date'						=> date("Y-m-d H:i:s"),
			'log_desc' 						=> "Create Patient Data : " . $this->input->post('pat_name') . " | Patient MRN : " . $this->input->post('pat_mrn') . "",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);


		include './design/koneksi/file.php';
		// Get all the data from the "example" table
		$result = mysqli_query($con, "SELECT id_Pat FROM pat_data ORDER BY id_Pat DESC LIMIT 1")
			or die($this->db->error());
		while ($row = mysqli_fetch_array($result)) {
			$last_id = $row['id_Pat'];
		}
		if ($reg_form == "/ci/registration/reg_patien") {
			echo "<script>window.opener.document.forms['quesioner_mcu'].elements['id_pat'].value='$last_id';window.opener.document.forms['quesioner_mcu'].elements['pat_mrn'].value='$pat_name';
				window.close(this);</script>";
			//redirect('registration/reg_patien/ok/'.$last_id.'/'.$pat_name.''); 
			//echo "$reg_form kondisi satu ngeklose";
		} else {
			// echo "$reg_form kondisi kedua langsung"; 
			//Echo "From patient $last_id";
			redirect('patient/data_patient/ok');
			// redirect('patient/data_patient/ok/'.$last_id.'/'.$pat_name.''); 
			echo "<script>setTimeout(function () { window.close();}, 1);</script>";
		}
	}


	function fo_report()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$this->load->model('m_regreport');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$id				 		= $session_data['id'];
			$data['trx_registration'] 			= $this->m_patient->get_report_reg2(); // 		
			$this->template->set('title', 'Klinik | Transfer Item List');
			$this->template->load('template', 'menu/fo_report', $data);
		} else {
			redirect('login', 'refresh');
		}
	}

	function fo_report_excel()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$this->load->model('m_regreport');
			$session_data 				= $this->session->userdata('logged_in');
			$data['username'] 			= $session_data['username'];
			$id				 			= $session_data['id'];
			$data['trx_registration'] 	= $this->m_patient->get_report_reg();
			$this->load->view('menu/fo_report_excel', $data);
		} else {
			redirect('login', 'refresh');
		}
	}


	//fungsi delete pasien data
	function delete_pat()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$id 					= $this->uri->segment(3);

		$data_pat 				= array(
			'status_pat'		=> 1,
		);
		$this->load->model('m_patient');
		$this->m_patient->update_pat_data2($data_pat, $id);

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_log = array(
			'id_user'						=> $user_id,
			'log_date'						=> date("Y-m-d"),
			'log_desc' 						=> "Delete Patient ID : " . $id,
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);

		// echo "<script>window.close(this);</script>";
		// echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
		redirect('patient/list_patient/del');
	}

	//fungsi update pasien data
	function update_pat()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$pat_mrn				= $this->input->post('pat_mrn');
		$pat_name				= $this->input->post('pat_name');
		$pat_dob				= date("Y-m-d", strtotime($this->input->post('reg_date')));
		$contact_phone			= $this->input->post('pat_contact_home[1]') . $this->input->post('pat_contact_home[2]') . $this->input->post('pat_contact_home[3]');
		$contact_mobile			= $this->input->post('pat_contact_misc[1]') . $this->input->post('pat_contact_misc[2]') . $this->input->post('pat_contact_misc[3]');


		$data_pat 				= array(
			'id_history'		=> $this->input->post('id_his'),
			'pat_name' 			=> ucwords($this->input->post('pat_name')),
			'pat_gender'		=> $this->input->post('pat_gender'),
			'pat_dob' 			=> $pat_dob,
			'pat_pob'			=> $this->input->post('pat_pob'),
			'pat_idno' 			=> $this->input->post('pat_idno'),
			'pat_marital_status' => $this->input->post('pat_marital_status'),
			'pat_address_home' 	=> $this->input->post('pat_address_home'),
			'pat_contact_home'	=> $contact_phone,
			'pat_address_misc' 	=> $this->input->post('pat_address_misc'),
			'pat_contact_misc'	=> $contact_mobile,
			'pat_rel_name' 		=> $this->input->post('pat_rel_name'),
			'pat_rel_type'		=> $this->input->post('pat_rel_type'),
			'pat_rel_contact' 	=> $this->input->post('pat_rel_contact'),
			'pat_nationality'	=> $this->input->post('pat_nationality'),
			'pat_email' 		=> $this->input->post('pat_email'),
			'pat_province'		=> $this->input->post('pat_province'),
			'pat_city' 			=> $this->input->post('pat_city'),
			'id_client'			=> $this->input->post('id_client'),
			'id_client_dept' 	=> $this->input->post('id_client_dept'),
			'id_client_job'		=> $this->input->post('id_client_job'),
			'id_title' 			=> $this->input->post('pat_title'),
		);
		$this->load->model('m_patient');
		$this->m_patient->update_pat_data($data_pat, $pat_mrn);

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_log = array(
			'id_user'						=> $user_id,
			'log_date'						=> date("Y-m-d"),
			'log_desc' 						=> "Update Patient Data : " . $this->input->post('pat_name') . " | Patient MRN : " . $this->input->post('pat_mrn') . "",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);

		// echo "<script>window.close(this);</script>";
		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
	}

	//fungsi load questionnaire mcu
	function quesioner_patient_mcu()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$this->template->set('title', 'Klinik | Questionnaire MCU');
			$this->template->load('template', 'menu/quesioner_patient_mcu', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	function que_patient_mcu_act()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$id_regist				= $this->input->post('id_reg');
			// proses insert data jika data kosong
			$data['all_data'] = $this->m_patient->get_que_mcu($id_regist);
			$row_cnt 	= $data['all_data']->num_rows();
			if ($row_cnt == 0) {
				$data_pack 						= array(
					'id_pat'					=> $this->input->post('id_pat'),
					'id_reg' 					=> $this->input->post('id_reg'),
				);
				$this->m_patient->save_que_mcu($data_pack);
			}
			$this->template->set('title', 'Klinik | Questionnaire MCU');
			$this->template->load('template', 'menu/quesioner_patient_mcu_act', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi load questionnaire treadmill
	function quesioner_patient_tread()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$this->template->set('title', 'Klinik | Questionnaire Treadmill');
			$this->template->load('template', 'menu/quesioner_patient_tread', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi load questionnaire treadmill
	function quesioner_patient_mcu_local()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$this->template->set('title', 'Klinik | Questionnaire MCU Local');
			$this->template->load('template', 'menu/quesioner_patient_mcu_local', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi load questionnaire gynrcology
	function quesioner_patient_gyn()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$this->template->set('title', 'Klinik | Questionnaire Gynecology');
			$this->template->load('template', 'menu/quesioner_patient_gyn', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi mencari pasien
	function find_patient()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_patient->get_patient_data();
			$this->template->set('title', 'Klinik | Find Patient');
			$this->template->load('template', 'menu/find_patient', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//find patient doctor
	function find_pat_doc()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_patient->get_patient_data();
			$this->template->set('title', 'Klinik | Find Patient');
			$this->template->load('template', 'menu/find_pat_doctor', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi mencari pasien
	function find_patient_doctor()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_patient->get_patient_data_doctor();
			$this->template->set('title', 'Klinik | Find Patient');
			$this->template->load('template', 'menu/find_patient_doctor', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi mencari lab
	function find_lab()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['data'] 			= $this->m_patient->get_data_lab();
			$this->template->set('title', 'Klinik | Find Lab');
			$this->template->load('template', 'menu/find_lab', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi mencari radiology
	function find_radiology()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['data'] 			= $this->m_patient->get_data_radiology();
			$this->template->set('title', 'Klinik | Find Radiology');
			$this->template->load('template', 'menu/find_radiology', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi mencari pasien data
	function find_patient_data()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_patient->get_patient_data_all();
			$this->template->set('title', 'Klinik | Find Patient Data');
			$this->template->load('template', 'menu/find_patient_data', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	public function list_patient()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_patient->get_patient_data_all();
			$this->template->set('title', 'Klinik | list Patient');
			$this->template->load('template', 'menu/list_patient', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	function list_patient_excel()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_patient->get_patient_data_all();
			$this->template->set('title', 'Klinik | list Patient');
			$this->load->view('menu/list_patient_excel', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	function list_patient_excel_for_eazy()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_patient->get_patient_data_all();
			$this->template->set('title', 'Klinik | list Patient');
			$this->load->view('menu/list_patient_excel_2', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi mencari pasien medical check up
	function find_patient_mcu()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_patient->get_patient_data_mcu();
			$this->template->set('title', 'Klinik | Find Medical Check Up');
			$this->template->load('template', 'menu/find_patient_mcu', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi mencari pasien treadmill
	function find_patient_tread()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_patient->get_patient_data_tread();
			$this->template->set('title', 'Klinik | Find Treadmill');
			$this->template->load('template', 'menu/find_patient_tread', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi mencari pasien gynecology
	function find_patient_gyn()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_patient->get_patient_data_gyn();
			$this->template->set('title', 'Klinik | Find Gynecology');
			$this->template->load('template', 'menu/find_patient_gyn', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi mencari pasien Marking Sheet
	function find_patient_mark()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['idx'] 			= $session_data['id'];
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_patient->get_patient_data_mark();
			$this->template->set('title', 'Klinik | Find Patient');
			$this->template->load('template', 'menu/find_patient_mark', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi mencari pasien Marking Sheet
	function find_patient_mark5()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['idx'] 			= $session_data['id'];
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_patient->get_patient_data_mark();
			$this->template->set('title', 'Klinik | Find Patient');
			$this->template->load('template', 'menu/find_patient_mark5', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	function find_patient_mark_mcu()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['idx'] 			= $session_data['id'];
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_patient->get_patient_data_mark();
			$this->template->set('title', 'Klinik | Find Patient');
			$this->template->load('template', 'menu/find_patient_mark3', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	function find_patient_print_mcu()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['idx'] 			= $session_data['id'];
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_patient->get_patient_data_printmcu();
			$this->template->set('title', 'Klinik | Find Patient');
			$this->template->load('template', 'menu/find_patient_mark4', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	function find_patient_mark_id()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['idx'] 			= $session_data['id'];
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_patient->get_patient_data_mark_distinct();
			$this->template->set('title', 'Klinik | Find Patient');
			$this->template->load('template', 'menu/find_patient_mark2', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi mencari pasien Marking Sheet
	function find_patient_mark_sheet()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['idx'] 			= $session_data['id'];
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_patient->get_patient_data_mark_sheet();
			$this->template->set('title', 'Klinik | Find Patient');
			$this->template->load('template', 'menu/find_patient_mark_sheet', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//Fungsi mencari pasien Dental
	function find_patient_dental()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['idx'] 			= $session_data['id'];
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_patient->get_patient_data_dental();
			$this->template->set('title', 'Klinik | Find Patient Dental');
			$this->template->load('template', 'menu/find_patient_dental', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi simpan questionnaire
	function save_que_mcu()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_que_mcu 						= array(
			'id_reg'						=> $this->input->post('id_reg'),
			'id_pat' 						=> $this->input->post('pat_mrn'),

			'vision_difficulty'				=> $this->input->post('vd'),
			'ear_discharge' 				=> $this->input->post('ed'),
			'asthma_bronx'					=> $this->input->post('ab'),
			'hay_fever'						=> $this->input->post('hf'),
			'skin_touble'					=> $this->input->post('st'),
			'tbc' 							=> $this->input->post('tb'),
			'breath_shortness'				=> $this->input->post('bs'),
			'blood_cough'	 				=> $this->input->post('bc'),

			'stomach_ulcer'					=> $this->input->post('su'),
			'recurrent_indigestion' 		=> $this->input->post('ri'),
			'jaundice_hepat'				=> $this->input->post('jh'),
			'gall_stones'	 				=> $this->input->post('gs'),
			'triglyceride'					=> $this->input->post('ts'),
			'blood_in_stool' 				=> $this->input->post('bis'),
			'varicose_veins'				=> $this->input->post('vv'),
			'cancer' 						=> $this->input->post('cr'),

			'heart_desease'			 		=> $this->input->post('hd'),
			'rheumatic'						=> $this->input->post('rd'),
			'abn_heart_beat' 				=> $this->input->post('abh'),
			'high_bp'						=> $this->input->post('hbp'),
			'stroke'		 				=> $this->input->post('str'),
			'chest_pain'					=> $this->input->post('sc'),
			'blood_disease'					=> $this->input->post('abd'),

			'kidney_disease'		 		=> $this->input->post('kd'),
			'pain_urine'					=> $this->input->post('pp'),
			'prostatic_disease'				=> $this->input->post('pd'),
			'diabetes'						=> $this->input->post('db'),
			'migraine'		 				=> $this->input->post('hm'),
			'fainting'						=> $this->input->post('df'),
			'joints_trougle'				=> $this->input->post('jst'),

			'accidents'		 				=> $this->input->post('saf'),
			'surgical_operation'			=> $this->input->post('so'),
			'height_fear'					=> $this->input->post('fh'),
			'reject_employment'				=> $this->input->post('re'),
			'award_benefit'		 			=> $this->input->post('abi'),
			'mental_condition'				=> $this->input->post('tmc'),
			'drinks_drugs'					=> $this->input->post('tpd'),
			'toxic_exposure' 				=> $this->input->post('ets'),
			'other_illness'					=> $this->input->post('hy'),
			'medication_allergy'			=> $this->input->post('aya'),
			'regular_medication'			=> $this->input->post('ayo'),
			'smoke'							=> $this->input->post('dys'),

			'abn_gyne'						=> $this->input->post('aga'),
			'first_mens'					=> $this->input->post('yol'),
			'regular_period'				=> $this->input->post('rpe'),
			'pregnant'			 			=> $this->input->post('ayp'),
			'lmp'							=> $this->input->post('lmp'),

			'is_father_alive' 				=> $this->input->post('fat_alive'),
			'father_age'					=> $this->input->post('fat_alive_age'),
			'father_medical'				=> $this->input->post('fat_mh'),
			'is_mother_alive'				=> $this->input->post('mot_alive'),
			'mother_age'	     			=> $this->input->post('mot_alive_age'),
			'mother_medical'				=> $this->input->post('mot_mh'),

			'siblings1_alive' 				=> $this->input->post('bro1_alive'),
			'siblings1_age'					=> $this->input->post('bro1_alive_age'),
			'siblings1_medical'				=> $this->input->post('bro1_mh'),
			'siblings2_alive'				=> $this->input->post('bro2_alive'),
			'siblings2_age'	     			=> $this->input->post('bro2_alive_age'),
			'siblings2_medical'				=> $this->input->post('bro2_mh'),

			'siblings3_alive' 				=> $this->input->post('bro3_alive'),
			'siblings3_age'					=> $this->input->post('bro3_alive_age'),
			'siblings3_medical'				=> $this->input->post('bro3_mh'),
			'smoking_habits'				=> $this->input->post('smk'),
			'smoking_freq'	     			=> $this->input->post('smk_freq'),
			'alcohol_habits'				=> $this->input->post('alc'),
			'alcohol_freq'					=> $this->input->post('alc_freq'),
			'drugs_habits'					=> $this->input->post('drugs_hab'),
			'drugs_routine'					=> $this->input->post('drugs_freq'),
			'exercise_habit'				=> $this->input->post('exercise'),
			'vacc_habit'					=> $this->input->post('exercise_freq'),
		);
		$this->load->model('m_patient');
		$this->m_patient->save_que_mcu($data_que_mcu);

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_log = array(
			'id_user'		=> $user_id,
			'log_date'		=> date("Y-m-d"),
			'log_desc' 		=> "Create Questionnaire MCU | ID Registration : " . $this->input->post('id_reg') . "",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log

		redirect('patient/quesioner_patient_mcu/ok');
	}
	//fungsi Update questionnaire
	function update_que_mcu()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$id_update				= $this->input->post('id_up');
		$data_que_mcu 						= array(
			'id_reg'						=> $this->input->post('id_reg'),
			'id_pat' 						=> $this->input->post('pat_mrn'),
			'vision_difficulty'				=> $this->input->post('vd'),
			'ear_discharge' 				=> $this->input->post('ed'),
			'asthma_bronx'					=> $this->input->post('ab'),
			'hay_fever'						=> $this->input->post('hf'),
			'skin_touble'					=> $this->input->post('st'),
			'tbc' 							=> $this->input->post('tb'),
			'breath_shortness'				=> $this->input->post('bs'),
			'blood_cough'	 				=> $this->input->post('bc'),

			'stomach_ulcer'					=> $this->input->post('su'),
			'recurrent_indigestion' 		=> $this->input->post('ri'),
			'jaundice_hepat'				=> $this->input->post('jh'),
			'gall_stones'	 				=> $this->input->post('gs'),
			'triglyceride'					=> $this->input->post('ts'),
			'blood_in_stool' 				=> $this->input->post('bis'),
			'varicose_veins'				=> $this->input->post('vv'),
			'cancer' 						=> $this->input->post('cr'),

			'heart_desease'			 		=> $this->input->post('hd'),
			'rheumatic'						=> $this->input->post('rd'),
			'abn_heart_beat' 				=> $this->input->post('abh'),
			'high_bp'						=> $this->input->post('hbp'),
			'stroke'		 				=> $this->input->post('str'),
			'chest_pain'					=> $this->input->post('sc'),
			'blood_disease'					=> $this->input->post('abd'),

			'kidney_disease'		 		=> $this->input->post('kd'),
			'pain_urine'					=> $this->input->post('pp'),
			'prostatic_disease'				=> $this->input->post('pd'),
			'diabetes'						=> $this->input->post('db'),
			'migraine'		 				=> $this->input->post('hm'),
			'fainting'						=> $this->input->post('df'),
			'joints_trougle'				=> $this->input->post('jst'),

			'accidents'		 				=> $this->input->post('saf'),
			'surgical_operation'			=> $this->input->post('so'),
			'height_fear'					=> $this->input->post('fh'),
			'reject_employment'				=> $this->input->post('re'),
			'award_benefit'		 			=> $this->input->post('abi'),
			'mental_condition'				=> $this->input->post('tmc'),
			'drinks_drugs'					=> $this->input->post('tpd'),
			'toxic_exposure' 				=> $this->input->post('ets'),
			'other_illness'					=> $this->input->post('hy'),
			'medication_allergy'			=> $this->input->post('aya'),
			'regular_medication'			=> $this->input->post('ayo'),
			'smoke'							=> $this->input->post('dys'),

			'abn_gyne'						=> $this->input->post('aga'),
			'first_mens'					=> $this->input->post('yol'),
			'regular_period'				=> $this->input->post('rpe'),
			'pregnant'			 			=> $this->input->post('ayp'),
			'lmp'							=> $this->input->post('lmp'),

			'is_father_alive' 				=> $this->input->post('fat_alive'),
			'father_age'					=> $this->input->post('fat_alive_age'),
			'father_medical'				=> $this->input->post('fat_mh'),
			'is_mother_alive'				=> $this->input->post('mot_alive'),
			'mother_age'	     			=> $this->input->post('mot_alive_age'),
			'mother_medical'				=> $this->input->post('mot_mh'),

			'siblings1_alive' 				=> $this->input->post('bro1_alive'),
			'siblings1_age'					=> $this->input->post('bro1_alive_age'),
			'siblings1_medical'				=> $this->input->post('bro1_mh'),
			'siblings2_alive'				=> $this->input->post('bro2_alive'),
			'siblings2_age'	     			=> $this->input->post('bro2_alive_age'),
			'siblings2_medical'				=> $this->input->post('bro2_mh'),

			'siblings3_alive' 				=> $this->input->post('bro3_alive'),
			'siblings3_age'					=> $this->input->post('bro3_alive_age'),
			'siblings3_medical'				=> $this->input->post('bro3_mh'),
			'smoking_habits'				=> $this->input->post('smk'),
			'smoking_freq'	     			=> $this->input->post('smk_freq'),
			'alcohol_habits'				=> $this->input->post('alc'),
			'alcohol_freq'					=> $this->input->post('alc_freq'),
			'drugs_habits'					=> $this->input->post('drugs_hab'),
			'drugs_routine'					=> $this->input->post('drugs_freq'),
			'exercise_habit'				=> $this->input->post('exercise'),
			'vacc_habit'					=> $this->input->post('exercise_freq'),
		);
		$this->load->model('m_patient');
		$this->m_patient->update_que_mcu($data_que_mcu, $id_update);
		redirect('patient/quesioner_patient_mcu/change');
	}
	//fungsi simpan questionnaire
	function save_que_tread()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_que_tr 						= array(
			'id_reg'						=> $this->input->post('id_reg'),
			'id_pat' 						=> $this->input->post('pat_mrn'),
			'tread_high_bp'					=> $this->input->post('bp'),
			'tread_high_hr' 				=> $this->input->post('hr'),
			'tread_chest_pain'				=> $this->input->post('cp'),
			'tread_hard_breath'				=> $this->input->post('hb'),
			'tread_cardio_hist'				=> $this->input->post('ch'),
			'tread_foot_injury'				=> $this->input->post('fi'),
		);
		$this->load->model('m_patient');
		$this->m_patient->save_que_tread($data_que_tr);
		redirect('patient/quesioner_patient_tread/ok');
	}
	//fungsi simpan questionnaire
	function save_que_gyn()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_que_gyn 						= array(
			'id_reg'						=> $this->input->post('id_reg'),
			'id_pat' 						=> $this->input->post('pat_mrn'),
			'gyn_last_mens_month'			=> $this->input->post('lmp_month'),
			'gyn_last_mens_day'				=> $this->input->post('lmp_day'),
			'gyn_reg_mens'  				=> $this->input->post('rm'),
			'gyn_irr_bleeding'				=> $this->input->post('igb'),
			'gyn_discharge'					=> $this->input->post('vd'),
			'gyn_discharge_qty'				=> $this->input->post('qty'),
			'gyn_abortion'					=> $this->input->post('abrt'),
			'gyn_abort_spontan'				=> $this->input->post('spnts'),
			'gyn_abort_induced'				=> $this->input->post('qty'),
			'gyn_hormon_ther'				=> $this->input->post('trpy'),
			'gyn_hormon_meds'				=> $this->input->post('ther_med'),
			'gyn_delivery'					=> $this->input->post('deli'),
			'gyn_contracept'				=> $this->input->post('cntrp'),
			'gyn_contracept_desc'			=> $this->input->post('con_exp'),
			'gyn_operation'					=> $this->input->post('go'),
			'gyn_operation_desc'			=> $this->input->post('exp_go'),
			'gyn_last_exam_year'			=> $this->input->post('ge_year'),
			'gyn_last_exam_mo'				=> $this->input->post('ge_month'),
			'gyn_sexual_act'				=> $this->input->post('actv_sex'),
		);
		$this->load->model('m_patient');
		$this->m_patient->save_que_gyn($data_que_gyn);
		redirect('patient/quesioner_patient_gyn/ok');
	}
	//fungsi update questionnaire treadmill
	function update_que_tread()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$id_update				= $this->input->post('id_up');
		$data_que_tr 						= array(
			'id_reg'						=> $this->input->post('id_reg'),
			'id_pat' 						=> $this->input->post('pat_mrn'),
			'tread_high_bp'					=> $this->input->post('bp'),
			'tread_high_hr' 				=> $this->input->post('hr'),
			'tread_chest_pain'				=> $this->input->post('cp'),
			'tread_hard_breath'				=> $this->input->post('hb'),
			'tread_cardio_hist'				=> $this->input->post('ch'),
			'tread_foot_injury'				=> $this->input->post('fi'),
		);
		$this->load->model('m_patient');
		$this->m_patient->update_que_tread($data_que_tr, $id_update);
		redirect('patient/quesioner_patient_tread/change');
	}
	//fungsi update questionnaire treadmill
	function update_que_gyn()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$id_update				= $this->input->post('id_up');
		$data_que_gyn 						= array(
			'id_reg'						=> $this->input->post('id_reg'),
			'id_pat' 						=> $this->input->post('pat_mrn'),
			'gyn_last_mens_month'			=> $this->input->post('lmp_month'),
			'gyn_last_mens_day'				=> $this->input->post('lmp_day'),
			'gyn_reg_mens'  				=> $this->input->post('rm'),
			'gyn_irr_bleeding'				=> $this->input->post('igb'),
			'gyn_discharge'					=> $this->input->post('vd'),
			'gyn_discharge_qty'				=> $this->input->post('qty'),
			'gyn_abortion'					=> $this->input->post('abrt'),
			'gyn_abort_spontan'				=> $this->input->post('spnts'),
			'gyn_abort_induced'				=> $this->input->post('qty'),
			'gyn_hormon_ther'				=> $this->input->post('trpy'),
			'gyn_hormon_meds'				=> $this->input->post('ther_med'),
			'gyn_delivery'					=> $this->input->post('deli'),
			'gyn_contracept'				=> $this->input->post('cntrp'),
			'gyn_contracept_desc'			=> $this->input->post('con_exp'),
			'gyn_operation'					=> $this->input->post('go'),
			'gyn_operation_desc'			=> $this->input->post('exp_go'),
			'gyn_last_exam_year'			=> $this->input->post('ge_year'),
			'gyn_last_exam_mo'				=> $this->input->post('ge_month'),
			'gyn_sexual_act'				=> $this->input->post('actv_sex'),
		);
		$this->load->model('m_patient');
		$this->m_patient->update_que_gyn($data_que_gyn, $id_update);
		redirect('patient/quesioner_patient_gyn/change');
	}
	//fungsi load marking sheet
	function mark_sheet_mcu()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['loc'] 			= $session_data['location'];
			$this->template->set('title', 'Klinik | Marking Sheet MCU');
			$this->template->load('template', 'menu/mark_sheet_mcu', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi load marking sheet
	function input_result_dental()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['loc'] 			= $session_data['location'];
			$this->template->set('title', 'Klinik | Input Result Dental');
			$this->template->load('template', 'menu/input_result_dental', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi load marking sheet
	function mark_sheet_mcu_act()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$this->load->model('m_lab');
			$this->load->model('m_registration');
			$idxx					= $this->input->post('id_pat');
			$id_regist				= $this->input->post('id_reg');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['loc'] 			= $session_data['location'];
			$user_id				= $session_data['id'];

			//proses insert data jika data kosong, agar dapat mendapat data di table pat_ms_d dan dapat verifikasi petugas. add rangga 4 Maret 2016
			$data['all_data'] = $this->m_patient->get_data_lock_ms($id_regist);
			//$data['all_data'] = $this->m_patient->get_data_mcu_patient_2($id_regist);
			$row_cnt 	= $data['all_data']->num_rows();
			//echo $id_regist ;
			//echo $row_cnt ;
			//die();
			if ($row_cnt == 0) {

				$data_pack 						= array(
					'id_pat'					=> $this->input->post('id_pat'),
					'id_reg' 					=> $this->input->post('id_reg'),
				);
				$this->m_patient->save_ms_h($data_pack);
				include './design/koneksi/file.php';
				$query 		= "SELECT id_ms_h id FROM pat_ms_h ORDER BY id_ms_h DESC LIMIT 1";
				if ($result 	= mysqli_query($con, $query)) {
					$row 	= mysqli_fetch_assoc($result);
					$count 	= $row['id'];
				}

				$data['find'] 			= $this->m_patient->get_mark_mcu_yang_bener_baru($id_regist);
				$rowC 					= $data['find']->num_rows();
				// echo $rowC; exit();
				$iscomp 	= "0";
				$user_id_2 	= "0";
				$prince		= array();
				foreach ($data['find']->result() as $row) {
					$data_prince	= $row->minions;
					$sql = "INSERT INTO pat_ms_d (id_ms_h, id_reg, id_service) VALUES ('" . $count . "', '" . $this->input->post('id_reg') . "', '" . $row->serpis . "')";
					//echo $sql."<br/>"; exit();
					$this->db->query($sql);
				}
				$prince	= $data_prince;
				//Proses Insert End...

			}

			$data['find'] 			= $this->m_patient->get_mark_mcu_yang_bener_baru($id_regist);
			$prince					= array();

			foreach ($data['find']->result() as $row) {
				$data_prince	= $row->minions;
			}

			$prince	= $data_prince;
			$data['data'] 			= $this->m_patient->get_patient_2($idxx);
			foreach ($data['data']->result() as $row) {
				$birth 	= $row->pat_dob;
				$gender = $row->pat_gender;
				//echo $birth ;
				//Function Convertion Age to Months
				$birthday = new DateTime($birth);
				$diff = $birthday->diff(new DateTime());
				$age = $diff->format('%m') + 12 * $diff->format('%y');
				//echo $months;
				//End of Function

			}
			$data['get_doctor2']        = $this->m_registration->get_doctor_by_user();
			$data['find']	 			= $this->m_patient->get_mark_mcu_yang_bener_baru_3($id_regist, $prince);
			$data['find_left'] 			= $this->m_patient->get_mark_mcu_2($id_regist, $prince, $age, $gender);
			//$data['find_notes']			= $this->m_patient->get_notes_ms($id_regist);
			$data['data_lock'] 			= $this->m_patient->get_data_lock_ms($id_regist);
			foreach ($data['data_lock']->result() as $row_lock) {
			}

			if ($user_id != $row_lock->lock_by && $row_lock->locked != 0) {
				echo "<script>alert('Has been locked !');</script>";
				redirect('patient/mark_sheet_mcu', 'refresh');
				exit();
			}

			$datapack				= array(
				'lock_by'				=> $user_id,
				'locked'				=> 1,
			);
			$data['lock'] 			= $this->m_patient->lock_mark_sheet($id_regist, $datapack);

			$data['all_note'] 			= $this->m_patient->get_data_mcu_patient_note($id_regist);
			$this->template->set('title', 'Klinik | Marking Sheet MCU');
			$this->template->load('template', 'menu/mark_sheet_mcu_act', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi load 
	function update_doc()
	{
		if ($this->session->userdata('logged_in')) {
			$id 	= $this->uri->segment(3);
			$val 	= $this->uri->segment(4);
			$data = array(
				'id_dr_fee'  => $val,
			);
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$user						= $session_data['id'];
			$data['data'] 			= $this->m_patient->update_doctor($id, $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi load marking sheet
	function input_result_dental_act()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$this->load->model('m_lab');

			$idxx					= $this->input->post('id_pat');
			$id_regist				= $this->input->post('id_reg');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['loc'] 			= $session_data['location'];
			$user_id				= $session_data['id'];
			//proses insert data jika data kosong, agar dapat mendapat data di table pat_ms_d dan dapat verifikasi petugas. add rangga 4 Maret 2016
			$data['all_data'] = $this->m_patient->get_data_lock_ms($id_regist);
			// $data['all_data'] = $this->m_patient->get_data_mcu_patient_2($id_regist);
			$row_cnt 	= $data['all_data']->num_rows();
			// echo $id_regist ;
			// echo $row_cnt ;
			// die();
			if ($row_cnt == 0) {

				$data_pack 						= array(
					'id_pat'					=> $this->input->post('id_pat'),
					'id_reg' 					=> $this->input->post('id_reg'),
				);
				$this->m_patient->save_ms_h($data_pack);
				include './design/koneksi/file.php';
				$query 		= "SELECT id_ms_h id FROM pat_ms_h ORDER BY id_ms_h DESC LIMIT 1";
				if ($result 	= mysqli_query($con, $query)) {
					$row 	= mysqli_fetch_assoc($result);
					$count 	= $row['id'];
				}

				$data['find'] 			= $this->m_patient->get_mark_mcu_yang_bener_baru($id_regist);
				$rowC 					= $data['find']->num_rows();
				// echo $rowC; exit();
				$iscomp 	= "0";
				$user_id_2 	= "0";
				$prince		= array();
				foreach ($data['find']->result() as $row) {
					$data_prince	= $row->minions;
					$sql = "INSERT INTO pat_ms_d (id_ms_h, id_reg, id_service) VALUES ('" . $count . "', '" . $this->input->post('id_reg') . "', '" . $row->serpis . "')";
					//echo $sql."<br/>"; exit();
					$this->db->query($sql);
				}
				$prince	= $data_prince;
				//Proses Insert End...
				$datapack				= array(
					'lock_by'				=> $user_id,
					'locked'				=> 1,
				);
				$data['lock'] 			= $this->m_patient->lock_mark_sheet($id_regist, $datapack);
			}

			$data['find'] 			= $this->m_patient->get_mark_mcu_yang_bener_baru($id_regist);
			$prince					= array();

			foreach ($data['find']->result() as $row) {
				$data_prince	= $row->minions;
			}

			$prince	= $data_prince;
			$data['data'] 			= $this->m_patient->get_patient_2($idxx);
			foreach ($data['data']->result() as $row) {
				$birth 	= $row->pat_dob;
				$gender = $row->pat_gender;
				//echo $birth ;
				//Function Convertion Age to Months
				$birthday = new DateTime($birth);
				$diff = $birthday->diff(new DateTime());
				$age = $diff->format('%m') + 12 * $diff->format('%y');
				//echo $months;
				//End of Function

			}
			$data['find']	 			= $this->m_patient->get_mark_mcu_yang_bener_baru_3($id_regist, $prince);
			$data['find_left'] 			= $this->m_patient->get_data_dental($id_regist, $prince, $age, $gender);
			$data['data_lock'] 			= $this->m_patient->get_data_lock_ms($id_regist);
			foreach ($data['data_lock']->result() as $row_lock) {
			}

			if ($user_id != $row_lock->lock_by && $row_lock->locked != 0) {
				echo "<script>alert('Has been locked !');</script>";
				redirect('patient/mark_sheet_mcu', 'refresh');
				exit();
			}

			$this->template->set('title', 'Klinik | Input Result Dental');
			$this->template->load('template', 'menu/input_result_dental_act', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi load Lab
	function fetch_prov()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_lab');
			$session_data 			= $this->session->userdata('logged_in');
			$this->template->set('title', 'Klinik | Province');
			$this->template->load('template', 'menu/fetch_prov');
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi simpan master package
	function save_mark_mcu()
	{
		$this->load->model('m_patient');
		$session_data 					= $this->session->userdata('logged_in');
		$user_id						= $session_data['id'];
		$rowC							= $this->input->post('rowC');
		$register_id					= $this->input->post('id_reg');
		$datapack						= array('locked' => 0,);
		$data['lock'] 					= $this->m_patient->lock_mark_sheet($register_id, $datapack);

		for ($i = 1; $i <= $rowC; $i++) {
			$hasil 						= $this->input->post('result_' . $i . '');
			$service 					= $this->input->post('id_serv_' . $i . '');
			$value_id 					= $this->input->post('id_value_' . $i . '');
			$data['all_data'] 			= $this->m_patient->get_data_mcu_patient($register_id, $service, $value_id);
			$data['all_note'] 			= $this->m_patient->get_data_mcu_patient_note($register_id, $service, $value_id);
			$row_cnt 					= $data['all_data']->num_rows();
			$row_note 					= $data['all_note']->num_rows();

			if ($row_cnt != 0) {
				$keluar 				= 1;
				$sql = "UPDATE pat_result_mcu SET result = '" . $hasil . "',ranges = '" . $this->input->post('ranges_' . $i . '') . "',flags='" . $this->input->post('mark[' . $i . ']') . "' WHERE id_service = '" . $service . "' and id_reg = '" . $register_id . "' and id_value='" . $value_id . "' ";
				$this->db->query($sql);
				//Create Log Start
				$session_data 			= $this->session->userdata('logged_in');
				$user_id				= $session_data['id'];
				$data_log = array(
					'id_user'						=> $user_id,
					'log_date'						=> date("Y-m-d"),
					'log_desc' 						=> "Update Marking Sheet MCU | ID Registration : " . $this->input->post('id_reg') . "",
				);
				$this->load->model('m_login');
				$this->m_login->log($data_log);
				//Endless Log
			} else {
				$keluar 				= 0;
				$sql = "INSERT INTO pat_result_mcu (id_reg, id_service, id_value, ranges, result, create_by, flags) VALUES ('" . $register_id . "', '" . $this->input->post('id_serv_' . $i . '') . "', '" . $this->input->post('id_value_' . $i . '') . "', '" . $this->input->post('ranges_' . $i . '') . "', '" . $this->input->post('result_' . $i . '') . "', '" . $user_id . "', '" . $this->input->post('mark[' . $i . ']') . "')";
				$this->db->query($sql);
				//Create Log Start
				$session_data 			= $this->session->userdata('logged_in');
				$user_id				= $session_data['id'];
				$data_log = array(
					'id_user'						=> $user_id,
					'log_date'						=> date("Y-m-d"),
					'log_desc' 						=> "Create Marking Sheet MCU | ID Registration : " . $this->input->post('id_reg') . "",
				);
				$this->load->model('m_login');
				$this->m_login->log($data_log);
				//Endless Log
			} // Batas else
		} // Batas looping

		//$i = $i+1;
		if ($row_note != 0) {
			$sqlx = "UPDATE pat_result_mcu SET result = '" . $this->input->post('result_' . $i . '') . "' WHERE id_reg = '" . $register_id . "' and id_value='99999' and ranges='Notes' ";
			$this->db->query($sqlx);
			//echo $i;
			//echo $sqlx;
			//die();
		} else {
			$sqly = "INSERT INTO pat_result_mcu (id_reg, id_service, id_value, ranges, result, create_by) VALUES ('" . $register_id . "', '99999', '99999', 'Notes', '" . $this->input->post('result_' . $i . '') . "', '" . $user_id . "')";
			$this->db->query($sqly);
			//echo $i;
			//echo $sqly;
			//die();
		}

		if ($keluar == 0) {
			redirect('patient/mark_sheet_mcu/ok');
		} else {
			redirect('patient/mark_sheet_mcu/update');
		}
	}
	//fungsi load print mark sheet
	function print_mark_sheet()
	{
		if ($this->session->userdata('logged_in')) {
			$id = $this->uri->segment(3);
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['data'] 			= $this->m_patient->get_print_mark($id);
			$data['find_left'] 		= $this->m_patient->get_mark_mcu($id);
			$prince					= array();
			foreach ($data['find_left']->result() as $row) {
				$prince	= $row->minions;
				$birth 	= $row->pat_dob;
				$gender = $row->pat_gender;
				//echo $birth ;
				//Function Convertion Age to Months
				$birthday = new DateTime($birth);
				$diff = $birthday->diff(new DateTime());
				$age = $diff->format('%m') + 12 * $diff->format('%y');
			}
			$data['find_2'] 			= $this->m_patient->get_mark_mcu_2($id, $prince, $age, $gender);
			$data['find_right'] 		= $this->m_patient->get_mark_mcu_yang_bener_baru_khusus_cetak($id, $prince);
			$data['gambar'] 			= $this->m_patient->get_mark_mcu_pic($id);
			$this->load->view('menu/print_mark_sheet', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi load print hasil label
	function print_label_act()
	{
		if ($this->session->userdata('logged_in')) {
			$id_reg 						= $this->input->post('id_reg');
			$data['id_up'] 				= $this->input->post('id_up');
			$data['id_pat'] 				= $this->input->post('id_pat');
			$data['pat_mrn'] 				= $this->input->post('pat_mrn');
			$data['pat_name']				= $this->input->post('pat_name');
			$data['age'] 					= $this->input->post('age');
			$data['client_name']			= $this->input->post('client_name');
			$data['pat_mcu'] 				= $this->input->post('pat_mcu');
			$data['gender']				= $this->input->post('gender');
			$data['pat_dob']				= $this->input->post('pat_dob');

			// echo $data['id_up']." - id_up </br>";
			// echo $data['id_pat']." - id_pat</br>";
			// echo $data['pat_mrn']."</br>";
			// echo $data['pat_name']."</br>";
			// echo $data['age']."</br>";
			// echo $data['client_name']."</br>";
			// echo $data['pat_mcu']."</br>";
			// echo $data['gender']."</br>";
			// echo $data['pat_dob']."</br>";
			// exit();

			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['data'] 			= $this->m_patient->get_print_mark($id_reg);
			$data['find'] 			= $this->m_patient->get_mark_mcu($id_reg);
			$data['gambar'] 			= $this->m_patient->get_mark_mcu_pic($id_reg);
			$this->load->view('menu/print_label_act', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function print_result_act()
	{
		if ($this->session->userdata('logged_in')) {
			//$id = $this->uri->segment(3);
			$this->load->model('m_patient');
			$this->load->model('m_docter');
			$jml_print				= $this->input->post('print_jum');
			$id						= $this->input->post('id_reg');
			$id_regist				= $this->input->post('id_reg');
			$data['id_regist']		= $this->input->post('id_reg');
			$id_pat					= $this->input->post('id_pat');
			$reg_date					= $this->input->post('reg_date');
			$bahasa					= $this->input->post('bahasa'); // pemisah untuk bahasa hasil mcu
			$data['bahasa']			= $this->input->post('bahasa'); // pemisah untuk bahasa hasil mcu
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$userid	 				= $session_data['id'];
			$data['userid']	 		= $session_data['id'];
			$now						= date("Y-m-d H:i:s");
			$idregjml					= array();
			$reg_id					= array();
			$tgl_reg					= array();
			$package_id				= array();
			$arr_id_item_value		= array();
			$arr_id_lab				= array();
			$arr_id_rad				= array();
			$arr_id_service			= array();
			$id_client_job			= array();
			$data['job']				= array();
			$data['jml_fisik'] 		= 0;
			$data['jml_lab'] 			= 0;
			$get_registration			= $this->m_patient->get_registration2($id_pat);
			$get_pat_data				= $this->m_patient->get_pat_data($id_pat);
			$jml_get_registration 	= $get_registration->num_rows();
			$jumlah_print 			= $jml_print + 1;
			$data['buka_fisik']		= $this->m_patient->get_data_grade_result($id_regist);


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
				'id_user'						=> $user_id,
				'log_date'						=> date("Y-m-d H:i:s"),
				'log_desc' 						=> "Print Medical Check UP Result | ID Registration: " . $id_regist . " | IP : " . $ip,
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log

			if ($id_regist == "0") {
				foreach ($get_registration->result() as $row) {
					$reg_date 				= $row->reg_date;
					$id_regist 				= $row->id_reg;
					$data['id_regist']		= $row->id_reg;
					$id 					= $row->id_reg;
				}
			}

			// ---------- untuk membedakan bahasa jepang dan english -------------
			if ($bahasa == 0) { // ---------- English -----------
				$data['konten'] 			= "Content";
				$data['std'] 				= "Std.Value";
				$data['dor']				= "Date of Result";
				$data['n'] 					= "Now";
				$data['p'] 					= "Previous";
				$data['l'] 					= "Last";
				$data['u'] 					= "Unit";
				$data['h_dental'] 			= "Dental Hygiene";
				$data['h_now'] 				= "Now";
				$data['h_Previous']			= "Previous";
				$data['h_Last']				= "Last";
				$data['h_Extra_Oral'] 		= "Extra Oral";
				$data['h_panoramic'] 		= "Panoramic X-ray";
				$data['h_intra'] 			= "Intra Oral";
				$data['h_Impaction']		= "Impaction teeth";
				$data['h_Broken']			= "Broken";
				$data['h_Cyst']				= "Cyst/granuloma";
				$data['h_Mobilization']		= "Mobilization of teeth";
				$data['h_Calculus']			= "Calculus/Plaque";
				$data['h_Caries']			= "Caries";
				$data['h_Filling']			= "Filling";
				$data['h_Missing']			= "Missing";
				$data['h_grade']			= "Grade";
				$data['g_Obesities']		= "Obesities";
				$data['g_Immunology_test']	= "Immunology test";
				$data['g_Eyes_Sight']		= "Eyes Sight";
				$data['g_dmh']				= "Diabetes Mellitus HbA1c";
				$data['g_Ocular']			= "Ocular Tension";
				$data['g_Bloodg']			= "Blood glucose";
				$data['g_Colorb']			= "Color Blindness";
				$data['g_Urineg']			= "Urine Glucose";
				$data['g_Fundus']			= "Fundus";
				$data['g_Fructosamine']		= "Fructosamine";
				$data['g_Hearing']			= "Hearing";
				$data['g_Tumorm']			= "Tumor marker";
				$data['g_Bloodp']			= "Blood Pressure";
				$data['g_Chestx']			= "Chest X-ray";
				$data['g_LungF']			= "Lung Function";
				$data['g_XShadow']			= "X-ray Shadow";
				$data['g_UrineA']			= "Urine Analysis";
				$data['g_Sputum']			= "Sputum";
				$data['g_UrineS']			= "Urine Sediment";
				$data['g_ECG']				= "ECG";
				$data['g_OB']				= "OB/parasite in stool";
				$data['g_Treadmill']		= "Treadmill";
				$data['g_Liverf']			= "Liver function";
				$data['g_Echocardiographi']	= "Echocardiographi";
				$data['g_Renal']			= "Renal";
				$data['g_USG']				= "USG";
				$data['g_Pancreas']			= "Pancreas";
				$data['g_USGP'] 			= "USG Prostate";
				$data['g_Urica']			= "Uric acid";
				$data['g_USGU']				= "USG Uterus";
				$data['g_Lipid']			= "Lipid";
				$data['g_USGM']				= "USG Mammae";
				$data['g_Electrolyte']		= "Electrolyte";
				$data['g_StomachX']			= "Stomach X-ray";
				$data['g_AnemiaTest']		= "Anemia Test";
				$data['g_PapSmear']			= "Pap Smear";
				$data['g_Hematology']		= "Hematology";
				$data['g_BreastE'] 			= "Breast Examination";
				$data['g_WBC']				= "WBC Classification";
				$data['g_ExtraOral']		= "Extra Oral";
				$data['g_Inflammation']		= "Inflammation";
				$data['g_PanoramicX']		= "Panoramic X-ray";
				$data['g_Syphilis']			= "Syphilis";
				$data['g_Intraoral']		= "Intra oral";
				$data['g_SerologyH']		= "Serology Hepatitis";
				$data['g_DentalHygiene']	= "Dental Hygiene";
				$data['g_Others']			= "Others";
				$data['g_Comments']			= "Comments";
				$data['g_GradeofResult']	= "Grade of Result";
				$data['g_NoProblem']		= "No Problem";
				$data['g_gorb']				= "A little problem, but not influence on daily life";
				$data['g_gorbf']			= "Same as B, but need to follow up";
				$data['g_gorc']				= "Need care on daily life";
				$data['g_gord']				= "Need medical treatment";
				$data['g_gore']				= "Under treatment";
				$data['g_gorn']				= "Not tested";
				$data['g_gorg']				= "Need closed examination";
			} else { // ---------- Jepang -----------
				$data['g_gorg']				= "精密検査が必要です。( Need closed examination )";
				$data['g_gorn']				= "検査をしていません。( Not tested )";
				$data['g_gore']				= "治療中。（ Under treatment ）";
				$data['g_gord']				= "治療が必要です。( Need medical treatment )";
				$data['g_gorc']				= "日常生活に注意が必要です。( Need care on daily life )";
				$data['g_gorbf']			= "B.ですか、経過観察してください。( Same as B, but need to follow up )";
				$data['g_gorb']				= "わずかに異常を認めますが、日常生活にはさしつかえありません ( A little problem, but not influence on daily life )";
				$data['g_NoProblem']		= "異常ありません ( No Problem )";
				$data['g_GradeofResult']	= "＜判定区分＞ ( Grade of result )";
				$data['g_Comments']			= " * 所 見  ( Comments )";
				$data['g_Others']			= "そ の 他 (Others)";
				$data['g_DentalHygiene']	= "歯 科 衛 生  (Dental Hygiene)";
				$data['g_SerologyH']		= "肝 炎 ウ イ ル ス (Serology Hepatitis)";
				$data['g_Intraoral']		= "口 腔 衛 生 (Intra oral)";
				$data['g_Syphilis']			= "梅 毒 (Syphilis)";
				$data['g_PanoramicX']		= "パ ノ ラ マ (Panoramic X-ray)";
				$data['g_Inflammation']		= "炎 症 (Inflammation)";
				$data['g_ExtraOral']		= "顎 外 固 定 (Extra Oral)";
				$data['g_WBC']				= "白 血 球 分 類 (WBC Classification)";
				$data['g_BreastE'] 			= "乳 房 検 査 (Breast Examination)";
				$data['g_Hematology']		= "一般血液系 (Hematology) ";
				$data['g_PapSmear']			= "子宮細胞診検査 (Pap Smear)";
				$data['g_AnemiaTest']		= "貧 血 (Anemia Test)";
				$data['g_StomachX']			= "胃 部 X 線 (Stomach X-ray)";
				$data['g_Electrolyte']		= "電 解 質 (Electrolyte)";
				$data['g_USGM']				= "乳 房 診 (USG Mammae)";
				$data['g_Lipid']			= "脂 質 (Lipid)";
				$data['g_USGU']				= "子 宮 超 音 波 (USG Uterus)";
				$data['g_Urica']			= "尿 酸 (Uric acid)";
				$data['g_USGP'] 			= "前 立 腺 (USG Prostate)";
				$data['g_Pancreas']			= "膵 臓 (Pancreas)";
				$data['g_USG']				= "部 超 腹 音 波 検 査 (USG)";
				$data['g_Renal']			= "腎 臓 (Renal)";
				$data['g_Echocardiographi']	= "心 臓 エ コ ー (Echocardiographi)";
				$data['g_Liverf']			= "肝 臓 (Liver function)";
				$data['g_Treadmill']		= "負 荷 心 電 図 (Treadmill)";
				$data['g_OB']				= "便 潜 血 / 虫 卵 (OB/parasite in stool)";
				$data['g_ECG']				= "心 電 図 検 査 (ECG)";
				$data['g_UrineS']			= "尿 沈 渣 (Urine Sediment)";
				$data['g_Sputum']			= "喀 痰 検 査 (Sputum)";
				$data['g_UrineA']			= "尿 定 性 (Urine Analysis)";
				$data['g_XShadow']			= "心 影  (X-ray Shadow)";
				$data['g_LungF']			= "肺 機 能 (Lung Function)";
				$data['g_Chestx']			= "胸 部 X 線 (Chest X-ray)";
				$data['g_Bloodp']			= "血 圧 (Blood Pressure)";
				$data['g_Tumorm']			= "腫 瘍 マ ー カ ー (Tumor marker)";
				$data['g_Hearing']			= "力 (Hearing)";
				$data['g_Fructosamine']		= "フルクトサミン (Fructosamine)";
				$data['g_Fundus']			= "眼 底 (Fundus)";
				$data['g_Urineg']			= "血 糖 / 血 糖 尿 (Glucose/urine glucose)";
				$data['g_Colorb']			= "色 覚 (Color Blindness)";
				$data['g_Bloodg']			= "血糖値 (Blood glucose)";
				$data['g_Ocular']			= "眼 圧 (Ocular Tension)";
				$data['g_Eyes_Sight']		= "視 力 (Eyes Sight)";
				$data['g_dmh']				= "糖 尿 病(Diabetes Mellitus HbA1c)";
				$data['g_Immunology_test']	= "免 疫 (Immunology test)";
				$data['g_Obesities']		= "肥 満 度 (Obesities)";
				$data['konten'] 			= "検 査 項 目 (Contents)";
				$data['std'] 				= "基 準 値 Std.value";
				$data['dor']				= "実  施  日(Date of Result)";
				$data['n'] 					= "今  回 Now";
				$data['p'] 					= "前  回 Previous";
				$data['l'] 					= "前 々 回 Last";
				$data['u'] 					= "単 位 Unit";
				$data['h_now'] 				= "今 回 (Now) ";
				$data['h_Previous']			= "前  回 (Previous) ";
				$data['h_Last']				= " 前 々 回 (Last)";
				$data['h_dental'] 			= "歯 科 衛 生 (Dental Hygiene)";
				$data['h_Extra_Oral'] 		= "顎 外 固 定 (Extra Oral)";
				$data['h_panoramic'] 		= "パ ノ ラ マ (Panoramic X-ray)";
				$data['h_intra'] 			= "口 腔 衛 生 (Intra oral)";
				$data['h_Impaction']		= "埋 状 (Impaction teeth)";
				$data['h_Broken']			= "破 損 (Broken)";
				$data['h_Cyst']				= "嚢 胞 /肉 芽 種 (Cyst/granuloma)";
				$data['h_Mobilization']		= "歯牙易動性 (Mobilization of teeth)";
				$data['h_Calculus']			= "歯 石/歯 垢 (Calculus/Plaque)";
				$data['h_Caries']			= "虫 歯 (Caries)";
				$data['h_Filling']			= "充 填 (Filling)";
				$data['h_Missing']			= "欠 損 (Missing)";
				$data['h_grade']			= "判 定 (Grade)";
			}
			// ---------- batas untuk membedakan bahasa jepang dan english -------------



			foreach ($get_pat_data->result() as $row) {
				$birth 	= $row->pat_dob;
				$gender = $row->pat_gender;
				//echo $birth ;
				//Function Convertion Age to Months
				$birthday = new DateTime($birth);
				$diff = $birthday->diff(new DateTime());
				$age = $diff->format('%m') + 12 * $diff->format('%y');
				//echo $months;
				//End of Function

			}

			// Hapus semua data pada table temp
			// $this->m_patient->hapus_tmp_print_mcu_h2($id_pat);
			// $this->m_patient->hapus_tmp_print_mcu_d2($id_pat);

			// Insert data temporary header
			$jack				= $this->m_patient->get_patient_3($id_pat, $reg_date);
			// $jack				= $this->m_patient->get_patient_3_new($id_pat,$id_regist,$reg_date);
			$data['jml_jack']	= $jack->num_rows();
			$nomor 					= 0;
			foreach ($jack->result() as $value) {
				$tgl_reg[] 			= $value->reg_date;
				$id_client_job[] 	= $value->id_client_job;
				$idregjml[] 		= $value->id_reg;
				$cekdataprint		= $this->m_patient->get_temp_print_mcu_h2($value->id_reg);
				$jmlcekdataprint	= $cekdataprint->num_rows();
				if (empty($jmlcekdataprint)) {
					$data_insert_h	= array(
						'id_pat'		=> $id_pat,
						'id_reg'		=> $value->id_reg,
						'reg_date'		=> $value->reg_date,
						'id_package'	=> $value->id_package,
						'created_by'	=> $userid,
						'created_date'	=> $now,
						'updated_by'	=> $userid,
						'updated_date'	=> $now,
						'seq_print'		=> $jumlah_print,
					);
					$this->m_patient->insert_temp_print_mcu_h($data_insert_h);

					$reg_id[] 		= $value->id_reg;
					$package_id[] 	= $value->id_package;
				} else {
					$data_insert_h	= array(
						'seq_print'		=> $jumlah_print,
						'updated_by'	=> $userid,
						'updated_date'	=> $now,
					);
					$this->m_patient->update_temp_print_mcu_h($data_insert_h, $value->id_reg);
				}

				$data['package' . $nomor] 		= $this->m_patient->get_list_package($value->id_reg, $value->id_package);
				$data['all_data_grade' . $nomor] 	= $this->m_patient->get_data_grade_result($value->id_reg);
				$nomor++;
			}

			$data['arr_reg_id']			= count($reg_id);
			$arr_reg_id 				= count($reg_id);

			// echo $arr_reg_id;exit();
			// echo "<pre>";print_r($reg_id);echo "</pre>";
			// echo "<pre>";print_r($id_client_job);echo "</pre>";exit();

			// UNTUK MENDAPATKAN JOB POSITION DISINI...
			for ($i = 0; $i < $arr_reg_id; $i++) {
				if (is_int($id_client_job[$i]) == true) {
					if ($id_client_job[$i] == 0) {
						$data['job'][] = "";
					} else {
						$postion = $this->m_patient->get_mst_client_job_id($id_client_job[$i]);
						foreach ($postion->result() as $isi) {
							$data['job'][] = $isi->client_job_desc;
						}
					}
				} else {
					$data['job'][] = $id_client_job[$i];
				}
			}
			// BATAS JOB POSITION DISINI...



			if (isset($tgl_reg[0])) {
				$data['reg_date_now'] 		= $tgl_reg[0];
			}

			if (isset($tgl_reg[1])) {
				$data['reg_date_previous'] = date("d-m-Y", strtotime($tgl_reg[1]));
			} else {
				$data['reg_date_previous'] 	= "";
			}

			if (isset($tgl_reg[2])) {
				$data['reg_date_last'] 	= date("d-m-Y", strtotime($tgl_reg[2]));
			} else {
				$data['reg_date_last'] 		= "";
			}


			$y 						= 1;

			for ($x = 0; $x < $arr_reg_id; $x++) {

				$detailmcu					= $this->m_patient->get_data_mcu3($reg_id[$x], $package_id[$x], $age, $gender);
				// $detaillab 					= $this->m_patient->get_data_detail_lab_hasil_mcu($reg_id[$x]);
				$detaillab 					= $this->m_patient->get_data_detail_lab($reg_id[$x], $package_id[$x]);
				$detailrad 					= $this->m_patient->print_detailrad_order2($reg_id[$x], $package_id[$x]);
				// $otherdata					= $this->m_patient->print_detailother_order_2($reg_id[$x]);
				$jml_detailmcu				= $detailmcu->num_rows();
				$jml_detaillab				= $detaillab->num_rows();
				$jml_detailrad				= $detailrad->num_rows();

				// $get_comment				= $this->m_patient->get_comment_mcu($id_regist,$y);

				// $arr_idgroupservice 	= array();
				// $arr_unumber 			= array();
				// $arr_nama_comment		= array();
				// $arr_coment 			= array();

				// foreach ($get_comment->result() as $row) {
				// 	$id_mcu_result			= $row->id_mcu_result;
				// 	$id_reg					= $row->id_reg;
				// 	$arr_idgroupservice[]	= $row->id_group_service;
				// 	$arr_unumber[]			= $row->unumber;
				// 	$arr_nama_comment[]		= $row->nama_comment;
				// 	$comment				= $row->comment;
				// 	$arr_coment[] 			= $row->comment;
				// 	$created_date			= $row->created_date;
				// 	$created_by				= $row->created_by;
				// }


				if ($x == 0) {

					foreach ($detailmcu->result() as $value) {

						if ($bahasa == 0) {
							$group_header 	= $value->group_header;
							$content_d 		= $value->nama_value;
						} else {
							$group_header 	= $value->group_header_jp;
							$content_d 		= $value->nama_value_j;
						}

						// $stdvaluez = " -mcu- ";
						$stdvaluez = $value->limit_1 . " - " . $value->limit_2;

						$data_insert_d	= array(
							'id_pat'		=> $value->id_pat,
							'id_reg'		=> $value->id_reg,
							'reg_date'		=> $value->reg_date,
							'content_h'		=> $group_header,
							'id_service'	=> $value->id_service,
							'id_item_value'	=> $value->id_item_value,
							'stdvalue'		=> $stdvaluez,
							'content_d'		=> $content_d,
							'now'			=> $value->result,
							'unit'			=> $value->Unit,
							'id_serv_group'	=> $value->id_group_serv,
							'id_package'	=> $value->id_quot,
							'name_package'	=> $value->quot_name,
							'seq_no'		=> $value->seq_no,
							'is_normal_now'	=> $value->flags,
						);
						$this->m_patient->insert_temp_print_mcu_d($data_insert_d);

						$arr_id_item_value[] = $value->id_item_value;
					}

					foreach ($detaillab->result() as $v_lab) {

						if ($bahasa == 0) {
							$content_h = $v_lab->group_name;
							// $content_d = $v_lab->nama_range;
							$content_d = $v_lab->name_type;
							if ($content_d == "") {
								$content_d = $v_lab->lab_item_abbr;
							}
						} else {
							$content_h = $v_lab->group_name_j;
							$content_d = $v_lab->lab_item_name_j;
							// $content_d = $v_lab->namajp_range;
							// if ($content_d == "") {$content_d = $v_lab->lab_item_name_j;}
						}

						// $stdvaluelab = "lab";
						$stdvaluelab = $v_lab->std_value;
						if ($content_h == "") {
							$content_h = $content_d;
						}

						$data_insert_d			= array(
							'id_pat'				=> $id_pat,
							'id_reg'				=> $v_lab->id_reg,
							'reg_date'				=> $v_lab->reg_date,
							'content_h'				=> $content_h,
							'id_service'			=> $v_lab->id_service,
							'id_item_value'			=> $v_lab->id_lab_item,
							'stdvalue'				=> $stdvaluelab,
							'is_normal_now'			=> $v_lab->is_normal,
							'content_d'				=> $content_d,
							'now'					=> $v_lab->result_value,
							'unit'					=> '-',
							'id_serv_group'			=> $v_lab->id_group_serv,
							'group_header_print'	=> $v_lab->lab_item_group,
							'id_package'			=> $v_lab->id_quot,
							'name_package'			=> $v_lab->quot_name,
						);
						$this->m_patient->insert_temp_print_mcu_d($data_insert_d);

						$arr_id_lab[] = $v_lab->id_service;
					}

					foreach ($detailrad->result() as $v_rad) {

						// $stdvaluerad 		= "rad";
						// $content_d 			= $v_rad->rad_item;
						// $id_serv_group 		= $v_rad->rad_item_group;
						$stdvaluerad 		= "-";
						$content_d 			= $v_rad->nama_value;
						$id_serv_group 		= $v_rad->id_group_serv;

						$data_insert_d			= array(
							'id_pat'				=> $id_pat,
							'id_reg'				=> $v_rad->id_reg,
							'reg_date'				=> $v_rad->reg_date,
							'content_h'				=> $v_rad->group_desc,
							'id_service'			=> $v_rad->id_service,
							'id_item_value'			=> $v_rad->id_rad_item,
							'stdvalue'				=> $stdvaluerad,
							'content_d'				=> $content_d,
							'now'					=> $v_rad->result,
							'unit'					=> '-',
							'id_serv_group'			=> $id_serv_group,
							'group_header_print'	=> $v_rad->rad_item_group,
							'id_package'			=> $v_rad->id_quot,
							'name_package'			=> $v_rad->quot_name,
						);
						$this->m_patient->insert_temp_print_mcu_d($data_insert_d);

						$arr_id_rad[] = $v_rad->id_rad_item;
					}

					// foreach ($otherdata->result() as $v_other) {
					// 	$data_insert_d	= array(
					// 	'id_pat'		=> $id_pat,
					// 	'id_reg'		=> $v_other->id_reg,
					// 	'reg_date'		=> $v_other->reg_date,
					// 	'content_h'		=> $v_other->group_desc,
					// 	'id_item_value'	=> $v_other->id_service,
					// 	'stdvalue'		=> '-',
					// 	'content_d'		=> $v_other->serv_name,
					// 	'now'			=> 0,
					// 	'unit'			=> '-',
					// 	'id_serv_group'	=> $v_other->order_type,
					// 	);
					// 	$this->m_patient->insert_temp_print_mcu_d($data_insert_d);

					// 	$arr_id_service[] = $v_other->id_service;
					// }

				}


				if ($x == 1) {
					foreach ($detailmcu->result() as $value) {
						if (in_array($value->id_item_value, $arr_id_item_value)) {
							$data_update			= array(
								'previous'				=> $value->result,
								'is_normal_previous'	=> $value->flags,
							);
							$this->m_patient->update_temp_print_mcu_d($data_update, $value->id_item_value);
						} else {
							$stdvaluez = $value->limit_1 . " - " . $value->limit_2;

							$data_insert_d			= array(
								'id_pat'				=> $value->id_pat,
								'id_reg'				=> $value->id_reg,
								'reg_date'				=> $value->reg_date,
								'content_h'				=> $group_header,
								'id_service'			=> $value->id_service,
								'id_item_value'			=> $value->id_item_value,
								'stdvalue'				=> $stdvaluez,
								'content_d'				=> $content_d,
								'now'					=> $value->result,
								'unit'					=> $value->Unit,
								'id_serv_group'			=> $value->id_group_serv,
								'id_package'			=> $value->id_quot,
								'name_package'			=> $value->quot_name,
								'is_normal_previous'	=> $value->flags,
							);
							$this->m_patient->insert_temp_print_mcu_d($data_insert_d);

							$arr_id_item_value[] = $value->id_item_value;
						}
					}

					foreach ($detaillab->result() as $value) {
						if (in_array($value->id_service, $arr_id_lab)) {
							$data_update	= array(
								'previous'		=> $value->result_value,
							);
							$this->m_patient->update_temp_print_mcu_d($data_update, $value->id_service);
						} else {


							if ($v_lab->name_type != "") {
								$content_d = $v_lab->name_type;
							} else {
								$content_d = $v_lab->lab_item_abbr;
							}

							$content_h = $v_lab->group_name;
							$stdvaluelab = $v_lab->std_value;
							if ($content_h != "") {
								$content_h = $content_d;
							}

							$data_insert_d			= array(
								'id_pat'				=> $id_pat,
								'id_reg'				=> $v_lab->id_reg,
								'reg_date'				=> $v_lab->reg_date,
								'content_h'				=> $content_h,
								'id_service'			=> $v_lab->id_service,
								'id_item_value'			=> $v_lab->id_lab_item,
								'stdvalue'				=> $stdvaluelab,
								'is_normal_previous'	=> $v_lab->is_normal,
								'content_d'				=> $content_d,
								'now'					=> $v_lab->result_value,
								'unit'					=> '-',
								'id_serv_group'			=> $v_lab->id_group_serv,
								'group_header_print'	=> $v_lab->lab_item_group,
								'id_package'			=> $v_lab->id_quot,
								'name_package'			=> $v_lab->quot_name,
							);
							$this->m_patient->insert_temp_print_mcu_d($data_insert_d);
						}
					}

					foreach ($detailrad->result() as $v_rad) {
						if (in_array($v_rad->id_rad_item, $arr_id_rad)) {
							$data_update	= array(
								'previous'		=> $v_rad->result,
							);
							$this->m_patient->update_temp_print_mcu_d($data_update, $value->id_lab_range);
						} else {

							$stdvaluerad 		= "-";
							$content_d 			= $v_rad->nama_value;
							$id_serv_group 		= $v_rad->id_group_serv;

							$data_insert_d			= array(
								'id_pat'				=> $id_pat,
								'id_reg'				=> $v_rad->id_reg,
								'reg_date'				=> $v_rad->reg_date,
								'content_h'				=> $v_rad->group_desc,
								'id_service'			=> $v_rad->id_service,
								'id_item_value'			=> $v_rad->id_rad_item,
								'stdvalue'				=> $stdvaluerad,
								'content_d'				=> $content_d,
								'now'					=> $v_rad->result,
								'unit'					=> '-',
								'id_serv_group'			=> $id_serv_group,
								'group_header_print'	=> $v_rad->rad_item_group,
								'id_package'			=> $v_rad->id_quot,
								'name_package'			=> $v_rad->quot_name,
							);
							$this->m_patient->insert_temp_print_mcu_d($data_insert_d);
						}
					}
				}

				if ($x == 2) {
					foreach ($detailmcu->result() as $value) {
						if (in_array($value->id_item_value, $arr_id_item_value)) {
							$data_update			= array(
								'last'					=> $value->result,
								'is_normal_last'		=> $value->flags,
							);
							$this->m_patient->update_temp_print_mcu_d($data_update, $value->id_item_value);
						} else {
							$stdvaluez = $value->limit_1 . " - " . $value->limit_2;

							$data_insert_d			= array(
								'id_pat'				=> $value->id_pat,
								'id_reg'				=> $value->id_reg,
								'reg_date'				=> $value->reg_date,
								'content_h'				=> $group_header,
								'id_service'			=> $value->id_service,
								'id_item_value'			=> $value->id_item_value,
								'stdvalue'				=> $stdvaluez,
								'content_d'				=> $content_d,
								'now'					=> $value->result,
								'unit'					=> $value->Unit,
								'id_serv_group'			=> $value->id_group_serv,
								'id_package'			=> $value->id_quot,
								'name_package'			=> $value->quot_name,
								'is_normal_last'		=> $value->flags,
							);
							$this->m_patient->insert_temp_print_mcu_d($data_insert_d);
						}
					}


					foreach ($detaillab->result() as $value) {
						if (in_array($value->id_service, $arr_id_lab)) {
							$data_update	= array(
								'last'			=> $value->result_value,
							);
							$this->m_patient->update_temp_print_mcu_d($data_update, $value->id_service);
						} else {

							if ($v_lab->name_type != "") {
								$content_d = $v_lab->name_type;
							} else {
								$content_d = $v_lab->lab_item_abbr;
							}

							$content_h = $v_lab->group_name;
							$stdvaluelab = $v_lab->std_value;
							if ($content_h != "") {
								$content_h = $content_d;
							}

							$data_insert_d			= array(
								'id_pat'				=> $id_pat,
								'id_reg'				=> $v_lab->id_reg,
								'reg_date'				=> $v_lab->reg_date,
								'content_h'				=> $content_h,
								'id_service'			=> $v_lab->id_service,
								'id_item_value'			=> $v_lab->id_lab_item,
								'stdvalue'				=> $stdvaluelab,
								'is_normal_last'		=> $v_lab->is_normal,
								'content_d'				=> $content_d,
								'now'					=> $v_lab->result_value,
								'unit'					=> '-',
								'id_serv_group'			=> $v_lab->id_group_serv,
								'group_header_print'	=> $v_lab->lab_item_group,
								'id_package'			=> $v_lab->id_quot,
								'name_package'			=> $v_lab->quot_name,
							);
							$this->m_patient->insert_temp_print_mcu_d($data_insert_d);
						}
					}

					foreach ($detailrad->result() as $v_rad) {
						if (in_array($v_rad->id_rad_item, $arr_id_rad)) {
							$data_update	= array(
								'previous'		=> $v_rad->result,
							);
							$this->m_patient->update_temp_print_mcu_d($data_update, $value->id_lab_range);
						} else {

							$stdvaluerad 		= "-";
							$content_d 			= $v_rad->nama_value;
							$id_serv_group 		= $v_rad->id_group_serv;

							$data_insert_d			= array(
								'id_pat'				=> $id_pat,
								'id_reg'				=> $v_rad->id_reg,
								'reg_date'				=> $v_rad->reg_date,
								'content_h'				=> $v_rad->group_desc,
								'id_service'			=> $v_rad->id_service,
								'id_item_value'			=> $v_rad->id_rad_item,
								'stdvalue'				=> $stdvaluerad,
								'content_d'				=> $content_d,
								'now'					=> $v_rad->result,
								'unit'					=> '-',
								'id_serv_group'			=> $id_serv_group,
								'group_header_print'	=> $v_rad->rad_item_group,
								'id_package'			=> $v_rad->id_quot,
								'name_package'			=> $v_rad->quot_name,
							);
							$this->m_patient->insert_temp_print_mcu_d($data_insert_d);
						}
					}
				}

				$y = $y + 1;
			} // Tutup Looping

			$this->m_patient->update_blood_pressure(); // update header blood_pressure
			$this->m_patient->update_temp_print_mcu_d2(); // update...

			$data['list_comment']		= $this->m_patient->get_data_mcu_result3($id_regist);
			$nama_package 				= $this->m_patient->get_package_name($id_pat);
			$data['data_h'] 			= $this->m_patient->get_temp_print_mcu_h($id_pat);
			$data['data_fisik']			= $this->m_patient->get_temp_print_mcu_d_fisik($id_pat);
			$data['data_lab']			= $this->m_patient->get_temp_print_mcu_d($id_pat, 1);
			$data['data_rad']			= $this->m_patient->get_temp_print_mcu_d($id_pat, array(2, 10, 11));
			$data['data_usg']			= $this->m_patient->get_temp_print_mcu_d($id_pat, 6);
			$data['data_dental']		= $this->m_patient->get_temp_print_mcu_d_dental($id_pat);

			$data['jml_fisik'] 			= $data['data_fisik']->num_rows();
			$data['jml_lab'] 			= $data['data_lab']->num_rows();
			$data['jml_rad'] 			= $data['data_rad']->num_rows();
			$data['jml_dental'] 		= $data['data_dental']->num_rows();
			$data['jml_usg'] 			= $data['data_usg']->num_rows();

			$data['data'] 				= $this->m_patient->get_print_mark($id);
			$data['grade'] 				= $this->m_patient->get_patient_grade($id);
			$data['reg_all'] 			= $this->m_patient->get_trx_registration_all($id_pat);
			$data['reg'] 				= $this->m_patient->get_trx_registration($id_pat, $id);
			$data['get_data_lock'] 		= $this->m_patient->get_data_lock($id_regist);

			$data['find'] 				= $this->m_patient->get_mark_mcu2($id);
			// $data['rad'] 				= $this->m_patient->get_mark_mcu_rad($id_pat,$id,'','');
			$data['rads']				= $this->m_patient->get_mark_mcu_rad_stomach($id_pat, $id, '', '');
			$data['radp']				= $this->m_patient->get_mark_mcu_rad_papsmear($id);
			$data['radb']				= $this->m_patient->get_mark_mcu_rad_breast($id);
			$data['jud'] 				= $this->m_patient->get_mst_judgment_grade($id_pat, $id, '', '');
			$data['lab'] 				= $this->m_patient->get_mark_mcu_lab($id_pat, $id, '', '');

			// $data['raddental']		= $this->m_patient->get_mark_mcu_rad_dental($id_pat,$id,'','');

			// ---------------------------MENDAPAT KAN DATA Dental------------------------------------------

			if ($data['jml_dental'] > 0) { // masukan data dental ke array ...
				// --- data array ---
				$data['arr_content_h']	= array();
				$data['arr_content_d']	= array();
				$data['arr_stdvalue']	= array();
				$data['arr_now']		= array();
				$data['arr_previous']	= array();
				$data['arr_last']		= array();
				$data['arr_unit']		= array();
				// --- batas data array ---

				foreach ($data['data_dental']->result() as $row) {
					$data['arr_content_h'][] 	= $row->content_h;
					$data['arr_content_d'][] 	= $row->content_d;
					$data['arr_stdvalue'][] 	= $row->stdvalue;
					$data['arr_now'][] 			= $row->now;
					$data['arr_previous'][] 	= $row->previous;
					$data['arr_last'][] 		= $row->last;
					$data['arr_unit'][] 		= $row->unit;
				}
			} // batas data dental ke array ...

			// ---------------------------BATAS DATA Dental------------------------------------------
			// ---------------------------MENDAPATKAN DATA USG------------------------------------------
			if ($data['jml_usg'] > 0) {

				$data['content_h_usg'] 				= array();
				$data['content_d_usg'] 				= array();
				$data['now_usg'] 					= array();
				$data['previous_usg'] 				= array();
				$data['last_usg'] 					= array();
				$data['unit_usg'] 					= array();
				$data['stdvalue_fisik_usg']			= array();

				foreach ($data['data_usg']->result() as $row_isis) {
					$data['content_h_usg'][]		= $row_isis->content_h;
					$data['content_d_usg'][]		= $row_isis->content_d;
					$data['stdvalue_fisik_usg'][]	= $row_isis->stdvalue;
					$data['now_usg'][]				= $row_isis->now;
					$data['previous_usg'][]			= $row_isis->previous;
					$data['last_usg'][]				= $row_isis->last;
					$data['unit_usg'][]				= $row_isis->unit;
				}

				$data['arr_jml_usg']				= count($data['content_h_usg']);
				// echo $data['arr_jml_usg'];echo "<br>";
				// echo "<pre>";print_r($data['content_d_usg']);echo "</pre>";
				// exit();
			}
			// ---------------------------BATAS DATA USG------------------------------------------

			$this->load->view('menu/print_mcu_result_act_new', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi load print mark sheet
	function print_result_act_old()
	{
		if ($this->session->userdata('logged_in')) {
			//$id = $this->uri->segment(3);
			$this->load->model('m_patient');
			$id						= $this->input->post('id_reg');
			$id_pat					= $this->input->post('id_pat');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['data'] 			= $this->m_patient->get_print_mark($id);
			$data['grade'] 			= $this->m_patient->get_patient_grade($id);
			$data['reg_all'] 			= $this->m_patient->get_trx_registration_all($id_pat);
			$data['reg'] 				= $this->m_patient->get_trx_registration($id_pat, $id);
			// di array untuk mendapatkan nomer 3 registrasi
			$noreg = array();
			foreach ($data['reg']->result() as $row_head) {
				$noreg[] = $row_head->id_reg;
			}
			//echo $noreg[2].'<br/>';

			$data['find'] 			= $this->m_patient->get_mark_mcu2($id);
			$data['rad'] 				= $this->m_patient->get_mark_mcu_rad($id_pat, $id, '', '');
			$data['rads']				= $this->m_patient->get_mark_mcu_rad_stomach($id_pat, $id, '', '');
			$data['radp']				= $this->m_patient->get_mark_mcu_rad_papsmear($id);
			$data['radb']				= $this->m_patient->get_mark_mcu_rad_breast($id);
			$data['raddental']		= $this->m_patient->get_mark_mcu_rad_dental($id_pat, $id, '', '');
			$data['jud'] 				= $this->m_patient->get_mst_judgment_grade($id_pat, $id, '', '');
			$data['lab'] 				= $this->m_patient->get_mark_mcu_lab($id_pat, $id, '', '');

			if (isset($noreg[1])) { // data untuk previous
				$data['find1'] 			= $this->m_patient->get_mark_mcu2($noreg[1]);
				$data['rad'] 				= $this->m_patient->get_mark_mcu_rad($id_pat, $id, $noreg[1], '');
				$data['jud'] 				= $this->m_patient->get_mst_judgment_grade($id_pat, $id, $noreg[1], '');
				$data['lab'] 				= $this->m_patient->get_mark_mcu_lab($id_pat, $id, $noreg[1], '');
				$data['raddental'] 		= $this->m_patient->get_mark_mcu_rad_dental($id_pat, $id, $noreg[1], '');
				$data['radp1']			= $this->m_patient->get_mark_mcu_rad_papsmear($noreg[1]);
				$data['radb']				= $this->m_patient->get_mark_mcu_rad_breast($noreg[1]);

				//echo "1";
			}
			if (isset($noreg[2])) { // data untuk last
				$data['find2'] 			= $this->m_patient->get_mark_mcu2($noreg[2]);
				$data['rad'] 				= $this->m_patient->get_mark_mcu_rad($id_pat, $id, $noreg[1], $noreg[2]);
				$data['jud'] 				= $this->m_patient->get_mst_judgment_grade($id_pat, $id, $noreg[1], $noreg[2]);
				$data['lab'] 				= $this->m_patient->get_mark_mcu_lab($id_pat, $id, $noreg[1], $noreg[2]);
				$data['raddental'] 		= $this->m_patient->get_mark_mcu_rad_dental($id_pat, $id, $noreg[1], $noreg[2]);
				$data['radp2']			= $this->m_patient->get_mark_mcu_rad_papsmear($noreg[2]);
				$data['radb']				= $this->m_patient->get_mark_mcu_rad_breast($noreg[2]);

				//echo "2";
			}
			$this->load->view('menu/print_mcu_result_act', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi load print pdf
	function print_result_pdf()
	{
		if ($this->session->userdata('logged_in')) {
			//$id = $this->uri->segment(3);
			$this->load->model('m_patient');
			$id						= $this->input->post('id_reg');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['data'] 			= $this->m_patient->get_print_mark($id);
			$data['find'] 			= $this->m_patient->get_mark_mcu($id);
			$this->load->view('menu/print_mcu_result', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	function update_group()
	{
		$id  = $this->uri->segment(3);
		$idx = str_replace('%20', ' ', $this->uri->segment(4));
		$idy = str_replace('%20', ' ', $this->uri->segment(5));
		// $idy = $this->uri->segment(5);
		$this->load->model('m_patient');
		$session_data 			= $this->session->userdata('logged_in');
		$user						= $session_data['id'];
		$data 						= array(
			'group_header_print' 		=> $id,
		);
		$data['data'] 			= $this->m_patient->update_grup($idx, $idy, $data);
	}
	//fungsi load print mark sheet
	function update_mark()
	{
		$id = $this->uri->segment(3);
		$this->load->model('m_patient');
		$session_data 			= $this->session->userdata('logged_in');
		$user						= $session_data['id'];
		$data 						= array(
			'sign' 						=> $user,
			'iscomplete' 				=> 1,
		);
		$data['data'] 			= $this->m_patient->update_check($id, $data);
	}
	//fungsi load print mark sheet
	function update_mark_2()
	{
		$id = $this->uri->segment(3);
		$this->load->model('m_patient');
		$session_data 			= $this->session->userdata('logged_in');
		$user						= $session_data['id'];
		$data 						= array(
			'sign' 						=> $user,
			'iscomplete' 				=> 0,
		);
		$data['data'] 			= $this->m_patient->update_check($id, $data);
	}
	//Upload
	function uploadImage()
	{
		$config['upload_path']   =   "design/file/";
		$config['allowed_types'] =   "pdf|jpg|jpeg|png";
		$config['max_size']      =   "5000";
		$config['max_width']     =   "1907";
		$config['max_height']    =   "1280";
		$config['file_name'] 	= 	$this->input->post('id_reg');
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload()) {
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['loc'] 			= $session_data['location'];
			$this->template->set('title', 'Klinik | Upload Result');
			$this->template->load('template', 'menu/upload_failed', $data);
		} else {
			$finfo = $this->upload->data();
			$this->_createThumbnail($finfo['file_name']);
			$data['uploadInfo'] = $finfo;
			$data['thumbnail_name'] = $finfo['raw_name'] . '_thumb' . $finfo['file_ext'];
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$this->template->set('title', 'Klinik | Upload Result');
			$this->template->load('template', 'menu/upload_success', $data);
		}
	}
	//Create Thumbnail function
	function _createThumbnail($filename)
	{
		$config['image_library']    = "gd2";
		$config['source_image']     = "design/file/" . $filename;
		$config['create_thumb']     = TRUE;
		$config['maintain_ratio']   = TRUE;
		$config['width'] = "80";
		$config['height'] = "80";
		$this->load->library('image_lib', $config);
		if (!$this->image_lib->resize()) {
			//echo $this->image_lib->display_errors();
		}
	}
	//fungsi load form patient data
	function upload_img()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['loc'] 			= $session_data['location'];
			$this->template->set('title', 'Klinik | Patient Data');
			$this->template->load('template', 'menu/upload_view', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi load marking sheet
	function print_mcu()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['loc'] 			= $session_data['location'];
			$this->template->set('title', 'Klinik | Print Result MCU');
			$this->template->load('template', 'menu/print_result', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function del_print_mcu()
	{
		if ($this->session->userdata('logged_in')) {
			$id_reg	= $this->uri->segment(3);
			$this->load->model('m_patient');
			$this->m_patient->hapus_tmp_print_mcu_h($id_reg);
			$this->m_patient->hapus_tmp_print_mcu_d($id_reg);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi Print Label
	function print_label()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['loc'] 			= $session_data['location'];
			$this->template->set('title', 'Klinik | Print Label');
			$this->template->load('template', 'menu/print_label', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi load marking sheet
	function input_result()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['loc'] 			= $session_data['location'];
			$this->template->set('title', 'Klinik | Input Result');
			$this->template->load('template', 'menu/input_result', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function find_reg_patient()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_patient->get_patient_data_now();
			$this->template->set('title', 'Klinik | Find Patient Data');
			$this->template->load('template', 'menu/find_patient_data3', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi load comment final
	function find_comment_final()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['loc'] 			= $session_data['location'];
			$data['comment_doc']	= $this->m_patient->get_data_comment();
			$this->template->set('title', 'Klinik | Input Comment');
			$this->template->load('template', 'menu/find_comment_fin', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi load comment
	function find_comment()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['loc'] 			= $session_data['location'];
			$data['comment_doc']	= $this->m_patient->get_data_comment();
			$this->template->set('title', 'Klinik | Input Comment');
			$this->template->load('template', 'menu/find_comment', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi load comment LAB
	function find_comment_lab()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['loc'] 			= $session_data['location'];
			$data['comment_doc']	= $this->m_patient->get_data_comment();
			$this->template->set('title', 'Klinik | Input Comment');
			$this->template->load('template', 'menu/find_comment_lab', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi load marking sheet
	function input_result_act()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_patient');

			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$id_regist				= $this->input->post('id_reg');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['loc'] 			= $session_data['location'];

			$update_lock		= array(
				'lock_by'			=> $user_id,
				'locked'			=> 1,
			);
			$data['lock'] 			= $this->m_patient->lock_mcu($id_regist, $update_lock);


			$data_pack 			= array(
				'id_regist'			=> $this->input->post('id_reg'),
				'created_by'		=> $user_id,
			);

			$data_pack_2			= array(
				'id_registration'	=> $this->input->post('id_reg'),
				'periode'	 		=> date("Y-m"),
				'date'				=> date("Y-m-d"),
			);
			$data['all_data'] 	= $this->m_patient->get_data_mcu_result2($id_regist);
			$row_cnt 			= $data['all_data']->num_rows();
			if ($row_cnt == 0) {
				$this->m_patient->save_mcu_result($data_pack);
				$this->m_patient->save_mcu_result_2($data_pack_2);
			}

			$data['find'] 			= $this->m_patient->get_mark_mcu($id_regist);
			$data['comment_doc']	= $this->m_patient->get_data_comment();
			$data['grade'] 			= $this->m_patient->get_result_grade($id_regist);
			$data['find_left'] 		= $this->m_patient->get_mark_mcu($id_regist);
			$prince					= array();
			foreach ($data['find_left']->result() as $row) {
				$prince = $row->minions;
				$birth 	= $row->pat_dob;
				$gender = $row->pat_gender;
				//echo $birth ;
				//Function Convertion Age to Months
				$birthday = new DateTime($birth);
				$diff = $birthday->diff(new DateTime());
				$age = $diff->format('%m') + 12 * $diff->format('%y');
			}
			// $data['filemcu'] 		= $this->m_patient->get_data_mcu($id_regist,$prince,$age);
			$data['filemcu'] 		= $this->m_patient->get_data_mcu_6($id_regist, $prince, $age, $gender);
			$data['filemcu_labrad'] = $this->m_patient->get_data_mcu_labrad($id_regist, $prince);
			$data['data_lock'] 		= $this->m_patient->get_data_lock($id_regist);
			$data['komentar'] 		= $this->m_patient->get_mcu_comment($id_regist);
			$data['jml_komentar']	= $data['komentar']->num_rows();
			foreach ($data['data_lock']->result() as $row_lock) {
			}
			if ($user_id != $row_lock->lock_by && $row_lock->locked != 0) {
				echo "<script>alert('Has been locked !');</script>";
				redirect('patient/input_result', 'refresh');
				exit();
			}


			$datapack				= array(
				'lock_by'			=> $user_id,
				'locked'			=> 1,
			);
			$data['lock'] 			= $this->m_patient->lock_mcu($id_regist, $datapack);
			$data['data_lock'] 		= $this->m_patient->get_data_lock($id_regist);
			$data['all_note'] 		= $this->m_patient->get_data_mcu_patient_note($id_regist);

			$this->template->set('title', 'Klinik | Medical Check Up Result');
			$this->template->load('template', 'menu/input_result_act_new', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi Input MCU Result
	function save_mcu_result_new()
	{
		$this->load->model('m_patient');
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$rowC					= $this->input->post('rowC');
		$register_id			= $this->input->post('id_reg');
		$urutan					= $this->input->post('urutan');
		$keurutan				= $this->input->post('keurutan');
		$comment_atas			= $this->input->post('comment_atas');
		$comment_bawah			= $this->input->post('comment_bawah');
		$header_atas			= $this->input->post('header_atas');
		$header_bawah			= $this->input->post('header_bawah');
		$jml_atas 				= count($urutan);
		$jml_bawah				= count($keurutan);
		$isi_jml_a				= count($header_atas);
		$isi_jml_b				= count($header_bawah);
		$now					= date("Y-m-d H:i:s");

		//Cek data ke Table mst_judgment_grade
		$data['all_data_grade'] 		= $this->m_patient->get_data_grade_result($register_id);
		$row_cnta 						= $data['all_data_grade']->num_rows();
		$data['get_data_mcu_result2'] 	= $this->m_patient->get_data_mcu_result2($register_id);
		$count_data						= $data['get_data_mcu_result2']->num_rows();
		$list_mcu_comment 				= $this->m_patient->get_mcu_comment($register_id);
		$jml							= $list_mcu_comment->num_rows();

		// print_r($header_atas); echo "<br>";
		// print_r($comment_atas); echo "<br>";
		// echo $jml_atas; echo "<br>";
		// echo $isi_jml_a; echo "<br>";
		// print_r($comment_bawah); echo "<br>";
		// print_r($header_bawah); echo "<br>";
		// echo $jml_bawah; echo "<br>";
		// echo $register_id; echo "<br>";
		// exit();

		// Update dan insert ke table pat_mcu_result	
		if ($count_data != 0) {
			$data_update					= array(
				'fitness'					=> $this->input->post('fitness'),
				'fitness_comment'			=> $this->input->post('comment_final'),
				'suggestion'				=> $this->input->post('suggestion'),
				'updated_date'				=> $now,
				'updated_by'				=> $user_id,
			);
			$this->m_patient->update_mcu_result($data_update, $register_id);
		} else {
			$data_update					= array(
				'id_regist'					=> $this->input->post('id_reg'),
				'fitness'					=> $this->input->post('fitness'),
				'fitness_comment'			=> $this->input->post('comment_final'),
				'suggestion'				=> $this->input->post('suggestion'),
				'created_date'				=> $now,
				'created_by'				=> $user_id,
				'locked'					=> 1,
				'lock_by'					=> $user_id,
			);
			$this->m_patient->save_mcu_result($data_update, $register_id);
		}

		// Update dan insert ke table pat_mcu_result_comment
		$getdatamcu 	= $this->m_patient->get_data_mcu_result2($register_id);

		foreach ($getdatamcu->result() as $value) {
			$id_mcu_result 				= $value->id_mcu_result;
			$id_regist 					= $value->id_regist;
			$fitness 					= $value->fitness;
			$fitness_comment			= $value->fitness_comment;
		}

		if ($jml > 0) { // Jika ada data maka masuk ke dalam...
			for ($i = 0; $i < $jml_atas; $i++) { // Looping untuk hapus data

				if ($comment_atas[$i] != "") {
					$this->m_patient->hapus_pat_mcu_result_comment($register_id, $header_atas[$i]);
				}

				if ($comment_bawah[$i] != "") {
					$this->m_patient->hapus_pat_mcu_result_comment($register_id, $header_bawah[$i]);
				}
			}
		}

		for ($i = 0; $i < $jml_atas; $i++) { // Looping untuk insert comment atas....
			if ($comment_atas[$i] != "") {
				$koment_atas					= explode(":", $comment_atas[$i]);
				$data_update					= array(
					'id_mcu_result'				=> $id_mcu_result,
					'id_reg'					=> $register_id,
					'id_group_service'			=> $urutan[$i],
					'unumber'					=> $i,
					'nama_comment'				=> $header_atas[$i],
					'comment'					=> $koment_atas[1],
					// 'comment'				=>$comment_atas[$i],
					'created_date'				=> $now,
					'created_by'				=> $user_id,
				);
				$this->m_patient->save_mcu_comment($data_update, $register_id);
			}
		}

		for ($i = 0; $i < $jml_bawah; $i++) { // Looping untuk insert comment bawah....
			if ($comment_bawah[$i] != "") {
				$koment_bawah					= explode(":", $comment_bawah[$i]);
				$data_update					= array(
					'id_mcu_result'				=> $id_mcu_result,
					'id_reg'					=> $register_id,
					'id_group_service'			=> $keurutan[$i],
					'unumber'					=> $i,
					'nama_comment'				=> $header_bawah[$i],
					'comment'					=> $koment_bawah[1],
					// 'comment'					=>$comment_bawah[$i],
					'created_date'				=> $now,
					'created_by'				=> $user_id,
				);
				$this->m_patient->save_mcu_comment($data_update, $register_id);
			}
		}

		//Jika Datanya Ada Update ke table mst_judgment_grade	
		if ($row_cnta != 0) {
			$data_pack_2					= array(
				'id_registration'			=> $this->input->post('id_reg'),
				'periode'	 				=> date("Y-m"),
				'date'						=> date("Y-m-d"),
				'Obesitas'					=> $this->input->post('obesitas_grade'),
				'Eyes_Sight'				=> $this->input->post('eye_grade'),
				'Ocular_Tension'			=> $this->input->post('ocular_grade'),
				'Color_Blindness'			=> $this->input->post('cb_grade'),

				'Fundus'					=> $this->input->post('fundus_grade'),
				'Hearing'					=> $this->input->post('hear_grade'),
				'Blood_Pressure'			=> $this->input->post('bp_grade'),
				'Lung_Function'		 		=> $this->input->post('lung_grade'),
				'Urine_Analysis'		 	=> $this->input->post('urinea_grade'),
				'Diabetes_Mellitus'		 	=> $this->input->post('Diabetes_Mellitus'),
				'Urine_Sediment'			=> $this->input->post('urines_grade'),
				'OB'			 			=> $this->input->post('ob_grade'),
				'Liver_Function'			=> $this->input->post('liver_grade'),
				'Renal'				 		=> $this->input->post('renal_grade'),
				'Pancreas'		 			=> $this->input->post('pan_grade'),

				'Uric_Acid'					=> $this->input->post('uric_grade'),
				'Lipid'						=> $this->input->post('lipid_grade'),

				'Electrolyte'				=> $this->input->post('elec_grade'),
				'Hematology'				=> $this->input->post('hema_grade'),
				'WBC_Classification'		=> $this->input->post('wbc_grade'),
				'Inflammation'		 		=> $this->input->post('inflam_grade'),

				'Syphilis'					=> $this->input->post('syph_grade'),
				'Serology_Hepatitis'		=> $this->input->post('sero_grade'),
				'Immunology_Test'			=> $this->input->post('imm_grade'),
				'Diabetes_Mellitus'			=> $this->input->post('diabetes_grade'),
				'Urine_Glucose'		 		=> $this->input->post('urineg_grade'),

				'Tumor_Marker'				=> $this->input->post('tumor_grade'),
				'Chest_Xray' 				=> $this->input->post('chest_grade'),
				'Xray_Shadow'				=> $this->input->post('shadowxray_grade'),
				'Sputum'		 			=> $this->input->post('sputum_grade'),
				'ECG'			 	     	=> $this->input->post('ecg_grade'),
				'Treadmill'		 			=> $this->input->post('tread_grade'),
				'Echocardiographi'		 	=> $this->input->post('echoca_grade'),

				'USG'						=> $this->input->post('usg_grade'),
				'USG_Prostate' 				=> $this->input->post('usgp_grade'),
				'USG_Uterus'				=> $this->input->post('usgu_grade'),
				'USG_Mammae'		 		=> $this->input->post('usgm_grade'),
				'Stomach_Xray'			 	=> $this->input->post('stoxray_grade'),
				'Pap_Smear'		 			=> $this->input->post('pap_grade'),
				'Breast_Examination'		=> $this->input->post('breast_grade'),

				'Extra_Oral'				=> $this->input->post('exor_grade'),
				'Panoramic_Xray' 			=> $this->input->post('pano_grade'),
				'Intra_Oral'				=> $this->input->post('intr_grade'),
				'Dental_Hygine'		 		=> $this->input->post('dent_grade'),

				'Drug_Test'		 		=> $this->input->post('drug_grade'),

				'pulse_rate'	 			=> $this->input->post('masuk1'),
				'breathing'	 				=> $this->input->post('masuk2'),
				'vital_sign_bp'	 			=> $this->input->post('masuk3'),
				'temperatur'	 			=> $this->input->post('masuk4'),
				'anteriorc'		 			=> $this->input->post('masuk5'),
				'eyes_visual_exam' 			=> $this->input->post('masuk6'),
				'eyes_comment'	 			=> $this->input->post('masuk7'),
				'ear_right'		 			=> $this->input->post('masuk8'),
				'ear_left'		 			=> $this->input->post('masuk9'),
				'nose_septum'	 			=> $this->input->post('masuk10'),
				'nose_polyps'	 			=> $this->input->post('masuk11'),
				'nose_conchae'	 			=> $this->input->post('masuk12'),
				'nose_comment'	 			=> $this->input->post('masuk13'),
				'dental'		 			=> $this->input->post('masuk14'),
				'throat_pharynx' 			=> $this->input->post('masuk15'),
				'throat_tonsil'				=> $this->input->post('masuk16'),
				'throat_comment'			=> $this->input->post('masuk17'),
				'neck_thyroid'				=> $this->input->post('masuk18'),
				'neck_lymph'	 			=> $this->input->post('masuk19'),
				'neck_comment'	 			=> $this->input->post('masuk20'),
				'cardiac_jvp'	 			=> $this->input->post('masuk21'),
				'cardiac_heartsound'	 	=> $this->input->post('masuk22'),
				'cardiac_comment'	 		=> $this->input->post('masuk23'),
				'breast_glands'	 			=> $this->input->post('masuk24'),
				'breast_glands_comment'		=> $this->input->post('masuk25'),
				'respiratory'	 			=> $this->input->post('masuk26'),
				'respiratory_comment'		=> $this->input->post('masuk27'),
				'abdomen_general' 			=> $this->input->post('masuk28'),
				'abdomen_liver'	 			=> $this->input->post('masuk29'),
				'abdomen_spleen'	 		=> $this->input->post('masuk30'),
				'abdomen_kidney'			=> $this->input->post('masuk31'),
				'abdomen_rectal' 			=> $this->input->post('masuk32'),
				'abdomen_comment'			=> $this->input->post('masuk33'),
				'spine'			 			=> $this->input->post('masuk34'),
				'skin'			 			=> $this->input->post('masuk35'),
				'Musculoskeletal'	 		=> $this->input->post('masuk36'),
				'genitourinary_hernia'		=> $this->input->post('masuk37'),
				'genitourinary_inguinal'	=> $this->input->post('masuk38'),
				'genitourinary_hemorrhoid'	=> $this->input->post('masuk39'),
				'genitourinary_comment'		=> $this->input->post('masuk40'),
				'neurological_motor'		=> $this->input->post('masuk41'),
				'neurological_sensory'		=> $this->input->post('masuk42'),
				'neurological_reflexes'		=> $this->input->post('masuk43'),
				'neurological_other'		=> $this->input->post('masuk44'),
				'neurological_comment'	 	=> $this->input->post('masuk45'),
				'fungsi_luhur'	 			=> $this->input->post('masuk46'),
				'physician'	 				=> $this->input->post('masuk47'),
			);
			//Update data Grading ke table mst_judgment_grade
			$this->m_patient->update_mcu_result_2($data_pack_2, $register_id);
			//Jika Datanya belum ada Insert ke table mst_judgment_grade
		} else {
			$data_pack_2					= array(
				'id_registration'			=> $this->input->post('id_reg'),
				'periode'	 				=> date("Y-m"),
				'date'						=> date("Y-m-d"),
				'Obesitas'					=> $this->input->post('obesitas_grade'),
				'Eyes_Sight'				=> $this->input->post('eye_grade'),
				'Ocular_Tension'			=> $this->input->post('ocular_grade'),
				'Color_Blindness'			=> $this->input->post('cb_grade'),
				'Fundus'					=> $this->input->post('fundus_grade'),
				'Hearing'					=> $this->input->post('hear_grade'),
				'Blood_Pressure'			=> $this->input->post('bp_grade'),
				'Lung_Function'		 		=> $this->input->post('lung_grade'),
				'Urine_Analysis'		 	=> $this->input->post('urinea_grade'),
				'Diabetes_Mellitus'		 	=> $this->input->post('Diabetes_Mellitus'),
				'Urine_Sediment'			=> $this->input->post('urines_grade'),
				'OB'			 			=> $this->input->post('ob_grade'),
				'Liver_Function'			=> $this->input->post('liver_grade'),
				'Renal'				 		=> $this->input->post('renal_grade'),
				'Pancreas'		 			=> $this->input->post('pan_grade'),
				'Uric_Acid'					=> $this->input->post('uric_grade'),
				'Lipid'						=> $this->input->post('lipid_grade'),
				'Electrolyte'				=> $this->input->post('elec_grade'),
				'Hematology'				=> $this->input->post('hema_grade'),
				'WBC_Classification'		=> $this->input->post('wbc_grade'),
				'Inflammation'		 		=> $this->input->post('inflam_grade'),
				'Syphilis'					=> $this->input->post('syph_grade'),
				'Serology_Hepatitis'		=> $this->input->post('sero_grade'),
				'Immunology_Test'			=> $this->input->post('imm_grade'),
				'Diabetes_Mellitus'			=> $this->input->post('diabetes_grade'),
				'Urine_Glucose'		 		=> $this->input->post('urineg_grade'),
				'Tumor_Marker'				=> $this->input->post('tumor_grade'),
				'Chest_Xray' 				=> $this->input->post('chest_grade'),
				'Xray_Shadow'				=> $this->input->post('shadowxray_grade'),
				'Sputum'		 			=> $this->input->post('sputum_grade'),
				'ECG'			 	     	=> $this->input->post('ecg_grade'),
				'Treadmill'		 			=> $this->input->post('tread_grade'),
				'Echocardiographi'		 	=> $this->input->post('echoca_grade'),
				'USG'						=> $this->input->post('usg_grade'),
				'USG_Prostate' 				=> $this->input->post('usgp_grade'),
				'USG_Uterus'				=> $this->input->post('usgu_grade'),
				'USG_Mammae'		 		=> $this->input->post('usgm_grade'),
				'Stomach_Xray'			 	=> $this->input->post('stoxray_grade'),
				'Pap_Smear'		 			=> $this->input->post('pap_grade'),
				'Breast_Examination'		=> $this->input->post('breast_grade'),
				'Extra_Oral'				=> $this->input->post('exor_grade'),
				'Panoramic_Xray' 			=> $this->input->post('pano_grade'),
				'Intra_Oral'				=> $this->input->post('intr_grade'),
				'Dental_Hygine'		 		=> $this->input->post('dent_grade'),
				'Drug_Test'		 			=> $this->input->post('drug_grade'),

				'pulse_rate'	 			=> $this->input->post('masuk1'),
				'breathing'	 				=> $this->input->post('masuk2'),
				'vital_sign_bp'	 			=> $this->input->post('masuk3'),
				'temperatur'	 			=> $this->input->post('masuk4'),
				'anteriorc'		 			=> $this->input->post('masuk5'),
				'eyes_visual_exam' 			=> $this->input->post('masuk6'),
				'eyes_comment'	 			=> $this->input->post('masuk7'),
				'ear_right'		 			=> $this->input->post('masuk8'),
				'ear_left'		 			=> $this->input->post('masuk9'),
				'nose_septum'	 			=> $this->input->post('masuk10'),
				'nose_polyps'	 			=> $this->input->post('masuk11'),
				'nose_conchae'	 			=> $this->input->post('masuk12'),
				'nose_comment'	 			=> $this->input->post('masuk13'),
				'dental'		 			=> $this->input->post('masuk14'),
				'throat_pharynx' 			=> $this->input->post('masuk15'),
				'throat_tonsil'				=> $this->input->post('masuk16'),
				'throat_comment'			=> $this->input->post('masuk17'),
				'neck_thyroid'				=> $this->input->post('masuk18'),
				'neck_lymph'	 			=> $this->input->post('masuk19'),
				'neck_comment'	 			=> $this->input->post('masuk20'),
				'cardiac_jvp'	 			=> $this->input->post('masuk21'),
				'cardiac_heartsound'	 	=> $this->input->post('masuk22'),
				'cardiac_comment'	 		=> $this->input->post('masuk23'),
				'breast_glands'	 			=> $this->input->post('masuk24'),
				'breast_glands_comment'		=> $this->input->post('masuk25'),
				'respiratory'	 			=> $this->input->post('masuk26'),
				'respiratory_comment'		=> $this->input->post('masuk27'),
				'abdomen_general' 			=> $this->input->post('masuk28'),
				'abdomen_liver'	 			=> $this->input->post('masuk29'),
				'abdomen_spleen'	 		=> $this->input->post('masuk30'),
				'abdomen_kidney'			=> $this->input->post('masuk31'),
				'abdomen_rectal' 			=> $this->input->post('masuk32'),
				'abdomen_comment'			=> $this->input->post('masuk33'),
				'spine'			 			=> $this->input->post('masuk34'),
				'skin'			 			=> $this->input->post('masuk35'),
				'Musculoskeletal'	 		=> $this->input->post('masuk36'),
				'genitourinary_hernia'		=> $this->input->post('masuk37'),
				'genitourinary_inguinal'	=> $this->input->post('masuk38'),
				'genitourinary_hemorrhoid'	=> $this->input->post('masuk39'),
				'genitourinary_comment'		=> $this->input->post('masuk40'),
				'neurological_motor'		=> $this->input->post('masuk41'),
				'neurological_sensory'		=> $this->input->post('masuk42'),
				'neurological_reflexes'		=> $this->input->post('masuk43'),
				'neurological_other'		=> $this->input->post('masuk44'),
				'neurological_comment'	 	=> $this->input->post('masuk45'),
				'fungsi_luhur'	 			=> $this->input->post('masuk46'),
				'physician'	 				=> $this->input->post('masuk47'),
			);
			//Simpan data Grading ke table mst_judgment_grade
			$this->m_patient->save_mcu_result_2($data_pack_2);
		}
		redirect('patient/input_result/update/' . $this->input->post('id_reg'));
	}

	//fungsi Input MCU Result
	function save_mcu_result()
	{
		$this->load->model('m_patient');
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$rowC					= $this->input->post('rowC');
		$register_id			= $this->input->post('id_reg');

		//Cek data ke Table mst_judgment_grade
		$data['all_data_grade'] = $this->m_patient->get_data_grade_result($register_id);
		$row_cnta 				= $data['all_data_grade']->num_rows();
		//Jika Datanya Ada Update ke table mst_judgment_grade	
		if ($row_cnta != 0) {
			$data_pack_2					= array(
				'id_registration'			=> $this->input->post('id_reg'),
				'periode'	 				=> date("Y-m"),
				'date'						=> date("Y-m-d"),
				'Obesitas'					=> $this->input->post('obesitas_grade'),
				'Eyes_Sight'				=> $this->input->post('eye_grade'),
				'Ocular_Tension'			=> $this->input->post('ocular_grade'),
				'Color_Blindness'			=> $this->input->post('cb_grade'),

				'Fundus'					=> $this->input->post('fundus_grade'),
				'Hearing'					=> $this->input->post('hear_grade'),
				'Blood_Pressure'			=> $this->input->post('bp_grade'),
				'Lung_Function'		 		=> $this->input->post('lung_grade'),
				'Urine_Analysis'		 	=> $this->input->post('urinea_grade'),

				'Urine_Sediment'			=> $this->input->post('urines_grade'),
				'OB'			 			=> $this->input->post('ob_grade'),
				'Liver_Function'			=> $this->input->post('liver_grade'),
				'Renal'				 		=> $this->input->post('renal_grade'),
				'Pancreas'		 			=> $this->input->post('pan_grade'),

				'Uric_Acid'					=> $this->input->post('uric_grade'),
				'Lipid'						=> $this->input->post('lipid_grade'),

				'Electrolyte'				=> $this->input->post('elec_grade'),
				'Anemia_Test' 				=> $this->input->post('anemia_grade'),
				'Hematology'				=> $this->input->post('hema_grade'),
				'WBC_Classification'		=> $this->input->post('wbc_grade'),
				'Inflammation'		 		=> $this->input->post('inflam_grade'),

				'Syphilis'					=> $this->input->post('syph_grade'),
				'Serology_Hepatitis'		=> $this->input->post('sero_grade'),
				'Immunology_Test'			=> $this->input->post('imm_grade'),
				'Diabetes_Mellitus'			=> $this->input->post('diabetes_grade'),
				'Blood_Glucose'		 		=> $this->input->post('bloodg_grade'),
				'Urine_Glucose'		 		=> $this->input->post('urineg_grade'),
				'Fructosamine'		 		=> $this->input->post('sero_grade'),

				'Tumor_Marker'				=> $this->input->post('tumor_grade'),
				'Chest_Xray' 				=> $this->input->post('chest_grade'),
				'Xray_Shadow'				=> $this->input->post('shadowxray_grade'),
				'Sputum'		 			=> $this->input->post('sputum_grade'),
				'ECG'			 	     	=> $this->input->post('ecg_grade'),
				'Treadmill'		 			=> $this->input->post('tread_grade'),
				'Echocardiographi'		 	=> $this->input->post('echoca_grade'),

				'USG'						=> $this->input->post('usg_grade'),
				'USG_Prostate' 				=> $this->input->post('usgp_grade'),
				'USG_Uterus'				=> $this->input->post('usgu_grade'),
				'USG_Mammae'		 		=> $this->input->post('usgm_grade'),
				'Stomach_Xray'			 	=> $this->input->post('stoxray_grade'),
				'Pap_Smear'		 			=> $this->input->post('pap_grade'),
				'Breast_Examination'		=> $this->input->post('breast_grade'),

				'Extra_Oral'				=> $this->input->post('exor_grade'),
				'Panoramic_Xray' 			=> $this->input->post('pano_grade'),
				'Intra_Oral'				=> $this->input->post('intr_grade'),
				'Dental_Hygine'		 		=> $this->input->post('dent_grade'),
			);
			//Update data Grading ke table mst_judgment_grade
			$this->m_patient->update_mcu_result_2($data_pack_2, $register_id);
			//Jika Datanya belum ada Insert ke table mst_judgment_grade
		} else {
			$data_pack_2					= array(
				'id_registration'			=> $this->input->post('id_reg'),
				'periode'	 				=> date("Y-m"),
				'date'						=> date("Y-m-d"),
				'Obesitas'					=> $this->input->post('obesitas_grade'),
				'Eyes_Sight'				=> $this->input->post('eye_grade'),
				'Ocular_Tension'			=> $this->input->post('ocular_grade'),
				'Color_Blindness'			=> $this->input->post('cb_grade'),

				'Fundus'					=> $this->input->post('fundus_grade'),
				'Hearing'					=> $this->input->post('hear_grade'),
				'Blood_Pressure'			=> $this->input->post('bp_grade'),
				'Lung_Function'		 		=> $this->input->post('lung_grade'),
				'Urine_Analysis'		 	=> $this->input->post('urinea_grade'),

				'Urine_Sediment'			=> $this->input->post('urines_grade'),
				'OB'			 			=> $this->input->post('ob_grade'),
				'Liver_Function'			=> $this->input->post('liver_grade'),
				'Renal'				 		=> $this->input->post('renal_grade'),
				'Pancreas'		 			=> $this->input->post('pan_grade'),

				'Uric_Acid'					=> $this->input->post('uric_grade'),
				'Lipid'						=> $this->input->post('lipid_grade'),

				'Electrolyte'				=> $this->input->post('elec_grade'),
				'Anemia_Test' 				=> $this->input->post('anemia_grade'),
				'Hematology'				=> $this->input->post('hema_grade'),
				'WBC_Classification'		=> $this->input->post('wbc_grade'),
				'Inflammation'		 		=> $this->input->post('inflam_grade'),

				'Syphilis'					=> $this->input->post('syph_grade'),
				'Serology_Hepatitis'		=> $this->input->post('sero_grade'),
				'Immunology_Test'			=> $this->input->post('imm_grade'),
				'Diabetes_Mellitus'			=> $this->input->post('diabetes_grade'),
				'Blood_Glucose'		 		=> $this->input->post('bloodg_grade'),
				'Urine_Glucose'		 		=> $this->input->post('urineg_grade'),
				'Fructosamine'		 		=> $this->input->post('sero_grade'),

				'Tumor_Marker'				=> $this->input->post('tumor_grade'),
				'Chest_Xray' 				=> $this->input->post('chest_grade'),
				'Xray_Shadow'				=> $this->input->post('shadowxray_grade'),
				'Sputum'		 			=> $this->input->post('sputum_grade'),
				'ECG'			 	     	=> $this->input->post('ecg_grade'),
				'Treadmill'		 			=> $this->input->post('tread_grade'),
				'Echocardiographi'		 	=> $this->input->post('echoca_grade'),

				'USG'						=> $this->input->post('usg_grade'),
				'USG_Prostate' 				=> $this->input->post('usgp_grade'),
				'USG_Uterus'				=> $this->input->post('usgu_grade'),
				'USG_Mammae'		 		=> $this->input->post('usgm_grade'),
				'Stomach_Xray'			 	=> $this->input->post('stoxray_grade'),
				'Pap_Smear'		 			=> $this->input->post('pap_grade'),
				'Breast_Examination'		=> $this->input->post('breast_grade'),

				'Extra_Oral'				=> $this->input->post('exor_grade'),
				'Panoramic_Xray' 			=> $this->input->post('pano_grade'),
				'Intra_Oral'				=> $this->input->post('intr_grade'),
				'Dental_Hygine'		 		=> $this->input->post('dent_grade'),
			);
			//Simpan data Grading ke table mst_judgment_grade
			$this->m_patient->save_mcu_result_2($data_pack_2);
		}
		$id_regist	= $this->input->post('id_reg');
		//Cek data ke Table pat_mcu_result
		$data['all_data'] = $this->m_patient->get_data_mcu_result($id_regist);
		$row_cnt 	= $data['all_data']->num_rows();
		//Jika Sudah Ada Datanya UPDATE
		if ($row_cnt != 0) {

			$dataarray 	= array();
			$cmt_ant	= $this->input->post('count_ant');
			for ($i = 0; $i <= $cmt_ant; $i++) {
				$data_cmt_ant 					= explode(":", $this->input->post('comment_ant_' . $i . ''));
				//$data_cmt_ant_jogress			= $data_cmt_ant.";";
				if (!isset($data_cmt_ant[1])) {
					$data_cmt_ant[1] = null;
				}
				$dataarray['id_service'][$i] 	= $data_cmt_ant[1];
			}
			$hasil_ant =  join(";", $dataarray['id_service']);

			$dataarray_2 	= array();
			$cmt_eye		= $this->input->post('count_eye');
			for ($a = 0; $a <= $cmt_eye; $a++) {

				$data_cmt_eye 					= explode(":", $this->input->post('comment_eye_' . $a . ''));
				//$data_cmt_eye_jogress			= $data_cmt_eye.";";
				if (!isset($data_cmt_eye[1])) {
					$data_cmt_eye[1] = null;
				}
				$dataarray_2['id_service'][$a] 	= $data_cmt_eye[1];
			}
			$hasil_eye =  join(";", $dataarray_2['id_service']);

			$dataarray_3 	= array();
			$cmt_hea		= $this->input->post('count_hea');
			for ($b = 0; $b <= $cmt_hea; $b++) {
				$data_cmt_hea 					= explode(":", $this->input->post('comment_hea_' . $b . ''));
				//$data_cmt_hea_jogress			= $data_cmt_hea.";";
				if (!isset($data_cmt_hea[1])) {
					$data_cmt_hea[1] = null;
				}
				$dataarray_3['id_service'][$b] 	= $data_cmt_hea[1];
			}
			$hasil_hea =  join(";", $dataarray_3['id_service']);

			$dataarray_4 	= array();
			$cmt_res		= $this->input->post('count_res');
			for ($c = 0; $c <= $cmt_res; $c++) {
				$data_cmt_res 					= explode(":", $this->input->post('comment_res_' . $c . ''));
				//$data_cmt_res_jogress			= $data_cmt_res.";";
				if (!isset($data_cmt_res[1])) {
					$data_cmt_res[1] = null;
				}
				$dataarray_4['id_service'][$c] 	= $data_cmt_res[1];
			}
			$hasil_res =  join(";", $dataarray_4['id_service']);

			$dataarray_5 	= array();
			$cmt_ecg		= $this->input->post('count_ecg');
			for ($d = 0; $d <= $cmt_ecg; $d++) {
				$data_cmt_ecg					= explode(":", $this->input->post('comment_ecg_' . $d . ''));
				//$data_cmt_ecg_jogress			= $data_cmt_ecg.";";
				if (!isset($data_cmt_ecg[1])) {
					$data_cmt_ecg[1] = null;
				}
				$dataarray_5['id_service'][$d] 	= $data_cmt_ecg[1];
			}
			$hasil_ecg =  join(";", $dataarray_5['id_service']);

			$dataarray_6 	= array();
			$cmt_tm			= $this->input->post('count_tm');
			for ($e = 0; $e <= $cmt_tm; $e++) {
				$data_cmt_tm					= explode(":", $this->input->post('comment_tm_' . $e . ''));
				//$data_cmt_tm_jogress			= $data_cmt_tm.";";
				if (!isset($data_cmt_tm[1])) {
					$data_cmt_tm[1] = null;
				}
				$dataarray_6['id_service'][$e] 	= $data_cmt_tm[1];
			}
			$hasil_tm =  join(";", $dataarray_6['id_service']);

			$dataarray_7 	= array();
			$cmt_dent		= $this->input->post('count_dent');
			for ($f = 0; $f <= $cmt_dent; $f++) {
				$data_cmt_dent					= explode(":", $this->input->post('comment_dent_' . $f . ''));
				//$data_cmt_dent_jogress			= $data_cmt_dent.";";
				if (!isset($data_cmt_dent[1])) {
					$data_cmt_dent[1] = null;
				}
				$dataarray_7['id_service'][$f] 	= $data_cmt_dent[1];
			}
			$hasil_dent =  join(";", $dataarray_7['id_service']);

			$dataarray_8 	= array();
			$cmt_gyn		= $this->input->post('count_gyn');
			for ($g = 0; $g <= $cmt_gyn; $g++) {
				$data_cmt_gyn					= explode(":", $this->input->post('comment_gyn_' . $g . ''));
				//$data_cmt_gyn_jogress			= $data_cmt_gyn.";";
				if (!isset($data_cmt_gyn[1])) {
					$data_cmt_gyn[1] = null;
				}
				$dataarray_8['id_service'][$g] 	= $data_cmt_gyn[1];
			}
			$hasil_gyn =  join(";", $dataarray_8['id_service']);

			$dataarray_9 	= array();
			$cmt_pap		= $this->input->post('count_pap');
			for ($h = 0; $h <= $cmt_pap; $h++) {
				$data_cmt_pap					= explode(":", $this->input->post('comment_pap_' . $h . ''));
				//$data_cmt_pap_jogress			= $data_cmt_pap.";";
				if (!isset($data_cmt_pap[1])) {
					$data_cmt_pap[1] = null;
				}
				$dataarray_9['id_service'][$h] 	= $data_cmt_pap[1];
			}
			$hasil_pap =  join(";", $dataarray_9['id_service']);

			$dataarray_10 	= array();
			$cmt_bra		= $this->input->post('count_bra');
			for ($i = 0; $i <= $cmt_bra; $i++) {
				$data_cmt_bra					= explode(":", $this->input->post('comment_bra_' . $i . ''));
				//$data_cmt_bra_jogress			= $data_cmt_bra.";";
				if (!isset($data_cmt_bra[1])) {
					$data_cmt_bra[1] = null;
				}
				$dataarray_10['id_service'][$i] 	= $data_cmt_bra[1];
			}
			$hasil_bra =  join(";", $dataarray_10['id_service']);

			$dataarray_11 	= array();
			$cmt_gyn_result	= $this->input->post('count_gyn_result');
			for ($i = 0; $i <= $cmt_gyn_result; $i++) {
				$data_cmt_gyn_result			= explode(":", $this->input->post('gyn_result_' . $i . ''));
				//$data_cmt_bra_jogress			= $data_cmt_bra.";";
				if (!isset($data_cmt_gyn_result[1])) {
					$data_cmt_gyn_result[1] = null;
				}
				$dataarray_11['id_service'][$i] 	= $data_cmt_gyn_result[1];
			}
			$hasil_gyn_result =  join(";", $dataarray_11['id_service']);

			$dataarray_12 	= array();
			$cmt_pap_result	= $this->input->post('count_pap_result');
			for ($i = 0; $i <= $cmt_pap_result; $i++) {
				$data_cmt_pap_result			= explode(":", $this->input->post('pap_result_' . $i . ''));
				//$data_cmt_bra_jogress			= $data_cmt_bra.";";
				if (!isset($data_cmt_pap_result[1])) {
					$data_cmt_pap_result[1] = null;
				}
				$dataarray_12['id_service'][$i] 	= $data_cmt_pap_result[1];
			}
			$hasil_pap_result =  join(";", $dataarray_12['id_service']);

			if ($this->input->post('comment_ant_0') == "") {
				$hasil_ant = $this->input->post('comment_ant_last');
			}
			if ($this->input->post('comment_eye_0') == "") {
				$hasil_eye = $this->input->post('comment_eye_last');
			}
			if ($this->input->post('comment_hea_0') == "") {
				$hasil_hea = $this->input->post('comment_hea_last');
			}
			if ($this->input->post('comment_res_0') == "") {
				$hasil_res = $this->input->post('comment_res_last');
			}
			if ($this->input->post('comment_tm_0') == "") {
				$hasil_tm = $this->input->post('comment_tm_last');
			}
			if ($this->input->post('comment_ecg_0') == "") {
				$hasil_ecg = $this->input->post('comment_tm_last');
			}
			if ($this->input->post('comment_pap_0') == "") {
				$hasil_pap = $this->input->post('comment_pap_last');
			}
			if ($this->input->post('comment_gyn_0') == "") {
				$hasil_gyn = $this->input->post('comment_gyn_last');
			}
			if ($this->input->post('gyn_result_0') == "") {
				$hasil_gyn_result = $this->input->post('comment_gyn_result_last');
			}
			if ($this->input->post('pap_result_0') == "") {
				$hasil_pap_result = $this->input->post('comment_pap_result_last');
			}
			if ($this->input->post('comment_bra_0') == "") {
				$hasil_bra = $this->input->post('comment_bra_last');
			}
			if ($this->input->post('comment_dent_0') == "") {
				$hasil_dent = $this->input->post('comment_dent_last');
			}

			$data_pack 						= array(
				'id_regist'					=> $this->input->post('id_reg'),
				'obe_index' 				=> $this->input->post('obe_index'),
				'abd_girth'					=> $this->input->post('abd_girth'),
				'std_weight'				=> $this->input->post('std_weight'),
				'ant_comment'				=> $hasil_ant,
				'ref_right'		 			=> $this->input->post('ref_right'),
				'ref_left'			 		=> $this->input->post('ref_left'),

				'fundus_H'					=> $this->input->post('fundus_h'),
				'fundus_S'					=> $this->input->post('fundus_s'),
				'class_venti'				=> $this->input->post('cov'),
				'ref_comment'		 		=> $hasil_eye,
				'tht_comment'		 		=> $this->input->post('tht'),
				'bp_comment'		 		=> $this->input->post('comment_bp'),

				'aud_comment'				=> $hasil_hea,
				'res_comment'	 			=> $hasil_res,
				'trd_result'				=> $this->input->post('trd'),
				'trd_comment'		 		=> $hasil_tm,
				'ecg_result'		 		=> $this->input->post('ecg'),

				'ecg_comment'				=> $hasil_ecg,
				'pap_result'				=> $hasil_pap_result,

				'pap_comment'				=> $hasil_pap,
				'gyn_result' 				=> $hasil_gyn_result,
				'gyn_comment'				=> $hasil_gyn,
				'brs_result'		 		=> $this->input->post('breast_result'),
				'brs_comment'		 		=> $hasil_bra,

				'dnt_comment'				=> $hasil_dent,
				'dnt_hygn' 					=> $this->input->post('dent_hygn'),
				'dnt_oral'					=> $this->input->post('dent_xral'),
				'dnt_pnrm'		 			=> $this->input->post('dent_xray'),
				'dnt_inor'			 		=> $this->input->post('dnt_inor'),
				'dnt_impc'		 			=> $this->input->post('dent_impact'),

				'dnt_brok'					=> $this->input->post('dent_broken'),
				'dnt_cyst' 					=> $this->input->post('dent_cyst'),
				'dnt_mobi'					=> $this->input->post('dent_mobi'),
				'dnt_calc'		 			=> $this->input->post('dent_calc'),
				'dnt_cari'			 		=> $this->input->post('dent_caris'),
				'dnt_fill'		 			=> $this->input->post('dent_fill'),

				'dnt_miss'		 			=> $this->input->post('dent_miss'),

				'fitness'		 			=> $this->input->post('fitness'),
				'fitness_comment'		 	=> $this->input->post('comment_final'),
				'suggestion'		 		=> $this->input->post('suggestion'),
			);
			//Update ke Table pat_mcu_result
			$this->m_patient->update_mcu_result($data_pack, $register_id);

			//INSERT UNTUK KOMENTAR LAB
			$rowC			= $this->input->post('rowC');
			for ($lab_aa = 1; $lab_aa <= $rowC; $lab_aa++) {
				$data_cmt_lab 								= $this->input->post('comment_lab_' . $lab_aa . '');
				$hasil_comment_lab 							= $data_cmt_lab;
				if ($hasil_comment_lab != "") {
					$sql_lab = "update mst_mcu_comment set comment='" . $hasil_comment_lab . "' where id='" . $this->input->post('isi_lab_' . $lab_aa . '') . "' ";
					$this->db->query($sql_lab);
				}
			}
			//INSERT UNTUK KOMENTAR RAD
			$rowCrad		= $this->input->post('rowCyin');
			for ($rad_aa = 1; $rad_aa <= $rowCrad; $rad_aa++) {
				$data_cmt_rad								= $this->input->post('comment_rad_' . $rad_aa . '');
				$hasil_comment_rad 							= $data_cmt_rad;

				if ($hasil_comment_rad != "") {
					$sql = "update mst_mcu_comment set comment='" . $hasil_comment_rad . "' where id='" . $this->input->post('isi_rad_' . $rad_aa . '') . "' ";
					$this->db->query($sql);
				}
			}

			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data_log = array(
				'id_user'						=> $user_id,
				'log_date'						=> date("Y-m-d"),
				'log_desc' 						=> "Update Result MCU | ID Registration : " . $this->input->post('id_reg') . "",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
			$datapack				= array(
				'lock_by'				=> $user_id,
				'locked'					=> 0,
			);
			$data['lock'] 			= $this->m_patient->lock_mcu($id_regist, $datapack);
			redirect('patient/input_result/update/' . $this->input->post('id_reg'));
			//Jika Belum Ada Datanya INSERT DATA
		} else {
			$dataarray 	= array();
			$cmt_ant	= $this->input->post('count_ant');
			$id_regist	= $this->input->post('id_reg');
			for ($i = 0; $i <= $cmt_ant; $i++) {
				$data_cmt_ant 					= explode(":", $this->input->post('comment_ant_' . $i . ''));
				//$data_cmt_ant_jogress			= $data_cmt_ant.";";
				if (!isset($data_cmt_ant[1])) {
					$data_cmt_ant[1] = null;
				}
				$dataarray['id_service'][$i] 	= $data_cmt_ant[1];
			}
			$hasil_ant =  join(";", $dataarray['id_service']);

			$dataarray_2 	= array();
			$cmt_eye		= $this->input->post('count_eye');
			for ($a = 0; $a <= $cmt_eye; $a++) {

				$data_cmt_eye 					= explode(":", $this->input->post('comment_eye_' . $a . ''));
				//$data_cmt_eye_jogress			= $data_cmt_eye.";";
				if (!isset($data_cmt_eye[1])) {
					$data_cmt_eye[1] = null;
				}
				$dataarray_2['id_service'][$a] 	= $data_cmt_eye[1];
			}
			$hasil_eye =  join(";", $dataarray_2['id_service']);

			$dataarray_3 	= array();
			$cmt_hea		= $this->input->post('count_hea');
			for ($b = 0; $b <= $cmt_hea; $b++) {
				$data_cmt_hea 					= explode(":", $this->input->post('comment_hea_' . $b . ''));
				//$data_cmt_hea_jogress			= $data_cmt_hea.";";
				if (!isset($data_cmt_hea[1])) {
					$data_cmt_hea[1] = null;
				}
				$dataarray_3['id_service'][$b] 	= $data_cmt_hea[1];
			}
			$hasil_hea =  join(";", $dataarray_3['id_service']);

			$dataarray_4 	= array();
			$cmt_res		= $this->input->post('count_res');
			for ($c = 0; $c <= $cmt_res; $c++) {
				$data_cmt_res 					= explode(":", $this->input->post('comment_res_' . $c . ''));
				//$data_cmt_res_jogress			= $data_cmt_res.";";
				if (!isset($data_cmt_res[1])) {
					$data_cmt_res[1] = null;
				}
				$dataarray_4['id_service'][$c] 	= $data_cmt_res[1];
			}
			$hasil_res =  join(";", $dataarray_4['id_service']);

			$dataarray_5 	= array();
			$cmt_ecg		= $this->input->post('count_ecg');
			for ($d = 0; $d <= $cmt_ecg; $d++) {
				$data_cmt_ecg					= explode(":", $this->input->post('comment_ecg_' . $d . ''));
				//$data_cmt_ecg_jogress			= $data_cmt_ecg.";";
				if (!isset($data_cmt_ecg[1])) {
					$data_cmt_ecg[1] = null;
				}
				$dataarray_5['id_service'][$d] 	= $data_cmt_ecg[1];
			}
			$hasil_ecg =  join(";", $dataarray_5['id_service']);

			$dataarray_6 	= array();
			$cmt_tm			= $this->input->post('count_tm');
			for ($e = 0; $e <= $cmt_tm; $e++) {
				$data_cmt_tm					= explode(":", $this->input->post('comment_tm_' . $e . ''));
				//$data_cmt_tm_jogress			= $data_cmt_tm.";";
				if (!isset($data_cmt_tm[1])) {
					$data_cmt_tm[1] = null;
				}
				$dataarray_6['id_service'][$e] 	= $data_cmt_tm[1];
			}
			$hasil_tm =  join(";", $dataarray_6['id_service']);

			$dataarray_7 	= array();
			$cmt_dent		= $this->input->post('count_dent');
			for ($f = 0; $f <= $cmt_dent; $f++) {
				$data_cmt_dent					= explode(":", $this->input->post('comment_dent_' . $f . ''));
				//$data_cmt_dent_jogress			= $data_cmt_dent.";";
				if (!isset($data_cmt_dent[1])) {
					$data_cmt_dent[1] = null;
				}
				$dataarray_7['id_service'][$f] 	= $data_cmt_dent[1];
			}
			$hasil_dent =  join(";", $dataarray_7['id_service']);

			$dataarray_8 	= array();
			$cmt_gyn		= $this->input->post('count_gyn');
			for ($g = 0; $g <= $cmt_gyn; $g++) {
				$data_cmt_gyn					= explode(":", $this->input->post('comment_gyn_' . $g . ''));
				//$data_cmt_gyn_jogress			= $data_cmt_gyn.";";
				if (!isset($data_cmt_gyn[1])) {
					$data_cmt_gyn[1] = null;
				}
				$dataarray_8['id_service'][$g] 	= $data_cmt_gyn[1];
			}
			$hasil_gyn =  join(";", $dataarray_8['id_service']);

			$dataarray_9 	= array();
			$cmt_pap		= $this->input->post('count_pap');
			for ($h = 0; $h <= $cmt_pap; $h++) {
				$data_cmt_pap					= explode(":", $this->input->post('comment_pap_' . $h . ''));
				//$data_cmt_pap_jogress			= $data_cmt_pap.";";
				if (!isset($data_cmt_pap[1])) {
					$data_cmt_pap[1] = null;
				}
				$dataarray_9['id_service'][$h] 	= $data_cmt_pap[1];
			}
			$hasil_pap =  join(";", $dataarray_9['id_service']);

			$dataarray_10 	= array();
			$cmt_bra		= $this->input->post('count_bra');
			for ($i = 0; $i <= $cmt_bra; $i++) {
				$data_cmt_bra					= explode(":", $this->input->post('comment_bra_' . $i . ''));
				//$data_cmt_bra_jogress			= $data_cmt_bra.";";
				if (!isset($data_cmt_bra[1])) {
					$data_cmt_bra[1] = null;
				}
				$dataarray_10['id_service'][$i] 	= $data_cmt_bra[1];
			}
			$hasil_bra =  join(";", $dataarray_10['id_service']);

			$dataarray_11 	= array();
			$cmt_gyn_result	= $this->input->post('count_gyn_result');
			for ($i = 0; $i <= $cmt_gyn_result; $i++) {
				$data_cmt_gyn_result			= explode(":", $this->input->post('gyn_result_' . $i . ''));
				//$data_cmt_bra_jogress			= $data_cmt_bra.";";
				if (!isset($data_cmt_gyn_result[1])) {
					$data_cmt_gyn_result[1] = null;
				}
				$dataarray_11['id_service'][$i] 	= $data_cmt_gyn_result[1];
			}
			$hasil_gyn_result =  join(";", $dataarray_11['id_service']);

			$dataarray_12 	= array();
			$cmt_pap_result	= $this->input->post('count_pap_result');
			for ($i = 0; $i <= $cmt_pap_result; $i++) {
				$data_cmt_pap_result			= explode(":", $this->input->post('pap_result_' . $i . ''));
				//$data_cmt_bra_jogress			= $data_cmt_bra.";";
				if (!isset($data_cmt_pap_result[1])) {
					$data_cmt_pap_result[1] = null;
				}
				$dataarray_12['id_service'][$i] 	= $data_cmt_pap_result[1];
			}
			$hasil_pap_result =  join(";", $dataarray_12['id_service']);

			$data_pack 						= array(
				'id_regist'					=> $this->input->post('id_reg'),
				'obe_index' 				=> $this->input->post('obe_index'),
				'abd_girth'					=> $this->input->post('abd_girth'),
				'std_weight'				=> $this->input->post('std_weight'),
				'ant_comment'				=> $hasil_ant,
				'ref_right'		 			=> $this->input->post('ref_right'),
				'ref_left'			 		=> $this->input->post('ref_left'),

				'fundus_H'					=> $this->input->post('fundus_h'),
				'fundus_S'					=> $this->input->post('fundus_s'),
				'class_venti'				=> $this->input->post('cov'),
				'ref_comment'		 		=> $hasil_eye,
				'tht_comment'		 		=> $this->input->post('tht'),
				'bp_comment'		 		=> $this->input->post('comment_bp'),

				'aud_comment'				=> $hasil_hea,
				'res_comment'	 			=> $hasil_res,
				'trd_result'				=> $this->input->post('trd'),
				'trd_comment'		 		=> $hasil_tm,
				'ecg_result'		 		=> $this->input->post('ecg'),

				'ecg_comment'				=> $hasil_ecg,
				'pap_result'				=> $hasil_pap_result,

				'pap_comment'				=> $hasil_pap,
				'gyn_result' 				=> $hasil_gyn_result,
				'gyn_comment'				=> $hasil_gyn,
				'brs_result'		 		=> $this->input->post('breast_result'),
				'brs_comment'		 		=> $hasil_bra,

				'dnt_comment'				=> $hasil_dent,
				'dnt_hygn' 					=> $this->input->post('dent_hygn'),
				'dnt_oral'					=> $this->input->post('dent_xral'),
				'dnt_pnrm'		 			=> $this->input->post('dent_xray'),
				'dnt_inor'			 		=> $this->input->post('dnt_inor'),
				'dnt_impc'		 			=> $this->input->post('dent_impact'),

				'dnt_brok'					=> $this->input->post('dent_broken'),
				'dnt_cyst' 					=> $this->input->post('dent_cyst'),
				'dnt_mobi'					=> $this->input->post('dent_mobi'),
				'dnt_calc'		 			=> $this->input->post('dent_calc'),
				'dnt_cari'			 		=> $this->input->post('dent_caris'),
				'dnt_fill'		 			=> $this->input->post('dent_fill'),

				'dnt_miss'		 			=> $this->input->post('dent_miss'),

				'fitness'		 			=> $this->input->post('fitness'),
				'fitness_comment'		 	=> $this->input->post('comment_final'),
				'suggestion'		 		=> $this->input->post('suggestion'),
			);
			//Simpan data ke table pat_mcu_result
			$this->m_patient->save_mcu_result($data_pack);
			$cmt_lab		= $this->input->post('count_lab');
			//INSERT UNTUK KOMENTAR LAB
			$rowC			= $this->input->post('rowC');
			for ($lab_aa = 1; $lab_aa <= $rowC; $lab_aa++) {
				$data_cmt_lab 								= $this->input->post('comment_lab_' . $lab_aa . '');
				$hasil_comment_lab 							= $data_cmt_lab;
				if ($hasil_comment_lab != "") {
					$sql_lab = "update mst_mcu_comment set comment='" . $hasil_comment_lab . "' where id='" . $this->input->post('isi_lab_' . $lab_aa . '') . "' ";
					$this->db->query($sql_lab);
				}
			}
			//INSERT UNTUK KOMENTAR RAD
			$rowCrad		= $this->input->post('rowCyin');
			for ($rad_aa = 1; $rad_aa <= $rowCrad; $rad_aa++) {
				$data_cmt_rad								= $this->input->post('comment_rad_' . $rad_aa . '');
				$hasil_comment_rad 							= $data_cmt_rad;

				if ($hasil_comment_rad != "") {
					$sql = "update mst_mcu_comment set comment='" . $hasil_comment_rad . "' where id='" . $this->input->post('isi_rad_' . $rad_aa . '') . "' ";
					$this->db->query($sql);
				}
			}

			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data_log = array(
				'id_user'						=> $user_id,
				'log_date'						=> date("Y-m-d"),
				'log_desc' 						=> "Create Result MCU | ID Registration : " . $this->input->post('id_reg') . "",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
			$datapack				= array(
				'lock_by'				=> $user_id,
				'locked'					=> 0,
			);
			$data['lock'] 			= $this->m_patient->lock_mcu($id_regist, $datapack);
			redirect('patient/input_result/insert');
		}
	}

	public function add_new_patient_ajax()
	{
		$code = 500;
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$user_id      = $session_data['id'];
			$loc          = $session_data['location'];

			$code_no = $this->m_patient->pat_mrn();

			if ($code_no == false) {
				$code_no = 1;
			}

			$pat_mrn = $loc . $code_no;
			$current_date = date('Y-m-d');
			$current_date_time = date('Y-m-d H:i:s');

			$id_number         = $this->input->post('id_number');
			$id_number_type    = $this->input->post('id_number_type');
			$id_medical_record = $this->input->post('id_medical_record');
			$patient_name      = strtoupper($this->input->post('patient_name'));
			$patient_title     = $this->input->post('patient_title');
			$gender            = $this->input->post('gender');
			$pob               = $this->input->post('pob');
			$dob               = $this->input->post('dob');
			$marital_status    = $this->input->post('marital_status');
			$religion          = $this->input->post('religion');
			$job               = $this->input->post('job');
			$mobile_phone      = $this->input->post('mobile_phone');
			$relative_name     = strtoupper($this->input->post('relative_name'));
			$relative_phone    = $this->input->post('relative_phone');

			$data = [
				'id_history'         => $id_medical_record,
				'pat_mrn'            => $pat_mrn,
				'pat_name'           => $patient_name,
				'pat_gender'         => $gender,
				'pat_dob'            => $dob,
				'pat_pob'            => $pob,
				'pat_idno'           => $id_number,
				'pat_idtype'         => $id_number_type,
				'pat_marital_status' => $marital_status,
				'pat_address_home'   => null,
				'pos_code'           => null,
				'pat_contact_home'   => null,
				'pat_address_misc'   => null,
				'pat_contact_misc'   => $mobile_phone,
				'pat_rel_name'       => $relative_name,
				'pat_rel_type'       => null,
				'pat_rel_contact'    => $relative_phone,
				'pat_nationality'    => 0,
				'pat_email'          => null,
				'pat_province'       => null,
				'pat_city'           => null,
				'id_client'          => null,
				'id_client_dept'     => null,
				'id_client_job'      => null,
				'id_title'           => $patient_title,
				'parentname'         => null,
				'job'                => $job,
				'religion'           => $religion,
				'src_mcu'            => null,
				'status_pat'         => 0,
				'created_date'       => $current_date_time,
			];

			$exec = $this->m_patient->add_new_patient_ajax($data);

			if ($exec) {
				$log_desc = "Create Patient Data : " . $patient_name . " | Patient MRN : " . $loc;
				$data_log = [
					'id_user'  => $user_id,
					'log_date' => $current_date,
					'log_desc' => $log_desc,
				];

				$this->m_login->log($data_log);

				$code = 200;
			}
		} else {
			$code = 403;
		}

		echo json_encode(['code' => $code]);
	}
}
