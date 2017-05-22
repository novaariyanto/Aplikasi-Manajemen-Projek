<?php 
$id_user = $_SESSION['id_user'];
$ip = $_SERVER['REMOTE_ADDR'];
$qry = mysqli_query($koneksi,"select * from tb_user where id_user ='$id_user' ")or die(mysqli_error());
$d = mysqli_fetch_object($qry);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Client</title>
</head>
<body>
<div class="col-md-3">
	<h4><span class="glyphicon glyphicon-user"></span> Tambah Data Client </h4>
	</div>
	
	<div class="col-md-12">
<hr>
		
		<div class="col-md-5">
			<form method="post" action="">
		
		  <div class="form-group">
		    <label>Nama</label>
		    <input type="text" name="name" class="form-control" placeholder="Nama" required="required">
		  </div>
			 <div class="form-group">
		    <label>Alamat</label>
		    <input type="text" name="addr" class="form-control" placeholder="Alamat" required="required">
		  </div>
		  <div class="form-group">
		    <label>Telephone</label>
				<input type="number" name="telp" class="form-control" placeholder="Telephone" required="required">
		
		  </div>
			  <br>
			  <input type="submit" name="simpan" class="btn btn-success" value="Simpan">	
			  <a href="?view=user" class="btn btn-danger">Kembali</a>
			  <input type="reset" class="btn btn-warning" value="Reset">
			  <?php 
					$nama = @$_POST['name'];
					$alamat = @$_POST['addr'];
					$telp = @$_POST['telp'];
					$id = $d->id_user;
					if(isset($_POST['simpan'])){
						$simpan = mysqli_query($koneksi,"INSERT INTO tb_client VALUES('','$nama','$alamat','$telp','$id','','1	')")or die(mysqli_error($koneksi));
						insert_log($koneksi,$id_user,$ip,'Menambah data client dengan nama = '. $nama );
						header('location:index.php?pages=client');
					}
			  ?>
			</form>
		</div>

	</div>
</body>
</html>