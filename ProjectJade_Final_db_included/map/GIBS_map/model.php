<?php
session_start();

  require_once("../../include/db_connect.php");
  require_once("../../include/function.php");
  if(!isset($_SESSION['id']) || $_SESSION['user_type'] != 'environment')
header("location:../../public/Login_form.php");
$id = $_SESSION['id'];
if(isset($_POST['comment_btn']))
{
	 $country = $_POST['country'];
 	$date = $_POST['date'];
	$comment = htmlentities($_POST['comment_box']);
	mysqli_query($connection,"insert into comment_text (e_id,comment,date_time) values($id,'$comment',now())");
	header("location:link.php?country=".$country."&date=".$date);
}

if(isset($_POST['grade_insert']))
{
	$cm = $_POST['cm'];
	$dc = $_POST['dc'];
	$sd = $_POST['sd'];
	$ol = $_POST['ol'];
	$country = $_POST['country'];
	$date = $_POST['date'];
	$result_1 = mysqli_query($connection,"select * from sc_grade where e_id = $id ");
          $row_1 = mysqli_fetch_assoc($result_1);
          if(is_array($row_1))
          {
          	mysqli_query($connection,"update sc_grade set cm=$cm,dc=$dc,sd=$sd,ol=$ol,date_time=now() where e_id = $id");
          }
          else
          	mysqli_query($connection,"insert into sc_grade (e_id,cm,dc,sd,ol,date_time) values($id,$cm,$dc,$sd,$ol,now())");
	header("location:link.php?country=".$country."&date=".$date);
}

?>

