<?php
class M_patient extends CI_Model
{

	function get_list_gender()
	{
		return $this->db->get('mst_gender');
	}

	function get_patient($id_mrn)
	{
		$this->db->where('pat_MRN', $id_mrn);
		return $this->db->get('pat_data');
	}

	function get_patient_2($id_mrn)
	{
		$this->db->where('id_pat', $id_mrn);
		return $this->db->get('pat_data');
	}

	function update_doctor($id, $data)
	{
		$this->db->where('id_ms_d', $id);
		$this->db->update('pat_ms_d', $data);
		return $this->db->affected_rows();
	}

	function get_patient_3($id_pat, $reg_date)
	{
		$this->db->limit(3, 0);
		$this->db->order_by('reg_date', 'desc');
		$this->db->where('id_service', 0);
		$this->db->where('id_pat', $id_pat);
		$this->db->where('reg_date <=', $reg_date);
		return $this->db->get('trx_registration');
	}

	function get_patient_3_new($id_pat, $id_reg, $reg_date)
	{
		$this->db->limit(3, 0);
		$this->db->order_by('reg_date', 'desc');
		$this->db->where('id_service', 0);
		$this->db->where('id_pat', $id_pat);
		$this->db->where('id_reg', $id_reg);
		$this->db->where('reg_date <=', $reg_date);
		return $this->db->get('trx_registration');
	}

	function get_pat_data($id_pat)
	{
		$this->db->where('id_pat', $id_pat);
		return $this->db->get('pat_data');
	}

	function get_registration($id_reg)
	{
		$this->db->where('id_reg', $id_reg);
		return $this->db->get('trx_registration');
	}

