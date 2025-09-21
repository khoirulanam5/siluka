<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PerawatanModel extends CI_Model {

    private $_table = 'tb_perawatan';

    public function generateIdPerawatan() {
        $unik = 'PRT';
        $kode = $this->db->query("SELECT MAX(id_perawatan) LAST_NO FROM tb_perawatan WHERE id_perawatan LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 3, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function getAll() {
        $this->db->select('tb_perawatan.*, tb_pendaftaran.*, tb_pasien.*, tb_jadwal.*, tb_karyawan.*, tb_hasil.*');
        $this->db->from('tb_perawatan');
        $this->db->join('tb_pendaftaran', 'tb_perawatan.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'right');
        $this->db->join('tb_pasien', 'tb_pendaftaran.id_pasien = tb_pasien.id_pasien', 'right');
        $this->db->join('tb_jadwal', 'tb_pendaftaran.id_jadwal = tb_jadwal.id_jadwal', 'inner');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan', 'inner');
        $this->db->join('tb_hasil', 'tb_perawatan.id_perawatan = tb_hasil.id_perawatan', 'left');
        $this->db->where('tb_jadwal.jenis_perawatan', 'Klinik');
        $this->db->where('tb_jadwal.id_karyawan', $this->session->userdata('id_karyawan'));
        return $this->db->get();
    }

    public function getPerawatan() {
        $this->db->select('tb_perawatan.*, tb_pendaftaran.*, tb_pasien.*, tb_jadwal.*, tb_karyawan.*');
        $this->db->from('tb_perawatan');
        $this->db->join('tb_pendaftaran', 'tb_perawatan.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'right');
        $this->db->join('tb_pasien', 'tb_pendaftaran.id_pasien = tb_pasien.id_pasien', 'right');
        $this->db->join('tb_jadwal', 'tb_pendaftaran.id_jadwal = tb_jadwal.id_jadwal', 'inner');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan', 'inner');
        $this->db->where('tb_jadwal.jenis_perawatan', 'Klinik');
        $this->db->where('tb_jadwal.id_karyawan', $this->session->userdata('id_karyawan'));
        return $this->db->get()->result();
    }

    public function addPerawatan($data) {
        return $this->db->insert($this->_table, $data);
    }
}