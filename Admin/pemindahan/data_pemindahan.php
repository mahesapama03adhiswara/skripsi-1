<section class="content-header">
	<h1>
		Data
		<bold>Pindah Arsip Inaktif </bold>
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
				  
			<a href="?page=add_pindah" title="Tambah Data" class="btn btn-primary">
				<i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
				<a href="?page=print_pemindahan" title="Cetak Data" class="btn btn-primary">
				<i class="glyphicon glyphicon-print"></i> Print</a>
				<div> <br> </div>
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>No. Laporan</th>
                            <th>Nama Arsip</th>
							<th>Tanggal Pindah </th>
                            <th>Rak</th>
							<th>Box</th>
							<th>Tempat</th>
							<th>Note</th>
                            <th>Aksi</th>
						</tr>
					</thead>	
					<tbody>

						<?php
                  $no = 1;
				  $bidang = $_SESSION['bidang'];				   
                  $sql =  $koneksi->query("SELECT * FROM tb_arsip WHERE tempat='Banjarmasin'"); 
                  while ($data= $sql->fetch_assoc()) {
                		?>
						<tr>
							<td>
								<?php echo $no++; ?>
							</td>
							<td>
								<?php echo $data['no_laporan']; ?>
							</td>
							<td>
								<?php echo $data['nama_arsip']; ?>
							</td>
							<td>
								<?php echo $data['tgl_pindah']; ?>
							</td>
                            <td>
								<?php echo $data['rak']; ?>
							</td>
							<td>
								<?php echo $data['box']; ?>
							</td>
                            <td>
								<?php echo $data['tempat']; ?>
							</td>
							<td>
								<?php echo $data['note_pindah']; ?>
							</td>
                            <td>
								<a href="?page=edit_pindah&kode=<?php echo $data['id_arsip']; ?>" 
								 title="Edit" class="btn btn-warning ms-1" >
									<i class="glyphicon glyphicon-edit"></i>
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