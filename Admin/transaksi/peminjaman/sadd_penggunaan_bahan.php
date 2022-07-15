<section class="content-header">
	<h1>
		Pemakaian 
		<small>Bahan</small>
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
					<h3 class="box-title">Tambah Penggunaan</h3>
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
								$query = "select * from tb_siswa WHERE jurusan='$jurusan' order by kelas, nama_siswa ASC";
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
								// ambil data dari database
								$query = "select * from tb_barang WHERE kategori = 'alat' AND kepemilikan='$jurusan'";
								$hasil = mysqli_query($koneksi, $query);
								while ($row = mysqli_fetch_array($hasil)) {
								?>
								<option value="<?php echo $row['kode_barang'] ?>">
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
								$query = "select * from tb_guru WHERE jurusan='$jurusan'";
								$hasil = mysqli_query($koneksi, $query);
								while ($row = mysqli_fetch_array($hasil)) {
								?>
								<option value="<?php echo $row['nik'] ?>">
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

		//menangkap post tgl pinjam
		$tgl_p=$_POST['tgl_pinjam'];
		
			$sql_simpan = "INSERT INTO tb_peminjaman (id_peminjaman,id_siswa,id_barang, jumlah, id_guru, tgl_pinjam, kepemilikan, status) VALUES (
				'".$_POST['id_peminjaman']."',
				 '".$_POST['id_siswa']."',
				 '".$_POST['id_barang']."',
				 '".$_POST['jumlah']."',
				 '".$_POST['id_guru']."',
				 '".$_POST['tgl_pinjam']."',
				 '".$jurusan."','PIN');";

			$query_simpan = mysqli_query($koneksi, $sql_simpan);
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


    if ($query_simpan){

      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=peminjaman';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=add_peminjaman';
          }
      })</script>";
    }
  