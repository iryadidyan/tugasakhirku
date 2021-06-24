<?php 
class ProfileController extends CI_controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Petugas');
        if ($this->session->userdata('status') == '') {
            # code...
            redirect('/');
        }
    }

    public function index()
    {
        $data = [
            'judul' => 'pengaturan',
            'judulHalaman' => 'profile'
        ];
        $this->load->view('template/header',$data);
        $this->load->view('admin/profile/admin/profile');
        $this->load->view('template/footer');
    }
    public function update_petugas()
    {
        $config['upload_path']          = './img';
        $config['allowed_types']        = 'jpg|png|jpeg';

        $this->load->library('upload', $config);
        $this->form_validation->set_rules('nama','nama','required');
        $this->form_validation->set_rules('email','email','valid_email|required');

        if ($this->form_validation->run() == false) {
             redirect('profile');           
        } else {
            
            $this->upload->do_upload('foto');

                $id = $this->session->userdata('id');
                $img = $this->upload->data();

                $data = [
                    "nama_petugas" => $this->input->post('nama',true),
                    "email" => $this->input->post('email'),
                    "gambar" => $img['file_name'],
                ];

                $update = [
                    "id" => $id,
                    "status" => $this->session->userdata('status'),
                    "nama"   => $this->input->post('nama',true),  
                    "username"   => $this->session->userdata('username'),   
                    "email"   => $this->input->post('email'),   
                    "gambar"   => $img['file_name'],   
                    "tanggal"   => $this->session->userdata('tanggal'),   
                ];
    
                // echo var_dump($data);
                $this->Petugas->edit($id,$data);
                $this->session->set_userdata($update);
                $this->session->set_flashdata('update_profil','data berhasil diubah');
                $this->index();
        }
    }
}