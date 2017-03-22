<?php require ($_SERVER['DOCUMENT_ROOT'].'/header.php');?>
	
	<h1><?php echo $stats["name"];?></h1>
	
	<table>
		<tr>
			<td>
				<a href="steel.php">
				<img align="center" src="/images/Steel.png" width="256" height="256"/>
				<br/> 
				<p align="center">Steel factory</p>
				</a>
			</td>
			<td>
				<a href="aluminium.php">
				<img align="center" src="/images/Aluminium.jpg" width="256" height="256"/>
				<br/> 
				<p align="center">Aluminium factory</p>
				</a>
			</td>
			<td>
				<a href="uranium.php">
				<img align="center" src="/images/Uranium.jpg" width="256" height="256"/>
				<br/> 
				<p align="center">Uranium factory</p>
				</a>
			</td>
		</tr>
		<tr>
			<td>
				<a href="farm.php">
				<img align="center" src="/images/Farm.jpg" width="256" height="256"/>
				<br/> 
				<p align="center">Farms</p>
				</a>
			</td>
			<td>
				<a href="shipyard.php">
				<img align="center" src="/images/default.jpg" width="256" height="256"/>
				<br/> 
				<p align="center">Shipyard</p>
				</a>
			</td>
			<td>
				<a href="defense.php">
				<img align="center" src="/images/OrbitalDefense.jpg" width="256" height="256"/>
				<br/> 
				<p align="center">Orbital Defenses</p>
				</a>
			</td>
		</tr>
	</table>
<?php require ($_SERVER['DOCUMENT_ROOT'].'/footer.php');?>