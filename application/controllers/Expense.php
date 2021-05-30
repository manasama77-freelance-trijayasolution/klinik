<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Expense extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_expense');
    }


    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data     = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];

            $data['arr_expense'] = $this->m_expense->get_list();

            $this->template->set('title', 'Klinik | Expense');
            $this->template->load('template', 'menu/expense', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function add()
    {
        $nama_barang       = $this->input->post('nama_barang');
        $nama_supplier     = $this->input->post('nama_supplier');
        $qty               = $this->input->post('qty');
        $harga             = $this->input->post('harga');
        $biaya_tambahan    = $this->input->post('biaya_tambahan');
        $sub_total         = $this->input->post('sub_total');
        $created_at        = $this->input->post('created_at');
        $current_date_time = date('Y-m-d H:i:s');

        $data = [
            'nama_barang'    => $nama_barang,
            'nama_supplier'  => $nama_supplier,
            'qty'            => $qty,
            'harga'          => $harga,
            'biaya_tambahan' => $biaya_tambahan,
            'sub_total'      => $sub_total,
            'created_at'     => $created_at,
            'updated_at'     => $current_date_time,
        ];

        $exec = $this->m_expense->add($data);

        if ($exec) {
            $this->session->set_flashdata('success', 'Process Add New Expense Success');
        } else {
            $this->session->set_flashdata('fail', 'Process Add New Expense Failed');
        }

        redirect('expense');
    }

    public function update()
    {
        $id                = $this->input->post('id_edit');
        $nama_barang       = $this->input->post('nama_barang_edit');
        $nama_supplier     = $this->input->post('nama_supplier_edit');
        $qty               = $this->input->post('qty_edit');
        $harga             = $this->input->post('harga_edit');
        $biaya_tambahan    = $this->input->post('biaya_tambahan_edit');
        $sub_total         = $this->input->post('sub_total_edit');
        $created_at        = $this->input->post('created_at_edit');
        $current_date_time = date('Y-m-d H:i:s');

        $data = [
            'nama_barang'    => $nama_barang,
            'nama_supplier'  => $nama_supplier,
            'qty'            => $qty,
            'harga'          => $harga,
            'biaya_tambahan' => $biaya_tambahan,
            'sub_total'      => $sub_total,
            'updated_at'     => $current_date_time,
        ];

        $where = ['id'  => $id];

        $exec = $this->m_expense->update($data, $where);

        if ($exec) {
            $this->session->set_flashdata('success', 'Process Update Expense Success');
        } else {
            $this->session->set_flashdata('fail', 'Process Update Expense Failed');
        }

        redirect('expense');
    }

    public function delete()
    {
        $id           = $this->input->post('id');
        $current_date = date('Y-m-d H:i:s');

        $data  = ['deleted_at' => $current_date];
        $where = ['id'  => $id];

        $exec = $this->m_expense->update($data, $where);

        if ($exec) {
            $msg = "Process Delete Expense Success";
            $this->session->set_flashdata('success', $msg);
        } else {
            $msg = "Process Delete Expense Failed";
            $this->session->set_flashdata('fail', $msg);
        }

        echo json_encode(['msg' => $msg]);
    }
}
        
    /* End of file  Expense.php */
