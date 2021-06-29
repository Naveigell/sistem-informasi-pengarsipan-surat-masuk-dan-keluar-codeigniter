<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class SuratKeluar
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Upload $upload
 * @property CI_DB_pdo_driver $db
 */
class SuratKeluar extends CI_Controller {
	private $table = 'tb_suratkeluar';

	public function index()
	{
		$data = array();
		$message_success 		= $this->session->flashdata('message_success');
		$data['surat_keluar']	= $this->db->select('*')->from($this->table)->get()->result_object();

		if (isset($message_success)) {
			$data['message_success'] = $message_success;
		}

		$data['content'] = 'pages/pegawai/surat_keluar_index';
		$this->load->view('includes/layout', $data);
	}

	public function add()
	{
		$data = array();
		$errors 				= $this->session->flashdata('errors');
		if (isset($errors)) {
			$data['errors'] = $errors;
		}

		$data['content'] = 'pages/pegawai/surat_keluar_add';
		$this->load->view('includes/layout', $data);
	}

	public function show($id = null)
	{
		if (is_null($id)) {
			redirect(base_url().'suratkeluar');
		}

		$surat = $this->db->select('*')->from($this->table)->where('id_sk', $id)->get()->result_object();

		$data['surat_keluar'] 	= $surat;
		$data['content'] 		= 'pages/pegawai/surat_keluar_show';

		$this->load->view('includes/layout', $data);
	}

	public function edit($id = null)
	{
		if (is_null($id)) {
			redirect(base_url().'suratkeluar');
		}

		$data = array();
		$errors 				= $this->session->flashdata('errors');
		if (isset($errors)) {
			$data['errors'] = $errors;
		}

		$surat = $this->db->select('*')->from($this->table)->where('id_sk', $id)->get()->result_object();

		$data['surat_keluar'] 	= $surat;
		$data['content'] 		= 'pages/pegawai/surat_keluar_edit';

		$this->load->view('includes/layout', $data);
	}

	public function update()
	{
		if ($this->input->server('REQUEST_METHOD') == "POST") {

			$id = $this->input->post('id');

			if (!$id) {
				redirect(base_url().'suratkeluar');
			}

			$this->form_validation->set_rules('nosurat', 'No surat', 'required|min_length[5]');
			$this->form_validation->set_rules('tanggal', 'Tanggal', 'required|callback_validation_date');
			$this->form_validation->set_rules('pengirim', 'Pengirim', 'required|min_length[5]');
			$this->form_validation->set_rules('perihal', 'Perihal', 'required|min_length[5]');
			$this->form_validation->set_rules('tujuan', 'Tujuan', 'required|min_length[5]');
			$this->form_validation->set_message('validation_date', 'Tanggal not valid');

			$filename = uniqid().date('YmdHis');
			if ($_FILES['lampiran']['name'] == "") {
				$this->form_validation->set_rules('lampiran', 'Lampiran', 'required');
			} else {
				$config['upload_path']          = './uploads/suratkeluar/';
				$config['allowed_types']        = 'pdf';
				$config['max_size']             = 100000;
				$config['file_name'] 			= $filename;

				$this->load->library('upload', $config);
				$uploaded = $this->upload->do_upload('lampiran');

				if (!$uploaded) {
					var_dump($this->upload->display_errors());
				}
			}

			if ($this->form_validation->run()) {
				$nosurat 		= $this->input->post('nosurat');
				$pengirim 		= $this->input->post('pengirim');
				$perihal 		= $this->input->post('perihal');
				$tanggal 		= $this->input->post('tanggal');
				$tujuan 		= $this->input->post('tujuan');
				$lampiran		= $filename;

				$created = $this->db->where('id_sk', $id)->update('tb_suratkeluar', array(
					'no_surat' => $nosurat,
					'perihal' => $perihal,
					'pengirim' => $pengirim,
					'tanggal_sk' => $tanggal,
					'tujuan' => $tujuan,
					'lampiran' => $lampiran.'.pdf',
				));

				if ($created) {
					$this->session->set_flashdata('message_success', 'Surat keluar berhasil diubah');
					redirect(base_url().'suratkeluar');
				}
			} else {
				$errors = $this->form_validation->error_array();
				$this->session->set_flashdata('errors', $errors);

				redirect(base_url().'suratkeluar/edit/'.$id);
			}
		} else {
			show_404();
		}
	}

	public function delete($id = null) {
		if (is_null($id)) {
			echo json_encode(array(
				"Id tidak boleh kosong"
			));
		} else if ($this->input->server('REQUEST_METHOD') == "POST") {
			$deleted = $this->db->delete($this->table, array(
				'id_sk' => $id
			));

			if ($deleted) {
				echo json_encode(array(
					"message" => "Surat berhasil dihapus",
					"success" => true,
				));
			}
		}
	}

	public function validation_date()
	{
		$date = $this->input->post('tanggal');
		if (!isset($date)) {
			return false;
		}

		$d = DateTime::createFromFormat('Y-m-d', $date);
		return $d && $d->format('Y-m-d') === $date;
	}

	public function create()
	{
		if ($this->input->server('REQUEST_METHOD') == "POST") {
			$this->form_validation->set_message('validation_date', 'Tanggal not valid');

			$this->form_validation->set_rules('nosurat', 'No surat', 'required|min_length[5]');
			$this->form_validation->set_rules('tanggal', 'Tanggal', 'required|callback_validation_date');
			$this->form_validation->set_rules('pengirim', 'Pengirim', 'required|min_length[5]');
			$this->form_validation->set_rules('perihal', 'Perihal', 'required|min_length[5]');
			$this->form_validation->set_rules('tujuan', 'Tujuan', 'required|min_length[5]');

			$filename = uniqid().date('YmdHis');
			if ($_FILES['lampiran']['name'] == "") {
				$this->form_validation->set_rules('lampiran', 'Lampiran', 'required');
			} else {
				$config['upload_path']          = './uploads/suratkeluar/';
				$config['allowed_types']        = 'pdf';
				$config['max_size']             = 100000;
				$config['file_name'] 			= $filename;

				$this->load->library('upload', $config);
				$uploaded = $this->upload->do_upload('lampiran');

				if ($uploaded) {
					var_dump($this->upload->display_errors());
				}
			}

			if ($this->form_validation->run()) {
				$lampiran		= $filename;
				$nosurat 		= $this->input->post('nosurat');
				$pengirim 		= $this->input->post('pengirim');
				$perihal 		= $this->input->post('perihal');
				$tanggal 		= $this->input->post('tanggal');
				$tujuan 		= $this->input->post('tujuan');

				$created = $this->db->insert('tb_suratkeluar', array(
					'no_surat' => $nosurat,
					'perihal' => $perihal,
					'pengirim' => $pengirim,
					'tanggal_sk' => $tanggal,
					'tujuan' => $tujuan,
					'lampiran' => $lampiran.'.pdf',
				));

				if ($created) {
					$this->session->set_flashdata('message_success', 'Surat keluar berhasil dibuat');
					redirect(base_url().'suratkeluar');
				}
			} else {
				$errors = $this->form_validation->error_array();
				$this->session->set_flashdata('errors', $errors);

				redirect(base_url().'suratkeluar/add');
			}
		} else {
			show_404();
		}
	}
}
