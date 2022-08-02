<?php


function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <!-- <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Report</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="?page=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Report</li>
                    </ol>
                </nav>
            </div> -->
        </div>
    </div>
    <style>
        @media print {

            /* Hide every other element */
            body * {
                visibility: hidden;
            }

            /*Then display print container elements */
            .print-container,
            .print-container * {
                visibility: visible;
            }
        }
    </style>

  
    <section class="section">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 ">		
        <a class="btn btn-outline-primary btn-sm" type="submit">
            <btn onclick="window.print();">   
        <i class="far fa-file-pdf"></i>&nbsp; Print </btn> </a>
    </div>
        <div class="card print-container">
            <div class="card-body">
                <table class="table table-borderless" width="100%" height="auto">
                    <!-- <tr>
                        <th style="text-align: right;">Tanggal Cetak :&nbsp&nbsp<?php echo tgl_indo(date('Y-m-d')) ?> </th>
                    </tr>-->
                    <tr> 
                        <td>
                            <center><img src="dist/img/KOP_BPKP.png" height="auto"></center>
                        </td>
                        
                    </tr>
                     <tr>
                        <th style="text-align: right;">Banjarbaru ,&nbsp&nbsp<?php echo tgl_indo(date('Y-m-d')) ?> </th>
                    </tr>
                   
                </table>
                <div class="table table-borderless">
                    <table class="table table-borderless" style="width: 150%">
                   
                        <center>
                            <h3 style="color:black ;">BERITA ACARA MUTASI ARSIP</h3>
                        </center>
                        <!-- <center>
                            <h6  style="color:black ;">SERAH TERIMA KENDARAAN DINAS</h6>
                        </center> -->
                        <br>
                        <div class="row">
                            <?php
                            $id_mutasi = $_GET['kode'];
                            $sql = mysqli_query($koneksi,"SELECT * FROM tb_mutasi,tb_arsip,tb_pengguna,tb_bidang
                            WHERE tb_mutasi.id_arsip = tb_arsip.id_arsip
                            AND tb_mutasi.nip = tb_pengguna.nip
                            AND tb_mutasi.bidang = tb_bidang.id_bidang  
                            AND id_mutasi = '$id_mutasi'
                            ");

                            while ($data = $sql->fetch_assoc()) {

                            ?>
                                <div class="col-sm-12">
                                    <p>
                                    <table>
                                        <tr>
                                            <td>No. Mutasi </td>
                                            <td>&emsp;:&nbsp;</td>
                                            <td><?php echo $data['id_mutasi']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Perihal</td>
                                            <td>&emsp;:&nbsp;</td>
                                            <td>Penyusutan Arsip Aktif ke Inaktif</td>
                                        </tr>
                                    </table>
                                    </p>
                                    <br>
                                
                                    <p>Pada tanggal <?php echo tgl_indo($data['tgl_ajukan']) ?>, yang bertanda tangan dibawah ini :</p>
                                    <table class="table-borderless"  style="width: 28%">
                                        <tr>
                                            <td>Nama</td>
                                            <td style="text-align: left; width: 0%">&emsp;:&nbsp;</td>
                                            <td><?php echo $data['nama_pegawai']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>NIP</td>
                                            <td>&emsp;:&nbsp;</td>
                                            <td><?php echo $data['nip']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Bidang</td>
                                            <td>&emsp;:</td>
                                            <td><?php echo $data['nama_bidang'] ?></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <p>Mengajukan Pemindahan Arsip Aktif ke Inaktif dengan keterangan sebagai berikut :</p>

                                    <table class="table-borderless"  style="width: 50%" >
                                        <tr>
                                            <td>Kode Klasifikasi</td>
                                            <td style="text-align: left; width: 5%">&emsp;&emsp;:&nbsp;</td>
                                            <td><?php echo $data['kode_klasifikasi']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>No. ST</td>
                                            <td style="text-align: left; width: 5%">&emsp;&emsp;:&nbsp;</td>
                                            <td><?php echo $data['no_st']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>No. Laporan</td>
                                            <td>&emsp;&emsp;:</td>
                                            <td><?php echo $data['no_laporan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Uraian Informasi Arsip</td>
                                            <td>&emsp;&emsp;:</td>
                                            <td><?php echo $data['nama_arsip']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Mengajukan</td>
                                            <td>&emsp;&emsp;:</td>
                                            <td><?php echo $data['tgl_ajukan']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Diterima</td>
                                            <td>&emsp;&emsp;:</td>
                                            <td><?php echo $data['tgl_acc']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Note</td>
                                            <td>&emsp;&emsp;:</td>
                                            <td><?php echo $data['note']; ?></td>
                                        </tr>
                                   
                                    </table>
                                    <br>
                                    <p>Maka dari itu, Arsip Aktif yang diajukan oleh <?php echo $data['nama_pegawai']; ?> dari bidang <?php echo $data['nama_bidang']; ?> memenuhi syarat untuk menyerahkan arsip aktif bidang <?php echo $data['nama_bidang']; ?> kepada arsiparis untuk dikelola menjadi arsip Inaktif.</p>
                                     <?php }  ?>
                                    <table class="table-borderless" style="width: 100%">
                                    <br>
                                        <tr>
                                            <td style="text-align: center; width: 33%;"></td>
                                            <td style="text-align: center; width: 33%;"></td>
                                            <td style="text-align: center; width: 33%;">Banjarbaru, <?php echo tgl_indo(date('Y-m-d'))?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; width: 33%;"></td>
                                            <td style="text-align: center; width: 33%;"></td>
                                            <td style="text-align: center; width: 33%;">Kasubbag Umum</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; width: 33%;"></td>
                                            <td style="text-align: center; width: 33%;"></td>
                                            <td style="text-align: center; width: 33%;"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; height: 80px;"></td>
                                            <td style="text-align: center; width: 80px;"></td>
                                            <td style="text-align: center; height: 80px;"></td>
                                        </tr>
                                        <tr>        
                                            <td style="text-align: center; width: 33%;"></td>
                                            <td style="text-align: center; width: 33%;"></td>
                                            <td style="text-align: center; width: 33%;">Khaerus Shaleh</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; width: 33%;"></td>
                                            <td style="text-align: center; width: 33%;"></td>
                                            <td style="text-align: center; width: 33%;">NIP. 197612509 198012 4 002</td>
                                        </tr>
                                        </table>
                                </div>
                                
                        </div>
                    </table>
                </div>
            </div>
        </div>

    </section>
</div>


<!-- Modal 3-->
<!-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Export Laporan APD Masuk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		<form method="POST" action="page/laporan/exportexcelapdmasuk.php">

			<strong><label>Pilih Bulan</label></strong>
			<div class="form-group">
				<label>Mulai Tanggal</label>
				<div class="form-group">
					<div class="form-line">
					<input type="date" class="form-control" name="tanggal_awal" required/>
					</div>
				</div>
				<label>Sampai Tanggal</label>
				<div class="form-group">
					<div class="form-line">
					<input type="date" class="form-control" value="<?= date("Y-m-d"); //t0day 
                                                                    ?>" name="tanggal_akhir" required/>
					</div>
				</div>
			</div>


      </div>
      <div class="modal-footer">	  	
	  	<button type="submit" class="btn btn-outline-success"><i class="far fa-file-excel"></i>&nbsp; Export as Excel</button>
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
      </div>	  
	  </form>
		</div>
	</div>
</div> -->