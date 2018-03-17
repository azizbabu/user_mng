<?php

session_start();

include 'functions.php';

if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['submit'])){
	
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
	$pic_src = 'upload/profile.png';
	if($pic['name']){
		$pic_src = 'upload/' . $pic["name"];
	}
	$username = test_input($_POST['username']);
	$password = test_input($_POST['password']);
	$status = 1;
	// echo "<img src = '$pic_src'>";

/***********************************************************************************************/
/* Input Validation */
/***********************************************************************************************/

	if(is_empty($name,'Name')){
		$name_err = is_empty($name,'Name');
		$_SESSION['name_err'] = $name_err;
		header('location:register.php');
		return;
	}else{
		unset($_SESSION['name_err']);
		if(!valid_name($name)){
			$_SESSION['name_err'] = "Only letters and white space allowed";
			header('location:register.php');
			return;
		}else{
			$success[] = true;
		}
	}

	if(is_empty($father_name,'father_Name')){
		$father_name_err = is_empty($father_name,'Father\'s Name');
		$_SESSION['father_name_err'] = $father_name_err;
		header('location:register.php');
		return;
	}else{
		unset($_SESSION['father_name_err']);
		if(!valid_name($father_name)){
			$_SESSION['father_name_err'] = "Only letters and white space allowed";
			header('location:register.php');
			return;
		}else{
			$success[] = true;
		}
	}

	if(is_empty($mother_name,'mother_Name')){
		$mother_name_err = is_empty($mother_name,'Mother\'s Name');
		$_SESSION['mother_name_err'] = $mother_name_err;
		header('location:register.php');
		return;
	}else{
		unset($_SESSION['mother_name_err']);
		if(!valid_name($mother_name)){
			$_SESSION['mother_name_err'] = 'Only letters and white space allowed';
			header('location:register.php');
			return;
		}else{
			$success[] = true;
		}
	}

	if(is_empty($email,'email')){
		$email_err = is_empty($email,'Email');
		$_SESSION['email_err'] = $email_err;
		header('location:register.php');
		return;
	}else{
		unset($_SESSION['email_err']);
		if(!valid_email($email)){
			$_SESSION['email_err'] = "Invalid email format";
			header('location:register.php');
			return;
		}else{
			unset($_SESSION['email_err']);
			$success[] = true;
		}
	}

	if(!empty($phone)){
		if(!preg_match('/^[\d-+(),]{6,}+$/', $phone)){
			$_SESSION['phone_err'] = "Phone no must be numeric and atleast 6 character long";
			header('location:register.php');
			return;
		}else{
			unset($_SESSION['phone_err']);
			$success[] = true;
		}
	}

	if(is_empty($day,'day')){
		$day_err = is_empty($day,'Day');
		$_SESSION['day_err'] = $day_err;
		header('location:register.php');
		return;
	}else{
		unset($_SESSION['day_err']);
		$success[] = true;
	}

	if(is_empty($month,'month')){
		$month_err = is_empty($month,'Month');
		$_SESSION['month_err'] = $month_err;
		header('location:register.php');
		return;
	}else{
		unset($_SESSION['month_err']);
		$success[] = true;
	}

	if(is_empty($year,'year')){
		$year_err = is_empty($year,'Year');
		$_SESSION['year_err'] = $year_err;
		header('location:register.php');
		return;
	}else{
		unset($_SESSION['year_err']);
		$success[] = true;
	}

	if(is_empty($sex,'sex')){
		$sex_err = is_empty($sex,'Sex');
		$_SESSION['sex_err'] = $sex_err;
		header('location:register.php');
		return;
	}else{
			$success[] = true;
		}

	if(is_empty($marital_status,'Marital Status')){
		$marital_err = is_empty($marital_status,'Marital Status');
		$_SESSION['marital_err'] = $marital_err;
		header('location:register.php');
		return;
	}else{
			$success[] = true;
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
		      $success[] = true;
		}else{
			$_SESSION['pic_err'] = "File should be gif, jpeg, jpg, png format and less than 3Kb";
			header('location:register.php');
			return;
		}
	}


	if(is_empty($country,'country')){
		$country_err = is_empty($country,'Country');
		$_SESSION['country_err'] = $country_err;
		header('location:register.php');
		return;
	}else{
		unset($_SESSION['country_err']);
		$success[] = true;
	}

	if(is_empty($username,'username')){
		$username_err = is_empty($username,'Username');
		$_SESSION['username_err'] = $username_err;
		header('location:register.php');
		return;
	}else{
		unset($_SESSION['username_err']);
		if(!preg_match('/^[A-Za-z][A-Za-z0-9-_@.]{3,}+$/',$username)){
			$_SESSION['username_err'] = "Username start with letter and atleast 4 character long";
			header('location:register.php');
			return;
		}
		else{
			unset($_SESSION['username_err']);
			$success[] = true;	
		}
	}

	if(is_empty($password,'password')){
		$password_err = is_empty($password,'Password');
		$_SESSION['password_err'] = $password_err;
		header('location:register.php');
		return;
	}else{
		unset($_SESSION['password_err']);
		if(!preg_match('/^[\w\W]{8,}+$/',$password)){
			$_SESSION['password_err'] = "Password must be atleast 8 character long";
			header('location:register.php');
			return;
		}else{
			$password = md5($password);
			$success[] = true;
		}
	}


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

	// if(mysql_fetch_array($result1)){
	if(mysql_num_rows($result1) > 0) {
 //    //email is already taken
	// 	echo 0;
	// }
	// else {
 //    //email is available
	// 	echo 1;
	// }
		$_SESSION['email_err'] = "Email already exists in database";
		header('location:register.php');
		exit();
	}else{
		unset($_SESSION['email_err']);
	}
	// if(mysql_fetch_array($result2)){
	// 	$_SESSION['username_err'] = "Username already exists";
	// 	header('location:register.php?user_err=1');
	// }//else{
	if(mysql_num_rows($result2) > 0) {
		$_SESSION['username_err'] = "Username already exists in database";
		header('location:register.php');
		exit();
	}else{
		unset($_SESSION['username_err']);
	}
		$sql = "INSERT INTO members(name,father_name,mother_name,address,email,phone,birth_day,sex,marital_status,country,pic,username,password,status)VALUES('$name','$father_name','$mother_name','$address','$email','$phone','$birth_day','$sex','$marital_status','$country','$pic_src','$username','$password','$status')";

		$result = mysql_query($sql);

		if(isset($success) && $success == true){
		if($result){
			$_SESSION['msg_insert'] = "User information are inserted sucessfully in database. Please login atfirst";
			header('location:login.php');
			unset($_SESSION['msg_failed']);
		}else{
			$_SESSION['msg_failed']  = "Data are not inserted";
			header('location:register.php');
		}
		}
	// }
}else{
	// unset($_SESSION['username_err']);
	// $_SESSION['username_err'] = "Username already exists";
	header('location:register.php?err=1');
}
?>