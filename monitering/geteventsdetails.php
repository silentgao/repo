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

//$reg_id = $_POST['Regid'];
$flag = $_POST['flag'];

// Opens a connection to a MySQL server
$query_monitor = "SELECT * FROM eventmonitoring WHERE 1";

$result_monitor = mysql_query($query_monitor);

$query_monitor_events = "SELECT * FROM events_monetering_details WHERE 1";

$result_monitor_events = mysql_query($query_monitor_events);



while ($row_monitor = mysql_fetch_array($result_monitor)) {
    
    if($row_monitor['flag']=="1")
    {
        $rowid=$row_monitor['id'];
       
        while ($row_m_e = mysql_fetch_array($result_monitor_events)) {
            
                if($row_m_e['lat']!=""){    
                
                $sttimedate=$row_m_e['startdate']." ".$row_m_e['starttime'];
                    
                $post_message[]=$row_m_e['id'].",".$row_m_e['lat'].",".$row_m_e['lng'].",".$row_m_e['name'].",".$row_m_e['description'].",".$row_m_e['type'].",".$sttimedate;
           
                }
                
        }  
        $result = mysql_query("DELETE from events_monetering_details WHERE row_id = '$rowid'");
    }
}



echo json_encode($post_message);

