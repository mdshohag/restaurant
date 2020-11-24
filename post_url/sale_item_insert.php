<?php
	session_start();
    require_once('../functions/cls_dbconfig.php');
	function __autoload($classname){
		require_once("../functions/$classname.class.php");
	}

	$cls_sales = new cls_sales();
	$cls_datetime = new cls_datetime();
	//$inovice_num = $cls_datetime->show_datetime();
	
	$inovice_num = (int)$cls_datetime->show_datetime() . rand(1111, 9999);
	//$inovice_num = trim(guid(), '{}') ;
	
    $user_id = $_SESSION['user_id'];
	$array =  $_POST['arr'];

	$tables =  $_POST['tables'];
	$employees =  $_POST['employees'];
	$customers = $_POST['customers'];
	$total_vat = $_POST['total_vat'];
	$sale_net_payable = $_POST['sale_net_payable'];
	$discount = $_POST['discount'];
	$due = $_POST['due'];
	$g_payment = $_POST['g_payment'];
	$pay_type = $_POST['pay_type'];
	$trans_num = $_POST['trans_num'];

	
	$result = json_decode($array);

		echo $cls_sales->sale_insert($user_id, $result, $inovice_num, $tables, $employees, $customers, $total_vat, $sale_net_payable, $discount, $due, $g_payment, $pay_type, $trans_num);




?>