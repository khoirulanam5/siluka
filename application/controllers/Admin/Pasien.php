<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Data Pasien';
        
        $this->db->select('tb_user.*, tb_pasien.*');
        $this->db->from('tb_user');
        $this->db->join('tb_pasien', 'tb_user.id_user = tb_pasien.id_user');
        $this->db->where('jabatan =', 'Pasien');
        $data['pasien'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/pasien/index', $data);
        $this->load->view('template/footer');
    }

    public function generateIdUser() {
        $unik = 'U';
        $kode = $this->db->query("SELECT MAX(id_user) LAST_NO FROM tb_user WHERE id_user LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 1, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function generateIdPasien() {
        $unik = 'P';
        $kode = $this->db->query("SELECT MAX(id_pasien) LAST_NO FROM tb_pasien WHERE id_pasien LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 1, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function add() {
        $data['title'] = 'Tambah Pasien';

        $this->form_validation->set_rules('nik', 'NIK', 'required|is_unique[tb_pasien.nik]|numeric');
        $this->form_validation->set_rules('nm_pasien', 'Nama Pasien', 'required');
        $this->form_validation->set_rules('umur', 'Umur', 'required|numeric');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomor Hp', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tb_pasien.email]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/pasien/add', $data);
            $this->load->view('template/footer');
        } else {
            $user = [
                'id_user' => $this->generateIdUser(),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'jabatan' => 'Pasien'
            ];
            $this->db->insert('tb_user', $user);
            $id_user = $user['id_user'];

            $pasien = [
                'id_pasien' => $this->generateIdPasien(),
                'id_user' => $id_user,
                'nik' => $this->input->post('nik'),
                'nm_pasien' => $this->input->post('nm_pasien'),
                'umur' => $this->input->post('umur'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'no_hp' => $this->input->post('no_hp'),
                'email' => $this->input->post('email'),
                'alamat' => $this->input->post('alamat')
            ];
            $this->db->insert('tb_pasien', $pasien);
    
            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Selamat', text:'Data Pasien Berhasil Ditambahkan', icon:'success'})</script>");
			redirect('admin/pasien');
        }
    }

    public function edit($id_user) {
        $data['title'] = 'Edit Data Pasien';

        $this->db->select('tb_user.*, tb_pasien.*');
        $this->db->from('tb_user');
        $this->db->join('tb_pasien', 'tb_user.id_user = tb_pasien.id_user');
        $this->db->where('tb_user.id_user', $id_user);
        $data['user'] = $this->db->get()->row();

        $this->form_validation->set_rules('nik', 'NIK', 'required|numeric');
        $this->form_validation->set_rules('nm_pasien', 'Nama Pasien', 'required');
        $this->form_validation->set_rules('umur', 'Umur', 'required|numeric');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomor Hp', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/pasien/edit', $data);
            $this->load->view('template/footer');
        } else {
            $id_user = $this->input->post('id_user');
            $user = [
                'id_user' => $id_user,
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'jabatan' => 'Pasien'
            ];
            $this->db->where('id_user', $id_user);
            $this->db->update('tb_user', $user);
    
            $id_pasien = $this->input->post('id_pasien');
            $pasien = [
                'id_pasien' => $id_pasien,
                'id_user' => $id_user,
                'nik' => $this->input->post('nik'),
                'nm_pasien' => $this->input->post('nm_pasien'),
                'umur' => $this->input->post('umur'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'no_hp' => $this->input->post('no_hp'),
                'email' => $this->input->post('email'),
                'alamat' => $this->input->post('alamat')
            ];
            $this->db->where('id_user', $id_user);
            $this->db->update('tb_pasien', $pasien);
    
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil diupdate', icon:'success'})</script>");
            redirect('admin/pasien');
        }
    }

    public function delete($id_user) {
        $this->db->trans_start();
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_pasien');
    
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user');
        $this->db->trans_complete();
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Hapus data pasien berhasil', icon:'success'})</script>");
		redirect('admin/pasien');
    }
}