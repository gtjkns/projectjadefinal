<?php 
	session_start();
	require_once("../include/db_connect.php");
	require_once("../include/function.php");
	

	$date = $_POST['rdate'];
	date("Y-m-d", strtotime($dob));
	$disease = $_POST['disease'];
	$user = $_POST['id'];
	$description = $_POST['description'];
	
	if(isset($_POST['response'])){
		$insert = "INSERT INTO pdhp_pat_dis (p_id, d_id, description) VALUES (\"$user\", \"$disease\", \"$description\")";

		$result = mysqli_query($connection, $insert);
		if($result){
			redirect_to("Patient.php#response");
		}
	}

 ?>