<?php

date_default_timezone_set("Asia/Jakarta");

function format_tgl($i){
    return date("d-m-Y",strtotime($i));
}

function no_rekening($id){
    $query = mysql_query("SELECT * FROM tblanggota WHERE id_anggota = '$id'");
    $xhasil = mysql_fetch_assoc($query);
    echo $xhasil['no_rekening'];
}

function nama($id){
    $query = mysql_query("SELECT * FROM tblanggota WHERE id_anggota = '$id'");
    $xhasil = mysql_fetch_assoc($query);
    echo $xhasil['nama'];
}
    
function alamat($id){
    $query = mysql_query("SELECT * FROM tblanggota WHERE id_anggota = '$id'");
    $xhasil = mysql_fetch_assoc($query);
    echo $xhasil['alamat'];
}

function tgl_lahir($id){
    $query = mysql_query("SELECT * FROM tblanggota WHERE id_anggota = '$id'");
    $xhasil = mysql_fetch_assoc($query);
    echo $xhasil['tgl_lahir'];
}

function tmp_lahir($id){
    $query = mysql_query("SELECT * FROM tblanggota WHERE id_anggota = '$id'");
    $xhasil = mysql_fetch_assoc($query);
    echo $xhasil['tmp_lahir'];
}

function pekerjaan($id){
    $query = mysql_query("SELECT * FROM tblanggota WHERE id_anggota = '$id'");
    $xhasil = mysql_fetch_assoc($query);
    echo $xhasil['pekerjaan'];
}

function j_kel($id){
    $query = mysql_query("SELECT * FROM tblanggota WHERE id_anggota = '$id'");
    $xhasil = mysql_fetch_assoc($query);
    echo $xhasil['j_kel'];
}

function jurusan($id){
    $query = mysql_query("SELECT * FROM tblanggota WHERE id_anggota = '$id'");
    $xhasil = mysql_fetch_assoc($query);
    echo $xhasil['jurusan'];
}

function no_hp($id){
    $query = mysql_query("SELECT * FROM tblanggota WHERE id_anggota = '$id'");
    $xhasil = mysql_fetch_assoc($query);
    echo $xhasil['no_hp'];
}

date_default_timezone_set("Asia/Jakarta");

function sanitizeThis($string) {
    $output1 = mysql_real_escape_string($string);
    $output2 = strip_tags($output1);
    return htmlspecialchars($output2); 
}

function token($length = 9) {
	$string = "";
	$char = range('0','9');
	$max = count($char) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$string .= $char[$rand];
	}
	return $string;
}

function pin($length = 7) {
	$string = "";
	$char = range('0','9');
	$max = count($char) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$string .= $char[$rand];
	}
	return $string;
}

function input_form_anggota($no_nik,$no_rekening,$nama,$alamat,$tgl_lahir,$tmp_lahir,$pekerjaan,$j_kel,$jurusan,$no_hp,$tgl_gabung,$ibu_kandung,$agama){
    $kode_pin   = pin();
    $query      = mysql_query("INSERT INTO tblanggota(no_nik,no_rekening,nama,alamat,tgl_lahir,tmp_lahir,pekerjaan,j_kel,jurusan,no_hp,tgl_gabung,ibu_kandung,agama,kode_pin) VALUES ('$no_nik','$no_rekening','$nama','$alamat','$tgl_lahir','$tmp_lahir','$pekerjaan','$j_kel','$jurusan','$no_hp','$tgl_gabung','$ibu_kandung','$agama','$kode_pin')");
}

function menabung($jenis_transaksi,$kode_transaksi,$no_rekening,$no_rekening_pengirim,$jumlah_kredit,$tanggal_simpan){
    $query = mysql_query("INSERT INTO tblsimpanan(jenis_transaksi,kode_transaksi,no_rekening,no_rekening_pengirim,jumlah_kredit,tanggal_simpan) VALUES ('$jenis_transaksi','$kode_transaksi','$no_rekening','$no_rekening_pengirim','$jumlah_kredit','$tanggal_simpan')");

}

function tarik_tunai($jenis_transaksi,$kode_transaksi,$no_rekening,$no_rekening_pengirim,$jumlah_debit,$tanggal_simpan){
    $query = mysql_query("INSERT INTO tblsimpanan(jenis_transaksi,kode_transaksi,no_rekening,no_rekening_pengirim,jumlah_debit,tanggal_simpan) VALUES ('$jenis_transaksi','$kode_transaksi','$no_rekening','$no_rekening_pengirim',$jumlah_debit,'$tanggal_simpan')");
}

