<?php

//User credentials
$Host = "localhost"; 
$User = "bsport";      
$Passwd = "PHArU6yU";    
$DBName = "evts";     

$Connect = mysql_connect($Host, $User, $Passwd, $DBName);

//Makes a query to the DB
function dbDo($command, $message="") {
	$result=@mysql_query($command);
	if($message) echo '<br>'.$message;
	if (!$result) {
		if($message) echo " - ";
		echo "Error:<br>".mysql_error();
		echo "<br>->".$command."<-<br>";
	}
	return $result;
}

//Lists all database contains
function dbList($param="") {
	if($param) {
		$nrows=@mysql_num_rows($param);
		if($nrows) $result = $param;
		else {
			$sql="SELECT * FROM ".$param;
			$result = dbDo($sql);
		}
	}
	if($result) {
		$nrows=mysql_num_rows($result);
		echo "<br>Gefunden:<br>";
		for ($i = 0; $i < $nrows; $i++) {
			$line = mysql_fetch_row($result);
			for($j = 0; $j < sizeof($line); $j++) 
				echo $line[$j].' ';
			echo '<br>';
			//print_r($line);
		}
		echo "<br>";
	}
	return result;
}

//Lists specific broadsport search results
function dbListSearchResults($param="") {
	if($param) {
		$nrows=@mysql_num_rows($param);
		if($nrows) $result = $param;
		else {
			$sql="SELECT `title`, `description`, `sportart`, `continent`, `reach`, `jahr`, `monat`, `tag`, `stunde`, `minute`, `website` FROM ".$param;
			$result = dbDo($sql);
		}
	}
	if($result) {
		$nrows=mysql_num_rows($result);
		echo "<br>Gefunden:<br>";
		for ($i = 0; $i < $nrows; $i++) {
			$line = mysql_fetch_row($result);
			for($j = 0; $j < sizeof($line); $j++) 
				echo $line[$j].' ';
			echo '<br>';
			//print_r($line);
		}
		echo "<br>";
	}
	return result;
}

dbDo("SET character_set_client='cp1251'");
dbDo("SET character_set_results='cp1251'");
dbDo("SET collation_connection='cp1251_general_ci'");
dbDo('use '.$DBName);//"database opening");
?>