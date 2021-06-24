<?php

class AuthController extends CI_controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Petugas');
        $this->load->library('session');
    }
    
    
    public function index()
    {
        if ($this->session->userdata('status') == '') {
            $this->load->view('auth/login');
        } else {
            redirect('/home');            
        }
    }

    public function login()
    {
        $username = $this->input->post('username',true);
        $password = $this->input->post('password',true);
        $cek       = $this->Petugas->cekLogin($username,$password);
        
        if ($cek['row'] > 0) {
            
            switch ($cek['level']) {
                case 1:
                    $role = "admin";
                    break;
                case 2:
                    $role = "teller";
                    break;
                case 3:
                    $role = "ketua";
                    break;
                default:
                    $role = "aa";
                    break;
            }
            $data = [
                "id" => $cek['id'],
                "status" => $role,
                "nama"   => $cek['nama'],  
                "username"   => $cek['username'],   
                "email"   => $cek['email'],   
                "gambar"   => $cek['gambar'],   
                "tanggal"   => $cek['tanggal'],   
            ];

            // echo var_dump($data);
            $this->session->set_userdata($data);
            redirect('/home');            
        } else {
            $this->session->set_flashdata('flashdata_login','Username / pasword tidak cocok');
            redirect('/');            
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        // $this->session->unset_userdata('status');
        redirect('/');            
    }

}