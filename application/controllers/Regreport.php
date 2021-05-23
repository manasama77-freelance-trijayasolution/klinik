<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Regreport extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}
	/*  	var $limit = 10;
	var $reg = 'reg_patien';
  */
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


	function reg_report()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['username'] = $session_data['username'];
		//----- condition where value of id_reg or date of registration not null-----//
		$act      = $this->input->post('act');
		$id_reg1  = $this->input->post('id_reg1');
		$id_reg2  = $this->input->post('id_reg2');
		$datereg1 = date("Y-m-d", strtotime($this->input->post('datereg1')));
		$datereg2 = date("Y-m-d", strtotime($this->input->post('datereg2')));
		//echo $act;
		if ($act == "View") {
			if (!empty($id_reg1) && !empty($id_reg2)) {

				$this->load->model('m_regreport'); // load ke model m_registration mst_charge_rule
				$data['trx_registration'] = $this->m_regreport->report_reg_as_id($id_reg1, $id_reg2); // 		
				$this->template->set('title', 'Klinik | Registration Report');
				$this->template->load('template', 'menu/reg_report', $data);
			} elseif (!empty($datereg1) && !empty($datereg2)) {

				$this->load->model('m_regreport'); // load ke model m_registration mst_charge_rule
				$data['trx_registration'] = $this->m_regreport->report_reg_as_date_new($datereg1, $datereg2); // 		
				$this->template->set('title', 'Klinik | Registration Report');
				$this->template->load('template', 'menu/reg_report', $data);
			}
		} elseif ($act == "Print") {
			//echo "Print ieu teh";
			echo "<script> window.open('print_reg/$datereg1/$datereg2', '', 'width=700, height=600, top=25, left=350');</script>";
			$this->load->model('m_regreport'); // load ke model m_registration mst_charge_rule
			$data['trx_registration'] = $this->m_regreport->get_report_reg(); // 		
			$this->template->set('title', 'Klinik | Registration Report');
			$this->template->load('template', 'menu/reg_report', $data);
		} else {
			$this->load->model('m_regreport'); // load ke model m_registration mst_charge_rule
			$data['trx_registration'] = $this->m_regreport->get_report_reg(); // 		
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

	function print_reg()
	{
		$datereg1                   = $this->uri->segment(3);
		$datereg2                   = $this->uri->segment(4);

		$session_data               = $this->session->userdata('logged_in');
		$loc 	                    = $session_data['location'];
		$data['username']           = $session_data['username'];
		$this->load->model('m_regreport'); // load ke model m_registration mst_charge_rule
		$data['report_reg_as_date'] = $this->m_regreport->report_reg_as_date($datereg1, $datereg2); // 
		$this->load->model('m_registration'); // load ke model m_registration mst_charge_rule
		$data['get_branch']         = $this->m_registration->get_mst_branch($loc); // ---""" " ---- mst_client_dept	
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

		/* var_dump($data_reg); 
die();  */

		$this->load->model('m_registration'); // go to model/m_registration patien dan kirim array data reg
		$this->m_registration->save_registration($data_reg);  // load dari model/function save_registration($data_reg)
		redirect('registration/reg_patien');
	}
}
