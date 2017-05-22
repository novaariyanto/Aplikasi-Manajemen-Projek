<?php 
 $ip = $_SERVER['REMOTE_ADDR'];
$qry = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE status =1 AND role= 2 ORDER BY id_user ASC")or die (mysqli_error($koneksi));

$qry1 = mysqli_query($koneksi,"SELECT * FROM tb_client WHERE status= 1 ORDER BY id_client ASC") OR DIE(mysql_error($koneksi));
		$id_user = $_SESSION['id_user'];
		$nama_proyek = @$_POST['nama_proyek'];
		$id_client = @$_POST['id_client'];
		$no_kontrak = @$_POST['no_kontrak'];
		$nilai = @$_POST['nilai'];
		$hari_mulai = @$_POST['hari_mulai'];
		$hari_selesai = @$_POST['hari_selesai'];
		$pic = @$_POST['pic'];
		$hari_ini = date('Y-m-d');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah Tugas</title>
</head>
<body>
<div class="col-md-3">
	<h4><span class="glyphicon glyphicon-user"></span> Tambah Data Proyek</h4>
	</div>
	
	<div class="col-md-12">
<hr>
	<form method="post" action="">

		<div class="col-md-5">
			<div class="form-group">
    			<label>Nama Proyek</label>
    			<input type="text" name="nama_proyek" class="form-control" placeholder="Nama proyek" required="required">
 			 </div>
		  <div class="form-group">
		    <label>Client</label>
		    <select class="form-control" name="id_client"> 
		   <option>Pilih Client</option>
		   <?php 
while ($data = mysqli_fetch_object($qry1)) {
	# code...
	echo "<option value='$data->id_client'>$data->client_name</option>";
}
		   ?>
		 
		    </select>
		  </div>
		  <?php

		  	$qrr = mysqli_query($koneksi,"SELECT MAX(contract_no)as maxkode from tb_project")or die(mysqli_error($koneksi));
		  	$dk= mysqli_fetch_object($qrr);
		  	$cek = mysqli_num_rows($qrr);
		  	$char = "KN";

		  	if($cek >1){
		  		$kodebaru = $char."001";
		  	}else{
		  	$kodelama = $dk->maxkode;
		  	$nourut = (Int)substr($kodelama,2,3);
		  	$nourut++;
		  	
		  	$kodebaru = $char. sprintf("%03s",$nourut);
		  }

		   ?>
			 <div class="form-group">
		    <label>Nomor Kontrak</label>
		    <input type="text" name="no_kontrak" class="form-control" placeholder="Nomor Kontrak" readonly value="<?php echo $kodebaru; ?>">
		  </div>
		  <div class="form-group">
		    <label>Nilai</label>
				<div class="form-group">
					<input type="number" name="nilai" class="form-control" placeholder="Nilai" required>
				</div>
		  </div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
    			<label>Hari Dimulai</label>
    			<input type="date" name="hari_mulai" required class="form-control" value="<?php echo $hari_ini; ?>">
    			 </div>
		  <div class="form-group">
		    <label>Hari Selesai</label>
		    <input type="date" name="hari_selesai" required="" class="form-control" 
		    value="<?php echo $hari_ini;?>">
		  </div>
			<div class="form-group">
		    <label>PIC</label>
		    <select class="form-control" name="pic" required=""> 
		    	<option>pilih PIC</option>
		    	<?php 
		    	while ($d=mysqli_fetch_object($qry)) {
		    		# code...
		    	echo "<option value='$d->id_user'>$d->fullname</option>";
					}
				?>
		    </select>
		  </div>
	  </div>
	  <div class="col-md-5">
			  	<input type="submit" name="simpan" class="btn btn-success" value="Simpan">	
				<a href="?pages=proyek" class="btn btn-danger">Kembali</a>
			  	<input type="reset" class="btn btn-warning" value="Reset">
			  	<?php 
			if(isset($_POST['simpan'])){
				$simpan = mysqli_query($koneksi,"INSERT INTO tb_project VALUES ('','$nama_proyek','$id_client','$no_kontrak','$nilai','$hari_mulai','$hari_selesai','$pic','$id_user','$hari_ini','4')")or die (mysqli_error($koneksi)); 
				insert_log($koneksi,$id_user,$ip,'Menambah data projek dengan nama = '. $nama_proyek );
				?>
				<br/>
				<br/>	
				<div class="alert alert-success">
					<span>Berhasil Menambah Data Proyek .</span>
				</div>
				<meta http-equiv="refresh" content="1; url='?pages=proyek'">
				<?php }
		?>
		</div>
			</form>
		</div>
</body>
</html>