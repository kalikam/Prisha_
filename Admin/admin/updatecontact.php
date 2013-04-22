<?php 
//error_reporting(E_ALL ^ E_NOTICE);
require_once('database.php');

include_once('functions.php');

include_once('includes/header.php');

if(isset($_POST['update']))
{ 
   $owner=$_POST['owner'];
  
   $year=$_POST['year'];
  
   $type=$_POST['type'];
  
   $employee=$_POST['employee'];
  
   $sales= $_POST['sales'];
   
   $market_cover= $_POST['market_cover'];

$query=mysql_query("update company_info set owner='$owner', year='$year', type='$type' , employee='$employee' , sales = '$sales', market_cover='$market_cover' where owner='$owner' ");


$message="update Successfully";

}

$res=mysql_query("select *from company_info");

$row=mysql_fetch_row($res);

?>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<div class="breadcrumbs"><p>Page</p></div>

<div id="MainContent">

<div class="pagecontainer">

<div class="pageoverflow">

<div class="pageoptions">

<div class="message"><?php echo $message; ?></div>

<div class="pageheader">Contact-Details</div></div>

<div class="midcontent">

<form method="post" action="" id="userform" enctype="multipart/form-data">

<table width="80%" align="center" cellpadding="5" cellspacing="0">
<tr>

    <td width="200">Company Owner</td>

    <td><input type="text" name="owner"  value="<? if(isset($row[0])) echo $row[0]; ?>" class="textbox_size" /></td>

</tr>

<tr>

    <td width="200">Establishment Year</td>

    <td><input type="text" name="year" value="<? if(isset($row[1])) echo $row[1]; ?>" class="textbox_size" /></td>

</tr>

<tr>

    <td>Business Type</td>

    <td><input type="text" name="type" value="<? if(isset($row[2])) echo $row[2];?>" class="textbox_size" /></td>

</tr>
<tr>

    <td>No. Of Employee</td>

    <td><input type="text" name="employee" value="<? if(isset($row[3])) echo $row[3];?>" class="textbox_size" />    </td>

</tr>
<tr>
    <td>Annual Sales</td>

    <td>
            <input type="text" name="sales" value="<? if(isset($row[4])) echo $row[4];?>" class="textbox_size" />
    </td>

</tr>
<tr>
    <td>Market Cover</td>

    <td>
            <input type="text" name="market_cover" value="<? if(isset($row[5])) echo $row[5];?>" class="textbox_size" />
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
