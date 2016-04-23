<?php 
	require_once("../../include/db_connect.php");
	require_once("../../include/function.php");
 ?>
<html>
<body>
	<form  type= get  action="geomap.5.htm">
<label for="Symptom">Symptom:</label>
<select class="single-select" id="user_country" name="country" required>
	<option value=""></option>
	<?php 
				//if(isset($_POST["country"])){				
					$symptom = find_symptom();  
				  	while ( $symp_arr = mysqli_fetch_assoc($symptom)) {
							 echo "<option value='{".$symp_arr['id']."}'>".$symp_arr['symptom']."</option>";
					}
			//	}
				
	?>

</select>
	&nbsp;&nbsp;<label for="date">Date:</label>
<input type="text" name="date" placeholder="yyyy-mm-dd" required /><br><br>
<input type = "submit" value = "Next">
</form>
</body>
</html>