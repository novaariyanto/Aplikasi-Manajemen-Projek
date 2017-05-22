<?php
	function insert_log($kon,$id_user,$ip,$note)
		{
			$query = mysqli_query($kon,"INSERT INTO tb_user_log SET id_user =$id_user,ip='$ip',note='$note'")or die(mysqli_error($kon));
		}
		function upd_lastlogin($kon,$ip,$date_time,$id_user)
		{
			$query = mysqli_query($kon,"UPDATE tb_user set ip ='$ip',lastlogin='$date_time' where id_user = $id_user");
		}

		function upd_stts_projek($kon,$status,$id_project)
		{
			$query = mysqli_query($kon,"UPDATE tb_project set status = $status where id_project = $id_project");
		}

 ?>

