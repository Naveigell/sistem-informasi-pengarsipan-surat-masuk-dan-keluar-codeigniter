<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Biodata
 * @property CI_Form_validation $form_validation
 * @property CI_Session $session
 * @property CI_Input $input
 * @property CI_DB_pdo_driver $db
 */
class Biodata extends CI_Controller {
	private $table = 'tbuser';

	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata('id')) {
			redirect(base_url().'login');
		}
	}

	public function index()
	{
		$data = array();
		$errors 				= $this->session->flashdata('errors');
		if (isset($errors)) {
			$data['errors'] = $errors;
		}

		$message_success_biodata = $this->session->flashdata('message_success_biodata');
		if (isset($message_success_biodata)) {
			$data['message_success_biodata'] = $message_success_biodata;
		}

		$data['biodata'] = $this->db->from($this->table)->select("*")->where("user_id", $this->session->userdata('id'))->get()->result_object();
		$data['content'] = 'biodata';
		$this->load->view('includes/layout', $data);
	}

	public function biodata()
	{
		if ($this->input->server("REQUEST_METHOD") == "POST") {
			$this->form_validation->set_rules('username', 'username', 'required|min_length[5]');
			$this->form_validation->set_rules('namalengkap', 'nama lengkap', 'required|min_length[5]');
			$this->form_validation->set_rules('email', 'email', 'required|min_length[5]');
			$this->form_validation->set_rules('telp', 'no telephone', 'required|min_length[5]');

			if ($this->form_validation->run()) {

				$username 			= $this->input->post('username');
				$namalengkap 		= $this->input->post('namalengkap');
				$email 				= $this->input->post('email');
				$telp 				= $this->input->post('telp');

				$updated = $this->db->where("user_id", $this->session->userdata('id'))->update($this->table, array(
					"username"			=> $username,
					"nama_lengkap"		=> $namalengkap,
					"email"				=> $email,
					"phone"				=> $telp
				));

				if ($updated) {
					$this->session->set_flashdata('message_success_biodata', 'biodata berhasil diubah');
					redirect(base_url().'biodata');
				}
			} else {
				$errors = $this->form_validation->error_array();
				$this->session->set_flashdata('errors', $errors);

				redirect(base_url().'biodata');
			}

		} else {
			show_404();
		}
	}

	public function password()
	{

	}

	public function image()
	{

	}
}
