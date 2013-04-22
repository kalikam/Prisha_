<?php
if(!function_exists('paging'))
{	
	function paging($sql,$record="2",$total,$qstr='')
	{
		global $rowsPerPage;
		global $pageNum;
		global $offset;
		global $maxPage;
		global $self;
		global $nav;
		global $toalrecord;

		$toalrecord=$total;
		$rowsPerPage=$record;
		
		if(isset($_GET['page']))
		{
			$pageNum = $_GET['page'];
		}
		else
		{
			$pageNum=1;
		}
		$offset=($pageNum-1)*$rowsPerPage;
		$maxPage = ceil($total/$rowsPerPage);
		$self = basename($_SERVER['PHP_SELF']);
		$nav = '';
		$query=$sql." limit $offset , $rowsPerPage";
		return($query);
	}
}
else
{
	if ($pageNum > 1)
	{
		$page = $pageNum - 1;
		$prev  = " <a href='$self?page=$page$qstr'>[Prev]</a> ";
		$first = " <a href='$self?page=1$qstr'>[First Page]</a> ";
	} 
	else
	{
		$prev  = " <span>[Prev]</span> "; 
		$first = " <span>[First Page]</span> "; 
	}
	if ($pageNum < $maxPage)
	{
		$page = $pageNum + 1;
		$next = " <a href='$self?page=$page$qstr'>[Next]</a> ";
		$last = " <a href='$self?page=$maxPage$qstr'>[Last Page]</a> ";
	} 
	else
	{
		$next = " <span>[Next]</span> "; 
		$last = " <span>[Last Page]</span> "; 
	}
?>
<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
<tr class="footer_num">
	<td align="center">Total Record : <?php echo $toalrecord; ?></td>
	<td align="center" style="text-align:center;">
		<?php echo $first." ".$prev; ?>
		<select name="pageid" id="pid" onchange="returnurl(this.value);">
		<?php for($i=1; $i<=$maxPage; $i++) { ?>
		<option value="<?php echo $i; ?>" <?php if($i==$pageNum) echo "selected"; ?>><?php echo $i; ?></option>
		<?php } ?>
		</select>
		<?php echo $next." ".$last;	?>
	</td>
	<td align="right" style="text-align:right;">Show Page No <?php echo $pageNum; ?> from <?php echo $maxPage; ?></td>
</tr>
</table>
<?php
}
?>