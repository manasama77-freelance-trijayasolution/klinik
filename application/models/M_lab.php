<?php
class M_lab extends CI_Model{
	
	function save_group($data_group){
	$this->db->insert('mst_lab_group',$data_group);
	}
	
	function get_list_group(){
	$this->db->where('is_active',0);
	$this->db->order_by("group_name", "asc");
	return $this->db->get('mst_lab_group');
	}
	
	function get_list_group_id($id){
	$this->db->where('id_lab_item_group',$id);
	return $this->db->get('mst_lab_group');
	}
	
	function get_item(){
	$this->db->order_by("lab_item_desc", "asc");
	return $this->db->get('mst_lab_item');
	}
	
	function get_lab_isi_data($id){
	return $this->db->get('pat_lab_result');
	$this->db->where('id_order',$id);
	}
	
	function update_group_lab($id,$data){
	$this->db->where('id_lab_item',$id);
	$this->db->update('mst_lab_item',$data);
	return $this->db->affected_rows();
	}
	
	function update_range_lab($id,$data){
	$this->db->where('id_lab_item_range',$id);
	$this->db->update('mst_lab_item_range',$data);
	return $this->db->affected_rows();
	}
	
	function update_mst_lab_group($id,$data){
	$this->db->where('id_lab_item_group',$id);
	$this->db->update('mst_lab_group',$data);
	return $this->db->affected_rows();
	}
	
	function get_list_item(){
		$this->db->select('*');
	    $this->db->from('mst_lab_item');
		$this->db->join('mst_lab_group', 'mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group', 'left');
		$this->db->order_by("lab_item_desc", "asc");
		$query = $this->db->get();
		return $query;
	}
	
  function get_list_item_aktif(){
    $this->db->select('*');
    $this->db->from('mst_lab_item');
    $this->db->join('mst_lab_group', 'mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group', 'left');
    $this->db->where('mst_lab_item.is_active', 0);
    $this->db->where('mst_lab_group.is_active', 0);
    $this->db->order_by('lab_item_desc', 'asc');
    $query = $this->db->get();
    return $query;
  }
  
  function get_list_item_id($id_item){
    $this->db->select('*');
      $this->db->from('mst_lab_item');
    $this->db->join('mst_lab_group', 'mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group', 'left');
    $this->db->where('id_lab_item', $id_item);
    $query = $this->db->get();
    return $query;
  }
  
	function get_list_range_2(){
	$this->db->select('*');
	$this->db->from('mst_lab_item');
	$this->db->join('mst_lab_group', 'mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group', 'inner');
	$this->db->join('mst_lab_item_range', 'mst_lab_item_range.id_lab_item = mst_lab_item.id_lab_item', 'inner');
	$this->db->join('mst_gender', 'mst_gender.id_gender = mst_lab_item_range.pat_gender', 'inner');
	$this->db->where('mst_lab_item_range.is_active', 0); 
	$this->db->order_by("lab_item_group", "asc");
	$this->db->order_by("lab_item_seq_no", "asc"); 
	$query = $this->db->get();
	return $query;
	}
	
	function get_range_by_id($id){
	$this->db->select('*');
	$this->db->from('mst_lab_item');
	$this->db->join('mst_lab_group', 'mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group', 'inner');
	$this->db->join('mst_lab_item_range', 'mst_lab_item_range.id_lab_item = mst_lab_item.id_lab_item', 'inner');
	$this->db->join('mst_gender', 'mst_gender.id_gender = mst_lab_item_range.pat_gender', 'inner');
	$this->db->where('id_lab_item_range', $id); 
	$query = $this->db->get();
	return $query;
	}
	
	function get_list_range(){
	$this->db->select('*');
	$this->db->from('mst_lab_item');
	$this->db->join('mst_lab_group', 'mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group', 'left');
	$this->db->join('mst_lab_item_range', 'mst_lab_item_range.id_lab_item = mst_lab_item.id_lab_item', 'left');
	$this->db->join('mst_gender', 'mst_gender.id_gender = mst_lab_item_range.pat_gender', 'left');
	$this->db->order_by("lab_item_group", "asc");
	$this->db->order_by("lab_item_seq_no", "asc"); 
	$query = $this->db->get();
	return $query;
	}
	
