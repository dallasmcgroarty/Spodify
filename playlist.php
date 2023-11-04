<?php include("includes/includedFiles.php"); 

    if (isset($_GET['id'])) {
        $playlistId = $_GET['id'];

    } else {
        Header("Location: index.php");
    }

    $playlist = new Playlist($conn, $playlistId);
    $owner = new User($conn, $playlist->getOwner());
?>

<div class="entity-info">
    <div class="left-section">
        <div class="playlist-image">
            <img src="assets/images/icons/playlist.png" alt="album artwork" />
        </div>
    </div>

    <div class="right-section playlist-info">
        <h2><?php echo $playlist->getName(); ?></h2>
        <p>By <?php echo $playlist->getOwner(); ?></p>
        <p><?php echo $playlist->getNumberOfSongs(); ?> songs</p>
        <button class="button" onclick="this.closest('.right-section').querySelector('.playlist-input-container').classList.toggle('hide');">Delete Playlist</button>
        <div class="playlist-input-container hide">
            <span class="playlist-confirm-delete">Are you sure?</span>
            <button id="playlist-submit-btn" class="button-smaller" onclick="deletePlaylist('<?php echo $playlist->getId() ?>');">Yes</button>
        </div>
    </div>

</div>

<div class="track-list-container">
    <ul class="track-list">
        <?php 
            $songIdArray = $playlist->getSongIds();

            $i = 1;
            foreach($songIdArray as $songId) {
                $song = new Song($conn, $songId);
                $songArtist = $song->getArtist();
                $id = $song->getId();

                echo "<li class='track-list-row' data-song-id='$id'>
                        <div class='track-count'>
                            <img class='play' src='assets/images/icons/play-white.png' alt='play' onclick='setTrack(\"$id\",tempPlaylist,true)'/>
                            <span class='track-number'>$i</span>
                        </div>

                        <div class='track-info'>
                            <span class='track-name'>" . $song->getTitle() . "</span>
                            <span class='track-artist'>" . $songArtist->getName() . "</span>
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

<nav class="options-menu hide">
    <input type="hidden" id="songId" />
    <div class="item" onclick="togglePlaylistMenu();">Add to playlist</div>
    <div class="item" onclick="removeFromPlaylist(this, '<?php echo $playlist->getId() ?>')">Remove from playlist</div>
    <div class="item">Copy Song Link</div>
    <div class="playlist-menu hide">
        <?php echo Playlist::getAllPlaylists($conn, $userLoggedIn->getUsername()); ?>
    </div>
</nav>