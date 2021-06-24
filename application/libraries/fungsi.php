<?php

class fungsi {

    function ready(){
        echo "test fungsi";
    }

    function format_tgl($i){
        return date("d-m-Y",strtotime($i));
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
}



