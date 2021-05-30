<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_doctor extends CI_Model
{

    public function get_list()
    {
        return $this->db
            ->from('mst_doctor')
            ->where('deleted_at', null)
            ->order_by('id_dr', 'desc')
            ->get();
    }

    public function add($data)
    {
        return $this->db->insert('mst_doctor', $data);
    }

    public function update($data, $where)
    {
        return $this->db->where($where)->update('mst_doctor', $data);
    }
}
                        
/* End of file M_doctor.php */
