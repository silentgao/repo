<?php
//require("phpsqlinfo_dbinfo.php");
$username='adminATg4ITy';
$password='SWhKUmLMAtYZ';
$database='eventmanager';


//Gets data from URL parameters
$name = $_GET['name'];
$Description = $_GET['Description'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$starttime=$_GET['starttime'];
$endtime=$_GET['endtime'];
$startdate=$_GET['startdate'];
$enddate=$_GET['enddate'];
$type = $_GET['type'];

  

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

// Insert new row with user data
$query = sprintf("INSERT INTO eventsdetails " .
         " (id, name, Description, lat, lng,starttime,endtime,startdate,enddate, type ) " .
         " VALUES (NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
         mysql_real_escape_string($name),
         mysql_real_escape_string($Description),
         mysql_real_escape_string($lat),
         mysql_real_escape_string($lng),
         mysql_real_escape_string($starttime),
         mysql_real_escape_string($endtime),
       
        mysql_real_escape_string($startdate),
        mysql_real_escape_string($enddate),
        mysql_real_escape_string($type));


    $result = mysql_query($query);
 
$query_monitor = "SELECT * FROM eventmonitoring WHERE 1";

$result_monitor = mysql_query($query_monitor);


while ($row_monitor = mysql_fetch_array($result_monitor)) {

    if($row_monitor['flag']=="1"){
        
        $query_m = sprintf("INSERT INTO events_monetering_details " .
         " (id, name, Description, lat, lng,starttime,endtime,startdate,enddate, type,row_id ) " .
         " VALUES (NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s','%s');",
         mysql_real_escape_string($name),
         mysql_real_escape_string($Description),
         mysql_real_escape_string($lat),
         mysql_real_escape_string($lng),
         mysql_real_escape_string($starttime),
         mysql_real_escape_string($endtime),
       
        mysql_real_escape_string($startdate),
        mysql_real_escape_string($enddate),
        mysql_real_escape_string($type),
        mysql_real_escape_string($row_monitor['id']));


        $result_m = mysql_query($query_m);
        
    }
    
}  
    
    

if (!$result) {
  die('Invalid query: ' . mysql_error());
}

?>

