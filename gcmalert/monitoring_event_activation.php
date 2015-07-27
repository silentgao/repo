<?php

$username='root';
$password='';
$database='eventmanager';

$connection = mysql_connect ("localhost:3306", $username, $password);

if (!$connection) {
  die('Not connected : ' . mysql_error());
}

$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}


//Gets data from URL parameters

$reg_id = $_POST['Regid'];
$flag = $_POST['flag'];

// Opens a connection to a MySQL server
$query_monitor = "SELECT * FROM eventmonitoring WHERE 1";

$result_monitor = mysql_query($query_monitor);


while ($row_monitor = mysql_fetch_array($result_monitor)) {
    
    if($flag=="1")
    {
         if($reg_id==$row_monitor['regid'])
         {
                $result = mysql_query("DELETE from eventmonitoring WHERE regid = '$reg_id'");
         
                 $query = sprintf("INSERT INTO eventmonitoring" .
                " (flag,regid) " .
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
            if($reg_id==$row_monitor['regid'])
            {
                $rowid=$row_monitor['id'];
                $result = mysql_query("DELETE from eventmonitoring WHERE regid = '$reg_id'");
                $result = mysql_query("DELETE from events_monetering_details WHERE row_id = '$rowid'");
            }
        }
    
}

    if($flag=="1")
    {

                $result = mysql_query("DELETE from eventmonitoring WHERE regid = '$reg_id'");
         
                 $query = sprintf("INSERT INTO eventmonitoring" .
                " (flag,regid) " .
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


