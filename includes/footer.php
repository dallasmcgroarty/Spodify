<?php 
    $songQuery = mysqli_query($conn, "SELECT * FROM songs ORDER BY RAND() LIMIT 10");

    $resultArray = [];

    while ($row = mysqli_fetch_array($songQuery)) {
        array_push($resultArray, $row['id']);
    }

    $jsonArray = json_encode($resultArray);
?>

<script>
    $(document).ready(function() {
        currentPlaylist = <?php echo $jsonArray ?>;
        audioElement = new Audio();
        setTrack(currentPlaylist[0], currentPlaylist, false);
    });

    function setTrack(trackId, newPlaylist, play) {

        $.post("includes/handlers/ajax/getSongJson.php", { songId: trackId }, function(data) {
            let track = JSON.parse(data);

            document.querySelector('#now-playing-bar .track-name').textContent = track.title;

            $.post("includes/handlers/ajax/getArtistJson.php", { artistId: track.artist }, function(data) {
                let artist = JSON.parse(data);
                document.querySelector('#now-playing-bar .artist-name').textContent = artist.name;
            });

            $.post("includes/handlers/ajax/getAlbumJson.php", { albumId: track.album }, function(data) {
                let album = JSON.parse(data);
                document.querySelector('#now-playing-bar .album-artwork').src = album.artworkPath;
            });

            audioElement.setTrack(track);
        });

        if (play) {
            audioElement.play();
        }
    }

    function playSong() {
        if (audioElement.audio.currentTime == 0) {
            $.post("includes/handlers/ajax/updatePlays.php", { songId: audioElement.currentlyPlaying.id });
        }

        document.querySelector('.control-button.play').classList.add('hide');
        document.querySelector('.control-button.pause').classList.remove('hide');
        audioElement.play();
    }

    function pauseSong() {
        document.querySelector('.control-button.play').classList.remove('hide');
        document.querySelector('.control-button.pause').classList.add('hide');
        audioElement.pause();
    }

</script>

</div>
                </div>

            <div id="now-playing-container">
                <div id="now-playing-bar">
                    <div id="now-playing-bar-left">
                        <div class="content">
                            <span class="album-link">
                                <img src="assets/images/album-placeholder.png" alt="album artwork" class="album-artwork">
                            </span>

                            <div class="track-info">
                                <span class="track-name">
                                    test
                                </span>

                                <span class="artist-name">
                                    test
                                </span>
                            </div>
                        </div>
                    </div>

                    <div id="now-playing-bar-center">
                        <div class="content player-controls">
                            <div class="buttons">
                                <button type="button" class="control-button shuffle" title="Shuffle Button">
                                    <img src="assets/images/icons/shuffle.png" alt="shuffle song">
                                </button>

                                <button type="button" class="control-button previous" title="Previous Button">
                                    <img src="assets/images/icons/previous.png" alt="previous song">
                                </button>

                                <button type="button" class="control-button play" title="Play Button" onclick="playSong();">
                                    <img src="assets/images/icons/play.png" alt="play song">
                                </button>

                                <button type="button" class="control-button pause hide" title="Pause Button" onclick="pauseSong();">
                                    <img src="assets/images/icons/pause.png" alt="pause song">
                                </button>

                                <button type="button" class="control-button next" title="Next Button">
                                    <img src="assets/images/icons/next.png" alt="next song">
                                </button>

                                <button type="button" class="control-button repeat" title="repeat Button">
                                    <img src="assets/images/icons/repeat.png" alt="repeat song">
                                </button>
                            </div>

                            <div class="playback-bar">
                                <span class="progress-time current">0:00</span>
                                <div class="progress-bar">
                                    <div class="progress-bar-bg">
                                        <div class="progress"></div>
                                    </div>
                                </div>
                                <span class="progress-time remaining">0:00</span>
                            </div>
                        </div>
                    </div>

                    <div id="now-playing-bar-right">
                        <div class="volume-bar">
                            <button type="button" class="control-button volume" title="Volume button">
                                <img src="assets/images/icons/volume.png" alt="Volume">
                            </button>

                            <div class="progress-bar">
                                <div class="progress-bar-bg">
                                    <div class="progress"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>