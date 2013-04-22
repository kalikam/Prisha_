<?php 
error_reporting(E_ALL ^ E_NOTICE);
require_once('database.php');
include_once('functions.php');
if(isset($_POST['addarticle']) && $_POST['addarticle']!='') 
{ $page_name				=	escapechar($_POST['page_name']);
  $page_state			=	trim($_POST['page_state']);
  //$page_meta_title		=	escapechar($_POST['page_meta_title']);
	//$page_meta_keyword		=	escapechar($_POST['page_meta_keyword']);

//	$page_meta_description	=	escapechar($_POST['page_meta_description']);

	$Article_content			=	escapechar($_POST['Article_content']);
	
	$parent_page = $_POST['Parent_Page'];
	
	$column_title = $_POST['Column_Title'];

	$error="";

	if($page_name=='')

	{

		$error="Please insert page title.";

	}



	if($error=='')

	{

	$check=mysql_query("select *from articles_data where article_title='$page_name'");

		if(mysql_num_rows($check)>0)

		{

			$message="This Articles alreday exist.";

			$class="errormessage";

		}

		else

		{

	       $res=mysql_query("insert into articles_data values('NULL','$page_name','$Article_content','$parent_page','$column_title','0','0')");

			header("location:addarticle.php?msg=add");

		}

	}

	else

	{

		$message=$error;

	}	

}



if(isset($msg) && $msg=='add')

{

	$message="Page added successfully.";

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

    <td width="200">Article Id</td>

    <td><input type="text"  value="<? ?>" class="textbox_size" /></td>

</tr>

<tr>

    <td width="200">Article Name</td>

    <td><input type="text" name="page_name" value="<??>" class="textbox_size" /></td>

</tr>

<tr>

    <td>Page State</td>

    <td>
            <input type="radio" class="radio_hide" name="page_state" value="sidebar" checked="checked" />Publish

            <input type="radio" class="radio_hide" name="page_state" value="header" />Unpublished
    </td>

</tr>
<tr>

    <td>Parent-Page</td>

    <td>
            <select name="Parent_Page" id="Parent_page">
			<?
			getAllPageName();
			?>
				</select>
    </td>

</tr>
    <td>Column-Title</td>

    <td>
            <select name="Column_Title" onChange="" id="Column">
			<option value="#">Select-Column</option>
			
			</select>
    </td>

</tr>
</table>

<table width="80%" align="center" cellpadding="5" cellspacing="0">

<tr>

    <td width="200" valign="top">&nbsp;</td>

    <td>&nbsp;</td>

</tr>

    <td valign="top">Page description</td>

    <td>

        <textarea id="editor1" name="Article_content"><?php echo $_POST['Article_content']; ?></textarea>

        <script type="text/javascript">CKEDITOR.replace( 'editor1' );</script>

    </td>

</tr>

<tr><td>&nbsp;</td><td><input type="submit" name="addarticle" value="Submit" /></td></tr>

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
