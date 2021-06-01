<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Marketing extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
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

	//fungsi load form quotation lama
	function quotation_v1()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$this->load->model('m_registration');

			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['sv_lab'] 		= $this->m_quotation->get_list_lab();
			$data['sv_rad'] 		= $this->m_quotation->get_list_rad();
			$data['sv_mark'] 		= $this->m_quotation->get_list_mark();
			$data['get_client']     = $this->m_registration->get_mst_client();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();

			$this->template->set('title', 'Klinik | Quotation');
			$this->template->load('template', 'menu/quotation', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function quotation_process()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$this->load->model('m_registration');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];


			$p_client				= $this->input->post('p_client');
			$data['p_name']			= $this->input->post('p_name');
			// echo "1 - ".$p_client."<br/> 2 - ".$data['p_name'];
			// exit();

			$data['get_client']     		= $this->m_quotation->get_mst_client_package_h2($p_client);
			foreach ($data['get_client']->result() as $row) {
				$data['id_package'] 			= $row->id_package;
				$data['package_name'] 			= $row->package_name;
				$data['persen_margin'] 			= $row->persen_margin;
				$data['qty'] 					= $row->qty;
				$data['sell_price'] 			= $row->sell_price;
				$data['adjust'] 				= $row->adjust;
				$data['amount_total']			= $row->amount_total;
				$data['grand_total'] 			= $row->grand_total;
				$data['package_exp'] 			= $row->package_exp;
				$data['id_Client'] 				= $row->id_Client;
				$data['client_name'] 			= $row->client_name;
				$data['client_address1'] 		= $row->client_address1;
				$data['client_address2'] 		= $row->client_address2;
				$data['client_contact_name']	= $row->client_contact_name;
				$data['client_phone'] 			= $row->client_phone;
				$data['client_fax'] 			= $row->client_fax;
				$data['client_mobile'] 			= $row->client_mobile;
				$data['client_other'] 			= $row->client_other;
			}

			$data['list_detail']    			= $this->m_quotation->get_list_service_package_detail($p_client);
			$data['sv_group'] 					= $this->m_quotation->get_list_services_group();
			$data['sv_lab'] 					= $this->m_quotation->get_list_lab();
			$data['sv_rad'] 					= $this->m_quotation->get_list_rad();
			$data['sv_mark'] 					= $this->m_quotation->get_list_mark();
			$data['sv_type'] 					= $this->m_quotation->get_list_services_type();

			$this->template->set('title', 'Klinik | Quotation');
			$this->template->load('template', 'menu/quotation_process', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi load form quotation
	function quotation()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$this->load->model('m_registration');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['userlevel'] 		= $session_data['userlevel'];
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['get_client']     = $this->m_quotation->get_mst_client_package_h();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			$data['get_sales']	    = $this->m_registration->get_sales_by_user();
			// $data['data'] 			= $this->m_quotation->get_list_services_all();
			$this->template->set('title', 'Klinik | Master Services Package');
			$this->template->load('template', 'menu/quotation_v2', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function quotation_process_v2()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$this->load->model('m_registration');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$p_client				= $this->input->post('p_client');
			$data['id_marketing']	= $this->input->post('mkd_id');
			$data['p_name']			= $this->input->post('p_name');
			// echo "1 - ".$p_client."<br/> 2 - ".$data['p_name'];
			// exit();

			$data['get_client']     		= $this->m_quotation->get_mst_client_package_h2($p_client);
			foreach ($data['get_client']->result() as $row) {
				$data['id_package'] 			= $row->id_package;
				$data['package_name'] 			= $row->package_name;
				$data['persen_margin'] 			= $row->persen_margin;
				$data['qty'] 					= $row->qty;
				$data['sell_price'] 			= $row->sell_price;
				$data['adjust'] 				= $row->adjust;
				$data['amount_total']			= $row->amount_total;
				$data['grand_total'] 			= $row->grand_total;
				$data['package_exp'] 			= $row->package_exp;
				$data['id_Client'] 				= $row->id_Client;
				$data['client_name'] 			= $row->client_name;
				$data['client_address1'] 		= $row->client_address1;
				$data['client_address2'] 		= $row->client_address2;
				$data['client_contact_name']	= $row->client_contact_name;
				$data['client_phone'] 			= $row->client_phone;
				$data['client_fax'] 			= $row->client_fax;
				$data['client_mobile'] 			= $row->client_mobile;
				$data['client_other'] 			= $row->client_other;
			}

			// $data['list_detail']    			= $this->m_quotation->get_list_service_package_detail($p_client);
			$data['list_detail']    			= $this->m_quotation->get_list_services_package2($p_client);
			$data['sv_group'] 					= $this->m_quotation->get_list_services_group();
			$data['sv_lab'] 					= $this->m_quotation->get_list_lab();
			$data['sv_rad'] 					= $this->m_quotation->get_list_rad();
			$data['sv_mark'] 					= $this->m_quotation->get_list_mark();
			$data['sv_type'] 					= $this->m_quotation->get_list_services_type();

			$this->template->set('title', 'Klinik | Quotation');
			$this->template->load('template', 'menu/quotation_process_v2', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}


	function save_qoutation_v2()
	{
		$this->load->model('m_master');
		$session_data 	= $this->session->userdata('logged_in');
		$user_id		= $session_data['id'];
		$rowC			= $this->input->post('rowcount');
		$kodeq 			= $this->input->post('1');
		$kodebuntut		= $this->input->post('2');
		// $bulanini		= $this->input->post('4');
		$bulanini		= date('m');
		$tahunini		= $this->input->post('5');
		$result 		= $this->input->post('p_client');
		$prs_margin 	= $this->input->post('adjs_amount');
		$package_name	= $this->input->post('package_name');
		$result_explode = explode('|', $result);
		$id_client 		= $result_explode[0];
		$name_client	= $result_explode[1];


		// Cek Number Qoutation...
		// $number 		= $this->m_master->get_number_param('qoutation_order');
		// $cek 			= $this->m_master->cek_sysparam('quotation_number');
		//       foreach ($cek->result() as $row) {
		//       	$id_sysp	= $row->id;
		//       	$sgroup		= $row->sgroup;
		//       	$skey		= (int)$row->skey + 1;
		// 	$svalue		= $row->svalue;
		// 	$lvalue		= $row->lvalue;
		//       }

		//       if ($svalue <> $bulanini) {$skey = 1;} //Jika bulannya berbeda maka harus diubah mejadi satu..

		// $data_update 		= array(
		// 	'skey'			=>$skey,
		// 	'svalue'		=>$bulanini,
		// 	'lvalue'		=>$tahunini,
		// );
		// $this->m_master->update_sysparam($id_sysp,$data_update);

		// echo $skey;
		// echo "</br>";
		// // echo $kodeq;
		// echo "</br>";

		// Create Number PR...
		$this->load->model('m_master');
		$number 				= $this->m_master->get_number_param('qoutation_order');
		$data['tahun'] 			= date('Y');
		$data['bulan'] 			= date('m');

		foreach ($number->result() as $row3) {
			$data['id_sysp']		= $row3->id;
			$data['sgroup']			= $row3->sgroup;
			$data['skey']			= (int)$row3->skey + 1;
			$data['svalue']			= (int)$row3->svalue;
			$data['lvalue']			= $row3->lvalue;
			$data['status']			= $row3->status;
			$data['created_time']	= $row3->created_time;
			$data['created_by']		= $row3->created_by;
			$data['updated_time']	= $row3->updated_time;
			$data['updated_by']		= $row3->updated_by;
			$data['remark']			= $row3->remark;
		}


		if ($data['svalue'] <> $data['bulan']) {
			$data['skey'] = 1;
		}

		$urutan 			= str_pad($data['skey'], 4, "0", STR_PAD_LEFT);

		$data_update 		= array(
			'skey'			=> $data['skey'],
			'svalue'		=> $data['bulan'],
			'lvalue'		=> $data['tahun'],
		);
		$this->load->model('m_master');
		$this->m_master->update_sysparam($data['id_sysp'], $data_update);
		// End Create Number PR...


		$gabung 		= $name_client{
			0} . "" . str_pad($id_client, 4, "0", STR_PAD_LEFT) . "/" . $package_name . "/" . $kodeq . "/" . $urutan;
		// $gabung 		= $name_client{0}."".str_pad($id_client, 4, "0", STR_PAD_LEFT)."/".$package_name."/".$kodeq."/".str_pad($skey, 4, "0", STR_PAD_LEFT);

		// echo $gabung; exit();

		// $config = Array(
		// 'protocol' => 'smtp',
		// 'smtp_host' => 'ssl://smtp.googlemail.com',
		// 'smtp_port' => 465,
		// 'smtp_user' => 'gojek.jktj2291@gmail.com',
		// 'smtp_pass' => 'Kampret123',
		// 'mailtype'  => 'html', 
		// 'charset'   => 'iso-8859-1'
		// );
		// $this->load->library('email', $config);
		// $this->email->set_newline("\r\n");


		// // Jika persen margin kurang dari 30 maka email ke direktur dan manager..
		// if ($prs_margin < 35) {
		// 	// $this->load->library('email');
		// 	$this->email->from('gojek.jktj2291@gmail.com', 'New Sistem');
		// 	$this->email->to('ranggapeni@gmail.com');
		// 	$this->email->subject('New Quotation');
		// 	$this->email->message('Testing the email manager.');
		// 	$this->email->send();
		// 	echo "krim email manager <br/>";
		// 	if ($prs_margin < 30) {

		// 		$this->email->from('gojek.jktj2291@gmail.com', 'New Sistem');
		// 		$this->email->to('ranggapeni@gmail.com');
		// 		// $this->email->cc('dudi@kyoai123.co.id');
		// 		// $this->email->bcc('rangga@kyoai123.co.id');

		// 		$this->email->subject('New Quotation');
		// 		$this->email->message('Testing the email direktur.');
		// 		$this->email->send();
		// 		echo "krim email direktur <br/>";


		// 	}
		// }
		// echo phpinfo();
		// exit();



		if ($rowC == "") {
			$rowC = "1";
		} else {
			$rowC = $rowC;
		}

		if ($this->input->post('2') == 1) {
			$nilainya	= $this->input->post('2');
		} else {
			$nilainya	= $this->input->post('2');
		}

		include './design/koneksi/file.php';
		$query 		= "SELECT id_quot id FROM mkt_quotation_h ORDER BY id_quot DESC LIMIT 1";
		if ($result 	= mysqli_query($con, $query)) {
			//$date	=date('ym');
			$row 	= mysqli_fetch_assoc($result);
			$count 	= $row['id'];
		}

		$data_quot 						= array(
			'quot_name'					=> $this->input->post('p_name'),
			'qout_id'					=> $gabung,
			'quot_revision'				=> 0,
			'is_finalised'				=> 1,
			'client_id'					=> $id_client,
			'qty_estimate'				=> $this->input->post('qty'),
			'margin'					=> $this->input->post('adjs_amount'),
			'quot_date_valid'			=> date("Y-m-d H:i:s", strtotime($this->input->post('v_exp'))),
			'quot_date_end'				=> date("Y-m-d H:i:s", strtotime($this->input->post('p_exp'))),
			'total_price'				=> str_replace(",", "", $this->input->post('amount_total')),
			'margin_amount'				=> str_replace(",", "", $this->input->post('adjs_nominal')),
			'grand_price'				=> str_replace(",", "", $this->input->post('peka')),
			'mkt_id'					=> $this->input->post('id_marketing'),
			'created_by'				=> $user_id,
			'created_date'				=> date("Y-m-d H:i:s"),

		);
		$this->load->model('m_quotation');
		$this->m_quotation->save_quot_h($data_quot);

		$q_filter 		= "SELECT *, MID(qout_id,5,3) asx FROM mkt_quotation_h where MID(qout_id,5,3)='" . str_pad($nilainya, 3, "0", STR_PAD_LEFT) . "' and revised='0' ORDER BY id_quot asc";
		//echo $q_filter ;
		if ($r_filter 	= mysqli_query($con, $q_filter)) {

			if (mysqli_num_rows($r_filter) > 0) {
				$nomer = 1;
				while ($row = $r_filter->fetch_assoc()) {
					if ($nomer == 1) {
						$angka = (int)$row['asx'];
					}
					$meledak = explode("/", $row['qout_id']);
					$boom	 = explode(".", $meledak[0]);
					//echo $boom[0];

					//echo (int)$row['asx'];
					//die();
					$sql_ubah = "update mkt_quotation_h set qout_id='" . $boom[0] . "." . str_pad($angka, 3, "0", STR_PAD_LEFT) . "/" . $meledak[1] . "/" . $meledak[2] . "/" . $meledak[3] . "' where id_quot='" . $row['id_quot'] . "' ";
					$this->db->query($sql_ubah);
					//echo $sql_ubah;
					//echo "</br>";
					$angka = (int)$row['asx'] + $nomer;
					$nomer = $nomer + 1;
					//echo $angka;
					//$this->db->query($sql_ubah);
				}
			}
		}
		//die();

		$final 			= "SELECT id_quot id FROM mkt_quotation_h ORDER BY id_quot DESC LIMIT 1";
		if ($resultx 	= mysqli_query($con, $final)) {
			//$date	=date('ym');
			$rowx 	= mysqli_fetch_assoc($resultx);
			$count 	= $rowx['id'];
		}

		for ($i = 1; $i <= $rowC; $i++) {
			$datas = "";
			$logic = "";

			if ($this->input->post('id_service[' . $i . ']') == "") {
				$datas = "0";
				$logic = "0";
			} else {
				$datas = $this->input->post('id_service[' . $i . ']');
				$logic = $this->input->post('service[' . $i . ']');
			}

			$aritmatika = "";
			if ($this->input->post('g_change_' . $i . '') == 2) {
				$aritmatika = $this->input->post('two_' . $i . '');
			} elseif ($this->input->post('g_change_' . $i . '') == 1) {
				$aritmatika = $this->input->post('one_' . $i . '');
			} elseif ($this->input->post('g_change_' . $i . '') == 0 || $this->input->post('g_change_' . $i . '') == 3) {
				//die();
				$aritmatika = $this->input->post('three_' . $i . '');
			}

			echo $this->input->post('g_change_' . $i . '');
			//	die();
			$sql = "INSERT INTO mkt_quotation_d (notes_service, id_quot_header, group_service, group_header, group_mark, service_id, service_other, seq_no, service_price, service_tax, before_tax) VALUES ('" . $this->input->post('notes_services_' . $i . '') . "', '" . $count . "', '" . $this->input->post('g_change_' . $i . '') . "', '" . rtrim($aritmatika) . "', '" . $this->input->post('mark_' . $i . '') . "', '" . $datas . "', '" . $logic . "', '" . $this->input->post('orderid[' . $i . ']') . "', '" . str_replace(",", "", $this->input->post('price[' . $i . ']')) . "', '" . $this->input->post('ck_' . $i . '') . "', '" . $this->input->post('bf_t_' . $i . '') . "' )";
			//echo $sql;
			//die();
			$this->db->query($sql);
		}
		//die();


		//Create Log Start
		$session_data 		= $this->session->userdata('logged_in');
		$user_id			= $session_data['id'];
		$data_log 			= array(
			'id_user'			=> $user_id,
			'log_date'			=> date("Y-m-d H:i:s"),
			'log_desc'			=> "Create Quotation, Package Name : " . $package_name,
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);


		redirect('marketing/quotation/ok');
	}

	function list_group_items()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$this->load->model('m_registration');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['data']	 		= $this->m_quotation->get_list_group();
			$this->template->set('title', 'Klinik | List Group Items');
			$this->template->load('template', 'menu/list_group_items', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi load form quotation
	function order_form()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$this->load->model('m_registration');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['sv_lab'] 		= $this->m_quotation->get_list_lab();
			$data['sv_rad'] 		= $this->m_quotation->get_list_rad();
			$data['sv_mark'] 		= $this->m_quotation->get_list_mark();
			$data['get_client']     = $this->m_registration->get_mst_client();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			$this->template->set('title', 'Klinik | Order Form');
			$this->template->load('template', 'menu/order_form', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi load form quotation
	function sales_contract()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$this->load->model('m_registration');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['get_client']     = $this->m_registration->get_mst_client();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			$this->template->set('title', 'Klinik | Sales Contract');
			$this->template->load('template', 'menu/sales_contract', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi simpan master currency
	function update_sc()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$id			 			= $this->uri->segment(3);
		$sql = "update mkt_sales_contract set dates_loc='" . $this->input->post('dates') . "',attn_name='" . $this->input->post('pic_name') . "',attn_tlp='" . $this->input->post('pic_telp') . "',attn_mobile='" . $this->input->post('pic_hp') . "',attn_email='" . $this->input->post('pic_email') . "',message='" . $this->input->post('message_m') . "' where id_sc='" . $id . "' ";
		$this->db->query($sql);

		echo "<script> alert('Success updated !'); window.close(this);</script>";
	}

	//fungsi load form quotation
	function update_sales_contract()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$this->load->model('m_registration');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$id			 			= $this->uri->segment(3);
			$data['data'] 			= $this->m_quotation->get_data_update_sc($id);
			$this->template->set('title', 'Klinik | Update Sales Contract');
			$this->template->load('template', 'menu/update_sales_contract', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi simpan quotation
	function save_quot()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$rowC					= $this->input->post('rowcount');
		$data_quot 			= array(
			'mkt_id'			=> $user_id,
			'quot_code' 		=> $this->input->post('quot_code'),
			'quot_date_create'  => date("Y-m-d", strtotime($this->input->post('quot_date_create'))),
			'quot_date_end' 	=> date("Y-m-d", strtotime($this->input->post('quot_date_end'))),
			'quot_version' 		=> 0,
			'client_id' 		=> $this->input->post('client_id'),
			'is_finalised'		=> 1,
		);
		$this->load->model('m_quotation');
		$this->m_quotation->save_quot_h($data_quot);

		for ($i = 1; $i <= $rowC; $i++) {
			$sql = "INSERT INTO mkt_quotation_d (service_id, service_price, id_quot_header, seq_no) VALUES ('" . $this->input->post('id[' . $i . ']') . "', '" . $this->input->post('price[' . $i . ']') . "', '" . $this->input->post('quot_code') . "', '" . $this->input->post('seq[' . $i . ']') . "')";
			$this->db->query($sql);
			//echo $this->db->affected_rows();
		}
		redirect('marketing/quotation/ok');
	}
	//fungsi mencari medical services
	function find_services()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$id			 			= $this->uri->segment(3);
			$data['find'] 			= $this->m_quotation->get_list_services_2($id);
			$this->template->set('title', 'Klinik | Find Services');
			$this->template->load('template', 'menu/find_services', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function find_services_q()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$id			 			= $this->uri->segment(4);
			$aa			 			= $this->uri->segment(5);
			if ($id == 1 && $aa > 0) {
				$data['find'] 			= $this->m_quotation->get_list_services_lab_q($id, $aa);
				// echo "1";
			} elseif ($id == 2) {
				$data['find'] 			= $this->m_quotation->get_list_services_rad_q($id, $aa);
				// echo "2";
			} else {
				$data['find'] 			= $this->m_quotation->get_list_services2();
				// $data['find'] 			= $this->m_quotation->get_list_services($id);
				// echo "3";
			}
			$this->template->set('title', 'Klinik | Find Services');
			$this->template->load('template', 'menu/find_s_q', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function find_lab()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$id			 			= $this->uri->segment(3);
			$data['find'] 			= $this->m_quotation->get_list_services($id);
			$this->template->set('title', 'Klinik | Find Services');
			$this->template->load('template', 'menu/find_lab_2', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function find_lab_group()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$id			 			= $this->uri->segment(3);
			$data['find'] 			= $this->m_quotation->get_list_services_lab_group();
			$this->template->set('title', 'Klinik | Find Services Lab');
			$this->template->load('template', 'menu/find_lab_group', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function find_servicesn()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['id']	 			= $this->uri->segment(4);
			$data['find'] 			= $this->m_quotation->get_list_services2();
			// $data['find'] 			= $this->m_quotation->get_list_services($data['id']);
			// $data['find'] 			= $this->m_quotation->get_list_services_alln();
			$this->template->set('title', 'Klinik | Find Services');
			$this->template->load('template', 'menu/find_services', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi mencari medical services
	function find_quotation()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$id						= $session_data['id'];
			$data['username'] 		= $session_data['username'];
			$data['find'] 			= $this->m_quotation->get_quotation($id);
			$this->template->set('title', 'Klinik | Find Quotation');
			$this->template->load('template', 'menu/find_quotation', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi mencari medical services
	function find_services_quot()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$id			 			= $this->uri->segment(4);
			$data['find'] 			= $this->m_quotation->get_list_services($id);
			$this->template->set('title', 'Klinik | Find Services');
			$this->template->load('template', 'menu/find_services_quot', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi converter currency
	function mst_currency()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['now']			= date("Y-m-d H:i:s");
			$data['data'] 			= $this->m_quotation->get_data_currency();
			$skrg 					= $this->m_quotation->get_data_currency_now();
			$data['tanggal']		= date("m/d/Y");
			$data['id_currency']	= 0;
			$data['amount']			= 0;
			$data['code']			= 0;
			$data['create_by']		= 0;
			$data['create_date']	= 0;

			foreach ($skrg->result() as $row) {
				$data['id_currency']	= $row->id_currency;
				$data['code']			= $row->code;
				$data['amount']			= $row->amount;
				$data['create_by']		= $row->create_by;
				$data['create_date']	= $row->create_date;
			}

			$this->template->set('title', 'Klinik | Currency');
			$this->template->load('template', 'menu/mst_currency2', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi converter currency
	function mst_currency_excel()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['now']			= date("Y-m-d H:i:s");
			$data['data'] 			= $this->m_quotation->get_data_currency();
			$skrg 					= $this->m_quotation->get_data_currency_now();
			$data['tanggal']		= date("m/d/Y");
			$data['id_currency']	= 0;
			$data['amount']			= 0;
			$data['code']			= 0;
			$data['create_by']		= 0;
			$data['create_date']	= 0;

			foreach ($skrg->result() as $row) {
				$data['id_currency']	= $row->id_currency;
				$data['code']			= $row->code;
				$data['amount']			= $row->amount;
				$data['create_by']		= $row->create_by;
				$data['create_date']	= $row->create_date;
			}

			$this->load->view('menu/mst_currency_excel', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function update_mst_currency()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['username'] 		= $session_data['id'];
			$data['id_currency']	= $this->uri->segment(3);
			$data['now']			= date("Y-m-d H:i:s");
			$data['tanggal']		= date("m/d/Y");
			$list 					= $this->m_quotation->get_data_currency_id($data['id_currency']);

			foreach ($list->result() as $row) {
				$data['code']			= $row->code;
				$data['amount']			= $row->amount;
				$data['create_by']		= $row->create_by;
				$data['create_date']	= date("m/d/Y", strtotime($row->create_date));
			}

			$this->template->set('title', 'Klinik | Currency');
			$this->template->load('template', 'menu/update_mst_currency', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function proses_update_mst_currency()
	{
		$this->load->model('m_quotation');
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data['now']			= date("Y-m-d H:i:s");
		$id_currency			= $this->input->post('id_currency');
		$tanggal				= date("Y-m-d H:i:s", strtotime($this->input->post("tanggal")));
		$nilai 					= $this->input->post('nilai');
		$tipe					= $this->input->post('tipe');

		$data_update 		= array(
			'code' 			=> $tipe,
			'amount' 		=> $nilai,
			'update_by' 	=> $user_id,
		);
		$this->m_quotation->update_mst_currency($id_currency, $data_update);

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_log = array(
			'id_user'			=> $user_id,
			'log_date'			=> $data['now'],
			'log_desc' 			=> "Update master currency, ID : " . $id_currency . "",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log

		echo "<script>window.close(this); window.onunload = refreshParent; function refreshParent() { window.opener.location.assign('mst_currency/change'); }</script>";
	}

	function save_s_package()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$now					= date("Y-m-d H:i:s");
			$nama_paket				= $this->input->post('p_name');
			$id_client				= $this->input->post('p_client');
			$qty					= $this->input->post('qty');
			$seq					= $this->input->post('seq');
			$service				= $this->input->post('service');
			$id_service				= $this->input->post('id_service');
			$fulus					= $this->input->post('fulus');
			$orderid				= $this->input->post('orderid');
			$orderty				= $this->input->post('orderty');
			$group					= $this->input->post('group');
			$adjs_amount			= $this->input->post('adjs_amount');
			$rowcount				= $this->input->post('rowcount');
			$amount_total			= str_replace(",", "", $this->input->post('amount_total')); //menghilangkan coma agar bisa masuk database
			$adjs_nominal			= str_replace(",", "", $this->input->post('adjs_nominal')); //menghilangkan coma agar bisa masuk database
			$sell_price				= str_replace(",", "", $this->input->post('sell_price')); //menghilangkan coma agar bisa masuk database
			$grand_total			= str_replace(",", "", $this->input->post('egi')); //menghilangkan coma agar bisa masuk database
			$cekdoubledata 			= $this->m_quotation->get_mst_service_package_h2($id_client, $nama_paket);
			$jmldoubledata			= $cekdoubledata->num_rows();

			if ($jmldoubledata > 0) {
				echo "<script> alert('Data Already Exists!'); window.history.back();</script>";
			} else {

				$data_header 			= array(
					'id_client' 		=> $id_client,
					'package_name' 		=> $nama_paket,
					'qty'				=> $qty,
					'persen_margin'		=> $adjs_amount,
					'sell_price'		=> $sell_price,
					'adjust' 			=> $adjs_nominal,
					'amount_total'		=> $amount_total,
					'grand_total'		=> $grand_total,
					'create_by'			=> $user_id,
				);
				$this->m_quotation->save_mst_p_h($data_header);

				$cekjmldata 			= $this->m_quotation->get_max_id_package();
				foreach ($cekjmldata->result() as $row) {
					$id_package_header 		= $row->id_package;
				}

				for ($i = 1; $i <= $rowcount; $i++) {
					// mencegah error karena null..
					if ($group[$i] == "") {
						$group[$i] = "Administration";
					}
					if ($orderty[$i] == "") {
						$orderty[$i] = 4;
					}
					if ($orderid[$i] == "") {
						$orderid[$i] = 0;
					}
					if ($id_service[$i] == "") {
						$id_service[$i] = 0;
					}
					if ($seq[$i] == "") {
						$seq[$i] = 0;
					}

					//insert detail...
					$data_detail 			= array(
						'id_package_header' => $id_package_header,
						'id_service' 		=> $id_service[$i],
						'seq_no'			=> $seq[$i],
						'order_id' 			=> $orderid[$i],
						'order_type'		=> $orderty[$i],
						'service_name' 		=> $service[$i],
						'group_name' 		=> $group[$i],
						'price'				=> $fulus[$i],
					);
					$this->m_quotation->save_mst_p_d($data_detail);
				}


				//Create Log Start
				$session_data 			= $this->session->userdata('logged_in');
				$user_id				= $session_data['id'];
				$data_log = array(
					'id_user'			=> $user_id,
					'log_date'			=> $now,
					'log_desc' 			=> "Insert master package, name : " . $nama_paket . "",
				);
				$this->load->model('m_login');
				$this->m_login->log($data_log);
				//Endless Log

				redirect('marketing/mst_service_package/ok');
			}
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function save_mst_currency()
	{
		$this->load->model('m_quotation');
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data['now']			= date("Y-m-d H:i:s");
		$id_currency			= $this->input->post('id_currency');
		$tanggal				= date("Y-m-d H:i:s", strtotime($this->input->post("tanggal")));
		$nilai 					= $this->input->post('nilai');
		$tipe					= $this->input->post('tipe');

		if ($id_currency == 0) {
			$data_insert 		= array(
				'code' 			=> $tipe,
				'amount' 		=> $nilai,
				'create_by' 	=> $user_id,
			);
			$this->m_quotation->save_mst_currency($data_insert);

			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data_log = array(
				'id_user'			=> $user_id,
				'log_date'			=> $data['now'],
				'log_desc' 			=> "Insert master currency, date : " . $tanggal . "",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log

		} else {
			$data_update 		= array(
				'code' 			=> $tipe,
				'amount' 		=> $nilai,
				'update_by' 	=> $user_id,
			);
			$this->m_quotation->update_mst_currency($id_currency, $data_update);

			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data_log = array(
				'id_user'			=> $user_id,
				'log_date'			=> $data['now'],
				'log_desc' 			=> "Update master currency, ID : " . $id_currency . "",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
		}

		redirect('marketing/mst_currency/ok');
	}

	function delete_currency()
	{

		$id						= $this->uri->segment(3);
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];

		// Update status
		$data_delete			= array(
			'is_active'				=> 1,
			'update_by' 			=> $user_id,
		);
		$this->load->model('m_quotation');
		$this->m_quotation->delete_currency($id, $data_delete);
		// End Update 

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_log 				= array(
			'id_user'				=> $user_id,
			'log_date'				=> date("Y-m-d H:i:s"),
			'log_desc' 				=> "Delete Currency, id : " . $id . " , Delete By " . $user_id,
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log


		redirect('marketing/mst_currency/del');
	}

	//fungsi converter currency
	function mst_currency_old()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['data'] 			= $this->m_quotation->get_data_currency();
			$this->template->set('title', 'Klinik | Currency');
			$this->template->load('template', 'menu/mst_currency', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi daftar list service
	function list_service()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['userlevel'] 		= $session_data['userlevel'];
			$data['find'] 			= $this->m_quotation->get_list_services_all();
			$this->template->set('title', 'Klinik | list Services');
			$this->template->load('template', 'menu/list_service', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function list_service_price()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['pilter']			= 0;
			$hapus_data 			= $this->m_quotation->tr_tmp_mst_service_price();
			$copy_data	 			= $this->m_quotation->copy_data_tmp_service_price();
			$data['find'] 			= $this->m_quotation->group_tmp_service_price();
			$data['total'] 			= $this->m_quotation->get_list_jml_tmpserviceprice();
			$this->template->set('title', 'Klinik | list Services');
			$this->template->load('template', 'menu/list_service_price', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function list_service_price_filter()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$jml 					= $this->input->post('pilter');
			$data['pilter']			= $this->input->post('pilter');
			$hapus_data 			= $this->m_quotation->tr_tmp_mst_service_price();
			$copy_data	 			= $this->m_quotation->copy_data_tmp_service_price();
			$data['find'] 			= $this->m_quotation->group_tmp_service_price2($jml);
			$data['total'] 			= $this->m_quotation->get_list_jml_tmpserviceprice();
			$this->template->set('title', 'Klinik | list Services');
			$this->template->load('template', 'menu/list_service_price', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function list_service_price_process()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$id 					= $this->uri->segment(3);
			$group 					= $this->uri->segment(4);
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			// $hapus_data 			= $this->m_quotation->tr_tmp_mst_service_price();
			// $copy_data	 			= $this->m_quotation->copy_data_tmp_service_price();
			$data['find'] 			= $this->m_quotation->get_list_tmp_service_price($id, $group);

			foreach ($data['find']->result() as $row) {
				$data['id_group']		= $row->id_group;
				$data['group_name']		= $row->group_name;
				$data['serv_name']		= $row->serv_name;
				$data['order_id']		= $row->order_id;
				$data['id_service']		= $row->id_service;
				$data['serv_seq_no']	= $row->serv_seq_no;
				$data['ket']			= $row->ket;
				$data['price']			= $row->price;
				$data['id_price_type']	= $row->id_price_type;
				$data['price_type']		= $row->price_type;
				$data['order_type']		= $row->order_type;
				$data['currency']		= $row->currency;
			}

			$this->template->set('title', 'Klinik | list Services');
			$this->template->load('template', 'menu/list_service_price_process', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function list_service_excel()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['data'] 			= $this->m_quotation->get_list_services_all();
			$this->load->view('menu/list_service_excel', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi load form Master Services
	function mst_service()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$this->load->model('m_inv');

			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['accno']			= $this->m_inv->get_list_coa();
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			$data['pay_type'] 		= $this->m_quotation->get_type();
			$data['branch'] 		= $this->m_quotation->get_branch();
			$data['find'] 			= $this->m_quotation->get_list_services_all();
			$this->template->set('title', 'Klinik | Master Services');
			$this->template->load('template', 'menu/mst_service', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}


	//fungsi load form add service price
	function insert_service_price()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['userid'] 		= $session_data['id'];
			$now					= date("Y-m-d H:i:s");
			$hrg					= str_replace(",", "", $this->input->post('price_1'));


			// ------- INSERT DATA SERVICE PRICE ------- 
			$data_service 				= array(
				'id_service'			=> $this->input->post('id_service'),
				'price_type' 			=> $this->input->post('type_1'),
				'price'					=> $hrg,
				'currency'				=> $this->input->post('curr_type_1'),
				'id_branch'				=> $this->input->post('branch'),
				'create_date'			=> $now,
			);
			$this->load->model('m_quotation');
			$this->m_quotation->save_mst_service_price($data_service);
			// ------- BATAS INSERT DATA SERVICE PRICE ------- 

			// ------- Create Log Start -------
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data_log = array(
				'id_user'						=> $user_id,
				'log_date'						=> date("Y-m-d"),
				'log_desc' 						=> "Add Service Price, With id service : " . $this->input->post('id_service') . "",
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			// ------- Endless Log -------

			// ------- Singkron data temporary -------
			$hapus_data 			= $this->m_quotation->tr_tmp_mst_service_price();
			$copy_data	 			= $this->m_quotation->copy_data_tmp_service_price();
			// ------- Batas Singkron data temporary -------

			// ------- Untuk Close popup reload parent -------
			echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
			// ------- Batas Close popup reload parent -------


		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi load form add service price
	function add_service_price()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$data['id_service']		= $this->uri->segment(3);
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['userid'] 		= $session_data['id'];
			$get_service			= $this->m_quotation->get_service_join_group($data['id_service']);
			foreach ($get_service->result() as $row1) {
				$data['id_group_serv']	= $row1->id_group_serv;
				$data['order_type']		= $row1->order_type;
				$data['order_id']		= $row1->order_id;
				$data['serv_name']		= $row1->serv_name;
				$data['serv_type']		= $row1->serv_type;
				$data['serv_code']		= $row1->serv_code;
				$data['group_desc']		= $row1->group_desc;
				$data['group_seq_no']	= $row1->group_seq_no;
			}
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			$data['pay_type'] 		= $this->m_quotation->get_type();
			$data['branch'] 		= $this->m_quotation->get_branch();
			$data['find'] 			= $this->m_quotation->get_list_services_all();
			$this->template->set('title', 'Klinik | Master Services');
			$this->template->load('template', 'menu/add_service_price', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function mst_service_excel()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			$data['pay_type'] 		= $this->m_quotation->get_type();
			$data['branch'] 		= $this->m_quotation->get_branch();
			$data['find'] 			= $this->m_quotation->get_list_services_all();
			$this->load->view('menu/mst_service_excel', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi simpan master service
	function save_mst_service()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$split			 		= explode(":", $this->input->post('grp_services'));
		$rowC					= $this->input->post('count_ant');

		if ($rowC == "") {
			$rowC = "1";
		} else {
			$rowC = $rowC;
		}

		$data_service 				= array(
			'id_group_serv'			=> $split[0],
			'serv_seq_no' 			=> $split[1],
			'serv_name'				=> $this->input->post('serv_name'),
			'order_id'				=> $this->input->post('serv_id'),
			'serv_code'				=> $this->input->post('serv_code'),
			'order_type' 			=> $this->input->post('serv_typ'),
			'coa' 					=> $this->input->post('i_coa'),
		);
		$this->load->model('m_quotation');
		$this->m_quotation->save_mst_service($data_service);

		include './design/koneksi/file.php';
		$query 		= "SELECT id_service id FROM mst_services ORDER BY id_service DESC LIMIT 1";
		if ($result 	= mysqli_query($con, $query)) {
			//$date	=date('ym');
			$row 	= mysqli_fetch_assoc($result);
			$count 	= $row['id'];
		}


		if (str_replace(",", "", $this->input->post('price_2')) == "0.00") {
			$nilai = str_replace(",", "", $this->input->post('price_2'));
		} else {
			$nilai = str_replace(",", "", $this->input->post('price_2'));
		}

		$sql = "INSERT INTO mst_service_price (id_service, price_type, price, currency, id_branch) VALUES ('" . $count . "', '" . $this->input->post('type_1') . "', '" . $nilai . "', '" . $this->input->post('curr_type_1') . "', '" . $this->input->post('branch') . "')";
		$this->db->query($sql);


		// for($i=1; $i<=5; $i++){

		// if(str_replace(",","",$this->input->post('price_'.$i.''))=="0.00"){
		// 	$nilai = str_replace(",","",$this->input->post('price_'.$i.''));
		// }else{
		// 	$nilai = str_replace(",","",$this->input->post('price_'.$i.''));
		// }

		// $sql = "INSERT INTO mst_service_price (id_service, price_type, price, currency, id_branch) VALUES ('".$count."', '".$this->input->post('type_'.$i.'')."', '".$nilai."', '".$this->input->post('curr_type_'.$i.'')."', '".$this->input->post('branch')."')";

		// if(str_replace(",","",$this->input->post('price_'.$i.''))=="0.00"){
		// 	}else{
		// 			$this->db->query($sql);
		// 	}
		// }

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_log = array(
			'id_user'						=> $user_id,
			'log_date'						=> date("Y-m-d"),
			'log_desc' 						=> "Create Master Service Price : " . $this->input->post('serv_name') . "",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log
		redirect('marketing/mst_service/');
	}

	function delete_service()
	{

		$this->load->model('m_inv');

		$id_price				= $this->uri->segment(3);
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];

		// Update status
		$data_delete			= array(
			'is_active'				=> 1,
		);
		$this->load->model('m_quotation');
		$this->m_inv->delete_service_price($id_price, $data_delete);
		// End Update 

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_log 				= array(
			'id_user'				=> $user_id,
			'log_date'				=> date("Y-m-d H:i:s"),
			'log_desc' 				=> "Delete Service Price, id : " . $id_price . " , Delete By " . $user_id,
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log

		echo "<script>window.history.back(); location.reload();</script>";

		// header("location:javascript://history.go(-1)");
		// redirect('marketing/mst_service/del');
	}

	function delete_service2()
	{

		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_inv');

			$id_price				= $this->uri->segment(3);
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];

			// Update status
			$data_delete			= array(
				'is_active'				=> 1,
			);
			$this->load->model('m_quotation');
			$this->m_inv->delete_service_price($id_price, $data_delete);
			// End Update 

			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data_log 				= array(
				'id_user'				=> $user_id,
				'log_date'				=> date("Y-m-d H:i:s"),
				'log_desc' 				=> "Delete Service Price, id : " . $id_price . " , Delete By " . $user_id,
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi load form Master Services
	function update_mst_service()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$data['id_price']		= $this->uri->segment(3);
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['userid'] 		= $session_data['id'];

			$get_service_price		= $this->m_quotation->get_service_price($data['id_price']);
			foreach ($get_service_price->result() as $row) {
				$id_service				= $row->id_service;
				$data['id_branch']		= $row->id_branch;
				$data['currency']		= $row->Currency;
				$data['price']			= $row->Price;
				$data['price_type']		= $row->price_type;
				$data['code_service']	= $row->code_service;
			}

			$get_service			= $this->m_quotation->get_service($id_service);
			foreach ($get_service->result() as $row1) {
				$data['id_group_serv']	= $row1->id_group_serv;
				$data['id_service']		= $row1->id_service;
				$data['order_type']		= $row1->order_type;
				$data['order_id']		= $row1->order_id;
				$data['serv_name']		= $row1->serv_name;
				$data['serv_type']		= $row1->serv_type;
				$data['serv_code']		= $row1->serv_code;
			}
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			$data['pay_type'] 		= $this->m_quotation->get_type();
			$data['branch'] 		= $this->m_quotation->get_branch();
			$data['find'] 			= $this->m_quotation->get_list_services_all();
			$this->template->set('title', 'Klinik | Master Services');
			$this->template->load('template', 'menu/update_mst_service', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	public function process_update_mst_service()
	{

		// echo '<pre>' . print_r($this->input->post(), 1) . '</pre>';
		// exit;

		$this->load->model('m_quotation');

		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$now					= date("Y-m-d H:i:s");
		$id_price				= $this->input->post('id_price');
		$serv_code				= $this->input->post('serv_code');
		$hrg					= str_replace(",", "", $this->input->post('price_2'));
		$serv_name				= $this->input->post('serv_name');
		$master_price			= $this->m_quotation->get_service_price($id_price);
		$temp_price				= $this->m_quotation->get_service_price_temp($id_price);
		$temp_jml 				= $temp_price->num_rows();

		foreach ($master_price->result() as $row) {
			$id_service			= $row->id_service;
			$id_branch			= $row->id_branch;
			$price_type			= $row->price_type;
			$Currency			= $row->Currency;
			$Price				= $row->Price;
		}

		//Cek Ip / cara membuat ip
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		//End Cek Ip

		//Update Harga pada table mst_service_price
		$data_update 		= array(
			'id_service' 	=> $id_service,
			'id_branch' 	=> $id_branch,
			'price_type' 	=> $price_type,
			'Currency' 		=> $Currency,
			'Price' 		=> $hrg,
			'code_service'	=> $serv_code,
		);
		$this->m_quotation->delete_service_price($id_price, $data_update);

		$data  = ['serv_name'  => $serv_name];
		$where = ['id_service' => $id_service];
		$exec = $this->m_quotation->update_mst_service($data, $where);

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_log = array(
			'id_user'			=> $user_id,
			'log_date'			=> $now,
			'log_desc' 			=> "Update Service Price " . $serv_name . " and id service " . $id_service . " Price from : " . $Price . " To : " . $hrg,
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log

		//Create Log Price Start
		$now			= date("Y-m-d H:i:s");
		$data_log_price = array(
			'id_price' 			=> $id_price,
			'id_service' 		=> $id_service,
			'type_price' 		=> $price_type,
			'price_old' 		=> $Price,
			'price_new' 		=> $hrg,
			'ip' 				=> $ip,
			'created_date'		=> $now,
			'created_by'		=> $user_id,
			'is_active'			=> 0,
		);
		$this->load->model('m_cashier');
		$this->m_cashier->insert_log_price($data_log_price);
		//Endless Log Price

		echo "<script>window.close(this); </script>";
		// echo "<script>alert('Success update !!');window.close(this); </script>";

	}

	function process_update_mst_service_old()
	{

		$this->load->model('m_quotation');

		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$now					= date("Y-m-d H:i:s");
		$id_price				= $this->input->post('id_price');
		$hrg					= str_replace(",", "", $this->input->post('price_1'));
		$serv_name				= $this->input->post('serv_name');
		$master_price			= $this->m_quotation->get_service_price($id_price);
		$temp_price				= $this->m_quotation->get_service_price_temp($id_price);
		$temp_jml 				= $temp_price->num_rows();

		foreach ($master_price->result() as $row) {
			$id_service			= $row->id_service;
			$id_branch			= $row->id_branch;
			$price_type			= $row->price_type;
			$Currency			= $row->Currency;
			$Price				= $row->Price;
		}

		if ($temp_jml == 0) {

			$data_insert 		= array(
				'source' 		=> $id_price,
				'id_service' 	=> $id_service,
				'id_branch' 	=> $id_branch,
				'price_type' 	=> $price_type,
				'Currency' 		=> $Currency,
				'Price' 		=> $hrg,
			);
			$this->m_quotation->save_mst_service_price_temp($data_insert);

			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data_log = array(
				'id_user'			=> $user_id,
				'log_date'			=> $now,
				'log_desc' 			=> "Insert Service Price Temp " . $serv_name . " and id service " . $id_service . " To : " . $hrg,
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log

		} else {

			$data_update 		= array(
				'source' 		=> $id_price,
				'id_service' 	=> $id_service,
				'id_branch' 	=> $id_branch,
				'price_type' 	=> $price_type,
				'Currency' 		=> $Currency,
				'Price' 		=> $hrg,
			);
			$this->m_quotation->update_mst_service_price_temp($id_price, $data_update);


			$data_update 		= array(
				'id_service' 	=> $id_service,
				'id_branch' 	=> $id_branch,
				'price_type' 	=> $price_type,
				'Currency' 		=> $Currency,
				'Price' 		=> $hrg,
			);
			$this->m_quotation->delete_service_price($id_price, $data_update);


			//Create Log Start
			$session_data 			= $this->session->userdata('logged_in');
			$user_id				= $session_data['id'];
			$data_log = array(
				'id_user'			=> $user_id,
				'log_date'			=> $now,
				'log_desc' 			=> "Update Service Price Temp " . $serv_name . " and id service " . $id_service . " Price from : " . $Price . " To : " . $hrg,
			);
			$this->load->model('m_login');
			$this->m_login->log($data_log);
			//Endless Log
		}

		//Cek Ip / cara membuat ip
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		//End Cek Ip

		//Create Log Price Start
		$now		= date("Y-m-d H:i:s");
		$data_log_price = array(
			'id_price' 			=> $id_price,
			'id_service' 		=> $id_service,
			'type_price' 		=> $price_type,
			'price_old' 		=> $Price,
			'price_new' 		=> $hrg,
			'ip' 				=> $ip,
			'created_date'		=> $now,
			'created_by'		=> $user_id,
			'is_active'			=> 0,
		);
		$this->load->model('m_cashier');
		$this->m_cashier->insert_log_price($data_log_price);
		//Endless Log Price

		echo "<script>alert('Success update !!');window.close(this); </script>";
	}

	//fungsi load form Master Services Package
	function mst_service_package()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$this->load->model('m_registration');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['get_client']     = $this->m_registration->get_mst_client();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			// $data['data'] 			= $this->m_quotation->get_list_services_all();
			$this->template->set('title', 'Klinik | Master Services Package');
			$this->template->load('template', 'menu/mst_service_package', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function mst_grouping_items()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$this->load->model('m_registration');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['get_client']     = $this->m_registration->get_mst_client();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			// $data['data'] 			= $this->m_quotation->get_list_services_all();
			$this->template->set('title', 'Klinik | Grouping Items');
			$this->template->load('template', 'menu/mst_grouping_items', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi simpan master currency
	function save_curr()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$rowC					= $this->input->post('count_ant');

		if ($rowC == "") {
			$rowC = "1";
		} else {
			$rowC = $rowC;
		}

		for ($i = 1; $i <= $rowC; $i++) {
			if ($this->input->post('price_' . $i . '') != $this->input->post('cocok_' . $i . '')) {
				$sql = "update mst_currency set amount='" . str_replace(",", "", $this->input->post('price_' . $i . '')) . "',create_by='" . $user_id . "',updated_date='" . date("Y-m-d H:i:s") . "' where id_currency='" . $this->input->post('id_' . $i . '') . "' ";
				$this->db->query($sql);
			}
		}
		//die();
		echo "<script> alert('Success updated !'); window.close(this);</script>";
	}
	//fungsi simpan master package
	function save_items_group()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$rowC					= $this->input->post('rowcount');

		if ($rowC == "") {
			$rowC = "1";
		} else {
			$rowC = $rowC;
		}
		$nama = array();
		for ($i = 1; $i <= $rowC; $i++) {
			$nama = $this->input->post('service[]');
		}
		$gabung = join(" + ", $nama);

		include './design/koneksi/file.php';
		$query 		= "SELECT id FROM mst_group_service_h ORDER BY id DESC LIMIT 1";
		if ($result 	= mysqli_query($con, $query)) {
			$date	= date('ym');
			$row 	= mysqli_fetch_assoc($result);
			$count 	= $row['id'] + 1;
		}


		$data_pack 			= array(
			'name_service'				=> $gabung,
			'create_by'					=> $user_id,
			'base_price'				=> str_replace(",", "", $this->input->post('base_price')),
			'normal_price'				=> str_replace(",", "", $this->input->post('normal_local')),
			'insurance_price'			=> str_replace(",", "", $this->input->post('insurance_japan')),
			'company_price'				=> str_replace(",", "", $this->input->post('company_japan')),
		);
		$this->load->model('m_quotation');
		$this->m_quotation->save_mst_g_service_h($data_pack);

		// die();

		for ($i = 1; $i <= $rowC; $i++) {
			$sql = "INSERT INTO mst_group_service_d (id_header, id_service, id_group_service) VALUES ('" . $count . "', '" . $this->input->post('id_service[' . $i . ']') . "', '" . $this->input->post('group[' . $i . ']') . "')";
			//echo $sql;
			//die();
			$this->db->query($sql);
		}
		//die();
		redirect('marketing/mst_grouping_items/ok');
	}
	//fungsi quotation
	function save_order_form()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		include './design/koneksi/file.php';
		$query 		= "SELECT id_order_form id FROM mkt_order_form_h ORDER BY quot_id DESC LIMIT 1";
		if ($result 	= mysqli_query($con, $query)) {
			$row 	= mysqli_fetch_assoc($result);
			$count 	= $row['id'] + 1;
		}

		$data_quot 						= array(
			'of_code'					=> $this->input->post('p_name'),
			'quot_id'					=> $this->input->post('idx'),
			'mkt_id'					=> $user_id,
			'of_status'					=> 1,
			'of_attn_name'				=> $this->input->post('pic_name'),
			'of_attn_name_2'			=> $this->input->post('pic_name_2'),
			'of_attn_telp'				=> $this->input->post('pic_telp'),
			'of_attn_telp_2'			=> $this->input->post('pic_telp_2'),
			'of_attn_hp'				=> $this->input->post('pic_hp'),
			'of_attn_hp_2'				=> $this->input->post('pic_hp_2'),
			'of_attn_email'				=> $this->input->post('pic_email'),
			'of_attn_email_2'			=> $this->input->post('pic_email_2'),
			'of_quantity'				=> $this->input->post('qty'),
		);
		$this->load->model('m_quotation');
		$this->m_quotation->save_order_h($data_quot);


		$sql = "INSERT INTO mkt_order_form_d (of_header_id, of_type, of_remark) VALUES ('" . $count . "', '1', '" . $this->input->post('r_o') . "')";
		$this->db->query($sql);

		$sql1 = "INSERT INTO mkt_order_form_d (of_header_id, of_type, of_remark) VALUES ('" . $count . "', '2', '" . $this->input->post('r_f') . "')";
		$this->db->query($sql1);
		redirect('marketing/order_form/ok');
	}
	//fungsi quotation
	function save_sales_contract()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];

		$data_quot 						= array(
			'dates_loc'				=> $this->input->post('dates'),
			'id_quot'					=> $this->input->post('idx'),
			'id_mkt'					=> $user_id,
			'status'					=> 1,
			'attn_name'					=> $this->input->post('pic_name'),
			'attn_tlp'					=> $this->input->post('pic_telp'),
			'attn_mobile'				=> $this->input->post('pic_hp'),
			'attn_email'				=> $this->input->post('pic_email'),
			'message'					=> $this->input->post('message_m'),
		);
		$this->load->model('m_quotation');
		$this->m_quotation->save_sales_contract($data_quot);

		redirect('marketing/sales_contract/ok');
	}

	//fungsi quotation
	function save_qoutation()
	{
		$this->load->model('m_master');
		$session_data 	= $this->session->userdata('logged_in');
		$user_id		= $session_data['id'];
		$rowC			= $this->input->post('rowcount');
		$kodeq 			= $this->input->post('1');
		$kodebuntut		= $this->input->post('2');
		$bulanini		= $this->input->post('4');
		$tahunini		= $this->input->post('5');
		$result 		= $this->input->post('p_client');
		$prs_margin 	= $this->input->post('adjs_amount');
		$package_name	= $this->input->post('package_name');
		$result_explode = explode('|', $result);
		$id_client 		= $result_explode[0];
		$name_client	= $result_explode[1];


		// Cek Number Qoutation...
		$cek 			= $this->m_master->cek_sysparam('quotation_number');
		foreach ($cek->result() as $row) {
			$id_sysp	= $row->id;
			$sgroup		= $row->sgroup;
			$skey		= (int)$row->skey + 1;
			$svalue		= $row->svalue;
			$lvalue		= $row->lvalue;
		}

		if ($svalue <> $bulanini) {
			$skey = 1;
		} //Jika bulannya berbeda maka harus diubah mejadi satu..

		$data_update 		= array(
			'skey'			=> $skey,
			'svalue'		=> $bulanini,
			'lvalue'		=> $tahunini,
		);
		$this->m_master->update_sysparam($id_sysp, $data_update);

		// echo $skey;
		// echo "</br>";
		// // echo $kodeq;
		// echo "</br>";



		$gabung 		= $name_client{
			0} . "" . str_pad($id_client, 4, "0", STR_PAD_LEFT) . "/" . $package_name . "/" . $kodeq . "/" . str_pad($skey, 4, "0", STR_PAD_LEFT);

		// echo $gabung; exit();

		// $config = Array(
		// 'protocol' => 'smtp',
		// 'smtp_host' => 'ssl://smtp.googlemail.com',
		// 'smtp_port' => 465,
		// 'smtp_user' => 'gojek.jktj2291@gmail.com',
		// 'smtp_pass' => 'Kampret123',
		// 'mailtype'  => 'html', 
		// 'charset'   => 'iso-8859-1'
		// );
		// $this->load->library('email', $config);
		// $this->email->set_newline("\r\n");


		// // Jika persen margin kurang dari 30 maka email ke direktur dan manager..
		// if ($prs_margin < 35) {
		// 	// $this->load->library('email');
		// 	$this->email->from('gojek.jktj2291@gmail.com', 'New Sistem');
		// 	$this->email->to('ranggapeni@gmail.com');
		// 	$this->email->subject('New Quotation');
		// 	$this->email->message('Testing the email manager.');
		// 	$this->email->send();
		// 	echo "krim email manager <br/>";
		// 	if ($prs_margin < 30) {

		// 		$this->email->from('gojek.jktj2291@gmail.com', 'New Sistem');
		// 		$this->email->to('ranggapeni@gmail.com');
		// 		// $this->email->cc('dudi@kyoai123.co.id');
		// 		// $this->email->bcc('rangga@kyoai123.co.id');

		// 		$this->email->subject('New Quotation');
		// 		$this->email->message('Testing the email direktur.');
		// 		$this->email->send();
		// 		echo "krim email direktur <br/>";


		// 	}
		// }
		// echo phpinfo();
		// exit();



		if ($rowC == "") {
			$rowC = "1";
		} else {
			$rowC = $rowC;
		}

		if ($this->input->post('2') == 1) {
			$nilainya	= $this->input->post('2');
		} else {
			$nilainya	= $this->input->post('2');
		}

		include './design/koneksi/file.php';
		$query 		= "SELECT id_quot id FROM mkt_quotation_h ORDER BY id_quot DESC LIMIT 1";
		if ($result 	= mysqli_query($con, $query)) {
			//$date	=date('ym');
			$row 	= mysqli_fetch_assoc($result);
			$count 	= $row['id'];
		}

		$data_quot 						= array(
			'quot_name'					=> $this->input->post('p_name'),
			'qout_id'					=> $gabung,
			'mkt_id'					=> $user_id,
			'quot_revision'				=> 0,
			'is_finalised'				=> 1,
			'client_id'					=> $id_client,
			'qty_estimate'				=> $this->input->post('qty'),
			'margin'					=> $this->input->post('adjs_amount'),
			'quot_date_valid'			=> date("Y-m-d H:i:s", strtotime($this->input->post('v_exp'))),
			'quot_date_end'				=> date("Y-m-d H:i:s", strtotime($this->input->post('p_exp'))),
			'total_price'				=> str_replace(",", "", $this->input->post('amount_total')),
			'margin_amount'				=> str_replace(",", "", $this->input->post('adjs_nominal')),
			'grand_price'				=> str_replace(",", "", $this->input->post('peka')),

		);
		$this->load->model('m_quotation');
		$this->m_quotation->save_quot_h($data_quot);

		$q_filter 		= "SELECT *, MID(qout_id,5,3) asx FROM mkt_quotation_h where MID(qout_id,5,3)='" . str_pad($nilainya, 3, "0", STR_PAD_LEFT) . "' and revised='0' ORDER BY id_quot asc";
		//echo $q_filter ;
		if ($r_filter 	= mysqli_query($con, $q_filter)) {

			if (mysqli_num_rows($r_filter) > 0) {
				$nomer = 1;
				while ($row = $r_filter->fetch_assoc()) {
					if ($nomer == 1) {
						$angka = (int)$row['asx'];
					}
					$meledak = explode("/", $row['qout_id']);
					$boom	 = explode(".", $meledak[0]);
					//echo $boom[0];

					//echo (int)$row['asx'];
					//die();
					$sql_ubah = "update mkt_quotation_h set qout_id='" . $boom[0] . "." . str_pad($angka, 3, "0", STR_PAD_LEFT) . "/" . $meledak[1] . "/" . $meledak[2] . "/" . $meledak[3] . "' where id_quot='" . $row['id_quot'] . "' ";
					$this->db->query($sql_ubah);
					//echo $sql_ubah;
					//echo "</br>";
					$angka = (int)$row['asx'] + $nomer;
					$nomer = $nomer + 1;
					//echo $angka;
					//$this->db->query($sql_ubah);
				}
			}
		}
		//die();

		$final 			= "SELECT id_quot id FROM mkt_quotation_h ORDER BY id_quot DESC LIMIT 1";
		if ($resultx 	= mysqli_query($con, $final)) {
			//$date	=date('ym');
			$rowx 	= mysqli_fetch_assoc($resultx);
			$count 	= $rowx['id'];
		}

		for ($i = 1; $i <= $rowC; $i++) {
			$datas = "";
			$logic = "";

			if ($this->input->post('id_service[' . $i . ']') == "") {
				$datas = "0";
				$logic = "0";
			} else {
				$datas = $this->input->post('id_service[' . $i . ']');
				$logic = $this->input->post('service[' . $i . ']');
			}

			$aritmatika = "";
			if ($this->input->post('g_change_' . $i . '') == 2) {
				$aritmatika = $this->input->post('two_' . $i . '');
			} elseif ($this->input->post('g_change_' . $i . '') == 1) {
				$aritmatika = $this->input->post('one_' . $i . '');
			} elseif ($this->input->post('g_change_' . $i . '') == 0 || $this->input->post('g_change_' . $i . '') == 3) {
				//die();
				$aritmatika = $this->input->post('three_' . $i . '');
			}

			echo $this->input->post('g_change_' . $i . '');
			//	die();
			$sql = "INSERT INTO mkt_quotation_d (notes_service, id_quot_header, group_service, group_header, group_mark, service_id, service_other, seq_no, service_price, service_tax, before_tax) VALUES ('" . $this->input->post('notes_services_' . $i . '') . "', '" . $count . "', '" . $this->input->post('g_change_' . $i . '') . "', '" . rtrim($aritmatika) . "', '" . $this->input->post('mark_' . $i . '') . "', '" . $datas . "', '" . $logic . "', '" . $this->input->post('orderid[' . $i . ']') . "', '" . str_replace(",", "", $this->input->post('price[' . $i . ']')) . "', '" . $this->input->post('ck_' . $i . '') . "', '" . $this->input->post('bf_t_' . $i . '') . "' )";
			//echo $sql;
			//die();
			$this->db->query($sql);
		}
		//die();

		//Create Log Start
		$session_data 		= $this->session->userdata('logged_in');
		$user_id			= $session_data['id'];
		$data_log 			= array(
			'id_user'			=> $user_id,
			'log_date'			=> date("Y-m-d H:i:s"),
			'log_desc'			=> "Create Quotation, Package Name : " . $package_name,
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);

		redirect('marketing/quotation/ok');
	}

	//fungsi quotation
	function app_quotation()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$notes 					= $_POST['notes'];
		$id		 				= $_POST['idx'];
		$logic		 			= $_POST['angka'];
		$ip 					= getenv('REMOTE_ADDR');

		$sqlx = "update mkt_quotation_h set is_finalised='" . $logic . "',approved_by='" . $user_id . "',approved_date='" . date("Y-m-d h:i:s") . "',ip_addr='" . $ip . "',notes='" . $notes . "' where id_quot='" . $id . "' ";
		//echo $sqlx;
		//die();
		$this->db->query($sqlx);

		echo "<script>alert('Success Updated, Thank You.'); window.close(this);</script>";
	}
	function posting_package()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$id_package 			= $this->uri->segment(3);

		$sqlx = "INSERT INTO mkt_posting_pack_h
					SELECT * FROM mkt_quotation_h WHERE id_quot='" . $id_package . "'; 
					";
		//echo $sqlx;
		//die();
		$this->db->query($sqlx);


		$sqlx = "INSERT INTO mkt_posting_pack_d 
		
					SELECT * FROM mkt_quotation_d WHERE id_quot_header='" . $id_package . "' 	
					";
		//echo $sqlx;
		//die();
		$this->db->query($sqlx);


		$sqlx = "update mkt_quotation_h set is_finalised=5 where id_quot='" . $id_package . "'
					";
		//echo $sqlx;
		//die();
		$this->db->query($sqlx);
		echo "<script>alert('Success Posting Package, Thank You.');window.location.href = '" . base_url() . "marketing/list_quotation';</script>";
	}

	function saved_quotation()
	{
		$this->load->model('m_quotation');
		include './design/koneksi/file.php';
		$idy					= $this->uri->segment(3);
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$rowcount				= $_POST['rowcount'];
		$txtbox 				= $_POST['g_change'];
		//$txtone 				= $_POST['one'];
		//$txttwo 				= $_POST['two'];
		$txtthree 				= $_POST['three'];
		//$txtmark				= $_POST['mark'];
		$txtservice				= $_POST['id_service'];
		$service				= $_POST['service'];
		$price					= $_POST['price'];
		$bf						= $_POST['bf'];
		$notes_services			= $_POST['notes_services'];
		$ids					= $this->input->post('n_qt');

		$queryx 		= "SELECT quot_revision idx FROM mkt_quotation_h where qout_id='" . $this->input->post('n_qt') . "' ORDER BY quot_revision DESC LIMIT 1";
		if ($resultx 	= mysqli_query($con, $queryx)) {
			//$date	=date('ym');
			$rowx 	= mysqli_fetch_assoc($resultx);
			$counti = $rowx['idx'];
		}

		if ($this->input->post('2') == 1) {
			$nilainya	= $this->input->post('2');
		} else {
			$nilainya	= $this->input->post('2');
		}

		$query 		= "SELECT id_quot id FROM mkt_quotation_h where id_quot='" . $idy . "' ORDER BY id_quot DESC LIMIT 1";
		if ($result 	= mysqli_query($con, $query)) {
			//$date	=date('ym');
			$row 	= mysqli_fetch_assoc($result);
			$count 	= $row['id'];
		}

		$this->m_quotation->delete_mkt_d($idy);

		$nomor = 1;
		error_reporting(0);

		foreach ($txtbox as $a => $b) {
			$ck = 0;
			if ($_POST['cki' . $nomor . ''] != "") {
				$ck	= $_POST['cki' . $nomor . ''];
			}

			$aritmatika = "";
			if ($txtbox[$a] == 0 || $txtbox[$a] == 3) {
				$aritmatika = $txtthree[$a];
			} else {
				$aritmatika = "0";
			}

			$logic = "";
			if ($txtservice[$a] == "0") {
				$logic = $service[$a];
			} else {
				$logic = $service[$a];
			}

			$sql = "INSERT INTO mkt_quotation_d (id_quot_header, group_service, group_header, service_id, service_other, seq_no, service_price, service_tax, before_tax, notes_service) VALUES ('" . $idy . "', '" . $txtbox[$a] . "', '" . rtrim($aritmatika) . "', '" . $txtservice[$a] . "', '" . $logic . "', '0', '" . str_replace(",", "", $price[$a]) . "', '" . $ck . "', '" . $bf[$a] . "', '" . $notes_services[$a] . "'  )";

			$this->db->query($sql);
			$nomor++;
		}

		//echo $sql;
		//die();
		//exit();

		$sqlx = "update mkt_quotation_h set total_price='" . str_replace(",", "", $this->input->post('amount_total')) . "',margin='" . str_replace(",", "", $this->input->post('adjs_amount')) . "',margin_amount='" . str_replace(",", "", $this->input->post('adjs_nominal')) . "',grand_price='" . str_replace(",", "", $this->input->post('peka')) . "' where id_quot='" . $this->input->post('idx') . "' ";
		$this->db->query($sqlx);
		$sqly = "update mkt_quotation_h set revised=0 where id_quot='" . $this->input->post('idx') . "' ";
		$this->db->query($sqly);

		//die();
		echo "<script>alert('Success Updated, Check again your Quotation.'); window.close(this);</script>";
	}


	//fungsi quotation
	function update_quotation()
	{
		include './design/koneksi/file.php';
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$txtbox 				= $_POST['g_change'];
		//$txtone 				= $_POST['one'];
		//$txttwo 				= $_POST['two'];
		$txtthree 				= $_POST['three'];
		//$txtmark				= $_POST['mark'];
		$txtservice				= $_POST['id_service'];
		$service				= $_POST['service'];
		$price					= $_POST['price'];
		$notes_services			= $_POST['notes_services'];
		$bf						= $_POST['bf'];

		$queryx 		= "SELECT quot_revision idx FROM mkt_quotation_h where qout_id='" . $this->input->post('n_qt') . "' ORDER BY quot_revision DESC LIMIT 1";
		if ($resultx 	= mysqli_query($con, $queryx)) {
			//$date	=date('ym');
			$rowx 	= mysqli_fetch_assoc($resultx);
			$counti = $rowx['idx'];
		}

		if ($this->input->post('2') == 1) {
			$nilainya	= $this->input->post('2');
		} else {
			$nilainya	= $this->input->post('2');
		}

		$query 		= "SELECT id_quot id FROM mkt_quotation_h ORDER BY id_quot DESC LIMIT 1";
		if ($result 	= mysqli_query($con, $query)) {
			//$date	=date('ym');
			$row 	= mysqli_fetch_assoc($result);
			$count 	= $row['id'] + 1;
		}

		$data_quot 						= array(
			'quot_name'					=> $this->input->post('p_name'),
			'qout_id'					=> $this->input->post('n_qt'),
			'mkt_id'					=> $user_id,
			'quot_revision'				=> $counti + 1,
			'is_finalised'				=> 1,
			'client_id'					=> $this->input->post('p_client'),
			'margin'					=> $this->input->post('adjs_amount'),
			'notes_client'				=> $this->input->post('client'),
			'qty_estimate'				=> $this->input->post('pax'),
			'quot_date_valid'			=> date("Y-m-d H:i:s", strtotime($this->input->post('v_exp'))),
			'quot_date_end'				=> date("Y-m-d H:i:s", strtotime($this->input->post('p_exp'))),
			'total_price'				=> str_replace(",", "", $this->input->post('amount_total')),
			'margin_amount'				=> str_replace(",", "", $this->input->post('adjs_nominal')),
			'grand_price'				=> str_replace(",", "", $this->input->post('peka')),
		);
		$this->load->model('m_quotation');
		$this->m_quotation->save_quot_h($data_quot);



		$nomor = 1;
		error_reporting(0);
		foreach ($txtbox as $a => $b) {
			$ck = 0;
			if ($_POST['cki' . $nomor . ''] != "") {
				$ck	= $_POST['cki' . $nomor . ''];
			}

			$aritmatika = "";
			if ($txtbox[$a] == 2) {
				$aritmatika = $txttwo[$a];
			} elseif ($txtbox[$a] == 1) {
				$aritmatika = $txtone[$a];
			} elseif ($txtbox[$a] == 0 || $txtbox[$a] == 3) {
				$aritmatika = $txtthree[$a];
			} else {
				$aritmatika = "0";
			}

			$logic = "";
			if ($txtservice[$a] == "0") {
				$logic = $service;
			} else {
				$logic = $service[$a];
			}

			$sql = "INSERT INTO mkt_quotation_d (id_quot_header, group_service, group_header, service_id, service_other, seq_no, service_price, service_tax, before_tax, notes_service) VALUES ('" . $count . "', '" . $txtbox[$a] . "', '" . rtrim($aritmatika) . "', '" . $txtservice[$a] . "', '" . $logic . "', '0', '" . str_replace(",", "", $price[$a]) . "', '" . $ck . "', '" . $bf[$a] . "', '" . $notes_services[$a] . "' )";
			//echo $sql;
			//die();
			$this->db->query($sql);
			$nomor++;
		}

		//exit();

		$sqlx = "update mkt_quotation_h set quot_revision=quot_revision+1,total_price='" . str_replace(",", "", $this->input->post('amount_total')) . "',margin='" . str_replace(",", "", $this->input->post('adjs_amount')) . "',margin_amount='" . str_replace(",", "", $this->input->post('adjs_nominal')) . "',grand_price='" . str_replace(",", "", $this->input->post('peka')) . "' where id_quot='" . $this->input->post('idx') . "' ";

		$sqly = "update mkt_quotation_h set revised=1 where id_quot='" . $this->input->post('idx') . "' ";
		$this->db->query($sqly);

		//die();
		echo "<script>alert('Success Updated, Check again your Quotation.'); window.close(this);</script>";
	}

	//fungsi load List Package
	function list_package()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['list'] 			= $this->m_quotation->get_list_service_package();
			$this->template->set('title', 'Klinik | List Package');
			$this->template->load('template', 'menu/list_package', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi load List Package
	function print_orderform()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$id			 			= $this->uri->segment(3);
			$type			 		= $this->uri->segment(4);
			$data['list'] 			= $this->m_quotation->get_data_order_ops($id, $type);
			$this->load->view('menu/print_orderform', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function sales_contract_print()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$id			 			= $this->uri->segment(3);
			//$type			 		= $this->uri->segment(4);
			$data['header']			= $this->m_quotation->get_sales_contract($id);
			$this->load->view('menu/sales_contract_print', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function list_quotation()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$id						= $session_data['id'];
			$data['list'] 			= $this->m_quotation->get_list_quot($id);
			$data['order'] 			= $this->m_quotation->get_order_form();
			$data['sales'] 			= $this->m_quotation->get_sales_contract_all();
			$this->template->set('title', 'Klinik | My Quotation');
			$this->template->load('template', 'menu/list_quotation', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function list_quotation_all()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$sts 					= $this->uri->segment(3);
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$id						= $session_data['id'];
			if ($sts == 'all') {
				$data['list']		= $this->m_quotation->get_list_quot_all2();
			} else {
				$data['list']		= $this->m_quotation->get_list_quot_all($sts);
			}
			$data['order'] 			= $this->m_quotation->get_order_form();
			$data['sales'] 			= $this->m_quotation->get_sales_contract_all();
			$this->template->set('title', 'Klinik | My Quotation');
			$this->template->load('template', 'menu/list_quotation_all', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function my_sales_contract()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$id						= $session_data['id'];
			$data['list'] 			= $this->m_quotation->get_list_sales_contract($id);
			$this->template->set('title', 'Klinik | My Quotation');
			$this->template->load('template', 'menu/my_sales_contract', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function list_quotation_app()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$id						= $session_data['id'];
			$data['list'] 			= $this->m_quotation->get_list_quot_app($id);
			$this->template->set('title', 'Klinik | List Quotation Approval');
			$this->template->load('template', 'menu/list_quotation_app', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	//fungsi load List Package
	function list_detail_package()
	{
		if ($this->session->userdata('logged_in')) {
			$id_package = $this->uri->segment(3);
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			$data['data'] 			= $this->m_quotation->get_list_services_package($id_package);
			$this->template->set('title', 'Klinik | Detail Package');
			$this->template->load('template', 'menu/list_detail_package', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function list_detail_quotation()
	{
		if ($this->session->userdata('logged_in')) {
			$id_package = $this->uri->segment(3);
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['fullname'];
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			$data['print_h']		= $this->m_quotation->get_data_header($id_package);
			$data['data'] 			= $this->m_quotation->get_list_services_quot($id_package);
			$this->template->set('title', 'Klinik | Detail Quotation');
			$this->template->load('template', 'menu/list_detail_quotation', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function print_client()
	{
		if ($this->session->userdata('logged_in')) {
			$id_package = $this->uri->segment(3);
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			$data['print_h']		= $this->m_quotation->get_data_header($id_package);
			$data['data'] 			= $this->m_quotation->get_list_services_quot($id_package);
			$this->load->view('menu/print_client', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function print_excel_client()
	{
		if ($this->session->userdata('logged_in')) {
			$id_package = $this->uri->segment(3);
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			$data['print_h']		= $this->m_quotation->get_data_header($id_package);
			$data['data'] 			= $this->m_quotation->get_list_services_quot($id_package);
			$this->load->view('menu/print_excel_client', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function list_detail_quotation_app()
	{
		if ($this->session->userdata('logged_in')) {
			$id_package = $this->uri->segment(3);
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			$data['print_h']		= $this->m_quotation->get_data_header($id_package);
			$data['data'] 			= $this->m_quotation->get_list_services_quot($id_package);
			$this->template->set('title', 'Klinik | Detail Quotation');
			$this->template->load('template', 'menu/list_detail_quotation_app', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function list_detail_quotation_view()
	{
		if ($this->session->userdata('logged_in')) {
			$id_package = $this->uri->segment(3);
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			$data['print_h']		= $this->m_quotation->get_data_header($id_package);
			$data['data'] 			= $this->m_quotation->get_list_services_quot($id_package);
			$this->template->set('title', 'Klinik | Detail Quotation');
			$this->template->load('template', 'menu/list_detail_quotation_view', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function update_service_package()
	{
		if ($this->session->userdata('logged_in')) {
			$this->load->model('m_quotation');
			$this->load->model('m_registration');
			$id_package 			= $this->uri->segment(3);
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['get_client']     = $this->m_registration->get_mst_client();
			// $data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			$data['detail'] 		= $this->m_quotation->get_list_service_package_detail($id_package);
			$data['list'] 			= $this->m_quotation->get_list_service_package_byID($id_package);
			$this->template->set('title', 'Klinik | Master Services Package');
			$this->template->load('template', 'menu/update_service_package', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi load form Master Services Package
	function update_mst_service_package()
	{
		if ($this->session->userdata('logged_in')) {
			$id_package = $this->uri->segment(3);
			$this->load->model('m_quotation');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			$data['detail'] 		= $this->m_quotation->get_list_service_package_detail($id_package);
			$data['list'] 			= $this->m_quotation->get_list_service_package_byID($id_package);
			$data['data'] 			= $this->m_quotation->get_list_services($id_package);
			$this->template->set('title', 'Klinik | Master Services Package');
			$this->template->load('template', 'menu/update_mst_service_package', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi load form Master Services Package
	function update_detail_quotation()
	{
		if ($this->session->userdata('logged_in')) {
			$id_package = $this->uri->segment(3);
			$this->load->model('m_quotation');
			$this->load->model('m_registration');
			$session_data 			= $this->session->userdata('logged_in');
			$data['username'] 		= $session_data['username'];
			$data['sv_group'] 		= $this->m_quotation->get_list_services_group();
			$data['sv_lab'] 		= $this->m_quotation->get_list_lab();
			$data['sv_rad'] 		= $this->m_quotation->get_list_rad();
			$data['sv_mark'] 		= $this->m_quotation->get_list_mark();
			$data['get_client']     = $this->m_registration->get_mst_client();
			$data['sv_type'] 		= $this->m_quotation->get_list_services_type();
			$data['print_h']		= $this->m_quotation->get_data_header($id_package);
			$data['notes']			= $this->m_quotation->get_data_notes($id_package);
			$data['print_d']		= $this->m_quotation->get_data_detail($id_package);
			$data['jml']			= $data['print_d']->num_rows();
			$this->template->set('title', 'Klinik | Update My Quotation');
			$this->template->load('template', 'menu/update_quotation', $data);
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	//fungsi untuk delete Delivery Address, Add by rangga 23 Feb 2016
	function progress_update_mst_service_package()
	{
		$id = $this->input->post('id_package');
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$rowC					= $this->input->post('rowC');

		if ($rowC == 0) {
			$rowC = "1";
		} else {
			$rowC = $rowC;
		}

		$data_pack 			= array(
			'package_name'				=> $this->input->post('p_name'),
			'package_price_base' 		=> str_replace(",", "", $this->input->post('p_pbase')),
			'package_price_std'			=> str_replace(",", "", $this->input->post('p_pstandart')),
			'package_price_jpn' 		=> str_replace(",", "", $this->input->post('p_pjapan')),
			'package_price_comp' 		=> str_replace(",", "", $this->input->post('p_pcompany')),
		);
		$this->load->model('m_quotation');
		$this->m_quotation->delete_package($id, $data_pack);

		include './design/koneksi/file.php';
		$delete_d 	= mysqli_query($con, "DELETE FROM mst_service_package_d WHERE id_package_header=" . $id);
		$query 		= "SELECT id_package id FROM mst_service_package_h ORDER BY id_package DESC LIMIT 1";
		if ($result 	= mysqli_query($con, $query)) {
			//$date	=date('ym');
			$row 	= mysqli_fetch_assoc($result);
			$count 	= $row['id'];
		}

		for ($i = 1; $i <= $rowC; $i++) {
			$uservalue = $this->input->post('serv[' . $i . ']');
			$uservalue = explode(":", $uservalue);
			if ($uservalue[0] != "") {
				$sql = "INSERT INTO mst_service_package_d (id_package_header, id_service, seq_no, order_id, order_type, group_name, price) VALUES ('" . $count . "', '" . $uservalue[1] . "', '" . $uservalue[2] . "', '" . $uservalue[3] . "', '" . $uservalue[4] . "', '" . $uservalue[5] . "', '" . $uservalue[0] . "')";
				$this->db->query($sql);
				//echo $this->input->post('serv['.$i.']');
				//die();
				//echo $this->db->affected_rows();
				//echo $this->db->affected_rows();
			} else {
				echo $uservalue[0];
				//echo "fail";
				//die();
			}
		}
		//die();
		// redirect('marketing/update_mst_service_package/ok');
		echo "<script>setTimeout(function () { window.opener.location.reload(true); window.close();}, 1);</script>";
	}

	//fungsi untuk delete Delivery Address, Add by rangga 23 Feb 2016
	function delete_package()
	{
		$data['now']	= date("Y-m-d H:i:s");
		$id 			= $this->uri->segment(3);

		$this->load->model('m_quotation');
		$data_app 	= array(
			'status'			=> 1,
		);
		$this->m_quotation->delete_package($id, $data_app);

		//Create Log Start
		$session_data 			= $this->session->userdata('logged_in');
		$user_id				= $session_data['id'];
		$data_log = array(
			'id_user'			=> $user_id,
			'log_date'			=> date("Y-m-d H:i:s"),
			'log_desc' 			=> "Delete Master Package, id_package : " . $id . "",
		);
		$this->load->model('m_login');
		$this->m_login->log($data_log);
		//Endless Log


		// kembalikan ke halaman user
		redirect('/marketing/list_package/del');
	}

	function remove_list()
	{
		$id 		= $this->uri->segment(3);
		$before	= $this->uri->segment(4);
		$this->load->model('m_quotation');
		$data_app 	= array(
			'status'			=> 1,
		);
		$this->m_quotation->delete_list_quot($id, $data_app);
		//kembalikan ke halaman user
		redirect('/marketing/update_detail_quotation/' . $before);
	}

	function p_app_client()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$data['id']				= $this->uri->segment(3);
		$data['user_id']		= $session_data['id'];
		// $data['notes']			= $_POST['variable'];
		$data['ip']				= getenv('REMOTE_ADDR');

		$this->template->set('title', 'Klinik | Approval');
		$this->template->load('template', 'menu/p_app_client', $data);
	}

	function app_client()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$id 					= $this->uri->segment(3);
		$user_id				= $session_data['id'];
		$notes 					= $_POST['variable'];
		$ip 					= getenv('REMOTE_ADDR');

		$sqlx = "UPDATE mkt_quotation_h SET is_finalised='6',approved_client='" . date("Y-m-d h:i:s") . "',notes_client='" . $notes . "' where id_quot='" . $id . "' ";
		//echo $sqlx;
		//die();
		$this->db->query($sqlx);
	}

	function dec_client()
	{
		$session_data 			= $this->session->userdata('logged_in');
		$id 					= $this->uri->segment(3);
		$user_id				= $session_data['id'];
		$notes 					= $_POST['variable'];
		$ip 					= getenv('REMOTE_ADDR');

		$sqlx = "UPDATE mkt_quotation_h SET is_finalised='7',approved_client='" . date("Y-m-d h:i:s") . "',notes_client='" . $notes . "',revised=0 where id_quot='" . $id . "' ";
		//echo $sqlx;
		//die();
		$this->db->query($sqlx);
	}
}
