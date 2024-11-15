<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Display extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->model('mdetail');
        $this->load->model('mdummy');
        $this->load->model('mmaster');
    }
    
    public function index()
    {
		global $serverip;

		// -- choose one : local /or/ cloud connection

		// local connection
		$res = $this->get_display();

		// cloud connection
		// $url = $serverip . 'unilever/api/display';
		// $raw = $this->mglobal->api_get($url);
		// $res = json_decode($raw, TRUE);
		// -----------------

		if(!empty($res)){
			if($res['code'] == 200){
				$data = $res;
				$this->load->view('vdisplay', $data);
			} else {
				// internal server error
			}
		} else {
			// lost connection
		}
    }

	public function get_display() {
		global $serverip;

		$data = [];
		$data['code'] = 200;
		$data['title'] = 'Display';
		$arr = [];
		$arr_panel = [];

		$x_note = [
		//	HOPPER 1, 	HOPPER 2, 	HOPPER 3	-- D3
			[75,		75, 		350],
		//	HOPPER 1, 	HOPPER 2, 	HOPPER 3	-- D4
			[75, 		75, 		350],
		//	HOPPER 1, 	HOPPER 2, 	HOPPER 3	-- D5
			[60, 		60, 		360]
		];

		$y_note = [
		//	HOPPER 1, 	HOPPER 2, 	HOPPER 3	-- D3
			[150, 		300, 		200],
		//	HOPPER 1, 	HOPPER 2, 	HOPPER 3	-- D4
			[150, 		300, 		200],
		//	HOPPER 1, 	HOPPER 2, 	HOPPER 3	-- D5
			[150, 		300, 		200]
		];

		$x_circle = [
		//	HOPPER 1, 	HOPPER 2, 	HOPPER 3	-- D3
			[215, 		240, 		265],
		//	HOPPER 1, 	HOPPER 2, 	HOPPER 3	-- D4
			[205, 		230, 		255],
		//	HOPPER 1, 	HOPPER 2, 	HOPPER 3	-- D5
			[205, 		230, 		255]
		];

		$y_circle = [
		//	HOPPER 1, 	HOPPER 2, 	HOPPER 3	-- D3
			[290, 		290, 		290],
		//	HOPPER 1, 	HOPPER 2, 	HOPPER 3	-- D4
			[185, 		185, 		185],
		//	HOPPER 1, 	HOPPER 2, 	HOPPER 3	-- D5
			[260, 		260, 		260]
		];

		$data['api_url'] = $serverip;
		$line = $this->mglobal->get_table('line');
			
		foreach ($line as $key => $value) {
			$device = $this->mglobal->get_items('device', ['line' => $value['line_name']]);
			$panel = [];
			foreach ($device as $key2 => $value2) {
				if(!isset($x_note[$key][$key2]) || !isset($y_note[$key][$key2])
				|| !isset($x_circle[$key][$key2]) || !isset($y_circle[$key][$key2])) {
					$x_note[$key][$key2] = 0;
					$y_note[$key][$key2] = 0;
					$x_circle[$key][$key2] = 0;
					$y_circle[$key][$key2] = 0;
				}
				$panel[$value2['id']] = [
					'device_name' => $value2['device_name'],
					'x_note' => $x_note[$key][$key2],
					'y_note' => $y_note[$key][$key2],
					'x_circle' => $x_circle[$key][$key2],
					'y_circle' => $y_circle[$key][$key2]
				];
				$arr_panel[$value2['id']] = [
					'lower_warn_pressure' => $value2['lower_warn_pressure'],
					'upper_warn_pressure' => $value2['upper_warn_pressure']
				];
			}
			$arr[$value['line_name']] = [
				'panel' => $panel
			];
		}
		$data['row'] = $arr;
		$data['row_panel'] = $arr_panel;

		// $this->mglobal->pre($data['row']);
		return $data;
	}

	public function api_display(){
		$res = $this->get_display();
		echo json_encode($res);
	}

	public function livedata()
	{
		global $serverip;
		$raw = $this->mglobal->api_get($serverip . "temp_hum_api");
		echo $raw;
	}
}

/* End of file Detail.php */
