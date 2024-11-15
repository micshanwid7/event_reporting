<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('upload');
		$this->load->model('mdummy');
		$this->load->model('mmaster');
	}

    public function index()
    {
       redirect('master/user');
    }

	public function user()
    {
		$this->mglobal->checkpermit(99);
        $header['title'] = 'User';
		$data = [];

		$res = $this->mglobal->get_table('users');

		$data['row'] = $res;

		$this->load->view('vheader', $header);
		$this->mglobal->load_toast();
		$this->load->view('user/vmaster_user', $data);
		$this->load->view('modal/reset_password');
		$this->load->view('vfooter');
    }

	public function user_add()
    {
		$this->mglobal->checkpermit();
        $header['title'] = 'Add User';
		$data = [];

		$this->form_validation->set_rules('i_username', 'username', 'trim|required');
		$this->form_validation->set_rules('i_name', 'name', 'trim|required');
		$this->form_validation->set_rules('i_password', 'password', 'trim|required');
		$this->form_validation->set_rules('i_c_password', 'confirm password', 'trim|required');
		if($this->form_validation->run() == false) {
			$data['user_list'] = $this->mglobal->get_table('users');
            $this->load->view('vheader', $header);
            $this->load->view('user/vmaster_user_add', $data);
            $this->load->view('vfooter');
        }else{
            $post = $this->mglobal->parse_postdata();
			$post['password'] = sha1($post['password']);
			unset($post['c_password']);

			$insert = $this->mmaster->crud('users', $post, 2);

			if($insert){
				$this->session->set_flashdata('global', 'ins_success');
				redirect('master/user');
			}else{
				$data = $post;
				$this->session->set_flashdata('global', 'ins_failed');
				$this->load->view('vheader', $header);
				$this->load->view('user/vmaster_user_add', $data);
				$this->load->view('vfooter');
			}
        }
    }

	public function user_edit($id)
	{
		$this->mglobal->checkpermit(99);
		$header['title'] = 'Edit User';
		$data = [];

		$data['del_title'] = "user";
		$data['url_delete'] = "master/user_delete/";


		$data['edit'] = $this->mglobal->get_table('users', $id);
        
		$this->form_validation->set_rules('i_name', 'name', 'trim|required');
		// $this->form_validation->set_rules('i_password', 'password', 'trim|required');
		// $this->form_validation->set_rules('i_c_password', 'confirm password', 'trim|required');
        
        if($this->form_validation->run() == false) {
            $this->load->view('vheader', $header);
            $this->load->view('user/vmaster_user_edit', $data);
			$this->load->view('modal/delete_message', $data);
            $this->load->view('vfooter');
        }else{
			$post = $this->mglobal->parse_postdata();
			//$post['password'] = sha1($post['password']);
			//unset($post['c_password']);
			unset($post['id_company']);

			$update = $this->mmaster->crud('users', $post, 1);

			if($update){
				$this->session->set_flashdata('global', 'upd_success');
				redirect('master/user');
			}else{
				$data = $post;
				$this->session->set_flashdata('global', 'upd_failed');
				$this->load->view('vheader', $header);
				$this->load->view('company/vmaster_user_edit', $data);
				$this->load->view('vfooter');
			}
		}
	}

	public function user_delete($id)
	{
		$this->mglobal->checkpermit(99);
		$header['title'] = 'Delete User';

		$delete = $this->mmaster->crud('users', $id, 3);

		if($delete) $this->session->set_flashdata('global', 'del_success');
		else $this->session->set_flashdata('global', 'del_failed');
		
		redirect('master/user');
	}

	public function user_reset($id)
	{
		$this->mglobal->checkpermit(99);
		$header['title'] = 'Reset Password User';

		$reset = $this->mglobal->change_password($id, true);

		if($reset) $this->session->set_flashdata('global', 'reset_success');
		
		redirect('master/user');
	}
}

/* End of file Master.php */
