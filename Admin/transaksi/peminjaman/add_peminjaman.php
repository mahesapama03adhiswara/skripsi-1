<section class="content-header">
	<h1>
		Peminjaman
		<small>Alat</small>
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
							<label>Nama Peminjam</label>
							<select name="id_siswa" id="id_siswa" class="form-control select2" style="width: 100%;">
								<option selected="selected">-- Pilih --</option>
								<?php
								$jurusan = $_SESSION['jurusan'];
								// ambil data dari database
								$query = "select * from tb_siswa WHERE jurusan ='$jurusan' order by kelas, nama_siswa  ASC";
								$hasil = mysqli_query($koneksi, $query);
								while ($row = mysqli_fetch_array($hasil)) {
								?>
								<option value="<?php echo $row['id_siswa'] ?>">
									<?php echo $row['kelas'] ?>
									-
									<?php echo $row['nama_siswa'] ?>
									
								</option>
								<?php
								}
								?>
							</select>
						</div>

						<div class="form-group">
							<label>Barang</label>
							<select name="id_barang" id="id_barang" class="form-control select2" style="width: 100%;">
								<option selected="selected">-- Pilih --</option>
								<?php
								$jurusan = $_SESSION['jurusan'];
								$query = "select * from tb_barang WHERE kepemilikan = '$jurusan' AND kategori= 'Alat'";
								$hasil = mysqli_query($koneksi, $query);
								while ($row = mysqli_fetch_array($hasil)) {
								?>
								<option value="<?php echo $row['id_barang'] ?>">
									<?php echo $row['kode_barang'] ?>
									-
									<?php echo $row['nama_barang'] ?>
								</option>
								<?php
								}
								?>
							</select>
						</div>

						<div class="form-group">
							<label>Jumlah</label>
							<input type="text" name="jumlah" id="jumlah" class="form-control" placeholder="Masukan Jumlah Barang Yang Dipinjam"/>
						</div>


						<div class="form-group">
							<label>Guru Pengajar</label>
							<select name="id_guru" id="id_guru" class="form-control select2" style="width: 100%;">
								<option selected="selected">-- Pilih --</option>
								<?php
								// ambil data dari database
								$jurusan = $_SESSION['jurusan'];
								$query = "select * from tb_guru WHERE jurusan ='$jurusan' order by nama_guru ASC";
								$hasil = mysqli_query($koneksi, $query);
								while ($row = mysqli_fetch_array($hasil)) {
								?>
								<option value="<?php echo $row['id_guru'] ?>">
									<?php echo $row['nik'] ?>
									-
									<?php echo $row['nama_guru'] ?>
								</option>
								<?php
								}
								?>
							</select>
						</div>

						<div class="form-group">
							<label>Tgl Pinjam</label>
							<input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control" />
						</div>

						<div class="form-group">
							<label>Foto Peminjam</label>
							<input type="file" name="foto" id="foto">
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

<?php

    if (isset ($_POST['Simpan'])){
		if(isset($_FILES['foto']['tmp_name'])){
			$image = addslashes(file_get_contents($_FILES['gambar']['tmp_name']));

		//menangkap post tgl pinjam
		$tgl_p=$_POST['tgl_pinjam'];
		$jumlah=$_POST['jumlah'];
		$selSto =mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE id_barang='" . $_POST['id_barang'] . "'");
		$sto    =mysqli_fetch_array($selSto);
		$stok    =$sto['stok'];
		//menghitung sisa stok
		$sisa    = $stok - $jumlah;

		if ($stok < $jumlah) {
			?>
			<script language="JavaScript">
				alert('Oops! Jumlah Barang Yang Dipinjam Kurang Dari Stok');
				document.location='?page=add_peminjaman';
			</script>
			<?php
		}else {	
			$sql_simpan = "INSERT INTO tb_peminjaman (id_peminjaman,id_siswa,id_barang, jumlah, id_guru, tgl_pinjam,foto,kepemilikan,kategori) VALUES (
				'".$_POST['id_peminjaman']."',
				 '".$_POST['id_siswa']."',
				 '".$_POST['id_barang']."',
				 '".$_POST['jumlah']."',
				 '".$_POST['id_guru']."',
				 '".$_POST['tgl_pinjam']."',
				 '".$image."',
				 '".$jurusan."','Alat')";
				 $upstok = mysqli_query($koneksi, "UPDATE tb_barang SET stok='$sisa' WHERE id_barang='" .$_POST["id_barang"]. "'");
			$query_simpan = mysqli_query($koneksi, $sql_simpan);
		}
	}

        


    if ($query_simpan){

      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=data_peminjaman';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=add_peminjamna';
          }
      })</script>";
    }
  }