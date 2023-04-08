<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<form action="login.php" method="post">
		<h2>Login</h2>
		<label>Email:</label>
		<input type="email" name="email" required>
		<label>Password:</label>
		<input type="password" name="password" required>
		<input type="submit" value="Login">
	</form>
</body>
</html>