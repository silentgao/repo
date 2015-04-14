<!doctype html>
<?php

session_start();

if(!isset($_SESSION['username']) || !isset($_SESSION['password'])){
    
    header('Location: index.php');
}

$flag=$_SESSION['flag'];
   

?>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Event manager</title>
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
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
    
        function confirmation(ID,Name) {
            
            var answer = confirm("Delete entry "+Name+" ?")
            if (answer){
                    alert("Entry Deleted")
                    window.location = "deleteevents.php?name="+Name;
            }
            else{
                    alert("No action taken")
            }
        }
    </script>

</head>


<body>
 <?php if($flag) : ?>
	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="#">Web Services</a></h1>
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
        
        
       <?php
        $username='root';
        $password='';
        $database='eventmanager';
        $connection=mysql_connect ('localhost:3306', $username, $password);
        if (!$connection) {
         die('Not connected : ' . mysql_error());
        }

    // Set the active mySQL database
        $db_selected = mysql_select_db($database, $connection);
         if (!$db_selected) {
            die ('Can\'t use db : ' . mysql_error());
        }

        // Select all the rows in the markers table
        $query = "SELECT * FROM eventsdetails";
        $result = mysql_query($query);
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        $count=0;
        while ($row = @mysql_fetch_assoc($result)){
              $count++;
        }
        $query_gcm = "SELECT * FROM gcmalert";
        $result_gcm = mysql_query($query_gcm);
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
          $count_gcm=0;
          while ($row = @mysql_fetch_assoc($result_gcm)){
              $count_gcm++;
          }  
          
        ?>

	<section id="main" class="column">
		
		<h4 class="alert_info">All Webservices informations.</h4>
		<article class="module width_full">
		<header><h3>Point Of Interest Webservice</h3></header>
                
                    <div class="module_content">     
                    <p>Point of interest webservice provide facebook and foursquare social media combined information maped with with following </p>
                    <p>Category based decision tree : <a href="bootstrap_working_code/index4.php">Decision Tree</a></p>
                    <p>For fetching data using the following link: http://eventmanager-irmatripplanner.rhcloud.com/POI/POI_database_xml.php</p>
                    <p>For Testing :<a href="POI/POI_database_xml.php">POI</a></p>
                    </div>
                	
                </article><!-- end of messages article -->
	
		<article class="module width_full">
		<header><h3>Events Webservice</h3></header>
                
                    <div class="module_content">     
                    <p>For fetching Events information use the follow links:</p>
                    <p>http://eventmanager-irmatripplanner.rhcloud.com/GetEventsDetailsFromDatabase.php</p>
                    <p>For Testing :<a href="http://eventmanager-irmatripplanner.rhcloud.com/GetEventsDetailsFromDatabase.php">Events</a></p>
                    </div>
                	
                </article><!-- end of messages article -->
		
                
		<div class="clear"></div>
		
		<div class="spacer"></div>
         
	</section>
        <?php else : ?>
        
        <article class="module width_full">
			
                      
                        <div class="module_content">
                            <h4 class="alert_warning">You are not authorized to access this page.</h4>
                            <p>Please <a href="index.php">login</a>.</p>
                        </div>
                
			<div class="module_content">
				
				
				
			<div class="clear"></div>
			</div>
		</article><!-- end of stats article -->
		
            
       <?php endif; ?>
      
</body>

</html>