	function save_item($data_item){
	$this->db->insert('mst_lab_item',$data_item);
	}
	
	function save_item_range($data_item){
	$this->db->insert('mst_lab_item_range',$data_item);
	}
	
	function order_lab_h($data_lab){
	$this->db->insert('pat_order_h',$data_lab);
	}
	
  function get_lab_item(){
  $this->db->select('*');
  $this->db->from('mst_lab_item');
  $this->db->join('mst_lab_group', 'mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group', 'left');
  $this->db->order_by("lab_item_group", "asc");
  $this->db->order_by("lab_item_seq_no", "asc"); 
  $query = $this->db->get();
  return $query;
  }
  
  function get_lab_item2(){
  $this->db->distinct('order_id,serv_name,mst_services.id_service');
  $this->db->select('order_id,serv_name,mst_services.id_service');
  $this->db->from('mst_services');
  $this->db->join('mst_service_price', 'mst_service_price.id_service=mst_services.id_service', 'inner');
  $this->db->where('order_type', 1);
  $query = $this->db->get();
  return $query;
  }
  
  function get_order_pending($id){
  $this->db->distinct('pat_order_h.id_reg, order_date, pat_name, client_name, id_order, is_complete, trx_registration.reg_date');
  $this->db->select('pat_order_h.id_reg, order_date, pat_name, client_name, id_order, is_complete, trx_registration.reg_date');
  $this->db->from('pat_order_h');
  $this->db->join('pat_data','pat_data.id_pat = pat_order_h.id_pat','inner');
  $this->db->join('trx_registration','trx_registration.id_reg = pat_order_h.id_reg','inner');
  $this->db->join('mst_client','mst_client.id_Client = trx_registration.id_client','left');
  $this->db->join('pat_order_d','pat_order_d.id_order_header = pat_order_h.id_order and pat_order_d.status = 0','left');
  $this->db->join('mst_group_service_d','mst_group_service_d.id_header = pat_order_d.id_service and id_group_service=1','left');
  $this->db->where('pat_order_d.status', 0);
  // $this->db->where('id_group_service', 1);
  // $this->db->where_in('order_type', '1,14');
  $this->db->where('order_status', $id);
  $this->db->order_by('id_order', 'desc');
  $query = $this->db->get();
  return $query;
  }
  
