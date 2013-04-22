<?php
$hostname = "localhost";
$username = "techmip7_root";
$password = "techmip7_123";
$dbname = "techmip7_prisha";
$conn =mysql_connect($hostname,$username,$password);
if(!$conn) die("Failed to connect to database!");
$status = mysql_select_db($dbname, $conn);
if(!$status) die("Failed to select database!");?>