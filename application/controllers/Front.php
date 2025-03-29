<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

  public function __construct(){
    parent::__construct();
  }

  public function index(){
    $this->load->view('front/header');
    $this->load->view('front/home');
    $this->load->view('front/footer');
  }

  public function feedback(){
    $this->load->view('front/header');
    $this->load->view('front/feedback');
    $this->load->view('front/footer');
  }

  public function generateIdSaran() {
    $unik = 'S';
    $kode = $this->db->query("SELECT MAX(id_saran) LAST_NO FROM tb_saran WHERE id_saran LIKE '".$unik."%'")->row()->LAST_NO;
    $urutan = (int) substr($kode, 1, 3);
    $urutan++;
    $huruf = $unik;
    $kode = $huruf . sprintf("%03s", $urutan);
    return $kode;
}

  public function feedback_v() {

    $this->form_validation->set_rules('saran', 'Saran', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->load->view('front/head');
        $this->load->view('front/feedback_v');
        $this->load->view('front/footer');
    } else {
        $data = [
            'id_saran' => $this->generateIdSaran(),
            'id_pasien' => $this->session->userdata('id_pasien'),
            'saran' => $this->input->post('saran'),
            'tgl' => date('Y-m-d')
        ];

        $this->db->insert('tb_saran', $data);

        $this->session->set_flashdata("pesan", "<script> Swal.fire({title:'Selamat', text:'Terima Kasih telah meluangkan waktu untuk mengisi feedback', icon:'success'})</script>");
        redirect('pasien/pembayaran');
    }
  }

  public function jadwal_v() {
    $username = $this->input->get('username');

    // Cek username di database
    $this->db->select('tb_pasien.id_pasien, tb_user.username');
    $this->db->from('tb_user');
    $this->db->join('tb_pasien', 'tb_user.id_user = tb_pasien.id_user', 'inner');
    $this->db->where('tb_user.username', $username);
    $result = $this->db->get()->row_array();

    // Validasi keberadaan username
    if (!$result) {
        $this->session->set_flashdata("pesan", "<script> Swal.fire({title:'Gagal', text:'Username tidak ditemukan atau tidak sesuai.', icon:'error'})</script>");
        redirect('front/home');
        return; // Hentikan eksekusi
    }

    // Simpan id_pasien ke session
    $this->session->set_userdata('id_pasien', $result['id_pasien']);

    $data['pasien'] = $result;

    $this->db->select('tb_jadwal.*, tb_karyawan.*');
    $this->db->from('tb_jadwal');
    $this->db->join('tb_karyawan', 'tb_jadwal.id_karyawan = tb_karyawan.id_karyawan');
    $data['jadwal'] = $this->db->get()->result();
    
    $this->load->view('front/head');
    $this->load->view('front/jadwal_v', $data);
    $this->load->view('front/footer');
  }

  public function saran() {
    $username = $this->input->get('username');

    // Cek username di database
    $this->db->select('tb_pasien.id_pasien, tb_user.username');
    $this->db->from('tb_user');
    $this->db->join('tb_pasien', 'tb_user.id_user = tb_pasien.id_user', 'inner');
    $this->db->where('tb_user.username', $username);
    $result = $this->db->get()->row_array();

    // Validasi keberadaan username
    if (!$result) {
        $this->session->set_flashdata("pesan", "<script> Swal.fire({title:'Gagal', text:'Username tidak ditemukan atau tidak sesuai.', icon:'error'})</script>");
        redirect('front/feedback');
        return; // Hentikan eksekusi
    }

    // Simpan id_pasien ke session
    $this->session->set_userdata('id_pasien', $result['id_pasien']);

    $data['pasien'] = $result;

    $this->db->select('tb_saran.*, tb_pasien.*');
    $this->db->from('tb_saran');
    $this->db->join('tb_pasien', 'tb_saran.id_pasien = tb_pasien.id_pasien');
    $data['feedback'] = $this->db->get()->result();

    $this->load->view('front/head');
    $this->load->view('front/saran', $data);
    $this->load->view('front/footer');
  }
}