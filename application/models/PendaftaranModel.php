<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PendaftaranModel extends CI_Model {

    private $_table = 'tb_pendaftaran';

    public function generateIdPendaftaran() {
        $unik = 'PDF';
        $kode = $this->db->query("SELECT MAX(id_pendaftaran) LAST_NO FROM tb_pendaftaran WHERE id_pendaftaran LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 3, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function getAll() {
        $this->db->select('tb_pendaftaran.*, tb_pasien.*, tb_jadwal.*, tb_karyawan.*');
        $this->db->from('tb_pendaftaran');
        $this->db->join('tb_pasien', 'tb_pendaftaran.id_pasien = tb_pasien.id_pasien');
        $this->db->join('tb_jadwal', 'tb_pendaftaran.id_jadwal = tb_jadwal.id_jadwal');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan');
        return $this->db->get();
    }

    public function getPendaftaranByPasien() {
        $this->db->select('tb_pendaftaran.*, tb_pasien.*, tb_jadwal.*, tb_karyawan.*');
        $this->db->from('tb_pendaftaran');
        $this->db->join('tb_pasien', 'tb_pendaftaran.id_pasien = tb_pasien.id_pasien');
        $this->db->join('tb_jadwal', 'tb_pendaftaran.id_jadwal = tb_jadwal.id_jadwal');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan');
        $this->db->where('tb_pasien.id_pasien', $this->session->userdata('id_pasien'));
        return $this->db->get();
    }

    public function selectKaryawan() {
        $this->db->select('tb_jadwal.*, tb_karyawan.nm_karyawan');
        $this->db->from('tb_jadwal');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan', 'left');
        return $this->db->get();
    }

    public function addPendaftaran($data) {
        return $this->db->insert($this->_table, $data);
    }

    public function editPendaftaran($id_pendaftaran, $data) {
        $this->db->where('id_pendaftaran', $id_pendaftaran);
        return $this->db->update($this->_table, $data);
    }

    public function verify($id_pendaftaran) {
        $this->db->set('status', 'Disetujui');
        $this->db->where('id_pendaftaran', $id_pendaftaran);
        $this->db->update($this->_table);
    }

    public function deletePendaftaran($id_pendaftaran) {
        $this->db->where('id_pendaftaran', $id_pendaftaran);
        return $this->db->delete($this->_table);
    }

    public function sendNotifPasien($id_pendaftaran) {
        $data = $this->db->query("SELECT tb_pasien.nm_pasien, tb_pasien.no_hp, tb_karyawan.nm_karyawan, tb_jadwal.hari, tb_jadwal.mulai, tb_jadwal.selesai, tb_pendaftaran.status
        FROM tb_user
        INNER JOIN tb_pasien ON tb_user.id_user = tb_pasien.id_user
        INNER JOIN tb_pendaftaran ON tb_pasien.id_pasien = tb_pendaftaran.id_pasien
        INNER JOIN tb_jadwal ON tb_pendaftaran.id_jadwal = tb_jadwal.id_jadwal
        INNER JOIN tb_karyawan ON tb_jadwal.id_karyawan = tb_karyawan.id_karyawan
        WHERE tb_user.jabatan = 'Pasien' AND tb_pendaftaran.id_pendaftaran ='".$id_pendaftaran."'")->result_array();
  
        $no_hp = $data[0]['no_hp'];
        $nm_pasien = $data[0]['nm_pasien'];
        $nm_karyawan = $data[0]['nm_karyawan'];
        $hari = $data[0]['hari'];
        $mulai = $data[0]['mulai'];
        $selesai = $data[0]['selesai'];
        $status = $data[0]['status'];
  
        $this->db->query("
        UPDATE tb_pendaftaran SET notif='Terkirim' WHERE id_pendaftaran = '".$id_pendaftaran."'");
  
        $userkey = $this->config->item('wa_userkey');
        $passkey = $this->config->item('wa_passkey');
        $url     = $this->config->item('wa_url');
  
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
            'userkey' => $userkey,
            'passkey' => $passkey,
            'to' => $no_hp,
            'message' => "Diberitahukan kepada $nm_pasien bahwa pendaftaran Anda telah $status. 
ID Pendaftaran: $id_pendaftaran
Nama Perawat: $nm_karyawan
Hari: $hari
Jam Mulai: $mulai
Jam Selesai: $selesai
Dimohon pasien dapat datang ke klinik sesuai dengan hari dan jam yang telah ditentukan. Terima kasih."
            
        ));
        $results = json_decode(curl_exec($curlHandle), true);
        curl_close($curlHandle);
    }

    public function sendNotifPerawat($id_pendaftaran) {
        $data = $this->db->query("SELECT tb_karyawan.nm_karyawan, tb_karyawan.no_hp, tb_pasien.nm_pasien, tb_jadwal.hari, tb_jadwal.mulai, tb_jadwal.selesai
        FROM tb_user
        INNER JOIN tb_karyawan ON tb_user.id_user = tb_karyawan.id_user
        INNER JOIN tb_jadwal ON tb_karyawan.id_karyawan = tb_jadwal.id_karyawan
        INNER JOIN tb_pendaftaran ON tb_jadwal.id_jadwal = tb_pendaftaran.id_jadwal
        INNER JOIN tb_pasien ON tb_pendaftaran.id_pasien = tb_pasien.id_pasien
        WHERE tb_user.jabatan = 'Perawat' AND tb_pendaftaran.id_pendaftaran ='".$id_pendaftaran."'")->result_array();
  
        $no_hp = $data[0]['no_hp'];
        $nm_karyawan = $data[0]['nm_karyawan'];
        $nm_pasien = $data[0]['nm_pasien'];
        $hari = $data[0]['hari'];
        $mulai = $data[0]['mulai'];
        $selesai = $data[0]['selesai'];
  
        $this->db->query("
        UPDATE tb_pendaftaran SET notif_perawat='Terkirim' WHERE id_pendaftaran = '".$id_pendaftaran."'");
  
        $userkey = $this->config->item('wa_userkey');
        $passkey = $this->config->item('wa_passkey');
        $url     = $this->config->item('wa_url');

        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
            'userkey' => $userkey,
            'passkey' => $passkey,
            'to' => $no_hp,
            'message' => "Kepada saudara $nm_karyawan tolong lekukan perawatan sesuai dengan data yang ada dibawah ini. 
ID Pendaftaran: $id_pendaftaran
Nama Pasien: $nm_pasien
Hari: $hari
Jam Mulai: $mulai
Jam Selesai: $selesai
Dimohon perawat dapat melakukan perawatan sesuai dengan hari dan jam yang telah dijadwalkan admin. Terima kasih."
        ));
        $results = json_decode(curl_exec($curlHandle), true);
        curl_close($curlHandle);
    }
}