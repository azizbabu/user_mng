<?php

session_start();

include 'functions.php';

if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['submit'])){
	
	// $id = $_POST['id'];
	$id = $_SESSION['id'];
	$name = test_input($_POST['name']);
	$father_name = test_input($_POST['father_name']);
	$mother_name = test_input($_POST['mother_name']);
	$address = test_input($_POST['address']);
	$email = test_input($_POST['email']);
	$phone = test_input($_POST['phone']);
	$day = test_input($_POST['day']);
	$month = test_input($_POST['month']);
	$year = test_input($_POST['year']);
	$birth_day = $day . '-' . $month . '-' . $year;
	$sex = test_input($_POST['sex']);
	$marital_status = test_input($_POST['marital_status']);
	$country = test_input($_POST['country']);
	$pic = $_FILES['pic'];
	$pic_src = $_POST['pic'];
	if($pic['name']){
		$pic_src = 'upload/' . $pic["name"];
	}
	$username = test_input($_POST['username']);
	// $password = test_input($_POST['password']);
	$status = 1;
	$old_email = $_POST['old_email'];
	$old_username = $_POST['old_username'];
	// echo "<img src = '$pic_src'>";

/***********************************************************************************************/
/* Input Validation */
/***********************************************************************************************/

	if(is_empty($name,'Name')){
		$name_err = is_empty($name,'Name');
		$_SESSION['name_err'] = $name_err;
		header('location:update.php');
		return;
	}else{
		unset($_SESSION['name_err']);
		if(!valid_name($name)){
			$_SESSION['name_err'] = "Only letters and white space allowed";
			header('location:update.php');
			return;
		}
	}

	if(is_empty($father_name,'father_Name')){
		$father_name_err = is_empty($father_name,'Father\'s Name');
		$_SESSION['father_name_err'] = $father_name_err;
		header('location:update.php');
		return;
	}else{
		unset($_SESSION['father_name_err']);
		if(!valid_name($father_name)){
			$_SESSION['father_name_err'] = "Only letters and white space allowed";
			header('location:update.php');
			return;
		}
	}

	if(is_empty($mother_name,'mother_Name')){
		$mother_name_err = is_empty($mother_name,'Mother\'s Name');
		$_SESSION['mother_name_err'] = $mother_name_err;
		header('location:update.php');
		return;
	}else{
		unset($_SESSION['mother_name_err']);
		if(!valid_name($mother_name)){
			$_SESSION['mother_name_err'] = 'Only letters and white space allowed';
			header('location:update.php');
			return;
		}
	}

	if(is_empty($email,'email')){
		$email_err = is_empty($email,'Email');
		$_SESSION['email_err'] = $email_err;
		header('location:update.php');
		return;
	}else{
		unset($_SESSION['email_err']);
		if(!valid_email($email)){
			$_SESSION['email_err'] = "Invalid email format";
			header('location:update.php');
			return;
		}else{
			unset($_SESSION['email_err']);
		}
	}

	if(!empty($phone)){
		if(!preg_match('/^[\d-+(),]{6,}+$/', $phone)){
			$_SESSION['phone_err'] = "Phone no must be numeric and atleast 6 character long";
			header('location:update.php');
			return;
		}else{
			unset($_SESSION['phone_err']);
		}
	}

	if(is_empty($day,'day')){
		$day_err = is_empty($day,'Day');
		$_SESSION['day_err'] = $day_err;
		header('location:update.php');
		return;
	}else{
		unset($_SESSION['day_err']);
	}

	if(is_empty($month,'month')){
		$month_err = is_empty($month,'Month');
		$_SESSION['month_err'] = $month_err;
		header('location:update.php');
		return;
	}else{
		unset($_SESSION['month_err']);
	}

	if(is_empty($year,'year')){
		$year_err = is_empty($year,'Year');
		$_SESSION['year_err'] = $year_err;
		header('location:update.php');
		return;
	}else{
		unset($_SESSION['year_err']);
	}

	if(is_empty($sex,'sex')){
		$sex_err = is_empty($sex,'Sex');
		$_SESSION['sex_err'] = $sex_err;
		header('location:update.php');
		return;
	}

	if(is_empty($marital_status,'Marital Status')){
		$marital_err = is_empty($marital_status,'Marital Status');
		$_SESSION['marital_err'] = $marital_err;
		header('location:update.php');
		return;
	}

	if(!empty($pic['name'])){
		if(valid_file($pic)){
			// if (file_exists("upload/" . $pic["name"])) {
		 //      echo $pic["name"] . " already exists. ";
		 //    } else {
		      move_uploaded_file($pic["tmp_name"],
		      "upload/" . $pic["name"]);
		      // echo "Stored in: " . "upload/" . $pic["name"];
		      // echo "<br/><img src='upload/{$pic['name']}' alt = 'img'>";
		    // }
		      unset($_SESSION['pic_err']);
		}else{
			$_SESSION['pic_err'] = "File should be gif, jpeg, jpg, png format and less than 3Kb";
			header('location:update.php');
			return;
		}
	}


	if(is_empty($country,'country')){
		$country_err = is_empty($country,'Country');
		$_SESSION['country_err'] = $country_err;
		header('location:update.php');
		return;
	}else{
		unset($_SESSION['country_err']);
	}

	if(is_empty($username,'username')){
		$username_err = is_empty($username,'Username');
		$_SESSION['username_err'] = $username_err;
		header('location:update.php');
		return;
	}else{
		unset($_SESSION['username_err']);
		if(!preg_match('/^[A-Za-z][A-Za-z0-9-_@.]{3,}+$/',$username)){
			$_SESSION['username_err'] = "Username start with letter and atleast 4 character long";
			header('location:update.php');
			return;
		}
		else{
			unset($_SESSION['username_err']);	
		}
	}

	// if(is_empty($password,'password')){
	// 	$password_err = is_empty($password,'Password');
	// 	$_SESSION['password_err'] = $password_err;
	// 	header('location:update.php');
	// }else{
	// 	unset($_SESSION['password_err']);
	// 	if(!preg_match('/^[\w\W]{8,}+$/',$password)){
	// 		$_SESSION['password_err'] = "Password must be atleast 8 character long";
	// 		header('location:update.php');
	// 	}else{
	// 		$password = md5($password);
	// 	}
	// }

/***********************************************************************************************/
/* Data Insert to Database */
/***********************************************************************************************/

	include 'db.php';

/***********************************************************************************************/
/* Check wheather a username and email already exists */
/***********************************************************************************************/

	$sql1 = "SELECT email FROM members WHERE email = '$email'";
	$result1  = mysql_query($sql1);

	$sql2 = "SELECT username FROM members WHERE username = '$username'";
	$result2 = mysql_query($sql2);

	if($email !== $old_email){
		if(mysql_num_rows($result1) > 0) {
			$_SESSION['email_err'] = "Email already exists in database";
			header('location:update.php');
			exit();
		}else{
			unset($_SESSION['email_err']);
		}
	}
	
	if($username !== $old_username){
		if(mysql_num_rows($result2) > 0) {
			$_SESSION['username_err'] = "Username already exists in database";
			header('location:update.php');
			exit();
		}else{
			unset($_SESSION['username_err']);
		}
	}

	$sql = "UPDATE members SET name='$name',father_name='$father_name',mother_name='$mother_name',address='$address',email='$email',phone='$phone',birth_day='$birth_day',sex='$sex',marital_status='$marital_status',country='$country',pic='$pic_src',username='$username',status='$status' WHERE id='$id'";

	$result = mysql_query($sql);

	if($result){
		$_SESSION['msg_update'] = "User account is updated";
		header('location:index.php');
		unset($_SESSION['msg_update']);
	}else{
		$_SESSION['msg_update']  = "User account could not be updated";
		header('location:update.php');
	}
	// }
}else{
	// unset($_SESSION['username_err']);
	// $_SESSION['username_err'] = "Username already exists";
	header('location:update.php?err=1');
}
