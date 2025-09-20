<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['UserModel' => 'user', 'KaryawanModel' => 'karyawan']);
        ispemilik();
    }

    public function index() {
        $data['title'] = 'Data Karyawan';
        $data['karyawan'] = $this->karyawan->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pemilik/karyawan/index', $data);
        $this->load->view('template/footer');
    }

    public function add() {
        $data['title'] = 'Tambah Karyawan';

        $this->form_validation->set_rules('nm_karyawan', 'Nama Karyawan', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomor Hp', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tb_karyawan.email]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('pemilik/karyawan/add', $data);
            $this->load->view('template/footer');
        } else {

            $user = [
                'id_user' => $this->user->generateIdUser(),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'jabatan' => $this->input->post('jabatan')
            ];
            $this->user->addUser($user);
            $id_user = $user['id_user'];

            $karyawan = [
                'id_karyawan' => $this->karyawan->generateIdKaryawan(),
                'id_user' => $id_user,
                'nm_karyawan' => $this->input->post('nm_karyawan'),
                'no_hp' => $this->input->post('no_hp'),
                'email' => $this->input->post('email'),
                'alamat' => $this->input->post('alamat')
            ];
            $this->karyawan->addKaryawan($karyawan);
            
            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Tambah data karyawan berhasil', icon:'success'})</script>");
			redirect('pemilik/karyawan');
        }
    }

    public function edit($id_user) {
        $data['title'] = 'Edit Data Karyawan';
        $data['user'] = $this->user->getById($id_user)->row();

        $this->form_validation->set_rules('nm_karyawan', 'Nama Karyawan', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomor Hp', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('pemilik/karyawan/edit', $data);
            $this->load->view('template/footer');
        } else {
            $id_user = $this->input->post('id_user');
            $user = [
                'id_user' => $id_user,
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'jabatan' => $this->input->post('jabatan')
            ];
            $this->user->editUser($id_user, $user);
    
            $id_karyawan = $this->input->post('id_karyawan');
            $karyawan = [
                'id_karyawan' => $id_karyawan,
                'id_user' => $id_user,
                'nm_karyawan' => $this->input->post('nm_karyawan'),
                'no_hp' => $this->input->post('no_hp'),
                'email' => $this->input->post('email'),
                'alamat' => $this->input->post('alamat')
            ];
            $this->karyawan->editKaryawan($id_karyawan, $karyawan);
    
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil diupdate', icon:'success'})</script>");
            redirect('pemilik/karyawan');
        }
    }

    public function delete($id_user) {
        $this->user->deleteUser($id_user);
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Hapus data karyawan berhasil', icon:'success'})</script>");
		redirect('pemilik/karyawan');
    }
}