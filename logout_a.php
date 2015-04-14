<?php
 session_start();
 session_destroy();
 $_SESSION['flag'] = 0;
 $_SESSION['username']="";
 $_SESSION['password']="";
 header('Location: index.php');
 exit;
?>
