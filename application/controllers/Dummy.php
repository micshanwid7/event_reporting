<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dummy extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdummy');
        
    }
    
    public function index()
    {
        
    }

    public function dash(){
        $raw = $this->mdummy->dash();
        echo $raw;
    }

    public function detail(){
        $raw = $this->mdummy->detail();
        echo $raw;
    }

    public function detail_live(){
        $raw = $this->mdummy->detail_live();
        echo $raw;
    }

}

/* End of file Dummy.php */
