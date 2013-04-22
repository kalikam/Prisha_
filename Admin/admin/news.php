<?php
// Request selected language
$hl = (isset($_POST["hl"])) ? $_POST["hl"] : false;
if(!defined("L_LANG") || L_LANG == "L_LANG")
{
	if($hl) define("L_LANG", $hl);

	// You need to tell the class which language do you use.
	// L_LANG should be defined as en_US format!!! Next line is an example, just put your own language from the provided list
	else define("L_LANG", "en_US");; // Greek example
}
// IMPORTANT: Request the selected date from the calendar

// Note: this sample doesn't show you how to use the $mydate variable with your database, but you can handle it as any other php variable in your script!
 
//error_reporting(E_ALL ^ E_NOTICE);
require_once('database.php');
include_once('functions.php');
if(isset($_POST['addnews']) && $_POST['addnews']!='') 
{  
	$news_content			=	escapechar($_POST['news_content']);
	
	$news_title			=	escapechar($_POST['news_title']);
	
	$news_date = $_POST['date3'];
	
	$news_state = $_POST['news_state'];

	$error="";

	if($news_title=='')

	{

		$error="Please insert news title.";

	}



	if($error=='')

	{

	$check=mysql_query("select *from news_master where news_title='$news_title'");

		if(mysql_num_rows($check)>0)

		{

			$message="This News alreday exist.";

			$class="errormessage";

		}

		else

		{

	       $res=mysql_query("insert into news_master values('NULL','$news_title','$news_date','$news_content','$news_attachment','$news_state')");

			header("location:news.php?msg=add");

		}

	}

	else

	{

		$message=$error;

	}	

}



if(isset($msg) && $msg=='add')

{

	$message="News added successfully.";

	$class="message";

}



include_once('includes/header.php');

?>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<div class="breadcrumbs"><p>Page</p></div>

<div id="MainContent">

<div class="pagecontainer">

<div class="pageoverflow">

<div class="pageoptions">

<div class="message"><?php echo $message; ?></div>

<div class="pageheader">Page</div></div>

<div class="midcontent">

<form method="post" action="" id="userform" enctype="multipart/form-data">

<table width="80%" align="center" cellpadding="5" cellspacing="0">
<tr>

    <td width="200">News Id</td>

    <td><input type="text"  value="<?  echo getNewsId() +1 ;?> " class="textbox_size" name="news_id" /></td>

</tr>

<tr>

    <td width="200">News Title</td>

    <td><input type="text" name="news_title" value="" class="textbox_size" /></td>

</tr>

<tr>

    <td>News State</td>

    <td>
            <input type="radio" class="radio_hide" name="news_state" value="1" checked="checked" />Publish

            <input type="radio" class="radio_hide" name="news_state" value="0" />Unpublished
    </td>

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

        <textarea id="editor1" name="news_content"><?php echo $_POST['news_content']; ?></textarea>

        <script type="text/javascript">CKEDITOR.replace( 'editor1' );</script>

    </td>

</tr>

<tr><td>&nbsp;</td><td><input type="submit" name="addnews" value="Submit" /></td></tr>

</table>

</form>

</div>

</div>

</div>

<?php include_once ('includes/footer.php'); ?>
<script language="javascript" src="jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">

$(document).ready(function(){
	$("#Parent_page").change(function(){
	
	var e=$('#Parent_page').val();
    //alert(e);
    $.ajax({type: "POST",url:"column.php",dataType: 'text',
    data:{k:e},success:function(result){
	//alert(result);
   $('#Column').html(result);
 }});   
 

});		
});

</script>
