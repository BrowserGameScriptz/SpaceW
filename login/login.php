<?php
require ($_SERVER['DOCUMENT_ROOT'].'/dbconnect.php');

if(!isset($_POST["username"]) || $_POST["username"] == ""){
	die("username empty");
}
if(!isset($_POST["password"]) || $_POST["password"] == ""){
	die("password empty");
}

$sql = 'SELECT * FROM `users` WHERE username="' . $_POST["username"] . '"';
$result = $conn->query($sql);
$user = $result->fetch_assoc();
if($result->num_rows >= 1){
	if($user["password"] == $_POST["password"]){
		setcookie(
  "id",
  $user["id"],
  time() + (10 * 365 * 24 * 60 * 60)
	);
		header('Location: /index.php');
	}else{
		die("wrong password, stop hacking...");
	}
}else{
	die ("user doesn't exist");
}
?>