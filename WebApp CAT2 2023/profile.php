<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php
		session_start();
		if(!isset($_SESSION['id'])) {
			header("Location: index.php");
			exit();
		}
		require_once('db.php');
		$sql = "SELECT * FROM users WHERE id = ".$_SESSION['id'];
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$name = $row['name'];
			$email = $row['email'];
		} else {
			echo "User not found.";
			exit();
		}
	?>
	<h2>Welcome, <?php echo $name; ?></h2>
	<p>Name: <?php echo $name; ?></p>
	<p>Email: <?php echo $email; ?></p>
	<a href="edit_profile.php">Edit Profile</a>
	<a href="logout.php">Logout</a>
</body>
</html>
