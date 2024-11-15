<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdummy extends CI_Model
{
	public function dash()
	{
		$data = [
			"device" => [
				"1" => [
					"pressure" => 30.2,
				],
				"2" => [
					"pressure" => 30.2,
				],
				"3" => [
					"pressure" => 30.2,
				],
				"4" => [
					"pressure" => 30.2,
				],
				"5" => [
					"pressure" => 9.2,
				],
				"6" => [
					"pressure" => 9.2,
				],
				"7" => [
					"pressure" => 9.2,
				],
				"8" => [
					"pressure" => 15.2,
				],
				"9" => [
					"pressure" => 15.2,
				],
			],
			"last_update" => "2024-10-21 08:30:24"
		];

		$res['code'] = 200;
		$res = $data;
		return json_encode($res);
	}
}

/* End of file Mdummy.php */
/* Location: ./application/models/Mdummy.php */