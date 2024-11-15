<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mdetail extends CI_Model
{
    public function get_data_log($line_id = null, $from_date = null, $to_date = null)
    {
        $data = [];

        // $this->db->select('created_at');
        // $this->db->distinct();
        // $this->db->order_by('created_at', 'asc');
        // $res = $this->db->get('data_log');
        // $created_at = $res->result_array();

        // $this->db->select('times');
        // $this->db->distinct();
        // $this->db->order_by('times', 'asc');
        // $res = $this->db->get('data_log');
        // $created_at = $res->result_array();

        $this->db->where('line', $line_id);
        $res = $this->db->get('device');
        $device = $res->result_array();

        $arr_press = [];

        $date_range = false;
        if($to_date != null) $date_range = true;
        foreach ($device as $key => $value) {
            $this->db->where('device_id', $value['id']);
            if($date_range){ //report chart
                $this->db->where('date >=', $from_date);
                $this->db->where('date <=', $to_date);
            }else{ //detail chart
                $this->db->where('date', $from_date);
            }
            $this->db->order_by('created_at', 'asc');
            $res2 = $this->db->get('data_log');
            $data_log = $res2->result_array();

            if($to_date != null){ //report chat, butuh menampilkan tanggal dan waktu
                foreach ($data_log as $key2 => $value2) {
                    $arr_press[$key][$key2]['x'] = date('Y-m-d H:i:s', strtotime($value2['created_at']));
                    $arr_press[$key][$key2]['y'] = $value2['pressure'];
                }
            }else{ //detail chart, hanya butuh menampilkan waktu
                foreach ($data_log as $key2 => $value2) {
                    $arr_press[$key][$key2]['x'] = date('H:i', strtotime($value2['created_at']));
                    $arr_press[$key][$key2]['y'] = $value2['pressure'];
                }
            }
        }
        $data['pressure'] = $arr_press;
        return $data;
    }

    public function generate_report($line_id = null, $from_date = null, $to_date = null)
    {
        $this->db->select('data_log.*, device.device_name');
        $this->db->from('data_log');
        $this->db->join('device', 'device.id = data_log.device_id');
        $this->db->where('data_log.line', $line_id);
        if($from_date != null && $to_date != null){
            $this->db->where('data_log.date >=', $from_date);
            $this->db->where('data_log.date <=', $to_date);
        }
        $this->db->order_by('data_log.created_at', 'asc');
        $this->db->order_by('data_log.device_id', 'asc');
        $res = $this->db->get();

        return $res ? $res->result_array() : [];
    }
}

/* End of file Mdetail.php */