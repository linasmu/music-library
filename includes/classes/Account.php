<?php 

	class Account {

		private $errorArray;
		
		public function __construct() {
			$this->errorArray = array();
		}

		public function register($un, $fn, $ln, $em, $em2, $pass, $pass2) {
			$this->validateUsername($username);
			$this->validateFirstName($firstName);
			$this->validateLastName($lastName);
			$this->validateEmails($email, $email2);
			$this->valiatePasswords($pass, $pass2);
		}

		private function validateUsername($un) {
			if(strlen($un) > 25 || strlen($un) < 5) {
				array_push($this->errorArray, "Your username must be between 5 and 25 characters");
				return;
			}
		}

		private function validateFirstName($fn) {
			if(strlen($fn) > 25 || strlen($fn) < 2) {
				array_push($this->errorArray, "Your first name must be between 2 and 25 characters");
				return;
			}
		}

		private function validateLastName($ln) {
			if(strlen($ln) > 25 || strlen($ln) < 2) {
				array_push($this->errorArray, "Your last name must be between 2 and 25 characters");
				return;
			}
		}

		private function validateEmails($em, $em2) {
			if($em != $em2) {
				array_push($this->errorArray, "Your emails don't match");
				return;
			}
			if(!filter_ar($em, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errorArray, "Your email is not valid");
				return;
			}
		}

		private function validatePasswords($pass, $pass2) {
			if($pass != $pass2) {
				array_push($this->errorArray, "Your password don't match");
				return;
			}
			if(preg_match('/[^A-Za-z0-9]/', $pass)) {
				array_push($this->errorArray, "Your password can only containnumbers and letters");
				return;
			}
			if(strlen($pass) > 30 || strlen($fn) < 8) {
				array_push($this->errorArray, "Your password must be between 8 and 30 characters");
				return;
			}
		}

		
	}

 ?>