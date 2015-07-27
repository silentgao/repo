<?php
   
include 'spherical-geometry.class.php'; 

$username='root';
$password='';
$database='eventmanager';

$send_message=  array();
// check for required fields
    
//if (isset($_POST['start']) && isset($_POST['end'])) {

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

    // Opens a connection to a mySQL server
     $connection=mysql_connect ('localhost:3306', $username, $password);
    if (!$connection) {
         die('Not connected : ' . mysql_error());
     }

    // Set the active mySQL database
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

        $post_message=array();
        $details=array();
        $id=1;
        // Iterate through the events
        while ($row = @mysql_fetch_assoc($result)){
 
        //Event locaton   
        $event=new LatLng(doubleval($row['lat']), doubleval($row['lng']));
   
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
        $startDateTime=$row['startdate']." ".$row['starttime'];
        $endDateTime=$row['enddate']." ".$row['endtime'];
        $active_flag=0;
        
        $time1 = strtotime($current_date);
        $time2 = strtotime($endDateTime);
        $diff = $time2 - $time1;
        
        if($diff>0){$active_flag=1; }else{$active_flag=0;}
        
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
                    
                    $message_type=$row['type'];
                    $message_description=$row['description'];
                    $post_message[]=$row['id'].",".$row['lat'].",".$row['lng'].",".$row['name'].",".$row['description'].",".$row['type'].",".$startDateTime.",".$endDateTime;
                    $messages_temp="Event: ".$message_type." Description: ". $message_description;
                   
                    array_push($send_message,$messages_temp);
                    
                    break;   
                }
 
            }
          }
        }
        
    echo json_encode($post_message);
    
    include_once 'GCM.php';
    include_once 'db_functions.php';
   
    $gcm = new GCM();

    $registatoin_ids = array($rid);
    //$message = array("price" => $message);
    $db = new DB_Functions();
    $users = $db->getAllUsers();
   // while ($row = mysql_fetch_array($users)) {
   
     //      $registatoin_ids=array($row["regid"]);
    //for($i=0;$i<count($$send_message);$i++){
    
            
           //$messages="Event: ".$message_type." Description: ". $message_description;
           $errors = array_filter($send_message);

            if (!empty($send_message)) {
                
                    $mm=  implode(" ",$send_message);
    
           //$message = array("price" => $messages[$i]);
                    $message = array("price" => $mm);

                    $result = $gcm->send_notification($registatoin_ids, $message);

                    echo $result;               
    //}      
            }
             
           
    //}


    //$result = $gcm->send_notification($registatoin_ids, $message);
    
    
    
    
//}


?>

