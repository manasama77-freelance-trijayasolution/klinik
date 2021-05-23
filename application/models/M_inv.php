<?php
class M_inv extends CI_Model{

	function insert_trx_item_wh($data_group){
	$this->db->insert('trx_item_wh',$data_group);
	}
	
	function insert_smart_notification($data_group){
	$this->db->insert('smart_notification',$data_group);
	}
	
	function save_pr_header($data_pack){
	$this->db->insert('trx_item_pr_h',$data_pack);
	}

	function save_pr_detail($data_pack){
	$this->db->insert('trx_item_pr_d',$data_pack);
	}

	function save_mi_header($data_pack){
	$this->db->insert('trx_item_transfer_h',$data_pack);
	}

	function insert_item_request_header($data_insert){
	$this->db->insert('trx_item_request_h',$data_insert);
	}
	
	function insert_item_request_detail($data_insert){
	$this->db->insert('trx_item_request_d',$data_insert);
	}
	
	function delete_service_price($id,$data_app){
	$this->db->where('id_price',$id);
	$this->db->update('mst_service_price',$data_app);
	return $this->db->affected_rows();
	}

	function save_po_header($data_pack){
	$this->db->insert('trx_item_po_h',$data_pack);
	}
	
	function save_po_detail($data_pack){
	$this->db->insert('trx_item_po_d',$data_pack);
	}
	
	function save_received_header($data_pack){
	$this->db->insert('trx_item_receive_h',$data_pack);
	}
	
	function save_trx_exchanges_inv_h($data_pack){
	$this->db->insert('trx_exchanges_inv_h',$data_pack);
	}
	
	function save_trx($data_input){
	$this->db->insert('trx_transaction_move',$data_input);
	}

	function save_return_header($data_pack){
	$this->db->insert('trx_item_return_h',$data_pack);
	}

	function save_master_supplier($data_group){
	$this->db->insert('mst_supplier',$data_group);
	}
	
	function save_master_ig($data_group){
	$this->db->insert('mst_item_group',$data_group);
	}
	
	function save_master_item($data_group){
	$this->db->insert('mst_item',$data_group);
	}

	function get_list_coa(){
	$query = $this->db->get('mst_coa');	
	return $query;
	}

	function get_coa($id){
	$this->db->where('order',$id);
	$query = $this->db->get('mst_coa');	
	return $query;
	}
	
	function get_cabang($id){
	$this->db->where('kode_branch',$id);
	$query = $this->db->get('mst_branch');	
	return $query;
	}
	
	function save_mst_coa($data_group){
	$this->db->insert('mst_coa',$data_group);
	}

	function save_sysparam($data_group){
	$this->db->insert('sysparam',$data_group);
	}
		
	function save_master_conversion($data_group){
	$this->db->insert('mst_conversion',$data_group);
	}
		
	function save_master_delivery($data_group){
	$this->db->insert('mst_delivery_address',$data_group);
	}

	function save_master_price($data_group){
	$this->db->insert('mst_item_price',$data_group);
	}

	function save_master_price_temp($data_group){
	$this->db->insert('mst_item_price_temp',$data_group);
	}

	function save_detail_exchanges_inv($data_group){
	$this->db->insert('trx_exchanges_inv_d',$data_group);
	}

	function save_detail_receive($data_group){
	$this->db->insert('trx_item_receive_d',$data_group);
	}

	function get_list_trx_item_po_h(){
	$this->db->order_by('po_date', 'desc'); 
	$query = $this->db->get('trx_item_po_h');	
	return $query;
	}

	function get_list_city(){
	$this->db->order_by('nama_kota', 'asc'); 
	$query = $this->db->get('mst_kota');	
	return $query;
	}
	
	function cekpriceitem($id_item,$price_type){
	$this->db->where('id_item',$id_item);
	$this->db->where('price_type',$price_type);
	$query = $this->db->get('mst_item_price');	
	return $query;
	}
	function cekpriceitem1($id_item){
	$this->db->where('id_item',$id_item);
	$query = $this->db->get('mst_item_price');	
	return $query;
	}

	function cekpriceitem_temp($id_item,$price_type){
	$this->db->where('id_item',$id_item);
	$this->db->where('price_type',$price_type);
	$query = $this->db->get('mst_item_price_temp');	
	return $query;
	}

	function get_mst_currency(){
	$this->db->where('skey',61);
	$this->db->where('sgroup','master_currency');
	$query = $this->db->get('sysparam');	
	return $query;
	}

	function get_master_group_coa(){
	$this->db->where('status',1);
	$this->db->where('sgroup','master_group_coa');
	$query = $this->db->get('sysparam');	
	return $query;
	}

	// function get_max_trx_item_pr_h(){
	// $this->db->select_max('id_pr_no');
	// $query = $this->db->get('trx_item_pr_h');	
	// return $query;
	// }

	function get_max_group_coa(){
	$this->db->where('sgroup','master_group_coa');
	$this->db->select_max('skey');
	$query = $this->db->get('sysparam');	
	return $query;
	}

	function get_max_mst_supplier(){
	$this->db->select_max('id_supplier');
	$query = $this->db->get('mst_supplier');	
	return $query;
	}

	function get_max_trx_item_po_h(){
	$this->db->select_max('id_po');
	$query = $this->db->get('trx_item_po_h');	
	return $query;
	}

	function get_mst_coa(){
	$query = $this->db->query("SELECT A.order, A.id_coa, A.desc1, A.desc2, A.currency, A.type, A.group, A.year, A.is_active, A.created_by, A.created_date, A.updated_by, A.updated_date, B.svalue AS matauang, C.svalue AS tipe FROM `mst_coa` A INNER JOIN ( SELECT * FROM sysparam WHERE sgroup = 'master_currency' ) B ON A.currency = B.skey INNER JOIN ( SELECT * FROM sysparam WHERE sgroup = 'master_group_coa' ) C ON A.type = C.skey WHERE `is_active` = 0 GROUP BY A.order, A.id_coa, A.desc1, A.desc2, A.currency, A.type, A.group, A.year, A.is_active, A.created_by, A.created_date, A.updated_by, A.updated_date");	
	return $query;
	}

	function get_max_item_request_header(){
	$this->db->select_max('id_item_request_h');
	$query = $this->db->get('trx_item_request_h');	
	return $query;
	}

	function get_max_trx_item_transfer_h(){
	$this->db->select_max('id_mi_no');
	$query = $this->db->get('trx_item_transfer_h');	
	return $query;
	}

	function get_warehouse_dep($id){
	$this->db->where('kode_dep', $id);
	$query = $this->db->get('mst_warehouse');	
	return $query;
	}

	function get_eazy(){
	$query = $this->db->get('export_eazy');	
	return $query;
	}

	function get_list_type_range($harga){
	$query = $this->db->query("SELECT mst_item_price_range.`from`, mst_item_price_range.`to`, mst_item_price_range.range_type, mst_item_price_range.percent, mst_item_price_range.`status`, mst_item_price_range.created_by, mst_item_price_range.created_date, mst_item_price_range.updated_by, mst_item_price_range.updated_date FROM `mst_item_price_range` WHERE STATUS = 0 AND $harga BETWEEN `from` AND `to`");
	return $query;
	}


	function get_list_mi($user_id){
	$query = $this->db->query("SELECT is_finalized, id_mi_no, mi_no, nama_dep, mi_date, count(id_item_mi_h) qty, GROUP_CONCAT( '*', item_product, ' (', item_qty, ' ', item_uom, ') ' SEPARATOR ';' ) items, fullname FROM trx_item_transfer_h INNER JOIN trx_item_transfer_d ON trx_item_transfer_d.id_item_mi_h = trx_item_transfer_h.id_mi_no INNER JOIN mst_department ON mst_department.kode_dep = trx_item_transfer_h.from_dept INNER JOIN mst_user ON mst_user.id = trx_item_transfer_h.user_id WHERE user_id ='$user_id'GROUP BY is_finalized, mi_no, nama_dep, mi_date, id_mi_no ORDER BY id_mi_no DESC");
	return $query;
	}
	
	function get_list_pr($id){
	//$query = $this->db->query("SET GLOBAL group_concat_max_len=1000000");
	$query = $this->db->query("SELECT is_finalized, id_pr_no, pr_no, nama_dep, pr_date, fullname, lvalue FROM trx_item_pr_h INNER JOIN mst_department ON mst_department.kode_dep = trx_item_pr_h.dept_id INNER JOIN mst_user ON mst_user.id = trx_item_pr_h.user_id LEFT JOIN ( SELECT id, sgroup, skey, svalue, lvalue, `status`, created_time, created_by, updated_by, remark FROM `sysparam` WHERE sgroup = 'is_finalized' AND remark = 'trx_item_pr_h' ) sysparam ON trx_item_pr_h.is_finalized = sysparam.skey WHERE user_id = '$id' GROUP BY is_finalized, pr_no, nama_dep, pr_date, id_pr_no ORDER BY id_pr_no DESC;");
	return $query;
	}
	
	function get_list_pr_old($id){
	//$query = $this->db->query("SET GLOBAL group_concat_max_len=1000000");
	$query = $this->db->query("SELECT is_finalized, id_pr_no, pr_no, nama_dep, pr_date, count(id_item_pr_h) qty, GROUP_CONCAT( '*', item_product, ' (', item_qty, ' ', item_uom, ') ' SEPARATOR ';' ) items, fullname, lvalue FROM trx_item_pr_h INNER JOIN trx_item_pr_d ON trx_item_pr_d.id_item_pr_h = trx_item_pr_h.id_pr_no INNER JOIN mst_department ON mst_department.kode_dep = trx_item_pr_h.dept_id INNER JOIN mst_user ON mst_user.id = trx_item_pr_h.user_id LEFT JOIN ( SELECT id, sgroup, skey, svalue, lvalue, `status`, created_time, created_by, updated_by, remark FROM `sysparam` WHERE sgroup = 'is_finalized' AND remark = 'trx_item_pr_h' ) sysparam ON trx_item_pr_h.is_finalized = sysparam.skey WHERE user_id='$id' GROUP BY is_finalized, pr_no, nama_dep, pr_date, id_pr_no ORDER BY id_pr_no DESC;");
	return $query;
	}

