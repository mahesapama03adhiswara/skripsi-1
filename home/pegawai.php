<?php
	$sql = $koneksi->query("SELECT count(kode_klasifikasi) as arsip from tb_arsip");
	while ($data= $sql->fetch_assoc()) {
	
		$arsip=$data['arsip'];
	}
?>

<?php
	$sql = $koneksi->query("SELECT count(nip) as pegawai from tb_pengguna");
	while ($data= $sql->fetch_assoc()) {
	
		$pegawai=$data['pegawai'];
	}
?>

<?php
	$sql = $koneksi->query("SELECT count(id_peminjaman) as pinjam from tb_peminjaman where status='Dipinjam'");
	while ($data= $sql->fetch_assoc()) {
	
		$pinjam=$data['pinjam'];
	}
?>

<?php
	$sql = $koneksi->query("SELECT count(id_peminjaman) as kembali from tb_peminjaman where status='Dikembalikan'");
	while ($data= $sql->fetch_assoc()) {
	
		$kembali=$data['kembali'];
	}
?>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard
		<small>Pegawai</small>
	</h1>
</section>

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">

		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<h4>
						<?= $pinjam; ?>
					</h4>

					<p>Peminjaman</p>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
				<a href="?page=peminjaman" class="small-box-footer">More info
					<i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-red">
				<div class="inner">
					<h4>
						<?= $kembali; ?>
					</h4>

					<p>Pengembalian</p>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
				<a href="?page=log_kembali" class="small-box-footer">More info
					<i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>