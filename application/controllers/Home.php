<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('m_login');
    $this->load->model('m_quotation');
    $this->load->model('m_regreport');
  }

  public function index()
  {
    if ($this->session->userdata('logged_in')) {
      $session_data = $this->session->userdata('logged_in');

      $data['username'] = $session_data['username'];
      $data['fullname'] = $session_data['fullname'];
      $data['agama']    = $session_data['agama'];
      $data['id']       = $session_data['id'];
      $data['users']    = $this->m_login->data_login();
      $data['data']     = $this->m_quotation->get_data_currency_limit();

      $data['arr_appointment'] = $this->m_regreport->get_data_appointment();

      $this->template->set('title', 'Klinik | Dashboard');
      $this->template->load('template', 'menu/index', $data);
    } else {
      //If no session, redirect to login page
      redirect('login', 'refresh');
    }
  }

  function chat()
  {
    if ($this->session->userdata('logged_in')) {
      $session_data = $this->session->userdata('logged_in');
      $data['username']   = $session_data['username'];
      $data['id']     = $session_data['id'];
      $data['users']    = $this->m_login->data_login();
      $this->template->set('title', 'Klinik | Chat Room');
      $this->template->load('template', 'menu/chat', $data);
      //$this->load->view('');
    } else {
      //If no session, redirect to login page
      redirect('login', 'refresh');
    }
  }

  function update_user()
  {
    if ($this->session->userdata('logged_in')) {
      $session_data = $this->session->userdata('logged_in');
      $data['username']   = $session_data['username'];
      $data['idx']     = $this->uri->segment(1);
      $data['id']     = $session_data['id'];
      $data['users']    = $this->m_login->data_login();
      $this->template->set('title', 'Klinik | Chat Room');
      $this->template->load('template', 'menu/update_user', $data);
      //$this->load->view('');
    } else {
      //If no session, redirect to login page
      redirect('login', 'refresh');
    }
  }

  function logout()
  {


    // --------- HAPUS CACHE DISINI --------- 
    // versi pertama...
    header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    // versi kedua..
    // header("Cache-Control: no-cache, must-revalidate");
    // header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    // header("Content-Type: application/xml; charset=utf-8");

    // --------- BATAS CACHE DISINI --------- 


    // --------- Singkron setelah Logout --------- 
    // --------- Singkron Lab yang sudah progres lewat dari 3 hari harus diubah menjadi pending --------- 
    $this->load->model('m_lab');
    $now                = date("Y-m-d H:i:s");
    $cek_lab            = $this->m_lab->get_order_pending(4);
    foreach ($cek_lab->result() as $row) {
      $id               = $row->id_order;
      $order_date       = $row->order_date;
      $selisih          = strtotime(date("M d Y ")) - (strtotime($order_date));
      // echo floor($selisih/3600/24);
      // echo "</br>";
      if ($selisih > 2) {
        $data_process = array(
          'order_status'  => 5,
        );
        $this->load->model('m_lab');
        $this->m_lab->status_order($data_process, $id);
      }
    }


    $data_process = array(
      'order_status'  => 4,
    );
    $this->load->model('m_lab');
    $this->m_lab->status_order($data_process, $id);
    // exit();

    // --------- End Singkron Lab  --------- 

    // --------- End Singkron            --------- 


    $url                     = $this->uri->segment(1);

    //Create Log Start
    $session_data            = $this->session->userdata('logged_in');
    $now                     = date("Y-m-d H:i:s");
    $user_id                 = $session_data['id'];
    $data_log                = array(
      'id_user'           => $user_id,
      'log_date'         => $now,
      'log_desc'          => "Logout Success",
    );
    $this->m_login->log($data_log);
    //Endless Log

    $data                  = array();
    $data                  = array(
      'online'                => 0,
    );
    $update = $this->m_login->user_logout($user_id, $data);
    $this->session->unset_userdata('logged_in');
    session_destroy();
    redirect('login', 'refresh');
  }
}
