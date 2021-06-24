<?php

class Petugas extends CI_model {

    public function getAllPetugas()
    {
        return $this->db->get('tblpetugas')->result();
    }

    public function cekLogin($username,$password)
    {
        $data = [
            'status' => 1,
            'username' => $username,
            'password' => md5($password)
        ];

        $row        =  $this->db->get_where("tblpetugas",$data)
                                ->num_rows();

        if ($row > 0) {
            $petugas    =  $this->db->get_where('tblpetugas',$data)->row();

            return  $x_data = [
                            'row'   => $row,
                            'id'  => $petugas->id_petugas,
                            'nama'  => $petugas->nama_petugas,
                            'username'  => $petugas->username,
                            'level'  => $petugas->level,
                            'email'  => $petugas->email,
                            'gambar'  => $petugas->gambar,
                            'tanggal'  => $petugas->tanggal_dibuat,
            ];
        } else {
            return $x_data['row']=$row;
        }     
    }

    public function tambah(){
        $data = [
            'username' => $this->input->post('username',true),
            'nama_petugas' => $this->input->post('nama',true),
            'level' => 2,
            'status' => 1,
            'password' => md5($this->input->post('pasword',true)),
            'email' => $this->input->post('email',true),
            'tanggal_dibuat' => date('Y-m-d'),
        ];
        $this->db->insert('tblpetugas',$data);

    }

    public function edit($id,$data){
        $config = [
            "nama_petugas" => $data['nama_petugas'],
            "email" => $data['email'],
            "gambar" => $data['gambar'],
        ];
        $this->db->set($data);
        $this->db->where('id_petugas',$id);
        $this->db->update('tblpetugas'); 
    }

    public function aktifkan_akun($id)
    {
        $data = array('status' => 1);
        return $this->db->where('id_petugas', $id)->update('tblpetugas', $data);
    }
    public function nonaktifkan_akun($id)
    {
        $data = array('status' => 0);
        return $this->db->where('id_petugas', $id)->update('tblpetugas', $data);
    }
    public function hapus($id)
    {
        return $this->db->where('id_petugas', $id)->delete('tblpetugas');
    }

}