<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Jadwal Perawatan';
        
        $this->db->select('tb_jadwal.*, tb_karyawan.*');
        $this->db->from('tb_jadwal');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan');
        $data['jadwal'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/jadwal/index', $data);
        $this->load->view('template/footer');
    }

    public function generateIdJadwal() {
        $unik = 'JDL';
        $kode = $this->db->query("SELECT MAX(id_jadwal) LAST_NO FROM tb_jadwal WHERE id_jadwal LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 3, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function add() {
        $data['title'] = 'Tambah Jadwal';

        $this->db->select('tb_jadwal.*, tb_karyawan.*, tb_user.*');
        $this->db->from('tb_jadwal');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan', 'right');
        $this->db->join('tb_user', 'tb_karyawan.id_user = tb_user.id_user', 'right');
        $this->db->where('tb_user.jabatan', 'Perawat');
        $data['perawat'] = $this->db->get()->result();

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
                'id_jadwal' => $this->generateIdJadwal(),
                'id_karyawan' => $this->input->post('id_karyawan'),
                'hari' => $this->input->post('hari'),
                'mulai' => $this->input->post('mulai'),
                'selesai' => $this->input->post('selesai'),
                'jenis_perawatan' => $this->input->post('jenis_perawatan')
            ];
            $this->db->insert('tb_jadwal', $jadwal);

            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Selamat', text:'Jadwal Berhasil Ditambahkan', icon:'success'})</script>");
			redirect('admin/jadwal');
        }
    }

    public function edit($id_jadwal) {
        $data['title'] = 'Edit Jadwal';

        $this->db->select('tb_jadwal.*, tb_karyawan.*, tb_user.*');
        $this->db->from('tb_jadwal');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan', 'right');
        $this->db->join('tb_user', 'tb_karyawan.id_user = tb_user.id_user', 'right');
        $this->db->where('tb_user.jabatan', 'Perawat');
        $data['perawat'] = $this->db->get()->result();

        $this->db->select('tb_jadwal.*, tb_karyawan.*');
        $this->db->from('tb_jadwal');
        $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan');
        $this->db->where('tb_jadwal.id_jadwal', $id_jadwal);
        $data['jadwal'] = $this->db->get()->row();

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
            $this->db->where('id_jadwal', $id_jadwal);
            $this->db->update('tb_jadwal', $jadwal);

            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Selamat', text:'Jadwal Berhasil Diupdate', icon:'success'})</script>");
			redirect('admin/jadwal');
        }
    }

    public function delete($id_jadwal) {
        $this->db->where('id_jadwal', $id_jadwal);
        $this->db->delete('tb_jadwal');
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Hapus data jadwal berhasil', icon:'success'})</script>");
		redirect('admin/jadwal');
    }
}