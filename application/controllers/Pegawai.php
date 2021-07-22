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
class Pegawai extends CI_Controller {
	private $table = 'tbuser';
	private $role = 'pegawai';

	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata('id') ||
			$this->session->userdata('role') == "pegawai") {
			redirect(base_url().'login');
		}
	}

	public function index()
	{
		$data = array();
		$message_success 		= $this->session->flashdata('message_success');
		$data['pegawai']		= $this->db->select('*')->from($this->table)->where('role', $this->role)->get()->result_object();

		if (isset($message_success)) {
			$data['message_success'] = $message_success;
		}

		$data['content'] = 'pages/admin/pegawai_index';
		$this->load->view('includes/layout', $data);
	}

	public function show($id = null)
	{
		$pegawai = $this->db->select('*')->from($this->table)->where('user_id', $id)->where('role', $this->role)->get()->result_object();

		$data['pegawai'] 		= $pegawai;
		$data['content'] 		= 'pages/admin/pegawai_show';

		$this->load->view('includes/layout', $data);
	}

	public function add()
	{
		$data = array();
		$errors 				= $this->session->flashdata('errors');
		if (isset($errors)) {
			$data['errors'] = $errors;
		}

		$data['content'] = 'pages/admin/pegawai_add';
		$this->load->view('includes/layout', $data);
	}

	public function delete($id = null) {
		if (is_null($id)) {
			echo json_encode(array(
				"Id tidak boleh kosong"
			));
		} else if ($this->input->server('REQUEST_METHOD') == "POST") {
			$deleted = $this->db->delete($this->table, array(
				'user_id' 	=> $id,
				'role'		=> 'pegawai'
			));

			if ($deleted) {
				echo json_encode(array(
					"message" => "Pegawai berhasil dihapus",
					"success" => true,
				));
			}
		}
	}

	public function create()
	{
		if ($this->input->server('REQUEST_METHOD') == "POST") {
			$this->form_validation->set_rules('username', 'username', 'required|min_length[5]');
			$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'required|min_length[5]');
			$this->form_validation->set_rules('email', 'email', 'required|min_length[5]');
			$this->form_validation->set_rules('telp', 'no hp', 'required|min_length[5]');
			$this->form_validation->set_rules('alamat', 'alamat', 'required|min_length[5]');
			$this->form_validation->set_rules('keahlian', 'keahlian', 'required|min_length[5]');

			if ($this->form_validation->run()) {

				$filename	= uniqid().'.png';
				$copied 	= copy(FCPATH.'assets/img/default.png', FCPATH.'assets/img/avatar/'.$filename);
				if ($copied) {
					$created = $this->db->insert($this->table, array(
						"username"		=> $this->input->post('username'),
						"password"		=> password_hash(123456, PASSWORD_DEFAULT),
						"nama_lengkap"	=> $this->input->post('nama_lengkap'),
						"email"			=> $this->input->post('email'),
						"phone"			=> $this->input->post('telp'),
						"role"			=> 'pegawai',
						"photo"			=> $filename,
						"is_active"		=> 1,
					));

					if ($created) {
						$this->session->set_flashdata('message_success', 'Pegawai berhasil ditambah');
						redirect(base_url().'pegawai');
					}
				}
			} else {
				$errors = $this->form_validation->error_array();
				$this->session->set_flashdata('errors', $errors);

				redirect(base_url().'pegawai/add');
			}

		} else {
			show_404();
		}
	}
}
