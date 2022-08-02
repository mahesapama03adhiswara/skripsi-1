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
    <td><center><img src="../../dist/img/KOP_BPKP.png" width="auto" height="150px"></center></td>
  </tr>
 
  </table>
<hr>
<?php
$id_bidang=$_POST['id_bidang'];
$sql= mysqli_query($koneksi,"SELECT * FROM tb_peminjaman, tb_arsip, tb_bidang, tb_pengguna
WHERE tb_peminjaman.id_arsip =tb_arsip.id_arsip
AND tb_peminjaman.bidang = tb_bidang.id_bidang
AND tb_bidang.id_bidang = '$id_bidang'
AND tb_peminjaman.nip = tb_pengguna.nip
AND tb_peminjaman.status='DIKEMBALIKAN'
AND YEAR(tgl_pinjam)='$tahun' 
AND MONTH(tgl_pinjam)='$bulan1'");

while ($data=$sql->fetch_array()) {
?>
   <h3><center><b>LAPORAN DATA PENGEMBALIAN PINJAM ARSIP INAKTIF BIDANG"<?php echo $data['nama_bidang'] ?>" </b></center></h3> 
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

   <th width="25px" height="50px">No. </th>  
   <th width="25px" height="50px">No. Pengembalian</th>
   <th width="25px" height="50px">Nama Peminjam</th>
   <th width="25px" height="50px">No. Laporan</th>
   <th width="25px" height="50px">Uraian Informasi Arsip</th>
   <th width="25px" height="50px">Tanggal Peminjaman</th>
   <th width="25px" height="50px">Tanggal Pengembalian</th>
   <th width="25px" height="50px">Note</th>
   <th width="25px" height="50px">Status</th>
   <!-- <th width="25px" height="50px">Jumlah</th>
   <th width="25px" height="50px">Box</th>
   <th width="25px" height="50px">Rak</th>
   <th width="25px" height="50px">Tahun</th>
   <th width="25px" height="50px">Lokasi</th> -->



 </tr>  
    </thead>
    <tbody>
        <?php
        $no = 1;
        $sql = $koneksi ->query("SELECT * FROM tb_peminjaman, tb_arsip, tb_bidang, tb_pengguna
        WHERE tb_peminjaman.id_arsip =tb_arsip.id_arsip
        AND tb_peminjaman.bidang = tb_bidang.id_bidang
        AND tb_bidang.id_bidang = '$id_bidang'
        AND tb_peminjaman.nip = tb_pengguna.nip
        AND tb_peminjaman.status='DIKEMBALIKAN'
        AND YEAR(tgl_pinjam)='$tahun'
        AND MONTH(tgl_pinjam)='$bulan1'");
        while ($data=$sql->fetch_array()) {

        ?>
          <tr>
            <td width="25px" height="50px"><center><?php echo $no++;?></center></td> 
            <td width="100px" height="50px"><center><?php echo $data['id_peminjaman'];?></center></td>
            <td width="100px" height="50px"><center><?php echo $data['nama_pegawai'];?></center></td>
            <td width="100px" height="50px"><center><?php echo $data['no_laporan'];?></center></td>
            <td width="100px" height="50px"><center><?php echo $data['nama_arsip'];?></center></td>
            <td width="100px" height="50px"><center><?php echo $data['tgl_pinjam'];?> </center></td> 
            <td width="100px" height="50px"><center><?php echo $data['tgl_kembali'];?> </center></td> 
            <td width="100px" height="50px"><center><?php echo $data['note'];?> </center></td>   
            <td width="100px" height="50px"><center><?php echo $data[6];?> </center></td> 
            <!-- <td width="100px" height="50px"><center><?php echo $data['jumlah'];?> </center></td> 
            <td width="100px" height="50px"><center><?php echo $data['box'];?></center></td>
            <td width="100px" height="50px"><center><?php echo $data['rak'];?> </center></td>   
            <td width="100px" height="50px"><center><?php echo $data['tahun'];?> </center></td> 
            <td width="100px" height="50px"><center><?php echo $data['tempat'];?> </center></td>  -->
            
            
         
                         
         </tr>  
        <?php }  ?>
        <!-- <tr>
           <td colspan="8">TOTAL :</td>
           <td  width="100px" height="50px"><center> Rp.<?php echo number_format($data2['total_harga']);?></center></td>
        </tr> -->
            </tbody> 
            </table>
            
            <br><p align="right">Banjarbaru,&nbsp <?php echo format_indo(date('Y-m-d'))?> &nbsp
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<br>
            <br> &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<br>Kepala Sub Bagian Umum &nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</br>         
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
