<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['PasienModel' => 'pasien', 'UserModel' => 'user']);
        isadmin();
    }

    public function index() {
        $data['title'] = 'Data Pasien';
        $data['pasien'] = $this->pasien->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/pasien/index', $data);
        $this->load->view('template/footer');
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
                'id_user' => $this->user->generateIdUser(),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'jabatan' => 'Pasien'
            ];
            $this->user->addUser($user);
            $id_user = $user['id_user'];

            $pasien = [
                'id_pasien' => $this->pasien->generateIdPasien(),
                'id_user' => $id_user,
                'nik' => $this->input->post('nik'),
                'nm_pasien' => $this->input->post('nm_pasien'),
                'umur' => $this->input->post('umur'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'no_hp' => $this->input->post('no_hp'),
                'email' => $this->input->post('email'),
                'alamat' => $this->input->post('alamat')
            ];
            $this->pasien->addPasien($pasien);
    
            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Selamat', text:'Data Pasien Berhasil Ditambahkan', icon:'success'})</script>");
			redirect('admin/pasien');
        }
    }

    public function edit($id_user) {
        $data['title'] = 'Edit Data Pasien';
        $data['user'] = $this->pasien->getById($id_user)->row();

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
            $this->user->editUser($id_user, $user);
    
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
            $this->pasien->editPasien($id_pasien, $pasien);
    
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data berhasil diupdate', icon:'success'})</script>");
            redirect('admin/pasien');
        }
    }

    public function delete($id_user) {
        $this->pasien->deletePasien($id_user);
        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Hapus data pasien berhasil', icon:'success'})</script>");
		redirect('admin/pasien');
    }
}