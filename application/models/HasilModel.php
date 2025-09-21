<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HasilModel extends CI_Model {

    private $_table = 'tb_hasil';

    public function generateIdHasil() {
        $unik = 'H';
        $kode = $this->db->query("SELECT MAX(id_hasil) LAST_NO FROM tb_hasil WHERE id_hasil LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 1, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function addHasil($hasil) {
        return $this->db->insert($this->_table, $hasil);
    }

    public function getAllKlinik() {
        $this->db->select('tb_perawatan.*, tb_pendaftaran.*, tb_pasien.*, tb_jadwal.*, tb_karyawan.*, tb_hasil.*, tb_pembayaran.*');
        $this->db->from('tb_perawatan');
        $this->db->join('tb_pendaftaran', 'tb_perawatan.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'right');
        $this->db->join('tb_pasien', 'tb_pendaftaran.id_pasien = tb_pasien.id_pasien', 'right');
        $this->db->join('tb_jadwal', 'tb_pendaftaran.id_jadwal = tb_jadwal.id_jadwal', 'inner');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan', 'inner');
        $this->db->join('tb_hasil', 'tb_perawatan.id_perawatan = tb_hasil.id_perawatan', 'left');
        $this->db->join('tb_pembayaran', 'tb_perawatan.id_perawatan = tb_pembayaran.id_perawatan', 'left');
        $this->db->where('tb_hasil.status_perawatan', 'Perawatan Klinik Selesai');
        return $this->db->get();
    }

    public function getKlinikByPasien() {
        $this->db->select('tb_perawatan.*, tb_pendaftaran.*, tb_pasien.*, tb_jadwal.*, tb_karyawan.*, tb_hasil.*, tb_pembayaran.*');
        $this->db->from('tb_perawatan');
        $this->db->join('tb_pendaftaran', 'tb_perawatan.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'right');
        $this->db->join('tb_pasien', 'tb_pendaftaran.id_pasien = tb_pasien.id_pasien', 'right');
        $this->db->join('tb_jadwal', 'tb_pendaftaran.id_jadwal = tb_jadwal.id_jadwal', 'inner');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan', 'inner');
        $this->db->join('tb_hasil', 'tb_perawatan.id_perawatan = tb_hasil.id_perawatan', 'left');
        $this->db->join('tb_pembayaran', 'tb_perawatan.id_perawatan = tb_pembayaran.id_perawatan', 'left');
        $this->db->where('tb_hasil.status_perawatan', 'Perawatan Klinik Selesai');
        $this->db->where('tb_pasien.id_pasien', $this->session->userdata('id_pasien'));
        return $this->db->get();
    }

    public function getAllHomecare() {
        $this->db->select('tb_homecare.*, tb_pasien.*, tb_karyawan.*, tb_pembayaran.*, tb_hasil.*');
        $this->db->from('tb_homecare');
        $this->db->join('tb_pasien', 'tb_homecare.id_pasien = tb_pasien.id_pasien', 'inner');
        $this->db->join('tb_karyawan', 'tb_homecare.id_karyawan = tb_karyawan.id_karyawan', 'inner');
        $this->db->join('tb_pembayaran', 'tb_homecare.id_homecare = tb_pembayaran.id_homecare', 'inner');
        $this->db->join('tb_hasil', 'tb_hasil.id_homecare = tb_homecare.id_homecare', 'inner');
        $this->db->where('tb_hasil.status_perawatan', 'Perawatan Homecare selesai');
        return $this->db->get();
    }

    public function getHomecareByPasien() {
        $this->db->select('tb_homecare.*, tb_pasien.*, tb_karyawan.*, tb_pembayaran.*, tb_hasil.*');
        $this->db->from('tb_homecare');
        $this->db->join('tb_pasien', 'tb_homecare.id_pasien = tb_pasien.id_pasien', 'inner');
        $this->db->join('tb_karyawan', 'tb_homecare.id_karyawan = tb_karyawan.id_karyawan', 'inner');
        $this->db->join('tb_pembayaran', 'tb_homecare.id_homecare = tb_pembayaran.id_homecare', 'inner');
        $this->db->join('tb_hasil', 'tb_hasil.id_homecare = tb_homecare.id_homecare', 'inner');
        $this->db->where('tb_hasil.status_perawatan', 'Perawatan Homecare selesai');
        $this->db->where('tb_pasien.id_pasien', $this->session->userdata('id_pasien'));
        return $this->db->get();
    }

    public function getAllPasien() {
        $this->db->select('tb_user.*, tb_pasien.*');
        $this->db->from('tb_user');
        $this->db->join('tb_pasien', 'tb_user.id_user = tb_pasien.id_user');
        $this->db->where('jabatan =', 'Pasien');
        return $this->db->get();
    }

    public function cetakKlinik() {
        $this->db->select('tb_perawatan.*, tb_pendaftaran.*, tb_pasien.*, tb_jadwal.*, tb_karyawan.*, tb_hasil.*, tb_pembayaran.*');
        $this->db->from('tb_perawatan');
        $this->db->join('tb_pendaftaran', 'tb_perawatan.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'right');
        $this->db->join('tb_pasien', 'tb_pendaftaran.id_pasien = tb_pasien.id_pasien', 'right');
        $this->db->join('tb_jadwal', 'tb_pendaftaran.id_jadwal = tb_jadwal.id_jadwal', 'inner');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan', 'inner');
        $this->db->join('tb_hasil', 'tb_perawatan.id_perawatan = tb_hasil.id_perawatan', 'left');
        $this->db->join('tb_pembayaran', 'tb_perawatan.id_perawatan = tb_pembayaran.id_perawatan', 'left');
        $this->db->where('tb_hasil.status_perawatan', 'Perawatan Klinik Selesai');
        return $this->db->get();
    }

    public function cetakHomecare() {
        $this->db->select('tb_homecare.*, tb_pasien.*, tb_karyawan.*, tb_pembayaran.*, tb_hasil.*');
        $this->db->from('tb_homecare');
        $this->db->join('tb_pasien', 'tb_homecare.id_pasien = tb_pasien.id_pasien', 'inner');
        $this->db->join('tb_karyawan', 'tb_homecare.id_karyawan = tb_karyawan.id_karyawan', 'inner');
        $this->db->join('tb_pembayaran', 'tb_homecare.id_homecare = tb_pembayaran.id_homecare', 'inner');
        $this->db->join('tb_hasil', 'tb_hasil.id_homecare = tb_homecare.id_homecare', 'inner');
        $this->db->where('tb_hasil.status_perawatan', 'Perawatan Homecare selesai');
        return $this->db->get();
    }

    public function cetakPasien() {
        $this->db->select('tb_user.*, tb_pasien.*');
        $this->db->from('tb_user');
        $this->db->join('tb_pasien', 'tb_user.id_user = tb_pasien.id_user');
        $this->db->where('jabatan =', 'Pasien');
        return $this->db->get();
    }

    public function cetakNotaKlinik($id_perawatan) {
        $this->db->select('tb_perawatan.*, tb_pendaftaran.*, tb_pasien.*, tb_jadwal.*, tb_karyawan.*, tb_hasil.*, tb_pembayaran.*');
        $this->db->from('tb_perawatan');
        $this->db->join('tb_pendaftaran', 'tb_perawatan.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'right');
        $this->db->join('tb_pasien', 'tb_pendaftaran.id_pasien = tb_pasien.id_pasien', 'right');
        $this->db->join('tb_jadwal', 'tb_pendaftaran.id_jadwal = tb_jadwal.id_jadwal', 'inner');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan', 'inner');
        $this->db->join('tb_hasil', 'tb_perawatan.id_perawatan = tb_hasil.id_perawatan', 'left');
        $this->db->join('tb_pembayaran', 'tb_perawatan.id_perawatan = tb_pembayaran.id_perawatan', 'left');
        $this->db->where('tb_hasil.status_perawatan', 'Perawatan Klinik Selesai');
        $this->db->where('tb_perawatan.id_perawatan', $id_perawatan);
        return $this->db->get();
    }

    public function cetakNotaHomecare($id_homecare) {
        $this->db->select('tb_homecare.*, tb_pasien.*, tb_karyawan.*, tb_pembayaran.*, tb_hasil.*');
        $this->db->from('tb_homecare');
        $this->db->join('tb_pasien', 'tb_homecare.id_pasien = tb_pasien.id_pasien', 'inner');
        $this->db->join('tb_karyawan', 'tb_homecare.id_karyawan = tb_karyawan.id_karyawan', 'inner');
        $this->db->join('tb_pembayaran', 'tb_homecare.id_homecare = tb_pembayaran.id_homecare', 'inner');
        $this->db->join('tb_hasil', 'tb_hasil.id_homecare = tb_homecare.id_homecare', 'inner');
        $this->db->where('tb_hasil.status_perawatan', 'Perawatan Homecare selesai');
        $this->db->where('tb_homecare.id_homecare', $id_homecare);
        return $this->db->get();
    }
}