<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    private $_table = 'tb_user';

    public function getById($id_user) {
        $this->db->select('tb_user.*, tb_karyawan.*');
        $this->db->from('tb_user');
        $this->db->join('tb_karyawan', 'tb_user.id_user = tb_karyawan.id_user');
        $this->db->where('tb_user.id_user', $id_user);
        return $this->db->get();
    }

    public function generateIdUser() {
        $unik = 'U';
        $kode = $this->db->query("SELECT MAX(id_user) LAST_NO FROM tb_user WHERE id_user LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 1, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function addUser($user) {
        return $this->db->insert($this->_table, $user);
    }

    public function editUser($id_user, $user) {
        $this->db->where('id_user', $id_user);
        return $this->db->update($this->_table, $user);
    }

    public function deleteUser($id_user) {
        $this->db->trans_start();
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_karyawan');
    
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user');
        return $this->db->trans_complete();
    }
}