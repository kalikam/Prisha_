<?php 
//error_reporting(E_ALL ^ E_NOTICE);
require_once('database.php');

include_once('functions.php');

include_once('includes/header.php');

if(isset($_POST['update']))
{ 
   $Adline1=$_POST['Ad_line1'];
  
   $Adline2=$_POST['Ad_line2'];
  
   $Adline3=$_POST['Ad_line3'];
  
   $contact=$_POST['contact'];
  
   $mobile= $_POST['mobile'];

$query=mysql_query("update contact set Ad_line1='$Adline1', Ad_line2='$Adline2', Ad_line3='$Adline3' , contact='$contact' , mobile = '$mobile' where id='1' ");


$message="update Successfully";

}

$res=mysql_query("select *from contact");

$row=mysql_fetch_row($res);

?>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<div class="breadcrumbs"><p>Page</p></div>

<div id="MainContent">

<div class="pagecontainer">

<div class="pageoverflow">

<div class="pageoptions">

<div class="message"><?php echo $message; ?></div>

<div class="pageheader">Company-Profile</div></div>

<div class="midcontent">

<form method="post" action="" id="userform" enctype="multipart/form-data">

<table width="80%" align="center" cellpadding="5" cellspacing="0">
<tr>

    <td width="200">Address-Line-1</td>

    <td><input type="text" name="Ad_line1"  value="<? if(isset($row[1])) echo $row[1]; ?>" class="textbox_size" /></td>

</tr>

<tr>

    <td width="200">Address-Line-2</td>

    <td><input type="text" name="Ad_line2" value="<? if(isset($row[2])) echo $row[2]; ?>" class="textbox_size" /></td>

</tr>

<tr>

    <td>Address-Line3</td>

    <td><input type="text" name="Ad_line3" value="<? if(isset($row[3])) echo $row[3];?>" class="textbox_size" /></td>

</tr>
<tr>

    <td>Contact</td>

    <td><input type="text" name="contact" value="<? if(isset($row[4])) echo $row[4];?>" class="textbox_size" />    </td>

</tr>
    <td>Mobile</td>

    <td>
            <input type="text" name="mobile" value="<? if(isset($row[5])) echo $row[5];?>" class="textbox_size" />
    </td>

</tr>
</table>

<table width="80%" align="center" cellpadding="5" cellspacing="0">


<tr><td>&nbsp;</td><td><input type="submit" name="update" value="update" /></td></tr>

</table>

</form>

</div>

</div>

</div>

<?php include_once ('includes/footer.php'); ?>
