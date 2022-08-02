<?php

if (isset($_GET['kode'])) {
	$sql_cek = "SELECT * FROM tb_peminjaman WHERE id_peminjaman='" . $_GET['kode'] . "'";
	$query_cek = mysqli_query($koneksi, $sql_cek);
	$data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
?>

<section class="content-header">
	<h1>
		Peminjaman
		<small>Barang</small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="index.php">
				<i class="fa fa-home"></i>
				<b>Website Pengelolaan Alat Praktek SMKN 2 Banjarbaru</b>
			</a>
		</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title">Tambah Peminjaman</h3>
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
					<div class="box-body">
						<div class="form-group">
							<label>ID Peminjaman</label>
							<input type='text' class="form-control" name="id_peminjaman" value="<?php echo $data_cek['id_peminjaman']; ?>" readonly />
						</div>
						<div class="form-group">
							<label>Nama Peminjam</label>
							<?php
							// ambil data dari database
							$query = "select p.id_peminjaman, s.id_siswa, s.nisn, s.nama_siswa from tb_peminjaman p inner join tb_siswa s on p.id_siswa=s.id_siswa where p.id_peminjaman='" . $_GET['kode'] . "'";
							$hasil = mysqli_query($koneksi, $query);
							while ($row = mysqli_fetch_array($hasil)) {
							?>
								<input type='text' class="form-control" name="id_siswa" value="<?php echo $row['nama_siswa']; ?>" readonly />
							<?php
							}
							?>
						</div>

						<div class="form-group">
							<label>Barang</label>
							<?php
							// ambil data dari database
							$query = "select p.id_peminjaman, b.id_barang, b.kode_barang, b.nama_barang  from tb_peminjaman p inner join tb_barang b on p.id_barang=b.id_barang where p.id_peminjaman='" . $_GET['kode'] . "'";
							$hasil = mysqli_query($koneksi, $query);
							while ($row = mysqli_fetch_array($hasil)) {
							?>
								<input type='text' class="form-control" name="id_barang" value="<?php echo $row['nama_barang']; ?>" readonly />
							<?php
							}
							?>
						</div>

						<div class="form-group">
							<label>Jumlah</label>
							<?php
							$query = "SELECT * FROM tb_peminjaman WHERE id_peminjaman='" . $_GET['kode'] . "'";
							$hasil = mysqli_query($koneksi, $query);
							while ($row = mysqli_fetch_array($hasil)) {
							?>
								<input type='text' class="form-control" name="jumlah" value="<?php echo $row['jumlah']; ?>" readonly />
							<?php
							}
							?>
						</div>


						<div class="form-group">
							<label>Guru Pengajar</label>
							<?php
							// ambil data dari database
							$query = "select p.id_peminjaman, g.id_guru, g.nama_guru from tb_peminjaman p inner join tb_guru g on p.id_guru=g.id_guru where p.id_peminjaman='" . $_GET['kode'] . "'";
							$hasil = mysqli_query($koneksi, $query);
							while ($row = mysqli_fetch_array($hasil)) {
							?>
								<input type='text' class="form-control" name="id_guru" value="<?php echo $row['nama_guru']; ?>" readonly />
							<?php
							}
							?>
						</div>

						<div class="form-group">
							<label>Status</label>
							<select name="status" id="status" class="form-control select2" style="width: 100%;">
								<option value="">-- Ubah Status --</option>
								<option value="KEM">Sudah Kembali</option>
							</select>
						</div>

						<div class="form-group">
							<label>Tgl Kembali</label>
							<input type="date" name="tgl_kembali" id="tgl_kembali" element.value="<?= date('m/d/Y');?>" class="form-control" />
						</div>

						<div class="form-group">
							<label>Foto Peminjam</label>
							<input type="file" name="foto" id="foto">
						</div>

					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
						<a href="?page=data_sirkul" class="btn btn-warning">Batal</a>
					</div>
				</form>
			</div>
			<!-- /.box -->
		</div>
	</div>
</section>

<?php

if (isset($_POST['Simpan'])) {
	if (isset($_FILES['foto']['tmp_name'])) {
		$image = addslashes(file_get_contents($_FILES['foto']['tmp_name']));

		//menangkap post tgl pinjam
		$tgl_k = $_POST['tgl_kembali'];
		$jumlah = $_GET['jumlah'];
		$selSto = mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE id_barang='" . $_POST['id_barang'] . "'");
		$sto    = mysqli_fetch_array($selSto);
		$stok    = $sto['stok'];
		//menghitung sisa stok
		$sisa    = $stok + $jumlah;
		$sql_simpan = "INSERT INTO tb_peminjaman (id_siswa,id_barang,jumlah,id_guru,tgl_kembali,foto,status) VALUES (
         '" . $_POST['id_siswa'] . "',
		  '" . $_POST['id_barang'] . "',
          '" . $_POST['jumlah'] . "',
          '" . $_POST['id_guru'] . "',
          '" . $_POST['tgl_kembali'] . "',
		  '".$image."',
          '" . $_POST['status'] . "')";
		$query_simpan = mysqli_query($koneksi, $sql_simpan);
		if ($query_simpan) {
			//update stok
			$upstok = mysqli_query($koneksi, "UPDATE tb_barang SET stok='$sisa' WHERE kode_barang='" . $_POST["kode_barang"] . "'");
			echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=peminjaman';
          }
      })</script>";
		} else {
			echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=add_peminjaman';
          }
      })</script>";
		}
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