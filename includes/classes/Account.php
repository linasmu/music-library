<?php 

	class Account {

		private $con;
		private $errorArray;
		
		public function __construct($con) {
			$this->con = $con;
			$this->errorArray = array();
		}

		public function login($un, $pass) {
			$pass = md5($pass);
			$query = mysqli_query($this->con, "SELECT * FROM users WHERE username = '$un' AND password = '$pass'");
			if(mysqli_num_rows($query) == 1) {
				return true;
			} else {
				array_push($this->errorArray, Constants::$loginFailed);
				return false;
			}
		}

		public function register($un, $fn, $ln, $em, $em2, $pass, $pass2) {
			$this->validateUsername($un);
			$this->validateFirstName($fn);
			$this->validateLastName($ln);
			$this->validateEmails($em, $em2);
			$this->validatePasswords($pass, $pass2);

			if(empty($this->errorArray) == true) {
				return $this->insertUserDetails($un, $fn, $ln, $em, $pass);
			} else {
				return false;
			}
		}

		public function getError($error) {
			if(!in_array($error, $this->errorArray)) {
				$error = "";
			}
			return "<span class='errorMessage'>$error</span>";
		}

		private function insertUserDetails($un, $fn, $ln, $em, $pass) {
			$encryptedPass = md5($pass);
			$profilePic = "assets/images/profile-pics/hea_emerald.png";
			$date = date("Y-m-d");
			echo "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryptedPass', '$date', '$profilePic')";
			$result = mysqli_query($this->con, "INSERT INTO users (`username`, `firstName`, `lastName`, `email`, `password`, `signUpDate`, `profilePic`) VALUES ('$un', '$fn', '$ln', '$em', '$encryptedPass', '$date', '$profilePic')");
			return $result;
		}

		private function validateUsername($un) {
			if(strlen($un) > 25 || strlen($un) < 5) {
				array_push($this->errorArray, Constants::$usernameCharacters);
				return;
			}
			$checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username= '$un'");
			if(mysqli_num_rows($checkUsernameQuery) != 0) {
				array_push($this->errorArray, Constants::$usernameTaken);
				return;
			}
		}

		private function validateFirstName($fn) {
			if(strlen($fn) > 25 || strlen($fn) < 2) {
				array_push($this->errorArray, Constants::$firstNameCharacters);
				return;
			}
		}

		private function validateLastName($ln) {
			if(strlen($ln) > 25 || strlen($ln) < 2) {
				array_push($this->errorArray, Constants::$lastNameCharacters);
				return;
			}
		}

		private function validateEmails($em, $em2) {
			if($em != $em2) {
				array_push($this->errorArray, Constants::$emailsDoNotMatch);
				return;
			}
			if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errorArray, Constants::$emailNotValid);
				return;
			}
			$checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email= '$em'");
			if(mysqli_num_rows($checkEmailQuery) != 0) {
				array_push($this->errorArray, Constants::$emailTaken);
				return;
			}
		}
		private function validatePasswords($pass, $pass2) {
			if($pass != $pass2) {
				array_push($this->errorArray, Constants::$passwordsDoNotMatch);
				return;
			}
			if(preg_match('/[^A-Za-z0-9]/', $pass)) {
				array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
				return;
			}
			if(strlen($pass) > 30 || strlen($pass) < 8) {
				array_push($this->errorArray, Constants::$passwordCharacters);
				return;
			}
		}

		
	}

 ?>