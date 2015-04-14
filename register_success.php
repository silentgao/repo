<!doctype html>
<html lang="en">

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

</head>


<body>

	<header id="header">
		<hgroup>
                    <h1 class="site_title"><a href="registrationv2.php">User Registration</a></h1>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
                     
			<p><?php echo htmlentities($_SESSION['user']); ?></p>
			<a class="logout_user" href="#" title="Logout">Logout</a>
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
                    <li class="icn_view_users"><a href="#">View Users</a></li>
                    
		</ul>
                
                <h3>Options</h3>
		<ul class="toggle">
                    <li class="icn_tags"><a href="dashboard.php">Dashboard</a></li>
                    <li class="icn_tags"><a href="gcmalert/BroadcastMessage.php">GCM</a></li>
                    <li class="icn_tags"><a href="webservices.php">Web Services</a></li>
                    <li class="icn_tags"><a href="AddEventsDetails.php">Add Events</a></li>
                    <li class="icn_tags"><a href="ShowEventsDetails.php">Show All Events</a></li>
		</ul>
                
		
		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_profile"><a href="#">Your Profile</a></li>
			<li class="icn_jump_back"><a href="logout.php">Logout</a></li>
		</ul>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2014 Website Event Management</strong></p>
			<p>Created By <a href="http://rifatrashid.sitecloud.cytanium.com">Rifat Ahmmad Rashid</a></p>
		</footer>
	</aside><!-- end of sidebar -->
   
	
	<section id="main" class="column">
		
		<h4 class="alert_info">Welcome to the Alert Manager Admin Registration Page.</h4>
		
		<article class="module width_full">
			<header><h3>Stats</h3></header>
                      
                        <div class="module_content">
                            <h4 class="alert_success">Registration successful!</h4>
                            <p>You can now go back to the <a href="admin_dashboard.php">Dashboard</a> and log in later.</p>
                        </div>
                
			<div class="module_content">
				
				
				
			<div class="clear"></div>
			</div>
		</article><!-- end of stats article -->
		
		
		
		
	
                
                
                
               
		<div class="clear"></div>
		
		<div class="spacer"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
	</section>


</body>

</html>