<?php



$username='root';
$password='';
$database='eventmanager';

include_once 'GCM.php';
include_once 'db_functions.php';


//Gets data from URL parameters
$type = $_GET['type'];
$Description = $_GET['Description'];


  

// Opens a connection to a MySQL server
$connection = mysql_connect ("localhost:3306", $username, $password);

if (!$connection) {
  die('Not connected : ' . mysql_error());
}


    $gcm = new GCM();
    $db = new DB_Functions();
    $users = $db->getAllUsers();
    
    while ($row = mysql_fetch_array($users)) {
   
           $registatoin_ids=array($row["regid"]);
    
           $messages="Event: ".$type." Description: ". $Description;
           $message = array("price" => $messages);

           $result2 = $gcm->send_notification($registatoin_ids, $message);

           echo $result2;  
   }
    

