<?php 

include_once('includes/header.php');

include_once('paging.php');

$article_id=$_GET['article_id'];

$article_status=$_GET['article_status'];

$msg=$_GET['msg'];

$keyword=$_GET['keyword'];



$delid=$_GET['delid'];

if(isset($delid) && $delid!='')

{

	@mysql_query("delete from articles_data where id='".$delid."'");

	$message="Information deleted successfully.";

}



if(isset($article_status) && $article_status!='')

{

	$upnews_status=($article_status==1)?0:1;

	$up=mysql_query("update articles_master set state='".$upnews_status."' where id='".$article_id."'");

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

$countrows="SELECT * FROM articles_data WHERE 1=1";

if(isset($keyword) && $keyword!='') {	

	$countrows.=" and ( article_title like '%".$keyword."%' or article_title like '%".$keyword."%' )";

}



$countrows.=" order by id desc";

$datacount=mysql_query($countrows); 

$number=mysql_num_rows($datacount);

if($number>0)

{

?>

<table class="pagetable" cellspacing="0">

<tr>

    <th>Article .no.</th>

    <th>Article Title</th>

	<th>Article Content</th>
	
	<th>Parent Page</th>

    <th>Container</th>
	
	<th>Created On</th>
	
	<th>State</th>
	
	<th> &nbsp; </th>
    
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

	<td><?php echo $rsfetch->article_title; ?></td>

	<td><?php echo read_more(6,$rsfetch->article_con); ?></td>

	<td><?php echo $refetch->parent_page; ?></td>
	
    <td><?php echo $refetch->container; ?></td>

    <td><?php echo $refetch->created_on; ?></td>
	

	<td>

	<a href="articlelist.php?article_id=<?php echo $rsfetch->id; ?>&amp; article_status=<?php echo $rsfetch->state; ?>">

	<?php if($rsfetch->state==1) { $img='true.gif'; } else { $img='false.gif'; } ?>

    <img src="images/<?php echo $img; ?>" border="0" />

    </a>

    </td>
	
		<td><?php echo $rsfetch->product_attachment; ?></td>


	<td>

    	<a href="updatearticle.php?article_id=<?php echo $rsfetch->id; ?>"><img src="images/edit.gif" class="systemicon" alt="Edit" title="Edit"></a>&nbsp;&nbsp;

		
    	<a href="articlelist.php?delid=<?php echo $rsfetch->id; ?>" onclick="return confirm('Are you really want to delete this record ?');">

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