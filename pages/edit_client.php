<?php 
$id_user = $_SESSION['id_user'];
$ip = $_SERVER['REMOTE_ADDR'];
$id_client = @$_GET['id_client'];
$qry = mysqli_query($koneksi,"select * from tb_client where id_client = '$id_client'") or die(mysqli_error($koneksi));
$d = mysqli_fetch_object($qry);

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="col-md-3">
	<h4><span class="glyphicon glyphicon-user"></span> Edit Data Client</h4>
	</div>
	
	<div class="col-md-12">
<hr>
		
		<div class="col-md-5">
			<form method="post" action="">
		
		  <div class="form-group">
		    <label>Nama</label>
		    <input type="text" name="name" class="form-control" placeholder="Nama" value="<?php echo $d->client_name;?>" required="required">
		  </div>
			 <div class="form-group">
		    <label>Alamat</label>
		    <input type="text" name="addr" class="form-control" placeholder="Alamat"  value="<?php echo $d->client_addr ;?>" required="required">
		  </div>
		  <div class="form-group">
		    <label>Telephone</label>
				<input type="number" name="telp" class="form-control" placeholder="Telephone"  value="<?php echo $d->client_phone ;?>" required="required">
		
		  </div>
			  <br>
			  <input type="submit" name="simpan" class="btn btn-success" value="Simpan">	
			  <a href="?pages=client" class="btn btn-danger">Kembali</a>
			  <?php 

					$nama = @$_POST['name'];
					$alamat = @$_POST['addr'];
					$telp = @$_POST['telp'];
					if(isset($_POST['simpan'])){
						$edit = mysqli_query($koneksi,"UPDATE tb_client SET client_name='$nama',client_addr='$alamat',client_phone='$telp' where id_client = '$id_client'") or die(mysqli_error($koneksi));

						insert_log($koneksi,$id_user,$ip,'Mengubah data client dengan id_clien = '. $id_client.'nama = '.$nama.' alamat = '.$alamat.'telephone = '.$telp);

						header('location:index.php?pages=client');
					}
			  ?>
			</form>
		</div>

	</div>
</body>
</html>