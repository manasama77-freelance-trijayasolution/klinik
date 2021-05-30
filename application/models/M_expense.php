<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_expense extends CI_Model
{

    public function get_list()
    {
        return $this->db
            ->from('expense')
            ->where('deleted_at', null)
            ->order_by('id', 'desc')
            ->get();
    }

    public function add($data)
    {
        return $this->db->insert('expense', $data);
    }

    public function update($data, $where)
    {
        return $this->db->where($where)->update('expense', $data);
    }
}
                        
/* End of file M_expense.php */
