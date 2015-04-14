<!doctype html>
<html lang="en">
<?php
include_once 'includes/register_inc.php';
include_once 'includes/functions.php';


session_start();

if(!isset($_SESSION['username']) || !isset($_SESSION['password'])){
    
    header('Location: index.php');
}

$flag=$_SESSION['flag'];
   



?>
<head>
	<meta charset="utf-8"/>
	<title>Alert Admin Panel</title>
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
	<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
       
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
</script>
 <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

<script type="text/javascript">
            function saveData() {
                 
                    document.myform.submit();

            }
</script>
</head>


<body>
 <?php //if (login_check($mysqli) == true) : ?>
	<header id="header">
		<hgroup>
                    <h1 class="site_title"><a href="registrationv2.php">User Registration</a></h1>
		</hgroup>
	</header> <!-- end of header bar -->
	
		<section id="secondary_bar">
		<div class="user">
                     
			<p><?php echo htmlentities($_SESSION['username']); ?></p>
                        <a class="logout_user" href="logout_a.php" title="Logout">Logout</a>
		</div>
		<div class="breadcrumbs_container">
                    <article class="breadcrumbs">
                        <a href="admin_dashboard.php">Dashboard</a> 
                        <div class="breadcrumb_divider"></div> 
                        <a class="current" href="gcmalert/BroadcastMessage.php">GCM</a>
                        <div class="breadcrumb_divider"></div> 
                        <a class="current" href="webservices.php">Web Services</a>
                        <div class="breadcrumb_divider"></div> 
                        <a class="current" href="ShowEventsDetails.php">Show All Events</a>
                        <div class="breadcrumb_divider"></div> 
                        <a class="current" href="AddEventsDetails.php">Add Events</a>
                    
                    </article>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<form class="quick_search">
			
		</form>
		<hr/>
		
		<h3>Users</h3>
		<ul class="toggle">
                    <li class="icn_add_user"><a href="registrationv2.php">Add New User</a></li>
                    <li class="icn_view_users"><a href="viewUsers2.php">View Users</a></li>
                    
		</ul>
                
                <h3>Options</h3>
		<ul class="toggle">
                    <li class="icn_tags"><a href="admin_dashboard.php">Dashboard</a></li>
                    <li class="icn_tags"><a href="gcmalert/BroadcastMessage.php">GCM</a></li>
                    <li class="icn_tags"><a href="webservices.php">Web Services</a></li>
                    <li class="icn_tags"><a href="AddEventsDetails.php">Add Events</a></li>
                    <li class="icn_tags"><a href="ShowEventsDetails.php">Show All Events</a></li>
		</ul>
                
		
		<h3>Admin</h3>
		<ul class="toggle">
                    <li class="icn_profile"><a href="profile.php">Profile</a></li>
                        <li class="icn_jump_back"><a href="logout_a.php">Logout</a></li>
		</ul>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2014 Website Event Management</strong></p>
			<p>Created By <a href="http://rifatrashid.sitecloud.cytanium.com">Rifat Ahmmad Rashid</a></p>
		</footer>
	</aside><!-- end of sidebar -->
        
   
	<section id="main" class="column">
		
		<h4 class="alert_info">Welcome to the Event Manager Admin Registration Page.</h4>
		
                <article class="module width_full">
			<header><h3>Instructions</h3></header>
			<ul>
            <li>Usernames may contain only digits, upper and lower case letters and underscores</li>
            <li>Emails must have a valid email format</li>
            <li>Passwords must be at least 6 characters long</li>
            <li>Passwords must contain
                <ul>
                    <li>At least one upper case letter (A..Z)</li>
                    <li>At least one lower case letter (a..z)</li>
                    <li>At least one number (0..9)</li>
                </ul>
            </li>
            <li>Your password and confirmation must match exactly</li>
        </ul>
			<footer>
				<form class="post_message">
                               
			
				</form>
			</footer>
		</article><!-- end of messages article -->
                
                
		<article class="module width_full">
			<header><h3>Registration</h3></header>
                        <form action="registration.php" method="post" name="registration_form">
				<div class="module_content">
                          
						<fieldset>
							<label>User Name</label>
							 <input type='text' name='username' id='username' />
						</fieldset>
						
                                                <fieldset>
                                                        <label>Email</label>
							<input type="text" name="email" id="email" />
						</fieldset>
                                               <fieldset>
                                                        <label>Password</label>
                                                        <input type="password" name="password" id="password" />
                                                </fieldset>
                                                <fieldset>
                                                    <label>Confirm Password</label>
                                                    <input type="password" name="confirmpwd" id="confirmpwd" />
						</fieldset>
                                              
						<fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label name="category">Category</label>
							<select name="role" style="width:92%;">
								<option>Admin</option>
								<option>Event Manager</option>
								<option>GCM Manager</option>
							</select>
						</fieldset>
						
                                    <div class="clear"></div>
				</div>
			<footer>
				<div class="submit_link">
									
                                <input type="submit" name="submit" value="Register" onclick="saveData()" /> 
				
				</div>
			</footer>
                 
                        </form>
		</article><!-- end of post new article -->
	
                
                
                
                
		<div class="clear"></div>
		
		<div class="spacer"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
	</section>


</body>

</html>