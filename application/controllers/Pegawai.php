<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {
	public function index()
	{
		$data['content'] = 'pages/admin/pegawai_index';
		$this->load->view('includes/layout', $data);
	}

	public function add()
	{
		$data['content'] = 'pages/admin/pegawai_add';
		$this->load->view('includes/layout', $data);
	}

	public function edit($id = null)
	{
		var_dump($id);
	}
}
