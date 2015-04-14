<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$username='root';
$password='';
$database='eventmanager';

$user = $_POST['username'];
$pass = $_POST['password'];
//echo $pass;

// Opens a connection to a MySQL server
$connection = mysql_connect ("localhost:3306", $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

$query_login = "SELECT * FROM users WHERE 1";

$result = mysql_query($query_login);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}
$flag=0;

while ($row = mysql_fetch_array($result)) {
    
    //echo $row['password'];

    if($row['username']== $user && $row['password']== $pass){
       $flag=1;
       session_start();
       $_SESSION['username'] = $user;
       $_SESSION['password'] = $pass;
     }
}


if($flag)
{
     $_SESSION['flag']=$flag;
     header('Location: admin_dashboard.php');
}
  
else {
     header('Location: index.php');
}      