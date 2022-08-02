<section class="content-header">
	<h1>
		Pengguna Sistem
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
		<div class="box-header">
			
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
							<th>Tangg. Pengajuan</th>
							<th>Nama Penginput</th>
							<th>Kode Klasifikasi</th>
							<th>Uraian Informasi Arsip</th>
							<th>Jumlah</th>
							<th>Status Mutasi</th>
							<th>Penanggung Jawab</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>

						<?php
                  $no = 1;
				  $sql = $koneksi->query("SELECT S.tgl_pengajuan, S.kode_klasifikasi, S.Penanggung_jawab, B.nama_arsip, B.jumlah, A.nip, A.nama_pegawai FROM tb_penyusutan S INNER JOIN tb_arsip B ON S.kode_klasifikasi = B.kode_klasifikasi INNER JOIN tb_pengguna A ON S.nip = A.nip WHERE S.validasi='PENDING'");
                  while ($data= $sql->fetch_assoc()) {
                ?>

						<tr>
							<td>
								<?php echo $no++; ?>
							</td>
							<td>
								<?php echo $data['tgl_pengajuan']; ?>
							</td>
							<td>
								<?php echo $data['nip']; ?>
								<br>(<?php  echo $data['nama_pegawai'] ?>)
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
								<?php echo $data['validasi']; ?>
							</td>
							<td>
								<?php echo $data['penanggung_jawab']; ?>
							</td>

							<td>
								<a href="?page=konfir/=<?=$data['id_pengajuan']; ?> ">
                              	<button class="btn btn-sm btn-danger">Validasi</button></a>
								<!-- <a href="?page=MyApp/edit_pengguna&kode=<?php echo $data['id_pengguna']; ?>"
								 title="Ubah" class="btn btn-success">
									<i class="glyphicon glyphicon-edit"></i>
								</a>
								<a href="?page=MyApp/del_pengguna&kode=<?php echo $data['id_pengguna']; ?>"
								 onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus" class="btn btn-danger">
									<i class="glyphicon glyphicon-trash"></i> -->
									</>
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