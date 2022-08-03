<?php
	error_reporting(E_ALL^ (E_NOTICE | E_WARNING));
    //KONEKSI DB
    include "inc/koneksi.php";
	
    //Mulai Sesion
    session_start();
    if ($_SESSION["ses_nip"]){
		$user =$_SESSION['ses_nip'];
        $sql = mysqli_query($koneksi,"SELECT * FROM tb_pengguna,tb_bidang
		WHERE tb_pengguna.bidang = tb_bidang.id_bidang AND  
		nip='$user'");
		// $sql = $koneksi->query("SELECT * FROM  WHERE nip='$user'");
        $sesi = mysqli_fetch_assoc($sql);

      $data_id = $_SESSION["ses_id"];
      $data_nama = $_SESSION["ses_nama"];
      $data_nip = $_SESSION["ses_nip"];
      $data_level = $_SESSION["ses_level"];
	  $bidang = $_SESSION['bidang'];

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
	<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"> -->

	<script data-require="moment.js@2.10.2" data-semver="2.10.2" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/locale/id.min.js" integrity="sha512-he8U4ic6kf3kustvJfiERUpojM8barHoz0WYpAUDWQVn61efpm3aVAD8RWL8OloaDDzMZ1gZiubF9OSdYBqHfQ==" crossorigin="anonymous"></script>
	
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

	<!-- fullCalendar -->
<script src="../bower_components/moment/moment.js"></script>
<script src="../bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<!-- Page specific script -->
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
						
								<?php if ($data['foto'] == "" || $data['foto'] == null){
									?>
									echo '<img class="rounded float-right" src="./dist/img/'.$data['foto'].'" ">';
								<?php }else{
								?>
									<img class="rounded float-right" src="Admin/pegawai/futu/<?= $sesi['foto']; ?>"/>
								<?php
								}
								?>
							<!-- </div>  -->
						

						<?php } ?>  
					</div>
					<div class="pull-left info">
						<p>
							<?= $data_nama; ?>
						</p>
						<span class="label label-warning">
							<?php
								if ($data_level == "Admin"){
									echo $data_level;
								}else{
									echo $data_level; echo " "; echo $sesi['nama_bidang'];
								}
							?>
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
								<i class="fa-solid fa-circle-dot"></i>   Data Arsip</a>
							</li>
							<!-- <li>
								<a href="?page=MyApp/data_arsip_aktif">
								<i class="fa-solid fa-circle-dot"></i>   Data Arsip Aktif</a>
							</li> -->
							<li>
								<a href="?page=data_bidang">
								<i class="fa-solid fa-circle-dot"></i>   Data Bidang</a>
							</li>
							<!-- <li>
								<a href="?page=data_retensi">
								<i class="fa-solid fa-circle-dot"></i>   Data Retensi</a>
							</li> -->
							
						</ul>
					</li>


					<li class="treeview">
						<a href="#">
						<i class="fa fa-book"></i>
							<span>Transaksi Arsip</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
						<li>
							<a href="?page=peminjaman">
							<i class="fa-solid fa-circle-dot"></i></i>Data Pinjam</a>
						</li>
						<li>
							<a href="?page=data_mutasi">
							<i class="fa-solid fa-circle-dot"></i></i>Data Mutasi Arsip</a>
						</li>
						<li>
							<a href="?page=data_pindah">
							<i class="fa-solid fa-circle-dot"></i></i>Data Pindah Arsip</a>
						</li>
						<li>
							<a href="?page=data_musnah">
							<i class="fa-solid fa-circle-dot"></i> Data Pemusnahan Arsip</a>
						</li>
						<!-- <li>
							<a href="?page=pengembalian">
							<i class="fa-solid fa-circle-dot"></i></i>Data Pengembalian Pinjam Arsip</a>
						</li> -->
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
								<a class="nav-link" data-toggle="modal" data-target="#modal-peg">
									<i class="fa-solid fa-circle-dot"></i></i>Data Pegawai</a>
							</li>
							<li>
								<a class="nav-link" data-toggle="modal" data-target="#modal-arsip-inaktif">
									<i class="fa-solid fa-circle-dot"></i></i>Data Arsip Inaktif</a>
							</li>
							<li>
								<a class="nav-link" data-toggle="modal" data-target="#modal-arsip-aktif">
									<i class="fa-solid fa-circle-dot"></i></i>Data Arsip Aktif</a>
							</li>
							<li>
								<a class="nav-link" data-toggle="modal" data-target="#modal-mutasi">
									<i class="fa-solid fa-circle-dot"></i></i>Data Mutasi Arsip</a>
							</li>
							<li>
								<a class="nav-link" data-toggle="modal" data-target="#modal-pinjam">
									<i class="fa-solid fa-circle-dot"></i></i>Data Peminjaman Arsip</a>
							</li>
							<li>
								<a class="nav-link" data-toggle="modal" data-target="#modal-pengembalian">
									<i class="fa-solid fa-circle-dot"></i></i>Data Pengembalian Arsip</a>
							</li><li>
								<a class="nav-link" data-toggle="modal" data-target="#modal-pindah">
									<i class="fa-solid fa-circle-dot"></i></i>Data Pemindahan Arsip</a>
							</li>
							<li>
								<a class="nav-link" data-toggle="modal" data-target="#modal-musnah">
									<i class="fa-solid fa-circle-dot"></i></i>Data Pemusnahan Arsip </a>
							</li>

						</ul>
					</li>

					
					<?php
					} elseif($data_level=="Pegawai"){
					?>
					<li class="treeview">
						<a href="?page=pegawai">
							<i class="fa fa-dashboard"></i>
							<span>Dashboard</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="?page=MyApp/data_arsip_inaktif">
							<i class="fa fa-folder"></i>
							<span>Data Arsip</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<!-- <li class="treeview">
						<a href="#">
							<i class="fa fa-folder"></i>
							<span>Kelola Data</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
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
							
						</ul>
					</li> -->

					<li class="treeview">
						<a href="#">
							<i class="fa fa-folder"></i>
							<span>Transaksi</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="?page=peminjaman">
								<i class="fa-solid fa-circle-dot"></i>   Peminjaman</a>
							</li>
							<li>
								<a href="?page=data_mutasi">
								<i class="fa-solid fa-circle-dot"></i>   Mutasi</a>
							</li>
														
						</ul>
					</li>
					
					

					<!-- <li class="treeview">
						<a href="#">
							<i class="fa fa-folder"></i>
							<span>Laporan</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">

							<li>
								<a href="?page=log_pinjam">
									<i class="fa fa-arrow-circle-o-down"></i>Laporan Pegawai</a>
							</li>
							<li>
								<a href="?page=log_kembali">
									<i class="fa fa-arrow-circle-o-up"></i>Laporan Peminjaman</a>
							</li>
							<li>
								<a href="">
									<i class="fa fa-arrow-circle-o-up"></i>Laporan Peminjaman</a>
							</li>
						</ul>
					</li> -->

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

				<!-- <li class="treeview">
					<a href="?page=MyApp/profil">
						<i class="fa fa-user"></i>
						<span>Profile</span>
						<span class="pull-right-container">
						</span>
					</a>
				</li> -->

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
              case 'edit_pegawai':
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
			 case 'MyApp/download':
					include "admin/arsipi/download.php";
					break;
			// case 'download':
            //       include "admin/arsipi/download.php";
			// 	  break;

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

				//peminjaman
				case 'add_peminjaman':
					include "admin/transaksi/peminjaman/add_peminjaman.php";
					break;
				case 'peminjaman':
					include "admin/transaksi/peminjaman/data_peminjaman.php";
					break;
				case 'validasi':
					include "admin/transaksi/peminjaman/validasi_pinjam.php";
					break;
				case 'kembali':
					include "admin/transaksi/peminjaman/kembali.php";
					break;
				case 'del_peminjaman':
					include "admin/transaksi/peminjaman/del_peminjaman.php";
					break;
				case 'cetakbapinjam':
					include "admin/laporan/ba_peminjaman1.php";
					break;

				// mutasi 
				case 'data_mutasi':
					include "admin/mutasi/data_mutasi.php";
					break;
				case 'add_mutasi':
					include "admin/mutasi/add_mutasi.php";
					break;
				case 'del_mutasi':
					include "admin/mutasi/del_mutasi.php";
					break;
				case 'detail_mutasi':
					include "admin/mutasi/detail_arsip.php";
					break;
				case 'edit_mutasi':
					include "admin/mutasi/edit_mutasi.php";
					break;
				case 'validasi_mut':
					include "admin/mutasi/validasi_mut.php";
					break;
				case 'cetakbamutasi':
					include "admin/laporan/ba_mutasi.php";
					break;


				//data retensi
				case 'data_retensi':
					include "admin/retensi/data_retensi.php";
					break;
				case 'edit_retensi':
					include "admin/retensi/ubah_retensi.php";
					break;
				case 'del_retensi':
					include "admin/retensi/hapus_retensi.php";
					break;
				case 'add_retensi':
					include "admin/retensi/hapus_retensi.php";
					break;
			

				//pemindahan
				case 'data_pindah':
					include "admin/pemindahan/data_pemindahan.php";
					break;
				case 'edit_pindah':
					include "admin/pemindahan/edit_pemindahan.php";
					break;
				case 'add_pindah':
					include "admin/pemindahan/add_pemindahan.php";
					break;

				//bidang
				case 'data_bidang':
					include "admin/bidang/data_bidang.php";
					break;
				case 'edit_bidang':
					include "admin/bidang/ubah_bidang.php";
					break;
				case 'del_bidang':
					include "admin/bidang/hapus_bidang.php";
					break;
				case 'add_bidang':
					include "admin/bidang/add_bidang.php";
					break;
				
				// pemusnahan
				case 'data_musnah':
					include "admin/pemusnahan/data_pemusnahan.php";
					break;
				case 'edit_musnah':
					include "admin/pemusnahan/edit_pemusnahan.php";
					break;
				case 'add_musnah':
					include "admin/pemusnahan/add_pemusnahan.php";
					break;

				//cetak semuanya 
				case 'print_pegawai':
					include "admin/laporan/all/lap_pegawai.php";
					break;
				case 'print_arsipi':
					include "admin/laporan/all/lap_arsipi.php";
					break;
				case 'print_arsipa':
					include "admin/laporan/all/lap_arsipa.php";
					break;
				case 'print_mutasi':
					include "admin/laporan/all/lap_mutasi.php";
					break;
				case 'print_pemindahan':
					include "admin/laporan/all/lap_pemindahan.php";
					break;
				case 'print_peminjaman':
					include "admin/laporan/all/lap_peminjaman.php";
					break;
				case 'print_pemusnahan':
					include "admin/laporan/all/lap_pemusnahan.php";
					break;
				case 'print_pengembalian':
					include "admin/laporan/all/lap_pengembalian.php";
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
			<center><strong>Copyright &copy; BPKP@2022
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

		<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script> -->


		<script>
			$(document).ready( function () {
				$('#myTable').DataTable();
			} );
			$(function() {
				$("#example1").DataTable();
				$("#example2").DataTable();
				$("#example3").DataTable();
				$("#example4").DataTable();
				$("#example5").DataTable();
				$("#example6").DataTable();
				$("#example7").DataTable();
				$("#example8").DataTable();
				$("#example9").DataTable();
				$("#example0").DataTable();
				$('#example10').DataTable({
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

<?php  
    }else{
        header("location:login.php");
    }
?>


	<div class="modal fade" id="modal-peg">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pilih Bidang</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="admin/laporan/lap_pegawai.php"method="POST">
                <label for="">Bidang</label>
                <select name="id_bidang"class="form-control" >
                      <option value="">-->PILIH BIDANG<--</option>
                      <?php
                       $sql= mysqli_query($koneksi,"SELECT * FROM tb_bidang ");
                       while ($data= mysqli_fetch_array($sql)){
                         echo "<option value='$data[id_bidang]'>$data[nama_bidang]</option>";
                       }
                      ?>
                   </select>
               
                   <!-- <label for="">BULAN</label>
               
               <select class="form-control" name="bulan" id="">
                    <option value="">-- PILIH BULAN --</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                  
                
                  </select>
                  <label for="">TAHUN</label>
                  <input type="text" name="tahun" class="form-control"> -->
             
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Show Data</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

	
	  <div class="modal fade" id="modal-arsip-inaktif">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pilih Bidang</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="admin/laporan/lap_arsipi.php"method="POST">
                <label for="">Bidang</label>
                <select name="id_bidang"class="form-control" >
                      <option value="">-->PILIH BIDANG<--</option>
                      <?php
                       $sql= mysqli_query($koneksi,"SELECT * FROM tb_bidang");
                       while ($data= mysqli_fetch_array($sql)){
                         echo "<option value='$data[id_bidang]'>$data[nama_bidang]</option>";
                       }
                      ?>
                   </select>
               
                   <label for="">BULAN</label>
               
               	<!-- <select class="form-control" name="bulan" id="">
                    <option value="">-- PILIH BULAN --</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select> -->
                  <label for="">TAHUN</label>
                  <input type="text" name="tahun" class="form-control">
             
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Show Data</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

	  <div class="modal fade" id="modal-arsip-aktif">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pilih Bidang</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="admin/laporan/lap_arsipa.php"method="POST">
                <label for="">Bidang</label>
                <select name="id_bidang"class="form-control" >
                      <option value="">-->PILIH BIDANG<--</option>
                      <?php
                       $sql= mysqli_query($koneksi,"SELECT * FROM tb_bidang");
                       while ($data= mysqli_fetch_array($sql)){
                         echo "<option value='$data[id_bidang]'>$data[nama_bidang]</option>";
                       }
                      ?>
                   </select>
               
                   <label for="">BULAN</label>
               
               	<!-- <select class="form-control" name="bulan" id="">
                    <option value="">-- PILIH BULAN --</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select> -->
                  <label for="">TAHUN</label>
                  <input type="text" name="tahun" class="form-control">
             
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Show Data</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

	  <div class="modal fade" id="modal-mutasi">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pilih Bidang</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="admin/laporan/lap_mutasi.php"method="POST">
                <label for="">Bidang</label>
                <select name="id_bidang"class="form-control" >
                      <option value="">-->PILIH BIDANG<--</option>
                      <?php
                       $sql= mysqli_query($koneksi,"SELECT * FROM tb_bidang");
                       while ($data= mysqli_fetch_array($sql)){
                         echo "<option value='$data[id_bidang]'>$data[nama_bidang]</option>";
                       }
                      ?>
                   </select>
               
                <label for="">BULAN</label>
               	<select class="form-control" name="bulan" id="">
                    <option value="">-- PILIH BULAN --</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>

                  <label for="">TAHUN</label>
                  <input type="text" name="tahun" class="form-control">
             
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Show Data</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

	  <div class="modal fade" id="modal-pinjam">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pilih Bidang</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="admin/laporan/lap_peminjaman.php"method="POST">
                <label for="">Bidang</label>
                <select name="id_bidang"class="form-control" >
                      <option value="">-->PILIH BIDANG<--</option>
                      <?php
                       $sql= mysqli_query($koneksi,"SELECT * FROM tb_bidang");
                       while ($data= mysqli_fetch_array($sql)){
                         echo "<option value='$data[id_bidang]'>$data[nama_bidang]</option>";
                       }
                      ?>
                   </select>
               
                <label for="">BULAN</label>
               	<select class="form-control" name="bulan" id="">
                    <option value="">-- PILIH BULAN --</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>

                  <label for="">TAHUN</label>
                  <input type="text" name="tahun" class="form-control">
             
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Show Data</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

	  <div class="modal fade" id="modal-pengembalian">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pilih Bidang</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="admin/laporan/lap_pengembalian.php"method="POST">
                <label for="">Bidang</label>
                <select name="id_bidang"class="form-control" >
                      <option value="">-->PILIH BIDANG<--</option>
                      <?php
                       $sql= mysqli_query($koneksi,"SELECT * FROM tb_bidang");
                       while ($data= mysqli_fetch_array($sql)){
                         echo "<option value='$data[id_bidang]'>$data[nama_bidang]</option>";
                       }
                      ?>
                   </select>
               
                <label for="">BULAN</label>
               	<select class="form-control" name="bulan" id="">
                    <option value="">-- PILIH BULAN --</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>

                  <label for="">TAHUN</label>
                  <input type="text" name="tahun" class="form-control">
             
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Show Data</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

	  <div class="modal fade" id="modal-pindah">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pilih Bidang</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="admin/laporan/lap_pindah.php"method="POST">
                <label for="">Bidang</label>
                <select name="id_bidang"class="form-control" >
                      <option value="">-->PILIH BIDANG<--</option>
                      <?php
                       $sql= mysqli_query($koneksi,"SELECT * FROM tb_bidang");
                       while ($data= mysqli_fetch_array($sql)){
                         echo "<option value='$data[id_bidang]'>$data[nama_bidang]</option>";
                       }
                      ?>
                   </select>
               
                <label for="">BULAN</label>
               	<select class="form-control" name="bulan" id="">
                    <option value="">-- PILIH BULAN --</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>

                  <label for="">TAHUN</label>
                  <input type="text" name="tahun" class="form-control">
             
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Show Data</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

	  <div class="modal fade" id="modal-musnah">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pilih Bidang</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="admin/laporan/lap_pemusnahan.php"method="POST">
                <label for="">Bidang</label>
                <select name="id_bidang"class="form-control" >
                      <option value="">-->PILIH BIDANG<--</option>
                      <?php
                       $sql= mysqli_query($koneksi,"SELECT * FROM tb_bidang");
                       while ($data= mysqli_fetch_array($sql)){
                         echo "<option value='$data[id_bidang]'>$data[nama_bidang]</option>";
                       }
                      ?>
                   </select>
               
                <!-- <label for="">BULAN</label>
               	<select class="form-control" name="bulan" id="">
                    <option value="">-- PILIH BULAN --</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>

                  <label for="">TAHUN</label> -->
                  <!-- <input type="text" name="tahun" class="form-control"> -->
             
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Show Data</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>