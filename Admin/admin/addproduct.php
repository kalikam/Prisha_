<?php 
error_reporting(E_ALL ^ E_NOTICE);
require_once('database.php');
include_once('functions.php');
$msg=$_GET['msg'];
if(isset($_POST['addproduct'])&&($_POST['product_photo'])!=='') 
{ 

  $product_name				=	escapechar($_POST['product_name']);

  $product_category			=	trim($_POST['product_category']);

  $product_rate		            =	escapechar($_POST['product_rate']);

  $product_detail      = $_POST['product_detail'];

  $product_img                = "product/".getProductId( ).".jpg";
  
  move_uploaded_file($_FILES['product_photo']['tmp_name'],$product_img);

	$error="";

	if($product_name=='')

	{

		$error="Please insert product title.";

	}



	if($error=='')

	{

		$check=mysql_query("select * from  product_master where product_name='".$product_name."'");

		if(mysql_num_rows($check)>0)

		{

			$message="This product alreday exist.";

			$class="errormessage";

		}

		else

		{

			$in=" insert into product_master values('NULL','$product_name','$product_category','$product_rate.','$product_detail','1', '$product_img')";

			mysql_query($in);

			header("location:addproduct.php?msg=add");

		}

	}

	else

	{

		$message=$error;

	}	

}



if(isset($msg) && $msg=='add')

{

	$message="Product added successfully.";

	$class="message";

}



include_once('includes/header.php');

?>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<div class="breadcrumbs">
  <p>PRODUCT</p>
</div>

<div id="MainContent">

<div class="pagecontainer">

<div class="pageoverflow">

<div class="pageoptions">

<div class="message"><?php echo $message; ?></div>

<div class="pageheader">Product-Details</div>
</div>

<div class="midcontent">

<form method="post" action="" id="userform" enctype="multipart/form-data">

<table width="80%" align="center" cellpadding="5" cellspacing="0">
<tr>

	<td width="200">Product Category </td>

    <td><select name="product_category" id="product_category">
	<? 
	getCategoryName();
	?>
	</select>
	</td>
</tr>

<tr>

    <td width="200">Product Name</td>

    <td><input type="text" name="product_name" value="<? ?>" class="textbox_size" /></td>

</tr>

<tr>

    <td width="200">Product Rate </td>

    <td><input type="text" name="product_rate" value="<? ?>" class="textbox_size" /></td>
</tr>

<tr>

    <td valign="top">Product-Photo</td>
    <td> <input type="file" name="product_photo" />    </td>
</tr>

<tr>

    <td valign="top">Product description</td>

    <td>        <textarea id="product_detail" name="product_detail"><?php  ?></textarea>

        <script type="text/javascript">CKEDITOR.replace( 'editor1' );</script>    </td>
</tr>

<tr><td>&nbsp;</td><td><input type="submit" name="addproduct" value="Submit" /></td></tr>
</table>

</form>

</div>

</div>

</div>

<?php include_once ('includes/footer.php'); ?>

<script type="text/javascript" language="javascript">


</script>