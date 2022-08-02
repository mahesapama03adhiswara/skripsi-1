<section class="content-header">
	<h1>
		Tambah
		<small>Data Pindah Arsip Inaktif</small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="index.php">
				<i class="fa fa-home"></i>
				<b>Data Arsip BPKP Provinsi Kalsel</b>
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
									<h3 class="box-title">Tambah Data Pemindahan Arsip </h3>
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
                                                    <label for="Arsip_Aktif">Arsip Inaktif</label>
                                                    <select name="id_arsip" id="id_arsip" class="form-control select2" style="width: 100%;" required>
                                                        <option value="">Pilih ... </option>
                                                        <optgroup label="id_arsip">
                                                        <?php
                                                            //Perintah sql untuk menampilkan semua data pada tabel jurusan
                                                            $sql="SELECT * FROM tb_arsip WHERE jenis='Inaktif' AND tempat='Banjarbaru'";

                                                            $hasil=mysqli_query($koneksi,$sql);
                                                            while ($data = mysqli_fetch_array($hasil)) {

                                                            $kete="";
                                                            if (isset($_POST['id_arsip'])) {
                                                                $id_arsipdipilih = trim($_POST['id_arsip']);

                                                                if ($id_arsipdipilih==$data['id_arsip'])
                                                                {
                                                                    $kete="selected";
                                                                }
                                                            }
                                                            ?>
                                                            <option <?php echo $kete; ?> value="<?php echo $data['id_arsip'];?>">
                                                                <?php echo $data['no_laporan'] ?> -
                                                                <?php echo $data['nama_arsip'] ?>
                                                            </option>
                                                            <?php
                                                                }
                                                        ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
										
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <br>
												<p> </p>	
                                                        <input type="submit" id="btn_hide" class="btn btn-outline-secondary " value="  Pilih  ">
                                                </div>
                                            </div>

                                            <?php
											if (isset($_POST['id_arsip'])) {
												$id_arsipdipilih=trim($_POST['id_arsip']);
												$sql="SELECT * FROM tb_arsip 
                                                WHERE jenis='Inaktif'  AND id_arsip='$id_arsipdipilih'
												";
                                                
                                                $hasil=mysqli_query($koneksi,$sql);
                                                $data = mysqli_fetch_array($hasil);
                                            
										?>

											<div class="col-md-6 col-12">
												<div class="form-group">
												<label>Lokasi</label>
                                                <select type="text" name="tempat" id="tempat" value="<?= $data['tempat']; ?>" class="form-control" placeholder="Lokasi" required>
														
														<option>Banjarmasin</option>
														<option>Banjarbaru</option>
													</select>
												<!-- <input type="text" name="tempat" id="tempat" value="<?= $data['tempat']; ?>" class="form-control" placeholder="Nama"> -->
												</div>
											</div>

                                            <div class="col-md-6 col-12">
												<div class="form-group">
												<label>Box</label>
												<input type="text" name="box" id="box" class="form-control" value="<?= $data['box']; ?>" placeholder="Nama">
												</div>
											</div>
											
											<div class="col-md-6 col-12">
												<div class="form-group">
												<label>Rak</label>
												<input type="text" name="rak" id="rak" class="form-control" value="<?= $data['rak']; ?>" placeholder="Nama">
												</div>
											</div>

                                            <div class="col-md-6 col-12">
												<div class="form-group">
												<label>Tanggal Pindah</label>
												<input type="date" name="tgl_pindah" id="tgl_pindah" class="form-control" value="<?= $data['tgl_pindah']; ?>" placeholder="Nama" required>
												</div>
											</div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Note</label>
                                                    <input type='text' class="form-control" name="note_pindah" value="<?php echo $data_cek['note_pindah']; ?>"/>
                                                </div>
                                            </div>
                                                

                                        </div>
                                    </div>
									
									<!-- /.box-body -->

									<div class="box-footer">
										<input type="submit" name="Ubah" value="Simpan" class="btn btn-info">
										<a href="?page=data_pindah" class="btn btn-warning">Batal</a>
									</div>
                                    </div>
                                    <?php } ?>
								</form>
							</div>
                            
                             
							<!-- /.box -->
			</section>
        </div>
		</div>
	</div>
</section>


<?php

    if (isset ($_POST['Ubah'])){

       
        $sql_ubah = "UPDATE tb_arsip SET
          tempat='".$_POST['tempat']."',
          box='".$_POST['box']."',
          rak='".$_POST['rak']."',
          tgl_pindah='".$_POST['tgl_pindah']."',
          note_pindah='".$_POST['note_pindah']."'
          WHERE id_arsip='".$_POST['id_arsip']."'";
          $query_ubah = mysqli_query($koneksi, $sql_ubah);
          mysqli_close($koneksi);

    if ($query_ubah){

      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=data_pindah';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=data_pindah';
          }
      })</script>";
    }
  }
    
?>