<?php 
    /**
     * User class
     */
    class User {

        private $conn;
        private $username;
        private $fullname;

        public function __construct($conn, $username) {
            $this->conn = $conn;
            $this->username = $username;
        }

        public function getFirstnameAndLastName() {
            if (isset($this->fullname)) {
                return $this->fullname;
            } else {
                $query = mysqli_query($this->conn, "SELECT concat(firstName, ' ', lastName) as 'name' FROM users WHERE username='$this->username'");

                $row = mysqli_fetch_array($query);
    
                $this->fullname = $row['name'];
    
                return $this->fullname;
            }
        }
    }
?>