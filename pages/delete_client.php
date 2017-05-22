	<?php 
$id_user= $_SESSION['id_user'];
$id_client = $_GET['id_client'];
$qry = mysqli_query($koneksi,"update tb_client set status=0 where id_client = '$id_client' ")or die(mysqli_error($koneksi));
insert_log($koneksi,$id_user,$ip,'Menghapus data client dengan id_client = '.$id_client );

header('location:index.php?pages=client');
?>