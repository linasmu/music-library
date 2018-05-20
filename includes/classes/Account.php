<?php 

	class Account {

		private $con;
		private $errorArray;
		
		public function __construct($con) {
			$this->con = $con
			$this->errorArray = array();
		}

		public function register($un, $fn, $ln, $em, $em2, $pass, $pass2) {
			$this->validateUsername($un);
			$this->validateFirstName($fn);
			$this->validateLastName($ln);
			$this->validateEmails($em, $ema2);
			$this->validatePasswords($pass, $pass2);

			if(empty($this->errorArray) == true) {
				return insertUserDetaisl($un, $fn, $ln, $em, $pass);
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

		private funtion insertUserDetaisl($un, $fn, $ln, $em, $pass) {
			$encryptedPass = md5($pass);
			$profilePic = "assets/images/profile-pics/hea_emerald.png";
			$date = date("Y-m-d");
			$reault = mysqli_query($this->con, "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryptedPass', '$date', '$profilePic')");
			return $result;
		}

		private function validateUsername($un) {
			if(strlen($un) > 25 || strlen($un) < 5) {
				array_push($this->errorArray, Constants::$usernameCharacters);
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
			if(strlen($pass) > 30 || strlen($fn) < 8) {
				array_push($this->errorArray, Constants::$passwordCharacters);
				return;
			}
		}

		
	}

 ?>