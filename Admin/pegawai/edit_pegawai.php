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
		<small>Data Pegawai</small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="index.php">
				<i class="fa fa-home"></i>
				<b>Website Data Pegawai BPKP Prov. Kalsel</b>
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
					<h3 class="box-title">Ubah Profil</h3>
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
							<input type='text' class="form-control" name="nip" value="<?php echo $data_cek['nip']; ?>"
							 readonly/>
						</div>

						<div class="form-group">
							<label>Nama Pegawai</label>
							<input type='text' class="form-control" name="nama_pegawai" value="<?php echo $data_cek['nama_pegawai']; ?>"
							/>
						</div>

						<div class="form-group">
							<label>Jenis Kelamin</label>
							<select name="jenkel" id="jenkel" class="form-control" required>
								<option value="">-- Pilih --</option>
								<?php
                                //cek data yg dipilih sebelumnya
                                if ($data_cek['jenkel'] == "Pria") echo "<option value='Pria' selected>Pria</option>";
                                else echo "<option value='Pria'>Pria</option>";
                                
                                if ($data_cek['jenkel'] == "Wanita") echo "<option value='Wanita' selected>Wanita</option>";
                                else echo "<option value='Wanita'>Wanita</option>";
                            ?>
							</select>
						</div>

						<div class="form-group">
							<label>Bidang</label>
							<input type='text' class="form-control" name="bidang" value="<?php echo $data_cek['bidang']; ?>"
							/>
						</div>

						<div class="form-group">
							<label>Email</label>
							<input type='text' class="form-control" name="email" value="<?php echo $data_cek['email']; ?>"
							/>
						</div>

						<div class="form-group">
							<label>No HP</label>
							<input type='number' class="form-control" name="no_hp" value="<?php echo $data_cek['no_hp']; ?>"
							/>
						</div>

						<div class="form-group">
							<label>Alamat</label>
							<input type='text' class="form-control" name="alamat" value="<?php echo $data_cek['alamat']; ?>"
							/>
						</div>

						<div class="form-group">
							<label>Jabatan</label>
							<input type='text' class="form-control" name="alamat" value="<?php echo $data_cek['jabatan']; ?>"
							/>
						</div>
					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<input type="submit" name="Ubah" value="Ubah" class="btn btn-success">
						<a href="?page=MyApp/data_pegawai" class="btn btn-warning">Batal</a>
					</div>
				</form>
			</div>
			<!-- /.box -->
</section>

<?php

if (isset ($_POST['Ubah'])){
    //mulai proses ubah
    $sql_ubah = "UPDATE tb_pengguna SET
		nama_pegawai='".$_POST['nama_pegawai']."',
		jenkel='".$_POST['jenkel']."',
		bidang='".$_POST['bidang']."',
		email='".$_POST['email']."',
        no_hp='".$_POST['no_hp']."'
		alamat='".$_POST['alamat']."'
        WHERE nip='".$_POST['nip']."'";

    $query_ubah = mysqli_query($koneksi, $sql_ubah);

    if ($query_ubah) {
        echo "<script>
        Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/data_pegawai';
            }
        })</script>";
        }else{
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/data_pegawai';
            }
        })</script>";
    }
}

?>
<script type="text/javascript">
        function change()
        {
        var x = document.getElementById('pass').type;

        if (x == 'password')
        {
            document.getElementById('pass').type = 'text';
            document.getElementById('mybutton').innerHTML;
        }
        else
        {
            document.getElementById('pass').type = 'password';
            document.getElementById('mybutton').innerHTML;
        }
        }
    </script>
	