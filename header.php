<?php
ob_start();
session_start();

require_once ($_SERVER['DOCUMENT_ROOT'].'/dbconnect.php');

if( !isset($_SESSION['user']) ) {
    header("Location: index.php");
    exit;
}

$userid = $_SESSION["user"];

$res= $conn->query ("SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow = $res->fetch_assoc();


$sql = "SELECT * FROM `planets` WHERE owner=" . $userid;
$result = $conn->query($sql);

if(isset($_SESSION["planet"])){
    $selectedPlanet = $_SESSION["planet"];
}else{
    $selectedPlanet = 1;
    $_SESSION["planet"] = 1;
}
$totalPlanets = $result->num_rows;
if($totalPlanets > 0){
    if($selectedPlanet <= $totalPlanets){
        for($row = 0;$row < $totalPlanets;$row++){
            if($selectedPlanet-1 == $row){
                $stats = $result->fetch_assoc();
                $name[$row+1] = $stats["name"];
            }else{
                $unusedstats = $result->fetch_assoc();
                $name[$row+1] = $unusedstats["name"];
                unset($unusedstats);
            }

        }
    }else {
        $_SESSION["planet"] = 1;
        header('Location: /home.php');
    }
}else {
    die("broken user. Errorcode: b4n4n4");
}

$sql = "SELECT * FROM `upgrades` WHERE planetid=" . $stats["id"];
$upgrades = $conn->query($sql);
$totalupgrades = $upgrades->num_rows;
if($totalupgrades > 0){
	for($i = 0;$i < $totalupgrades;$i++){
		$tempUpg = $upgrades->fetch_assoc();
		
		unset($tempUpg);
	}
}

$conn->close();
?>



<!DOCTYPE html>
<html>
<head>
<title>SPACEW</title>
<link rel="icon" href="/images/icon.png">
<link rel="stylesheet" href="/assets/style.css?v=<?php time();?>">

</head>
<body>

<audio controls autoplay style="display: none;">
  <source src="/sound/spaceship.wav" type="audio/wav">
</audio>

<div class="container">

<div id="settings">
<p>SpaceW |
    Logged in as: <?php echo $userRow["userName"];?> |
<a href="/login/logout.php?logout=1"">Log out</a>
</p>
</div>
<nav>
	<h1>Planets</h1>
	  <ul>
		<?php
		for ($i = 0;$i < $totalPlanets; $i++){
			$id = $i+1;
			echo '<li><a href="/home.php"><img width="64px" height="64px" src="/images/planets/planet' . rand(1,6) . '.jpg" /><br />' . $name[$i+1] . '</a></li>';
		}
		?>
	  </ul>
</nav>
	

<div id="main">
	<div>
		<p class="currentplanet">Current Planet: <?php echo $stats["name"];?> |</p>
		
		<p class="currentplanet tooltip">Steel: <?php echo $stats["steel_storage"];?>
		<span class="tooltiptext">Production: <?php echo $stats["steel_produce"]*4;?></span></p>
		|
		<p class="currentplanet tooltip">Aluminium: <?php echo $stats["aluminium_storage"];?>
		<span class="tooltiptext">Production: <?php echo $stats["aluminium_produce"]*4;?></span></p>
		|
		<p class="currentplanet tooltip">Uranium: <?php echo $stats["uranium_storage"];?>
		<span class="tooltiptext">Production: <?php echo $stats["uranium_produce"]*4;?></span></p>
		|
		<p class="currentplanet tooltip">Population: <?php echo $stats["population"];?>
		<span class="tooltiptext">Production: <?php echo $stats["farms"]*25;?></span></p>
	</div>