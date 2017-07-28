<?php session_start()?>


<?php

$_SESSION['username']= null ;
$_SESSION['user_first_name']= null ;
$_SESSION['user_surname']= null ;
$_SESSION['user_access_level']= null ;
$_SESSION['user_email']= null ;
$_SESSION['user_image']= null ;

header("Location: ../index.php");

?>
