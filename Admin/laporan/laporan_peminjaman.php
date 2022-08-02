<?php
include "../../inc/koneksi.php";

date_default_timezone_set('Asia/Jakarta');
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
    <td><center><img src="../../dist/img/bpkp.png" width="auto" height="150px"></center></td>
  </tr>
 
  </table>
<hr>
<?php
$id_bidang=$_POST['id_bidang'];
$sql= mysqli_query($koneksi,"SELECT *, S.id_peminjaman, S.status, S.tgl_pinjam, B.no_laporan, B.nama_arsip, B.jumlah, A.nip, A.nama_pegawai 
FROM tb_peminjaman S 
INNER JOIN tb_bidang w ON S.id_bidang = w.id_bidang
INNER JOIN tb_arsip B ON S.no_laporan = B.no_laporan 
INNER JOIN tb_pengguna A ON S.nip = A.nip 
WHERE S.status='Dikembalikan'  AND w.id_bidang='1'
AND MONTH(tgl_pinjam)='$bulan1' 
AND YEAR(tgl_pinjam)='$tahun'");
while ($data=$sql->fetch_assoc()) {
?>
   <h3><center><b>LAPORAN ASET LOKASI"<?php echo $data['nama_bidang'] ?>" PADA BULAN  <?php echo  bulan_indo((int)$bulan1); ?> <?php echo date('Y')?> </b></center></h3> 
   <?php
break;
}
   ?>
<table class="table table-borderless" style="width: 100%"> 
  <tr>
    <th style="text-align: right;">Tanggal Cetak :&nbsp&nbsp<?php echo format_indo(date('Y-m-d'))?> </th>
</tr>
  </table> 
<table border="1" width="100%" style="border-collapse: collapse;">

                                       <thead>
                                        <tr>

   <th width="25px" height="50px">No</th>  
   <th width="25px" height="50px">Tanggal Pinjam</th>
   <th width="25px" height="50px">NIP</th>
   <th width="25px" height="50px">Nama Peminjam</th>
   <th width="25px" height="50px">Nama Arsip</th>
   <th width="25px" height="50px">Bidang</th>
   <th width="25px" height="50px">Status</th>
 
  

 </tr>  
    </thead>
    <tbody>
                                     

        <?php

       


        $no = 1;

        $sql = $koneksi ->query("SELECT *, S.id_peminjaman, S.status, S.tgl_pinjam, B.no_laporan, B.nama_arsip, B.jumlah, A.nip, A.nama_pegawai 
        FROM tb_peminjaman S 
        INNER JOIN tb_bidang w ON S.id_bidang = w.id_bidang
        INNER JOIN tb_arsip B ON S.no_laporan = B.no_laporan 
        INNER JOIN tb_pengguna A ON S.nip = A.nip 
        WHERE S.status='DIKEMBALIKAN'  AND w.id_bidang='1'
        AND MONTH(tgl_pinjam)='$bulan1' 
        AND YEAR(tgl_pinjam)='$tahun'");
        while ($data=$sql->fetch_assoc()) {

        ?>
          <tr>
              <td width="25px" height="50px"><center><?php echo $no++;?></center></td> 
              <td width="100px" height="50px"><center><?php echo format_indo(date($data['tgl_pinjam']));?></center></td>
              <td width="100px" height="50px"><center><?php echo $data['nip'];?></center></td>
              <td width="100px" height="50px"><center><?php echo $data['nama_pegawai'];?></center></td>
              <td width="100px" height="50px"><center><?php echo $data['nama_arsip'];?></center></td>
              <td width="100px" height="50px"><center><?php echo $data['nama_bidang'];?> </center></td>   
               <td width="100px" height="50px"><center><?php echo $data['status'];?> </center></td> 
            
            
         
                         
         </tr>  
        <?php }  ?>
        <!-- <tr>
           <td colspan="8">TOTAL :</td>
           <td  width="100px" height="50px"><center> Rp.<?php echo number_format($data2['total_harga']);?></center></td>
        </tr> -->
            </tbody> 
            </table>
            
            <br><p align="right">Rantau,&nbsp <?php echo format_indo(date('Y-m-d'))?> &nbsp
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<br>
            <br>Project Manager &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<br>PT Hasnur Riung Sinergi Site BRE &nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</br>         
            <br></br>   
            <br></br>
            
            &nbsp&nbsp&nbsp
            <p align="right">Khaerus Shaleh &nbsp&nbsp &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp</p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</p>
            </div>
            <br></br>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            
            <input type="button" class="noPrint button" value="Cetak" onclick="window.print()">
                      </div>
                  </div>
              </div>
          </div>
    </div>  
    
					<script>
					window.onload = window.print;
					</script>                                   
