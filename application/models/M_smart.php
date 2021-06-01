<?php
class M_smart extends CI_Model{

	function get_smartid($id){
	$this->db->where('id', $id);
	return $this->db->get('smart_notification');
	}

	function get_items($id_item){
	$this->db->from('mst_item');
	$this->db->join('mst_item_group', 'mst_item.item_group = mst_item_group.id_item_group','inner');
	$this->db->where('mst_item.id_item', $id_item);
	$query = $this->db->get();
	return $query;
	}

	function get_mst_services($order_type,$order_id){
	$this->db->from('mst_services');
	$this->db->where('id_group_serv', $order_type);
	$this->db->where('id_service', $order_id);
	$query = $this->db->get();
	return $query;
	}

	function get_mst_services_lab($order_type,$order_id){
	$this->db->from('mst_services');
	$this->db->where('order_type', $order_type);
	$this->db->where('order_id', $order_id);
	$query = $this->db->get();
	return $query;
	}

	function get_max_mst_services(){
	$this->db->select_max('id_service');
	$this->db->from('mst_services');
	$query = $this->db->get();
	return $query;
	}

	function get_list_1(){
	$query = $this->db->query("SELECT * FROM pat_order_h inner join pat_data on pat_data.id_Pat=pat_order_h.id_pat where order_status=2 and order_type=2 ORDER BY order_date DESC");
	return $query;
	}
	
	function get_list_2($jobs){
	$query = $this->db->query("SELECT * FROM trx_item_pr_h where dept_id='".$jobs."' and is_finalized='1' ");
	return $query;
	}

	function get_list_3($jobs){
	$query = $this->db->query("SELECT * FROM trx_item_po_h inner join mst_user on mst_user.id=trx_item_po_h.user_id where menu_level='".$jobs."' and is_completed='1' ");
	return $query;
	}
	
	function get_list_4($jobs){
	$query = $this->db->query("SELECT * FROM mst_user where online='1'");
	return $query;
	}
	
	function get_list_5($jobs){
	$query = $this->db->query("SELECT * FROM trx_item_transfer_h where from_dept='".$jobs."' and is_finalized='1'");
	return $query;
	}
	
