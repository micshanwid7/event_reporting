<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail extends CI_Controller
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
        $id = 10;
        $year = date('Y');
        $mnth = date('m');
        redirect('detail/portable/' . $id . '/' . $year . '/' . $mnth);
    }

    public function panel($id, $date)
    {
        global $serverip;
        $this->mglobal->checkpermit();
        $header['title'] = 'Detail';
        $data['id'] = $id;
        $data['date'] = $date;
        // -- choose one : local /or/ cloud connection

        // local connection
        $res = $this->get_detail($id, $date);

        // cloud connection
        // $url = $serverip . 'unilever/api/detail/' . $id . '/' . $date;
        // $raw = $this->mglobal->api_get($url);
        // $res = json_decode($raw, TRUE);
        // -----------------

        // print_r($raw);

        if (!empty($res)) {
            if ($res['code'] == 200) {
                $data = $res;
                $this->load->view('vheader', $header);
                $this->load->view('vdetail', $data);
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
        $post = $this->mglobal->parse_postdata();

        redirect('detail/panel/' . $post['id_line'] . '/' . date('Y-m-d', strtotime($post['date'])));
    }

    function upload_files($field, $type_name, $resize = false)
    {
        $path = "./uploads/feedback";

        //Configure upload.
        $this->upload->initialize(array(
            "upload_path"   => $path,
            "allowed_types" => "jpg|png",
            "file_name"     => $type_name
        ));

        //Perform upload.
        if ($this->upload->do_upload($field)) {

            $fileData = $this->upload->data();

            if ($resize == true) {
                $width = $fileData['image_width'];
                $height = $fileData['image_height'];
            }

            $img_cfg_thumb['image_library'] = 'gd2';
            $img_cfg_thumb['source_image'] = "../uploads/" . $fileData['raw_name'] . $fileData['file_ext'];
            $img_cfg_thumb['maintain_ratio'] = FALSE;
            $img_cfg_thumb['new_image'] = "../uploads/" . $fileData['raw_name'] . $fileData['file_ext'];
            $img_cfg_thumb['width'] = $width;
            $img_cfg_thumb['height'] = $height;
            $img_cfg_thumb['quality'] = 80;
            $this->load->library('image_lib');
            $this->image_lib->initialize($img_cfg_thumb);
            $this->image_lib->resize();

            return $fileData['raw_name'] . $fileData['file_ext'];
        } else {
            //return $this->upload->display_errors(); //check jika ada error pada upload file
            return "upload failed";
        }
    }

    public function get_detail($id, $date)
    {
        $data = [];

        $data['code'] = 200;
        $data['id'] = $id;
        // $data['month'] = $month;
        // $data['year'] = $year;
        $data['date'] = $date;
        //$str_date = $year . "-" . $month . "-" . $date;
        
        $data['row'] = $this->mglobal->get_table('line');
        $data_log = $this->mdetail->get_data_log($id, $date);
        $device = $this->mglobal->get_items('device', ['line' => $id]);

        $data['chart'] = $data_log;
        $data['device'] = $device;

        return $data;
    }

    public function api_get_detail($id, $date)
    {
        $data = $this->get_detail($id, $date);
        echo json_encode($data);
    }
}

/* End of file Detail.php */