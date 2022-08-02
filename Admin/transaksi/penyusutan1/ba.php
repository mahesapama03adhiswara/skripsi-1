<?php
$id =$_GET['id'];

$sql=mysqli_query($koneksi,"SELECT*FROM pengajuan_aset WHERE id_pengajuan ='$id' ");
$data= mysqli_fetch_assoc($sql);
include "../../koneksi.php";


date_default_timezone_set('Asia/Jakarta');

$koneksi = new mysqli("localhost", "root", "", "aset_hrs");
$bulan1 = $_POST['bulan'];
$tahun = $_POST['tahun'];


 function format_indo($date){
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    $tahun = substr($date, 0, 4);               
    $bulan = substr($date, 5, 2);
    $tgl   = substr($date, 8, 2);
    $result = $tgl . " " . $BulanIndo[(int)$bulan-1]. " ". $tahun;
    return($result);
    }

function bulan_indo($bulan_angka) {
 $bulan1 = array(1=>'JANUARI', 
      'FEBRUARI', 
      'MARET', 
      'APRIL', 
      'MEI', 
      'JUNI', 
      'JULI', 
      'AGUSTUS', 
      'SEPTEMBER', 
      'OKTOBER', 
      'NOVEMBER', 
      'DESEMBER'
     );

 return $bulan1[$bulan_angka];
}
?>

<style>

    @media print{
      input.noPrint{
        display: none;
      }

    }
