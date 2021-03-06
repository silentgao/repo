<!doctype html>
<html lang="en">
<?php

session_start();

if(!isset($_SESSION['username']) || !isset($_SESSION['password'])){
    
    header('Location: index.php');
}

$flag=$_SESSION['flag'];
   

?>
<head>
	<meta charset="utf-8"/>
	<title>Alert Admin Panel</title>
	
	<link rel="stylesheet" href="../css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
        <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="../js/hideshow.js" type="text/javascript"></script>
	<script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
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
          /*  $(document).ready(function(){
               
            });
            function sendPushNotification(){
                var data = $('form1#').serialize();
                $('form1#'.unbind('submit');                
                $.ajax({
                    url: "send_message_broadcast.php",
                    type: 'GET',
                    data: data,
                    beforeSend: function() {
                        
                    },
                    success: function(data, textStatus, xhr) {
                          $('.txt_message').val("");
                          alert("messgae send");
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        
                    }
                });
                return false;
            }*/
    
            function saveData() {
                 
                    document.myform.submit();

            }
        
        
    
        </script>

</head>


<body>
    
     <header id="header">
		<hgroup>
			<h1 class="site_title"><a href="#">Broadcasting</a></h1>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
                     
			<p><?php echo htmlentities($_SESSION['username']); ?></p>
                        <a class="logout_user" href="../logout_a.php" title="Logout">Logout</a>
		</div>
		<div class="breadcrumbs_container">
                    <article class="breadcrumbs">
                        <a href="../admin_dashboard.php">Dashboard</a> 
                        <div class="breadcrumb_divider"></div> 
                        <a class="current" href="gcmalert/BroadcastMessage.php">GCM</a>
                        <div class="breadcrumb_divider"></div> 
                        <a class="current" href="../webservices.php">Web Services</a>
                        <div class="breadcrumb_divider"></div> 
                        <a class="current" href="../ShowEventsDetails.php">Show All Events</a>
                        <div class="breadcrumb_divider"></div> 
                        <a class="current" href="../AddEventsDetails.php">Add Events</a>
                    
                    </article>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<form class="quick_search">
			
		</form>
		<hr/>
		
		<h3>Users</h3>
		<ul class="toggle">
                    <li class="icn_add_user"><a href="../registrationv2.php">Add New User</a></li>
                    <li class="icn_view_users"><a href="../viewUsers2.php">View Users</a></li>
                    
		</ul>
                
                <h3>Options</h3>
		<ul class="toggle">
                    <li class="icn_tags"><a href="../admin_dashboard.php">Dashboard</a></li>
                    <li class="icn_tags"><a href="../gcmalert/BroadcastMessage.php">GCM</a></li>
                    <li class="icn_tags"><a href="../webservices.php">Web Services</a></li>
                    <li class="icn_tags"><a href="../AddEventsDetails.php">Add Events</a></li>
                    <li class="icn_tags"><a href="../ShowEventsDetails.php">Show All Events</a></li>
		</ul>
                
		
		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_profile"><a href="../profile.php">Profile</a></li>
                        <li class="icn_jump_back"><a href="../logout_a.php">Logout</a></li>
		</ul>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2014 Website Event Management</strong></p>
			<p>Created By <a href="http://rifatrashid.sitecloud.cytanium.com">Rifat Ahmmad Rashid</a></p>
		</footer>
	</aside><!-- end of sidebar -->
        
	
	<section id="main" class="column">
		
		<h4 class="alert_info">Broadcasting Events & Details to all registered users.</h4>
		
		<article class="module width_3_quarter">
			<header><h3>Broadcast Messages</h3></header>
                        <form id="form1" name="myform" method="post" action='push_event_db.php'>
                  
				<div class="module_content">
						<fieldset>
							<label>Event</label>
                                           		<input type="text" name="type">
						</fieldset>
						<fieldset>
							<label>Description</label>
							<textarea rows="12" name="description"></textarea>
						</fieldset>
					
				</div>
                                  
                                <footer>
                                            <div class="submit_link">
                                     <!--   <input type="hidden" name="regId" value=<?php //echo $row["regid"] ?>"/>-->
                               
                                            <input type="submit" value="Broadcast" class="alt_btn" onclick="saveData()">
                                             
                                       </div>
                                </footer>
                       </form>
		</article><!-- end of post new article -->
		
		 <?php
        include_once 'db_functions.php';
        $db = new DB_Functions();
        $users = $db->getAllUsers();
        if ($users != false)
            $no_of_users = mysql_num_rows($users);
        else
            $no_of_users = 0;
        ?>

		<article class="module width_quarter">
			<header><h3>GCM Users</h3></header>
                        
                        <?php
                         if ($no_of_users > 0) {
                        ?>
              
                        
			<div class="message_list">
			<?php
                            while ($row = mysql_fetch_array($users)) {
                        ?>
                            <div class="module_content">
					<div class="message"><p>User:</p>
					<p><strong><?php echo $row["name"] ?></strong></p></div>
                            </div>
                        <?php }
                        }  ?> 
			</div>
			<footer>
				
			</footer>
		</article><!-- end of messages article -->
		
		<div class="clear"></div>
		
		
		
		
		
		<div class="spacer"></div>
	</section>


</body>

</html>