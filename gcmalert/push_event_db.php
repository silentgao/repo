<?php
       
include_once 'GCM.php';
include_once 'db_functions.php';
       
        
$username='root';
$password='';
$database='eventmanager';

//Gets data from URL parameters

$Description = $_POST['description'];

$type = $_POST['type'];

// Opens a connection to a MySQL server
$connection = mysql_connect ("localhost:3306", $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}
date_default_timezone_set("CET");
$current_date=date("d-m-Y H:i");
// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Insert new row with user data
//$query = sprintf("INSERT INTO push_event" .
//         " (type,description) " .
//         " VALUES ('%s', '%s');",
//         mysql_real_escape_string($type),
//         mysql_real_escape_string($Description));
$query = sprintf("INSERT INTO broadcast_message" .
         " (id,events,description,timr) " .
         " VALUES (NULL,'%s', '%s','%s');",
         mysql_real_escape_string($type),
         mysql_real_escape_string($Description),
         mysql_real_escape_string($current_date));
$result = mysql_query($query);

// Opens a connection to a MySQL server





/*while ($row_monitor = mysql_fetch_array($result_monitor)) {

     if($row_monitor['flag']=="1"){   
            
           $registatoin_ids=array($row["reg_id"]);
           $message="MOnitored".$type." ".$Description;
           
           $message = array("price" => $message);
           
           $result = $gcm->send_notification($registatoin_ids, $message);

           echo $result;
         
     }
    
}*/

if (!$result) {
  die('Invalid query: ' . mysql_error());
}

        $db = new DB_Functions();
        $gcm = new GCM();
        $users = $db->getAllUsers();
      
        if ($users != false)
            $no_of_users = mysql_num_rows($users);
        else
            $no_of_users = 0;
              
       while ($row = mysql_fetch_array($users)) {
        
           $registatoin_ids=array($row["regid"]);
           $message="Event: ".$type.". Description:".$Description;
           
           $message = array("price" => $message);
           
           $result = $gcm->send_notification($registatoin_ids, $message);

           echo $result;              
       }  

header('Location: BroadcastMessage.php');