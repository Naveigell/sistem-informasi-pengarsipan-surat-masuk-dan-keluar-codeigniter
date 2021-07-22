<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Login
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_DB_pdo_driver $db
 */
class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata('id')) {
			redirect(base_url().'dashboard');
		}
	}

	public function index()
	{
		$data = array();
		$errors = $this->session->flashdata('errors');
		if (isset($errors)) {
			$data['errors'] = $errors;
		}

		$this->load->view('login', $data);
	}

	public function do_login()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			$this->form_validation->set_rules('email', 'Email', 'required|min_length[5]');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');

			if ($this->form_validation->run()) {
				$email 		= $this->input->post('email');
				$password 	= $this->input->post('password');

				$user 	= $this->db->select("*")->from("tbuser")->where("email", $email)->get()->result_object();
				if (count($user) > 0) {
					if (password_verify($password, $user[0]->password)) {
						$data = array(
							"id"			=> $user[0]->user_id,
							"username"		=> $user[0]->username,
							"name"			=> $user[0]->nama_lengkap,
							"role"			=> $user[0]->role,
							"avatar"		=> $user[0]->photo
						);

						// update the last login
						$this->db->where("user_id", $user[0]->user_id)->update("tbuser", array(
							"last_login"	=> date("Y-m-d H:i:s")
						));

						$this->session->set_userdata($data);

						redirect(base_url().'dashboard');
					} else {
						$this->session->set_flashdata('errors', array(
							"password"		=> "Password wrong!"
						));
					}
				} else {
					$this->session->set_flashdata('errors', array(
						"email"		=> "User not found"
					));
				}

			} else {
				$field_names = array('email', 'password');
				$errors = array();
				foreach ($field_names as $field) {
					$error = $this->form_validation->error($field);
					$errors[$field] = $error;
				}

				$this->session->set_flashdata('errors', $errors);

			}
			redirect(base_url().'login');
		} else {
			show_404();
		}
	}
}
