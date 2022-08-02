<?php
// include "../../../inc/koneksi.php";

date_default_timezone_set('Asia/Jakarta');
$koneksi = new mysqli ("localhost","root","","arsip");
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
    <td><center><img src="dist/img/KOP_BPKP.png" width="auto" height="150px"></center></td>
  </tr>
 
  </table>
<hr>
<?php
// $id_arsip=$_POST['id_arsip'];

$sql= mysqli_query($koneksi,"SELECT * FROM tb_arsip, tb_bidang
WHERE tb_arsip.bidang =tb_bidang.id_bidang
AND tb_arsip.jenis='Musnah'");
while ($data=$sql->fetch_assoc()) {
?>
   <h3><center><b>LAPORAN DATA MUTASI ARSIP </b></center></h3> 
   <?php
break;
}
   ?>
<table class="table table-borderless" style="width: 100%"> 
  <tr>
    <th style="text-align: right;">Tanggal Cetak :&nbsp&nbsp<?php echo format_indo(date('Y-m-d'))?> </th>
</tr>
  </table> 
<table border="1" width="100%" style="border-collapse: collapse;" align="center">

    <thead>
        <tr align="center" >
            <th width="25px" height="50px">No. </th>
            <th width="25px" height="50px">No. Laporan</th>
            <th width="25px" height="50px">Uraian Informasi Arsip</th>
            <th width="25px" height="50px">Tanggal Pemusnahan</th>
            <th width="25px" height="50px">Note</th>
            <th width="25px" height="50px">Status Arsip</th>
        </tr>  
    </thead>
    <tbody>
        <?php
        $no = 1;
       // $id_arsip=$_POST['id_arsip'];
        $sql= mysqli_query($koneksi,"SELECT * FROM tb_arsip, tb_bidang
        WHERE tb_arsip.bidang =tb_bidang.id_bidang
        AND tb_arsip.jenis='Musnah'");
        while ($data=$sql->fetch_assoc()) {

        ?>
          <tr>
          <td width="25px" height="50px"><center><?php echo $no++;?></center></td> 
            <td width="100px" height="50px"><center><?php echo $data['no_laporan'];?></center></td>
            <td width="100px" height="50px"><center><?php echo $data['nama_arsip'];?></center></td>
            <td width="100px" height="50px"><center><?php echo $data['tgl_musnah'];?> </center></td>  
            <td width="100px" height="50px"><center><?php echo $data['note_musnah'];?> </center></td> 
            <td width="100px" height="50px"><center><?php echo $data['jenis'];?></center></td>            
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
