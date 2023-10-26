<?php 
    include("includes/includedFiles.php");

?>

<div class="playlist-container">
    <h1 class="text-center">Playlists</h1>
    <div class="button-items text-center">
        <button class="button green" onclick="this.closest('.button-items').querySelector('.playlist-input-container').classList.toggle('hide');">New Playlist</button>
        <div class="playlist-input-container hide">
            <input id="playlist-input" type="text" placeholder="Enter playlist name..."/>
            <button id="playlist-submit-btn" class="button-small" onclick="createPlaylist();">OK</button>
        </div>
    </div>
    <div class="grid-view-container">
        <?php 
            $username = $userLoggedIn->getUsername();
            $playlistQuery = mysqli_query($conn, "SELECT * FROM playlists WHERE owner = '$username'");

            if (mysqli_num_rows($playlistQuery) == 0) {
                echo "<span class='no-results'>You don't have any playlists yet. </span>";
            } else {
                while ($row = mysqli_fetch_array($playlistQuery)) {
                    $playlist = new Playlist($conn, $row);
                    $urlAction = "openPage('playlist.php?id=" . $playlist->getId() . "')";

                    echo "<div class='grid-view-item' role='link' tabindex='0' onclick=$urlAction>
                        <div class='playlist-image'>
                            <img src='assets/images/icons/playlist.png'/>
                        </div>
                        <div class='grid-view-info'>" 
                        . $playlist->getName() . 
                        "</div>
                    </div>";
                }
            }
        ?>
    </div>
</div>