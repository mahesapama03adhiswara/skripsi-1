<section class="content-header">
	<h1>
		Peminjaman Arsip
		
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
<!-- Main content -->
<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse">
					<i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove">
					<i class="fa fa-remove"></i>
				</button>
			</div>
		</div>
										<p id="demo"></p>
                						<p id="aaa"></p>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
				<table id="example2" class="table table-bordered table-striped">
					<thead>
						<tr>				
							<th>Nama Peminjam</th>
							<th>Kode Klasifikasi</th>
							<th>Uraian Informasi Arsip</th>
							<th>Jumlah Arsip</th>
							<th>Tgl jml</th>
							<th>Tgl Pinjam</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>

						<?php
						$bidang = $_SESSION['bidang'];
						$sql = $koneksi->query("SELECT S.id_peminjaman, S.status, S.tgl_pinjam, B.no_laporan, B.nama_arsip, B.jumlah, A.nip, A.nama_pegawai FROM tb_peminjaman S INNER JOIN tb_arsip B ON S.no_laporan = B.no_laporan INNER JOIN tb_pengguna A ON S.nip = A.nip WHERE S.status='DITERIMA'");
						while ($data= $sql->fetch_assoc()) {
						?>

						<tr>

							<td>
								<?php echo $data['nip']; ?>
							</td>

							<td>
								<?php echo $data['nama_pegawai']; ?>
							</td>
							<td>
								<?php echo $data['no_laporan']; ?>
							</td>
							<td>
								
								<?php echo $data['nama_arsip']; ?>
							</td>
							<td>
								
								<?php echo $data['jumlah']; ?>
							</td>
							<td>
								
								<!-- <?php echo $data['tgl_pinjam']; ?> -->
								
								<text id="ae1" ></text>
							</td>
							<td>
								<?php  $tgl = $data['tgl_pinjam']; echo date("d/M/Y", strtotime($tgl))?>
							</td>
							
							<td>
								<a href="?page=kembali&kode=<?php echo $data['id_peminjaman']; ?>"  title="Setuui" class="btn btn-danger">
									<i class="glyphicon glyphicon-download"></i>
							</td>
						</tr>
						
<script>
    document.getElementById('demo').innerHTML = moment().format('dddd, LL') + " (" + moment().fromNow() + ") ";

    document.getElementById('ae1').innerHTML = moment("2012-06-20").format('dddd, LL') + " (" + moment("20120620", "YYYYMMDD").fromNow() + ") ";

    function asdasd(){
        document.getElementById('aaa').innerHTML = moment().format('MMMM Do YYYY, h:mm:ss a')
    };
    setInterval(asdasd,1000);
</script>
						<?php
						}
						?>
					</tbody>

				</table>
			</div>
		</div>
	</div>
</section>
