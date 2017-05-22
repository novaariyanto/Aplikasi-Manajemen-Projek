
<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data User</title>
</head>
<body>
<div class="col-md-3">
	<h4><span class="glyphicon glyphicon-user"></span> Tambah Data User</h4>
	</div>
	
	<div class="col-md-12">
<hr>
		
		<div class="col-md-5">
			<form method="post">
			<div class="form-group">
    			<label>Nama</label>
    			<input type="text" name="nama" class="form-control" placeholder="Nama" required="required">
 			 </div>
		  <div class="form-group">
		    <label>Username</label>
		    <input type="text" name="username" class="form-control" placeholder="Username" required="required">
		  </div>
			 <div class="form-group">
		    <label>Password</label>
		    <input type="password" name="password" class="form-control" placeholder="Password" required="required">
		  </div>
		  <div class="form-group">
		    <label>Level</label>
				<select name="role" class="form-control" required="">
					<option value="">Pilih Level</option>
					<option value="1">Admin</option>
					<option value="2">PIC</option>
				</select>
		  </div>
			  <br>
			  <input type="submit" name="simpan" class="btn btn-success" value="Simpan">	
					

			  <a href="?view=user" class="btn btn-danger">Kembali</a>
			  <input type="reset" class="btn btn-warning" value="Reset">
			</form>

			<?php
					$id_user = $_SESSION['id_user'];
					$nama = @$_POST['nama'];
					$uname = @$_POST['username'];
					$pwd = @$_POST['password'];
					$akses = @$_POST['role'];
					$ip = $_SERVER['REMOTE_ADDR'];
				if(isset($_POST['simpan'])){
					$qry = mysqli_query($koneksi,"select * from tb_user where username = '$uname'");
					if(mysqli_num_rows($qry)== 1){
						echo "<br/><div class='alert alert-danger'>coba lagi ! username sudah ada .</div>
					";
					}else{
					$simpan =mysqli_query($koneksi,"INSERT INTO tb_user VALUES('','$nama','','$uname','$pwd','$akses','',1)")or die (mysqli_error($koneksi));
			
            		insert_log($koneksi,$id_user,$ip,'Menambah data user dengan nama = '. $nama );


				?>
					<br>
					<div class='alert alert-success'>
							Berhasil menambah Data User !
					</div>
					
					<meta http-equiv="refresh" content="1; url='?pages=user'">
					
					<?php
				}}
			?>
		</div>
	</div>

</body>
</html>