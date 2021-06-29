<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Login
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Session $session
 */
class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
//		$this->load->helper(array('form', 'url'));
//		$this->load->library('form_validation');
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
				redirect(base_url().'dashboard');
			} else {
				$field_names = array('email', 'password');
				$errors = array();
				foreach ($field_names as $field) {
					$error = $this->form_validation->error($field);
					$errors[$field] = $error;
				}

				$this->session->set_flashdata('errors', $errors);

				redirect(base_url().'login');
			}
		} else {
			show_404();
		}
	}
}
