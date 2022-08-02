<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_retensi WHERE kode_klasifikasi='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

<section class="content-header">
	<h1>
		Master Data
		<small>Data Retensi</small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="index.php">
				<i class="fa fa-home"></i>
				<b>Data Arsip Inaktif BPKP Provinsi Kalsel</b>
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
					<h3 class="box-title">Ubah Data Retensi</h3>
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

						<div class="form-group" >
							<label>Kode Klasifikasi</label>
							<input type='text' class="form-control" name="kode_klasifikasi" value="<?php echo $data_cek['kode_klasifikasi']; ?>" readonly
							/>
						</div>

						<div class="form-group">
							<label>Tanggal Mutasi</label>
							<input type='date' class="form-control" name="tgl_mutasi" value="<?php echo $data_cek['tgl_mutasi']; ?>"
							/>
						</div>

						<div class="form-group">
							<label>Tanggal Pemusnahan</label>
							<input type='date' class="form-control" name="tgl_pemusnahan" value="<?php echo $data_cek['tgl_pemusnahan']; ?>"
							/>
						</div>

						

						<!-- <div class="form-group">
							<label>Foto</label>
							<input type="file" name="gambar" id="gambar">
						</div> -->
					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<input type="submit" name="Ubah" value="Ubah" class="btn btn-success">
						<a href="?page=MyApp/data_arsip_inaktif" class="btn btn-warning">Batal</a>
					</div>
				</form>
			</div>
			<!-- /.box -->
</section>

<?php

if (isset ($_POST['Ubah'])){
    //mulai proses ubah
	
    $sql_ubah = "UPDATE tb_retensi SET 
		kode_klasifikasi='".$_POST['kode_klasifikasi']."',
		tgl_mutasi='".$_POST['tgl_mutasi']."',
		tgl_pemusnahan='".$_POST['tgl_pemusnahan']."'
        WHERE kode_klasifikasi='".$_GET['kode']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
	

    if ($query_ubah) {
        echo "<script>
        Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data_retensi';
            }
        })</script>";
        }else{
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data_retensi';
            }
        })</script>";
    }
}

