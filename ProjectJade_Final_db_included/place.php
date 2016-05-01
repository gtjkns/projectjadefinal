<?php
require_once("include/db_connect.php");
require_once("include/function.php");

if(isset($_GET['find_city']))
{
	$id = $_GET['find_city'];
	$city = find_city_by_country($id);
	echo '<select class="form-control" name="city" id="city">
				<option value="">Select City</option>';
				  	while ( $city_arr = mysqli_fetch_assoc($city)) {
							 echo "<option value='".$city_arr['id']."'>".$city_arr['name']."</option>";
					}
	echo '</select>
			<p> &nbsp;</p>';
}

if(isset($_GET['guest_find_city']))
{
	$id = $_GET['guest_find_city'];
	$city = find_city_by_country($id);
	echo '<select class="form-control" name="city" id="hospital_by_city" onchange="find_hospital()">
				<option value="">Select City</option>';
				  	while ( $city_arr = mysqli_fetch_assoc($city)) {
							 echo "<option value='".$city_arr['id']."'>".$city_arr['name']."</option>";
					}
	echo '</select>
			<p> &nbsp;</p>';
}

if(isset($_GET['guest_find_hospital']))
{
	$country = $_GET['country'];
	$city = $_GET['city'];
	$string = "";
	$count = 0;
	$result = mysqli_query($connection,"select * from pdhp_hospital where cid = $country and sid = $city");
	$string = $string. '<ul>';
				  	while ( $row = mysqli_fetch_assoc($result)) {
							 $string = $string. '<li><a class="modal_show" data-toggle="modal" href="#myModal_'.$count.'">'.$row['name'].'</a>
							 <div id="myModal_'.$count.'" class="modal fade" role="dialog">
								  <div class="modal-dialog">

								    <!-- Modal content-->
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">Hospital</h4>
								      </div>
								      <div class="modal-body">
								      	<table class="table">
								      		<tr><td>Name :</td><td>'.$row['name'].'</td></tr>
								      		<tr><td>Phone :</td><td>'.$row['phone'].'</td></tr>
								      		<tr><td>Email :</td><td>'.$row['email'].'</td></tr>
								      		<tr><td>Website :</td><td>'.$row['website'].'</td></tr>
								      		<tr><td>Registration No :</td><td>'.$row['reg_num'].'</td></tr>
								      		<tr><td>Address :</td><td>'.$row['address'].'</td></tr>
								      	</table>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
								      </div>
								    </div>

								  </div>
								</div>
							 </li>';
							 $count++;
					}
	$string = $string.'</ul><p> &nbsp;</p>';
			if($count > 0)
				echo $string;
			else
				echo 'No Results Found.';
}



?>