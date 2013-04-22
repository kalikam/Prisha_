	<?php
	include('database.php');
	$str="<option value=#>Select Column</option>";
    	
//	$str.=$_REQUEST['k'];
  
	$k=$_REQUEST['k'];
	
	    $res=mysql_query("SELECT * FROM article_place where parent_page='$k'");

	while($row=mysql_fetch_row($res))

	{ 
	    $str.="<option value=$row[0]>$row[1]</option>";
	}


	echo $str;
	?>