<?php
session_start();
if(isset($_SESSION['id']))
{
	
		header("location:../profiles/".$_SESSION['user_type'].".php");
}
	require_once("../include/db_connect.php");
	require_once("../include/function.php");

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<link rel="stylesheet" type="text/css" href="assets/forms_assets/view.css" media="all">
<script type="text/javascript" src="assets/forms_assets/view.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
<script type="text/javascript">
	function find_city(id)
	{
		$.ajax({url: "../place.php?find_city="+id, success: function(result){
			document.getElementById("put_city").innerHTML = result;
	    }});
	}
</script>
</head>
<body id="main_body" >
	
	<img id="top" src="assets/forms_assets/top.png" alt="">
	<div id="form_container">
	
	<h1><a>Pharmacy Form</a></h1>
		<form id="form_1123733" class="appnitro"  method="post" action="PharmacySignup.php">
					<div class="form_description">
			<h2>Pharmacy Form</h2>
			</div>	
			<?php
			if(isset($_GET['msg']))
			{
				if($_GET['msg'] == 1 )
					echo '<p><b>Sorry, Username Already exists.</b></p>';
				else if($_GET['msg'] == 2 )
					echo '<p><b>Sorry, Email Already exists.</b></p>';
				else if($_GET['msg'] == 3 )
					echo '<p><b>Sorry, Username and Email Already exists.</b></p>';
			}
			?>
			<ul >
			
					<li id="li_1" >
		<label class="description" for="element_1">Name </label>
		<div>
			<input id="name" name="name" class="element text medium" type="text" value="" required/>
		</div> 
		</li>		<li id="li_1" >
		<label class="description" for="username">Username </label>
		<div>
			<input id="username" name="username" class="element text medium" type="text" value="" required/>
		</div> 
		</li>		<li id="li_2" >
		<label class="description" for="email">Email </label>
		<div>
			<input id="email" name="email" class="element text medium" type="email" value="" required/> 
		</div> 
		</li>		<li id="li_2" >
		<label class="description" for="password">Password </label>
		<div>
			<input id="password" name="password" class="element text medium" type="password" value="" required/> 
		</div> 
		</li>	<li id="password_li" >
		<label class="description" for="password">Confirmed password </label>
		<div>
			<input id="confirmpassword" name="confirmpassword" class="element text medium" type="password" maxlength="255" value="" required/> 
		</div> 
		</li>
				<li id="li_2" >
		<label class="description" for="password">Address </label>
		<div>
			<input id="address" name="address" class="element text medium" type="text" value="" required/>
		</div> 
		</li>	
				<li id="li_4" >
		<label class="description" for="registration">Registration number </label>
		<div>
			<input id="registration" name="registration" class="element text medium" type="text" value="" required/> 
		</div> 
		</li>		<li id="li_4" >
		<label class="description" for="element_4">Phone</label>
		<div>
			<input id="phone" name="phone" class="element text medium" type="text" value="" required/> 
		</div> 
		</li>	
		<li id="country" >
		<label class="description" for="country">Country </label>

		
		

		<div>

		<select class="element select medium country" id="country" name="country" required onchange="find_city(this.value)">
				<option value="">Select Country</option>
			<?php		
					$country = find_country();  

				  	while ( $country_arr = mysqli_fetch_assoc($country)) {
							 echo "<option value='".$country_arr['id']."'>".$country_arr['country']."</option>";
					}
				
			  ?>
		</select>

		
		</div> 
		</li>		<li id="li_10" >
		<label class="description" for="city">City/State </label>
		<div>
		<div class="col-xs-12" id="put_city">
			
		</div>
		
		</div> 
		</li>
			
					<li class="buttons">
			    <input type="hidden" name="form_id" value="1123909" />
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>	
	</div>
	<img id="bottom" src="assets\forms_assets\bottom.png" alt="">
	</body>
</html>