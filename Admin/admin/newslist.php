<?php 

include_once('includes/header.php');

include_once('paging.php');

$news_id=$_GET['news_id'];

$news_status=$_GET['news_status'];

$msg=$_GET['msg'];

$keyword=$_GET['keyword'];



$delid=$_GET['delid'];

if(isset($delid) && $delid!='')

{

	@mysql_query("delete from news_master where news_id='".$delid."'");

	$message="Information deleted successfully.";

}



if(isset($news_status) && $news_status!='')

{

	$upnews_status=($news_status==1)?0:1;

	$up=mysql_query("update news_master set product_news_status='".$upnews_status."' where news_id='".$news_id."'");

	$message="news_status updated successfully.";

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

<div class="pageheader">News<span style="float:right;"><a href="news.php">Add new News</a></span></div></div>

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

$countrows="SELECT * FROM news_master WHERE 1=1";

if(isset($keyword) && $keyword!='') {	

	$countrows.=" and ( news_title like '%".$keyword."%' or news_title like '%".$keyword."%' )";

}



$countrows.=" order by news_id desc";

$datacount=mysql_query($countrows); 

$number=mysql_num_rows($datacount);

if($number>0)

{

?>

<table class="pagetable" cellspacing="0">

<tr>

    <th>News .no.</th>

    <th>News Title</th>

    <th>News Date</th>
	
	<th>News Content</th>
	
	<th>News_status</th>

    <th>News Attachment</th>
	
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

	<td><?php echo $rsfetch->news_title; ?></td>

	<td><?php echo $rsfetch->news_date; ?></td>

	<td><?php echo read_more(7,$rsfetch->news_content).".."; ?></td>

	<td>

	<a href="productlist.php?news_id=<?php echo $rsfetch->news_id; ?>&amp;news_status=<?php echo $rsfetch->product_news_status; ?>">

	<?php if($rsfetch->news_status==1) { $img='true.gif'; } else { $img='false.gif'; } ?>

    <img src="images/<?php echo $img; ?>" border="0" />

    </a>

    </td>
	
		<td><?php echo $rsfetch->product_attachment; ?></td>


	<td>

    	<a href="updatenews.php?news_id=<?php echo $rsfetch->news_id; ?>"><img src="images/edit.gif" class="systemicon" alt="Edit" title="Edit"></a>&nbsp;&nbsp;

		
    	<a href="newslist.php?delid=<?php echo $rsfetch->news_id; ?>" onclick="return confirm('Are you really want to delete this record ?');">

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