	function get_lab_order($id){
	$query = $this->db->query("SELECT DISTINCT
  pat_order_h.id_reg, order_date, pat_name, client_name, id_order, is_complete, trx_registration.reg_date
FROM
  pat_order_h 
  INNER JOIN pat_data 
    ON pat_data.id_pat = pat_order_h.id_pat 
  INNER JOIN trx_registration 
    ON trx_registration.id_reg = pat_order_h.id_reg 
  LEFT JOIN mst_client 
    ON mst_client.id_Client = trx_registration.id_client 
  LEFT JOIN pat_order_d
    ON pat_order_d.id_order_header = pat_order_h.id_order and pat_order_d.status = '0'
  LEFT JOIN mst_group_service_d 
    ON mst_group_service_d.id_header = pat_order_d.id_service AND id_group_service='1'
WHERE (
	pat_order_d.status = '0'
	and
    order_type = '1' 
    OR order_type = '14'
    AND id_group_service='1'
  ) 
  AND order_status = '$id' 
ORDER BY id_order DESC;");
	return $query;
	}
	

  function get_lab_non_unit_range(){
  $query = $this->db->query("SELECT mst_lab_group.id_lab_item_group, mst_lab_item.id_lab_item, mst_lab_group.group_name, mst_lab_item.lab_item_desc, mst_lab_item.lab_item_unit, mst_lab_item_range.std_value, mst_lab_item_range.low_limit, mst_lab_item_range.high_limit, mst_lab_item_range.min_limit, mst_lab_item_range.max_limit, mst_lab_item_range.age_range_1, mst_lab_item_range.age_range_2, mst_lab_item_range.pat_gender FROM mst_lab_item LEFT JOIN mst_lab_group ON mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group LEFT JOIN mst_lab_item_range ON mst_lab_item.id_lab_item = mst_lab_item_range.id_lab_item LEFT JOIN ( SELECT * FROM sysparam WHERE sgroup = 'gender' ) D ON D.skey WHERE mst_lab_item.is_active = 0 AND mst_lab_group.is_active = 0 ORDER BY lab_item_desc ASC");
  return $query;
  }

	function get_lab_act_h($id){
	$this->db->select('*');
	$this->db->from('pat_order_h');
	$this->db->join('pat_data', 'pat_data.id_pat = pat_order_h.id_pat', 'inner');
	$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left');
	$this->db->join('trx_registration', 'trx_registration.id_reg = pat_order_h.id_reg', 'left');
	$this->db->join('mst_client', 'mst_client.id_client = trx_registration.id_client', 'left');
	$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot = trx_registration.id_package', 'left');
	$this->db->where('id_order',$id);
	$this->db->order_by("id_order", "desc");
	$query = $this->db->get();
	return $query;
	}
	
	function get_lab_act_h_mcu($id){
	$this->db->select('*');
	$this->db->from('pat_order_h');
	$this->db->join('pat_data', 'pat_data.id_pat = pat_order_h.id_pat', 'inner');
	$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left');
	$this->db->join('trx_registration', 'trx_registration.id_reg = pat_order_h.id_reg', 'left');
	$this->db->join('mst_client', 'mst_client.id_client = trx_registration.id_client', 'left');
	$this->db->join('mst_service_package_h', 'mst_service_package_h.id_package = trx_registration.id_package', 'left');
	$this->db->where('pat_order_h.id_reg',$id);
	$this->db->order_by("id_order", "asc");
	$query = $this->db->get();
	return $query;
	}
	
	function get_lab_act_d($id,$months,$gender){
	$query = $this->db->query("
	SELECT 
  * 
FROM
  (SELECT 
    id_order,
    id_reg,
    pat_name,
    lab_item_abbr AS lab_item_desc_1,
    mst_lab_item.id_lab_item,
	id_lab_item_range,
    mst_lab_item_range.type_lab,name_type,name_j,
	CASE WHEN std_value ='' THEN CONCAT(low_limit, ' - ' , high_limit)
    ELSE
    std_value
    END AS std_value,
	low_limit,high_limit,min_limit,max_limit,age_range_1,age_range_2,
    lab_item_group,
    lab_item_unit,
    lab_item_seq_no,
    group_name,
    lab_item_case,
    STATUS 
  FROM
    pat_order_h 
    LEFT JOIN pat_data 
      ON pat_data.id_pat = pat_order_h.id_pat 
    LEFT JOIN mst_title 
      ON mst_title.id_title = pat_data.id_title 
    LEFT JOIN pat_order_d 
      ON pat_order_d.id_order_header = pat_order_h.id_order 
    LEFT JOIN mst_group_service_d 
      ON mst_group_service_d.id_header = pat_order_d.id_service 
      AND id_group_service = '1' 
    LEFT JOIN mst_services 
      ON mst_services.id_service = mst_group_service_d.id_service 
    LEFT JOIN mst_lab_item 
      ON mst_lab_item.id_lab_item = mst_services.order_id 
    LEFT JOIN mst_lab_group 
      ON mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group 
    LEFT JOIN mst_lab_item_range 
      ON mst_lab_item_range.id_lab_item = mst_lab_item.id_lab_item 
  WHERE id_order = '$id' 
    AND pat_order_h.order_type = '14' 
    AND lab_item_desc IS NOT NULL 
  UNION
  ALL 
  SELECT 
    id_order,
    id_reg,
    pat_name,
    lab_item_abbr AS lab_item_desc,
    mst_lab_item.id_lab_item,
	id_lab_item_range,
    mst_lab_item_range.type_lab,name_type,name_j,
	CASE WHEN std_value ='' THEN CONCAT(low_limit, ' - ' , high_limit)
    ELSE
    std_value
    END AS std_value,
	low_limit,high_limit,min_limit,max_limit,age_range_1,age_range_2,
    lab_item_group,
    lab_item_unit,
    lab_item_seq_no,
    group_name,
    lab_item_case,
    STATUS 
  FROM
    pat_order_h 
    LEFT JOIN pat_data 
      ON pat_data.id_pat = pat_order_h.id_pat 
    LEFT JOIN mst_title 
      ON mst_title.id_title = pat_data.id_title 
    LEFT JOIN pat_order_d 
      ON pat_order_d.id_order_header = pat_order_h.id_order 
    LEFT JOIN mst_lab_item 
      ON mst_lab_item.id_lab_item = pat_order_d.id_service 
    LEFT JOIN mst_lab_group 
      ON mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group 
    LEFT JOIN mst_lab_item_range 
      ON mst_lab_item_range.id_lab_item = mst_lab_item.id_lab_item 
  WHERE id_order = '$id' 
    AND pat_order_h.order_type = '1' 
    AND mst_lab_item_range.pat_gender = '$gender' 
    AND '$months' BETWEEN age_range_1 
    AND age_range_2 
  UNION
  ALL 
  SELECT 
    id_order,
    id_reg,
    pat_name,
    lab_item_abbr AS lab_item_desc,
    mst_lab_item.id_lab_item,
	id_lab_item_range,
    mst_lab_item_range.type_lab,name_type,name_j,
	CASE WHEN std_value ='' THEN CONCAT(low_limit, ' - ' , high_limit)
    ELSE
    std_value
    END AS std_value,
	low_limit,high_limit,min_limit,max_limit,age_range_1,age_range_2,
    lab_item_group,
    lab_item_unit,
    lab_item_seq_no,
    group_name,
    lab_item_case,
    STATUS 
  FROM
    pat_order_h 
    LEFT JOIN pat_data 
      ON pat_data.id_pat = pat_order_h.id_pat 
    LEFT JOIN mst_title 
      ON mst_title.id_title = pat_data.id_title 
    LEFT JOIN pat_order_d 
      ON pat_order_d.id_order_header = pat_order_h.id_order 
    LEFT JOIN mst_lab_item 
      ON mst_lab_item.id_lab_item = pat_order_d.id_service 
    LEFT JOIN mst_lab_group 
      ON mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group 
    LEFT JOIN mst_lab_item_range 
      ON mst_lab_item_range.id_lab_item = mst_lab_item.id_lab_item 
  WHERE id_order = '$id' 
    AND pat_order_h.order_type = '1' 
    AND pat_order_d.id_service NOT IN 
    (SELECT 
      pat_order_d.id_service 
    FROM
      pat_order_h 
      LEFT JOIN pat_data 
        ON pat_data.id_pat = pat_order_h.id_pat 
      LEFT JOIN mst_title 
        ON mst_title.id_title = pat_data.id_title 
      LEFT JOIN pat_order_d 
        ON pat_order_d.id_order_header = pat_order_h.id_order 
      LEFT JOIN mst_lab_item 
        ON mst_lab_item.id_lab_item = pat_order_d.id_service 
      LEFT JOIN mst_lab_group 
        ON mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group 
      LEFT JOIN mst_lab_item_range 
        ON mst_lab_item_range.id_lab_item = mst_lab_item.id_lab_item 
    WHERE id_order = '$id' 
      AND pat_order_h.order_type = '1' 
      AND mst_lab_item_range.pat_gender = '$gender' 
      AND '$months' BETWEEN age_range_1 
      AND age_range_2)) AS aa 
ORDER BY group_name,
  lab_item_desc_1,
  name_type ASC ;

");
	return $query;
	}
	
	// function get_lab_act_d($id,$months,$gender){
	// $this->db->select('*');
	// $this->db->from('pat_order_h');
	// $this->db->join('pat_data', 'pat_data.id_pat = pat_order_h.id_pat', 'left');
	// $this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left');
	// $this->db->join('pat_order_d', 'pat_order_d.id_order_header = pat_order_h.id_order', 'left');
	// $this->db->join('mst_lab_item', 'mst_lab_item.id_lab_item = pat_order_d.id_service', 'left');
	// $this->db->join('mst_lab_group', 'mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group', 'left');
	// $this->db->join('mst_lab_item_range', 'mst_lab_item_range.id_lab_item = mst_lab_item.id_lab_item', 'left');
	// $this->db->where('id_order',$id);
	// $this->db->where('mst_lab_item_range.pat_gender',$gender);
	// $this->db->where("'$months' BETWEEN age_range_1 AND age_range_2");
	// $this->db->order_by("lab_item_group", "asc");
	// $this->db->order_by("lab_item_seq_no", "asc"); 
	// $query = $this->db->get();
	// $query = $this->db->query("SELECT 
  // * 
// FROM
  // pat_order_h 
  // LEFT JOIN pat_data 
    // ON pat_data.id_pat = pat_order_h.id_pat 
  // LEFT JOIN mst_title 
    // ON mst_title.id_title = pat_data.id_title 
  // LEFT JOIN pat_order_d 
    // ON pat_order_d.id_order_header = pat_order_h.id_order 
  // LEFT JOIN mst_lab_item 
    // ON mst_lab_item.id_lab_item = pat_order_d.id_service 
  // LEFT JOIN mst_lab_group 
    // ON mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group 
  // LEFT JOIN mst_lab_item_range 
    // ON mst_lab_item_range.id_lab_item = mst_lab_item.id_lab_item 
// WHERE id_order = '$id' 
  // AND mst_lab_item_range.pat_gender = '$gender' 
  // AND '$months' BETWEEN age_range_1 
  // AND age_range_2 

  // UNION ALL
  
  // SELECT 
  // * 
// FROM
  // pat_order_h 
  // LEFT JOIN pat_data 
    // ON pat_data.id_pat = pat_order_h.id_pat 
  // LEFT JOIN mst_title 
    // ON mst_title.id_title = pat_data.id_title 
  // LEFT JOIN pat_order_d 
    // ON pat_order_d.id_order_header = pat_order_h.id_order 
  // LEFT JOIN mst_lab_item 
    // ON mst_lab_item.id_lab_item = pat_order_d.id_service 
  // LEFT JOIN mst_lab_group 
    // ON mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group 
  // LEFT JOIN mst_lab_item_range 
    // ON mst_lab_item_range.id_lab_item = mst_lab_item.id_lab_item 
// WHERE id_order = '$id' 
  // AND  pat_order_d.id_service  NOT IN (SELECT 
  // pat_order_d.id_service 
// FROM
  // pat_order_h 
  // LEFT JOIN pat_data 
    // ON pat_data.id_pat = pat_order_h.id_pat 
  // LEFT JOIN mst_title 
    // ON mst_title.id_title = pat_data.id_title 
  // LEFT JOIN pat_order_d 
    // ON pat_order_d.id_order_header = pat_order_h.id_order 
  // LEFT JOIN mst_lab_item 
    // ON mst_lab_item.id_lab_item = pat_order_d.id_service 
  // LEFT JOIN mst_lab_group 
    // ON mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group 
  // LEFT JOIN mst_lab_item_range 
    // ON mst_lab_item_range.id_lab_item = mst_lab_item.id_lab_item 
// WHERE id_order = '$id' 
  // AND mst_lab_item_range.pat_gender = '$gender' 
  // AND '$months' BETWEEN age_range_1 
  // AND age_range_2 );");
	// return $query;
	// }
	
	function get_lab_act_d_rev($id){
	$query = $this->db->query("SELECT 
	group_name,
	lab_item_desc,
	ref_no,
	mst_lab_item.id_lab_item,
	lab_item_unit,
	result_value,
	pat_lab_result.is_normal,
	GROUP_CONCAT(
    '[',
    pat_lab_result_old.lab_result,
	']',
    REPLACE(
      REPLACE(
        pat_lab_result_old.is_normal,
        '1',
        '*'
      ),
      '0',
      ''
    ),
    ' ',
    DATE_FORMAT(
      pat_lab_result_old.datetime,
      '%d-%b-%y %H:%i %p'
    ),
    '' 
    ORDER BY pat_lab_result_old.id_result DESC SEPARATOR ';'
  ) rev,
  COUNT(
    pat_lab_result_old.id_lab_item
  ) count_revision 
FROM
pat_lab_result
INNER JOIN 
mst_lab_item
ON mst_lab_item.id_lab_item=pat_lab_result.id_lab_item
INNER JOIN 
mst_lab_group
ON mst_lab_group.id_lab_item_group=mst_lab_item.lab_item_group
INNER JOIN pat_lab_result_old 
    ON pat_lab_result_old.id_order = pat_lab_result.id_order 
    AND pat_lab_result.id_lab_item = pat_lab_result_old.id_lab_item
WHERE pat_lab_result.id_order = '$id' GROUP BY
pat_lab_result.id_lab_item
");
	return $query;
	}
	
	function get_lab_act_comment($id,$months,$gender){
	$this->db->distinct('id_lab_item_group,group_seq_no');
	$this->db->select('id_lab_item_group,group_seq_no');
	$this->db->from('pat_order_h');
	$this->db->join('pat_data', 'pat_data.id_pat = pat_order_h.id_pat', 'left');
	$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left');
	$this->db->join('pat_order_d', 'pat_order_d.id_order_header = pat_order_h.id_order', 'left');
	$this->db->join('mst_lab_item', 'mst_lab_item.id_lab_item = pat_order_d.id_service', 'left');
	$this->db->join('mst_lab_group', 'mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group', 'left');
	$this->db->join('mst_lab_item_range', 'mst_lab_item_range.id_lab_item = mst_lab_item.id_lab_item', 'left');
	$this->db->where('id_order',$id);
	$this->db->where('mst_lab_item_range.pat_gender',$gender);
	$this->db->where("'$months' BETWEEN age_range_1 AND age_range_2");
	$this->db->order_by("lab_item_group", "asc");
	$this->db->order_by("lab_item_seq_no", "asc"); 
	$query = $this->db->get();
	return $query;
	}
	
	function get_lab_app_d($id,$months,$gender){
	$this->db->select('*');
	$this->db->from('pat_order_h');
	$this->db->join('pat_data', 'pat_data.id_pat = pat_order_h.id_pat', 'left');
	$this->db->join('mst_title', 'mst_title.id_title = pat_data.id_title', 'left');
	$this->db->join('pat_order_d', 'pat_order_d.id_order_header = pat_order_h.id_order', 'left');
	$this->db->join('mst_lab_item', 'mst_lab_item.id_lab_item = pat_order_d.id_service', 'left');
	$this->db->join('mst_lab_group', 'mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group', 'left');
	$this->db->join('pat_lab_result', 'pat_lab_result.id_order = pat_order_h.id_order and pat_lab_result.id_lab_item = pat_order_d.id_service', 'left');
	$this->db->join('mst_lab_item_range', 'mst_lab_item_range.id_lab_item = mst_lab_item.id_lab_item', 'left');
	$this->db->where('pat_order_h.id_order',$id);
	$this->db->where('mst_lab_item_range.pat_gender',$gender);
	$this->db->where("'$months' BETWEEN age_range_1 AND age_range_2");
	//$this->db->where('is_normal',1);
	$this->db->order_by("mst_lab_item.lab_item_group", "asc");
	$this->db->order_by("lab_item_seq_no", "asc"); 
	$query = $this->db->get();
	return $query;
	}
	
	function get_lab_edit($id,$months,$gender){
	$query = $this->db->query("
	SELECT 
  pat_order_h.id_order,
  pat_order_h.id_reg,
  pat_name,
  lab_item_desc,
  mst_lab_item_range.*,
  mst_lab_item.lab_item_group,
  lab_item_unit,
  lab_item_seq_no,
  group_name,
  lab_item_case,
  STATUS,
  mst_lab_item.*,
  result_value,
  is_normal,
  id_lab_range
FROM
  pat_order_h 
  LEFT JOIN pat_data 
    ON pat_data.id_pat = pat_order_h.id_pat 
  LEFT JOIN mst_title 
    ON mst_title.id_title = pat_data.id_title 
  LEFT JOIN pat_order_d 
    ON pat_order_d.id_order_header = pat_order_h.id_order 
  LEFT JOIN mst_group_service_d 
    ON mst_group_service_d.id_header = pat_order_d.id_service 
    AND id_group_service = '1' 
  LEFT JOIN mst_services 
    ON mst_services.id_service = mst_group_service_d.id_service 
  LEFT JOIN mst_lab_item 
    ON mst_lab_item.id_lab_item = mst_services.order_id 
  LEFT JOIN mst_lab_group 
    ON mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group 
  LEFT JOIN mst_lab_item_range 
    ON mst_lab_item_range.id_lab_item = mst_lab_item.id_lab_item 
  LEFT JOIN pat_lab_result
    ON pat_lab_result.id_order=pat_order_d.id_order_header AND mst_lab_item.id_lab_item=pat_lab_result.id_lab_item
  WHERE pat_order_h.id_order = '$id' 
  AND pat_order_h.order_type = '14' 
  AND lab_item_desc IS NOT NULL 
UNION
ALL 
SELECT
DISTINCT 
  pat_order_h.id_order,
  pat_order_h.id_reg,
  pat_name,
  lab_item_desc,
  mst_lab_item_range.*,
  mst_lab_item.lab_item_group,
  lab_item_unit,
  lab_item_seq_no,
  group_name,
  lab_item_case,
  STATUS,
  mst_lab_item.* ,
  result_value,
  is_normal,
  id_lab_range
FROM
  pat_order_h 
  LEFT JOIN pat_data 
    ON pat_data.id_pat = pat_order_h.id_pat 
  LEFT JOIN mst_title 
    ON mst_title.id_title = pat_data.id_title 
  LEFT JOIN pat_order_d 
    ON pat_order_d.id_order_header = pat_order_h.id_order 
  LEFT JOIN mst_lab_item 
    ON mst_lab_item.id_lab_item = pat_order_d.id_service 
  LEFT JOIN mst_lab_group 
    ON mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group 
  LEFT JOIN mst_lab_item_range 
    ON mst_lab_item_range.id_lab_item = mst_lab_item.id_lab_item 
  LEFT JOIN pat_lab_result
    ON pat_lab_result.id_order=pat_order_d.id_order_header AND mst_lab_item.id_lab_item=pat_lab_result.id_lab_item and mst_lab_item_range.id_lab_item_range=pat_lab_result.id_lab_range
WHERE pat_order_h.id_order = '$id' 
  AND pat_order_h.order_type = '1' 
  AND mst_lab_item_range.pat_gender = '$gender' 
  AND '$months' BETWEEN age_range_1 
  AND age_range_2 
UNION
ALL 
SELECT 
  pat_order_h.id_order,
  pat_order_h.id_reg,
  pat_name,
  lab_item_desc,
  mst_lab_item_range.*,
  mst_lab_item.lab_item_group,
  lab_item_unit,
  lab_item_seq_no,
  group_name,
  lab_item_case,
  STATUS,
  mst_lab_item.* ,
  result_value,
  is_normal,
  id_lab_range
FROM
  pat_order_h 
  LEFT JOIN pat_data 
    ON pat_data.id_pat = pat_order_h.id_pat 
  LEFT JOIN mst_title 
    ON mst_title.id_title = pat_data.id_title 
  LEFT JOIN pat_order_d 
    ON pat_order_d.id_order_header = pat_order_h.id_order 
  LEFT JOIN mst_lab_item 
    ON mst_lab_item.id_lab_item = pat_order_d.id_service 
  LEFT JOIN mst_lab_group 
    ON mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group 
  LEFT JOIN mst_lab_item_range 
    ON mst_lab_item_range.id_lab_item = mst_lab_item.id_lab_item 
  LEFT JOIN pat_lab_result
    ON pat_lab_result.id_order=pat_order_d.id_order_header AND mst_lab_item.id_lab_item=pat_lab_result.id_lab_item
WHERE pat_order_h.id_order = '$id' 
  AND pat_order_h.order_type = '1' 
  AND pat_order_d.id_service NOT IN 
  (SELECT 
    pat_order_d.id_service 
  FROM
    pat_order_h 
    LEFT JOIN pat_data 
      ON pat_data.id_pat = pat_order_h.id_pat 
    LEFT JOIN mst_title 
      ON mst_title.id_title = pat_data.id_title 
    LEFT JOIN pat_order_d 
      ON pat_order_d.id_order_header = pat_order_h.id_order 
    LEFT JOIN mst_lab_item 
      ON mst_lab_item.id_lab_item = pat_order_d.id_service 
    LEFT JOIN mst_lab_group 
      ON mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group 
    LEFT JOIN mst_lab_item_range 
      ON mst_lab_item_range.id_lab_item = mst_lab_item.id_lab_item 
    LEFT JOIN pat_lab_result
      ON pat_lab_result.id_order=pat_order_d.id_order_header AND mst_lab_item.id_lab_item=pat_lab_result.id_lab_item
  WHERE pat_order_h.id_order = '$id' 
    AND pat_order_h.order_type = '1' 
    AND mst_lab_item_range.pat_gender = '$gender' 
    AND '$months' BETWEEN age_range_1 
    AND age_range_2);
	");
	return $query;
	}
	
	function get_lab_result($id){
	$this->db->from('pat_lab_result');
	//$this->db->join('pat_order_d', 'pat_order_d.id_order_header = pat_lab_result.id_order and pat_order_d.id_service = pat_lab_result.id_lab_item', 'left');
	$this->db->join('mst_lab_item', 'mst_lab_item.id_lab_item = pat_lab_result.id_lab_item', 'left');
	$this->db->join('mst_lab_group', 'mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group', 'left');
	$this->db->where('pat_lab_result.id_order',$id);
	$this->db->order_by("mst_lab_group.group_name", "asc");
	$this->db->order_by("pat_lab_result.name_type", "asc");
	$query = $this->db->get();
	return $query;
	}
	
	function get_lab_result_mcu($id){
	$this->db->select('*');
	$this->db->from('pat_lab_result');
	$this->db->join('pat_order_d', 'pat_order_d.id_order_header = pat_lab_result.id_order and pat_order_d.id_service = pat_lab_result.id_lab_item', 'inner');
	$this->db->join('mst_lab_item', 'mst_lab_item.id_lab_item = pat_order_d.id_service', 'left');
	$this->db->join('mst_lab_group', 'mst_lab_group.id_lab_item_group = mst_lab_item.lab_item_group', 'left');
	$this->db->where('pat_lab_result.id_reg',$id);
	$this->db->order_by("mst_lab_group.group_name", "asc");
	$this->db->order_by("pat_lab_result.name_type", "asc");
	$query = $this->db->get();
	return $query;
	}
	
	function status_order($data_process,$id){
	$this->db->where('id_order',$id);
	$this->db->update('pat_order_h',$data_process);
  return $this->db->affected_rows();
	}
	
	//ini untuk memasukkan kedalam tabel pegawai
    function loaddata($dataarray) {
        for ($i = 0; $i < count($dataarray); $i++) {
            $data = array(
                'id_lab_item' 	=> $dataarray[$i]['id_lab_item'],
                'low_limit' 	=> $dataarray[$i]['low_limit'],
                'high_limit' 	=> $dataarray[$i]['high_limit'],
                'min_limit' 	=> $dataarray[$i]['min_limit'],
                'max_limit' 	=> $dataarray[$i]['max_limit'],
                'age_range_1' 	=> $dataarray[$i]['age_range_1'],
                'age_range_2' 	=> $dataarray[$i]['age_range_2'],
                'pat_gender' 	=> $dataarray[$i]['pat_gender']
            );
            //ini untuk menambahkan apakah dalam tabel sudah ada data yang sama
            //apabila data sudah ada maka data di-skip
            // saya contohkan kalau ada data nama yang sama maka data tidak dimasukkan
            $this->db->where('id_lab_item', $this->input->post('id_lab_item'));            
            if ($cek) {
                $this->db->insert('mst_lab_item_range', $data);
            }
        }
	}
}
?>