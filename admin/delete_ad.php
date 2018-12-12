<?php
if(!isset($_SESSION['admin_ID']))
{
	echo "<script>window.location='login.php';</script>";
}

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require_once( '../classes/Functions.php' ); 
	$cond['id'] = strip_tags($_POST['id']); 
	$image = strip_tags($_POST['image']); 


// error_reporting(-1);
	$core = new Core();
	$data = $core->delete_where('ads',$cond);
	if ($data) {
		if (file_exists("../uploads/$image")) {
			unlink("../uploads/$image");
		}
		echo json_encode(array('status'=>'ok','msg'=>'item is deleted'));
	}else{
		echo json_encode(array('status'=>'no','msg'=>'orrer occure'));

	}

}else{
	die();
}