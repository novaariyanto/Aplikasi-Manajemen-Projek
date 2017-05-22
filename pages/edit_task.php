		<?php 	
		 		$ip = $_SERVER['REMOTE_ADDR'];
				$id_user = $_SESSION['id_user'];
				
				$id_project = $_GET['id_project'];
				$id_task = $_GET['id_task'];
			if(isset($_POST['simpan'])){
				$persen = $_POST['persen'];
				$note = $_POST['catatan'];
				$update_persentase = mysqli_query($koneksi,"UPDATE tb_task SET 
				percent_progress = '$persen' ,
				task_note = '$note'
				where id_task = '$id_task '
				 ")or die(mysqli_error($koneksi));

				insert_log($koneksi,$id_user,$ip,'Memperbarui data tugas persentase dari projek menjadi = '.$persen.'dan memberi catatan = '.$note);

			header("location:index.php?pages=task&act=detail&id_project=$id_project");
		}
		$qry = mysqli_query($koneksi,"SELECT * FROM tb_task where id_task = '$id_task'")or die(mysqli_error($koneksi)) ;
		$d = mysqli_fetch_object($qry);
				 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="col-md-3">
	<h4><span class="glyphicon glyphicon-user"></span> Perbarui Data Pekerjaan</h4>
	</div>
	
	<div class="col-md-12">
<hr>
		
		<div class="col-md-5">
			<form method="post" action="">
		
		  <div class="form-group">
		    <label>Persentase</label>
		 
		    <input type="text" name="persen" class="form-control" placeholder="Persentase"  value="<?php echo $d->percent_progress;?>" required="required">
		  </div>
			 <div class="form-group">
		    <label>Catatan</label>
		    <input type="text" name="catatan" class="form-control" placeholder="Catatan" value="<?php echo $d->task_note; ?>">
		  </div>
		 			  <br>
			  <input type="submit" name="simpan" class="btn btn-success" value="Simpan">	
			  <a href="?pages=task&act=detail&id_project=<?php echo  $id_project;?>" class="btn btn-danger">Kembali</a>
			 
			</form>
		</div>

	</div>
</body>
</html>
					