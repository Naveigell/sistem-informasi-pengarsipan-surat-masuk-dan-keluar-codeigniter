<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class SuratMasuk
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Upload $upload
 * @property CI_DB_pdo_driver $db
 * @property TelegramLib $telegramlib
 */
class SuratMasuk extends CI_Controller {
	private $table = 'tb_suratmasuk';

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
		$message_success 		= $this->session->flashdata('message_success');
		$message_warning 		= $this->session->flashdata('message_warning');
		$data['surat_masuk']	= $this->db->select('*')->from($this->table)->get()->result_object();

		if (isset($message_success)) {
			$data['message_success'] = $message_success;
		}

		if (isset($message_warning)) {
			$data['message_warning'] = $message_warning;
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

		// take all users except itself (current logged user)
		$data["users"] = $this->db->select('*')->from("tbuser")->where_not_in('user_id', $this->session->userdata('id'))->get()->result_object();

		$data['content'] = 'pages/pegawai/surat_masuk_add';
		$this->load->view('includes/layout', $data);
	}

	public function show($id = null)
	{
		if (is_null($id)) {
			redirect(base_url().'suratkeluar');
		}

		$surat = $this->db->select('*')->from($this->table)->join("tbuser", "tbuser.user_id = $this->table.penerima_id")->where('id_sm', $id)->get()->result_object();

		$data['surat_masuk'] 	= $surat;
		$data['content'] 		= 'pages/pegawai/surat_masuk_show';

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

		$surat = $this->db->select('*')->from($this->table)->join("tbuser", "tbuser.user_id = $this->table.penerima_id")->where('id_sm', $id)->get()->result_object();

		$data["users"] 			= $this->db->select('*')->from("tbuser")->where_not_in('user_id', $this->session->userdata('id'))->get()->result_object();
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

	public function download($id = null)
	{
		if (!is_null($id)) {
			$surat = $this->db->select("*")->from($this->table)->where('id_sm', $id)->get()->result_object();
			if (count($surat) > 0) {

				$penerima = $this->db->select()->from("telegram_users")->where("id_tbuser", $surat[0]->penerima_id)->get()->result_object();

				// check if the file exists and get the file with
				// file_get_contents
				$path = FCPATH.'uploads/suratmasuk/'.$surat[0]->lampiran;
				if (file_exists($path)) {
					$data = file_get_contents ($path);

					// update status and
					// catch if theres an error
					try {

						$this->db->where('id_sm', $id)->update($this->table, array(
							"dibaca"	=> 1
						));
					} catch (Exception $e) {}

					if (count($penerima) > 0 && $surat[0]->dibaca == 0) {
						$this->telegramlib->sendDocument($penerima[0]->chat_id, $surat[0]->lampiran, array(
							"caption" => "Hallo berikut kami kirimkan kembali file yang telah kamu baca."
						));
					}

					// then force download the file
					force_download($surat[0]->lampiran, $data);
				}
				redirect(base_url().'dashboard');
			}
		} else {
			redirect(base_url().'dashboard');
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
			$this->form_validation->set_rules('penerima', 'Penerima', 'required');
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
				$penerima 		= $this->input->post('penerima');
				$notelp 		= $this->input->post('telp');
				$tanggal 		= $this->input->post('tanggal');
				$nosurat 		= $this->input->post('nosurat');
				$lampiran		= $filename;

				$created = $this->db->where('id_sm', $id)->update($this->table, array(
					'no_surat' => $nosurat,
					'perihal' => $perihal,
					'penerima_id' => $penerima,
					'no_hp' => $notelp,
					'tanggal_sm' => $tanggal,
					'lampiran' => $lampiran.'.pdf',
				));

				if ($created) {
					$penerima = $this->db->select()->from("telegram_users")->where("id_tbuser", $penerima)->get()->result_object();
					$pengirim = $this->session->userdata("name");

					$this->session->set_flashdata('message_success', 'Surat masuk berhasil diubah');
					$this->telegramlib->sendMessage(
						$penerima[0]->chat_id,
						"Hallo, kamu menerima surat yang penerima nya diubah dari <i><b>$pengirim</b></i> dengan Nomor Surat <i><b>$nosurat</b></i>, mohon untuk segera dibaca ya!",
						array("html"	=> true)
					);
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
			$this->form_validation->set_rules('penerima', 'Penerima', 'required');
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
				$pengirim 		= $this->session->userdata('id');
				$penerima 		= $this->input->post('penerima');
				$notelp 		= $this->input->post('telp');
				$tanggal 		= $this->input->post('tanggal');
				$lampiran		= $filename;

				$created = $this->db->insert('tb_suratmasuk', array(
					'no_surat' => $nosurat,
					'perihal' => $perihal,
					'pengirim_id' => $pengirim,
					'penerima_id' => $penerima,
					'no_hp' => $notelp,
					'tanggal_sm' => $tanggal,
					'lampiran' => $lampiran.'.pdf',
				));

				if ($created) {
					$this->session->set_flashdata('message_success', 'Surat masuk berhasil dibuat');
					$penerima = $this->db->select()->from("telegram_users")->where("id_tbuser", $penerima)->get()->result_object();
					$pengirim = $this->session->userdata("name");
					if (count($penerima) > 0) {
						$this->telegramlib->sendMessage($penerima[0]->chat_id, "Hallo, kamu menerima surat masuk dari <i><b>$pengirim</b></i> dengan Nomor Surat <i><b>$nosurat</b></i>, mohon untuk segera dibaca ya!", array("html"	=> true));
						$this->telegramlib->sendDocument($penerima[0]->chat_id, $lampiran.'.pdf');
					} else {
						$this->session->set_flashdata('message_warning', "Telegram pengguna tidak terdaftar dalam sistem");
					}
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
