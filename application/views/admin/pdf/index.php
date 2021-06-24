<?php



require('html2fpdf.php');
ob_start();

?>
<html>
<head>
<title>Contoh Export to PDF</title>

</head>
<body>

<table width="100%" cellspacing="6" cellpadding="5" align="center" border="1">
    <tr><td colspan="2" align="center">Contoh Laporan</td></tr>
    <tr><td colspan="2">Yang bertanda tangan dibawah ini adalah :
    <tr><td>Nama</td>
        <td>Muhamad Rizal</td>
    </tr>
    <tr><td>Kelas</td>
        <td>99</td>
    </tr>
    <tr><td colspan="2">Menyatakan bersedia mengikuti kegiatan sekolah</td></tr>
    <tr><td colspan="2" align="right"> Bandung <br>&nbsp;<br> Muhamad Rizal
    </td></tr>
</table>


</body>
</html>
<?php
// Output-Buffer in variable:
$html=ob_get_contents();
ob_end_clean();
$pdf=new HTML2FPDF();
$pdf->AddPage();
$pdf->WriteHTML($html);
if (preg_match("/MSIE/i", $_SERVER["HTTP_USER_AGENT"])){
    header("Content-type: application/PDF");
} else {
    header("Content-type: application/PDF");
    header("Content-Type: application/pdf");
}
$pdf->Output("sample2.pdf","I");

?>
