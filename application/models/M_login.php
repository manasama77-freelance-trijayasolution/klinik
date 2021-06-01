<?php
class M_login extends CI_Model
{
  function login($username, $password)
  {
    $this->db->select('*');
    $this->db->from('mst_user');
    $this->db->where('username', $username);
    $this->db->where('userpass', $password);
    $this->db->limit(1);
    $query = $this->db->get();
    if ($query->num_rows() == 1) {
      return $query->result();
    } else {
      return false;
    }
  }

  function data_login()
  {
    $this->db->where('online', 1);
    return $this->db->get('mst_user'); //  load name of table
  }

  function log($data_log)
  {
    return $this->db->insert('usr_log', $data_log);
  }

  function user_login($username, $data)
  {
    $this->db->where('username', $username);
    $this->db->update('mst_user', $data);
    return $this->db->affected_rows();
  }

  function user_logout($user_id, $data)
  {
    $this->db->where('id', $user_id);
    $this->db->update('mst_user', $data);
    return $this->db->affected_rows();
  }
}
