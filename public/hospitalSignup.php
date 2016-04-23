<?php 

	require_once("../include/db_connect.php");
	require_once("../include/function.php");

	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$website = $_POST['web'];
	$cid = $_POST['country'];
	$sid = $_POST['city'];
	$reg = $_POST['registration'];

	if(isset($_POST['submit'])){
		$insert = "INSERT INTO pdhp_hospital (name, usernam, password, email, website, phone, address, reg_num, cid, sid) VALUES (\"$name\",\"$username\", \"$password\", \"$email\", \"$phone\", \"$address\",\"$reg\", \"$website\", \"$cid\",\"$sid\")";
	}

	$result = mysqli_query($connection, $insert);

	if ( $result === false ) {
			echo $insert . "<br>";
			echo mysqli_error($connection);
		    exit();
		 }else{
		 	redirect("Success.php");
		}


 ?>