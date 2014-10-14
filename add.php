<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="css/styles.css" >
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
                
                //Variablen setzen entsprechend der Felder des Formulars.
                $table = "events";
                $sent = $_POST['send'];
                $title = htmlentities($_POST['Titel']);
                $descript = htmlentities($_POST['Beschreibung']);
                $sportart = htmlentities($_POST['sportart']);
                $continent = htmlentities($_POST['continent']);
                $reach = htmlentities($_POST['reichweite']);
                $year = htmlentities($_POST['Jahr']);
                $month = htmlentities($_POST['Monat']);
                $day = htmlentities($_POST['Tag']);
                $hour = htmlentities($_POST['Stunde']);
                $minutes = htmlentities($_POST['Minute']);
                $latitude = htmlentities($_POST['lat']);
                $longitude = htmlentities($_POST['lng']);
                $website = htmlentities($_POST['Webseite']);
                $errors = array();
                $leapYear = array(2016, 2020, 2024, 2028, 2032, 2036, 2040);
                $longestMonth = array(01, 03, 05, 07, 08, 10, 12);
                
                // Wenn der 'Senden' Button angeklickt wurde:
                if (isset($sent)) {
                    
                    //variablen auf Inhalt prüfen und ggf. den Fehler (hier einfach der Feldname) in das Array $errors packen.
                    if ($title == '') {
                        $errors[] = 'Kein Titel';
                    }
                    
                    if ($descript == '') {
                        $errors[] = 'Keine Beschreibung';
                    } 
                    
                    if ($day == '' || (!($day>=1 && $day<=31))) {
                        $errors[] = 'Kein Tag bzw. 01-31';
                    }
                    
                    if (($year == '') || (!($year>=2014 && $year<=2040))) {
                        $errors[] = 'Kein Jahr bzw. max. bei 2040';
                    }
                    
                    if ($month == '' || (!($month>=1 && $month<=12))) {
                        $errors[] = 'Kein Monat, bzw. 01-12';
                    } else {
                        if (!(in_array($month, $longestMonth))) {
                           if ($month == 02) {
                                if  ((in_array($year, $leapYear)) && ($day > 29)) {
                                    $errors[] = 'Unmöglicher Tag => Das eingegebene Jahr ist ein Schaltjahr (max. 29 Tage)';
                                } else {
                                    if ((!(in_array($year, $leapYear))) && ($day > 28)) {
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
                    
                    if ($minutes == '' || (!($minutes>=0 && $minutes<60))) {
                        $errors[] = 'Keine Minute, bzw. 00-60';
                    }
                    
                    if ($latitude == '') {
                        $errors[] = 'Kein Ort ausgewählt';
                    }
                    
                    // Wenn keine Fehler, Inhalt der Variablen an DB übermittlen und auf Success Seite weiterleiten, andernfalls die entsprechenden Fehler von oben ausdrucken.
                    if (count($errors)==0) {
                        $sql = "INSERT INTO `".$table."` 
                            (`title`, `description` ,
                            `sportart`, `continent`, `reach`,
                            `jahr`, `monat`, `tag`, `website`,
                            `stunde`, `minute`, `lat`, `lng`) 
                        VALUES 
                            ('".$title."', '".$descript."',
                            '".$sportart."', '".$continent."', '".$reach."',
                            '".$year."', '".$month."', '".$day."', '".$website."',
                            '".$hour."', '".$minutes."', '".$latitude."', '".$longitude."');";
                        dbDo($sql);
                        header("Location: /success.php");
                    } else {
                        echo '<br>Folgende Fehler traten auf:<br>' . implode('<br>', $errors);
                    }
                }

            ?>
            
            // Navigations Leiste
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
            <h2>
                Eigene Veranstaltung eintragen
            </h2>
            <p>
                Hier kannst Du eine neue Veranstaltung eintragen.
            </p>
            <!-- Formular um neue Veranstaltung einzutragen. PHP Code in input druckt den entsprechenden Wert der Variable ein,
            Sofern ein solcher bereits übertragen wurde (z.B. wenn ein Fehler aufgetreten ist.) -->
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
                            Webseite des Veranstalters (mit "http://")
                        </td>
                        <td>
                            <input type="text" name="Webseite" value="<?php echo $website ?>"/>
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
                                <option value="eSport">eSport</option>
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
                            Datum (JJJJ-MM-TT)*
                        </td>
                        <td>
                            <!-- Zeit und Datum wurden von Hand mit verschiedenen Input Felder gemacht,
                            Da Zeitformat des input type time nicht mit dem der DB übereingestummen hat. -->
                            <input type="text" name="Jahr" maxlength="4" size="3" value="<?php echo $year ?>"/>
                            &nbsp;
                            <input type="text" name="Monat" maxlength="2" size="1" value="<?php echo $month ?>"/>
                            &nbsp;
                            <input type="text" name="Tag" maxlength="2" size="1" value="<?php echo $day ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Uhrzeit (SS-MM)*
                        </td>
                        <td>
                            <input type="text" name="Stunde" maxlength="2" size="1" value="<?php echo $hour ?>"/>
                            &nbsp;
                            <input type="text" name="Minute" maxlength="2" size="1" value="<?php echo $minutes ?>"/>
                        </td>
                    </tr>
                </table>	         
                <h4 style="text-align:center">Klicke auf die Karte, um den Ort der Veranstaltung anzugeben.*</h4>
            
                <!-- Map 2.0 | Das Div, wohin die Karte geladen wird, anschliessend zwei versteckte inputs
                um den Wert der Länge und Breite zu speichern und an DB zu übertragen, anschliessend Sende-
                bzw. Zurücksetzbutton. -->
                <div id="map" style="height: 300px;width: 66%;margin:0 auto;"></div>
                <br>
                <input type="text" name="lat" id="lat" hidden="true" value="<?php echo $latitude ?>">
                <input type="text" name="lng" id="lng" hidden="true" value="<?php echo $longitude ?>">
                <div style="float:right">
                    <input type=submit name=send value="Abschicken">
                    <input type="reset" value="Zurücksetzen"/>
                </div>
            </form>
            
            
            <br><br><br><br>
        </div>
        <!-- Generiert die Karte -->
        <script src="leaflet/leaflet.js"></script>
        <script>
            var map = L.map('map').setView([46.801111, 8.226667], 7);
                
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 18
            }).addTo(map);
            // Falls bereits ein Ort angegeben wurde, und ein Fehler auftritt, wird der alte Ort
            // mit einem Marker auf der Karte eingetragen.
            <?php
                if (!($latitude == 0)) {
                    ?>
                    var marker = L.marker([<?php echo $latitude ?>,<?php echo $longitude ?>]).addTo(map);
                    <?php
                }
            ?>
            
			// Bei einem Klick auf die Karte wird (falls vorhanden) der alte Marker gelöscht,
            // und ein neuer gesetzt, die Werte Lat/Lng werden in das HTML Formular übertragen.
			var new_event_marker;

			map.on('click', function(e) {
                <?php
                    if (!($latitude == 0)) {
                        echo 'map.removeLayer(marker);';
                    }
                ?>
                if(typeof(new_event_marker)==='undefined') {
                    new_event_marker = new L.marker(e.latlng,{ draggable: true}).bindPopup('Event Position');
                    new_event_marker.addTo(map);        
                } else {
                    new_event_marker.setLatLng(e.latlng);         
                }
                console.log(e.latlng);
                var lat_input = document.getElementById("lat");
                var lng_input = document.getElementById("lng");
                lat_input.value = e.latlng.lat;
                lng_input.value = e.latlng.lng;
			});
        </script>
    </body>
</html>