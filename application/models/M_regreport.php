<?php
class M_regreport extends CI_Model{
	
function get_report_reg(){
	$this->db->select('trx_registration.id_reg,trx_registration.reg_date,pat_data.pat_name,pat_data.pat_MRN,mst_client.client_name,id_service');
	$this->db->from('trx_registration');
	$this->db->join('pat_data', 'trx_registration.id_pat = pat_data.id_pat ','left');
	$this->db->join('mst_client', 'trx_registration.id_client = mst_client.id_Client ','left');
	$this->db->order_by("id_reg", "desc");
/* 	$this->db->limit(0,5); */
	$this->db->limit(1000);
	$query = $this->db->get();
	return $query;
}  
	
function report_reg_as_id($id_reg1,$id_reg2){
	$this->db->select('trx_registration.id_reg,trx_registration.reg_date,pat_data.pat_name,pat_data.pat_MRN,mst_client.client_name,id_service');
	$this->db->from('trx_registration');
	$this->db->join('pat_data', 'trx_registration.id_pat = pat_data.id_pat ','left');
	$this->db->join('mst_client', 'trx_registration.id_client = mst_client.id_Client ','left');
	$this->db->order_by("id_reg", "desc");
	$this->db->where("id_reg BETWEEN $id_reg1 AND $id_reg2");
/* 	$this->db->limit(0,5); */
	$query = $this->db->get();
//	$this->db->limit(1000);
//	$this->db->where('id_reg', $id_reg1);
	return $query;
}  
	
function report_expense_as_date($datereg1,$datereg2){
	$this->db->select('trx_item_po_h.id_po, trx_item_po_d.id_item_po_d, trx_item_po_h.created_date, trx_item_po_d.item_id, trx_item_po_d.item_qty, trx_item_po_h.supplier_id, trx_item_po_d.item_amount');
	$this->db->from('trx_item_po_h');
	$this->db->join('trx_item_po_d', 'trx_item_po_h.id_po=trx_item_po_d.id_po_header','inner');
	$this->db->order_by('trx_item_po_h.created_date', 'desc');
	$this->db->where("SUBSTRING(trx_item_po_h.created_date,1,10) BETWEEN '$datereg1' AND '$datereg2'");
	$query = $this->db->get();
	return $query;
}  

function report_profit_as_date($datereg1,$datereg2){
	$query = $this->db->query("SELECT * FROM ( SELECT `trx_registration`.`id_reg` AS id_trx, `trx_registration`.`reg_date` AS tgl, `serv_name` AS item_in, '-' AS item_out, `mst_service_price`.`Price`, '-' AS ket FROM `trx_registration` LEFT JOIN `pat_data` ON `trx_registration`.`id_pat` = `pat_data`.`id_pat` LEFT JOIN `mst_client` ON `trx_registration`.`id_client` = `mst_client`.`id_Client` LEFT JOIN `pat_order_h` ON `pat_order_h`.`id_reg` = `trx_registration`.`id_reg` LEFT JOIN `pat_order_d` ON `pat_order_d`.`id_order_header` = `pat_order_h`.`id_order` LEFT JOIN `mst_services` ON `mst_services`.`id_service` = `pat_order_d`.`id_service` LEFT JOIN `mst_service_price` ON `mst_services`.`id_service` = `mst_service_price`.`id_service` WHERE mst_service_price.price_type=2 AND SUBSTRING( trx_registration.reg_date, 1, 10 ) BETWEEN '$datereg1' AND '$datereg2' UNION ALL SELECT `trx_item_po_d`.`id_item_po_d`, `trx_item_po_h`.`created_date`, '-' AS item_in, `trx_item_po_d`.`item_id`, `trx_item_po_d`.`item_amount`, '-' AS ket FROM `trx_item_po_h` INNER JOIN `trx_item_po_d` ON `trx_item_po_h`.`id_po` = `trx_item_po_d`.`id_po_header` WHERE SUBSTRING( trx_item_po_h.created_date, 1, 10 ) BETWEEN '$datereg1' AND '$datereg2' ) A ORDER BY tgl");
	return $query;		
}  
	
function report_reg_as_date($datereg1,$datereg2){
	$this->db->select('trx_registration.id_reg, trx_registration.reg_date,pat_data.pat_name, pat_data.pat_MRN, mst_client.client_name, mst_services.id_service, serv_name, mst_service_price.Price');
	$this->db->from('trx_registration');
	$this->db->join('pat_data', 'trx_registration.id_pat = pat_data.id_pat ','left');
	$this->db->join('mst_client', 'trx_registration.id_client = mst_client.id_Client ','left');
	$this->db->join('pat_order_h', 'pat_order_h.id_reg = trx_registration.id_reg ','left');
	$this->db->join('pat_order_d', 'pat_order_d.id_order_header = pat_order_h.id_order ','left');
	$this->db->join('mst_services', 'mst_services.id_service = pat_order_d.id_service ','left');
	$this->db->join('mst_service_price', 'mst_services.id_service = mst_service_price.id_service ','left');
	$this->db->where("mst_service_price.price_type=2");
	$this->db->where("SUBSTRING(trx_registration.reg_date,1,10) BETWEEN '$datereg1' AND '$datereg2'");
	$this->db->order_by("id_reg", "desc");
	$query = $this->db->get();
	return $query;
}  

	
function report_reg_as_date_new($datereg1,$datereg2){
	$this->db->select('trx_registration.id_reg,trx_registration.reg_date,pat_data.pat_name,pat_data.pat_MRN,mst_client.client_name,id_service');
	$this->db->from('trx_registration');
	$this->db->join('pat_data', 'trx_registration.id_pat = pat_data.id_pat ','left');
	$this->db->join('mst_client', 'trx_registration.id_client = mst_client.id_Client ','left');
	$this->db->where("SUBSTRING(trx_registration.reg_date,1,10) BETWEEN '$datereg1' AND '$datereg2'");
	$this->db->order_by("id_reg", "desc");
	$query = $this->db->get();
	return $query;
}  

