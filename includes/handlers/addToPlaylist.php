<?php 
    include('../../config.php');

    if(isset($_POST['playlistId']) && isset($_POST['songId'])) {
        $playlistId = $_POST['playlistId'];
        $songId = $_POST['songId'];

        $orderIdQuery = mysqli_query($conn, "SELECT IFNULL(MAX(playlistOrder) + 1,1) as playlistOrder FROM playlistsongs WHERE playlistId='$playlistId'");
        $row = mysqli_fetch_array($orderIdQuery);

        $order = $row['playlistOrder'];

        $query = mysqli_query($conn, "INSERT INTO playlistsongs (songId, playlistId, playlistOrder)  VALUES('$songId', '$playlistId', '$order')");

        return $query;

    } else {
        echo "Playlist id or song id not passed correctly.";
    }
?>