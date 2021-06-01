<?php
class M_quotation extends CI_Model
{

	function get_list_client()
	{
		return $this->db->get('mst_client');
	}

	function delete_mkt_d($ids)
	{
		$this->db->where('id_quot_header', $ids);
		$this->db->delete('mkt_quotation_d');
	}

	function save_quot_h($data_quot)
	{
		$this->db->insert('mkt_quotation_h', $data_quot);
	}

	function get_mst_service_package_h()
	{
		$this->db->from('mst_service_package_h');
		$query = $this->db->get();
		return $query;
	}

	function get_max_id_package()
	{
		$this->db->select_max('id_package');
		$this->db->from('mst_service_package_h');
		$this->db->where('status', 0);
		$query = $this->db->get();
		return $query;
	}

	function get_mst_service_package_h2($id_client, $package_name)
	{
		$this->db->from('mst_service_package_h');
		$this->db->where('id_client', $id_client);
		$this->db->where('package_name', $package_name);
		$this->db->where('status', 0);
		$query = $this->db->get();
		return $query;
	}

	function get_list_service_package_detail($id_package)
	{
		$this->db->select('mst_service_package_d.id_package_detail, mst_service_package_d.id_package_header, mst_service_package_d.id_service, mst_service_package_d.seq_no, mst_service_package_d.order_id, mst_service_package_d.order_type, mst_service_package_d.service_name, mst_service_package_d.group_name, mst_service_package_d.price, mst_services.id_group_serv, mst_services.serv_seq_no, mst_services.coa, mst_services.serv_name, mst_services.serv_name_j, mst_services.serv_type, mst_services.serv_code, mst_service_price.id_price, mst_service_price.id_branch, mst_service_price.price_type, mst_service_price.Currency, mst_service_price.Price AS harga');
		$this->db->from('mst_service_package_d');
		$this->db->join('mst_services', 'mst_service_package_d.id_service=mst_services.id_service', 'left');
		$this->db->join('mst_service_price', 'mst_services.id_service=mst_service_price.id_service AND mst_service_price.price_type=1', 'left');
		$this->db->where('id_package_header', $id_package);
		$this->db->where('status', 0);
		$query = $this->db->get();
		return $query;
	}

	function get_list_tmp_service_price($id_service, $id_group)
	{
		$this->db->from('tmp_mst_service_price');
		$this->db->where('id_service', $id_service);
		$this->db->where('id_group', $id_group);
		$query = $this->db->get();
		return $query;
	}

	function get_list_sales_contract($id)
	{
		$this->db->from('mkt_sales_contract');
		$this->db->join('mkt_quotation_h', 'mkt_quotation_h.id_quot = mkt_sales_contract.id_quot', 'left');
		$this->db->join('mst_client', 'mst_client.id_Client = mkt_quotation_h.client_id', 'left');
		$this->db->where('id_mkt', $id);
		$query = $this->db->get();
		return $query;
	}

	function get_list_group()
	{
		$this->db->from('mst_group_service_h');
		$this->db->join('mst_user', 'mst_user.id = mst_group_service_h.create_by', 'inner');
		$query = $this->db->get();
		return $query;
	}

	function get_data_update_sc($id)
	{
		$this->db->from('mkt_sales_contract');
		$this->db->join('mkt_quotation_h', 'mkt_quotation_h.id_quot = mkt_sales_contract.id_quot', 'left');
		$this->db->join('mst_client', 'mst_client.id_Client = mkt_quotation_h.client_id', 'left');
		$this->db->where('id_sc', $id);
		$query = $this->db->get();
		return $query;
	}

