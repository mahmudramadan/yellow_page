<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require_once( '../classes/Functions.php' );
	require_once( '../classes/Strategy.php' );

	$username = strip_tags($_POST['username']); 
	$password = strip_tags($_POST['password']); 
	$password_data = new PasswordClass($password);
	$hash_password = $password_data->getPassword();

	$cond['active'] = 1;
	$cond['username'] = $username;
	$cond['password'] = $hash_password;

// error_reporting(-1);
	$core = new Core();
	$user = $core->get_where('admin','*',$cond);
	if ($user) {
		session_start();
		$_SESSION['admin_ID'] = $user[0]['id'];
		$_SESSION['admin_username'] = $user[0]['username'];
		$_SESSION['admin_privellage'] = $user[0]['privellage'];
		echo json_encode(array('status'=>'ok'));
	}else{
		echo json_encode(array('status'=>'no','msg'=>'username or password is incorrect'));
	}
}else{
	die();
}