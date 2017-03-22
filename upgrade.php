<?php
require ($_SERVER['DOCUMENT_ROOT'].'/dbconnect.php');
if( !isset($_GET['user']) ) {
	die("you're not logged in");
}else if (!isset($_GET["planetid"])){
	die("no planet defined");
}
$userid = $_GET["user"];
$planetid = $_GET["planetid"];

$sql = "SELECT * FROM `planets` WHERE id=" . $planetid;
$result = $conn->query($sql);
$stats = $result->fetch_assoc();
if($result->num_rows > 0){
if($stats["owner"] == $userid){
	if(isset($_GET["upgradeSteel"])){
		$steelRequired = $stats["steel_produce"]*6;
		$aluminiumRequired = $stats["steel_produce"]*8;
		$populationRequired = $stats["steel_produce"]*25;
		if($steelRequired < $stats["steel_storage"] && $aluminiumRequired < $stats["aluminium_storage"] && $populationRequired < $stats["population"]){
			$newSteelStorage = $stats["steel_storage"] - $steelRequired;
			$newAluminiumStorage = $stats["aluminium_storage"] - $aluminiumRequired;
			$newSteelProduce = $stats["steel_produce"] + 1;
			$newPopulation = $stats["population"] - $populationRequired;
			$sql = "UPDATE `planets` SET aluminium_storage=" . $newAluminiumStorage . ",steel_storage=" . $newSteelStorage . ",steel_produce=" . $newSteelProduce . ",population=" . $newPopulation . " WHERE id=" . $planetid;
			if ($conn->query($sql) === TRUE) {
				die("Upgraded Steel Production!");
			} else {
				die("didn't work. " . $conn->error);
}
		}else{
			die("not enough ressources");
		}
	}else if(isset($_GET["upgradeAluminium"])){
		die("you're shit");
	}else {
		die("unknown command");
	}
} else{
	die("you don't own this planet");
}
}else{
	die("planet doesn't exist");
}
?>