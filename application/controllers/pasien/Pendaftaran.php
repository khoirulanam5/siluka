<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Pendaftaran Layanan Pasien';

        $this->db->select('tb_pendaftaran.*, tb_pasien.*, tb_jadwal.*, tb_karyawan.*');
        $this->db->from('tb_pendaftaran');
        $this->db->join('tb_pasien', 'tb_pendaftaran.id_pasien = tb_pasien.id_pasien');
        $this->db->join('tb_jadwal', 'tb_pendaftaran.id_jadwal = tb_jadwal.id_jadwal');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan');
        $this->db->where('tb_pasien.id_pasien', $this->session->userdata('id_pasien'));
        $data['pendaftaran'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pasien/pendaftaran/index', $data);
        $this->load->view('template/footer');
    }

    public function generateIdPendaftaran() {
        $unik = 'PDF';
        $kode = $this->db->query("SELECT MAX(id_pendaftaran) LAST_NO FROM tb_pendaftaran WHERE id_pendaftaran LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 3, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function add() {
        $data['title'] = 'Tambah Data Pendaftaran Layanan';

        // Fetch available jadwal options
        $this->db->select('tb_jadwal.*, tb_karyawan.nm_karyawan');
        $this->db->from('tb_jadwal');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan', 'left');
        $data['pendaftaran'] = $this->db->get()->result();

        $this->form_validation->set_rules('id_jadwal', 'ID Jadwal', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('pasien/pendaftaran/add', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'id_pendaftaran' => $this->generateIdPendaftaran(),
                'id_pasien' => $this->session->userdata('id_pasien'),
                'id_jadwal' => $this->input->post('id_jadwal'),
                'status' => 'Proses',
                'tgl_pendaftaran' => date('Y-m-d')
            ];

            $this->db->insert('tb_pendaftaran', $data);

            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Selamat', text:'Pendaftaran Berhasil, Jadwal Akan di Konfirmasi Oleh Admin', icon:'success'})</script>");
			redirect('pasien/pendaftaran');
        }
    }

    public function edit($id_pendaftaran) {
        $data['title'] = 'Edit Data Pendaftaran Layanan';
    
        // Fetch the selected pendaftaran data
        $data['pendaftaran'] = $this->db->get_where('tb_pendaftaran', ['id_pendaftaran' => $id_pendaftaran])->row();
    
        // Fetch available jadwal options
        $this->db->select('tb_jadwal.*, tb_karyawan.nm_karyawan');
        $this->db->from('tb_jadwal');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan', 'left');
        $data['jadwal'] = $this->db->get()->result();
    
        // Form validation
        $this->form_validation->set_rules('id_jadwal', 'ID Jadwal', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('pasien/pendaftaran/edit', $data);
            $this->load->view('template/footer');
        } else {
            $updateData = [
                'id_jadwal' => $this->input->post('id_jadwal'),
            ];
    
            $this->db->where('id_pendaftaran', $id_pendaftaran);
            $this->db->update('tb_pendaftaran', $updateData);
    
            $this->session->set_flashdata("pesan", "<script> Swal.fire({title: 'Berhasil', text: 'Data Pendaftaran Berhasil Diperbarui', icon: 'success'})</script>");
            redirect('pasien/pendaftaran');
        }
    }
    
    public function delete($id_pendaftaran) {
        $this->db->where('id_pendaftaran', $id_pendaftaran);
        $this->db->delete('tb_pendaftaran');
        $this->session->set_flashdata("pesan", "<script> Swal.fire({title: 'Berhasil', text: 'Data Pendaftaran Berhasil Dihapus', icon: 'success'})</script>");
        redirect('pasien/pendaftaran');
    }
}