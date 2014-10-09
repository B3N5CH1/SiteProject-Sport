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
            
			
			
			<!-- Search table -->
			<table border="1">
			<form method="POST">
            <table  style="background-color:silver;width:200px" class="table table-hover" border="2" cellpadding="2">
                <tr>
                    <td>Sportart</td>
                    <td>
                        <select name="sportart">
                            <option value="Fussball"> Fussball</option>
                            <option value="Basketball">Basketball</option>
                            <option value="Handball">Handball</option>
                            <option value="Volleyball">Volleyball</option>
                            <option value="Tennis">Tennis</option>
                            <option value="Rugby">Rugby</option>
                            <option value="Table tennis">Table tennis</option>
                            <option value="Squash">Squash</option>
                            <option value="Ice Hockey">Ice Hockey</option>
                            <option value="Luge">Luge</option>
                            <option value="Skeleton">Skeleton</option>
                            <option value="Alpine Skiing">Alpine Skiing</option>
                            <option value="Freestyle Skiing">Freestyle Skiing</option>
                            <option value="Speed Skating">Speed Skating</option>
                            <option value="Baseball">Baseball</option>
                            <option value="Cricket">Cricket</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Region</td>
					<td>
						<select name="region">
							<option value="Europa">Europa</option>
							<option value="America">America</option>
							<option value="Asien">Asien</option>
							<option value="Afrika">Afrika</option>
						</select>
					</td>
				</tr>
                <tr>
                    <td>Stichwort</td>
                    <td><input type="text" name="keyword" /></td>
                </tr>
				<tr>
                    <td>Date from</td>
                    <td><input type="text" name="datefrom" /></td>
                </tr>
				<tr>
                    <td>Date to</td>
                    <td><input type="text" name="dateto" /></td>
                </tr>
				
            </table>	
				<input type=submit name=send value="Suchen">
				<input type="reset" />
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
					dbList($sql);
				}
            ?>
			
			
			
           
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
            
			<!-- List of all events -->
            <table border="1">
                <?php 
                
                //require_once('php/connect.php');
                
                $Connect = mysqli_connect("localhost", "bsport", "PHArU6yU", "evts");

                $sql = "SELECT * FROM events";
 
                $db_erg = mysqli_query( $Connect, $sql );
                if ( ! $db_erg )
                {
                    die('Ungültige Abfrage: ' . mysqli_error($Connect));
                }
                    while ($zeile = mysqli_fetch_array( $db_erg, MYSQL_ASSOC))
                    {
                        echo "<h3>". $zeile['title'] . " findet am ". $zeile['jahr'] . ".". $zeile['monat'] . ".". $zeile['tag'] . ". um ". $zeile['stunde'] . ":". $zeile['minute'] . " statt.</h3>";
                    }
					
					//Showing an event on map
					
					
					
					//in development
					
					
					
                ?>
            
            </table>
			
			
            <br><br><br><br>
        </div>
		</div>
    </body>
</html>