	function get_trx_registration2($id_reg){
	$this->db->where('trx_registration.id_reg', $id_reg);
	return $this->db->get('trx_registration'); //  load name of table
	}

	function del_trx_registration($id_reg){
	$this->db->delete('trx_registration', array('id_reg' => $id_reg)); 
	}

	function update_registration($data_user,$id){
	$this->db->where('id_reg',$id);
	$this->db->update('trx_registration',$data_user);
	}

 	function get_patient_data_mark(){
	$this->db->select('*');
	$this->db->from('pat_data');
	$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
	$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
	$this->db->join('trx_registration', 'trx_registration.id_pat = pat_data.id_pat',  'inner');
	$query = $this->db->get();
	return $query;
	}


/* Select
  trx_registration.id_reg,
  trx_registration.reg_date,
  trx_registration.id_pat,
  pat_data.pat_MRN,
  pat_data.pat_name,
  pat_data.id_Pat As id_Pat1
From
  trx_registration Inner Join
  pat_data On trx_registration.id_pat = pat_data.id_Pat  */  


	function get_trx_registration(){
	return $this->db->get('trx_registration'); //  load name of table
	}
	
	 
    /* function save_registration($data_reg){
	$this->db->insert('trx_registration',$data_reg);
	}

		
	function get_mst_charge_rule(){
	return $this->db->get('mst_charge_rule'); //  load name of table
	}
		
	function get_mst_paytype(){
	return $this->db->get('mst_paytype'); //  load name of table
	}
	
	function get_mst_client(){
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
	
	function get_mst_insurance(){
	return $this->db->get('mst_insurance'); //  load name of table
	}
	
	function get_mst_services(){
	return $this->db->get('mst_services'); //  load name of table
	}

	function get_mst_service_package_h(){
	return $this->db->get('mst_service_package_h'); //  load name of table
	}

	function get_mst_project(){
	$this->db->order_by("project_date_start", "desc");
	return $this->db->get('mst_project'); //  load name of table
	//$query = $this->db->get('mst_project'); 
	//return $query->result();
	}

	 */
}
?>