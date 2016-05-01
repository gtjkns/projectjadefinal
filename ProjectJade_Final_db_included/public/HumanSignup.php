<?php
session_start();
if(isset($_SESSION['id']))
{
	
		header("location:../profiles/".$_SESSION['user_type'].".php");
}
	
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
		$query = "SELECT * from pdhp_patient where username = '$username' OR  email = '$email' LIMIT 1";
		$result = mysqli_query($connection, $query);
		$result_row = mysqli_fetch_assoc($result);
		//print_r($result_row);
		if(is_array($result_row)){
			if($result_row['username'] == $username && $result_row['email'] == $email)
				$msg = 3;
			else if($result_row['username'] == $username)
				$msg = 1;
			else if($result_row['email'] == $email)
				$msg = 2;

			header("location:Signup_form.php?msg=".$msg);
		}
		else{
		$insert = "INSERT INTO pdhp_patient (username, password, email, first_name, last_name, dob, gender, cid, sid, s_s_n, i_n) VALUES (\"$username\",\"$password\", \"$email\", \"$first_name\", \"$last_name\", \"$dob\", \"$gender\", \"$cid\",\"$sid\", \"$s_s_n\", \"$i_n\")";
		

		$result = mysqli_query($connection, $insert);
			// echo "variable"  . $sid . "<br >";
			// echo "Post" . $_POST["city"] . "<br >";
		}

//Insert Data into the Doctors Table		
	}else if(isset($_POST['submit']) && $_POST['type']==="doctor"){
		$query = "SELECT * from pdhp_doctor where username = '$username' OR  email = '$email' LIMIT 1";
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

			header("location:Signup_form.php?msg=".$msg);
		}
		else{
		$insert = "INSERT INTO pdhp_doctor (username, password, email, first_name, last_name, dob, gender, cid, sid, s_s_n, i_n) VALUES (\"$username\",\"$password\", \"$email\", \"$first_name\", \"$last_name\", \"$dob\", \"$gender\", \"$cid\",\"$sid\", \"$s_s_n\", \"$i_n\")";

		$result = mysqli_query($connection, $insert);

		}
//Insert data into the Environmentalist table
	}else if(isset($_POST['submit']) && $_POST['type']==="environment"){
		$query = "SELECT * from pdhp_environmentalist where username = '$username' OR  email = '$email' LIMIT 1";
		$result = mysqli_query($connection, $query);
		$result_row = mysqli_fetch_assoc($result);
		//print_r($result_row);
		if(is_array($result_row)){
			if($result_row['username'] == $username && $result_row['email'] == $email)
				$msg = 3;
			else if($result_row['username'] == $username)
				$msg = 1;
			else if($result_row['email'] == $email)
				$msg = 2;

			header("location:Signup_form.php?msg=".$msg);
		}
		else{
		$insert = "INSERT INTO pdhp_environmentalist (username, password, email, first_name, last_name, dob, gender,cid, sid, s_s_n, i_n) VALUES (\"$username\",\"$password\", \"$email\", \"$first_name\", \"$last_name\", \"$dob\", \"$gender\", \"$cid\",\"$sid\", \"$s_s_n\", \"$i_n\")";
		
		$result = mysqli_query($connection, $insert);
		}
	}

		if ( $result === false ) {
			echo $insert . "<br>";
			echo mysqli_error($connection);
		    exit();
		 }else{
		 	//redirect("Login_form.php");
		}

 ?>