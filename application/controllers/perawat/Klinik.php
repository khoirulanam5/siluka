<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klinik extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Perawatan Klinik';

        $this->db->select('tb_perawatan.*, tb_pendaftaran.*, tb_pasien.*, tb_jadwal.*, tb_karyawan.*, tb_hasil.*');
        $this->db->from('tb_perawatan');
        $this->db->join('tb_pendaftaran', 'tb_perawatan.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'right');
        $this->db->join('tb_pasien', 'tb_pendaftaran.id_pasien = tb_pasien.id_pasien', 'right');
        $this->db->join('tb_jadwal', 'tb_pendaftaran.id_jadwal = tb_jadwal.id_jadwal', 'inner');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan', 'inner');
        $this->db->join('tb_hasil', 'tb_perawatan.id_perawatan = tb_hasil.id_perawatan', 'left');
        $this->db->where('tb_jadwal.jenis_perawatan', 'Klinik');
        $this->db->where('tb_jadwal.id_karyawan', $this->session->userdata('id_karyawan'));
        $data['perawatan'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('perawat/klinik/index', $data);
        $this->load->view('template/footer');
    }

    public function generateIdPerawatan() {
        $unik = 'PRT';
        $kode = $this->db->query("SELECT MAX(id_perawatan) LAST_NO FROM tb_perawatan WHERE id_perawatan LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 3, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function generateIdHasil() {
        $unik = 'H';
        $kode = $this->db->query("SELECT MAX(id_hasil) LAST_NO FROM tb_hasil WHERE id_hasil LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 1, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function generateIdBayar() {
        $unik = 'BYR';
        $kode = $this->db->query("SELECT MAX(id_pembayaran) LAST_NO FROM tb_pembayaran WHERE id_pembayaran LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 3, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function perawatan($id_pendaftaran) {
        $data['title'] = 'Proses Perawatan Pasien';
    
        // Ambil data perawatan
        $this->db->select('tb_perawatan.*, tb_pendaftaran.*, tb_pasien.*, tb_jadwal.*, tb_karyawan.*');
        $this->db->from('tb_perawatan');
        $this->db->join('tb_pendaftaran', 'tb_perawatan.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'right');
        $this->db->join('tb_pasien', 'tb_pendaftaran.id_pasien = tb_pasien.id_pasien', 'right');
        $this->db->join('tb_jadwal', 'tb_pendaftaran.id_jadwal = tb_jadwal.id_jadwal', 'inner');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan', 'inner');
        $this->db->where('tb_jadwal.jenis_perawatan', 'Klinik');
        $this->db->where('tb_jadwal.id_karyawan', $this->session->userdata('id_karyawan'));
        $data['perawatan'] = $this->db->get()->result();
    
        $data['id_pendaftaran'] = $id_pendaftaran; // Pastikan diteruskan ke view
    
        // Validasi form
        $this->form_validation->set_rules('nm_perawatan', 'Nama Perawatan', 'required');
        $this->form_validation->set_rules('biaya_perawatan', 'Biaya Perawatan', 'required');
        $this->form_validation->set_rules('catatan', 'Catatan', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('perawat/klinik/perawatan', $data); // Pastikan $data diteruskan
            $this->load->view('template/footer');
        } else {
            // Proses simpan data
            $data = [
                'id_perawatan' => $this->generateIdPerawatan(),
                'id_pendaftaran' => $id_pendaftaran,
                'nm_perawatan' => $this->input->post('nm_perawatan'),
                'tgl_perawatan' => date('Y-m-d'),
                'biaya_perawatan' => $this->input->post('biaya_perawatan'),
                'catatan' => $this->input->post('catatan')
            ];
    
            $this->db->insert('tb_perawatan', $data);
    
            $hasil = [
                'id_hasil' => $this->generateIdHasil(),
                'id_perawatan' => $data['id_perawatan'],
                'tgl_perawatan' => date('Y-m-d'),
                'status_perawatan' => 'Perawatan Klinik Selesai'
            ];
    
            $this->db->insert('tb_hasil', $hasil);

            $bayar = [
                'id_pembayaran' => $this->generateIdBayar(),
                'id_perawatan' => $data['id_perawatan']
            ];

            $this->db->insert('tb_pembayaran', $bayar);
    
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Perawatan Berhasil dilakukan', icon:'success'})</script>");
            redirect('perawat/hasil');
        }
    }    
}