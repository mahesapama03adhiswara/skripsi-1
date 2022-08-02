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
					<!-- <?php
					if ($data_level!="Admin"){
					?>
			<a href="?page=add_peminjaman" title="Tambah Data" class="btn btn-primary">
				<i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
				<?php } ?> -->

				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#pengajuan" data-toggle="tab">Pengajuan Pinjam</a>
					</li>
					<li>
					<a href="#validasi" data-toggle="tab">Validasi Pinjam</a>
					</li>
					<li>
						<a href="#kembali" data-toggle="tab">Pengembalian</a>
					</li>
            	</ul>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse">
					<i class="fa fa-minus"></i>
				</button>
				<!-- <button type="button" class="btn btn-box-tool" data-widget="remove">
					<i class="fa fa-remove"></i>
				</button> -->
			</div>
		</div>

		       

		<!-- /.box-header -->
		<div class="box-body">
			<div class="tab-content">
			<!-- <?php
					if ($data_level!="Admin"){
					?>
					<a href="?page=add_peminjaman" title="Tambah Data" class="btn btn-primary">
						<i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
				<?php } ?> -->
              	<div class="active tab-pane" id="pengajuan">
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>			
										<th>No. </th>	
										<th>No. Peminjaman</th>
										
										<th>Nama Peminjam</th>
										<th>No. Laporan</th>
										<th>Uraian Informasi Arsip</th>
										
										<th>Tanggal Pinjam</th>
										<th>Status</th>
										<th>Note</th>
										<th>Aksi</th>
									</tr>
								</thead> 
							<tbody>

								<?php
								
								$no = 1;
								$bidang = $_SESSION['bidang'];
								if($data_level == "Admin"){
									$sql = $koneksi->query("SELECT * FROM tb_peminjaman,tb_arsip,tb_pengguna
									WHERE tb_peminjaman.id_arsip = tb_arsip.id_arsip
									AND tb_peminjaman.nip = tb_pengguna.nip
									AND tb_peminjaman.status = 'PENDING'");
								}else{
									$sql = $koneksi->query("SELECT * FROM tb_peminjaman,tb_arsip,tb_pengguna
									WHERE tb_peminjaman.id_arsip = tb_arsip.id_arsip
									AND tb_peminjaman.nip = tb_pengguna.nip
									AND tb_peminjaman.status ='PENDING' 
									AND tb_pengguna.bidang='".$sesi['bidang']."'");
								}
								while ($data= $sql->fetch_array()){
									?>

								<tr>
									<td>
										<?php echo $no++; ?>
									</td>
									<td>
										<?php echo $data['id_peminjaman']; ?>
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
										<?php  $tgl = $data['tgl_pinjam']; echo date("d/M/Y", strtotime($tgl))?>
									</td>
									<td>
										<?= $data[6];?>
									</td>
									<td>
										<?= $data['note']; ?>
									</td>
									
									<td>
										<?php
											if ($data_level!="Pegawai"){
											?>
											<a href="?page=validasi&kode=<?php echo $data['id_peminjaman'];  ?>"  title="" class="btn btn-success">
												<i class="glyphicon glyphicon-download"></i>
												<?php } ?>
											
											<a href="?page=del_peminjaman&kode=<?php echo $data['id_peminjaman']; ?>" onclick="return confirm('Yakin Hapus Data Ini ?')"
											title="Hapus" class="btn btn-danger">
												<i class="glyphicon glyphicon-trash"></i>
									</td>
								</tr>
									<?php
									}
									?>
							</tbody>
						</table>
			
					<!-- table responsive  -->
					</div>
				<!-- tab active tab pane  -->
				</div>
 
				<!-- validasi pinjam arsip -->
				<div class="active tab-pane fade" id="validasi">
				<div class="table-responsive">
				
				
				<a href="?page=print_peminjaman" title="Cetak Data" class="btn btn-primary">
				<i class="glyphicon glyphicon-print"></i> Print</a>
				<div><br></div>
				<table id="example2" class="table table-bordered table-striped">
					<thead>
						<tr>	
							<th>No. </th>	
							<th>NIP</th>		
							<th>Nama Peminjam</th>
							<th>No. Laporan</th>
							<th>Uraian Informasi Arsip</th>
							<!-- <th>Jumlah Arsip</th> -->
							<th>Tanggal Pengajuan Pinjam</th>
							<th>Status</th>
							<th>Note</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>

						<?php
						$no = 1;
						$bidang = $_SESSION['bidang'];
						if($data_level == "Admin"){
							$sql = $koneksi->query("SELECT * FROM tb_peminjaman,tb_arsip,tb_pengguna
							WHERE tb_peminjaman.id_arsip = tb_arsip.id_arsip
							AND tb_peminjaman.nip = tb_pengguna.nip
							AND tb_peminjaman.status != 'PENDING'
							AND tb_peminjaman.status != 'DIKEMBALIKAN'");
						}else{
							$sql = $koneksi->query("SELECT * FROM tb_peminjaman,tb_arsip,tb_pengguna
							WHERE tb_peminjaman.id_arsip = tb_arsip.id_arsip
							AND tb_peminjaman.nip = tb_pengguna.nip
							AND tb_peminjaman.status !='PENDING' 
							AND tb_peminjaman.status !='DIKEMBALIKAN'
							AND tb_pengguna.bidang='".$sesi['bidang']."'");
						}
						while ($data= $sql->fetch_array()){
						?>

						<tr>

							<td>
								<?php echo $no++; ?>
							</td>

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
							<!-- <td>
								
								<?php echo $data['jumlah']; ?>
							</td> -->
							<td>
								<?php echo $data['tgl_pinjam']; ?>
								
							</td>
							<td>
								<?php echo $data[6]; ?>
							</td>
							<td>
								<?php echo $data ['note']; ?>
							</td>
							
							<td>
								<a href="?page=detailvalidasi&kode=<?php echo $data['id_peminjaman']; ?>" title="detail" class="btn btn-info">
									<i class="glyphicon glyphicon-info-sign"></i>
								</a> <br> <p></p>
								<a href="?page=cetakbapinjam&kode=<?php echo $data['id_peminjaman']; ?>"  title="Cetak" class="btn btn-warning">
									<i class="glyphicon glyphicon-print"></i>
								<?php
								if ($data_level!="Pegawai"){
								?>
								</a> <br> <p></p>
								<a href="?page=kembali&kode=<?php echo $data['id_peminjaman']; ?>"  title="Setuui" class="btn btn-danger">
									<i class="glyphicon glyphicon-download"></i>
								<?php } ?>
								</a>
							</td>
						</tr>
					</tbody>
						<?php
						}
						?>
				</table>
			</div>
				</div>

				<div class="active tab-pane fade" id="kembali">
				<div class="table-responsive">
				<a href="?page=print_pengembalian" title="Cetak Data" class="btn btn-primary">
				<i class="glyphicon glyphicon-print"></i> Print</a>
				<table id="example3" class="table table-bordered table-striped">
					<thead>
						<tr>		
							<th>No.</th>
							<th>No. Pinjam</th>		
							<th>Nama Peminjam</th>
							<th>Kode Klasifikasi</th>
							<th>Uraian Informasi Arsip</th>
							<th>Tanggal Pinjam</th>
							<th>Tanggal Pengembalian</th>
							<th>Status</th>
							<th>Note</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>

						<?php
						$bidang = $_SESSION['bidang'];
						$no=1;
						if($data_level == "Admin"){
							$sql = $koneksi->query("SELECT * FROM tb_peminjaman,tb_arsip,tb_pengguna
							WHERE tb_peminjaman.id_arsip = tb_arsip.id_arsip
							AND tb_peminjaman.nip = tb_pengguna.nip
							AND tb_peminjaman.status = 'DIKEMBALIKAN'");
						}else{
							$sql = $koneksi->query("SELECT * FROM tb_peminjaman,tb_arsip,tb_pengguna
							WHERE tb_peminjaman.id_arsip = tb_arsip.id_arsip
							AND tb_peminjaman.nip = tb_pengguna.nip
							AND tb_peminjaman.status ='DIKEMBALIKAN' 
							AND tb_pengguna.bidang='".$sesi['bidang']."'");
						}
						while ($data= $sql->fetch_array()) {
						?>

						<tr>

							<td>
								<?php echo $no++; ?>
							</td>
							<td>
								<?php echo $data['id_peminjaman']; ?>
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
							</td>
							<td>
								<?php echo $data['tgl_pinjam']; ?>
							</td>
							<td>
								<?php echo $data['tgl_kembali']; ?>
								
							</td>
							<td>
								<?php echo $data[6]; ?>
							</td>
							
							<td>
								<?php echo $data['note_kembali']; ?>
							</td>
							
							<td>
								<!-- <a href="#"  title="Test" class="btn btn-Warning">
									<i class="glyphicon glyphicon-search"></i> -->
							</td>
						</tr>
					</tbody>
						<?php
						}
						?>
				</table>
				</div>
				</div>



			  	
			<!-- tab content  -->
			</div>
		<!-- tab box body -->
		</div>
	</div>
</section>