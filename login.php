<?php
$lifetime=30*60;
session_set_cookie_params($lifetime); // Set the session cookie parameters. The effect of this function only lasts for the duration of the script.
// void session_set_cookie_params ( int $lifetime [, string $path [, string $domain [, bool $secure = false [, bool $httponly = false ]]]] )
ini_set('session.cookie_httponly', 1);
// $currentCookieParams = session_get_cookie_params();
// $sidvalue = session_id();  
session_start();
 
 
// setcookie(  
//     'PHPSESSID',//name  
//     $sidvalue,//value  
//     $lifetime,//expires at end of session  
//     $currentCookieParams['path'],//path  
//     $currentCookieParams['domain'],//domain  
//     true //secure  
// );  

/***********************************************************************************************/
/* Check wheather username and password match with database */
/***********************************************************************************************/
if(isset($_POST['submit'])){
	$identity = $_POST['identity'];
	$password = md5($_POST['password']);

	include 'db.php';

	$sql = "SELECT * FROM members WHERE email='$identity' OR username='$identity' AND password='$password'";
	$result = mysql_query($sql);
	if($obj = mysql_fetch_object($result)){
		$_SESSION['id'] = $obj->id;
		$_SESSION['role'] = $obj->role;
		if($_SESSION['role'] == '1'){
			$_SESSION['admin'] = true;
		}
		$_SESSION['username'] = $obj->username;
		$_SESSION['pic'] = $obj->pic;
		$_SESSION['status'] = $obj->status;
		$_SESSION['login'] = true;
		header('location:index.php');
	}else{
		$status = "Please use valid Email/Username and Password";
	}
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
        <title>Login Form of UMS</title>
        <meta name="description" content="This is login page of user management system">
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
		<div class="container">
			<?php if(isset($_SESSION['msg_insert'])):?>
				<p class="message"><?php echo $_SESSION['msg_insert']; ?>
			<?php endif;?>
			<h2>Login Form</h2>
			<form class= "form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
			<p class="direction">Please login with your email/username and password below.</p>
				<ul>
					<?php if(isset($status)):?>
						<p class="notice"><?php echo $status;?></p>
					<?php endif;?>
					<li>
						<label class="field-title"  for="identity">Email/Username:</label>
						<input type="text" id="identity" name="identity">
					</li>
					<li>
						<label class="field-title"  for="password">Password:</label>
						<input type="password" id="password" name="password">						
					</li>
					<p class="forgot-password"><a href="forgot_password.php">Forgot Password?</a></p>
					<li>
						<input type="submit" class = "btn btn-primary button" id="submit" name="submit" value="Login">
					</li>
					<p class="direction">If you new to this system sing up please</p>
					<a href="register.php" class="btn btn-danger button">Sign Up</a>
				</ul>	
			</form>
		</div>
    </body>
</html>



<!-- VirtualRouter.codeplex.com -->