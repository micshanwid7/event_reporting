<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mmaster extends CI_Model
{
	public function serverip()
	{
		// $ip = 'http://127.0.0.1:3100/';
		global $serverip;
		return $serverip;
	}

    public function crud($table, $data, $crud_type)
    {
        $this->db->trans_start(); 
        $this->db->trans_strict(false);

        if ($crud_type == 1) {
			//edit mode
            $this->db->where('id', $data['id']);
            $this->db->update($table, $data);
        } else if($crud_type == 2) {
			//add mode
            $this->db->insert($table, $data);
        }else{
            //delete mode
            $this->db->where('id', $data);
            $this->db->delete($table);    
        }

        $this->db->trans_complete(); 

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            return true;
        }
    }
}

/* End of file Mglobal.php */
/* Location: ./application/models/Mglobal.php */