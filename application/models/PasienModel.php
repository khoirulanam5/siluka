<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PasienModel extends CI_Model {

    private $_table = 'tb_pasien';

    public function getAll() {
        $this->db->select('tb_user.*, tb_pasien.*');
        $this->db->from('tb_user');
        $this->db->join('tb_pasien', 'tb_user.id_user = tb_pasien.id_user');
        $this->db->where('jabatan =', 'Pasien');
        return $this->db->get();
    }

    public function getById($id_user) {
        $this->db->select('tb_user.*, tb_pasien.*');
        $this->db->from('tb_user');
        $this->db->join('tb_pasien', 'tb_user.id_user = tb_pasien.id_user');
        $this->db->where('tb_user.id_user', $id_user);
        return $this->db->get();
    }

    public function generateIdPasien() {
        $unik = 'P';
        $kode = $this->db->query("SELECT MAX(id_pasien) LAST_NO FROM tb_pasien WHERE id_pasien LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 1, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
      }

    public function addPasien($pasien) {
        return $this->db->insert($this->_table, $pasien);
    }

    public function editPasien($id_pasien, $pasien) {
        $this->db->where('id_pasien', $id_pasien);
        return $this->db->update($this->_table, $pasien);
    }

    public function deletePasien($id_user) {
        $this->db->trans_start();
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_pasien');
    
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user');
        return $this->db->trans_complete();
    }
}