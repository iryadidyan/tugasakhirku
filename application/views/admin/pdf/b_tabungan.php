<?php
include 'fpdf.php';

$pdf = new FPDF('P','cm','A4');

$pdf->AddPage();
$pdf->SetFont('Arial','',10);

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(3,0.5,"Tanggal",0,0,'L');
$pdf->Cell(4,0.5,"Debit",0,0,'R');
$pdf->Cell(4,0.5,"Kredit",0,0,'R');
$pdf->Cell(4,0.5,"Sisa Saldo",0,0,'R');
$pdf->Ln(0.5);
$pdf->Cell(20,0,"",1,0,'L');
$pdf->Ln(0.5);
$pdf->SetFont('Arial','',10);
$sisa_saldo = 0;

foreach($detail as $nsb)
{
    $sisa_saldo += $nsb['sisa_saldo'];
    $pdf->Cell(3,0.5,date("d-m-Y",strtotime($nsb['tanggal_simpan'])),0,0,'L');
    $pdf->Cell(4,0.5,"Rp ".number_format ($nsb['jumlah_debit'], 2, ',', '.'),0,0,'R');
    $pdf->Cell(4,0.5,"Rp ".number_format ($nsb['jumlah_kredit'], 2, ',', '.'),0,0,'R');
    $pdf->Cell(4,0.5,"Rp ".number_format ($sisa_saldo, 2, ',', '.'),0,0,'R');
    $pdf->Ln(0.5);    
}

$pdf->Output();

 ?>
