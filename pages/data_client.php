<!DOCTYPE html>
<html>
<head>
	<title>Data Client</title>
</head>
<body>
	<div class="col-md-4">
	<h4> <span class="glyphicon glyphicon-user"></span>	Client</h4>
	<!-- Trigger the modal with a button -->
					<a href="?pages=client&act=tambah" class="btn btn-sm btn-success"> <span class="glyphicon glyphicon-add"></span> Tambah Client</a>
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
    	$qjumlah = mysqli_query($koneksi,"select * from tb_client where status=1");	
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
					<th>nama</th>
					<th>Alamat</th>
					<th>Nomor Telephone</th>
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
								$qtampil = mysqli_query($koneksi,"SELECT * FROM tb_client WHERE status ='1' AND client_name LIKE '%$inputan%' ORDER BY id_client DESC")or die(mysqli_error($koneksi));
							} 
							else if($inputan==""){
								$qtampil = mysqli_query($koneksi,"SELECT * FROM tb_client where status='1'ORDER BY id_client DESC LIMIT $posisi,$batas")or die(mysqli_error($koneksi));
							}
						} else {
							$qtampil = mysqli_query($koneksi,"SELECT * FROM tb_client WHERE status = '1' ORDER BY id_client DESC LIMIT $posisi,$batas")or die(mysqli_error($koneksi));
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
					<td><?php echo $d->client_name; ?></td>
					<td><?php echo $d->client_addr; ?></td>
					<td><?php echo $d->client_phone; ?></td>
					<td>
						<a Onclick="return confirm('Client <?php echo $d->client_name; ?> Akan anda hapus ?');" <a href="?pages=client&act=hapus&id_client=<?php echo $d->id_client; ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span>	</a>		
						<a href="?pages=client&act=edit&id_client=<?php echo $d->id_client; ?>" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-edit"></span>	</a>
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
      <a href="?pages=client&hal=<?php echo $pri; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    		
    </li>
    <?php 
    	for($i=1; $i<=$hal; $i++){
    ?>
    <li <?php if($i==$page){echo "class='active'";} ?>><a href="?pages=client&hal=<?php echo $i; ?>"><?php echo $i; ?>	</a></li>
    <?php } ?>
    <li>
      <?php 
      if($page!=$hal){
      $next = $page+1; 
    	}else {
    		$next=$page+0;
    	}
      ?>
      <a href="?pages=client&hal=<?php echo $next; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
		</center>
	</body>
</html> 