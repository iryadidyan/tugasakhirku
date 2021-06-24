<?php 

class LaporanController extends CI_controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaksi');
        $this->load->model('Laporan');
        $this->load->model('Rekap');
        $this->load->library('form_validation');
        if ($this->session->userdata('status') == '') {
            redirect('/');
        }
    }

    public function validasi(){
        $rekap = $this->Rekap->get_rekap();
        $data = [
            'rekap' => $rekap
        ];
        $config = [
            'judul' => 'Laporan Keuangan',
            'judulHalaman' => 'laporan-keuangan'
        ];
        
        $this->load->view('template/header',$config);
        $this->load->view('admin/laporan/validasi_laporan_keuangan',$data);
        $this->load->view('template/footer');
    }
    public function index(){
        $rekap = $this->Rekap->get_rekap();
        $data = [
            'rekap' => $rekap
        ];
        $config = [
            'judul' => 'Laporan Keuangan',
            'judulHalaman' => 'laporan-keuangan'
        ];
        
        $this->load->view('template/header',$config);
        $this->load->view('admin/laporan/laporan_keuangan',$data);
        $this->load->view('template/footer');
    }

    public function get_data(){
        $start  = $_GET['start'];
        $end    = $_GET['end'];

        $query = $this->Laporan->periode($start,$end);
        foreach ($query as $key) {

            $data[] = [
                'tanggal' => $key->tanggal_simpan,
                'debit' => $key->jumlah_debit,
                'kredit' => $key->jumlah_kredit,
            ];
        }

        $result = array(
            "draw" => $_POST['draw'],
              "recordsTotal" => $query->num_rows(),
              "recordsFiltered" => $query->num_rows(),
              "data" => $data
         );
        echo json_encode($result);
        exit();
    }

    public function print(){

        $start  = $_POST['awal'];
        $end    = $_POST['akhir'];
        $query = $this->Laporan->periode($start,$end);
        $jenis = $this->Laporan->distinct($start,$end);
        $saldo = $this->Laporan->total_saldo($start,$end);
        $i= 1;

        if ($jenis != null) {
            foreach ($jenis as $k) {
                $row[$i] = [
                       "transaksi" => $k->jenis_transaksi,
                       "ket"       => $this->Laporan->jenis($start,$end,$k->jenis_transaksi)
                   ];
                $i++;
           }
        } else {
            $row[1] = 0;
            $this->session->set_flashdata('flashdata_error','Data pada periode ini tidak ditemukan');
        }

        $detail = $row;
        $config = [
            'judul' => 'Cetak laporan',
            'judulHalaman' => 'cetak-laporan-keuangan'
        ];
        
        $data = [
            "periode" => $start." - ".$end,
            "data"    => $query,
            "sisa"    => $saldo,
            "detail"  => $detail
        ];

        $this->load->view('template/header',$config);
        $this->load->view('admin/laporan/print',$data);
        $this->load->view('template/footer');
    }

    public function save(){
        $p = $this->input->post('periode'); 
        $k = $this->input->post('kredit',true);
        $d = $this->input->post('debit',true);
        $s = $this->input->post('sisa',true);
        $n = $this->input->post('nama_petugas',true);
        
        $this->form_validation->set_rules('periode','periode','required|is_unique[tblrekap.periode]');

        if ($this->form_validation->run()  == FALSE) {
            $this->session->set_flashdata('rekap_error','laporan gagal disimpan');
            redirect('laporan/keuangan');
        } else {
            $this->Rekap->insert($p,$k,$d,$s,$n);
            $this->session->set_flashdata('rekap','laporan telah disimpan');
            redirect('laporan/keuangan');
        }
    }

    public function get_aktivasi($id)
    {
        $this->Rekap->aktivasi($id);
        $this->session->set_flashdata('flashdata_validasi','data berhasil di validasi');
        redirect('validasi_laporan');
    }
    public function get_blokir($id)
    {
        $this->Rekap->blokir($id);
        $this->session->set_flashdata('flashdata_validasi','data berhasil dinonaktifkan');
        redirect('validasi_laporan');
    }



}