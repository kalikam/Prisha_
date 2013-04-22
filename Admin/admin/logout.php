<?php
@session_start();

unset($_SESSION['adminId']);
unset($_SESSION['adminFirst']);
unset($_SESSION['adminLast']);

//session_destroy();
header("location:index.php");
?>