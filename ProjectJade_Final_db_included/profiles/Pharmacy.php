<?php
session_start();
if(!isset($_SESSION['id']))
header("location:../public/Login_form.php");

if(isset($_SESSION['id']) && $_SESSION['user_type'] != 'Pharmacy')
header("location:".$_SESSION['user_type'].".php");


	$username = $_SESSION['username'];
	$_POST['id'] = $_SESSION['id'];
	
	require_once("../include/db_connect.php");
	require_once("../include/function.php");

	$user_data = get_user($_SESSION['id'], "pdhp_pharmacy");
	//print_r($user_data);
 ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Pharmacy</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.0.min.js">
	</script>
	<link rel="stylesheet" 
href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" 
src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="assets/css/main.css" />
<script type="text/javascript">
$(document).ready(function() {
    $('#example').dataTable();
} );
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
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<style type="text/css">
		#search_hospital p{margin-bottom:0px;}
		</style>
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
			<div id="header">

				<div class="top">

					<!-- Logo -->
						<div id="logo">
							
							<h1 id="title"><?php echo $user_data['name']; ?></h1>
							<p>Pharmacy</p>
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
							<ul style="">
								<!-- <li><a href="#portfolio" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-th">News</span></a></li> -->
								<li><a href="#about" id="about-link" class="skel-layers-ignoreHref"><span class="icon fa-user">Profile</span></a></li>
								<li><a href="#contact" id="contact-link" class="skel-layers-ignoreHref"><span class="icon fa-envelope">Response</span></a></li>
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
								<h2 class="alt">Welcome!<br />
								</h2>
								<p></p>
							</header>

							<!-- <footer>
								<a href="#portfolio" class="button scrolly">News</a>
							</footer>

						</div>
 -->
					</section>
				<!-- Portfolio -->
					<section id="portfolio" class="two">
						<div class="container">

							<header>
								<h2>Latest Entries</h2>
							</header>


							<div class="row">
								<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead><tr><th class="text-center">Disease</th><th class="text-center">Customers</th><th class="text-center">Prescribed Customers</th><th class="text-center">Date</th></tr></thead>
							<tbody>
							<?php
							$result = mysqli_query($connection,"select * from pharmacy_disease_count left join pdhp_disease on  pdhp_disease.id = pharmacy_disease_count.d_id where pharmacy_disease_count.p_id = ".$user_data['id']." order by pharmacy_disease_count.id desc");
							while($row = mysqli_fetch_array($result))
							{
								echo '
									<tr>
									<td>'.$row['disease'].'</td>
									<td>'.$row['num_cus'].'</td>
									<td>'.$row['num_pre_cus'].'</td>
									<td>'.$row['date_time'].'</td>
									</tr>
								';
							}
							?>
							</tbody>
							</table>
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
							<div class="col-xs-12" style="padding-bottom:20px;">
								<h3 class="col-xs-12 text-center">UserName : <?php echo $user_data['username'] ?></h3>
							</div>
							
							<div class="col-xs-12 nopadding">
								<div class="col-xs-12 nopadding">
									<form action="model.php" method="post">
										<div class="col-xs-9 nopadding">
											<label class="description pull-left" for="name">Password </label>
											<input id="name" name="old" class="element text medium" type="text" value="" required/> 
										</div>
										<div class="col-xs-9 nopadding">
											<label class="description pull-left" for="name">New Password </label>
											<input id="name" name="new" class="element text medium" type="text" value="" required/> 
										</div>
										
										<div class="col-xs-9 nopadding">
											<label class="description pull-left" for="name">Confirm Password </label>
											<input id="name" name="new_2" class="element text medium" type="text" value="" required/> 
										</div>

										<div class="col-xs-3">
											<button type="submit" name="update_pharmacy_password">Update</button>
										</div>
									</form>
								</div> 
							</div>

							<div class="col-xs-12 nopadding">
								
								<div class="col-xs-12 nopadding">
									<form action="model.php" method="post">
										<div class="col-xs-12 nopadding">
											<label class="description pull-left" for="name">Phone </label>
										</div>
										<div class="col-xs-9 nopadding">
											<input id="name" name="phone" class="element text medium" type="text" value="<?php echo $user_data['phone'] ?>" required/> 
										</div>
										<div class="col-xs-3">
											<button type="submit" name="update_pharmacy_phone">Update</button>
										</div>
									</form>
								</div> 
							</div>
							<div class="col-xs-12 nopadding">
								
								<div class="col-xs-12 nopadding">
									<form action="model.php" method="post">
										<div class="col-xs-12 nopadding">
											<label class="description pull-left" for="name">Email </label>
										</div>
										<div class="col-xs-9 nopadding">
											<input id="name" name="email" class="element text medium" type="text" value="<?php echo $user_data['email'] ?>" required/> 
										</div>
										<div class="col-xs-3">
											<button type="submit" name="update_pharmacy_email">Update</button>
										</div>
									</form>
								</div> 
							</div>

							<div class="col-xs-12 nopadding">
								
								<div class="col-xs-12 nopadding">
									<form action="model.php" method="post">
										<div class="col-xs-12 nopadding">
											<label class="description pull-left" for="name">Address </label>
										</div>
										<div class="col-xs-9 nopadding">
											<input id="name" name="address" class="element text medium" type="text" value="<?php echo $user_data['address'] ?>" required/> 
										</div>
										<div class="col-xs-3">
											<button type="submit" name="update_pharmacy_address">Update</button>
										</div>
									</form>
								</div> 
							</div>

						</div>
					</section>
					<section class="six" id="search_hospital">

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
				<!-- Contact -->
					<section id="contact" class="four">
						<div class="container">

							<header>
								<form id="form_1123909" class="appnitro"  method="post" action="model.php">
									
			
		<label class="description" for="element_1">Disease </label>
		<div class="col-xs-12">
		<select class="element select medium" id="element_1" name="d_id"> 
			<option value="" selected="selected">Select</option>
			<?php 
				//if(isset($_POST["country"])){				
					$disease = find_disease();
				  	while ( $dis = mysqli_fetch_assoc($disease)) {
							 echo "<option value='".$dis['id']."'>".$dis['disease']."</option>";
					}
			// }		
				
			?>

		</select>
		<p>&nbsp;</p>
		</div> 	
		
		<div class="col-xs-8">
			<div class="col-xs-4">
				<label class="description" for="element_1">Number of Customers </label>
			</div>
			<div>
				<input name="num_cus" type="number">
			</div>
		</div>
		<div class="col-xs-8">
			<div class="col-xs-4">
				<label class="description" for="element_1">Number of Prescribed Customers </label>
			</div>
			<div>
				<input name="num_pre_cus" type="number">
			</div>		
		</div>
		<div class="col-xs-8">
			<div class="col-xs-4">
			</div>
			<div>
				<button name="pharmacy_patient_record" type="submit">Add Record</button>
			</div>		
		</div>
							


							
								
		</div>
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
			<script type="text/javascript" src="view.js"></script>
	</body>
</html>
