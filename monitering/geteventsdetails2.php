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





// Opens a connection to a MySQL server
$query_monitor = "SELECT * FROM eventmonitoring WHERE 1";

$result_monitor = mysql_query($query_monitor);

$query_monitor_events = "SELECT * FROM events_monetering_details WHERE 1";

$result_monitor_events = mysql_query($query_monitor_events);

if (isset($_POST['start']) && isset($_POST['end'])) {

     $st = $_POST['start'];
     $ed=$_POST['end'];
     $rid=$_POST['Regid'];
     $lat=$_POST['lat'];
     $long=$_POST['long'];
    
    //$regId ="APA91bG0HhCMk5Tsq5TSr4RtEigarQ-bQXM9YGH1mjLklzo-P8TlEgBhfPRhJLI0pShQB3RbezJdAjNn7X0lR4yhLYBX79uCq6uPlOtpSkCSK1cC3bF-8wTeXF0q-f4Epo2C3YSuLz0RX_Ytz2_kfTdNtQFEjQTUeWUPoO0xD54eImgt6XjS55A" ;
     
    $trim_lat1=  trim($lat,"[");
    $trim_lat2=  trim($trim_lat1,"]");
    $lat_value=  trim($trim_lat2);
    
    $trim_lng1=  trim($long,"[");
    $trim_lng2=  trim($trim_lng1,"]");
    $lng_value=  trim($trim_lng2);
    
    $lat_array=  explode(",", $lat_value);
    $lng_array=  explode(",", $lng_value);
    
    
    $start_array=  explode(",", $st);
    $end_array=    explode(",", $ed);
    
     date_default_timezone_set("CET");
     $current_date=date("d-m-Y H:i");    
    
    
    
    
while ($row_monitor = mysql_fetch_array($result_monitor)) {
    
    if($row_monitor['flag']=="1")
    {
        $rowid=$row_monitor['id'];
       
        while ($row_m_e = mysql_fetch_array($result_monitor_events)) {
            
                if($row_m_e['lat']!=""){
                
                //Event locaton   
                $event=new LatLng(doubleval($row_m_e['lat']), doubleval($row_m_e['lng']));

                /* Code for calculating bounds   */

                $radius=50;
                $LatLng=$event;
                $latRadiansDistance = $radius / 6378137;
                $latDegreesDistance = rad2deg($latRadiansDistance);
                $lngDegreesDistance = rad2deg($latRadiansDistance / cos(deg2rad($LatLng->getLat())));

                // SW point
                $swLat = $LatLng->getLat() - $latDegreesDistance;
                $swLng = $LatLng->getLng() - $lngDegreesDistance;
                $sw = new LatLng($swLat, $swLng);

                // NE point
                $neLat = $LatLng->getLat() + $latDegreesDistance;
                $neLng = $LatLng->getLng() + $lngDegreesDistance;
                $ne = new LatLng($neLat, $neLng);

                $b=new LatLngBounds($sw,$ne);
                //$message=$b->toString();
                //$message=$b->contains($b->getCenter());

                /*Checking Event Active or Not  */
                $startDateTime=$row_m_e['startdate']." ".$row_m_e['starttime'];
                $endDateTime=$row_m_e['enddate']." ".$row_m_e['endtime'];
                $active_flag=0;

                $time1 = strtotime($current_date);
                $time2 = strtotime($endDateTime);
                $diff = $time2 - $time1; 
                
                if($diff>0){$active_flag=1; }else{$active_flag=0;}
                $active_flag=1; 
                if($active_flag){
                /*Loop to check contains points*/
                    for($i=0;$i<count($lat_array);$i++)
                    {
                        $lt=new LatLng(doubleval($lat_array[$i]),doubleval($lng_array[$i]));

                        if($b->contains($lt))
                        {
                            // $message="value contains";
                            /*$post_message["id"]=$row['id'];
                            $details["lat"]=$row['lat'];
                            $details["lng"]=$row['lng'];
                            $details["name"]=$row['name'];
                            $details["Description"]=$row['Description'];
                            $details["type"]=$row['type'];
                            $post_message["details"]=$details;
                            */
                         $sttimedate=$row_m_e['startdate']." ".$row_m_e['starttime'];

                        $post_message[]=$row_m_e['id'].",".$row_m_e['lat'].",".$row_m_e['lng'].",".$row_m_e['name'].",".$row_m_e['description'].",".$row_m_e['type'].",".$sttimedate;
                         break;   
                        }

                    }
                }
                
               
                }
                
        }  
        $result = mysql_query("DELETE from events_monetering_details WHERE row_id = '$rowid'");
    }
}



echo json_encode($post_message);

}