<?php 
	session_start();
	require_once("../include/db_connect.php");
	require_once("../include/function.php");

	$type = $_POST['type'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	global $connection;
	
	if($type === 'patient'){
		$query = "SELECT id, username, password from pdhp_pharmacy where username = \"$username\" AND password = \"$password\" LIMIT 1";
		$result = mysqli_query($connection, $query);
		$result_row = mysqli_fetch_assoc($result);
		if($result){
			$_SESSION['id'] = $result_row['id'];
			redirect("../profiles/Patient.php");
		}
	}elseif($type === 'doctor'){
		$query = "SELECT username, password FROM pdhp_doctor where username = \"$username\" AND password = \"$password\"  LIMIT 1";
		$result = mysqli_query($connection, $query);
		$result_row = mysqli_fetch_assoc($result);
		if($result){
			$_SESSION['id'] = $result_row['id'];
			redirect("../profiles/Doctor.php");
		}
	}elseif($type === 'hospital'){
		$query = "SELECT usernam, password FROM pdhp_hospital where username = \"$username\" AND password = \"$password\"  LIMIT 1";
		$result = mysqli_query($connection, $query);
		$result_row = mysqli_fetch_assoc($result);
		if($result){
			redirect("../profiles/Hospital.php");
			$_SESSION['id'] = $result_row['id'];
		}
	}elseif($type === 'pharmacy'){
		$query = "SELECT usernam, password FROM pdhp_pharmacy where username = \"$username\" AND password = \"$password\"  LIMIT 1";
		$result = mysqli_query($connection, $query);
		$result_row = mysqli_fetch_assoc($result);
		if($result){
			$_SESSION['id'] = $result_row['id'];
			redirect("../profiles/Pharmacy.php");
		}
	}elseif($type === 'environment'){
		$query = "SELECT usernam, password FROM pdhp_evironment where username = \"$username\" AND password = \"$password\"  LIMIT 1";
		$result = mysqli_query($connection, $query);
		$result_row = mysqli_fetch_assoc($result);
		if($result){
			$_SESSION['id'] = $result_row['id'];
			redirect("../map/Start.php");
		}
	}
 ?>