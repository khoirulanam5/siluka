<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homecare extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Verifikasi Pelayanan Homecare';

        $this->db->select('tb_homecare.*, tb_pasien.*, tb_karyawan.*');
        $this->db->from('tb_homecare');
        $this->db->join('tb_pasien', 'tb_homecare.id_pasien = tb_pasien.id_pasien', 'left');
        $this->db->join('tb_karyawan', 'tb_homecare.id_karyawan = tb_karyawan.id_karyawan', 'left');
        $data['homecare'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/homecare/index', $data);
        $this->load->view('template/footer');
    }

    public function verifikasi($id_homecare) {
        $data['title'] = 'Tambahkan Perawat Untuk Layanan Homecare'; 
        $data['id_homecare'] = $id_homecare;

        $this->db->select('tb_karyawan.id_karyawan, tb_user.username');
        $this->db->from('tb_karyawan');
        $this->db->join('tb_user', 'tb_karyawan.id_user = tb_user.id_user', 'inner');
        $this->db->where('tb_user.jabatan', 'Perawat');
        $data['perawat'] = $this->db->get()->result();        

        $this->form_validation->set_rules('id_karyawan', 'ID Karyawan', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/homecare/verifikasi', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'id_karyawan' => $this->input->post('id_karyawan'),
                'status' => 'Terverifikasi'
            ];

            $this->db->where('id_homecare', $id_homecare);
            $this->db->update('tb_homecare', $data);

            $this->sendNotifPasien($id_homecare);
            $this->sendNotifPerawat($id_homecare);

            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Selamat', text:'Verifikasi Berhasil', icon:'success'})</script>");
			redirect('admin/homecare');
        }
    }

    public function delete($id_homecare) {
        $this->db->trans_start();
        $this->db->where('id_homecare', $id_homecare);
        $this->db->delete('tb_hasil');

        $this->db->where('id_homecare', $id_homecare);
        $this->db->delete('tb_homecare');
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Data homecare berhasil dihapus', icon:'success'})</script>");
        redirect('admin/homecare');
    }
}