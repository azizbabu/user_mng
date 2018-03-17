<?php

	$host = 'localhost'; 
	$user = 'root';
	$pass = '';

$con = mysql_connect($host,$user,$pass) or die('Could not not connect to database'. mysql_error($con));

mysql_select_db('user_mng',$con) or die ('Cound not select database' . mysql_error($con));