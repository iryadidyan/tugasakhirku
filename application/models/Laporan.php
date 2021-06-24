<?php 

class Laporan extends CI_model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function distinct($awal,$akhir){
        return $this->db->distinct()
                    ->select('jenis_transaksi')
                    ->where("tanggal_simpan BETWEEN '{$awal}' AND '{$akhir}'")
                    ->get('tblsimpanan')
                    ->result();
    }

    public function periode($awal,$akhir){
        return $this->db
                    ->select("*")
                    ->where("tanggal_simpan BETWEEN '{$awal}' AND '{$akhir}'")
                    ->get("tblsimpanan")
                    ->result();
    }
    public function jenis($awal,$akhir,$jt){
        return $this->db
                    ->select("*")
                    ->where("tanggal_simpan BETWEEN '{$awal}' AND '{$akhir}'")
                    ->where("jenis_transaksi",$jt)
                    ->get("tblsimpanan")
                    ->result();
    }
    public function total_saldo($awal,$akhir){
        return $this->db
                    ->select("id_akun,SUM(jumlah_kredit) as t_kredit,SUM(jumlah_debit) as t_debit,(SUM(jumlah_kredit)-SUM(jumlah_debit)) as sisa_saldo")
                    ->where("tanggal_simpan BETWEEN '{$awal}' AND '{$akhir}'")
                    ->get("tblsimpanan")
                    ->result();
    }
}