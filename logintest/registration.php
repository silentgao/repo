<?php

define('DB_HOST', '127.4.86.2:3306');
define('DB_NAME', 'eventmanager');
define('DB_USER','adminATg4ITy');
define('DB_PASSWORD','SWhKUmLMAtYZ');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); 
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

function NewUser() { 

$username = $_POST['username']; 
$role = $_POST['role']; 
$email = $_POST['email']; 
$password = $_POST['password']; 
$query = "INSERT INTO users (username,email,password,role) VALUES ('$username','$email','$password','$role')"; 
$data = mysql_query ($query)or die(mysql_error()); 

if($data) { header('Location: register_success.php'); } 

}

function SignUp() { 
    
if(!empty($_POST['username'])) //checking the 'user' name which is from Sign-Up.html, is it empty or have some text 
{ 
        $query = mysql_query("SELECT * FROM users WHERE username = '$_POST[username]' AND password = '$_POST[password]'") or die(mysql_error());
        
if(!$row = mysql_fetch_array($query) or die(mysql_error())) { 
    newuser(); 
} 
else { 
    echo "SORRY...YOU ARE ALREADY REGISTERED USER..."; 
    
} 

} 

} 
if(isset($_POST['submit'])) {
    
    SignUp(); 
    
}


