<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PdfParser extends \Dompdf\Dompdf {

	public function __construct(){
		parent::__construct();
	}

	private function app(){
		return get_instance();
	}

	public function parse($filename, $view, $data = array())
	{
		$html = $this->app()->load->view($view, $data, true);

		$this->loadHtml($html);
		$this->render();
		$this->stream($filename.date('_d_m_Y_H_i_s_').uniqid(), array(
			"Attachment"	=> false
		));
	}
}
