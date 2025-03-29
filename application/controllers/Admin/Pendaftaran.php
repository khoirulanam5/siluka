<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Pendaftaran Layanan Pasien';

        $this->db->select('tb_pendaftaran.*, tb_pasien.*, tb_jadwal.*, tb_karyawan.*');
        $this->db->from('tb_pendaftaran');
        $this->db->join('tb_pasien', 'tb_pendaftaran.id_pasien = tb_pasien.id_pasien');
        $this->db->join('tb_jadwal', 'tb_pendaftaran.id_jadwal = tb_jadwal.id_jadwal');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan');
        $data['pendaftaran'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/pendaftaran/index', $data);
        $this->load->view('template/footer');
    }

    public function verifikasi($id_pendaftaran) {

        $this->db->set('status', 'Disetujui');
        $this->db->where('id_pendaftaran', $id_pendaftaran);
        $this->db->update('tb_pendaftaran');

        $this->sendNotifPasien($id_pendaftaran);
        $this->sendNotifPerawat($id_pendaftaran);

        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Pendaftaran Berhasil Diverifikasi', icon:'success'})</script>");
        redirect('admin/pendaftaran');
    }

    public function delete($id_pendaftaran) {
        $this->db->where('id_pendaftaran', $id_pendaftaran);
        $this->db->delete('tb_pendaftaran');
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Data pendaftaran berhasil dihapus', icon:'success'})</script>");
        redirect('admin/pendaftaran');
    }
}