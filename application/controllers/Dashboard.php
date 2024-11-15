<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mdummy');
	}

	public function index()
	{
		redirect('dashboard/summary', 'refresh');
	}

	public function check_param($param)
	{
		foreach ($param as $key => $value) {
			if ($value == null) $this->index();
		}
	}

	public function summary()
	{
		global $serverip;
		$this->mglobal->checkpermit();
		$header['title'] = 'Dashboard';

		// -- choose one : local /or/ cloud connection

		// local connection
		$res = $this->get_dashboard();

		// cloud connection
		// $url = $serverip . 'unilever/api/dashboard';
		// $raw = $this->mglobal->api_get($url);
		// $res = json_decode($raw, TRUE);
		// -----------------
		
		if (!empty($res['code'])) {
			if ($res['code'] == 200) {
				$data = $res;
				$this->load->view('vheader', $header);
				$this->load->view('vdashboard', $data);
				$this->load->view('vfooter');
			} else {
				// internal server error
			}
		} else {
			// lost connection
		}
	}

	public function filter()
	{
		// print_r($_GET);
		redirect(
			'dashboard/summary/' . $_GET['id_company'] . "/" .
				$_GET['id_plant'] . "/" . $_GET['id_eq_type'] . "/" .
				$_GET['measure_type']
		);
	}

	public function get_dashboard()
	{
		global $serverip;

		$data = [];
		$arr = [];
		$arr_panel = [];

		$data['api_url'] = $serverip;
		$line = $this->mglobal->get_table('line');

		foreach ($line as $key => $value) {
			$device = $this->mglobal->get_items('device', ['line' => $value['line_name']]);
			$panel = [];
			foreach ($device as $key2 => $value2) {
				$panel[$value2['id']] = $value2['device_name'];
				$arr_panel[$value2['id']] = [
					'lower_warn_pressure' => $value2['lower_warn_pressure'],
					'upper_warn_pressure' => $value2['upper_warn_pressure']
				];
			}
			$arr[$value['line_name']] = [
				'panel' => $panel
			];
		}
		$data['code'] = 200;
		$data['row'] = $arr;
		$data['row_panel'] = $arr_panel;

		// $this->mglobal->pre($data);
		return $data;
	}

	public function api_get_dashboard()
	{
		$data = $this->get_dashboard();
		echo json_encode($data);
	}

	public function livedata()
	{
		// echo '{"test":"123456"}';
		global $serverip;
		$raw = $this->mglobal->api_get($serverip . "pressure_api");
		echo $raw;
	}
}

/* End of file Dashboard.php */