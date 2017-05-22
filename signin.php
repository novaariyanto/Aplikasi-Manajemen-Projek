<?php
include 'inc/koneksi.php';
include('inc/function.php');
session_start();
 Date_default_timezone_set('Asia/Jakarta');
 $date_time = date("Y-m-d H:m:s");
 $ip = $_SERVER['REMOTE_ADDR'];

if(@$_SESSION['id_user']){
 ?>
 <script type="text/javascript">
   window.location.href ='index.php';
 </script>
<?php 
}else {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Aplikasi Proyek</title>

    <script type="text/javascript" src="js/jquery.min.js"></script> 
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">

   
  </head>

  <body style="background-image: url('gambar/background.jpg'); background-attachment:fixed;background-repeat: no-repeat; background-size: cover;">
<div class="loading"></div>

<div id="w">
<center>
<div class="col-md-4 col-lg-offset-4">
      <form class="form-signin" method="POST" action="" >
      <div class="panel panel-default panel-primary" style="margin-top:100px;">
        <div class="panel-heading" >
        <h2>Silahkan Login !</h2>
        <h5>Aplikasi Manajemen proyek</h5>
        </div>
    <div class="panel panel-body">

      <input type="text" class="form-control" name='user' placeholder="Username" required autofocus>
        <br/>
      <input type="password" class="form-control" name='pass' placeholder="Password" required>
        <br/>
      <button class="btn btn-lg btn-info btn-block" name="login" type="submit">Sign in</button>
            

             <?php 
         

          $user = @$_POST['user'];
          $pass = @$_POST['pass'];
          if(isset($_POST['login'])){
          $qry = mysqli_query($koneksi,"SELECT *  FROM tb_user WHERE username ='$user' AND password = '$pass' AND status = 1");
          $d = mysqli_fetch_object($qry);
          if( mysqli_num_rows($qry) == 1) {
            $_SESSION['id_user']=$d->id_user;
            $id_user  = $_SESSION['id_user'];

            upd_lastlogin($koneksi,$ip,$date_time,$id_user);
            insert_log($koneksi,$id_user,$ip,'Login Aplikasi ');
            header('location:index.php');
          }else{
            ?>
            <br/>
           <div class="alert alert-danger">
                  Coba Lagi , Mungkin username dan Password Tidak Cocok .
                </div>
<?php }}?>
      </form>
              </div>
     
</div>
    </div> <!-- /container -->
 </center>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript">
      
<!-- ------------------------------- Loading ---------------------->
$(function() {
  $("#w").hide();
  $(".loading").delay(500).fadeOut(200, function() {
    $("#w").fadeIn(400);
  });
});
    </script>
  </body>
</html>
<?php } ?>