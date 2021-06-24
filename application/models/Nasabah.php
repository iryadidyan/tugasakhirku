<?php

class Nasabah extends CI_model 
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function jumlah()
    {
        return $this->db->count_all_results('tblanggota');
    }

    public function getAllNasabah()
    {
        return $this->db->get('tblanggota')->result();
    }

    public function token($length = 9) 
    {
        $string = "";
        $char = range('0','9');
        $max = count($char) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $string .= $char[$rand];
        }
        return $string;
    }
    public function simpan()
    {
        $data = [
                'no_nik' => $this->input->post('no_nik',true),
                'tgl_gabung' => $this->input->post('tgl_gabung',true),
                'no_rekening' => $this->input->post('no_rekening',true),
                'nama' => $this->input->post('nama',true),
                'tmp_lahir' => $this->input->post('tmp_lahir',true),
                'tgl_lahir' => $this->input->post('tgllahir',true),
                'j_kel' => $this->input->post('j_kel',true),
                'ibu_kandung' => $this->input->post('ibu_kandung',true),
                'agama' => $this->input->post('agama',true),
                'email' => $this->input->post('Email',true),
                'no_hp' => $this->input->post('no_hp',true),
                'alamat' => $this->input->post('alamat',true),
                'pekerjaan' => $this->input->post('pekerjaan',true),
        ];
        $this->db->insert('tblanggota', $data);
    }

    public function progres($jml)
    {
        $hasil  = ($jml/$this->jumlah())*100;
        return ceil($hasil);
    }

    public function aktif_app()
    {
        $data = ['status >' => 0];
        return $this->db->get_where('tblanggota',$data)->num_rows();
    }
    public function nonaktif_app()
    {
        $data = ['status' => 0];
        return $this->db->get_where('tblanggota',$data)->num_rows();
    }
    public function data_nasabah($id)
    {
        return $this->db->select('*')
                        ->get_where('tblanggota','no_rekening ='.$id)
                        ->row_array();
    }

    public function aktivasi($id)
    {
        $data = [
            'kode_pin' => 1234567,
            'pasword' => 1234567,
            'status' => 1
        ];
        return $this->db->where('id_anggota', $id)->update('tblanggota', $data);
    }
    public function blokir($id)
    {
        $data = [
            'kode_pin' => 1234567,
            'pasword' => 1234567,
            'status' => 0
        ];
        return $this->db->where('id_anggota', $id)->update('tblanggota', $data);
    }
    function search_nasabah($title){
        $this->db->like('no_rekening', $title , 'both');
        $this->db->order_by('no_rekening', 'ASC');
        $this->db->limit(10);
        return $this->db->get('tblanggota')->result();
    }

    public function check_rekening($data){
        $row  =  $this->db->get_where("tblanggota","no_rekening =".$data)
                                ->num_rows();
        return  $row;
    }

}