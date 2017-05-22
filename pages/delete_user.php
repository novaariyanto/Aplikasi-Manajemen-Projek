<?php 
$id_user= $_SESSION['id_user'];
$id_user = $_GET['id_user'];
$qry = mysqli_query($koneksi,"UPDATE tb_user set status=0 where id_user = '$id_user' ")or die(mysqli_error($koneksi));
insert_log($koneksi,$id_user,$ip,'Menghapus data user dengan id_user = '.$id_user );
header('location:index.php?pages=user');
?>