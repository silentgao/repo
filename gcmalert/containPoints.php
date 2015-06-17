<?php
   
include 'spherical-geometry.class.php'; 

// check for required fields
    
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
    
    
      
      
    
    //Event locaton   
       $event=new LatLng(45.181625, 9.153396);
   
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

/*Loop to check contains points*/
for($i=0;$i<count($lat_array);$i++)
{
   $lt=new LatLng(doubleval($lat_array[$i]),doubleval($lng_array[$i]));
   
   if($b->contains($lt))
   {
       $message="value contains";
       break;   
   }
   else {
   $message="value not contains";    
   }
   
}
    
  
  /*  for($i=0;$i<count($lat_array);$i++)
    {
      
        
        $message=$lat_array[$i];
    }*/
    
    
    include_once './GCM.php';
    
    $gcm = new GCM();

    $registatoin_ids = array($rid);
    $message = array("price" => $message);

    $result = $gcm->send_notification($registatoin_ids, $message);
    echo json_encode($result);
}


?>

