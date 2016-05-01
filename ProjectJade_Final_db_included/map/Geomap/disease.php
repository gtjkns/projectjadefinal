<?php
session_start();
	require_once("../../include/db_connect.php");
	require_once("../../include/function.php");
	if(!isset($_SESSION['id']))
header("location:../../public/Login_form.php");

if($_SESSION['user_type'] == 'environment')
	$home_url = '../GIBS_map/start.php';
else
	$home_url = '../../profiles/'.$_SESSION['user_type'].'.php';
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
<style type="text/css">
	.nopadding{padding:0;}
</style>

	<div class="container">
		<div class="col-xs-12 col-md-6 col-md-offset-3" style="top:70px;">
			<h3 class="text-center">Disease Frequency</h3>
			<form  method="post"  action="disease_map.php">
			<table class="table">
				<tr>
					<td><label for="Symptom">Symptom:</label></td>
					<td>
						<select class="form-control" id="user_country" name="d_id" required>
						<option value="">Select</option>
						<?php 
									//if(isset($_POST["country"])){				
										$symptom = find_disease();  
									  	while ( $symp_arr = mysqli_fetch_assoc($symptom)) {
												 echo "<option value='".$symp_arr['id']."'>".$symp_arr['disease']."</option>";
										}
								//	}
									
						?>

					</select>
					</td>
				</tr>
				<tr>
					<td><label for="datepicker">From Date:</label></td>
					<td><input type="text" name="date_from" id = "datepicker" class="form-control" placeholder="From" required /></td>
				</tr>
				<tr>
					<td><label for="datepicker_2">To Date:</label></td>
					<td><input type="text" name="date_to" id = "datepicker_2" class="form-control" placeholder="To" required /></td>
				</tr>
				<tr>
					<td class="text-left"><a class="btn btn-warning" href="<?php echo $home_url; ?>">Home</a></td>
					<td class="text-right"><input class="btn btn-success" type = "submit" value = "Next"></td>
				</tr>
			</table>
			</form>
		</div>
	</div>
</body>
</html>