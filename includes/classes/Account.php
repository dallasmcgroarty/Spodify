<?php 
    class Account {

        private $conn;
        private $errorArray;

        public function __construct($conn) {
            $this->conn = $conn;
            $this->errorArray = array();
        }

        public function login($un, $pass) {
            $pass = md5($pass);

            $query = mysqli_query($this->conn, "SELECT * FROM users WHERE username='$un' AND password='$pass'");

            if (mysqli_num_rows($query) == 1) {
                return true;
            } else {
                array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }

        public function register($username, $firstName, $lastName, $email, $email2, $password, $password2) {
            $this->validateUsername($username);
            $this->validateFirstname($firstName);
            $this->validateLastname($lastName);
            $this->validateEmails($email, $email2);
            $this->validatePasswords($password, $password2);

            if (empty($this->errorArray)) {
                // insert into db
                return $this->insertUserDetails($username, $firstName, $lastName, $email, $password);
            } else {
                return false;
            }
        }

        public function getError($error) {
            if (!in_array($error, $this->errorArray)) {
                $error = '';
            }

            return "<span class='error-message'>$error</span>";
        }

        private function insertUserDetails($un, $fn, $ln, $em, $pass) {
            $encryptedPw = md5($pass);
            $profilePic = "assets/images/profilePictures/profilepic-default.png";
            $date = date("Y-m-d");

            $result = mysqli_query($this->conn, "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')");

            return $result;
        }

        private function validateUsername($un) {
            if (strlen($un) > 25 || strlen($un) < 5) {
                array_push($this->errorArray, 'Your username must be between 5 and 25 characters.');
                return;
            }

            $checkUsernameQuery = mysqli_query($this->conn, "SELECT username FROM users WHERE username='$un'");
            if (mysqli_num_rows($checkUsernameQuery) != 0) {
                array_push($this->errorArray, Constants::$usernameTaken);
                return;
            }
        }
    
        private function validateFirstname($fn) {
            if (strlen($fn) > 25 || strlen($fn) < 2) {
                array_push($this->errorArray, 'Your first name must be between 2 and 25 characters.');
                return;
            }

            if (!ctype_alpha($fn)) {
                array_push($this->errorArray, 'Your first name can only contain alphabetic character(s).');
                return;
            }
        }
    
        private function validateLastname($ln) {
            if (strlen($ln) > 25 || strlen($ln) < 2) {
                array_push($this->errorArray, 'Your last name must be between 2 and 25 characters.');
                return;
            }

            if (!ctype_alpha($ln)) {
                array_push($this->errorArray, 'Your last name can only contain alphabetic character(s).');
                return;
            }
        }
    
        private function validateEmails($em, $em2) {
            if ($em !== $em2) {
                array_push($this->errorArray, 'Your emails do not match.');
                return;
            }

            if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, 'Your email is invalid.');
                return;
            }

            $checkEmailQuery = mysqli_query($this->conn, "SELECT email FROM users WHERE email='$em'");
            if (mysqli_num_rows($checkEmailQuery) != 0) {
                array_push($this->errorArray, Constants::$emailTaken);
                return;
            }
        }
    
        private function validatePasswords($pass, $pass2) {
            if ($pass !== $pass2) {
                array_push($this->errorArray, 'Your passwords do not match.');
                return;
            }

            if (strlen($pass) > 30 || strlen($pass) < 5) {
                array_push($this->errorArray, 'Your password must be between 5 and 30 characters.');
                return;
            }
        }
    }
?>