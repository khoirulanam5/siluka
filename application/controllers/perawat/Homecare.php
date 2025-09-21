<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homecare extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['HomecareModel' => 'homecare', 'HasilModel' => 'hasil', 'PembayaranModel' => 'pembayaran']);
        isperawat();
    }

    public function index() {
        $data['title'] = 'Perawatan Homecare';
        $data['homecare'] = $this->homecare->getHomecare()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('perawat/homecare/index', $data);
        $this->load->view('template/footer');
    }

    public function perawatan($id_homecare) {
        $data['title'] = 'Layanan Perawatan Homecare';
        $data['homecare'] = $this->homecare->getUserdata()->result();
        $data['id_homecare'] = $id_homecare;

        $this->form_validation->set_rules('biaya_homecare', 'Biaya', 'required');
        $this->form_validation->set_rules('catatan_kunjungan', 'Catatan', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('perawat/homecare/perawatan', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'catatan_kunjungan' => $this->input->post('catatan_kunjungan'),
                'biaya_homecare' => $this->input->post('biaya_homecare'),
                'status' => 'Selesai'
            ];
            $this->homecare->editHomecare($data, $id_homecare);

            $hasil = [
                'id_hasil' => $this->hasil->generateIdHasil(),
                'id_homecare' => $id_homecare,
                'tgl_perawatan' => date('Y-m-d'),
                'status_perawatan' => 'Perawatan Homecare Selesai'
            ];
            $this->hasil->addHasil($hasil);

            $bayar = [
                'id_pembayaran' => $this->pembayaran->generateIdBayar(),
                'id_homecare' => $id_homecare
            ];
            $this->pembayaran->addBayar($bayar);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Perawatan Berhasil dilakukan', icon:'success'})</script>");
            redirect('perawat/hasil/homecare');
        }
    }
}