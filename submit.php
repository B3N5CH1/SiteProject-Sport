<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/leaflet.css">
        <title>
            Broadsport.ch
        </title>
		
    </head>
    
    <body>
		
        <div class="container">
            <p></p>
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collabse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.html">Home</a>
                    </div>
                </div>
            </nav>
            
            <h2>Eigene Veranstaltung eintragen</h2>
            <p>
            Hier kannst Du eine neue Veranstaltung eintragen.
            </p>
            <table  style="background-color:silver" class="table table-hover" border="2" cellpadding="2">
				<form method="POST" action="submit.php">
                <tr>
                    <td>Titel</td>
                    <td><input type="text" name="Titel" /></td>
                </tr>
                <tr>
                    <td>Kurze beschreibung</td>
                    <td><input type="text" name="Kurze_beschreibung"/></td>
                </tr>
                <tr>
                    <td>Sportart</td>
                    <td>
                        <select name="sportart">
                            <option value="Football">Football</option>
                            <option value="Basketball">Basketball</option>
                            <option value="Handball">Handball</option>
                            <option value="Volleyball">Volleyball</option>
                            <option value="Tennis">Tennis</option>
                            <option value="Rugby">Rugby</option>
                            <option value="Table tennis">Table tennis</option>
                            <option value="Squash">Squash</option>
                            <option value="Ice Hockey">Ice Hocky</option>
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
                    <td>Kontinent</td>
                    <td>
                        <select name="continent">
                            <option value="Europa">Europa</option>
                            <option value="America">America</option>
                            <option value="Asien">Asien</option>
                            <option value="Afrika">Afrika</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Reichweite</td>
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
                    <td>Adresse</td>
                    <td><input type="text" name="Adresse" /></td>
                </tr>
                <tr>
                    <td>PLZ</td>
                    <td><input type="text" name="PLZ" /></td>
                </tr>
                <tr>
                    <td>Stadt</td>
                    <td><input type="text" name="Stadt" /></td>
                </tr>
                <tr>
                    <td>Datum</td>
                    <td><input type="date" name="Datum"/></td>
                </tr>
                <tr>
                    <td>Uhrzeit</td>
                    <td><input type="time" name="Uhrzeit"/></td>
                </tr>
				<input type=submit name=send value="Send!">
				</form>
            </table>	
			
			
<?php	

require_once('php/connect.php');

$table = "events";
$sent = $_POST['send'];
$title = $_POST['Titel'];
$descript = $_POST['Kurze_beschreibung'];
$sportart = $_POST['sportart'];
$continent = $_POST['continent'];
$reach = $_POST['reichweite'];
$adress = $_POST['Adresse'];
$zip = $_POST['PLZ'];
$city = $_POST['Stadt'];
$dte = $_POST['Datum'];
$time = $_POST['Uhrzeit'];

if(isset($sent)){

		$sql = "INSERT INTO `".$table."` (`id` ,`title`, `description` , `sportart`, `continent`, `reach`, `adress`, `zip`, `city`) 
			VALUES 
			('', '".$title."', '".$descript."', '".$sportart."', '".$continent."', '".$reach."', '".$adress."', '".$zip."', '".$city."');";
		dbDo($sql);
}

?>	
			
			
			
			
			
			
			
				<input type="reset" />
            
            <!-- Map -->
            <div id="map" height="180"></div>
            <script src="js/leaflet.js"></script>
            <script>
                // create a map in the "map" div, set the view to a given place and zoom
                var map = L.map('map').setView([51.505, -0.09], 13);

                // add an OpenStreetMap tile layer
                L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // add a marker in the given location, attach some popup content to it and open the popup
                L.marker([51.5, -0.09]).addTo(map)
                .bindPopup('A pretty CSS3 popup. <br> Easily customizable.')
                .openPopup();
                console.log(map);
            </script>
            
            
            <!-- Map 2.0 -->
            
            <br><br><br><br>
        </div>
    </body>
</html>