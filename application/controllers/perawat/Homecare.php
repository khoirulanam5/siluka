<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homecare extends CI_Controller {

    public function __construct() {
        parent::__construct();
        isperawat();
    }

    public function index() {
        $data['title'] = 'Perawatan Homecare';

        $this->db->select('tb_homecare.*, tb_pasien.*, tb_karyawan.*');
        $this->db->from('tb_homecare');
        $this->db->join('tb_pasien', 'tb_homecare.id_pasien = tb_pasien.id_pasien', 'left');
        $this->db->join('tb_karyawan', 'tb_homecare.id_karyawan = tb_karyawan.id_karyawan', 'left');
        $this->db->where('tb_karyawan.id_karyawan', $this->session->userdata('id_karyawan'));
        $this->db->group_start();
        $this->db->where('tb_homecare.status', 'Terverifikasi');
        $this->db->or_where('tb_homecare.status', 'Selesai');
        $this->db->group_end();
        $data['homecare'] = $this->db->get()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('perawat/homecare/index', $data);
        $this->load->view('template/footer');
    }

    public function generateIdHasil() {
        $unik = 'H';
        $kode = $this->db->query("SELECT MAX(id_hasil) LAST_NO FROM tb_hasil WHERE id_hasil LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 1, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function generateIdBayar() {
        $unik = 'BYR';
        $kode = $this->db->query("SELECT MAX(id_pembayaran) LAST_NO FROM tb_pembayaran WHERE id_pembayaran LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 3, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function perawatan($id_homecare) {
        $data['title'] = 'Layanan Perawatan Homecare';

        $this->db->select('tb_homecare.*, tb_pasien.*, tb_karyawan.*');
        $this->db->from('tb_homecare');
        $this->db->join('tb_pasien', 'tb_homecare.id_pasien = tb_pasien.id_pasien', 'left');
        $this->db->join('tb_karyawan', 'tb_homecare.id_karyawan = tb_karyawan.id_karyawan', 'left');
        $this->db->where('tb_karyawan.id_karyawan', $this->session->userdata('id_karyawan'));
        $this->db->where('tb_homecare.status', 'Terverifikasi');
        $data['homecare'] = $this->db->get()->result();

        $data['id_homecare'] = $id_homecare;

        $this->form_validation->set_rules('biaya_homecare', 'Biaya', 'required');
        $this->form_validation->set_rules('catatan_kunjungan', 'Catatan', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('perawat/homecare/perawatan', $data);
            $this->load->view('template/footer');
        } else {
            $data = [
                'catatan_kunjungan' => $this->input->post('catatan_kunjungan'),
                'biaya_homecare' => $this->input->post('biaya_homecare'),
                'status' => 'Selesai'
            ];

            $this->db->where('id_homecare', $id_homecare);
            $this->db->update('tb_homecare', $data);

            $hasil = [
                'id_hasil' => $this->generateIdHasil(),
                'id_homecare' => $id_homecare,
                'tgl_perawatan' => date('Y-m-d'),
                'status_perawatan' => 'Perawatan Homecare Selesai'
            ];
    
            $this->db->insert('tb_hasil', $hasil);

            $bayar = [
                'id_pembayaran' => $this->generateIdBayar(),
                'id_homecare' => $id_homecare
            ];

            $this->db->insert('tb_pembayaran', $bayar);
    
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Perawatan Berhasil dilakukan', icon:'success'})</script>");
            redirect('perawat/hasil/homecare');
        }
    }
}