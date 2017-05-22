<?php 
$qry = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE id_user ='".$_SESSION['id_user']."'")or die(mysqli_error());
$d = mysqli_fetch_object($qry);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Selamat Datang !</title>
</head>
<body>
<center>
	<div style="margin-top: 150px;">
		<span style="font-size: 3em; margin-top:100px;" >Aplikasi Manajemen Projek</span>
		<br/>
		<span style="font-size: 2em;">Selamat Datang <font style="font-size: 25pt ;text-transform: capitalize;">
		 <?php echo $d->fullname?></font> ..!!!
		</span>
	</div>
</center>
</body>
</html>