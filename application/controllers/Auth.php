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
            //'dataSekolah'   => $this->DataSekolah_m->getSekolah()
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
                    //$user = $this->db->where(['username'=>$username])->or_where(['email' => $username])->get('tbl_loginppdb')->row_array();
                    $users = $this->db->where(['username'=>$username])->or_where(['email' => $username])->get('tbl_login')->row_array();
                    if ($user) {
                        if ($user['active'] == 1) {
                            // CEK PASSS
                            if (password_verify($password, $user['password'])) {
                                // set session
                                $dataLogin = array(
                                    'username' => $user['username'],
                                    'role_id'  => 2
                                );
                                $this->session->set_userdata($dataLogin);
                                // set login history
                                $dataLog = array(
                                    'username'      => $user['username'],
                                    'role_id'       => 2,
                                    'tipe'          => 'login',
                                    'time'          => time(),
                                    'ip_address'    => get_client_ip_env(),
                                    'os'            => $this->agent->platform(),
                                    'browser'       => agent()
                                );
                                helper_login($dataLog);
                                $this->page();
                            }
                            else {
                                $this->session->set_flashdata('gagal','Login : '.$username.'<br>Password yang anda masukkan salah !');
                                redirect('auth/index','refresh');
                            }
                        }
                        else {
                            $this->session->set_flashdata('gagal','Login : '.$username.'<br>Belum di aktivasi !');
                            redirect('auth/index','refresh');
                        }
                    }
                    elseif ($users) {
                        if ($users['active'] == 1) {
                            // CEK PASSS
                            if (password_verify($password, $users['password'])) {
                                // Set session
                                $dataLogin = array(
                                    'username' => $users['username'],
                                    'role_id'  => $users['role_id'],
                                );
                                $this->session->set_userdata($dataLogin);
                                // set login history
                                $dataLog = array(
                                    'username'      => $users['username'],
                                    'role_id'       => $users['role_id'],
                                    'tipe'          => 'login',
                                    'time'          => time(),
                                    'ip_address'    => get_client_ip_env(),
                                    'os'            => $this->agent->platform(),
                                    'browser'       => agent()
                                );
                                helper_login($dataLog);

                                $this->page();
                            }
                            else {
                                $this->session->set_flashdata('gagal','Login : '.$username.'<br>Password yang anda masukkan salah !');
                                redirect('auth/index','refresh');
                            }
                        }
                        else {
                            $this->session->set_flashdata('gagal','Login : '.$username.'<br>Belum di aktivasi !');
                            redirect('auth/index','refresh');
                        }
                    }
                    elseif($siswa = $this->db->where(['nama_siswa'=>$username])->or_where(['nisn' => $username])->where('nis_lokal',$password)->get('tbl_siswa')->row_array()){
                        $dataLogin = array(
                            'username' => $siswa['nama_siswa'],
                            'role_id'  => 5,
                            'kelas'    => $siswa['kelas'],
                        );
                        $this->session->set_userdata($dataLogin);
                        $dataLog = array(
                            'username'      => $siswa['nama_siswa'],
                            'role_id'       => 5,
                            'tipe'          => 'login',
                            'time'          => time(),
                            'ip_address'    => get_client_ip_env(),
                            'os'            => $this->agent->platform(),
                            'browser'       => agent()
                        );
                        helper_login($dataLog);

                        $this->page();
                    }
                    else {
                        $this->session->set_flashdata('gagal','Login : '.$username.'<br>Tidak ditemukan !');
                        redirect('auth/index','refresh');
                    }
        // Comand ini Untuk Mematikan G-captcha
                }
            }
        }
        else {
            $this->load->view('templates/header-login', $data);
            $this->load->view('auth/index', $dataIsi);
            $this->load->view('templates/footer-login');
        }
        // Sampai Sini
        }
    }
    public function register()
    {
        $data = array(
            'title'          => 'Register', 
            'script_captcha' => $this->recaptcha->getScriptTag(),
            'dataSekolah'    => $this->DataSekolah_m->getSekolah()
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
        ///////////////// Condition //////////////
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
                    // Cek Last ID Ditahun Tersebut
                    $cekId = $this->db->like('id',date('Y'))->select('id')->order_by('id','DESC')
                                      ->limit(1)->get('tbl_loginppdb')->row()->id;
                    if ($cekId != NULL) {
                        $id = explode('-',$cekId);
                        $ids = $id[1];
                        $idPPDB = date('Y').'-'.str_pad($ids+1, 3, '0', STR_PAD_LEFT);
                        // Hasil 2020-002++
                    }
                    else{
                        $idPPDB = date('Y').'-001';
                        // Reset Hasil 2020-001
                    }
                    $telp       = htmlspecialchars($this->input->post('phone', true));
                    $telephone  = preg_replace('/^0/', '+62', $telp);
                    $data = array(
                        'id'            => $idPPDB,
                        'username'      => htmlspecialchars($this->input->post('username', true)),
                        'name'          => htmlspecialchars($this->input->post('name', true)),
                        'image'         => 'default.jpg',
                        'password'      => password_hash($this->input->post('password1'),PASSWORD_DEFAULT),
                        'email'         => htmlspecialchars($this->input->post('email', true)), 
                        'telp'          => $telephone,
                        'active'        => 1,
                        'formulir'      => 'Belum',
                        'status'        => 'Menunggu',
                        'role_id'       => 2,
                        'waktu_daftar'  => date('Y/m/d H:i:s'),
                        'waktu_update'  => date('0000-00-00 00:00:00'),
                        'nis'           => ''
                    );
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
        elseif ($role == 3) {
            redirect('home');
        }
        elseif ($role == 4) {
            redirect('absen');
        }
        elseif ($role == 5) {
            redirect('FileSiswa');
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
                'time'          => time(),
                'ip_address'    => get_client_ip_env(),
                'os'            => $this->agent->platform(),
                'browser'       => agent()
            );
            helper_login($dataLog);
            if ($this->session->userdata('role_id') == 5) {
                $this->session->unset_userdata('kelas');
            }
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('role_id');
            $this->session->set_flashdata('berhasil','<b>'.$username.'</b> Berhasil logout');
        }
        redirect('auth','refresh');
    }
}