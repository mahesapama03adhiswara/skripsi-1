
<section class="content-header">
	<h1>
		Tambah
		<small>Data Retensi</small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="index.php">
				<i class="fa fa-home"></i>
				<b>Data Bidang BPKP Provinsi Kalsel</b>
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
									<h3 class="box-title">Tambah Data Retensi</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse">
											<i class="fa fa-minus"></i>
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
												<label>No. Klasifikasi</label>
												<input type="text" name="no_klasifikasi" id="no_klasifikasi" class="form-control" placeholder="Nama">
												</div>
											</div>

                                            <div class="col-md-6 col-12">
												<div class="form-group">
												<label>Tanggal Penciptaan</label>
												<input type="date" name="tgl_cipta" id="tgl_cipta" class="form-control" placeholder="Nama">
												</div>
											</div>

                                            <div class="col-md-6 col-12">
												<div class="form-group">
												<label>Tanggal Mutasi</label>
												<input type="date" name="tgl_mutasi" id="tgl_mutasi" class="form-control" placeholder="Nama">
												</div>
											</div>

                                            <div class="col-md-6 col-12">
												<div class="form-group">
												<label>Tanggal Pemusnahan</label>
												<input type="date" name="tgl_pemusnahan" id="tgl_pemusnahan" class="form-control" placeholder="Nama">
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
		
        $sql_simpan = "INSERT INTO tb_retensi (no_klasifikasi,tgl_cipta,tgl_mutasi,tgl_pemusnahan) VALUES (
           '".$_POST['no_klasifikasi']."',
		   '".$_POST['tgl_cipta']."',
           '".$_POST['tgl_mutasi']."',
           '".$_POST['tgl_pemusnahan']."'
		  )";
		  
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

    if ($query_simpan){

      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=data_retensi';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=data_retensi';
          }
      })</script>";
    }
  }
    
