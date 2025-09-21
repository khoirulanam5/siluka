<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['HasilModel' => 'hasil', 'PembayaranModel' => 'pembayaran']);
        ispasien();
    }

    public function index() {
        $data['title'] = 'Riwayat Perawatan Klinik';
        $data['hasil'] = $this->hasil->getKlinikByPasien()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pasien/hasil/klinik', $data);
        $this->load->view('template/footer');
    }

    public function homecare() {
        $data['title'] = 'Riwayat Perawatan Homecare';
        $data['hasil'] = $this->hasil->getHomecareByPasien()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pasien/hasil/homecare', $data);
        $this->load->view('template/footer');
    }

    public function bayar($id_pembayaran) {
        $data['title'] = 'Form Pembayaran';
        $data['id_pembayaran'] = $id_pembayaran;
        $data['total'] = $this->pembayaran->getBayarById($id_pembayaran)->row();

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
            $this->load->view('pasien/hasil/bayar', $data);
            $this->load->view('template/footer');
            return;
        }
    
        $image = $this->upload->data('file_name');
        $bayar = [
            'tgl_bayar' => date('Y-m-d'),
            'bayar' => $image
        ];
    
        $this->pembayaran->editBayar($id_pembayaran, $bayar);
    
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