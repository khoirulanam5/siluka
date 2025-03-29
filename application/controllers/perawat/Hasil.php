<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Riwayat Perawatan Klinik';

        $this->db->select('tb_perawatan.*, tb_pendaftaran.*, tb_pasien.*, tb_jadwal.*, tb_karyawan.*, tb_hasil.*, tb_pembayaran.*');
        $this->db->from('tb_perawatan');
        $this->db->join('tb_pendaftaran', 'tb_perawatan.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'right');
        $this->db->join('tb_pasien', 'tb_pendaftaran.id_pasien = tb_pasien.id_pasien', 'right');
        $this->db->join('tb_jadwal', 'tb_pendaftaran.id_jadwal = tb_jadwal.id_jadwal', 'inner');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan', 'inner');
        $this->db->join('tb_hasil', 'tb_perawatan.id_perawatan = tb_hasil.id_perawatan', 'left');
        $this->db->join('tb_pembayaran', 'tb_perawatan.id_perawatan = tb_pembayaran.id_perawatan', 'left');
        $this->db->where('tb_hasil.status_perawatan', 'Perawatan Klinik Selesai');
        $data['hasil'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('perawat/hasil/klinik', $data);
        $this->load->view('template/footer');
    }

    public function homecare() {
        $data['title'] = 'Riwayat Perawatan Homecare';

        $this->db->select('tb_homecare.*, tb_pasien.*, tb_karyawan.*, tb_pembayaran.*, tb_hasil.*');
        $this->db->from('tb_homecare');
        $this->db->join('tb_pasien', 'tb_homecare.id_pasien = tb_pasien.id_pasien', 'inner');
        $this->db->join('tb_karyawan', 'tb_homecare.id_karyawan = tb_karyawan.id_karyawan', 'inner');
        $this->db->join('tb_pembayaran', 'tb_homecare.id_homecare = tb_pembayaran.id_homecare', 'inner');
        $this->db->join('tb_hasil', 'tb_hasil.id_homecare = tb_homecare.id_homecare', 'inner');
        $this->db->where('tb_hasil.status_perawatan', 'Perawatan Homecare selesai');
        $data['hasil'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('perawat/hasil/homecare', $data);
        $this->load->view('template/footer');
    }
}