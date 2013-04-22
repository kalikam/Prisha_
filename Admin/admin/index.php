<?php
error_reporting(E_ALL ^ E_NOTICE);
$error=$_GET['err'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
<title>Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" media="screen, projection" href="css/loginstyle.css">
</head>
<body>
<div class="login-fields">
<?php if(isset($error) && $error==1) { ?>
<div class="error">Your emailid and password does not matches.</div>
<?php } ?>
<form name="adminLoginForm" id="adminLoginForm" action="loginVerify.php" method="post">
<table width="100%" cellpadding="5" cellspacing="5">
<tr>
	<td class="caption-field" align="right">Username:</td>
	<td><input id="lbusername" class="form_fields" name="username" type="text"></td>
</tr>
<tr>
	<td class="caption-field" align="right">Password:</td>
	<td><input id="lbpassword" class="form_fields" name="adminPassword" type="password"></td>
</tr>
<tr>
	<td></td>
	<td><input class="loginsubmit" name="loginsubmit" value="Submit" type="submit"></td>
</tr>
</table>
 </form>
</div>
</body>
</html>