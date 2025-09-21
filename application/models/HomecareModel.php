<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class HomecareModel extends CI_Model {

    private $_table = 'tb_homecare';

    public function generateIdHomecare() {
        $unik = 'HMCR';
        $kode = $this->db->query("SELECT MAX(id_homecare) LAST_NO FROM tb_homecare WHERE id_homecare LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 4, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function getAll() {
        $this->db->select('tb_homecare.*, tb_pasien.*, tb_karyawan.*');
        $this->db->from('tb_homecare');
        $this->db->join('tb_pasien', 'tb_homecare.id_pasien = tb_pasien.id_pasien', 'left');
        $this->db->join('tb_karyawan', 'tb_homecare.id_karyawan = tb_karyawan.id_karyawan', 'left');
        return $this->db->get();
    }

    public function getHomecare() {
        $this->db->select('tb_homecare.*, tb_pasien.*, tb_karyawan.*');
        $this->db->from('tb_homecare');
        $this->db->join('tb_pasien', 'tb_homecare.id_pasien = tb_pasien.id_pasien', 'left');
        $this->db->join('tb_karyawan', 'tb_homecare.id_karyawan = tb_karyawan.id_karyawan', 'left');
        $this->db->where('tb_karyawan.id_karyawan', $this->session->userdata('id_karyawan'));
        $this->db->group_start();
        $this->db->where('tb_homecare.status', 'Terverifikasi');
        $this->db->or_where('tb_homecare.status', 'Selesai');
        $this->db->group_end();
        return $this->db->get();
    }

    public function getUserdata() {
        $this->db->select('tb_homecare.*, tb_pasien.*, tb_karyawan.*');
        $this->db->from('tb_homecare');
        $this->db->join('tb_pasien', 'tb_homecare.id_pasien = tb_pasien.id_pasien', 'left');
        $this->db->join('tb_karyawan', 'tb_homecare.id_karyawan = tb_karyawan.id_karyawan', 'left');
        $this->db->where('tb_karyawan.id_karyawan', $this->session->userdata('id_karyawan'));
        $this->db->where('tb_homecare.status', 'Terverifikasi');
        return $this->db->get();
    }

    public function getHomecareByPasien() {
        $this->db->select('tb_homecare.*, tb_pasien.*, tb_karyawan.*');
        $this->db->from('tb_homecare');
        $this->db->join('tb_pasien', 'tb_homecare.id_pasien = tb_pasien.id_pasien', 'left');
        $this->db->join('tb_karyawan', 'tb_homecare.id_karyawan = tb_karyawan.id_karyawan', 'left');
        $this->db->where('tb_pasien.id_pasien', $this->session->userdata('id_pasien'));
        return $this->db->get();
    }

    public function selectPerawat() {
        $this->db->select('tb_karyawan.*, tb_user.*');
        $this->db->from('tb_karyawan');
        $this->db->join('tb_user', 'tb_karyawan.id_user = tb_user.id_user', 'inner');
        $this->db->where('tb_user.jabatan', 'Perawat');
        return $this->db->get();
    }

    public function addHomecare($data) {
        return $this->db->insert($this->_table, $data);
    }

    public function editHomecare($data, $id_homecare) {
        $this->db->where('id_homecare', $id_homecare);
        return $this->db->update($this->_table, $data);
    }

    public function deleteHomecare($id_homecare) {
        $this->db->trans_start();
        $this->db->where('id_homecare', $id_homecare);
        $this->db->delete('tb_hasil');

        $this->db->where('id_homecare', $id_homecare);
        $this->db->delete('tb_homecare');
        return $this->db->trans_complete();
    }

    public function sendNotifPasien($id_homecare) {
        $data = $this->db->query("SELECT tb_pasien.nm_pasien, tb_pasien.no_hp, tb_karyawan.nm_karyawan, tb_homecare.nama_perawatan, tb_homecare.tgl_kunjungan, tb_homecare.jam, tb_homecare.alamat_kunjungan, tb_homecare.status
        FROM tb_user
        INNER JOIN tb_pasien ON tb_user.id_user = tb_pasien.id_user
        INNER JOIN tb_homecare ON tb_pasien.id_pasien = tb_homecare.id_pasien
        INNER JOIN tb_karyawan ON tb_homecare.id_karyawan = tb_karyawan.id_karyawan
        WHERE tb_user.jabatan = 'Pasien' AND tb_homecare.id_homecare ='".$id_homecare."'")->result_array();
  
        $nm_pasien = $data[0]['nm_pasien'];
        $no_hp = $data[0]['no_hp'];
        $nm_karyawan = $data[0]['nm_karyawan'];
        $nama_perawatan = $data[0]['nama_perawatan'];
        $tgl_kunjungan = $data[0]['tgl_kunjungan'];
        $jam = $data[0]['jam'];
        $alamat = $data[0]['alamat_kunjungan'];
        $status = $data[0]['status'];
  
        $this->db->query("
        UPDATE tb_homecare SET notif='Terkirim' WHERE id_homecare = '".$id_homecare."'");
  
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
            'message' => "Diberitahukan kepada $nm_pasien bahwa pendaftaran layanan homecare Anda telah $status. 
ID Homecare: $id_homecare
Nama Perawat: $nm_karyawan
Jenis Luka: $nama_perawatan
Tanggal Kunjungan: ".do_formal_date($tgl_kunjungan)."
Pukul Waktu: $jam
Alamat Rumah: $alamat
Dimohon pasien dapat standby dirumah pada waktu kunjungan perawatan (Homecare). Terima kasih."
            
        ));
        $results = json_decode(curl_exec($curlHandle), true);
        curl_close($curlHandle);
    }

    public function sendNotifPerawat($id_homecare) {
        $data = $this->db->query("SELECT tb_pasien.nm_pasien, tb_pasien.no_hp, tb_karyawan.nm_karyawan, tb_homecare.nama_perawatan, tb_homecare.tgl_kunjungan, tb_homecare.jam, tb_homecare.alamat_kunjungan, tb_homecare.status
        FROM tb_user
        INNER JOIN tb_pasien ON tb_user.id_user = tb_pasien.id_user
        INNER JOIN tb_homecare ON tb_pasien.id_pasien = tb_homecare.id_pasien
        INNER JOIN tb_karyawan ON tb_homecare.id_karyawan = tb_karyawan.id_karyawan
        WHERE tb_user.jabatan = 'Pasien' AND tb_homecare.id_homecare ='".$id_homecare."'")->result_array();
  
        $nm_pasien = $data[0]['nm_pasien'];
        $no_hp = $data[0]['no_hp'];
        $nm_karyawan = $data[0]['nm_karyawan'];
        $nama_perawatan = $data[0]['nama_perawatan'];
        $tgl_kunjungan = $data[0]['tgl_kunjungan'];
        $jam = $data[0]['jam'];
        $alamat = $data[0]['alamat_kunjungan'];
        $status = $data[0]['status'];
  
        $this->db->query("
        UPDATE tb_homecare SET notif_perawat='Terkirim' WHERE id_homecare = '".$id_homecare."'");
  
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
            'message' => "Kepada saudara $nm_karyawan tolong lekukan perawatan homecare sesuai dengan data yang ada dibawah ini. 
ID Homecare: $id_homecare
Nama Pasien: $nm_pasien
Jenis Luka: $nama_perawatan
Tanggal Kunjungan: ".do_formal_date($tgl_kunjungan)."
Pukul Waktu: $jam
Alamat Rumah: $alamat
Dimohon perawat dapat melakukan perawatan homecare sesuai dengan tanggal dan jam yang telah dijadwalkan admin. Terima kasih."
            
        ));
        $results = json_decode(curl_exec($curlHandle), true);
        curl_close($curlHandle);
    }
}
