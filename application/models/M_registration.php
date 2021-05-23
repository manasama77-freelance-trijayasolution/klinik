<?php
class M_registration extends CI_Model{

	function get_order_patient($id_reg){
	$this->db->select('trx_registration.id_reg,reg_date,pat_name,pat_MRN,price_type rule,client_name,ins_name,paytype,drname,package_name,trx_registration.id_package,misc_notes,photo');
	$this->db->from('trx_registration');
	$this->db->join('pat_data', 'trx_registration.id_pat = pat_data.id_Pat ','left');
	$this->db->join('mst_doctor', 'trx_registration.id_dr = mst_doctor.id_dr ','left');
	$this->db->join('mst_paytype', 'trx_registration.payment_type = mst_paytype.id_type ','left');
	$this->db->join('mst_insurance', 'trx_registration.insurance_comp = mst_insurance.id_ins_comp ','left');
	$this->db->join('mst_client', 'trx_registration.id_client = mst_client.id_Client ','left');
	$this->db->join('mst_price_type', 'trx_registration.pat_charge_rule = mst_price_type.id_price_type ','left');
	$this->db->join('mst_service_package_h', 'mst_service_package_h.id_package = trx_registration.id_package ','left');
	$this->db->join('pat_photo', 'pat_photo.id_reg = trx_registration.id_reg ','left');
	$this->db->where('trx_registration.id_reg', $id_reg);
	$query = $this->db->get();
	return $query;
	}
	
	function save_registration($data_reg){
    $this->db->insert('trx_registration',$data_reg);
	}

	function get_mst_charge_rule(){
	$categories = array('2', '3', '5', '6','1');
	$this->db->where_in('id_price_type', $categories);
	return $this->db->get('mst_price_type'); //  load name of table
	}
	
	function get_get_apptoday(){
	return $this->db->get('trx_appointment'); //  load name of table
	}
		
	function get_mst_paytype(){
	return $this->db->get('mst_paytype'); //  load name of table
	}
	
	function get_data_reg($id_reg){
	$this->db->select('pat_charge_rule,trx_registration.id_reg,reg_date,pat_name,pat_MRN,price_type,client_name,ins_name,paytype,drname,package_name,trx_registration.id_package,misc_notes,photo,reference,trx_registration.insurance_comp,mst_client_dept.id_client_dept,trx_registration.id_client_job,trx_registration.id_dr,trx_registration.id_sales');
	$this->db->from('trx_registration');
	$this->db->join('pat_data', 'trx_registration.id_pat = pat_data.id_Pat ','left');
	$this->db->join('mst_doctor', 'trx_registration.id_dr = mst_doctor.id_dr ','left');
	$this->db->join('mst_paytype', 'trx_registration.payment_type = mst_paytype.id_type ','left');
	$this->db->join('mst_insurance', 'trx_registration.insurance_comp = mst_insurance.id_ins_comp ','left');
	$this->db->join('mst_client', 'trx_registration.id_client = mst_client.id_Client ','left');
	$this->db->join('mst_client_dept', 'trx_registration.id_client_dept = mst_client_dept.id_client_dept ','left');
	//$this->db->join('mst_client_job', 'trx_registration.id_client_job = mst_client_job.id_client_job ','left');
	$this->db->join('mst_price_type', 'trx_registration.pat_charge_rule = mst_price_type.id_price_type ','left');
	$this->db->join('mst_service_package_h', 'mst_service_package_h.id_package = trx_registration.id_package ','left');
	$this->db->join('pat_photo', 'pat_photo.id_reg = trx_registration.id_reg ','left');
	$this->db->where('trx_registration.id_reg', $id_reg);
	$query = $this->db->get();
	return $query;
	}
	
	function get_mst_client(){
	$this->db->where('status',0);
	$this->db->order_by("client_name","asc");
	return $this->db->get('mst_client'); //  load name of table
	}

	function get_mst_client_dept(){
	return $this->db->get('mst_client_dept'); //  load name of table
	}
	
	function get_mst_client_job(){
	return $this->db->get('mst_client_job'); //  load name of table
	}

	function get_mst_doctor(){
	return $this->db->get('mst_doctor'); //  load name of table
	}

	function get_doctor_by_user(){
	$this->db->from('mst_user');
	$this->db->where('mst_user.menu_level', 3);
	$this->db->where('mst_user.is_active', 1);
	$this->db->order_by("fullname","asc");
	$query = $this->db->get();
	return $query;
	}
	
	function get_sales_by_user(){
	$this->db->from('mst_user');
	$this->db->where('mst_user.menu_level', 5);
	$this->db->where('mst_user.is_active', 1);
	$this->db->order_by('fullname', 'asc');
	$query = $this->db->get();
	return $query;
	}
	
	function get_mst_insurance(){
	$this->db->where('status',0);
	return $this->db->get('mst_insurance'); //  load name of table
	}
	
