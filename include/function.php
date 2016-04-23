<?php 
	
	function confirm_query($result_set){
			if(!$result_set) {
				die("Database Query Failed.");
		}
	}

	function find_department(){
		global $connection;
		$query = "SELECT id, dept_name from pdhp_dept ORDER BY dept_name";
		$department = mysqli_query($connection, $query);
		confirm_query($department);

		return $department;
	}

	function find_country(){
		global $connection;
		$query = "SELECT id, country from pdhp_country ORDER BY country";
		$country = mysqli_query($connection, $query);
		confirm_query($country);

		return $country;
	}

	function find_city(){
		
		global $connection;
		//$query = "SELECT pdhp_city.name FROM pdhp_city where region_id = " . $country;
		$query = "SELECT id, name FROM pdhp_city ORDER BY name";
		$city = mysqli_query($connection, $query);
		confirm_query($city);
		
		
		return $city;
	} 
	function find_disease(){
		
		global $connection;
		$query = "SELECT id, disease FROM pdhp_disease ORDER BY disease";
		$disease_set = mysqli_query($connection, $query);
		confirm_query($disease_set);
		
		
		return $disease_set;
	}

	function find_symptom(){
		global $connection;
		$query = "SELECT id, symptom FROM pdhp_symptom ORDER BY symptom";
		$symptom_set = mysqli_query($connection, $query);
		confirm_query($symptom_set);
		
		
		return $symptom_set;
	} 


	function patientDoctor(){
		
	}

	function redirect($url, $permanent = false) {
		if($permanent) {
			header('HTTP/1.1 301 Moved Permanently');
		}
		header('Location: '.$url);
		exit();
}

function mysql_prep($string){
		global $connection;
		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}




?>