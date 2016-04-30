<?php
session_start();
	require_once("../../include/db_connect.php");
	require_once("../../include/function.php");
	if(!isset($_SESSION['id']))
header("location:../../public/Login_form.php");

 ?>
<html>
<body>
<link rel="stylesheet" type="text/css" href="../../profiles/assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../../profiles/assets/css/ui.css">
<script type="text/javascript" src="../../profiles/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="../../profiles/assets/js/ui.js"></script>
<script type="text/javascript">
	
	$(function() {
		$( "#datepicker,#datepicker_2" ).datepicker({dateFormat:"yy-mm-dd",changeMonth: true,changeYear: true,yearRange: '1950:2025'});
	});
</script>
	<form  method="post"  action="symptom_map.php">
<label for="Symptom">Symptom:</label>
<select class="single-select" id="user_country" name="s_id" required>
	<option value=""></option>
	<?php 
				//if(isset($_POST["country"])){				
					$symptom = find_symptom();  
				  	while ( $symp_arr = mysqli_fetch_assoc($symptom)) {
							 echo "<option value='".$symp_arr['id']."'>".$symp_arr['symptom']."</option>";
					}
			//	}
				
	?>

</select>
	&nbsp;&nbsp;<label for="date">Date:</label>
<input type="text" name="date_from" id = "datepicker" class="datepicker" placeholder="From" required /><br><br>
<input type="text" name="date_to" id = "datepicker_2" class="datepicker" placeholder="To" required /><br><br>
<input type = "submit" value = "Next">
</form>
</body>
</html>