<?php 
    class Artist {
        private $conn;
        private $id;
        private $name;

        public function __construct($conn, $id) {
            $this->conn = $conn;
            $this->id = $id;
        }

        public function getName() {
            if (isset($this->name)) {
                return $this->name;
            } else {
                $artistQuery = mysqli_query($this->conn, "SELECT name FROM artists WHERE id='$this->id'");
                $artist = mysqli_fetch_array($artistQuery);

                if ($artist) {
                    $this->setName($artist['name']);
                    return $this->name;
                }
            }
        }

        private function setName($name) {
            $this->name = $name;
        }
    }
?>