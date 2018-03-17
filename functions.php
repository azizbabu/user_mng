<?php

/***********************************************************************************************/
/* Input field validation */
/***********************************************************************************************/

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

/***********************************************************************************************/
/* Check wheather field is empty */
/***********************************************************************************************/

function is_empty($field,$field_name){
	if(empty($field)){
		$msg = "$field_name should not be empty";
	}else{
		$msg = '';
	}

	return $msg;
}

/***********************************************************************************************/
/* Check wheather the file is valid */
/***********************************************************************************************/

function valid_file($pic){

	$msg = '';
	
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $pic["name"]);
	$extension = end($temp);

	if ((($pic["type"] == "image/gif")
		|| ($pic["type"] == "image/jpeg")
		|| ($pic["type"] == "image/jpg")
		|| ($pic["type"] == "image/pjpeg")
		|| ($pic["type"] == "image/x-png")
		|| ($pic["type"] == "image/png"))
		&& ($pic["size"] < 300000)
		&& ($pic["error"] == 0)
		&& in_array($extension, $allowedExts)) {
		$msg = "Valid file";
	} 

	return $msg;
}

/***********************************************************************************************/
/* Name validation */
/***********************************************************************************************/

function valid_name($name){
	
	$msg = '';

	if(preg_match("/^[a-zA-Z\.\- ]*$/",$name)){
		$msg = "Name is valid"; 
	}

	return $msg;
}

/***********************************************************************************************/
/* Email validation */
/***********************************************************************************************/

function valid_email($email){

	$msg = '';

	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $msg = "Valid email format";
     }

     return $msg;
}

