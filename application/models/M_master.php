<?php
class M_master extends CI_Model{

	function get_list_log(){
	$this->db->from('usr_log');
	$this->db->join('mst_user','usr_log.id_user=mst_user.id','inner');
	$this->db->order_by('log_date', 'desc');
	$query = $this->db->get();
	return $query;
	}
	
	function get_list_sysparam(){
	$this->db->distinct('sgroup');
	$this->db->select('sgroup, count(*) AS jumlah');
	$this->db->from('sysparam');
	$this->db->where('status', 0);
	$this->db->group_by('sgroup');
	$this->db->order_by('sgroup', 'asc');
	$query = $this->db->get();
	return $query;
	}

	function get_trx_note($group_notes,$id_order){
	$this->db->from('trx_notes');
	$this->db->where('group_notes', $group_notes);
	$this->db->where('id_order', $id_order);
	$query = $this->db->get();
	return $query;
	}

	function get_patient($id_pat){
	$this->db->where('id_pat', $id_pat);
	return $this->db->get('pat_data');
	}

	function get_pr($id_pr_no){
	$this->db->where('id_pr_no', $id_pr_no);
	return $this->db->get('trx_item_pr_h');
	}

	function get_kriteria_id($id_pr_no){
	$this->db->where('id', $id_pr_no);
	return $this->db->get('mst_kriteria');
	}
	function get_kriteria(){
	return $this->db->get('mst_kriteria');
	}

	function get_number_param($remark){
	$this->db->where('remark', $remark);
	$this->db->where('sgroup', 'create_number');
	return $this->db->get('sysparam');
	}

	function get_sysparam($sgroup, $remark){
	$this->db->from('sysparam');
	$this->db->where('status',0);
	$this->db->where('remark', $remark);
	$this->db->where('sgroup', $sgroup);
	$query = $this->db->get();
	return $query;
	}

	function get_patient2($id_reg){
	$this->db->from('trx_registration');
	$this->db->join('pat_data','trx_registration.id_pat=pat_data.id_Pat','inner');
	$this->db->where('trx_registration.id_reg', $id_reg);
	$query = $this->db->get();
	return $query;
	}
	
	function cek_sysparam($sgroup){
	$this->db->where('status',0);
	$this->db->where('sgroup',$sgroup);
	return $this->db->get('sysparam');
	}

	function cek_timer($id_order, $group_id){
	$this->db->where('group_id',$group_id);
	$this->db->where('id_order',$id_order);
	return $this->db->get('trx_timer');
	}

	function cek_notes($id_order, $group_notes){
	$this->db->where('group_notes',$group_notes);
	$this->db->where('id_order',$id_order);
	return $this->db->get('trx_notes');
	}

	function cek_mst_item_value($id){
	$this->db->where('id',$id);
	return $this->db->get('mst_item_value');
	}

	function cek_mst_lab_item($id){
	$this->db->where('id_lab_item',$id);
	return $this->db->get('mst_lab_item');
	}

	function cek_mst_lab_range($id){
	$this->db->where('id_lab_item_range',$id);
	return $this->db->get('mst_lab_item_range');
	}

	function cek_mst_rad_item($id){
	$this->db->where('id_rad_item',$id);
	return $this->db->get('mst_rad_item');
	}

	function cek_mst_services($id){
	$this->db->where('id_service',$id);
	return $this->db->get('mst_services');
	}

	function cek_mst_lab_group($id){
	$this->db->where('id_lab_item_group',$id);
	return $this->db->get('mst_lab_group');
	}

	function cek_mst_rad_group($id){
	$this->db->where('id_rad_group',$id);
	return $this->db->get('mst_rad_group');
	}

	function view_sysparam($id){
	$this->db->where('id',$id);
	return $this->db->get('sysparam');
	}

	function cek_data_billing2($id_reg){
	$this->db->where('id_reg',$id_reg);
	return $this->db->get('trx_pharmacy_h');
	}

	function get_billing_item_request($id_reg,$split){
	$this->db->from('trx_bh');
	$this->db->join('trx_bd','trx_bh.id_bh=trx_bd.id_bh','inner');
	$this->db->where('trx_bh.id_reg', $id_reg);
	$this->db->where('trx_bd.split', $split);
	$this->db->where(array('id_service' => 0));
	$query = $this->db->get();
	return $query;
	}

