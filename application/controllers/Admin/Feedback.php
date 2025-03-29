<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Kepuasan Pelanggan';
        
        $this->db->select('tb_saran.*, tb_pasien.*');
        $this->db->from('tb_saran');
        $this->db->join('tb_pasien', 'tb_saran.id_pasien = tb_pasien.id_pasien');
        $data['feedback'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/feedback/index', $data);
        $this->load->view('template/footer');
    }

    public function delete($id_saran) {
        $this->db->where('id_saran', $id_saran);
        $this->db->delete('tb_saran');
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Hapus data saran berhasil', icon:'success'})</script>");
		redirect('admin/feedback');
    }
}