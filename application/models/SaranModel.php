<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class SaranModel extends CI_Model {

    private $_table = 'tb_saran';

    public function generateIdSaran() {
        $unik = 'S';
        $kode = $this->db->query("SELECT MAX(id_saran) LAST_NO FROM tb_saran WHERE id_saran LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 1, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function getAll() {
        $this->db->select('tb_saran.*, tb_pasien.*');
        $this->db->from('tb_saran');
        $this->db->join('tb_pasien', 'tb_saran.id_pasien = tb_pasien.id_pasien');
        return $this->db->get();
    }

    public function getByusername($username) {
        $this->db->select('tb_pasien.id_pasien, tb_user.username');
        $this->db->from('tb_user');
        $this->db->join('tb_pasien', 'tb_user.id_user = tb_pasien.id_user', 'inner');
        $this->db->where('tb_user.username', $username);
        return $this->db->get();
    }

    public function addSaran($saran) {
        return $this->db->insert($this->_table, $saran);
    }

    public function deleteSaran($id_saran) {
        $this->db->where('id_saran', $id_saran);
        return $this->db->delete($this->_table);
    }
}