<?php 
 $ip = $_SERVER['REMOTE_ADDR'];
	$id_user= $_SESSION['id_user'];
$id_project = $_GET['id_project'];
$qry = mysqli_query($koneksi,"update tb_project set status= 0 where id_project = '$id_project' ")or die(mysqli_error($koneksi));
insert_log($koneksi,"$id_user","$ip",'Menghapus data projek dengan id_projek = '.$id_projek );

header('location:index.php?pages=proyek');
?>