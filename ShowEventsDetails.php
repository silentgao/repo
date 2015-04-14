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
	<title>Event Manager Admin Panel</title>
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
       
        
        
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

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <script type="text/javascript">
    //<![CDATA[

    var customIcons = {
      restaurant: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
      },
      bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
      },
       accident: {
        icon: 'http://eventmanager-irmatripplanner.rhcloud.com/event/accident.png'
      },
       jam: {
        icon: 'http://eventmanager-irmatripplanner.rhcloud.com/event/trafficjam.png'
      },
       concert: {
        icon: 'http://eventmanager-irmatripplanner.rhcloud.com/event/concert.png'
      },
       market: {
        icon: 'http://eventmanager-irmatripplanner.rhcloud.com/event/market.png'
      },
       maintenance: {
        icon: 'http://eventmanager-irmatripplanner.rhcloud.com/event/repair.png'
      },
       party: {
        icon: 'http://eventmanager-irmatripplanner.rhcloud.com/event/party.png'
      },
       misc: {
        icon: 'http://eventmanager-irmatripplanner.rhcloud.com/event/fire.png'
      }
      
      
    };

    function load() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(45.1958975,9.1558951),
        zoom: 13,
        mapTypeId: 'roadmap'
      });
      var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP file
      downloadUrl("GetEventsDetailsFromDatabase.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var description = markers[i].getAttribute("Description");
          var type = markers[i].getAttribute("type");
          var starttime=markers[i].getAttribute("starttime");
          var startdate=markers[i].getAttribute("startdate");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<b>Event: " + name + "</b> <br/><b>Description: " + description+"</b><br/><b>Time: "+starttime+"</b><br/><b>Start Date :"+startdate+"</b>";
          var icon = customIcons[type] || {};
          //var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
            
            var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon:icon.icon// iconBase + 'schools_maps.png'
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

    //]]>

  </script>
  

</head>


<body  onload="load()">

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="#">Show Events Details</a></h1>
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
      <!--     <article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Content Manager</h3></header>
               
          		
           </article>
          -->  
          
          
        <article class="module width_3_quarter">
            <header><h3>Events</h3></header>
            
		<div class="module_content">
                    <div id="map" style="width: 640px; height: 400px"></div>
		</div>
            
            <footer>
				
            </footer>
	</article><!-- end of post new article -->
                
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
        $query = "SELECT * FROM eventsdetails WHERE 1";
        $result = mysql_query($query);
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        $count=1;
        ?>
        <article class="module width_quarter">
            <header><h3>All Events</h3></header>
		
            <div class="message_list" style="height: 450px">
                            <?php 
                           while ($row = @mysql_fetch_assoc($result)){?>
				<div class="module_content">
					<div class="message">
					<p><strong><?php echo $count++.". "."Event: ".$row["name"]."</br>"."Description: ".$row['description']."</br>"." Start Date & Time: ".$row['startdate']." ".$row['starttime']."</br>"."End Date & Time: ".$row['enddate']." ".$row['endtime'] ?></strong></p></div>
				</div>
                            
                            <?php } ?>
		</div>
			
	</article><!-- end of messages article -->
        
        
		<div class="clear"></div>
             
                <div class="spacer"></div>
             
		
		
        </section>


</body>

</html>