<?php 
	//1. Connect a database connection
	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME","jkns_pdhp");
	
	$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
/*
	if(mysqli_connect_errno()){
		die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
	}
	$connection = mysql_connect("localhost","root","");
	mysql_select_db("jkns_pdhp",$connection);
	*/
 