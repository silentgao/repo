<?php

        
include_once 'GCM.php';
include_once 'db_functions.php';
        
        
$username='root';
$password='';
$database='eventmanager';


//Gets data from URL parameters

//$Description = $_GET['Description'];

//$type = $_GET['type'];

  

// Opens a connection to a MySQL server
$connection = mysql_connect ("localhost:3306", $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}



        $db = new DB_Functions();
        $gcm = new GCM();
        $users = $db->getAllUsers();
      
        if ($users != false)
            $no_of_users = mysql_num_rows($users);
        else
            $no_of_users = 0;
              
       while ($row = mysql_fetch_array($users)) {
           //if($row["name"]==$name){
           //    $regId=$row["regid"]
 //    $registatoin_ids = array("APA91bG0HhCMk5Tsq5TSr4RtEigarQ-bQXM9YGH1mjLklzo-P8TlEgBhfPRhJLI0pShQB3RbezJdAjNn7X0lR4yhLYBX79uCq6uPlOtpSkCSK1cC3bF-8wTeXF0q-f4Epo2C3YSuLz0RX_Ytz2_kfTdNtQFEjQTUeWUPoO0xD54eImgt6XjS55A");
           $registatoin_ids=array($row["regid"]);
           $message=$Description;
           $message = array("price" => $message);

           $result = $gcm->send_notification($registatoin_ids, $message);

            echo $result;;               
       }  

