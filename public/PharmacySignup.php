<?php 
require_once("../include/db_connect.php");
require_once("../include/function.php");

if(!empty($_POST)){
	$name = $_POST['name'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$address = $_POST['address'];
	$reg = $_POST['registration'];
	$phone = $_POST['phone'];
	$cid = $_POST['country'];
	$sid = $_POST['city'];

	if(isset($_POST['submit'])){
		$insert = "INSERT INTO pdhp_pharmacy (name, username, email, password, address, reg_num, phone, cid, sid) VALUES (\"$name\", \"$username\",\"$email\", \"$password\", \"$address\",\"$reg\",\"$phone\", \"$cid\",\"$sid\")";
	}
	global $connection;
	$result = mysqli_query($connection, $insert);

	if ( $result === false ) {
			echo $insert . "<br>";
			echo mysqli_error($connection);
		    exit();
		 }else{
		 	//redirect("Success.php");
		 	echo "Working check database";
		}
	}
 ?>