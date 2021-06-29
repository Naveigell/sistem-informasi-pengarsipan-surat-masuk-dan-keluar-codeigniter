<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class SuratMasuk
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Upload $upload
 * @property CI_DB_pdo_driver $db
 */
class SuratMasuk extends CI_Controller {

	private $table = 'tb_suratmasuk';

	public function index()
	{
		$data = array();
		$message_success 		= $this->session->flashdata('message_success');
		$data['surat_masuk']	= $this->db->select('*')->from($this->table)->get()->result_object();

		if (isset($message_success)) {
			$data['message_success'] = $message_success;
		}

		$data['content'] = 'pages/pegawai/surat_masuk_index';
		$this->load->view('includes/layout', $data);
	}

	public function add()
	{
		$data = array();
		$errors 				= $this->session->flashdata('errors');
		if (isset($errors)) {
			$data['errors'] = $errors;
		}

		$data['content'] = 'pages/pegawai/surat_masuk_add';
		$this->load->view('includes/layout', $data);
	}

	public function show($id = null)
	{
		$surat = $this->db->select('*')->from($this->table)->where('id_sm', $id)->get()->result_object();

		$data['surat_masuk'] 	= $surat;
		$data['content'] 		= 'pages/pegawai/surat_masuk_show';

		$this->load->view('includes/layout', $data);
	}

	public function edit($id = null)
	{
		$data = array();
		$errors 				= $this->session->flashdata('errors');
		if (isset($errors)) {
			$data['errors'] = $errors;
		}

		$surat = $this->db->select('*')->from($this->table)->where('id_sm', $id)->get()->result_object();

		$data['surat_masuk'] 	= $surat;
		$data['content'] 		= 'pages/pegawai/surat_masuk_edit';

		$this->load->view('includes/layout', $data);
	}

	public function delete($id = null) {
		if (is_null($id)) {
			echo json_encode(array(
				"Id tidak boleh kosong"
			));
		} else if ($this->input->server('REQUEST_METHOD') == "POST") {
			$deleted = $this->db->delete($this->table, array(
				'id_sm' => $id
			));

			if ($deleted) {
				echo json_encode(array(
					"message" => "Surat berhasil dihapus",
					"success" => true,
				));
			}
		}
	}

	public function update()
	{
		if ($this->input->server('REQUEST_METHOD') == "POST") {

			$id = $this->input->post('id');

			if (!$id) {
				redirect(base_url().'suratmasuk');
			}


			$this->form_validation->set_rules('nosurat', 'No surat', 'required|min_length[5]');
			$this->form_validation->set_rules('tanggal', 'Tanggal', 'required|callback_validation_date');
			$this->form_validation->set_rules('penerima', 'Penerima', 'required|min_length[5]');
			$this->form_validation->set_rules('perihal', 'Perihal', 'required|min_length[5]');
			$this->form_validation->set_rules('telp', 'No telepone', 'required|min_length[5]');

			$this->form_validation->set_message('validation_date', 'Tanggal not valid');

			$filename = uniqid().date('YmdHis');
			if ($_FILES['lampiran']['name'] == "") {
				$this->form_validation->set_rules('lampiran', 'Lampiran', 'required');
			} else {
				$config['upload_path']          = './uploads/suratmasuk/';
				$config['max_size']             = 100000;
				$config['file_name'] 			= $filename;
				$config['allowed_types']        = 'pdf';

				$this->load->library('upload', $config);
				$uploaded = $this->upload->do_upload('lampiran');

				if (!$uploaded) {
					var_dump($this->upload->display_errors());
				}
			}

			if ($this->form_validation->run()) {
				$perihal 		= $this->input->post('perihal');
				$pengirim 		= 'not implemented yet'; // $this->input->post('pengirim');
				$penerima 		= $this->input->post('penerima');
				$notelp 		= $this->input->post('telp');
				$tanggal 		= $this->input->post('tanggal');
				$nosurat 		= $this->input->post('nosurat');
				$lampiran		= $filename;

				$created = $this->db->where('id_sm', $id)->update($this->table, array(
					'no_surat' => $nosurat,
					'perihal' => $perihal,
					'pengirim' => $pengirim,
					'penerima' => $penerima,
					'no_hp' => $notelp,
					'tanggal_sm' => $tanggal,
					'lampiran' => $lampiran.'.pdf',
				));

				if ($created) {
					$this->session->set_flashdata('message_success', 'Surat masuk berhasil diubah');
					redirect(base_url().'suratmasuk');
				}
			} else {
				$errors = $this->form_validation->error_array();
				$this->session->set_flashdata('errors', $errors);

				redirect(base_url().'suratmasuk/edit/'.$id);
			}
		} else {
			show_404();
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
			$this->form_validation->set_rules('penerima', 'Penerima', 'required|min_length[5]');
			$this->form_validation->set_rules('perihal', 'Perihal', 'required|min_length[5]');
			$this->form_validation->set_rules('telp', 'No telepone', 'required|min_length[5]');

			$filename = uniqid().date('YHmids');
			if ($_FILES['lampiran']['name'] == "") {
				$this->form_validation->set_rules('lampiran', 'Lampiran', 'required');
			} else {
				$config['upload_path']          = './uploads/suratmasuk/';
				$config['file_name'] 			= $filename;
				$config['allowed_types']        = 'pdf';
				$config['max_size']             = 100000;

				$this->load->library('upload', $config);
				$uploaded = $this->upload->do_upload('lampiran');

				if (!$uploaded) {
					var_dump($this->upload->display_errors());
				}
			}

			if ($this->form_validation->run()) {
				$nosurat 		= $this->input->post('nosurat');
				$perihal 		= $this->input->post('perihal');
				$pengirim 		= 'not implemented yet'; // $this->input->post('pengirim');
				$penerima 		= $this->input->post('penerima');
				$notelp 		= $this->input->post('telp');
				$tanggal 		= $this->input->post('tanggal');
				$lampiran		= $filename;

				$created = $this->db->insert('tb_suratmasuk', array(
					'no_surat' => $nosurat,
					'perihal' => $perihal,
					'pengirim' => $pengirim,
					'penerima' => $penerima,
					'no_hp' => $notelp,
					'tanggal_sm' => $tanggal,
					'lampiran' => $lampiran.'.pdf',
				));

				if ($created) {
					$this->session->set_flashdata('message_success', 'Surat masuk berhasil dibuat');
					redirect(base_url().'suratmasuk');
				}
			} else {
				$errors = $this->form_validation->error_array();
				$this->session->set_flashdata('errors', $errors);

				redirect(base_url().'suratmasuk/add');
			}
		} else {
			show_404();
		}
	}
}
