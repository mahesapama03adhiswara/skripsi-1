<section class="content-header">
	<h1>
		Log Data
		<small>Peminjaman</small>
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
<!-- Main content -->
<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<p></p>
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
							<th>No</th>
							<th>Nama Peminjam</th>
							<th>Kelas</th>
							<th>Barang</th>
							<th>Guru Pengajar</th>
							<th>Tanggal Pinjam</th>
						</tr>
					</thead>
					<tbody>

						<?php
                  $no = 1;
                  $sql = $koneksi->query("SELECT s.id_peminjaman, a.nisn, a.nama_siswa, a.kelas, b.kode_barang, b.nama_barang, c.nik, c.nama_guru, s.tgl_pinjam from tb_peminjaman s inner join tb_siswa a ON s.nisn=a.nisn inner join tb_barang b on s.kode_barang=b.kode_barang inner join tb_guru c on s.nik=c.nik where status='PIN' order by tgl_pinjam desc");;
                  while ($data= $sql->fetch_assoc()) {
                ?>

						<tr>
							<td>
								<?php echo $no++; ?>
							</td>
							<td>
								<?php echo $data['nisn']; ?>
								-
								<?php echo $data['nama_siswa']; ?>
							</td>
							<td>
								<?php echo $data['kelas']; ?>
							</td>
							<td>
								<?php echo $data['nama_barang']; ?>
							</td>
							<td>
								<?php echo $data['nama_guru']; ?>
							</td>
							<td>
								<?php  $tgl = $data['tgl_pinjam']; echo date("d/M/Y", strtotime($tgl))?>
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