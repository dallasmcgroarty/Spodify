<?php 
    /**
     * Artist class
     */
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

        public function getSongIds() {
            $query = mysqli_query($this->conn, "SELECT id FROM songs WHERE artist='$this->id' ORDER BY plays DESC");

            $songArray = [];

            while ($row = mysqli_fetch_array($query)) {
                array_push($songArray, $row['id']);
            }

            return $songArray;
        }

        public function getId() {
            return $this->id;
        }
    }
?>