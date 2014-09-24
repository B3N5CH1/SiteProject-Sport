<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" href="leaflet/leaflet.css">
        <title>
            Broadsport.ch
        </title>
		
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
                            <a class="navbar-brand" href="index.html">Home</a>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href="submit.html">Veranstaltung eintragen</a></li>
                                <li><a href="About.html">About</a></li>
                                <!--<li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">One more separated link</a></li>
                                    </ul> -->
                                </li>
                            </ul>
                            <form class="navbar-form navbar-left" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                            </form> <!--
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#">Link</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </nav>
            
            <h2>Eigene Veranstaltung eintragen</h2>
            <p>
            Hier kannst Du eine neue Veranstaltung eintragen.
            </p>
            <form method="POST" action="submit.php">
            <table  style="background-color:silver" class="table table-hover" border="2" cellpadding="2">
				
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
				
				
            </table>	
			<input type=submit name=send value="Send!">
			<input type="reset" />
            </form>
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
			
			
			
			
			
			
			
				         
            
            <!-- Map 2.0 -->
            <br><br>
            <div id="map" style="height: 200px;"></div>
            <script src="leaflet/leaflet.js"></script>
            <script>
                var map = L.map('map').setView([46.951083, 7.438639], 16);
                
                L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                    maxZoom: 18
                }).addTo(map);
                
                L.marker([46.951083, 7.438639]).addTo(map)
                .bindPopup('ExWi-Gebäude UniB')
                .openPopup();
                console.log(map);
                
                
            </script>
            
            <br><br><br><br>
        </div>
    </body>
</html>