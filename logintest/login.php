<?php
session_start();
 if($_REQUEST['usr']=='ABC' && $_REQUEST['pswd']=='123'){
 $_SESSION['usr'] = 'ABC';
 $_SESSION['pswd'] = '123';
 header('Location: content.php');
 }
 else{
 header('Location: niceform.php');
 }
?>

