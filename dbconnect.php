<?php
$servername = "localhost";
$username = "id865681_depression";
$password = "crippling";
$dbname = "id865681_planets";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>