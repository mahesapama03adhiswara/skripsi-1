<?php



    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_peminjaman, tb_arsip, tb_pengguna
		WHERE tb_peminjaman.id_arsip = tb_arsip.id_arsip 
		AND tb_peminjaman.nip = tb_pengguna.nip
		AND id_peminjaman='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }

?>

<section class="content-header">
	<h1>
		Peminjaman
		<small>Arsip Inaktif</small>
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
									<h3 class="box-title">Verifikasi Pinjam Arsip</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse">
											<i class="fa fa-minus"></i>
										</button>
										<button type="button" class="btn btn-box-tool" data-widget="remove">
											<i class="fa fa-remove"></i>
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
													<label>No. Pinjam</label>
													<input type="text" value="<?= $data_cek['id_peminjaman'] ?>" readonly name="id_peminjaman" id="id_peminjaman" class="form-control" placeholder=""/>
												</div>
											</div>
											
											<div class="col-md-6 col-12">
												<div class="form-group">
													<div hidden>
														<input type="text" value="<?= $data_cek['nip']; ?>" name="nip" id="nip" class="form-control" placeholder="" />
													</div>
													<label>Nama Peminjam</label>
													<input type="text" value="<?= $data_cek['nama_pegawai']; ?>" readonly class="form-control" placeholder=""/>
												</div>
											</div>
											
											<div class="col-md-6 col-12">
												<div class="form-group">
													<div hidden>
													<label>id arsip</label>
													<input type="text" name="id_arsip" value="<?= $data_cek['id_arsip']; ?>" readonly class="form-control" placeholder=""/>
													</div>
													<div>
													<label>No. Laporan</label>
													<input type="text" name="no_laporan" value="<?= $data_cek['no_laporan']; ?>" readonly class="form-control" placeholder=""/>
													</div>
													
												</div>
											</div>
											
											<div class="col-md-6 col-12">
												<div class="form-group">
													<label> Nama Arsip Inaktif</label>
													<input type="text" value="<?= $data_cek['nama_arsip']; ?>" readonly class="form-control" placeholder=""/>
												</div>
											</div>
											
											<div class="col-md-6 col-12">
												<div class="form-group">
													<label>Jumlah</label>
													<input type="text" name="jumlah" value="<?= $data_cek['jumlah']; ?>" readonly class="form-control" placeholder=""/>
												</div>
											</div>

											<div class="col-md-6 col-12">
												<div class="form-group">
													<label>Tanggal Kembali</label>
													<input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" />
												</div>
											</div>
											
											<div class="col-md-6 col-12">
												<div class="form-group">
													<label>Note</label>
													<input type="text" name="note" id="note" class="form-control" placeholder=""/>
												</div>
											</div>

											<!-- <div class="col-md-6 col-12" >
												<div class="form-group">
													<label>Status</label>
													<select name="status" id="status" class="form-control" required>
														<option>DIKEMBALIKAN</option>
													</select>
												</div>
											</div> -->

											<!-- <div class="col-md-6 col-12">
												<div class="form-group">
													<label>Status</label>
													<select name="status" id="status" class="form-control" required>
														<option>-- Pilih --</option>
														<option>DITERIMA</option>
														<option>DITOLAK</option>
													</select>
												</div>
											</div> -->
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
	$status='DIKEMBALIKAN';
	$Idp = $_POST['id_peminjaman'];
	$idarsip = $_POST['id_arsip'];
	$note = $_POST['note'];
	$tgl = $_POST['tgl_kembali'];	//menangkap post tgl pinjam

	// $sql_simpan = "UPDATE tb_peminjaman SET status='DIKEMBALIKAN', note='$note', tgl_kembali='$tgl' where id_peminjaman='$Idp'";
	// 		$query_simpan = mysqli_query($koneksi, $sql_simpan);
			// echo $sql_simpan;
			// echo $query_simpan;

	if($status == "DIKEMBALIKAN"){
		$query_simpan="UPDATE tb_peminjaman SET status='DIKEMBALIKAN', note='$note', tgl_kembali='$tgl' where id_peminjaman='$Idp'";
		$query_simpan = mysqli_query($koneksi, $query_simpan);
	
		
		$query_simpan1="UPDATE tb_arsip SET status='TERSEDIA' WHERE id_arsip='$idarsip'";
		mysqli_query($koneksi,$query_simpan1);
		
		
		}else{
			$query_simpan="UPDATE tb_peminjaman SET status='$status', note='$note' where id_peminjaman='$Idp'";
			mysqli_query($koneksi,$query_simpan);
		}

			

		if ($query_simpan) {
			//update stok
			
			?>
			<script>
				Swal.fire({title: 'Update Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
				}).then((result) => {
					if (result.value) {
						window.location = 'index.php?page=peminjaman';
					}
				})
			</script>
		<?php
		} else {
		?>
			<script>
				Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
				}).then((result) => {
					if (result.value) {
						window.location = 'index.php?page=add_peminjaman';
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