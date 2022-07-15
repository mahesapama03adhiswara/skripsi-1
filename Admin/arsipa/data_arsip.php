<section class="content-header">
	<h1>
		Master Data
		<small>Data Arsip Aktif</small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="index.php">
				<i class="fa fa-home"></i>
				<b>Website Pengelolaan Arsip Aktif BPKP Prov. Kalsel</b>
			</a>
		</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<a href="?page=MyApp/add_arsip_aktif" title="Tambah Data" class="btn btn-primary">
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
							<th>No</th>
							<th>Kode Klasifikasi</th>
							<th>No. ST</th>
							<th>No. Laporan</th>
							<th>Uraian Informasi Arsip</th>
							<th>Bidang</th>
							<th>Tahun</th>
							<th>Tingkat Keaslian</th>
							<th>Jumlah</th>
							<th>Rak</th>
							<th>Box</th>
							<th>File</th>
							<th>Aksi</th>
						</tr>
					</thead>	
					<tbody>

						<?php
                  $no = 1;
				  $bidang = $_SESSION['bidang'];
                  $sql =  $koneksi->query("SELECT * from tb_arsip WHERE jenis='Aktif'"); 
                  while ($data= $sql->fetch_assoc()) {
					
                ?>

						<tr>
							<td>
								<?php echo $no++; ?>
							</td>
							<td>
								<?php echo $data['kode_klasifikasi']; ?>
							</td>
							<td>
								<?php echo $data['no_st']; ?>
							</td>
							<td>
								<?php echo $data['no_laporan']; ?>
							</td>
							<td>
								<?php echo $data['nama_arsip']; ?>
							</td>
							<td>
								<?php echo $data['bidang']; ?>
							</td>
							<td>
								<?php echo $data['tahun']; ?>
							</td>
							<td>
								<?php echo $data['tingkat_keaslian']; ?>
							</td>
							<td>
								<?php echo $data['jumlah']; ?>
							</td>
							<td>
								<?php echo $data['rak']; ?>
							</td>
							<td>
								<?php echo $data['box']; ?>
							</td>
							<td>
								 <img src="./admin/arsipa/images/<?php echo $data['foto']; ?>" width="100" height="100"> 
							</td>
							<td>
								<a href="?page=MyApp/edit_arsip_aktif&kode=<?php echo $data['id_arsip']; ?>" title="Ubah"
								 class="btn btn-success">
									<i class="glyphicon glyphicon-edit"></i>
								</a>
								<a href="?page=MyApp/del_arsip_aktif&kode=<?php echo $data['id_arsip']; ?>" onclick="return confirm('Yakin Hapus Data Ini ?')"
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