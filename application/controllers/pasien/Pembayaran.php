<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['PembayaranModel' => 'pembayaran']);
        ispasien();
    }

    public function index() {
        $data['title'] = 'Riwayat Pembayaran Klinik';
        $data['pembayaran'] = $this->pembayaran->getPembayaranKlinikByPasien()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pasien/pembayaran/klinik', $data);
        $this->load->view('template/footer');
    }

    public function homecare() {
        $data['title'] = 'Riwayat Pembayaran Homecare';
        $data['pembayaran'] = $this->pembayaran->getPembayaranHomecareByPasien()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pasien/pembayaran/homecare', $data);
        $this->load->view('template/footer');
    }
}