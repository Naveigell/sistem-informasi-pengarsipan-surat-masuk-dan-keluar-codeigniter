<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Dashboard
 * @property CI_DB_pdo_driver $db
 */
class Dashboard extends CI_Controller {
	public function index()
	{
		$data['content'] = 'pages/admin/dashboard';
		$this->load->view('includes/layout', $data);
	}
}
