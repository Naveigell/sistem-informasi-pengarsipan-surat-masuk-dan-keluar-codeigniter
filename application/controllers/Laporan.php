<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Laporan
 * @property PdfParser $pdfparser
 * @property CI_DB_pdo_driver $db
 * @property CI_Session $session
 */
class Laporan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata('id') ||
			$this->session->userdata('role') == "admin") {
			redirect(base_url().'login');
		}
	}

	public function index()
	{
		$data = array();
		$data['surat_masuk'] 	= $this->db->select("*")->from("tb_suratmasuk")->get()->result_object();
		$data['surat_keluar'] 	= $this->db->select("*")->from("tb_suratkeluar")->get()->result_object();

		$data['content'] = 'pages/pegawai/laporan';
		$this->load->view('includes/layout', $data);
	}

	public function suratmasuk()
	{
		$data['surat_masuk'] 	= $this->db->select("*")->from("tb_suratmasuk")->get()->result_object();

		$this->pdfparser->setPaper('A4', 'landscape');
		$this->pdfparser->parse('surat_masuk', 'pages/pegawai/pdf/suratmasuk', $data);
	}

	public function suratkeluar()
	{
		$data['surat_keluar'] 	= $this->db->select("*")->from("tb_suratkeluar")->get()->result_object();

		$this->pdfparser->setPaper('A4', 'landscape');
		$this->pdfparser->parse('surat_keluar', 'pages/pegawai/pdf/suratkeluar', $data);
	}
}
