<?php
	session_start();
	if(!isset($_SESSION['id'])) {
		header("Location: index.php");
		exit();
	}
	require_once('db.php');
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$sql = "UPDATE users SET name='".$name."', email='".$email."', password='".$password."' WHERE id=".$_SESSION['id'];
	if ($conn->query($sql) === TRUE) {
		header("Location: profile.php");
		exit();
	} else {
		echo "Error updating record: " . $conn->error;
	}
	$conn->close();
?>
