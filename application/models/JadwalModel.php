<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class JadwalModel extends CI_Model {

    private $_table = 'tb_jadwal';

    public function getAll() {
        $this->db->select('tb_jadwal.*, tb_karyawan.*');
        $this->db->from('tb_jadwal');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan');
        return $this->db->get();
    }

    public function getById($id_jadwal) {
        $this->db->select('tb_jadwal.*, tb_karyawan.*');
        $this->db->from('tb_jadwal');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan');
        $this->db->where('tb_jadwal.id_jadwal', $id_jadwal);
        return $this->db->get();
    }

    public function generateIdJadwal() {
        $unik = 'JDL';
        $kode = $this->db->query("SELECT MAX(id_jadwal) LAST_NO FROM tb_jadwal WHERE id_jadwal LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 3, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }
    
    public function selectPerawat() {
        $this->db->select('tb_jadwal.*, tb_karyawan.*, tb_user.*');
        $this->db->from('tb_jadwal');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan', 'right');
        $this->db->join('tb_user', 'tb_karyawan.id_user = tb_user.id_user', 'right');
        $this->db->where('tb_user.jabatan', 'Perawat');
        return $this->db->get();
    }

    public function addJadwal($jadwal) {
        return $this->db->insert($this->_table, $jadwal);
    }

    public function editJadwal($id_jadwal, $jadwal) {
        $this->db->where('id_jadwal', $id_jadwal);
        return $this->db->update($this->_table, $jadwal);
    }

    public function deleteJadwal($id_jadwal) {
        $this->db->where('id_jadwal', $id_jadwal);
        return $this->db->delete($this->_table);
    }
}