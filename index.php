<?php
$lifetime=30*60;
session_set_cookie_params($lifetime);
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
if(!isset($_SESSION['login'])){
	header('location:login.php');
}

$id = $_SESSION['id'];

include 'db.php';

$sql = "SELECT * FROM members WHERE id = '$id'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$username = isset($row['username'])? $row['username']:$_SESSION['username'];
$pic = isset($row['pic'])? $row['pic']:$_SESSION['pic'];
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>User Management System</title>
        <meta name="description" content="This is home page of UMS">
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
        <nav id = "top-menu" class="navbar navbar-default" role="navigation">
        	<div class="container-fluid">
        		<!-- Brand and toggle get grouped for better mobile display -->
        		<div class="navbar-header">
        			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#ums">
        				<span class="sr-only">Toggle navigation</span>
        				<span class="icon-bar"></span>
        				<span class="icon-bar"></span>
        				<span class="icon-bar"></span>
        			</button>
        			<a class="navbar-brand" href="#"><img class= "logo" src="images/logo2.jpg" alt="logo"></a>
        		</div>
		
        		<!-- Collect the nav links, forms, and other content for toggling -->
        		<div class="collapse navbar-collapse" id="ums">
        			<!-- <ul class="nav navbar-nav">
        				<li class="active"><a href="index.php">Home</a></li>
        				<li><a href="#">Link</a></li>
        				<li class="dropdown">
        					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
        					<ul class="dropdown-menu" role="menu">
        						<li><a href="#">Action</a></li>
        						<li><a href="#">Another action</a></li>
        						<li><a href="#">Something else here</a></li>
        						<li class="divider"></li>
        						<li><a href="#">Separated link</a></li>
        						<li class="divider"></li>
        						<li><a href="#">One more separated link</a></li>
        					</ul>
        				</li>
        			</ul> -->
        			<form class="navbar-form navbar-left search" role="search">
        				<div class="form-group">
        					<input type="text" class="form-control" placeholder="Search">
        				</div>
        			</form>
        			<ul class="nav navbar-nav navbar-right">
        				<li><a class="active" href="index.php">Home</a></li>
        				<li><a href="users.php">Users</a></li>
        				<li><a href="profile.php" class="special"><img src="<?php echo $pic;?>" width = '20' height='20'><?php echo substr($username,0,5)?></a></li>
        				<li class="dropdown">
        					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span></a>
        					<?php
        						if($_SESSION['status']){
        							$status = "Deactivate";
        						}else{	
        							$status = "Activate";
        						}

        						if(isset($_GET['status'])){
        							$status = $_GET['status'];
        							if($status){
        								$status = "Deactivate";
        							}else{
        								$status = "Activate";
        							}
        						}  
        					?>

        					<script>
        						function confirmation(){
        							if(document.getElementById('status').innerHTML == 'Deactivate Account'){
        							var con = confirm('Are you sure to deactivate account');
	        							if(con){
	        								return true;
	        							}else{
	        								return false;
	        							}
        							}else{
        								var con2 = confirm('Are you sure to activate account');
        								if(con2){
	        								return true;
	        							}else{
	        								return false;
	        							}
        							}
        						}
        					</script>
        					
        					<ul class="dropdown-menu" role="menu">
        						<li><a href="update.php">Update Account</a></li>
        						<li><a id = "status" onclick = "return confirmation()" href="status.php?id=<?php echo $_SESSION['id']?>"><?php echo $status?> Account</a></li>
        						<li><a onclick = "return confirm('Are you sure to delete account?')" href="delete.php">Delete Account</a></li>
        						<li class="divider"></li>
        						<li><a href="logout.php">Logout</a></li>
        					</ul>
        				</li>
        			</ul>
        		</div><!-- /.navbar-collapse -->
        	</div><!-- /.container-fluid -->
        </nav><!-- /#top-menu -->

        <section id="main-content">
        	<div class="container">
        	<?php if($status == 'Deactivate'){?>

        		<h1>User Management System</h1>
        		<div class="row">
        			<div class="col-sm-4">
        				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem eligendi, aliquam hic nulla corporis odio a perferendis, deleniti sint suscipit magni tempore nobis, porro qui quis architecto, inventore ducimus iste possimus quibusdam ex voluptatem sapiente. Sit dicta ab pariatur asperiores harum corporis, eaque laudantium recusandae id ex fugiat nostrum, necessitatibus dolorem iusto rem qui voluptate! Optio, maiores saepe, doloribus minus hic vitae quae voluptatem qui distinctio quisquam ea recusandae. Ullam sint, deserunt eligendi reprehenderit a aperiam iste officiis quaerat, eius quod placeat, quasi vel. Quos libero, sed placeat odio doloremque expedita at deserunt aperiam eveniet, dolorum cum, quisquam, maiores vel.</p>
        			</div>
        			<div class="col-sm-4">
        				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos quibusdam aperiam facilis fuga id libero, amet aliquid accusantium optio nulla fugiat aspernatur maiores ad animi deleniti. Tempora commodi provident cupiditate saepe quas doloremque doloribus repellendus laudantium labore non, perspiciatis nihil. Non voluptate reprehenderit hic illum, soluta quibusdam cumque laudantium magni adipisci ratione! Neque dolorem unde provident doloribus ullam sint molestias corporis nihil ea, nesciunt ab laborum eum enim sequi ipsum excepturi ipsa cum. Odio dolorum commodi a quos fugit! Veniam ullam natus non cumque aliquam officia laudantium ut mollitia nihil dicta facere accusamus dolorum vero commodi recusandae eaque ipsum, numquam?</p>
        			</div>
        			<div class="col-sm-4">
        				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo, fugit, quam. Suscipit tenetur harum, provident, nihil error alias animi quis voluptatem modi. Perspiciatis voluptatum, est culpa maxime, quo vitae quasi animi quod laborum libero dolores, deleniti fugit quaerat! Laudantium, maxime distinctio est ducimus hic provident magni veritatis ullam amet earum, fugit pariatur tempore, enim labore fuga nemo perspiciatis at non commodi ipsa, quia culpa repellat. Expedita accusamus excepturi aliquam voluptatibus at non quis, eaque provident ut similique nam nihil earum error voluptate ullam, voluptatem facilis incidunt, delectus mollitia ad rerum nesciunt possimus. Hic sit praesentium, itaque laboriosam magnam rem aperiam.</p>
        			</div>
        		</div>
        	</div>
        </section><!-- #main-content -->

        <footer id="footer">
        	<p>&copy; 2014 All Rights Reserved, User Management System </p>
        </footer>
        <?php }else{ ?>
		<h2 class="warning">Your account is deactivated, please activate account first to see information</h2>
        <?php } ?>
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>