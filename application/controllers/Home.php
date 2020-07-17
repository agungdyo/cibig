<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //is_adminOprator();
        //$this->load->model('DataSekolah_m');
        //$this->load->model('Home_m');
    }
    public function index()
    {
        $data = array(
            'title'         => 'Dashboard'
        );
        $this->load->view('templates/header', $data);
        $this->load->view('templates/footer-full');
        
    }
}
