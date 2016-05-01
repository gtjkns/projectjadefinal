<?php
session_start();
if(!isset($_SESSION['id']))
header("location:../public/Login_form.php");

if(isset($_SESSION['id']) && $_SESSION['user_type'] != 'Hospital')
header("location:".$_SESSION['user_type'].".php");


	$username = $_SESSION['username'];
	$_POST['id'] = $_SESSION['id'];
	
	require_once("../include/db_connect.php");
	require_once("../include/function.php");

	$user_data = get_user($_SESSION['id'], "pdhp_hospital");
	$id = $user_data['id'];
	//print_r($user_data);
 ?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php  echo "Welcome ".$user_data['name']. "! "?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
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
	<link rel="stylesheet" href="assets/css/main.css" />
	
	<link rel="stylesheet" type="text/css" href="assets/css/custom.css">
	<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	<style type="text/css">
	.button-sm{padding : 0 15px;margin-bottom:5px;}
	.input-sm{width : 70px;margin-bottom:5px;}
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
						
						<h1 id="title"><?php echo $user_data['name'] ?></h1>
						<p>Hospital</p>
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
							<li><a href="#portfolio" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-th">Departments</span></a></li>
							<li><a href="#about" id="about-link" class="skel-layers-ignoreHref"><span class="icon fa-user">Profile</span></a></li>
							<li><a href="#response" id="contact-link" class="skel-layers-ignoreHref"><span class="icon fa-envelope">Response</span></a></li>
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

						<footer>
							<a href="#portfolio" class="button scrolly">Departments</a>
						</footer>

					</div>
				</section>

			<!-- Portfolio -->
				<section id="portfolio" class="two">
					<div class="container">

						<header>
							<h2>Departments</h2>
						</header>

						<div class="row">
						<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<tr><th>Department</th><th>Patient</th></tr>
							<?php
							$result = mysqli_query($connection,"select * from pdhp_hospital_dept left join pdhp_dept on  pdhp_dept.id = pdhp_hospital_dept.d_id where pdhp_hospital_dept.h_id = ".$user_data['id']." order by pdhp_hospital_dept.num_opd desc");
							while($row = mysqli_fetch_array($result))
							{
								echo '
									<tr>
									<td>'.$row['dept_name'].'</td>
									<td>'.$row['num_opd'].'</td>
									</tr>
								';
							}
							?>
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
						<!-- <form id="form_1123909" class="appnitro"  method="post" action="HospitalInput.php">
						<ul> -->
		<div class="col-xs-12" style="padding-bottom:20px;">
			<h3 class="col-xs-12 text-center">UserName : <?php echo $user_data['username'] ?></h3>
		</div>
		<div class="col-xs-12 nopadding">
			<label class="description pull-left" for="name">Name of Hospital  </label>
			<div class="col-xs-12 nopadding">
				<form action="model.php" method="post">
					<div class="col-xs-9 nopadding">
						<input id="name" name="name" class="element text medium" type="text" value="<?php echo $user_data['name'] ?>" required/> 
					</div>
					<div class="col-xs-3">
						<button type="submit" name="update_hospital_name">Update</button>
					</div>
				</form>
			</div>
		</div>


		<div class="col-xs-12 nopadding" style="margin:30px 0;">
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
						<button type="submit" name="update_hospital_password">Update</button>
					</div>
				</form>
			</div> 
		</div>

		<div class="col-xs-12 nopadding">
			<label class="description pull-left" for="name">Phone </label>
			<div class="col-xs-12 nopadding">
				<form action="model.php" method="post">
					<div class="col-xs-9 nopadding">
						<input id="name" name="phone" class="element text medium" type="text" value="<?php echo $user_data['phone'] ?>" required/> 
					</div>
					<div class="col-xs-3">
						<button type="submit" name="update_hospital_phone">Update</button>
					</div>
				</form>
			</div> 
		</div>
		
		<div class="col-xs-12 nopadding">
			<label class="description pull-left" for="name">Address </label>
			<div class="col-xs-12 nopadding">
				<form action="model.php" method="post">
					<div class="col-xs-9 nopadding">
						<input id="name" name="address" class="element text medium" type="text" value="<?php echo $user_data['address'] ?>" required/> 
					</div>
					<div class="col-xs-3">
						<button type="submit" name="update_hospital_address">Update</button>
					</div>
				</form>
			</div> 
		</div>
		<div class="col-xs-12 nopadding">
			<label class="description pull-left" for="name">Email </label>
			<div class="col-xs-12 nopadding">
				<form action="model.php" method="post">
					<div class="col-xs-9 nopadding">
						<input id="name" name="email" class="element text medium" type="text" value="<?php echo $user_data['email'] ?>" required/> 
					</div>
					<div class="col-xs-3">
						<button type="submit" name="update_hospital_email">Update</button>
					</div>
				</form>
			</div> 
		</div>
		<div class="col-xs-12 nopadding">
			<label class="description pull-left" for="name">Website </label>
			<div class="col-xs-12 nopadding">
				<form action="model.php" method="post">
					<div class="col-xs-9 nopadding">
						<input id="name" name="website" class="element text medium" type="text" value="<?php echo $user_data['website'] ?>" required/> 
					</div>
					<div class="col-xs-3">
						<button type="submit" name="update_hospital_website">Update</button>
					</div>
				</form>
			</div> 
		</div>
