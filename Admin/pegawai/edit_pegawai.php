<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_pengguna, tb_bidang, tb_jabatan
		WHERE tb_pengguna.bidang = tb_bidang.id_bidang
		AND tb_pengguna.jabatan = tb_jabatan.id_jabatan
		AND nip='".$_GET['kode']."'";
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
								<option value="<?php echo $data_cek['jenkel']; ?>">-- Pilih --</option>
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
							<select name="bidang" id="bidang" class="form-control select2" style="width: 100%;">
								<option><?php echo $data_cek['bidang']; ?></option>
								<?php			
								// ambil data dari database
								$query = "select * from tb_bidang";
								$hasil = mysqli_query($koneksi, $query);
								while ($row = mysqli_fetch_array($hasil)) {
								?>
								<option value="<?php echo $row['id_bidang'] ?>">
									<?php echo $row['bidang'] ?>
								</option>
								<?php
								}
								?>
							</select>
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
							<label>Jabatan12</label>
							<select name="jabatan" id="jabatan" class="form-control select2" style="width: 100%;">
								<option><?php echo $data_cek['jabatan']; ?></option>
								<?php			
								// ambil data dari database
								$query = "select * tb_jabatan";
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
						
						<div class="col-md-6 col-12">
										<div class="form-group">
											<label for="photo-you">Photo</label>	
											<input type="file" name="photo" id="photo" class="form-control"  image-crop-aspect-ratio="1:1" >
                            				<small class="text-muted">*Kosongkan jika tidak ingin mengubah foto profil.</small>
										</div>
									</div>
									<div class="col-md-6 col-12">
									</div>
									<div class="col-md-6 col-12">
										<div class="form-group">
											<img src="Admin/pegawai/futu/<?= $data_cek['foto']; ?>" alt="" width="35%"  height="auto">
										</div>
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

if (isset($_POST['Ubah'])) {
	$nip = $_POST['nip'];
	$nama_pegawai = $_POST['nama_pegawai'];
	$bidang = $_POST['bidang'];
	$jenkel = $_POST['jenkel'];
	$jabatan = $_POST['jabatan'];
	$email = $_POST['email'];
	$alamat = $_POST['alamat'];
	$no_hp = $_POST['no_hp'];
	$tgl = date('Y-m-d');	//menangkap post tgl pinjam
	
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

		if($photo){

			$ngedit = "UPDATE tb_pengguna SET 
			nama_pegawai='$nama_pegawai',
			bidang='$bidang', jenkel='$jenkel', jabatan='$jabatan', email='$email',
			no_hp='$no_hp', photo='$photo', alamat='$alamat'
			WHERE nip='$nip'";

			$sql = mysqli_query($koneksi,"UPDATE tb_pengguna SET nama_pegawai='$nama_pegawai', bidang='$bidang', jenkel='$jenkel', jabatan='$jabatan', email='$email', no_hp='$no_hp', foto='$photo', alamat='$alamat'
			WHERE nip='$nip'"
			);                    
	
			if($sql){
				?>
				<script>
					Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
					}).then((result) => {
						if (result.value) {
							window.location = 'index.php?page=MyApp/data_pegawai';
						}
					})
				</script>
			<?php
				} else {
				?>
					<script>
						Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
						}).then((result) => {
							if (result.value) {
								window.location = 'index.php?page=edit_pegawai';
							}
						})
					</script>
			<?php
			}
		}
	} else {
		$sql = mysqli_query($koneksi,"UPDATE tb_pengguna SET nama_pegawai='$nama_pegawai', bidang='$bidang', jenkel='$jenkel', jabatan='$jabatan', email='$email', no_hp='$no_hp', alamat='$alamat'
		WHERE nip='$nip'"
		);                              
	
			if($sql){
				?>
				<script>
					Swal.fire({title: 'Update Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
					}).then((result) => {
						if (result.value) {
							window.location = 'index.php?page=MyApp/data_pegawai';
						}
					})
				</script>
			<?php
				} else {
				?>
					<script>
						Swal.fire({title: 'Update Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
						}).then((result) => {
							if (result.value) {
								window.location = 'index.php?page=edit_pegawai';
							}
						})
					</script>
			<?php
			}
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
	