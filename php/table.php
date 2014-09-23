<html>
<head>
  <title>Table, that we should create</title>
</head>
<body>
<?php

require_once('connect.php');

//=====================================================

$table = "events";
$sql="DROP TABLE ".$table;
dbDo($sql, "Creating table events ".$table);
$sql="CREATE TABLE ".$table."
	(id int(10)     not null auto_increment,
	  TEXT,
	 pol TEXT,
	 lang_id int(30) not null,
     primary key (id),
	 foreign key (lang_id) references lang (id) on delete cascade on update cascade
	) ENGINE=InnoDB;";
if(dbDo($sql, "inserting into table ".$table)) {
	
	$sql = "INSERT INTO `".$table."` (`id` ,`faml`, `pol` , `lang_id`) 
			VALUES 
			('', 'Иванов', 'мужской', '1'),
			('', 'Петрова', 'женский', '2'),
			('', 'Сидорова', 'женский', '3')
			;";
	if(dbDo($sql, "внесение данных в таблицу ".$table))
		dbList($table);
}
/*
$table = "travels";
$sql="DROP TABLE ".$table;
dbDo($sql, "удаление таблицы ".$table);

$sql="CREATE TABLE ".$table."
	(id int(30)     not null auto_increment,
	 traveldate date not null,
	 manager_id int(30) not null,
	 country_id int(30) not null,
	 lang_id int(30) not null,
	 primary key (id),
	 foreign key (manager_id) references managers (id) on delete cascade on update cascade,
	 foreign key (country_id) references country (id) on delete cascade on update cascade
	) ENGINE=InnoDB;";

if(dbDo($sql, "создание таблицы ".$table)) {
	$sql = "INSERT INTO `".$table."` (`id` ,`traveldate`, `manager_id`, `country_id`, `lang_id` ) 
			VALUES ('', '".date("2005-01-03")."', '1', '1', '1'),
					('','".date("2005-01-15")."', '2', '2', '2'),
					('','".date("2005-02-02")."', '3', '1', '3'),
					('','".date("2005-02-05")."', '1', '3', '1'),
					('','".date("2005-02-14")."', '3', '4', '3'),
					('','".date("2005-04-04")."', '2', '1', '2')
					;";
	if(dbDo($sql, "внесение данных в таблицу ".$table))
		dbList($table);
}

$table = "country";
$sql="DROP TABLE ".$table;
dbDo($sql, "удаление таблицы ".$table);

$sql="CREATE TABLE ".$table."
	(id int(30)     not null auto_increment,
	 name TEXT,
	 primary key (id)
	 ) ENGINE=InnoDB;";

if(dbDo($sql, "создание таблицы ".$table)) {
	$sql = "INSERT INTO `".$table."` 
					(`id` , `name`) VALUES
					('', 	'Италия'),
					('', 	'Франция'),
					('', 	'Германия'),
					('', 	'Венгрия')
					;";
	if(dbDo($sql, "внесение данных в таблицу ".$table))
		dbList($table);
}

$table = "lang";
$sql="DROP TABLE ".$table;
dbDo($sql, "удаление таблицы ".$table);

$sql="CREATE TABLE ".$table."
	(id int(30)     not null auto_increment,
	 name TEXT,
	 primary key (id)
	 ) ENGINE=InnoDB;";

if(dbDo($sql, "создание таблицы ".$table)) {
	$sql = "INSERT INTO `".$table."` 
					(`id` , `name`) VALUES
					('', 	'английский'),
					('', 	'французский'),
					('', 	'немецкий')
					;";
	if(dbDo($sql, "внесение данных в таблицу ".$table))
		dbList($table);
}



*/
//======================================================
?>
</body>
</html>
