<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homecare extends CI_Controller {

    public function __construct() {
        parent::__construct();
        isadmin();
    }

    public function index() {
        $data['title'] = 'Verifikasi Pelayanan Homecare';

        $this->db->select('tb_homecare.*, tb_pasien.*, tb_karyawan.*');
        $this->db->from('tb_homecare');
        $this->db->join('tb_pasien', 'tb_homecare.id_pasien = tb_pasien.id_pasien', 'left');
        $this->db->join('tb_karyawan', 'tb_homecare.id_karyawan = tb_karyawan.id_karyawan', 'left');
        $data['homecare'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/homecare/index', $data);
        $this->load->view('template/footer');
    }

    public function verifikasi($id_homecare) {
        $data['title'] = 'Tambahkan Perawat Untuk Layanan Homecare'; 
        $data['id_homecare'] = $id_homecare;

        $this->db->select('tb_karyawan.id_karyawan, tb_user.username');
        $this->db->from('tb_karyawan');
        $this->db->join('tb_user', 'tb_karyawan.id_user = tb_user.id_user', 'inner');
        $this->db->where('tb_user.jabatan', 'Perawat');
        $data['perawat'] = $this->db->get()->result();        

        $this->form_validation->set_rules('id_karyawan', 'ID Karyawan', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/homecare/verifikasi', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'id_karyawan' => $this->input->post('id_karyawan'),
                'status' => 'Terverifikasi'
            ];

            $this->db->where('id_homecare', $id_homecare);
            $this->db->update('tb_homecare', $data);

            $this->sendNotifPasien($id_homecare);
            $this->sendNotifPerawat($id_homecare);

            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Selamat', text:'Verifikasi Berhasil', icon:'success'})</script>");
			redirect('admin/homecare');
        }
    }

    public function delete($id_homecare) {
        $this->db->trans_start();
        $this->db->where('id_homecare', $id_homecare);
        $this->db->delete('tb_hasil');

        $this->db->where('id_homecare', $id_homecare);
        $this->db->delete('tb_homecare');
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Data homecare berhasil dihapus', icon:'success'})</script>");
        redirect('admin/homecare');
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
  
        $userkey = "a859631d94df";
        $passkey = "3f109df052a53eaa3237060a";
        $url = "https://console.zenziva.net/wareguler/api/sendWA/";
  
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
  
        $userkey = "a859631d94df";
        $passkey = "3f109df052a53eaa3237060a";
        $url = "https://console.zenziva.net/wareguler/api/sendWA/";
  
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