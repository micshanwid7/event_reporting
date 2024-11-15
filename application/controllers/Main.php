<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
	public function index()
	{
		redirect('main/login');
	}

	public function login()
	{
		$this->session->userdata('user') != '' ? redirect('report') : false;

		global $serverip;
		$data = [];
		if (empty($this->input->post('submit'))) {
			$this->load->view('vlogin', $data, FALSE);
		} else {
			$post['username'] = $this->input->post('username');
			$post['password'] = sha1($this->input->post('password'));

			// $url = $serverip . 'login';
			// $raw = $this->api_login($url, $post);
			// $res = json_decode($raw, TRUE);

			$res = $this->mglobal->php_login($post);
			if (!empty($res)) {
				if ($res['password'] == $post['password']) {
					$data = $res;
					$this->session->set_userdata('user', $data['username']);
					$this->session->set_userdata('name', $data['name']);
					$this->session->set_userdata('id', $data['id']);
					$this->session->set_userdata('level', $data['level']);

					switch ($data['level']) {
						default : redirect('report'); break;
					}

				} else {
					$this->session->set_flashdata('login', 'Wrong Password');
					redirect('main/login');
				}
			} else {
				$this->session->set_flashdata('login', 'User not found');
				redirect('main/login');
			}

		// 	// dummy login
		// 	// $res['code'] = '200';
		// 	// $res['data']['id'] = 1;
		// 	// $res['data']['username'] = 'admin';
		// 	// $res['data']['name'] = 'admin';
		// 	// $res['data']['level'] = 99;

		// 	// if (!empty($res)) {
		// 	// 	if ($res['code'] == '200') {
		// 	// 		$data = $res['data'];
		// 	// 		$this->session->set_userdata('user', $data['username']);
		// 	// 		$this->session->set_userdata('name', $data['name']);
		// 	// 		$this->session->set_userdata('id', $data['id']);
		// 	// 		$this->session->set_userdata('level', $data['level']);
		// 	// 		redirect('dashboard');
		// 	// 	} else if($res['code'] == 401) {
		// 	// 		$this->session->set_flashdata('login', $res['data']['message']);
		// 	// 		redirect('main/login');
		// 	// 	} else {
		// 	// 		$this->session->set_flashdata('login', 'Unknown error');
		// 	// 		redirect('main/login');
		// 	// 	}
		// 	// } else {
		// 	// 	$this->session->set_flashdata('login', 'Lost connection to data server');
		// 	// 	redirect('main/login');
		// 	// }
		}
	}

	// public function changepassword(){
	// 	$this->mglobal->checkpermit();
	// 	global $serverip;
	// 	$header = $this->mglobal->get_notif();
	// 	$header['title'] = 'Change Password';

	// 	if(empty($this->input->post('submit'))){
	// 		$this->load->view('vheader', $header);
	// 		$this->mglobal->load_toast();
	// 		$this->load->view('vchangepassword');
	// 		$this->load->view('vfooter');
	// 	} else {
	// 		$post = $this->parse_postdata();
	// 		$post['id'] = $this->session->userdata('id');
	// 		$post['old_password'] = sha1($post['old_password']);
	// 		$post['new_password'] = sha1($post['new_password']);
	// 		$url = $serverip . 'users_password';
	// 		$raw = $this->mglobal->api_update($url, $post);
	// 		$res = json_decode($raw, true);
	// 		if (!empty($res)) {
	// 			if ($res['code'] == "200") {
	// 				$this->session->set_flashdata('info', $res['data']);
	// 				redirect('main/changepassword');
	// 			}
	// 			else if($res['code'] == "201"){
	// 				$this->session->set_flashdata('error', $res['data']);
	// 				redirect('main/changepassword');
	// 			}
	// 			else {
	// 				$this->session->set_flashdata('global', 'upd_failed');
	// 				redirect('main/changepassword');
	// 			}
	// 		}
	// 		else {
	// 			$this->session->set_flashdata('global', 'upd_failed');
	// 			redirect('main/changepassword');
	// 		}
	// 	}
	// }

	public function changepassword()
	{
		$post = $this->mglobal->parse_postdata();
		foreach ($post as $key => $value) {
			$post[$key] = sha1($value);
		}
		$post['id'] = $this->session->userdata('id');
		$res = $this->mglobal->change_password($post);

		if($res) $this->session->set_flashdata('password', 'Change password success!');
		echo json_encode($res);
	}

	private function parse_postdata()
	{
		// automatically fetch all post data
		$post = [];
		foreach ($_POST as $key => $val) {
			$key2 = substr($key, strpos($key, "_") + 1);
			if (substr($key, 0, 2) == 'i_') $post[$key2] = $val; // only return post data with input prefix 'i_'
		}
		return $post;
	}

	public function api_login($url, $post)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // bypass SSL checking on https
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}


	public function show404()
	{
		$this->load->view('page/v404');
	}

	public function show500()
	{
		$this->load->view('page/v500');
	}

	public function show403()
	{
		$this->load->view('page/v403');
	}
	public function logout()
	{
		session_destroy();
		redirect('main/login');
	}
}

/* End of file Main.php */
