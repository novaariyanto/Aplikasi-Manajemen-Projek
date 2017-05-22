<?php 
$ip = $_SERVER['REMOTE_ADDR'];
$idid= $_SESSION['id_user'];

$id_user = $_GET['id_user'];
$qry = mysqli_query($koneksi,"select * from tb_user where id_user='$id_user'")or die(mysqli_error($koneksi));
$d = mysqli_fetch_object($qry);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="col-md-2">
	<h4><span class="glyphicon glyphicon-user"></span> Edit Data User</h4>
	</div>
	
	<div class="col-md-12">
<hr>
		
		<div class="col-md-5">
			<form method="post">
			<div class="form-group">
    			<label>Nama</label>
    			<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $d->fullname;?>" required="required">
 			 </div>
		  <div class="form-group">
		    <label>Username</label>
		    <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $d->username;?>" required="required">
		  </div>
			 <div class="form-group">
		    <label>Password</label>
		    <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo $d->password;?>"required="required">
		  </div>
		  <div class="form-group">
		    <label>Level</label>
				<select name="role" class="form-control" required="">
					<option value="">Pilih Level</option>
					<option <?php if ($d->role == '1'): ?>
						selected
					<?php endif ?> value="1">Admin</option>
					<option <?php if ($d->role == '2'): ?>
						selected
					<?php endif ?> value="2">PIC</option>
				</select>
		  </div>
			  <br>
			  <input type="submit" name="simpan" class="btn btn-success" value="Simpan">	
					

			  <a href="?pages=user" class="btn btn-danger">Kembali</a>
			
			</form>
			<?php
					$nama = @$_POST['nama'];
					$uname = @$_POST['username'];
					$pwd = @$_POST['password'];
					$akses = @$_POST['role'];
				if(isset($_POST['simpan'])){
					$edit =mysqli_query($koneksi,"UPDATE tb_user set fullname='$nama',username='$uname',password='$pwd',role='$akses' where id_user ='$id_user'")or die (mysqli_error($koneksi));

					insert_log($koneksi,$idid,$ip,'Mengubah data user nama user = '.$nama.' username ='.$uname.'password ='.$pwd.'akses = '.$akses.' dari id_user = '. $id_user);
				?>
					<br>
					<div class='alert alert-success'>
							Berhasil mengubah Data User !
					</div>
					
					<meta http-equiv="refresh" content="1; url='?pages=user'">
					
					<?php
				}
			?>
		</div>

	</div>
</body>
</html>