	function get_registration2($id_pat)
	{
		$this->db->from('trx_registration');
		$this->db->join('pat_data', 'trx_registration.id_pat = pat_data.id_pat ', 'left');
		$this->db->where('trx_registration.id_pat', $id_pat);
		$this->db->order_by('id_reg', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query;
	}


	function get_list_package($id_reg, $param)
	{
		$this->db->from('pat_data');
		$this->db->join('trx_registration', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $param . ')', 'inner');
		$this->db->where('id_service', 0);
		$this->db->where('id_reg', $id_reg);
		$this->db->order_by('reg_date', 'desc');
		$query = $this->db->get();
		return $query;
	}

	function get_data_radiology()
	{
		$this->db->select('*');
		$this->db->from('mst_rad_item');
		$this->db->join('mst_rad_group', 'mst_rad_group.id_rad_group = mst_rad_item.rad_item_group', 'left');
		$this->db->order_by("group_seq_no", "asc");
		$this->db->order_by("seq_no", "asc");
		$query = $this->db->get();
		return $query;
	}

	function get_report_reg()
	{
		$this->db->select('trx_registration.id_reg,trx_registration.reg_date,pat_data.pat_name,pat_data.pat_MRN,mst_client.client_name,id_service, trx_registration.create_date, mst_user.fullname');
		$this->db->from('trx_registration');
		$this->db->join('pat_data', 'trx_registration.id_pat = pat_data.id_pat ', 'left');
		$this->db->join('mst_client', 'trx_registration.id_client = mst_client.id_Client ', 'left');
		$this->db->join('mst_user', 'trx_registration.create_by = mst_user.id ', 'left');
		$this->db->order_by("id_reg", "desc");
		$this->db->limit(1000);
		$query = $this->db->get();
		return $query;
	}

	function get_report_reg2()
	{
		$this->db->select('trx_registration.id_reg,trx_registration.reg_date,pat_data.pat_name,pat_data.pat_MRN,mst_client.client_name,id_service, trx_registration.create_date, mst_user.fullname');
		$this->db->from('trx_registration');
		$this->db->join('pat_data', 'trx_registration.id_pat = pat_data.id_pat ', 'left');
		$this->db->join('mst_client', 'trx_registration.id_client = mst_client.id_Client ', 'left');
		$this->db->join('mst_user', 'trx_registration.create_by = mst_user.id ', 'left');
		// $this->db->order_by("trx_registration.create_date", "desc");
		$this->db->order_by("trx_registration.reg_date", "desc");
		$this->db->limit(1000);
		$query = $this->db->get();
		return $query;
	}

	function get_data_lab()
	{
		$this->db->select('*');
		$this->db->from('mst_lab_item');
		$this->db->join('mst_lab_group', 'mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group', 'left');
		$this->db->order_by("lab_item_group", "asc");
		$this->db->order_by("lab_item_seq_no", "asc");
		$query = $this->db->get();
		return $query;
	}

	function get_mst_client()
	{
		return $this->db->get('mst_client'); //  load name of table
	}

	function get_data_comment()
	{
		$this->db->distinct('c_1');
		$this->db->select('code_comment,c_1');
		$this->db->from('mst_comment_auto'); //  load name of table
		$this->db->where('code_comment !=', '');
		//$this->db->limit(5);
		$this->db->group_by("c_1");
		$this->db->order_by('code_comment', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function get_mst_client_dept()
	{
		return $this->db->get('mst_client_dept'); //  load name of table
	}

	function get_temp_print_mcu_h($id_reg)
	{
		$this->db->from('tmp_print_mcu_h');
		$this->db->where('id_reg', $id_reg);
		$query = $this->db->get();
		return $query;
	}

	function get_temp_print_mcu_h2($id_reg)
	{
		$this->db->from('tmp_print_mcu_h');
		$this->db->join('tmp_print_mcu_d', 'tmp_print_mcu_h.id_reg = tmp_print_mcu_d.id_reg', 'inner');
		$this->db->where('tmp_print_mcu_h.id_reg', $id_reg);
		$query = $this->db->get();
		return $query;
	}

	function get_comment_mcu($id_reg, $nomber)
	{
		$this->db->from('pat_mcu_result_comment');
		$this->db->where('id_reg', $id_reg);
		$this->db->where('id_group_service', $nomber);
		$query = $this->db->get();
		return $query;
	}

	function get_temp_print_mcu_d($id_pat, $id_serv_group)
	{
		$this->db->from('tmp_print_mcu_d');
		$this->db->where('id_pat', $id_pat);
		$this->db->where_in('id_serv_group', $id_serv_group);
		$this->db->order_by('group_header_print', 'asc');
		$this->db->order_by('content_h', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function get_temp_print_mcu_d_fisik($id_pat)
	{
		$id_serv_group = array(0, 3);
		$this->db->from('tmp_print_mcu_d');
		$this->db->where('id_pat', $id_pat);
		$this->db->where_in('id_serv_group', $id_serv_group);
		$this->db->order_by('group_header_print', 'asc');
		$this->db->order_by('content_h', 'asc');
		$this->db->order_by('seq_no', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function get_temp_print_mcu_d_dental($id_pat)
	{
		$this->db->from('tmp_print_mcu_d');
		$this->db->where('id_pat', $id_pat);
		$this->db->where('id_serv_group', 5);
		$this->db->order_by('group_header_print', 'asc');
		$this->db->order_by('content_h', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function get_package_name($id_pat)
	{
		$this->db->distinct('id_reg, name_package');
		$this->db->select('id_reg, name_package');
		$this->db->from('tmp_print_mcu_d');
		$this->db->where('id_pat', $id_pat);
		$query = $this->db->get();
		return $query;
	}

	function get_temp_name_package($id_pat)
	{
		$this->db->distinct('id_reg,name_package');
		$this->db->from('tmp_print_mcu_d');
		$this->db->where('id_pat', $id_pat);
		$query = $this->db->get();
		/* var_dump($datereg1,$datereg2);
	exit();  */
		return $query;
	}

	function get_que_mcu($id_reg)
	{
		$this->db->where('id_reg', $id_reg);
		return $this->db->get('mst_client_dept'); //  load name of table
	}

	function get_data_lock($id_regist)
	{
		$this->db->where('id_regist', $id_regist);
		return $this->db->get('pat_mcu_result'); //  load name of table
	}

	function get_data_lock_ms($id_regist)
	{
		$this->db->where('id_reg', $id_regist);
		return $this->db->get('pat_ms_h'); //  load name of table
	}

	function get_mst_title()
	{
		return $this->db->get('mst_title'); //  load name of table
	}

	function get_mst_client_job()
	{
		return $this->db->get('mst_client_job'); //  load name of table
	}

	function get_mst_client_job_id($id_client_job)
	{
		$this->db->where('id_client_job', $id_client_job);
		return $this->db->get('mst_client_job'); //  load name of table
	}

	function get_data_patien($id_reg, $code)
	{
		$this->db->from('pat_data');
		$this->db->join('trx_registration ', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('pat_order_h', 'trx_registration.id_reg=pat_order_h.id_reg', 'inner');
		$this->db->join('pat_order_d', 'pat_order_h.id_order=pat_order_d.id_order_header', 'inner');
		$this->db->join('mst_services', 'pat_order_d.id_service=mst_services.id_service', 'inner');
		$this->db->join('mst_service_price', 'mst_services.id_service=mst_service_price.id_service and trx_registration.pat_charge_rule=mst_service_price.price_type', 'left');
		$this->db->join('mst_price_type', 'mst_service_price.price_type=mst_price_type.id_price_type and trx_registration.pat_charge_rule=mst_price_type.id_price_type', 'left');
		$this->db->where('pat_order_h.id_reg', $id_reg);
		$this->db->where('pat_order_h.order_type', $code);
		$this->db->where('mst_services.order_type', $code);
		$query = $this->db->get();
		return $query;
	}

	function get_data_lab_patien($id_reg)
	{
		$this->db->from('pat_data');
		$this->db->join('trx_registration ', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('pat_order_h', 'trx_registration.id_reg=pat_order_h.id_reg', 'inner');
		$this->db->join('pat_order_d', 'pat_order_h.id_order=pat_order_d.id_order_header', 'inner');
		$this->db->join('mst_lab_item', 'pat_order_d.id_service=mst_lab_item.id_lab_item', 'inner');
		$this->db->join('mst_services', 'mst_lab_item.id_lab_item=mst_services.order_id', 'inner');
		$this->db->join('mst_service_price', 'mst_services.id_service=mst_service_price.id_service and trx_registration.pat_charge_rule=mst_service_price.price_type', 'inner');
		$this->db->join('mst_price_type', 'mst_service_price.price_type=mst_price_type.id_price_type and trx_registration.pat_charge_rule=mst_price_type.id_price_type', 'inner');
		$this->db->where('pat_order_h.id_reg', $id_reg);
		$this->db->where('pat_order_h.mcu', 0);
		$this->db->where('pat_order_h.order_type', 1);
		$this->db->where('mst_services.order_type', 1);
		$query = $this->db->get();
		return $query;
	}

	function get_data_rad_patien($id_reg)
	{
		$this->db->from('pat_data');
		$this->db->join('trx_registration ', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('pat_order_h', 'trx_registration.id_reg=pat_order_h.id_reg', 'inner');
		$this->db->join('pat_order_d', 'pat_order_h.id_order=pat_order_d.id_order_header', 'inner');
		$this->db->join('mst_rad_item', 'pat_order_d.id_service=mst_rad_item.id_rad_item', 'inner');
		$this->db->join('mst_services', 'mst_rad_item.id_rad_item=mst_services.order_id', 'inner');
		$this->db->join('mst_service_price', 'mst_services.id_service=mst_service_price.id_service and trx_registration.pat_charge_rule=mst_service_price.price_type', 'left');
		$this->db->join('mst_price_type', 'mst_service_price.price_type=mst_price_type.id_price_type and trx_registration.pat_charge_rule=mst_price_type.id_price_type', 'left');
		$this->db->where('pat_order_h.id_reg', $id_reg);
		$this->db->where('pat_order_h.mcu', 0);
		$this->db->where('pat_order_h.order_type', 2);
		$this->db->where('mst_services.order_type', 2);
		$query = $this->db->get();
		return $query;
	}

	function get_list_marital()
	{
		return $this->db->get('mst_marital_status');
	}

	function get_list_province()
	{
		return $this->db->get('mst_provinsi');
		$this->db->order_by("provinsi_id", "asc");
	}

	function get_list_city()
	{
		return $this->db->get('mst_kota');
		$this->db->order_by("kota_id", "asc");
	}

	function get_list_relative()
	{
		return $this->db->get('mst_relative');
	}

	function get_list_nationality()
	{
		return $this->db->get('mst_nationality');
	}

	function save_patient($data_pat)
	{
		$this->db->insert('pat_data', $data_pat);
		if ($this->db->affected_rows() == 0) {
			echo '<script>window.history.back();</script>';
		}
		//$this->db->_error_message();
		//$this->db->close();
	}

	function get_patient_data_mark()
	{
		$this->db->select('trx_registration.id,id_reg,reg_date,pat_name,pat_dob,pat_pob,gender,pat_MRN,title_desc,quot_name package_name,client_name,pat_data.id_Pat,locked,username fullname,lock_by,trx_registration.create_date');
		$this->db->from('pat_data');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('trx_registration', 'trx_registration.id_pat = pat_data.id_Pat', 'inner');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot = trx_registration.id_package', 'inner');
		$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left');
		$this->db->join('mst_client', 'mst_client.id_client = trx_registration.id_client', 'left');
		$this->db->join('pat_mcu_result', 'pat_mcu_result.id_regist = trx_registration.id_reg', 'left');
		$this->db->join('mst_user', 'mst_user.id = pat_mcu_result.lock_by', 'left');
		$this->db->order_by('trx_registration.id', 'desc');
		$query = $this->db->get();
		return $query;
	}

	function get_patient_data_printmcu()
	{
		$this->db->select('trx_registration.id, trx_registration.id_reg, trx_registration.reg_date, pat_name, pat_dob, pat_pob, gender, pat_MRN, title_desc, quot_name package_name, client_name,pat_data.id_Pat,username fullname,trx_registration.create_date, tmp_print_mcu_h.updated_by, tmp_print_mcu_h.seq_print');
		$this->db->from('pat_data');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('trx_registration', 'trx_registration.id_pat = pat_data.id_Pat', 'inner');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot = trx_registration.id_package', 'inner');
		$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left');
		$this->db->join('mst_client', 'mst_client.id_client = trx_registration.id_client', 'left');
		$this->db->join('tmp_print_mcu_h', 'tmp_print_mcu_h.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('mst_user', 'mst_user.id = tmp_print_mcu_h.updated_by', 'left');
		$this->db->order_by('trx_registration.id', 'desc');
		$query = $this->db->get();
		return $query;
	}

	function get_patient_data_mark_distinct()
	{
		$this->db->distinct('pat_MRN, id_history, pat_name, title_desc, pat_dob, client_name, pat_data.id_Pat');
		$this->db->select('pat_MRN, id_history, pat_name, title_desc, pat_dob, client_name, pat_data.id_Pat');
		$this->db->from('pat_data');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('trx_registration', 'trx_registration.id_pat = pat_data.id_Pat', 'inner');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot = trx_registration.id_package', 'inner');
		$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left');
		$this->db->join('mst_client', 'mst_client.id_client = trx_registration.id_client', 'left');
		$this->db->join('pat_mcu_result', 'pat_mcu_result.id_regist = trx_registration.id_reg', 'left');
		$this->db->join('mst_user', 'mst_user.id = pat_mcu_result.lock_by', 'left');
		$this->db->order_by('trx_registration.id', 'desc');
		$query = $this->db->get();
		return $query;
	}

	function print_detailrad_order($id_reg, $param)
	{
		$this->db->select('pat_order_h.id_order, mst_order_type.order_type_desc, pat_order_h.order_type, pat_order_h.id_reg, pat_order_h.order_date, pat_order_h.order_status, pat_order_h.mcu, pat_order_d.id_service, mst_rad_item.id_rad_item, mst_rad_item.rad_item, mst_rad_item.rad_item_group, mst_rad_item.seq_no, mst_rad_group.group_desc, pat_rad_result.result, trx_registration.reg_date, mkt_posting_pack_h.id_quot, mkt_posting_pack_h.quot_name, trx_registration.id_pat');
		$this->db->from('pat_order_h');
		$this->db->join('mst_order_type', 'mst_order_type.id_order_type = pat_order_h.order_type', 'left');
		$this->db->join('pat_order_d', 'pat_order_d.id_order_header = pat_order_h.id_order', 'left');
		$this->db->join('mst_rad_item', 'mst_rad_item.id_rad_item = pat_order_d.id_service', 'left');
		$this->db->join('mst_rad_group', 'mst_rad_group.id_rad_group = mst_rad_item.rad_item_group', 'left');
		$this->db->join('trx_registration', 'trx_registration.id_reg = pat_order_h.id_reg', 'left');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $param . ')', 'inner');
		$this->db->join('pat_rad_result', 'pat_order_h.id_order = pat_rad_result.id_order AND pat_order_d.id_service = pat_rad_result.id_rad_item', 'left');
		$this->db->where('pat_order_h.id_reg', $id_reg);
		$this->db->where('id_order_type', 2);
		$this->db->where('pat_order_d.status !=', 1);
		$query = $this->db->get();
		return $query;
	}

	function print_detailrad_order2($id_reg, $param)
	{
		$this->db->select('pat_order_h.id_order, mst_order_type.order_type_desc, pat_order_h.order_type, pat_order_h.id_reg, pat_order_h.order_date, pat_order_h.order_status, pat_order_h.mcu, mst_services.id_service, mst_rad_item.id_rad_item, mst_rad_item.rad_item, mst_rad_item.rad_item_group, mst_rad_item.seq_no, mst_rad_group.group_desc, pat_rad_result.result, trx_registration.reg_date, mkt_posting_pack_h.id_quot, mkt_posting_pack_h.quot_name, trx_registration.id_pat, mst_services.id_group_serv, pat_rad_result.nama_value');
		$this->db->from('pat_order_h');
		$this->db->join('mst_order_type', 'mst_order_type.id_order_type = pat_order_h.order_type', 'left');
		$this->db->join('pat_order_d', 'pat_order_d.id_order_header = pat_order_h.id_order', 'left');
		$this->db->join('mst_services', 'mst_services.order_id = pat_order_d.id_service and mst_services.id_group_serv not in (0,1)', 'left');
		$this->db->join('mst_rad_item', 'mst_rad_item.id_rad_item = pat_order_d.id_service', 'left');
		$this->db->join('mst_rad_group', 'mst_rad_group.id_rad_group = mst_rad_item.rad_item_group', 'left');
		$this->db->join('trx_registration', 'trx_registration.id_reg = pat_order_h.id_reg', 'left');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $param . ')', 'inner');
		$this->db->join('pat_rad_result', 'pat_order_h.id_order = pat_rad_result.id_order AND pat_order_d.id_service = pat_rad_result.id_rad_item', 'left');
		$this->db->where('pat_order_h.id_reg', $id_reg);
		$this->db->where('id_order_type', 2);
		$this->db->where('pat_order_d.status !=', 1);
		$query = $this->db->get();
		return $query;
	}

	function get_patient_data_mark_sheet()
	{
		$this->db->select('trx_registration.id,trx_registration.id_reg,reg_date,pat_name,pat_dob,pat_pob,gender,pat_MRN,title_desc,quot_name package_name,client_name,pat_data.id_Pat,trx_registration.create_date,locked,lock_by,fullname');
		$this->db->from('pat_data');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('trx_registration', 'trx_registration.id_pat = pat_data.id_Pat', 'inner');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot = trx_registration.id_package', 'inner');
		$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left');
		$this->db->join('mst_client', 'mst_client.id_client = trx_registration.id_client', 'left');
		$this->db->join('pat_ms_h', 'pat_ms_h.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('mst_user', 'mst_user.id = pat_ms_h.lock_by', 'left');
		$this->db->order_by('trx_registration.id', 'desc');
		$query = $this->db->get();
		return $query;
	}

	function get_patient_data_dental()
	{
		$this->db->distinct('id');
		$this->db->select('trx_registration.id,trx_registration.id_reg,reg_date,pat_name,pat_dob,pat_pob,gender,pat_MRN,title_desc,quot_name package_name,client_name,pat_data.id_Pat,trx_registration.create_date,locked,lock_by,fullname');
		$this->db->from('pat_data');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('trx_registration', 'trx_registration.id_pat = pat_data.id_Pat', 'inner');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot = trx_registration.id_package', 'inner');
		$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot and group_service=5', 'inner');
		$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left');
		$this->db->join('mst_client', 'mst_client.id_client = trx_registration.id_client', 'left');
		$this->db->join('pat_ms_h', 'pat_ms_h.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('mst_user', 'mst_user.id = pat_ms_h.lock_by', 'left');
		$this->db->order_by('trx_registration.id', 'desc');
		$query = $this->db->get();
		return $query;
	}

	function get_patient_grade($id)
	{
		$query = $this->db->query("SELECT Obesitas,Eyes_Sight,Ocular_Tension,Color_Blindness,Fundus,Hearing,Blood_Pressure,Lung_Function,Urine_Analysis,Urine_Sediment,OB,Liver_Function,Renal,Pancreas,Uric_Acid,Lipid,Electrolyte,Hematology,WBC_Classification,Inflammation,Syphilis,Serology_Hepatitis,Others,Immunology_Test,Diabetes_Mellitus,Urine_Glucose,Tumor_Marker,Chest_Xray,Xray_Shadow,Sputum,ECG,Treadmill,Echocardiographi,USG,USG_Prostate,USG_Uterus,USG_Mammae,Stomach_Xray,Pap_Smear,Breast_Examination,Extra_Oral,Panoramic_Xray,Intra_Oral,Dental_Hygine FROM mst_judgment_grade where id_registration=" . $id . ";");
		return $query;
	}

	function get_trx_registration_all($id_pat)
	{
		$this->db->from('trx_registration');
		$this->db->join('mst_service_package_h', 'mst_service_package_h.id_package = trx_registration.id_package', 'inner');
		$this->db->where('id_pat', $id_pat);
		$this->db->order_by("reg_date", "desc");
		$query = $this->db->get();
		return $query;
	}

	function get_trx_registration($id_pat, $id_reg)
	{
		$this->db->from('trx_registration');
		$this->db->join('mst_service_package_h', 'mst_service_package_h.id_package = trx_registration.id_package', 'inner');
		$this->db->where('id_pat', $id_pat);
		$this->db->where('id_reg <=', $id_reg);
		$this->db->order_by("reg_date", "desc");
		$this->db->limit(3, 0);
		$query = $this->db->get();
		return $query;
	}

	function get_trx_registration_all_new($id_pat)
	{
		$this->db->from('trx_registration');
		$this->db->where('id_pat', $id_pat);
		$this->db->where('id_service', 0);
		$this->db->order_by("reg_date", "desc");
		$query = $this->db->get();
		return $query;
	}

	function get_trx_registration_new($id_pat)
	{
		$this->db->from('trx_registration');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (trx_registration.id_package)', 'left');
		$this->db->where('id_service', 0);
		$this->db->where('id_pat', $id_pat);
		$this->db->order_by("reg_date", "desc");
		$this->db->limit(3, 0);
		$query = $this->db->get();
		return $query;
	}

	function get_mark_mcu_pic($id)
	{
		$this->db->where('id_reg', $id);
		return $this->db->get('pat_photo');
	}

	function get_data_dental($id_regist, $param, $age, $gender)
	{
		$this->db->distinct('serv_name');
		$this->db->select('serv_name,nama_group,mst_services.id_service serpis,trx_registration.id_reg as fingerid, nama_value, mst_item_value.id, result');
		$this->db->from('trx_registration');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $param . ')', 'left');
		$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('mst_service_group', 'mst_service_group.id_serv_group = mst_services.id_group_serv', 'left');
		$this->db->join('mst_mark_group', 'mst_mark_group.id = mkt_posting_pack_d.group_mark', 'left');
		$this->db->join('mst_item_value', 'mst_item_value.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('pat_result_mcu', 'pat_result_mcu.id_service = mkt_posting_pack_d.service_id and pat_result_mcu.id_value = mst_item_value.id and trx_registration.id_reg=pat_result_mcu.id_reg', 'left');
		// batas penambahan, add by rangga 11 Febuari 2015
		$this->db->order_by("serv_name, nama_value", "asc");
		$this->db->where('trx_registration.id_reg', $id_regist);
		$this->db->where('mst_item_value.is_active', 0);
		$this->db->where('mst_item_value.gender', $gender);
		$this->db->where('id_serv_group', 5);
		$this->db->where("$age BETWEEN range_age_1 AND range_age_2");
		//$this->db->limit(3,0); 
		$query = $this->db->get();
		return $query;
	}

	function get_mark_mcu_2($id_regist, $param, $age, $gender)
	{
		$this->db->distinct('serv_name');
		$this->db->select('serv_name,nama_group,mst_services.id_service serpis,trx_registration.id_reg as fingerid, nama_value, mst_item_value.id, result, limit_1, limit_2');
		$this->db->from('trx_registration');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $param . ')', 'left');
		$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('mst_service_group', 'mst_service_group.id_serv_group = mst_services.id_group_serv', 'left');
		$this->db->join('mst_mark_group', 'mst_mark_group.id = mkt_posting_pack_d.group_mark', 'left');
		$this->db->join('mst_item_value', 'mst_item_value.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('pat_result_mcu', 'pat_result_mcu.id_service = mkt_posting_pack_d.service_id and pat_result_mcu.id_value = mst_item_value.id and trx_registration.id_reg=pat_result_mcu.id_reg', 'left');
		// batas penambahan, add by rangga 11 Febuari 2015
		$this->db->order_by("serv_name, mst_item_value.seq_no ", "asc");
		$this->db->where('trx_registration.id_reg', $id_regist);
		$this->db->where('mst_item_value.is_active', 0);
		$this->db->where('mst_item_value.gender', $gender);
		$this->db->where_not_in('id_serv_group', 1);
		$this->db->where_not_in('id_serv_group', 2);
		$this->db->where_not_in('id_serv_group', 5);
		$this->db->where_not_in('id_serv_group', 6);
		$this->db->where("$age BETWEEN range_age_1 AND range_age_2");
		//$this->db->limit(3,0); 
		$query = $this->db->get();
		return $query;
	}

	function get_mark_mcu_3($id_regist, $param)
	{
		$this->db->distinct('serv_name');
		$this->db->select('serv_name,nama_group,mst_services.id_service serpis,trx_registration.id_reg as fingerid, nama_value, mst_item_value.id, result');
		$this->db->from('trx_registration');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $param . ')', 'left');
		$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('mst_service_group', 'mst_service_group.id_serv_group = mst_services.id_group_serv', 'left');
		$this->db->join('mst_mark_group', 'mst_mark_group.id = mkt_posting_pack_d.group_mark', 'left');
		$this->db->join('mst_item_value', 'mst_item_value.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('pat_result_mcu', 'pat_result_mcu.id_service = mkt_posting_pack_d.service_id and pat_result_mcu.id_value = mst_item_value.id', 'left');
		// batas penambahan, add by rangga 11 Febuari 2015
		$this->db->order_by("serv_name, nama_value", "asc");
		$this->db->where('trx_registration.id_reg', $id_regist);
		$this->db->where_not_in('id_serv_group', 1);
		$this->db->where_not_in('id_serv_group', 2);
		//$this->db->where("$age BETWEEN range_age_1 AND range_age_2");
		//$this->db->limit(3,0); 
		$query = $this->db->get();
		return $query;
	}

	function get_mark_mcu($id_regist)
	{
		$this->db->select('*,mst_services.id_service serpis,trx_registration.id_reg as fingerid, trx_registration.id_package as minions');
		$this->db->from('trx_registration');
		$this->db->join('mst_service_package_h', 'mst_service_package_h.id_package = trx_registration.id_package', 'left');
		$this->db->join('mst_service_package_d', 'mst_service_package_d.id_package_header = mst_service_package_h.id_package', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mst_service_package_d.id_service', 'left');
		$this->db->join('pat_ms_h', 'pat_ms_h.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('pat_ms_d', 'pat_ms_d.id_ms_h = pat_ms_h.id_ms_h AND pat_ms_d.id_service = mst_services.id_service', 'left');
		$this->db->join('mst_user', 'mst_user.id = pat_ms_d.sign', 'left');
		$this->db->join('pat_mcu_result', 'pat_mcu_result.id_regist = trx_registration.id_reg', 'left');
		$this->db->join('pat_order_h', 'pat_order_h.id_reg = trx_registration.id_reg', 'left');
		// dibawah ini ditambahkan join untuk melihat radiologi, add by rangga 11 Febuari 2015
		$this->db->join('pat_rad_result', 'pat_rad_result.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('mst_rad_item', 'mst_rad_item.id_rad_item = pat_rad_result.id_rad_item', 'left');
		$this->db->join('mst_rad_group', 'mst_rad_group.id_rad_group = mst_rad_item.rad_item_group', 'left');
		$this->db->join('pat_data', 'pat_data.id_Pat = trx_registration.id_pat', 'left');
		// batas penambahan, add by rangga 11 Febuari 2015
		$this->db->order_by("serv_seq_no", "asc");
		$this->db->where('trx_registration.id_reg', $id_regist);
		$this->db->group_by("mst_services.id_service");
		//$this->db->limit(3,0); 
		$query = $this->db->get();
		return $query;
	}

	function get_mark_mcu_yang_bener($id_regist)
	{
		$this->db->select('*,mst_services.id_service serpis,trx_registration.id_reg as fingerid, trx_registration.id_package as minions');
		$this->db->from('trx_registration');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot = trx_registration.id_package', 'left');
		$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('pat_ms_h', 'pat_ms_h.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('pat_ms_d', 'pat_ms_d.id_ms_h = pat_ms_h.id_ms_h AND pat_ms_d.id_service = mst_services.id_service', 'left');
		$this->db->join('mst_user', 'mst_user.id = pat_ms_d.sign', 'left');
		$this->db->join('pat_mcu_result', 'pat_mcu_result.id_regist = trx_registration.id_reg', 'left');
		$this->db->join('pat_order_h', 'pat_order_h.id_reg = trx_registration.id_reg', 'left');
		// dibawah ini ditambahkan join untuk melihat radiologi, add by rangga 11 Febuari 2015
		$this->db->join('pat_rad_result', 'pat_rad_result.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('mst_rad_item', 'mst_rad_item.id_rad_item = pat_rad_result.id_rad_item', 'left');
		$this->db->join('mst_rad_group', 'mst_rad_group.id_rad_group = mst_rad_item.rad_item_group', 'left');
		// batas penambahan, add by rangga 11 Febuari 2015
		$this->db->order_by("serv_seq_no", "asc");
		$this->db->where('trx_registration.id_reg', $id_regist);
		$this->db->group_by("mst_services.id_service");
		//$this->db->limit(3,0); 
		$query = $this->db->get();
		return $query;
	}

	function get_mark_mcu_yang_bener_baru($id_regist)
	{
		$this->db->select('*, mst_services.id_service AS serpis,trx_registration.id_reg as fingerid, trx_registration.id_package as minions');
		$this->db->from('trx_registration');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot = trx_registration.id_package', 'left');
		$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('pat_ms_h', 'pat_ms_h.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('pat_ms_d', 'pat_ms_d.id_ms_h = pat_ms_h.id_ms_h AND pat_ms_d.id_service = mst_services.id_service', 'left');
		$this->db->join('mst_user', 'mst_user.id = pat_ms_d.sign', 'left');
		$this->db->join('pat_mcu_result', 'pat_mcu_result.id_regist = trx_registration.id_reg', 'left');
		$this->db->join('pat_order_h', 'pat_order_h.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('mst_mark_group', 'mst_mark_group.id = mkt_posting_pack_d.group_mark', 'left');
		$this->db->order_by("mst_mark_group.id", "desc");
		$this->db->where('trx_registration.id_reg', $id_regist);
		$this->db->where('mkt_posting_pack_d.service_id !=0');
		$this->db->group_by("mst_services.id_service");
		//$this->db->limit(3,0); 
		$query = $this->db->get();
		return $query;
	}

	function get_mark_mcu_yang_bener_baru_2($id_regist, $param)
	{
		$this->db->select('group_service,GROUP_CONCAT(DISTINCT(serv_name)," <input type=checkbox>") serv_name,
	mst_services.id_service serpis,
	trx_registration.id_reg AS fingerid,
	trx_registration.id_package AS minions, nama_group');
		$this->db->from('trx_registration');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $param . ')', 'left');
		$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('pat_ms_h', 'pat_ms_h.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('pat_ms_d', 'pat_ms_d.id_ms_h = pat_ms_h.id_ms_h AND pat_ms_d.id_service = mst_services.id_service', 'left');
		$this->db->join('mst_user', 'mst_user.id = pat_ms_d.sign', 'left');
		$this->db->join('pat_mcu_result', 'pat_mcu_result.id_regist = trx_registration.id_reg', 'left');
		$this->db->join('pat_order_h', 'pat_order_h.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('mst_mark_group', 'mst_mark_group.id = mkt_posting_pack_d.group_mark', 'left');
		$this->db->order_by("mst_mark_group.id", "desc");
		$this->db->where('trx_registration.id_reg', $id_regist);
		$this->db->where('mkt_posting_pack_d.service_id !=0');
		$this->db->group_by("group_service");
		//$this->db->limit(3,0); 
		$query = $this->db->get();
		return $query;
	}

	function get_mark_mcu_yang_bener_baru_khusus_cetak($id_regist, $param)
	{
		$query = $this->db->query('
SELECT DISTINCT IFNULL(nama_value, IFNULL(nama_group, serv_name)) serv_name FROM  mkt_posting_pack_h 
     LEFT JOIN mkt_posting_pack_d 
     ON mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot 
     INNER JOIN mst_services 
     ON mst_services.id_service = mkt_posting_pack_d.service_id AND mst_services.`id_group_serv` = mkt_posting_pack_d.`group_service`
     LEFT JOIN mst_lab_item 
     ON mst_lab_item.id_lab_item = mst_services.order_id AND mst_services.`id_group_serv` = 1 
     LEFT JOIN mst_mark_group 
     ON mst_mark_group.id = mst_lab_item.lab_item_sampling
     LEFT JOIN mst_item_value
     ON mkt_posting_pack_d.`group_service` = mst_item_value.`id_group_serv` AND mkt_posting_pack_d.service_id = mst_item_value.`id_service` AND mst_item_value.id_group_serv = 2
WHERE mkt_posting_pack_h.id_quot IN (' . $param . ') 
     ');
		return $query;
	}

	function update_blood_pressure()
	{
		$query = $this->db->query("UPDATE tmp_print_mcu_d SET content_h='Blood Pressure' WHERE content_d LIKE '%Blood Pressure%'");
		return $query;
	}

	function get_mark_mcu_yang_bener_baru_3($id_regist, $param)
	{
		$this->db->select('*,mst_services.id_service serpis,trx_registration.id_reg as fingerid, trx_registration.id_package as minions, id_dr_fee');
		$this->db->from('trx_registration');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $param . ')', 'left');
		$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('mst_service_group', 'mst_services.id_group_serv = mst_service_group.id_serv_group', 'left');
		$this->db->join('pat_ms_h', 'pat_ms_h.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('pat_ms_d', 'pat_ms_d.id_ms_h = pat_ms_h.id_ms_h AND pat_ms_d.id_service = mst_services.id_service', 'left');
		$this->db->join('mst_user', 'mst_user.id = pat_ms_d.sign', 'left');
		$this->db->join('pat_mcu_result', 'pat_mcu_result.id_regist = trx_registration.id_reg', 'left');
		$this->db->join('pat_order_h', 'pat_order_h.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('mst_mark_group', 'mst_mark_group.id = mkt_posting_pack_d.group_mark', 'left');
		$this->db->order_by("group_seq_no", "asc");
		$this->db->where('mkt_posting_pack_d.service_id !=0');
		$this->db->where('trx_registration.id_reg', $id_regist);
		$this->db->group_by("mst_services.id_service");
		//$this->db->limit(3,0); 
		$query = $this->db->get();
		return $query;
	}

	function get_result_comment_lab($id_regist)
	{
		$this->db->select('*');
		$this->db->from('mst_mcu_comment');
		$this->db->join('mst_lab_group', 'mst_lab_group.id_lab_item_group = mst_mcu_comment.id_group', 'left');
		$this->db->where('mst_mcu_comment.order_type', 1);
		$this->db->where('mst_mcu_comment.id_regist', $id_regist);
		$query = $this->db->get();
		return $query;
	}

	function get_result_comment_rad($id_regist)
	{
		$this->db->select('*');
		$this->db->from('mst_mcu_comment');
		$this->db->join('mst_rad_group', 'mst_rad_group.id_rad_group = mst_mcu_comment.id_group', 'left');
		$this->db->where('mst_mcu_comment.order_type', 2);
		$this->db->where('mst_mcu_comment.id_regist', $id_regist);
		$query = $this->db->get();
		return $query;
	}

	function get_mark_mcu2($id_regist)
	{
		$this->db->select('*,mst_services.id_service serpis');
		$this->db->from('trx_registration');
		$this->db->join('mst_service_package_h', 'mst_service_package_h.id_package = trx_registration.id_package', 'left');
		$this->db->join('mst_service_package_d', 'mst_service_package_d.id_package_header = mst_service_package_h.id_package', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mst_service_package_d.id_service', 'left');
		$this->db->join('pat_ms_h', 'pat_ms_h.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('pat_ms_d', 'pat_ms_d.id_ms_h = pat_ms_h.id_ms_h AND pat_ms_d.id_service = mst_services.id_service', 'left');
		$this->db->join('mst_user', 'mst_user.id = pat_ms_d.sign', 'left');
		$this->db->join('pat_mcu_result', 'pat_mcu_result.id_regist = trx_registration.id_reg', 'left');
		$this->db->join('pat_order_h', 'pat_order_h.id_reg = trx_registration.id_reg', 'left');
		// dibawah ini ditambahkan join untuk melihat radiologi, add by rangga 11 Febuari 2015
		$this->db->join('pat_rad_result', 'pat_rad_result.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('mst_rad_item', 'mst_rad_item.id_rad_item = pat_rad_result.id_rad_item', 'left');
		$this->db->join('mst_rad_group', 'mst_rad_group.id_rad_group = mst_rad_item.rad_item_group', 'left');
		// batas penambahan, add by rangga 11 Febuari 2015
		$this->db->order_by("serv_seq_no", "asc");
		$this->db->where('trx_registration.id_reg', $id_regist);
		//$this->db->where_not_in('id_rad_group',9);
		$this->db->group_by("mst_services.id_service");
		//$this->db->limit(3,0); 
		$query = $this->db->get();
		return $query;
	}

	function get_mark_mcu_last($id_regist)
	{
		$this->db->select('*,mst_services.id_service serpis');
		$this->db->from('trx_registration');
		$this->db->join('mst_service_package_h', 'mst_service_package_h.id_package = trx_registration.id_package', 'left');
		$this->db->join('mst_service_package_d', 'mst_service_package_d.id_package_header = mst_service_package_h.id_package', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mst_service_package_d.id_service', 'left');
		$this->db->join('pat_ms_h', 'pat_ms_h.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('pat_ms_d', 'pat_ms_d.id_ms_h = pat_ms_h.id_ms_h AND pat_ms_d.id_service = mst_services.id_service', 'left');
		$this->db->join('mst_user', 'mst_user.id = pat_ms_d.sign', 'left');
		$this->db->join('pat_mcu_result', 'pat_mcu_result.id_regist = trx_registration.id_reg', 'left');
		$this->db->join('pat_order_h', 'pat_order_h.id_reg = trx_registration.id_reg', 'left');
		// dibawah ini ditambahkan join untuk melihat radiologi, add by rangga 11 Febuari 2015
		$this->db->join('pat_rad_result', 'pat_rad_result.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('mst_rad_item', 'mst_rad_item.id_rad_item = pat_rad_result.id_rad_item', 'left');
		$this->db->join('mst_rad_group', 'mst_rad_group.id_rad_group = mst_rad_item.rad_item_group', 'left');
		// batas penambahan, add by rangga 11 Febuari 2015
		$this->db->order_by("serv_seq_no", "asc");
		$this->db->where('trx_registration.id_reg', $id_regist);
		//$this->db->where_not_in('id_rad_group',9);
		$this->db->group_by("mst_services.id_service");
		//$this->db->limit(3,0); 
		$query = $this->db->get();
		return $query;
	}

	// Fungsi ini dibuat untuk melihat radiologi khusus Stomach, add by rangga 16 Febuari 2016
	function get_mark_mcu_rad_stomach($id_pat, $id, $previous, $last)
	{
		$query = $this->db->query("SELECT  id_pat,mst_rad_item.id_rad_item,rad_item,group_desc,A.comment,
	max(case when  id_reg = '" . $id . "' then result ELSE '' END) AS 'now',
	max(case when  id_reg = '" . $previous . "' then result ELSE '' END) AS 'previous',
	max(case when  id_reg = '" . $last . "' then result ELSE '' END) AS 'last'
	FROM pat_rad_result 
	LEFT JOIN mst_rad_item ON mst_rad_item.id_rad_item = pat_rad_result.id_rad_item 
	LEFT JOIN mst_rad_group ON mst_rad_group.id_rad_group = mst_rad_item.rad_item_group 
	LEFT JOIN (SELECT * FROM mst_mcu_comment WHERE id_regist='" . $id . "' AND order_type=2) A ON A.id_group=mst_rad_group.id_rad_group 
	WHERE pat_rad_result.id_pat=" . $id_pat . " AND id_rad_group = 9
	GROUP BY id_pat,id_rad_item,group_desc,rad_item,A.comment;");
		return $query;
	}

	// Fungsi ini dibuat untuk melihat radiologi khusus Pap smear, add by rangga 16 Febuari 2016
	function get_mark_mcu_rad_papsmear($id_regist)
	{
		$this->db->select('*,mst_services.id_service serpis');
		$this->db->from('trx_registration');
		$this->db->join('mst_service_package_h', 'mst_service_package_h.id_package = trx_registration.id_package', 'left');
		$this->db->join('mst_service_package_d', 'mst_service_package_d.id_package_header = mst_service_package_h.id_package', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mst_service_package_d.id_service', 'left');
		$this->db->join('pat_ms_h', 'pat_ms_h.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('pat_ms_d', 'pat_ms_d.id_ms_h = pat_ms_h.id_ms_h AND pat_ms_d.id_service = mst_services.id_service', 'left');
		$this->db->join('mst_user', 'mst_user.id = pat_ms_d.sign', 'left');
		$this->db->join('pat_mcu_result', 'pat_mcu_result.id_regist = trx_registration.id_reg', 'left');
		$this->db->join('pat_order_h', 'pat_order_h.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('pat_rad_result', 'pat_rad_result.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('mst_rad_item', 'mst_rad_item.id_rad_item = pat_rad_result.id_rad_item', 'left');
		$this->db->join('mst_rad_group', 'mst_rad_group.id_rad_group = mst_rad_item.rad_item_group', 'left');
		$this->db->order_by("serv_seq_no", "asc");
		$this->db->where('trx_registration.id_reg', $id_regist);
		$this->db->group_by("mst_services.id_service");
		$query = $this->db->get();
		return $query;
	}

	// Fungsi ini dibuat untuk melihat radiologi khusus Breast Examination, add by rangga 16 Febuari 2016
	function get_mark_mcu_rad_breast($id_regist)
	{
		$this->db->select('*,mst_services.id_service serpis');
		$this->db->from('trx_registration');
		$this->db->join('mst_service_package_h', 'mst_service_package_h.id_package = trx_registration.id_package', 'left');
		$this->db->join('mst_service_package_d', 'mst_service_package_d.id_package_header = mst_service_package_h.id_package', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mst_service_package_d.id_service', 'left');
		$this->db->join('pat_ms_h', 'pat_ms_h.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('pat_ms_d', 'pat_ms_d.id_ms_h = pat_ms_h.id_ms_h AND pat_ms_d.id_service = mst_services.id_service', 'left');
		$this->db->join('mst_user', 'mst_user.id = pat_ms_d.sign', 'left');
		$this->db->join('pat_mcu_result', 'pat_mcu_result.id_regist = trx_registration.id_reg', 'left');
		$this->db->join('pat_order_h', 'pat_order_h.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('pat_rad_result', 'pat_rad_result.id_reg = trx_registration.id_reg', 'left');
		$this->db->join('mst_rad_item', 'mst_rad_item.id_rad_item = pat_rad_result.id_rad_item', 'left');
		$this->db->join('mst_rad_group', 'mst_rad_group.id_rad_group = mst_rad_item.rad_item_group', 'left');
		$this->db->order_by("serv_seq_no", "asc");
		$this->db->where('trx_registration.id_reg', $id_regist);
		$this->db->group_by("mst_services.id_service");
		$query = $this->db->get();
		return $query;
	}

	// Fungsi ini dibuat untuk melihat radiologi khusus Dental, add by rangga 16 Febuari 2016
	function get_mark_mcu_rad_dental($id_pat, $id, $previous, $last)
	{
		$query = $this->db->query("SELECT trx_registration.id_pat,
	max(case when  id_reg = '" . $id . "' then dnt_hygn ELSE '' END) AS 'now_hygn',
	max(case when  id_reg = '" . $previous . "' then dnt_hygn ELSE '' END) AS 'previous_hygn',
	max(case when  id_reg = '" . $last . "' then dnt_hygn ELSE '' END) AS 'last_hygn',
    max(case when  id_reg = '" . $id . "' then dnt_oral ELSE '' END) AS 'now_oral',
	max(case when  id_reg = '" . $previous . "' then dnt_oral ELSE '' END) AS 'previous_oral',
	max(case when  id_reg = '" . $last . "' then dnt_oral ELSE '' END) AS 'last_oral',
    max(case when  id_reg = '" . $id . "' then dnt_pnrm ELSE '' END) AS 'now_pnrm',
	max(case when  id_reg = '" . $previous . "' then dnt_pnrm ELSE '' END) AS 'previous_pnrm',
	max(case when  id_reg = '" . $last . "' then dnt_pnrm ELSE '' END) AS 'last_pnrm',
    max(case when  id_reg = '" . $id . "' then dnt_inor ELSE '' END) AS 'now_inor',
	max(case when  id_reg = '" . $previous . "' then dnt_inor ELSE '' END) AS 'previous_inor',
	max(case when  id_reg = '" . $last . "' then dnt_inor ELSE '' END) AS 'last_inor',
    max(case when  id_reg = '" . $id . "' then dnt_impc ELSE '' END) AS 'now_impc',
	max(case when  id_reg = '" . $previous . "' then dnt_impc ELSE '' END) AS 'previous_impc',
	max(case when  id_reg = '" . $last . "' then dnt_impc ELSE '' END) AS 'last_impc',
    max(case when  id_reg = '" . $id . "' then dnt_brok ELSE '' END) AS 'now_brok',
	max(case when  id_reg = '" . $previous . "' then dnt_brok ELSE '' END) AS 'previous_brok',
	max(case when  id_reg = '" . $last . "' then dnt_brok ELSE '' END) AS 'last_brok',
    max(case when  id_reg = '" . $id . "' then dnt_cyst ELSE '' END) AS 'now_cyst',
	max(case when  id_reg = '" . $previous . "' then dnt_cyst ELSE '' END) AS 'previous_cyst',
	max(case when  id_reg = '" . $last . "' then dnt_cyst ELSE '' END) AS 'last_cyst',
    max(case when  id_reg = '" . $id . "' then dnt_mobi ELSE '' END) AS 'now_mobi',
	max(case when  id_reg = '" . $previous . "' then dnt_mobi ELSE '' END) AS 'previous_mobi',
	max(case when  id_reg = '" . $last . "' then dnt_mobi ELSE '' END) AS 'last_mobi',
    max(case when  id_reg = '" . $id . "' then dnt_calc ELSE '' END) AS 'now_calc',
	max(case when  id_reg = '" . $previous . "' then dnt_calc ELSE '' END) AS 'previous_calc',
	max(case when  id_reg = '" . $last . "' then dnt_calc ELSE '' END) AS 'last_calc',
    max(case when  id_reg = '" . $id . "' then dnt_cari ELSE '' END) AS 'now_cari',
	max(case when  id_reg = '" . $previous . "' then dnt_cari ELSE '' END) AS 'previous_cari',
	max(case when  id_reg = '" . $last . "' then dnt_cari ELSE '' END) AS 'last_cari',
    max(case when  id_reg = '" . $id . "' then dnt_fill ELSE '' END) AS 'now_fill',
	max(case when  id_reg = '" . $previous . "' then dnt_fill ELSE '' END) AS 'previous_fill',
	max(case when  id_reg = '" . $last . "' then dnt_fill ELSE '' END) AS 'last_fill',
    max(case when  id_reg = '" . $id . "' then dnt_miss ELSE '' END) AS 'now_miss',
	max(case when  id_reg = '" . $previous . "' then dnt_miss ELSE '' END) AS 'previous_miss',
	max(case when  id_reg = '" . $last . "' then dnt_miss ELSE '' END) AS 'last_miss',
	max(case when  id_reg = '" . $id . "' then dnt_comment ELSE '' END) AS 'now_comment',
	max(case when  id_reg = '" . $previous . "' then dnt_comment ELSE '' END) AS 'previous_comment',
	max(case when  id_reg = '" . $last . "' then dnt_comment ELSE '' END) AS 'last_comment'
	FROM pat_mcu_result 
	INNER JOIN trx_registration on pat_mcu_result.id_regist=trx_registration.id_reg
	WHERE trx_registration.id_pat=" . $id_pat . "
	GROUP BY trx_registration.id_pat;");
		return $query;
	}

	// Fungsi ini dibuat untuk melihat radiologi khusus grade, add by rangga 16 Febuari 2016
	function get_mst_judgment_grade($id_pat, $id, $previous, $last)
	{
		$query = $this->db->query("SELECT id_pat,
		max(case when  id_registration ='" . $id . "' then Obesitas ELSE '' END) AS 'now_Obesitas',
		max(case when  id_registration='" . $previous . "' then Obesitas ELSE '' END) AS 'previous_Obesitas',
		max(case when  id_registration= '" . $last . "' then Obesitas ELSE '' END) AS 'last_Obesitas',

		max(case when  id_registration ='" . $id . "' then Eyes_Sight ELSE '' END) AS 'now_Eyes_Sight',
		max(case when  id_registration='" . $previous . "' then Eyes_Sight ELSE '' END) AS 'previous_Eyes_Sight',
		max(case when  id_registration= '" . $last . "' then Eyes_Sight ELSE '' END) AS 'last_Eyes_Sight',

		max(case when  id_registration ='" . $id . "' then Ocular_Tension ELSE '' END) AS 'now_Ocular_Tension',
		max(case when  id_registration='" . $previous . "' then Ocular_Tension ELSE '' END) AS 'previous_Ocular_Tension',
		max(case when  id_registration= '" . $last . "' then Ocular_Tension ELSE '' END) AS 'last_Ocular_Tension',

		max(case when  id_registration ='" . $id . "' then Color_Blindness ELSE '' END) AS 'now_Color_Blindness',
		max(case when  id_registration='" . $previous . "' then Color_Blindness ELSE '' END) AS 'previous_Color_Blindness',
		max(case when  id_registration= '" . $last . "' then Color_Blindness ELSE '' END) AS 'last_Color_Blindness',

		max(case when  id_registration ='" . $id . "' then Fundus ELSE '' END) AS 'now_Fundus',
		max(case when  id_registration='" . $previous . "' then Fundus ELSE '' END) AS 'previous_Fundus',
		max(case when  id_registration= '" . $last . "' then Fundus ELSE '' END) AS 'last_Fundus',

		max(case when  id_registration ='" . $id . "' then Hearing ELSE '' END) AS 'now_Hearing',
		max(case when  id_registration='" . $previous . "' then Hearing ELSE '' END) AS 'previous_Hearing',
		max(case when  id_registration= '" . $last . "' then Hearing ELSE '' END) AS 'last_Hearing',

		max(case when  id_registration ='" . $id . "' then Blood_Pressure ELSE '' END) AS 'now_Blood_Pressure',
		max(case when  id_registration='" . $previous . "' then Blood_Pressure ELSE '' END) AS 'previous_Blood_Pressure',
		max(case when  id_registration= '" . $last . "' then Blood_Pressure ELSE '' END) AS 'last_Blood_Pressure',

		max(case when  id_registration ='" . $id . "' then Lung_Function ELSE '' END) AS 'now_Lung_Function',
		max(case when  id_registration='" . $previous . "' then Lung_Function ELSE '' END) AS 'previous_Lung_Function',
		max(case when  id_registration= '" . $last . "' then Lung_Function ELSE '' END) AS 'last_Lung_Function',

		max(case when  id_registration ='" . $id . "' then Urine_Analysis ELSE '' END) AS 'now_Urine_Analysis',
		max(case when  id_registration='" . $previous . "' then Urine_Analysis ELSE '' END) AS 'previous_Urine_Analysis',
		max(case when  id_registration= '" . $last . "' then Urine_Analysis ELSE '' END) AS 'last_Urine_Analysis',

		max(case when  id_registration ='" . $id . "' then Urine_Sediment ELSE '' END) AS 'now_Urine_Sediment',
		max(case when  id_registration='" . $previous . "' then Urine_Sediment ELSE '' END) AS 'previous_Urine_Sediment',
		max(case when  id_registration= '" . $last . "' then Urine_Sediment ELSE '' END) AS 'last_Urine_Sediment',

		max(case when  id_registration ='" . $id . "' then OB ELSE '' END) AS 'now_OB',
		max(case when  id_registration='" . $previous . "' then OB ELSE '' END) AS 'previous_OB',
		max(case when  id_registration= '" . $last . "' then OB ELSE '' END) AS 'last_OB',

		max(case when  id_registration ='" . $id . "' then Liver_Function ELSE '' END) AS 'now_Liver_Function',
		max(case when  id_registration='" . $previous . "' then Liver_Function ELSE '' END) AS 'previous_Liver_Function',
		max(case when  id_registration= '" . $last . "' then Liver_Function ELSE '' END) AS 'last_Liver_Function',

		max(case when  id_registration ='" . $id . "' then Renal ELSE '' END) AS 'now_Renal',
		max(case when  id_registration='" . $previous . "' then Renal ELSE '' END) AS 'previous_Renal',
		max(case when  id_registration= '" . $last . "' then Renal ELSE '' END) AS 'last_Renal',

		max(case when  id_registration ='" . $id . "' then Pancreas ELSE '' END) AS 'now_Pancreas',
		max(case when  id_registration='" . $previous . "' then Pancreas ELSE '' END) AS 'previous_Pancreas',
		max(case when  id_registration= '" . $last . "' then Pancreas ELSE '' END) AS 'last_Pancreas',

		max(case when  id_registration ='" . $id . "' then Uric_Acid ELSE '' END) AS 'now_Uric_Acid',
		max(case when  id_registration='" . $previous . "' then Uric_Acid ELSE '' END) AS 'previous_Uric_Acid',
		max(case when  id_registration= '" . $last . "' then Uric_Acid ELSE '' END) AS 'last_Uric_Acid',

		max(case when  id_registration ='" . $id . "' then Lipid ELSE '' END) AS 'now_Lipid',
		max(case when  id_registration='" . $previous . "' then Lipid ELSE '' END) AS 'previous_Lipid',
		max(case when  id_registration= '" . $last . "' then Lipid ELSE '' END) AS 'last_Lipid',

		max(case when  id_registration ='" . $id . "' then Electrolyte ELSE '' END) AS 'now_Electrolyte',
		max(case when  id_registration='" . $previous . "' then Electrolyte ELSE '' END) AS 'previous_Electrolyte',
		max(case when  id_registration= '" . $last . "' then Electrolyte ELSE '' END) AS 'last_Electrolyte',

		max(case when  id_registration ='" . $id . "' then Hematology ELSE '' END) AS 'now_Hematology',
		max(case when  id_registration='" . $previous . "' then Hematology ELSE '' END) AS 'previous_Hematology',
		max(case when  id_registration= '" . $last . "' then Hematology ELSE '' END) AS 'last_Hematology',

		max(case when  id_registration ='" . $id . "' then WBC_Classification ELSE '' END) AS 'now_WBC_Classification',
		max(case when  id_registration='" . $previous . "' then WBC_Classification ELSE '' END) AS 'previous_WBC_Classification',
		max(case when  id_registration= '" . $last . "' then WBC_Classification ELSE '' END) AS 'last_WBC_Classification',

		max(case when  id_registration ='" . $id . "' then Inflammation ELSE '' END) AS 'now_Inflammation',
		max(case when  id_registration='" . $previous . "' then Inflammation ELSE '' END) AS 'previous_Inflammation',
		max(case when  id_registration= '" . $last . "' then Inflammation ELSE '' END) AS 'last_Inflammation',

		max(case when  id_registration ='" . $id . "' then Syphilis ELSE '' END) AS 'now_Syphilis',
		max(case when  id_registration='" . $previous . "' then Syphilis ELSE '' END) AS 'previous_Syphilis',
		max(case when  id_registration= '" . $last . "' then Syphilis ELSE '' END) AS 'last_Syphilis',

		max(case when  id_registration ='" . $id . "' then Serology_Hepatitis ELSE '' END) AS 'now_Serology_Hepatitis',
		max(case when  id_registration='" . $previous . "' then Serology_Hepatitis ELSE '' END) AS 'previous_Serology_Hepatitis',
		max(case when  id_registration= '" . $last . "' then Serology_Hepatitis ELSE '' END) AS 'last_Serology_Hepatitis',

		max(case when  id_registration ='" . $id . "' then Others ELSE '' END) AS 'now_Others',
		max(case when  id_registration='" . $previous . "' then Others ELSE '' END) AS 'previous_Others',
		max(case when  id_registration= '" . $last . "' then Others ELSE '' END) AS 'last_Others',

		max(case when  id_registration ='" . $id . "' then Immunology_Test ELSE '' END) AS 'now_Immunology_Test',
		max(case when  id_registration='" . $previous . "' then Immunology_Test ELSE '' END) AS 'previous_Immunology_Test',
		max(case when  id_registration= '" . $last . "' then Immunology_Test ELSE '' END) AS 'last_Immunology_Test',

		max(case when  id_registration ='" . $id . "' then Diabetes_Mellitus ELSE '' END) AS 'now_Diabetes_Mellitus',
		max(case when  id_registration='" . $previous . "' then Diabetes_Mellitus ELSE '' END) AS 'previous_Diabetes_Mellitus',
		max(case when  id_registration= '" . $last . "' then Diabetes_Mellitus ELSE '' END) AS 'last_Diabetes_Mellitus',

		max(case when  id_registration ='" . $id . "' then Urine_Glucose ELSE '' END) AS 'now_Urine_Glucose',
		max(case when  id_registration='" . $previous . "' then Urine_Glucose ELSE '' END) AS 'previous_Urine_Glucose',
		max(case when  id_registration= '" . $last . "' then Urine_Glucose ELSE '' END) AS 'last_Urine_Glucose',

		max(case when  id_registration ='" . $id . "' then Tumor_Marker ELSE '' END) AS 'now_Tumor_Marker',
		max(case when  id_registration='" . $previous . "' then Tumor_Marker ELSE '' END) AS 'previous_Tumor_Marker',
		max(case when  id_registration= '" . $last . "' then Tumor_Marker ELSE '' END) AS 'last_Tumor_Marker',

		max(case when  id_registration ='" . $id . "' then Chest_Xray ELSE '' END) AS 'now_Chest_Xray',
		max(case when  id_registration='" . $previous . "' then Chest_Xray ELSE '' END) AS 'previous_Chest_Xray',
		max(case when  id_registration= '" . $last . "' then Chest_Xray ELSE '' END) AS 'last_Chest_Xray',

		max(case when  id_registration ='" . $id . "' then Xray_Shadow ELSE '' END) AS 'now_Xray_Shadow',
		max(case when  id_registration='" . $previous . "' then Xray_Shadow ELSE '' END) AS 'previous_Xray_Shadow',
		max(case when  id_registration= '" . $last . "' then Xray_Shadow ELSE '' END) AS 'last_Xray_Shadow',

		max(case when  id_registration ='" . $id . "' then Sputum ELSE '' END) AS 'now_Sputum',
		max(case when  id_registration='" . $previous . "' then Sputum ELSE '' END) AS 'previous_Sputum',
		max(case when  id_registration= '" . $last . "' then Sputum ELSE '' END) AS 'last_Sputum',

		max(case when  id_registration ='" . $id . "' then ECG ELSE '' END) AS 'now_ECG',
		max(case when  id_registration='" . $previous . "' then ECG ELSE '' END) AS 'previous_ECG',
		max(case when  id_registration= '" . $last . "' then ECG ELSE '' END) AS 'last_ECG',

		max(case when  id_registration ='" . $id . "' then Treadmill ELSE '' END) AS 'now_Treadmill',
		max(case when  id_registration='" . $previous . "' then Treadmill ELSE '' END) AS 'previous_Treadmill',
		max(case when  id_registration= '" . $last . "' then Treadmill ELSE '' END) AS 'last_Treadmill',

		max(case when  id_registration ='" . $id . "' then Echocardiographi ELSE '' END) AS 'now_Echocardiographi',
		max(case when  id_registration='" . $previous . "' then Echocardiographi ELSE '' END) AS 'previous_Echocardiographi',
		max(case when  id_registration= '" . $last . "' then Echocardiographi ELSE '' END) AS 'last_Echocardiographi',

		max(case when  id_registration ='" . $id . "' then USG ELSE '' END) AS 'now_usg',
		max(case when  id_registration='" . $previous . "' then USG ELSE '' END) AS 'previous_usg',
		max(case when  id_registration= '" . $last . "' then USG ELSE '' END) AS 'last_usg',

		max(case when  id_registration ='" . $id . "' then USG_Prostate ELSE '' END) AS 'now_usgpros',
		max(case when  id_registration='" . $previous . "' then USG_Prostate ELSE '' END) AS 'previous_usgpro',
		max(case when  id_registration= '" . $last . "' then USG_Prostate ELSE '' END) AS 'last_usgpros',

		max(case when  id_registration ='" . $id . "' then USG_Uterus ELSE '' END) AS 'now_usgut',
		max(case when  id_registration='" . $previous . "' then USG_Uterus ELSE '' END) AS 'previous_usgut',
		max(case when  id_registration= '" . $last . "' then USG_Uterus ELSE '' END) AS 'last_usgut',

		max(case when  id_registration ='" . $id . "' then USG_Mammae ELSE '' END) AS 'now_usgmam',
		max(case when  id_registration='" . $previous . "' then USG_Mammae ELSE '' END) AS 'previous_usgmam',
		max(case when  id_registration= '" . $last . "' then USG_Mammae ELSE '' END) AS 'last_usgmam',
		
		max(case when  id_registration ='" . $id . "' then Stomach_Xray ELSE '' END) AS 'now_stomach',
		max(case when  id_registration='" . $previous . "' then Stomach_Xray ELSE '' END) AS 'previous_stomach',
		max(case when  id_registration= '" . $last . "' then Stomach_Xray ELSE '' END) AS 'last_stomach',

		max(case when  id_registration ='" . $id . "' then Pap_Smear ELSE '' END) AS 'now_pap',
		max(case when  id_registration='" . $previous . "' then Pap_Smear ELSE '' END) AS 'previous_pap',
		max(case when  id_registration= '" . $last . "' then Pap_Smear ELSE '' END) AS 'last_pap',
	   
		max(case when  id_registration = '" . $id . "' then Breast_Examination ELSE '' END) AS 'now_breast',
		max(case when  id_registration= '" . $previous . "' then Breast_Examination ELSE '' END) AS 'previous_breast',
		max(case when  id_registration= '" . $last . "' then Breast_Examination ELSE '' END) AS 'last_breast',
		
		max(case when  id_registration = '" . $id . "' then Panoramic_Xray ELSE '' END) AS 'now_panoramic',
		max(case when  id_registration= '" . $previous . "' then Panoramic_Xray ELSE '' END) AS 'previous_panoramic',
		max(case when  id_registration= '" . $last . "' then Panoramic_Xray ELSE '' END) AS 'last_panoramic',

		max(case when  id_registration = '" . $id . "' then Extra_Oral ELSE '' END) AS 'now_Extra_Oral',
		max(case when  id_registration= '" . $previous . "' then Extra_Oral ELSE '' END) AS 'previous_Extra_Oral',
		max(case when  id_registration= '" . $last . "' then Extra_Oral ELSE '' END) AS 'last_Extra_Oral',

		max(case when  id_registration = '" . $id . "' then Intra_Oral ELSE '' END) AS 'now_intra_oral',
		max(case when  id_registration= '" . $previous . "' then Intra_Oral ELSE '' END) AS 'previous_intra_oral',
		max(case when  id_registration= '" . $last . "' then Intra_Oral ELSE '' END) AS 'last_intra_oral',

		max(case when  id_registration = '" . $id . "' then Dental_Hygine ELSE '' END) AS 'now_dental_hygn',
		max(case when  id_registration= '" . $previous . "' then Dental_Hygine ELSE '' END) AS 'previous_dental_hygn',
		max(case when  id_registration= '" . $last . "' then Dental_Hygine ELSE '' END) AS 'last_dental_hygn'
	FROM kyoaims.mst_judgment_grade
	WHERE id_pat='" . $id_pat . "'
	GROUP BY id_pat;");
		return $query;
	}

	/* function get_mst_judgment_grade($id_regist){
	$this->db->from('mst_judgment_grade');
	$this->db->where('id_registration',$id_regist);
	$query = $this->db->get();
	return $query;
	} */

	function get_mark_mcu_lab2($id_pat, $id, $previous, $last)
	{ // Fungsi ini dibuat untuk melihat radiologi, add by rangga 11 Febuari 2016
		$query = $this->db->query("SELECT id_pat,mst_lab_item.id_lab_item,group_name,lab_item_desc,A.comment,
	max(case when  id_reg = '" . $id . "' then result_value ELSE '' END) AS 'now',
	max(case when  id_reg = '" . $previous . "' then result_value ELSE '' END) AS 'previous',
	max(case when  id_reg = '" . $last . "' then result_value ELSE '' END) AS 'last'
	FROM pat_lab_result 
	LEFT JOIN mst_lab_item ON mst_lab_item.id_lab_item = pat_lab_result.id_lab_item 
	LEFT JOIN mst_lab_group ON mst_lab_group.id_lab_item_group = pat_lab_result.lab_item_group 
	LEFT JOIN (SELECT * FROM mst_mcu_comment WHERE id_regist='" . $id . "' AND order_type=1) A ON A.id_group=mst_lab_group.id_lab_item_group
	WHERE pat_lab_result.id_pat=" . $id_pat . "
	GROUP BY id_pat,mst_lab_item.id_lab_item,group_name,lab_item_desc,A.comment;");
		return $query;
	}

	function get_mark_mcu_lab($id_pat, $id, $previous, $last)
	{ // Fungsi ini dibuat untuk melihat radiologi, add by rangga 11 Febuari 2016
		$query = $this->db->query("SELECT * FROM (
			SELECT id_pat,mst_lab_item.id_lab_item,group_name,lab_item_desc,
			MAX(CASE WHEN id_reg = '" . $id . "' THEN result_value ELSE '' END) AS 'now', 
			MAX(CASE WHEN id_reg = '" . $previous . "' THEN result_value ELSE '' END) AS 'previous', 
			MAX(CASE WHEN id_reg = '" . $last . "' THEN result_value ELSE '' END) AS 'last' 
			FROM pat_lab_result 
			LEFT JOIN mst_lab_item ON mst_lab_item.id_lab_item = pat_lab_result.id_lab_item 
			LEFT JOIN mst_lab_group ON mst_lab_group.id_lab_item_group = pat_lab_result.lab_item_group 
			WHERE pat_lab_result.id_pat=" . $id_pat . "
			GROUP BY id_pat,mst_lab_item.id_lab_item,group_name,lab_item_desc
			UNION ALL
			SELECT id_pat,'comment' AS lab,group_name,COMMENT,'' AS NOW,'' AS previous,'' AS LAST FROM mst_mcu_comment 
			INNER JOIN trx_registration ON trx_registration.id_reg=mst_mcu_comment.id_regist
			INNER JOIN mst_lab_group ON mst_lab_group.id_lab_item_group=mst_mcu_comment.id_group
			WHERE id_regist='" . $id . "' and order_type='1'
			) aa
			ORDER BY group_name,id_lab_item;");
		return $query;
	}

	// Fungsi ini dibuat untuk melihat radiologi, add by rangga 11 Febuari 2016
	function get_mark_mcu_rad($id_pat, $id, $previous, $last)
	{
		$query = $this->db->query("SELECT  id_pat,mst_rad_item.id_rad_item,rad_item,group_desc,A.comment,
	max(case when  id_reg = '" . $id . "' then result ELSE '' END) AS 'now',
	max(case when  id_reg = '" . $previous . "' then result ELSE '' END) AS 'previous',
	max(case when  id_reg = '" . $last . "' then result ELSE '' END) AS 'last'
	FROM pat_rad_result 
	LEFT JOIN mst_rad_item ON mst_rad_item.id_rad_item = pat_rad_result.id_rad_item 
	LEFT JOIN mst_rad_group ON mst_rad_group.id_rad_group = mst_rad_item.rad_item_group 
	LEFT JOIN (SELECT * FROM mst_mcu_comment WHERE id_regist='" . $id . "' AND order_type=2) A ON A.id_group=mst_rad_group.id_rad_group 
	WHERE pat_rad_result.id_pat=" . $id_pat . " AND id_rad_group NOT IN (9,15,16)
	GROUP BY id_pat,id_rad_item,group_desc,rad_item,A.comment;");
		return $query;
	}

	function get_patient_data()
	{
		$this->db->select('id_reg,reg_date,pat_name,pat_dob,pat_pob,gender,pat_MRN,title_desc,pat_data.id_Pat,client_name,pat_charge_rule,price_type,create_date');
		$this->db->from('pat_data');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('trx_registration', 'trx_registration.id_pat = pat_data.id_Pat', 'inner');
		$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left');
		$this->db->join('mst_client', 'mst_client.id_client = trx_registration.id_client', 'left');
		$this->db->join('mst_price_type', 'mst_price_type.id_price_type = trx_registration.pat_charge_rule', 'inner');
		$this->db->where('trx_registration.status_reg', 0);
		$this->db->order_by("create_date", "desc");
		//$this->db->where('pat_data.id_pat', 21);
		$this->db->limit(1500);
		$query = $this->db->get();
		return $query;
	}

	function get_patient_data_doctor()
	{
		$this->db->select('id_reg,reg_date,pat_name,pat_dob,pat_pob,gender,pat_MRN,title_desc,pat_data.id_Pat,client_name');
		$this->db->from('pat_data');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('trx_registration', 'trx_registration.id_pat = pat_data.id_Pat', 'inner');
		$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left');
		$this->db->join('mst_client', 'mst_client.id_client = trx_registration.id_client', 'left');
		$this->db->order_by("id_reg", "desc");
		//$this->db->where('pat_data.id_pat', 21);
		$this->db->limit(1500);
		$query = $this->db->get();
		return $query;
	}

	function get_print_mark($id)
	{
		$this->db->select('reg_date,id_reg,pat_name,pat_dob,pat_pob,gender,pat_MRN,pat_name,title_desc,id_reg,mkt_posting_pack_h.quot_name package_name,client_name,client_address1');
		$this->db->from('pat_data');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('trx_registration', 'trx_registration.id_pat = pat_data.id_Pat', 'inner');
		$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot = trx_registration.id_package', 'left');
		$this->db->join('mst_client', 'mst_client.id_Client = trx_registration.id_client', 'left');
		$this->db->order_by("reg_date", "desc");
		$this->db->where('id_reg', $id);
		$query = $this->db->get();
		return $query;
	}

	function get_data_patien_reg($id)
	{
		$this->db->select('*,trx_registration.id_package as dodol');
		$this->db->from('pat_data');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('trx_registration', 'trx_registration.id_pat = pat_data.id_Pat', 'inner');
		$this->db->join('mst_price_type', 'trx_registration.pat_charge_rule=mst_price_type.id_price_type', 'inner');
		$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'inner');
		$this->db->join('mst_service_package_h', 'mst_service_package_h.id_package = trx_registration.id_package', 'left');
		$this->db->join('mst_client', 'mst_client.id_Client = trx_registration.id_client', 'left');
		$this->db->order_by("reg_date", "desc");
		$this->db->where('id_reg', $id);
		$query = $this->db->get();
		return $query;
	}

	function get_list_trx_bh($id)
	{
		$this->db->from('trx_bh');
		$this->db->where('id_reg', $id);
		$this->db->or_where('id_bh', $id);
		$query = $this->db->get();
		return $query;
	}

	function del_list_trx_bh($id_bh)
	{
		$this->db->delete('trx_bh', array('id_bh' => $id_bh));
	}

	function del_list_trx_bd($id_bh)
	{
		$this->db->delete('trx_bd', array('id_bh' => $id_bh));
	}

	function get_patient_data_all()
	{
		$this->db->select('*');
		$this->db->from('pat_data');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('mst_client', 'mst_client.id_Client = pat_data.id_client', 'left');
		$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left');
		$this->db->join('mst_provinsi', 'pat_data.pat_province=mst_provinsi.provinsi_id', 'left');
		$this->db->join('mst_kota', 'pat_data.pat_city=mst_kota.kota_id', 'left');
		$this->db->join('mst_nationality', 'pat_data.pat_nationality=mst_nationality.id_nationality', 'left');
		$this->db->where('status_pat', 0);
		$this->db->order_by('pat_data.id_Pat', 'desc');
		$query = $this->db->get();
		return $query;
	}

	function get_patient_data_now()
	{
		$tgl = date("Y-m-d");
		$this->db->select('*');
		$this->db->from('pat_data');
		$this->db->join('trx_registration', 'pat_data.id_pat=trx_registration.id_pat', 'left');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('mst_client', 'trx_registration.id_client=mst_client.id_Client', 'left');
		$this->db->join('mst_service_package_h', 'trx_registration.id_package=mst_service_package_h.id_package', 'left');
		// $this->db->join('mst_service_package_d', 'mst_service_package_h.id_package=mst_service_package_d.id_package_header', 'left'); // Biki doubel jadi nnti get mst_service_package_d setelah muncul data
		$this->db->where('trx_registration.reg_date', $tgl);
		$query = $this->db->get();
		return $query;
	}

	function get_patient_data_mcu()
	{
		$this->db->select('*');
		$this->db->from('pat_data');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('trx_registration', 'trx_registration.id_pat = pat_data.id_Pat', 'inner');
		$this->db->join('pat_qst_mcu', 'pat_qst_mcu.id_pat = pat_data.pat_mrn', 'inner');
		$query = $this->db->get();
		return $query;
	}

	function get_data_mcu_patient($register_id, $id_service, $id_value)
	{
		$this->db->from('pat_result_mcu');
		$this->db->where('id_reg', $register_id);
		$this->db->where('id_service', $id_service);
		$this->db->where('id_value', $id_value);
		$query = $this->db->get();
		return $query;
	}

	function get_data_mcu_patient_note($register_id)
	{
		$this->db->from('pat_result_mcu');
		$this->db->where('id_reg', $register_id);
		$this->db->where('id_service', 99999);
		$query = $this->db->get();
		return $query;
	}

	function get_data_mcu_patient_2($register_id)
	{
		$this->db->from('pat_mcu_result');
		$this->db->where('id_regist', $register_id);
		$query = $this->db->get();
		return $query;
	}

	function get_billing_mcu($id_reg, $babydragon)
	{
		$this->db->from('pat_data');
		$this->db->join('trx_registration', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('mst_service_package_h', 'mst_service_package_h.id_package in (' . $babydragon . ')', 'inner');
		$this->db->join('mst_service_package_d', 'mst_service_package_h.id_package=mst_service_package_d.id_package_header', 'inner');
		$this->db->where('id_reg', $id_reg);
		$query = $this->db->get();
		return $query;
	}

	function get_billing_mcu_list($id_reg, $babydragon)
	{
		$this->db->distinct('package_name, grand_total');
		$this->db->select('package_name, grand_total');
		$this->db->from('pat_data');
		$this->db->join('trx_registration', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('mst_service_package_h', 'mst_service_package_h.id_package in (' . $babydragon . ')', 'inner');
		$this->db->join('mst_service_package_d', 'mst_service_package_h.id_package=mst_service_package_d.id_package_header', 'inner');
		$this->db->where('id_reg', $id_reg);
		$query = $this->db->get();
		return $query;
	}

	function get_data_mcu_result($register_id)
	{
		$this->db->from('pat_result_mcu');
		$this->db->where('id_reg', $register_id);
		$query = $this->db->get();
		return $query;
	}

	//print detail lab
	function get_data_detail_lab_hasil_mcu($id_reg)
	{
		$this->db->distinct('pat_lab_result.id_lab_result, pat_lab_result.id_order, pat_lab_result.id_reg, pat_lab_result.id_pat, pat_lab_result.id_lab_item, pat_lab_result.id_lab_range, pat_lab_result.result_value, pat_lab_result.revision, pat_lab_result.std_value, pat_lab_result.name_type, pat_lab_result.name_jp, pat_lab_result.lab_item_group, pat_lab_result.seq_no, pat_lab_result.is_normal, pat_lab_result.remarks, pat_lab_result.ref_no, pat_lab_result.create_date, pat_lab_result.create_by, mst_lab_item.id_lab_item AS id_service, mst_lab_item.lab_item_desc, mst_lab_item.lab_item_name_j, mst_lab_item.lab_item_abbr, mst_lab_item.lab_item_unit, mst_lab_item.lab_item_group, mst_lab_item.lab_item_seq_no, mst_lab_item.lab_item_case, mst_lab_item.lab_item_sampling, mst_lab_group.id_lab_item_group, mst_lab_group.group_name, mst_lab_group.group_name_j, mst_lab_group.group_mark, mst_lab_group.group_seq_no, mst_lab_group.is_active, mst_lab_item_range.id_lab_item_range AS id_item_value, mst_lab_item_range.id_lab_item, mst_lab_item_range.type_lab, mst_lab_item_range.name_type, mst_lab_item_range.name_j, mst_lab_item_range.std_value, mst_lab_item_range.low_limit, mst_lab_item_range.high_limit, mst_lab_item_range.min_limit, mst_lab_item_range.max_limit, mst_lab_item_range.age_range_1, mst_lab_item_range.age_range_2, mst_lab_item_range.pat_gender, mst_lab_item_range.is_active, mst_lab_item_range.unit as unitxx');
		$this->db->select('pat_lab_result.id_lab_result, pat_lab_result.id_order, pat_lab_result.id_reg, pat_lab_result.id_pat, pat_lab_result.id_lab_item, pat_lab_result.id_lab_range, pat_lab_result.result_value, pat_lab_result.revision, pat_lab_result.std_value, pat_lab_result.name_type, pat_lab_result.name_jp, pat_lab_result.lab_item_group, pat_lab_result.seq_no, pat_lab_result.is_normal, pat_lab_result.remarks, pat_lab_result.ref_no, pat_lab_result.create_date, pat_lab_result.create_by, mst_lab_item.id_lab_item AS id_service, mst_lab_item.lab_item_desc, mst_lab_item.lab_item_name_j, mst_lab_item.lab_item_abbr, mst_lab_item.lab_item_unit, mst_lab_item.lab_item_group, mst_lab_item.lab_item_seq_no, mst_lab_item.lab_item_case, mst_lab_item.lab_item_sampling, mst_lab_group.id_lab_item_group, mst_lab_group.group_name, mst_lab_group.group_name_j, mst_lab_group.group_mark, mst_lab_group.group_seq_no, mst_lab_group.is_active, mst_lab_item_range.id_lab_item_range AS id_item_value, mst_lab_item_range.id_lab_item, mst_lab_item_range.type_lab, mst_lab_item_range.name_type, mst_lab_item_range.name_j, mst_lab_item_range.std_value, mst_lab_item_range.low_limit, mst_lab_item_range.high_limit, mst_lab_item_range.min_limit, mst_lab_item_range.max_limit, mst_lab_item_range.age_range_1, mst_lab_item_range.age_range_2, mst_lab_item_range.pat_gender, mst_lab_item_range.is_active, mst_lab_item_range.unit as unitxx');
		$this->db->from('pat_lab_result');
		$this->db->join('mst_lab_item', 'mst_lab_item.id_lab_item = pat_lab_result.id_lab_item', 'left');
		$this->db->join('mst_lab_group', 'mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group', 'left');
		$this->db->join('mst_lab_item_range', 'mst_lab_item_range.id_lab_item_range = pat_lab_result.id_lab_range AND mst_lab_item_range.id_lab_item=pat_lab_result.id_lab_item AND mst_lab_item_range.pat_gender=1 AND mst_lab_item_range.type_lab=1', 'left');
		$this->db->where('pat_lab_result.id_reg', $id_reg);
		$query = $this->db->get();
		return $query;
	}

	//print detail lab
	function get_data_detail_lab($id_reg, $param)
	{
		$this->db->select('trx_registration.id, trx_registration.id_reg, trx_registration.reg_date, trx_registration.id_pat, trx_registration.pat_charge_rule, trx_registration.payment_type, trx_registration.id_client, trx_registration.id_client_dept, trx_registration.id_client_job, trx_registration.id_sales, trx_registration.reference, trx_registration.id_dr, trx_registration.insurance_comp, trx_registration.id_project, trx_registration.misc_notes, trx_registration.pat_sign, trx_registration.reg_type, trx_registration.id_service, trx_registration.id_package, trx_registration.fingerid, trx_registration.status_reg, trx_registration.create_by, trx_registration.create_date, mkt_posting_pack_h.id_quot, mkt_posting_pack_h.quot_name, mkt_posting_pack_h.qout_id, mkt_posting_pack_h.quot_date_create, mkt_posting_pack_h.quot_date_valid, mkt_posting_pack_h.quot_date_end, mkt_posting_pack_h.quot_revision, mkt_posting_pack_h.qty_estimate, mkt_posting_pack_h.client_id, mkt_posting_pack_h.mkt_id, mkt_posting_pack_h.total, mkt_posting_pack_h.total_price, mkt_posting_pack_h.margin, mkt_posting_pack_h.margin_amount, mkt_posting_pack_h.disc, mkt_posting_pack_h.disc_amount, mkt_posting_pack_h.grand_price, mkt_posting_pack_h.approved_by, mkt_posting_pack_h.approved_date, mkt_posting_pack_h.approved_client, mkt_posting_pack_h.ip_addr, mkt_posting_pack_h.notes_client, mkt_posting_pack_h.notes, mkt_posting_pack_h.is_finalised, mkt_posting_pack_h.revised, mkt_posting_pack_h.coa, mkt_posting_pack_d.id_quot_detail, mkt_posting_pack_d.id_quot_header, mkt_posting_pack_d.status, mkt_posting_pack_d.group_header_print, mkt_posting_pack_d.group_service, mkt_posting_pack_d.group_header, mkt_posting_pack_d.group_mark, mkt_posting_pack_d.service_id, mkt_posting_pack_d.before_tax, mkt_posting_pack_d.service_tax, mkt_posting_pack_d.service_other, mkt_posting_pack_d.service_price, mkt_posting_pack_d.seq_no, mkt_posting_pack_d.notes_service, mst_services.id_service, mst_services.id_group_serv, mst_services.order_type, mst_services.order_id, mst_services.serv_seq_no, mst_services.coa, mst_services.serv_name, mst_services.serv_name_j, mst_services.serv_type, mst_services.serv_code, mst_services.is_active, mst_service_group.id_serv_group, mst_service_group.group_desc, mst_service_group.group_seq_no, mst_mark_group.id, mst_mark_group.nama_group, mst_lab_item.id_lab_item, mst_lab_item.lab_item_desc, mst_lab_item.lab_item_name_j, mst_lab_item.lab_item_abbr, mst_lab_item.lab_item_unit, mst_lab_item.lab_item_group, mst_lab_item.lab_item_seq_no, mst_lab_item.lab_item_case, mst_lab_item.lab_item_sampling, pat_lab_result.id_lab_result, pat_lab_result.id_order, pat_lab_result.id_lab_item, pat_lab_result.id_lab_range, pat_lab_result.result_value, pat_lab_result.revision, pat_lab_result.std_value, pat_lab_result.name_type, pat_lab_result.lab_item_group, pat_lab_result.seq_no, pat_lab_result.is_normal, pat_lab_result.remarks, pat_lab_result.ref_no, pat_lab_result.create_date, pat_lab_result.create_by, mst_lab_group.group_name, mst_lab_group.group_name_j, mst_lab_group.group_mark, mst_lab_group.group_seq_no, mst_lab_group.is_active');
		$this->db->from('trx_registration');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $param . ')', 'left');
		$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('mst_service_group', 'mst_service_group.id_serv_group = mst_services.id_group_serv', 'left');
		$this->db->join('mst_mark_group', 'mst_mark_group.id = mkt_posting_pack_d.group_mark', 'left');
		$this->db->join('mst_lab_item', 'mst_lab_item.id_lab_item = mst_services.order_id', 'left');
		$this->db->join('pat_lab_result', 'pat_lab_result.id_reg = trx_registration.id_reg AND mst_services.id_group_serv = 1 AND pat_lab_result.id_lab_item = mst_services.order_id', 'left');
		$this->db->join('mst_lab_group', 'mst_lab_group.id_lab_item_group = pat_lab_result.lab_item_group
		AND mst_services.id_group_serv = 1', 'left');
		$this->db->where('trx_registration.id_reg', $id_reg);
		$this->db->where('id_serv_group', 1);
		$query = $this->db->get();
		return $query;
	}

	//print detail lab
	function get_data_detail_lab_old($id_reg, $param)
	{
		$this->db->from('trx_registration');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $param . ')', 'left');
		$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('mst_service_group', 'mst_service_group.id_serv_group = mst_services.id_group_serv', 'left');
		$this->db->join('mst_mark_group', 'mst_mark_group.id = mkt_posting_pack_d.group_mark', 'left');
		$this->db->join('pat_lab_result', 'pat_lab_result.id_reg = trx_registration.id_reg AND mst_services.id_group_serv = 1 AND pat_lab_result.id_lab_item = mst_services.order_id', 'left');
		$this->db->join('mst_lab_group', 'mst_lab_group.id_lab_item_group = pat_lab_result.lab_item_group
		AND mst_services.id_group_serv = 1', 'left');
		$this->db->where('trx_registration.id_reg', $id_reg);
		$this->db->where('id_serv_group', 1);
		$query = $this->db->get();
		return $query;
	}


	//print detail lab
	function get_data_detail_lab_xx($id_reg, $param)
	{
		$this->db->select('pat_order_h.id_order, mst_order_type.order_type_desc, pat_order_h.order_type, pat_order_h.id_reg, pat_order_h.order_date, pat_order_h.order_status, pat_order_h.mcu, pat_order_d.id_service, mst_lab_item.lab_item_desc, mst_lab_group.group_name, mst_rad_item.seq_no, mst_rad_group.group_desc, pat_lab_result.id_lab_range, pat_lab_result.result_value, pat_lab_result.name_type, mkt_posting_pack_h.id_quot, mkt_posting_pack_h.quot_name, trx_registration.reg_date, trx_registration.id_pat, pat_lab_result.std_value, mst_services.serv_name');
		$this->db->from('pat_order_h');
		$this->db->join('pat_order_d', 'pat_order_d.id_order_header = pat_order_h.id_order', 'left');
		$this->db->join('mst_lab_item', 'mst_lab_item.id_lab_item = pat_order_d.id_service', 'left');
		$this->db->join('trx_registration', 'pat_order_h.id_reg = trx_registration.id_reg', 'inner');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $param . ')', 'inner');
		$this->db->join('mst_services', 'mst_services.id_service = pat_order_d.id_service', 'inner');
		$this->db->join('pat_lab_result', 'pat_order_h.id_reg = pat_lab_result.id_reg and mst_lab_item.id_lab_item = pat_lab_result.id_lab_item', 'left');
		$this->db->join('mst_order_type', 'mst_order_type.id_order_type = pat_order_h.order_type', 'left');
		$this->db->join('mst_lab_group', 'mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group', 'left');
		$this->db->join('mst_rad_item', 'mst_rad_item.id_rad_item = pat_order_d.id_service', 'left');
		$this->db->join('mst_rad_group', 'mst_rad_group.id_rad_group = mst_rad_item.rad_item_group', 'left');
		$this->db->where('pat_order_h.id_reg', $id_reg);
		$this->db->where('id_order_type', 1);
		$this->db->where('pat_order_d.status !=', 1);
		$query = $this->db->get();
		return $query;
	}

	function get_data_mcu_result2($register_id)
	{
		$this->db->from('pat_mcu_result');
		$this->db->where('id_regist', $register_id);
		$query = $this->db->get();
		return $query;
	}

	function get_data_mcu_result3($register_id)
	{
		$this->db->from('pat_mcu_result');
		$this->db->join('pat_mcu_result_comment', 'pat_mcu_result.id_mcu_result=pat_mcu_result_comment.id_mcu_result', 'inner');
		$this->db->where('pat_mcu_result.id_regist', $register_id);
		$query = $this->db->get();
		return $query;
	}

	function get_data_mcu($id_regist, $param, $age)
	{
		$id_serv_group = array(1, 2);
		$this->db->select('group_header,serv_name,nama_group,mst_services.id_service serpis,trx_registration.id_reg as fingerid, nama_value, mst_item_value.id, result, id_quot_header, group_header_print prints, mst_item_value.Unit, mkt_posting_pack_h.quot_name');
		$this->db->from('trx_registration');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $param . ')', 'left');
		$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('mst_service_group', 'mst_service_group.id_serv_group = mst_services.id_group_serv', 'left');
		$this->db->join('mst_mark_group', 'mst_mark_group.id = mkt_posting_pack_d.group_mark', 'left');
		$this->db->join('mst_item_value', 'mst_item_value.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('pat_result_mcu', 'pat_result_mcu.id_service = mkt_posting_pack_d.service_id and pat_result_mcu.id_value = mst_item_value.id', 'left');
		// batas penambahan, add by rangga 11 Febuari 2015
		$this->db->order_by("group_header, serv_name, nama_value", "asc");
		$this->db->where('trx_registration.id_reg', $id_regist);
		$this->db->where_not_in('id_serv_group', $id_serv_group);
		$this->db->where("$age BETWEEN range_age_1 AND range_age_2");
		//$this->db->limit(3,0); 
		$query = $this->db->get();
		return $query;
	}

	function get_data_mcu_5($id_regist, $param, $age, $gender)
	{
		$id_serv_group = array(1, 2, 6, 10);
		$this->db->select('group_header,serv_name,nama_group,mst_services.id_service serpis,trx_registration.id_reg as fingerid, nama_value, mst_item_value.id, result, id_quot_header, group_header_print prints, mst_item_value.Unit, mkt_posting_pack_h.quot_name');
		$this->db->from('trx_registration');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $param . ')', 'left');
		$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('mst_service_group', 'mst_service_group.id_serv_group = mst_services.id_group_serv', 'left');
		$this->db->join('mst_mark_group', 'mst_mark_group.id = mkt_posting_pack_d.group_mark', 'left');
		$this->db->join('mst_item_value', 'mst_item_value.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('pat_result_mcu', 'pat_result_mcu.id_service = mkt_posting_pack_d.service_id and pat_result_mcu.id_value = mst_item_value.id AND trx_registration.id_reg = pat_result_mcu.id_reg', 'left');
		// batas penambahan, add by rangga 11 Febuari 2015
		$this->db->order_by("group_header, serv_name, nama_value", "asc");
		$this->db->where('trx_registration.id_reg', $id_regist);
		$this->db->where('mst_item_value.gender', $gender);
		$this->db->where('mst_item_value.is_active', 0);
		$this->db->where_not_in('id_serv_group', $id_serv_group);
		$this->db->where("$age BETWEEN range_age_1 AND range_age_2");
		//$this->db->limit(3,0); 
		$query = $this->db->get();
		return $query;
	}

	function get_data_mcu_6($id_regist, $param, $age, $gender)
	{
		$id_serv_group = array(1, 2, 6, 10);
		$query = $this->db->query("SELECT CASE WHEN mkt_posting_pack_d.group_service NOT IN (0, 3) AND mkt_posting_pack_d.group_header = 0 THEN mst_service_group.group_desc ELSE group_header END AS group_header, 0 serv_name, nama_group, mst_services.id_service serpis, trx_registration.id_reg AS fingerid, nama_value, mst_item_value.id, result, id_quot_header, group_header_print prints, mst_item_value.Unit, mkt_posting_pack_h.quot_name, ranges, pat_result_mcu.flags FROM trx_registration LEFT JOIN mkt_posting_pack_h ON mkt_posting_pack_h.id_quot IN ($param) LEFT JOIN mkt_posting_pack_d ON mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot LEFT JOIN mst_services ON mst_services.id_service = mkt_posting_pack_d.service_id LEFT JOIN mst_service_group ON mst_service_group.id_serv_group = mst_services.id_group_serv LEFT JOIN mst_mark_group ON mst_mark_group.id = mkt_posting_pack_d.group_mark LEFT JOIN mst_item_value ON mst_item_value.id_service = mkt_posting_pack_d.service_id LEFT JOIN pat_result_mcu ON pat_result_mcu.id_service = mkt_posting_pack_d.service_id AND pat_result_mcu.id_value = mst_item_value.id AND trx_registration.id_reg = pat_result_mcu.id_reg WHERE trx_registration.id_reg = $id_regist AND mst_item_value.gender = $gender AND mst_item_value.is_active = 0 AND id_serv_group NOT IN (1, 2, 6, 10) AND $age BETWEEN range_age_1 AND range_age_2 ORDER BY group_header ASC,
	mst_item_value.seq_no ASC ");
		return $query;
	}

	function get_data_mcu4($id_regist, $param)
	{
		$id_serv_group = array(1, 2);
		$this->db->select('group_header,serv_name,nama_group,mst_services.id_service serpis,trx_registration.id_reg as fingerid, nama_value, mst_item_value.id, result, id_quot_header, group_header_print prints, mst_item_value.Unit, mkt_posting_pack_h.quot_name');
		$this->db->from('trx_registration');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $param . ')', 'left');
		$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('mst_service_group', 'mst_service_group.id_serv_group = mst_services.id_group_serv', 'left');
		$this->db->join('mst_mark_group', 'mst_mark_group.id = mkt_posting_pack_d.group_mark', 'left');
		$this->db->join('mst_item_value', 'mst_item_value.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('pat_result_mcu', 'pat_result_mcu.id_service = mkt_posting_pack_d.service_id and pat_result_mcu.id_value = mst_item_value.id', 'left');
		// batas penambahan, add by rangga 11 Febuari 2015
		$this->db->order_by("group_header, serv_name, nama_value", "asc");
		$this->db->where('trx_registration.id_reg', $id_regist);
		$this->db->where_not_in('id_serv_group', $id_serv_group);
		//$this->db->limit(3,0); 
		$query = $this->db->get();
		return $query;
	}

	function get_data_mcu2($id_regist, $param)
	{
		$id_serv_group = array(1, 2);
		$this->db->select('group_header,serv_name,nama_group,mst_services.id_service serpis,trx_registration.id_reg as fingerid, nama_value, mst_item_value.id, result, id_quot_header, group_header_print prints, mst_item_value.Unit, trx_registration.reg_date, trx_registration.id_reg');
		$this->db->from('trx_registration');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $param . ')', 'left');
		$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('mst_service_group', 'mst_service_group.id_serv_group = mst_services.id_group_serv', 'left');
		$this->db->join('mst_mark_group', 'mst_mark_group.id = mkt_posting_pack_d.group_mark', 'left');
		$this->db->join('mst_item_value', 'mst_item_value.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('pat_result_mcu', 'pat_result_mcu.id_service = mkt_posting_pack_d.service_id and pat_result_mcu.id_value = mst_item_value.id', 'left');
		// batas penambahan, add by rangga 11 Febuari 2015
		$this->db->order_by('reg_date, group_header, serv_name, nama_value', 'asc');
		$this->db->where('trx_registration.id_pat', $id_regist);
		$this->db->where_not_in('id_serv_group', $id_serv_group);
		$this->db->where_not_in('trx_registration.id_service', 0);
		//$this->db->limit(3,0); 
		$query = $this->db->get();
		return $query;
	}

	function get_data_mcu3($id_regist, $param, $age, $gender)
	{
		$query = $this->db->query("SELECT trx_registration.id_pat, trx_registration.id_reg, trx_registration.reg_date, CASE WHEN mkt_posting_pack_d.group_service NOT IN (0, 3) AND mkt_posting_pack_d.group_header = 0 THEN mst_service_group.group_desc ELSE group_header END AS group_header, IFNULL( CONVERT (lvalue USING utf8), mst_service_group.group_desc ) AS group_header_jp, nama_value, nama_value_j, result, id_quot, mkt_posting_pack_h.quot_name, mst_services.id_service,mst_item_value.id AS id_item_value, mst_item_value.Unit, mst_services.id_group_serv, mst_service_group.group_desc,mst_item_value.limit_1,mst_item_value.limit_2,mst_item_value.seq_no, pat_result_mcu.flags FROM trx_registration INNER JOIN mkt_posting_pack_h ON mkt_posting_pack_h.id_quot IN ($param) LEFT JOIN mkt_posting_pack_d ON mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot LEFT JOIN ( SELECT * FROM sysparam WHERE sgroup = 'mkt_posting_pack_d' ) B ON mkt_posting_pack_d.group_header = B.skey LEFT JOIN mst_services ON mst_services.id_service = mkt_posting_pack_d.service_id LEFT JOIN mst_service_group ON mst_service_group.id_serv_group = mst_services.id_group_serv LEFT JOIN mst_mark_group ON mst_mark_group.id = mkt_posting_pack_d.group_mark LEFT JOIN mst_item_value ON mst_item_value.id_service = mkt_posting_pack_d.service_id LEFT JOIN pat_result_mcu ON pat_result_mcu.id_service = mkt_posting_pack_d.service_id AND pat_result_mcu.id_value = mst_item_value.id AND pat_result_mcu.id_reg = trx_registration.id_reg WHERE trx_registration.id_reg = $id_regist AND mst_item_value.is_active = 0 AND mst_item_value.gender = $gender AND id_serv_group NOT IN (1,2,6) AND $age BETWEEN range_age_1 AND range_age_2 ORDER BY serv_name ASC, nama_value ASC;");
		return $query;
	}

	function get_data_mcu3_old($id_regist, $param, $age, $gender)
	{
		$id_serv_group = array(1, 2);
		$this->db->select('trx_registration.id_pat, trx_registration.id_reg, trx_registration.reg_date, group_header, B.lvalue,nama_value, result, id_quot, mkt_posting_pack_h.quot_name, mkt_posting_pack_d.service_id as id_item_value, mst_item_value.Unit, mst_services.id_group_serv, mst_service_group.group_desc');
		$this->db->from('trx_registration');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $param . ')', 'inner');
		$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot', 'left');
		$this->db->join('(SELECT * FROM sysparam WHERE sgroup="mkt_posting_pack_d") B', 'mkt_posting_pack_d.group_header=B.skey', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('mst_service_group', 'mst_service_group.id_serv_group = mst_services.id_group_serv', 'left');
		$this->db->join('mst_mark_group', 'mst_mark_group.id = mkt_posting_pack_d.group_mark', 'left');
		$this->db->join('mst_item_value', 'mst_item_value.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('pat_result_mcu', 'pat_result_mcu.id_service = mkt_posting_pack_d.service_id and pat_result_mcu.id_value = mst_item_value.id and pat_result_mcu.id_reg=trx_registration.id_reg', 'left');
		$this->db->where('trx_registration.id_reg', $id_regist);
		$this->db->where('mst_item_value.is_active', 0);
		$this->db->where('mst_item_value.gender', $gender);
		$this->db->where_not_in('id_serv_group', $id_serv_group);
		$this->db->where("$age BETWEEN range_age_1 AND range_age_2");
		$this->db->order_by("serv_name, nama_value", "asc");
		$query = $this->db->get();
		return $query;
	}

	function print_detailother_order($id)
	{
		$this->db->distinct();
		$this->db->select('pat_order_h.id_reg, trx_registration.reg_date, pat_order_h.id_order, serv_name, mst_service_group.group_desc, pat_order_h.order_type, pat_order_h.id_reg, pat_order_h.order_date, pat_order_h.order_status, pat_order_h.mcu, pat_order_d.id_service, dr_fee_d.id_dr, id_fee_d');
		$this->db->from('pat_order_h');
		$this->db->join('trx_registration', 'pat_order_h.id_reg = trx_registration.id_reg', 'inner');
		$this->db->join('mst_service_group', 'mst_service_group.id_serv_group = pat_order_h.order_type', 'left');
		$this->db->join('pat_order_d', 'pat_order_d.id_order_header = pat_order_h.id_order', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = pat_order_d.id_service', 'left');
		$this->db->join('dr_fee_h', 'dr_fee_h.id_reg = pat_order_h.id_reg', 'left');
		$this->db->join('dr_fee_d', 'dr_fee_d.id_fee_h = dr_fee_h.id and dr_fee_d.id_service=pat_order_d.id_service', 'left');
		$this->db->where('pat_order_h.id_reg', $id);
		$this->db->where('pat_order_h.order_type !=', 1);
		$this->db->where('pat_order_h.order_type !=', 2);
		$this->db->where('pat_order_h.order_type !=', 14);
		$this->db->where('pat_order_d.status !=', 1);
		//$this->db->where('id_order_type',4);	
		$query = $this->db->get();
		return $query;
	}

	function print_detailother_order_2($id)
	{
		$order_type = array(0, 1, 2);
		$this->db->distinct();
		$this->db->select('pat_order_h.id_reg, trx_registration.reg_date, pat_order_h.id_order, serv_name, mst_service_group.group_desc, pat_order_h.order_type, pat_order_h.id_reg, pat_order_h.order_date, pat_order_h.order_status, pat_order_h.mcu, pat_order_d.id_service, dr_fee_d.id_dr, id_fee_d');
		$this->db->from('pat_order_h');
		$this->db->join('trx_registration', 'pat_order_h.id_reg = trx_registration.id_reg', 'inner');
		$this->db->join('mst_service_group', 'mst_service_group.id_serv_group = pat_order_h.order_type', 'left');
		$this->db->join('pat_order_d', 'pat_order_d.id_order_header = pat_order_h.id_order', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = pat_order_d.id_service', 'left');
		$this->db->join('dr_fee_h', 'dr_fee_h.id_reg = pat_order_h.id_reg', 'left');
		$this->db->join('dr_fee_d', 'dr_fee_d.id_fee_h = dr_fee_h.id and dr_fee_d.id_service=pat_order_d.id_service', 'left');
		$this->db->where('pat_order_h.id_reg', $id);
		$this->db->where_not_in('pat_order_h.order_type', $order_type);
		$this->db->where('pat_order_d.status !=', 1);
		//$this->db->where('id_order_type',4);	
		$query = $this->db->get();
		return $query;
	}

	function hapus_tmp_print_mcu_h($id_reg)
	{
		$query = $this->db->delete('tmp_print_mcu_h', array('id_reg' => $id_reg));
		return $query;
	}

	function hapus_tmp_print_mcu_h2($id_pat)
	{
		$query = $this->db->delete('tmp_print_mcu_h', array('id_pat' => $id_pat));
		return $query;
	}

	function tr_tmp_print_mcu_h()
	{
		$query = $this->db->query("truncate table tmp_print_mcu_h");
		return $query;
	}

	function tr_tmp_print_mcu_d()
	{
		$query = $this->db->query("truncate table tmp_print_mcu_d");
		return $query;
	}

	function hapus_tmp_print_mcu_d($id_reg)
	{
		$query = $this->db->delete('tmp_print_mcu_d', array('id_reg' => $id_reg));
		return $query;
	}

	function hapus_tmp_print_mcu_d2($id_pat)
	{
		$query = $this->db->delete('tmp_print_mcu_d', array('id_pat' => $id_pat));
		return $query;
	}

	function hapus_pat_mcu_result_comment($id_reg, $nama_comment)
	{
		$this->db->where('id_reg', $id_reg);
		$this->db->where('nama_comment', $nama_comment);
		$this->db->delete('pat_mcu_result_comment');
		// return $this->db->affected_rows();
	}

	function get_data_mcu_save($id_regist, $param)
	{
		$this->db->distinct();
		$this->db->select('group_header, id_quot_header, group_header_print prints');
		$this->db->from('trx_registration');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $param . ')', 'left');
		$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('mst_service_group', 'mst_service_group.id_serv_group = mst_services.id_group_serv', 'left');
		$this->db->join('mst_mark_group', 'mst_mark_group.id = mkt_posting_pack_d.group_mark', 'left');
		$this->db->join('mst_item_value', 'mst_item_value.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('pat_result_mcu', 'pat_result_mcu.id_service = mkt_posting_pack_d.service_id and pat_result_mcu.id_value = mst_item_value.id', 'left');
		// batas penambahan, add by rangga 11 Febuari 2015
		$this->db->order_by("serv_name, nama_value", "asc");
		$this->db->where('trx_registration.id_reg', $id_regist);
		$this->db->where_not_in('id_serv_group', 1);
		$this->db->where_not_in('id_serv_group', 2);
		//$this->db->limit(3,0); 
		$query = $this->db->get();
		return $query;
	}

	function get_data_mcu_labrad($id_regist, $param)
	{
		$query = $this->db->query("SELECT * FROM ( SELECT 'Laboratorium' group_header,
    group_header group_header1,
    group_name AS groups,
    serv_name,
	pat_lab_result.name_type AS nama_group,pat_lab_result.is_normal,
    mst_services.id_service serpis,
    trx_registration.id_reg AS fingerid,
    id_quot_header,
    result_value AS results,
	std_value,
    group_header_print prints  FROM trx_registration LEFT JOIN mkt_posting_pack_h ON mkt_posting_pack_h.id_quot IN ($param) LEFT JOIN mkt_posting_pack_d ON mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot LEFT JOIN mst_services ON mst_services.id_service = mkt_posting_pack_d.service_id LEFT JOIN mst_service_group ON mst_service_group.id_serv_group = mst_services.id_group_serv LEFT JOIN mst_mark_group ON mst_mark_group.id = mkt_posting_pack_d.group_mark LEFT JOIN pat_lab_result ON pat_lab_result.id_reg = trx_registration.id_reg AND mst_services.id_group_serv = 1 AND pat_lab_result.id_lab_item = mst_services.order_id LEFT JOIN mst_lab_group ON mst_lab_group.id_lab_item_group = pat_lab_result.lab_item_group AND mst_services.id_group_serv = 1 WHERE trx_registration.id_reg = '$id_regist' AND id_serv_group = 1 
	UNION ALL 
	SELECT DISTINCT 
    'Radiologi' AS group_header,
    '' AS group_header1,
    mst_rad_group.group_desc AS groups,
    nama_value,
	'' AS nama_group, '0' as is_normal,
    pat_rad_result.id_rad_item serpis,
    id_reg AS fingerid,
    0 id_quot_header,
    result,
	0 std_value,
    0 prints 
	FROM
      pat_rad_result 
    LEFT JOIN mst_rad_item 
      ON pat_rad_result.id_rad_item = mst_rad_item.id_rad_item 
    LEFT JOIN mst_rad_group 
      ON mst_rad_group.id_rad_group = mst_rad_item.rad_item_group 
	WHERE id_reg = '$id_regist' ) A ORDER BY group_header,groups,nama_group ASC");
		return $query;
	}

	function get_data_grade_result($register_id)
	{
		$this->db->from('mst_judgment_grade');
		$this->db->where('id_registration', $register_id);
		$query = $this->db->get();
		return $query;
	}

	function get_patient_data_tread()
	{
		$this->db->select('*');
		$this->db->from('pat_data');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('trx_registration', 'trx_registration.id_pat = pat_data.id_Pat', 'left');
		$this->db->join('pat_qst_treadmill', 'pat_qst_treadmill.id_pat = pat_data.pat_mrn', 'inner');
		$query = $this->db->get();
		return $query;
	}

	function get_patient_data_gyn()
	{
		$this->db->select('*');
		$this->db->from('pat_data');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('trx_registration', 'trx_registration.id_pat = pat_data.id_Pat', 'left');
		$this->db->join('pat_qst_gynecology', 'pat_qst_gynecology.id_pat = pat_data.pat_mrn', 'inner');
		$query = $this->db->get();
		return $query;
	}

	function save_que_mcu($data_que_mcu)
	{
		$this->db->insert('pat_qst_mcu', $data_que_mcu);
	}

	function insert_temp_print_mcu_h($data_insert)
	{
		$this->db->insert('tmp_print_mcu_h', $data_insert);
	}

	function update_temp_print_mcu_h($data_update, $id_reg)
	{
		$this->db->where('id_reg', $id_reg);
		$this->db->update('tmp_print_mcu_h', $data_update);
		return $this->db->affected_rows();
	}

	function insert_temp_print_mcu_d($data_insert)
	{
		$this->db->insert('tmp_print_mcu_d', $data_insert);
	}

	function update_temp_print_mcu_d($data_update, $id_item_value)
	{
		$this->db->where('id_item_value', $id_item_value);
		$this->db->update('tmp_print_mcu_d', $data_update);
		return $this->db->affected_rows();
	}

	function update_temp_print_mcu_d2()
	{
		$query = $this->db->query("UPDATE tmp_print_mcu_h INNER JOIN tmp_print_mcu_d ON tmp_print_mcu_h.id_reg = tmp_print_mcu_d.id_reg INNER JOIN mkt_posting_pack_d ON tmp_print_mcu_h.id_package = mkt_posting_pack_d.id_quot_header AND tmp_print_mcu_d.content_h = mkt_posting_pack_d.group_header SET tmp_print_mcu_d.group_header_print = mkt_posting_pack_d.group_header_print; ");
		return $query;
	}

	function insert_trx_bh($data_insert)
	{
		$this->db->insert('trx_bh', $data_insert);
	}

	function insert_trx_bd($data_insert)
	{
		$this->db->insert('trx_bd', $data_insert);
	}

	function update_que_mcu($data_que_mcu, $id_update)
	{
		$this->db->where('id_qst_mcu', $id_update);
		$this->db->update('pat_qst_mcu', $data_que_mcu);
		return $this->db->affected_rows();
	}

	function update_pat_data($data_que_mcu, $id_update)
	{
		$this->db->where('pat_MRN', $id_update);
		$this->db->update('pat_data', $data_que_mcu);
		return $this->db->affected_rows();
	}

	function update_pat_data2($data_que_mcu, $id_Pat)
	{
		$this->db->where('id_Pat', $id_Pat);
		$this->db->update('pat_data', $data_que_mcu);
		return $this->db->affected_rows();
	}

	function update_status_trx_bh($id_bh, $update_trx_bh)
	{
		$this->db->where('id_bh', $id_bh);
		$this->db->update('trx_bh', $update_trx_bh);
		return $this->db->affected_rows();
	}

	function update_status_trx_bd($id_bh, $update_trx_bd)
	{
		$this->db->where('id_bh', $id_bh);
		$this->db->update('trx_bd', $update_trx_bd);
		return $this->db->affected_rows();
	}

	function update_check($id, $data)
	{
		$this->db->where('id_ms_d', $id);
		$this->db->update('pat_ms_d', $data);
		return $this->db->affected_rows();
	}

	function update_grup($id, $idx, $data)
	{
		$this->db->where('group_header', $idx);
		$this->db->where('id_quot_header', $id);
		$this->db->update('mkt_posting_pack_d', $data);
		return $this->db->affected_rows();
	}

	function save_que_tread($data_que_tr)
	{
		$this->db->insert('pat_qst_treadmill', $data_que_tr);
	}

	function save_mcu_comment($data_que_tr)
	{
		$this->db->insert('pat_mcu_result_comment', $data_que_tr);
	}

	function update_que_tread($data_que_tr, $id_update)
	{
		$this->db->where('id_treadmill_qst', $id_update);
		$this->db->update('pat_qst_treadmill', $data_que_tr);
		return $this->db->affected_rows();
	}

	function save_que_gyn($data_que_gyn)
	{
		$this->db->insert('pat_qst_gynecology', $data_que_gyn);
	}

	function update_que_gyn($data_que_gyn, $id_update)
	{
		$this->db->where('id_gyne_qst', $id_update);
		$this->db->update('pat_qst_gynecology', $data_que_gyn);
		return $this->db->affected_rows();
	}

	function update_ms_h($data_pack, $register_id)
	{
		$this->db->where('id_reg', $register_id);
		$this->db->update('pat_result_mcu', $data_pack);
		return $this->db->affected_rows();
	}

	function update_mcu_result($data_pack, $register_id)
	{
		$this->db->where('id_regist', $register_id);
		$this->db->update('pat_mcu_result', $data_pack);
		return $this->db->affected_rows();
	}

	function save_ms_h($data_pack)
	{
		$this->db->insert('pat_ms_h', $data_pack);
	}

	function save_mcu_result($data_pack)
	{
		$this->db->insert('pat_mcu_result', $data_pack);
	}

	function save_mcu_result_2($data_pack_2)
	{
		$this->db->insert('mst_judgment_grade', $data_pack_2);
	}

	function update_mcu_result_2($data_pack_2, $register_id)
	{
		$this->db->where('id_registration', $register_id);
		$this->db->update('mst_judgment_grade', $data_pack_2);
		return $this->db->affected_rows();
	}

	function get_result_grade($id_regist)
	{
		$this->db->where('id_registration', $id_regist);
		return $this->db->get('mst_judgment_grade');
	}

	function lock_mcu($id_regist, $datapack)
	{
		$this->db->where('id_regist', $id_regist);
		$this->db->update('pat_mcu_result', $datapack);
		return $this->db->affected_rows();
	}

	function get_mcu_comment($id_regist)
	{
		$this->db->where('id_reg', $id_regist);
		return $this->db->get('pat_mcu_result_comment');
	}

	function lock_mark_sheet($id_regist, $datapack)
	{
		$this->db->where('id_reg', $id_regist);
		$this->db->update('pat_ms_h', $datapack);
		return $this->db->affected_rows();
	}

	public function pat_mrn()
	{
		$sql = "SELECT pat_mrn id, cast(left(pat_mrn,4) as decimal) dt FROM pat_data ORDER BY id_pat DESC LIMIT 1";

		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			$counts = $query->row()->id;
			$counts = substr($counts, 1, strlen($counts) - 1);
			$counts = $counts + 1;

			$code_no = str_pad($counts, 0, "0", STR_PAD_LEFT);

			return $code_no;
		} else {
			return false;
		}
	}

	public function add_new_patient_ajax($data)
	{
		return $this->db->insert('pat_data', $data);
	}
}
