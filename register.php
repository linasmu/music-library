<!DOCTYPE html>

<?php 
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($con);

	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");

	function getInputValue($name) {
		if(isset($_POST[$name])) {
			echo$_POST[$name];
		}
	}
 ?>
<html>
<head>
	<title>Welcome to Your music</title>
	<link rel="stylesheet" href="style.css" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
	<script src="js/register.js"></script>
</head>
<body>

<?php
if(isset($_POST['registerButton'])) {
	echo '<script>
	$(document).ready(function() {
		$("#loginForm").hide();
		$("#registerForm").show();
		
	});
</script>';
} else {
	echo '<script>
	$(document).ready(function() {
		$("#loginForm").show();
		$("#registerForm").hide();
		
	});
</script>';
}
?>

<div id="background">

	<div id="loginContainer">

	<div id="inputContainer">
		<form id="loginForm" action="register.php" method="POST">
			<h2>Login to your music</h2>
			<p>
				<?php echo $account->getError(Constants::$loginFailed); ?>
				<label for="loginUsername">Username</label>
				<input id="loginUsername" type="text" name="loginUsername" placeholder="Your username" value="<?php getInputValue('loginUsername')?>" required>	
			</p>
			<p>
				<label for="loginPassword">Password</label>
				<input id="loginPassword" type="password" name="loginPassword" placeholder="Password" required>
			</p>

			<button type="submit" name="loginButton">Log in</button>

			<div class="hasAccountText">
				<span id="hideLogin">Don't have an account yet? Signup here.</span>
			</div>
		</form>

		<form id="registerForm" action="register.php" method="POST">
			<h2>Create free account</h2>
			<p>
				<?php echo $account->getError(Constants::$usernameCharacters); ?>
				<?php echo $account->getError(Constants::$usernameTaken); ?>
				<label for="username">Username</label>
				<input id="username" type="text" name="username" value="<?php getInputValue('username'); ?>" placeholder="Your username"  required>	
			</p>

			<p>
				<?php echo $account->getError(Constants::$firstNameCharacters); ?>
				<label for="firstName">First name</label>
				<input id="firstName" type="text" name="firstName" value="<?php getInputValue('firstName'); ?>" placeholder="Your first name" required>	
			</p>

			<p>
				<?php echo $account->getError(Constants::$lastNameCharacters); ?>
				<label for="lastName">Last name</label>
				<input id="lastName" type="text" name="lastName" value="<?php getInputValue('lastName'); ?>" placeholder="Your last name" required>	
			</p>

			<p>
				<?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
				<?php echo $account->getError(Constants::$emailNotValid); ?>
				<?php echo $account->getError(Constants::$emailTaken); ?>
				<label for="email">Email</label>
				<input id="email" type="text" name="email" value="<?php getInputValue('email'); ?>" placeholder="Your email" required>	
			</p>

			<p>
				<label for="email2">Confirm email</label>
				<input id="email2" type="email" name="email2" value="<?php getInputValue('email2'); ?>" placeholder="Confirm email" required>	
			</p>


			<p>
				<?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
				<?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
				<?php echo $account->getError(Constants::$passwordCharacters); ?>
				<label for="password">Password</label>
				<input id="password" type="password" name="password" placeholder="Password" required>
			</p>

			<p>
				<label for="password2">Confirm password</label>
				<input id="password2" type="password" name="password2" placeholder="Confirm password" required>
			</p>

			<button type="submit" name="registerButton">Sign up</button>

			<div class="hasAccountText">
				<span id="hideRegister">Alresdy have an acount? Log in here.</span>
			</div>
		</form>
	</div>

	<div id="loginText">
		<h1>Get great music, right now</h1>
		<h2>Listen to tons of music for free</h2>
		<ul>
			<li>Know what you want to listen to? Just search and hit play.</li>
			<li>Check out the latest charts, brand new releases and great playlists for right now.</li>
			<li>Enjoy new music every Monday with your own personal playlist. Or sit back and enjoy Radio.</li>
		</ul>
	</div>	
	</div>
</div>
</body>
</html>