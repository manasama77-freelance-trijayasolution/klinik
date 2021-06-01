<?php
class M_client extends CI_Model{
	
	function save_client($data_client){
	$this->db->insert('mst_client',$data_client);
	}

	function save_pic_client($data_client){
	$this->db->insert('mst_client_pic',$data_client);
	}

	function save_insurance($data_client){
	$this->db->insert('mst_insurance',$data_client);
	}
		
	function get_mst_client(){
	$this->db->where('status',0);
	return $this->db->get('mst_client'); //  load name of table
	}
			
	function get_mst_client_by_id($id_client){
	$this->db->where('id_client',$id_client);
	return $this->db->get('mst_client'); //  load name of table
	}
	
	function update_company($id_Client,$data_update){
	$this->db->where('id_Client',$id_Client);
	$this->db->update('mst_client',$data_update);
	return $this->db->affected_rows();
	}

	function get_mst_insurance(){
	$this->db->where('status',0);
	return $this->db->get('mst_insurance'); //  load name of table
	}
			
	function get_mst_insurance_by_id($id_client){
	$this->db->where('id_ins_comp',$id_client);
	return $this->db->get('mst_insurance'); //  load name of table
	}

	function update_insurance($id_ins_comp,$data_update){
	$this->db->where('id_ins_comp',$id_ins_comp);
	$this->db->update('mst_insurance',$data_update);
	return $this->db->affected_rows();
	}
	
	function get_max_client(){
	$this->db->select_max('id_Client');
	$this->db->from('mst_client');
	$query = $this->db->get();
	return $query;
	}

	function update_client_code(){
	$query = $this->db->query("UPDATE mst_client SET client_code=CONCAT(UPPER(LEFT(client_name,1)),LPAD(id_Client, 4, 0));");
	return $query;
	}
	
	
}
?>