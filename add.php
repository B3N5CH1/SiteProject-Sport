<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" href="leaflet/leaflet.css">
        <script language="javascript" type="text/javascript" src="js/bootstrap.js"></script>
        <title>
            Broadsport.ch
        </title>
		
    </head>
    
    <body>
		
        <div class="container">
            <p></p>
            
            
            
            <?php	

                require_once('php/connect.php');

                $table = "events";
                $sent = $_POST['send'];
                $title = htmlentities($_POST['Titel']);
                $descript = htmlentities($_POST['Beschreibung']);
                $sportart = htmlentities($_POST['sportart']);
                $continent = htmlentities($_POST['continent']);
                $reach = htmlentities($_POST['reichweite']);
                $adress = htmlentities($_POST['Adresse']);
                $zip = htmlentities($_POST['PLZ']);
                $city = htmlentities($_POST['Stadt']);
                $year = htmlentities($_POST['Jahr']);
                $month = htmlentities($_POST['Monat']);
                $day = htmlentities($_POST['Tag']);
                $hour = htmlentities($_POST['Stunde']);
                $minutes = htmlentities($_POST['Minute']);
                $errors = array();
                $leapYear = array(2016, 2020, 2024, 2028, 2032, 2036, 2040);
                $longestMonth = array(01, 03, 05, 07, 08, 10, 12);
                
                if (isset($sent)) {
                    
                    //variablen auf Inhalt prüfen und ggf. den Fehler (hier einfach der Feldname) in das Array $errors packen.
                    if ($title == '') {
                        $errors[] = 'Kein Titel';
                    }
                    
                    if ($descript == '') {
                        $errors[] = 'Keine Beschreibung';
                    } 
                    
                    if ($day == '' || (!($day>=1 && $day<=31))) {
                        $errors[] = 'Kein Tag bzw. limitiert 01-31';
                    }
                    
                    if (($year == '') || (!($year>=2014 && $year<=2040))) {
                        $errors[] = 'Kein Jahr bzw. max. bei 2040';
                    }
                    
                    if ($month == '' || (!($month>=1 && $month<=12))) {
                        $errors[] = 'Kein Monat';
                    } else {
                        if (!(in_array($month, $longestMonth))) {
                           if ($month == 02) {
                                if  ((in_array($year, $possibleYear)) && ($day > 29)) {
                                    $errors[] = 'Unmöglicher Tag => Das eingegebene Jahr ist ein Schaltjahr (max. 29 Tage)';
                                } else {
                                    if ((!(in_array($year, $possibleYear))) && ($day > 28)) {
                                        $errors[] = 'Unmöglicher Tag => Das eingegebene Jahr ist kein Schaltjahr';
                                    }
                                }
                            }
                        } else {
                            if ($day > 31) {
                                $errors[] = 'Unmöglicher Tag';
                            }
                        }
                    }
                    
                    if ($hour == '' || (!($hour>=0 && $hour<=24))) {
                        $errors[] = 'Keine Stunde, bzw. 00-24';
                    }
                    
                    if ($minutes == '') {
                        $errors[] = 'Keine Minute';
                    } else {
                        if (!($minutes>=0 && $minutes<60)) {
                            $errors[] = 'Inkorrekte Minuten';    
                        }
                    }
                    
                    if (count($errors)==0) {
                        $sql = "INSERT INTO `".$table."` 
                            (`id` ,`title`, `description` ,
                            `sportart`, `continent`, `reach`,
                            `adress`, `zip`, `city`,
                            `jahr`, `monat`, `tag`,
                            `stunde`, `minute`) 
                        VALUES 
                            ('', '".$title."', '".$descript."',
                            '".$sportart."', '".$continent."', '".$reach."',
                            '".$adress."', '".$zip."', '".$city."',
                            '".$year."', '".$month."', '".$day."',
                            '".$hour."', '".$minutes."');";
                        dbDo($sql);
                        header("Location: /success.php");
                    } else {
                        echo '<br>Folgende Fehler traten auf:<br>' . implode('<br>', $errors);
                    }
                }

            ?>
            
            
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
								<li><a href="search.php">Suche</a></li>
                                <li><a href="About.html">About</a></li>
                            </ul>
                            <!-- <form class="navbar-form navbar-left" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                            </form> -->
                        </div>
                    </div>
                </div>
            </nav>
            
            
            
            <br>
            <h2>Eigene Veranstaltung eintragen</h2>
            <p>
            Hier kannst Du eine neue Veranstaltung eintragen.
            </p>
            <form method="POST" action="add.php">
            <table  style="background-color:silver" class="table table-hover" border="2" cellpadding="2">
				
                <tr>
                    <td>
                        Titel*
                    </td>
                    <td>
                        <input type="text" name="Titel" value="<?php echo $title ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Kurze beschreibung*
                    </td>
                    <td>
                        <input type="text" name="Beschreibung" value="<?php echo $descript ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Webseite des Veranstalters
                    </td>
                    <td>
                        <input type="text" name="Webseite" value="<?php echo $_website; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Sportart
                    </td>
                    <td>
                        <select name="sportart">
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
                            <option value="Andere">Anderes</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Kontinent
                    </td>
                    <td>
                        <select name="continent">
                            <option value="Europa">Europa</option>
                            <option value="America">Amerika</option>
                            <option value="Asien">Asien</option>
                            <option value="Afrika">Afrika</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Reichweite
                    </td>
                    <td>
                        <select name="reichweite">
                            <option value="Lokal">Lokal</option>
                            <option value="National">National</option>
                            <option value="Kontinental">Kontinental</option>
                            <option value="Weltweit">Weltweit</option>
                            <option value="Olympisch">Olympisch</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Adresse
                    </td>
                    <td>
                        <input type="text" name="Adresse" />
                    </td>
                </tr>
                <tr>
                    <td>
                        PLZ
                    </td>
                    <td>
                        <input type="text" name="PLZ" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Stadt
                    </td>
                    <td>
                        <input type="text" name="Stadt" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Datum (JJJJ-MM-TT)*
                    </td>
                    <td>
                        <input type="text" name="Jahr" maxlength="4" size="3" value="<?php echo $year ?>"/>
                        &nbsp;
                        <input type="text" name="Monat" maxlength="2" size="1" value="<?php echo $month ?>"/>
                        &nbsp;
                        <input type="text" name="Tag" maxlength="2" size="1" value="<?php echo $day ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Uhrzeit (SS-HH)*
                    </td>
                    <td>
                        <input type="text" name="Stunde" maxlength="2" size="1" value="<?php echo $hour ?>"/>
                        &nbsp;
                        <input type="text" name="Minute" maxlength="2" size="1" value="<?php echo $minutes ?>"/>
                    </td>
                </tr>
				
				
            </table>	         
            
            <!-- Map 2.0 -->
            <div id="map" style="height: 250px;"></div>
            <script src="leaflet/leaflet.js"></script>
            <script>
            var map = L.map('map').setView([46.951083, 7.438639], 16);
                
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 18
                }).addTo(map);
				
			
			var new_event_marker;

			map.on('click', function(e) {

			if(typeof(new_event_marker)==='undefined')
			{
				new_event_marker = new L.marker(e.latlng,{ draggable: true}).bindPopup('Event Position');
				new_event_marker.addTo(map);        
			}
			else 
			{
				new_event_marker.setLatLng(e.latlng);         
			}
			});
            </script>
                
            <br>
            <input type=submit name=send value="Send">
			<input type="reset" />
            </form>
            
            
            <br><br><br><br>
        </div>
    </body>
</html>