<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'AuthController';
$route['login'] = 'AuthController/login';
$route['logout'] = 'AuthController/logout';

$route['home'] = 'welcome/utama';
$route['adminlte'] = 'welcome/adminlte';

$route['profile'] = 'ProfileController';
$route['profile/update_petugas'] = 'ProfileController/update_petugas';

$route['nasabah'] = 'NasabahController';
$route['nasabah/tambah'] = 'NasabahController/add';
$route['nasabah/post'] = 'NasabahController/simpan';
$route['nasabah/profile/(:num)'] = 'NasabahController/profile/$1';
$route['nasabah/aktivasi/(:num)'] = 'NasabahController/get_aktivasi/$1';
$route['nasabah/blokir/(:num)'] = 'NasabahController/get_blokir/$1';
$route['nasabah/tabungan/(:num)'] = 'NasabahController/get_tabungan/$1';


$route['transaksi/menabung'] = 'TransaksiController/get_menabung';

$route['transaksi/menabung/post'] = 'TransaksiController/post_menabung';
$route['transaksi/tarik_tunai/post'] = 'TransaksiController/post_tarik_tunai';

$route['transaksi/data'] = 'TransaksiController/data';
$route['transaksi/cetak/(:num)/(:num)'] = 'TransaksiController/cetak/$1/$2';
$route['transaksi/tarik'] = 'TransaksiController/get_tarik';

$route['petugas'] = 'PetugasController';
$route['petugas/tambah'] = 'PetugasController/tambah';
$route['petugas/aktivasi/(:num)'] = 'PetugasController/get_aktivasi/$1';
$route['petugas/blokir/(:num)'] = 'PetugasController/get_blokir/$1';
$route['petugas/hapus/(:num)'] = 'PetugasController/hapus/$1';

$route['akun'] = 'AkunController';
$route['akun/tambah'] = 'AkunController/tambah';
$route['akun/aktivasi/(:num)'] = 'AkunController/get_aktivasi/$1';
$route['akun/blokir/(:num)'] = 'AkunController/get_blokir/$1';
$route['akun/hapus/(:num)'] = 'AkunController/hapus/$1';


$route['laporan/keuangan'] = 'LaporanController';

$route['validasi_laporan'] = 'LaporanController/validasi';
$route['validasi/aktivasi/(:num)'] = 'LaporanController/get_aktivasi/$1';
$route['validasi/nonaktivasi/(:num)'] = 'LaporanController/get_blokir/$1';

$route['Auto/(:num)'] = 'AutoController/get_autocomplete/$1';

$route['404_override'] = 'welcome/errors';
$route['translate_uri_dashes'] = FALSE;
