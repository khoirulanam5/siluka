<?php

	function isadmin() {
		$ci = get_instance();
		$jabatan = $ci->session->userdata('jabatan');
		if ($jabatan != 'Admin') {
			redirect('auth');
		}
	}

	function ispemilik() {
		$ci = get_instance();
		$jabatan = $ci->session->userdata('jabatan');
		if ($jabatan != 'Pemilik') {
			redirect('auth');
		}
	}

	function isperawat() {
		$ci = get_instance();
		$jabatan = $ci->session->userdata('jabatan');
		if ($jabatan != 'Perawat') {
			redirect('auth');
		}
	}

	function ispasien() {
		$ci = get_instance();
		$jabatan = $ci->session->userdata('jabatan');
		if ($jabatan != 'Pasien') {
			redirect('auth');
		}
	}