	function get_list_services_quot($id_package)
	{
		$query = $this->db->query("select A.*,B.*,ifnull(C.serv_name,service_other) serv_name,D.group_desc,before_tax,service_tax
			from mkt_quotation_h A
			inner join mkt_quotation_d B on A.id_quot=B.id_quot_header
			left join mst_services C on B.service_id=C.id_service
			left join mst_service_group D on B.group_service=D.id_serv_group
			where A.id_quot=$id_package and status=0 order by group_seq_no asc;");
		return $query;
	}

	function get_list_service_package()
	{
		$this->db->from('mst_service_package_h');
		$this->db->join('mst_client', 'mst_service_package_h.id_client=mst_client.id_Client', 'inner');
		$this->db->where('mst_service_package_h.status', 0);
		$query = $this->db->get();
		return $query;
	}

	function get_service_price($id)
	{
		$this->db->from('mst_service_price');
		$this->db->where('id_price', $id);
		$query = $this->db->get();
		return $query;
	}

	function get_mst_client_package_h()
	{
		$this->db->from('mst_client');
		$this->db->join('mst_service_package_h', 'mst_client.id_Client=mst_service_package_h.id_client', 'inner');
		$this->db->where('mst_client.status', 0);
		$this->db->order_by('client_name', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function get_mst_client_package_h2($id_package)
	{
		$this->db->from('mst_service_package_h');
		$this->db->join('mst_client', 'mst_service_package_h.id_client=mst_client.id_Client', 'inner');
		$this->db->where('mst_service_package_h.id_package', $id_package);
		$query = $this->db->get();
		return $query;
	}

	function get_service_price_temp($id)
	{
		$this->db->from('mst_service_price_temp');
		$this->db->where('source', $id);
		$query = $this->db->get();
		return $query;
	}

	function get_service_join_group($id)
	{
		$this->db->from('mst_services');
		$this->db->join('mst_service_group', 'mst_services.id_group_serv=mst_service_group.id_serv_group', 'left');
		$this->db->where('id_service', $id);
		$query = $this->db->get();
		return $query;
	}

	function get_service($id)
	{
		$this->db->from('mst_services');
		$this->db->where('id_service', $id);
		$query = $this->db->get();
		return $query;
	}

	function get_list_quot($id)
	{
		$this->db->select('*,DATEDIFF(quot_date_end,NOW()) AS sisa');
		$this->db->from('mkt_quotation_h');
		$this->db->join('(select * from sysparam where sgroup="is_finalised" and remark="mkt_quotation_h") a', 'a.skey = mkt_quotation_h.is_finalised', 'inner');
		$this->db->join('mkt_order_form_h', 'mkt_order_form_h.quot_id = mkt_quotation_h.id_quot', 'left');
		$this->db->where('mkt_quotation_h.mkt_id', $id);
		$query = $this->db->get();
		return $query;
	}

	function get_list_quot_all($id)
	{
		$this->db->select('*,DATEDIFF(quot_date_end,NOW()) AS sisa');
		$this->db->from('mkt_quotation_h');
		$this->db->join('(select * from sysparam where sgroup="is_finalised" and remark="mkt_quotation_h") a', 'a.skey = mkt_quotation_h.is_finalised', 'inner');
		$this->db->join('mkt_order_form_h', 'mkt_order_form_h.quot_id = mkt_quotation_h.id_quot', 'left');
		$this->db->join('mst_user', 'mkt_quotation_h.mkt_id = mst_user.id', 'left');
		$this->db->where('mkt_quotation_h.is_finalised', $id);
		$this->db->order_by('quot_date_create', 'desc');
		$query = $this->db->get();
		return $query;
	}

	function get_list_quot_all2()
	{
		$this->db->select('*,DATEDIFF(quot_date_end,NOW()) AS sisa');
		$this->db->from('mkt_quotation_h');
		$this->db->join('(select * from sysparam where sgroup="is_finalised" and remark="mkt_quotation_h") a', 'a.skey = mkt_quotation_h.is_finalised', 'inner');
		$this->db->join('mkt_order_form_h', 'mkt_order_form_h.quot_id = mkt_quotation_h.id_quot', 'left');
		$this->db->join('mst_user', 'mkt_quotation_h.mkt_id = mst_user.id', 'left');
		$this->db->order_by('quot_date_create', 'desc');
		$query = $this->db->get();
		return $query;
	}

	function get_list_quot_app($id)
	{
		$query = $this->db->query("SELECT 
  *,DATEDIFF(quot_date_end,NOW()) AS sisa 
FROM
  `mkt_quotation_h` 
  INNER JOIN 
    (SELECT 
      * 
    FROM
      sysparam 
    WHERE sgroup = 'is_finalised' 
      AND remark = 'mkt_quotation_h') a 
    ON `a`.`skey` = `mkt_quotation_h`.`is_finalised` 
  INNER JOIN `mst_user` 
    ON `mst_user`.`id` = `mkt_quotation_h`.`mkt_id` 
WHERE `atasan_1` = '$id' ;");
		return $query;
	}

	function get_list_lab()
	{
		$this->db->from('mst_lab_group');
		$this->db->where('is_active', 0);
		$this->db->order_by("group_name", "asc");
		$query = $this->db->get();
		return $query;
	}

	function get_list_rad()
	{
		$this->db->from('mst_rad_group');
		$this->db->order_by("group_desc", "asc");
		$this->db->where('is_active', 0);
		$query = $this->db->get();
		return $query;
	}

	function get_list_service_package_byID($id_package)
	{
		$this->db->from('mst_service_package_h');
		$this->db->where('status', 0);
		$this->db->where('id_package', $id_package);
		$query = $this->db->get();
		return $query;
	}

	function get_data_header($id_package)
	{
		$this->db->from('mkt_quotation_h');
		$this->db->join('mst_client', 'mst_client.id_Client = mkt_quotation_h.client_id', 'inner');
		$this->db->join('mst_user', 'mst_user.id = mkt_quotation_h.mkt_id', 'inner');
		$this->db->where('id_quot', $id_package);
		$query = $this->db->get();
		return $query;
	}

	function get_data_notes($id_package)
	{
		$this->db->from('mkt_quotation_h');
		$this->db->join('mst_client', 'mst_client.id_Client = mkt_quotation_h.client_id', 'inner');
		$this->db->join('mst_user', 'mst_user.id = mkt_quotation_h.approved_by', 'inner');
		$this->db->where('id_quot', $id_package);
		$query = $this->db->get();
		return $query;
	}

	function get_data_detail($id_package)
	{
		$query = $this->db->query("SELECT 
		*,
		ifnull(serv_name,service_other) serv_name,service_tax
		FROM
		`mkt_quotation_d` 
		inner JOIN `mst_service_group` 
			ON `mst_service_group`.`id_serv_group` = `mkt_quotation_d`.`group_service` 
		LEFT JOIN `mst_services` 
			ON `mst_services`.`id_service` = `mkt_quotation_d`.`service_id` 
		WHERE `id_quot_header` = '$id_package' and status='0' order by id_serv_group, group_header, serv_name asc;");
		return $query;
	}

	function get_list_services_lab()
	{
		//AND id_price_type = '2' Edit ini 2016 Desember
		$query = $this->db->query("SELECT * FROM (
	SELECT DISTINCT id_lab_item AS id,'Pemeriksaan Lab' as group_name,c.serv_name,c.order_id,c.id_service,a.lab_item_seq_no AS serv_seq_no,'2' AS KET, order_type, currency, id_group_serv
	FROM mst_lab_item a
	LEFT JOIN mst_lab_group b ON a.lab_item_group=b.id_lab_item_group
	LEFT JOIN (SELECT * FROM mst_services WHERE order_type=1) c ON a.id_lab_item=c.order_id
	LEFT JOIN mst_service_price d ON c.id_service=d.id_service
	LEFT JOIN mst_price_type e ON d.price_type=e.id_price_type
	WHERE id_price_type<>'6'
	UNION ALL
	SELECT DISTINCT id_rad_group,'Pemeriksaan Radiologi' as group_desc,c.serv_name,c.order_id,c.id_service,a.seq_no,'3' AS KET, order_type, currency, id_group_serv	
	FROM mst_rad_item a
	LEFT JOIN mst_rad_group b  ON a.rad_item_group=b.id_rad_group
	LEFT JOIN (SELECT * FROM mst_services WHERE order_type=2) c ON a.id_rad_item=c.order_id
	LEFT JOIN mst_service_price d ON c.id_service=d.id_service
	LEFT JOIN mst_price_type e ON d.price_type=e.id_price_type
	WHERE id_price_type<>'6'
    UNION ALL
    SELECT a.id_service,group_desc,serv_name,order_id,a.id_service,serv_seq_no,id_group_serv AS KET, id_group_serv, currency, id_group_serv
    FROM mst_services a 
    LEFT JOIN mst_service_price b ON a.id_service=b.id_service 
    LEFT JOIN mst_price_type c ON b.price_type=c.id_price_type  
	LEFT JOIN mst_service_group d ON a.id_group_serv=d.id_serv_group 
    WHERE order_type=0 AND id_price_type<>'6'
	) xyz ORDER BY id_group_serv,serv_name ASC;");
		return $query;
	}

	function get_list_services_lab_group()
	{
		//AND id_price_type = '2' Edit ini 2016 Desember
		$query = $this->db->query("SELECT DISTINCT * FROM (
	SELECT DISTINCT id_lab_item AS id,'Pemeriksaan Lab' as group_name,c.serv_name,c.order_id,c.id_service,a.lab_item_seq_no AS serv_seq_no,'2' AS KET, order_type, currency, id_group_serv
	FROM mst_lab_item a
	LEFT JOIN mst_lab_group b ON a.lab_item_group=b.id_lab_item_group
	LEFT JOIN (SELECT * FROM mst_services WHERE order_type=1) c ON a.id_lab_item=c.order_id
	LEFT JOIN mst_service_price d ON c.id_service=d.id_service
	LEFT JOIN mst_price_type e ON d.price_type=e.id_price_type
	WHERE id_price_type<>'6'
	UNION ALL
	SELECT DISTINCT id_rad_group,'Pemeriksaan Radiologi' as group_desc,c.serv_name,c.order_id,c.id_service,a.seq_no,'3' AS KET, order_type, currency, id_group_serv	
	FROM mst_rad_item a
	LEFT JOIN mst_rad_group b  ON a.rad_item_group=b.id_rad_group
	LEFT JOIN (SELECT * FROM mst_services WHERE order_type=2) c ON a.id_rad_item=c.order_id
	LEFT JOIN mst_service_price d ON c.id_service=d.id_service
	LEFT JOIN mst_price_type e ON d.price_type=e.id_price_type
	WHERE id_price_type<>'6'
    UNION ALL
    SELECT DISTINCT a.id_service,group_desc,serv_name,order_id,a.id_service,serv_seq_no,id_group_serv AS KET, id_group_serv, currency, id_group_serv
    FROM mst_services a 
    LEFT JOIN mst_service_price b ON a.id_service=b.id_service 
    LEFT JOIN mst_price_type c ON b.price_type=c.id_price_type  
	LEFT JOIN mst_service_group d ON a.id_group_serv=d.id_serv_group 
    WHERE order_type=0 AND id_price_type<>'6'
	) xyz ORDER BY id_group_serv,serv_name ASC;");
		return $query;
	}

	function get_list_services_2($id)
	{
		//AND id_price_type = '2' Edit ini 2016 Desember
		$query = $this->db->query("SELECT * FROM mst_services a LEFT JOIN mst_service_group d ON a.id_group_serv=d.id_serv_group 
    WHERE id_group_serv ='$id' ;");
		return $query;
	}

	function copy_data_tmp_service_price()
	{
		$query = $this->db->query("INSERT INTO tmp_mst_service_price ( id_group, group_name, serv_name, order_id, id_service, serv_seq_no, ket, price, id_price_type, price_type, order_type, currency, id_price ) SELECT * FROM ( SELECT DISTINCT IFNULL(id_lab_item, 0) AS id, 'Pemeriksaan Lab' AS group_name, c.serv_name, c.order_id, c.id_service, a.lab_item_seq_no AS serv_seq_no, '2' AS KET, price, e.id_price_type, e.price_type, order_type, currency, d.id_price FROM mst_lab_item a LEFT JOIN mst_lab_group b ON a.lab_item_group = b.id_lab_item_group LEFT JOIN ( SELECT * FROM mst_services WHERE order_type = 1 ) c ON a.id_lab_item = c.order_id LEFT JOIN mst_service_price d ON c.id_service = d.id_service LEFT JOIN mst_price_type e ON d.price_type = e.id_price_type WHERE d.is_active = 0 UNION ALL SELECT DISTINCT IFNULL(id_rad_group, 0), 'Pemeriksaan Radiologi' AS group_desc, c.serv_name, c.order_id, c.id_service, a.seq_no, '3' AS KET, price, e.id_price_type, e.price_type, order_type, currency, d.id_price FROM mst_rad_item a LEFT JOIN mst_rad_group b ON a.rad_item_group = b.id_rad_group LEFT JOIN ( SELECT * FROM mst_services WHERE order_type = 2 ) c ON a.id_rad_item = c.order_id LEFT JOIN mst_service_price d ON c.id_service = d.id_service LEFT JOIN mst_price_type e ON d.price_type = e.id_price_type WHERE d.is_active = 0 UNION ALL SELECT IFNULL(d.id_serv_group, 0), group_desc, serv_name, order_id, a.id_service, serv_seq_no, id_group_serv AS KET, price, c.id_price_type, c.price_type, id_group_serv, currency, b.id_price FROM mst_services a LEFT JOIN mst_service_price b ON a.id_service = b.id_service LEFT JOIN mst_price_type c ON b.price_type = c.id_price_type LEFT JOIN mst_service_group d ON a.id_group_serv = d.id_serv_group WHERE order_type = 0 AND b.is_active = 0 ) xyz WHERE price <> '0' ORDER BY serv_name ASC;");
		return $query;
	}

	function group_tmp_service_price()
	{
		$this->db->select('tmp_mst_service_price.id_group, tmp_mst_service_price.group_name, tmp_mst_service_price.id_service, tmp_mst_service_price.serv_name, COUNT( tmp_mst_service_price.urutan ) AS JML');
		$this->db->from('tmp_mst_service_price');
		$this->db->group_by('tmp_mst_service_price.id_group, tmp_mst_service_price.group_name, tmp_mst_service_price.id_service, tmp_mst_service_price.serv_name');
		$query = $this->db->get();
		return $query;
	}

	function group_tmp_service_price2($jml)
	{
		$query = $this->db->query("SELECT `tmp_mst_service_price`.`id_group`, `tmp_mst_service_price`.`group_name`, `tmp_mst_service_price`.`id_service`, `tmp_mst_service_price`.`serv_name`, COUNT(tmp_mst_service_price.urutan ) AS JML FROM `tmp_mst_service_price` GROUP BY `tmp_mst_service_price`.`id_group`, `tmp_mst_service_price`.`group_name`, `tmp_mst_service_price`.`id_service`, `tmp_mst_service_price`.`serv_name` HAVING COUNT(tmp_mst_service_price.urutan ) = $jml ");
		return $query;
	}

	function get_list_jml_tmpserviceprice()
	{
		$query = $this->db->query("SELECT DISTINCT JML FROM ( SELECT tmp_mst_service_price.id_group, tmp_mst_service_price.group_name, tmp_mst_service_price.id_service, tmp_mst_service_price.serv_name, COUNT( tmp_mst_service_price.urutan ) AS JML FROM `tmp_mst_service_price` GROUP BY tmp_mst_service_price.id_group, tmp_mst_service_price.group_name, tmp_mst_service_price.id_service, tmp_mst_service_price.serv_name ) A");
		return $query;
	}

	function get_list_services2()
	{
		$query = $this->db->query("SELECT * FROM ( SELECT DISTINCT a.id_lab_item AS id, 'Lab Exam.' AS group_name, serv_name, GROUP_CONCAT( DISTINCT f.name_type ORDER BY id_lab_item_range, name_type ASC ) AS detail, type_lab, c.order_id, c.id_service, a.lab_item_seq_no AS serv_seq_no, '2' AS KET, price, e.price_type, order_type, currency, d.update_date FROM mst_lab_item a LEFT JOIN mst_lab_group b ON a.lab_item_group = b.id_lab_item_group LEFT JOIN mst_lab_item_range f ON f.id_lab_item = a.id_lab_item AND f.pat_gender = '1' LEFT JOIN ( SELECT * FROM mst_services WHERE order_type = 1 ) c ON a.id_lab_item = c.order_id LEFT JOIN mst_service_price d ON c.id_service = d.id_service LEFT JOIN mst_price_type e ON d.price_type = e.id_price_type WHERE id_price_type = '1' GROUP BY a.id_lab_item, e.price_type UNION ALL SELECT DISTINCT id_rad_group, 'Radiology Exam.' AS group_desc, c.serv_name, '-' AS name_type, '-' AS type_lab, c.order_id, c.id_service, a.seq_no, '3' AS KET, price, e.price_type, order_type, currency, d.update_date FROM mst_rad_item a LEFT JOIN mst_rad_group b ON a.rad_item_group = b.id_rad_group LEFT JOIN ( SELECT * FROM mst_services WHERE order_type = 2 ) c ON a.id_rad_item = c.order_id LEFT JOIN mst_service_price d ON c.id_service = d.id_service LEFT JOIN mst_price_type e ON d.price_type = e.id_price_type WHERE id_price_type = '1' UNION ALL SELECT a.id_service, group_desc, serv_name, '-' AS name_type, '-' AS type_lab, order_id, a.id_service, serv_seq_no, id_group_serv AS KET, price, c.price_type, id_group_serv, currency, b.update_date FROM mst_services a LEFT JOIN mst_service_price b ON a.id_service = b.id_service LEFT JOIN mst_price_type c ON b.price_type = c.id_price_type LEFT JOIN mst_service_group d ON a.id_group_serv = d.id_serv_group WHERE order_type NOT IN (1, 2) AND id_price_type = '1' ) xyz ORDER BY serv_name ASC;");
		return $query;
	}

	function get_list_services($id)
	{
		//AND id_price_type = '2' Edit ini 2016 Desember
		$query = $this->db->query("SELECT * FROM (
	SELECT DISTINCT a.id_lab_item AS id,'Pemeriksaan Lab' AS group_name,serv_name,GROUP_CONCAT(DISTINCT f.name_type ORDER BY id_lab_item_range, name_type ASC) AS detail, type_lab,
    c.order_id,c.id_service,a.lab_item_seq_no AS serv_seq_no,'2' AS KET, price, e.price_type,order_type, currency, d.update_date
	FROM mst_lab_item a
	LEFT JOIN mst_lab_group b ON a.lab_item_group=b.id_lab_item_group
	LEFT JOIN mst_lab_item_range f ON f.id_lab_item=a.id_lab_item and f.pat_gender='1'
	LEFT JOIN (SELECT * FROM mst_services WHERE order_type=1) c ON a.id_lab_item=c.order_id
	LEFT JOIN mst_service_price d ON c.id_service=d.id_service
	LEFT JOIN mst_price_type e ON d.price_type=e.id_price_type
	WHERE id_price_type='1'
	GROUP BY a.id_lab_item,e.price_type
	UNION ALL
	SELECT DISTINCT id_rad_group,'Pemeriksaan Radiologi' as group_desc,c.serv_name,'-' as name_type,'-' as type_lab, c.order_id,c.id_service,a.seq_no,'3' AS KET, price, e.price_type,order_type, currency, d.update_date
	FROM mst_rad_item a
	LEFT JOIN mst_rad_group b  ON a.rad_item_group=b.id_rad_group
	LEFT JOIN (SELECT * FROM mst_services WHERE order_type=2) c ON a.id_rad_item=c.order_id
	LEFT JOIN mst_service_price d ON c.id_service=d.id_service
	LEFT JOIN mst_price_type e ON d.price_type=e.id_price_type
	WHERE id_price_type='1'
    UNION ALL
    SELECT a.id_service,group_desc,serv_name,'-' as name_type,'-' as type_lab, order_id,a.id_service,serv_seq_no,id_group_serv AS KET, price, c.price_type, id_group_serv, currency, b.update_date
    FROM mst_services a 
    LEFT JOIN mst_service_price b ON a.id_service=b.id_service 
    LEFT JOIN mst_price_type c ON b.price_type=c.id_price_type  
	LEFT JOIN mst_service_group d ON a.id_group_serv=d.id_serv_group 
    WHERE order_type=0 AND id_price_type='1'
    UNION ALL
    SELECT a.id_service,group_desc,serv_name,'-' as name_type,'-' as type_lab, order_id,a.id_service,serv_seq_no,id_group_serv AS KET, price, c.price_type, id_group_serv, currency, b.update_date
    FROM mst_services a 
    LEFT JOIN mst_service_price b ON a.id_service=b.id_service 
    LEFT JOIN mst_price_type c ON b.price_type=c.id_price_type  
	LEFT JOIN mst_service_group d ON a.id_group_serv=d.id_serv_group 
    WHERE order_type NOT IN (0, 1, 2) AND id_price_type='1'
	) xyz where order_type='$id' ORDER BY serv_name ASC;");
		return $query;
	}

	function get_list_services_lab_q($id, $group)
	{ //========== Note : saya rangga membuat ini untuk group lab pada qoutation.
		$query = $this->db->query("SELECT * FROM ( SELECT DISTINCT a.id_lab_item AS id, 'Pemeriksaan Lab' AS group_name, serv_name, GROUP_CONCAT( DISTINCT f.name_type ORDER BY id_lab_item_range, name_type ASC ) AS detail, type_lab, c.order_id, c.id_service, a.lab_item_seq_no AS serv_seq_no, '2' AS KET, price, e.price_type, order_type, currency, a.lab_item_group, d.update_date FROM mst_lab_item a LEFT JOIN mst_lab_group b ON a.lab_item_group = b.id_lab_item_group LEFT JOIN mst_lab_item_range f ON f.id_lab_item = a.id_lab_item AND f.pat_gender = '1' LEFT JOIN ( SELECT * FROM mst_services WHERE order_type = 1 ) c ON a.id_lab_item = c.order_id LEFT JOIN mst_service_price d ON c.id_service = d.id_service LEFT JOIN mst_price_type e ON d.price_type = e.id_price_type WHERE id_price_type = '1' GROUP BY a.id_lab_item, e.price_type UNION ALL SELECT a.id_service, group_desc, serv_name, '-' AS name_type, '-' AS type_lab, order_id, a.id_service, serv_seq_no, id_group_serv AS KET, price, c.price_type, id_group_serv, currency, 'services' AS lab_item_group, b.update_date FROM mst_services a LEFT JOIN mst_service_price b ON a.id_service = b.id_service LEFT JOIN mst_price_type c ON b.price_type = c.id_price_type LEFT JOIN mst_service_group d ON a.id_group_serv = d.id_serv_group WHERE order_type = 0 AND id_price_type = '1' ) xyz WHERE order_type = '$id' AND lab_item_group = '$group' ORDER BY serv_name ASC;");
		return $query;
	}

	function get_list_services_rad_q($id, $group)
	{ //========== Note : saya rangga membuat ini untuk group Radiology pada qoutation.
		$query = $this->db->query("SELECT * FROM ( SELECT DISTINCT id_rad_item, b.group_desc, c.serv_name, '-' AS name_type, '-' AS type_lab, c.order_id, c.id_service, a.seq_no, '3' AS KET, price, e.price_type, order_type, currency, id_rad_group, d.update_date FROM mst_rad_item a LEFT JOIN mst_rad_group b ON a.rad_item_group = b.id_rad_group LEFT JOIN ( SELECT * FROM mst_services WHERE order_type = 2 ) c ON a.id_rad_item = c.order_id LEFT JOIN mst_service_price d ON c.id_service = d.id_service LEFT JOIN mst_price_type e ON d.price_type = e.id_price_type WHERE id_price_type = '1' UNION ALL SELECT a.id_service, group_desc, serv_name, '-' AS name_type, '-' AS type_lab, order_id, a.id_service, serv_seq_no, id_group_serv AS KET, price, c.price_type, id_group_serv, currency, '0' AS id_rad_group, b.update_date FROM mst_services a LEFT JOIN mst_service_price b ON a.id_service = b.id_service LEFT JOIN mst_price_type c ON b.price_type = c.id_price_type LEFT JOIN mst_service_group d ON a.id_group_serv = d.id_serv_group WHERE order_type = 0 AND id_price_type = '1' )  xyz WHERE order_type='$id' AND id_rad_group='$group' ORDER BY serv_name ASC;");
		return $query;
	}

	function get_list_services_alln()
	{
		$query = $this->db->query("SELECT * FROM (
	SELECT DISTINCT id_lab_item AS id,'Pemeriksaan Lab' as group_name,c.serv_name,c.order_id,c.id_service,a.lab_item_seq_no AS serv_seq_no,'2' AS KET, price, e.price_type,order_type, currency
	FROM mst_lab_item a
	LEFT JOIN mst_lab_group b ON a.lab_item_group=b.id_lab_item_group
	LEFT JOIN (SELECT * FROM mst_services WHERE order_type=1) c ON a.id_lab_item=c.order_id
	LEFT JOIN mst_service_price d ON c.id_service=d.id_service
	LEFT JOIN mst_price_type e ON d.price_type=e.id_price_type
	UNION ALL
	SELECT DISTINCT id_rad_group,'Pemeriksaan Radiologi' as group_desc,c.serv_name,c.order_id,c.id_service,a.seq_no,'3' AS KET, price, e.price_type,order_type, currency	
	FROM mst_rad_item a
	LEFT JOIN mst_rad_group b  ON a.rad_item_group=b.id_rad_group
	LEFT JOIN (SELECT * FROM mst_services WHERE order_type=2) c ON a.id_rad_item=c.order_id
	LEFT JOIN mst_service_price d ON c.id_service=d.id_service
	LEFT JOIN mst_price_type e ON d.price_type=e.id_price_type
    UNION ALL
    SELECT a.id_service,group_desc,serv_name,order_id,a.id_service,serv_seq_no,id_group_serv AS KET, price, c.price_type, id_group_serv, currency
    FROM mst_services a 
    LEFT JOIN mst_service_price b ON a.id_service=b.id_service 
    LEFT JOIN mst_price_type c ON b.price_type=c.id_price_type  
	LEFT JOIN mst_service_group d ON a.id_group_serv=d.id_serv_group 
    WHERE order_type=0
	) xyz  where price<>'0' ORDER BY serv_name ASC;");
		return $query;
	}

	function get_list_services_all()
	{
		$query = $this->db->query("SELECT * FROM ( SELECT DISTINCT id_lab_item AS id, 'Laboratory' AS group_item_name, group_name, c.serv_name, c.order_id, c.id_service, a.lab_item_seq_no AS serv_seq_no, '2' AS KET, price, e.price_type, order_type, currency, d.id_price AS dodol, d.code_service FROM mst_lab_item a LEFT JOIN mst_lab_group b ON a.lab_item_group = b.id_lab_item_group INNER JOIN ( SELECT * FROM mst_services WHERE order_type = 1 AND is_active = 0 ) c ON a.id_lab_item = c.order_id LEFT JOIN mst_service_price d ON c.id_service = d.id_service LEFT JOIN mst_price_type e ON d.price_type = e.id_price_type WHERE d.is_active = 0 UNION ALL SELECT DISTINCT id_rad_item, 'Radiology' AS group_item_name, group_desc, c.serv_name, c.order_id, c.id_service, a.seq_no, '3' AS KET, price, e.price_type, order_type, currency, d.id_price AS dodol, d.code_service FROM mst_rad_item a LEFT JOIN mst_rad_group b ON a.rad_item_group = b.id_rad_group INNER JOIN ( SELECT * FROM mst_services WHERE order_type = 2 AND is_active = 0 ) c ON a.id_rad_item = c.order_id LEFT JOIN mst_service_price d ON c.id_service = d.id_service LEFT JOIN mst_price_type e ON d.price_type = e.id_price_type WHERE d.is_active = 0 UNION ALL SELECT a.id_service, 'Pemeriksaan Fisik' AS group_item_name, 'Pemeriksaan Fisik' AS group_desc, serv_name, order_id, a.id_service, serv_seq_no, '1' AS KET, price, c.price_type, order_type, currency, b.id_price AS dodol, b.code_service FROM mst_services a LEFT JOIN mst_service_price b ON a.id_service = b.id_service LEFT JOIN mst_price_type c ON b.price_type = c.id_price_type WHERE order_type NOT IN (1, 2) AND a.is_active = 0 AND b.is_active = 0 UNION ALL SELECT a.id_service, d.group_desc AS group_item_name, 'Other' AS group_desc, serv_name, order_id, a.id_service, serv_seq_no, '1' AS KET, price, c.price_type, order_type, currency, b.id_price AS dodol, b.code_service FROM mst_services a LEFT JOIN mst_service_group d ON a.id_group_serv = d.id_serv_group LEFT JOIN mst_service_price b ON a.id_service = b.id_service LEFT JOIN mst_price_type c ON b.price_type = c.id_price_type WHERE order_type NOT IN (0, 1, 2) AND a.is_active = 0 AND b.is_active = 0 ) xyz ORDER BY code_service ASC, group_name ASC;");
		return $query;
	}

	function get_list_services_allX()
	{
		$query = $this->db->query("SELECT * FROM ( SELECT DISTINCT id_lab_item AS id, 'Laboratory' AS group_item_name, group_name, c.serv_name, c.order_id, c.id_service, a.lab_item_seq_no AS serv_seq_no, '2' AS KET, price, e.price_type, order_type, currency, d.id_price AS dodol FROM mst_lab_item a LEFT JOIN mst_lab_group b ON a.lab_item_group = b.id_lab_item_group INNER JOIN ( SELECT * FROM mst_services WHERE order_type = 1 AND is_active = 0 ) c ON a.id_lab_item = c.order_id LEFT JOIN mst_service_price d ON c.id_service = d.id_service LEFT JOIN mst_price_type e ON d.price_type = e.id_price_type WHERE d.is_active = 0 UNION ALL SELECT DISTINCT id_rad_item, 'Radiology' AS group_item_name, group_desc, c.serv_name, c.order_id, c.id_service, a.seq_no, '3' AS KET, price, e.price_type, order_type, currency, d.id_price AS dodol FROM mst_rad_item a LEFT JOIN mst_rad_group b ON a.rad_item_group = b.id_rad_group INNER JOIN ( SELECT * FROM mst_services WHERE order_type = 2 AND is_active = 0 ) c ON a.id_rad_item = c.order_id LEFT JOIN mst_service_price d ON c.id_service = d.id_service LEFT JOIN mst_price_type e ON d.price_type = e.id_price_type WHERE d.is_active = 0 UNION ALL SELECT a.id_service, 'Pemeriksaan Fisik' AS group_item_name, 'Pemeriksaan Fisik' AS group_desc, serv_name, order_id, a.id_service, serv_seq_no, '1' AS KET, price, c.price_type, order_type, currency, b.id_price AS dodol FROM mst_services a LEFT JOIN mst_service_price b ON a.id_service = b.id_service LEFT JOIN mst_price_type c ON b.price_type = c.id_price_type WHERE order_type NOT IN (1, 2) AND a.is_active = 0 AND b.is_active = 0 UNION ALL SELECT a.id_service, d.group_desc AS group_item_name, 'Other' AS group_desc, serv_name, order_id, a.id_service, serv_seq_no, '1' AS KET, price, c.price_type, order_type, currency, b.id_price AS dodol FROM mst_services a LEFT JOIN mst_service_group d ON a.id_group_serv = d.id_serv_group LEFT JOIN mst_service_price b ON a.id_service = b.id_service LEFT JOIN mst_price_type c ON b.price_type = c.id_price_type WHERE order_type NOT IN (0, 1, 2) AND a.is_active = 0 AND b.is_active = 0 ) xyz ORDER BY group_name ASC;");
		return $query;
	}

	function delete_service_price($id, $data_app)
	{
		$this->db->where('id_price', $id);
		$this->db->update('mst_service_price', $data_app);
		return $this->db->affected_rows();
	}

	function delete_currency($id, $data_app)
	{
		$this->db->where('id_currency', $id);
		$this->db->update('mst_currency', $data_app);
		return $this->db->affected_rows();
	}

	function get_list_services_package($id_package)
	{
		$query = $this->db->query("select A.*,B.*,C.serv_name
			from mst_service_package_h A
			inner join mst_service_package_d B on A.id_package=B.id_package_header
			left join mst_services C on B.id_service=C.id_service
			where A.id_package=$id_package ORDER BY B.order_type,B.service_name ASC;");
		return $query;
	}

	function get_list_services_package2($id_package)
	{
		$this->db->select('mst_service_package_h.id_package, mst_service_package_h.id_client, mst_service_package_h.package_name, mst_service_package_h.persen_margin, mst_service_package_h.qty, mst_service_package_h.sell_price, mst_service_package_h.adjust, mst_service_package_h.amount_total, mst_service_package_h.grand_total, mst_service_package_h.package_exp, mst_service_package_d.id_package_detail, mst_service_package_d.id_package_header, mst_service_package_d.id_service, mst_service_package_d.seq_no, mst_service_package_d.order_id, mst_service_package_d.order_type, mst_service_package_d.service_name, mst_service_package_d.group_name, mst_service_package_d.price, mst_services.id_group_serv, mst_services.serv_name');
		$this->db->from('mst_service_package_h');
		$this->db->join('mst_service_package_d', 'mst_service_package_h.id_package = mst_service_package_d.id_package_header', 'inner');
		$this->db->join('mst_services', 'mst_service_package_d.id_service=mst_services.id_service', 'left');
		$this->db->where('mst_service_package_h.id_package', $id_package);
		$this->db->where('mst_service_package_h.status', 0);
		$query = $this->db->get();
		return $query;
	}

	function get_type()
	{
		return $this->db->get('mst_price_type');
	}

	function tr_tmp_mst_service_price()
	{
		return $this->db->truncate('tmp_mst_service_price');
	}


	function get_type3($id)
	{
		$this->db->where('id_price_type', $id);
		return $this->db->get('mst_price_type');
	}

	function get_type2($id)
	{
		$this->db->where('id_reg', $id);
		$this->db->join('trx_registration', 'trx_registration.pat_charge_rule=mst_price_type.id_price_type', 'inner');
		return $this->db->get('mst_price_type');
	}

	function get_data_order_ops($id, $type)
	{
		$this->db->where('quot_id', $id);
		$this->db->where('of_type', $type);
		$this->db->join('mkt_quotation_h', 'mkt_quotation_h.id_quot=mkt_order_form_h.quot_id', 'inner');
		$this->db->join('mst_client', 'mst_client.id_Client=mkt_quotation_h.client_id', 'inner');
		$this->db->join('mkt_order_form_d', 'mkt_order_form_d.of_header_id=mkt_order_form_h.id_order_form', 'inner');
		return $this->db->get('mkt_order_form_h');
	}

	function get_list_mark()
	{
		return $this->db->get('mst_mark_group');
	}

	function get_order_form()
	{
		$this->db->join('mkt_quotation_h', 'mkt_quotation_h.id_quot=mkt_order_form_h.quot_id', 'inner');
		$this->db->join('mkt_order_form_d', 'mkt_order_form_d.of_header_id=mkt_order_form_h.id_order_form', 'inner');
		return $this->db->get('mkt_order_form_h');
	}

	function get_sales_contract($id)
	{
		$this->db->where('mkt_sales_contract.id_quot', $id);
		$this->db->join('mkt_quotation_h', 'mkt_quotation_h.id_quot=mkt_sales_contract.id_quot', 'inner');
		$this->db->join('mst_client', 'mst_client.id_Client=mkt_quotation_h.client_id', 'inner');
		$this->db->join('mst_user', 'mst_user.id=mkt_sales_contract.id_mkt', 'inner');
		return $this->db->get('mkt_sales_contract');
	}

	function get_sales_contract_all()
	{
		$this->db->join('mkt_quotation_h', 'mkt_quotation_h.id_quot=mkt_sales_contract.id_quot', 'inner');
		return $this->db->get('mkt_sales_contract');
	}

	function get_quotation($id)
	{
		$this->db->where('mkt_id', $id);
		$this->db->join('mst_client', 'mst_client.id_Client=mkt_quotation_h.client_id', 'left');
		return $this->db->get('mkt_quotation_h');
	}

	function get_data_currency()
	{
		$this->db->where('is_active', 0);
		$this->db->order_by('id_currency', 'desc');
		return $this->db->get('mst_currency');
	}

	function get_data_currency_limit()
	{
		$this->db->where('is_active', 0);
		$this->db->order_by('id_currency', 'desc');
		return $this->db->get('mst_currency', 3);
	}

	function get_data_currency_id($id)
	{
		$this->db->where('id_currency', $id);
		return $this->db->get('mst_currency');
	}

	function get_data_currency_now()
	{
		$now		= date("Y-m-d");
		$this->db->where('create_date', $now);
		return $this->db->get('mst_currency');
	}

	function get_list_services_group()
	{
		$categories = array('0', '1', '2', '4', '5', '6', '10', '11');
		$this->db->where_in('id_serv_group', $categories);
		return $this->db->get('mst_service_group');
	}

	function get_list_services_group_2()
	{
		$categories = array('0', '2', '3', '5', '6', '10', '11');
		$this->db->where_in('id_serv_group', $categories);
		return $this->db->get('mst_service_group');
	}

	function get_list_services_type()
	{
		return $this->db->get('mst_service_type');
	}

	function get_branch()
	{
		return $this->db->get('mst_branch');
	}

	function save_mst_currency($data_insert)
	{
		$this->db->insert('mst_currency', $data_insert);
	}

	function save_mst_service($data_service)
	{
		$this->db->insert('mst_services', $data_service);
	}

	function save_mst_service_price($data_service)
	{
		$this->db->insert('mst_service_price', $data_service);
	}

	function save_mst_service_price_temp($data_service)
	{
		$this->db->insert('mst_service_price_temp', $data_service);
	}

	function save_mst_p_h($data_pack)
	{
		$this->db->insert('mst_service_package_h', $data_pack);
	}

	function save_mst_p_d($data_pack)
	{
		$this->db->insert('mst_service_package_d', $data_pack);
	}

	function save_order_h($data_quot)
	{
		$this->db->insert('mkt_order_form_h', $data_quot);
	}

	function save_mst_g_service_h($data_pack)
	{
		$this->db->insert('mst_group_service_h', $data_pack);
	}

	function save_sales_contract($data_quot)
	{
		$this->db->insert('mkt_sales_contract', $data_quot);
	}

	function delete_package($id, $data_app)
	{
		$this->db->where('id_package', $id);
		$this->db->update('mst_service_package_h', $data_app);
		return $this->db->affected_rows();
	}

	function update_mst_service_price_temp($id, $data_app)
	{
		$this->db->where('source', $id);
		$this->db->update('mst_service_price_temp', $data_app);
		return $this->db->affected_rows();
	}

	function update_mst_currency($id, $data_app)
	{
		$this->db->where('id_currency', $id);
		$this->db->update('mst_currency', $data_app);
		return $this->db->affected_rows();
	}

	function delete_list_quot($id, $data_app)
	{
		$this->db->where('id_quot_detail', $id);
		$this->db->update('mkt_quotation_d', $data_app);
		return $this->db->affected_rows();
	}

	public function update_mst_service($data, $where)
	{
		return $this->db->update('mst_services', $data, $where);
	}
}
