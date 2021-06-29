<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Login
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Upload $upload
 * @property CI_DB_pdo_driver $db
 */
class SuratMasuk extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array();
		$message_success 		= $this->session->flashdata('message_success');
		$data['surat_masuk']	= $this->db->select('*')->from('tb_suratmasuk')->get()->result_object();

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

			$filename = uniqid().date('YmdHis');
			if ($_FILES['lampiran']['name'] == "") {
				$this->form_validation->set_rules('lampiran', 'Lampiran', 'required');
			} else {
				$config['upload_path']          = './uploads/';
				$config['allowed_types']        = 'pdf';
				$config['max_size']             = 100000;
				$config['file_name'] 			= $filename;

				$this->load->library('upload', $config);
				$uploaded = $this->upload->do_upload('lampiran');

				if ($uploaded) {
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
					var_dump($this->upload->display_errors());
				}
			}
		} else {
			show_404();
		}
	}
}
