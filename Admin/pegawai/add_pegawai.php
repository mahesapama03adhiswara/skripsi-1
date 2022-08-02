
<section class="content-header">
	<h1>
		Tambah
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

<section id="multiple-column-form">
	<div class="row match-height">
		<div class="col-12">
			<section class="content">
				<!-- // Basic multiple Column Form section start -->
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
									<div class="row">
										<div class="box-body">


											<div class="col-md-6 col-12">
												<div class="form-group">
													<label>NIP</label>
													<input type="text" name="nip" id="nip" class="form-control" required>
												</div>
											</div>
											
											<div class="col-md-6 col-12">
												<div class="form-group">
												<label>Nama Pegawai</label>
												<input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" placeholder="Nama" required>
												</div>
											</div>
											
											<div class="col-md-6 col-12">
												<div class="form-group">
													<label>Jenis Kelamin</label>
													<select name="jenkel" id="jenkel" class="form-control" required>
														<option>-- Pilih --</option>
														<option>Pria</option>
														<option>Wanita</option>
													</select>
												</div>
											</div>
											
											<div class="col-md-6 col-12">
												<div class="form-group">
													<label>Level</label>
													<select name="level" id="level" class="form-control" required>
														<option>-- Pilih --</option>
														<option>Admin</option>
														<option>Pegawai</option>
													</select>
												</div>
											</div>
											
											<div class="col-md-6 col-12">
												<div class="form-group">
												<label>Bidang</label>
												<select name="bidang" id="bidang" class="form-control select2" style="width: 100%;" required>
													<option selected="selected">-- Pilih --</option>
													<?php
													// ambil data dari database
													$query = "select * from tb_bidang";
													$hasil = mysqli_query($koneksi, $query);
													while ($row = mysqli_fetch_array($hasil)) {
													?>
													<option value="<?php echo $row['id_bidang'] ?>">
														<?php echo $row['nama_bidang'] ?>
													</option>
													<?php
													}
													?>
												</select>
												</div>
											</div>

											<div class="col-md-6 col-12">
												<div class="form-group">
												<label>Jabatan</label>
												<select name="jabatan" id="jabatan" class="form-control select2" style="width: 100%;">
													<option selected="selected" required>-- Pilih --</option>
													<?php
													
													// ambil data dari database
													$query = "select * from tb_jabatan";
													$hasil = mysqli_query($koneksi, $query);
													while ($row = mysqli_fetch_array($hasil)) {
													?>
													<option value="<?php echo $row['id_jabatan'] ?>">
														<?php echo $row['nama_jabatan'] ?>
													</option>
													<?php
													}
													?>
												
												</select>
												</div>
											</div>
											
											<div class="col-md-6 col-12">
												<div class="form-group">
													<label>Email</label>
													<input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
												</div>
											</div>
											
											<div class="col-md-6 col-12">
												<div class="form-group">
													<label>No HP</label>
													<input type="number" name="no_hp" id="no_hp" class="form-control" placeholder="No HP" required>
												</div>
											</div>
											
											<div class="col-md-6 col-12">
												<div class="form-group">
													<label>Alamat</label>
													<input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" required>
												</div>
											</div>
											
											<div class="col-md-6 col-12">
												<div class="form-group">
													<label>Password</label>
													<input type="text" name="password" id="password" class="form-control" placeholder="" required>
												</div>
											</div>
											
											<div class="col-md-6 col-12">
													<div class="form-group">
														<label for="photo-you">Photo</label>	
														<small class="text-danger">Jika kosong = untuk menghemat storage, gambar dinonaktifkan dan akan otomatis default.</i></small>	
														<input type="file" name="photo" id="photo" class="form-control"  image-crop-aspect-ratio="1:1">
														<small class="text-muted">Default Perempuan: <a href='https://pngtree.com/so/Vector'>Vector png from pngtree.com/</a>.</i></small>	<br>
														<small class="text-muted">Default Pria: <a href='https://pngtree.com/so/Business'>Business png from pngtree.com/</a>.</i></small>	
													</div>
											</div>

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
		</div>
	</div>
</section>


<?php

    if (isset ($_POST['Simpan'])){
		$jeniskelamin = $_POST['jenkel'];

		$temp = "Admin/pegawai/futu/";
		if (!empty($_FILES['photo']['tmp_name'])) {
			$fileupload     = $_FILES['photo']['tmp_name'];
			$ImageName      = $_FILES['photo']['name'];
			$acak           = rand(11111111, 99999999);
			$ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
			$ImageExt       = str_replace('.','',$ImageExt);
			$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
			$NewImageName   = str_replace(' ', '', $acak.'.'.$ImageExt);
			$photo          = $NewImageName;
			move_uploaded_file($fileupload, $temp.$NewImageName);
		} else {
			if($jeniskelamin=="Wanita"){
				$photo = "—Pngtree—vector female student icon_3787628.png";
			}else{$photo = "—Pngtree—business male icon vector_4187852.png";}
		}
		
		
		$test = "SELECT * FROM tb_pengguna WHERE nip='".$_POST['nip']."'";
		$test_nip = mysqli_query($koneksi, $test);
		$jumlah_nrp = mysqli_num_rows($test_nip);

		if($jumlah_nrp < 1){
        $sql_simpan = "INSERT INTO tb_pengguna (nip,level,nama_pegawai,jenkel,bidang,jabatan,email,alamat,password,no_hp,foto) VALUES (
           '".$_POST['nip']."',
		   '".$_POST['level']."',
          '".$_POST['nama_pegawai']."',
          '$jeniskelamin',
		  '".$_POST['bidang']."',
          '".$_POST['jabatan']."',
          '".$_POST['email']."',
		  '".$_POST['alamat']."',
		  '".$_POST['password']."',
          '".$_POST['no_hp']."',
          '$photo'
		  )";
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

		}else{
			echo "<script>
				Swal.fire({title: 'NIP sudah ada',text: '',icon: 'error',confirmButtonText: 'OK'
				}).then((result) => {
					if (result.value) {
						window.location = 'index.php?page=MyApp/add_pegawai';
					}
				})</script>";
		  }

	// 	  $query_simpan = mysqli_query($koneksi, $sql_simpan);
	// 	  mysqli_close($koneksi);
		  

    // if ($query_simpan){

    //   echo "<script>
    //   Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
    //   }).then((result) => {
    //       if (result.value) {
    //           window.location = 'index.php?page=MyApp/data_pegawai';
    //       }
    //   })</script>";
    //   }else{
    //   echo "<script>
    //   Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
    //   }).then((result) => {
    //       if (result.value) {
    //           window.location = 'index.php?page=MyApp/add_pegawai';
    //       }
    //   })</script>";
    // }
  }
    
