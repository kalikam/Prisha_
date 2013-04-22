<?php 
error_reporting(E_ALL ^ E_NOTICE);
require_once('database.php');
include_once('functions.php');
$msg=$_GET['msg'];

$product=$_GET['productid'];
if(!$product)
header("location:productlist.php");
else
{ $query=mysql_query("select *from product_master where product_id='$product'");

  $pro=mysql_fetch_object($query);
}
if(isset($_REQUEST['updateproduct'])&&($_REQUEST['updateproduct'])!=='') 
{ 

  $product_name				=	escapechar($_REQUEST['product_name']);

  $product_category			=	trim($_REQUEST['product_category']);

  $product_rate		            =	escapechar($_REQUEST['product_rate']);

  $product_detail      = $_REQUEST['product_detail'];

  if(isset($_FILES['product_photo']['tmp_name']))
  {  
    $product_img                = "product/".getProductId( ).".jpg";
  
      if(file_exists($product_img))
        {
		  unlink($product_img);
        }
  move_uploaded_file($_FILES['product_photo']['tmp_name'],$product_img);
}
	$error="";

	if($product_name=='')

	{

		$error="Please insert product title.";

	}



	if($error=='')

	{


			$in="update product_master set product_name='$product_name', product_cat='$product_category', product_price='$product_rate', product_detail='$product_detail', product_status='1'" ;
			if(strlen($product_img)>0)
			{			$in.=", product_img='$product_img'";
	       
		    }
	 
	        $in .=" where product_id='$product'";
		
			mysql_query($in);

			header("location:productlist.php?msg=Updated!");

		}

	

	else

	{

		$message=$error;

	}	

}



if(isset($msg) && $msg=='updated')

{

	$message="Product updated successfully.";

	$class="message";

}



include_once('includes/header.php');

?>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<div class="breadcrumbs">
  <p> PRODUCT </p>
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
	getCategoryName($pro->product_cat);
	?>
	</select>
	</td>
</tr>

<tr>

    <td width="200">Product Name</td>

    <td><input type="text" name="product_name" value="<? echo $pro->product_name; ?>" class="textbox_size" /></td>

</tr>

<tr>

    <td width="200">Product Rate </td>

    <td><input type="text" name="product_rate" value="<? echo $pro->product_price; ?>" class="textbox_size" /></td>
</tr>

<tr>

    <td valign="top">Product-Photo</td>
    <td> <input type="file" name="product_photo" value="<? echo $pro->product_img; ?>"/>    </td>
	<td> <img src="<? echo "Admin/admin/".$pro->product_img; ?>" height="40" width="40" /></td>
</tr>

<tr>

    <td valign="top">Product description</td>

    <td>        <textarea id="product_detail" name="product_detail"><?php echo $pro->product_detail;  ?></textarea>

        <script type="text/javascript">CKEDITOR.replace( 'editor1' );</script>    </td>
</tr>

<tr><td>&nbsp;</td><td><input type="submit" name="updateproduct" value="Submit" /></td></tr>
</table>

</form>

</div>

</div>

</div>

<?php include_once ('includes/footer.php'); ?>

<script type="text/javascript" language="javascript">


</script>