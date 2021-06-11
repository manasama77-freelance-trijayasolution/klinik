<?php
class M_cashier extends CI_Model
{

	function get_list_gender()
	{
		return $this->db->get('mst_gender');
	}

	function get_mst_client()
	{
		return $this->db->get('mst_client'); //  load name of table
	}

	function get_list_bank()
	{
		return $this->db->get('mst_bank');
	}

	public function get_list_bank2()
	{
		return $this->db->where('id_bank in', '(3, 7)', false)->get('mst_bank');
	}

	function get_list_ins()
	{
		return $this->db->get('mst_insurance');
	}

	function get_mst_client_dept()
	{
		return $this->db->get('mst_client_dept'); //  load name of table
	}

	function get_mst_title()
	{
		return $this->db->get('mst_title'); //  load name of table
	}

	function get_mst_client_job()
	{
		return $this->db->get('mst_client_job'); //  load name of table
	}

	function get_billing()
	{
		return $this->db->get('trx_billing');
	}

	function get_billing_reg1($id_reg)
	{
		$this->db->where('id_reg', $id_reg);
		return $this->db->get('trx_billing');
	}

	function get_invoice($id_reg, $id_billing)
	{
		$this->db->where('id_billing', $id_billing);
		$this->db->where('id_reg', $id_reg);
		return $this->db->get('trx_pat_invoice');
	}

	function get_doctor_by_user()
	{
		$this->db->from('mst_user');
		$this->db->where('mst_user.menu_level', 3);
		$this->db->where('mst_user.is_active', 1);
		$query = $this->db->get();
		return $query;
	}

