<?php
session_start();

/***********************************************************************************************/
/* Check wheather username and password match with database */
/***********************************************************************************************/
if(isset($_POST['submit'])){
	$identity = $_POST['identity'];

	include 'db.php';

	$sql = "SELECT * FROM members WHERE email='$identity' OR username='$identity'";
	$result = mysql_query($sql);
	if($obj = mysql_fetch_object($result)){
		$_SESSION['id'] = $obj->id;
		$_SESSION['email'] = $obj->email;
		header('location:doforgot_password.php');
	}else{
		$status = "Email or Username is not found in database";
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
        <meta name="description" content="This is forgot password page of user management system">
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
			<h2>Find Your Account</h2>
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
						<input type="submit" class = "btn btn-primary button" id="submit" name="submit" value="Search">
					</li>
				</ul>	
			</form>
		</div>
    </body>
</html>



<!-- VirtualRouter.codeplex.com -->