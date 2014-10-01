<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" href="leaflet/leaflet.css">
        <script language="javascript" type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script language="javascript" type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.3/moment.js"></script>
        <script language="javascript" type="text/javascript" src="js/bootstrap.js"></script>
        <link rel="stylesheet" href="https://raw.githubusercontent.com/Eonasdan/bootstrap-datetimepicker/master/build/css/bootstrap-datetimepicker.css">
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
                            <a class="navbar-brand" href="index.php">Home</a>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href="submit.php">Veranstaltung eintragen</a></li>
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
                $year = $_POST['Jahr'];
                $month = $_POST['Monat'];
                $day = $_POST['Tag'];
                $hour = $_POST['Stunde'];
                $minutes = $_POST['Minute'];

                if(isset($sent)){
                    $sql = "INSERT INTO `".$table."` (`id` ,`title`, `description` , `sportart`, `continent`, `reach`, `adress`, `zip`,                         `city`, `jahr`, `monat`, `tag`, `stunde`, `minute`) 
                    VALUES 
                    ('', '".$title."', '".$descript."', '".$sportart."', '".$continent."', '".$reach."', '".$adress."', '".$zip."',                             '".$city."', '".$year."', '".$month."', '".$day."', '".$hour."', '".$minutes."');";
                    dbDo($sql);
                }

            ?>	
            
            <h1>
                Deine Veranstaltung wurde eingetragen!
            </h1>
            <h2>
                Vielen Dank!
            </h2>
            
        </div>
    </body>
</html>