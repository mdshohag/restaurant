<?php 
require_once('../functions/cls_dbconfig.php');
	function __autoload($class_name){
		require_once("../functions/$class_name.class.php");
	}
	
	$db= new DB();
	$cls_table = new cls_table();
	
	$table_name = $db->con()->real_escape_string("$_POST[table_name]");
	$description = $db->con()->real_escape_string("$_POST[description]");
	$saved_by = "$_POST[saved_by]";
	
	echo $cls_table->insert_table($table_name,$description,$saved_by);

?>