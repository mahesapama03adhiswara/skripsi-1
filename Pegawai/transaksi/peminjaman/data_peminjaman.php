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
			<a href="?page=add_peminjaman" title="Tambah Data" class="btn btn-primary">
				<i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
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
		<div class="box-body">
			<div class="table-responsive">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>				
							<th>Nama Peminjam</th>
							<th>Kode Klasifikasi</th>
							<th>Uraian Informasi Arsip</th>
							<th>Jumlah Arsip</th>
							<th>Tgl Pinjam</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>

				  <?php
				  $bidang = $_SESSION['bidang'];
                  $sql = $koneksi->query("SELECT S.id_peminjaman, S.status, S.tgl_pinjam, B.kode_klasifikasi, B.nama_arsip, B.jumlah, A.nip, A.nama_pegawai FROM tb_peminjaman S INNER JOIN tb_arsip B ON S.kode_klasifikasi = B.kode_klasifikasi INNER JOIN tb_pengguna A ON S.nip = A.nip WHERE S.status='Pending'");
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
								<?php echo $data['kode_klasifikasi']; ?>
							</td>
							<td>
								
								<?php echo $data['nama_arsip']; ?>
							</td>
							<td>
								
								<?php echo $data['jumlah']; ?>
							</td>
							<td>
								
								<?php echo $data['tgl_pinjam']; ?>
							</td>
							<td>
								<?php  $tgl = $data['tgl_pinjam']; echo date("d/M/Y", strtotime($tgl))?>
							</td>
							<td>
								<?php echo '<img class="rounded" height="100" width="100" src="data:image/jpeg;base64,'.base64_encode( $data['foto'] ).'"/>'; ?>
							</td>
							<td>

								<a href="?page=kembali&kode=<?php echo $data['id_peminjaman']; $data['id_peminjaman']; ?> &kode_klasifikasi_=<?php echo $data['kode_klasifikasi']; ?> &nip=<?php echo $data['nip']; ?> &jumlah=<?php echo $data['jumlah']; ?> &tgl_pinjam=<?php echo $data['tgl_pinjam']; ?>"  title="Setuui" class="btn btn-danger">
									<i class="glyphicon glyphicon-download"></i>
							</td>
						</tr>
						<?php
                  }
                ?>
					</tbody>

				</table>
			</div>
		</div>
	</div>
</section>