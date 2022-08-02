<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_arsip WHERE id_arsip='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

<section class="content-header">
	<h1>
		Master Data
		<small>Data Arsip Inaktif</small>
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
					<h3 class="box-title">Ubah Arsip Inaktif</h3>
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
							<input type="text"' class="form-control" name="kode_klasifikasi" value="<?php echo $data_cek['kode_klasifikasi']; ?>"
							/>
						</div>

						<div class="form-group">
							<label>No. ST</label>
							<input type="text" class="form-control" name="no_st" value="<?php echo $data_cek['no_st']; ?>"
							/>
						</div>

						<div class="form-group">
							<label>No. laporan</label>
							<input type="text" class="form-control" name="no_laporan" value="<?php echo $data_cek['no_laporan']; ?>"
							/>
						</div>

						<div class="form-group">
							<label>Uraian Informasi Arsip</label>
							<input type="text" class="form-control" name="nama_arsip" value="<?php echo $data_cek['nama_arsip']; ?>"
							/>
						</div>

						<div class="form-group"> 
							<label> Bidang </label>
						<select name="bidang" id="bidang" class="form-control select2" style="width: 100%;">
								<option selected="selected">-- Pilih --</option>
								<?php
								
								// ambil data dari database
								$query = "select * from tb_bidang";
								$hasil = mysqli_query($koneksi, $query);
								while ($row = mysqli_fetch_array($hasil)) {
								?>
								<option value="<?php echo $row['id'] ?>">
									<?php echo $row['nama_bidang'] ?>
								</option>
								<?php
								}
								?>
							</select>
						</div>

						<div class="form-group">
							<label>Tahun </label>
							<input type="number" class="form-control" name="tahun" value="<?php echo $data_cek ['tahun']; ?>"
							/>
						</div>

						<div class="form-group">
							<label>Tingkat Keaslian </label>
							<select name="tingkat_keaslian" id="tingkat_keaslian" class="form-control select2" style="width: 100%;">
							<option value=""><?php echo $data_cek['tingkat_keaslian']; ?></option>
							<option value="COPY">COPY</option>
							<option value="ASLI">ASlI</option>
							<option value="Asli dan Copy">Asli dan Copy</option>
							</select>
						</div>

						<div class="form-group">
							<label>jumlah </label>
							<input type="number" class="form-control" name="jumlah" value="<?php echo $data_cek['jumlah']; ?>"
							/>
						</div>

						<div class="form-group">
							<label>Rak </label>
							<input type="text" class="form-control" name="rak" value="<?php echo $data_cek ['rak']; ?>"
							/>
						</div>

						<div class="form-group">
							<label>Box </label>
							<input type="text" class="form-control" name="box" value="<?php echo $data_cek ['box']; ?>"
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
	if(isset($_FILES['gambar']['tmp_name'])){
		$image = addslashes(file_get_contents($_FILES['gambar']['tmp_name']));
    $sql_ubah = "UPDATE tb_arsip SET
		kode_klasifikasi='".$_POST['kode_klasifikasi']."',
		no_st='".$_POST['no_st']."',
		no_laporan='".$_POST['no_laporan']."',
		nama_arsip='".$_POST['nama_arsip']."',
		bidang='".$_POST['bidang']."',
		tingkat_keaslian='".$_POST['tingkat_keaslian']."',
		jumlah='".$_POST['jumlah']."',
		rak='".$_POST['rak']."',
		box='".$_POST['box']."',
		foto='".$image."'
        WHERE id_arsip='".$_GET['kode']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
	}

    if ($query_ubah) {
        echo "<script>
        Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/data_arsip_inaktif';
            }
        })</script>";
        }else{
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/data_arsip_inaktif';
            }
        })</script>";
    }
}

