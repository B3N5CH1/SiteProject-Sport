<html>
	<head> 
        <title>Broadsport - Sportveranstaltungen in der Nähe</title>
        <meta charset="utf-8">
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css" >
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="leaflet/leaflet.css">
	</head>
	<body>
        <div class="container">
            <p></p>
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collabse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="index.php">Home</a>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href="add.php">Veranstaltung eintragen</a></li>
                                <li><a href="about.html">About</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            
            <br>
            <h1>Broadsport - Sportveranstaltungen in der Nähe</h1>
            <h2>News / Updates</h2>
            
            <!-- Map 2.0 -->
            <?php
                require_once('php/connect.php');
                
                $myquery = "
                    SELECT  `lat`, `lng` FROM  `events`
                    WHERE `lat` <> 0
                ";
                $query = mysql_query($myquery);
    
                if ( ! $query ) {
                    echo mysql_error();
                    die;
                }
    
                $data = array();
                
            ?>
            
            <div id="map" style="height: 400px"></div>
            
			<script src="leaflet/leaflet.js"></script>
			
            <script>
            var map = L.map('map').setView([46.951083, 7.438639], 16);
                
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 18
                }).addTo(map);
				
            <?php
                  echo "var planelatlong = [";
    
                for ($x = 0; $x < mysql_num_rows($query); $x++) {
                    $data[] = mysql_fetch_assoc($query);
                    echo "[",$data[$x]['lat'],",",$data[$x]['lng'],"]";
                    if ($x <= (mysql_num_rows($query)-2) ) {
                        echo ",";
                    }
                }

                echo "];";
            ?>
                
            for (var i = 0; i < planelatlong.length; i++) {
			marker = new L.marker([planelatlong[i][0],planelatlong[i][1]])
				.addTo(map);
            }
            </script>
      
            <br><br><br><br>
        </div>
		</div>
    </body>
</html>
