<?php session_start();?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>All Users of UMS</title>
        <meta name="description" content="All users of UMS">
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
        <section id="main-content">
        	<div class="container">
        		<h1>User Management System</h1>
        		<table border='1'>
        			<tr>
        				<th>Sr No</th>
        				<th>Name:</th>
        				<th>Father's Name</th>
        				<th>Mother's Name</th>
        				<th>Address</th>
        				<th>Email</th>
        				<th>Phone</th>
        				<th>Birth Day</th>
        				<th>Sex</th>
        				<th>Marital Status</th>
        				<th>Country</th>
        				<th>Image</th>
        				<?php if(isset($_SESSION['login'])):?>
        					<th>Update</th>
        				<?php endif; ?>
        				<?php if(isset($_SESSION['admin'])){?>
        					<th>Delete</th>
        				<?php } ?>
        			</tr>
					<?php

						include 'db.php';

						$sql = "SELECT * FROM members";
						$result = mysql_query($sql);
						$i=1;
						while($rows = mysql_fetch_array($result)){
							$background_color = 'white';
							if($rows['id'] == $_SESSION['id']){
								$background_color = 'red';
							}
						?>
						<tr style = "background-color:<?php echo $background_color;?>">
							<td><?php echo $i++;?></td>
							<td><?php echo $rows['name'];?></td>
							<td><?php echo $rows['father_name'];?></td>
							<td><?php echo $rows['mother_name'];?></td>
							<td><?php echo $rows['address'];?></td>
							<td><?php echo $rows['email'];?></td>
							<td><?php echo $rows['phone'];?></td>
							<td><?php echo $rows['birth_day'];?></td>
							<td><?php echo $rows['sex'];?></td>
							<td><?php echo $rows['marital_status'];?></td>
							<td><?php echo $rows['country'];?></td>
							<td><img src= "<?php echo $rows['pic'];?>" alt="pic" width='25' height='25'></td>
							
							<td>
							<?php if(isset($_SESSION['id'])):?>
								<?php if($rows['id'] == $_SESSION['id']):?>
									<form action="update.php" method="post">
										<input type="hidden" name="id" value="<?php echo $rows['id']?>">
										<input type="submit" id="submit" name="submit" value="Update">
									</form>
								<?php endif; ?>
							<?php endif;?>
							</td>
							
							<?php if(isset($_SESSION['admin'])){?>
							<td>
								<form action="delete.php" method="post">
									<input type="hidden" name="id" value="<?php echo $rows['id']?>">
									<input type="submit" onclick = "return confirm('Are you sure to delete account?')" id="submit" name="submit" value="Delete">
								</form>
							</td>
							<?php } ?>
						</tr>
						<?php } ?>
        		</table>
        	</div>
        </section>
    </body>
    
</html>