function update_data_anggota($id_anggota,$nama,$alamat,$tgl_lahir,$tmp_lahir,$pekerjaan,$j_kel,$jurusan,$no_hp){
    $query = mysql_query("UPDATE tblanggota SET nama = '$nama',alamat = '$alamat',tgl_lahir = '$tgl_lahir',tmp_lahir = '$tmp_lahir',pekerjaan = '$pekerjaan',j_kel = '$j_kel',jurusan = '$jurusan',no_hp = '$no_hp' WHERE id_anggota = '$id_anggota'");
}

function data_nasabah($r){
    $query    = mysql_query("SELECT * FROM tblanggota WHERE no_rekening = '$r'");
    $row      = mysql_fetch_array($query);
    return $row['nama'];
}


function semua_data_nasabah($r){
    $query    = mysql_query("SELECT * FROM tblanggota WHERE no_rekening = '$r'");
    return $row = mysql_fetch_array($query);
}


function data_jumlah_nasabah(){
    $query    = mysql_query("SELECT * FROM tblanggota");
    $row      = mysql_num_rows($query);
    echo $row;
}

function jumlah_transaksi_hari_ini($tgl_ini){
    $query    = mysql_query("SELECT * FROM tblsimpanan WHERE tanggal_simpan = '$tgl_ini'");
    $row      = mysql_num_rows($query);
    echo $row;
}

function data_jumlah_pegawai(){
    $query    = mysql_query("SELECT * FROM tblpetugas");
    $row      = mysql_num_rows($query);
    echo $row;
}

function jumlah_pemasukan_hari_ini($tanggal_simpan){
    $query    = mysql_query("SELECT (SUM(jumlah_kredit) - SUM(jumlah_debit)) AS sisa_saldo FROM tblsimpanan WHERE tanggal_simpan = '$tanggal_simpan'");
    $row      = mysql_fetch_array($query);
    $sisa_saldo = $row['sisa_saldo'];
    echo "Rp ".number_format ($sisa_saldo, 2, ',', '.');
}

function total_deposito(){
    $query    = mysql_query("SELECT (SUM(jumlah_kredit) - SUM(jumlah_debit)) AS sisa_saldo FROM tblsimpanan");
    $col      = mysql_fetch_array($query);
    echo "Rp ".number_format ($col['sisa_saldo'], 2, ',', '.');
}

function sms_selamat($nama,$nohp){
    $modem = 'bank';
    $pesan = 'Selamat '.$nama.' nomor anda sudah terdaftar di Bank MINI SMK MAARIF NU TIRTO. unduh aplikasi android dan nikmati fasilitas kemudahan dalam bertransaksi';
    $query = "INSERT INTO outbox (DestinationNumber, SenderID, TextDecoded, CreatorID) VALUES ('$nohp', '$modem', '$pesan', 'Gammu 1.28.90')";
    $hasil = mysql_query($query);
}

function sms_nabung($rekening,$nominal){
    $modem = 'bank';
    $pesan = 'TRANSFER dari No. '.$rekening.' sebesar '.$nominal;
    $query = "INSERT INTO outbox (DestinationNumber, SenderID, TextDecoded, CreatorID) VALUES ('$nohp', '$modem', '$pesan', 'Gammu 1.28.90')";
    $hasil = mysql_query($query);
}

function hari_ini(){
    $tahun = date("Y");
    $bulan = date("m");
    $tanggal = date("d");
    if($bulan<12){
        if($bulan>6&&$tanggal>25){
        $tahun=$tahun;}
        else {
        $tahun=$tahun-1;}
    }
    return $hari_ini = $tanggal.'-'.$bulan.'-'.$tahun;
}

function notifikasi($notif){
    if ($notif == 'SUKSES') {
        echo "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
             TRANSAKSI PENARIKAN ".$notif."</div>";
    } elseif ($notif == 'GAGAL') {
        echo "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
             TRANSAKSI PENARIKAN ".$notif."</div>";
    } elseif ($notif != 'GAGAL' || $notif != 'GAGAL' ){
        echo "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              MOHON UNTUK MENCETAK BUKTI SETOR ".$notif."</div>"; }

}

function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
        $temp = penyebut($nilai - 10). " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
}

function terbilang($nilai) {
    if($nilai<0) {
        $hasil = "minus ". trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }     		
    return $hasil;
}

?>
    
