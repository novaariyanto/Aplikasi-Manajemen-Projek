
<?php 
	 $id_user = $_SESSION['id_user'];
	 $query = mysqli_query($koneksi,"SELECT * FROM tb_user where id_user = '$id_user'");
	 $dd =mysqli_fetch_object($query);

	
	 // standar
	$cari1 = mysqli_query($koneksi,"SELECT * FROM `tb_project` where tb_project.pic ='$id_user' and status >0 ");
	// proses
	$cari2 = mysqli_query($koneksi,"SELECT * FROM `tb_project` where tb_project.pic ='$id_user' and status = 2 ");
	// selesai
	$cari3 = mysqli_query($koneksi,"SELECT * FROM `tb_project` where tb_project.pic ='$id_user' and status = 3 ");
	// belum
	$cari4 = mysqli_query($koneksi,"SELECT * FROM `tb_project` where tb_project.pic ='$id_user' and status = 4 ");

	$da1 = mysqli_num_rows($cari1);
	$da2 = mysqli_num_rows($cari2);
	$da3 = mysqli_num_rows($cari3);
	$da4 = mysqli_num_rows($cari4);

?>
<div class="row">
<div class="span4">
	<div class="panel panel-default " style="padding: 10pt;">
		<font style="font-size: 25pt; font-family:serif;"><?=$dd->fullname;?></font> <br/>
		kamu memiliki Projek Sebagai berikut :
	</div>
</div>
</div>
<div class="row">

	<div class="col-md-3" style="text-align: center;">
		<div class="panel panel-default panel-primary ">
		  <div class="panel-heading" style="font-family: Arial;font-size: 25px;">Selesai</div>
		  <div class="panel-body" style="font-size: 3em">
			<?=$da3 ;?>
		  </div>
		</div>
	</div>
	<div class="col-md-3" style="text-align: center;">
		<div class="panel panel-default  panel-info ">
		  <div class="panel-heading" style="font-family: Arial;font-size: 25px;">Dalam Pengerjaan</div>
		  <div class="panel-body" style="font-size: 3em">
		    <?=$da2; ?>
		  </div>
		</div>
	</div>
	<div class="col-md-3" style="text-align: center;">
		<div class="panel panel-default  panel-danger ">
		  <div class="panel-heading" style="font-family: Arial;font-size: 25px;">Belum Dikerjakan</div>
		  <div class="panel-body" style="font-size: 3em">
		    <?=$da4 ;?>
		  </div>
		</div>
	</div>
		<div class="col-md-3" style="text-align: center;">
		<div class="panel panel-default panel-success">
		  <div class="panel-heading" style="font-family: Arial;font-size: 25px;">Semua Projek</div>
		  <div class="panel-body" style="font-size: 3em">
			<?=$da1;?>
		  </div>
		</div>
	</div>
</div>