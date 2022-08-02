<section class="content-header">
	<h1>
		Data Mutasi Arsip
		
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
			<ul class="nav nav-tabs">
					<li class="active">
						<a href="#pengajuan" data-toggle="tab">Pengajuan Mutasi</a>
					</li>
					<li>
					<a href="#validasi" data-toggle="tab">Validasi</a>
					</li>
					<li>
						<a href="#riwayat" data-toggle="tab">Riwayat Mutasi</a>
					</li>
            </ul>
			<div class="box-tools pull-right"> 
				<button type="button" class="btn btn-box-tool" data-widget="collapse">
					<i class="fa fa-minus"></i>
				</button>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="tab-content">

			<div class="active tab-pane" id="pengajuan">
				<div class="table-responsive">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>		
							<th>No.</th>		
							<th>Nama Pengaju</th>
							<th>Kode Klasifikasi</th>
							<th>Uraian Informasi Arsip</th>
							<th>Jumlah Arsip</th>
							<th>Tgl Mengajukan</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>

				  <?php
					$no = 1;
					if($data_level == "Admin"){
						$sql = $koneksi->query("SELECT * FROM tb_mutasi,tb_arsip,tb_pengguna
						WHERE tb_mutasi.id_arsip = tb_arsip.id_arsip
						AND tb_mutasi.nip = tb_pengguna.nip
						AND tb_mutasi.status ='PENDING'");
					}else{
						$sql = $koneksi->query("SELECT * FROM tb_mutasi,tb_arsip,tb_pengguna
						WHERE tb_mutasi.id_arsip = tb_arsip.id_arsip
						AND tb_mutasi.nip = tb_pengguna.nip
						AND tb_mutasi.status ='PENDING' 
						AND tb_pengguna.bidang='".$sesi['bidang']."'");
					}
					while ($data= $sql->fetch_assoc()){
                ?>

						<tr>
							<td>
								<?php echo $no++; ?>
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
								<?php  $tgl = $data['tgl_ajukan']; echo date("d/M/Y", strtotime($tgl))?>
							</td>
							<td>
								<?php echo $data['validasi']; ?>
							</td>

							<td>
								<a href="?page=del_mutasi&kode=<?php echo $data['id_mutasi']; ?>" onclick="return confirm('Yakin Hapus Data Ini ?')"
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

			<div class="active tab-pane fade" id="validasi">
				<div class="table-responsive">
					<!-- .content  -->
					<h3>halo</h3>
				</div>
			</div>

			<div class="active tab-pane fade" id="riwayat">
				<div class="table-responsive">
					<!-- .content  -->
					<h3>oh oke</h3>
				</div>
			</div>

			</div>
		</div>
	</div>
</section>