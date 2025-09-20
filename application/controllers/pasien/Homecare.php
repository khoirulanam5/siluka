<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homecare extends CI_Controller {

    public function __construct() {
        parent::__construct();
        ispasien();
    }

    public function index() {
        $data['title'] = 'Pelayanan Homecare';

        $this->db->select('tb_homecare.*, tb_pasien.*, tb_karyawan.*');
        $this->db->from('tb_homecare');
        $this->db->join('tb_pasien', 'tb_homecare.id_pasien = tb_pasien.id_pasien', 'left');
        $this->db->join('tb_karyawan', 'tb_homecare.id_karyawan = tb_karyawan.id_karyawan', 'left');
        $this->db->where('tb_pasien.id_pasien', $this->session->userdata('id_pasien'));
        $data['homecare'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pasien/homecare/index', $data);
        $this->load->view('template/footer');
    }

    public function generateIdHomecare() {
        $unik = 'HMCR';
        $kode = $this->db->query("SELECT MAX(id_homecare) LAST_NO FROM tb_homecare WHERE id_homecare LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 4, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function add() {
        $data['title'] = 'Form Pendaftaran Homecare';

        $this->form_validation->set_rules('nama_perawatan', 'Nama Perawatan', 'required');
        $this->form_validation->set_rules('tgl_kunjungan', 'Tanggal Kunjungan', 'required');
        $this->form_validation->set_rules('jam', 'Jam Kunjungan', 'required');
        $this->form_validation->set_rules('alamat_kunjungan', 'Alamat Kunjungan', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('pasien/homecare/add', $data);
            $this->load->view('template/footer');
        } else {
            // Konfigurasi upload
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/luka/';
            $this->load->library('upload', $config);
            $this->upload->do_upload('foto');
            $image = $this->upload->data('file_name');
            
            $data = [
                'id_homecare' => $this->generateIdHomecare(),
                'id_pasien' => $this->session->userdata('id_pasien'),
                'nama_perawatan' => $this->input->post('nama_perawatan'),
                'foto' => $image,
                'tgl_kunjungan' => $this->input->post('tgl_kunjungan'),
                'jam' => $this->input->post('jam'),
                'alamat_kunjungan' => $this->input->post('alamat_kunjungan')
            ];

            $this->db->insert('tb_homecare', $data);

            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Pendaftaran Homecare berhasil, Tunggu untuk admin memverifikasi pendaftaran', icon:'success'})</script>");
			redirect('pasien/homecare');
        }
    }
}