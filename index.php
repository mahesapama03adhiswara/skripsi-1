<?php
    //Mulai Sesion
    session_start();
    if (isset($_SESSION["ses_nip"])==""){
		header("location: login.php");

    }else{
      $data_id = $_SESSION["ses_id"];
      $data_nama = $_SESSION["ses_nama"];
      $data_nip = $_SESSION["ses_nip"];
      $data_level = $_SESSION["ses_level"];
	  $bidang = $_SESSION['bidang'];

    }

    //KONEKSI DB
    include "inc/koneksi.php";
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Pengelolaan Arsip Dinamis BPKP</title>
	<link rel="icon" href="dist/img/logo.png">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="plugins/select2/select2.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>

<body class="hold-transition skin-green sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="index.php" class="logo">
				<span class="logo-lg">
					<img src="dist/img/bpkp.png" width="37px">
					<b>BPKP</b>
				</span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- Messages: style can be found in dropdown.less-->
						<li class="dropdown messages-menu">
							<a class="dropdown-toggle">
								<span>
									<b>
										Website Pengelolaan Arsip Dinamis BPKP
									</b>
								</span>
							</a>
						</li>
					</ul>
				</div>
			</nav>
		</header>

		<!-- =============================================== -->

		<!-- Left side column. contains the sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				</<b>
				<div class="user-panel">
					<div class="pull-left image">
						<?php 
						$data_id = $_SESSION["ses_id"];
						$sql = $koneksi->query("SELECT * FROM tb_pengguna WHERE id_pegawai='$data_id'");
						while ($data= $sql->fetch_assoc()) {
						?>
						<!-- <div class="img-circle elevation-2"> -->
						
								<?php
								if ($data['foto'] != null){
								// echo '<img class="rounded" height="500" width="500" src=".dist/img/ $data['foto'];"/>';
								echo '<img class="rounded float-right" src="./dist/img/'.$data['foto'].'" ">';
								} else {
									echo '<img class="rounded float-right" src="dist/img/avatar.png"/>';
								}
								?>
							<!-- </div>  -->
						

						<?php } ?>  
					</div>
					<div class="pull-left info">
						<p>
							<?php echo $data_nama; ?>
						</p>
						<span class="label label-warning">
							<?php echo $data_level; ?>
						</span>
					</div>
				</div>
				</br>
				<!-- /.search form -->
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">
					<li class="header">MAIN NAVIGATION</li>

					<!-- Level  -->
					<?php
					if ($data_level=="Admin"){
					?>
					<li class="treeview">
						<a href="?page=admin">
							<i class="fa fa-dashboard"></i>
							<span>Dashboard</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="#">
							<i class="fa fa-folder"></i>
							<span>Kelola Data</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="?page=MyApp/data_pegawai">
								<i class="fa-solid fa-circle-dot"></i>   Data Pegawai</a>
							</li>
							<li>
								<a href="?page=MyApp/data_arsip_inaktif">
								<i class="fa-solid fa-circle-dot"></i>   Data Arsip Inaktif</a>
							</li>
							<li>
								<a href="?page=MyApp/data_arsip_aktif">
								<i class="fa-solid fa-circle-dot"></i>   Data Arsip Aktif</a>
							</li>
							<li>
								<a href="?page=MyApp/data_mutasi">
								<i class="fa-solid fa-circle-dot"></i>   Data Mutasi Arsip</a>
							</li>
							<li>
								<a href="?page=MyApp/data_musnah">
								<i class="fa-solid fa-circle-dot"></i>   Data Pemusnahan Arsip</a>
							</li>
						</ul>
					</li>


					<li class="treeview">
						<a href="#">
						<i class="fa fa-shopping-cart"></i>
							<span>Transaksi</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
						<li>
							<a href="?page=peminjaman">
							<i class="fa-solid fa-circle-dot"></i></i>Data Pinjam Arsip Inaktif</a>
						</li>
						<li>
							<a href="?page=penggunaan_bahan">
							<i class="fa-solid fa-circle-dot"></i></i>Data Pengembalian Arsip Inaktif</a>
						</li>
						


		  				</ul>
		  			</li>

					<li class="treeview">
						<a href="#">
							<i class="fa fa-print"></i>
							<span>Laporan</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="admin/pegawai/print_pegawai.php" target="blank">
									<i class="fa-solid fa-circle-dot"></i></i>Data Pegawai</a>
							</li>
							<li>
								<a href="admin/arsipi/print_arsip.php" target="blank">
									<i class="fa-solid fa-circle-dot"></i></i>Data Arsip Inaktif</a>
							</li>
							<li>
								<a href="admin/arsipa/print_arsip.php">
									<i class="fa-solid fa-circle-dot"></i></i>Data Arsip Aktif</a>
							</li>
							<li>
								<a href="admin/peminjaman/print_peminjaman.php" target="blank">
									<i class="fa-solid fa-circle-dot"></i></i>Data Mutasi Arsip</a>
							</li>
							<li>
								<a href="admin/peminjaman/print_pengembalian.php" target="blank">
									<i class="fa-solid fa-circle-dot"></i></i>Data Peminjaman</a>
							</li>
							<li>
								<a href="admin/peminjaman/print_pengembalian.php" target="blank">
									<i class="fa-solid fa-circle-dot"></i></i>Data Pengembalian</a>
							</li>
						</ul>
					</li>

					
					<?php
					} elseif($data_level=="Pegawai"){
					?>
					<li class="treeview">
						<a href="?page=petugas">
							<i class="fa fa-dashboard"></i>
							<span>Dashboard</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="?page=petugas_peminjaman">
							<i class="fa fa-refresh"></i>
							<span>Peminjaman</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="#">
							<i class="fa fa-book"></i>
							<span>Log Data</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">

							<li>
								<a href="?page=log_pinjam">
									<i class="fa fa-arrow-circle-o-down"></i>Peminjaman</a>
							</li>
							<li>
								<a href="?page=log_kembali">
									<i class="fa fa-arrow-circle-o-up"></i>Pengembalian</a>
							</li>
						</ul>
					</li>

					

					<!-- <li class="treeview">
						<a href="#">
							<i class="fa fa-book"></i>
							<span>Log Data</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">

							<li>
								<a href="?page=log_pinjam">
									<i class="fa fa-arrow-circle-o-down"></i>Peminjaman</a>
							</li>
							<li>
								<a href="?page=log_kembali">
									<i class="fa fa-arrow-circle-o-up"></i>Pengembalian</a>
							</li>
						</ul>
					</li> -->

					<?php
					}
					?>

					
					<li class="header">SETTING</li>

				<li class="treeview">
					<a href="?page=MyApp/profil">
						<i class="fa fa-user"></i>
						<span>Profile</span>
						<span class="pull-right-container">
						</span>
					</a>
				</li>

				<li>
						<a href="logout.php" onclick="return confirm('Anda yakin keluar dari aplikasi ?')">
							<i class="fa fa-sign-out"></i>
							<span>Logout</span>
							<span class="pull-right-container"></span>
						</a>
					</li>


			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- =============================================== -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<!-- Main content -->
			<section class="content">
				<?php 
      if(isset($_GET['page'])){
          $hal = $_GET['page'];
  
          switch ($hal) {
              //Klik Halaman Home Pengguna
              case 'admin':
                  include "home/admin.php";
                  break;
              case 'pegawai':
                  include "home/pegawai.php";
                  break;
              
        
              //Pengguna
              case 'MyApp/data_pengguna':
                  include "admin/pengguna/data_pengguna.php";
                  break;
              case 'MyApp/add_pengguna':
                  include "admin/pengguna/add_pengguna.php";
                  break;
              case 'MyApp/edit_pengguna':
                  include "admin/pengguna/edit_pengguna.php";
                  break;
              case 'MyApp/del_pengguna':
                  include "admin/pengguna/del_pengguna.php";
				  break;
              case 'MyApp/profil':
                  include "admin/profil/data_profil.php";
				  break;
              case 'MyApp/edit_profil':
                  include "admin/profil/edit_profile.php";
				  break;

              //pegawai
              case 'MyApp/data_pegawai':
                  include "admin/pegawai/data_pegawai.php";
                  break;
              case 'MyApp/add_pegawai':
                  include "admin/pegawai/add_pegawai.php";
                  break;
              case 'MyApp/edit_pegawai':
                  include "admin/pegawai/edit_pegawai.php";
                  break;
              case 'MyApp/del_pegawai':
                  include "admin/pegawai/del_pegawai.php";
                  break;

              //arsip inaktif
              case 'MyApp/data_arsip_inaktif':
                  include "admin/arsipi/data_arsip.php";
                  break;
              case 'MyApp/add_arsip_inaktif':
                  include "admin/arsipi/add_arsip.php";
                  break;
              case 'MyApp/edit_arsip_inaktif':
                  include "admin/arsipi/edit_arsip.php";
                  break;
              case 'MyApp/del_arsip_inaktif':
                  include "admin/arsipi/del_arsip.php";
				  break;

				  //arsip Aktif
				  case 'MyApp/data_arsip_aktif':
					include "admin/arsipa/data_arsip.php";
					break;
				case 'MyApp/add_arsip_aktif':
					include "admin/arsipa/add_arsip.php";
					break;
				case 'MyApp/edit_arsip_aktif':
					include "admin/arsipa/edit_arsip.php";
					break;
				case 'MyApp/del_arsip_aktif':
					include "admin/arsipa/del_arsip.php";
					break;

				//sirkul
              case 'peminjaman':
                  include "admin/transaksi/peminjaman/data_peminjaman.php";
                  break;
              case 'add_peminjaman':
                  include "admin/transaksi/peminjaman/add_peminjaman.php";
                  break;
              case 'kembali':
                  include "admin/transaksi/peminjaman/kembali.php";
				  break;

				//log
				case 'log_pinjam':
					include "admin/log/log_pinjam.php";
					break;
				case 'log_kembali':
					include "admin/log/log_kembali.php";
					break;

				



				
					
             

          
              //default
              default:
				  echo "<center><br><br><br><br><br><br><br><br><br>
				  <h1> Halaman tidak ditemukan !</h1></center>";
                  break;    
          }
      }else{
        // Auto Halaman Home Pengguna
          if($data_level=="Admin"){
              include "home/admin.php";
              }
                  elseif($data_level=="Pegawai"){
                      include "home/pegawai.php";
                      }
                        }
    ?>



			</section>
			<!-- /.content -->
		</div>

		<!-- /.content-wrapper -->

		<footer class="main-footer">
			<div class="pull-right hidden-xs">
			</div>
			<center><strong>Copyright &copy; Nur Azizah Rizali
		</footer>
		<div class="control-sidebar-bg"></div>

		<!-- ./wrapper -->

		<!-- jQuery 2.2.3 -->
		<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
		<!-- Bootstrap 3.3.6 -->
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="https://kit.fontawesome.com/69a8585055.js"></script>	

		<script src="plugins/select2/select2.full.min.js"></script>
		<!-- DataTables -->
		<script src="plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

		<!-- AdminLTE App -->
		<script src="dist/js/app.min.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="dist/js/demo.js"></script>
		<!-- page script -->


		<script>
			$(function() {
				$("#example1").DataTable();
				$('#example2').DataTable({
					"paging": true,
					"lengthChange": false,
					"searching": false,
					"ordering": true,
					"info": true,
					"autoWidth": false
				});
			});
		</script>

		<script>
			$(function() {
				//Initialize Select2 Elements
				$(".select2").select2();
			});
		</script>
</body>

</html>