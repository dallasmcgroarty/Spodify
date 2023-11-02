<?php 
    include("includes/includedFiles.php");

    if (isset($_GET['id'])) {
        $artistId = $_GET['id'];

    } else {
        Header("Location: index.php");
    }

    $artist = new Artist($conn, $artistId);
?>

<div class="entity-info border-bottom">
    <div class="center-section">
        <div class="artist-info">
            <h1 class="artist-name"><?php echo $artist->getName(); ?></h1>

            <div class="header-buttons">
                <button class="button green" onclick="playFirstSong();">PLAY</button>
            </div>
        </div>
    </div>
</div>

<div class="track-list-container border-bottom">
    <h2 class="text-center">Songs</h2>
    <ul class="track-list">
        <?php 
            $songIdArray = $artist->getSongIds();

            $i = 1;
            foreach($songIdArray as $songId) {
                $song = new Song($conn, $songId);
                $id = $song->getId();

                echo "<li class='track-list-row' data-song-id='$id'>
                        <div class='track-count'>
                            <img class='play' src='assets/images/icons/play-white.png' alt='play' onclick='setTrack(\"$id\",tempPlaylist,true)'/>
                            <span class='track-number'>$i</span>
                        </div>

                        <div class='track-info'>
                            <span class='track-name'>" . $song->getTitle() . "</span>
                            <span class='track-artist'>" . $artist->getName() . "</span>
                        </div>

                        <div class='track-options'>
                            <img class='options-button' src='assets/images/icons/more.png' alt='more options' onclick='showOptionsMenu(this)' />
                        </div>

                        <div class='track-duration'>
                            <span class='duration'>" . $song->getDuration() . "</span>
                        </div>
                    </li>";

                    $i += 1;
            }
        ?>
        <script>
            tempSongIds = '<?php echo json_encode($songIdArray); ?>';
            tempPlaylist = JSON.parse(tempSongIds);
            console.log(tempPlaylist);
        </script>
    </ul>
</div>

<h2 class="text-center">Albums</h2>
<div class="grid-view-container">
    <?php 
        $albumQuery = mysqli_query($conn, "SELECT * FROM albums WHERE artist='$artistId'");

        while ($row = mysqli_fetch_array($albumQuery)) {
            $urlAction = "openPage('album.php?id=" . $row['id'] . "')";
            echo "<div class='grid-view-item'>
                <div class='album-link' role='link' tabindex='0' onclick=$urlAction>
                    <img src='" . $row['artworkPath'] . "' alt='album art' />
                    <div class='grid-view-info'>" 
                    . $row['title'] . 
                    "</div>
                </div>
            </div>";
        }
    ?>
</div>

<nav class="options-menu hide">
    <input type="hidden" id="songId" />
    <div class="item" onclick="togglePlaylistMenu();">Add to playlist</div>
    <div class="item">Copy Song Link</div>
    <div class="playlist-menu hide">
        <?php echo Playlist::getAllPlaylists($conn, $userLoggedIn->getUsername()); ?>
    </div>
</nav>
