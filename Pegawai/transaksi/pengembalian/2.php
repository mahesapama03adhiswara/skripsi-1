<?php
    if(isset($_GET['kode'])){
        $jumlah = $_GET['jumlah'];
        $selSto = mysqli_query($koneksi, "SELECT * FROM tb_barang WHERE id_barang='" . $_GET['kode'] . "'");
        $sto    = mysqli_fetch_array($selSto);
        $stok   = $sto['stok'];
        $hasil = (int)$jumlah + (int)$stok;
        $sql_ubah = "UPDATE tb_peminjaman SET status='KEM', tgl_kembali='" . date('Y-m-d H:i:s') . "' WHERE id_peminjaman='".$_GET['kode']."'";
    if($sql_ubah) {
        $upstok = mysqli_query($koneksi, "UPDATE tb_barang SET stok='$hasil' WHERE id_barang='" .$_GET['id_barang']. "'");
    }
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);


    if ($query_ubah) {
        echo "<script>
        Swal.fire({title: 'Kembalikan Barang Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=peminjaman';
            }
        })</script>";
        }else{
        echo "<script>
        Swal.fire({title: 'Kembalikan Buku Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=peminjaman';
            }
        })</script>";
    }
	}
