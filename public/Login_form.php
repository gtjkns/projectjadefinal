<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Login Form</title>
<link rel="stylesheet" type="text/css" href="assets\forms_assets\view.css" media="all">
<script type="text/javascript" src="assets\forms_assets\view.js"></script>

</head>
<body id="main_body" >
	
	<img id="top" src="assets\forms_assets\top.png" alt="">
	<div id="form_container">
	
		<h1><a>Login Form</a></h1>
		<form id="form_1123733" class="appnitro"  method="post" action="verifylogin.php">
					<div class="form_description">
			<h2>Log in</h2>
		</div>						
			<ul >
			
					<li id="li_1" >
		<label class="description" for="element_1">Username</label>
		<div>
			<input id="element_1" name="username" class="element text medium" type="text" maxlength="255" value="" required/> 
		</div> 
		</li>		<li id="li_2" >
		<label class="description" for="element_2">Password </label>
		<div>
			<input id="element_2" name="password" class="element text medium" type="password" maxlength="255" value="" required/> 
		</div> 
		</li>		<li id="li_2" >
		<label class="description" for="type">Account type </label>
		<div>
		<select class="element select medium" id="element_2" name="type"> 
			<option value="" selected="selected"></option>
				<option value="patient" >Patient</option>
				<option value="doctor" >Doctor</option>
				<option value="hospital" >Hospital</option>
				<option value="pharmacy" >Pharmacy</option>
				<option value="environment" >Environmental Scientist</option>

		</select>
		</div> 
		</li>
			
					<li class="buttons">
			    <input type="hidden" name="form_id" value="1123733" />
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Login" />
		</li>
			</ul>
		</form>	
	</div>
	<img id="bottom" src="assets\forms_assets\bottom.png" alt="">
	</body>
</html>