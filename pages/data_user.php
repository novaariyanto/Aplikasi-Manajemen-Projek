<!DOCTYPE html>
<html>
<head>
	<title>Data User</title>
</head>
<body>
	<div class="col-md-4">
	<h4> <span class="glyphicon glyphicon-user"></span>	User</h4>
	<!-- Trigger the modal with a button -->
					<a href="?pages=user&act=tambah" class="btn btn-sm btn-success"> <span class="glyphicon glyphicon-add"></span> Tambah User</a>
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
    	$qjumlah = mysqli_query($koneksi,"select * from tb_user where status=1");	
    	$jumlah_data = mysqli_num_rows($qjumlah);
    	echo $jumlah_data; ?></span> 
    </div>

    <!-- /input-group -->
    	<div class="col-md-12">
    	<br/>
    	<center>
	<table class="table table-bordered" >
			<thead>
				<tr class="bg-success">
					<th>No.</th>
					<th>Fullname</th>
					<th>Username</th>
					<th>Password</th>
					<th>Level</th>
					<th>Last Login</th>
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
								$qtampil = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE fullname LIKE '%$inputan%' and status=1 ORDER BY id_user DESC ");
							}
							else if($inputan==""){
								$qtampil = mysqli_query($koneksi,"SELECT * FROM tb_user where status=1 ORDER BY id_user DESCLIMIT $posisi,$batas");
							}
						} else {
							$qtampil = mysqli_query($koneksi,"SELECT * FROM tb_user where status=1 ORDER BY id_user DESC LIMIT $posisi,$batas");
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
					<td><?php echo $d->fullname; ?></td>
					<td><?php echo $d->username; ?></td>
					<td><?php echo $d->password; ?></td>
					<td><?php if ($d->role >1) {echo "PIC";}elseif($d->role <2){echo "Admin";}; ?></td>
					<td><?php echo $d->lastlogin; ?></td>
					<td>
						<a Onclick="return confirm('User <?php echo $d->fullname; ?> Akan anda hapus ?');" <a href="?pages=user&act=hapus&id_user=<?php echo $d->id_user; ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span>	</a>		
						<a href="?pages=user&act=edit&id_user=<?php echo $d->id_user; ?>" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-edit"></span>	</a>
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
      <a href="?pages=user&hal=<?php echo $pri; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    		
    </li>
    <?php 
    	for($i=1; $i<=$hal; $i++){
    ?>
    <li <?php if($i==$page){echo "class='active'";} ?>><a href="?pages=user&hal=<?php echo $i; ?>"><?php echo $i; ?>	</a></li>
    <?php } ?>
    <li>
      <?php 
      if($page!=$hal){
      $next = $page+1; 
    	}else {
    		$next=$page+0;
    	}
      ?>
      <a href="?pages=user&hal=<?php echo $next; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
		</center>
	</body>
</html> 