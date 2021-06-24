<?php

class PetugasController extends CI_controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Petugas');
        $this->load->library('form_validation');
        if ($this->session->userdata('status') != 'admin') {
            redirect('home');
        }
    }
    public function index(){
        $config = [
            'judul' => 'Petugas',
            'judulHalaman' => 'tabel-petugas'
        ];
        $data = [
            'petugas' => $this->Petugas->getAllPetugas()
        ];
        $this->load->view('template/header',$config);
        $this->load->view('admin/petugas/petugas',$data);
        $this->load->view('template/footer');
    }
    public function tambah(){
        $this->form_validation->set_rules('username','username','required|max_length[6]|is_unique[tblpetugas.username]');
        $this->form_validation->set_rules('nama','nama','required');
        $this->form_validation->set_rules('pasword','pasword','required');
        $this->form_validation->set_rules('email','email','required|valid_email|is_unique[tblpetugas.email]');

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $this->Petugas->tambah();
            $this->session->set_flashdata('petugas_aktivasi','data berhasil ditambahkan');
            $this->index();
        }
    }
  
    public function get_aktivasi($id)
    {
        $this->Petugas->aktifkan_akun($id);
        $this->session->set_flashdata('petugas_aktivasi','data berhasil diaktivasi');
        redirect('petugas');
    }
    public function get_blokir($id)
    {
        $this->Petugas->nonaktifkan_akun($id);
        $this->session->set_flashdata('petugas_aktivasi','data berhasil dinonaktifkan');
        redirect('petugas');
    }
    public function hapus($id)
    {
        $this->Petugas->hapus($id);
        $this->session->set_flashdata('petugas_aktivasi','data berhasil hapus');
        redirect('petugas');
    }
    public function update()
    {
        $this->Petugas->update();
        $this->session->set_flashdata('petugas_aktivasi','data berhasil hapus');
        redirect('petugas');
    }
}