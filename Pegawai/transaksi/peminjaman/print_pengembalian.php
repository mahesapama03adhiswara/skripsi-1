<?php
require '/xampp/htdocs/pkl/inc/koneksi.php';
require_once __DIR__ . '/../../vendor/autoload.php';
$kembali = $koneksi->query("SELECT s.id_peminjaman, b.kode_barang, b.nama_barang,b.stok, a.nisn, a.kelas, a.nama_siswa, c.nik, c.nama_guru, s.jumlah, s.tgl_kembali, s.tgl_pinjam
from tb_peminjaman s inner join tb_barang b on s.kode_barang=b.kode_barang inner join tb_guru c on s.nik=c.nik
inner join tb_siswa a on s.nisn=a.nisn where status='KEM' order by tgl_pinjam asc");


$mpdf = new \Mpdf\Mpdf();
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../dist/css/print.css" class="css">
    <title>PRINT DATA PENGEMBALIAN</title>
</head>
<body>
<table style="border: 1px solid #fff; width: 100%;">
        <tr>
            <td style="width: 15%;">
                <img src="../../dist/img/kalsel.png" style="width:90px; height:90px;"> 
            </td>
            <td style="width:77%;">
                <center>
                    <p style="font-size: 15px;"><b>PEMERINTAH PROVINSI KALIMANTAN SELATAN</b></p>
                    <P style="font-size: 15px;"><b>DINAS PENDIDIKAN DAN KEBUDAYAAN</b></P>
                    <P style="font-size: 15px;"><b>SMK NEGERI 2 BANJARBARU</b></P>
                    <P style="font-size: 12px";>Jalan Nusatara Nomor 1 <img src="../../dist/img/phone.png" style="width:10px; height: 10px;">/Fax(0511)4773452 Loktabat Selatan Banjarbaru</P>
                    <p style="font-size: 12px";>Website http://www.smkn2banjarbaru.sch.id Email: smkn2bjb@gmail.com</p>
                </center>
            </td>
        </tr>
    </table>
    <hr style="color: black; margin: 0px; padding: 0px; height: 5px;">
    <br>

    <h3 align="center">LAPORAN DATA PENGEMBALIAN ALAT PRAKTEK PADA JURUSAN TEKNIK KOMPUTER DAN INFORMATIKA</h3>
    <table width="100%" border="1" cellpading="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Peminjam</th>
        <th>Kelas</th>
        <th>Barang</th>
        <th>Jumlah Barang</th>
        <th>Guru Pengajar</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
    </tr> ';
    $i = 1;

    foreach( $kembali as $row) {
        $html .= '<tr>
        <td align="center">'. $i++ .'</td>
        <td align="center">'. $row["nama_siswa"].'</td>
        <td align="center">'. $row["kelas"].'</td>
        <td align="center">'. $row["nama_barang"].'</td>
        <td align="center">'. $row["jumlah"].'</td>
        <td align="center">'. $row["nama_guru"].'</td>
        <td align="center">'. $row["tgl_pinjam"].'</td>
        <td align="center">'. $row["tgl_kembali"].'</td>
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
            KEPALA BENGKEL TKJ
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

