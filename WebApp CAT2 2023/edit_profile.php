<?php
	session_start();
	// Redirect user to login page if not logged in
	if(!isset($_SESSION['id'])) {
		header("Location: index.php");
		exit();
	}

	require_once('db.php');

	// Get user details from database
	$stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
	$stmt->bind_param("i", $_SESSION['id']);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		$name = $row['name'];
		$email = $row['email'];
	} else {
		echo "User not found.";
		exit();
	}

	// Handle form submission
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		// Validate form input
		if (empty($name) || empty($email) || empty($password)) {
			$error = "All fields are required.";
		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error = "Invalid email format.";
		} else {
			// Update user details in database
			$stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
			$stmt->bind_param("sssi", $name, $email, $password, $_SESSION['id']);
			if ($stmt->execute()) {
				$message = "Profile updated successfully.";
			} else {
				$error = "Error updating profile: " . $conn->error;
			}
		}
	}

	$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<h2>Edit Profile</h2>
		<?php if (isset($error)) { ?>
			<div class="error"><?php echo $error; ?></div>
		<?php } ?>
		<?php if (isset($message)) { ?>
			<div class="message"><?php echo $message; ?></div>
		<?php } ?>
		<form method="post">
			<label>Name:</label>
			<input type="text" name="name" value="<?php echo $name; ?>" required>
			<label>Email:</label>
			<input type="email" name="email" value="<?php echo $email; ?>" required>
			<label>Password:</label>
			<input type="password" name="password" required>
			<input type="submit" value="Update">
		</form>
		<a href="profile.php">Cancel</a>
		<a href="logout.php">Logout</a>
	</div>
</body>
</html>
