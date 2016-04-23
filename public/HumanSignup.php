<?php 
	
	require_once("../include/db_connect.php");
	require_once("../include/function.php");
	
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$dob = $_POST['dob'];
	$dob = date("Y-m-d", strtotime($dob));
	$gender = $_POST['gender'];
	$cid = $_POST['country'];
	$sid = $_POST['city'];
	$s_s_n = $_POST['s_s_n'];
	$i_n = $_POST['i_n'];

	global $connection;


//Insert data into the patient table
	
	if(isset($_POST['submit']) && $_POST['type']==="patient"){
		$insert = "INSERT INTO pdhp_patient (username, password, email, first_name, last_name, dob, gender, cid, sid, s_s_n, i_n) VALUES (\"$username\",\"$password\", \"$email\", \"$first_name\", \"$last_name\", \"$dob\", \"$gender\", \"$cid\",\"$sid\", \"$s_s_n\", \"$i_n\")";
		

		$result = mysqli_query($connection, $insert);
			// echo "variable"  . $sid . "<br >";
			// echo "Post" . $_POST["city"] . "<br >";
		

//Insert Data into the Doctors Table		
	}else if(isset($_POST['submit']) && $_POST['type']==="doctor"){
		$insert = "INSERT INTO pdhp_doctor (username, password, email, first_name, last_name, dob, gender, cid, sid, s_s_n, i_n) VALUES (\"$username\",\"$password\", \"$email\", \"$first_name\", \"$last_name\", \"$dob\", \"$gender\", \"$cid\",\"$sid\", \"$s_s_n\", \"$i_n\")";

		$result = mysqli_query($connection, $insert);

		
//Insert data into the Environmentalist table
	}else if(isset($_POST['submit']) && $_POST['type']==="environment"){
		$insert = "INSERT INTO pdhp_environmentalist (username, password, email, first_name, last_name, dob, gender, s_s_n, i_n) VALUES (\"$username\",\"$password\", \"$email\", \"$first_name\", \"$last_name\", \"$dob\", \"$gender\", \"$cid\",\"$sid\", \"$s_s_n\", \"$i_n\")";
		
		$result = mysqli_query($connection, $insert);

	}

		if ( $result === false ) {
			echo $insert . "<br>";
			echo mysqli_error($connection);
		    exit();
		 }else{
		 	redirect("Success.php");
		}

 ?>