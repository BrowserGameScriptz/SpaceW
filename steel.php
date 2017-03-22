<?php require ($_SERVER['DOCUMENT_ROOT'].'/header.php');?>

<script src="/upgrade.js"></script>
<h1>THIS IS YOUR STEEL FACTORY!</h1>
<img width="256" height="256" src="/images/Steel.jpg" />
<p> Level <?php echo $stats["steel_produce"];?></p>

<?php
$steelRequired = $stats["steel_produce"]*4*1.5;
$aluminiumRequired = $stats["steel_produce"]*4*2;
$populationRequired = $stats["steel_produce"]*25;
$timeSpent = $stats["steel_produce"]*5;
?>

<p>Requirements for upgrading to level <?php echo $stats["steel_produce"]+1;?>:
<br />

Steel: <?php echo $steelRequired;?> |
Aluminium: <?php echo $aluminiumRequired;?> |
Population: <?php echo $populationRequired;?> |
Time: <?php echo $timeSpent;?></p>
<?php
if($steelRequired > $stats["steel_storage"] || $aluminiumRequired > $stats["aluminium_storage"] || $populationRequired > $stats["population"]){
	echo 'not enough resources';
}else{
	echo '<button onclick="upgradeSteel(' . $stats["id"] . ',' . $userid . ')">Upgrade</button>';
}
?>

<?php require ($_SERVER['DOCUMENT_ROOT'].'/footer.php');?>