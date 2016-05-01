<?php
session_start();
if(isset($_SESSION['id']))
{
	
		header("location:../profiles/".$_SESSION['user_type'].".php");
}
	require_once("../include/db_connect.php");
	require_once("../include/function.php");

	$type = $_POST['type'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if($type == 'Patient'){
		
		$query = "SELECT id, username, password from pdhp_patient where username = '$username' AND password = '$password' LIMIT 1";
		$result = mysqli_query($connection, $query);
		$result_row = mysqli_fetch_assoc($result);
		//print_r($result_row);
		if(is_array($result_row)){
			$_SESSION['id'] = $result_row['id'];
			$_SESSION['username'] = $result_row['username'];
			$_SESSION['user_type'] = $type;
			redirect("../profiles/Patient.php");
		}
		else
		{
			redirect("Login_form.php?msg=1");
		}
	}elseif($type === 'Doctor'){
		$query = "SELECT id, username, password FROM pdhp_doctor where username = '$username' AND password = '$password'  LIMIT 1";
		$result = mysqli_query($connection, $query);
		$result_row = mysqli_fetch_assoc($result);
		if(is_array($result_row)){
			$_SESSION['id'] = $result_row['id'];
			$_SESSION['username'] = $result_row['username'];
			$_SESSION['user_type'] = $type;			
			redirect("../profiles/Doctor.php");
		}
		else
		{
			redirect("Login_form.php?msg=1");
		}
	}elseif($type === 'Hospital'){
		$query = "SELECT id, username, password FROM pdhp_hospital where username = '$username' AND password = '$password'  LIMIT 1";
		$result = mysqli_query($connection, $query);
		$result_row = mysqli_fetch_assoc($result);
		if(is_array($result_row)){

			$_SESSION['id'] = $result_row['id'];
			$_SESSION['username'] = $result_row['username'];	
			$_SESSION['user_type'] = $type;
			redirect("../profiles/Hospital.php");
		}
		else
		{
			redirect("Login_form.php?msg=1");
		}
	}elseif($type === 'Pharmacy'){
		$query = "SELECT id, username, password FROM pdhp_pharmacy where username = '$username' AND password = '$password'  LIMIT 1";
		$result = mysqli_query($connection, $query);
		$result_row = mysqli_fetch_assoc($result);
		if(is_array($result_row)){
			$_SESSION['id'] = $result_row['id'];
			$_SESSION['username'] = $result_row['username'];
			$_SESSION['user_type'] = $type;
			redirect("../profiles/Pharmacy.php");
		}
		else
		{
			redirect("Login_form.php?msg=1");
		}
	}elseif($type === 'environment'){
		$query = "SELECT id, username, password FROM pdhp_environmentalist where username = '$username' AND password = '$password'  LIMIT 1";
		$result = mysqli_query($connection, $query);
		$result_row = mysqli_fetch_assoc($result);
		if(is_array($result_row)){
			$_SESSION['id'] = $result_row['id'];
			$_SESSION['username'] = $result_row['username'];
			$_SESSION['user_type'] = $type;
			redirect("../map/GIBS_map/Start.php");
		}
		else
		{
			redirect("Login_form.php?msg=1");
		}
	}

 ?>