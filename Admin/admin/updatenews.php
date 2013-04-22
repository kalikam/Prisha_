<?php 
error_reporting(E_ALL ^ E_NOTICE);
require_once('database.php');
include_once('functions.php');
$news_id=$_REQUEST['news_id'];
if(isset($_POST['editnews']) && $_POST['editnews']!='') 
{	$news_title				=	escapechar($_POST['news_title']);
	
	$news_title			=	escapechar($_POST['news_title']);
	
	$news_date = $_POST['date3'];
	
	$news_state = $_POST['news_state'];

	$news_content			=	escapechar($_POST['news_content']);
	
	$error="";
	if($news_title=='')
    {
		$error="Please insert news title.";
	}
	if($error=='')
    {
	$in=" update news_master set	news_title='".$news_title."',	
 			news_date 			=	'".$news_date."',	

			news_content 			=	'".$news_content."',
			
			news_date               =  '".$news_date."',


			news_status  			=	'".$news_state."' where  news_id='".$_GET['news_id']."'  ";

			$res=mysql_query($in);
			if($res>0)
			$message="News edited successfully.";

		}

   else

	{

		$message=$error;

	}	

}



if(isset($_GET['news_id']) && $_GET['news_id']!='')

{

	$fetch=mysql_query("select * from  news_master where news_id='".$_GET['news_id']."' ");

	$fetchdata=mysql_fetch_array($fetch);

}





include_once('includes/header.php');

?>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<div class="breadcrumbs"><p>News</p></div>

<div id="MainContent">

<div class="pagecontainer">

<div class="pageoverflow">

<div class="pageoptions">

<div class="message"><?php echo $message; ?></div>

<div class="pageheader">News</div></div>

<div class="midcontent">


<form method="post" action="" id="userform" enctype="multipart/form-data">

<table width="80%" align="center" cellpadding="5" cellspacing="0">
<tr>

    <td width="200">News Id</td>

    <td><input type="text"  value="<?  echo $fetchdata[0];?> " class="textbox_size" name="news_id" /></td>

</tr>

<tr>

    <td width="200">News Title</td>

    <td> <input type="text" name="news_title" class="textbox_size" value="<? echo $fetchdata[1] ?>" /></td>

</tr>

<tr>

    <td>News State</td>
<? if($fetchdata[5]==1)
{?>
    <td>
            <input type="radio" class="radio_hide" name="news_state" value="1" checked="checked" />Publish

            <input type="radio" class="radio_hide" name="news_state" value="0" />Unpublished
    </td>
<? }
else 
{
?>
        <input type="radio" class="radio_hide" name="news_state" value="1"  />Publish

            <input type="radio" class="radio_hide" name="news_state" value="0" checked="checked" />Unpublished
    </td>
<? }
?>
</tr>
</table>

<table width="80%" align="center" cellpadding="5" cellspacing="0">

<tr>

    <td width="200" valign="top">News Date </td>

    <td><?php
//$mydate = isset($_POST["date1"]) ? $_POST["date1"] : "";
include('calendar/tc_calendar.php');
$myCalendar = new tc_calendar("date3", true, false);
$myCalendar->setIcon("calendar/images/iconCalendar.gif");
$myCalendar->setDate(date('d'), date('m'), date('Y'));
$myCalendar->setPath("calendar/");
$myCalendar->setYearInterval(1945, date('Y'));
$myCalendar->setAlignment('left', 'bottom');
//$myCalendar->autoSubmit(true, "form1");
$myCalendar->writeScript();
?></td>

</tr>
<tr>

    <td width="200" valign="top">News Attachment </td>

    <td><input type="file" name="f1" /></td>

</tr>

<tr>

    <td valign="top">News description</td>

    <td>

        <textarea id="editor1" name="news_content"><?php echo $fetchdata[3]; ?></textarea>

        <script type="text/javascript">CKEDITOR.replace( 'editor1' );</script>

    </td>

</tr>

<tr><td>&nbsp;</td><td><input type="submit" name="editnews" value="Submit" /></td></tr>

</table>

</form>

</div>

</div>

</div>

<?php include_once ('includes/footer.php'); ?>

<script type="text/javascript" language="javascript">

$(document).ready(function(){

	$(".radio_hide").click(function(){

		radio_val=this.value;

		if(radio_val=='header') {

			$("#hide_table").show();

		} else {

			$("#hide_table").hide();

		}

	})

});

</script>