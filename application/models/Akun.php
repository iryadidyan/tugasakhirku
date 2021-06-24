<?php

class Akun extends CI_model {
    public function get_Akun()
    {
        return $this->db
                ->select('*')
                ->get('tblakun')
                ->result();
    }
    public function get_Akun_Aktif()
    {
        return $this->db
                ->select('*')
                ->where('status',1)
                ->get('tblakun')
                ->result();
    }

    public function tambah()
    {
        $data = [
            'id_akun' => $this->input->post('id_akun',true),
            'nama_akun' => $this->input->post('nama_akun',true),
        ];
        $this->db->insert('tblakun',$data);
    }

    
    public function edit($id,$data){
        $this->db->set($data);
        $this->db->where('id_akun',$id);
        $this->db->update('tblakun'); 
    }

    public function aktifkan_akun($id)
    {
        $data = array('status' => 1);
        return $this->db->where('id_akun', $id)->update('tblakun', $data);
    }
    public function nonaktifkan_akun($id)
    {
        $data = array('status' => 0);
        return $this->db->where('id_akun', $id)->update('tblakun', $data);
    }
    public function hapus($id)
    {
        return $this->db->where('id_akun', $id)->delete('tblakun');
    }

}