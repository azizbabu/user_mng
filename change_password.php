<?php

session_start();

$id = $_SESSION['id'];
if(!isset($_SESSION['id'])){
    header('location:login.php');
}

include 'functions.php';

include 'db.php';

$sql= "SELECT * FROM members WHERE id = '$id'";
$result = mysql_query($sql);
$row  = mysql_fetch_array($result);

if(isset($_POST['submit'])){
	$old_password = $_POST['old_password'];
	$new_password = $_POST['new_password'];
	$con_new_password = $_POST['con_new_password'];
	// echo $row['password'] . '<br/>';
	// echo md5($old_password);
	// die();
	if(is_empty($old_password,'Old Password')){
		$password_err = is_empty($old_password,'Old Password');
		$_SESSION['old_password_err'] = $password_err;
		header('location:change_password.php');
		return;
	}else{
		unset($_SESSION['old_password_err']);
		if(!preg_match('/^[\w\W]{8,}+$/',$old_password)){
			$_SESSION['old_password_err'] = "Password must be atleast 8 character long";
			header('location:change_password.php');
			return;
		}else{
			$old_password = md5($old_password);
		}
	}
	if(is_empty($new_password,'New Password')){
		$password_err = is_empty($new_password,'New Password');
		$_SESSION['new_password_err'] = $password_err;
		header('location:change_password.php');
		return;
	}else{
		unset($_SESSION['new_password_err']);
		if(!preg_match('/^[\w\W]{8,}+$/',$new_password)){
			$_SESSION['new_password_err'] = "Password must be atleast 8 character long";
			header('location:change_password.php');
			return;
		}else{
			$new_password = md5($new_password);
		}
	}
	if(is_empty($con_new_password,'New Confirm Password')){
		$password_err = is_empty($con_new_password,'New Confirm Password');
		$_SESSION['con_new_password_err'] = $password_err;
		header('location:change_password.php');
		return;
	}else{
		unset($_SESSION['con_new_password_err']);
		if(!preg_match('/^[\w\W]{8,}+$/',$con_new_password)){
			$_SESSION['con_new_password_err'] = "Password must be atleast 8 character long";
			header('location:change_password.php');
			return;
		}else{
			$con_new_password = md5($con_new_password);
		}
	}
	if($old_password == $row['password']){
		if($new_password == $con_new_password){
			$sql= "UPDATE members SET password='$new_password' WHERE id = '$id'";
			$result = mysql_query($sql);
			if($result){
				unset($_SESSION['msg_insert']);
				$_SESSION['msg_insert'] = "Please login by your new password";
				header('location:login.php');
			}else{
				header('location:change_password.php');
			}
		}else{
			$status = "New password and confirm new password do not match";
		}
	}else{
		$status = "Old password do not match with login password";
	}
}else{
	// header('location:login.php');
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Change password of UMS</title>
        <meta name="description" content="This is a page of password change">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <section id="change-password">
        		<div class="container">
        			<h2>Change Password</h2>
        			<form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
						<ul>
						<?php if(isset($status)):?>
							<p class="notice"><?php echo $status;?></p>
						<?php endif; ?>
							<li>
							<?php if(isset($_SESSION['old_password_err'])):?>
								<p class="notice"><?php echo $_SESSION['old_password_err'];?></p>
							<?php endif;?>
								<label class="field-title" for="old_password">Old Password:</label>
								<input type="password" id="old_password" name="old_password">
							</li>
							<li>
							<?php if(isset($_SESSION['new_password_err'])):?>
								<p class="notice"><?php echo $_SESSION['new_password_err'];?></p>
							<?php endif;?>
								<label class="field-title" for="new_password">New Password:</label>
								<input type="password" id="new_password" name="new_password">
							</li>
							<li>
							<?php if(isset($_SESSION['con_new_password_err'])):?>
								<p class="notice"><?php echo $_SESSION['con_new_password_err'];?></p>
							<?php endif;?>
								<label class="field-title" for="con_new_password">Confirm New Password:</label>
								<input type="password" id="con_new_password" name="con_new_password">	
							</li>
							<li>
								<input class="btn btn-danger button" type="submit" id="submit" name="submit" value="Submit">
							</li>
						</ul>
        			</form>
        		</div>
        	</section>	
    </body>
</html>