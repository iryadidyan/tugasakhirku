<?php 

class Transaksi extends CI_model
{
    public function jumlah()
    {
        return $this->db->count_all_results('tblsimpanan');
    }

    public function getAllTransaksi()
    {
        return $this->db->get('tblsimpanan')->result();
    }

    public function total_transaksi()
    {
        return $this->db->query("SELECT (SUM(jumlah_kredit) - SUM(jumlah_debit)) AS sisa_saldo FROM tblsimpanan")->result();
    }

    public function total_kredit()
    {
        return $this->db->query("SELECT SUM(jumlah_kredit) AS total_kredit FROM tblsimpanan")->result();
    }

    public function total_debit()
    {
        return $this->db->query("SELECT SUM(jumlah_debit) AS total_debit FROM tblsimpanan")->result();
    }

    public function total_tr_kredit()
    {
        return $this->db->select('*')
            ->from('tblsimpanan')
            ->where("jumlah_kredit >",0)
            ->get();
    }

    public function total_tr_debit()
    {        
        return $this->db->select('*')
            ->from('tblsimpanan')
            ->where("jumlah_debit >",0)
            ->get();
    }
    public function jenis_transaksi()
    {
        return $this->db->select('jenis_transaksi')
                        ->distinct()
                        ->get('tblsimpanan')->result();
    }

    public function progres($n)
    {
        $data   = ['jenis_transaksi' => $n];
        $jml    = $this->db->get_where('tblsimpanan',$data)->num_rows();
        $hasil  = ($jml/$this->jumlah())*100;
        return ceil($hasil);
    }
    public function jml_transaksi($n)
    {
        $data   = ['jenis_transaksi' => $n];
        $jml    = $this->db->get_where('tblsimpanan',$data)->num_rows();
        return ceil($jml);
    }
    public function get_detail($id)
    {
        return $this->db->select('jumlah_debit,jumlah_kredit,tanggal_simpan, (jumlah_kredit-jumlah_debit) AS sisa_saldo')
            ->from('tblsimpanan')
            ->where('no_rekening',$id)
            ->get()->result_array();
    }
    public function get_data($start = null,$end = null)
    {
        return $this->db->select('jumlah_debit,jumlah_kredit,tanggal_simpan, (jumlah_kredit-jumlah_debit) AS sisa_saldo,(jumlah_kredit+jumlah_debit) AS jumlah')
            ->from('tblsimpanan')
            ->where('tanggal_simpan >=',$start)
            ->where('tanggal_simpan <=',$end)
            ->get();
    }

    public function bukti_transaksi($id)
    {
        return $this->db->select('no_rekening,jenis_transaksi,jumlah_debit,jumlah_kredit,tanggal_simpan, (jumlah_kredit+jumlah_debit) AS jumlah')
            ->get_where('tblsimpanan','kode_transaksi ='.$id)
            ->row_array();
      
    }
    public function get_kredit()
    {
        return $this->db->select('*')
            ->from('tblsimpanan')
            ->where('tanggal_simpan',date('Y-m-d'))
            ->where('jenis_transaksi','simpan')
            ->order_by('id_simpanan', 'DESC')
            ->get()->result();
    }
    public function get_debit()
    {
        return $this->db->select('*')
            ->from('tblsimpanan')
            ->where('tanggal_simpan',date('Y-m-d'))
            ->where('jenis_transaksi','TARIK_TUNAI')
            ->order_by('id_simpanan', 'DESC')
            ->get()->result();
    }

    public function post($id,$jumlah,$field,$jenis,$akun)
    {
        $string = date('d-m-Y H:i:s').$id;
        $data = [
            'jenis_transaksi' => $jenis, 
            'kode_transaksi'=> preg_replace('/\D/', '', $string), 
            'no_rekening' => $id, 
            'no_rekening_pengirim' => 0, 
            'id_akun' => $akun, 
            $field => $jumlah, 
            'tanggal_simpan' => date('Y-m-d')
        ];
        $this->db->insert('tblsimpanan', $data);
        return $sukses = 'sukses';
    }

    
    public function cek_saldo($data)
    {
        $this->db->select('(SUM(jumlah_kredit) - SUM(jumlah_debit)) AS sisa_saldo');
        return $this->db->get_where('tblsimpanan','no_rekening = '.$data)->row();
    }


    
}
