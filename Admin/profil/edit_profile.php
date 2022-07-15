<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_pengguna WHERE nip='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

<section class="content-header">
	<h1>
		Master Data
		<small>Data Profil</small>
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
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title">Ubah Guru</h3>
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
							<input type='hidden' class="form-control" name="nip" value="<?php echo $data_cek['nip']; ?>"
							 readonly/>
						</div>

						<div class="form-group">
							<label>Nama Pengguna</label>
							<input class="form-control" name="nama_pegawai" value="<?php echo $data_cek['nama_pegawai']; ?>"
							/>
						</div>

						<div class="form-group">
							<label>NIP</label>
							<input class="form-control" name="nip" readonly value="<?php echo $data_cek['nip']; ?>"
							/>
						</div>

						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password" id="password" value="<?php echo $data_cek['password']; ?>"
							/>
							<input id="mybutton" onclick="change()" type="checkbox" class="form-checkbox"> Lihat Password
						</div>

						<div class="form-group">
							<label>Foto</label>
							<input type="file" name="foto" id="foto">
						</div>
					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<input type="submit" name="Ubah" value="Ubah" class="btn btn-success">
						<a href="?page=MyApp/profil" class="btn btn-warning">Batal</a>
					</div>
				</form>
			</div>
			<!-- /.box -->
</section>

<?php

if (isset ($_POST['Ubah'])){
    //mulai proses ubah
	$dir = "./dist/img/";
	$nama_file = $_FILES['foto']['name'];
	$nama_file_tmp = $_FILES['foto']['tmp_name'];
	$ext = explode(".", $nama_file);
	$gantiNama = round(microtime(true)) . "." . end($ext);
	$dirUpload = "./dist/img/";
	move_uploaded_file($nama_file_tmp, $dir . $gantiNama);
	$query;
    $sql_ubah = "UPDATE tb_pengguna SET
        nama_pegawai='".$_POST['nama_pegawai']."',
        nip='".$_POST['nip']."',
        password='".md5($_POST['password'])."',
        foto='".$gantiNama."'
        WHERE nip='".$_POST['nip']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);

    if ($query_ubah) {
        echo "<script>
        Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/profil';
            }
        })</script>";
        }else{
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/profil';
            }
        })</script>";
    }
}

