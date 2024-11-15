<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends CI_Controller
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
        redirect('report/participant');
    }

    public function participant()
    {
        $this->mglobal->checkpermit(99);
        $header['title'] = 'Participant';
		$data = [];

		$data['row'] = $this->mglobal->get_table('participants');

		$this->load->view('vheader', $header);
		$this->mglobal->load_toast();
		$this->load->view('participant/vmaster_participant', $data);
		$this->load->view('vfooter');
    }

    public function participant_add()
    {
		$this->mglobal->checkpermit();
        $header['title'] = 'Add Participant';
		$data = [];

		$this->form_validation->set_rules('i_username', 'username', 'trim|required');
		$this->form_validation->set_rules('i_name', 'name', 'trim|required');
		$this->form_validation->set_rules('i_password', 'password', 'trim|required');
		$this->form_validation->set_rules('i_c_password', 'confirm password', 'trim|required');
		if($this->form_validation->run() == false) {
			$data['user_list'] = $this->mglobal->get_table('participants');
            $this->load->view('vheader', $header);
            $this->load->view('participant/vmaster_participant_add', $data);
            $this->load->view('vfooter');
        }else{
            $post = $this->mglobal->parse_postdata();
			$post['password'] = sha1($post['password']);
			unset($post['c_password']);

			$insert = $this->mmaster->crud('participants', $post, 2);

			if($insert){
				$this->session->set_flashdata('global', 'ins_success');
				redirect('master/participant');
			}else{
				$data = $post;
				$this->session->set_flashdata('global', 'ins_failed');
				$this->load->view('vheader', $header);
				$this->load->view('participant/vmaster_participant_add', $data);
				$this->load->view('vfooter');
			}
        }
    }

	public function participant_edit($id)
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

	public function participant_delete($id)
	{
		$this->mglobal->checkpermit(99);
		$header['title'] = 'Delete User';

		$delete = $this->mmaster->crud('users', $id, 3);

		if($delete) $this->session->set_flashdata('global', 'del_success');
		else $this->session->set_flashdata('global', 'del_failed');
		
		redirect('master/user');
    }

	public function import() {
		// Path directory/folder untuk menyimpan file xls yang di upload
		$path 		= './assets/temp/files/';
 
		// Memanggil fungsi upload_config() untuk inisialisasi fungsi upload
		$this->upload_config($path);
		if (!$this->upload->do_upload('file')) {
			//jika proses upload gagal, set flash message error lalu redirect ke halaman form
			$this->session->set_flashdata('global', $this->upload->display_errors());
			redirect('report/participant');
		} else {
			//get data file yang di upload
			$file_data 	= $this->upload->data();
			//get full path hingga ke filename
			$file_name 	= $path.$file_data['file_name'];
			//proses untuk get extension file
			$arr_file 	= explode('.', $file_name);
			$extension 	= end($arr_file);
			//cek dan validasi jika file yang di upload ber ekstensi xlsx
			if($extension == 'xlsx') {
				 // jika file xlsx, buat object reader xlsx.
				$reader 	= new ReaderXlsx();
			} else {
				// jika salah, set flash message error lalu redirect ke halaman form
				$this->session->set_flashdata('global', 'invalid_file');				
				redirect('report/participant');
			}
			//proses extrac data yang ada pada file xlsx
			$spreadsheet 	= $reader->load($file_name);
			$sheet_data 	= $spreadsheet->getActiveSheet()->toArray();
			$list 			= [];
			foreach($sheet_data as $key => $val) {
				if($key != 0) {
					// cek supaya tidak ada duplikasi data
					$result 	= $this->manage_spreadsheet_model->get(array("name" => $val[5]));
					if($result == FALSE || empty($result)) {
						$list [] = [
							'name'				=> $val[0],
							'company_name'		=> $val[1],
							'uuid'				=> $val[2],
						];
					} 
				}
			}
			if(file_exists($file_name))
				//hapus kembali file, supaya tidak memenuhi server
				unlink($file_name);
			
			if(count($list) > 0) {
				// proses insert batch data dari file xlsx ke mysql
				$result 	= $this->manage_spreadsheet_model->add_batch($list);
				if($result) {
					$this->session->set_flashdata('alert',array(
                        	'class' => 'success',
                        	'message' => 'Sukses Import Data'
                    	)
                	);	
					redirect('report/participant');
				} else {
					$this->session->set_flashdata('alert',array(
                        	'class' => 'danger',
                        	'message' => 'Maaf, Import Data Gagal'
                    	)
                	);
					redirect('report/participant');
				}
			} else {
				$this->session->set_flashdata('alert',array(
                        	'class' => 'warning',
                        	'message' => 'Data Sudah Ada di Database'
                    	)
                );
				redirect('report/participant');
			}
		}
		// redirect('report/participant');
	}
 
	public function upload_config($path) {
		if (!is_dir($path)) 
			mkdir($path, 0755, TRUE);		
		$config['upload_path'] 		= './'.$path;		
		$config['allowed_types'] 	= 'xlsx|XLSX|xls|XLS';
		$config['max_filename']	 	= '255';
		$config['encrypt_name'] 	= TRUE;
		$config['max_size'] 		= 4096; 
		$this->load->library('upload', $config);
	}
}

/* End of file Report.php */