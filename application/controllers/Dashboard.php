<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['karyawan'] = count($this->db->get('tb_karyawan')->result());
        $data['pasien'] = count($this->db->get('tb_pasien')->result());
        $data['homecare'] = count($this->db->get('tb_homecare')->result());
        $data['perawatan'] = count($this->db->get('tb_perawatan')->result());

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }
}