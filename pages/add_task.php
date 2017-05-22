<?php 
				$id_user = $_SESSION['id_user'];
				$id_project = $_GET['id_project'];
				$hari_ini = date('Y-m-d');
				$nama = @$_POST['nama'];
				$tgl_mulai = @$_POST['tanggal_mulai'];
				$tgl_selesai = @$_POST['tanggal_selesai'];
				$simpan_tugas = mysqli_query($koneksi,"INSERT INTO tb_task (task_name,task_date_start,task_date_end ,id_project,id_user,datetime,status)VALUES('$nama','$tgl_mulai','$tgl_selesai','$id_project','$id_user','$hari_ini','1')")or die(mysqli_error($koneksi));

				$qry2 = mysqli_query($koneksi,"SELECT count(status) as total  FROM tb_task where id_project = $id_project and $id_user = $id_user and status=1 ")or die(mysqli_error($koneksi));
				$da = mysqli_fetch_object($qry2);
				$total = $da->total;
				$persen = 100/$total;
				$update_pfj = mysqli_query($koneksi,"UPDATE tb_task SET percent_from_projek = $persen where id_project=$id_project and id_user = $id_user")or die(mysqli_error($koneksi));
			header("location:index.php?pages=task&act=detail&id_project=$id_project");
				 ?>