<!doctype html>
<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<head>

	<!-- Basics -->
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>Login</title>

	<!-- CSS -->
	
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/styles.css">
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
        <script type="text/javascript">
        
            function saveData() {
                 
                    document.myform.submit();

            }
        
        
    
        </script>
	
</head>

	<!-- Main HTML -->
	
<body>
	
	<!-- Begin Page Content -->
	<?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error Logging In!</p>';
        }
        ?> 
	<div id="container">
            <!--<label>Event Manager Admin Panel</label>-->
            <form id="form1" name="myform" method="post" action='login_db_functions.php'>
               
		<label for="name">Username:</label>
		
                <input type="name" name="username">
		
		<label for="username">Password:</label>
		
		<!--<p><a href="#">Forgot your password?</a>-->
		
		<input type="password" name="password">
		
		<div id="lower">
		
		<!--<input type="checkbox"><label class="check" for="checkbox">Keep me logged in</label>-->
		
		<!--<input type="submit" value="Login" onclick="saveData()">-->
		<input type="submit" name="login" value="Login" onclick="saveData()" />
                                 
                                   
		</div>
		
            </form>
		
	</div>
	
	
	<!-- End Page Content -->
	
</body>

</html>
	
	
	
	
	
		
	