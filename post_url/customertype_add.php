<?php 
    session_start();
    $saved_by = $_SESSION['user_id'];
require_once('../functions/cls_dbconfig.php');
	function __autoload($class_name){
		require_once("../functions/$class_name.class.php");
	}
	$db = new DB();
	$cls_customer = new cls_customer();
	
	$user_id = $saved_by;
	
	$customertype_name = $db->con()->real_escape_string("$_POST[customertype_name]");

	echo $cls_customer->customertype_add($user_id, $customertype_name);

?>