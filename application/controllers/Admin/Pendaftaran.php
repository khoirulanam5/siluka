<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['PendaftaranModel' => 'pendaftaran']);
        isadmin();
    }

    public function index() {
        $data['title'] = 'Pendaftaran Layanan Pasien';
        $data['pendaftaran'] = $this->pendaftaran->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/pendaftaran/index', $data);
        $this->load->view('template/footer');
    }

    public function verifikasi($id_pendaftaran) {

        $this->pendaftaran->verify($id_pendaftaran);

        $this->pendaftaran->sendNotifPasien($id_pendaftaran);
        $this->pendaftaran->sendNotifPerawat($id_pendaftaran);

        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Pendaftaran Berhasil Diverifikasi', icon:'success'})</script>");
        redirect('admin/pendaftaran');
    }

    public function delete($id_pendaftaran) {
        $this->pendaftaran->deletePendaftaran($id_pendaftaran);
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Data pendaftaran berhasil dihapus', icon:'success'})</script>");
        redirect('admin/pendaftaran');
    }
}