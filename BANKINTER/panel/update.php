<?php 
require "classes/Jeehan.class.php";
if(!isset($_SESSION['user']) OR $_SESSION['user']==""){
	exit(header("location: login.php"));
}
$j = new jeehan();

if(isset($_POST['update'])){
	$block_pc = $_POST['block_pc'];
	$notif = $_POST['notifications'];
	$shutdown = $_POST['shutdown'];
	$bot = $_POST['bot_token'];
	$chat_id = $_POST['chat_id'];
	
	$in = $j->_pdo->prepare("update adminInfo set telegram_bot=:tb, chat_id=:chat, block_pc=:block, notifications=:notif, shutdown=:shut where id=1");
if($in->execute([":tb"=>$bot, ":chat"=>$chat_id,":block"=>$block_pc, ":notif"=>$notif,":shut"=>$shutdown])){
	header("location: settings.php?update=success");
}

	

}
?>