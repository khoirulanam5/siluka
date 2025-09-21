<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['PendaftaranModel' => 'pendaftaran']);
        ispasien();
    }

    public function index() {
        $data['title'] = 'Pendaftaran Layanan Pasien';
        $data['pendaftaran'] = $this->pendaftaran->getPendaftaranByPasien()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pasien/pendaftaran/index', $data);
        $this->load->view('template/footer');
    }

    public function add() {
        $data['title'] = 'Tambah Data Pendaftaran Layanan';
        $data['pendaftaran'] = $this->pendaftaran->selectKaryawan()->result();

        $this->form_validation->set_rules('id_jadwal', 'ID Jadwal', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('pasien/pendaftaran/add', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'id_pendaftaran' => $this->pendaftaran->generateIdPendaftaran(),
                'id_pasien' => $this->session->userdata('id_pasien'),
                'id_jadwal' => $this->input->post('id_jadwal'),
                'status' => 'Proses',
                'tgl_pendaftaran' => date('Y-m-d')
            ];

            $this->pendaftaran->addPendaftaran($data);

            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Selamat', text:'Pendaftaran Berhasil, Jadwal Akan di Konfirmasi Oleh Admin', icon:'success'})</script>");
			redirect('pasien/pendaftaran');
        }
    }

    public function edit($id_pendaftaran) {
        $data['title'] = 'Edit Data Pendaftaran Layanan';
        $data['pendaftaran'] = $this->db->get_where('tb_pendaftaran', ['id_pendaftaran' => $id_pendaftaran])->row();
        $data['jadwal'] = $this->pendaftaran->selectKaryawan()->result();
    
        // Form validation
        $this->form_validation->set_rules('id_jadwal', 'ID Jadwal', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('pasien/pendaftaran/edit', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'id_jadwal' => $this->input->post('id_jadwal'),
            ];

            $this->pendaftaran->editPendaftaran($id_pendaftaran, $data);

            $this->session->set_flashdata("pesan", "<script> Swal.fire({title: 'Berhasil', text: 'Data Pendaftaran Berhasil Diperbarui', icon: 'success'})</script>");
            redirect('pasien/pendaftaran');
        }
    }
    
    public function delete($id_pendaftaran) {
        $this->pendaftaran->deletePendaftaran($id_pendaftaran);
        $this->session->set_flashdata("pesan", "<script> Swal.fire({title: 'Berhasil', text: 'Data Pendaftaran Berhasil Dihapus', icon: 'success'})</script>");
        redirect('pasien/pendaftaran');
    }
}