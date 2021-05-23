<?php
class M_fin extends CI_Model{
	function get_registration_today(){
		$this->db->join('mst_user', 'mst_user.id = trx_registration.create_by', 'left');
		$this->db->join('mkt_posting_pack_h', 'mkt_posting_pack_h.id_quot = trx_registration.id_package', 'left');
		$this->db->join('mst_price_type', 'mst_price_type.id_price_type = trx_registration.pat_charge_rule', 'inner');
		$this->db->join('mst_client', 'mst_client.id_Client = trx_registration.id_client', 'inner');
		$this->db->join('pat_data', 'pat_data.id_Pat = trx_registration.id_pat', 'inner');
		$this->db->where('reg_date', date('Y-m-d') );
		$this->db->order_by("reg_date", "asc");
		return $this->db->get('trx_registration');
	}
}
?>