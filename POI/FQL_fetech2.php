<?php

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

//header("Content-type: text/xml");

// Start XML file, echo parent node
//echo '<markers>';
//echo $result->name.",".$result->id;
  //echo "test";
foreach($place_search->data as $result) {
    
  //  echo '<marker ';
    //    echo $result->name.",".$result->id;
    //  echo $result->location->latitude.",".$result->location->latitude;
    //echo 'lat="' .$result->location->latitude. '" ';
    //echo 'lng="' .$result->location->longitude. '" ';
    //echo 'id="' .$result->id. '" ';
    //echo 'name="' .parseToXML($result->name). '" ';
    //echo 'street="' .parseToXML($result->location->street). '" ';
    //echo 'category="' .parseToXML($result->category). '" ';
    
   // echo 'category="' .parseToXML($result->category). '" ';
   // $fql = 'SELECT checkin_count FROM place WHERE page_id=' .$result->id. '';
    //$result2 = json_decode(file_get_contents('https://graph.facebook.com/fql?q=' . rawurlencode($fql) . '&access_token=' . $fb_token));
    //echo 'checkin_count="' .parseToXML($result2->data->checkin_count). '" ';
    //print_r($result2);
    
  //echo '/>';
  $count++;
   
  $fql = 'SELECT pic_big,type FROM place WHERE page_id=' .$result->id. '';
  
  $result2 = json_decode(file_get_contents('https://graph.facebook.com/fql?q=' . rawurlencode($fql) . '&access_token=' . $fb_token));
  
  print_r($result2);
  
  foreach ($result2->data as $vv) {
  
     // $ch_count= $vv->checkin_count;
    //  echo $vv->pic_big."</br>";
  }
  
    
    
}

//echo '</markers>';



