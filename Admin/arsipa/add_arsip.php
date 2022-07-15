<section class="content-header">
	<h1>
		Master Data
		<small>Data Arsip Aktif</small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="index.php">
				<i class="fa fa-home"></i>
				<b>Website Pengelolaan Arsip Aktif/b>
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
					<h3 class="box-title">Tambah Arsip</h3>
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
							<label>Kode Klasifikasi</label>
							<input type="text" name="kode_klasifikasi" id="kode_klasifikasi" class="form-control" placeholder="Kode Klasifikasi">
						</div>

						<div class="form-group">
							<label>No. ST</label>
							<input type="text" name="no_st" id="no_st" class="form-control" placeholder="No. ST">
						</div>

						<div class="form-group">
							<label>No. Laporan</label>
							<input type="text" name="no_laporan" id="no_laporan" class="form-control" placeholder="No. Laporan">
						</div>

						<div class="form-group">
							<label>Uraian Informasi Arsip</label>
							<input type="text" name="nama_arsip" id="nama_arsip" class="form-control" placeholder="Uraian Informasi Arsip">
						</div>

						<div class="form-group">
							<label>Bidang</label>
							<select name="bidang" id="bidang" class="form-control select2" style="width: 100%;">
							<option value="">-- Pilih --</option>
							<option value="TU">TU</option>
							<option value="IPP">IPP</option>
							<option value="AN">AN</option>
							<option value="Investigasi">Investigasi</option>
							<option value="P3A">P3A</option>
							<option value="APD">APD</option>
							</select>
						</div>

						<div class="form-group">
							<label>Tahun</label>
							<input type="number" name="tahun" id="tahun" class="form-control" placeholder="Tahun Arsip">
						</div>

						<div class="form-group">
							<label>Tingkat Keaslian</label>
							<select name="tingkat_keaslian" id="tingkat_keaslian" class="form-control select2" style="width: 100%;">
							<option value="">-- Pilih --</option>
							<option value="Asli">ASLI</option>
							<option value="Copy">COPY</option>
							<option value="Asli dan Copy">Asli dan Copy</option>
							</select>
						</div>

						<div class="form-group">
							<label>Jumlah</label>
							<input type="text" name="jumlah" id="jumlah" class="form-control" placeholder="Jumlah Arsip">
						</div>

						<div class="form-group">
							<label>Rak</label>
							<input type="text" name="rak" id="rak" class="form-control" placeholder="Rak Arsip">
						</div>

						<div class="form-group">
							<label>Box</label>
							<input type="text" name="box" id="box" class="form-control" placeholder="Box Arsip">
						</div>

						<div class="form-group">
							<label>Foto</label>
							<input type="file" name="foto" id="foto">
						</div>

						<div class="form-group">
							<label>Jenis File</label>
							<select name="jenis" id="jenis" class="form-control select2" style="width: 100%;">
							<option value="">-- Pilih --</option>
							<option value="Aktif">Aktif</option>
							<option value="Inaktif">Inaktif</option>
							</select>
						</div>
						
					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
						<a href="?page=MyApp/data_arsip_aktif" class="btn btn-warning">Batal</a>
					</div>
				</form>
			</div>
			<!-- /.box -->
</section>

<?php

    if (isset ($_POST['Simpan'])){
		
		// $image = addslashes(file_get_contents($_FILES['gambar']['tmp_name']));
		$dir = "./admin/arsipa/images/";
		$nama_file = $_FILES['foto']['name'];
		$nama_file_tmp = $_FILES['foto']['tmp_name'];
		$ext = explode(".", $nama_file);
		$gantiNama = round(microtime(true)) . "." . end($ext);
		$dirUpload = "./admin/arsipa/images/";
		move_uploaded_file($nama_file_tmp, $dir . $gantiNama);
		$query;
		
		$$bidang = $_SESSION['bidang'];
        $sql_simpan = "INSERT INTO tb_arsip (kode_klasifikasi,no_st,no_laporan,nama_arsip,bidang,tahun,tingkat_keaslian,jummlah,rak,box,jenis) VALUES (
           '".$_POST['kode_klasifikasi']."',	
          '".$_POST['no_st']."',
          '".$_POST['no_laporan']."',
          '".$_POST['nama_arsip']."',
          '".$_POST['bidang']."',
		  '".$_POST['tahun']."',
		  '".$_POST['tingkat_keaslian']."',
		  '".$_POST['jumlah']."',
		  '".$_POST['rak']."',
		  '".$_POST['box']."',
		  '".$_POST['jenis']."',
          '".$gantiNama."',
          '".$bidang."','Arsip')";
		
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);
		
    if ($query_simpan){

      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=MyApp/data_arsip_aktif';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=MyApp/add_arsip_aktif';
          }
      })</script>";
    }
  }
    
