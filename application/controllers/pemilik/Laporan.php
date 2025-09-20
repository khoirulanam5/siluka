<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['HasilModel' => 'hasil']);
        ispemilik();
    }

    public function index() {
        $data['title'] = 'Data Riwayat Perawatan Klinik';
        $data['hasil'] = $this->hasil->getAllKlinik()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pemilik/laporan/klinik', $data);
        $this->load->view('template/footer');
    }

    public function homecare() {
        $data['title'] = 'Riwayat Perawatan Homecare';
        $data['hasil'] = $this->hasil->getAllHomecare()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pemilik/laporan/homecare', $data);
        $this->load->view('template/footer');
    }

    public function pasien() {
        $data['title'] = 'Data Pasien';
        $data['pasien'] = $this->hasil->getAllPasien()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pemilik/laporan/pasien', $data);
        $this->load->view('template/footer');
    }

    public function cetakklinik() {
        $data['hasil'] = $this->hasil->cetakKlinik()->result();

        $this->load->view('pemilik/laporan/cetak_klinik', $data);
    }

    public function cetakhomecare() {
        $data['hasil'] = $this->hasil->cetakHomecare()->result();

        $this->load->view('pemilik/laporan/cetak_homecare', $data);
    }

    public function cetakpasien() {
        $data['pasien'] = $this->hasil->cetakPasien()->result();

        $this->load->view('pemilik/laporan/cetak_pasien', $data);
    }
}