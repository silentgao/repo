<?php

include 'spherical-geometry.class.php'; 

//$lat_end=45.1894664;//$_POST['latend'];
//$lng_end=9.163067;//$_POST['lngend'];


//$ed="45.1894664,9.163067";
$username='adminATg4ITy';
$password='SWhKUmLMAtYZ';
$database='eventmanager';


// Opens a connection to a MySQL server
$connection=mysql_connect ('127.4.86.2:3306', $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table
$query_fb = "SELECT * FROM  broadcast_message WHERE 1";
//$query_foursquare = "SELECT * FROM poi_foursquare_extend WHERE 1";
$result_fb = mysql_query($query_fb);
//$result_foursquare = mysql_query($query_foursquare);

if (!$result_fb) {
  die('Invalid query: ' . mysql_error());
}


$count=0;  
 while ($row = mysql_fetch_array($result_fb)) {
     
        //Event locaton   
    
      
            
            $message[]=$row["events"]."|".$row["description"]."|".$row["timr"];
            
           // echo $row["type"];
            $count++;
            
 }
 
 
 echo json_encode($message);
 //echo $count;
