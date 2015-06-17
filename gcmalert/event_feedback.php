<?php

$username='adminATg4ITy';
$password='SWhKUmLMAtYZ';
$database='eventmanager';

$connection = mysql_connect ("127.4.86.2:3306", $username, $password);

if (!$connection) {
  die('Not connected : ' . mysql_error());
}

$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}


//Gets data from URL parameters



// Opens a connection to a MySQL server
$query_monitor = "SELECT * FROM temp_events WHERE 1";
$result_monitor = mysql_query($query_monitor);

$query_events = "SELECT * FROM eventsdetails WHERE 1";
$result_events = mysql_query($query_events);

while ($row_monitor = mysql_fetch_array($result_monitor)) {
    
    if($flag=="1")
    {
         if($reg_id==$row_monitor['reg_id'])
         {
                $result = mysql_query("DELETE from event_monitoring WHERE reg_id = '$reg_id'");
         
                 $query = sprintf("INSERT INTO event_monitoring" .
                " (flag,reg_id) " .
                " VALUES ('%s', '%s');",
                 mysql_real_escape_string($flag),
                mysql_real_escape_string($reg_id));

                $result = mysql_query($query);

                if (!$result) {
                     die('Invalid query: ' . mysql_error());
                }
        
        }
    }
       if($flag=="2")
        {
            if($reg_id==$row_monitor['reg_id'])
            {
                $result = mysql_query("DELETE from event_monitoring WHERE reg_id = '$reg_id'");
            }
        }
    
}

    if($flag=="1")
    {

                $result = mysql_query("DELETE from event_monitoring WHERE reg_id = '$reg_id'");
         
                 $query = sprintf("INSERT INTO event_monitoring" .
                " (flag,reg_id) " .
                " VALUES ('%s', '%s');",
                 mysql_real_escape_string($flag),
                mysql_real_escape_string($reg_id));

                $result = mysql_query($query);

                if (!$result) {
                     die('Invalid query: ' . mysql_error());
                }
        
        
    }    
    

// Set the active MySQL database

// Insert new row with user data


