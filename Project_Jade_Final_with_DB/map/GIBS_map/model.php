<?php
session_start();

  require_once("../../include/db_connect.php");
  require_once("../../include/function.php");
  if(!isset($_SESSION['id']) || $_SESSION['user_type'] != 'environment')
header("location:../../public/Login_form.php");
$id = $_SESSION['id'];
if(isset($_POST['comment_btn']))
{
	$comment = htmlentities($_POST['comment_box']);
	mysqli_query($connection,"insert into comment_text (e_id,comment,date_time) values($id,'$comment',now())");
	header("location:link.php");
}

?>

