<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homecare extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['HomecareModel' => 'homecare']);
        isadmin();
    }

    public function index() {
        $data['title'] = 'Verifikasi Pelayanan Homecare';
        $data['homecare'] = $this->homecare->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/homecare/index', $data);
        $this->load->view('template/footer');
    }

    public function verifikasi($id_homecare) {
        $data['title'] = 'Tambahkan Perawat Untuk Layanan Homecare'; 
        $data['id_homecare'] = $id_homecare;

        $data['perawat'] = $this->homecare->selectPerawat()->result();

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

            $this->homecare->editHomecare($data, $id_homecare);

            $this->homecare->sendNotifPasien($id_homecare);
            $this->homecare->sendNotifPerawat($id_homecare);

            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Selamat', text:'Verifikasi Berhasil', icon:'success'})</script>");
			redirect('admin/homecare');
        }
    }

    public function delete($id_homecare) {
        $this->homecare->deleteHomecare($id_homecare);
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Data homecare berhasil dihapus', icon:'success'})</script>");
        redirect('admin/homecare');
    }
}