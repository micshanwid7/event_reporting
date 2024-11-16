<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mglobal extends CI_Model
{

	public function serverip()
	{
		// $ip = 'http://147.139.185.19:3100/';
		// $ip = 'http://127.0.0.1:3100/';
		//$ip = 'http://192.168.100.252:3100/';
		// $ip = 'http://localhost:8080/indoserako_journal/';
		global $serverip;
		return $serverip;
	}

	public function indexofuser()
	{
		global $serverip;
		$data = [];
		$url = $serverip . 'users';
		$raw = $this->mglobal->api_get($url);
		$user = json_decode($raw, true);
		//print_r($user);
		$data[0] = 'None';
		foreach ($user['data'] as $key => $val) {
			$data[$val['id']] = $val['username'];
		}
		return $data;
	}

	public function checkpermit($param = null)
	{
		if ($this->session->userdata('user') == '') {
			redirect('main/login', 'refresh');
		}

		switch ($param) {
			case 10:
			case 'spv':
				if ($this->session->userdata('level') < 10) redirect('main/show403', 'refresh');
				break;
			case 20:
			case 'manager':
				if ($this->session->userdata('level') < 20) redirect('main/show403', 'refresh');
				break;
			case 99:
			case 'admin';
				if ($this->session->userdata('level') < 99) redirect('main/show403', 'refresh');
				break;
			default:
				return true;
				break;
		}
	}

	public function load_modal()
	{
		//-- popup modal based on flashdata
		//-- to be called after loading vheader

		$temp = $this->session->flashdata('global');
		switch ($temp) {
			case 'ins_success':
				$this->load->view('modal/vinsert_success');
				break;
			case 'ins_failed':
				$this->load->view('modal/vinsert_failed');
				break;
			case 'upd_success':
				$this->load->view('modal/vupdate_success');
				break;
			case 'upd_failed':
				$this->load->view('modal/vupdate_failed');
				break;
			case 'del_success':
				$this->load->view('modal/vdelete_success');
				break;
			case 'del_failed':
				$this->load->view('modal/vdelete_failed');
				break;
			case 'lost_connection':
				$this->load->view('modal/vlost_connection');
				break;
			case 'unknown':
				$this->load->view('modal/vunknown');
				break;
			default:
				break;
		}
	}

	public function load_toast()
	{
		//-- popup toast based on flashdata
		//-- using plugin toastr.js
		//-- to be called after loading vheader

		$temp = $this->session->flashdata('global');
		$data['msg'] = '';
		/* flag
		|  0 = danger
		|  1 = warning
		|  2 = success
		*/
		$data['flag'] = 0;
		switch ($temp) {
			case 'ins_success':
				$data['flag'] = 2;
				$data['msg'] = 'Insert data success!';
				$this->load->view('page/vtoast', $data);
				break;
			case 'ins_failed':
				$data['msg'] = 'Insert data failed!';
				$this->load->view('page/vtoast', $data);
				break;
			case 'upd_success':
				$data['flag'] = 2;
				$data['msg'] = 'Update data success!';
				$this->load->view('page/vtoast', $data);
				break;
			case 'upd_failed':
				$data['msg'] = 'Update data failed!';
				$this->load->view('page/vtoast', $data);
				break;
			case 'del_success':
				$data['flag'] = 2;
				$data['msg'] = 'Delete data success!';
				$this->load->view('page/vtoast', $data);
				break;
			case 'del_failed':
				$data['msg'] = 'Delete data failed!';
				$this->load->view('page/vtoast', $data);
				break;
			case 'feed_success':
				$data['flag'] = 2;
				$data['msg'] = 'Submit feedback success!';
				$this->load->view('page/vtoast', $data);
				break;
			case 'feed_failed':
				$data['msg'] = 'Submit feedback failed!';
				$this->load->view('page/vtoast', $data);
				break;
			case 'feed_status_success':
				$data['flag'] = 2;
				$data['msg'] = 'Change feedback status success!';
				$this->load->view('page/vtoast', $data);
				break;
			case 'reset_success':
				$data['flag'] = 2;
				$data['msg'] = 'Reset password success!';
				$this->load->view('page/vtoast', $data);
				break;
			case 'date_limit':
				$data['msg'] = 'Maximum period in 7 days!';
				$this->load->view('page/vtoast', $data);
				break;
			case 'invalid_date':
				$data['msg'] = 'Invalid date! From date must be smaller than to date';
				$this->load->view('page/vtoast', $data);
				break;
			case 'invalid_file':
				$data['msg'] = 'Xlsx file only!';
				$this->load->view('page/vtoast', $data);
				break;
			case 'imp_success':
				$data['flag'] = 2;
				$data['msg'] = 'Import data success!';
				$this->load->view('page/vtoast', $data);
				break;
			case 'imp_failed':
				$data['msg'] = 'Import data failed!';
				$this->load->view('page/vtoast', $data);
				break;
			case 'dup_data':
				$data['flag'] = 2;
				$data['msg'] = 'Several data already exist! Update success!';
				$this->load->view('page/vtoast', $data);
				break;
			case 'roll_success':
				$data['flag'] = 2;
				$data['msg'] = 'Rollback Visit success!';
				$this->load->view('page/vtoast', $data);
				break;
			case $temp:
				if (!empty($temp)) {
					$data['msg'] = $temp;
					$this->load->view('page/vtoast', $data);
				}
				break;
			default:
				break;
		}
	}

	public function lost_connection()
	{
		$this->load->view('vheader');
		$this->load->view('page/vlost_connection');
		$this->load->view('vfooter');
	}

	public function internal_error()
	{
		$this->load->view('vheader');
		$this->load->view('page/vinternal_error');
		$this->load->view('vfooter');
	}

	public function error_custom($data)
	{
		$this->load->view('vheader');
		$this->load->view('page/verror_custom', $data);
		$this->load->view('vfooter');
	}

	public function prev_month($year, $month)
	{
		$tanggal =  date('Y-m-d', strtotime($year . '-' . $month . " -1 month"));
		$prevyear = date('Y', strtotime($tanggal));
		$prevmonth = date('m', strtotime($tanggal));
		return $prevyear . '/' . $prevmonth;
	}

	public function next_month($year, $month)
	{
		$tanggal =  date('Y-m-d', strtotime($year . '-' . $month . " +1 month"));
		$nextyear = date('Y', strtotime($tanggal));
		$nextmonth = date('m', strtotime($tanggal));
		return $nextyear . '/' . $nextmonth;
	}

	public function prev_week($year, $week)
	{
		$tanggal =  date('Y-m-d', strtotime($year . 'W' . $week . " -1 week"));
		$prevyear = date('Y', strtotime($tanggal));
		$prevweek = date('W', strtotime($tanggal));
		return $prevyear . '/' . $prevweek;
	}

	public function next_week($year, $week)
	{
		$tanggal =  date('Y-m-d', strtotime($year . 'W' . $week . " +1 week"));
		$nextyear = date('Y', strtotime($tanggal));
		$nextweek = date('W', strtotime($tanggal));
		return $nextyear . '/' . $nextweek;
	}

	public function nextday($tanggal)
	{
		$nextday =  date('Y-m-d', strtotime($tanggal . " +1 day"));
		return $nextday;
	}

	public function prevday($tanggal)
	{
		$prevday =  date('Y-m-d', strtotime($tanggal . " -1 day"));
		return $prevday;
	}

	public function api_get($url)
	{
		// $jwt = $this->session->userdata('jwt');
		// $authorization = "authorization: bearer ".$jwt;

		// $request_headers = [
		// 	'session_id:' . session_id()
		// ];

		$ch = curl_init();
		// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization ));
		//curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); // maximum time (seconds) for trying connection
		curl_setopt($ch, CURLOPT_TIMEOUT, 300);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //-- return the transfer as a string
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // bypass SSL checking on https
		$output = curl_exec($ch); //-- contains the output string
		curl_close($ch); //-- close curl resource to free up system resources
		// $data = json_decode($output, TRUE); //-- decode json data to PHP array

		// print_r($output);
		// return $data;
		return $output;
	}

	public function api_insert($url, $post = null)
	{
		// $jwt = $this->session->userdata('jwt');
		// $authorization = "authorization: bearer ".$jwt;
		// $json = json_encode($post);

		$ch = curl_init();
		// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization )); // send authorization header
		// curl_setopt($ch, CURLOPT_HEADER, true);  // include headers, default is true
		// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); // send authorization header
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $json); //send with json
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post)); //send with array
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return the transfer as a string
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // bypass SSL checking on https
		$output = curl_exec($ch); // contains the output string
		// $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE); //save httpcode
		curl_close($ch); //close curl resource to free up system resources

		// $result = json_decode($output,true);
		// $result['http_status'] = $http_status;
		return $output;
	}

	public function api_update($url, $post)
	{
		// $jwt = $this->session->userdata('jwt');
		// $authorization = "authorization: bearer ".$jwt;

		// $json = json_encode($post);
		$ch = curl_init();
		// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization ));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // update 
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post)); //send with array
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $json); //send with json
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return the transfer as a string
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // bypass SSL checking on https
		$output = curl_exec($ch); // contains the output string
		curl_close($ch); //close curl resource to free up system resources
		// $result = json_decode($output,true);
		return $output;
	}

	public function api_delete($url)
	{
		// $jwt = $this->session->userdate('jwt');
		// $authorization = "authorization: bearer ".$jwt;

		$ch = curl_init();
		// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization ));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); // delete
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return the transfer as a string
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // bypass SSL checking on https
		$output = curl_exec($ch); // contains the output string
		curl_close($ch); //close curl resource to free up system resources
		// $result = json_decode($output,true);
		return $output;
	}

	public function php_login($post)
	{
		$this->db->where('username', strtolower($post['username']));
		$res = $this->db->get('users');

		return $res ? $res->row_array() : false;
	}

	public function get_table($table, $by_id = null, $spec_column = null)
	{

		if ($by_id != null) {
			if ($spec_column != null) {
				if ($table == 'users') {
					$this->db->select($spec_column)->from($table);
					$this->db->join('plant', 'plant.id = users.id_plant');
					$this->db->join('company', 'company.id = plant.id_company');
					$this->db->where('users.id', $by_id);
				} else {
					$this->db->select($spec_column)->from($table)->where('id', $by_id);
				}
			} else {
				$this->db->select('*')->from($table)->where('id', $by_id);
			}

			$res = $this->db->get();

			return $res ? $res->row_array() : false;
		} else {
			switch ($table) {
				case 'participants':
					$this->db->order_by('id', 'asc');
					break;
				case 'line':
					$this->db->order_by('id', 'asc');
					break;
				case 'users': {
						$this->db->select('users.*');
						$this->db->order_by('users.id', 'asc');
						break;
					}
				default:
					break;
			}
			$res = $this->db->get($table);
			return $res ? $res->result_array() : false;
		}

		if ($by_id != null) {
			$this->db->select('velocity_json, ge_json');
			$this->db->where('id', $by_id);
			$res = $this->db->get($table);
			return $res ? $res->row_array() : false;
		} else {
			$res = $this->db->get($table);
			return $res ? $res->result_array() : false;
		}
	}

	public function get_item($table, $where)
	{
		$this->db->where($where);
		$res = $this->db->get($table);
		return $res ? $res->row_array() : false;
	}

	public function get_items($table, $where)
	{
		$this->db->where($where);
		switch ($table) {
			case 'device':
				$this->db->order_by('id', 'asc');
				break;
			default:
				break;
		}
		$res = $this->db->get($table);
		return $res ? $res->result_array() : false;
	}

	public function parse_postdata()
	{
		// automatically fetch all post data
		$post = [];
		foreach ($_POST as $key => $val) {
			$xss_check = $this->input->post($key, TRUE);
			$key2 = substr($key, strpos($key, "_") + 1);
			if (substr($key, 0, 2) == 'i_') $post[$key2] = $xss_check; // only return post data with input prefix 'i_ 
			else if (substr($key, 0, 2) == 'p_') $post[$key] = $xss_check;
		}
		return $post;
	}

	public function change_password($data, $reset = null)
	{
		if ($reset) {
			$this->db->set('password', sha1('123'));
			$this->db->where('id', $data);
			$this->db->update('users');
		} else {
			$this->db->select('password')->from('users')->where('id', $data['id']);
			$res = $this->db->get();
			$oldpass = $res->row_array();

			if ($oldpass['password'] != $data['old_password']) {
				return false;
			} else {
				$this->db->set('password', $data['new_password']);
				$this->db->where('id', $data['id']);
				$this->db->update('users');
			}
		}
		return true;
	}

	public function pre($data)
	{ 
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
}

/* End of file Mglobal.php */
/* Location: ./application/models/Mglobal.php */