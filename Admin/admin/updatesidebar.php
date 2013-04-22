<?php 
error_reporting(E_ALL ^ E_NOTICE);
require_once('database.php');
include_once('functions.php');
$sidebarid=$_GET['sidebarid'];
$msg=$_GET['msg'];

if(isset($_POST['addsidebar']) && $_POST['addsidebar']!='') 
{
	$sidebar_title	=	escapechar($_POST['sidebar_title']);
	$sidebar_content=	escapechar($_POST['sidebar_content']);

	$error="";
	if($sidebar_title=='')
	{
		$error="Please insert sidebar title.";
	}

	if($error=='')
	{
		$in=" update sidebars set
		sidebar_title	=	'".$sidebar_title."',	
		sidebar_content	=	'".$sidebar_content."' where sidebarid='".$sidebarid."' ";
		mysql_query($in);
		$message="Sidebar updated successfully.";
		$class="message";
	}
	else
	{
		$message=$error;
	}	
}

$fetch=mysql_query("select * from sidebars where sidebarid='".$sidebarid."' ");
$result=mysql_fetch_array($fetch);

include_once('includes/header.php');
?>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<div class="breadcrumbs"><p>Sidebar</p></div>
<div id="MainContent">
<div class="pagecontainer">
<div class="pageoverflow">
<div class="pageoptions">
<div class="message"><?php echo $message; ?></div>
<div class="pageheader">Sidebar</div></div>
<div class="midcontent">
<form method="post" action="" id="userform">
<table width="80%" align="center" cellpadding="5" cellspacing="0">
<tr>
    <td width="200">Sidebar Name</td>
    <td><input type="text" name="sidebar_title" value="<?=$result['sidebar_title'];?>" class="textbox_size" /></td>
</tr>
<tr>
    <td valign="top">Sidebar description</td>
    <td>
        <textarea id="editor1" name="sidebar_content"><?php echo decode($result['sidebar_content']); ?></textarea>
        <script type="text/javascript">CKEDITOR.replace( 'editor1' );</script>
    </td>
</tr>
<tr><td>&nbsp;</td><td><input type="submit" name="addsidebar" value="Submit" /></td></tr>
</table>
</form>
</div>
</div>
</div>
<?php include_once ('includes/footer.php'); ?>