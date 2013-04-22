<?php 
include_once('includes/header.php');
if(isset($_POST['submit']) && $_POST['submit']!='')
{
	$fetch=mysql_query("select * from admin_info where admin_id='".$_SESSION['adminId']."'");
	$resfetch=mysql_fetch_array($fetch);
	$oldpass=$_POST['oldpassword'];
	if($oldpass==$resfetch['password'])
	{
		$newpassword = trim($_POST['newpassword']);
		$confirmpassword = trim($_POST['confirmpassword']);
		if($newpassword!='' && $newpassword==$confirmpassword)
		{
			$up=mysql_query("update admin_info set password='".$newpassword."' where admin_id='".$_SESSION['adminId']."'");
			$message="Password changed successfully.";
		}
		else
		{
			$message = "Password is empty or Password and Confirm Password doesn't match.";
		}
	}
	else
	{
		$message="You have insert wrong old password.";
	}
}
?>

<div class="breadcrumbs"><p>Change Password</p></div>
<div id="MainContent">
<div class="pagecontainer">
<div class="pageoverflow">
<div class="pageoptions">
<div class="errormessage"><?php echo $message; ?></div>
<div class="pageheader">Change Password</div></div>
<form name="invitationForm" id="invitationForm" action="" method="post" >
<div class="addConnection_rightbox table_data" style="margin-top:0px;">
<h2>Change Password</h2>
<table width="100%" cellpadding="5" cellspacing="5">
<tr>
	<td width="21%">Old Password</td>
    <td width="79%"><input type="password" value="" name="oldpassword" id="old" /></td>
</tr>
<tr>
	<td>New Password</td>
    <td><input type="password" value="" name="newpassword" id="newp" /></td>
</tr>
<tr>
	<td>Confirm Password</td>
    <td><input type="password" value="" name="confirmpassword" id="cnewp" /></td>
</tr>
<tr>
	<td></td>
    <td><input class="blue_button" name="submit" type="submit" value="Submit" onclick="return validation();" /></td>
</tr>
</table>
</div>
</form>
</div>
</div>

<?php include_once ('includes/footer.php'); ?>