<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuratKeluar extends CI_Controller {
	public function index()
	{
		$data['content'] = 'pages/pegawai/surat_keluar_index';
		$this->load->view('includes/layout', $data);
	}

	public function add()
	{
		$data['content'] = 'pages/pegawai/surat_keluar_add';
		$this->load->view('includes/layout', $data);
	}
}
