<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Laporan
 * @property PdfParser $pdfparser
 * @property CI_DB_pdo_driver $db
 */
class Laporan extends CI_Controller {
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
