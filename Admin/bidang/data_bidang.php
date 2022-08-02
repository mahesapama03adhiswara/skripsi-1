<section class="content-header">
	<h1>
		Master Data 
		<bold>Bidang </bold>
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
				 
			<a href="?page=add_bidang" title="Tambah Data" class="btn btn-primary">
				<i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
				<div> <br> </div>
			
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Bidang</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
						</tr>
					</thead>	
					<tbody>

						<?php
                  $no = 1;
				  $bidang = $_SESSION['bidang'];				   
                  $sql =  $koneksi->query("SELECT * FROM tb_bidang"); 
                  while ($data= $sql->fetch_assoc()) {
                		?>
						<tr>
							<td>
								<?php echo $no++; ?>
							</td>
							<td>
								<?php echo $data['nama_bidang']; ?>
							</td>
                            <td>
								<?php echo $data['ket']; ?>
							</td>
							
                            <td>
								<a href="?page=edit_bidang&kode=<?php echo $data['id_bidang']; ?>" title="edit" 
								class="btn btn-warning">
								<i class="glyphicon glyphicon-hand-right"></i>
								</a>

								<a href="?page=del_bidang&kode=<?php echo $data['id_bidang']; ?>" onclick="return confirm('Yakin Hapus Data Ini ?')"
								 title="Hapus" class="btn btn-danger ms-1" >
									<i class="glyphicon glyphicon-trash"></i>
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