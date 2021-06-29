<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Logout
 * @property CI_Session $session
 */
class Logout extends CI_Controller {
	public function index()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
