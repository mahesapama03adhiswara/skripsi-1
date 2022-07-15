<section class="content-header">
	<h1>
		Pemakaian
		<small>Bahan Habis Pakai</small>
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
			<a href="?page=add_penggunaan_bahan" title="Tambah Data" class="btn btn-primary">
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
							<th>Kelas</th>
							<th>Barang</th>
							<th>Jumlah Barang</th>
							<th>Guru Pengajar</th>
							<th>Tgl Pinjam</th>
							<th>Foto</th>
							<th>Kelola</th>
						</tr>
					</thead>
					<tbody>

				  <?php
				  $jurusan = $_SESSION['jurusan'];
                  $sql = $koneksi->query("SELECT s.id_peminjaman, b.id_barang, b.kode_barang, b.nama_barang, b.stok, a.id_siswa, a.nisn, a.nama_siswa, a.kelas, a.nama_siswa, c.id_guru, c.nik, c.nama_guru, s.jumlah, s.tgl_pinjam, s.foto, s.kategori, s.kepemilikan from tb_peminjaman s inner join tb_barang b on s.id_barang = b.id_barang inner join tb_guru c on s.id_guru = c.id_guru  inner join tb_siswa a on s.id_siswa = a.id_siswa WHERE s.kategori='Bahan' AND s.kepemilikan='$jurusan'");
                  while ($data= $sql->fetch_assoc()) {
                ?>

						<tr>
							<td>
								<?php echo $data['nama_siswa']; ?>
							</td>
							<td>
								<?php echo $data['kelas']; ?>
							</td>
							<td>
								
								<?php echo $data['nama_barang']; ?>
							</td>
							<td>
								
								<?php echo $data['jumlah']; ?>
							</td>
							<td>
								
								<?php echo $data['nama_guru']; ?>
							</td>
							<td>
								<?php  $tgl = $data['tgl_pinjam']; echo date("d/M/Y", strtotime($tgl))?>
							</td>
							
							<td>
								<?php echo '<img class="rounded" width="75" height="75" src="data:image/jpeg;base64,'.base64_encode( $data['foto'] ).'"/>'; ?>
							</td>
							<td>

								<a href="?page=kembali&kode=<?php echo $data['id_peminjaman']; ?> &kode_barang=<?php echo $data['kode_barang']; ?> &jumlah=<?php echo $data['jumlah']; ?> &stok=<?php echo $data['stok']; ?>"  title="Kembalikan" class="btn btn-danger">
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