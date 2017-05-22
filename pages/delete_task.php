<?php 
$id_user= $_SESSION['id_user'];
$id_task = $_GET['id_task'];
$id_project = $_GET['id_project'];
$qry = mysqli_query($koneksi,"UPDATE tb_task set status=0 where id_task = '$id_task' ")or die(mysqli_error($koneksi));

insert_log($koneksi,$id_user,$ip,'Menghapus data tugas dengan id_tugas = '.$id_task );

header("location:index.php?pages=task&act=detail&id_project=$id_project");
?>