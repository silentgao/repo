<!doctype html>
<html lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<title>Event Manager Admin Panel</title>
	
        <link rel="stylesheet" href="css/layout_long_side_bar.css.css" type="text/css" media="screen" />

        <script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
         
       
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <script src="http://jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>
   
  
    <script src="lib/moment.min.js"></script>
    <script src="lib/site.js"></script>
   <!-- <link rel="stylesheet" type="text/css" href="lib/site.css" />-->

    <script src="jquery.datepair.js"></script>

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
    var marker;
    var infowindow;

    function initialize() {
      var latlng = new google.maps.LatLng(45.1958975,9.1558951);
      var options = {
        zoom: 13,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }
      var map = new google.maps.Map(document.getElementById("map-canvas"), options);
      var html = "<table>" +
                 "<tr><td>Name:</td> <td><input type='text' id='name'/> </td> </tr>" +
                 "<tr><td>Description:</td> <td><input type='datetime' id='Description'/></td> </tr>" +
                 "<tr><p'>"+
                 "<tr><td>Start Date:</td><td><input type='text' id='Startdate' onfocus='startdate()'></td></tr>"+
                 "<tr><td>Start Time:</td><td><input type='text' id='StartTime' onfocus='starttime()'></td></tr>"+
                 "<tr><td>End Date:</td><td><input type='text' id='Enddate' onfocus='enddate()'></td></tr>"+
                 "<tr><td>End Time:</td><td><input type='text' id='EndTime' onfocus='endtime()'></td></tr>"+
                 "</p></tr>"+
                 "<tr><td>Type:</td> <td><select id='type'>" +
                 "<option value='accident' SELECTED>ACCIDENT</option>" +
                 "<option value='jam'>JAM</option>" +
                 "<option value='concert'>CONCERT</option>" +
                 "<option value='maintenance'>MAINTENANCE</option>" +
                 "<option value='market'>MARKET</option>" +
                 "<option value='misc'>MISC</option>" +
                 "</select> </td></tr>" +
                 "<tr><td></td><td><input type='button' value='Save & Close' onclick='saveData()'/></td></tr>";
    infowindow = new google.maps.InfoWindow({
     content: html
    });
 
    google.maps.event.addListener(map, "click", function(event) {
        
        marker = new google.maps.Marker({
          position: event.latLng,
          map: map
        });
        google.maps.event.addListener(marker, "click", function() {
          infowindow.open(map, marker);
        });
    });
    }

   function startdate(){
      $("#Startdate").datepicker({
        changeMonth: true,
        changeYear: true, 
        showButtonPanel: true,
    }).datepicker("setDate", new Date());
      /*  var $datepicker = $("#Startdate");
        $datepicker.datepicker({
        showButtonPanel: true,
        dateFormat: 'm-d-yy'
    });
     $datepicker.datepicker('setDate', new Date());*/
   }
   
    function enddate(){
      $("#Enddate").datepicker({
        changeMonth: true,
        changeYear: true, yearRange: '1950:+10'
    }).datepicker("setDate", new Date());
   }
   
  function starttime(){
      
   var now    = new Date();
   var hour   = now.getHours();
   var minute = now.getMinutes();
   var second = now.getSeconds();
   
   
   if (hour   < 10) { hour   = "0" + hour;   }
   if (minute < 10) { minute = "0" + minute; }
   if (second < 10) { second = "0" + second; }
   var timeString = hour + ':' + minute ;
   var x = $("#StartTime").val(timeString);
  }
  
   function endtime(){
      
   var now    = new Date();
   var hour   = now.getHours();
   var minute = now.getMinutes();
   var second = now.getSeconds();
   
   
   if (hour   < 10) { hour   = "0" + hour;   }
   if (minute < 10) { minute = "0" + minute; } 
   if (second < 10) { second = "0" + second; }
   var timeString = hour + ':' + minute ;
   var x = $("#EndTime").val(timeString);
  }
   
    function saveData() {
      var name = escape(document.getElementById("name").value);
      var address = escape(document.getElementById("Description").value);
      var type = document.getElementById("type").value;
      var latlng = marker.getPosition();
      var starttime=escape(document.getElementById("StartTime").value);
     var endtime=escape(document.getElementById("EndTime").value);
     var startdate=escape(document.getElementById("Startdate").value);
     var enddate=escape(document.getElementById("Enddate").value);
      var url = "AddEventDetailsToDatabase.php?name=" + name + "&Description=" + address +
                "&type=" + type + "&lat=" + latlng.lat() + "&lng=" + latlng.lng()+"&starttime="+starttime+"&endtime="+endtime+"&startdate="+startdate+"&enddate="+enddate;
        
      downloadUrl(url, function(data, responseCode) {
          alert("Event Added to List");
          infowindow.close();
          document.getElementById("message").innerHTML = "Location added.";
          location.reload();
      });
      
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request.responseText, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}
    </script>
  
<script type="text/javascript">
    //<![CDATA[

    var customIcons = {
      restaurant: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
      },
      bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
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
      downloadUrl2("GetEventsDetailsFromDatabase.php", function(data) {
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
            icon: icon.icon//iconBase //+ 'schools_maps.png'
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

    function downloadUrl2(url, callback) {
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

   function bothload(){
        load();
        initialize();
       
   }
  </script>
    
    
    
</head>


<body  onload="bothload()">

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index1.html">Admin Panel</a></h1>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>Rifat Abir</p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
                    <article class="breadcrumbs">
                        <a href="AddEventsDetails.php">Add Events</a> 
                        <div class="breadcrumb_divider"></div> 
                        <a class="current" href="ShowEventsDetails.php">Show All Events</a>
                        <div class="breadcrumb_divider"></div> 
                        <a class="current" href="ShowEventsDetails.php">Admin Panel</a>
                    
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
			<li class="icn_add_user"><a href="#">Add New User</a></li>
			<li class="icn_view_users"><a href="#">View Users</a></li>
			<li class="icn_profile"><a href="#">Your Profile</a></li>
		</ul>
		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_settings"><a href="#">Options</a></li>
			<li class="icn_security"><a href="#">Security</a></li>
			<li class="icn_jump_back"><a href="#">Logout</a></li>
		</ul>
		
                <ul class="toggle">
			
		</ul>
		<footer>
			<hr />
			
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
        $username='betaalert';
        $password='';
        $database='my_betaalert';
        $connection=mysql_connect ('localhost', $username, $password);
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
		<header><h3>All Events In Database</h3></header>
                     <div class="message_list">
                            <?php 
                            
                           while ($row = @mysql_fetch_assoc($result)){
                            ?>
				<div class="module_content">
					<div class="message">
					<p><strong><?php echo $count++.". "."Event: ".$row["name"]."</br>"."Description: ".$row['description']."</br>"."Date & Time: ".$row['startdate']." ".$row['starttime'] ?></strong></p></div>
				</div>
                            
                            <?php } ?>
		</div>
			
            </article><!-- end of messages article -->
                <article class="module width_3_quarter">
		<header><h3>Add Events</h3></header>
                    <div class="module_content">
                        <div id="map-canvas" style="width: 640px; height: 400px"></div>
                        <div id="message"></div>
                    </div>
		<footer>
				
		</footer>
	</article><!-- end of post new article -->
                
                
		<div class="clear"></div>
             
                <div class="spacer"></div>
              
		<section id="secondary_bar">
                  
                </section><!-- end of secondary bar -->
		
	
	</section>


</body>

</html>

