<?php

class NasabahController extends CI_controller {
    public function __construct()
    {
        
        parent::__construct();
        $this->load->database();
        $this->load->model('Nasabah');
        $this->load->model('Transaksi');
        $this->load->library('form_validation');
        if ($this->session->userdata('status') == '') {
            redirect('/');
        }
    }

    public function add()
    {
        $data = [
            'judul' => 'Tambah Nasabah',
            'judulHalaman' => 'form-nasabah', 
        ];

        $this->load->view('template/header',$data);
        $this->load->view('admin/data/add_nasabah',$data);
        $this->load->view('template/footer');
    }

    public function index()
    {
        $data = [
            'judul' => 'Data Nasabah',
            'judulHalaman' => 'tabel-nasabah', 
            'nasabah' => $this->Nasabah->getAllNasabah()
        ];

        $this->load->view('template/header',$data);
        $this->load->view('admin/data/nasabah',$data);
        $this->load->view('template/footer');
    }

    public function simpan()
    {
        $this->form_validation->set_rules('no_nik', 'NIK', 'required|is_unique[tblanggota.no_nik]');
        $this->form_validation->set_rules('tgl_gabung', '', 'required');
        $this->form_validation->set_rules('no_rekening', 'no rekening', 'required|is_unique[tblanggota.no_rekening]');
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('tmp_lahir', 'tempat lahir', 'required');
        $this->form_validation->set_rules('tgllahir', 'tanggal lahir', 'required');
        $this->form_validation->set_rules('j_kel', '', 'required');
        $this->form_validation->set_rules('ibu_kandung', 'ibu kandung', 'required');
        $this->form_validation->set_rules('agama', 'agama', 'required');
        $this->form_validation->set_rules('Email', 'email', 'trim|required|valid_email|is_unique[tblanggota.email]');
        $this->form_validation->set_rules('no_hp', 'no telepon', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('pekerjaan', '', 'required');


        if ($this->form_validation->run() == FALSE)
        {
            $this->add();
        } else {
            $this->Nasabah->simpan();
            $this->session->set_flashdata('sukses','data berhasil ditambahkan');
            redirect('nasabah/tambah');
        }
    }

    public function get_aktivasi($id)
    {
        $this->Nasabah->aktivasi($id);
        $this->session->set_flashdata('aktivasi','data berhasil diaktivasi');
        redirect('nasabah');

    }
    public function get_blokir($id)
    {
        $this->Nasabah->blokir($id);
        $this->session->set_flashdata('aktivasi','data berhasil dinonaktifkan');
        redirect('nasabah');
    }
    public function get_tabungan($id)
    {
        $data['detail'] = $this->Transaksi->get_detail($id);
        $this->load->view('admin/pdf/b_tabungan',$data);
    }
    public function profile($id)
    {
        $config = [
            'judul' => $id.' Profile nasabah',
            'judulHalaman' => 'profile',
        ];
        $data = [
            'profile' => $this->Nasabah->data_nasabah($id)
        ];
        $this->load->view('template/header',$config);
        $this->load->view('admin/profile/nasabah/profile',$data);
        $this->load->view('template/footer');
    }
}