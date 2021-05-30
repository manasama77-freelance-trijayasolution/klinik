<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Doctor extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_doctor');
    }


    public function doctor_management()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data         = $this->session->userdata('logged_in');
            $data['username']     = $session_data['username'];

            $data['arr_doctor'] = $this->m_doctor->get_list();

            $this->template->set('title', 'Klinik | Doctor Order');
            $this->template->load('template', 'menu/doctor_management', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function add()
    {
        $drname = $this->input->post('drname');
        $drnationality = 104;

        $data = [
            'drname'        => $drname,
            'drnationality' => $drnationality,
        ];

        $exec = $this->m_doctor->add($data);

        if ($exec) {
            $this->session->set_flashdata('success', 'Process Add New Doctor Success');
        } else {
            $this->session->set_flashdata('fail', 'Process Add New Doctor Failed');
        }

        redirect('doctor/doctor_management');
    }

    public function update()
    {
        $id_dr = $this->input->post('id_dr_edit');
        $drname = $this->input->post('drname_edit');

        $data  = ['drname' => $drname];
        $where = ['id_dr'  => $id_dr];

        $exec = $this->m_doctor->update($data, $where);

        if ($exec) {
            $this->session->set_flashdata('success', 'Process Update Doctor Success');
        } else {
            $this->session->set_flashdata('fail', 'Process Update Doctor Failed');
        }

        redirect('doctor/doctor_management');
    }

    public function delete()
    {
        $id_dr        = $this->input->post('id_dr');
        $current_date = date('Y-m-d H:i:s');

        $data  = ['deleted_at' => $current_date];
        $where = ['id_dr'  => $id_dr];

        $exec = $this->m_doctor->update($data, $where);

        if ($exec) {
            $msg = "Process Delete Doctor Success";
            $this->session->set_flashdata('success', $msg);
        } else {
            $msg = "Process Delete Doctor Failed";
            $this->session->set_flashdata('fail', $msg);
        }

        echo json_encode(['msg' => $msg]);
    }
}
        
    /* End of file  Doctor.php */
