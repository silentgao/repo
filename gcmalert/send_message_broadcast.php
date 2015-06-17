<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (isset($_GET["name"]) && isset($_GET["message"])) {
    $name = $_GET["name"];
    $message = $_GET["message"];
    
     
        include_once 'db_functions.php';
        $db = new DB_Functions();
        $users = $db->getAllUsers();
        if ($users != false)
            $no_of_users = mysql_num_rows($users);
        else
            $no_of_users = 0;
              
       while ($row = mysql_fetch_array($users)) {
           if($row["name"]==$name){
               $regId=$row["regid"];               
          }             
    
       }
    
    include_once 'GCM.php';
    
    $gcm = new GCM();

    $registatoin_ids = array($regId);
    $message = array("price" => $message);

    $result = $gcm->send_notification($registatoin_ids, $message);

    echo $result;
}
?>
