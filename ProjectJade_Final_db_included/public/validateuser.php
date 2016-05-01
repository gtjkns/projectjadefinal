<?php 
	require_once("../include/db_connect.php");
	require_once("../include/function.php");
	global $connection;
	$userName = $_POST['user'];
	$passWord = $_POST['pass'];
	$query = "SELECT * from pdhp_patient where username = \'". $userName ."\' AND password = \'" . $passWord . "\'";
	$query = mysql_prep($query);
	echo $query;

	$if($_POST['type'] === "Patient"){
		
	}elseif($_POST['type'] === "Doctor"){

	}elseif($_POST['type'] === "Hospital"){
		
	}elseif($_POST['type'] === "Pharmacy"){
		
	}
 ?>