<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Your music</title>
</head>
<body>

	<div id="inputContainer">
		<form id="loginForm" action="register.php" method="POST">
			<h2>Login to your music</h2>
			<p>
				<label for="loginUsername">Username</label>
				<input id="loginUsername" type="text" name="loginUsername" placeholder="Your username" required>	
			</p>
			<p>
				<label for="loginPassword">Password</label>
			<input id="loginPassword" type="password" name="loginPassword" placeholder="Password" required>
			</p>

			<button type="submit" name="loginButton">Log in</button>
		</form>

		<form id="registerForm" action="register.php" method="POST">
			<h2>Create free account</h2>
			<p>
				<label for="username">Username</label>
				<input id="username" type="text" name="username" placeholder="Your username" required>	
			</p>

			<p>
				<label for="firstName">First name</label>
				<input id="firstName" type="text" name="firstName" placeholder="Your first name" required>	
			</p>

			<p>
				<label for="lastName">Last name</label>
				<input id="lastName" type="text" name="lastName" placeholder="Your last name" required>	
			</p>

			<p>
				<label for="email">Email</label>
				<input id="email" type="text" name="email" placeholder="Your email" required>	
			</p>

			<p>
				<label for="email2">Confirm email</label>
				<input id="email2" type="email" name="email2" placeholder="Confirm email" required>	
			</p>


			<p>
				<label for="password">Password</label>
				<input id="password" type="password" name="password" placeholder="Password" required>
			</p>

			<p>
				<label for="password2">Password</label>
				<input id="password2" type="password" name="password2" placeholder="Confitm password" required>
			</p>

			<button type="submit" name="registerButton">Sign up</button>
		</form>
	</div>
</body>
</html>