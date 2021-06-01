<?php
class m_pharmacy extends CI_Model{
	
	function get_trx_pharmacy($presc_no){
		$this->db->where('presc_no',$presc_no);
		return $this->db->get('trx_pharmacy_h');
	}
	
	function get_trx_pharmacy2($id_reg){
		$this->db->where('id_reg',$id_reg);
		return $this->db->get('trx_pharmacy_h');
	}
	
	function get_pat_prescription_h_data($id_reg){
		$this->db->where('id_reg',$id_reg);
		return $this->db->get('pat_prescription_h');
	}

	function get_item_drug_by_id($id_item){
		$this->db->where('id_item',$id_item);
		return $this->db->get('mst_item');
	}

	function get_item_drug(){
		$this->db->from('mst_item');
		$this->db->join('mst_baseunit','mst_item.baseunit=mst_baseunit.id_baseunit','inner');
		$this->db->where('item_group',2);
		$this->db->where('id_manufaktur',0);
		$query = $this->db->get();
		return $query;
	}

	function get_find_item_drug(){
	$arr = array('3', '6', '7', '8');
	$this->db->select('mst_item_group.item_group,item_name,supp_name,warehouse_name,item_curr_qty,mst_baseunit.baseunit,item_remarks,id_item,id_baseunit,ifnull(mst_item.id_manufaktur,"0") as id_manufaktur');
	$this->db->from('mst_item');
	$this->db->join('mst_item_group', 'mst_item_group.id_item_group = mst_item.item_group', 'left');
	$this->db->join('mst_supplier', 'mst_supplier.id_supplier = mst_item.supplier_id', 'left');
	$this->db->join('mst_warehouse', 'mst_warehouse.id_warehouse = mst_item.warehouse_id', 'left');
	$this->db->join('mst_baseunit', 'mst_baseunit.id_baseunit = mst_item.baseunit', 'left');
	$this->db->where_in('mst_item.item_group', $arr);
	$query = $this->db->get();
	return $query;
	}

