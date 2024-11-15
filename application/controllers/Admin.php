<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function index()
	{
		$header['title'] = 'Admin Page';
		$data = [];

		$this->load->view('vheader', $header);
		// $this->mglobal->load_toast();
		$this->mglobal->load_modal();
		$this->load->view('admin/vadmin', $data);
		$this->load->view('vfooter');
	}

	public function color()
	{
		$header['title'] = 'Color Library';
		$data = [];

		$this->load->view('vheader', $header);
		$this->load->view('admin/vcolor', $data);
		$this->load->view('vfooter');
	}

	public function dummy()
	{
		global $serverip;
		$this->load->model('mdummy');

		$header['title'] = 'Dummy Data';
		$i = 0;
		$data['dummy'][$i]['name'] = 'Dashboard';
		$data['dummy'][$i]['url']  = $serverip . 'dashboard';
		$data['dummy'][$i]['data'] = $this->mdummy->dashboard();
		$i++;
		$data['dummy'][$i]['name'] = 'Workload';
		$data['dummy'][$i]['url']  = $serverip . 'get_workload';
		$data['dummy'][$i]['data'] = $this->mdummy->workload();

		$this->load->view('vheader', $header);
		$this->load->view('admin/vdummy', $data);
		$this->load->view('vfooter');
	}

	public function get()
	{
		$this->load->model('Mglobal');
		$serverip = $this->mglobal->serverip();
		$data['serverip'] = $serverip;
		$data['json'] = '';

		if (empty($this->input->post('btn_submit'))) {
			$data['url'] = '';
			$data['full_url'] = '';
		} else {
			$data['url'] = $this->input->post('782_url');
			$data['full_url'] = $serverip . $this->input->post('782_url');
			$raw = $this->mglobal->api_get($data['full_url']);
			$data['json'] = $raw;
		}

		// print_r($data);
		$this->load->view('vheader');
		$this->load->view('admin/vapi_get', $data);
		$this->load->view('vfooter');
	}

	public function parse_postdata()
	{
		// automatically fetch all post data
		$post = [];
		foreach ($_POST as $key => $val) {
			$key2 = substr($key, strpos($key, "_") + 1);
			if (substr($key, 0, 2) == 'i_') $post[$key2] = $val; // only return post data with input prefix 'i_'
		}
		return $post;
	}

	public function lost_connection()
	{
		$this->mglobal->lost_connection();
	}

	public function userdata()
	{
		$all = $this->session->userdata();
		print_r($all);
	}

	public function phpinfo()
	{
		phpinfo();
	}

	public function sandbox()
	{
		echo '<pre>';
		print_r($_SERVER);
		echo '</pre>';
	}
}

/* End of file Admin.php */
