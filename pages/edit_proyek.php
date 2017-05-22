<?php 
$id_project = $_GET['id_project'];
$query = mysqli_query($koneksi,"SELECT *  FROM tb_project WHERE id_project = $id_project ");
$d = mysqli_fetch_object($query);

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
	<title>Edit Data Proyek</title>
</head>
<body>
<div class="col-md-3">
	<h4><span class="glyphicon glyphicon-user"></span> Edit Data Proyek</h4>
	</div>
	
	<div class="col-md-12">
<hr>
	<form method="post" action="">

		<div class="col-md-5">
			<div class="form-group">
    			<label>Nama Proyek</label>
    			<input type="text" name="nama_proyek" class="form-control" placeholder="Nama proyek" required="required" value="<?php echo $d->project_name; ?>">
 			 </div>

		  <div class="form-group">
		   <label>Client</label>
		   	<select class="form-control" name="id_client"> 
		   		<option>Pilih Client</option>

				   <?php 
				   $query = mysqli_query($koneksi,"SELECT *  FROM tb_client WHERE status =1 order by id_client ASC ")or die(mysqli_error($koneksi));
					while ($data = mysqli_fetch_object($query)) 
						{?>

						<option
						 <?php
						  if($data->id_client){ echo "selected"; 
						  } ?>
						 value='<?php echo $data->id_client; ?>' >
						 <?php echo $data->client_name; }?>
							
						</option>
		    </select>
		  </div>


			 <div class="form-group">
		    <label>Nomor Kontrak</label>
		    <input type="text" name="no_kontrak" class="form-control" placeholder="Nomor Kontrak" value="<?php echo $d->contract_no; ?>" required="required">
		  </div>
		  <div class="form-group">
		    <label>Nilai</label>
				<div class="form-group">
					<input type="number" name="nilai" class="form-control" placeholder="Nilai" required value="<?php echo $d->project_value; ?>">
				</div>
		  </div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
    			<label>Hari Dimulai</label>
    			<input type="date" name="hari_mulai" required class="form-control" value="<?php echo $d->start_date; ?>" ?>
    			 </div>
		  <div class="form-group">
		    <label>Hari Selesai</label>
		    <input type="date" name="hari_selesai" required="" class="form-control" 
		    value="<?php echo $d->end_date?>">
		  </div>
			<div class="form-group">
		    <label>PIC</label>
		    <select class="form-control" name="pic" required=""> 
		    	<option>pilih PIC</option>
		    	<?php 
		    	$qry = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE status =1 ");
		    	while ($da =mysqli_fetch_object($qry)) {
		    		# code...
		    	?>
		    	<option <?php if($da->id_user == $d->pic){echo "selected";}?> value='<?php echo  $da->id_user; ?>'><?php echo $da->fullname; ?></option>";
		    	<?php echo $d->id_user; ?>
			<?php } ?>
		    </select>

		  </div>
	  </div>
	  <div class="col-md-5">
			  	<input type="submit" name="simpan" class="btn btn-success" value="Simpan">	
				<a href="?pages=proyek" class="btn btn-danger">Kembali</a>
			  	<?php
			if(isset($_POST['simpan'])){
				$simpan = mysqli_query($koneksi,"UPDATE tb_project SET project_name='$nama_proyek',id_client='$id_client',contract_no='$no_kontrak',project_value='$nilai',start_date='$hari_mulai',end_date='$hari_selesai',pic='$pic' WHERE id_project = '$id_project'") or die(mysqli_error($koneksi));
			
			insert_log($koneksi,$id_user,$ip,'Mengubah data projek nama projek = '.$nama_proyek.' id_client = '.$id_client.'no kontrak = '.$no_kontrak.'nilai = '.$nilai.'hari mulai = '.$hari_mulai.' hari selesai = '.$hari_selesai.' pic = '.$pic. ' dari id_projek = '.$id_project);
			
				?>
				<br/>
				<br/>
				<div class="alert alert-success">
					<span>Berhasil Memperbarui Data Proyek .</span>
				</div>
				<meta http-equiv="refresh" content="1; url='?pages=proyek'">
				<?php }
		?>
		</div>
			</form>
		</div>
</body>
</html>