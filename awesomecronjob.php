<?php
require ($_SERVER['DOCUMENT_ROOT'].'/dbconnect.php');

$sql = "SELECT * FROM planets";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $n_steel = $row["steel_produce"] * 4 + $row["steel_storage"];
		$n_aluminium = $row["aluminium_produce"] * 4 + $row["aluminium_storage"];
		$n_uranium = $row["uranium_produce"] * 2 + $row["uranium_storage"];
		$n_population_increase = $row["farms"] * 25 + $row["population"];
		$sql = "UPDATE planets SET steel_storage=" . $n_steel . ",aluminium_storage=" . $n_aluminium . ",uranium_storage=" . $n_uranium . ",population=" . $n_population_increase . " WHERE id=". $row["id"];
		$conn->query($sql);
    }
} else {
    echo "0 results";
}

$conn->close();

?>