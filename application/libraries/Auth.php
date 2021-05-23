<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Auth library
 *
 * @author	Anggy Trisnawan
 */
class Auth{
	var $CI = NULL;
	function __construct()
	{
		// get CI's object
		$this->CI =& get_instance();
	}
	// untuk validasi login
	function do_login($username,$password)
	{
		// cek di database, ada ga?
		$this->CI->db->select('u.*, l.level_nama');
		$this->CI->db->from('user u');
		$this->CI->db->join('level l', 'u.user_level = l.level_id', 'inner');
		$this->CI->db->where('u.user_username',$username);
		$this->CI->db->where('u.user_password=MD5("'.$password.'")','',false);
		$result = $this->CI->db->get();
		if($result->num_rows() == 0) 
		{
			// username dan password tsb tidak ada 
			return 3;
		}
		else	
		{
			// ada, maka ambil informasi dari database
			$userdata = $result->row();
			$ss='"user_id";s:'.strlen($userdata->user_id).':"'.$userdata->user_id.'"';
			$this->CI->db->from('ci_sessions');
                	$this->CI->db->like('user_data',$ss);
                	$result1 = $this->CI->db->get();
			if($result1->num_rows() != 0){
                    $this->CI->db->like('user_data',$ss);
			$this->CI->db->delete('ci_sessions');
			}
	
			$session_data = array(
				'comp_id'   	=> $userdata->comp_id,
		     	'group_id'  	=> $userdata->group_id,
				'user_id'		=> $userdata->user_id,
				'username'		=> $userdata->user_username,
				'nama'			=> $userdata->user_nama,
				'level'			=> $userdata->user_level,
				'level_nama' 	=> $userdata->level_nama
			);
			// buat session
			$this->CI->session->set_userdata($session_data);
			return 1;
		}
	}
	// untuk mengecek apakah user sudah login/belum
	function is_logged_in()
	{
		if($this->CI->session->userdata('user_id') == '')
		{
			return false;
		}
		return true;
	}
	// untuk validasi di setiap halaman yang mengharuskan authentikasi
	function restrict()
	{
		if($this->is_logged_in() == false)
		{
			redirect('home/login');
		}
	}
	// untuk mengecek menu
	function cek_menu($idmenu)
	{
		$this->CI->load->model('usermodel');
		$status_user = $this->CI->session->userdata('level');
		$allowed_level = $this->CI->usermodel->get_array_menu($idmenu);
		if(in_array($status_user,$allowed_level) == false)
		{
			die("Maaf, Anda tidak berhak untuk mengakses halaman ini.");
		}
	}
	function log($log)
	{
		$this->CI->load->model('usermodel');
		$data ['url']= $log;
		$data ['user'] = $this->CI->session->userdata('username');
		$this->CI->usermodel->insert_log($data);
	}
	function cek_user($userid)
        {
                $this->CI->load->model('usermodel');
                $user = $this->CI->usermodel->get_username($userid); 
                $usr=$user->result();
		if(!empty($usr[0]->user_id) || $usr[0]->user_id != ''){
			return TRUE;
		}
		return FALSE;
        }
	function cek_atm($id_atm)
        {
                $this->CI->load->model('menumodel');
                $user = $this->CI->menumodel->get_id_atm($id_atm); 
                $usr=$user->result();
		if(!empty($usr[0]->id_atm) || $usr[0]->id_atm != ''){
		return TRUE;
		}
		return FALSE;
        }	
	function cek_menu_delete($idmenu)
        {
                $this->CI->load->model('usermodel');
                $status_user = $this->CI->session->userdata('level');
                $allowed_level = $this->CI->usermodel->get_array_menu($idmenu);
                if(in_array($status_user,$allowed_level) == false)
                {
                        return 2;
                }else{
			return 1;
		}
        }
	// untuk logout
	function do_logout()
	{
		
		$this->CI->session->sess_destroy();	
	}
}
