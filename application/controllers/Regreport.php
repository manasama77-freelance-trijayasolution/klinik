<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Regreport extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_regreport');
		$this->load->model('m_registration');
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


	public function reg_report()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data     = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$act              = $this->input->post('act');
			$id_reg1          = $this->input->post('id_reg1');
			$id_reg2          = $this->input->post('id_reg2');
			$datereg1         = ($this->input->post('datereg1')) ? $this->input->post('datereg1') : date('Y-m-d');
			$datereg2         = ($this->input->post('datereg2')) ? $this->input->post('datereg2') : date('Y-m-d');

			if ($act == "View") {
				if (!empty($id_reg1) && !empty($id_reg2)) {
					$data['trx_registration'] = $this->m_regreport->report_reg_as_id($id_reg1, $id_reg2);
				} elseif (!empty($datereg1) && !empty($datereg2)) {
					$data['trx_registration'] = $this->m_regreport->report_reg_as_date_new($datereg1, $datereg2); // 		
				}
			} else {
				if ($act == "Print") {
					echo "<script> window.open('print_reg/$datereg1/$datereg2', '', 'width=700, height=600, top=25, left=350');</script>";
				}

				$data['trx_registration'] = $this->m_regreport->get_report_reg();
			}

			$data['datereg1'] = $datereg1;
			$data['datereg2'] = $datereg2;

			$this->template->set('title', 'Klinik | Registration Report');
			$this->template->load('template', 'menu/reg_report', $data);
		}
	}

	function reg_report_excel()
	{
		$this->load->model('m_regreport');
		$session_data 				= $this->session->userdata('logged_in');
		$data['username'] 			= $session_data['username'];
		$act      					= $this->input->post('act');
		$id_reg1  					= $this->input->post('id_reg1');
		$id_reg2  					= $this->input->post('id_reg2');
		$datereg1 					= date("Y-m-d", strtotime($this->input->post('datereg1')));
		$datereg2 					= date("Y-m-d", strtotime($this->input->post('datereg2')));
		$data['data'] 				= $this->m_regreport->get_report_reg();
		$this->load->view('menu/reg_report_excel', $data);
	}

	public function print_reg()
	{
		$session_data     = $this->session->userdata('logged_in');
		$datereg1         = $this->uri->segment(3);
		$datereg2         = $this->uri->segment(4);
		$loc              = $session_data['location'];
		$data['username'] = $session_data['username'];

		$data['report_reg_as_date'] = $this->m_regreport->report_reg_as_date($datereg1, $datereg2);
		$data['get_branch']         = $this->m_registration->get_mst_branch($loc);

		$this->template->set('title', 'Klinik | Registration Report');
		$this->load->view('menu/print_reg', $data);
	}

	function delete_reg()
	{
		if ($this->session->userdata('logged_in')) {

			$this->load->model('m_regreport');

			$session_data                  	= $this->session->userdata('logged_in');
			$data['username']              	= $session_data['username'];
			$location 						= $session_data['location'];
			$id_reg       	           		= $this->uri->segment(3);
			$select 						= $this->m_regreport->get_trx_registration2($id_reg);

			foreach ($select->result() as $row) {
				$this->db->insert('trx_registration_recyclebin', $row);
			}

			$this->m_regreport->del_trx_registration($id_reg);


			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data_log = array(
				'id_user'						=> $user_id,
				'log_date'						=> date("Y-m-d H:i:s"),
				'log_desc' 						=> "Delete Registration | ID Registration : " . $id_reg . "",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log


			// redirect('regreport/reg_report');
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function save_reg()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_reg 			= array(
			'id_reg'			=> $this->input->post('id_reg'),
			'reg_date' 			=> date("Y-m-d", strtotime($this->input->post('reg_date'))),
			//'reg_date' 			=>$this->input->post('reg_date'),
			'id_pat'			=> $this->input->post('id_pat'),
			'pat_charge_rule' 	=> $this->input->post('pat_charge_rule'),
			'payment_type'		=> $this->input->post('payment_type'),
			'id_client' 		=> $this->input->post('id_client'),
			'id_client_dept'	=> $this->input->post('id_client_dept'),
			'id_client_job' 	=> $this->input->post('id_client_job'),
			'reference'			=> $this->input->post('reference'),
			'id_dr' 			=> $this->input->post('id_dr'),
			'insurance_comp'	=> $this->input->post('insurance_comp'),
			'id_project' 		=> $this->input->post('id_project'),
			'misc_notes'		=> $this->input->post('misc_notes'),
			'pat_sign' 			=> $this->input->post('pat_sign'),
			'reg_type' 			=> $this->input->post('reg_type'),
		);

		$this->m_registration->save_registration($data_reg);  // load dari model/function save_registration($data_reg)
		redirect('registration/reg_patien');
	}

	public function get_list_registration()
	{
		$data = $this->m_regreport->get_list();
		$code = 500;

		if ($data) {
			$code = 200;
		}

		$result = [];

		if ($data->num_rows() > 0) {
			foreach ($data->result() as $key) {
				$nested = [
					'id'         => $key->id,
					'id_reg'     => $key->id_reg,
					'id_pat'     => $key->id_pat,
					'reg_date'   => $key->reg_date,
					'pat_name'   => $key->pat_name,
					'title_desc' => $key->title_desc,
					'pat_dob'    => $key->pat_dob,
					'price_type' => $key->price_type,
					'age'        => $this->generate_age($key->pat_dob),
				];

				array_push($result, $nested);
			}
		}

		echo json_encode([
			'code'     => $code,
			'num_rows' => $data->num_rows(),
			'result'   => $result,
		]);
	}

	public function generate_age($dob = null)
	{
		if ($dob == null) {
			$dob = new DateTime();
		}

		$current_date = new DateTime();
		$dob = new DateTime($dob);
		$interval = $current_date->diff($dob);

		return $interval->y . ' Year ' . $interval->m . ' Month';
	}
}