	function get_list_received($id){
	$query = $this->db->query("1 SELECT item_name,is_completed,id_po,po_no,po_date,
	GROUP_CONCAT('*',item_name,' (',trx_item_po_d.item_qty,' ',mst_baseunit.baseunit,') ' SEPARATOR ';') items, 
	supp_name supplier, 
	COUNT(id_po_header) qty, 
	is_completed status, XX.lvalue as stsvalue   
	FROM trx_item_po_h 
	INNER JOIN trx_item_po_d ON trx_item_po_d.id_po_header=trx_item_po_h.id_po 
	INNER JOIN mst_item ON mst_item.id_item=trx_item_po_d.item_id 
	INNER JOIN mst_conversion ON mst_conversion.id_conv = trx_item_po_d.item_uom
	INNER JOIN mst_baseunit ON mst_baseunit.id_baseunit = mst_conversion.source_baseunit
	INNER JOIN mst_user ON mst_user.id=trx_item_po_h.user_id 
	LEFT JOIN trx_item_pr_h ON trx_item_pr_h.id_pr_no=trx_item_po_d.id_pr_header
	INNER JOIN mst_supplier ON mst_supplier.id_supplier=trx_item_po_h.supplier_id
	INNER JOIN (SELECT * FROM sysparam WHERE sgroup='status' AND remark LIKE '%trx_item_po_h%') XX ON trx_item_po_h.is_completed=XX.skey
	GROUP BY po_no ORDER BY id_po DESC;");
	return $query;
	}
	

	function get_find_item_drug2(){
	$this->db->select('mst_item_group.item_group,item_name,supp_name,warehouse_name,item_curr_qty,mst_baseunit.baseunit,item_remarks,mst_item.id_item,id_baseunit,mst_item_price.Price as item_price');
	$this->db->from('mst_item');
	$this->db->join('mst_item_price','mst_item.id_item=mst_item_price.id_item','left');
	$this->db->join('mst_item_group', 'mst_item_group.id_item_group = mst_item.item_group', 'inner');
	$this->db->join('mst_supplier', 'mst_supplier.id_supplier = mst_item.supplier_id', 'left');
	$this->db->join('mst_warehouse', 'mst_warehouse.id_warehouse = mst_item.warehouse_id', 'inner');
	$this->db->join('mst_baseunit', 'mst_baseunit.id_baseunit = mst_item.baseunit', 'inner');
	$this->db->where('mst_item.item_group', 6);
	$this->db->where('id_manufaktur',0);
	$query = $this->db->get();
	return $query;
	}

	function get_patient_data_all(){
		$tgl = date("Y-m-d");

		$this->db->select('*');
		$this->db->from('pat_data');
		$this->db->join('trx_registration', 'pat_data.id_pat=trx_registration.id_pat', 'left');
		$this->db->join('mst_gender', 'mst_gender.id_gender = pat_data.pat_gender', 'left');
		$this->db->join('mst_marital_status', 'mst_marital_status.id_status = pat_data.pat_marital_status', 'left');
		$this->db->where('trx_registration.reg_date', $tgl);
		$query = $this->db->get();
		return $query;
	}

	function get_list_manufaktur_header(){
		$this->db->where('status',0);
		return $this->db->get('mst_manufaktur_h');
	}

	function get_id_item($id){
		$this->db->where('id_manufaktur',$id);
		return $this->db->get('mst_item');
	}

	function get_data_pharmacy($id_reg){
	$this->db->from('pat_data');
	$this->db->join('trx_registration ','pat_data.id_pat=trx_registration.id_pat','inner');
	$this->db->join('pat_prescription_h ','trx_registration.id_reg=pat_prescription_h.id_reg','inner');
	$this->db->join('pat_prescription_d ','pat_prescription_h.id_presc=pat_prescription_d.id_presc_h','inner');
	$this->db->join('mst_item ','mst_item.id_item=pat_prescription_d.drug_id','inner');
	$this->db->join('mst_item_price ','mst_item.id_item = mst_item_price.id_item and trx_registration.pat_charge_rule=mst_item_price.price_type','left');
	$this->db->join('mst_baseunit','mst_item.baseunit=mst_baseunit.id_baseunit','inner');
	$this->db->join('mst_drug_dosage','pat_prescription_d.drug_dosage=mst_drug_dosage.id_drug_dosage','inner');
	$this->db->where('trx_registration.id_reg',$id_reg);
	$query = $this->db->get(); 
	return $query;
	}

	function get_list_resep_header_all(){
		$presc_status = array(2,4);
		$this->db->from('pat_prescription_h');
		$this->db->join('pat_data','pat_prescription_h.id_pat=pat_data.id_pat','inner');
		$this->db->join('(select sgroup,skey,svalue,lvalue from sysparam where sgroup="presc_status" and remark="pat_prescription_h") C','C.skey=pat_prescription_h.presc_status','inner');
		$this->db->where_in('presc_status', $presc_status);
		$query = $this->db->get();
		return $query;
	}

	function get_list_resep_header(){
		$presc_status = array(1,4);
		$this->db->from('pat_prescription_h');
		$this->db->join('pat_data','pat_prescription_h.id_pat=pat_data.id_pat','inner');
		$this->db->join('(select sgroup,skey,svalue,lvalue from sysparam where sgroup="presc_status" and remark="pat_prescription_h") C','C.skey=pat_prescription_h.presc_status','inner');
		$this->db->where_not_in('presc_status', $presc_status);
		$query = $this->db->get();
		return $query;
	}

	function get_warehouse_stock($id_item,$jml){
	$query = $this->db->query("SELECT  mst_warehouse.id_warehouse, mst_warehouse.warehouse_name,trx_item_wh.id_item, sum(trx_item_wh.stock) as jumlah 
			FROM trx_item_wh 
			INNER JOIN mst_warehouse ON trx_item_wh.id_warehouse=mst_warehouse.id_warehouse 
			WHERE mst_warehouse.status=0 and trx_item_wh.id_item=$id_item and trx_item_wh.stock >= $jml
			GROUP BY mst_warehouse.id_warehouse,mst_warehouse.warehouse_name;");
	return $query;
	}

	function get_list_resep_detail($id_presc_h){
		$this->db->select('*,ifnull(Price,"0") as item_price');
		$this->db->from('pat_prescription_h');
		$this->db->join('pat_prescription_d','pat_prescription_h.id_presc=pat_prescription_d.id_presc_h','inner');
		$this->db->join('mst_item','pat_prescription_d.drug_id=mst_item.id_item','inner');
		$this->db->join('mst_baseunit','pat_prescription_d.drug_uom=mst_baseunit.id_baseunit','inner');
		$this->db->join('mst_drug_dosage','pat_prescription_d.drug_dosage=mst_drug_dosage.id_drug_dosage','left');
		$this->db->join('mst_warehouse','mst_item.warehouse_id=mst_warehouse.id_warehouse','inner');
		$this->db->join('trx_registration','pat_prescription_h.id_reg=trx_registration.id_reg','inner');
		$this->db->join('mst_item_price','mst_item.id_item=mst_item_price.id_item and mst_item_price.price_type=trx_registration.pat_charge_rule','left');
		$this->db->where('pat_prescription_h.id_presc',$id_presc_h);
		$this->db->order_by("drug_group", "asc"); 
		$this->db->order_by("id_presc_h", "desc"); 
		$query = $this->db->get();
		return $query;
	}

	function get_list_update_resep_detail($id_presc_h){
		$this->db->select('trx_pharmacy_d.id_phar_d, trx_pharmacy_d.id_phar_h, mst_item.item_name, mst_drug_dosage.dosage_main, mst_drug_dosage.dosage_days, trx_pharmacy_d.id_warehouse, trx_pharmacy_d.warehouse_name, pat_prescription_d.drug_qty AS drug_qty1, trx_pharmacy_d.drug_qty as drug_qty2,mst_baseunit.baseunit, mst_item_price.Price as item_price,trx_pharmacy_d.disc1, trx_pharmacy_d.disc2, trx_pharmacy_d.amount as amount3,trx_pharmacy_h.amount as amount2, trx_pharmacy_h.ppn, trx_pharmacy_h.total,trx_pharmacy_d.stock, trx_pharmacy_d.balance,trx_pharmacy_h.presc_no,trx_pharmacy_h.id_reg, trx_pharmacy_h.id_pat,mst_item.id_manufaktur,pat_prescription_d.drug_uom,trx_pharmacy_d.drug_id,trx_item_wh.stock');
		$this->db->from('pat_prescription_h');
		$this->db->join('pat_prescription_d','pat_prescription_h.id_presc=pat_prescription_d.id_presc_h','inner');
		$this->db->join('mst_item','pat_prescription_d.drug_id=mst_item.id_item','inner');
		$this->db->join('mst_baseunit','pat_prescription_d.drug_uom=mst_baseunit.id_baseunit','inner');
		$this->db->join('mst_drug_dosage','pat_prescription_d.drug_dosage=mst_drug_dosage.id_drug_dosage','left');
		$this->db->join('trx_pharmacy_h','pat_prescription_h.id_presc=trx_pharmacy_h.presc_no','inner');
		$this->db->join('trx_pharmacy_d','trx_pharmacy_h.id_phar_trx=trx_pharmacy_d.id_phar_h AND pat_prescription_d.drug_id=trx_pharmacy_d.drug_id','inner');
		$this->db->join('trx_registration','pat_prescription_h.id_reg=trx_registration.id_reg','inner');
		$this->db->join('mst_item_price','mst_item.id_item=mst_item_price.id_item and mst_item_price.price_type=trx_registration.pat_charge_rule','left');
		$this->db->join('trx_item_wh','trx_pharmacy_d.drug_id=trx_item_wh.id_item AND trx_pharmacy_d.id_warehouse=trx_item_wh.id_warehouse','left');
		$this->db->where('pat_prescription_h.id_presc',$id_presc_h);
		$query = $this->db->get();
		return $query;
	}


	function get_list_manufaktur_detail($id_manufaktur_h){
		$this->db->select('mst_manufaktur_d.*,mst_item.item_name,mst_baseunit.baseunit');
		$this->db->from('mst_manufaktur_d');
		$this->db->join('mst_item','mst_manufaktur_d.id_item=mst_item.id_item','inner');
		$this->db->join('mst_baseunit','mst_manufaktur_d.base_unit=mst_baseunit.id_baseunit','inner');
		$this->db->where('id_manufaktur_h',$id_manufaktur_h);
		$this->db->where('status',0);
		$query = $this->db->get('');
		return $query;
	}

	function get_list_drugs(){
		$this->db->where('item_group',6);
		return $this->db->get('mst_item');
	}

	function get_list_instruction(){
		return $this->db->get('mst_baseunit');
	}

	function get_list_label(){
		$this->db->where('status',0);
		return $this->db->get('mst_label');
	}

	function get_list_label_id($id){
		$this->db->where('id_label',$id);
		$this->db->where('status',0);
		return $this->db->get('mst_label');
	}

	function save_label($data_insert){
		$this->db->insert('mst_label',$data_insert);
	}	

	function get_list_manufaktur_all(){
		$this->db->from('mst_manufaktur_h');
		$this->db->join('mst_manufaktur_d','mst_manufaktur_h.id_manufaktur=mst_manufaktur_d.id_manufaktur_h','inner');
		$query = $this->db->get();
		return $query;
	}
	
	function get_max_id_prescription(){
		$this->db->select_max('id_presc');
		$query = $this->db->get('pat_prescription_h');
		return $query;
	}

	function get_max_id_manufaktur(){
		$this->db->select_max('id_manufaktur');
		$query = $this->db->get('mst_manufaktur_h');
		return $query;
	}

	function get_max_id_phar_trx(){
		$this->db->select_max('id_phar_trx');
		$query = $this->db->get('trx_pharmacy_h');
		return $query;
	}

	function save_manufaktur_h($data_insert_h){
		$this->db->insert('mst_manufaktur_h',$data_insert_h);
	}

	function save_trx_pharmacy_h($data_insert){
		$this->db->insert('trx_pharmacy_h',$data_insert);
	}

	function save_trx_pharmacy_d($data_insert){
		$this->db->insert('trx_pharmacy_d',$data_insert);
	}

	function save_trx_undispensed($data_insert){
		$this->db->insert('trx_undispensed',$data_insert);
	}

	function save_manufaktur_d($data_insert_d){
		$this->db->insert('mst_manufaktur_d',$data_insert_d);
	}

	function get_list_dosage(){
		$this->db->where('status',0);
		return $this->db->get('mst_drug_dosage');
	}

	function get_list_dosage_id($id){
		$this->db->where('id_drug_dosage',$id);
		$this->db->where('status',0);
		return $this->db->get('mst_drug_dosage');
	}

	function get_list_dosageBy_Iditem($id_item){
		$this->db->where('status',0);
		$this->db->where('id_drug',$id_item);
		return $this->db->get('mst_drug_dosage');
	}

	function save_dosage($data_insert){
		$this->db->insert('mst_drug_dosage',$data_insert);
	}

	function save_prescription($data_insert){
		$this->db->insert('pat_prescription_h',$data_insert);
	}


	function save_prescription_d($data_insert_d){
		$this->db->insert('pat_prescription_d',$data_insert_d);
	}

	function del_trx_pharmacy_h($id_phar_trx){
	$this->db->delete('trx_pharmacy_h', array('id_phar_trx' => $id_phar_trx)); 
	}

	function del_trx_pharmacy_d($id_phar_h){
	$this->db->delete('trx_pharmacy_d', array('id_phar_h' => $id_phar_h)); 
	}

	function delete_dosage($id,$data_delete){
	$this->db->where('id_drug_dosage',$id);
	$this->db->update('mst_drug_dosage',$data_delete);
	return $this->db->affected_rows();
	}

	function delete_label($id,$data_delete){
	$this->db->where('id_label',$id);
	$this->db->update('mst_label',$data_delete);
	return $this->db->affected_rows();
	}

	function delete_manufaktur($id,$data_delete){
	$this->db->where('id_manufaktur',$id);
	$this->db->update('mst_manufaktur_h',$data_delete);
	return $this->db->affected_rows();
	}

	function delete_mst_item($id,$data_delete){
	$this->db->where('id_item',$id);
	$this->db->update('mst_item',$data_delete);
	return $this->db->affected_rows();
	}

	function delete_prescription($id,$data_delete){
	$this->db->where('id_presc',$id);
	$this->db->update('pat_prescription_h',$data_delete);
	return $this->db->affected_rows();
	}

	function update_prescription($id,$data_delete){
	$this->db->where('id_presc',$id);
	$this->db->update('pat_prescription_h',$data_delete);
	return $this->db->affected_rows();
	}

	function update_trx_pharmacy_h($id_phar_h,$data_update){
	$this->db->where('id_phar_trx',$id_phar_h);
	$this->db->update('trx_pharmacy_h',$data_update);
	return $this->db->affected_rows();
	}
	
	function update_trx_pharmacy_h2($presc_no,$data_update){
	$this->db->where('presc_no',$presc_no);
	$this->db->update('trx_pharmacy_h',$data_update);
	return $this->db->affected_rows();
	}
	
	function update_trx_pharmacy_d($id_phar_d,$data_update){
	$this->db->where('id_phar_d',$id_phar_d);
	$this->db->update('trx_pharmacy_d',$data_update);
	return $this->db->affected_rows();
	}

	function update_trx_pharmacy_d2($id_phar_h,$data_update){
	$this->db->where('id_phar_h',$id_phar_h);
	$this->db->update('trx_pharmacy_d',$data_update);
	return $this->db->affected_rows();
	}

	function update_werehouse_stock($id_item,$id_warehouse,$jml,$data_warehouse){
	$this->db->where('id_warehouse',$id_warehouse);
	$this->db->where('id_item',$id_item);
	$this->db->set('stock','stock-'.$jml, FALSE);
	$this->db->update('trx_item_wh',$data_warehouse);
	return $this->db->affected_rows();	
	}

	function update_stock_itemwh($id_item,$id_warehouse,$data_warehouse){
	$this->db->where('id_warehouse',$id_warehouse);
	$this->db->where('id_item',$id_item);
	$this->db->update('trx_item_wh',$data_warehouse);
	return $this->db->affected_rows();	
	}

	function get_iditem_manufaktur($drug_id){
	$this->db->select('*,mst_manufaktur_d.id_item as drug_id');		
	$this->db->from('mst_manufaktur_h');		
	$this->db->join('mst_manufaktur_d','mst_manufaktur_h.id_manufaktur=mst_manufaktur_d.id_manufaktur_h','inner');		
	$this->db->join('mst_item','mst_manufaktur_h.id_manufaktur=mst_item.id_manufaktur','inner');		
	$this->db->where('mst_manufaktur_h.id_manufaktur',$drug_id);		
	$query = $this->db->get();
	return $query;
	}
	
	
}
?>