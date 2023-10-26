<?php 
    include('../../config.php');

    if(isset($_POST['name']) && isset($_POST['username'])) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $date = date('Y-m-d h:i:s');

        $query = mysqli_query($conn, "INSERT INTO playlists VALUES('', '$name', '$username', '$date')");

        return $query;

    } else {
        echo "Name or username not passed correctly.";
    }
?>