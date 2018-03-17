<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>User Regitration Form</title>
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
            <?php session_start(); 
                // if(isset($_SESSION['delete_msg'])):
                if(isset($_GET['delete_msg']) && $_GET['delete_msg'] == 1):?>
                   <p class="message"><?php echo "Your account is deleted, please register again";
                   endif;  
             ?>

        		<h2>User Ragitration Form</h2>
                <?php //if(isset($_SESSION['msg_failed'])):?>
                    <p class="notice"><?php// echo $_SESSION['msg_failed']; ?>
                <?php //endif;?>
                <form class= "form" action="user_insert.php" name="form" method="post" enctype="multipart/form-data">
        			<ul> 
                        <li>
                            <?php if(isset($_SESSION['name_err'])): ?>
                            <?php // if(isset($_GET['name_err']) && $_GET['name_err'] == 1): ?>
                                <p class="notice"><?php echo $_SESSION['name_err'];?></p>
                            <?php endif;?>
        					<label class="field-title" for="name">Name:</label>
        					<input type="text" id="name" name="name" placeholder ="Enter Your Name">
                            <span class="msg">Required</span>
        				</li>
        				<li>
                            <?php if(isset($_SESSION['father_name_err'])): ?>
                            <?php // if(isset($_GET['father_name_err']) && $_GET['father_name_err'] == 1): ?>
                                <p class="notice"><?php echo $_SESSION['father_name_err'];?></p>
                            <?php endif;?>
        					<label class="field-title" for="father_name">Father's Name:</label>
        					<input type="text" id="father_name" name="father_name" placeholder ="Enter Your Father's Name">
                            <span class="msg">Required</span>
        				</li>
        				<li>
                            <?php if(isset($_SESSION['mother_name_err'])): ?>
                            <?php // if(isset($_GET['mother_name_err']) && $_GET['mother_name_err'] == 1): ?>
                                <p class="notice"><?php echo $_SESSION['mother_name_err'];?></p>
                            <?php endif;?>
        					<label class="field-title" for="mother_name">Mother's Name:</label>
        					<input type="text" id="mother_name" name="mother_name" placeholder ="Enter Your Mother's Name">
                            <span class="msg">Required</span>
        				</li>
        				<li class="address">
                        <p class="notice"></p>
        					<label class="field-title address-label" for="address">Address:</label>
        					<textarea name="address" id="address" cols="30" rows="10" placeholder ="Enter Your Address"></textarea>
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
        					<input type="text" id="email" name="email" placeholder ="Enter Your Email Address">
                            <span class="msg">Required</span>
        				</li>
        				<li>
                        <?php if(isset($_SESSION['phone_err'])): ?>
                            <p class="notice"><?php echo $_SESSION['phone_err'];?></p>
                        <?php endif;?>
        					<label class="field-title" for="phone">Phone No:</label>
        					<input type="text" id="phone" name="phone" placeholder ="Enter Your Phone No">
                            <span class="msg">Optional</span>
        				</li>
        				<li>
                            <?php // if(isset($_SESSION['day_err']) || isset($_SESSION['month_err']) || isset($_SESSION['year_err'])) : 
                                $day_err = '';
                                if(isset($_SESSION['day_err'])){
                                  $day_err = $_SESSION['day_err'];  
                                }
                                $month_err = '';
                                if(isset($_SESSION['month_err'])){
                                   $month_err = $_SESSION['month_err'];
                                }
                                $year_err = '';
                                if(isset($_SESSION['year_err'])){
                                    $year_err = $_SESSION['year_err'];
                                }
                                ?>

                                <!-- <p class="notice"><?php // echo $_SESSION['day_err'] . ' ' . $_SESSION['month_err'] . ' ' . $_SESSION['year_err'];?></p> -->
                                <p class="notice"><?php echo $day_err . ' ' . $month_err . ' ' . $year_err;?></p>
                            <?php //endif;?>
        					<label class="field-title" for="birth_day">Birth Day:</label>
        					<select name="day" id="day">
                                <option value="" selected="selected">Day:</option>
                                <?php 
                                    for($i=01;$i<=31;$i++){
                                        echo "<option value=\"$i\">$i</option>";
                                    }
                                ?>
                            </select>
                            <select name="month" id="month">
                                <option value="" selected="selected">Month:</option>
                                <?php 
                                    for($i=01;$i<=12;$i++){
                                        echo "<option value=\"$i\">$i</option>";
                                    }
                                ?>
                            </select>
                            <select name="year" id="year">
                                <option value="" selected="selected">Year:</option>
                                <?php 
                                    for($i=2014;$i>=1900;$i--){
                                        echo "<option value=\"$i\">$i</option>";
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
        					<input type="radio" id="msex" name="sex" value = "Male" checked="checked">
        					<label for="fsex">Female:</label>
        					<input type="radio" id="fsex" name="sex" value="Female">
                            <span class="msg">Required</span>
        				</li>
        				<li>
                            <?php if(isset($_SESSION['marital_err'])): ?>
                                <p class="notice"><?php echo $_SESSION['marital_err'];?></p>
                            <?php endif;?>
        					<span class="field-title">Marital Status:</span>
                            <label for="single">Single:</label>
                            <input type="radio" id="single" name="marital_status" value = "Single" checked="checked">
                            <label for="married">Married:</label>
                            <input type="radio" id="married" value = "Married" name="marital_status">
                            <span class="msg">Required</span>
        				</li>
        				<li>
                            <?php if(isset($_SESSION['country_err'])): ?>
                                <p class="notice"><?php echo $_SESSION['country_err'];?></p>
                            <?php endif;?>
                            <label class="field-title" for="country">Country:</label>  
                            <select name="country" id="country">
                                <option value="" selected="selected">(Select your Country)</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="India">India</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Srilanka">Srilanka</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Vutan">Vutan</option>
                                <option value="Afganistan">Afganistan</option>
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
                        </li>
        				<li>
                            <?php if(isset($_SESSION['username_err'])): ?>
                                <p class="notice"><?php echo $_SESSION['username_err'];?></p>
                            <?php endif;?>
                            <label class="field-title" for="username">Username:</label>
                            <input type="text" id="username" name="username">
                            <span class="msg">Required</span>            
                        </li>
        				<li>
                            <?php if(isset($_SESSION['password_err'])): ?>
                                <p class="notice"><?php echo $_SESSION['password_err'];?></p>
                            <?php endif;?>
                            <label class="field-title" for="password">Password:</label>
                            <input type="password" id="password" name="password" autocomplete = "off">
                            <span class="msg">Required</span> 
                            <div class="note"><small class="text-success">*[Passord must be 8 characters long]</small></div>               
                        </li>
                        <li><input class= "btn btn-info button" type="submit" name="submit" value="Register"></li>
        			</ul>
                </form>
        	</div>
        </section>
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>

