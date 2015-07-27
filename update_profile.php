<?php

define('DB_HOST', 'localhost:3306');
define('DB_NAME', 'eventmanager');
define('DB_USER','root');
define('DB_PASSWORD','');
$username = $_POST['username']; 
$role = $_POST['role']; 
$email = $_POST['email']; 
$password = $_POST['password']; 

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); 
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

function NewUser() { 



$query = "INSERT INTO users (username,email,password,role) VALUES ('$username','$email','$password','$role')"; 
$data = mysql_query ($query)or die(mysql_error()); 

        if($data) { header('Location: register_success.php'); } 

}

function SignUp() { 
    
if(!empty($_POST['username'])) //checking the 'user' name which is from Sign-Up.html, is it empty or have some text 
{       
        $ua=$_POST['username'];
        $pa=$_POST['password'];
        
        $query = mysql_query("SELECT * FROM users WHERE username = '$ua' AND password = '$pa'") or die(mysql_error());
        
        if(!$row = mysql_fetch_array($query) or die(mysql_error())) { 
        newuser();
}
else { 
    
    $query_del=  sprintf("DELETE FROM eventsdetails WHERE name = '$username' LIMIT 1");
    $test_2 = mysql_query($query_del); 
    newuser();
} 

} 

} 
if(isset($_POST['submit'])) {
    
    SignUp(); 
    
}


