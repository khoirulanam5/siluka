<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['SaranModel' => 'saran']);
        isadmin();
    }

    public function index() {
        $data['title'] = 'Kepuasan Pelanggan';
        $data['feedback'] = $this->saran->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/feedback/index', $data);
        $this->load->view('template/footer');
    }

    public function delete($id_saran) {
        $this->saran->deleteSaran($id_saran);
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Hapus data saran berhasil', icon:'success'})</script>");
		redirect('admin/feedback');
    }
}