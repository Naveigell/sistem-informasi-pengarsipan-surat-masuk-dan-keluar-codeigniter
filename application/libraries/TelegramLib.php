<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TelegramLib
{
	private $accessToken;

	const SEND_MESSAGE = 1;
	const SEND_DOCUMENT = 2;

	public function __construct()
	{
		$ci = &get_instance();
		$ci->load->config('api_token');
		$this->accessToken = $ci->config->item('telegram_token');
	}

	public function sendDocument($id, $path, $options = array())
	{
		$data = array(
			"chat_id" 			=> $id,
			"document"			=> new CURLFile(realpath("uploads/suratmasuk/".$path)),
		);

		if (!empty($options["caption"])) {
			$data["caption"] = $options["caption"];
		}

		$this->send($data, "sendDocument", self::SEND_DOCUMENT);
	}

	public function sendMessage($id, $text, $options = array())
	{
		$data = array(
			"chat_id" 	=> $id,
			"text"		=> $text
		);

		if (!empty($options["request_contact"])) {
			$data["reply_markup"] = array(
				"keyboard"			=> array(
					array(
						array(
							"text"				=> "Kirim Nomor Telponmu",
							"request_contact"	=> true
						)
					)
				),
				"one_time_keyboard"				=> true,
				"resize_keyboard"				=> true,
			);
		}

		if (!empty($options["html"])) {
			$data["parse_mode"] = "html";
		}

		$this->send($data, "sendMessage");
	}

	private function send($data, $endpoint, $type = self::SEND_MESSAGE)
	{
		$ch = curl_init();
		$header = "multipart/form-data";

		if ($type === self::SEND_MESSAGE) {
			$header = "application/json";
			$data = json_encode($data);
		}

		curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$this->accessToken/$endpoint");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_POST,TRUE);
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Content-Type:$header"));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		$output = curl_exec($ch);

		curl_close($ch);
	}
}