	function get_or($id_reg, $id_billing)
	{
		$this->db->where('id_billing', $id_billing);
		$this->db->where('id_reg', $id_reg);
		return $this->db->get('trx_pat_or');
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

	function get_billing_reg($id_reg, $id_billing)
	{
		$this->db->where('id_billing', $id_billing);
		$this->db->where('id_reg', $id_reg);
		return $this->db->get('trx_billing');
	}

	function cek_data_billing($id_reg)
	{
		$this->db->where('id_reg', $id_reg);
		return $this->db->get('pat_order_h');
	}

	function cek_data_billing2($id_reg)
	{
		$this->db->where('id_reg', $id_reg);
		return $this->db->get('trx_pharmacy_h');
	}

	function get_billing_item_request($id_reg, $split)
	{
		$this->db->from('trx_bh');
		$this->db->join('trx_bd', 'trx_bh.id_bh=trx_bd.id_bh', 'inner');
		$this->db->where('trx_bh.id_reg', $id_reg);
		$this->db->where('trx_bd.split', $split);
		$this->db->where(array('id_service' => 0));
		$query = $this->db->get();
		return $query;
	}

	function get_billing_group_item($id_reg, $code_service, $urutan)
	{
		$this->db->from('trx_bh');
		$this->db->join('trx_bd', 'trx_bh.id_bh=trx_bd.id_bh', 'inner');
		$this->db->where('trx_bh.id_reg', $id_reg);
		$this->db->where('trx_bd.code_service', $code_service);
		$this->db->where('trx_bd.split', $urutan);
		$query = $this->db->get();
		return $query;
	}

	function get_smart_rad($id_service, $type_charge_rule)
	{
		$this->db->from('mst_service_price');
		$this->db->where('id_service', $id_service);
		$this->db->where('price_type', $type_charge_rule);
		$query = $this->db->get();
		return $query;
	}

	function get_smart_notification($id_reg, $id_trouble, $id_source_trouble, $code_service)
	{
		$this->db->from('smart_notification');
		$this->db->where('id_reg', $id_reg);
		$this->db->where('id_trouble', $id_trouble);
		$this->db->where('id_source_trouble', $id_source_trouble);
		$this->db->where('type_id', $code_service);
		$query = $this->db->get();
		return $query;
	}

	function get_payment_list_before($id_reg, $id_billing)
	{
		$this->db->from('trx_pat_payment_h');
		$this->db->where('id_billing', $id_billing);
		$this->db->where('id_reg', $id_reg);
		$query = $this->db->get();
		return $query;
	}

	function get_payment_list($id_reg, $id_billing)
	{
		$this->db->select('trx_pat_payment_h.amount as am1, trx_pat_payment_d.amount as am2');
		$this->db->from('trx_pat_payment_h');
		$this->db->join('trx_pat_payment_d', 'trx_pat_payment_h.id_payment=trx_pat_payment_d.id_payment_detail', 'inner');
		$this->db->where('id_billing', $id_billing);
		$this->db->where('id_reg', $id_reg);
		$query = $this->db->get();
		return $query;
	}

	function get_list_payment()
	{
		$sts 			= array(2, 5); // reject dan deleted
		$sts2 			= array(1, 2); // reject dan deleted
		$price_type 	= array(5); // Tipe pembayaran
		$this->db->select('trx_billing.id_billing,trx_billing.bill_no,trx_registration.id_reg,pat_data.pat_name,mst_client.client_name,mst_price_type.price_type,min(trx_pat_payment_h.outstanding) as outstanding,pat_data.id_Pat,pat_data.pat_dob,pat_data.pat_pob,mst_client.id_client,mst_service_package_h.package_name,mst_service_package_h.id_package,trx_billing.id_bh');
		$this->db->from('pat_data');
		$this->db->join('trx_registration', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('mst_client', 'trx_registration.id_client=mst_client.id_Client', 'left');
		$this->db->join('mst_service_package_h', 'trx_registration.id_package=mst_service_package_h.id_package', 'left');
		$this->db->join('trx_billing', 'trx_registration.id_reg=trx_billing.id_reg', 'inner');
		$this->db->join('trx_pat_payment_h', 'trx_registration.id_reg=trx_pat_payment_h.id_reg and trx_billing.id_billing=trx_pat_payment_h.id_billing and is_complete <> 2', 'left');
		$this->db->join('mst_price_type', 'mst_price_type.id_price_type=trx_billing.type_charge_rule', 'left');
		// $this->db->where_not_in('trx_billing.status', $sts);
		//$this->db->where_not_in('id_price_type', $price_type);
		// $this->db->or_where_not_in('trx_pat_payment_h.is_complete', $sts2);
		$this->db->group_by('trx_billing.id_billing,trx_billing.bill_no,trx_registration.id_reg,pat_data.pat_name,mst_client.client_name,mst_price_type.price_type,pat_data.id_Pat,pat_data.pat_dob,pat_data.pat_pob,mst_client.id_client,mst_service_package_h.package_name,mst_service_package_h.id_package');
		$this->db->order_by('trx_billing.create_date', 'desc');
		$query = $this->db->get();
		return $query;
	}

	function get_list_payment2()
	{
		$tgl 				= date("Y-m-d");
		$status 			= array(0, 3);
		$type_charge_rule 	= array(5, 3);
		$this->db->select('*');
		$this->db->from('pat_data');
		$this->db->join('trx_registration', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('mst_client', 'trx_registration.id_client=mst_client.id_Client', 'left');
		$this->db->join('mst_service_package_h', 'trx_registration.id_package=mst_service_package_h.id_package', 'left');
		$this->db->join('trx_billing', 'trx_registration.id_reg=trx_billing.id_reg', 'inner');
		$this->db->where('trx_billing.status != ', 2);
		$this->db->where_in('trx_billing.type_charge_rule', $type_charge_rule);
		$query = $this->db->get();
		return $query;
	}

	function get_list_invoice($first_date, $second_date)
	{
		$type_charge_rule 	= array(5, 3);
		$this->db->select('trx_registration.id_reg as dodol, pat_data.*, trx_billing.*,trx_pat_or.*,trx_registration.*,mst_client.*,mst_price_type.*,trx_bh.*,trx_pat_invoice.*');
		$this->db->from('pat_data');
		$this->db->join('trx_registration', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('mst_insurance', 'trx_registration.insurance_comp = mst_insurance.id_ins_comp', 'left');
		$this->db->join('trx_bh', 'trx_registration.id_reg=trx_bh.id_reg', 'inner');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('mst_client', 'trx_registration.id_client=mst_client.id_Client', 'left');
		$this->db->join('mst_service_package_h', 'trx_registration.id_package=mst_service_package_h.id_package', 'left');
		$this->db->join('trx_billing', 'trx_registration.id_reg=trx_billing.id_reg', 'inner');
		$this->db->join('trx_pat_invoice', 'trx_pat_invoice.id_reg=trx_registration.id_reg and trx_pat_invoice.id_billing=trx_billing.id_billing', 'left');
		$this->db->join('trx_pat_or', 'trx_pat_or.id_reg=trx_registration.id_reg and trx_pat_or.id_billing=trx_billing.id_billing', 'left');
		$this->db->join('mst_price_type', 'trx_billing.type_charge_rule=mst_price_type.id_price_type', 'inner');
		$this->db->where('trx_registration.reg_date >=', $first_date);
		$this->db->where('trx_registration.reg_date <=', $second_date);
		// $this->db->where_in('trx_billing.type_charge_rule', $type_charge_rule);
		$query = $this->db->get();
		return $query;
	}

	function get_list_billing($id_reg)
	{
		$this->db->where('id_reg', $id_reg);
		$this->db->or_where('id_billing', $id_reg);
		return $this->db->get('trx_billing');
	}

	function get_kurs_dollar()
	{
		$this->db->order_by('id_currency', 'desc');
		$this->db->where('code', 'USD');
		return $this->db->get('mst_currency', 1);
	}

	function get_kurs_dollar_limit1()
	{
		$this->db->order_by('update_date', 'desc');
		$this->db->where('code', 'USD');
		// $this->db->limit(1);
		return $this->db->get('mst_currency', 1);
	}

	function get_kurs_dollar_by_date($tgl)
	{
		$this->db->where('create_date', $tgl);
		return $this->db->get('mst_currency', 1);
	}

	function get_num_billing()
	{
		$this->db->where('month(create_date)', date("m"));
		$this->db->where('year(create_date)', date("Y"));
		return $this->db->get('trx_billing');
	}

	function get_billing_split($id_reg, $split)
	{
		$this->db->from('trx_bh');
		$this->db->join('trx_bd', 'trx_bh.id_bh=trx_bd.id_bh', 'inner');
		$this->db->join('trx_billing', 'trx_bh.id_reg=trx_billing.id_reg and trx_bd.id_billing=trx_billing.id_billing', 'inner');
		$this->db->where('trx_bh.id_reg', $id_reg);
		$this->db->where('trx_bd.split', $split);
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

	function get_order_type($id_bh)
	{
		$this->db->select('split,type_charge_rule,mst_price_type.price_type');
		$this->db->from('trx_bd');
		$this->db->join('mst_price_type', 'trx_bd.type_charge_rule=mst_price_type.id_price_type', 'left');
		$this->db->where("id_bh", $id_bh);
		$this->db->group_by("split", "asc");
		$query = $this->db->get();
		return $query;
	}

	function get_type_change_rule($id_bh, $split)
	{
		$this->db->distinct('type_charge_rule');
		$this->db->select('type_charge_rule');
		$this->db->from('trx_bd');
		$this->db->where("id_bh", $id_bh);
		$this->db->where("split", $split);
		$query = $this->db->get();
		return $query;
	}

	function get_order_type_urut($id_bh, $angka)
	{
		$this->db->select('split,type_charge_rule,mst_price_type.price_type');
		$this->db->from('trx_bd');
		$this->db->join('mst_price_type', 'trx_bd.type_charge_rule=mst_price_type.id_price_type', 'left');
		$this->db->where("id_bh", $id_bh);
		$this->db->where("split", $angka);
		$this->db->group_by("split", "asc");
		$query = $this->db->get();
		return $query;
	}

	function get_list_services()
	{
		$query = $this->db->query("SELECT a.id_service,'Pemeriksaan Fisik' as group_name,serv_name,order_id,a.id_service,serv_seq_no,'1' AS KET, price, c.price_type, order_type, currency
    FROM mst_services a 
    LEFT JOIN mst_service_price b ON a.id_service=b.id_service 
    LEFT JOIN mst_price_type c ON b.price_type=c.id_price_type  
    WHERE id_group_serv=4;");
		return $query;
	}

	function get_max_split_trx_bd($id_reg)
	{
		$this->db->select_max('split');
		$this->db->from('trx_bh');
		$this->db->join('trx_bd', 'trx_bh.id_bh = trx_bd.id_bh ', 'inner');
		$this->db->where('id_reg', $id_reg);
		$query = $this->db->get();
		return $query;
	}

	function get_max_trx_billing($id_reg)
	{
		$this->db->select_max('id_billing');
		$this->db->from('trx_billing');
		$this->db->where('id_reg', $id_reg);
		$query = $this->db->get();
		return $query;
	}

	function get_max_trx_pat_payment_h($id_reg)
	{
		$this->db->select_max('id_payment');
		$this->db->from('trx_pat_payment_h');
		$this->db->where('id_reg', $id_reg);
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

	function print_detailgrp_order($id_reg)
	{
		$this->db->select('group_desc, name_service, order_date, id_service, id_order, base_price, normal_price, insurance_price, company_price');
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

	function get_data_billing($id_reg, $code, $urutan)
	{
		$this->db->select('id_bd,serv_name,ifnull(mst_service_price.Price,"0") harga');
		$this->db->from('pat_data');
		$this->db->join('trx_registration ', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('trx_bh', 'trx_registration.id_reg=trx_bh.id_reg', 'inner');
		$this->db->join('trx_bd', 'trx_bh.id_bh=trx_bd.id_bh', 'inner');
		$this->db->join('mst_services', 'trx_bd.id_service=mst_services.id_service', 'inner');
		$this->db->join('mst_service_price', 'mst_services.id_service=mst_service_price.id_service and trx_bd.type_charge_rule=mst_service_price.price_type', 'left');
		$this->db->join('mst_price_type', 'mst_service_price.price_type=mst_price_type.id_price_type and trx_bd.type_charge_rule=mst_price_type.id_price_type', 'left');
		$this->db->where('trx_registration.id_reg', $id_reg);
		$this->db->where('trx_bd.code_service', $code);
		$this->db->where('mst_services.order_type', $code);
		$this->db->where('trx_bd.split', $urutan);
		$query = $this->db->get();
		return $query;
	}

	function get_data_billing_other($id_reg, $urutan)
	{
		$query = $this->db->query("SELECT `id_bd`, `serv_name`, ifnull(`mst_service_price`.`price`,`trx_bd`.`price`) AS `harga` FROM `pat_data` INNER JOIN `trx_registration` ON `pat_data`.`id_pat` = `trx_registration`.`id_pat` INNER JOIN `trx_bh` ON `trx_registration`.`id_reg` = `trx_bh`.`id_reg` INNER JOIN `trx_bd` ON `trx_bh`.`id_bh` = `trx_bd`.`id_bh` INNER JOIN `mst_services` ON `trx_bd`.`id_service` = `mst_services`.`id_service` AND `trx_bd`.`code_service` = `mst_services`.`id_group_serv` LEFT JOIN `mst_service_price` ON `mst_services`.`id_service` = `mst_service_price`.`id_service` AND `trx_registration`.`pat_charge_rule` = `mst_service_price`.`price_type` LEFT JOIN `mst_price_type` ON `mst_service_price`.`price_type` = `mst_price_type`.`id_price_type` WHERE `trx_registration`.`id_reg` = $id_reg AND `trx_bd`.`code_service` NOT IN (12, 0, 1, 2) AND `trx_bd`.`split` = $urutan ");
		return $query;
	}

	function get_data_billing_other_old($id_reg, $urutan)
	{
		$this->db->select('id_bd,serv_name,ifnull(mst_service_price.price,"0") harga');
		$this->db->from('pat_data');
		$this->db->join('trx_registration ', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('trx_bh', 'trx_registration.id_reg=trx_bh.id_reg', 'inner');
		$this->db->join('trx_bd', 'trx_bh.id_bh=trx_bd.id_bh', 'inner');
		$this->db->join('mst_services', 'trx_bd.id_service=mst_services.id_service and trx_bd.code_service=mst_services.id_group_serv', 'inner');
		$this->db->join('mst_service_price', 'mst_services.id_service=mst_service_price.id_service AND trx_registration.pat_charge_rule = mst_service_price.price_type', 'left');
		$this->db->join('mst_price_type', 'mst_service_price.price_type=mst_price_type.id_price_type', 'left');
		$this->db->where('trx_registration.id_reg', $id_reg);
		$this->db->where('trx_bd.code_service not in (12,0,1,2)');
		$this->db->where('trx_bd.split', $urutan);
		$query = $this->db->get();
		return $query;
	}

	function get_data_pharmacy($id_reg)
	{
		$this->db->from('pat_data');
		$this->db->join('trx_registration ', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('trx_pharmacy_h ', 'trx_registration.id_reg=trx_pharmacy_h.id_reg', 'inner');
		$this->db->join('trx_pharmacy_d ', 'trx_pharmacy_h.id_phar_trx=trx_pharmacy_d.id_phar_h', 'inner');
		$this->db->join('mst_item ', 'mst_item.id_item=trx_pharmacy_d.drug_id', 'inner');
		$this->db->join('mst_item_price ', 'mst_item.id_item = mst_item_price.id_item and trx_registration.pat_charge_rule=mst_item_price.price_type', 'left');
		$this->db->where('trx_registration.id_reg', $id_reg);
		$this->db->where('trx_pharmacy_d.is_dispensed', 1);
		$query = $this->db->get();
		return $query;
	}

	function get_view_pharmacy($id_reg, $code, $urutan)
	{
		$this->db->select('id_bd,item_name as serv_name,drug_qty,IFNULL(trx_bd.Price, "0") harga');
		$this->db->from('pat_data');
		$this->db->join('trx_registration ', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('trx_bh', 'trx_registration.id_reg=trx_bh.id_reg', 'inner');
		$this->db->join('trx_bd', 'trx_bh.id_bh=trx_bd.id_bh', 'inner');
		$this->db->join('mst_item', 'trx_bd.id_service = mst_item.id_item', 'inner');
		$this->db->join('trx_pharmacy_h', 'trx_registration.id_reg=trx_pharmacy_h.id_reg', 'inner');
		$this->db->join('trx_pharmacy_d', 'trx_pharmacy_h.id_phar_trx=trx_pharmacy_d.id_phar_h and mst_item.id_item=trx_pharmacy_d.drug_id', 'inner');
		$this->db->where('trx_registration.id_reg', $id_reg);
		$this->db->where('trx_bd.code_service', $code);
		$this->db->where('trx_bd.split', $urutan);
		$query = $this->db->get();
		return $query;
	}


	function sys_data_billing($id_reg, $code)
	{
		$query = $this->db->query("UPDATE trx_bd INNER JOIN trx_bh ON trx_bh.id_bh = trx_bd.id_bh INNER JOIN mst_services ON trx_bd.id_service = mst_services.id_service LEFT JOIN mst_service_price ON mst_services.id_service = mst_service_price.id_service AND trx_bd.type_charge_rule = mst_service_price.price_type LEFT JOIN mst_price_type ON mst_service_price.price_type = mst_price_type.id_price_type AND trx_bd.type_charge_rule = mst_price_type.id_price_type SET trx_bd.price=mst_service_price.Price WHERE trx_bh.id_reg = '" . $id_reg . "' AND trx_bd.code_service = " . $code . " AND mst_services.order_type = " . $code . " and  IFNULL(trx_bd.price , '0') <>  IFNULL(mst_service_price.Price, '0') ;");
		return $query;
	}

	function get_data_patien($id_reg)
	{
		$this->db->select('pat_data.id_Pat, pat_data.pat_name, pat_data.pat_gender, pat_data.pat_dob, pat_data.pat_pob, trx_registration.id_reg, trx_registration.reg_date, trx_registration.pat_charge_rule, trx_registration.payment_type, trx_registration.id_client, mst_services.id_service, pat_order_h.order_type, mst_service_price.Price, mst_service_price.id_price, mst_service_price.Currency');
		$this->db->from('pat_data');
		$this->db->join('trx_registration ', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('pat_order_h', 'trx_registration.id_reg=pat_order_h.id_reg and pat_order_h.order_type not in (1,2)', 'inner');
		$this->db->join('pat_order_d', 'pat_order_h.id_order=pat_order_d.id_order_header', 'inner');
		$this->db->join('mst_services', 'pat_order_d.id_service=mst_services.id_service and pat_order_h.order_type=mst_services.id_group_serv', 'inner');
		$this->db->join('mst_service_price', 'mst_services.id_service=mst_service_price.id_service and trx_registration.pat_charge_rule=mst_service_price.price_type', 'left');
		$this->db->join('mst_price_type', 'mst_service_price.price_type=mst_price_type.id_price_type and trx_registration.pat_charge_rule=mst_price_type.id_price_type', 'left');
		$this->db->where('pat_order_h.id_reg', $id_reg);
		$this->db->where('pat_order_h.mcu', 0);
		$this->db->where('pat_order_h.order_status <>', 2);
		$this->db->where('pat_order_d.status', 0);
		$query = $this->db->get();
		return $query;
	}

	function get_data_lab_patien($id_reg)
	{
		$this->db->select('*,mst_services.id_service');
		$this->db->from('pat_data');
		$this->db->join('trx_registration ', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('pat_order_h', 'trx_registration.id_reg=pat_order_h.id_reg', 'inner');
		$this->db->join('pat_order_d', 'pat_order_h.id_order=pat_order_d.id_order_header', 'inner');
		$this->db->join('mst_lab_item', 'pat_order_d.id_service=mst_lab_item.id_lab_item', 'inner');
		$this->db->join('mst_services', 'mst_lab_item.id_lab_item=mst_services.order_id and pat_order_h.order_type=mst_services.id_group_serv', 'inner');
		$this->db->join('mst_service_price', 'mst_services.id_service=mst_service_price.id_service and trx_registration.pat_charge_rule=mst_service_price.price_type', 'left');
		$this->db->join('mst_price_type', 'mst_service_price.price_type=mst_price_type.id_price_type and trx_registration.pat_charge_rule=mst_price_type.id_price_type', 'left');
		$this->db->where('pat_order_h.id_reg', $id_reg);
		$this->db->where('pat_order_h.mcu', 0);
		$this->db->where('pat_order_h.order_type', 1);
		$this->db->where('mst_services.order_type', 1);
		$this->db->where('pat_order_h.order_status <>', 2);
		$this->db->where('pat_order_d.status', 0);
		$this->db->where('mst_services.coa <>', 129);
		$query = $this->db->get();
		return $query;
	}

	function get_data_rad_patien($id_reg)
	{
		$this->db->select('*, mst_services.id_service');
		$this->db->from('pat_data');
		$this->db->join('trx_registration ', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('pat_order_h', 'trx_registration.id_reg=pat_order_h.id_reg', 'inner');
		$this->db->join('pat_order_d', 'pat_order_h.id_order=pat_order_d.id_order_header', 'inner');
		$this->db->join('mst_rad_item', 'pat_order_d.id_service=mst_rad_item.id_rad_item', 'inner');
		$this->db->join('mst_services', 'mst_rad_item.id_rad_item=mst_services.order_id and pat_order_h.order_type=mst_services.id_group_serv', 'inner');
		$this->db->join('mst_service_price', 'mst_services.id_service=mst_service_price.id_service and trx_registration.pat_charge_rule=mst_service_price.price_type', 'left');
		$this->db->join('mst_price_type', 'mst_service_price.price_type=mst_price_type.id_price_type and trx_registration.pat_charge_rule=mst_price_type.id_price_type', 'left');
		$this->db->where('pat_order_h.id_reg', $id_reg);
		$this->db->where('pat_order_h.mcu', 0);
		$this->db->where('pat_order_h.order_type', 2);
		$this->db->where('mst_services.order_type', 2);
		$this->db->where('pat_order_h.order_status <>', 2);
		$this->db->where('pat_order_d.status ', 0);
		$query = $this->db->get();
		return $query;
	}

	function get_patient_data_mark()
	{
		$this->db->select('id,id_reg,reg_date,pat_name,pat_dob,pat_pob,gender,pat_MRN,title_desc,package_name,client_name,pat_data.id_Pat');
		$this->db->from('pat_data');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('trx_registration', 'trx_registration.id_pat = pat_data.id_Pat', 'inner');
		$this->db->join('mst_service_package_h', 'mst_service_package_h.id_package = trx_registration.id_package', 'inner');
		$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left');
		$this->db->join('mst_client', 'mst_client.id_client = trx_registration.id_client', 'left');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
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

	function get_mark_mcu_pic($id)
	{
		$this->db->where('id_reg', $id);
		return $this->db->get('pat_photo');
	}

	function get_mark_mcu_2($id_regist, $param)
	{
		$this->db->select('*,mst_services.id_service serpis,`trx_registration`.id_reg as fingerid');
		$this->db->from('trx_registration');
		$this->db->join('mst_service_package_h', 'mst_service_package_h.id_package in (' . $param . ')', 'left');
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
		$this->db->group_by("mst_services.id_service");
		//$this->db->limit(3,0); 
		$query = $this->db->get();
		return $query;
	}

	function get_mark_mcu($id_regist)
	{
		$this->db->select('*,mst_services.id_service serpis,`trx_registration`.id_reg as fingerid, trx_registration.id_package as minions');
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
		$this->db->group_by("mst_services.id_service");
		//$this->db->limit(3,0); 
		$query = $this->db->get();
		return $query;
	}

	function get_mark_mcu_yang_bener($id_regist)
	{
		$this->db->select('*,mst_services.id_service serpis,`trx_registration`.id_reg as fingerid, trx_registration.id_package as minions');
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


	function get_patient_data()
	{
		$this->db->select('id_reg,reg_date,pat_name,pat_dob,pat_pob,gender,pat_MRN,title_desc,pat_data.id_Pat,client_name,pat_charge_rule,price_type');
		$this->db->from('pat_data');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('trx_registration', 'trx_registration.id_pat = pat_data.id_Pat', 'inner');
		$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left');
		$this->db->join('mst_client', 'mst_client.id_client = trx_registration.id_client', 'left');
		$this->db->join('mst_price_type', 'mst_price_type.id_price_type = trx_registration.pat_charge_rule', 'inner');
		$this->db->order_by("id_reg", "desc");
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
		$this->db->select('reg_date,id_reg,pat_name,pat_dob,pat_pob,gender,pat_MRN,pat_name,title_desc,id_reg,mst_service_package_h.package_name,client_name,client_address1');
		$this->db->from('pat_data');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('trx_registration', 'trx_registration.id_pat = pat_data.id_Pat', 'inner');
		$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'inner');
		$this->db->join('mst_service_package_h', 'mst_service_package_h.id_package = trx_registration.id_package', 'left');
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
		$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left');
		$this->db->join('mst_service_package_h', 'mst_service_package_h.id_package = trx_registration.id_package', 'left');
		$this->db->join('mst_client', 'mst_client.id_Client = trx_registration.id_client', 'left');
		$this->db->order_by("reg_date", "desc");
		$this->db->where('id_reg', $id);
		$query = $this->db->get();
		return $query;
	}

	function get_type_ch_payment($id_billing)
	{
		$this->db->from('trx_bd');
		$this->db->join('trx_billing', 'trx_bd.id_billing = trx_billing.id_billing', 'inner');
		$this->db->join('mst_price_type', 'trx_bd.type_charge_rule = mst_price_type.id_price_type', 'inner');
		$this->db->where('trx_billing.id_billing', $id_billing);
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

	function get_list_trx_bh2($id)
	{
		$this->db->from('trx_bh');
		$this->db->join('trx_registration', 'trx_registration.id_reg=trx_bh.id_reg', 'inner');
		$this->db->join('pat_data', 'trx_registration.id_pat=pat_data.id_Pat', 'inner');
		$this->db->join('mst_service_package_h', 'trx_registration.id_package=mst_service_package_h.id_package', 'left'); // left dikarena untuk outpatient
		$this->db->join('mst_client', 'trx_registration.id_client=mst_client.id_client', 'left'); // ini left dikarenakan tidak ada client
		$this->db->where('id_bh', $id);
		$query = $this->db->get();
		return $query;
	}

	function get_list_trx_bh3($id)
	{
		$this->db->from('trx_bh');
		$this->db->join('trx_registration', 'trx_registration.id_reg=trx_bh.id_reg', 'inner');
		$this->db->join('pat_data', 'trx_registration.id_pat=pat_data.id_Pat', 'inner');
		$this->db->join('mst_service_package_h', 'trx_registration.id_package=mst_service_package_h.id_package', 'left');
		$this->db->join('mst_client', 'trx_registration.id_client=mst_client.id_client', 'left');
		$this->db->where('id_bh', $id);
		$query = $this->db->get();
		return $query;
	}

	function cek_harga($id_bh)
	{
		$this->db->from('trx_bh');
		$this->db->join('trx_bd', 'trx_bh.id_bh=trx_bd.id_bh', 'inner');
		$this->db->join('mst_services', 'trx_bd.id_service=mst_services.id_service', 'inner');
		$this->db->where('trx_bh.id_bh', $id_bh);
		$this->db->where_not_in('trx_bd.code_service', 13);
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

	function del_invoice($id_reg, $id_billing)
	{
		$this->db->where('id_reg', $id_reg);
		$this->db->delete('trx_pat_invoice', array('id_billing' => $id_billing));
	}

	function del_or($id_reg, $id_billing)
	{
		$this->db->where('id_reg', $id_reg);
		$this->db->delete('trx_pat_or', array('id_billing' => $id_billing));
	}

	function get_patient_data_all()
	{
		$this->db->select('*');
		$this->db->from('pat_data');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$query = $this->db->get();
		return $query;
	}

	function get_patient_data_now()
	{
		$tgl = date("Y-m-d");
		$this->db->select('trx_registration.id_reg AS noreg, trx_registration.id_service, pat_data.id_Pat, pat_data.pat_name, pat_data.pat_dob, pat_data.pat_pob, mst_gender.*, mst_marital_status.*, mst_client.id_Client AS id_client, mst_client.client_name, mst_service_package_h.id_package, mst_service_package_h.package_name, trx_registration.reg_date,mst_title.title_desc');
		$this->db->from('pat_data');
		$this->db->join('trx_registration', 'pat_data.id_pat = trx_registration.id_pat', 'inner');
		$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->join('mst_client', 'trx_registration.id_client = mst_client.id_Client', 'left');
		$this->db->join('mst_service_package_h', 'trx_registration.id_package = mst_service_package_h.id_package', 'left');
		$this->db->join('trx_bh', 'trx_registration.id_reg = trx_bh.id_reg', 'left');
		// $this->db->where('trx_registration.reg_date', $tgl); // Case untuk perhari ini..
		// $this->db->where('IFNULL(trx_bh.STATUS, 0) !=', 4);
		$this->db->where('trx_registration.status_reg', 1);
		$this->db->order_by('trx_registration.reg_date', 'desc');
		$query = $this->db->get();
		return $query;
	}

	// function get_patient_data_now(){
	// $tgl = date("Y-m-d");
	// $query = $this->db->query("SELECT * FROM ( SELECT trx_registration.id_reg AS noreg, pat_data.id_Pat, pat_data.pat_name, pat_data.pat_dob, pat_data.pat_pob, mst_gender.*, mst_marital_status.*, mst_client.id_Client AS id_client, mst_client.client_name, mst_service_package_h.id_package, mst_service_package_h.package_name, IFNULL(trx_bh.status, 0) AS xstatus FROM pat_data LEFT JOIN trx_registration ON pat_data.id_pat = trx_registration.id_pat LEFT JOIN mst_gender ON mst_gender.id_gender = pat_data.pat_gender LEFT JOIN mst_marital_status ON mst_marital_status.id_status = pat_data.pat_marital_status LEFT JOIN mst_client ON trx_registration.id_client = mst_client.id_Client LEFT JOIN mst_service_package_h ON trx_registration.id_package = mst_service_package_h.id_package LEFT JOIN trx_bh ON trx_registration.id_reg = trx_bh.id_reg WHERE trx_registration.reg_date = '".$tgl."' ) xx WHERE xstatus != 4");
	// return $query;
	// }

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

	function get_data_mcu_patient($register_id)
	{
		$this->db->from('pat_ms_h');
		$this->db->where('id_reg', $register_id);
		$query = $this->db->get();
		return $query;
	}

	function get_billing_mcu($id_reg, $babydragon)
	{
		$this->db->from('pat_data');
		$this->db->join('trx_registration', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot in (' . $babydragon . ')', 'inner');
		// $this->db->join('mst_service_package_h', 'mst_service_package_h.id_package in ('.$babydragon.')', 'inner');
		// $this->db->join('mst_service_package_d', 'mst_service_package_h.id_package=mst_service_package_d.id_package_header', 'inner');
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
		$this->db->join('mst_service_package_h', '`mst_service_package_h.id_package in (' . $babydragon . ')', 'inner');
		// $this->db->join('mst_service_package_d', 'mst_service_package_h.id_package=mst_service_package_d.id_package_header', 'inner');
		$this->db->where('id_reg', $id_reg);
		$query = $this->db->get();
		return $query;
	}

	function get_billing_data_mcu($id_reg)
	{
		$this->db->select('pat_data.id_Pat, pat_data.id_history, pat_data.pat_MRN, pat_data.pat_name, pat_data.pat_gender, pat_data.pat_dob, pat_data.pat_pob, pat_data.pat_idno, pat_data.pat_idtype, pat_data.pat_marital_status, pat_data.pat_address_home, pat_data.pat_contact_home, pat_data.pat_address_misc, pat_data.pat_contact_misc, pat_data.pat_rel_name, pat_data.pat_rel_type, pat_data.pat_rel_contact, pat_data.pat_nationality, pat_data.pat_email, pat_data.pat_province, pat_data.pat_city, pat_data.id_client, pat_data.id_client_dept, pat_data.id_client_job, pat_data.id_title, pat_data.src_mcu, trx_registration.id, trx_registration.id_reg, trx_registration.reg_date, trx_registration.id_pat, trx_registration.pat_charge_rule, trx_registration.payment_type, trx_registration.id_client, trx_registration.id_client_dept, trx_registration.id_client_job, trx_registration.reference, trx_registration.id_dr, trx_registration.insurance_comp, trx_registration.id_project, trx_registration.misc_notes, trx_registration.pat_sign, trx_registration.reg_type, trx_registration.id_service, trx_registration.id_package, trx_registration.fingerid, trx_registration.status_reg, trx_registration.create_by, trx_registration.create_date, trx_bh.id_bh, trx_bh.id_reg, trx_bh.id_pat, trx_bh.age, trx_bh.`status`, trx_bh.create_by, trx_bh.create_date, trx_bh.update_by, trx_bh.update_date, trx_bd.id_bd, trx_bd.id_bh, trx_bd.id_service, trx_bd.code_service, trx_bd.name_service, trx_bd.type_charge_rule, trx_bd.id_serv_group, trx_bd.split, trx_bd.price, trx_bd.price_old, trx_bd.id_billing, trx_bd.id_item_request_h, mkt_posting_pack_h.id_quot, mkt_posting_pack_h.quot_name AS package_name, mkt_posting_pack_h.qout_id, mkt_posting_pack_h.quot_date_create, mkt_posting_pack_h.quot_date_valid, mkt_posting_pack_h.quot_date_end, mkt_posting_pack_h.quot_revision, mkt_posting_pack_h.qty_estimate, mkt_posting_pack_h.client_id, mkt_posting_pack_h.mkt_id, mkt_posting_pack_h.total, mkt_posting_pack_h.total_price, mkt_posting_pack_h.margin, mkt_posting_pack_h.margin_amount, mkt_posting_pack_h.disc, mkt_posting_pack_h.disc_amount, mkt_posting_pack_h.grand_price, mkt_posting_pack_h.approved_by, mkt_posting_pack_h.approved_date, mkt_posting_pack_h.approved_client, mkt_posting_pack_h.ip_addr, mkt_posting_pack_h.notes_client, mkt_posting_pack_h.notes, mkt_posting_pack_h.is_finalised, mkt_posting_pack_h.revised, mkt_posting_pack_h.coa');
		$this->db->from('pat_data');
		$this->db->join('trx_registration', 'pat_data.id_pat=trx_registration.id_pat', 'inner');
		$this->db->join('trx_bh', 'trx_bh.id_reg=trx_registration.id_reg', 'inner');
		$this->db->join('trx_bd', 'trx_bd.id_bh=trx_bh.id_bh', 'inner');
		$this->db->join('mkt_posting_pack_h', 'trx_bd.id_service=mkt_posting_pack_h.id_quot', 'inner');
		// $this->db->join('mst_service_package_h', 'trx_bd.id_service=mst_service_package_h.id_package', 'inner');
		$this->db->where('trx_registration.id_reg', $id_reg);
		$this->db->where('trx_bd.code_service', 12);
		$query = $this->db->get();
		return $query;
	}

	function get_data_mcu_result($register_id)
	{
		$this->db->from('pat_mcu_result');
		$this->db->where('id_regist', $register_id);
		$query = $this->db->get();
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

	function save_invoice($insert_invoice)
	{
		$this->db->insert('trx_pat_invoice', $insert_invoice);
	}

	function save_smart_notif($data)
	{
		$this->db->insert('smart_notification', $data);
	}

	function save_or($insert_invoice)
	{
		$this->db->insert('trx_pat_or', $insert_invoice);
	}

	function save_que_mcu($data_que_mcu)
	{
		$this->db->insert('pat_qst_mcu', $data_que_mcu);
	}

	function insert_trx_pat_payment_h($data_insert)
	{
		$this->db->insert('trx_pat_payment_h', $data_insert);
	}

	function insert_trx_pat_payment_d($insert_detail)
	{
		$this->db->insert('trx_pat_payment_d', $insert_detail);
	}

	function insert_trx_billing($insert_billing)
	{
		$this->db->insert('trx_billing', $insert_billing);
	}

	function insert_trx_bh($data_insert)
	{
		$this->db->insert('trx_bh', $data_insert);
	}

	function del_billing($id_reg)
	{
		$this->db->delete('trx_billing', array('id_reg' => $id_reg));
	}

	function del_trx_bd($id_bh)
	{
		$this->db->delete('trx_bd', array('id_bh' => $id_bh));
	}

	function del_trx_bh($id_bh)
	{
		$this->db->delete('trx_bh', array('id_bh' => $id_bh));
	}

	function insert_trx_bd($data_insert)
	{
		$this->db->insert('trx_bd', $data_insert);
	}

	function insert_log_price($data_insert)
	{
		$this->db->insert('mst_service_price_history', $data_insert);
	}

	function update_que_mcu($data_que_mcu, $id_update)
	{
		$this->db->where('id_qst_mcu', $id_update);
		$this->db->update('pat_qst_mcu', $data_que_mcu);
		return $this->db->affected_rows();
	}

	function update_invoice($id_reg, $id_billing, $data_update)
	{
		$this->db->where('id_reg', $id_reg);
		$this->db->where('id_billing', $id_billing);
		$this->db->update('trx_pat_invoice', $data_update);
		return $this->db->affected_rows();
	}

	function update_trx_billing($id_reg, $data_update)
	{
		$this->db->where('id_reg', $id_reg);
		$this->db->or_where('id_billing', $id_reg);
		$this->db->update('trx_billing', $data_update);
		return $this->db->affected_rows();
	}

	function update_trx_pat_payment_h($id_billing, $data_update)
	{
		$this->db->where('id_billing', $id_billing);
		$this->db->update('trx_pat_payment_h', $data_update);
		return $this->db->affected_rows();
	}

	function save_billing($id_billing, $save_update)
	{
		$this->db->where('id_billing', $id_billing);
		$this->db->update('trx_billing', $save_update);
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

	function update_status_trx_bd2($id_bd, $update_trx_bd)
	{
		$this->db->where('id_bd', $id_bd);
		$this->db->update('trx_bd', $update_trx_bd);
		return $this->db->affected_rows();
	}

	function update_trx_bd($id_bd, $data_update)
	{
		$this->db->where('id_bd', $id_bd);
		$this->db->update('trx_bd', $data_update);
		return $this->db->affected_rows();
	}

	function update_check($id, $data)
	{
		$this->db->where('id_ms_d', $id);
		$this->db->update('pat_ms_d', $data);
		return $this->db->affected_rows();
	}

	function save_que_tread($data_que_tr)
	{
		$this->db->insert('pat_qst_treadmill', $data_que_tr);
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
		$this->db->update('pat_ms_h', $data_pack);
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

	function save_doctor_fee_h($data_fee)
	{
		$this->db->insert('dr_fee_h', $data_fee);
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

	function get_result_grade()
	{
		return $this->db->get('mst_judgment_grade');
	}

	function update_fix_usd()
	{
		$query = $this->db->query("UPDATE mst_service_price SET Currency='USD' WHERE Currency LIKE '%USD%';");
		return $query;
	}

	public function trx_pat_payment_d($id_billing)
	{
		return $this->db
			->select([
				'trx_pat_payment_h.amount as bayar',
				'trx_pat_payment_d.type_payment',
			])
			->from('trx_pat_payment_d')
			->join('trx_pat_payment_h', 'trx_pat_payment_h.id_payment = trx_pat_payment_d.id_payment_header')
			->where('trx_pat_payment_h.id_billing', $id_billing)
			->get();
	}

	public function report_patient_1($from, $to)
	{
		$query = $this->db
			->select([
				'trx_registration.id_reg',
				'trx_registration.reg_date',
				'pat_data.pat_name',
				'mst_doctor.drname as doctor_name',
			])
			->from('trx_registration')
			->join('pat_data', 'pat_data.id_Pat = trx_registration.id_pat')
			->join('mst_doctor', 'mst_doctor.id_dr = trx_registration.id_dr')
			->where("trx_registration.reg_date BETWEEN '$from' AND '$to'", null, false)
			->where('trx_registration.status_reg', 3)
			->order_by('trx_registration.reg_date', 'desc')
			->get();

		return $query;
	}

	public function report_patient_2($id_reg)
	{
		$query = $this->db
			->from('mst_odo')
			->where('mst_odo.id_reg', $id_reg)
			->get();

		return $query;
	}

	public function report_patient_3($id_reg)
	{
		$query = $this->db
			->distinct()
			->select(
				[
					'mst_services.serv_name',
					'mst_service_price.Price as price'
				]
			)
			->from('pat_order_h')
			->join('pat_order_d', 'pat_order_d.id_order_header = pat_order_h.id_order', 'inner')
			->join('mst_services', 'mst_services.id_service = pat_order_d.id_service', 'left')
			->join('mst_service_price', 'mst_service_price.id_service = mst_services.id_service', 'left')
			->where('pat_order_h.id_reg', $id_reg)
			->get();

		return $query;
	}

	public function report_patient_4($id_reg)
	{
		return $this->db
			->select('trx_pat_payment_d.type_payment, trx_pat_payment_d.card_no')
			->from('trx_pat_payment_h')
			->join('trx_pat_payment_d', 'trx_pat_payment_d.id_payment_header = trx_pat_payment_h.id_payment', 'left')
			->where('id_reg', $id_reg)
			->get();
	}
}
