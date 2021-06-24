<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Headers: Content-Type, Authorisation, X-Requested-with' );

$mysqli = mysqli_connect('localhost', 'root', '', 'tabunganku');
date_default_timezone_set('Asia/Jakarta');

function format_tgl($i){
    return date("d-m-Y",strtotime($i));
}

// 200 OK
// 201 Request Berhasil dibuat
// 202 Request berhasil diterima
// 204 Tanpa Konten
// 205 Reset Content
// 302 Ditemukan
// 400 Permintaan Tak Layak
// 401 Unauthorized
// 402 Payment Required
// 403 Terlarang
// 404 Tidak Ditemukan
// 405 Method Not Allowed

if (isset($_GET['api'])) {
    $api   = $_GET['api'];
    
    if ($api == "nasabah") {

        $email    = $_GET['email'];
        $pass     = $_GET['pass'];
        $query    = mysqli_query($mysqli,"SELECT * FROM tblnasabah WHERE email = '$email' and pasword = '$pass'");
        $jml      = mysqli_num_rows($query);
        
        if ($jml > 0) {
            $data = mysqli_fetch_array($query,MYSQLI_ASSOC);

            if($data['status'] > 0){
                $data_anggota = array(
                    'kode'          => 302,
                    'status'        => 'aktif',
                    'id_anggota'    => $data['id_anggota'], 
                    'no_rekening'   => $data['no_rekening'], 
                    'pasword'       => $data['pasword'], 
                    'nama'          => $data['nama'], 
                    'alamat'        => $data['alamat'], 
                    'tgl_lahir'     => $data['tgl_lahir'], 
                    'tmp_lahir'     => $data['tmp_lahir'], 
                    'pekerjaan'     => $data['pekerjaan'], 
                    'j_kel'         => $data['j_kel'], 
                    'jurusan'       => $data['jurusan'], 
                    'no_hp'         => $data['no_hp'], 
                    'kode_pin'      => $data['kode_pin']
                );
                echo json_encode($data_anggota);
            } else {
                $data_anggota = array(
                    'kode'    => 400,
                    'status'  => 'Mobile Apps tidak aktif',
                );
                echo json_encode($data_anggota);
            }
        } else {
            $data_anggota = array(
                'kode'    => 404,
                'status'  => 'tidak daftar',
                'hasil pencarian' => $jml
            );
            echo json_encode($data_anggota);
        }


    } elseif ($api == "transfer") {

        $string1 = date('d-m-Y H:i:s').$_POST['no_rekening']."11";
        $string2 = date('d-m-Y H:i:s').$_POST['no_rekening']."22";

        $kode_transaksi1 = preg_replace('/\D/', '', $string1);
        $kode_transaksi2 = preg_replace('/\D/', '', $string2);

        $tanggal_simpan = date('Y-m-d');

        $no_rekening_pengirim = $_GET['no_rekening'];
        $no_rekening_tujuan = $_GET['rekening_tujun'];
        $jumlah_tf = $_GET['jml_tf'];

        $cek = mysqli_query($mysqli,"SELECT * FROM tblnasabah WHERE no_rekening = '$no_rekening_tujuan'");
        $jml = mysqli_num_rows($cek);

        if($jml>0){

            $st_sql = mysqli_query($mysqli,"SELECT (SUM(jumlah_kredit) - SUM(jumlah_debit)) AS sisa_saldo FROM tbltabungan WHERE no_rekening = '$no_rekening_pengirim' AND id_akun = '2101'");
            
            $sisa_saldo = 0;
            while ($data = mysqli_fetch_array($st_sql,MYSQLI_ASSOC)) {
                $sisa_saldo += $data['sisa_saldo'];
            }
            
            $hasil = mysqli_fetch_array(MYSQLI_ASSOC,$st_sql);
            $sisa_kredit = $sisa_saldo + 7000;

            if ( $sisa_kredit > $jumlah_tf ) {

                
            //menambah saldo tabungan umum ke rekening lain
                $query1 = mysqli_query($mysqli,"INSERT INTO tbltabungan(jenis_transaksi,id_akun,kode_transaksi,no_rekening,no_rekening_pengirim,jumlah_kredit,tanggal_simpan) VALUES ('TRANS_MASUK','2101','$kode_transaksi1','$no_rekening_tujuan','$no_rekening_pengirim','$jumlah_tf','$tanggal_simpan')");
            //mengurangi saldo tabungan umum pemilik/ mentransfer uang ke rekeneing lain
                $query2 = mysqli_query($mysqli,"INSERT INTO tbltabungan(jenis_transaksi,id_akun,kode_transaksi,no_rekening,no_rekening_pengirim,jumlah_debit,tanggal_simpan) VALUES ('TRANS_KELUAR','2101','$kode_transaksi2','$no_rekening_pengirim','$no_rekening_tujuan','$jumlah_tf','$tanggal_simpan')");
            //menguranig saldo tabungan umum sebagai biaya transfer dikenakan kepada pengirim
                $query3 = mysqli_query($mysqli,"INSERT INTO tbltabungan(jenis_transaksi,id_akun,kode_transaksi,no_rekening,no_rekening_pengirim,jumlah_debit,tanggal_simpan) VALUES ('TRANS_KELUAR','4102','$kode_transaksi2','$no_rekening_pengirim','ADM-TF','2000','$tanggal_simpan')");
            //menambahkan ke kredit pendapatan dari akun 2101 ke akun 4102
                $query4 = mysqli_query($mysqli,"INSERT INTO tblpendapatan(id_akun,keterangan,jumlah_kredit,tanggal_simpan) VALUES ('4102','adm. Tf .$no_rekening_pengirim','2000','$tanggal_simpan')");
                $data = array(
                    "kode"  => 201,
                    "tf_status" => "sukses"
                );
                echo json_encode($data);
            } else {
                # code...
                $data = array(
                    "kode"  => 400,
                    "tf_status" => $sisa_kredit
                );
                echo json_encode($data);
            }
        } else {
            $data = array(
                "kode"  => 404,
                "tf_status" => "gagal"
            );
            echo json_encode($data);
        }

    } elseif ($api == "info") {
        # code...
        $no_rekening    = $_GET['xno_rekening'];
        $query = mysqli_query($mysqli,"SELECT *, (jumlah_kredit - jumlah_debit) as saldo FROM tbltabungan WHERE no_rekening = '$no_rekening' AND id_akun = '2101'");
        $jml = mysqli_num_rows($query);
        $sisa_kredit = 0;

        if($jml>0){
            while ($data = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
                $sisa_kredit += $data['saldo']; 
            }
            $data_anggota = array( 
                "kode" => 201,
                "status" => "ada",
                "sisa_kredit" => "Rp ".number_format ($sisa_kredit , 2, ',', '.')
            );
            echo json_encode($data_anggota);
        } else {
            $data_anggota = array(
                "kode"   => 404,
                "status" => "Tidak ada"
            );
            echo json_encode($data_anggota);
        }
        
    } elseif ($api == "log_transaksi") {
        # code...
        $no_rekening    = $_GET['no_rekening'];
        $TRANS_MASUK    = mysqli_query($mysqli,"SELECT * FROM tbltabungan INNER JOIN tblnasabah ON tbltabungan.no_rekening_pengirim = tblnasabah.no_rekening WHERE tbltabungan.jenis_transaksi = 'TRANS_MASUK' AND tbltabungan.no_rekening = '$no_rekening' ORDER BY tbltabungan.id_simpanan DESC LIMIT 5");
        $TRANS_KELUAR   = mysqli_query($mysqli,"SELECT * FROM tbltabungan INNER JOIN tblnasabah ON tbltabungan.no_rekening_pengirim = tblnasabah.no_rekening WHERE tbltabungan.jenis_transaksi = 'TRANS_KELUAR' AND tbltabungan.no_rekening = '$no_rekening' ORDER BY tbltabungan.id_simpanan DESC LIMIT 5");
        $simpan         = mysqli_query($mysqli,"SELECT * FROM tbltabungan WHERE jenis_transaksi = 'simpan' AND no_rekening = '$no_rekening' ORDER BY id_simpanan DESC LIMIT 5");
        $TARIK_TUNAI    = mysqli_query($mysqli,"SELECT * FROM tbltabungan WHERE jenis_transaksi = 'TARIK_TUNAI' AND no_rekening = '$no_rekening' ORDER BY id_simpanan DESC LIMIT 5");

        while ($TM = mysqli_fetch_array($TRANS_MASUK,MYSQLI_ASSOC)) {
            # code...
            $arr['TRANS_MASUK'][] = array(
                'kode'              => 201,
                'nama_transaksi'     => "Transfer Masuk",
                'tanggal_simpan'      => format_tgl($TM['tanggal_simpan']), 
                'jumlah'              => "Rp ".number_format ($TM['jumlah_kredit'], 2, ',', '.'), 
                'jenis_transaksi'     => $TM['jenis_transaksi'],
                'metode_pihak_ketiga' => "Nama Pengirim : ",
                'pihak_ketiga'        => $TM['no_rekening_pengirim']." an. ".$TM['nama'],
            );
        }
        while ($TK = mysqli_fetch_array($TRANS_KELUAR,MYSQLI_ASSOC)) {
            # code...
            $arr['TRANS_KELUAR'][]  = array(
                'kode'              => 201,
                'nama_transaksi'      => "Transfer Keluar",
                'tanggal_simpan'      => format_tgl($TK['tanggal_simpan']), 
                'jumlah'              => "Rp ".number_format ($TK['jumlah_debit'], 2, ',', '.'), 
                'jenis_transaksi'     => $TK['jenis_transaksi'],
                'metode_pihak_ketiga' => "Nama Penerima : ",
                'pihak_ketiga'        => $TK['no_rekening_pengirim']."/".$TK['nama'],
            );
        }
        while ($TT = mysqli_fetch_array($TARIK_TUNAI,MYSQLI_ASSOC)) {
            # code...
            $arr['TARIK_TUNAI'][] = array(
                'kode'              => 201,
                'nama_transaksi'   => "Tarik tunai",
                'tanggal_simpan'    => format_tgl($TT['tanggal_simpan']), 
                'jumlah'            => "Rp ".number_format ($TT['jumlah_debit'], 2, ',', '.'), 
                'jenis_transaksi'   => $TT['jenis_transaksi'],
                'metode_pihak_ketiga' => "Nama Petugas :",
                'pihak_ketiga'      => 'TELLER',
            );
        }
        while ($SI = mysqli_fetch_array($simpan,MYSQLI_ASSOC)) {
            # code...
            $arr['simpan'][] = array(
                'kode'              => 201,
                'nama_transaksi'    => "Menabung",
                'tanggal_simpan'    => format_tgl($SI['tanggal_simpan']), 
                'jumlah'            => "Rp ".number_format ($SI['jumlah_kredit'], 2, ',', '.'), 
                'jenis_transaksi'   => $SI['jenis_transaksi'],
                'metode_pihak_ketiga' => "Nama Petugas :",
                'pihak_ketiga'      => 'TELLER',
            );
        }
        echo json_encode($arr);
    }
} else {
    # jika tidak terdapat parameter apapun
    $arr = array(
        "kode" => 401,
        "status" => "Unauthorized",
        "Info" => "Api Tugas Akhir | Aplikasi Transaksi Nasabah Bank Mini IQTI Berbasis Android,by Dhiyan Iryadi (MI.15.00311)",
    );
    echo json_encode($arr);
}