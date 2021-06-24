<?php

class AkunController extends CI_controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Akun');
        $this->load->library('form_validation');
        if ($this->session->userdata('status') != 'admin') {
            redirect('home');
        }
    }

    public function index(){
        $config = [
            'judul' => 'akun',
            'judulHalaman' => 'tabel-akun'
        ];
        $data = [
            'akun' => $this->Akun->get_Akun()
        ];
        $this->load->view('template/header',$config);
        $this->load->view('admin/akun/akun',$data);
        $this->load->view('template/footer');
    }

    public function tambah(){
        $this->form_validation->set_rules('id_akun','username','required|max_length[15]|is_unique[tblakun.id_akun]');
        $this->form_validation->set_rules('nama_akun','nama','required|is_unique[tblakun.nama_akun]');

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $this->Akun->tambah();
            $this->session->set_flashdata('update_akun','data berhasil ditambahkan');
            $this->index();
        }
    }

    
    public function get_aktivasi($id)
    {
        $this->Akun->aktifkan_akun($id);
        $this->session->set_flashdata('update_akun','data berhasil diaktivasi');
        redirect('akun');
    }
    public function get_blokir($id)
    {
        $this->Akun->nonaktifkan_akun($id);
        $this->session->set_flashdata('update_akun','data berhasil dinonaktifkan');
        redirect('akun');
    }
    public function hapus($id)
    {
        $this->Akun->hapus($id);
        $this->session->set_flashdata('update_akun','data berhasil hapus');
        redirect('akun');
    }
}