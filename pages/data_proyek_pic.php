<?php 
	$pic = $_SESSION['id_user'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Pekerjaan</title>
</head>
<body>
	<div class="col-md-8">
	<h4> <span class="glyphicon glyphicon-book"></span> Data	Pekerjaan</h4>
	<!-- Trigger the modal with a button -->
				
					<a href="" class="btn btn-sm btn-info"> <span class="glyphicon glyphicon-refresh"></span> Perbarui	</a>
	</div>
<div class="col-md-4">
		<form method="post" action="">
		 <div class="input-group">
      <input type="text" class="form-control" name="inputan" placeholder="Cari data..">
      <span class="input-group-btn">
        <button class="btn btn-success" type="submit" name="cari"><span class="glyphicon glyphicon-search"></span></button>
      </span>
      </div>
      </form>
 <br>
    	Jumlah Data  <span class="label label-success"><?php 
    	$qjumlah = mysqli_query($koneksi,"SELECT * FROM tb_project where pic = '$pic' and status >'0'");	
    	$jumlah_data = mysqli_num_rows($qjumlah);
    	echo $jumlah_data; ?></span> 
    </div>

    <!-- /input-group -->
    	<div class="col-md-11">
    	<br/>
    	<center>
	<table class="table table-bordered" style="text-align:left;">
			<thead >
				<tr class="bg-success">
					<th>No.</th>
					<th>Nama Projek</th>
					<th>Dateline</th>
					<th>Client</th>
					
					<th>Action</th>
				</tr>
			</thead>	
			<tbody>
				<tr>
								<?php
						$batas = 7;
						$hal = ceil($jumlah_data / $batas);
						$page = (isset($_GET['hal'])) ? $_GET['hal']:1;
						$posisi = ($page - 1) * $batas;
						$inputan = @$_POST['inputan']; 
						if(isset($_POST['cari'])){
							if($inputan != ""){
								$qtampil = mysqli_query($koneksi,"SELECT * FROM tb_project 
									 INNER JOIN tb_client ON tb_project.id_client = tb_client.id_client
									 WHERE tb_project.status >'0'
									 AND tb_project.pic ='$pic' and tb_project.project_name
									 LIKE '%$inputan%' ORDER BY tb_project.id_project DESC");
							}
							else if($inputan==""){
								$qtampil = mysqli_query($koneksi,"SELECT *  FROM tb_project 
									INNER JOIN tb_client on tb_project.id_client = tb_client.id_client 	
									WHERE tb_project.status >'0'  and tb_project.pic = $pic
									ORDER BY tb_project.id_project DESC LIMIT $posisi,$batas ");
							}
						} else {
							$qtampil = mysqli_query($koneksi,"SELECT * FROM tb_project 
								INNER JOIN tb_client 
								on tb_project.id_client = tb_client.id_client 
								WHERE tb_project.status >'0' AND tb_project.pic = '$pic'  ORDER BY tb_project.id_project DESC LIMIT $posisi,$batas");
						}
						$cek = mysqli_num_rows($qtampil);
						if($cek <= 0){
							?>
								<tr>
								<td colspan="12"> <center>Data tidak ada ! <a href="" class="btn btn-success">refresh</a></center></td>
								</tr>
							<?php
							echo "<center><h4><small>Hasil cari dari</small> :".$inputan."</h4></center>";
						} else {
						$no=1+$posisi;
						while($d = mysqli_fetch_object($qtampil)){
					 ?>
				<tr>
					<td><?php echo $no++; ?>.</td>	
					<td><?php echo $d->project_name; ?></td>
					<td><?php echo $d->end_date; ?></td>
					<td><?php echo $d->client_name; ?></td>
					
					<td>
							
						<a href="?pages=task&act=detail&id_project=<?php echo $d->id_project; ?>" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-edit"> Detail</span>	</a>
					</td>
				</tr>
				<?php } } ?>
				</tr>

			</tbody>
			</table
			<nav>
  <ul class="pagination">
    <li>
    	<?php 
    		if($page!="1"){
    			$pri = $page-1;	
    		}else if($page == "1"){
    			$pri = $page-0;
    		}
    	?>
      <a href="?pages=proyek_pic&hal=<?php echo $pri; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    		
    </li>
    <?php 
    	for($i=1; $i<=$hal; $i++){
    ?>
    <li <?php if($i==$page){echo "class='active'";} ?>><a href="?pages=proyek_pic&hal=<?php echo $i; ?>"><?php echo $i; ?>	</a></li>
    <?php } ?>
    <li>
      <?php 
      if($page!=$hal){
      $next = $page+1; 
    	}else {
    		$next=$page+0;
    	}
      ?>
      <a href="?pages=proyek_pic&hal=<?php echo $next; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
		</center>
	</body>
</html> 