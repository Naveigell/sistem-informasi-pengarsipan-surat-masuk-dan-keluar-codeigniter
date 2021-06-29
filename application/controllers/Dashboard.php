<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Dashboard
 * @property CI_DB_pdo_driver $db
 * @property CI_Session $session
 */
class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata('id')) {
			redirect(base_url().'login');
		}
	}

	public function index()
	{
		$data['content'] = 'pages/admin/dashboard';
		$this->load->view('includes/layout', $data);
	}
}
