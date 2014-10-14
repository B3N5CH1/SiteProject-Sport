<html>
	<head> 
        <title>Broadsport - Sportveranstaltungen in der Nähe</title>
        <meta charset="utf-8">
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css" >
        <link type="text/css" rel="stylesheet" href="css/styles.css" >
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
            
			
			
			<!-- Search table -->
			<form method="POST">
                Sportart
					<select name="sportart">
                        <option value="*">Alle</option>
                        <option value="Fussball">Fusball</option>
                        <option value="Basketball">Basketball</option>
                        <option value="Handball">Handball</option>
                        <option value="Volleyball">Volleyball</option>
                        <option value="Tennis">Tennis</option>
                        <option value="Rugby">Rugby</option>
                        <option value="Tischtennis">Tischtennis</option>
                        <option value="Squash">Squash</option>
                        <option value="Eis Hockey">Eis Hockey</option>
                        <option value="Rennrodeln">Rennrodeln</option>
                        <option value="Skeleton">Skeleton</option>
                        <option value="Alpine Skiing">Alpine Skiing</option>
                        <option value="Freestyle Skiing">Freestyle Skiing</option>
                        <option value="Speed Skating">Eisschnelllauf</option>
                        <option value="Baseball">Baseball</option>
                        <option value="Cricket">Cricket</option>
                        <option value="eSport">eSport</option>
                        <option value="Andere">Anderes</option>
                    </select>
                Region
					<select name="region">
				        <option value="Europa">Europa</option>
                        <option value="America">Amerika</option>
                        <option value="Asien">Asien</option>
                        <option value="Afrika">Afrika</option>
				    </select>
				Stichwort
                    <input type="text" name="keyword" />
                
               <!-- Datum von
                <input type="text" name="datefrom"/>
                Datum bis<input type="text" name="dateto" /> -->
				<input type=submit name=send value="Suchen">
				<input type="reset" value="Zurücksetzen"/>
            </form>
			
            <br><br>
			
			<?php	
                require_once('php/connect.php');

				//Getting updated variables
				$table = "events";
				$sent = $_POST['send'];
				$keyword = $_POST['keyword'];
				$fromYear = $_POST['fromYear'];
				$fromMonth = $_POST['fromMonth'];
				$fromDay = $_POST['fromDay'];
				$toYear = $_POST['toYear'];
				$toMonth = $_POST['toMonth'];
				$toDay = $_POST['toDay'];
                $region = $_POST['region'];
                $sportart = $_POST['sportart'];
			
			    //If somebody has pressed a "send" button
				if(isset($sent)){
					//Search on Sportart
					$sql = "`".$table."` WHERE ";
					if(isset($sportart)){
						 $sql = $sql." sportart = '".$sportart."'";
					}
				
					//Search on Region
					if(isset($region)){
						$sql = $sql." AND continent = '".$region."'";
					}
				
					//Search on Keyword
					if(isset($keyword) && $keyword != ''){
						$sql = $sql." AND title LIKE '%".$keyword."%';";
					}
				
					//Still in development
					
					
					/*
					//Search on Date
					if(isset($datefrom) && isset($dateto)){
						$sql = $sql." AND date BETWEEN '".$fromYear."-".$fromMonth."-".$fromDay."' AND '".$toYear."-".$toMonthT."-".$toDay."';";
					} */
					dbListSearchResults($sql);
				}
            ?>
			
			
			
           
            <?php
                require_once('php/connect.php');
                
                $myquery = "
                    SELECT  `title`, `lat`, `lng` FROM  `events`
                    WHERE `lat` <> 0
                ";
                $query = mysql_query($myquery);
    
                if ( ! $query ) {
                    echo mysql_error();
                    die;
                }
    
                $data = array();
                
            ?>
            
			 <!-- Map 2.0 -->
            <div id="map" style="height: 400px"></div>
            
			<script src="leaflet/leaflet.js"></script>
			
            <script>
            var map = L.map('map').setView([46.801111, 8.226667], 7);
                
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 18
                }).addTo(map);
				
            <?php
                  echo "var planelatlong = [";
    
                for ($x = 0; $x < mysql_num_rows($query); $x++) {
                    $data[] = mysql_fetch_assoc($query);
                    echo "[\"",$data[$x]['title'],"\",",$data[$x]['lat'],",",$data[$x]['lng'],"]";
                    if ($x <= (mysql_num_rows($query)-2) ) {
                        echo ",";
                    }
                }

                echo "];";
            ?>
                
                
            for (var i = 0; i < planelatlong.length; i++) {
				marker = new L.marker([planelatlong[i][1],planelatlong[i][2]]);
                  
				marker.bindPopup(planelatlong[i][0]);
				marker.addTo(map);  
            }
            </script>
            
			<!-- List of all events -->
            
                <?php 
                
                require_once('php/connect.php');
                
                //$Connect = mysqli_connect("localhost", "bsport", "PHArU6yU", "evts");

                $sql = "SELECT * FROM events";
 
                $db_erg = mysql_query($sql );
                if ( ! $db_erg )
                {
                    die('Ungültige Abfrage: ' . mysql_error($Connect));
                }
                
                while ($zeile = mysql_fetch_object($db_erg))
                {
                    ?>
                    <br>
                    <form method="POST">
                        <table class="table table-hover" style="width:100%">
                            <tr>
                                <th style="width:65%">
                                    <?php
                                        echo $zeile->title;
										//Setting an index when executing loop
										$counter=$counter+1;
                                    ?>
                                </th>
                                <th style="width:25%">
                                    <?php
                                        echo $zeile->jahr;
                                        echo ".";
                                        if ($zeile->monat < 10) {
                                            echo "0";
                                        }
                                        echo $zeile->monat;
                                        echo ".";
                                        if ($zeile->tag < 10) {
                                            echo "0";
                                        }
                                        echo $zeile->tag; 
                                        echo ".";
                                    ?>
                                </th>
                                <th style="width:10%">
                                    <?php
                                        if ($zeile->stunde < 10) {
                                            echo "0";
                                        }
                                        echo $zeile->stunde;
                                        echo ":";
                                        if ($zeile->minute < 10) {
                                            echo "0";
                                        }
                                        echo $zeile->minute;
                                    ?>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                        echo $zeile->description;
                                    ?>
                                    <br>
                                    <?php
                                        echo $zeile->website;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo $zeile->sportart;
                                    ?>
                                    <br>
                                    <?php
                                        echo $zeile->continent;
                                    ?>
                                    <br>
                                    <?php
                                        echo $zeile->reach;
                                    ?>
                                </td>
                                <td>
                                    <?php
										//Getting access to the DB
										//require_once('php/connect.php');
												
                                        //echo "<input type=submit name='show' value='Anzeigen'>";
										//$show = $_POST['show'];
										//If a button is pressed, get lat and long from the database
										/*if(isset($show)){
											//Retrieving data for lat and long
											$latt = "SELECT `lat` FROM `events` WHERE events.id='".$counter."'";
											$long = "SELECT `lng` FROM `events` WHERE events.id='".$counter."'";
											dbDo($latt);
											print $latt;
											dbDo($long);
											print $long;
											//As soon as we get coordinates of chosen event, we can set a new wiew on map
											 ?>
											<!-- Map 2.0 -->
											<div id="map" style="height: 400px"></div>
            
											<script src="leaflet/leaflet.js"></script>
			
											<script>
											var map = L.map('map').setView([46.801111, 8.226667], 7);
                
											L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
											attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
											maxZoom: 18
											}).addTo(map);
											<?php
											}*/
                                    ?>
                                </td>
                            </tr>
                        </table>
					</form>
                    <?php
                    }
				?>
            
			
            <br><br><br><br>
        </div>
		</div>
    </body>
</html>
