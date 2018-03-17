<?php

include 'db.php';

if(isset($_GET['id']))
{
$status=$_GET['id'];
$select_status=mysql_query("SELECT * FROM members WHERE id='$status'");
while($row=mysql_fetch_object($select_status))
{
$st=$row->status;
echo $row->name;
if($st=='0')
{
$status2=1;
unset($_SESSION['status']);
$_SESSION['status'] = $status2; 
}
else
{
$status2=0;
unset($_SESSION['status']);
$_SESSION['status'] = $status2;
}

$update=mysql_query("UPDATE members SET status='$status2' where id='$status' ");
if($update)
{
header("Location:index.php?status=$status2");
}
else
{
echo mysql_error();
}
}
}
