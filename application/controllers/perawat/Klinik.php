<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klinik extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['PerawatanModel' => 'perawatan', 'HasilModel' => 'hasil', 'PembayaranModel' => 'pembayaran']);
        isperawat();
    }

    public function index() {
        $data['title'] = 'Perawatan Klinik';

        $data['perawatan'] = $this->perawatan->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('perawat/klinik/index', $data);
        $this->load->view('template/footer');
    }

    public function perawatan($id_pendaftaran) {
        $data['title'] = 'Proses Perawatan Pasien';
        $data['perawatan'] = $this->perawatan->getPerawatan()->result();
        $data['id_pendaftaran'] = $id_pendaftaran;

        $this->form_validation->set_rules('nm_perawatan', 'Nama Perawatan', 'required');
        $this->form_validation->set_rules('biaya_perawatan', 'Biaya Perawatan', 'required');
        $this->form_validation->set_rules('catatan', 'Catatan', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('perawat/klinik/perawatan', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'id_perawatan' => $this->perawatan->generateIdPerawatan(),
                'id_pendaftaran' => $id_pendaftaran,
                'nm_perawatan' => $this->input->post('nm_perawatan'),
                'tgl_perawatan' => date('Y-m-d'),
                'biaya_perawatan' => $this->input->post('biaya_perawatan'),
                'catatan' => $this->input->post('catatan')
            ];
            $this->perawatan->addPerawatan($data);
    
            $hasil = [
                'id_hasil' => $this->hasil->generateIdHasil(),
                'id_perawatan' => $data['id_perawatan'],
                'tgl_perawatan' => date('Y-m-d'),
                'status_perawatan' => 'Perawatan Klinik Selesai'
            ];
            $this->hasil->addHasil($hasil);

            $bayar = [
                'id_pembayaran' => $this->pembayaran->generateIdBayar(),
                'id_perawatan' => $data['id_perawatan']
            ];
            $this->pembayaran->addBayar($bayar);
    
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Perawatan Berhasil dilakukan', icon:'success'})</script>");
            redirect('perawat/hasil');
        }
    }    
}