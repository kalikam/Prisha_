<?php
require_once('database.php');
$username = $_POST['username'];
$password = $_POST['adminPassword'];

$sql="select * from admin_info where username='".$username."' and password='".$password."'"; 
$rs=mysql_query($sql);
if(mysql_num_rows($rs)==1)
{
	@session_start();
	$row = mysql_fetch_object($rs);
	$_SESSION['adminId'] = $row->admin_id;
	$_SESSION['adminFirst'] = $row->first_name;
	$_SESSION['adminLast'] = $row->last_name;
	$_SESSION['email'] = $row->email;
	$url="home.php";
}
else
{
	$url="index.php?err=1";
}
header("location:".$url);       
?>