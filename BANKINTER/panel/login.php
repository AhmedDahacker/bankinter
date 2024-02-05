<?php 
session_start();
if(isset($_SESSION['user']) AND $_SESSION['user']!=""){
	header("location: index.php");
}
?>
<!doctype html>
<html>
<head>
<title>LCP - Log in</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width ">
<link rel="stylesheet" href="res/login.css">
<script src="res/jq.js"></script>
</head>
<body>
<div class="container">
<div class="form">
<div class="msg">
</div>
<div class="cols">
<h1>Live Control Panel - Log in</h1>
<div class="col">
<input type="text" class="textinput" id="username" placeholder="Username">
</div>
<div class="col">
<input type="password" class="textinput" id="password" placeholder="Password">
</div>
<div class="col">
<button class="sbmt" onclick="login()">Log In</button>
</div>
<div class="col" style="margin-top:30px;">
<a href="javascript:alert('Check config.php file.')" class="link">Don't hava login information?</a>
</div>
<div class="col" style="margin-top:30px; text-align:center; font-size:0.7em;">
</div>
</div>
</div>
</div>

<script>
$('.form').on('keydown', function (e) {
    var key = e.which;
    if(key == 13) {
        //alert("enter");
       login();
    }
});
function login(){
	$(".sbmt").html("Loging in...");
	var u = $("#username").val();
	var p = $("#password").val();
	if(u!="" && p!=""){
		$.post("process/log.php",{login:1, user:u, pass:p},function(done){
			if(done=="SUCCESS"){
				window.location="index.php";
			}else if(done=="FAILED"){
				alert("Incorrect Information!");
			}else{
				alert("Unknown Error.");
			}
			$(".sbmt").html("Log In");
		});
	}else{
		$(".sbmt").html("Log In");
		alert("Enter login information");
	}
}
</script>
</body>
</html>