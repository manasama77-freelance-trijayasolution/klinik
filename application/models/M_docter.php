<?php
class M_docter extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_mst_lab_item($id_reg)
	{
		//$this->db->select('*');
		//$this->db->from('mst_services');
		//$this->db->join('mst_service_price', 'mst_service_price.id_service = mst_services.id_service', 'inner');
		//$this->db->join('pat_order_d', 'pat_order_d.id_service = mst_services.id_service', 'left');
		//$this->db->join('pat_order_h', 'pat_order_h.id_order = pat_order_d.id_order_header', 'left');
		//$this->db->where('id_branch',$branch);
		//$this->db->where('price_type',$type);
		//$this->db->where('id_reg', $id_reg);
		//$this->db->where('mst_services.order_type',1);
		//$query = $this->db->get();
		//return $query;
		$query = $this->db->query("SELECT distinct order_id,serv_name,mst_services.id_service FROM mst_services INNER JOIN
	mst_service_price ON mst_service_price.id_service=mst_services.id_service
	WHERE order_type='1'
	AND mst_services.order_id NOT IN (SELECT b.id_service FROM pat_order_h a INNER JOIN pat_order_d b ON a.id_order=b.id_order_header WHERE id_reg='" . $id_reg . "' and status <> '1');");
		return $query;
	}

	function get_mst_rad_item($id_reg)
	{
		$query = $this->db->query("SELECT distinct order_id,serv_name,mst_services.id_service FROM mst_services INNER JOIN
	mst_service_price ON mst_service_price.id_service=mst_services.id_service
	WHERE order_type='2' 
	AND mst_services.order_id NOT IN (SELECT b.id_service FROM pat_order_h a INNER JOIN pat_order_d b ON a.id_order=b.id_order_header WHERE id_reg='" . $id_reg . "');");
		return $query;
	}

	function get_other_service($id_reg)
	{
		$query = $this->db->query("SELECT distinct mst_services.id_service,group_desc,serv_name,id_group_serv FROM mst_services INNER JOIN
	mst_service_price ON mst_service_price.id_service=mst_services.id_service AND  mst_service_price.is_active=0 inner join mst_service_group on mst_service_group.id_serv_group=mst_services.id_group_serv
	WHERE order_id='0' 
	AND mst_services.id_service NOT IN (SELECT b.id_service FROM pat_order_h a INNER JOIN pat_order_d b ON a.id_order=b.id_order_header WHERE id_reg='" . $id_reg . "');");
		return $query;
	}

	function get_mst_group_item()
	{
		$query = $this->db->query("SELECT * FROM mst_group_service_h;");
		return $query;
	}

	function get_patient_by_client($id_client)
	{
		$this->db->from('pat_data');
		$this->db->join('trx_registration', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->where('pat_data.id_client', $id_client);
		$query = $this->db->get();
		return $query;
	}

	function print_mcu($id_reg, $id_package)
	{
		$this->db->from('pat_data');
		$this->db->join('trx_registration', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $id_package . ')', 'inner');
		$this->db->where('id_reg', $id_reg);
		$query = $this->db->get();
		return $query;
	}

	function get_report_mcu()
	{
		$this->db->from('mkt_posting_pack_h');
		$this->db->join('mst_client', 'mkt_posting_pack_h.client_id = mst_client.id_Client', 'inner');
		$query = $this->db->get();
		return $query;
	}

	function get_mkt_posting_pack_h_id($id_quot)
	{
		$this->db->where_in('id_quot', $id_quot);
		$query = $this->db->get('mkt_posting_pack_h');
		return $query;
	}

	function get_report_mcu_year($id_client, $id_package)
	{
		$query = $this->db->query("SELECT DISTINCT quot_name, MONTH (reg_date) AS bulan, YEAR (reg_date) AS tahun, COUNT(*) AS jml FROM pat_data INNER JOIN trx_registration ON pat_data.id_pat = trx_registration.id_pat INNER JOIN mkt_posting_pack_h ON mkt_posting_pack_h.id_quot IN ($id_package) WHERE pat_data.id_client = '" . $id_client . "' GROUP BY mkt_posting_pack_h.quot_name, MONTH (reg_date), YEAR (reg_date)");
		return $query;
	}

	function get_report_mcu_detail($id_reg, $id_package, $month, $year)
	{
		$this->db->from('pat_data');
		$this->db->join('trx_registration', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $id_package . ')', 'inner');
		$this->db->where('id_reg', $id_reg);
		$this->db->where('MONTH(reg_date)', $month);
		$this->db->where('YEAR(reg_date)', $year);
		$query = $this->db->get();
		return $query;
	}

	function get_temp_print_mcu_d_byID($id_pat)
	{
		$this->db->from('tmp_print_mcu_d');
		$this->db->where('id_pat', $id_pat);
		$query = $this->db->get();
		return $query;
	}


	function get_data_detail_lab($id_reg, $param)
	{
		$this->db->from('trx_registration');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $param . ')', 'left');
		$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = mkt_posting_pack_d.service_id', 'left');
		$this->db->join('mst_service_group', 'mst_service_group.id_serv_group = mst_services.id_group_serv', 'left');
		$this->db->join('mst_mark_group', 'mst_mark_group.id = mkt_posting_pack_d.group_mark', 'left');
		$this->db->join('pat_lab_result', 'pat_lab_result.id_reg = trx_registration.id_reg AND mst_services.id_group_serv = 1 AND pat_lab_result.id_lab_item = mst_services.order_id', 'left');
		$this->db->join('mst_lab_item', 'mst_lab_item.id_lab_item = mst_services.order_id', 'left');
		$this->db->join('mst_lab_group', 'mst_lab_item.lab_item_group=mst_lab_group.id_lab_item_group', 'left');
		$this->db->where('trx_registration.id_reg', $id_reg);
		$this->db->where('id_serv_group', 1);
		$query = $this->db->get();
		return $query;
	}

	function get_headers_table($id_pat)
	{
		$this->db->distinct('content_d');
		$this->db->select('content_d');
		$this->db->from('tmp_print_mcu_d');
		$this->db->where_in('id_pat', $id_pat);
		$query = $this->db->get();
		return $query;
	}

	function get_list_paket_detail($id_package)
	{
		$this->db->select('cast(mkt_posting_pack_d.group_service AS UNSIGNED) as group_service, mkt_posting_pack_d.service_other, mst_item_value.nama_value, mst_lab_item_range.name_type');
		$this->db->from('mkt_posting_pack_d');
		$this->db->join('mst_item_value', 'mkt_posting_pack_d.service_id=mst_item_value.id_service AND mkt_posting_pack_d.group_service IN (0,2, 3, 5,6, 10,11)', 'left');
		$this->db->join('mst_lab_item_range', 'mkt_posting_pack_d.service_id=mst_lab_item_range.id_lab_item AND mkt_posting_pack_d.group_service=1', 'left');
		$this->db->where('mkt_posting_pack_d.id_quot_header', $id_package);
		$this->db->order_by('cast(mkt_posting_pack_d.group_service AS UNSIGNED)', 'asc');
		$this->db->order_by('service_other', 'asc');
		$this->db->order_by('mst_item_value.nama_value', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function get_data_mcu3($id_regist, $param, $age, $gender)
	{
		$id_serv_group = array(1, 2);
		$this->db->select('trx_registration.id_pat, trx_registration.id_reg, trx_registration.reg_date, group_header,nama_value, result, id_quot, mkt_posting_pack_h.quot_name, mkt_posting_pack_d.service_id as id_item_value, mst_item_value.Unit, mst_services.id_group_serv');
		$this->db->from('trx_registration');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $param . ')', 'inner');
		$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot', 'left');
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


	function get_list_item_value()
	{
		$this->db->select('mst_item_value.id, mst_item_value.id_group_serv, mst_item_value.id_service, mst_item_value.nama_value, mst_item_value.range_age_1, mst_item_value.range_age_2, mst_item_value.limit_1, mst_item_value.limit_2, mst_item_value.formula, mst_item_value.create_by, mst_item_value.create_date, mst_service_group.group_desc, mst_service_group.group_seq_no, mst_gender.gender, mst_services.id_group_serv, mst_services.order_type, mst_services.order_id, mst_services.serv_seq_no, mst_services.coa, mst_services.serv_name, mst_services.serv_type, mst_services.serv_code');
		$this->db->from('mst_item_value');
		$this->db->join('mst_service_group', 'mst_item_value.id_group_serv = mst_service_group.id_serv_group', 'inner');
		$this->db->join('mst_gender', 'mst_item_value.gender = mst_gender.id_gender', 'inner');
		$this->db->join('mst_services', 'mst_item_value.id_service = mst_services.id_service', 'inner');
		$this->db->where('mst_item_value.is_active', 0);
		$query = $this->db->get();
		return $query;
	}

	function get_list_item_value_by_id($id)
	{
		$this->db->select('mst_item_value.id, mst_item_value.id_group_serv, mst_item_value.id_service, mst_item_value.nama_value, mst_item_value.range_age_1, mst_item_value.range_age_2, mst_item_value.limit_1, mst_item_value.limit_2, mst_item_value.formula, mst_item_value.create_by, mst_item_value.create_date, mst_service_group.group_desc, mst_service_group.group_seq_no, mst_gender.gender, mst_services.id_group_serv, mst_services.order_type, mst_services.order_id, mst_services.serv_seq_no, mst_services.coa, mst_services.serv_name, mst_services.serv_type, mst_services.serv_code, mst_item_value.unit');
		$this->db->from('mst_item_value');
		$this->db->join('mst_service_group', 'mst_item_value.id_group_serv = mst_service_group.id_serv_group', 'inner');
		$this->db->join('mst_gender', 'mst_item_value.gender = mst_gender.id_gender', 'inner');
		$this->db->join('mst_services', 'mst_item_value.id_service = mst_services.id_service', 'inner');
		$this->db->where('mst_item_value.is_active', 0);
		$this->db->where('mst_item_value.id', $id);
		$query = $this->db->get();
		return $query;
	}

	function get_hst_doctor($id_reg)
	{
		$this->db->from('dr_fee_h');
		$this->db->join('dr_fee_d', 'dr_fee_d.id_fee_h=dr_fee_h.id', 'inner');
		$this->db->where('id_reg', $id_reg);
		$query = $this->db->get();
		return $query;
	}

	function get_trx($id_reg)
	{
		$this->db->where('id_reg', $id_reg);
		return $this->db->get('trx_registration');
	}

	function get_soap($id_reg)
	{
		$this->db->where('id_reg', $id_reg);
		$this->db->join('mst_user', 'mst_user.id=doctor_soap.create_by', 'inner');
		return $this->db->get('doctor_soap');
	}

	public function order_lab_h($data_lab)
	{
		return $this->db->insert('pat_order_h', $data_lab);
	}

	function get_rad_order($id)
	{
		$this->db->select('*');
		$this->db->from('pat_order_h');
		$this->db->join('pat_data', 'pat_data.id_Pat = pat_order_h.id_pat', 'left');
		$this->db->where('order_status', 0);
		$this->db->order_by("pat_order_h.id_reg", "desc");
		$query = $this->db->get();
		return $query;
	}

	function get_last_order($branch, $type, $id_reg)
	{
		$query = $this->db->query("SELECT 
		IFNULL(IFNULL(a.serv_name, b.serv_name),name_service) serv_name, order_date
		FROM pat_order_h 
		INNER JOIN pat_order_d 
		ON pat_order_d.id_order_header = pat_order_h.id_order 
		LEFT JOIN mst_services a 
		ON a.order_id = pat_order_d.id_service 
		AND pat_order_h.order_type = a.id_group_serv 
		AND pat_order_h.order_type <> 0 
		LEFT JOIN mst_services b 
		ON b.id_service = pat_order_d.id_service 
		AND pat_order_h.order_type = b.id_group_serv 
		 LEFT JOIN mst_group_service_h 
    ON mst_group_service_h.id = pat_order_d.id_service 
		WHERE id_reg = '" . $id_reg . "' and pat_order_d.status=0");
		return $query;
	}

	function get_last_presc($branch, $type, $id_reg)
	{
		$query = $this->db->query("SELECT item_name, a.create_date
		FROM pat_prescription_h a
		INNER JOIN pat_prescription_d b 
			ON a.id_presc=b.id_presc_h
		INNER JOIN mst_item c
			ON b.drug_id=c.id_item
		WHERE id_reg='" . $id_reg . "'");
		return $query;
	}

	function get_dokter_order_list($id)
	{
		$query = $this->db->query("SELECT DISTINCT id_reg,pat_name,MAX(order_date) order_date, client_name FROM (
		SELECT DISTINCT a.id_reg,pat_name,order_date,client_name FROM trx_registration a
		INNER JOIN pat_data b ON a.id_pat=b.id_Pat
		INNER JOIN pat_order_h c ON a.id_reg=c.id_reg
		LEFT JOIN mst_client d ON a.id_client=d.id_Client
		UNION ALL
		SELECT DISTINCT a.id_reg,pat_name,c.create_date,client_name FROM trx_registration a
		INNER JOIN pat_data b ON a.id_pat=b.id_Pat
		INNER JOIN pat_prescription_h c ON a.id_reg=c.id_reg
		LEFT JOIN mst_client d ON a.id_client=d.id_Client 
		)aa
		GROUP BY id_reg,pat_name,client_name ORDER BY id_reg DESC");
		return $query;
	}

	function viewid_dokter_order_list($id_reg1, $id_reg2)
	{
		$this->db->distinct('pat_order_h.id_pat, pat_name, id_reg');
		$this->db->from('pat_order_h');
		$this->db->join('pat_data', 'pat_data.id_Pat = pat_order_h.id_pat', 'inner');
		$this->db->where('id_reg >=', $id_reg1);
		$this->db->where('id_reg <=', $id_reg2);
		$this->db->group_by("pat_order_h.id_reg");
		$query = $this->db->get();
		/* var_dump($id_reg1,$id_reg2,$datereg1,$datereg2);
	exit();  */
		return $query;
	}

	function viewdate_dokter_order_list($datereg1, $datereg2)
	{
		$search_format1 = "$datereg1 00:00:00";
		$search_format2 = "$datereg2 23:59:59";
		$this->db->distinct('pat_order_h.id_pat, pat_name, id_reg');
		$this->db->from('pat_order_h');
		$this->db->join('pat_data', 'pat_data.id_Pat = pat_order_h.id_pat', 'inner');
		$this->db->where('order_date >=', $search_format1);
		$this->db->where('order_date <=', $search_format2);
		$this->db->group_by("pat_order_h.id_reg");
		$query = $this->db->get();
		/* var_dump($datereg1,$datereg2);
	exit();  */
		return $query;
	}

	function get_other_service_fee()
	{
		$this->db->select('mst_services.id_service,group_desc,serv_name,id_group_serv');
		$this->db->from('mst_services');
		$this->db->join('mst_service_group', 'mst_service_group.id_serv_group = mst_services.id_group_serv', 'inner');
		$this->db->join('mst_service_price', 'mst_service_price.id_service = mst_services.id_service', 'inner');
		$this->db->order_by("group_seq_no", "asc");
		$this->db->where('order_id', 0);
		//$this->db->where('id_branch',$branch);
		//$this->db->where('price_type',$type);
		$query = $this->db->get();
		return $query;
	}


	function print_list_order($id_reg)
	{
		$this->db->select('trx_registration.id_reg,trx_registration.id_pat,pat_name,pat_gender,pat_dob,reg_date,package_name,title_desc,pat_data.id_title,client_name,trx_registration.id_service idx,trx_registration.create_date');
		$this->db->from('trx_registration');
		$this->db->join('pat_data', 'pat_data.id_Pat = trx_registration.id_pat', 'left');
		$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left');
		//$this->db->join('trx_registration', 'trx_registration.id_reg = pat_order_h.id_reg', 'left');
		$this->db->join('mst_service_package_h', 'mst_service_package_h.id_package = trx_registration.id_service', 'left');
		$this->db->join('mst_client', 'mst_client.id_Client = trx_registration.id_client', 'left');
		$this->db->where('trx_registration.id_reg', $id_reg);
		$this->db->order_by("trx_registration.id_reg", "desc");
		$query = $this->db->get();
		return $query;
	}
	//print detail lab
	function print_detaillab_order($id_reg)
	{
		$this->db->select('pat_order_h.id_order,
					   mst_order_type.order_type_desc,
					   pat_order_h.order_type,
					   pat_order_h.id_reg,
					   pat_order_h.order_date,
					   pat_order_h.order_status,					   
					   pat_order_h.mcu,
					   pat_order_d.id_service,
					   mst_lab_item.lab_item_desc,
					   mst_lab_group.group_name,
					   mst_rad_item.seq_no,
					   mst_rad_group.group_desc');
		$this->db->from('pat_order_h');
		$this->db->join('mst_order_type', 'mst_order_type.id_order_type = pat_order_h.order_type', 'left');
		$this->db->join('pat_order_d', 'pat_order_d.id_order_header = pat_order_h.id_order', 'left');
		$this->db->join('mst_lab_item', 'mst_lab_item.id_lab_item = pat_order_d.id_service', 'left');
		$this->db->join('mst_lab_group', 'mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group', 'left');
		$this->db->join('mst_rad_item', 'mst_rad_item.id_rad_item = pat_order_d.id_service', 'left');
		$this->db->join('mst_rad_group', 'mst_rad_group.id_rad_group = mst_rad_item.rad_item_group', 'left');
		$this->db->where('pat_order_h.id_reg', $id_reg);
		$this->db->where('id_order_type', 1);
		$this->db->where('pat_order_d.status !=', 1);
		$query = $this->db->get();
		return $query;
	}
	//print detail lab
	function print_detailgrp_order($id_reg)
	{
		$this->db->select('group_desc, name_service, order_date, id_service, id_order');
		$this->db->from('pat_order_h');
		$this->db->join('pat_order_d', 'pat_order_d.id_order_header = pat_order_h.id_order', 'inner');
		$this->db->join('mst_group_service_h', 'mst_group_service_h.id = pat_order_d.id_service', 'inner');
		$this->db->join('mst_service_group', 'mst_service_group.id_serv_group = pat_order_h.order_type', 'inner');
		$this->db->where('pat_order_h.id_reg', $id_reg);
		$this->db->where('pat_order_h.order_type', 14);
		$this->db->where('pat_order_d.status !=', 1);
		$query = $this->db->get();
		return $query;
	}
	//print detail Radiology
	function print_detailrad_order($id_reg)
	{
		$data	= array(2, 6);
		$this->db->select('pat_order_h.id_order,
					   mst_order_type.order_type_desc,
					   pat_order_h.order_type,
					   pat_order_h.id_reg,
					   pat_order_h.order_date,
					   pat_order_h.order_status,					  
					   pat_order_h.mcu,
					   pat_order_d.id_service,
					   mst_rad_item.rad_item,
					   mst_rad_item.rad_item_group,
					   mst_rad_item.seq_no,
					   mst_rad_group.group_desc');
		$this->db->from('pat_order_h');
		$this->db->join('mst_order_type', 'mst_order_type.id_order_type = pat_order_h.order_type', 'left');
		$this->db->join('pat_order_d', 'pat_order_d.id_order_header = pat_order_h.id_order', 'left');
		$this->db->join('mst_rad_item', 'mst_rad_item.id_rad_item = pat_order_d.id_service', 'left');
		$this->db->join('mst_rad_group', 'mst_rad_group.id_rad_group = mst_rad_item.rad_item_group', 'left');
		$this->db->where('pat_order_h.id_reg', $id_reg);
		$this->db->where_in('id_order_type', $data);
		$this->db->where('pat_order_d.status !=', 1);
		$query = $this->db->get();
		return $query;
	}
	//print detail USG
	function print_detailUSG_order($id_reg)
	{
		$data	= array(6);
		$this->db->select('pat_order_h.id_order,
					   pat_order_h.order_type,
					   pat_order_h.id_reg,
					   pat_order_h.order_date,
					   pat_order_h.order_status,					  
					   pat_order_h.mcu,
					   pat_order_d.id_service,
					   mst_rad_item.rad_item,
					   mst_rad_item.rad_item_group,
					   mst_rad_item.seq_no,
					   mst_rad_group.group_desc');
		$this->db->from('pat_order_h');
		$this->db->join('pat_order_d', 'pat_order_d.id_order_header = pat_order_h.id_order', 'left');
		$this->db->join('mst_services', 'mst_services.id_service = pat_order_d.id_service', 'left');
		$this->db->join('mst_rad_item', 'mst_rad_item.id_rad_item = mst_services.order_id', 'left');
		$this->db->join('mst_rad_group', 'mst_rad_group.id_rad_group = mst_rad_item.rad_item_group', 'left');
		$this->db->where('pat_order_h.id_reg', $id_reg);
		$this->db->where_in('pat_order_h.order_type', $data);
		$this->db->where('pat_order_d.status !=', 1);
		$query = $this->db->get();
		return $query;
	}
	//print detail Farmasi
	function print_detailphar_order($id)
	{
		$this->db->select('*,pat_prescription_h.create_date as tgl');
		$this->db->from('pat_prescription_h');
		$this->db->join('pat_prescription_d', 'pat_prescription_d.id_presc_h = pat_prescription_h.id_presc', 'left');
		$this->db->join('mst_item', 'mst_item.id_item = pat_prescription_d.drug_id', 'left');
		$this->db->join('mst_baseunit', 'mst_baseunit.id_baseunit = pat_prescription_d.drug_uom', 'left');
		$this->db->where('id_reg', $id);
		$this->db->where_not_in('presc_status', 1);
		$query = $this->db->get();
		return $query;
	}


	function update_check($id, $idx, $data)
	{
		$this->db->where('id_service', $id);
		$this->db->where('id_order_header', $idx);
		$this->db->update('pat_order_d', $data);
		return $this->db->affected_rows();
	}

	function update_item_value($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('mst_item_value', $data);
		return $this->db->affected_rows();
	}

	//print detail other
	function print_detailother_order($id)
	{
		$this->db->distinct();
		$this->db->select('pat_order_h.id_order,
	serv_name,
	mst_service_group.group_desc,
	pat_order_h.order_type,
	pat_order_h.id_reg,
	pat_order_h.order_date,
	pat_order_h.order_status,	pat_order_h.mcu,
	pat_order_d.id_service, dr_fee_d.id_dr, id_fee_d');
		$this->db->from('pat_order_h');
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

	public function get_list_service()
	{
		return $this->db
			->distinct()
			->select([
				'mst_services.id_service',
				'group_desc',
				'serv_name',
				'id_group_serv'
			])
			->from('mst_services')
			->join('mst_service_price', 'mst_service_price.id_service = mst_services.id_service AND mst_service_price.is_active = 0', 'left')
			->join('mst_service_group', 'mst_service_group.id_serv_group = mst_services.id_group_serv', 'left')
			->where('mst_services.order_id', 0)
			->get();
	}

	public function get_selected_services($id_registration, $id_patient)
	{
		return $this->db
			->from('order_services')
			->where('id_registration', $id_registration)
			->where('id_patient', $id_patient)
			->where('is_complete', 'no')
			->get();
	}

	public function append_services($data)
	{
		return $this->db->insert('order_services', $data);
	}

	public function get_table_list_service($id_registration, $id_patient)
	{
		return $this->db
			->select([
				'order_services.id',
				'order_services.id_registration',
				'order_services.id_patient',
				'order_services.id_service',
				'mst_services.serv_name as service_name',
				'mst_service_group.group_desc',
			])
			->from('order_services')
			->join('mst_services', 'mst_services.id_service = order_services.id_service', 'left')
			->join('mst_service_group', 'mst_service_group.id_serv_group = mst_services.id_group_serv', 'left')
			->where('order_services.id_registration', $id_registration)
			->where('order_services.id_patient', $id_patient)
			->where('order_services.is_complete', 'no')
			->order_by('order_services.id', 'desc')
			->get();
	}

	public function remove_services($data)
	{
		return $this->db->where($data)->delete('order_services');
	}

	public function remove_pat_order_h($id_registration, $id_patient)
	{
		return $this->db->where([
			'id_reg'       => $id_registration,
			'id_pat'       => $id_patient,
			'order_status' => 1,
			'is_complete'  => 0,
		])->delete('pat_order_h');
	}

	public function store_pat_order_d($data)
	{
		return $this->db->insert('pat_order_d', $data);
	}

	public function insert_odontogram($data_odontogram)
	{
		return $this->db->insert('mst_odo', $data_odontogram);
	}

	public function update_registration($data, $where)
	{
		return $this->db->update('trx_registration', $data, $where);
	}

	public function get_data_odo($id_reg)
	{
		return $this->db
			->from('mst_odo')
			->where('id_reg', $id_reg)
			->get();
	}

	public function id_dr_on_registration($id_reg)
	{
		return $this->db->where('id_reg', $id_reg)->get('trx_registration', 1);
	}
}
