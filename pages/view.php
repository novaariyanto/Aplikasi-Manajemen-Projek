<?php 
$pages = @$_GET['pages'];
$act = @$_GET[''];

if($pages=="user"){
switch (@$_GET['act']) {
		// user
	case 'tambah':
	include "pages/add_user.php";
	break;

	case 'edit':
	include "pages/edit_user.php";
	break;

	case 'hapus':
	include "pages/delete_user.php";
	break;

	default :
	include "pages/data_user.php";
	break;
	// user
	
}}elseif($pages=="client"){
	switch (@$_GET['act']) {
		// client
	case 'tambah':
	include "pages/add_client.php";
	break;

	case 'edit':
	include "pages/edit_client.php";
	break;

	case 'hapus':
	include "pages/delete_client.php";
	break;

	default :
	include "pages/data_client.php";
	break;
	
}}elseif($pages=="proyek"){
	switch (@$_GET['act']) {
		// client
	case 'tambah':
	include "pages/add_proyek.php";
	break;

	case 'edit':
	include "pages/edit_proyek.php";
	break;

	case 'hapus':
	include "pages/delete_proyek.php";
	break;

	default :
	include "pages/data_proyek.php";
	break;
	
	}}elseif($pages=="task"){
	switch (@$_GET['act']) {
		// client
	case 'tambah':
	include "pages/add_task.php";
	break;

	case 'detail':
	include "pages/detail_task.php";
	break;

	case 'hapus':
	include "pages/delete_task.php";
	break;

	case 'edit':
	include "pages/edit_task.php";
	break;

}}elseif($pages=="log"){
		switch (@$_GET['act']) {
			case 'detail':
				# code...
			include "pages/detail_log_catatan.php";
				break;
			
			default:
				# code...
			include "pages/data_log_user.php";
				break;
}}elseif($pages=="laporan"){
		switch (@$_GET['act']) {
			case 'detail':
				# code...
			include "pages/detail_log_catatan.php";
				break;
			
			default:
				# code...
			include "pages/laporan.php";
				break;

}}elseif($pages=="proyek_pic"){

	include "pages/data_proyek_pic.php";

}elseif($pages=="profil"){

	include "pages/profil.php";

}elseif($pages=="statistik"){

	include "pages/statistik_proyek.php";	

}else {
	include 'pages/welcome.php';
}
?>	