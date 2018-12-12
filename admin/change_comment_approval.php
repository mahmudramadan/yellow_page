<?php
if(!isset($_SESSION['admin_ID']))
{
	echo "<script>window.location='login.php';</script>";
}

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require_once( '../classes/Functions.php' ); 
	$table_id = $_POST['id']; 
	$status =  $_POST['status'] ; 

	if ($status == 0 ) {
		$array_data['approve'] = 1;
	}else{
		$array_data['approve'] = 0;

	}
// error_reporting(-1);
	$core = new Core();
	$data = $core->update_where_id('comments',$array_data,$table_id);  
	if ($data) {

		echo json_encode(array('status'=>'ok','msg'=>'changes done successfully'));
	}else{
		echo json_encode(array('status'=>'no','msg'=>'orrer occure'));

	}

}else{
	die();
}