<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$username='adminATg4ITy';
$password='SWhKUmLMAtYZ';
$database='eventmanager';

$name=$_GET['name'];

//echo $name;
// Opens a connection to a MySQL server
$connection = mysql_connect ("127.4.86.2:3306", $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}


 $query_del=  sprintf("DELETE FROM eventsdetails WHERE name = '$name' LIMIT 1");
 $test_2 = mysql_query($query_del); 


//Insert new row with user data
//$query = sprintf("INSERT INTO event_delete" .
//         " (event_name) " .
//         " VALUES ('%s');",
//         mysql_real_escape_string($type));
//
//$result = mysql_query($query);

header('Location: admin_dashboard.php');

