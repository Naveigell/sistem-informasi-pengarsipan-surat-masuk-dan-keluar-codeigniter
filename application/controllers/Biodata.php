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

		$message_success_password = $this->session->flashdata('message_success_password');
		if (isset($message_success_password)) {
			$data['message_success_password'] = $message_success_password;
		}

		$message_success_avatar = $this->session->flashdata('message_success_avatar');
		if (isset($message_success_avatar)) {
			$data['message_success_avatar'] = $message_success_avatar;
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
					$this->session->set_flashdata('message_success_biodata', 'Biodata berhasil diubah');
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
		if ($this->input->server('REQUEST_METHOD') == "POST") {
			$this->form_validation->set_rules('old_password', 'password lama', 'required|min_length[5]');
			$this->form_validation->set_rules('new_password', 'password baru', 'required|min_length[5]');
			$this->form_validation->set_rules('repeat_new_password', 'ulangi password baru', 'required|min_length[5]');

			$errors = array();
			if ($this->form_validation->run()) {
				$user = $this->db->select("*")->from($this->table)->where("user_id", $this->session->userdata('id'))->get()->result_object();
				if (count($user) > 0) {
					$old_password 				= $this->input->post('old_password');
					$new_password 				= $this->input->post('new_password');
					$repeat_new_password 		= $this->input->post('repeat_new_password');

					if ($new_password !== $repeat_new_password) {
						$errors['new_password'] = 'New password and repeat new password is different';
					} else {
						if (password_verify($old_password, $user[0]->password)) {
							$updated = $this->db->where("user_id", $this->session->userdata('id'))->update($this->table, array(
								"password"		=> password_hash($new_password, PASSWORD_DEFAULT)
							));

							if ($updated) {
								$this->session->set_flashdata('message_success_password', 'Password berhasil diubah');
								redirect(base_url().'biodata');
							}
						} else {
							$errors['old_password'] = 'Old password wrong';
						}
					}
					$this->session->set_flashdata('errors', $errors);

					redirect(base_url().'biodata');
				} else {
					var_dump($user);
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

	public function image()
	{
		if ($this->input->server("REQUEST_METHOD") == "POST") {
			$file		= $_FILES['avatar'];
			$filename 	= $file['name'];
			if ($filename == "") {
				http_response_code(400);
				echo json_encode(array(
					"message" => "Avatar tidak boleh kosong",
					"success" => false,
				));
			} else {
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if (in_array($ext, array('png', 'jpg', 'jpeg'))) {
					$image_new_name = uniqid().'.'.$ext;
					if (move_uploaded_file($file['tmp_name'], FCPATH.'assets/img/avatar/'.$image_new_name)) {
						$updated = $this->db->where('user_id', $this->session->userdata('id'))->update($this->table, array(
							'photo'		=> 	$image_new_name
						));

						if ($updated) {
							$this->session->set_userdata('avatar', $image_new_name);
							$this->session->set_flashdata('message_success_image', 'Avatar berhasil diubah');
							echo json_encode(array(
								"message" => "Upload berhasil",
								"success" => true,
							));
							return;
						}
					}

					http_response_code(500);
					echo json_encode(array(
						"message" => "Avatar gagal diupload",
						"success" => false,
					));
				} else {
					http_response_code(400);
					echo json_encode(array(
						"message" => "Ekstensi hanya boleh png, jpg, jpeg",
						"success" => false,
					));
				}
			}
		} else {
			show_404();
		}
	}
}
