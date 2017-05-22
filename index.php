<?php 
include 'inc/koneksi.php';
include('inc/function.php');
session_start();
date_default_timezone_set('Asia/Jakarta');

$ip = $_SERVER['REMOTE_ADDR'];

if(!@$_SESSION['id_user']){
header('location: signin.php');
  };
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
    <link rel="icon" href="favicon.ico">

    <title>Aplikasi Manajemen Proyek</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script> 
    <script type="text/javascript" src="js/highcharts.js"></script> 
 
    <!-- Custom styles for this template -->
  
  
    <link href="css/sidebar.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
    <body>
    <div id="bg-loader" style="width: 100%;height: 100%;position: absolute;background-color: rgba(0,0,0,0.4);top: 0;z-index: 999;">
<div class="loading"></div>
</div>
 <!-- /#sidebar-wrapper -->
</div>


      <div id="wrapper">
       <div id="sidebar-wrapper"">
        <?php include "pages/menu.php"; ?> 
          </div>
                   <div class="span10">
                        <div class="top">
                                  <span class="glyphicon glyphicon-menu-hamburger" style="font-size: 15pt;" id="menu-toggle"></span>
                                   <?php 
$qry = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE id_user ='".$_SESSION['id_user']."'")or die(mysqli_error());
          $d = mysqli_fetch_object($qry);
          ?> 
                                  <font style="float: right;margin-right:10px;margin-top: 7px;"><?=$d->fullname;?>
         <a onclick="return confirm('Apakah Anda Ingin Keluar?...')" href="inc/logout.php" class="glyphicon glyphicon-log-out"></a> 
                                   </font>
                          </div>
                          <div class="span6" style="height:10px;"></div>
                          <div class="span1" style="padding:0.2em 0.3em; margin-right:0" id="tekan"></div>

                    <div style="clear:both;"></div>
                </div>

            <div class="span10" id="w" style="margin-top: 100px;padding: 20px;">
              <?php include('pages/view.php'); ?>
            </div>

        </div>
     </div>
      <script src="assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript">

    <!------- wrapper-------->
        $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
<!-- ------------------------------- Loading ---------------------->
$(function() {
  $("#w").hide();
  $(".loading").delay(500).fadeOut(10, function() {
    $("#bg-loader").remove();
    $("#w").fadeIn(400);
  });
  
});
    </script>
  </body>
</html>