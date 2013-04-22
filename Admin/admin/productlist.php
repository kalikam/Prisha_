<?php 

include_once('includes/header.php');

include_once('paging.php');

$pageid=$_GET['pageid'];

$status=$_GET['status'];

$msg=$_GET['msg'];

$keyword=$_GET['keyword'];



$delid=$_GET['delid'];

if(isset($delid) && $delid!='')

{

	@mysql_query("delete from product_master where product_id='".$delid."'");

	$message="Information deleted successfully.";

}


if(isset($msg))
{
  $message="updated Successfully!";
}

if(isset($status) && $status!='')

{

	$upstatus=($status==1)?0:1;

	$up=mysql_query("update product_master set product_status='".$upstatus."' where product_id='".$pageid."'");

	$message="Status updated successfully.";

}



$qstr='';

if(isset($keyword) && $keyword) {

	$qstr.='&keyword='.$keyword;

}

?>

<script type="text/javascript" language="javascript">

function returnurl(pid)

{

	document.location.href='pagelist.php?page='+pid+'<?=$qstr?>';

}

</script>

<div class="breadcrumbs"><p>Pages</p></div>

<div id="MainContent">

<div class="pagecontainer">

<div class="pageoverflow">

<div class="pageoptions">

<div class="message"><?php echo $message; ?></div>

<div class="pageheader">Pages<span style="float:right;"><a href="addproduct.php">Add new product</a></span></div></div>

<form action="" method="get">

<table width="100%" cellspacing="0" cellpadding="0">

<tbody><tr>

	<td align="right" style="text-align: right;">

		Keyword : <input type="text" value="<?=$keyword;?>" name="keyword">

        <input type="submit" value="Search" name="searchdata">

    </td>

</tr>

</tbody></table>

<br>

</form>

<?php 

$countrows="SELECT * FROM product_master WHERE 1=1";

if(isset($keyword) && $keyword!='') {	

	$countrows.=" and ( product_name like '%".$keyword."%' or product_cat like '%".$keyword."%' )";

}



$countrows.=" order by product_id desc";

$datacount=mysql_query($countrows); 

$number=mysql_num_rows($datacount);

if($number>0)

{

?>

<table class="pagetable" cellspacing="0">

<tr>

    <th>Product.no.</th>

    <th>Product Name</th>

    <th>Product Category</th>
	
	<th>Product Price</th>
	
	<th>Product Detail</th>

    <th>Product Status</th>

    <th>Product Image</th>
	
	<th>&nbsp; </th>
    
</tr>

<?php 

$returnsql=paging($countrows,25,$number);

$returndata=mysql_query($returnsql);

$i=1;

while($rsfetch=mysql_fetch_object($returndata))

{

if($i%2==0) $class='class="row1"';

else  $class='class="row2"'; 

?>

<tr <?php echo $class; ?>>

	<td><?php echo $i; ?></td>

	<td><?php echo $rsfetch->product_name; ?></td>

	<td><?php echo getCategoryNameToId($rsfetch->product_cat); ?></td>

	<td><?php echo $rsfetch->product_price; ?></td>

	<td><?php echo read_more(10, $rsfetch->product_detail); ?></td>
	
	<td>

	<a href="productlist.php?pageid=<?php echo $rsfetch->product_id; ?>&amp;status=<?php echo $rsfetch->product_status; ?>">

	<?php if($rsfetch->product_status==1) { $img='true.gif'; } else { $img='false.gif'; } ?>

    <img src="images/<?php echo $img; ?>" border="0" />

    </a>

    </td>
	
		<td><?php echo $rsfetch->product_img; ?></td>


	<td>

    	<a href="updateproduct.php?productid=<?php echo $rsfetch->product_id; ?>"><img src="images/edit.gif" class="systemicon" alt="Edit" title="Edit"></a>&nbsp;&nbsp;

		
    	<a href="productlist.php?delid=<?php echo $rsfetch->product_id; ?>" onclick="return confirm('Are you really want to delete this record ?');">

        <img src="images/delete.gif" class="systemicon"></a>

        
    </td>

</tr>

<?php $i++; } ?>	

<tr><td>&nbsp;</td></tr>

<tr><td colspan="13"><?php include("paging.php"); ?></td></tr>

</table>

<?php } else { ?>

<div class="none">There is no record</div>

<?php } ?>

</div>

</div>



<?php include_once ('includes/footer.php'); ?>