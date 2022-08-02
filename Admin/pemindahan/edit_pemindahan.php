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
					<h3 class="box-title">Ubah Data Pindah Arsip Inaktif</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse">
							<i class="fa fa-minus"></i>
						</button>
						
					</div>
				</div>
				<!-- /.box-header -->
                <!-- <th>No. Laporan</th>
                            <th>Nama Arsip</th>
							<th>Tanggal Pindah </th>
                            <th>Rak</th>
							<th>Tempat</th>
                            <th>Aksi</th> -->
				<!-- form start -->
				<form action="" method="post" enctype="multipart/form-data">
					<div class="box-body">

						<div class="form-group" >
							<label>No. Laporan</label>
							<input type='text' class="form-control" name="nama_bidang" value="<?php echo $data_cek['no_laporan']; ?>" readonly>
						</div>

						<div class="form-group">
							<label>Uraian Informasi Arsip</label>
							<input type='text' class="form-control" name="ket" value="<?php echo $data_cek['nama_arsip']; ?>" readonly
							/>
						</div>

                        <div class="form-group">
							<label>Tanggal Pindah</label>
							<input type='date' class="form-control" name="tgl_pindah" value="<?php echo $data_cek['tgl_pindah']; ?>"
							/>
						</div>

                        <div class="form-group">
							<label>Rak</label>
							<input type='text' class="form-control" name="rak" value="<?php echo $data_cek['rak']; ?>"
							/>
						</div>

                        <div class="form-group">
							<label>Tempat</label>
							<input type='text' class="form-control" name="tempat" value="<?php echo $data_cek['tempat']; ?>" readonly
							/>
						</div>

                        <div class="form-group">
							<label>Note</label>
							<input type='text' class="form-control" name="note_pindah" value="<?php echo $data_cek['note_pindah']; ?>" readonly
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
						<a href="?page=data_pindah" class="btn btn-warning">Batal</a>
					</div>
				</form>
			</div>
			<!-- /.box -->
</section>

<?php

if (isset ($_POST['Ubah'])){
    //mulai proses ubah
	
    $sql_ubah = "UPDATE tb_bidang SET 
		tempat='".$_POST['tempat']."',
        rak='".$_POST['rak']."',
        note_pindah='".$_POST['note_pindah']."',
        tgl_pindah='".$_POST['tgl_pindah']."'
        WHERE id_arsip='".$_POST['id_arsip']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
	

    if ($query_ubah) {
        echo "<script>
        Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data_pindah';
            }
        })</script>";
        }else{
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data_pindah';
            }
        })</script>";
    }
}

