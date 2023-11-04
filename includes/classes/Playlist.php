<?php 
    /**
     * Playlist class
     */
    class Playlist {
        private $conn;
        private $id;
        private $name;
        private $owner;

        public function __construct($conn, $data) {
            if (!is_array($data)) {
                $query = mysqli_query($conn, "SELECT * FROM playlists WHERE id='$data'");
                $data = mysqli_fetch_array($query);
            }

            $this->conn = $conn;
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->owner = $data['owner'];
        }

        public function getName() {
            return $this->name;
        }

        public function getId() {
            return $this->id;
        }

        public function getOwner() {
            return $this->owner;
        }

        public function getNumberOfSongs() {
            $query = mysqli_query($this->conn, "SELECT songId FROM playlistsongs WHERE playlistId='$this->id'");
            return mysqli_num_rows($query);
        }

        public function getSongIds() {
            $query = mysqli_query($this->conn, "SELECT songId FROM playlistsongs WHERE playlistId='$this->id' ORDER BY playlistOrder ASC");

            $songArray = [];

            while ($row = mysqli_fetch_array($query)) {
                array_push($songArray, $row['songId']);
            }

            return $songArray;
        }

        public static function getAllPlaylists($conn, $username) {
            $html = "";
            $query = mysqli_query($conn, "SELECT * FROM playlists WHERE owner='$username'");

            while ($row = mysqli_fetch_array($query)) {
                $id = $row['id'];
                $name = $row['name'];

                $html .= "<div class='item playlist-select-item' data-id='$id' onclick='addSongToPlaylist(this)'>$name</div>";
            }

            return $html;
        }
    }
?>