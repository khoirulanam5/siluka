<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['UserModel' => 'user', 'PasienModel' => 'pasien']);
    }

    public function index() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $cek = $this->db->get_where("tb_user", array("username" => $username, "password" => $password))->row();

                if(!empty($cek)) {
                    $user = [
                        'id_user' => $cek->id_user,
                        'username' => $cek->username,
                        'password' => $cek->password,
                        'jabatan' => $cek->jabatan
                    ];
                    $this->session->set_userdata($user);

                    $karyawan = $this->db->get_where('tb_karyawan', ['id_user' => $cek->id_user])->row();

                    if ($karyawan) {
                        $kar = [
                            'id_karyawan' => $karyawan->id_karyawan,
                            'nm_karyawan' => $karyawan->nm_karyawan,
                            'no_hp' => $karyawan->no_hp,
                            'email' => $karyawan->email,
                            'alamat' => $karyawan->alamat
                        ];
                        $this->session->set_userdata($kar);
                    }

                    $pasien = $this->db->get_where('tb_pasien', ['id_user' => $cek->id_user])->row();

                    if ($pasien) {
                        $pas = [
                            'id_pasien' => $pasien->id_pasien,
                            'nik' => $pasien->nik,
                            'nm_pasien' => $pasien->nm_pasien,
                            'umur' => $pasien->umur,
                            'jenis_kelamin' => $pasien->jenis_kelamin,
                            'no_hp' => $pasien->no_hp,
                            'email' => $pasien->email,
                            'alamat' => $pasien->alamat
                        ];
                        $this->session->set_userdata($pas);
                    }

                    if ($cek->level == 'Pemilik') {
                        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Login Berhasil', icon:'success'})</script>");
                        redirect('dashboard');
                    } else if ($cek->level == 'Admin') {
                        $this->session->set_flashdata("pesan","<script>Swal.fire({icon:'success', title:'Berhasil', text:'Login Berhasil!', confirmButtonText:'OK'})</script>");
                        redirect('dashboard');
                    } else if ($cek->jabatan == 'Perawat'){
                        $this->session->set_flashdata("pesan","<script>Swal.fire({icon:'success', title:'Berhasil', text:'Login Berhasil!', confirmButtonText:'OK'})</script>");
                        redirect('dashboard');
                    } else {
                        $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Berhasil', text:'Login Berhasil', icon:'success'})</script>");
                        redirect('dashboard');
                    }
                } else {
                    $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Gagal', text:'username / password salah', icon:'error'})</script>");
                    redirect('auth');
                }
        }
    }

    public function register() {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required|is_unique[tb_pasien.nik]|numeric');
        $this->form_validation->set_rules('nm_pasien', 'Nama Pasien', 'required');
        $this->form_validation->set_rules('umur', 'Umur', 'required|numeric');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('no_hp', 'Nomor Hp', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tb_pasien.email]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
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
    
            $this->session->set_flashdata("pesan","<script> Swal.fire({title:'Selamat', text:'Akun berhasil dibuat', icon:'success'})</script>");
			redirect('auth');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('front');
    }
}