<?php
$id_peminjaman =$_GET['kode'];
// $koneksi = new mysqli("localhost", "root", "", "arsip");
// include "../../inc/koneksi.php";

$sql=mysqli_query($koneksi,"SELECT * FROM tb_peminjaman WHERE id_peminjaman ='$id_peminjaman' ");
$data= mysqli_fetch_assoc($sql);

date_default_timezone_set('Asia/Jakarta');


// $bulan1 = $_POST['bulan'];
// $tahun = $_POST['tahun'];


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
<table class="table responsive" width="100%" height="auto"> 
<!-- <tr>
    <th style="text-align: right;">Tanggal Cetak :&nbsp&nbsp<?php echo format_indo(date('Y-m-d'))?> </th>
</tr> -->
  <tr>
    <td><center><img src="dist/img/KOP_BPKP.png" width="1400px" height="170px"></center></td>
  </tr>
 
  </table>
  
  
  <?php
$id_peminjaman =$_GET['kode'];

$sql= mysqli_query($koneksi,"SELECT * FROM tb_peminjaman,tb_arsip,tb_pengguna, tb_bidang
WHERE tb_peminjaman.id_arsip = tb_arsip.id_arsip
AND tb_peminjaman.nip = tb_pengguna.nip
AND id_peminjaman = '$id_peminjaman'");
while ($data=$sql->fetch_assoc()) {
?>
   <!-- <h4><center><b>NOTA PEMBELIAN </h4> <br><h6> ID "<?php echo $data['id_pengajuan'] ?>"<br> Nama Aset "<?php echo $data['nama_aset'] ?>" </b></center> </h6> -->
<div class="wrapper">
  <section class="invoice">
    
    <small class="float-right"><strong><h5><b>Banjarbaru, <?php echo format_indo($data['tgl_pinjam'])?></b> </h5></strong></small>
    <div class="row invoice-info">
      <div class="col-sm-8 invoice-col">
        <h5>  <b> <p>Nomor &nbsp&nbsp&nbsp&nbsp :  <?php echo $data['id_peminjaman'] ?>
        <br>Perihal &nbsp&nbsp &nbsp: Peminjaman Arsip Inaktif  </p></h5>
          </div>
    </div>
    <?php

    break;
    }
      ?>

    <?php
    $id_peminjaman =$_GET['kode'];

    $sql= mysqli_query($koneksi,"SELECT  * 
    FROM tb_peminjaman a
    INNER JOIN tb_pengguna b ON a.nip = b.nip
    INNER JOIN tb_bidang c ON a.bidang = c.id_bidang 
    INNER JOIN tb_arsip d ON a.id_arsip = d.id_arsip
    WHERE a.id_peminjaman= '$id_peminjaman'
    ");
    while ($data=$sql->fetch_assoc()) {
    ?>
    
  <h5>
    <p>
       Pada (hari) dan tanggal <?php echo format_indo($data['tgl_pinjam']) ?>, Pegawai dengan &nbsp :
      </p>
      
      <table class="table-borderless"  style="width: 90%" >
          
          <tr >
                <td style="text-align: left; width: 30%"><strong><h5>NIP </h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp <?php echo $data['nip'] ?></h5></b></strong></td>
              </tr>
              <tr >
                <td style="text-align: left; width: 30%;"><strong><h5>Nama </h5></b></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp <?php echo $data['nama_pegawai'] ?></h5></b></strong></td>
              </tr>
              <tr >
                <td style="text-align: left; width: 30%;"><strong><h5>Bidang</h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp <?php echo $data['nama_bidang'] ?></h5></strong></td>
              </tr>
             
              <h5>
      </table>
  </h5>
   
      <table class="table-borderless" style="width: 90%">
        
              <h5>
                <p>
                Mengajukan peminjaman Arsip Inaktif sebagai berikut &nbsp :
                </p>
              </h5>
              <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>Kode Klasifikasi</h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp <?php echo $data['kode_klasifikasi'] ?></h5></strong></td>
              </tr>
              <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>No. ST</h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp <?php echo $data['no_st'] ?></h5></strong></td>
              </tr>
              <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>No. Laporan</h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp <><?php echo $data['no_laporan'] ?> </h5></strong></td>
              </tr>
              <tr>
                <td style="text-align: left; width: 30%;"><strong><h5>Uraian Informasi Arsip</h5></strong></td>
                <td style="text-align: left; width: 60%;"><strong><h5>:&nbsp  <?php echo $data['nama_arsip'];?></h5></strong></td>
              </tr>
      </table>
      
      <div>
        <br>
          <h5>
            
            <p>
              Dan telah disetujui untuk mengambil Arsip Inaktif yang berkaitan.
          </p>
        </h5>
        </div>

<table class="table-borderless" style="width: 100%">
  <br>
      <tr>
        <td style="text-align: center; width: 33%;"><strong><h5><b>Disetujui,&nbsp&nbsp Banjarbaru,<?php echo format_indo($data['tgl_pinjam'])?></h5></b></strong></td>
        <td style="text-align: center; width: 33%;"></td>
        <td style="text-align: center; width: 33%;"><strong><h5><b> Banjarbaru,<?php echo format_indo($data['tgl_pinjam'])?></b></h5></strong></td>
      </tr>
      
      <tr>
        <td style="text-align: center; width: 33%;"><strong><h5><b>Pegawai <?php echo $data['nama_bidang'] ?></h5></b></strong></td>
        <td style="text-align: center; width: 33%;"></td>
        <td style="text-align: center; width: 33%;"><strong><h5><b>Kasubag Umum</h5></b></strong></td>
      </tr>
      <tr>
        <td style="text-align: center; width: 33%;"></td>
        <td style="text-align: center; width: 33%;"></td>
        <td style="text-align: center; width: 33%;"></td>
      </tr>
      <tr>
        <td style="text-align: center; height: 80px;"><img src="dist/img/PM.PNG"height="100px" width="100px"></td>
        <td style="text-align: center; width: 80px;"> </td>
        <td style="text-align: center; height: 80px;"><img src="dist/img/<?php echo $data['qrcode']?>"height="100px" width="100px"></td>
      </tr>
      <tr>        
        <td style="text-align: center; width: 33%;"><strong><h5><b><?php echo $data['nama_pegawai'] ?></h5></b></strong></td>
        <td style="text-align: center; width: 33%;"></td>
        <td style="text-align: center; width: 33%;"><strong><h5><b>Khaerus Shaleh</h5></b></strong></td>
      </tr>
      <tr>
        <td style="text-align: center; width: 33%;"><strong><h5><b><?php echo $data['nip'] ?></h5></b></strong></td>
        <td style="text-align: center; width: 33%;"></td>
        <td style="text-align: center; width: 33%;"><strong><h5><b>NIP. 197612509 198012 4 002</h5></b></strong></td>
      </tr>
</table>

   
    <?php
// break;
}
   ?>
    <!-- /.row --></div>
 </section>
</div>
 
            <input type="button" class="noPrint button" value="Cetak Surat" onclick="window.print()"></center>
                      </div>
                  </div>
              </div>
          </div>
    </div>                                     