	function get_list_po($id){
	//$query = $this->db->query("SET GLOBAL group_concat_max_len=1000000");
	$query = $this->db->query("SELECT is_completed,id_po,po_no,po_date,
	GROUP_CONCAT('*',item_name,' (',trx_item_po_d.item_qty,' ',mst_baseunit.baseunit,') ' SEPARATOR ';') items, 
	GROUP_CONCAT('<span style=width:130px class=''label label-inverse''> ',pr_no,'</span>' SEPARATOR ';') pr, 
	COUNT(id_po_header) qty, 
	is_completed status
	FROM trx_item_po_h 
	INNER JOIN trx_item_po_d ON trx_item_po_d.id_po_header = trx_item_po_h.id_po
    INNER JOIN mst_item ON mst_item.id_item = trx_item_po_d.item_id
	INNER JOIN mst_conversion ON mst_conversion.id_conv = trx_item_po_d.item_uom
	INNER JOIN mst_baseunit ON mst_baseunit.id_baseunit = mst_conversion.source_baseunit
	INNER JOIN mst_user ON mst_user.id = trx_item_po_h.user_id
	LEFT JOIN trx_item_pr_h ON trx_item_pr_h.id_pr_no = trx_item_po_d.id_pr_header
	where trx_item_po_h.user_id='$id' and is_completed <>'5'
	GROUP BY po_no,po_date,id_po,is_completed ORDER BY id_po DESC;");
	return $query;
	}
	
	function get_list_po_returnt($id_po){
	$query = $this->db->query("SELECT trx_item_po_d.id_item_po_d,item_name,trx_item_po_d.item_qty qty,mst_baseunit.baseunit AS unit,c.baseunit AS source,
	is_completed,id_po,trx_item_po_h.po_date,trx_item_po_d.item_id, mst_baseunit.id_baseunit id_dest,is_completed STATUS,
	trx_item_po_h.supplier_id,mst_conversion.conv_factor,
	trx_item_receive_d.item_dest AS qty_rev,trx_item_receive_d.item_amount AS amount_rev,trx_item_receive_d.id_detail_rcv
	FROM trx_item_po_h 
	INNER JOIN trx_item_po_d ON trx_item_po_d.id_po_header=trx_item_po_h.id_po 
	INNER JOIN mst_item ON mst_item.id_item=trx_item_po_d.item_id 
	INNER JOIN mst_baseunit c ON c.id_baseunit=mst_item.baseunit 
	INNER JOIN mst_conversion ON mst_conversion.id_conv = trx_item_po_d.item_uom
	INNER JOIN mst_baseunit ON mst_baseunit.id_baseunit = mst_conversion.source_baseunit
	INNER JOIN mst_user ON mst_user.id=trx_item_po_h.user_id 
	LEFT JOIN trx_item_pr_h ON trx_item_pr_h.id_pr_no=trx_item_po_d.id_pr_header
	INNER JOIN mst_supplier ON mst_supplier.id_supplier=trx_item_po_h.supplier_id
	LEFT JOIN trx_item_receive_h ON trx_item_po_h.id_po=trx_item_receive_h.po_id
	LEFT JOIN trx_item_receive_d ON trx_item_receive_h.id_receive_h=trx_item_receive_d.id_receive
	and mst_item.id_item=trx_item_receive_d.item_id AND trx_item_po_d.item_qty=trx_item_receive_d.item_qty
	WHERE id_po='$id_po';");
	return $query;
	}

	function get_list_po_returnt_update($id_po){
	$query = $this->db->query("SELECT trx_item_po_d.id_item_po_d,item_name,trx_item_po_d.item_qty qty,mst_baseunit.baseunit AS unit,c.baseunit AS source,id_po,trx_item_po_h.po_date,trx_item_po_d.item_id,mst_baseunit.id_baseunit id_dest,trx_item_po_h.supplier_id,mst_conversion.conv_factor,trx_item_receive_d.item_dest AS qty_rev,trx_item_po_d.item_qty,trx_item_return_d.item_qty,trx_item_receive_d.item_amount AS amount_rev,trx_item_receive_d.id_detail_rcv,trx_item_return_h.id_retur,trx_item_return_h.return_remarks,trx_item_return_d.id_return_d,trx_item_return_d.return_date
		FROM trx_item_po_h
		INNER JOIN trx_item_po_d ON trx_item_po_d.id_po_header = trx_item_po_h.id_po
		INNER JOIN mst_item ON mst_item.id_item = trx_item_po_d.item_id
		INNER JOIN mst_baseunit c ON c.id_baseunit = mst_item.baseunit
		INNER JOIN mst_conversion ON mst_conversion.id_conv = trx_item_po_d.item_uom
		INNER JOIN mst_baseunit ON mst_baseunit.id_baseunit = mst_conversion.source_baseunit
		INNER JOIN mst_user ON mst_user.id = trx_item_po_h.user_id
		LEFT JOIN trx_item_pr_h ON trx_item_pr_h.id_pr_no = trx_item_po_d.id_pr_header
		INNER JOIN mst_supplier ON mst_supplier.id_supplier = trx_item_po_h.supplier_id
		LEFT JOIN trx_item_receive_h ON trx_item_po_h.id_po = trx_item_receive_h.po_id
		LEFT JOIN trx_item_receive_d ON trx_item_receive_h.id_receive_h = trx_item_receive_d.id_receive AND mst_item.id_item = trx_item_receive_d.item_id 
		LEFT JOIN trx_item_return_h ON trx_item_po_h.id_po=trx_item_return_h.po_id
		LEFT JOIN trx_item_return_d ON trx_item_return_h.id_retur=trx_item_return_d.id_return_h
		AND mst_item.id_item = trx_item_return_d.item_id
		WHERE id_po='$id_po'
		GROUP BY trx_item_return_d.id_return_d;");
	return $query;
	}
	
	function get_list_received($id){
	//$query = $this->db->query("SET GLOBAL group_concat_max_len=1000000");
	$query = $this->db->query("SELECT item_name,is_completed,id_po,po_no,po_date,
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
	where is_completed not in ('2','5') and archive=0
	GROUP BY po_no ORDER BY id_po DESC;");
	return $query;
	}
	
	// Untuk return, add by rangga 17 Feb 2016
	function get_list_returnt($id){	
	$query = $this->db->query("SELECT item_name,trx_item_po_h.is_completed,id_po,po_no,po_date, 
		GROUP_CONCAT('*',item_name,' (',trx_item_po_d.item_qty,' ',mst_baseunit.baseunit,') ' SEPARATOR ';') items, 
		supp_name supplier, 
		COUNT(id_po_header) qty, trx_item_po_h.is_completed status, trx_item_return_h.id_retur,
		XX.lvalue as stsvalue, YY.lvalue as ststrvalue,
		case when ISNULL(trx_item_return_h.is_completed) then 0 
			else trx_item_return_h.is_completed END as sts_rt,
		trx_item_return_h.archive
		FROM trx_item_po_h 
		INNER JOIN trx_item_po_d ON trx_item_po_d.id_po_header=trx_item_po_h.id_po 
		INNER JOIN mst_item ON mst_item.id_item=trx_item_po_d.item_id 
		INNER JOIN mst_conversion ON mst_conversion.id_conv = trx_item_po_d.item_uom
		INNER JOIN mst_baseunit ON mst_baseunit.id_baseunit = mst_conversion.source_baseunit     
		INNER JOIN mst_user ON mst_user.id=trx_item_po_h.user_id 
		LEFT JOIN trx_item_pr_h ON trx_item_pr_h.id_pr_no=trx_item_po_d.id_pr_header 
		INNER JOIN mst_supplier ON mst_supplier.id_supplier=trx_item_po_h.supplier_id 
		LEFT JOIN (SELECT * FROM sysparam WHERE sgroup='status') XX ON trx_item_po_h.is_completed=XX.skey 
		LEFT JOIN trx_item_return_h ON trx_item_return_h.po_id=trx_item_po_h.id_po 
		LEFT JOIN (SELECT * FROM sysparam WHERE sgroup='status_rt') YY ON trx_item_return_h.is_completed=YY.skey 
		where trx_item_po_h.is_completed not in ('2','4','1') 
		GROUP BY po_no ORDER BY id_po DESC;");
	return $query;
	}
		// where trx_item_po_h.user_id='$id' and trx_item_po_h.is_completed not in ('2','4','1') 
	
	
	function get_list_received_detail($id){
	//$query = $this->db->query("SET GLOBAL group_concat_max_len=1000000");
	$query = $this->db->query("SELECT id_item_po_d,item_name,trx_item_po_d.item_qty qty,mst_baseunit.baseunit AS unit,c.baseunit AS source,is_completed,id_po,po_date,item_id, mst_baseunit.id_baseunit id_dest,is_completed STATUS,trx_item_po_h.supplier_id, supp_name, mst_conversion.conv_factor,trx_item_po_d.item_price,trx_item_po_d.item_disc_am / trx_item_po_d.item_qty as item_disc
	FROM trx_item_po_h 
	INNER JOIN trx_item_po_d ON trx_item_po_d.id_po_header=trx_item_po_h.id_po 
	INNER JOIN mst_item ON mst_item.id_item=trx_item_po_d.item_id 
	INNER JOIN mst_baseunit c ON c.id_baseunit=mst_item.baseunit 
	INNER JOIN mst_conversion ON mst_conversion.id_conv = trx_item_po_d.item_uom
	INNER JOIN mst_baseunit ON mst_baseunit.id_baseunit = mst_conversion.source_baseunit
	INNER JOIN mst_user ON mst_user.id=trx_item_po_h.user_id 
	LEFT JOIN trx_item_pr_h ON trx_item_pr_h.id_pr_no=trx_item_po_d.id_pr_header
	INNER JOIN mst_supplier ON mst_supplier.id_supplier=trx_item_po_h.supplier_id
	WHERE is_completed ='0' and id_po='$id'
	GROUP BY id_item_po_d ORDER BY id_po DESC");
	return $query;
	}
	
	function get_list_received_update($id){
	//$query = $this->db->query("SET GLOBAL group_concat_max_len=1000000");
	$query = $this->db->query("SELECT trx_item_receive_d.id_detail_rcv,id_receive_h,
	trx_item_receive_d.receive_fisik,
	trx_item_receive_d.receive_expired,
	trx_item_receive_d.receive_dosis,
	trx_item_receive_d.receive_suhu,
	id_item_po_d,trx_item_receive_d.item_source source,trx_item_receive_d.item_dest dest,
	item_name,
	trx_item_receive_d.item_qty qty_po,
	trx_item_receive_d.item_dest qty_receive,
	mst_baseunit.baseunit AS base_po,trx_item_receive_d.item_amount,
	c.baseunit AS base_source,
	is_completed,
	id_po,trx_item_receive_d.batch_code,trx_item_receive_d.batch_date,trx_item_receive_d.expired_date,
	trx_item_po_h.po_date,trx_item_po_d.item_id,
	mst_baseunit.id_baseunit id_dest,
	is_completed STATUS,trx_item_po_h.supplier_id, supp_name,trx_item_receive_d.item_qty - trx_item_receive_d.item_dest as sisa,
	trx_item_po_d.item_price, trx_item_po_d.item_disc_am / trx_item_po_d.item_qty AS item_disc
	FROM trx_item_po_h 
	LEFT JOIN trx_item_po_d ON trx_item_po_d.id_po_header=trx_item_po_h.id_po 
	LEFT JOIN mst_item ON mst_item.id_item=trx_item_po_d.item_id 
	LEFT JOIN mst_baseunit c ON c.id_baseunit=mst_item.baseunit 
	LEFT JOIN mst_conversion ON mst_conversion.id_conv = trx_item_po_d.item_uom
	LEFT JOIN mst_baseunit ON mst_baseunit.id_baseunit = mst_conversion.source_baseunit
	LEFT JOIN mst_user ON mst_user.id=trx_item_po_h.user_id 
	LEFT JOIN trx_item_pr_h ON trx_item_pr_h.id_pr_no=trx_item_po_d.id_pr_header
	LEFT JOIN mst_supplier ON mst_supplier.id_supplier=trx_item_po_h.supplier_id
	LEFT JOIN trx_item_receive_h ON trx_item_receive_h.po_id=trx_item_po_h.id_po
	LEFT JOIN trx_item_receive_d ON trx_item_receive_d.id_receive=trx_item_receive_h.id_receive_h
	LEFT JOIN trx_item_receive_d g ON trx_item_receive_d.item_id=mst_item.id_item
	WHERE is_completed ='3' and id_po='$id' AND trx_item_receive_d.item_dest < trx_item_receive_d.item_qty
	GROUP BY trx_item_receive_d.id_detail_rcv
	ORDER BY id_po DESC");
	return $query;
	}
	
	function received_update_mst_item(){
	$query = $this->db->query("UPDATE mst_item A
			INNER JOIN trx_item_receive_d B ON B.item_id=A.id_item
			INNER JOIN trx_item_receive_h C ON C.id_receive_h=B.id_receive
			INNER JOIN trx_item_po_h D ON C.po_id=D.id_po
			SET A.item_curr_qty=B.item_amount+A.item_curr_qty
			WHERE D.is_completed=4;
	");
	return $query;
	}

	// syscrone tabel trx_item_wh pada table mst_item
	function sys_master_item(){ 
	$query = $this->db->query("UPDATE trx_item_wh A INNER join mst_item B ON A.id_item = B.id_item AND A.id_warehouse=B.warehouse_id SET B.item_curr_qty = A.stock;");
	return $query;
	}

	/** syscrone tabel mst_item pada table trx_item_wh **/

	function sys_item_to_wh(){
	$query = $this->db->query("INSERT INTO trx_item_wh (id_item,id_warehouse,stock) SELECT mst_item.id_item, mst_item.warehouse_id, mst_item.item_curr_qty FROM mst_item LEFT JOIN trx_item_wh ON mst_item.id_item = trx_item_wh.id_item WHERE trx_item_wh.id_item IS NULL AND is_active=0");
	return $query;
	}
	
	function sys_gudang(){
	$query = $this->db->query("INSERT INTO trx_item_wh (id_warehouse) SELECT mst_warehouse.id_warehouse FROM mst_warehouse LEFT JOIN trx_item_wh ON mst_warehouse.id_warehouse = trx_item_wh.id_warehouse WHERE trx_item_wh.id_warehouse IS NULL;");
	return $query;
	}

	function sys_transfer_item(){ 
	$query = $this->db->query("UPDATE trx_item_wh A INNER join mst_item B ON A.id_item = B.id_item AND A.id_warehouse=B.warehouse_id SET A.stock = B.item_curr_qty;");
	return $query;
	}
	
	/** syscrone tabel mst_item pada table trx_item_wh **/
	

	function sys_item_min_stock(){
	$query = $this->db->query("UPDATE trx_item_wh INNER JOIN mst_warehouse ON trx_item_wh.id_warehouse = mst_warehouse.id_warehouse INNER JOIN mst_item ON trx_item_wh.id_item = mst_item.id_item INNER JOIN mst_item_group ON mst_item_group.id_item_group = mst_item.item_group INNER JOIN mst_baseunit ON mst_baseunit.id_baseunit = mst_item.baseunit LEFT JOIN mst_minmax ON trx_item_wh.id_item=mst_minmax.item_id AND trx_item_wh.id_warehouse=mst_minmax.id_warehouse SET mst_minmax.flag=1 WHERE mst_warehouse.status = 0 AND trx_item_wh.stock < min_qty AND trx_item_wh.stock > 0;");
	return $query;
	}

	function sys_item_minus_stock(){
	$query = $this->db->query("UPDATE trx_item_wh INNER JOIN mst_warehouse ON trx_item_wh.id_warehouse = mst_warehouse.id_warehouse INNER JOIN mst_item ON trx_item_wh.id_item = mst_item.id_item INNER JOIN mst_item_group ON mst_item_group.id_item_group = mst_item.item_group INNER JOIN mst_baseunit ON mst_baseunit.id_baseunit = mst_item.baseunit LEFT JOIN mst_minmax ON trx_item_wh.id_item=mst_minmax.item_id AND trx_item_wh.id_warehouse=mst_minmax.id_warehouse SET mst_minmax.flag=2 WHERE mst_warehouse.status = 0 AND trx_item_wh.stock < min_qty AND trx_item_wh.stock < 0;");
	return $query;
	}

	function sys_item_max_stock(){
	$query = $this->db->query("UPDATE trx_item_wh INNER JOIN mst_warehouse ON trx_item_wh.id_warehouse = mst_warehouse.id_warehouse INNER JOIN mst_item ON trx_item_wh.id_item = mst_item.id_item INNER JOIN mst_item_group ON mst_item_group.id_item_group = mst_item.item_group INNER JOIN mst_baseunit ON mst_baseunit.id_baseunit = mst_item.baseunit LEFT JOIN mst_minmax ON trx_item_wh.id_item=mst_minmax.item_id AND trx_item_wh.id_warehouse=mst_minmax.id_warehouse SET mst_minmax.flag=1 WHERE mst_warehouse.status = 0 AND trx_item_wh.stock < mst_minmax.max_qty;");
	return $query;
	}
	
	function hapus_eazy(){
	$query = $this->db->query("TRUNCATE TABLE export_eazy");
	return $query;
	}

	function masuk_data_eazy(){
	$query = $this->db->query("INSERT INTO export_eazy ( NoBarang, Deskripsi, Deskripsi2, IndukBarang, qty, gudang, gdasli, pajak, Unit1, Unit2, Unit3, Ratio2, Ratio3, base, normal, insurance, company, usd, uharga5, tglsaldoawal, periode, tahun, persediaan, hpp, returpembelian, penjualan, returpenjualan, penerimaanbelumtertagih, barangterkirim, tipebarang, tipepersediaan ) SELECT mst_item.id_item, mst_item.item_name, mst_item.item_name AS NAMA2, mst_item_group.item_group, trx_item_wh.stock, x.warehouse_name, mst_warehouse.warehouse_name, 'P' AS pajak, mst_baseunit.baseunit, '' AS unit2, '' AS unit3, '' AS ratio2, '' AS ratio3, IFNULL(a.Price, 0) AS base, IFNULL(b.Price, 0) AS normal, IFNULL(c.Price, 0) AS insurance, IFNULL(d.Price, 0) AS company, IFNULL(e.Price, 0) AS usd, '0' AS uharga5, mst_item.create_date, '0' AS periode, YEAR (mst_item.create_date), '' AS persedian, '' AS hpp, '' AS returpembelian, '' AS penjualan, '' AS returpenjualan, '' AS penerimaanbelumtertagih, '' AS barangterkirim, '' AS tipebarang, '' AS tipepersediaan FROM mst_item INNER JOIN mst_item_group ON mst_item_group.id_item_group = mst_item.item_group LEFT JOIN mst_supplier ON mst_supplier.id_supplier = mst_item.supplier_id LEFT JOIN mst_warehouse ON mst_warehouse.id_warehouse = mst_item.warehouse_id LEFT JOIN mst_baseunit ON mst_baseunit.id_baseunit = mst_item.baseunit LEFT JOIN trx_item_wh ON mst_item.id_item = trx_item_wh.id_item LEFT JOIN mst_warehouse x ON x.id_warehouse = trx_item_wh.id_warehouse LEFT JOIN ( SELECT mst_price_type.price_type AS jenis_bayar, mst_item_price.id_price, mst_item_price.id_item, mst_item_price.id_branch, mst_item_price.price_type, mst_item_price.Currency, mst_item_price.Price, mst_item_price.create_by, mst_item_price.create_date, mst_item_price.update_by, mst_item_price.update_date, mst_item_price.`status` FROM mst_item_price INNER JOIN mst_price_type ON mst_item_price.price_type = mst_price_type.id_price_type WHERE mst_item_price.price_type = 1 ) a ON mst_item.id_item = a.id_item LEFT JOIN ( SELECT mst_price_type.price_type AS jenis_bayar, mst_item_price.id_price, mst_item_price.id_item, mst_item_price.id_branch, mst_item_price.price_type, mst_item_price.Currency, mst_item_price.Price, mst_item_price.create_by, mst_item_price.create_date, mst_item_price.update_by, mst_item_price.update_date, mst_item_price.`status` FROM mst_item_price INNER JOIN mst_price_type ON mst_item_price.price_type = mst_price_type.id_price_type WHERE mst_item_price.price_type = 2 ) b ON mst_item.id_item = b.id_item LEFT JOIN ( SELECT mst_price_type.price_type AS jenis_bayar, mst_item_price.id_price, mst_item_price.id_item, mst_item_price.id_branch, mst_item_price.price_type, mst_item_price.Currency, mst_item_price.Price, mst_item_price.create_by, mst_item_price.create_date, mst_item_price.update_by, mst_item_price.update_date, mst_item_price.`status` FROM mst_item_price INNER JOIN mst_price_type ON mst_item_price.price_type = mst_price_type.id_price_type WHERE mst_item_price.price_type = 3 ) c ON mst_item.id_item = c.id_item LEFT JOIN ( SELECT mst_price_type.price_type AS jenis_bayar, mst_item_price.id_price, mst_item_price.id_item, mst_item_price.id_branch, mst_item_price.price_type, mst_item_price.Currency, mst_item_price.Price, mst_item_price.create_by, mst_item_price.create_date, mst_item_price.update_by, mst_item_price.update_date, mst_item_price.`status` FROM mst_item_price INNER JOIN mst_price_type ON mst_item_price.price_type = mst_price_type.id_price_type WHERE mst_item_price.price_type = 5 ) d ON mst_item.id_item = d.id_item LEFT JOIN ( SELECT mst_price_type.price_type AS jenis_bayar, mst_item_price.id_price, mst_item_price.id_item, mst_item_price.id_branch, mst_item_price.price_type, mst_item_price.Currency, mst_item_price.Price, mst_item_price.create_by, mst_item_price.create_date, mst_item_price.update_by, mst_item_price.update_date, mst_item_price.`status` FROM mst_item_price INNER JOIN mst_price_type ON mst_item_price.price_type = mst_price_type.id_price_type WHERE mst_item_price.price_type = 6 ) e ON mst_item.id_item = e.id_item WHERE mst_item.is_active = 0 ORDER BY mst_item.id_item");
	return $query;
	}


	// Simpan data mst_warehouse
	function save_master_trx_item_wh($data_group){
	$this->db->insert('trx_item_wh',$data_group);
	}

	// Simpan data mst_warehouse
	function save_master_warehouse($data_group){
	$this->db->insert('mst_warehouse',$data_group);
	}

	function update_trx_item_wh($id_item,$warehouse_id,$data_app){
	$this->db->where('id_item',$id_item);
	$this->db->where('id_warehouse',$warehouse_id);
	$this->db->update('trx_item_wh',$data_app);
	return $this->db->affected_rows();
	}

	function update_trx_item_wh3($id_item,$warehouse_id,$data_app,$tambah){
	$this->db->where('id_item',$id_item);
	$this->db->where('id_warehouse',$warehouse_id);
	$this->db->set('stock', 'stock + '.$tambah, FALSE);
	$this->db->update('trx_item_wh',$data_app);
	return $this->db->affected_rows();
	}

	function update_trx_item_wh2($id,$data_app){
	$this->db->where('id',$id);
	$this->db->update('trx_item_wh',$data_app);
	return $this->db->affected_rows();
	}

	function get_list_app_mi($id){
	$query = $this->db->query("SELECT id_mi_no, mi_no, nama_dep, mi_date, count(id_item_mi_h) qty, GROUP_CONCAT( '*', item_product, ' (', item_qty, ' ', item_uom, ') ' SEPARATOR ';' ) items, fullname FROM trx_item_transfer_h INNER JOIN trx_item_transfer_d ON trx_item_transfer_d.id_item_mi_h = trx_item_transfer_h.id_mi_no INNER JOIN mst_department ON mst_department.kode_dep = trx_item_transfer_h.from_dept INNER JOIN mst_user ON mst_user.id = trx_item_transfer_h.user_id WHERE from_dept = '$id' AND is_finalized = '0' GROUP BY mi_no, nama_dep, mi_date, id_mi_no, fullname ORDER BY id_mi_no DESC;");
	return $query;
	}
	
	function get_list_app_pr($id){
	//$query = $this->db->query("SET GLOBAL group_concat_max_len=1000000");
	$query = $this->db->query("SELECT id_pr_no,pr_no,nama_dep,pr_date,count(id_item_pr_h) qty,GROUP_CONCAT('*',item_product,' (',item_qty,' ',item_uom,') ' SEPARATOR ';') items, fullname, trx_item_pr_h.is_finalized, svalue, lvalue  FROM trx_item_pr_h inner join trx_item_pr_d on trx_item_pr_d.id_item_pr_h=trx_item_pr_h.id_pr_no inner join mst_department on mst_department.kode_dep=trx_item_pr_h.dept_id inner join mst_user on mst_user.id=trx_item_pr_h.user_id LEFT JOIN ( SELECT id, sgroup, skey, svalue, lvalue, `status`, created_time, created_by, updated_by, remark FROM `sysparam` WHERE sgroup = 'is_finalized' AND remark = 'trx_item_pr_h' ) sysparam ON trx_item_pr_h.is_finalized = sysparam.skey where dept_id='$id' and is_finalized != '6' group by  pr_no,nama_dep,pr_date,id_pr_no,fullname order by id_pr_no desc;");
	return $query;
	}
	
	function get_list_app_pr_all(){
	//$query = $this->db->query("SET GLOBAL group_concat_max_len=1000000");
	$query = $this->db->query("SELECT id_pr_no,pr_no,nama_dep,pr_date,count(id_item_pr_h) qty,GROUP_CONCAT('*',item_product,' (',item_qty,' ',item_uom,') ' SEPARATOR ';') items, fullname, trx_item_pr_h.is_finalized, svalue, lvalue  FROM trx_item_pr_h inner join trx_item_pr_d on trx_item_pr_d.id_item_pr_h=trx_item_pr_h.id_pr_no inner join mst_department on mst_department.kode_dep=trx_item_pr_h.dept_id inner join mst_user on mst_user.id=trx_item_pr_h.user_id LEFT JOIN ( SELECT id, sgroup, skey, svalue, lvalue, `status`, created_time, created_by, updated_by, remark FROM `sysparam` WHERE sgroup = 'is_finalized' AND remark = 'trx_item_pr_h' ) sysparam ON trx_item_pr_h.is_finalized = sysparam.skey where is_finalized != '6' group by  pr_no,nama_dep,pr_date,id_pr_no,fullname order by id_pr_no desc;");
	return $query;
	}
	
	function get_list_pr_pur(){
	$query = $this->db->query("SELECT id_pr_no,pr_no,nama_dep,pr_date,count(id_item_pr_h) qty,GROUP_CONCAT('*',item_product,' (',vestige,' ',item_uom,') ' SEPARATOR ';') items, fullname, trx_item_pr_h.is_finalized, svalue, lvalue  FROM trx_item_pr_h inner join trx_item_pr_d on trx_item_pr_d.id_item_pr_h=trx_item_pr_h.id_pr_no inner join mst_department on mst_department.kode_dep=trx_item_pr_h.dept_id inner join mst_user on mst_user.id=trx_item_pr_h.user_id LEFT JOIN ( SELECT id, sgroup, skey, svalue, lvalue, `status`, created_time, created_by, updated_by, remark FROM `sysparam` WHERE sgroup = 'is_finalized' AND remark = 'trx_item_pr_h' ) sysparam ON trx_item_pr_h.is_finalized = sysparam.skey where is_finalized IN (0,5)	 group by  pr_no,nama_dep,pr_date,id_pr_no,fullname order by id_pr_no desc;");
	return $query;
	}
	
	function get_list_app_po($id){
	//$query = $this->db->query("SET GLOBAL group_concat_max_len=1000000");
	$query = $this->db->query("SELECT id_po,po_no,po_date,COUNT(id_po_header) qty,
	GROUP_CONCAT('*',item_name,' (',trx_item_po_d.item_qty,' ',mst_baseunit.baseunit,') ' SEPARATOR ';') items,fullname,
	GROUP_CONCAT('<span style=''width:130px;'' class=''label label-inverse''> ',pr_no,'</span>' SEPARATOR ';') pr 
	FROM trx_item_po_h 
	INNER JOIN trx_item_po_d ON trx_item_po_d.id_po_header=trx_item_po_h.id_po 
	INNER JOIN mst_item ON mst_item.id_item=trx_item_po_d.item_id 
	INNER JOIN mst_conversion ON mst_conversion.id_conv = trx_item_po_d.item_uom
	INNER JOIN mst_baseunit ON mst_baseunit.id_baseunit = mst_conversion.source_baseunit
	INNER JOIN mst_user ON mst_user.id=trx_item_po_h.user_id 
	LEFT JOIN trx_item_pr_h ON trx_item_pr_h.id_pr_no=trx_item_po_d.id_pr_header
	WHERE is_completed='1'
	GROUP BY  po_no,po_date,id_po,fullname ORDER BY id_po DESC");
	return $query;
	}
	
	function get_list_all_it(){
	$query = $this->db->query("SELECT * FROM ( SELECT DISTINCT a.id_lab_item AS id, 'Lab Exam' AS type_name, b.group_name AS item_group, serv_name AS item_name FROM mst_lab_item a LEFT JOIN mst_lab_group b ON a.lab_item_group = b.id_lab_item_group LEFT JOIN ( SELECT * FROM mst_services WHERE order_type = 1 ) c ON a.id_lab_item = c.order_id UNION ALL SELECT DISTINCT a.id_rad_item, 'Radiology Exam' AS type_name, b.group_desc, c.serv_name FROM mst_rad_item a LEFT JOIN mst_rad_group b ON a.rad_item_group = b.id_rad_group LEFT JOIN ( SELECT * FROM mst_services WHERE order_type = 2 ) c ON a.id_rad_item = c.order_id UNION ALL SELECT a.id_service, d.group_desc AS type_name, d.group_desc, serv_name FROM mst_services a LEFT JOIN mst_service_price b ON a.id_service = b.id_service LEFT JOIN mst_price_type c ON b.price_type = c.id_price_type LEFT JOIN mst_service_group d ON a.id_group_serv = d.id_serv_group WHERE order_type NOT IN (1, 2)) xyz;");
	return $query;
	}
	
	function get_list_all_it_OLD(){
	$query = $this->db->query("select ifnull(C.serv_name,service_other) item_name,D.group_desc AS item_group
			from mkt_quotation_h A
			left join mkt_quotation_d B on A.id_quot=B.id_quot_header
			left join mst_services C on B.service_id=C.id_service
			left join mst_service_group D on B.group_service=D.id_serv_group
			order by group_seq_no asc;");
	return $query;
	}
	
	function get_hitory_item_po($id_item){
	$this->db->select('trx_item_po_d.id_item_po_d, trx_item_po_d.id_po_header, trx_item_po_d.id_pr_header, trx_item_po_d.item_id, trx_item_po_d.item_qty, trx_item_po_d.item_uom, trx_item_po_d.item_price, trx_item_po_d.item_disc_am, trx_item_po_d.item_disc, trx_item_po_d.item_amount, trx_item_po_h.id_po, trx_item_po_h.po_no, trx_item_po_h.po_date, trx_item_po_h.delivery_date, trx_item_po_h.supplier_id, mst_supplier.supp_name, trx_item_po_h.address_id, trx_item_po_h.term_payment, trx_item_po_h.due_date, trx_item_po_h.user_id, trx_item_po_h.app_id, trx_item_po_h.is_completed, trx_item_po_h.total_amount, trx_item_po_h.ppn_amount, trx_item_po_h.grand_amount, trx_item_po_h.archive, trx_item_po_h.created_date, trx_item_receive_h.id_receive_h, trx_item_receive_h.receive_no, trx_item_receive_h.receive_date, trx_item_receive_h.is_partial');
	$this->db->from('mst_item');
	$this->db->join('trx_item_po_d', 'mst_item.id_item=trx_item_po_d.item_id', 'inner');
	$this->db->join('trx_item_po_h', 'trx_item_po_d.id_po_header=trx_item_po_h.id_po', 'inner');
	$this->db->join('trx_item_receive_h', 'trx_item_receive_h.po_id=trx_item_po_h.id_po', 'inner');
	// $this->db->join('trx_item_receive_d', 'trx_item_receive_d.id_receive=trx_item_receive_h.id_receive_h and trx_item_receive_d.item_id=mst_item.id_item', 'inner');
	$this->db->join('mst_supplier', 'mst_supplier.id_supplier=trx_item_po_h.supplier_id', 'inner');
	$this->db->where('mst_item.id_item', $id_item);
	$this->db->where('mst_item.is_active', 0);
	$query = $this->db->get();
	return $query;
	}
	
	function get_list_it(){
	$this->db->select('mst_item_group.item_group, item_name, supp_name, warehouse_name, batch_code, item_curr_qty, mst_baseunit.baseunit, mst_item.id_item, id_baseunit');
	$this->db->from('mst_item');
	$this->db->join('mst_item_group', 'mst_item_group.id_item_group = mst_item.item_group', 'left');
	$this->db->join('mst_supplier', 'mst_supplier.id_supplier = mst_item.supplier_id', 'left');
	$this->db->join('mst_warehouse', 'mst_warehouse.id_warehouse = mst_item.warehouse_id', 'left');
	$this->db->join('mst_baseunit', 'mst_baseunit.id_baseunit = mst_item.baseunit', 'left');
	$this->db->where('mst_item.is_active', 0);
	$query = $this->db->get();
	return $query;
	}
	
	function get_list_item_request(){
	$this->db->select('mst_item_group.item_group, item_name, supp_name, warehouse_name, batch_code, item_curr_qty, mst_baseunit.baseunit, mst_item.id_item, id_baseunit, mst_user.fullname, mst_item.create_date');
	$this->db->from('mst_item');
	$this->db->join('mst_item_group', 'mst_item_group.id_item_group = mst_item.item_group', 'left');
	$this->db->join('mst_supplier', 'mst_supplier.id_supplier = mst_item.supplier_id', 'left');
	$this->db->join('mst_warehouse', 'mst_warehouse.id_warehouse = mst_item.warehouse_id', 'left');
	$this->db->join('mst_baseunit', 'mst_baseunit.id_baseunit = mst_item.baseunit', 'left');
	$this->db->join('mst_user', 'mst_item.created_by = mst_user.id', 'left');
	$this->db->where('mst_item.is_active', 2);
	$query = $this->db->get();
	return $query;
	}
	
	function get_list_it_by_id($id_item){
	$this->db->select('mst_item_group.item_group, item_name, supp_name, warehouse_name, batch_code, item_curr_qty, mst_baseunit.baseunit, mst_item.id_item, id_baseunit, mst_item_group.id_item_group,mst_item.batch_code, mst_item.batch_date, mst_item.item_qty, mst_item.item_curr_qty, mst_item.baseunit, mst_item.supplier_id, mst_item.warehouse_id, mst_item.item_remarks, mst_item.coa, mst_item.is_active, mst_item.expired_date, mst_item.item_curr_qty');
	$this->db->from('mst_item');
	$this->db->join('mst_item_group', 'mst_item_group.id_item_group = mst_item.item_group', 'left');
	$this->db->join('mst_supplier', 'mst_supplier.id_supplier = mst_item.supplier_id', 'left');
	$this->db->join('mst_warehouse', 'mst_warehouse.id_warehouse = mst_item.warehouse_id', 'left');
	$this->db->join('mst_baseunit', 'mst_baseunit.id_baseunit = mst_item.baseunit', 'left');
	$this->db->where('mst_item.id_item', $id_item);
	$query = $this->db->get();
	return $query;
	}
	
	function get_list_it_price(){
	$this->db->select('id_price,mst_item.item_name, mst_item_price.Currency, mst_item_price.Price, mst_item_price.`status`, mst_branch.nama_branch, mst_branch.alamat_branch, mst_item_price.create_date, mst_item_price.create_by, mst_price_type.price_type, mst_item_price.code_item');
	$this->db->from('mst_item_price');
	$this->db->join('mst_item', 'mst_item_price.id_item = mst_item.id_item', 'inner');
	$this->db->join('mst_branch', 'mst_item_price.id_branch = mst_branch.kode_branch', 'inner');
	$this->db->join('mst_price_type', 'mst_item_price.price_type = mst_price_type.id_price_type', 'inner');
	$this->db->where('mst_item.is_active', 0);
	$this->db->where('mst_item_price.status', 0);
	$query = $this->db->get();
	return $query;
	}

	function get_list_it_price_id($id_price){
	$this->db->select('id_price,mst_item.item_name, mst_item_price.Currency, mst_item_price.Price, mst_item_price.`status`, mst_branch.nama_branch, mst_branch.alamat_branch, mst_item_price.create_date, mst_item_price.create_by, mst_price_type.price_type,mst_price_type.id_price_type,mst_item.id_item,mst_item_price.code_item');
	$this->db->from('mst_item_price');
	$this->db->join('mst_item', 'mst_item_price.id_item = mst_item.id_item', 'inner');
	$this->db->join('mst_branch', 'mst_item_price.id_branch = mst_branch.kode_branch', 'inner');
	$this->db->join('mst_price_type', 'mst_item_price.price_type = mst_price_type.id_price_type', 'inner');
	$this->db->where('mst_item.is_active', 0);
	$this->db->where('mst_item_price.status', 0);
	$this->db->where('mst_item_price.id_price', $id_price);
	$query = $this->db->get();
	return $query;
	}

	function get_list_it_transfer($id_item){
	$this->db->select('trx_item_wh.id_item,mst_item_group.item_group,mst_item.item_name,mst_warehouse.id_warehouse, mst_warehouse.warehouse_name,trx_item_wh.id_item,trx_item_wh.stock,mst_baseunit.baseunit');
	$this->db->from('trx_item_wh');
	$this->db->join('mst_warehouse', 'trx_item_wh.id_warehouse=mst_warehouse.id_warehouse', 'inner');
	$this->db->join('mst_item', 'trx_item_wh.id_item=mst_item.id_item', 'inner');
	$this->db->join('mst_item_group', 'mst_item_group.id_item_group = mst_item.item_group', 'inner');
	$this->db->join('mst_baseunit', 'mst_baseunit.id_baseunit = mst_item.baseunit', 'inner');
	$this->db->where('trx_item_wh.id_item', $id_item);
	$this->db->where('mst_warehouse.status', 0);
	$query = $this->db->get();
	return $query;
	}

	function get_list_all_item_transfer(){
	$query = $this->db->query("SELECT mst_item.id_item,mst_item.item_name,mst_baseunit.baseunit,sum(ifnull(mst_item.item_curr_qty,0))+sum(ifnull(trx_item_wh.stock,0)) as jumlah FROM mst_item left join trx_item_wh ON mst_item.id_item = trx_item_wh.id_item left join mst_baseunit ON mst_baseunit.id_baseunit = mst_item.baseunit GROUP BY mst_item.id_item,mst_item.item_name,mst_baseunit.baseunit;");
	return $query;
	}

	function select_transfer_item(){
	$query = $this->db->query("SELECT trx_item_wh.id_item, item_name, mst_baseunit.baseunit, sum(trx_item_wh.stock) AS jumlah FROM trx_item_wh INNER JOIN mst_warehouse ON trx_item_wh.id_warehouse = mst_warehouse.id_warehouse INNER JOIN mst_item ON mst_item.id_item = trx_item_wh.id_item LEFT JOIN mst_baseunit ON mst_baseunit.id_baseunit = mst_item.baseunit WHERE mst_warehouse.`status` = 0 GROUP BY trx_item_wh.id_item, item_name, mst_baseunit.baseunit;");
	return $query;
	}

	function get_warehouse_stock($id_item){
	$query = $this->db->query("SELECT  mst_warehouse.id_warehouse, mst_warehouse.warehouse_name,trx_item_wh.id_item, sum(trx_item_wh.stock) as jumlah 
			FROM trx_item_wh 
			INNER JOIN mst_warehouse ON trx_item_wh.id_warehouse=mst_warehouse.id_warehouse 
			WHERE mst_warehouse.status=0 and trx_item_wh.id_item=$id_item
			GROUP BY mst_warehouse.id_warehouse,mst_warehouse.warehouse_name;");
	return $query;
	}

	function get_find_item(){
	$this->db->select('mst_item_group.item_group,item_name,supp_name,warehouse_name,item_curr_qty,mst_baseunit.baseunit,item_remarks,mst_item.id_item,id_baseunit');
	$this->db->from('mst_item');
	$this->db->join('mst_item_group', 'mst_item_group.id_item_group = mst_item.item_group', 'left');
	$this->db->join('mst_supplier', 'mst_supplier.id_supplier = mst_item.supplier_id', 'left');
	$this->db->join('mst_warehouse', 'mst_warehouse.id_warehouse = mst_item.warehouse_id', 'left');
	$this->db->join('mst_baseunit', 'mst_baseunit.id_baseunit = mst_item.baseunit', 'left');
	$this->db->where('mst_item.is_active', 0);
	$this->db->order_by("item_name", "asc");
	$query = $this->db->get();
	return $query;
	}

	function get_find_item_for_pr(){
	$this->db->select('mst_item_group.item_group,item_name,supp_name,warehouse_name,item_curr_qty,mst_baseunit.baseunit,item_remarks,mst_item.id_item,id_baseunit');
	$this->db->from('mst_item');
	$this->db->join('mst_item_group', 'mst_item_group.id_item_group = mst_item.item_group', 'left');
	$this->db->join('mst_supplier', 'mst_supplier.id_supplier = mst_item.supplier_id', 'left');
	$this->db->join('mst_warehouse', 'mst_warehouse.id_warehouse = mst_item.warehouse_id', 'left');
	$this->db->join('mst_baseunit', 'mst_baseunit.id_baseunit = mst_item.baseunit', 'left');
	$this->db->where_in('mst_item.is_active', array(0,2));
	$this->db->order_by("item_name", "asc");
	$query = $this->db->get();
	return $query;
	}

	function get_find_item_pr(){
	$this->db->select('mst_item_group.item_group,item_name,supp_name,warehouse_name,item_curr_qty,mst_baseunit.baseunit,item_remarks,mst_item.id_item,id_baseunit, trx_item_pr_h.id_pr_no, trx_item_pr_h.pr_no, trx_item_pr_h.pr_date, trx_item_pr_h.is_finalized, trx_item_pr_h.user_id, trx_item_pr_h.user_app, trx_item_pr_h.dept_id, trx_item_pr_d.item_qty, trx_item_pr_d.vestige');
	$this->db->from('mst_item');
	$this->db->join('mst_item_group', 'mst_item_group.id_item_group = mst_item.item_group', 'left');
	$this->db->join('mst_supplier', 'mst_supplier.id_supplier = mst_item.supplier_id', 'left');
	$this->db->join('mst_warehouse', 'mst_warehouse.id_warehouse = mst_item.warehouse_id', 'left');
	$this->db->join('mst_baseunit', 'mst_baseunit.id_baseunit = mst_item.baseunit', 'left');
	$this->db->join('trx_item_pr_d', 'mst_item.id_item = trx_item_pr_d.id_item', 'inner');
	$this->db->join('trx_item_pr_h', 'trx_item_pr_h.id_pr_no = trx_item_pr_d.id_item_pr_h', 'inner');
	$this->db->where('mst_item.is_active', 0);
	$this->db->where('trx_item_pr_h.is_finalized', 0);
	$this->db->where('trx_item_pr_d.vestige >', 0);
	$this->db->order_by("trx_item_pr_h.id_pr_no", "asc");
	$query = $this->db->get();
	return $query;
	}

	function get_find_item_by_pr($id_pr){
	$this->db->select('mst_item_group.item_group,item_name,supp_name,warehouse_name,item_curr_qty,mst_baseunit.baseunit,item_remarks,mst_item.id_item,id_baseunit');
	$this->db->from('mst_item');
	$this->db->join('mst_item_group', 'mst_item_group.id_item_group = mst_item.item_group', 'left');
	$this->db->join('mst_supplier', 'mst_supplier.id_supplier = mst_item.supplier_id', 'left');
	$this->db->join('mst_warehouse', 'mst_warehouse.id_warehouse = mst_item.warehouse_id', 'left');
	$this->db->join('mst_baseunit', 'mst_baseunit.id_baseunit = mst_item.baseunit', 'left');
	$this->db->join('trx_item_pr_d', 'mst_item.id_item = trx_item_pr_d.id_item', 'inner');
	$this->db->join('trx_item_pr_h', 'trx_item_pr_h.id_pr_no = trx_item_pr_d.id_item_pr_h', 'inner');
	$this->db->where('mst_item.is_active', 0);
	$this->db->where('trx_item_pr_h.id_pr_no', $id_pr);
	$this->db->order_by("item_name", "asc");
	$query = $this->db->get();
	return $query;
	}

	function get_find_item2($id_warehouse){
	$this->db->select('mst_item_group.item_group,item_name,supp_name,warehouse_name,item_curr_qty,mst_baseunit.baseunit,item_remarks,mst_item.id_item,id_baseunit');
	$this->db->from('mst_item');
	$this->db->join('mst_item_group', 'mst_item_group.id_item_group = mst_item.item_group', 'left');
	$this->db->join('mst_supplier', 'mst_supplier.id_supplier = mst_item.supplier_id', 'left');
	$this->db->join('trx_item_wh', 'trx_item_wh.id_item = mst_item.id_item', 'left');
	$this->db->join('mst_warehouse', 'mst_warehouse.id_warehouse=trx_item_wh.id_warehouse', 'left');
	$this->db->join('mst_baseunit', 'mst_baseunit.id_baseunit = mst_item.baseunit', 'left');
	$this->db->where('trx_item_wh.id_warehouse', $id_warehouse);
	$this->db->where('mst_item.is_active', 0);
	$this->db->where('item_curr_qty >',10);
	$this->db->order_by('item_name', 'asc');
	$query = $this->db->get();
	return $query;
	}

	function get_find_item3($id_warehouse, $item_group){
	$this->db->select('mst_item_group.item_group, item_name, supp_name, warehouse_name,stock as item_curr_qty, mst_baseunit.baseunit, item_remarks, mst_item.id_item,id_baseunit');
	$this->db->from('mst_item');
	$this->db->join('mst_item_group', 'mst_item_group.id_item_group = mst_item.item_group', 'left');
	$this->db->join('mst_supplier', 'mst_supplier.id_supplier = mst_item.supplier_id', 'left');
	$this->db->join('trx_item_wh', 'trx_item_wh.id_item = mst_item.id_item', 'left');
	$this->db->join('mst_warehouse', 'mst_warehouse.id_warehouse=trx_item_wh.id_warehouse', 'left');
	$this->db->join('mst_baseunit', 'mst_baseunit.id_baseunit = mst_item.baseunit', 'left');
	$this->db->where('trx_item_wh.id_warehouse', $id_warehouse);
	$this->db->where('mst_item.is_active', 0);
	$this->db->where('item_curr_qty >',10);
	$this->db->where_in('mst_item_group.id_item_group', $item_group);
	$this->db->order_by('item_name', 'asc');
	$query = $this->db->get();
	return $query;
	}

	function get_request_item($id_mi_no){
	$this->db->from('trx_item_transfer_h');
	$this->db->join('trx_item_transfer_d', 'trx_item_transfer_h.id_mi_no=trx_item_transfer_d.id_item_mi_h', 'inner');
	$this->db->where('id_mi_no', $id_mi_no);
	$query = $this->db->get();
	return $query;	
	}

	function get_request_item_to($id_mi_no){
	$this->db->from('trx_item_transfer_h');
	$this->db->join('trx_item_transfer_d', 'trx_item_transfer_h.id_mi_no=trx_item_transfer_d.id_item_mi_h', 'inner');
	$this->db->join('trx_item_wh', 'trx_item_transfer_h.to_wh=trx_item_wh.id_warehouse and trx_item_transfer_d.id_item=trx_item_wh.id_item', 'inner');
	$this->db->where('trx_item_transfer_h.id_mi_no', $id_mi_no);
	$query = $this->db->get();
	return $query;	
	}

	function get_find_item_drug(){
	$this->db->select('mst_item_group.item_group,item_name,supp_name,warehouse_name,item_curr_qty,mst_baseunit.baseunit,item_remarks,id_item,id_baseunit');
	$this->db->from('mst_item');
	$this->db->join('mst_item_group', 'mst_item_group.id_item_group = mst_item.item_group', 'left');
	$this->db->join('mst_supplier', 'mst_supplier.id_supplier = mst_item.supplier_id', 'left');
	$this->db->join('mst_warehouse', 'mst_warehouse.id_warehouse = mst_item.warehouse_id', 'left');
	$this->db->join('mst_baseunit', 'mst_baseunit.id_baseunit = mst_item.baseunit', 'left');
	$this->db->where('mst_item.is_active', 0);
	$this->db->where('mst_item.item_group', 6);
	$query = $this->db->get();
	return $query;
	}

	function get_find_item_drug2(){
	$this->db->select('mst_item_group.item_group,item_name,supp_name,warehouse_name,item_price,item_curr_qty,mst_baseunit.baseunit,item_remarks,id_item,id_baseunit,mst_item.item_price');
	$this->db->from('mst_item');
	$this->db->join('mst_item_group', 'mst_item_group.id_item_group = mst_item.item_group', 'inner');
	$this->db->join('mst_supplier', 'mst_supplier.id_supplier = mst_item.supplier_id', 'inner');
	$this->db->join('mst_warehouse', 'mst_warehouse.id_warehouse = mst_item.warehouse_id', 'inner');
	$this->db->join('mst_baseunit', 'mst_baseunit.id_baseunit = mst_item.baseunit', 'inner');
	$this->db->where('mst_item.is_active', 0);
	$this->db->where('mst_item.item_group', 2);
	$this->db->where('id_manufaktur',0);
	$query = $this->db->get();
	return $query;
	}	

	function get_header_trf_items($id){
	$this->db->select('trx_item_transfer_h.id_mi_no, trx_item_transfer_h.mi_no, trx_item_transfer_h.mi_date, trx_item_transfer_h.is_finalized, trx_item_transfer_h.user_id, trx_item_transfer_h.user_app, trx_item_transfer_h.from_wh, trx_item_transfer_h.from_dept, trx_item_transfer_h.to_wh, trx_item_transfer_h.to_dept, trx_item_transfer_h.`status`, trx_item_transfer_h.ipno, mst_user.fullname, a.warehouse_name as dari_gud,b.warehouse_name as ke_gud');
	$this->db->from('trx_item_transfer_h');
	$this->db->join('mst_user', 'trx_item_transfer_h.user_id = mst_user.id', 'inner');
	$this->db->join('mst_warehouse a', 'trx_item_transfer_h.from_wh = a.id_warehouse', 'inner');
	$this->db->join('mst_warehouse b', 'trx_item_transfer_h.to_wh = b.id_warehouse', 'inner');
	$this->db->where('trx_item_transfer_h.status', 0);
	$this->db->where('trx_item_transfer_h.is_finalized', 0);
	$this->db->where('trx_item_transfer_h.id_mi_no', $id);
	$query = $this->db->get();
	return $query;
	}

	function get_detail_trf_items($id){
	$query = $this->db->query("SELECT trx_item_transfer_d.id_mi_d, trx_item_transfer_d.id_item_mi_h, trx_item_transfer_d.id_item, trx_item_transfer_d.item_product, trx_item_transfer_d.item_qty, trx_item_transfer_d.item_uom, trx_item_transfer_d.approve, trx_item_transfer_d.`status`, trx_item_transfer_d.remarks, trx_item_transfer_d.create_date, trx_item_transfer_d.create_by, trx_item_transfer_h.from_wh, trx_item_wh.stock, trx_item_wh.id as id_wh, IFNULL(trx_item_wh.stock, 0) - trx_item_transfer_d.item_qty as sisa FROM `trx_item_transfer_d` INNER JOIN `trx_item_transfer_h` ON `trx_item_transfer_h`.`id_mi_no` = `trx_item_transfer_d`.`id_item_mi_h` INNER JOIN `trx_item_wh` ON `trx_item_wh`.`id_warehouse` = `trx_item_transfer_h`.`from_wh` AND `trx_item_wh`.`id_item` = `trx_item_transfer_d`.`id_item` WHERE `trx_item_transfer_d`.`id_item_mi_h` = $id ");
	return $query;
	}

	function get_detail_trf_items2($id){
	$query = $this->db->query("SELECT trx_item_transfer_d.id_mi_d, trx_item_transfer_d.id_item_mi_h, trx_item_transfer_d.id_item, trx_item_transfer_d.item_product, trx_item_transfer_d.item_qty, trx_item_transfer_d.item_uom, trx_item_transfer_d.approve, trx_item_transfer_d.`status`, trx_item_transfer_d.remarks, trx_item_transfer_d.create_date, trx_item_transfer_d.create_by, trx_item_transfer_h.to_wh, IFNULL(trx_item_wh.stock, 0) AS stock, IFNULL(trx_item_wh.id, 0) AS id_wh, IFNULL(trx_item_wh.stock, 0) + trx_item_transfer_d.item_qty AS total FROM `trx_item_transfer_d` INNER JOIN `trx_item_transfer_h` ON `trx_item_transfer_h`.`id_mi_no` = `trx_item_transfer_d`.`id_item_mi_h` LEFT JOIN `trx_item_wh` ON `trx_item_wh`.`id_warehouse` = `trx_item_transfer_h`.`to_wh` AND `trx_item_wh`.`id_item` = `trx_item_transfer_d`.`id_item` WHERE `trx_item_transfer_d`.`id_item_mi_h` = $id ");
	return $query;
	}

	function get_detail_trf_items_old($id){
	$this->db->select('trx_item_transfer_d.id_mi_d, trx_item_transfer_d.id_item_mi_h, trx_item_transfer_d.id_item, trx_item_transfer_d.item_product, trx_item_transfer_d.item_qty, trx_item_transfer_d.item_uom, trx_item_transfer_d.approve, trx_item_transfer_d.`status`, trx_item_transfer_d.remarks, trx_item_transfer_d.create_date, trx_item_transfer_d.create_by, trx_item_transfer_h.from_wh, trx_item_wh.stock, trx_item_wh.id,IFNULL(trx_item_wh.stock,0) - trx_item_transfer_d.item_qty');
	$this->db->from('trx_item_transfer_d');
	$this->db->join('trx_item_transfer_h', 'trx_item_transfer_h.id_mi_no = trx_item_transfer_d.id_item_mi_h', 'inner');
	$this->db->join('trx_item_wh', 'trx_item_wh.id_warehouse = trx_item_transfer_h.from_wh AND trx_item_wh.id_item = trx_item_transfer_d.id_item', 'inner');
	$this->db->where('trx_item_transfer_d.id_item_mi_h', $id);
	$query = $this->db->get();
	return $query;
	}

	function get_header_trf_items_wh($id){
	$this->db->select('trx_item_transfer_h.id_mi_no, trx_item_transfer_d.id_mi_d, trx_item_transfer_d.id_item_mi_h, trx_item_transfer_d.id_item, trx_item_transfer_d.item_product, trx_item_transfer_d.item_qty, trx_item_transfer_d.item_uom, trx_item_transfer_d.approve, trx_item_transfer_d.`status`, trx_item_transfer_d.remarks, trx_item_transfer_d.create_date, trx_item_transfer_d.create_by, trx_item_wh.id, trx_item_wh.id_warehouse, trx_item_wh.stock, trx_item_wh.update_by, trx_item_wh.update_date');
	$this->db->from('trx_item_transfer_h');
	$this->db->join('trx_item_transfer_d', 'trx_item_transfer_d.id_item_mi_h = trx_item_transfer_h.id_mi_no', 'inner');
	$this->db->join('trx_item_wh', 'trx_item_transfer_h.from_wh = trx_item_wh.id_warehouse AND trx_item_transfer_d.id_item = trx_item_wh.id_item', 'inner');
	$this->db->where('trx_item_transfer_h.id_mi_no', $id);
	$query = $this->db->get();
	return $query;
	}

	function update_header_trf_items($id_mi_no,$data_update){
	$this->db->where('id_mi_no',$id_mi_no);
	$this->db->update('trx_item_transfer_h',$data_update);
	return $this->db->affected_rows();
	}

	function update_detail_trf_items($id_mi_no,$data_update){
	$this->db->where('id_item_mi_h',$id_mi_no);
	$this->db->update('trx_item_transfer_d',$data_update);
	return $this->db->affected_rows();
	}

	function get_list_request_item(){
	$this->db->select('trx_item_request_h.id_item_request_h, trx_item_request_h.source, trx_item_request_h.is_complete, mst_user.fullname, trx_item_request_h.create_date, trx_item_pr_h.pr_no, COUNT( trx_item_request_d.id_item_request_d ) AS jml');
	$this->db->from('trx_item_request_h');
	$this->db->join('trx_item_request_d', 'trx_item_request_h.id_item_request_h = trx_item_request_d.id_item_request_h', 'inner');
	$this->db->join('trx_item_pr_h', 'trx_item_request_h.id_pr_no=trx_item_pr_h.id_pr_no', 'left');
	$this->db->join('mst_user', 'trx_item_request_h.create_by=mst_user.id', 'left');
	$this->db->where('trx_item_request_h.is_complete', 0);
	$this->db->group_by('trx_item_request_h.id_item_request_h, trx_item_request_h.source, trx_item_request_h.is_complete, mst_user.fullname, trx_item_request_h.create_date');
	$query = $this->db->get();
	return $query;
	}
	
	function get_detail_list_request_item($id_item_request_h){
	$this->db->from('trx_item_request_d');
	$this->db->where('id_item_request_h', $id_item_request_h);
	$this->db->where('is_complete', 0);
	$query = $this->db->get();
	return $query;
	}
	
	function get_find_pr(){
	//$query = $this->db->query('SET GLOBAL group_concat_max_len=1000000');
	$query = $this->db->query("SELECT id_pr_no,pr_no,nama_dep,pr_date,count(id_item_pr_h) qty,GROUP_CONCAT('*',item_product,' (',item_qty,' ',item_uom,') ' SEPARATOR ';') items, GROUP_CONCAT('*',item_product,' (',item_qty,' ',item_uom,') ' SEPARATOR ', ') files FROM trx_item_pr_h inner join trx_item_pr_d on trx_item_pr_d.id_item_pr_h=trx_item_pr_h.id_pr_no inner join mst_department on mst_department.kode_dep=trx_item_pr_h.dept_id group by  pr_no,nama_dep,pr_date,id_pr_no;");
	return $query;
	}

	function get_find_pr_approve(){
	//$query = $this->db->query('SET GLOBAL group_concat_max_len=1000000');
	$query = $this->db->query("SELECT id_pr_no, pr_no, nama_dep, pr_date, count(id_item_pr_h) qty, GROUP_CONCAT( '*', item_product, ' (', item_qty, ' ', item_uom, ') ' SEPARATOR ';' ) items, GROUP_CONCAT( '*', item_product, ' (', item_qty, ' ', item_uom, ') ' SEPARATOR ', ' ) files FROM trx_item_pr_h INNER JOIN trx_item_pr_d ON trx_item_pr_d.id_item_pr_h = trx_item_pr_h.id_pr_no INNER JOIN mst_department ON mst_department.kode_dep = trx_item_pr_h.dept_id WHERE trx_item_pr_h.is_finalized = 0 AND id_pr_no NOT IN ( SELECT id_pr_header FROM trx_item_po_d ) GROUP BY pr_no, nama_dep, pr_date, id_pr_no;");
	return $query;
	}

	function get_find_pr_approve_info($id){
	$query = $this->db->query("SELECT id_pr_no,pr_no,nama_dep,pr_date,count(id_item_pr_h) qty,GROUP_CONCAT('*',item_product,' (',item_qty,' ',item_uom,') ' SEPARATOR ';') items, GROUP_CONCAT('*',item_product,' (',item_qty,' ',item_uom,') ' SEPARATOR ', ') files FROM trx_item_pr_h inner join trx_item_pr_d on trx_item_pr_d.id_item_pr_h=trx_item_pr_h.id_pr_no inner join mst_department on mst_department.kode_dep=trx_item_pr_h.dept_id WHERE id_pr_no=".$id." AND trx_item_pr_h.is_finalized=0  group by  pr_no,nama_dep,pr_date,id_pr_no;");
	return $query;
	}
	
	function get_find_pr_approve_detail_info($id){
	$this->db->select('id_pr_no, pr_no, nama_dep, pr_date, item_product, item_qty, item_uom');
	$this->db->from('trx_item_pr_h');
	$this->db->join('trx_item_pr_d', 'trx_item_pr_d.id_item_pr_h = trx_item_pr_h.id_pr_no', 'inner');
	$this->db->join('mst_department', 'mst_department.kode_dep = trx_item_pr_h.dept_id', 'inner');
	$this->db->where('id_pr_no', $id);
	$this->db->where('trx_item_pr_h.is_finalized ',0);
	$query = $this->db->get();
	return $query;
	}
	
	function get_list_wh(){
	$this->db->where('status',0);
	return $this->db->get('mst_warehouse');
	}
	
	function list_mst_item_price_temp(){
	$this->db->select('mst_item_price_temp.id_price, mst_item_price_temp.id_item, mst_item_price_temp.id_branch, mst_item_price_temp.Currency, mst_item_price_temp.Price, mst_item_price_temp.updated_by, mst_item_price_temp.updated_date, mst_item_price_temp.`status`, mst_item_price.Price AS hrg, mst_item.item_name, mst_price_type.price_type');
	$this->db->from('mst_item_price_temp');
	$this->db->join('mst_item_price','mst_item_price_temp.id_item=mst_item_price.id_item AND mst_item_price_temp.price_type=mst_item_price.price_type', 'left');
	$this->db->join('mst_item','mst_item_price_temp.id_item=mst_item.id_item','inner');
	$this->db->join('mst_price_type','mst_item_price_temp.price_type=mst_price_type.id_price_type','inner');
	$this->db->where('mst_item_price_temp.status',0);
	return $this->db->get('');
	}
	
	function get_list_wh2($item_group){
	$this->db->select('mst_warehouse.id_warehouse,mst_warehouse.kode_dep,mst_warehouse.warehouse_name,COUNT(trx_item_wh.id_item) as jumlah');
	$this->db->from('trx_item_wh');
	$this->db->join('mst_warehouse','trx_item_wh.id_warehouse=mst_warehouse.id_warehouse','inner');
	$this->db->where('mst_item.is_active',0);
	$this->db->join('mst_item','trx_item_wh.id_item=mst_item.id_item','inner');
	$this->db->where('status',0);
	$this->db->where_in('item_group',$item_group);
	$this->db->where('item_curr_qty >',10);
	$this->db->group_by('mst_warehouse.id_warehouse,mst_warehouse.kode_dep,mst_warehouse.warehouse_name');
	return $this->db->get('');
	}
	
	function get_list_wh3($id){
	$this->db->group_by('mst_warehouse.id_warehouse,mst_warehouse.kode_dep,mst_warehouse.warehouse_name');
	$this->db->where('status',0);
	// $this->db->where('mst_item.is_active',0);
	$this->db->where('kode_dep',$id);
	$this->db->join('mst_item','trx_item_wh.id_item=mst_item.id_item','left');
	$this->db->join('mst_warehouse','trx_item_wh.id_warehouse=mst_warehouse.id_warehouse', 'inner');
	$this->db->from('trx_item_wh');
	$this->db->select('mst_warehouse.id_warehouse,mst_warehouse.kode_dep,mst_warehouse.warehouse_name,COUNT(trx_item_wh.id_item) as jumlah');
	return $this->db->get('');
	}
	
	function get_list_wh_dep(){
	$this->db->where('status',0);
	$this->db->from('mst_warehouse');
	$this->db->join('mst_department','mst_warehouse.kode_dep=mst_department.kode_dep','left');
	return $this->db->get();
	}
	
	function get_list_wh_dep_id($id){
	$this->db->where('id_warehouse',$id);
	$this->db->where('status',0);
	$this->db->from('mst_warehouse');
	return $this->db->get();
	}
	
	function get_list_trx_item_wh($id_item,$id_warehouse){
	$this->db->where('id_item',$id_item);
	$this->db->where('id_warehouse',$id_warehouse);
	return $this->db->get('trx_item_wh');
	}

	function get_delivery_data(){
	$this->db->where('status',0);
	return $this->db->get('mst_delivery_address');
	}

	function get_max_trx_item_pr_h(){
	$this->db->select_max('id_pr_no');
	$query = $this->db->get('trx_item_pr_h');	
	return $query;
	}
		
	function get_max_mst_delivery_address(){
	$this->db->select_max('id_delivery');
	$query = $this->db->get('mst_delivery_address');	
	return $query;
	}
		
	function get_delivery_data_id($id){
	$this->db->where('id_delivery',$id);
	return $this->db->get('mst_delivery_address');
	}
	
	function get_list_depart($id){
	$this->db->where('kode_dep',$id);
	return $this->db->get('mst_department');
	}
	
	function get_list_depart_po(){
	return $this->db->get('mst_department');
	}
	
	function get_expense_header($id){
	$this->db->where('id_po',$id);
	return $this->db->get('trx_item_po_h');
	}
	
	function get_expense_main($id){
	$this->db->from('trx_item_po_d');
	$this->db->where('id_po_header',$id);
	$this->db->order_by('id_item_po_d', 'asc');
	$query = $this->db->get();
	return $query;
	}
	
	function get_pr_header($id){
	$this->db->where('id_pr_no',$id);
	$this->db->join('mst_department', 'mst_department.kode_dep = trx_item_po_h.dept_id', 'inner');
	return $this->db->get('trx_item_pr_h');
	}
	
	function get_pr_main($id){
	$this->db->from('trx_item_pr_d');
	$this->db->where('id_item_pr_h',$id);
	$this->db->order_by('seq_no', 'asc');
	$query = $this->db->get();
	return $query;
	}
	
	function get_pr_main_ap($id){
	$this->db->from('trx_item_pr_d');
	$this->db->where('id_item_pr_h',$id);
	$this->db->where_in('is_status', array(0,1));
	$this->db->order_by('seq_no', 'asc');
	$query = $this->db->get();
	return $query;
	}
	
	function get_mi_header($id){
	$this->db->where('id_mi_no',$id);
	$this->db->join('mst_department', 'mst_department.kode_dep = trx_item_transfer_h.to_dept', 'inner');
	return $this->db->get('trx_item_transfer_h');
	}
	
	function get_mi_jumlah_dept($id){
	$this->db->where('to_dept',$id);
	$this->db->where('status',0);
	return $this->db->get('trx_item_transfer_h');
	}
	
	function get_mi_cek_nomor($id,$mi_no){
	$this->db->where('mi_no',$mi_no);
	$this->db->where('to_dept',$id);
	$this->db->where('status',0);
	$this->db->order_by('mi_no', 'desc');
	return $this->db->get('trx_item_transfer_h');
	}
	
	function get_mi_main($id){
	$this->db->where('id_item_mi_h',$id);
	return $this->db->get('trx_item_transfer_d');
	}
	
	function get_po_header($id){
	$this->db->where('id_po',$id);
	$this->db->join('mst_supplier', 'mst_supplier.id_supplier = trx_item_po_h.supplier_id', 'inner');
	return $this->db->get('trx_item_po_h');
	}
	
	function get_po_main($id){
	$this->db->select('*,trx_item_po_d.item_qty qtys,trx_item_po_d.item_price price');
	$this->db->where('id_po_header',$id);
	$this->db->join('mst_item', 'mst_item.id_item = trx_item_po_d.item_id', 'inner');
	$this->db->join('mst_conversion', 'mst_conversion.id_conv = trx_item_po_d.item_uom', 'inner');
	$this->db->join('mst_baseunit', 'mst_baseunit.id_baseunit = mst_conversion.source_baseunit', 'inner');	
	return $this->db->get('trx_item_po_d');
	}
	
	function get_print_received_main($id){
	$query = $this->db->query("SELECT *, `trx_item_po_d`.`item_qty` `qtys`, `trx_item_po_d`.`item_price` `price`,trx_item_receive_d.item_qty as num1,trx_item_receive_d.item_dest as num2
	FROM
	    `trx_item_po_d`
	        INNER JOIN
	    `mst_item` ON `mst_item`.`id_item` = `trx_item_po_d`.`item_id`
	        INNER JOIN
	    `mst_baseunit` ON `mst_baseunit`.`id_baseunit` = `trx_item_po_d`.`item_uom`
	        LEFT JOIN
	    `trx_item_receive_h` ON `trx_item_po_d`.`id_po_header` = `trx_item_receive_h`.`po_id` 
	        LEFT JOIN
	    `trx_item_receive_d` ON `trx_item_receive_h`.`id_receive_h` = `trx_item_receive_d`.`id_receive` and trx_item_receive_d.item_id = mst_item.id_item        
	WHERE
	    `id_po_header` = $id
	 AND `trx_item_receive_d`.`item_dest`<= trx_item_receive_d.item_qty
	    ");
	return $query;
	}

	function get_po_grand($id){
	$this->db->where('id_po',$id);
	return $this->db->get('trx_item_po_h');
	}
	
	function get_po_footer($id){
	$this->db->where('id_po',$id);
	$this->db->join('mst_delivery_address', 'mst_delivery_address.id_delivery = trx_item_po_h.address_id', 'inner');
	return $this->db->get('trx_item_po_h');
	}
	
	function get_pjv($id){
	$this->db->where('po_id',$id);
	return $this->db->get('trx_item_receive_h');
	}
	
	function get_list_sp(){
	$this->db->order_by('id_supplier', 'desc'); 
	$this->db->where('status',0);
	return $this->db->get('mst_supplier');
	}

	function get_list_sp_id($id){
	$this->db->where('id_supplier',$id);
	$this->db->where('status',0);
	return $this->db->get('mst_supplier');
	}
	
	function get_list_item($id_item){
	$this->db->where('is_active',0);
	$this->db->where('id_item',$id_item);
	$this->db->join('mst_baseunit', 'mst_baseunit.id_baseunit=mst_item.baseunit', 'inner');
	return $this->db->get('mst_item');
	}

	function get_list_po_header($id){
	$this->db->where('id_po',$id);
	return $this->db->get('trx_item_po_h');
	}
	
	function get_list_ig(){
	$this->db->where('is_active',0);
	return $this->db->get('mst_item_group');
	}
	
	function get_list_item_all(){
	$this->db->order_by('item_name', 'asc');
	$this->db->where('is_active',0);
	return $this->db->get('mst_item');
	}
	
	function get_list_ig_id($id){
	$this->db->where('id_item_group',$id);
	$this->db->where('is_active',0);
	return $this->db->get('mst_item_group');
	}
	
	function get_list_bu(){
	$this->db->order_by("baseunit", "asc");
	return $this->db->get('mst_baseunit');
	}
	
	function get_list_conversion(){
	return $this->db->get('mst_conversion');
	}
	
	function count_transmission(){
	$this->db->select('LPAD(COUNT(*)+1,4,"0") as xyz');
	$this->db->from('trx_exchanges_inv_h');
	$this->db->where('MONTH(created_date)', date('m'));
	$this->db->where('YEAR(created_date)', date('Y'));
	$query = $this->db->get();
	return $query;
	}

	function get_list_conversion_join_base(){
	$this->db->select('mst_conversion.id_conv, mst_baseunit.baseunit, mst_conversion.conv_factor,c.baseunit as xx,mst_conversion.remarks');
	$this->db->from('mst_conversion');
	$this->db->join('mst_baseunit', 'mst_conversion.source_baseunit=mst_baseunit.id_baseunit', 'inner');
	$this->db->join('mst_baseunit c', 'mst_conversion.dest_baseunit=c.id_baseunit', 'inner');
	$this->db->where('is_active', 0);
	$query = $this->db->get();
	return $query;
	}

	function get_listconvbyid($id){
	$this->db->select('mst_conversion.id_conv, mst_baseunit.baseunit, mst_conversion.conv_factor,c.baseunit as xx,mst_conversion.remarks');
	$this->db->from('mst_conversion');
	$this->db->join('mst_baseunit', 'mst_conversion.source_baseunit=mst_baseunit.id_baseunit', 'inner');
	$this->db->join('mst_baseunit c', 'mst_conversion.dest_baseunit=c.id_baseunit', 'inner');
	$this->db->where('mst_conversion.source_baseunit', $id);
	$this->db->or_where('mst_conversion.dest_baseunit', $id);
	$this->db->where('is_active', 0);
	$query = $this->db->get();
	return $query;
	}

	function get_list_conversion_join_base_id($id){
	$this->db->select('mst_conversion.id_conv, mst_baseunit.baseunit, mst_conversion.conv_factor,c.baseunit as xx,mst_conversion.remarks');
	$this->db->from('mst_conversion');
	$this->db->join('mst_baseunit', 'mst_conversion.source_baseunit=mst_baseunit.id_baseunit', 'inner');
	$this->db->join('mst_baseunit c', 'mst_conversion.dest_baseunit=c.id_baseunit', 'inner');
	$this->db->where('is_active', 0);
	$this->db->where('mst_conversion.id_conv', $id);
	$query = $this->db->get();
	return $query;
	}

	function get_list_transmission($id){
	$this->db->select('trx_exchanges_inv_h.id_retur_h, trx_exchanges_inv_h.id_receive_h, trx_exchanges_inv_h.po_id, trx_exchanges_inv_h.retur_no, trx_exchanges_inv_h.supp_name, trx_exchanges_inv_h.invoice_no, trx_exchanges_inv_h.amount, trx_exchanges_inv_h.term, trx_exchanges_inv_h.create_by, trx_exchanges_inv_h.created_date, trx_item_po_h.id_po, trx_item_po_h.po_no, trx_item_po_h.po_date, trx_item_po_h.delivery_date, trx_item_po_h.supplier_id, trx_item_po_h.address_id, trx_item_po_h.term_payment, trx_item_po_h.due_date, trx_item_po_h.user_id, trx_item_po_h.app_id, trx_item_po_h.is_completed, trx_item_po_h.total_amount, trx_item_po_h.ppn_amount, trx_item_po_h.grand_amount, trx_item_po_h.archive, trx_item_po_h.created_date');
	$this->db->from('trx_exchanges_inv_h');
	$this->db->join('trx_item_po_h', 'trx_exchanges_inv_h.po_id = trx_item_po_h.id_po', 'inner');
	$this->db->where('po_id', $id);
	$query = $this->db->get();
	return $query;
	}

	function del_pr($id){
	$this->db->where('id_item_pr_h',$id);
	$this->db->delete('trx_item_pr_d');
	$this->db->where('id_pr_no',$id);
	$this->db->delete('trx_item_pr_h');
	return $this->db->affected_rows();
	}
	
	function update_trx_item_pr_h($id,$data_app){
	$this->db->where('id_pr_no',$id);
	$this->db->update('trx_item_pr_h',$data_app);
	return $this->db->affected_rows();
	}

	function update_trx_item_pr_d($id,$data_app){
	$this->db->where('id_pr_d',$id);
	$this->db->update('trx_item_pr_d',$data_app);
	return $this->db->affected_rows();
	}

	function update_arc($id,$data_app){
	$this->db->where('id_po',$id);
	$this->db->update('trx_item_po_h',$data_app);
	return $this->db->affected_rows();
	}

	function update_trx_item_po_d($id,$data_app){
	$this->db->where('id_item_po_d',$id);
	$this->db->update('trx_item_po_d',$data_app);
	return $this->db->affected_rows();
	}


	function update_trx_item_transfer_h($id,$data_app){
	$this->db->where('id_mi_no',$id);
	$this->db->update('trx_item_transfer_h',$data_app);
	return $this->db->affected_rows();
	}

	function update_trfmid($id,$data_app){
	$this->db->where('id_mi_d',$id);
	$this->db->update('trx_item_transfer_d',$data_app);
	return $this->db->affected_rows();
	}

	function update_mst_item_group($id,$data_app){
	$this->db->where('id_item_group',$id);
	$this->db->update('mst_item_group',$data_app);
	return $this->db->affected_rows();
	}

	function update_mst_conversion($id,$data_app){
	$this->db->where('id_conv',$id);
	$this->db->update('mst_conversion',$data_app);
	return $this->db->affected_rows();
	}

	function update_sysparam($id,$data_app){
	$this->db->where('id',$id);
	$this->db->update('sysparam',$data_app);
	return $this->db->affected_rows();
	}

	function update_coa($id,$data_app){
	$this->db->where('order',$id);
	$this->db->update('mst_coa',$data_app);
	return $this->db->affected_rows();
	}

	function update_mst_item($id,$data_app){
	$this->db->where('id_item',$id);
	$this->db->update('mst_item',$data_app);
	return $this->db->affected_rows();
	}

	function update_requestitem($id,$data_app){
	$this->db->where('id_item_request_h',$id);
	$this->db->update('trx_item_request_h',$data_app);
	return $this->db->affected_rows();
	}

	function update_request_item_d($id_item_request_d,$data_app){
	$this->db->where('id_item_request_d',$id_item_request_d);
	$this->db->update('trx_item_request_d',$data_app);
	return $this->db->affected_rows();
	}

	function update_trfmid2($id,$data_app){
	$this->db->where('id_item_mi_h',$id);
	$this->db->update('trx_item_transfer_d',$data_app);
	return $this->db->affected_rows();
	}

	function del_po($id,$data_app)
	{
	$this->db->where('id_po',$id);
	$this->db->update('trx_item_po_h',$data_app);
	return $this->db->affected_rows();
	}

	function del_price_item($id,$data_app){
	$this->db->where('id_price',$id);
	$this->db->update('mst_item_price_temp',$data_app);
	return $this->db->affected_rows();
	}

	//fungsi untuk delete Delivery Address, Add by rangga 23 Feb 2016
	function delete_DeliveryAddress($id,$data_app){
	$this->db->where('id_delivery',$id);
	$this->db->update('mst_delivery_address',$data_app);
	return $this->db->affected_rows();
	}

	//fungsi untuk delete Warehouse, Add by rangga 23 Feb 2016
	function delete_Warehouse($id,$data_app){
	$this->db->where('id_warehouse',$id);
	$this->db->update('mst_warehouse',$data_app);
	return $this->db->affected_rows();
	}
	
	//fungsi untuk delete Warehouse, Add by rangga 23 Feb 2016
	function delete_Supplier($id,$data_app){
	$this->db->where('id_supplier',$id);
	$this->db->update('mst_supplier',$data_app);
	return $this->db->affected_rows();
	}
	
	//fungsi untuk delete/update Item, Add by rangga 20 September 2016
	function delete_item($id,$data_app){
	$this->db->where('id_item',$id);
	$this->db->update('mst_item',$data_app);
	return $this->db->affected_rows();
	}

	function update_arc_rt($id,$data_app)
	{
	$this->db->where('id_retur',$id);
	$this->db->update('trx_item_return_h',$data_app);
	return $this->db->affected_rows();
	}
	
	function app_pr($id,$data_app){
	$this->db->where('id_pr_no',$id);
	$this->db->update('trx_item_pr_h',$data_app);
	return $this->db->affected_rows();
	}

	function update_detail_pr($id,$data_app){
	$this->db->where('id_item_pr_h',$id);
	$this->db->update('trx_item_pr_d',$data_app);
	return $this->db->affected_rows();
	}

	function app_mi($id,$data_app){
	$this->db->where('id_mi_no',$id);
	$this->db->update('trx_item_transfer_h',$data_app);
	return $this->db->affected_rows();
	}
	
	function app_po($id,$data_app){
	$this->db->where('id_po',$id);
	$this->db->update('trx_item_po_h',$data_app);
	return $this->db->affected_rows();
	}
	
	function update_status_received($idd,$datas){
	$this->db->where('id_po',$idd);
	$this->db->update('trx_item_po_h',$datas);
	return $this->db->affected_rows();
	}
	
	function update_return($idd,$datas){
	$this->db->where('id_retur',$idd);
	$this->db->update('trx_item_return_h',$datas);
	return $this->db->affected_rows();
	}
	
	function update_status_received_partial($iddd,$datap){
	$this->db->where('id_receive_h',$iddd);
	$this->db->update('trx_item_receive_h',$datap);
	return $this->db->affected_rows();
	}

	function update_hrg_temp($id_item,$price_type,$data_update){
	$this->db->where('id_item',$id_item);
	$this->db->where('price_type',$price_type);
	$this->db->update('mst_item_price_temp',$data_update);
	return $this->db->affected_rows();
	}

	function update_hrg_temp_by_id_price($id_price,$data_update){
	$this->db->where('id_price',$id_price);
	$this->db->update('mst_item_price_temp',$data_update);
	return $this->db->affected_rows();
	}

	function update_mst_item_price($id_price,$data_update){
	$this->db->where('id_price',$id_price);
	$this->db->update('mst_item_price',$data_update);
	return $this->db->affected_rows();
	}

}
?>