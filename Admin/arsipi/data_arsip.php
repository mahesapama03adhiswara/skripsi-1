<section class="content-header">
	<h1>
		Master Data 
		<bold>Arsip </bold>
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
					<!-- <?php
					if ($data_level!="Pegawai"){
					?>
			<a href="?page=MyApp/add_arsip_inaktif" title="Tambah Data" class="btn btn-primary">
				<i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
				<div> <br> </div>
				<?php } ?> -->
		
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#arsipi" data-toggle="tab">Arsip Inaktif</a>
					</li>
					<li>
					<a href="#arsipa" data-toggle="tab">Arsip Aktif</a>
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
			

              	<div class="active tab-pane" id="arsipi">
				  <div class="table-responsive">
				  <?php
					if ($data_level!="Pegawai"){
					?>
					<div>
					<a href="?page=MyApp/add_arsip_inaktif" title="Tambah Data" class="btn btn-primary">
					<i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
					
					<a href="?page=print_arsipi" title="Cetak Data" class="btn btn-primary">
					<i class="glyphicon glyphicon-print"></i> Print</a>
					
					</div>
					<br>
				
				<?php } ?>
				
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
							<th>Status</th>
							<th>Rak</th>
							<th>Box</th>
							<th>File</th>
							<th>Aksi</th>
						</tr>
					</thead>	
					<tbody>

					<?php
					$no = 1;
					if ($data_level == "Admin"){
						$sql =  $koneksi->query("SELECT * FROM tb_arsip,tb_bidang
						WHERE tb_arsip.bidang = tb_bidang.id_bidang 
						AND jenis='Inaktif' 
						");
						}else{
							$sql =  $koneksi->query("SELECT * FROM tb_arsip,tb_bidang
							WHERE tb_arsip.bidang = tb_bidang.id_bidang 
							AND jenis='Inaktif' 
							AND tb_arsip.status= 'TERSEDIA'
							"); 
						}
						while ($data= $sql->fetch_assoc()){
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
								<?php echo $data['nama_bidang']; ?>
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
								<?php echo $data['status']; ?>
							</td>
							<td>
								<?php echo $data['rak']; ?>
							</td>
							<td>
								<?php echo $data['box']; ?>
							</td>
							<td>
								<a href="?page=MyApp/download&filename=<?php echo $data['file']; ?>"><?php echo $data['file']; ?></a>
								<!-- <a href="download.php?filename=<?=$data['file']?>">Download</a> -->
							</td>
							<!-- <td>
								 <img src="./admin/arsipi/images/<?php echo $data['file']; ?>" width="100" height="100"> 
							</td> -->
							
							<td>
							<?php
								if ($data_level!="Admin"){
								?>
								<a href="?page=add_peminjaman&kode=<?php echo $data['id_arsip']; ?>" title="pinjam" 
								class="btn btn-warning">
								<i class="glyphicon glyphicon-hand-right"></i>
								</a>
							
								<?php } ?>
								<?php 
								if ($data_level !="Pegawai"){
									?>
								<a href="?page=MyApp/edit_arsip_inaktif&kode=<?php echo $data['id_arsip']; ?>" title="Ubah"
								 class="btn btn-success">
									<i class="glyphicon glyphicon-edit"></i>
								</a>

								<a href="?page=MyApp/del_arsip_inaktif&kode=<?php echo $data['id_arsip']; ?>" onclick="return confirm('Yakin Hapus Data Ini ?')"
								 title="Hapus" class="btn btn-danger ms-1" >
									<i class="glyphicon glyphicon-trash"></i>
									<?php } ?>
							</td>
						</tr>
						</tbody>
						<?php
						}
						?>
					
				</table>
				</div>
			</div>
			

			
              	<div class="active tab-pane fade" id="arsipa">
				  <div class="table-responsive">
				  <?php
					if ($data_level!="Admin"){
					?>
						<a href="?page=MyApp/add_arsip_aktif" title="Tambah Data" class="btn btn-primary">
						<i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
				
				<?php }else{ ?>
					<a href="?page=print_arsipa" title="Cetak Data" class="btn btn-primary">
					<i class="glyphicon glyphicon-print"></i> Print</a>
				<?php } ?>
				<div> <br> </div>
				  <table id="example2" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Klasifikasi</th>
							<th>No. ST</th>
							<th>No. Laporan</th>
							<th>Uraian Informasi Arsip</th>
							<th>Bidang</th>
							<th>Tahun</th>
							
							<!-- <th>File</th> -->
							<!-- <th>Aksi</th> -->
						</tr>
					</thead>	
					<tbody>

						<?php
						$no = 1;
						if ($data_level == "Admin"){
							$sql =  $koneksi->query("SELECT * FROM tb_arsip,tb_bidang
							WHERE tb_arsip.bidang = tb_bidang.id_bidang 
							AND jenis='Aktif'");
						}else{
							$sql =  $koneksi->query("SELECT * FROM tb_arsip,tb_bidang
							WHERE tb_arsip.bidang = tb_bidang.id_bidang 
							AND jenis='Aktif' 
							AND bidang='".$sesi['bidang']."'"); 
						}
						while ($data= $sql->fetch_assoc()){
							
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
								<?php echo $data['nama_bidang']; ?>
							</td>
							<td>
								<?php echo $data['tahun']; ?>
							</td>
							<!-- <td>
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
							</td> -->
							<!-- <td>
								 <img src="./admin/arsipa/images/<?php echo $data['file']; ?>" width="100" height="100"> 
							</td> -->
							<td>
								<?php
								if ($data_level!="Admin"){
								?>
									<a href="?page=addmutasi&kode=<?php echo $data['id_arsip']; ?>"  title="Ajukan" class="btn btn-Info">
									<i class="glyphicon glyphicon-inbox"></i>
								
								
								<a href="?page=MyApp/edit_arsip_aktif&kode=<?php echo $data['id_arsip']; ?>" title="Ubah"
								 class="btn btn-success">
									<i class="glyphicon glyphicon-edit"></i>
								</a>
								<a href="?page=MyApp/del_arsip_aktif&kode=<?php echo $data['id_arsip']; ?>" onclick="return confirm('Yakin Hapus Data Ini ?')"
								 title="Hapus" class="btn btn-danger">
									<i class="glyphicon glyphicon-trash"></i>
								<?php } ?>
							</td>
						</tr>
					</tbody>
						<?php
						}
						?>
					
				</table>
				  </div>
				</div>


			<!-- .div table responsive  -->
			</div>
		</div>
	</div>
		
</section>