<?php
//add in your connection to the database here, mine is just a require_once statement
//get the passed parameter

include 'db.php';

$email = mysql_real_escape_string(strtolower($_POST["email"]));
 
//send a request to the database
$sql = "SELECT email FROM TABLE_NAME WHERE LOWER(email) = '" . $email . "'";
$result = mysql_query($sql, $conn) or die("Could not get email: " . mysql_error());
 
if(mysql_num_rows($result) > 0) {
    //email is already taken
    echo 0;
}
else {
    //email is available
    echo 1;
}