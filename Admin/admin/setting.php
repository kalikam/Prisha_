<?php 
include_once('includes/header.php');
if(isset($_POST['submit']) && $_POST['submit']!='')
{
	$newemailid 		= 	trim($_POST['newemailid']);
	$confirmemailid 	= 	trim($_POST['confirmemailid']);
	
	if($newemailid!='' && $newemailid==$confirmemailid)
	{
		$up=mysql_query("update admin_info set email='".$newemailid."' where admin_id='".$_SESSION['adminId']."'");
		$message="Emailid changed successfully.";
		$class=' class="message"';
	}
	else
	{
		$message = "Email is empty or New Email and Confirm Email doesn't match.";
		$class=' class="errormessage"';
	}
}

$fetch=mysql_query("select * from admin_info where admin_id='".$_SESSION['adminId']."'");
$result=mysql_fetch_array($fetch);
?>

<div class="breadcrumbs"><p>Change Setting</p></div>
<div id="MainContent">
<div class="pagecontainer">
<div class="pageoverflow">
<div class="pageoptions">
<div <?=$class?>><?php echo $message; ?></div>
<div class="pageheader">Change Setting : This emailid is used for admin login.</div></div>
<form name="invitationForm" id="invitationForm" action="" method="post" >
<div class="addConnection_rightbox table_data" style="margin-top:0px;">
<h2>Setting</h2>
<table width="100%" cellpadding="5" cellspacing="5">
<tr>
	<td>Previous Emailid</td>
    <td><?php echo $result['email']; ?></td>
</tr>
<tr>
	<td width="21%">New Emailid</td>
    <td width="79%"><input type="text" value="<?=$_POST['newemailid']?>" name="newemailid" /></td>
</tr>
<tr>
	<td width="21%">Confirm Emailid</td>
    <td width="79%"><input type="text" value="<?=$_POST['confirmemailid']?>" name="confirmemailid" /></td>
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