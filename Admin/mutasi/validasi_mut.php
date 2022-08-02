<?php



    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_mutasi, tb_arsip, tb_pengguna
		WHERE tb_mutasi.id_arsip = tb_arsip.id_arsip 
		AND tb_mutasi.nip = tb_pengguna.nip
		AND id_mutasi='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }

?>

<section class="content-header">
	<h1>
		Validasi Mutasi
		<small>Arsip Aktif</small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="index.php">
				<i class="fa fa-home"></i>
				<b>Website Pengelolaan Arsip Dinamis BPKP Provinsi Kalsel</b>
			</a>
		</li>
	</ol>
</section>


<section id="multiple-column-form">
	<div class="row match-height">
		<div class="col-12">
			<section class="content">
				<!-- // Basic multiple Column Form section start -->
							<!-- general form elements -->
							<div class="box box-info">
								<div class="box-header with-border">
									<h3 class="box-title">Validasi Mutasi</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse">
											<i class="fa fa-minus"></i>
										</button>
										
									</div>
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form action="" method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="box-body">
											
											<div class="col-md-6 col-12">
												<div class="form-group">
													<label>No. Mutasi</label>
													<input type="text" value="<?= $data_cek['id_mutasi'] ?>" readonly name="id_mutasi" id="id_mutasi" class="form-control" placeholder=""/>
												</div>
											</div>
											
											<div class="col-md-6 col-12">
												<div class="form-group">
													<div hidden>
														<input type="text" value="<?= $data_cek['nip']; ?>" name="nip" id="nip" class="form-control" placeholder="" />
													</div>
													<label>Nama Pengaju</label>
													<input type="text" value="<?= $data_cek['nama_pegawai']; ?>" readonly class="form-control" placeholder=""/>
												</div>
											</div>
											
											<div class="col-md-6 col-12">
												<div class="form-group">
													<div hidden>
													<input type="text" name="id_arsip" value="<?= $data_cek['id_arsip']; ?>" readonly class="form-control" placeholder="" >
													</div>
													<label> Nama Arsip</label>
													<input type="text" value="<?= $data_cek['nama_arsip']; ?>" readonly class="form-control" placeholder=""/>
														
												</div>
											</div>
											
											<!-- <div class="col-md-6 col-12">
												<div class="form-group">
													
												</div>
											</div> -->
											
											<!-- <div class="col-md-6 col-12">
												<div class="form-group">
													<label>Jumlah</label>
													<input type="text" name="jumlah" value="<?= $data_cek['jumlah']; ?>" readonly class="form-control" placeholder=""/>
												</div>
											</div> -->

											<div class="col-md-6 col-12">
												<div class="form-group">
													<label>Tanggal Disetujui</label>
													<input type="date" name="tgl_acc" id="tgl_acc" class="form-control "/>
												</div>
											</div>
											
											<div class="col-md-6 col-12">
												<div class="form-group">
													<label>Note</label>
													<input type="text" name="note" id="note" class="form-control" placeholder=""/>
												</div>
											</div>
											
											<div class="col-md-6 col-12">
												<div class="form-group">
													<label>Status</label>
													<select name="validasi" id="validasi" class="form-control" required>
														<option>-- Pilih --</option>
														<option>DITERIMA</option>
														<option>DITOLAK</option>
													</select>
												</div>
											</div>
<!-- 											
											<div class="col-md-6 col-12">
												<div class="form-group">
													<label>Status Pengajuan</label> 
													<input type="text" name="status" id="status" class="form-control" value="PENDING" />
												</div>
											</div> -->
											
											<!-- <div class="col-md-6 col-12">
												<div class="form-group">
													<label>Alamat</label>
													<input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat">
												</div>
											</div> -->


										</div>
									</div>
									<!-- /.box-body -->

									<div class="box-footer">
										<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
										<a href="?page=peminjaman" class="btn btn-warning">Batal</a>
									</div>
								</form>
							</div>
							<!-- /.box -->
			</section>
		</div>
	</div>
</section>

<?php

if (isset($_POST['Simpan'])) {
	$validasi = $_POST['validasi'];
	$idm = $_POST['id_mutasi'];
	// $jenis = $_POST['jenis'];
	$note = $_POST['note'];
	$idarsip = $_POST['id_arsip'];
	$tglacc = $_POST['tgl_acc'];
		
	if($validasi == "DITERIMA"){
	$query_simpan="UPDATE tb_mutasi SET validasi='DITERIMA', note='$note', tgl_acc='$tglacc' WHERE id_mutasi='$idm'";
	mysqli_query($koneksi,$query_simpan);

	
	$query_simpan1="UPDATE tb_arsip SET jenis='Inaktif' WHERE id_arsip='$idarsip'";
	mysqli_query($koneksi,$query_simpan1);
	
	?>
	<script type="text/javascript">
			toast // alert lu
	</script>

<?php
	}else{
		$query_simpan="UPDATE tb_mutasi SET validasi='DITOLAK', tgl_acc='$tglacc WHERE id_mutasi='$idm'";
		mysqli_query($koneksi,$query_simpan);
	}

	
	// $validasi = $_POST['validasi'];
	// $idm = $_POST['id_mutasi'];
	// $note = $_POST['note'];

	// $tgl = date('Y-m-d');	//menangkap post tgl pinjam
	// 	$sql_simpan = 	"UPDATE tb_mutasi SET validasi='$validasi', note='$note'
	// 					where id_mutasi='$idm'";
	// 		$query_simpan = mysqli_query($koneksi, $sql_simpan);
	// 		// echo $sql_simpan;
	// 		// echo $query_simpan;

		if ($query_simpan) {
			//update stok
			
			?>
			<script>
				Swal.fire({title: 'Validasi Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
				}).then((result) => {
					if (result.value) {
						window.location = 'index.php?page=data_mutasi';
					}
				})
			</script>
		<?php
		} else {
		?>
			<script>
				Swal.fire({title: 'Validasi Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
				}).then((result) => {
					if (result.value) {
						window.location = 'index.php?page=data_mutasi';
					}
				})
			</script>
	  <?php
		}
}
/*

		$get_current_stock = "SELECT * FROM tb_barang WHERE kode_barang='" . $_POST["kode_barang"] . "'";
		$query_get_stock = mysqli_query($koneksi, $get_current_stock);
		$current_stock = mysqli_fetch_array($query_get_stock)[2];
		$current_stock++;
		//update stok
		$update_stock = "UPDATE tb_barang SET stok='" . $current_stock . "' WHERE kode_barang='" . $_POST["kode_barang"] . "'";
		mysqli_query($koneksi, $update_stock);
        mysqli_close($koneksi);
		
*/


// if ($query_simpan) {
// }
// ?>