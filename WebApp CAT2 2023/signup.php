<!DOCTYPE html>
<html>
<head>
	<title>Signup Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<form action="register.php" method="post">
		<h2>Sign Up</h2>
		<label>Name:</label>
		<input type="text" name="name" required>
		<label>Email:</label>
		<input type="email" name="email" required>
		<label>Password:</label>
		<input type="password" name="password" required>
		<input type="submit" value="Sign Up">
	</form>
</body>
</html>