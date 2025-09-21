<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class PembayaranModel extends CI_Model {

    private $_table = 'tb_pembayaran';

    public function generateIdBayar() {
        $unik = 'BYR';
        $kode = $this->db->query("SELECT MAX(id_pembayaran) LAST_NO FROM tb_pembayaran WHERE id_pembayaran LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 3, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function addBayar($bayar) {
        return $this->db->insert($this->_table, $bayar);
    }

    public function getAllPembayaranKlinik() {
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
        return $this->db->get();
    }

    public function getAllPembayaranHomecare() {
        $this->db->select('tb_homecare.*, tb_pembayaran.*, tb_pasien.*');
        $this->db->from('tb_homecare');
        $this->db->join('tb_pembayaran', 'tb_homecare.id_homecare = tb_pembayaran.id_homecare');
        $this->db->join('tb_pasien', 'tb_homecare.id_pasien = tb_pasien.id_pasien');
        $this->db->where('tb_pembayaran.bayar !=', NULL);
        return $this->db->get();
    }

}
