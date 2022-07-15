
<section class="content-header">
	<h1>
		Master Data
		<small>Data Pegawai</small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="index.php">
				<i class="fa fa-home"></i>
				<b>Data Pegawai BPKP Provinsi Kalsel</b>
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
					<h3 class="box-title">Tambah Pegawai</h3>
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
							<label>NIP</label>
							<input type="text" name="nip" id="nip" class="form-control">
						</div>

						<div class="form-group">
							<label>Nama Pegawai</label>
							<input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" placeholder="Nama">
						</div>

						<div class="form-group">
							<label>Jenis Kelamin</label>
							<select name="jenkel" id="jenkel" class="form-control" required>
								<option>-- Pilih --</option>
								<option>Pria</option>
								<option>Wanita</option>
							</select>
						</div>

						<div class="form-group">
							<label>Level</label>
							<select name="level" id="level" class="form-control" required>
								<option>-- Pilih --</option>
								<option>Admin</option>
								<option>Pegawai</option>
							</select>
						</div>

						<div class="form-group">
							<label>Bidang</label>
							<input type="text" name="mapel" id="mapel" class="form-control" placeholder="Mata Pelajaran">
						</div>

						<div class="form-group">
							<label>Email</label>
							<input type="text" name="email" id="email" class="form-control" placeholder="Email">
						</div>

						<div class="form-group">
							<label>No HP</label>
							<input type="number" name="no_hp" id="no_hp" class="form-control" placeholder="No HP">
						</div>

						<div class="form-group">
							<label>Alamat</label>
							<input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat">
						</div>

						<div class="form-group">
							<label>Password</label>
							<input type="text" name="password" id="password" class="form-control" placeholder="">
						</div>

					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
						<a href="?page=MyApp/data_pegawai" class="btn btn-warning">Batal</a>
					</div>
				</form>
			</div>
			<!-- /.box -->
</section>

<?php

    if (isset ($_POST['Simpan'])){
    
        $sql_simpan = "INSERT INTO tb_pengguna (nip,level,nama_pegawai,jenkel,bidang,email,alamat,password,no_hp) VALUES (
           '".$_POST['nip']."',
		   '".$_POST['level']."',
          '".$_POST['nama_pegawai']."',
          '".$_POST['jenkel']."',
          '".$_POST['mapel']."',
          '".$_POST['email']."',
		  '".$_POST['alamat']."',
		  '".$_POST['password']."',
          '".$_POST['no_hp']."')";
		  
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

    if ($query_simpan){

      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=MyApp/data_pegawai';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=MyApp/add_pegawai';
          }
      })</script>";
    }
  }
    
