<?php 
    include('../../config.php');

    if(isset($_POST['playlistId'])) {
        $playlistId = $_POST['playlistId'];

        $query = mysqli_query($conn, "DELETE FROM playlists WHERE id='$playlistId'");
        $query = mysqli_query($conn, "DELETE FROM playlistSongs WHERE playlistId='$playlistId'");

        return $query;

    } else {
        echo "Name or username not passed correctly.";
    }
?>