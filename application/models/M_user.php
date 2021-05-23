<?php
class M_user extends CI_Model{
	
	function get_list_user(){
		return $this->db->get('mst_user');
	}
	
	function get_list_user_leftjoin_demo_finger(){
		return $this->db->get('mst_user');
	}
	function get_job(){
		return $this->db->get('mst_department');
	}
	
	function get_branch(){
		return $this->db->get('mst_branch');
	}
	
	function get_list_user_by_id($id){
		$this->db->where('id',$id);
		return $this->db->get('mst_user');
	}
	
	function update_user($data_user,$id){
		$this->db->where('id',$id);
		$this->db->update('mst_user',$data_user);
	}
	
    function delete_user($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('mst_user');
	}
	
	function add_user($data_user)
	{
		$this->db->insert('mst_user',$data_user);
	}
	
}
?>