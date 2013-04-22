<?php

function getNewsId()
{ $result= mysql_query("select news_id from news_master order by news_id Desc");

  $row=mysql_fetch_row($result);
  
  return $row[0];

}
function read_more($str,$content)
{
   $brkcon = explode(" ",$content);
   $wi = 0;
   $glimpse = "";
    while($wi < $str)
	{
	$glimpse .= $brkcon[$wi]." " ;
	$wi++ ;
	}
echo $glimpse;
}

function decode($str)

{

	$str = htmlspecialchars_decode($str,ENT_QUOTES);

	return html_entity_decode(trim($str),ENT_QUOTES);

}



function escapechar($str){

	return htmlentities(trim($str),ENT_QUOTES);

}



function createRandomPassword() 

{

    $chars="abcdefghjkmnopqrstuvwxyz023456789";

    srand((double)microtime()*1000000);

    $i = 0;

    $pass = '' ;

    while ($i<=4) 

	{

        $num  = rand() % 33;

        $tmp  = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;

    }

    return $pass;

}



function getEncryptPassword($password)

{

	return base64_encode($password);

}



function getDecryptPassword($passowrd)

{

	echo base64_decode($passowrd);

}





function sendmail($toemail,$subject,$msgbody,$from='')

{

	if($from=='') {

		$email_from='admin@indiainfotech.com';

	} else {

		$email_from=$from;

	}



	$headers  = 'MIME-Version: 1.0' . "\r\n";

	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$headers .= 'From:'.$email_from."\r\n";

	$msgbody=$msgbody;

	@mail($toemail, $subject, $msgbody, $headers);

}



function mail_attachment($to,$subject,$message,$attachment,$from='')

{

	if($from=='') {

		$email_from='admin@indiainfotech.com';

	} else {

		$email_from=$from; // Who the email is from

	}

	$email_message = 0;

	$fileatt = $attachment; // Path to the file

	$fileatt_type = "application/octet-stream"; // File Type

	$start=	strrpos($attachment, '/') == -1 ? strrpos($attachment, '//') : strrpos($attachment, '/')+1;

	$fileatt_name = substr($attachment, $start, strlen($attachment)); // Filename that will be used for the file as the 	attachment



	$email_subject =  $subject; // The Subject of the email



	//$email_txt=$message; // Message that the email has in it

	$email_txt=getEmailTemplate($message);





	$email_to = $to; // Who the email is to

	$headers = "From: ".$email_from;



	$file = fopen($fileatt,'rb');

	$data = fread($file,filesize($fileatt));

	fclose($file);

	$msg_txt="";

	

	$semi_rand = md5(time());

	$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

	

	$headers .= "\nMIME-Version: 1.0\n" .

	"Content-Type: multipart/mixed;\n" .

	" boundary=\"{$mime_boundary}\"";

	

	$email_txt .= $msg_txt;

	

	$email_message .= "This is a multi-part message in MIME format.\n\n" .

	"--{$mime_boundary}\n" .

	"Content-Type:text/html; charset=\"iso-8859-1\"\n" .

	"Content-Transfer-Encoding: 7bit\n\n" .

	$email_txt . "\n\n";



	$data = chunk_split(base64_encode($data));



	$email_message .= "--{$mime_boundary}\n" .

	"Content-Type: {$fileatt_type};\n" .

	" name=\"{$fileatt_name}\"\n" .

	"Content-Disposition: attachment;\n" .

	" filename=\"{$fileatt_name}\"\n" .

	"Content-Transfer-Encoding: base64\n\n" .

	$data . "\n\n" .

	"--{$mime_boundary}--\n";

	

	$ok = @mail($email_to, $email_subject, $email_message, $headers);

}



function getShowDateFormat($date)

{

	$exp=explode("-",$date);

	$year=$exp[0];

	$month=$exp[1];

	$day=$exp[2];



	if($year>0 && $month>0)

	{	

		$date=date("d M Y",mktime(0,0,0,$month,$day,$year));

		$return=$date;

	}

	else

	{

		$return='';

	}

	return $return;

}



function checkEmail($emailid)

{

	if(!preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$emailid)) 

	{

		return "no";

	}

	else

	{

		return "yes";

	}

}



function getParentPage($selectedpage='',$currentpage='')

{

	$string='';

	if($currentpage!='') {

		$fetch=mysql_query("select * from pages where page_status=1 and page_position='header' and pageid!='".$currentpage."' ");

	} else {

		$fetch=mysql_query("select * from pages where page_status=1 and page_position='header' ");

	}

	

	if(mysql_num_rows($fetch)>0)

	{

		$string.='<option value="">Select Page</option>';

		while($resfetch=mysql_fetch_array($fetch))

		{

			if($resfetch['pageid']==$selectedpage) {

				$string.='<option value="'.$resfetch['pageid'].'" selected="true">'.$resfetch['page_name'].'</option>';

			} else {

				$string.='<option value="'.$resfetch['pageid'].'">'.$resfetch['page_name'].'</option>';

			}

		}

	}

	return $string;

}



function getPageSlug($pagename)

{

	if($pagename!='')

	{

		$pagename=strtolower(trim($pagename));

		$pagename=str_replace(" ","_",$pagename);

		$return=$pagename;

	}

	else

	{

		$return='';

	}

	return $return;

}



function getPageName($pageid)

{

	$fetch=mysql_query("select * from pages where pageid='".$pageid."' ");

	if(mysql_num_rows($fetch)>0)

	{

		$result=mysql_fetch_array($fetch);

		$return=$result['page_name'];

	}

	else

	{

		$return='';

	}

	return $return;

}




function getSidebarList($sidebarid='')

{

	$string='';

	$fetch=mysql_query("select * from sidebars ");

	if(mysql_num_rows($fetch)>0)

	{

		while($resfetch=mysql_fetch_array($fetch))

		{

			if($resfetch['sidebarid']==$sidebarid) {

				$string.='<option value="'.$resfetch['sidebarid'].'" selected="true">'.$resfetch['sidebar_title'].'</option>';

			} else {

				$string.='<option value="'.$resfetch['sidebarid'].'">'.$resfetch['sidebar_title'].'</option>';

			}

		}

	}

	return $string;

}

function getAllPageName()
{ 			$str="<option value=Select-Page>Select Page</option>";
			$fetch=mysql_query("select * from pages");
       
	       while($row=mysql_fetch_row($fetch))
		   { 
		     $str.= "<option value=$row[0]>$row[1]</option>";
		   
		   }
echo $str;
}
include_once("database.php");
function getCategoryName($str)
{ $fetch=mysql_query("select * from category_info");

  $str="<option value='#'>select Category</option>";
  while($row=mysql_fetch_row($fetch))
  { 
    if($str==$row[0])
     $str.="<option value=$row[0] selected=\"selected\">$row[1]</option>";
   else
    $str.="<option value=$row[0]>$row[1]</option>";
  }
  
  echo $str;
  
}

function getCategoryNameToId($id)
{ $fetch=mysql_query("select * from category_info where cat_id='$id'");

  $row=mysql_fetch_row($fetch);
  
  $str=$row[1];
  
  return $str;
  
}


function getProductId( )
{ $fetch=mysql_query("select product_id from product_master order by product_id Desc Limit 1");

   $row=mysql_fetch_row($fetch);

   return $row[0]+1;

}



?>
