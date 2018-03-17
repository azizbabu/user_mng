<?php
session_start();
$id = $_SESSION['id'];
if(!isset($_SESSION['id'])){
    header('location:login.php');
}

include 'db.php';

$sql= "SELECT * FROM members WHERE id = '$id'";
$result = mysql_query($sql);
$row  = mysql_fetch_array($result);
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Profile of User in UMS</title>
        <meta name="description" content="This is profile of user in user management system">
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
        <section id="profile">
         	<div class="container">
         		<h1>User Management System</h1>
         		<p class="profile"><img src="<?php echo $row['pic'];?>" alt="profile pic" width="150" height="150"><span class="profile-user"><?php echo $row['name']?></span></p>
         		<h2 class="profile-title">All information of <?php echo $row['name']?></h2>
         		<div class="table-responsive">
	         		<table class="table table-striped">
	         			<tr>
	         				<th>Name:</th>
	         				<td><?php echo $row['name'];?></td>
	         			</tr>
	         			<tr>
	         				<th>Father's Name:</th>
	         				<td><?php echo $row['father_name'];?></td>
	         			</tr>
	         			<tr>
	         				<th>Mother's Name</th>
	         				<td><?php echo $row['mother_name'];?></td>
	         			</tr>
	         			<tr>
	         				<th>Address</th>
	         				<td><?php echo $row['address'];?></td>
	         			</tr>
	         			<tr>
	         				<th>Email</th>
	         				<td><?php echo $row['email'];?></td>
	         			</tr>
	         			<tr>
	         				<th>Phone No:</th>
	         				<td><?php echo $row['phone'];?></td>
	         			</tr>
	         			<tr>
	         				<th>Biorth Day:</th>
	         				<td><?php echo $row['birth_day'];?></td>
	         			</tr>
	         			<tr>
	         				<th>Sex:</th>
	         				<td><?php echo $row['sex'];?></td>
	         			</tr>
	         			<tr>
	         				<th>Marital Status:</th>
	         				<td><?php echo $row['marital_status'];?></td>
	         			</tr>
	         			<tr>
	         				<th>Country:</th>
	         				<td><?php echo $row['country'];?></td>
	         			</tr>
	         			<tr>
	         				<th>Username:</th>
	         				<td><?php echo $row['username'];?></td>
	         			</tr>
	         			<tr>
	         				<th>Account Status:</th>
	         				<?php 
	         				$status = "Active";
	         				if($row['status'] == 0){
	         					$status = "Deactive";
	         				}
	         				?>
	         				<td><?php echo $status;?></td>
	         			</tr>
	         		</table><!--/.table/table-strped-->
         		</div><!--/.table-responsive-->

         		<a href="update.php" class="btn btn-primary button">Update Profile Information</a>
         		<a href="change_password.php" class="btn btn-danger button">Change Password</a>
         	</div>
         </section> 
    </body>
</html>