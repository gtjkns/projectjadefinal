<?php
session_start();
if(isset($_SESSION['id']))
{
	
		header("location:../profiles/".$_SESSION['user_type'].".php");
}
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
		$query = "SELECT * from pdhp_hospital where username = '$username' OR  email = '$email' LIMIT 1";
		$result = mysqli_query($connection, $query);
		$result_row = mysqli_fetch_assoc($result);
		//print_r($result_row);
		if(is_array($result_row)){
			//echo 'ere';
			if($result_row['username'] == $username && $result_row['email'] == $email)
				$msg = 3;
			else if($result_row['username'] == $username)
				$msg = 1;
			else if($result_row['email'] == $email)
				$msg = 2;

			header("location:Hospital_form.php?msg=".$msg);
		}
		else{
		$insert = "INSERT INTO pdhp_hospital (name, username, password, email, website, phone, address, reg_num, cid, sid) VALUES (\"$name\",\"$username\", \"$password\", \"$email\", \"$phone\", \"$address\",\"$reg\", \"$website\", \"$cid\",\"$sid\")";
		$result = mysqli_query($connection, $insert);
	}
}
	

	if ( $result === false ) {
			echo $insert . "<br>";
			echo mysqli_error($connection);
		    exit();
		 }else{
		 	redirect("Success.php");
		}


 ?>