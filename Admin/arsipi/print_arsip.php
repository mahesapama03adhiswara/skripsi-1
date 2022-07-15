<?php
require '/xampp/htdocs/skripsi-1/inc/koneksi.php';
require_once __DIR__ . '/../../vendor/autoload.php';
include '/xampp/htdocs/skripsi-1/inc/koneksi.php';
$arsip = mysqli_query($koneksi, "SELECT * FROM tb_arsip WHERE jenis='Inaktif'");


$mpdf = new \Mpdf\Mpdf();
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../dist/css/print.css" class="css">
    <br>
    <title>PRINT DATA ARSIP INAKTIF</title>
</head>
<body>
<table style="border: 1px solid #fff; width: 100%;">
        <tr>
            <td style="width: 15%;">
                <img src="../../dist/img/bpkp.png" style="width:90px; height:70px;"> 
            </td>
            <td style="width:77%;">
                <center>
                    <p style="font-size: 15px;"><b>BADAN PENGAWASAN KEUANGAN DAN PEMBANGUNAN</b></p>
                    <P style="font-size: 15px;"><b>PERWAKILAN PROVINSI KALIMANTAN SELATAN</b></P>
                    <P style="font-size: 12px";>Jalan Jenderal Ahmad Yani Km 32.5 Banjarbaru 70711</P>
                    <p style="font-size: 12px";>Telepon: (0511) 4781116 Fakimile: (0511) 4774501 </p>
                    <p style="font-size: 12px";>Surel: kalsel@bpkp.go.id Situs: www.bpkp.go.id </p>
                </center>
            </td>
        </tr>
    </table>
    <hr style="color: black; margin: 0px; padding: 0px; height: 5px;">
    <br>

    <h3 align="center">LAPORAN DATA ARSIP INAKTIF PADA BPKP PROVINSI KALSEL</h3>
    <table width="100%" border="1" cellpading="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Kode Klasifikasi</th>
        <th>No. ST</th>
        <th>No. Laporan</th>
        <th>Uraian Laporan Informasi</th>
        <th>Bidang</th>
        <th>Tahun</th>
        <th>Tingkat Keaslian</th>
        <th>Jumlah</th>
        <th>Rak</th>
        <th>Box</th>
    </tr> ';
    $i = 1;
    foreach( $arsip as $row) {
        $html .= '<tr>
        <td align="center">'. $i++ .'</td>
        <td align="center">'. $row["kode_klasifikasi"].'</td>
        <td align="center">'. $row["no_st"].'</td>
        <td align="center">'. $row["no_laporan"].'</td>
        <td align="center">'. $row["nama_arsip"].'</td>
        <td align="center">'. $row["bidang"].'</td>
        <td align="center">'. $row["tahun"].'</td>
        <td align="center">'. $row["tingkat_keaslian"].'</td>
        <td align="center">'. $row["jumlah"].'</td>
        <td align="center">'. $row["rak"].'</td>
        <td align="center">'. $row["box"].'</td>
        </tr>';
    }

    $html .=   '</table>
    <table style="border: 1px solid #fff;">
        <tr></tr>
        <tr>
        
            <td align="right" style="width: 15%;">
            <br>
            <br>Banjarbaru, _______________
            </td>
        </tr>
        
        <tr>
            <td align="right" style="width: 15%; padding-right: 45px;">
                Mengetahui
            </td>
        </tr>
        <tr>
            <td align="right" style="width: 20%; padding-right: 10px">
            KEPALA ARSIPARIS
            </td>
        </tr>
        <tr>
            <td align="right" style="width: 30%; padding-top: 90px; padding-right: 15px">
            Muhammad Yasa, S.Pd
            </td>
        </tr>
        <tr>
            <td align="right" style="width: 20%;">
            NIP. 198111242009031002
            </td>
        </tr>
    </table>
    
</body>
</html>';

    

$mpdf->WriteHTML($html);
$mpdf->Output();
?>

