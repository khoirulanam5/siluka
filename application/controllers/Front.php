<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['SaranModel' => 'saran', 'JadwalModel' => 'jadwal']);
    }

    public function index() {
        $this->load->view('front/header');
        $this->load->view('front/home');
        $this->load->view('front/footer');
    }

    public function feedback() {
        $this->load->view('front/header');
        $this->load->view('front/feedback');
        $this->load->view('front/footer');
    }

    public function feedback_v() {
        $this->form_validation->set_rules('saran', 'Saran', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('front/head');
            $this->load->view('front/feedback_v');
            $this->load->view('front/footer');
        } else {
            $saran = [
                'id_saran' => $this->saran->generateIdSaran(),
                'id_pasien' => $this->session->userdata('id_pasien'),
                'saran' => $this->input->post('saran'),
                'tgl' => date('Y-m-d')
            ];

            $this->saran->addSaran($saran);

            $this->session->set_flashdata("pesan", "<script> Swal.fire({title:'Selamat', text:'Terima Kasih telah meluangkan waktu untuk mengisi feedback', icon:'success'})</script>");
            redirect('pasien/pembayaran');
        }
    }

    public function jadwal_v() {
        $username = $this->input->get('username');
        $result = $this->jadwal->getByUsername($username)->row_array();

        if (!$result) {
            $this->session->set_flashdata("pesan", "<script> Swal.fire({title:'Gagal', text:'Username tidak ditemukan atau tidak sesuai.', icon:'error'})</script>");
            redirect('front/home');
            return;
        }

        $this->session->set_userdata('id_pasien', $result['id_pasien']);

        $data['pasien'] = $result;
        $data['jadwal'] = $this->jadwal->getAll()->result();
        
        $this->load->view('front/head');
        $this->load->view('front/jadwal_v', $data);
        $this->load->view('front/footer');
    }

    public function saran() {
        $username = $this->input->get('username');
        $result = $this->saran->getByusername($username)->row_array();

        if (!$result) {
            $this->session->set_flashdata("pesan", "<script> Swal.fire({title:'Gagal', text:'Username tidak ditemukan atau tidak sesuai.', icon:'error'})</script>");
            redirect('front/feedback');
            return;
        }

        $this->session->set_userdata('id_pasien', $result['id_pasien']);

        $data['pasien'] = $result;
        $data['feedback'] = $this->saran->getAll()->result();

        $this->load->view('front/head');
        $this->load->view('front/saran', $data);
        $this->load->view('front/footer');
    }
}