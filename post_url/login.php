<?php
	require_once('../functions/cls_dbconfig.php');
	function __autoload($class_name){
		require_once("../functions/$class_name.class.php");
	}

	$cls_user_info = new cls_user_info();

    $username = $_POST['username'];
	$password = md5($_POST['password']);

	$today=date("y/m/d");
	$date="15 December 2021";
	$ex_date = date('y/m/d',strtotime($date));
	if($today<$ex_date) {

		$result = $cls_user_info->login($username, $password);
		echo $result;
	}
?>