	function get_mst_services(){
	return $this->db->get('mst_services'); //  load name of table
	}

	function get_mst_service_package_h(){
	$this->db->where('is_finalised',6);
	$this->db->join('mst_client', 'mst_client.id_Client = mkt_posting_pack_h.client_id ','inner');
	return $this->db->get('mkt_posting_pack_h'); //  load name of table
	}
	
	function get_reg_type(){
	return $this->db->get('mst_reg_type'); //  load name of table
	}
	
	function get_mst_branch($loc){
	$this->db->select('kode_company,nama_branch');
	$this->db->from('mst_branch');
	$this->db->where('kode_branch', $loc);
	//$this->db->get_where('kode_branch', array('kode_branch' => $loc));
	$query = $this->db->get();
	return $query;
	}  
	
	function get_reference(){
	$this->db->distinct('reference');
	$this->db->select('reference');
	$this->db->from('trx_registration');
	$query = $this->db->get();
	return $query;
	}

/* 	function get_mst_branch('SELECT kode_company FROM kyoaims.mst_branch where kode_branch='){
	return $this->db->get('mst_branch'); //  load name of table
	} */

	function get_mst_project(){
	$this->db->order_by("project_date_start", "desc");
	return $this->db->get('mst_project'); //  load name of table
	//$query = $this->db->get('mst_project'); 
	//return $query->result();
	}
	
	function print_rgis(){
	$this->db->order_by("project_date_start", "desc");
	return $this->db->get('mst_project'); //  load name of table
	//$query = $this->db->get('mst_project'); 
	//return $query->result();
	}
	
	function get_regdetpatient($id_reg){
	$this->db->select('trx_registration.id_reg,reg_date,pat_name,pat_MRN,price_type rule,client_name,ins_name,paytype,mst_user.fullname as drname,quot_name package_name,trx_registration.id_package,misc_notes,photo');
	$this->db->from('trx_registration');
	$this->db->join('pat_data', 'trx_registration.id_pat = pat_data.id_Pat ','left');
	$this->db->join('mst_user', 'trx_registration.id_dr = mst_user.id ','left');
	$this->db->join('mst_paytype', 'trx_registration.payment_type = mst_paytype.id_type ','left');
	$this->db->join('mst_insurance', 'trx_registration.insurance_comp = mst_insurance.id_ins_comp ','left');
	$this->db->join('mst_client', 'trx_registration.id_client = mst_client.id_Client ','left');
	$this->db->join('mst_price_type', 'trx_registration.pat_charge_rule = mst_price_type.id_price_type ','left');
	$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot = trx_registration.id_package ','left');
	$this->db->join('pat_photo', 'pat_photo.id_reg = trx_registration.id_reg ','left');
	$this->db->where('trx_registration.id_reg', $id_reg);
	$query = $this->db->get();
	return $query;
	}
	
	function get_data_pisik($id_paket_combo){
	$this->db->where('mst_services.order_type',0);
	$this->db->where_in('id_quot', $id_paket_combo);
	$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot ','inner');
	$this->db->join('mst_services', 'mst_services.id_service = mkt_posting_pack_d.service_id ','inner');
	$query = $this->db->get('mkt_posting_pack_h');
	return $query;
	}  
	
	function get_service_group($id){
	$this->db->where_in('id', $id);
	$this->db->join('mst_group_service_d', 'mst_group_service_d.id_header = mst_group_service_h.id ','inner');
	$this->db->join('mst_services', 'mst_services.id_service = mst_group_service_d.id_service ','inner');
	$query = $this->db->get('mst_group_service_h');
	return $query;
	}  
	
	function send_job_lab($id_paket_combo){
	$this->db->where('mst_services.order_type',1);
	$this->db->where_in('id_quot', $id_paket_combo);
	$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot ','inner');
	$this->db->join('mst_services', 'mst_services.id_service = mkt_posting_pack_d.service_id ','inner');
	$query = $this->db->get('mkt_posting_pack_h');
	return $query;
	}  
	
	function send_job_radio($id_paket_combo){
	$files = array(2,6);
	$this->db->where_in('mst_services.id_group_serv',$files);
	$this->db->where_in('id_quot', $id_paket_combo);
	$this->db->join('mkt_posting_pack_d', 'mkt_posting_pack_d.id_quot_header = mkt_posting_pack_h.id_quot ','inner');
	$this->db->join('mst_services', 'mst_services.id_service = mkt_posting_pack_d.service_id ','inner');
	$query = $this->db->get('mkt_posting_pack_h');
	return $query;
	}  

	function reg_update($id_update,$data_reg){
	$this->db->where('id_reg',$id_update);
	$this->db->update('trx_registration',$data_reg);
	return $this->db->affected_rows();
	}

	
}
?>