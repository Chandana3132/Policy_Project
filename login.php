<!DOCTYPE html>
<html>
	<head>
		<title>Digital Tourist Guide | Login</title>
		<?php
			include 'links.php';
		?>
	</head>
	<body>
		<?php include 'navbar.php'; ?>
		<div class="login">
			<h1>Admin Login</h1>
			<div class="login_inputs">
				<form method="POST" action="logincheck.php">
					Username : <input type="text" name="username" class="inputs" placeholder="Enter Username"><br><br>
					Password : <input type="password" name="password" class="inputs" placeholder="Enter Password"><br><br>
					<input type="submit" name="submit" value="LOGIN">
				</form>
			</div>
		</div>
	</body>
</html>