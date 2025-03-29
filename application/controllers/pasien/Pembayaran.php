<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Riwayat Pembayaran Klinik';

        $this->db->select('tb_perawatan.*, tb_pendaftaran.*, tb_pasien.*, tb_jadwal.*, tb_karyawan.*, tb_hasil.*, tb_pembayaran.*');
        $this->db->from('tb_perawatan');
        $this->db->join('tb_pendaftaran', 'tb_perawatan.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'right');
        $this->db->join('tb_pasien', 'tb_pendaftaran.id_pasien = tb_pasien.id_pasien', 'right');
        $this->db->join('tb_jadwal', 'tb_pendaftaran.id_jadwal = tb_jadwal.id_jadwal', 'inner');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan', 'inner');
        $this->db->join('tb_hasil', 'tb_perawatan.id_perawatan = tb_hasil.id_perawatan', 'left');
        $this->db->join('tb_pembayaran', 'tb_perawatan.id_perawatan = tb_pembayaran.id_perawatan', 'left');
        $this->db->where('tb_hasil.status_perawatan', 'Perawatan Klinik Selesai');
        $this->db->where('tb_pembayaran.bayar !=', NULL);
        $this->db->where('tb_pasien.id_pasien', $this->session->userdata('id_pasien'));
        $data['pembayaran'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pasien/pembayaran/klinik', $data);
        $this->load->view('template/footer');
    }

    public function homecare() {
        $data['title'] = 'Riwayat Pembayaran Homecare';

        $this->db->select('tb_homecare.*, tb_pembayaran.*, tb_pasien.*');
        $this->db->from('tb_homecare');
        $this->db->join('tb_pembayaran', 'tb_homecare.id_homecare = tb_pembayaran.id_homecare');
        $this->db->join('tb_pasien', 'tb_homecare.id_pasien = tb_pasien.id_pasien');
        $this->db->where('tb_pembayaran.bayar !=', NULL);
        $this->db->where('tb_pasien.id_pasien', $this->session->userdata('id_pasien'));
        $data['pembayaran'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pasien/pembayaran/homecare', $data);
        $this->load->view('template/footer');
    }
}