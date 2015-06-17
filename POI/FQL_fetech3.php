<?php

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
require 'facebook.php';
ini_set('max_execution_time', 300);


//Pavia Italy

$lat='45.1894664';
$long='9.163067';



$facebook = new Facebook(array(
	'appId' => '406079986240934',
	'secret' => 'bb193aff259eb37c2f9a1c9c297b8106'
));




$fb_token = '44275bb8a0408fb35a438f8e4035d9e6';
//$fb_token=$facebook->getAccessToken()
echo $fb_token;
if (!$facebook->getUser())
{
    $login_url = $facebook->getLoginUrl(array(
            'scope' => 'publish_stream' // Permissions goes here
        ) 
    );
}

$place_search2 = file_get_contents('https://graph.facebook.com/search?type=place&center=' . $lat . ',' . $long . '&distance=10000&access_token=' . $fb_token);
echo $place_search2;
//var_dump($place_search);
$place_search=json_decode($place_search2);




// Opens a connection to a MySQL server
$connection = mysql_connect ("127.4.86.2:3306", $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

$query_del=  sprintf("DELETE FROM `POI` WHERE 1");
$test_2 = mysql_query($query_del);

//if (!$test_2) {
 // die('Invalid query: ' . mysql_error());
//}

foreach($place_search->data as $result) {
    
    
  $category =  $result->category;
  $address  = $result->location->street;
  $page_id=$result->id;
  $name=$result->name;
  //echo '/>';
  $count++;
   
  $fql = 'SELECT latitude,longitude,checkin_count,pic,description,pic_big FROM place WHERE page_id=' .$result->id. '';
  
  $result2 = json_decode(file_get_contents('https://graph.facebook.com/fql?q=' . rawurlencode($fql) . '&access_token=' . $fb_token));
  
  //print_r($result2);
  
  foreach ($result2->data as $vv) {
  
     // $ch_count= $vv->checkin_count;
      //echo $vv->type."</br>";
      $lat=$vv->latitude;
      $lng=$vv->longitude;
      $checkin_count=$vv->checkin_count;
      $pic=$vv->pic;
      $description=$vv->description;
      $pic_big=$vv->pic_big;
  }
  
  $query = sprintf("INSERT INTO POI " .
         " (id, name, description, page_id,lat,lng,pic,category,checkin_count,pic_big,address) " .
         " VALUES (NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
         mysql_real_escape_string($name),
         mysql_real_escape_string($description),
         mysql_real_escape_string($page_id),
         mysql_real_escape_string($lat),
         mysql_real_escape_string($lng),
         mysql_real_escape_string($pic),
         mysql_real_escape_string($category),
         mysql_real_escape_string($checkin_count),
         mysql_real_escape_string($pic_big),
         mysql_real_escape_string($address));

        $test = mysql_query($query);  
    
}
echo $count;
//echo '</markers>';



