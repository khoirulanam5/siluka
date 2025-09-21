<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['HasilModel' => 'hasil']);
        ispasien();
    }

    public function index() {
        $data['title'] = 'Riwayat Perawatan Klinik';

        $this->db->select('tb_perawatan.*, tb_pendaftaran.*, tb_pasien.*, tb_jadwal.*, tb_karyawan.*, tb_hasil.*, tb_pembayaran.*');
        $this->db->from('tb_perawatan');
        $this->db->join('tb_pendaftaran', 'tb_perawatan.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'right');
        $this->db->join('tb_pasien', 'tb_pendaftaran.id_pasien = tb_pasien.id_pasien', 'right');
        $this->db->join('tb_jadwal', 'tb_pendaftaran.id_jadwal = tb_jadwal.id_jadwal', 'inner');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan', 'inner');
        $this->db->join('tb_hasil', 'tb_perawatan.id_perawatan = tb_hasil.id_perawatan', 'left');
        $this->db->join('tb_pembayaran', 'tb_perawatan.id_perawatan = tb_pembayaran.id_perawatan', 'left');
        $this->db->where('tb_hasil.status_perawatan', 'Perawatan Klinik Selesai');
        $this->db->where('tb_pasien.id_pasien', $this->session->userdata('id_pasien'));
        $data['hasil'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pasien/hasil/klinik', $data);
        $this->load->view('template/footer');
    }

    public function homecare() {
        $data['title'] = 'Riwayat Perawatan Homecare';

        $this->db->select('tb_homecare.*, tb_pasien.*, tb_karyawan.*, tb_pembayaran.*, tb_hasil.*');
        $this->db->from('tb_homecare');
        $this->db->join('tb_pasien', 'tb_homecare.id_pasien = tb_pasien.id_pasien', 'inner');
        $this->db->join('tb_karyawan', 'tb_homecare.id_karyawan = tb_karyawan.id_karyawan', 'inner');
        $this->db->join('tb_pembayaran', 'tb_homecare.id_homecare = tb_pembayaran.id_homecare', 'inner');
        $this->db->join('tb_hasil', 'tb_hasil.id_homecare = tb_homecare.id_homecare', 'inner');
        $this->db->where('tb_hasil.status_perawatan', 'Perawatan Homecare selesai');
        $this->db->where('tb_pasien.id_pasien', $this->session->userdata('id_pasien'));
        $data['hasil'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pasien/hasil/homecare', $data);
        $this->load->view('template/footer');
    }

    public function bayar($id_pembayaran) {
        $data['title'] = 'Form Pembayaran';
        $data['id_pembayaran'] = $id_pembayaran;

        $this->db->select('tb_pembayaran.*, tb_perawatan.biaya_perawatan, tb_homecare.biaya_homecare');
        $this->db->from('tb_pembayaran');
        $this->db->join('tb_perawatan', 'tb_perawatan.id_perawatan = tb_pembayaran.id_perawatan', 'left');
        $this->db->join('tb_homecare', 'tb_homecare.id_homecare = tb_pembayaran.id_homecare', 'left');
        $this->db->where('tb_pembayaran.id_pembayaran', $id_pembayaran);
        $data['total'] = $this->db->get()->row(); // Mengambil satu baris saja
    
        // Validasi ID pembayaran
        $cek_pembayaran = $this->db->get_where('tb_pembayaran', ['id_pembayaran' => $id_pembayaran])->row();
        if (!$cek_pembayaran) {
            $this->session->set_flashdata("pesan", "<script> Swal.fire({title:'Error', text:'ID Pembayaran tidak valid!', icon:'error'})</script>");
            redirect('pasien/hasil');
        }
    
        // Konfigurasi upload file
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2048';
        $config['upload_path'] = './assets/bayar/';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, true);
        }
        $this->load->library('upload', $config);
    
        if (!$this->upload->do_upload('bayar')) {
            $data['error'] = $this->upload->display_errors();
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('pasien/hasil/bayar', $data); // Tampilkan error di halaman ini
            $this->load->view('template/footer');
            return;
        }
    
        $image = $this->upload->data('file_name');
        $bayar = [
            'tgl_bayar' => date('Y-m-d'),
            'bayar' => $image
        ];
    
        $this->db->where('id_pembayaran', $id_pembayaran);
        $this->db->update('tb_pembayaran', $bayar);
    
        $this->session->set_flashdata("pesan", "<script> Swal.fire({title:'Berhasil', text:'Pembayaran Berhasil Dikirim', icon:'success'})</script>");
        redirect('front/feedback_v');
    }
    
    public function nota_k($id_perawatan) {
        $data['hasil'] = $this->hasil->cetakNotaKlinik($id_perawatan)->result();

        $this->load->view('pasien/hasil/nota_klinik', $data);
    }

    public function nota_h($id_homecare) {
        $data['hasil'] = $this->hasil->cetakNotaHomecare($id_homecare)->result();

        $this->load->view('pasien/hasil/nota_homecare', $data);
    }
}