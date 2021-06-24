<?php

class TransaksiController extends CI_controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Akun');
        $this->load->model('Transaksi');
        $this->load->model('Nasabah');
        $this->load->library('form_validation');
        if ($this->session->userdata('status') == '') {
            redirect('/');
        }
    }
    public function get_menabung()
    {
        $config = [
            'tabungan' => $this->Transaksi->get_kredit(),
            'url' => 'menabung/post',
            'jenis' => 'kredit',
            'akun' => $this->Akun->get_Akun_Aktif()
            ];
        $data = [
            'judul' => 'Transaksi menabung',
            'judulHalaman' => 'form-menabung'
        ];
        $this->load->view('template/header',$data);
        $this->load->view('admin/transaksi/form',$config);
        $this->load->view('template/footer');
    }

    public function post_menabung()
    {
        $this->form_validation->set_rules('no_rek','nomor rekening','numeric|required');
        $this->form_validation->set_rules('jumlah','nominal','numeric|required|less_than[2000000]|greater_than[5000]');
       
        if ($this->Nasabah->check_rekening($this->input->post('no_rek'))  > 0) {
            if ($this->form_validation->run() == false) {
                $this->get_menabung();  
            } else {
                $kirim = $this->Transaksi->post($this->input->post('no_rek',true),$this->input->post('jumlah',true),'jumlah_kredit','simpan',$this->input->post('akun',true));
                if ($kirim == 'sukses') {
                    $this->session->set_flashdata('transfer_sukses','transfer ke '.$this->input->post('no_rek',true).' berhasil di inputkan ke database, silahkan cetak bukti transaksi');
                    redirect('transaksi/menabung');  
                } 
            }
        } else {
            $this->session->set_flashdata('transfer_gagal','Nomor rekening '.$this->input->post('no_rek',true).' tidak terdapat pada data nasabah');
            redirect('transaksi/menabung');  
        }
    }
    public function post_tarik_tunai()
    {
        $this->form_validation->set_rules('no_rek','nomor rekening','numeric|required');
        $this->form_validation->set_rules('jumlah','nominal','numeric|required|less_than[2000000]|greater_than[5000]');
       
        if ($this->Nasabah->check_rekening($this->input->post('no_rek'))  > 0) {
            if ($this->form_validation->run() == false) {
                $this->get_tarik();  
            } else {
                $saldo = $this->Transaksi->cek_saldo($this->input->post('no_rek'));
                if ($saldo->sisa_saldo > $this->input->post('jumlah',true)+5000) {
                    $kirim = $this->Transaksi->post($this->input->post('no_rek',true),$this->input->post('jumlah',true),'jumlah_debit','TARIK_TUNAI',$this->input->post('akun',true));
                    if ($kirim == 'sukses') {
                        
                        $this->session->set_flashdata('transfer_sukses','Penarikan dari rekening '.$this->input->post('no_rek',true).' berhasil berhasil, silahkan cetak bukti transaksi');
                        redirect('transaksi/tarik');  
                    } 
                } else {
                    $this->session->set_flashdata('transfer_gagal','Nomor rekening '.$this->input->post('no_rek',true).' tidak memiliki cukup saldo untuk didebet');
                    redirect('transaksi/tarik');  
                }
            }
            
        } else {
            $this->session->set_flashdata('transfer_gagal','Nomor rekening '.$this->input->post('no_rek',true).' tidak terdapat pada data nasabah');
            redirect('transaksi/tarik');  
        }
    }
        
    public function get_tarik()
    {
        $data = [
            'tabungan' => $this->Transaksi->get_debit(),
            'url' => 'tarik_tunai/post',
            'jenis' => 'debit',
            'akun' => $this->Akun->get_Akun_Aktif()
            ];
        $config = [
            'judul' => 'Transaksi tarik tunai',
            'judulHalaman' => 'form-tarik-tunai'
        ];
        $this->load->view('template/header',$config);
        $this->load->view('admin/transaksi/form',$data);
        $this->load->view('template/footer');
    }
    public function cetak($k,$s)
    {
        $data = [
            'sdata' => $this->Nasabah->data_nasabah($s),
            'data' => $this->Transaksi->bukti_transaksi($k),
        ];
        $this->load->view('admin/pdf/print',$data);
    }

    public function data(){
        $config = [
            'judul' => 'Data transaksi',
            'judulHalaman' => 'tabel-transaksi', 
            'transaksi' => $this->Transaksi->getAllTransaksi()
        ];

        $this->load->view('template/header',$config);
        $this->load->view('admin/data/transaksi',$config);
        $this->load->view('template/footer');
    }
}