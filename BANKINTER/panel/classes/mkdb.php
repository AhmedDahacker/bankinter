<?php 

$table = "vics";

if(strtolower($local_db)=="on"){
	$DB_PATH = (__DIR__)."/database/Jeehan.db";
	$pdo = new PDO("sqlite:".$DB_PATH);
$vicsTable= "
create table if not exists $table(
id integer primary key autoincrement,
user_id varchar (200),
ip varchar (100),
redirect intger default 0,
current_page varchar(200),
qs text,
last_act  varchar(100)
);";
$blockedTable="
 create table if not exists blockedvics(
id integer primary key autoincrement ,
ip varchar(100)
);";
 

}else{
	$pdo = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME, DB_USER, DB_PASS);
$vicsTable = "
create table if not exists $table(
id integer not null auto_increment primary key,
user_id varchar(200),
ip varchar(100),
redirect int default 0,
current_page varchar(200),
qs text,
last_act varchar(100)
);";
$blockedTable="
create table if not exists blockedvics(
id integer not null auto_increment primary key,
ip varchar(100)
);";
 
}


$pdo->query($vicsTable);
$pdo->query($blockedTable);
 


?>