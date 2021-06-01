<?php
class M_rad extends CI_Model{

	function get_list_group(){
	$this->db->where('is_active',0);
	return $this->db->get('mst_rad_group');
	}

  function get_list_pat_rad_result($id_reg){
  $this->db->where('id_reg',$id_reg);
  return $this->db->get('pat_rad_result');
  }

	function get_list_group_id($id){
	$this->db->where('is_active',0);
	$this->db->where('id_rad_group',$id);
	return $this->db->get('mst_rad_group');
	}
	
	function update_group_rad($id,$data){
	$this->db->where('id_rad_item',$id);
	$this->db->update('mst_rad_item',$data);
	return $this->db->affected_rows();
	}

	function save_group($data_group){
	$this->db->insert('mst_rad_group',$data_group);
	}

	function save_item($data_item){
	$this->db->insert('mst_rad_item',$data_item);
	}
	
	function get_rad_item(){
	$this->db->select('*');
	$this->db->from('mst_rad_item');
	$this->db->join('mst_rad_group', 'mst_rad_group.id_rad_group = mst_rad_item.rad_item_group', 'left');
	$this->db->where("status", 0);
	$this->db->order_by("rad_item_group", "desc");
	$query = $this->db->get();
	return $query;
	}

	function update_mst_rad_group($id,$data){
	$this->db->where('id_rad_group',$id);
	$this->db->update('mst_rad_group',$data);
	return $this->db->affected_rows();
	}

	function get_rad_report(){
	$this->db->select('id_rad_result,id_reg,pat_name,group_desc,rad_item,result');
	$this->db->from('pat_rad_result');
	 $this->db->join('pat_data', 'pat_data.id_Pat = pat_rad_result.id_pat', 'inner');
	 $this->db->join('mst_rad_item', 'mst_rad_item.id_rad_item = pat_rad_result.id_rad_item', 'left');
	 $this->db->join('mst_rad_group', 'mst_rad_item.rad_item_group = mst_rad_group.id_rad_group', 'left');
	/*$this->db->order_by("group_seq_no", "asc");
	$this->db->order_by("seq_no", "asc");  */
	$query = $this->db->get();
	return $query;
	}
	
