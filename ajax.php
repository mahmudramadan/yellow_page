<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require_once( 'classes/Functions.php' );
	$array_data['ads_id'] = strip_tags($_POST['ads_id']);
	$array_data['username'] = strip_tags($_POST['username']);
	$array_data['comment'] = strip_tags($_POST['comment']);
	if (empty($_POST['ads_id']) || empty($_POST['username']) || empty($_POST['comment'])) {
		echo json_encode(array('status'=>'no','msg'=>'please write all data '));
		die();
	}
	$core = new Core();
	$comments = $core->insert_New('comments',$array_data); 

	if ($comments) {
		echo json_encode(array('status'=>'ok'));
	}else{
		
		echo json_encode(array('status'=>'no','msg'=>'An error occure please try again'));
	}
 
}else{
	echo "yala mn hna yad";
	die();
}
?>