<?php
session_start();

// $id = $_REQUEST['id'];

$id = $_SESSION['id'];

// if(isset($id) && isset($_SESSION['id']) && $_SESSION['id'] == $id){
if(isset($_SESSION['id'])){

	include 'db.php';

	$sql = "DELETE FROM members WHERE id = '$id'";
	$result = mysql_query($sql);
	if($result){
		// $_SESSION['delete_msg'] = "Your account is deleted, please register again";
		// unset($_SESSION['id']);
		header('location:register.php?delete_msg=1');
		session_destroy();
	}else{
		header('location:index.php');
	}
}else{
	header('location:register.php');
}
?>