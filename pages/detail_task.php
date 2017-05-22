<?php 
		
	$id_user = $_SESSION['id_user'];
	$id_project = $_GET['id_project'];
	$hari_ini = date('Y-m-d');
	$qry = mysqli_query($koneksi,"SELECT * FROM tb_project where id_project = $id_project");
	$data = mysqli_fetch_object($qry);

	$qry2 = mysqli_query($koneksi,"SELECT sum(percent_progress)as progres,count(id_task)as total  FROM tb_task  where id_project = $id_project and id_user = $id_user and status >0 ")or die(mysqli_error($koneksi));
		$da = mysqli_fetch_object($qry2);
		$total = $da->total;
		if ($total < 1) {
		
		$total = 0;
				$persen = '0%';
				// belum dikerjakan
			upd_stts_projek($koneksi,4,$id_project);
		}

		else{
				# code...
		$progres = $da->progres;
		$persen = $progres/$total;

		if($persen <100 ){
			// proses
			upd_stts_projek($koneksi,2,$id_project);
		}elseif($persen >= 100){
			// selesai
			upd_stts_projek($koneksi,3,$id_project);
			
		}
		$persen = number_format($persen,2,'.','.');
		$persen = $persen.'%';
			
		}
			
	?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Tugas</title>
</head>
<body>
<div class="col-md-4">
	<div class="panel">
		<div class="panel-body">
			Projek : <?php echo $data->project_name; ?> <br>
			Persentase : 
			
			<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persen;?>;">
    					<?php echo $persen ;?>
						  </div>
						</div>

				




			</div>
		</div>
	</div>
</div>
	<div class="col-md-8">
	<h4> <span class="glyphicon glyphicon-"></span> Data Tugas</h4>
	<!-- Trigger the modal with a button -->
	
	<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Tambah Tugas</button>

	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Tambah Tugas</h4>
				</div>
				<!-- body modal -->
				<div class="modal-body">			 
					<form method="post" action="?pages=task&act=tambah&id_project=<?php echo $id_project; ?>">
					<input type="hidden" name="id_project" value="<?php echo $id_project; ?>">
					<div class="form-group">
					    <label>Nama Tugas</label>
					    <input type="text" name="nama" class="form-control" placeholder="Nama Tugas"
					     required="required">
				 	</div>
				  	<div class="form-group">
					    <label>Tanggal Mulai</label>
					    <input type="date" name="tanggal_mulai" class="form-control" value="<?php echo $hari_ini;?>">
				 	</div>

				  	<div class="form-group">
				    	<label>Tanggal Selesai</label>
							<div class="form-group">
							 <input type="date" name="tanggal_selesai" class="form-control" value="<?php echo $hari_ini;?>">
							</div>
				  	</div>
				</div>
				<!-- footer modal -->
				<div class="modal-footer">
					<input type="submit" name="simpan_tugas" class="btn btn-primary" value="simpan">
				  	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				  		</form>
				</div>
			</div>
		</div>
	</div>
			

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
    	Jumlah Data  <span class="label label-success">
    	<?php 
    	$qjumlah = mysqli_query($koneksi,"SELECT * FROM tb_task where id_user = $id_user and id_project = $id_project")or dir(mysqli_error($koneksi));	
    	$jumlah_data = mysqli_num_rows($qjumlah);
    	echo $jumlah_data; ?></span> 
    </div>
    <!-- /input-group -->
    	<div class="col-md-12">
    	<br/>
    	<center>
	<table class="table table-striped" style="text-align: left;">
			<thead>
				<tr class="bg-success">
					<th>No.</th>
					<th>Nama Pekerjaan</th>
					<th>Tanggal Mulai</th>
					<th>Tanggal Selesai</th>
					<th>Catatan</th>
					<th>Persentase</th>
					<th>Aksi</th>
				</tr>
			</thead>	
			<tbody>
				<tr>
							<?php
						

						$inputan = @$_POST['inputan']; 
						if(isset($_POST['cari'])){
							if($inputan != ""){
								$qtampil = mysqli_query($koneksi,"SELECT * FROM tb_task where id_user = $id_user and id_project = $id_project and task_name LIKE '%$inputan%' and status = 1 ORDER BY id_project DESC")or die (mysqli_error($koneksi));	
							}
							else if($inputan==""){
								$qtampil = mysqli_query($koneksi,"SELECT * FROM tb_task where id_user = $id_user and id_project = $id_project and status =1")or die(mysqli_error($koneksi));	
							}
						} else {
							$qtampil = mysqli_query($koneksi,"SELECT * FROM tb_task where id_user = $id_user and id_project = $id_project and status=1 ")or dir(mysqli_error($koneksi));	
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
						$no=1;
						while($d = mysqli_fetch_object($qtampil)){
					 ?>
				<tr>
					<td><?php echo $no++; ?>.</td>	
					<td><?php echo $d->task_name; ?></td>
					<td><?php echo $d->task_date_start; ?></td>
					<td><?php echo $d->task_date_end; ?></td>
					<td><?php echo $d->task_note; ?></td>
					<td>
					<?php $persent = $d->percent_progress.'%'; ?>
						<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persent;?>;">
    					<?php echo $persent ;?>
						  </div>
						</div>
					</td>	
					<td>
						<a Onclick="return confirm('Tugas <?php echo $d->task_name; ?> Akan anda hapus ?');" <a href="?pages=task&act=hapus&id_task=<?php echo $d->id_task; ?>&id_project=<?php echo $d->id_project; ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span>	</a>	

						<a href="?pages=task&act=edit&id_task=<?php echo $d->id_task; ?>&id_project=<?php echo $d->id_project; ?>" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
							
					</td>
						</center>			
				</tr>
				<?php 
				} } 
				?>
				</tr>

			</tbody>
			</table>
	


	</body>
</html> 