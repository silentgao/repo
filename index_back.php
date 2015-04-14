<!doctype html>
<?php
include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start();
?>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Alert Admin Panel</title>
	
	<link rel="stylesheet" href="css/layout_admin.css" type="text/css" media="screen" />
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
</script>

</head>


<body>
 <?php //if (login_check($mysqli) == true) : ?>
	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index1.html">Website Admin</a></h1>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
                     
			<p><?php echo htmlentities($_SESSION['username']); ?></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
                    <article class="breadcrumbs">
                        <a href="index.php">Admin Panel</a> 
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
			<input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>
		
		<h3>Users</h3>
		<ul class="toggle">
                    <li class="icn_add_user"><a href="registrationv2.php">Add New User</a></li>
			<li class="icn_view_users"><a href="#">View Users</a></li>
			<li class="icn_profile"><a href="#">Your Profile</a></li>
		</ul>
                
                <h3>Options</h3>
		<ul class="toggle">
                    <li class="icn_tags"><a href="registrationv2.php">Admin Panel</a></li>
                    <li class="icn_tags"><a href="gcmalert/BroadcastMessage.php">GCM</a></li>
                    <li class="icn_tags"><a href="#">Web Services</a></li>
                    <li class="icn_tags"><a href="#">Add Events</a></li>
                    <li class="icn_tags"><a href="#">Show All Events</a></li>
		</ul>
                
		
		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_settings"><a href="#">Options</a></li>
			<li class="icn_security"><a href="#">Security</a></li>
                        <li class="icn_jump_back"><a href="logout.php">Logout</a></li>
		</ul>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2014 Website Alert Management</strong></p>
			<p>Created By <a href="http://rifatrashid.sitecloud.cytanium.com">Rifat Ahmmad Rashid</a></p>
		</footer>
	</aside><!-- end of sidebar -->
        
        
       <?php
        $username='adminATg4ITy';
        $password='SWhKUmLMAtYZ';
        $database='eventmanager';
        $connection=mysql_connect ('127.4.86.2:3306', $username, $password);
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
		
		<h4 class="alert_info">Welcome to the Manager Admin Panel.</h4>
		
		<article class="module width_full">
			<header><h3>Stats</h3></header>
                        <article class="module width_3_quarter">
                        <div class="module_content">
                           <h4>For Add New Event visit: <a href="AddEventsDetails.php">Add Event Details</a></h4>
                           <h4>For View Event visit: <a href="ShowEventsDetails.php.php">Show Details</a></h4>
                        </div>
                            </article>
			<div class="module_content">
				
				
				<article class="stats_overview">
					<div class="overview_today">
						<p class="overview_day">No of GCM Users</p>
						<p class="overview_count"><?php echo $count_gcm;?></p>
                        <p class="overview_type">Users</p>
                    </div>
					<div class="overview_previous">
						<p class="overview_day">Registered Events</p>
						<p class="overview_count"><?php echo $count;?></p>
						<p class="overview_type">Events</p>
						
					</div>
				</article>
				<div class="clear"></div>
			</div>
		</article><!-- end of stats article -->
		
		<article class="module width_full">
                 
                 <?php        
        $connection=mysql_connect ('127.4.86.2:3306', $username, $password);
        if (!$connection) {
         die('Not connected : ' . mysql_error());
        }

    // Set the active mySQL database
        $db_selected = mysql_select_db($database, $connection);
         if (!$db_selected) {
            die ('Can\'t use db : ' . mysql_error());
        }

        // Select all the rows in the markers table
        $query = "SELECT * FROM eventsdetails WHERE 1";
        $result = mysql_query($query);
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        $count=1;
        ?>    
                    
		<header>
                <h3 class="tabs_involved">Event Management</h3>
		
		</header>
       
		
			<table class="tablesorter" cellspacing="0"> 
                           <thead> 
				<tr> 
   				<th>Select</th> 
    				<th>Event Name</th> 
    				<th>Category</th> 
    				<th>Created On</th> 
    				<th>Actions</th> 
				</tr> 
                            </thead>
                         </table>
			<div class="message_list">
                             <table class="tablesorter" cellspacing="0"> 
                             
                            <?php 
                           while ($row = @mysql_fetch_assoc($result)){
                            ?>
				<!--<div class="module_content">
					<div class="message"><p>User:</p>
					<p><strong>Message</strong></p></div>
				</div>-->
                                <tr> 
   				<td><input type="checkbox"></td> 
                                <td><?php echo $row["name"];?></td> 
    				<td><?php echo $row["type"];?></td> 
    				<td><?php echo $row["startdate"];?></td> 
    				<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr> 
                            <?php }?>
                                </table>
			</div>
   		</article><!-- end of content manager article -->
		
		<article class="module width_full">
                    
		<header>
                <h3 class="tabs_involved">GCM Management</h3>
		
		</header>
         <?php           
        $connection=mysql_connect ('127.4.86.2:3306', $username, $password);
        if (!$connection) {
         die('Not connected : ' . mysql_error());
        }

    // Set the active mySQL database
        $db_selected = mysql_select_db($database, $connection);
         if (!$db_selected) {
            die ('Can\'t use db : ' . mysql_error());
        }

        // Select all the rows in the markers table
        $query = "SELECT * FROM gcmalert WHERE 1";
        $result = mysql_query($query);
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        $count=1;
        ?>
		
			<table class="tablesorter" cellspacing="0"> 
                           <thead> 
				<tr> 
   				<th>Select</th> 
    				<th>User Name</th> 
    				<th>Registration ID</th> 
    				<th>    </th>
                                <th>    </th>
    				<th>Actions</th> 
				</tr>  
                            </thead>
                         </table>
			<div class="message_list">
                             <table class="tablesorter" cellspacing="0"> 
                             
                          <?php 
                           while ($row = @mysql_fetch_assoc($result)){
                            ?>
				<tr> 
   				<td><input type="checkbox"></td> 
    				<td style="width: 100px"><?php echo $row["name"];?></td> 
    				<td><?php echo "   ";?></td> 
                                <td style="width: 200px"><?php echo $row["regid"];?></td> 
                                <td><?php echo "   ";?></td>
    				<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr> 
                                <?php } ?>
                                </table>
			</div>
   		</article><!-- end of content manager article -->
		
		<div class="clear"></div>
		
		<div class="spacer"></div>
         
	</section>
        <?php //else : ?>
        
      <!--  <article class="module width_full">
			
                      
                        <div class="module_content">
                            <h4 class="alert_warning">You are not authorized to access this page.</h4>
                            <p>Please <a href="index.php">login</a>.</p>
                        </div>
                
			<div class="module_content">
				
				
				
			<div class="clear"></div>
			</div>
		</article><!-- end of stats article -->
		
            
       <?php //endif; ?>
      
</body>

</html>