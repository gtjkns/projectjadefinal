<?php
	require_once("../../include/db_connect.php");
	require_once("../../include/function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Hospital</title>
<link rel="stylesheet" type="text/css" href="../../profiles/assets/css/bootstrap.css" media="all">
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="../../profiles/assets/js/jquery.min.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="view.js"></script>
<script type="text/javascript">
	function find_city(id)
	{
		$.ajax({url: "../../place.php?guest_find_city="+id, success: function(result){
			document.getElementById("put_city").innerHTML = result;
	    }});
	}
	function find_hospital()
	{
		country = document.getElementById("country").value;
		hospital_by_city = document.getElementById("hospital_by_city").value;
		console.log(hospital_by_city);
			$.ajax({url: "../../place.php?guest_find_hospital=&country="+country+"&city="+hospital_by_city, success: function(result){
			document.getElementById("put_hospital").innerHTML = result;
	    }});
	}
	$(document).on('click','.modal_show',function(){
		href_ = $(this).attr('href');
		$(href_).modal('show');
	});
</script>
<style type="text/css">
	body{background:#67727B;}
</style>
</head>
<body id="main_body" >
	
	<img id="top" src="top.png" alt="">
	<div id="form_container">
	<div class="row" style="padding:20px;">
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
	</div>
	<img id="bottom" src="bottom.png" alt="">
	</body>
</html>