	function get_rad_report_h($id){
	$arr = array('2', '6');
	
	$query = $this->db->query("SELECT DISTINCT 
	trx_registration.id_reg,
	pat_name,
	pat_mrn,
	pat_dob,
	client_name
FROM
  `trx_registration` 
  INNER JOIN `pat_data` 
    ON `pat_data`.`id_Pat` = `trx_registration`.`id_pat` 
  LEFT JOIN `mst_client` 
    ON `mst_client`.`id_Client` = `trx_registration`.`id_client` 
  LEFT JOIN `pat_order_h` 
    ON `pat_order_h`.`id_reg` = `trx_registration`.`id_reg` 
WHERE `pat_order_h`.`id_reg` = '$id' 
  AND `pat_order_h`.`order_type` IN ('2', '6');");
	return $query;
	}
	
	function get_rad_report_mcu_h($id){
	$arr = array('2', '6');
	$this->db->select('*');
	$this->db->from('trx_registration`');
	$this->db->join('pat_data', 'pat_data.id_Pat = trx_registration.id_pat', 'inner');
	$this->db->join('mst_client', 'mst_client.id_Client = trx_registration.id_client', 'left');
	$this->db->join('pat_order_h', 'pat_order_h.id_reg = trx_registration.id_reg', 'left');
	$this->db->where('pat_order_h.id_reg',$id);
	$this->db->where_in('pat_order_h.order_type',$arr);
	$query = $this->db->get();
	return $query;
	}
	
	function rad_order_report_h(){
	$this->db->select('*');
	$this->db->from('pat_order_h');
	$this->db->join('pat_data', 'pat_data.id_Pat = pat_order_h.id_pat', 'inner');
    $this->db->where('order_type',2);
 	$this->db->where('order_status',0);
    $this->db->order_by("id_order", "desc"); 
	$query = $this->db->get();
	return $query;
	}
	
	function get_rad_order(){
	$query = $this->db->query("SELECT 
  * 
FROM
  (SELECT 
    id_order,
    pat_order_h.id_reg,trx_registration.reg_date,
    order_date,
    pat_name,
    client_name,
    GROUP_CONCAT(
      '&#8594; ', mst_services.serv_name SEPARATOR ', '
    ) items,
	IFNULL(quot_name,'Outpatient') quot_name
  FROM
    `pat_order_h` 
    INNER JOIN `pat_data` 
      ON `pat_data`.`id_Pat` = `pat_order_h`.`id_pat` 
    INNER JOIN `trx_registration` 
      ON `trx_registration`.`id_reg` = `pat_order_h`.`id_reg` 
    LEFT JOIN `mst_client` 
      ON `mst_client`.`id_Client` = `trx_registration`.`id_client` 
    INNER JOIN `pat_order_d` 
      ON `pat_order_d`.`id_order_header` = `pat_order_h`.`id_order` 
      AND trx_registration.id_reg = pat_order_h.`id_reg` 
    INNER JOIN `mst_services` 
      ON `mst_services`.`order_id` = `pat_order_d`.`id_service`
      AND mst_services.`id_group_serv` IN (2,6)
	LEFT JOIN mkt_posting_pack_h
	  ON mkt_posting_pack_h.id_quot = trx_registration.id_package
  WHERE pat_order_h.order_type = '2' 
    AND `order_status` = '1' 
    AND pat_order_d.status != '1' 
  GROUP BY id_order,
    pat_order_h.id_reg,
    order_date,
    pat_name,
    client_name 
  ) XX 
ORDER BY id_order DESC ;");
	return $query;
	}

	function get_rad_order_print($id){
	$query = $this->db->query("SELECT 
  * 
FROM
  (SELECT 
    id_order,
    pat_order_h.id_reg,trx_registration.reg_date,
    order_date,
    pat_name,
    client_name,
    GROUP_CONCAT(
      '&#8594; ', mst_services.serv_name SEPARATOR ', '
    ) items,
	IFNULL(quot_name,'Outpatient') quot_name
  FROM
    `pat_order_h` 
    INNER JOIN `pat_data` 
      ON `pat_data`.`id_Pat` = `pat_order_h`.`id_pat` 
    INNER JOIN `trx_registration` 
      ON `trx_registration`.`id_reg` = `pat_order_h`.`id_reg` 
    INNER JOIN `mst_client` 
      ON `mst_client`.`id_Client` = `trx_registration`.`id_client` 
    INNER JOIN `pat_order_d` 
      ON `pat_order_d`.`id_order_header` = `pat_order_h`.`id_order` 
      AND trx_registration.id_reg = pat_order_h.`id_reg` 
    INNER JOIN `mst_services` 
      ON `mst_services`.`order_id` = `pat_order_d`.`id_service`
      AND mst_services.`id_group_serv` IN (2,6)
	LEFT JOIN mkt_posting_pack_h
	  ON mkt_posting_pack_h.id_quot = trx_registration.id_package
  WHERE pat_order_h.order_type = '2' 
    AND `order_status` = '$id' 
    AND pat_order_d.status != '1' 
  GROUP BY id_order,
    pat_order_h.id_reg,
    order_date,
    pat_name,
    client_name 
  ) XX 
ORDER BY id_order DESC ");
	return $query;
	}
	
	function get_rad_act_d($id){
	$query = $this->db->query("SELECT 
  * 
FROM
  (SELECT 
    id_order,
    id_reg,
    a.order_type,
    id_rad_item,
    group_desc,
   CASE
      WHEN e.nama_value IS NULL
      THEN cc.serv_name 
      ELSE nama_value 
    END AS rad_item,
    c.seq_no 
  FROM
    pat_order_h a 
    LEFT JOIN pat_order_d b 
      ON a.id_order = b.id_order_header 
    LEFT JOIN mst_rad_item c 
      ON b.id_service = c.id_rad_item 
    LEFT JOIN mst_rad_group d 
      ON c.rad_item_group = d.id_rad_group 
    LEFT JOIN mst_services cc 
      ON b.id_service = cc.order_id AND id_group_serv IN (2,6)
    LEFT JOIN mst_item_value e 
      ON cc.id_service = e.id_service AND e.`gender`='1'
  WHERE id_order = '$id' 
    AND a.order_type = '2' 
    AND b.status != '1' 
  UNION
  ALL 
  SELECT 
    id_order,
    id_reg,
    a.order_type,
    c.id_service,
    'USG',
    serv_name,
    0 
  FROM
    pat_order_h a 
    LEFT JOIN pat_order_d b 
      ON a.id_order = b.id_order_header 
    LEFT JOIN mst_services c 
      ON b.id_service = c.id_service 
    LEFT JOIN mst_item_value d 
      ON c.id_service = d.id_service 
      AND d.id_group_serv = 6 
  WHERE id_order = '$id' 
    AND c.id_group_serv = '6' 
    AND a.order_type <> '2' 
    AND b.status != '1') aa ");
	return $query;
	}
	
	function get_rad_act_comment($id){
	$this->db->distinct('mst_rad_group.id_rad_group,group_seq_no');
	$this->db->select('mst_rad_group.id_rad_group,group_seq_no');
	$this->db->from('pat_order_h');
	$this->db->join('pat_order_d', 'pat_order_d.id_order_header = pat_order_h.id_order', 'left');
	$this->db->join('mst_rad_item', 'mst_rad_item.id_rad_item = pat_order_d.id_service', 'left');
	$this->db->join('mst_rad_group', 'mst_rad_group.id_rad_group = mst_rad_item.rad_item_group', 'left');
	$this->db->where('id_order',$id); 
	$query = $this->db->get();
	return $query;
	}

	function get_rad_report_d($id){
	$query = $this->db->query("SELECT 
	* 
	FROM
	(SELECT 
		a.id_order,
		a.id_reg,
		order_type,
		c.id_rad_item,
		group_desc,
		nama_value rad_item,
		result 
	FROM
    pat_order_h a 
    LEFT JOIN pat_order_d b 
      ON a.id_order = b.id_order_header 
    LEFT JOIN mst_rad_item c 
      ON b.id_service = c.id_rad_item 
    LEFT JOIN mst_rad_group d 
      ON c.rad_item_group = d.id_rad_group 
    LEFT JOIN pat_rad_result e 
      ON a.id_order = e.id_order 
      AND b.id_service = e.id_rad_item 
  WHERE a.id_reg = '$id' 
    AND a.order_type = '2' 
  UNION
  ALL 
  SELECT 
    a.id_order,
    a.id_reg,
    a.order_type,
    c.id_service,
    'USG',
    serv_name,
    result 
  FROM
    pat_order_h a 
    LEFT JOIN pat_order_d b 
      ON a.id_order = b.id_order_header 
    LEFT JOIN mst_services c 
      ON b.id_service = c.id_service 
    INNER JOIN pat_rad_result e 
      ON a.id_order = e.id_order
      AND b.id_service = e.id_rad_item 
  WHERE e.id_reg = '$id' 
	AND a.order_type='6'
    ) aa;");
	return $query;
	}
	
	function save_rad_result($data_rad){
	$this->db->insert('pat_rad_result',$data_rad);
	}

	//fungsi untuk delete Delivery Address, Add by rangga 23 Feb 2016
	function delete_items($id,$data_app){
	$this->db->where('id_rad_item',$id);
	$this->db->update('mst_rad_item',$data_app);
	return $this->db->affected_rows();
	}

  function update_pat_rad_result_byid($id,$data_app){
  $this->db->where('id_rad_result',$id);
  $this->db->update('pat_rad_result',$data_app);
  return $this->db->affected_rows();
  }
}
?>