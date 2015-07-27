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
$query = "SELECT * FROM eventsdetails WHERE 1";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
  //echo 'name="' . parseToXML($row['name']) . '" ';
 // echo 'address="' . parseToXML($row['address']) . '" ';
  echo 'id="' . $row['id'] . '" ';
  echo 'name="' . $row['name'] . '" ';
  echo 'Description="' . $row['description'] . '" ';
  echo 'starttime="' . $row['starttime'] . '" ';
  echo 'startdate="' . $row['startdate'] . '" ';
  echo 'endtime="' . $row['endtime'] . '" ';
  echo 'enddate="' . $row['enddate'] . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['lng'] . '" ';
  echo 'type="' . $row['type'] . '" ';
  
  
  echo '/>';
}

// End XML file
echo '</markers>';

?>