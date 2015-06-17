<?php

include 'spherical-geometry.class.php'; 

//$lat_end=45.1894664;//$_POST['latend'];
//$lng_end=9.163067;//$_POST['lngend'];

$st = $_POST['start'];
$ed = $_POST['end'];
//$ed="45.1894664,9.163067";
$username='root';
$password='';
$database='eventmanager';

function parseToXML($htmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&#39;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 
return $xmlStr; 
} 
$start_array=  explode(",", $st);
$end_array=    explode(",", $ed);
// Opens a connection to a MySQL server
$connection=mysql_connect ('localhost:3306', $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table
$query_fb = "SELECT * FROM POI WHERE 1";
//$query_foursquare = "SELECT * FROM poi_foursquare_extend WHERE 1";
$result_fb = mysql_query($query_fb);
//$result_foursquare = mysql_query($query_foursquare);

if (!$result_fb) {
  die('Invalid query: ' . mysql_error());
}

$count=0;  
 while ($row = mysql_fetch_array($result_fb)) {
     
        //Event locaton   
    
        $event=new LatLng(doubleval($end_array[0]), doubleval($end_array[1]));
   
        /* Code for calculating bounds   */
  
        $radius=100;
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

 
         
        $lt=new LatLng(doubleval($row['lat']),doubleval($row['lng']));
   
        if($b->contains($lt))
        {    
            if($row['description']=="")
                $empty="No description ";
            else
                $empty=$row['description'];
            
            $message[]=$row['id']."|".$row['name']."|".$empty."|".$row['lat']."|".$row['lng']."|".$row['pic']."|".$row['pic_big']."|".$row['address'];
            $count++;
        }        
 }
 
 
 echo json_encode($message);
 //echo $count;
