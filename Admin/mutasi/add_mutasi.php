<?php


$query1 = "SELECT max(id_mutasi) as maxid1 from tb_mutasi";
$hasil1 = mysqli_query($koneksi, $query1);
$data1  = mysqli_fetch_array($hasil1);
$id_mutasi = $data1['maxid1'];

$nourut1 = (int) substr($id_mutasi,3,6);
$nourut1++;
$char1 = "MT";
$newiddetil = $char1.sprintf("%06s",$nourut1);
$iddetil= $newiddetil;



?>


<section class="content-header">
	<h1>
		Pemindahan Arsip
		<small>Aktif</small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="index.php">
				<i class="fa fa-home"></i>
				<b>Website Pengelolaan Arsip Dinamis BPKP Provinsi Kalsel</b>
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
									<h3 class="box-title">Pengajuan Mutasi Arsip Aktif</h3>
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
													<label>No. Mutasi</label>
													<input value="<?= $newiddetil ?>" readonly type="text" name="id_mutasi" id="id_mutasi" class="form-control">
												</div>
											</div>

											<div class="col-md-6 col-12" hidden>
												<div class="form-group">
												<label>NIP</label>
												<input type="text" value="<?= $sesi['nip']; ?>" name="nip" id="nip" class="form-control" readonly>
											</div>
											</div>

											<div class="col-md-6 col-12" >
											<div class="form-group">
												<label>Nama Pengaju</label>
												<input type="text" value="<?= $sesi['nama_pegawai']; ?>" readonly class="form-control" placeholder=""/>
											</div>
											</div>

											<!-- <div class="col-md-6 col-12">
												<div class="form-group">
													<label>Kode Klasifikasi</label>
													<select name="kode_klasifikasi" id="kode_klasifikasi" class="form-control select2" style="width: 100%;" required >
														<option selected="selected">-- Pilih --</option>
														<?php
													// ambil data dari database
													$query = "select * from tb_arsip where jenis='Aktif'";
													$hasil = mysqli_query($koneksi, $query);
													while ($row = mysqli_fetch_array($hasil)) {
													?>
													<option value="<?php echo $row['id_arsip'] ?>">
														<?php echo $row['kode_klasifikasi'] ?> -
														<?php echo $row['nama_arsip'] ?> 
														
													</option>
													<?php
													}
													?>
													</select>
												</div>
											</div> -->

											<div class="col-md-6 col-12" >
												<div class="form-group" >
													<label>Arsip Aktif</label>
													<select name="id_arsip" id="id_arsip" class="form-control select2" style="width: 100%;" >
														<option selected="selected" >-- Pilih --</option>
														
														<?php
													// ambil data dari database
													$query = "select * from tb_arsip
													where jenis='Aktif' AND bidang='".$sesi['bidang']."'";
													// $bidang = $_SESSION['bidang'];
													$hasil = mysqli_query($koneksi, $query);
													while ($row = mysqli_fetch_array($hasil)) {
													?>
													<option 
														value="<?php echo $row['id_arsip'] ?>">
														<?php echo $row['kode_klasifikasi'] ?> -
														<?php echo $row['nama_arsip'] ?>
													</option>
													<?php
													}
													?>
													</select>
												</div>
											</div>
											
											<div class="col-md-6 col-12" hidden>
												<div class="form-group">
												<label>Bidang</label>
												<input type="text" value="<?= $sesi['id_bidang']; ?>" name="bidang" id="bidang" class="form-control" readonly>
												</div>
											</div>
											
											<div class="col-md-6 col-12">
											<div class="form-group">
												<label>Bidang</label>
												<input type="text" value="<?= $sesi['nama_bidang']; ?>" readonly class="form-control" placeholder=""/>
											</div>
											</div>
											
											<div class="col-md-6 col-12">
												<div class="form-group">
													<label>Tanggal Pengajuan</label>
													<input type="date" name="tgl_ajukan" id="tgl_ajukan" class="form-control" required>
												</div>
											</div>

											<div class="col-md-6 col-12" hidden>
												<div class="form-group">
													<label>status pengajuan</label>
													<input type="text" name="validasi" id="vallidasi" class="form-control" placeholder="">
												</div>
											</div>

											<div class="col-md-6 col-12">
												<div class="form-group">
													<label>Note</label>
													<input type="text" name="note" id="note" class="form-control" placeholder="">
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
		//menangkap post tgl pinjam
		$validasi='PENDING';
		
		

			$sql_simpan = "INSERT INTO tb_mutasi (id_mutasi,id_arsip,nip,bidang,validasi,tgl_ajukan,note) VALUES (
				
				'".$_POST['id_mutasi']."',
				'".$_POST['id_arsip']."',
				'".$_POST['nip']."',
				'".$_POST['bidang']."',
				'".$validasi."',
				'".$_POST['tgl_ajukan']."',
				'".$_POST['note']."')";
			$query_simpan = mysqli_query($koneksi, $sql_simpan);
		

	

    if ($query_simpan){
		?>

    	<script>
		Swal.fire({title: 'Pengajuan Mutasi Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
		}).then((result) => {
			if (result.value) {
				window.location = 'index.php?page=add_mutasi';
			}
		})
		</script>
		<?php 
		}else{
			?>
		<script>
		Swal.fire({title: 'Pengajuan Mutasi Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
		}).then((result) => {
			if (result.value) {
				window.location = 'index.php?page=data_mutasi';
			}
		})
		</script>
		<?php 
		}
	}
	?>

  

	
        <!-- <div class="card">
            <div class="header">
                <h2>
                Mutasi Arsip
                </h2>
                
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped table-borderless table-hover table-sm table-dark m-b-0">
                        <thead>
                            <tr align='center'>
                                <th>No</th>
                                <th>ID Mutasi</th>
                                <th>Kode Klasifikasi</th>
                                <th>Nama Arsip</th>
                                <th>Tanggal Pengajuan</th>
								<th>Note</th>
                                <th>Aksi</th>   
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                        	<?php 
                            $no = 1;
							$bidang = $_SESSION['bidang'];
							$sql = mysqli_query($koneksi,"SELECT * FROM tb_mutasi, tb_pengguna, tb_bidang, tb_arsip
							WHERE tb_mutasi.nip = tb_pengguna.nip
							AND tb_mutasi.bidang = tb_bidang.id_bidang
							AND tb_mutasi.id_arsip = tb_arsip.id_arsip
							AND tb_mutasi.id_mutasi='$newiddetil'
							ORDER BY tb_mutasi.id_mutasi Asc
							");

							while ($data= $sql->fetch_array()) {
								?>
									<tr align='center'>
										<td><?= $no++; ?></td>
										<td><?= $data['id_mutasi']; ?> </td>
										<td><?= $data['kode_klasifikasi']; ?> </td>
										<td><?= $data['nama_arsip']; ?> </td>
										<td><?= $data['jumlah']; ?> </td>
										<td>+ <?= $data['note']; ?> </td>
										<td>
                        					<a onclick="return confirm('Apakah Anda Yakin untuk Menghapus Data Ini ??')" href="?page=del_mutasi&kode=<?= $data['id_mutasi']; ?>"><button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></a>
										</td>
									</tr>
								<?php
									}
								?>
                        </tbody>

                    </table>
					<div class="container-fluid " align="center">
						<a href="?page=data_mutasi" onclick="return confirm('Apakah Anda Yakin untuk Menyimpan Data Ini ??')" class="btn btn-primary">Selesai</a>
					</div><br>
                </div><div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> -->