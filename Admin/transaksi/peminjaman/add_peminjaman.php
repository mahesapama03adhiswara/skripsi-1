<?php

$query1 = "SELECT max(id_peminjaman) as maxid1 from tb_peminjaman";
$hasil1 = mysqli_query($koneksi, $query1);
$data1  = mysqli_fetch_array($hasil1);
$id_pinjam = $data1['maxid1'];

$nourut1 = (int) substr($id_pinjam,3,6);
$nourut1++;
$char1 = "PN";
$newiddetil = $char1.sprintf("%06s",$nourut1);
$iddetil= $newiddetil;


    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_arsip
		WHERE id_arsip='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }

?>


<section class="content-header">
	<h1>
		Peminjaman Arsip
		<small>Inaktif</small>
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
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title">Tambah Peminjaman</h3>
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
							<label>No. Pinjam</label>
							<input type="text" value="<?= $iddetil ?>" readonly name="nopin" id="nopin" class="form-control" placeholder=""/>
						</div>
						
						<div class="form-group" hidden>
							<label>nip</label>
							<input type="text" value="<?= $sesi['nip']; ?>" name="nip" id="nip" class="form-control" placeholder=""/>
						</div>

						<div class="form-group" hidden>
							<label>bidang</label>
							<input type="text" value="<?= $sesi['bidang']; ?>" name="bidang" id="bidang" class="form-control" placeholder=""/>
						</div>

						<div class="form-group">
							<label>Nama Peminjam</label>
							<input type="text" value="<?= $sesi['nama_pegawai']; ?>" readonly class="form-control" placeholder=""/>
						</div>
						
						<div class="form-group">
							<div hidden>
								<label>No. Laporan</label>
							<input type="text" name="id_arsip" value="<?= $data_cek['id_arsip']; ?>" readonly class="form-control" placeholder=""/>
							</div>
							<div>
							<label>No. Laporan</label>
							<input type="text" value="<?= $data_cek['no_laporan']; ?>" readonly class="form-control" placeholder=""/>
							</div>
							
						</div>

						<div class="form-group">
							<label> Nama Arsip Inaktif</label>
							<input type="text" value="<?= $data_cek['nama_arsip']; ?>" readonly class="form-control" placeholder=""/>
						</div>

						
						<div class="form-group">
							<label>Jumlah</label>
							<input type="text" name="jumlah" id="jumlah" class="form-control" placeholder="Masukan Jumlah Arsip Yang Dipinjam"/>
						</div>

						<div class="form-group">
							<label>Tgl Pinjam</label>
							<input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control" />
						</div>

						<div class="form-group">
							<label>Note</label> 
							<input type="text" name="note" id="note" class="form-control" />
						</div>

					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<button type="submit" name="Simpan" class="btn btn-info">Simpan</button>
						<a href="?page=peminjaman" class="btn btn-warning">Batal</a>
						
					</div>
				</form>
			</div>
			<!-- /.box -->
</section>



<?php

    if (isset ($_POST['Simpan'])){
		

		//menangkap post tgl pinjam
		$status='PENDING';
		$tgl_p=$_POST['tgl_pinjam'];
		$jumlah=$_POST['jumlah'];

			$sql_simpan = "INSERT INTO tb_peminjaman (id_peminjaman,id_arsip,nip,jumlah,status,note,bidang,tgl_pinjam) VALUES (
				
				 '".$_POST['nopin']."',
				 '".$_POST['id_arsip']."',
				 '".$_POST['nip']."',
				 '".$_POST['jumlah']."',
				 '".$status."',
				 '".$_POST['note']."',
				 '".$_POST['bidang']."',
				 '".$_POST['tgl_pinjam']."')";
				
				
			$query_simpan = mysqli_query($koneksi, $sql_simpan);
		

	

    if ($query_simpan){

      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=peminjaman';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'index.php?page=peminjaman';
          }
      })</script>";
    }}
  