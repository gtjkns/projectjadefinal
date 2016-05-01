<?php
session_start();
require_once("../include/db_connect.php");
require_once("../include/function.php");
if(!isset($_SESSION['id']))
{
	header("location:../public/Login_form.php");
} 
$id = $_SESSION['id'];


if($_SESSION['user_type'] == 'patient')
{

	$user_data = get_user($_SESSION['id'], "pdhp_patient");

	if(isset($_POST['feedback_on_symptom']))
	{
		$s_id = $_POST['s_id'];
		$feedback = $_POST['feedback'];
		mysqli_query($connection,"insert into pat_feedback_s (p_id,s_id,feedback,date_time) values($id,$s_id,'$feedback',now())");
		header("location:Patient.php");
	}

	if(isset($_POST['feedback_on_disease']))
	{
		$d_id = $_POST['d_id'];
		$feedback = $_POST['feedback'];
		mysqli_query($connection,"insert into pat_feedback_d (p_id,d_id,feedback,date_time) values($id,$d_id,'$feedback',now())");
		header("location:Patient.php");
	}

	if(isset($_POST['patient_record']))
	{
		$d_id = $_POST['d_id'];
		$s_id = $_POST['s_id'];
		$description = $_POST['description'];
		$grade = $_POST['grade'];
		$symptom_photo = explode(".",$_FILES['symptom_photo']['name']);
		$ext_1 = end($symptom_photo);
		$report_photo = explode(".",$_FILES['report_photo']['name']);
		$ext_2 = end($report_photo);
		$symptom_photo = 'symptom_photo_'.str_replace(" ","",microtime()).'.'.$ext_1;
		$report_photo = 'report_photo_'.str_replace(" ","",microtime()).'.'.$ext_2;


		move_uploaded_file($_FILES['symptom_photo']['tmp_name'], getcwd().'/upload/symptom/'.$symptom_photo);
		move_uploaded_file($_FILES['report_photo']['tmp_name'], getcwd().'/upload/report/'.$report_photo);
		//$id,$d_id,$s_id,$grade,$report_photo,$symptom_photo,$description,now()
		//p_id,d_id,s_id,s_grade,report,symptom,description,date_time
		mysqli_query($connection,"insert into pdhp_pat_dis (p_id,d_id,s_id,s_grade,report,symptom,description,date_time) values($id,$d_id,$s_id,$grade,'$report_photo','$symptom_photo','$description',now())");
		header("location:Patient.php");
	}

}

if($_SESSION['user_type'] == 'pharmacy')
{
	$user_data = get_user($_SESSION['id'], "pdhp_pharmacy");

	if(isset($_POST['pharmacy_patient_record']))
	{
		$d_id = $_POST['d_id'];
		$num_cus = $_POST['num_cus'];
		$num_pre_cus = $_POST['num_pre_cus'];
		mysqli_query($connection,"insert into pharmacy_disease_count (p_id,d_id,num_cus,num_pre_cus,date_time) values($id,$d_id,$num_cus,$num_pre_cus,now())");
		header("location:Pharmacy.php");
	}

	if(isset($_POST['update_pharmacy_phone']))
	{
		$phone = $_POST['phone'];
		mysqli_query($connection,"update pdhp_pharmacy set phone = '$phone' where id = $id");
		header("location:Pharmacy.php");
	}

	if(isset($_POST['update_pharmacy_email']))
	{
		$email = $_POST['email'];
		mysqli_query($connection,"update pdhp_pharmacy set email = '$email' where id = $id");
		header("location:Pharmacy.php");
	}

	if(isset($_POST['update_pharmacy_address']))
	{
		$address = $_POST['address'];
		mysqli_query($connection,"update pdhp_pharmacy set address = '$address' where id = $id");
		header("location:Pharmacy.php");
	}
	if(isset($_POST['update_pharmacy_password']))
	{
		$old = $_POST['old'];
		$new = $_POST['new'];
		$new_2 = $_POST['new_2'];
		if($user_data['password'] == $old && $new == $new_2)
		mysqli_query($connection,"update pdhp_pharmacy set password = '$new' where id = $id");
		header("location:pharmacy.php");
	}
}


