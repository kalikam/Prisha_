<?php

error_reporting(E_ALL ^ E_NOTICE);

require_once('database.php');

require_once('functions.php');

@session_start();

if(!isset($_SESSION['adminId']))

{

	header("location:index.php");

}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title>Administrative Control Panel</title>

<link rel="stylesheet" type="text/css" href="css/style.css">

<script type="text/javascript" language="javascript" src="js/jquery-latest.js"></script>

<script type="text/javascript" language="javascript" src="js/jquery.validate.js"></script>

</head>

<body>

<div id="ncleangrey-container">

<div id="logocontainer">

	<h1>Administrative control panel</h1>

</div>

<div class="topmenucontainer">

	<ul id="nav">

	<li><a href="home.php">Home</a></li>

	<li><a href="productlist.php">Products</a></li>

	<li><a href="newslist.php">News</a></li>

	<li><a href="setting.php">Setting</a></li>

	<li><a href="changepassword.php">Change Password</a></li>

	<li><a href="logout.php">Logout</a></li>

	</ul>

	<div class="clearb"></div>

</div>