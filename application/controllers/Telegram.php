<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Telegram
 * @property TelegramLib $telegramlib
 */
class Telegram extends CI_Controller
{
	public function index()
	{
		$ci = &get_instance();
		try {
			$response = file_get_contents('php://input');
			$response = json_decode($response, true);
			$messages = $response["message"];

			if (!$messages["from"]["is_bot"]) {
				$id = $messages["from"]["id"];
				$message = "";
				$request_contact = false;
				$user = $ci->db->from("telegram_users")->select("*")->where("chat_id", $id)->get()->result_object();

				if (empty($messages["contact"]) && count($user) <= 0) {
					$message = "Tolong kirim nomor telponmu dengan cara klik tombol di bawah keyboard untuk login ya.";
					$request_contact = true;
				} else if (count($user) > 0) {
					$message = "Terimakasih telah login, kamu akan menerima notifikasi dari kami jika ada surat yang masuk kepadamu.";
				} else {
					$user = $ci->db->from("tbuser")->select("*")->where("phone", "0".substr($messages["contact"]["phone_number"], 2))->get()->result_object();
					if (count($user) > 0) {
						$ci->db->insert("telegram_users", array(
							"chat_id"			=> $id,
							"id_tbuser"			=> $user[0]->user_id
						));
						$message = "Terimakasih telah login, kamu akan menerima notifikasi dari kami jika ada surat yang masuk kepadamu.";
					} else {
						$message = "Nomor telpon mu belum terdaftar, mohon untuk mengubah biodata ya!";
					}
				}

				$this->telegramlib->sendMessage($id, $message, array("request_contact" => $request_contact));
			} else {
				$this->telegramlib->sendMessage($messages["from"]["id"], "Bot response");
			}
		} catch (Exception $exception) {
			error_log($exception->getMessage());
		}
	}
}
