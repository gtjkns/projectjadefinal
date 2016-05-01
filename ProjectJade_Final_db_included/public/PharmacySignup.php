<?php
session_start();
if(isset($_SESSION['id']))
{
	
		header("location:../profiles/".$_SESSION['user_type'].".php");
}
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
global $connection;
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

			header("location:Pharmacy_form.php?msg=".$msg);
		}
		else{
		$insert = "INSERT INTO pdhp_pharmacy (name, username, email, password, address, reg_num, phone, cid, sid) VALUES (\"$name\", \"$username\",\"$email\", \"$password\", \"$address\",\"$reg\",\"$phone\", \"$cid\",\"$sid\")";
		$result = mysqli_query($connection, $insert);
	}
	}
	
	

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