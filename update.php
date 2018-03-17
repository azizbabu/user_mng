<?php

session_start();

// $id = $_REQUEST['id'];
$id = $_SESSION['id'];

// if(!isset($id) || !isset($_SESSION['id']) || $_SESSION['id'] !== $id){
if(!isset($_SESSION['id'])){
    header('location:login.php');
}

include 'db.php';

$sql= "SELECT * FROM members WHERE id = '$id'";
$result = mysql_query($sql);
$row  = mysql_fetch_array($result);
$birth_day = explode('-',$row['birth_day']);
$day = $birth_day[0];
$month = $birth_day[1];
$year = $birth_day[2];

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Update Account</title>
        <meta name="description" content="This is user registration form">
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
        <section id="registration">
        	<div class="container">
        		<h2>User Ragitration Form</h2>
                <?php //if(isset($_SESSION['msg_failed'])):?>
                    <p class="notice"><?php// echo $_SESSION['msg_failed']; ?>
                <?php //endif;?>
                <form class= "form" action="update_success.php" name="form" method="post" enctype="multipart/form-data">
        			<ul> 
                        <li>
                            <?php if(isset($_SESSION['name_err'])): ?>
                            <?php // if(isset($_GET['name_err']) && $_GET['name_err'] == 1): ?>
                                <p class="notice"><?php echo $_SESSION['name_err'];?></p>
                            <?php endif;?>
        					<label class="field-title" for="name">Name:</label>
        					<input type="text" id="name" name="name" value = "<?php echo $row['name'];?>" placeholder ="Enter Your Name">
                            <span class="msg">Required</span>
        				</li>
        				<li>
                            <?php if(isset($_SESSION['father_name_err'])): ?>
                            <?php // if(isset($_GET['father_name_err']) && $_GET['father_name_err'] == 1): ?>
                                <p class="notice"><?php echo $_SESSION['father_name_err'];?></p>
                            <?php endif;?>
        					<label class="field-title" for="father_name">Father's Name:</label>
        					<input type="text" id="father_name" name="father_name" value = "<?php echo $row['father_name'];?>" placeholder ="Enter Your Father's Name">
                            <span class="msg">Required</span>
        				</li>
        				<li>
                            <?php if(isset($_SESSION['mother_name_err'])): ?>
                            <?php // if(isset($_GET['mother_name_err']) && $_GET['mother_name_err'] == 1): ?>
                                <p class="notice"><?php echo $_SESSION['mother_name_err'];?></p>
                            <?php endif;?>
        					<label class="field-title" for="mother_name">Mother's Name:</label>
        					<input type="text" id="mother_name" name="mother_name" value = "<?php echo $row['mother_name'];?>" placeholder ="Enter Your Mother's Name">
                            <span class="msg">Required</span>
        				</li>
        				<li class="address">
                        <p class="notice"></p>
        					<label class="field-title address-label" for="address">Address:</label>
        					<textarea name="address" id="address" cols="30" rows="10" placeholder ="Enter Your Address"><?php echo $row['address'];?></textarea>
                            <span class="msg address-label">Optional</span>
        				</li>
        				<li>
                            <p id = "emailError"></p>
                            <?php if(isset($_SESSION['email_err'])): ?>
                            <?php // if(isset($_GET['email_err']) && $_GET['email_err'] == 1): ?>
                                <p class="notice"><?php echo $_SESSION['email_err'];?></p>
                            <?php endif;?>
                            <?php if(isset($_GET['email_err']) && $_GET['email_err'] == 1): ?>
                                <?php unset($_SESSION['email_err']);?><p class="notice"><?php echo "Email already exists";?></p>
                            <?php endif;?>
        					<label class="field-title" for="email">Email:</label>
        					<input type="text" id="email" name="email" value = "<?php echo $row['email'];?>"  placeholder ="Enter Your Email Address">
                            <span class="msg">Required</span>
        				</li>
        				<li>
                        <?php if(isset($_SESSION['phone_err'])): ?>
                            <p class="notice"><?php echo $_SESSION['phone_err'];?></p>
                        <?php endif;?>
        					<label class="field-title" for="phone">Phone No:</label>
        					<input type="text" id="phone" name="phone" value = "<?php echo $row['phone'];?>" placeholder ="Enter Your Phone No">
                            <span class="msg">Optional</span>
        				</li>
        				<li>
                            <?php if(isset($_SESSION['day_err']) || isset($_SESSION['month_err']) || isset($_SESSION['year_err'])) : ?>
                                <p class="notice"><?php echo $_SESSION['day_err'] . ' ' . $_SESSION['month_err'] . ' ' . $_SESSION['year_err'];?></p>
                            <?php endif;?>
        					<label class="field-title" for="birth_day">Birth Day:</label>
        					<select name="day" id="day">
                                <option value="">Day:</option>
                                <?php 
                                    for($i=01;$i<=31;$i++){
                                        $selected = '';
                                        if($i==$day){
                                            $selected = 'selected';
                                        }
                                        echo "<option value=\"$i\" $selected>$i</option>";
                                    }
                                ?>
                            </select>
                            <select name="month" id="month">
                                <option value="">Month:</option>
                                <?php 
                                    for($i=01;$i<=12;$i++){
                                        $selected2 = '';
                                        if($i==$month){
                                            $selected2 = 'selected';
                                        }
                                        echo "<option value=\"$i\" $selected2>$i</option>";
                                    }
                                ?>
                            </select>
                            <select name="year" id="year">
                                <option value="">Year:</option>
                                <?php 
                                    for($i=2014;$i>=1900;$i--){
                                        $selected3 = '';
                                        if($i==$year){
                                            $selected3 = 'selected';
                                        }
                                        echo "<option value=\"$i\" $selected3>$i</option>";
                                    }
                                ?>
                            </select>
                            <span class="msg">Required</span>
        				</li>
        				<li>
                            <?php if(isset($_SESSION['sex_err'])): ?>
                                <p class="notice"><?php echo $_SESSION['sex_err'];?></p>
                            <?php endif;?>
        					<span class="field-title">Sex:</span>
        					<label for="msex">Male:</label>
                            <?php 
                                $checked=''; 
                                if($row['sex'] == 'Male'){
                                    $checked='checked';
                                }
                                $checked2=''; 
                                if($row['sex'] == 'Female'){
                                    $checked2='checked';
                                }
                            ?>
        					<input type="radio" id="msex" name="sex" value = "Male" <?php echo $checked?>>
        					<label for="fsex">Female:</label>
        					<input type="radio" id="fsex" name="sex" value="Female" <?php echo $checked2?>>
                            <span class="msg">Required</span>
        				</li>
        				<li>
                            <?php if(isset($_SESSION['marital_err'])): ?>
                                <p class="notice"><?php echo $_SESSION['marital_err'];?></p>
                            <?php endif;?>
        					<span class="field-title">Marital Status:</span>
                            <label for="single">Single:</label>
                            <?php
                                $checked3 = '';
                                if($row['marital_status'] == 'Single'){
                                    $checked3 = 'checked';
                                }
                                $checked4 = '';
                                if($row['marital_status'] == 'Married'){
                                    $checked4 = 'checked';
                                }
                            ?>
                            <input type="radio" id="single" name="marital_status" value = "Single" <?php echo $checked3; ?>>
                            <label for="married">Married:</label>
                            <input type="radio" id="married" value = "Married" name="marital_status" <?php echo $checked4; ?>>
                            <span class="msg">Required</span>
        				</li>
        				<li>
                            <?php if(isset($_SESSION['country_err'])): ?>
                                <p class="notice"><?php echo $_SESSION['country_err'];?></p>
                            <?php endif;?>
                            <label class="field-title" for="country">Country:</label>  
                            <select name="country" id="country">
                            <?php
                                $selected4 = '';
                                if($row['country'] == 'Bangladesh'){
                                    $selected4 = "selected='selected'";
                                }
                                $selected5 = '';
                                if($row['country'] == 'India'){
                                    $selected5 = "selected='selected'";
                                }
                                $selected6 = '';
                                if($row['country'] == 'Pakistan'){
                                    $selected6 = "selected='selected'";
                                }
                                $selected7 = '';
                                if($row['country'] == 'Srilanka'){
                                    $selected7 = "selected='selected'";
                                }
                                $selected8 = '';
                                if($row['country'] == 'Nepal'){
                                    $selected8 = "selected='selected'";
                                }
                                $selected9 = '';
                                if($row['country'] == 'Vutan'){
                                    $selected9 = "selected='selected'";
                                }
                                $selected10 = '';
                                if($row['country'] == 'Afganistan'){
                                    $selected10 = "selected='selected'";
                                }
                            ?>
                                <option value="">(Select your Country)</option>
                                <option value="Bangladesh" <?php echo $selected4;?>>Bangladesh</option>
                                <option value="India" <?php echo $selected5;?>>India</option>
                                <option value="Pakistan" <?php echo $selected6;?>>Pakistan</option>
                                <option value="Srilanka" <?php echo $selected7;?>>Srilanka</option>
                                <option value="Nepal" <?php echo $selected8;?>>Nepal</option>
                                <option value="Vutan" <?php echo $selected9;?>>Vutan</option>
                                <option value="Afganistan" <?php echo $selected10;?>>Afganistan</option>
                            </select>
                            <span class="msg">Required</span>  
                        </li>
                        <li>
                            <?php if(isset($_SESSION['pic_err'])): ?>
                                <p class="notice"><?php echo $_SESSION['pic_err'];?></p>
                            <?php endif;?>
                            <label class="field-title" for="pic">Upload Image:</label>
                            <input type="file" id="pic" name="pic">
                            <span class="msg">Optional</span>
                            <img src="<?php echo $row['pic'];?>" width = '50' height = '50'>            
                        </li>
        				<li>
                            <?php if(isset($_SESSION['username_err'])): ?>
                                <p class="notice"><?php echo $_SESSION['username_err'];?></p>
                            <?php endif;?>
                            <label class="field-title" for="username">Username:</label>
                            <input type="text" id="username" name="username" value="<?php echo $row['username']?>">
                            <span class="msg">Required</span>            
                        </li>
        				<!-- <li>
                            <?php //if(isset($_SESSION['password_err'])): ?>
                                <p class="notice"><?php //echo $_SESSION['password_err'];?></p>
                            <?php// endif;?>
                            <label class="field-title" for="password">Password:</label>
                            <input type="password" id="password" name="password" autocomplete = "off">
                            <span class="msg">Required</span>            
                        </li> -->
                        <li><input class= "btn btn-info button" type="submit" name="submit" value="Update"></li>
                        <input type="hidden" name="old_email" value="<?php echo $row['email'];?>">
                        <input type="hidden" name="old_username" value="<?php echo $row['username'];?>">
                        <input type="hidden" name="status" value="<?php echo $row['status'];?>">
                        <input type="hidden" name="pic" value="<?php echo $row['pic'];?>">
                        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
        			</ul>
                </form>
        	</div>
        </section>
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>