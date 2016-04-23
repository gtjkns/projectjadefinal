<?php 
	session_start();
	$_POST['id'] = $_SESSION['id'];
	
	require_once("../include/db_connect.php");
	require_once("../include/function.php");

 ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Patient profile</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
			<div id="header">

				<div class="top">

					<!-- Logo -->
						<div id="logo">
							<span class="image avatar48"><img src="images/avatar.jpg" alt="" /></span>
							<h1 id="title">Nabil</h1>
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
								<li><a href="#top" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home">Intro</span></a></li>
								<li><a href="#portfolio" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-th">News</span></a></li>
								<li><a href="#about" id="about-link" class="skel-layers-ignoreHref"><span class="icon fa-user">Profile</span></a></li>
								<li><a href="#response" id="response-link" class="skel-layers-ignoreHref"><span class="icon fa-envelope">Response</span></a></li>
								<li><a href="#feedback" id="feedback-link" class="skel-layers-ignoreHref"><span class="icon fa-envelope">Feedback</span></a></li>
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

							<footer>
								<a href="#portfolio" class="button scrolly">News</a>
							</footer>

						</div>
					</section>

				<!-- Portfolio -->
					<section id="portfolio" class="two">
						<div class="container">

							<header>
								<h2>News</h2>
							</header>

							<p>Vitae natoque dictum etiam semper magnis enim feugiat convallis convallis
							egestas rhoncus ridiculus in quis risus amet curabitur tempor orci penatibus.
							Tellus erat mauris ipsum fermentum etiam vivamus eget. Nunc nibh morbi quis
							fusce hendrerit lacus ridiculus.</p>

							<div class="row">
								<div class="4u 12u$(mobile)">
									<article class="item">
										<a href="#" class="image fit"><img src="images/pic02.jpg" alt="" /></a>
										<header>
											<h3>Ipsum Feugiat</h3>
										</header>
									</article>
									<article class="item">
										<a href="#" class="image fit"><img src="images/pic03.jpg" alt="" /></a>
										<header>
											<h3>Rhoncus Semper</h3>
										</header>
									</article>
								</div>
								<div class="4u 12u$(mobile)">
									<article class="item">
										<a href="#" class="image fit"><img src="images/pic04.jpg" alt="" /></a>
										<header>
											<h3>Magna Nullam</h3>
										</header>
									</article>
									<article class="item">
										<a href="#" class="image fit"><img src="images/pic05.jpg" alt="" /></a>
										<header>
											<h3>Natoque Vitae</h3>
										</header>
									</article>
								</div>
								<div class="4u$ 12u$(mobile)">
									<article class="item">
										<a href="#" class="image fit"><img src="images/pic06.jpg" alt="" /></a>
										<header>
											<h3>Dolor Penatibus</h3>
										</header>
									</article>
									<article class="item">
										<a href="#" class="image fit"><img src="images/pic07.jpg" alt="" /></a>
										<header>
											<h3>Orci Convallis</h3>
										</header>
									</article>
								</div>
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

							<p>Tincidunt eu elit diam magnis pretium accumsan etiam id urna. Ridiculus
							ultricies curae quis et rhoncus velit. Lobortis elementum aliquet nec vitae
							laoreet eget cubilia quam non etiam odio tincidunt montes. Elementum sem
							parturient nulla quam placerat viverra mauris non cum elit tempus ullamcorper
							dolor. Libero rutrum ut lacinia donec curae mus vel quisque sociis nec
							ornare iaculis.</p>

						</div>
					</section>

				<!-- Contact -->
					<section id="response" class="four">
						<div class="container">

							<header>
								<form id="form_1121969" class="appnitro" enctype="multipart/form-data" method="post" action="Addres">
							<h2 id="response">Response</h2>
			<ul >
				<li id="li_1" >
		<label class="description" for="date">Date </label>
		<span>
			<input id="rdate" name="rdate" class="element text" style="margin: 0px 0px 0px -735px;" width="30px" value="" type="date" placeholder="MM/DD//YYYY" required>

		</span>
	</li>
	
					<div class="form_description">
			<p></p>
		</div>						
			<ul>		<li id="li_2" >
		<label class="description" for="element_1">Disease </label>
		<div>
		<select class="element select medium" id="element_1" name="disease"> 
			<option value="" selected="selected"></option>
			<?php
				//if(isset($_POST["country"])){				
					$disease = find_disease();  

				  	while ( $dis_arr = mysqli_fetch_assoc($disease)) {
							 echo "<option value='{".$dis_arr['id']."}'>".$dis_arr['disease']."</option>";
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
		<select class="element select medium" id="element_2" name="element_2"> 
			<option value="" selected="selected"></option>
			<?php 
				//if(isset($_POST["country"])){				
					$symptom = find_symptom();  
				  	while ( $symp_arr = mysqli_fetch_assoc($symptom)) {
							 echo "<option value='{".$symp_arr['id']."}'>".$symp_arr['symptom']."</option>";
					}
			//	}
				
			  ?>
<!--  -->
		</select>
		</div> 
		</li>		<li id="li_4" >
		<label class="description" for="element_3">Symptom Grading </label>
		<div>
		<input type="number" min="1" max="10" name="grade">

		<!-- <form id="form_1121969" class="appnitro" enctype="multipart/form-data" method="post" action="">
					<div class="form_description">
			<p></p>
		</div> -->						
			<ul>		<li id="li_6" >
		<label class="description" for="element_2">&nbsp;&nbsp;&nbsp;Attach a photo of the infected area (If any) </label>
		<div>
			<input id="element_7" name="element_2" class="element file" type="file"/> 
		</div>  
		</li>		<li id="li_8" >
		<label class="description" for="element_3">&nbsp;&nbsp;&nbsp;Attach a photo of a report (If any) </label>
		<div>
			<input id="element_9" name="element_3" class="element file" type="file"/> 
		</div>  
		</li>
	</ul>
							</header>

							<!-- <form id="form_1121969" class="appnitro" enctype="multipart/form-data" method="post" action=""> -->
									<div class="12u$">
										<br><br><input type="submit" name="response" value="Send Response" />
									</div>
								</div>
							</form>
							<form id="form_1123909" class="appnitro"  method="post" action="feedback.php">

							<br><br><h2 id="feedback">Give feedback</h2>
							<div>
							<label class="description" for="element_4">Records Date:</label>
						<select style="margin: 0px 0px 0px -735px; " width="30px" class="element select medium" id="element_4" name="element_4"> 
							<option value="" selected="selected"></option>
							<?php 
								//if(isset($_POST["country"])){				
									$disease = find_disease();  
				
								  	while ( $dis_arr = mysqli_fetch_assoc($disease)) {
											 echo "<option value='{".$dis_arr['id']."}'>".$dis_arr['disease']."</option>";
									}
								//}
								
							  ?>
				
						</select>
					</div>
				<ul>
					<li id="li_10" >
						<label class="description" for="element_1">&nbsp;&nbsp;&nbsp;Feedback </label>
						<div>
			<textarea style="margin: 0px auto; height:200px; width:1000px;" id="feedback_desc" name="feedback" class="element textarea medium"></textarea> 
		</div>
						<div class="12u$">
										<br><br><input type="submit" value="Send Feedback" />
									</div>
					</li>
				</ul>
				</form>
					</header>
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