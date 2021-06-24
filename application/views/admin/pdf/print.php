<?php
include 'fpdf.php';
include 'fungsi.php';

if ($data['jenis_transaksi'] == "simpan" ) {
    $jenis_transaksi = "BUKTI SETORAN";
} elseif ($data['jenis_transaksi'] == "TARIK_TUNAI" ) {
    $jenis_transaksi = "BUKTI PENARIKAN";
}


$pdf = new FPDF('P','cm','A4');

$pdf->AddPage();
$pdf->SetFont('Arial','',10);

//header ................................../
$pdf->SetFillColor(63,81,179);
$pdf->SetFont('Times','B',14);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(19.1,1, $jenis_transaksi,0,0,'C',true);
$pdf->Ln();
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,0.5,"Tanggal",0,0,'R');
$pdf->SetTextColor(255,255,255);
$pdf->Cell(4.1,0.5,date("d-m-Y",strtotime($data['tanggal_simpan'])),0,0,'C',true);
$pdf->Ln(1);
//header ................................../

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(4.5,0.5,"No. Rekening Tujuan",0,0,'L');
$pdf->Cell(0.5,0.5,":",0,0,'L');
$pdf->Cell(5,0.5,$data['no_rekening'],0,0,'L');

$pdf->Cell(1,0.5,"",0,0,'L');
$pdf->Cell(4,0.5,"TUNAI",1,0,'C');
$pdf->Cell(4,0.5,"JUMLAH (Rp)",1,0,'C');

$pdf->Ln(0.5);
$pdf->Cell(4.5,0.5,"Nama Pemilik Rekening",0,0,'L');
$pdf->Cell(0.5,0.5,":",0,0,'L');
$pdf->Cell(5,0.5,$sdata['nama'],0,0,'L');

$pdf->Cell(1,0.5,"",0,0,'L');
$pdf->Cell(4,0.5,"",1,0,'L');
$pdf->Cell(4,0.5,"",1,0,'L');

$pdf->Ln(0.5);
$pdf->Cell(4.5,0.5,"",0,0,'L');
$pdf->Cell(0.5,0.5,"",0,0,'L');
$pdf->Cell(5,0.5,"",0,0,'L');

$pdf->Cell(1,0.5,"",0,0,'L');
$pdf->Cell(4,0.5,"",1,0,'L');
$pdf->Cell(4,0.5,"",1,0,'L');

$pdf->Ln(0.5);
$pdf->Cell(4.5,0.5,"Nama Penyetor",0,0,'L');
$pdf->Cell(0.5,0.5,":",0,0,'L');
$pdf->Cell(5,0.5,"",0,0,'L');

$pdf->Cell(1,0.5,"",0,0,'L');
$pdf->Cell(4,0.5,"Rp ".number_format ($data['jumlah'], 2, ',', '.'),1,0,'C');
$pdf->Cell(4,0.5,"",1,0,'L');

$pdf->Ln(0.5);
$pdf->Cell(4.5,0.5,"Alamat Penyetor",0,0,'L');
$pdf->Cell(0.5,0.5,":",0,0,'L');
$pdf->Cell(5,0.5,"",0,0,'L');

$pdf->Cell(1,0.5,"",0,0,'L');
$pdf->Cell(4,0.5,"",1,0,'C');
$pdf->Cell(4,0.5,"Rp ".number_format ($data['jumlah'], 2, ',', '.'),1,0,'C');

$pdf->Ln(1);
$pdf->SetFont('Times','I',12);
$pdf->Cell(19,1, "Terbilang : ".terbilang($data['jumlah'], 2, ',', '.')." rupiah",1,0,'C');
$pdf->Ln(1);

$pdf->SetFont('Times','',10);
$pdf->Cell(9,1, "Teller",0,0,'C');
$pdf->Cell(9,1, "Penyetor",0,0,'C');
$pdf->Ln(1.5);

$pdf->Cell(9,1, $this->session->userdata('nama'),0,0,'C');
$pdf->Cell(9,1, ".......................",0,0,'C');
$pdf->Ln(1.5);

$pdf->SetFont('Times','U',10);
$pdf->Cell(19,0, "",1,1,'C');

$pdf->Output();

 ?>
