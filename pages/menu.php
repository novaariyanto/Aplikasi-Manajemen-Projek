 <?php 
          $qry = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE id_user ='".$_SESSION['id_user']."'")or die(mysqli_error());
          $d = mysqli_fetch_object($qry);
?>
      <div style=" height: 70px;width:250px;padding-top:20px;text-align: center;">
      <font style="font-size: 2.5em; width: 100%; font-family: Arial; color: #fbc02d;line-height:2px;">M</font>
      <br/>
      <font style="font-size: 12pt;color: #e0f2f1;">Managemen proyek</font>
      </div>
      <div style="width: 250px;"> 
      <div class="ot"><img src="gambar/via.jpg" class="circle" >
        <font style="float: center|horizontal;margin-right: 10px; font-size: 11pt;color: #F5F5F5;">Online : <?=$d->fullname;?></font></div>
      </div>
      <br>
    
  <ul class="sidebar-nav" style="margin-top: 85px;">
            <li class="sidebar-brand "></li>
            <?php 
              if($d->role==2){ ?>
            <li><a href="index.php">
            <span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a href="?pages=profil"> <span class="glyphicon glyphicon-user"></span> Profil</a></li>
            <li><a href="?pages=proyek_pic"> <span class="glyphicon glyphicon-calendar"></span> Pekerjaan</a></li> 
            <li><a href="?pages=statistik"> <span class="glyphicon glyphicon-stats"></span> Statistik</a></li>
            <?php }else {?>
             <li><a href="index.php"> <span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
            <li><a href="?pages=user"> <span class="glyphicon glyphicon-user"></span> Data User</a></li>
            <li><a href="?pages=log"> <span class="glyphicon glyphicon-info-sign"></span> Data Log User</a></li>
            <li><a href="?pages=proyek"> <span class="glyphicon glyphicon-calendar"></span> Data Proyek</a></li>
            <li><a href="?pages=client"> <span class="glyphicon glyphicon-user"></span> Data Client</a></li>
            <li><a href="?pages=laporan"> <span class="glyphicon glyphicon-briefcase"></span> Laporan</a></li>
            <?php }?>
            <li>
          <a onclick="return confirm('Apakah Anda Ingin Keluar?...')" href="inc/logout.php"> <span class="glyphicon glyphicon-log-out"></span> Logout</a>
        </li>
            </ul>

        