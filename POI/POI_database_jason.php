<?php

$username='root';
$password='';
$database='eventmanager';
function parseToXML($htmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&#39;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 
return $xmlStr; 
} 

// Opens a connection to a MySQL server
$connection=mysql_connect ('localhost:3306', $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table
$query_fb = "SELECT * FROM POI WHERE 1";
//$query_foursquare = "SELECT * FROM poi_foursquare_extend WHERE 1";
$result_fb = mysql_query($query_fb);
//$result_foursquare = mysql_query($query_foursquare);

if (!$result_fb) {
  die('Invalid query: ' . mysql_error());
}




  
$row_fb = mysql_fetch_array($result_fb)


  


?>