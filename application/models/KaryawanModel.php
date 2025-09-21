<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class karyawanModel extends CI_Model {

    private $_table = 'tb_karyawan';

    public function generateIdKaryawan() {
        $unik = 'K';
        $kode = $this->db->query("SELECT MAX(id_karyawan) LAST_NO FROM tb_karyawan WHERE id_karyawan LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 1, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function getAll() {
        $this->db->select('tb_user.*, tb_karyawan.*');
        $this->db->from('tb_user');
        $this->db->join('tb_karyawan', 'tb_user.id_user = tb_karyawan.id_user');
        $this->db->where('jabatan !=', 'Pasien');
        return $this->db->get();
    }

    public function addKaryawan($karyawan) {
        return $this->db->insert($this->_table, $karyawan);
    }

    public function editKaryawan($id_karyawan, $karyawan) {
        $this->db->where('id_karyawan', $id_karyawan);
        return $this->db->update($this->_table, $karyawan);
    }
}