	function get_list_services_bahasa(){
	$query = $this->db->query("SELECT * FROM ( SELECT '1' AS kode_tabel, 'mst_item_value' AS nama_tabel, mst_service_group.group_desc AS group_name, mst_item_value.id, mst_item_value.nama_value, mst_item_value.nama_value_j FROM `mst_item_value` LEFT JOIN mst_service_group ON mst_item_value.id_group_serv = mst_service_group.id_serv_group UNION ALL SELECT '2' AS kode_tabel, 'mst_lab_item' AS nama_tabel, 'Lab Exam. [Pemeriksaan Lab]' AS group_name, mst_lab_item.id_lab_item, mst_lab_item.lab_item_abbr, mst_lab_item.lab_item_name_j FROM mst_lab_item UNION ALL SELECT '3' AS kode_tabel, 'mst_rad_item' AS nama_tabel, 'Radiology Exam. [Pemeriksaan Radiologi]' AS group_name, mst_rad_item.id_rad_item, mst_rad_item.rad_item, mst_rad_item.rad_item_j FROM mst_rad_item UNION ALL SELECT '4' AS kode_tabel, 'mst_services' AS nama_tabel, mst_service_group.group_desc AS group_name, mst_services.id_service, mst_services.serv_name, mst_services.serv_name_j FROM `mst_services` LEFT JOIN mst_service_group ON mst_services.id_group_serv = mst_service_group.id_serv_group UNION ALL SELECT '5' AS kode_tabel, 'mst_lab_group' AS nama_tabel, 'Lab Exam. [Pemeriksaan Lab]' AS group_name, mst_lab_group.id_lab_item_group, mst_lab_group.group_name, mst_lab_group.group_name_j FROM `mst_lab_group` UNION ALL SELECT '6' AS kode_tabel, 'mst_rad_group' AS nama_tabel, 'Radiology Exam. [Pemeriksaan Radiologi]' AS group_name, mst_rad_group.id_rad_group, mst_rad_group.group_desc, mst_rad_group.group_desc_j FROM `mst_rad_group` UNION ALL SELECT '7' AS kode_tabel, 'mst_lab_item_range' AS nama_tabel, 'Lab Exam. [Pemeriksaan Lab]' AS group_name, mst_lab_item_range.id_lab_item_range, mst_lab_item_range.name_type, mst_lab_item_range.name_j FROM `mst_lab_item_range` ) A ORDER BY nama_value ASC");
	return $query;
	}

	function get_list_services_bahasa_xl(){
	$query = $this->db->query("SELECT DISTINCT nama_value, nama_value_j FROM ( SELECT '1' AS kode_tabel, 'mst_item_value' AS nama_tabel, mst_service_group.group_desc AS group_name, mst_item_value.id, mst_item_value.nama_value, mst_item_value.nama_value_j FROM `mst_item_value` LEFT JOIN mst_service_group ON mst_item_value.id_group_serv = mst_service_group.id_serv_group UNION ALL SELECT '2' AS kode_tabel, 'mst_lab_item' AS nama_tabel, 'Lab Exam. [Pemeriksaan Lab]' AS group_name, mst_lab_item.id_lab_item, mst_lab_item.lab_item_abbr, mst_lab_item.lab_item_name_j FROM mst_lab_item UNION ALL SELECT '3' AS kode_tabel, 'mst_rad_item' AS nama_tabel, 'Radiology Exam. [Pemeriksaan Radiologi]' AS group_name, mst_rad_item.id_rad_item, mst_rad_item.rad_item, mst_rad_item.rad_item_j FROM mst_rad_item UNION ALL SELECT '4' AS kode_tabel, 'mst_services' AS nama_tabel, mst_service_group.group_desc AS group_name, mst_services.id_service, mst_services.serv_name, mst_services.serv_name_j FROM `mst_services` LEFT JOIN mst_service_group ON mst_services.id_group_serv = mst_service_group.id_serv_group UNION ALL SELECT '5' AS kode_tabel, 'mst_lab_group' AS nama_tabel, 'Lab Exam. [Pemeriksaan Lab]' AS group_name, mst_lab_group.id_lab_item_group, mst_lab_group.group_name, mst_lab_group.group_name_j FROM `mst_lab_group` UNION ALL SELECT '6' AS kode_tabel, 'mst_rad_group' AS nama_tabel, 'Radiology Exam. [Pemeriksaan Radiologi]' AS group_name, mst_rad_group.id_rad_group, mst_rad_group.group_desc, mst_rad_group.group_desc_j FROM `mst_rad_group` UNION ALL SELECT '7' AS kode_tabel, 'mst_lab_item_range' AS nama_tabel, 'Lab Exam. [Pemeriksaan Lab]' AS group_name, mst_lab_item_range.id_lab_item_range, mst_lab_item_range.name_type, mst_lab_item_range.name_j FROM `mst_lab_item_range` ) A ORDER BY nama_value ASC");
	return $query;
	}

