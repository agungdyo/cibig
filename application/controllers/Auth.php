<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('DataSekolah_m');
        //$this->load->model('Auth_m');
        $this->load->library(array('form_validation', 'Recaptcha'));
        date_default_timezone_set("Asia/Jakarta");
    }
    public function index()
    {
        if ($this->session->userdata('role_id')) {
            // $this->load->view('complete_login');
            $this->page();
        }
        else{
        $data = array(
            'title'         => 'Login', 
            'script_captcha' => $this->recaptcha->getScriptTag()
        ); 
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
         
        $dataIsi = array('script_captcha' => $this->recaptcha->getScriptTag());
        $recaptcha = $this->input->post('g-recaptcha-response');
        if(isset($recaptcha)){
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header-login', $data);
            $this->load->view('auth/index');
            $this->load->view('templates/footer-login');
            } else {
                if (!isset($response['success']) || $response['success'] <> true) {
                    $dataIsi['captcha'] = 'Please Complete Captcha';
                    $this->load->view('templates/header-login', $data);
                    $this->load->view('auth/index', $dataIsi);
                    $this->load->view('templates/footer-login');
                }
                else {
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');
                    $users = $this->db->where(['username'=>$username])->or_where(['email' => $username])->get('tbl_login')->row_array();
                    if ($users) {
                        if ($users['active'] == 1) {
                                $dataLogin = array(
                                    'username' => $users['username'],
                                    'role_id'  => $users['role_id'],
                                );
                                $this->session->set_userdata($dataLogin);
                                $dataLog = array(
                                    'username'      => $users['username'],
                                    'role_id'       => $users['role_id'],
                                    'tipe'          => 'login',
                                    'time'          => time()
                                );
                                
                                $this->page();
                        }
                        else {
                            $this->session->set_flashdata('gagal','Login : '.$username.'<br>Belum berhasil login !');
                            redirect('auth/index','refresh');
                        }
                    }
                    else {
                        
                        $this->session->set_flashdata('gagal','Login : '.$username.'<br>Tidak ditemukan !');
                    }
                }
            }
        }
        else {
            $this->load->view('templates/header-login', $data);
            $this->load->view('auth/index', $dataIsi);
            $this->load->view('templates/footer-login');
        }
        }
    }
    public function register()
    {
        $data = array(
            'title'          => 'Register', 
            'script_captcha' => $this->recaptcha->getScriptTag(),
        ); 
        /////////////////// FORM VALIDATION //////////////
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tbl_loginppdb.username]|is_unique[tbl_login.username]',[
            'is_unique' => 'Username already in use !'
        ]);
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim|is_unique[tbl_loginppdb.telp]|is_unique[tbl_login.telp]',[
            'is_unique' => 'Phone already in use !'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_loginppdb.email]|is_unique[tbl_login.email]',[
            'is_unique' => 'Email already in use !'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|max_length[20]',[
            'min_length' => 'Password too Short !',
            'max_length' => 'Password too Long !'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]',[
            'matches' => "Password don't match !"
        ]);
        $dataIsi = array('script_captcha' => $this->recaptcha->getScriptTag());
        $recaptcha = $this->input->post('g-recaptcha-response');
        if(isset($recaptcha)){
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header-login', $data);
                $this->load->view('auth/register', $dataIsi);
                $this->load->view('templates/footer-login');
            } else {
                if (!isset($response['success']) || $response['success'] <> true) {
                    $dataIsi['captcha'] = 'Please Complete Captcha';
                    $this->load->view('templates/header-login', $data);
                    $this->load->view('auth/register', $dataIsi);
                    $this->load->view('templates/footer-login');
                }
                else {
                    
                    if ($this->Auth_m->insertRegister($data)) {
                        $this->session->set_flashdata('berhasil','Login : '.$data['username'].' Berhasil Ditambahkan ');
                        redirect('auth/index','refresh');
                    }
                    else {
                        $this->session->set_flashdata('gagal','Login : '.$data['username'].' Gagal Ditambahkan ');
                        redirect('auth/register','refresh');
                    }
                }
            }
        }
        else {
            $this->load->view('templates/header-login', $data);
            $this->load->view('auth/register', $dataIsi);
            $this->load->view('templates/footer-login');
        }
    }
    public function page()
    {
        $role = $this->session->userdata('role_id');
        if ($role == 1) {
            redirect('home');
        }
        elseif ($role == 2) {
            redirect('users');
        }
        else{
            redirect('');
        }
    }


    public function logout()
    {
        if($username = $this->session->userdata('username'))
        {
            // set login history
            $dataLog = array(
                'username'      => $this->session->userdata('username'),
                'role_id'       => $this->session->userdata('role_id'),
                'tipe'          => 'logout',
                'time'          => time()
                /* 'ip_address'    => get_client_ip_env(),
                'os'            => $this->agent->platform(),
                'browser'       => agent() */
            );
            
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('role_id');
            $this->session->set_flashdata('berhasil','<b>'.$username.'</b> Berhasil logout');
        }
        redirect('auth','refresh');
    }
}