.img{
width: 900px;
height: auto;
margin-left: 20px;

}
.button {
  background-color: #1E90FF;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
.tumblr {
  background-color: #1E90FF;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

</style>
<table class="table table-borderless" width="100%" height="auto"> 
<tr>
    <th style="text-align: right;">Tanggal Cetak :&nbsp&nbsp<?php echo format_indo(date('Y-m-d'))?> </th>
</tr>
  <tr>
    <td><center><img src="dist/img/logo_report_hrs.jpg" width="1400px" height="170px"></center></td>
  </tr>
 
  </table>
  
<hr>
  
<table class="table table-borderless" style="width: 100%"> 
 
  </table> 
  <?php
$id =$_GET['id'];

$sql= mysqli_query($koneksi,"SELECT p.id_pengajuan, u.nama,p.nama_aset,k.nama_kategori,l.nama_lokasi,r.nama_ruang,p.harga,p.tanggal_masuk,
 p.id_supplier, s.nama_supplier, s.alamat_supplier, s.no_hp, s.email, s.nama_sales, p.tanggal_pengajuan,p.tanggal_musnah
FROM pengajuan_aset p 
				   INNER JOIN user u ON p.nrp = u.nrp
                   INNER JOIN kategori_aset k ON p.id_kategori = k.id_kategori
                   INNER JOIN lokasi l ON p.id_lokasi = l.id_lokasi
                   INNER JOIN ruang_aset r ON p.id_ruang = r.id_ruang 
                   INNER JOIN supplier s ON p.id_supplier = s.id_supplier 
WHERE id_pengajuan = '$id' 
AND p.validasi_go = 'DIAMBIL'
AND p.status_musnah = 'PENDING'");
while ($data=$sql->fetch_assoc()) {
?>
   <!-- <h4><center><b>NOTA PEMBELIAN </h4> <br><h6> ID "<?php echo $data['id_pengajuan'] ?>"<br> Nama Aset "<?php echo $data['nama_aset'] ?>" </b></center> </h6> -->
<div class="wrapper">
   <section class="invoice">
   <h2><center><b style="color:black;"> <br></b></center></h2>
   <div class="row">
      <div class="col-12">
        <h2 class="page-header">
       
        <small class="float-right"><p><strong><h5><b> Rantau, <?php echo format_indo($data['tanggal_musnah'])?></b></h5></strong></p></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
    <h5>  <b> <p>Nomor :  <?php echo $data['id_pengajuan'] ?><br>Prihal &nbsp&nbsp: Pemusnahan Barang  <?php echo $data['nama_lokasi'] ?></p>
       <p> Kepada Yth <br>Project Manager  PT HASNUR RIUNG SINERGI SITE BRE <br>Kabupaten Tapin</p></b></h5>
       <p> </p><br>
       <br>
      
      </div>
      <!-- /.col -->
    
      <!-- /.col -->
    
      <!-- /.col -->
    </div><h5>
    <p>
       Bersamaan dengana adanya surat ini kami dari
       <b><?php echo $data['nama_lokasi'] ?>&nbsp Ruang  <?php echo $data['nama_ruang'] ?></b>,<br> ingin mengajukan pemusnahan aset
       ,berikut aset yang kami ajukan pemusnahan &nbsp :
      </p>
    </h5>
    <?php

break;
}
   ?>

<?php
$id =$_GET['id'];

$sql= mysqli_query($koneksi,"SELECT p.id_pengajuan, u.nama,u.jabatan,p.nama_aset,k.nama_kategori,l.nama_lokasi,r.nama_ruang,
p.harga,p.tanggal_masuk, p.id_supplier, s.nama_supplier,
 s.alamat_supplier, s.no_hp, s.email, s.nama_sales, p.qty, u.nrp, u.qrcode, p.tanggal_pengajuan,
 p.validasi_go,p.status_musnah, p.jml_musnah,p.tanggal_musnah,p.note_musnah, (qty * harga) AS total
FROM pengajuan_aset p 
				   INNER JOIN user u ON p.nrp = u.nrp
                   INNER JOIN kategori_aset k ON p.id_kategori = k.id_kategori
                   INNER JOIN lokasi l ON p.id_lokasi = l.id_lokasi
                   INNER JOIN ruang_aset r ON p.id_ruang = r.id_ruang 
                   INNER JOIN supplier s ON p.id_supplier = s.id_supplier 
WHERE id_pengajuan = '$id' 
AND p.validasi_go = 'DIAMBIL'
AND p.status_musnah = 'PENDING'");
while ($data=$sql->fetch_assoc()) {
?>
    <!-- <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>NO</th>
            <th>ID Pengajuan</th>
            <th>Nama Barang </th>
            <th>Jenis Barang</th>
            <th>Supplier</th>
            <th>Qty</th>
            <th>Harga Satuan</th>
            <th>Total Harga</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>1</td>
            <td><?php echo $data['id_pengajuan'] ?></td>
            <td><?php echo $data['nama_aset'] ?></td>
            <td><?php echo $data['nama_kategori'] ?></td>
            <td><?php echo $data['nama_supplier'] ?></td>
            <td><?php echo $data['qty'] ?></td>
            <td>Rp.<?php echo number_format($data['harga']); ?></td>
            <td>Rp.<?php echo number_format($data['total']); ?></td>
          </tr>
        
          <tbody>

          </tbody>
        </table>
      </div>
 
    </div> -->
    <table class="table-borderless" style="width: 90%">
          <br>
              <tr>
                <td style="text-align: left; width: 30%;"><strong><h5><b>ID Aset </h5></b></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp<b> <?php echo $data['id_pengajuan'] ?></h5></b></strong></td>
              </tr>
              
              <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>Nama Aset</h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp <?php echo $data['nama_aset'] ?></h5></strong></td>
              </tr>
              <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>Kategori</h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp <?php echo $data['nama_kategori'] ?></h5></strong></td>
              </tr>
              <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>Lokasi</h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp <?php echo $data['nama_lokasi'] ?></h5></strong></td>
              </tr>
              <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>Ruang</h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp <?php echo $data['nama_ruang'] ?></h5></strong></td>
              </tr>
              <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>Alasan Pemusnahan</h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp <?php echo $data['note_musnah'] ?></h5></strong></td>
              </tr>
              <!-- <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>Supplier</h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp <?php echo $data['nama_supplier'] ?></h5></strong></td>
              </tr> -->
              <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>Jumlah Aset </h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp <?php echo $data['qty'] ?> </h5></strong></td>
              </tr>
              <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>Jumlah Yang Dimusnahkan</h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp <?php echo $data['jml_musnah'] ?> </h5></strong></td>
              </tr>
              <!-- <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>Harga Estimasi </h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp Rp.<?php  echo number_format($data['harga']) ?></h5></strong></td>
              </tr> -->
              <!-- <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>Total </h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp Rp.<?php  echo number_format($data['total']) ?></h5></strong></td>
              </tr> -->
              <!-- <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>Foto Aset Rusak</h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp  <img src="dist/img/<?php echo $data['foto_rusak'];?>"height="100px" width="200x"style="border: radius 50%;"/></h5></strong></td>
              </tr> -->
              <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>Status</h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp <?php echo $data['status_musnah'] ?></h5></strong></td>
              </tr>
              <!-- <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>Keusakan</h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp <?php echo $data['kerusakan'] ?></h5></strong></td>
              </tr> -->
              <!-- <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>Jasa Service</h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp <?php echo $data['jasa_service'] ?></h5></strong></td>
              </tr> -->
              <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>Tanggal Pengajuan</h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp <?php echo format_indo($data['tanggal_musnah'])?></h5></strong></td>
              </tr>
              <!-- <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>Tanggal Diterima</h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp <?php echo format_indo($data['tanggal_validasi'])?></h5></strong></td>
              </tr> -->
              <!-- <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>Nama Validator</h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp MH Usep Arif Topnai</h5></strong></td>
              </tr> -->
             
             
            </table>
    <br><br><br>
    <div>
        <h5>
          <p>
            Demikian surat pengajuan pemusnahan aset ini kami sampaikan, &nbsp atas perhatian kami ucapkan Terimaksih.
        </p>
      </h5>
      </div>
<br><br><br>
<table class="table-borderless" style="width: 100%">
          <br>
              <tr>
                <td style="text-align: center; width: 33%;"><strong><h5><b>Mengetahui,</h5></b></strong></td>
                <td style="text-align: center; width: 33%;"></td>
                <td style="text-align: center; width: 33%;"><strong><h5><b> Rantau, <?php echo format_indo($data['tanggal_pengajuan'])?></b></h5></strong></td>
              </tr>
              <tr>
                <td style="text-align: center; width: 33%;"><strong><h5><b>Project Manager</h5></b></strong></td>
                <td style="text-align: center; width: 33%;"></td>
                <td style="text-align: center; width: 33%;"><strong><h5><b><?php echo $data['jabatan'] ?></h5></b></strong></td>
              </tr>
              <tr>
                <td style="text-align: center; width: 33%;"></td>
                <td style="text-align: center; width: 33%;"></td>
                <td style="text-align: center; width: 33%;"></td>
              </tr>
              <tr>
                <td style="text-align: center; height: 80px;"></td>
                <td style="text-align: center; width: 80px;"> </td>
                <td style="text-align: center; height: 80px;"><img src="dist/img/<?php echo $data['qrcode']?>"height="100px" width="100px"></td>
              </tr>
              <tr>        
                <td style="text-align: center; width: 33%;"><strong><h5><b>MH Usep Arif Topani</h5></b></strong></td>
                <td style="text-align: center; width: 33%;"></td>
                <td style="text-align: center; width: 33%;"><strong><h5><b><?php echo $data['nama'] ?></h5></b></strong></td>
              </tr>
              <tr>
                <td style="text-align: center; width: 33%;"><strong><h5><b>NRP:7867899</h5></b></strong></td>
                <td style="text-align: center; width: 33%;"></td>
                <td style="text-align: center; width: 33%;"><strong><h5><b>NRP:<?php echo $data['nrp'] ?></h5></b></strong></td>
              </tr>
            </table>
    <div>
      
     <!-- <h5><b>
      <br><p align="right">Rantau,&nbsp <?php echo format_indo(date('Y-m-d'))?> &nbsp
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<br>
            <br><?php echo $data['jabatan'] ?> &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<br>PT Hasnur Riung Sinergi Site BRE &nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</br>         
            <br></br>   
            <br></br>
            
            &nbsp&nbsp
            <p align="right"><?php echo $data['nama'] ?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp</p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</p>
            </div>
            <br></br>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </h5></b> -->
    </div>
    <?php
// break;
}
   ?>
    <!-- /.row -->
 </section>
</div>
 
            <input type="button" class="noPrint button" value="Cetak Surat" onclick="window.print()"></center>
                      </div>
                  </div>
              </div>
          </div>
    </div>                                     