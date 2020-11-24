<?php
	$today=date("y/m/d");
	$date="15 December 2021";
	$ex_date = date('y/m/d',strtotime($date));
	if($today>$ex_date) {
        unset($_SESSION['user_id']);
        unset($_SESSION['usertype']);
        session_destroy();
    }