	function get_list_6($jobs){
	$query = $this->db->query("
	SELECT id,id_reg,notes,create_date,serv_name,id_price_type,price_type,type_id,a.id_trouble
	FROM smart_notification a
	INNER JOIN mst_services b ON a.type_id=b.id_group_serv AND a.id_trouble=b.id_service
	INNER JOIN mst_price_type c ON a.id_source_trouble=c.id_price_type
	WHERE type_id = '0' AND id_department LIKE '%".$jobs."%' and status = '1'
	UNION ALL
	SELECT id,id_reg,notes,create_date,serv_name,id_price_type,price_type,type_id,a.id_trouble
	FROM smart_notification a
	INNER JOIN mst_services b ON a.type_id=b.id_group_serv AND a.id_trouble=b.order_id
	INNER JOIN mst_price_type c ON a.id_source_trouble=c.id_price_type
	WHERE type_id = '1' AND id_department LIKE '%".$jobs."%' and status = '1'
	UNION ALL
	SELECT id,id_reg,notes,create_date,serv_name,id_price_type,price_type,type_id,a.id_trouble
	FROM smart_notification a
	INNER JOIN mst_services b ON a.type_id=b.id_group_serv AND a.id_trouble=b.order_id
	INNER JOIN mst_price_type c ON a.id_source_trouble=c.id_price_type
	WHERE type_id = '2' AND id_department LIKE '%".$jobs."%' and status = '1'
	UNION ALL
	SELECT id,id_reg,notes,create_date,serv_name,id_price_type,price_type,type_id,a.id_trouble
	FROM smart_notification a
	INNER JOIN mst_services b ON a.type_id=b.id_group_serv AND a.id_trouble=b.id_service
	INNER JOIN mst_price_type c ON a.id_source_trouble=c.id_price_type
	WHERE type_id = '3' AND id_department LIKE '%".$jobs."%' and status = '1'
	UNION ALL
	SELECT id,id_reg,notes,create_date,serv_name,id_price_type,price_type,type_id,a.id_trouble
	FROM smart_notification a
	INNER JOIN mst_services b ON a.type_id=b.id_group_serv AND a.id_trouble=b.id_service
	INNER JOIN mst_price_type c ON a.id_source_trouble=c.id_price_type
	WHERE type_id = '4' AND id_department LIKE '%".$jobs."%' and status = '1'
	UNION ALL
	SELECT id,id_reg,notes,create_date,serv_name,id_price_type,price_type,type_id,a.id_trouble
	FROM smart_notification a
	INNER JOIN mst_services b ON a.type_id=b.id_group_serv AND a.id_trouble=b.id_service
	INNER JOIN mst_price_type c ON a.id_source_trouble=c.id_price_type
	WHERE type_id = '5' AND id_department LIKE '%".$jobs."%' and status = '1' 
	UNION ALL
	SELECT id,id_reg,notes,a.create_date,item_name,id_price_type,price_type,type_id,a.id_trouble
	FROM smart_notification a
	INNER JOIN mst_item b ON a.type_id=13 AND a.id_trouble=b.id_item
	INNER JOIN mst_price_type c ON a.id_source_trouble=c.id_price_type
	WHERE  id_department LIKE '%".$jobs."%' and status = '1'");
	return $query;
	}

	function get_lab_items($id){
	$this->db->from('smart_notification');
	$this->db->join('mst_lab_item', 'mst_lab_item.id_lab_item = smart_notification.id_trouble','inner');
	$this->db->where('smart_notification.id', $id);
	$query = $this->db->get();
	return $query;
	}
	
	function get_other_items($id){
	$this->db->from('smart_notification');
	$this->db->join('mst_services', 'mst_services.id_service = smart_notification.id_trouble','inner');
	$this->db->join('mst_service_group', 'mst_service_group.id_serv_group = smart_notification.type_id','inner');
	$this->db->where('smart_notification.id', $id);
	$query = $this->db->get();
	return $query;
	}
	
	function get_rad_items($id){
	$this->db->from('smart_notification');
	$this->db->join('mst_rad_item', 'mst_rad_item.id_rad_item = smart_notification.id_trouble','inner');
	$this->db->where('smart_notification.id', $id);
	$query = $this->db->get();
	return $query;
	}
	
	function get_list_7($id){
	$query = $this->db->query("SELECT * FROM mkt_quotation_h inner join mst_user on mst_user.id=mkt_quotation_h.mkt_id where is_finalised='1' and atasan_1='".$id."' order by quot_date_create asc");
	return $query;
	}
		
	function get_list_8($jobs){
	$query = $this->db->query("SELECT * FROM trx_item_request_h where is_complete='0'");
	return $query;
	}

	function get_list_9($jobs){
	$this->db->select('trx_item_transfer_h.id_mi_no, trx_item_transfer_h.mi_no, trx_item_transfer_h.mi_date, trx_item_transfer_h.is_finalized, trx_item_transfer_h.user_id, trx_item_transfer_h.user_app, trx_item_transfer_h.from_wh, trx_item_transfer_h.from_dept, trx_item_transfer_h.to_wh, trx_item_transfer_h.to_dept, trx_item_transfer_h.status, trx_item_transfer_h.ipno');
	$this->db->from('trx_item_transfer_h');
	$this->db->where('trx_item_transfer_h.status', 0);
	$this->db->where('trx_item_transfer_h.is_finalized', 0);
	$this->db->where('trx_item_transfer_h.from_dept', $jobs);
	$query = $this->db->get();
	return $query;
	}

	function get_list_10(){
	$this->db->from('mst_item');
	$this->db->join('mst_item_group', 'mst_item.item_group =  mst_item_group.id_item_group','inner');
	$this->db->join('mst_user', 'mst_item.created_by =  mst_user.id','inner');
	$this->db->where('mst_item.is_active', 2);
	$query = $this->db->get();
	return $query;
	}

	function update_smart_sts($id,$data_app){
	$this->db->where('id',$id);
	$this->db->update('smart_notification',$data_app);
	return $this->db->affected_rows();
	}

	function save_registration($data_reg){
    $this->db->insert('trx_registration',$data_reg);
	}

}
?>