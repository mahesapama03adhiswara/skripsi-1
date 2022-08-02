<section class="content-header">
	<h1>
		Master Data
		<small>Data Pegawai</small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="index.php">
				<i class="fa fa-home"></i>
				<b>Website Pengelolaan Arsip Inaktif BPKP Prov. Kalsel</b>
			</a>
		</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<a href="?page=MyApp/add_pegawai" title="Tambah Data" class="btn btn-primary">
				<i class="glyphicon glyphicon-plus"></i> Tambah Data Pegawai</a>
			<a href="?page=print_pegawai" title="Cetak Data" class="btn btn-primary">
				<i class="glyphicon glyphicon-print"></i> Print</a>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse">
					<i class="fa fa-minus"></i>
				</button>
				
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
                    <table class="table table-striped display" id="myTable">
					<thead>
						<tr>
							<th>No.</th>
							<th>Foto</th>
							<th>NIP</th>
							<th>Nama</th>
							<th>Jenis Kelamin</th>
							<th>Bidang</th>
							<th>Jabatan</th>
							<th>Email</th>
							<th>No HP</th>
							<th>Alamat</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>

						<?php
						 $no = 1;
                  $sql = $koneksi->query("SELECT * from tb_pengguna p, tb_bidang b, tb_jabatan x
				  WHERE p.bidang = b.id_bidang
				  AND p.jabatan = x.id_jabatan
				  ");
                  while ($data= $sql->fetch_assoc()) {
                ?>

						<tr>
							<td>
								<?php echo $no++; ?>
							</td>
							<td>
								<?php if ($data['foto'] == "" || $data['foto'] == null){
									?>
								
								<img src="Admin/pegawai/futu/no-image.png" alt="" width="100px"  height="auto">
								<?php }else{
								?>
								<img src="Admin/pegawai/futu/<?= $data['foto']; ?>" alt="" width="100px"  height="auto">
								<?php
								}
								?>
							</td>
							<td>
								<?php echo $data['nip']; ?>
							</td>
							<td>
								<?php echo $data['nama_pegawai']; ?>
							</td>
							<td>
								<?php echo $data['jenkel']; ?>
							</td>
							<td>
								<?php echo $data['nama_bidang']; ?>
							</td>
							<td>
								<?php echo $data['nama_jabatan']; ?>
							</td>
							<td>
								<?php echo $data['email']; ?>
							</td>
							<td>
								<?php echo $data['no_hp']; ?>
							</td>
							<td>
								<?php echo $data['alamat']; ?>
							</td>

							<td>
								<a href="?page=edit_pegawai&kode=<?php echo $data['nip']; ?>" title="Ubah"
								 class="btn btn-success">
									<i class="glyphicon glyphicon-edit"></i>
								</a>
								<a href="?page=MyApp/del_pegawai&kode=<?php echo $data['nip']; ?>" onclick="return confirm('Yakin Hapus Data Ini ?')"
								 title="Hapus" class="btn btn-danger">
									<i class="glyphicon glyphicon-trash"></i>
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