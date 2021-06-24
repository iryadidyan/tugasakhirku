<?php 

class Rekap extends CI_model {

    public function get_rekap()
    {
        $this->db->order_by("id_rekap", "desc");
        return $this->db->get('tblrekap')->result();
    }
    public function insert($p,$k,$d,$s,$n){

        $data = [
            "periode" => $p, 
            "kredit" => $k, 
            "debit" => $d,
            "sisa" => $s,
            "nama_petugas" => $n,
        ];
        $simpan = $this->db->insert('tblrekap', $data);
    }

    public function aktivasi($id)
    {
        $data = [
            'validasi' => 1
        ];
        return $this->db->where('id_rekap', $id)->update('tblrekap', $data);
    }
    public function blokir($id)
    {
        $data = [
            'validasi' => 0
        ];
        return $this->db->where('id_rekap', $id)->update('tblrekap', $data);
    }
}