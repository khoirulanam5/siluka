<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['JadwalModel' => 'jadwal']);
        isadmin();
    }

    public function index() {
        $data['title'] = 'Jadwal Perawatan';
        $data['jadwal'] = $this->jadwal->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/jadwal/index', $data);
        $this->load->view('template/footer');
    }

    public function add() {
        $data['title'] = 'Tambah Jadwal';
        $data['perawat'] = $this->jadwal->selectPerawat()->result();

        $this->form_validation->set_rules('id_karyawan', 'ID Perawat', 'required');
        $this->form_validation->set_rules('hari', 'Hari', 'required');
        $this->form_validation->set_rules('mulai', 'Waktu Mulai', 'required');
        $this->form_validation->set_rules('selesai', 'Waktu Selesai', 'required');
        $this->form_validation->set_rules('jenis_perawatan', 'Jenis Perawatan', 'required');

        if  ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/jadwal/add', $data);
            $this->load->view('template/footer');
        } else {
            $jadwal = [
                'id_jadwal' => $this->jadwal->generateIdJadwal(),
                'id_karyawan' => $this->input->post('id_karyawan'),
                'hari' => $this->input->post('hari'),
                'mulai' => $this->input->post('mulai'),
                'selesai' => $this->input->post('selesai'),
                'jenis_perawatan' => $this->input->post('jenis_perawatan')
            ];
            $this->jadwal->addJadwal($jadwal);

            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Selamat', text:'Jadwal Berhasil Ditambahkan', icon:'success'})</script>");
			redirect('admin/jadwal');
        }
    }

    public function edit($id_jadwal) {
        $data['title'] = 'Edit Jadwal';
        $data['perawat'] = $this->jadwal->selectPerawat()->result();
        $data['jadwal'] = $this->jadwal->getById($id_jadwal)->row();

        $this->form_validation->set_rules('id_karyawan', 'ID Perawat', 'required');
        $this->form_validation->set_rules('hari', 'Hari', 'required');
        $this->form_validation->set_rules('mulai', 'Waktu Mulai', 'required');
        $this->form_validation->set_rules('selesai', 'Waktu Selesai', 'required');
        $this->form_validation->set_rules('jenis_perawatan', 'Jenis Perawatan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/jadwal/edit', $data);
            $this->load->view('template/footer');
        } else {
            $jadwal = [
                'id_jadwal' => $id_jadwal,
                'id_karyawan' => $this->input->post('id_karyawan'),
                'hari' => $this->input->post('hari'),
                'mulai' => $this->input->post('mulai'),
                'selesai' => $this->input->post('selesai'),
                'jenis_perawatan' => $this->input->post('jenis_perawatan')
            ];
            $this->jadwal->editJadwal($id_jadwal, $jadwal);

            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Selamat', text:'Jadwal Berhasil Diupdate', icon:'success'})</script>");
			redirect('admin/jadwal');
        }
    }

    public function delete($id_jadwal) {
        $this->jadwal->deleteJadwal($id_jadwal);
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Hapus data jadwal berhasil', icon:'success'})</script>");
		redirect('admin/jadwal');
    }
}