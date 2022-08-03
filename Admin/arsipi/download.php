<?php 
include "inc/koneksi.php";

    // if (isset($_GET['filename'])) {
    // $filename    = $_GET['filename'];

    // $back_dir    ="../Admin/arsipi/file/";
    // $file = $back_dir.$_GET['filename'];
     
    //     if (file_exists($file)) {
    //         header('Content-Description: File Transfer');
    //         header('Content-Type: application/octet-stream');
    //         header('Content-Disposition: attachment; filename='.basename($file));
    //         header('Content-Transfer-Encoding: binary');
    //         header('Expires: 0');
    //         header('Cache-Control: private');
    //         header('Pragma: private');
    //         header('Content-Length: ' . filesize($file));
    //         ob_clean();
    //         flush();
    //         readfile($file);
            
    //         exit;
    //     } 
    //     else {
    //         $_SESSION['pesan'] = "Oops! File - $filename - not found ...";
    //         header("location:index.php");
    //     }
    // }
?>

<div class="cointainer">
    <div class="row">
        <ul class="breadcrumb"style="box-shadow:2px 2px 8px #888888;">
        <h4>DOKUMEN <?php echo $data['file']?></h4>
        </ul>
    </div>
    <?php
        $filename=$_GET['filename'];
        $sql=mysqli_query("SELECT * FROM tb_arsip a,tb_bidang b
        WHERE a.bidang = b.id_bidang 
        AND a.file ='$filename'");
        while ($data=mysqli_fetch_array($sql)){
            ?>


            <object data="../admin/arsipi/file/<?php echo $data['file']?>"width="100%"height="1000px"style="box-shadow:2px 2px 8px #888888;" type=""value=""></object>
            
            <?php
        }
    ?>
</div>