if($_SESSION['user_type'] == 'doctor')
{
	$user_data = get_user($_SESSION['id'], "pdhp_doctor");

	if(isset($_POST['doctor_patient_record']))
	{
		$d_id = $_POST['disease'];
		$num_patient = $_POST['num_patient'];
		$num_med = $_POST['num_med'];
		$num_atnd_h = $_POST['num_atnd_h'];
		$foreign = $_POST['foreign'];
		if($foreign == '1')
		mysqli_query($connection,"insert into doc_disease_count (doc_id,num_patient,num_med,num_atnd_h,date_time,d_id,if_foreign) values($id,$num_patient,$num_med,$num_atnd_h,now(),$d_id,$foreign)");
		header("location:doctor.php");
	}

	if(isset($_POST['update_doctor_email']))
	{
		$email = $_POST['email'];
		mysqli_query($connection,"update pdhp_doctor set email = '$email' where id = $id");
		header("location:doctor.php");
	}

	if(isset($_POST['update_doctor_phone']))
	{
		$phone = $_POST['phone'];
		mysqli_query($connection,"update pdhp_doctor set phone = '$phone' where id = $id");
		header("location:doctor.php");
	}

	if(isset($_POST['update_doctor_password']))
	{
		$old = $_POST['old'];
		$new = $_POST['new'];
		$new_2 = $_POST['new_2'];
		if($user_data['password'] == $old && $new == $new_2)
		mysqli_query($connection,"update pdhp_doctor set password = '$new' where id = $id");
		header("location:doctor.php");
	}



}
if($_SESSION['user_type'] == 'hospital')
{
	$user_data = get_user($_SESSION['id'], "pdhp_hospital");

	if(isset($_POST['update_hospital_name']))
	{
		$name = $_POST['name'];
		mysqli_query($connection,"update pdhp_hospital set name = '$name' where id = $id");
		header("location:Hospital.php");
	}

	if(isset($_POST['update_hospital_phone']))
	{
		$phone = $_POST['phone'];
		mysqli_query($connection,"update pdhp_hospital set phone = '$phone' where id = $id");
		header("location:Hospital.php");
	}
	
	if(isset($_POST['update_hospital_address']))
	{
		$address = $_POST['address'];
		mysqli_query($connection,"update pdhp_hospital set address = '$address' where id = $id");
		header("location:Hospital.php");
	}
	
	if(isset($_POST['update_hospital_email']))
	{
		$email = $_POST['email'];
		mysqli_query($connection,"update pdhp_hospital set email = '$email' where id = $id");
		header("location:Hospital.php");
	}
	
	if(isset($_POST['update_hospital_website']))
	{
		$website = $_POST['website'];
		mysqli_query($connection,"update pdhp_hospital set website = '$website' where id = $id");
		header("location:Hospital.php");
	}
	
	if(isset($_POST['update_hospital_dept']))
	{
		$dept = $_POST['dept'];
		foreach ($dept as $value) {
			$result = mysqli_query($connection,"select * from pdhp_hospital_dept where h_id = $id and d_id = $value");
			$row = mysqli_num_rows($result);
			if($row < 1)
			mysqli_query($connection,"insert into pdhp_hospital_dept (h_id,d_id) values($id,$value)");
		}
		header("location:Hospital.php");
	}
	
	if(isset($_POST['update_hospital_password']))
	{
		$old = $_POST['old'];
		$new = $_POST['new'];
		$new_2 = $_POST['new_2'];
		if($user_data['password'] == $old && $new == $new_2)
		mysqli_query($connection,"update pdhp_hospital set password = '$new' where id = $id");
		header("location:Hospital.php");
	}

	
	if(isset($_POST['update_hospital_dept_data']))
	{
		$d_id = $_POST['d_id'];
		$seats_avail = $_POST['seats_avail'];
		$opd_patients = $_POST['opd_patients'];
		$doctors_avail = $_POST['doctors_avail'];
		mysqli_query($connection,"update pdhp_hospital_dept set num_seat = $seats_avail, num_doc = $doctors_avail, num_opd = $opd_patients where id = $d_id");
		header("location:Hospital.php");
	}



}
	
 ?>