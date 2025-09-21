<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['HasilModel' => 'hasil']);
        isperawat();
    }

    public function index() {
        $data['title'] = 'Riwayat Perawatan Klinik';
        $data['hasil'] = $this->hasil->getAllKlinik()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('perawat/hasil/klinik', $data);
        $this->load->view('template/footer');
    }

    public function homecare() {
        $data['title'] = 'Riwayat Perawatan Homecare';
        $data['hasil'] = $this->hasil->getAllHomecare()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('perawat/hasil/homecare', $data);
        $this->load->view('template/footer');
    }
}