<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Nasabah');
		$this->load->model('Transaksi');
		if ($this->session->userdata('status') == '') {
				redirect('/');
		}
	}


	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function adminlte()
	{
		$this->load->view('template/adminLTE');
	}

	public function utama()
	{
		$datax['judul'] = "Halaman Admin";
		$datax['judulHalaman'] = "Dashboard";
		$data['jumlah_nasabah'] = $this->Nasabah->jumlah();
		$data['jumlah_transaksi'] = $this->Transaksi->jumlah();
		$data['jumlah_total_pemasukan'] = $this->Transaksi->total_transaksi();
		$data['total_kredit'] = $this->Transaksi->total_kredit();
		$data['total_debit'] = $this->Transaksi->total_debit();

		$data['transaksi'] = $this->Transaksi->jenis_transaksi();

		$data['total_tr_kredit'] = $this->Transaksi->total_tr_kredit()->num_rows();
		$data['total_tr_debit'] = $this->Transaksi->total_tr_debit()->num_rows();


		$this->load->view('template/header',$datax);
		$this->load->view('admin/halaman_utama',$data);
		$this->load->view('template/footer');
	}
	
	public function errors(){
		$datax['judul'] = "Error";
		$datax['judulHalaman'] = "Error";
		$this->load->view('template/header',$datax);
		$this->load->view('auth/erro404');
		$this->load->view('template/footer');
	}
}
