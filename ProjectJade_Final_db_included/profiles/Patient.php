<?php
session_start();
if(!isset($_SESSION['id']))
header("location:../public/Login_form.php");

if(isset($_SESSION['id']) && $_SESSION['user_type'] != 'Patient')
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
<script type="text/javascript" src="view.js"></script>
<link rel="stylesheet" href="assets/css/main.css" />
<script type="text/javascript">
	function find_city(id)
	{
		$.ajax({url: "../place.php?guest_find_city="+id, success: function(result){
			document.getElementById("put_city").innerHTML = result;
	    }});
	}
	function find_hospital()
	{
		country = document.getElementById("country").value;
		hospital_by_city = document.getElementById("hospital_by_city").value;
		console.log(hospital_by_city);
			$.ajax({url: "../place.php?guest_find_hospital=&country="+country+"&city="+hospital_by_city, success: function(result){
			document.getElementById("put_hospital").innerHTML = result;
	    }});
	}
	$(document).on('click','.modal_show',function(){
		href_ = $(this).attr('href');
		$(href_).modal('show');
	});
</script>
<style type="text/css">
	.range_marker{border:1px solid #000;border-color:transparent;font-size:14px;line-height:14px;float:left;}
	p{margin-bottom:5px;}
</style>
<style type="text/css">
		#search_hospital p{margin-bottom:0px;}
		</style>
	</head>
	<body>

		<!-- Header -->
			<div id="header">

				<div class="top">

					<!-- Logo -->
						<div id="logo">
							
							<h1 id="title"><?php echo $user_data['first_name'].' '.$user_data['last_name']; ?></h1>
							<p>Patient</p>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<!--

								Prologue's nav expects links in one of two formats:

								1. Hash link (scrolls to a different section within the page)

								   <li><a href="#foobar" id="foobar-link" class="icon fa-whatever-icon-you-want skel-layers-ignoreHref"><span class="label">Foobar</span></a></li>

								2. Standard link (sends the user to another page/site)

								   <li><a href="http://foobar.tld" id="foobar-link" class="icon fa-whatever-icon-you-want"><span class="label">Foobar</span></a></li>

							-->
							<ul>
								<!--<li><a href="#top" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home">Intro</span></a></li>-->
								<li><a href="#portfolio" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-th">Latest Response</span></a></li>
								<li><a href="#about" id="about-link" class="skel-layers-ignoreHref"><span class="icon fa-user">Profile</span></a></li>
								<li><a href="#response" id="response-link" class="skel-layers-ignoreHref"><span class="icon fa-envelope">Response</span></a></li>
								<li><a href="#feedback" id="feedback-link" class="skel-layers-ignoreHref"><span class="icon fa-envelope">Feedback</span></a></li>
								<li><a href="../map/Geomap/disease.php" target="blank" id="" class="skel-layers-ignoreHref"><span class="icon fa-area-chart">Disease Frequency</span></a></li>
							<li><a href="../map/Geomap/symptom.php" target="blank" id="" class="skel-layers-ignoreHref"><span class="icon fa-line-chart">symptom Frequency</span></a></li>
								<li><a href="../map/GIBS_map/start.php" target="blank" id="" class="skel-layers-ignoreHref"><span class="icon fa-connectdevelop">NASA World View Map</span></a></li>
								<li><a href="Logout.php" id="logout-link" class="skel-layers-ignoreHref"><span class="">Log out</span></a></li>
							</ul>
						</nav>

				</div>

				<div class="bottom">

					<!-- Social Icons -->
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>

						</ul>

				</div>

			</div>

		<!-- Main -->
			<div id="main">

				<!-- Intro -->
					<section id="top" class="one dark cover">
						<div class="container">

							<header>
								<h2 class="alt">Hello! dear Patient<br />
								</h2>
								<p>How have you been?</p>
							</header>


						</div>
					</section>

				<!-- Portfolio -->
					<section id="portfolio" class="two">
						<div class="container">

							<header>
								<h2>Latest Response</h2>
							</header>

							<div class="row">
								<?php
									$page = (int) (!isset($_GET["pageN"]) ? 1 : $_GET["pageN"]);
                                            $limit = 6;
                                            $startpoint = ($page * $limit) - $limit;

                                            $statement = "`pdhp_pat_dis` where p_id = ".$user_data['id']." ";
									$result = mysqli_query($connection,"select * from pdhp_pat_dis left join pdhp_disease on  pdhp_disease.id = pdhp_pat_dis.d_id where pdhp_pat_dis.p_id = ".$user_data['id']." order by pdhp_pat_dis.id desc  LIMIT {$startpoint} , {$limit}");
									while($row = mysqli_fetch_array($result))
									{
										echo '
										<div class="col-xs-4">
										<div class="col-xs-12">
										<a href="patient_response.php?id='.$row['id'].'" target="new" class="image  fit"><img class="latest_response" src="upload/symptom/'.$row['symptom'].'" alt="" /></a>
										<header>
											<p>'.$row['disease'].'</p>
										</header>
										</div>
										</div>
										';
									}
								?>
							</div>

						</div>
					</section>

				<!-- About Me -->
					<section id="about" class="three">
						<div class="container">

							<header>
								<h2>Profile</h2>
							</header>

							<a href="#" class="image featured"><img src="images/pic08.jpg" alt="" /></a>


						</div>
					</section>

				<!-- Contact -->
					<section id="response" class="four">
						<div class="container">

							<header>
								<form id="form_1121969" class="appnitro" enctype="multipart/form-data" method="post" action="model.php">
							<h2 id="response">Response</h2>
			<ul >
				
	
					<div class="form_description">
			<p></p>
		</div>						
			<ul>		<li id="li_2" >
		<label class="description" for="element_1">Disease </label>
		<div>
		<select class="element select medium" id="element_1" name="d_id"> 
			<option value="" selected="selected">Select</option>
			<?php
				//if(isset($_POST["country"])){				
					$disease = find_disease();  

				  	while ( $dis_arr = mysqli_fetch_assoc($disease)) {
							 echo "<option value='".$dis_arr['id']."'>".$dis_arr['disease']."</option>";
					}
				//}
				
			  ?>

		</select>
		</div> 
		</li>
		<ul>
			
							<h1>Add a brief description of your disease</h1>

					<li id="li_5" >
		<label class="description" for="element_1">&nbsp;&nbsp;&nbsp;Description </label>
		<div>
			<textarea id="element_1" name="description" class="element textarea medium"></textarea> 
		</div> 
		</li>	<li id="li_3" >
		<label class="description" for="element_2">Symptom </label>
		<div>
		<select class="element select medium" id="element_2" name="s_id"> 
			<option value="" selected="selected">Selected</option>
			<?php 
				//if(isset($_POST["country"])){				
					$symptom = find_symptom();  
				  	while ( $symp_arr = mysqli_fetch_assoc($symptom)) {
							 echo "<option value='".$symp_arr['id']."'>".$symp_arr['symptom']."</option>";
					}
			//	}
				
			  ?>
<!--  -->
		</select>
		</div> 
		</li>		<li id="li_4" >
		<label class="description" for="element_3">Symptom Grading </label>
		<div>
		<input type="range" min="1" max="10" name="grade" style="width:98%">
		<div>
			<div class="col-xs-12" style="padding:0;width:98%">
			<div class="range_marker" style="width:11.11%"><div class="pull-left">1</div></div>
			<div class="range_marker" style="width:11.11%"><div class="pull-left">2</div></div>
			<div class="range_marker" style="width:11.11%"><div class="pull-left">3</div></div>
			<div class="range_marker" style="width:11.11%"><div class="pull-left">4</div></div>
			<div class="range_marker" style="width:11.11%"><div class="pull-left">5</div><div class="pull-right">&nbsp;6</div></div>
			<div class="range_marker" style="width:11.11%"><div class="pull-right">&nbsp; 7</div></div>
			<div class="range_marker" style="width:11.11%"><div class="pull-right">&nbsp; 8</div></div>
			<div class="range_marker" style="width:11.11%"><div class="pull-right">&nbsp; 9</div></div>
			<div class="range_marker" style="width:11.11%"><div class="pull-right">10</div></div>
			</div>
		</div>
		<!-- <form id="form_1121969" class="appnitro" enctype="multipart/form-data" method="post" action="">
					<div class="form_description">
			<p></p>
		</div> -->						
			<ul>		<li id="li_6" >
		<label class="description" for="element_2">&nbsp;&nbsp;&nbsp;Attach a photo of the infected area (If any) </label>
		<div>
			<input id="element_7" name="symptom_photo" class="element file" type="file"/> 
		</div>  
		</li>		<li id="li_8" >
		<label class="description" for="element_3">&nbsp;&nbsp;&nbsp;Attach a photo of a report (If any) </label>
		<div>
			<input id="element_9" name="report_photo" class="element file" type="file"/> 
		</div>  
		</li>
	</ul>
							</header>

							<!-- <form id="form_1121969" class="appnitro" enctype="multipart/form-data" method="post" action=""> -->
									<div class="12u$">
										<br><br><input type="submit" name="patient_record" value="Send Response" />
									</div>
								</div>
							</form>

					<section class="five" id="feedback">
					<form method="post" action="model.php">
						<div class="container">
							<header><h2>Give Feedback on Symptom</h2></header>
							<label>Select Symptom</label>
							<div class="col-xs-12">
							<select class="form-control" name="s_id">
								<option value="" selected="selected">Selected</option>
									<?php 
										//if(isset($_POST["country"])){				
											$symptom = find_symptom();  
										  	while ( $symp_arr = mysqli_fetch_assoc($symptom)) {
													 echo "<option value='".$symp_arr['id']."'>".$symp_arr['symptom']."</option>";
											}
									//	}
										
									  ?>
							</select>
							<div>
									<input type="textarea" name="feedback" style="width:100%;height:100px;margin-top:25px;margin-bottom:25px;" placeholder="Feedback">
									<input type="submit" value="submit" name="feedback_on_symptom">
								
							</div>
							</div>
						</div>
						</form>
					</section>
				
				<section class="five">

						<div class="container">
							<header><h2>Give Feedback on Disease</h2></header>
							<label>Select Disease</label>
							<div class="col-xs-12">
							<form method="post" action="model.php">
							<select class="form-control" name="d_id">
								<option value="" selected="selected">Select</option>
									<?php
										//if(isset($_POST["country"])){				
											$disease = find_disease();  

										  	while ( $dis_arr = mysqli_fetch_assoc($disease)) {
													 echo "<option value='".$dis_arr['id']."'>".$dis_arr['disease']."</option>";
											}
										//}
										
									  ?>
							</select>
							<div>
								<input type="textarea" name="feedback"  style="width:100%;height:100px;margin-top:25px;margin-bottom:25px;"  placeholder="Feedback">
								<input type="submit" value="submit" name="feedback_on_disease"><br><br>
							</div>
							</form>
							<form action="">
								<input type="checkbox" name="type" value="Bike">Have you been to a hospital <br><br>
								<input type="checkbox" name="type" value="Car">Have you been to a pharmacy<br><br>
								<input type="checkbox" name="type" value="Car">Have you been to a doctor 
							</form>
							</div>

						</div>
					</section>
					
				<section class="six"  id="search_hospital">

						<div class="container">
							<div class="col-xs-12">
								<h3>Search Hospital</h3>
							</div>
							<div class="col-xs-12">
								<select class="form-control" name="country" id="country" onchange="find_city(this.value)">
									<option value="">Select Country</option>
								<?php		
										$country = find_country();  

									  	while ( $country_arr = mysqli_fetch_assoc($country)) {
												 echo "<option value='".$country_arr['id']."'>".$country_arr['country']."</option>";
										}
									
								  ?>
								  </select>
								  <p> &nbsp;</p>
							</div>
							<div class="col-xs-12" id="put_city">
								
							</div>
							<div class="col-xs-12" style="padding:0;">
								<p> &nbsp;</p>
								<div class="col-xs-12" id="put_hospital">

								</div>
							</div>
						</div>
					</section>

				</div>

				

		<!-- Footer -->
			<div id="footer">
			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollzer.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script src="assets/js/addInput.js" language="Javascript" type="text/javascript"></script>

	</body>
</html>