	function get_list_services(){
	$query = $this->db->query("SELECT a.id_service,'Pemeriksaan Fisik' as group_name,serv_name,order_id,a.id_service,serv_seq_no,'1' AS KET, price, c.price_type, order_type, currency
    FROM mst_services a 
    LEFT JOIN mst_service_price b ON a.id_service=b.id_service 
    LEFT JOIN mst_price_type c ON b.price_type=c.id_price_type  
    WHERE id_group_serv=4;");
	return $query;
	}

	function get_max_split_trx_bd($id_reg){
	$this->db->select_max('split');
	$this->db->from('trx_bh');
	$this->db->join('trx_bd', 'trx_bh.id_bh = trx_bd.id_bh ', 'inner');
	$this->db->where('id_reg',$id_reg);
	$query = $this->db->get();
	return $query;
	}

	function save_trx_notes($data_insert){
	$this->db->insert('trx_notes',$data_insert);
	}

	function save_sysparam($data_insert){
	$this->db->insert('sysparam',$data_insert);
	}

	function save_kriteria($data_insert){
	$this->db->insert('mst_kriteria',$data_insert);
	}

	function insert_timer($data_insert){
	$this->db->insert('trx_timer',$data_insert);
	}

	function save_invoice($insert_invoice){
	$this->db->insert('trx_pat_invoice',$insert_invoice);
	}

	function del_trx_bh($id_bh){
	$this->db->delete('trx_bh', array('id_bh' => $id_bh)); 
	}

	function update_sysparam($id,$data_update){
	$this->db->where('id',$id);
	$this->db->update('sysparam',$data_update);
	return $this->db->affected_rows();
	}
	
	function update_timer($id,$data_update){
	$this->db->where('id_timer',$id);
	$this->db->update('trx_timer',$data_update);
	return $this->db->affected_rows();
	}

	function update_mst_item_value($id,$data_update){
	$this->db->where('id',$id);
	$this->db->update('mst_item_value',$data_update);
	return $this->db->affected_rows();
	}

	function update_mst_lab_item($id,$data_update){
	$this->db->where('id_lab_item',$id);
	$this->db->update('mst_lab_item',$data_update);
	return $this->db->affected_rows();
	}

	function update_mst_rad_item($id,$data_update){
	$this->db->where('id_rad_item',$id);
	$this->db->update('mst_rad_item',$data_update);
	return $this->db->affected_rows();
	}

	function update_mst_services($id,$data_update){
	$this->db->where('id_service',$id);
	$this->db->update('mst_services',$data_update);
	return $this->db->affected_rows();
	}

	function update_mst_lab_group($id,$data_update){
	$this->db->where('id_lab_item_group',$id);
	$this->db->update('mst_lab_group',$data_update);
	return $this->db->affected_rows();
	}

	function update_mst_rad_group($id,$data_update){
	$this->db->where('id_rad_group',$id);
	$this->db->update('mst_rad_group',$data_update);
	return $this->db->affected_rows();
	}

	function find_labresult_idrange_null(){
	$query = $this->db->query("SELECT * FROM pat_lab_result WHERE id_lab_range IS NULL OR id_lab_range = '' ORDER BY id_lab_item");
	return $query;
	}

	function get_lab_range($id_lab_item,$pat_gender,$months){
	$this->db->where('id_lab_item', $id_lab_item);
	$this->db->where('pat_gender', $pat_gender);
	$this->db->where("'$months' BETWEEN age_range_1 AND age_range_2");
	return $this->db->get('mst_lab_item_range');
	}
	
	function update_pat_lab_result($id_lab_result,$data_update){
	$this->db->where('id_lab_result',$id_lab_result);
	$this->db->update('pat_lab_result',$data_update);
	return $this->db->affected_rows();
	}

	function sys_group_lab(){
	$query = $this->db->query("UPDATE mst_lab_item LEFT JOIN pat_lab_result ON mst_lab_item.id_lab_item = pat_lab_result.id_lab_item SET pat_lab_result.lab_item_group = mst_lab_item.lab_item_group");
	return $query;
	}
	
	function sys_stdvalue_lab(){
	$query = $this->db->query("UPDATE pat_lab_result LEFT JOIN mst_lab_item_range ON pat_lab_result.id_lab_range = mst_lab_item_range.id_lab_item_range SET pat_lab_result.std_value = mst_lab_item_range.std_value, pat_lab_result.name_type=mst_lab_item_range.name_type");
	return $query;
	
	$query_2 = $this->db->query("UPDATE 
	pat_result_mcu 
	LEFT JOIN mst_item_value 
    ON pat_result_mcu.id_service = mst_item_value.id_service AND pat_result_mcu.`id_value`=mst_item_value.`id` SET ranges = CONCAT_WS(
      ' - ',
      mst_item_value.limit_1,
      mst_item_value.limit_2
    )
    WHERE pat_result_mcu.ranges = '0'");
	return $query_2;
	
	$query_3 = $this->db->query("UPDATE mst_services 
	INNER JOIN mkt_posting_pack_d ON mst_services.id_service=mkt_posting_pack_d.service_id
	SET mkt_posting_pack_d.group_service=mst_services.id_group_serv
	WHERE mst_services.id_group_serv - mkt_posting_pack_d.group_service <> 0;");
	return $query_3;
		
	$query_4 = $this->db->query("UPDATE `mst_lab_item_range` SET std_value=CONCAT(low_limit,'-',high_limit) where std_value='';
	UPDATE `mst_lab_item_range` SET std_value=CONCAT(low_limit,'-',high_limit) where std_value is null;
	");
	return $query_4;
	}

	function sys_namavalue_rad(){
	$query = $this->db->query("UPDATE pat_rad_result LEFT JOIN mst_rad_item ON pat_rad_result.id_rad_item=mst_rad_item.id_rad_item SET pat_rad_result.nama_value=mst_rad_item.rad_item_abbr WHERE pat_rad_result.nama_value IS NULL");
	return $query;
	}

	


}
?>