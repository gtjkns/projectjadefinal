<?php
session_start();
if(!isset($_SESSION['id']))
header("location:../public/Login_form.php");

if(isset($_SESSION['id']) && $_SESSION['user_type'] != 'patient')
header("location:".$_SESSION['user_type'].".php");

	$username = $_SESSION['username'];
	$_POST['id'] = $_SESSION['id'];
	
	require_once("../include/db_connect.php");
	require_once("../include/function.php");

	$user_data = get_user($_SESSION['id'], "pdhp_patient");
	//print_r($user_data);
 ?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Patient profile</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../include/pagination.css">
		<link rel="stylesheet" type="text/css" href="../include/B_blue.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  </head>
  <body style="padding-bottom:50px;background:rgba(0,0,0,.1)">
  	<div class="container">
  		<div class="col-xs-12">
  			<?php
  			$result = mysqli_query($connection,"select pdhp_pat_dis.symptom as symptom_photo,pdhp_symptom.symptom,pdhp_disease.disease,pdhp_pat_dis.description,pdhp_pat_dis.report,pdhp_pat_dis.date_time from pdhp_pat_dis left join pdhp_disease on  pdhp_disease.id = pdhp_pat_dis.d_id  left join pdhp_symptom on  pdhp_symptom.id = pdhp_pat_dis.s_id where pdhp_pat_dis.p_id = ".$user_data['id']."");
				$row = mysqli_fetch_array($result);
				echo '
				<h3>Disease : '.$row['disease'].'</h3>
				<h3>Symptom : '.$row['symptom'].'</h3>
				<h3>Infected Area : </h3>
				<div class="text-center">
					<img style="width:50%" src="upload/symptom/'.$row['symptom_photo'].'">
				</div>
				<h3>Report : </h3>
				<div class="text-center">
					<img style="width:50%" src="upload/report/'.$row['report'].'">
				</div>
				<h3>Description : </h3>
				<div>
					'.$row['description'].'
				</div>
				<p>&nbsp;</p>
				<p>Date : '.$row['date_time'].'</p>
				';
  			?>
  		</div>
  	</div>
  </body>
  </html>