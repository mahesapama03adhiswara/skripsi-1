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
							<select name="nip" id="nip" class="form-control select2" style="width: 100%;">
								<option selected="selected">-- Pilih --</option>
								<?php
								$jurusan = $_SESSION['bidang'];
								// ambil data dari database
								$query = "select * from tb_pengguna WHERE bidang ='$bidang'";
								$hasil = mysqli_query($koneksi, $query);
								while ($row = mysqli_fetch_array($hasil)) {
								?>
								<option value="<?php echo $row['nip'] ?>">
									<?php echo $row['jabatan'] ?>
									-
									<?php echo $row['nama_pegawai'] ?>
									
								</option>
								<?php
								}
								?>
							</select>
						</div>

						<div class="form-group">
							<label>Barang</label>
							<select name="kode_klasifikasi" id="kode_klasifikasi" class="form-control select2" style="width: 100%;">
								<option selected="selected">-- Pilih --</option>
								<?php
								$jurusan = $_SESSION['bidang'];
								$query = "select * from tb_arsip WHERE status =inaktif";
								$hasil = mysqli_query($koneksi, $query);
								while ($row = mysqli_fetch_array($hasil)) {
								?>
								<option value="<?php echo $row['Kode_klasifikasi'] ?>">
									<?php echo $row['kode_klasifikasi'] ?>
									-
									<?php echo $row['nama_arsip'] ?>
								</option>
								<?php
								}
								?>
							</select>
						</div>

						<div class="form-group">
							<label>Jumlah</label>
							<input type="text" name="jumlah" id="jumlah" class="form-control" placeholder="Masukan Jumlah Arsip Yang Dipinjam"/>
						</div>

						<div class="form-group">
							<label>Tgl Pinjam</label>
							<input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control" />
						</div>

						<div class="form-group">
							<label>Status Pengajuan</label>
							<input type="text" name="status" id="status" class="form-control" readonly/>
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
		$jumlah=$_POST['jumlah'];
		$selSto =mysqli_query($koneksi, "SELECT * FROM tb_arsip WHERE id_arsip='" . $_POST['id_arsip'] . "'");
		$sto    =mysqli_fetch_array($selSto);
		$stok    =$stok['stok'];
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
			$sql_simpan = "INSERT INTO tb_peminjaman (id_peminjaman,kode_klasifikasi,nip, jumlah, tgl_pinjam, status) VALUES (
				'".$_POST['id_peminjaman']."',
				 '".$_POST['kode_klasifikasi']."',
				 '".$_POST['nip']."',
				 '".$_POST['jumlah']."',
				 '".$_POST['status']."',
				 '".$_POST['tgl_pinjam']."')";
				
				 $upstok = mysqli_query($koneksi, "UPDATE tb_arsip SET stok='$sisa' WHERE id_arsip='" .$_POST["id_arsip"]. "'");
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
  