<!-- </form> -->
						
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


			<!-- Response -->
				<section id="contact" class="four">
	<div class="container">

		<header><h2>ADD DEPARTMENT</h2></header>
		<form action="model.php" method="post">
			<div class="col-xs-12 text-left">
			<?php
				$i=0;
				$result = mysqli_query($connection,"select * from pdhp_dept order by dept_name");
				while($row = mysqli_fetch_array($result))
				{
					echo '
					<div class="col-xs-12 col-md-6" style="padding-left:20px;">
						<input style="position:absolute;top:10px;left:0;" type="checkbox" id="dept_'.$row['id'].'" value="'.$row['id'].'" name="dept[]">
						<label for="dept_'.$row['id'].'">'.$row['dept_name'].'</label>
					</div>
					';
					$i++;
				}
				echo '<input name="dept_count" value="'.$i.'" type="hidden">';

			?>
			</div>
			<div class="col-xs-12 tex-center">
			<button name="update_hospital_dept" type="submit">Update</button>
			</div>
		</form>

	</div>
		
	<div class="container" id="response">

		<header><h2>Response</h2></header>
							
		<div class="col-xs-12">
		<table class="update_info" cellspacing="2"> 
			<tr>
				<th class="text-center">Department</th>
				<th class="text-center">Available Seats</th>
				<th class="text-center">Number of OPD patients</th>
				<th class="text-center">Doctors Available</th>
				<th></th>


			</tr>
			<?php
				$i=0;
				$result = mysqli_query($connection,"select  pdhp_hospital_dept.id AS h_d_Id, pdhp_dept.id AS dept_Id, pdhp_dept.dept_name, pdhp_hospital_dept.num_seat,pdhp_hospital_dept.num_opd,pdhp_hospital_dept.num_doc from pdhp_hospital_dept left join pdhp_dept on pdhp_hospital_dept.d_id = pdhp_dept.id where h_id = $id ");
				while($row = mysqli_fetch_array($result))
				{
					echo '
						<tr>
							<form action="model.php" method="post">
									<td style="word-break:break-all;">'.$row['dept_name'].' <input type="hidden" name="d_id" value="'.$row['h_d_Id'].'"></td>
									<td class="text-center"><input class="input-sm" value="'.$row['num_seat'].'" name="seats_avail"></td>
									<td class="text-center"><input class="input-sm"  value="'.$row['num_opd'].'" name="opd_patients"></td>
									<td class="text-center"><input class="input-sm"  value="'.$row['num_doc'].'" name="doctors_avail"></td>
									<td class="text-center"><button type="submit" name="update_hospital_dept_data" class="button-sm">Save</button></td>
							</form>

						</tr>
					';
					$i++;
				}
				echo '<input name="dept_count" value="'.$i.'" type="hidden">';

			?>
			
		</table>

	</div> 
	</div> 
			
	
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
		<script src="assets/js/bootstrap.js"></script>

</body>
</html>