<?php include('includes/header.php'); 

    if (isset($_GET['id'])) {
        $albumId = $_GET['id'];

    } else {
        Header("Location: index.php");
    }

    $album = new Album($conn, $albumId);
    $artist = $album->getArtist();
?>

<div class="entity-info">
    <div class="left-section">
        <img src="<?php echo $album->getArtworkPath(); ?>" alt="album artwork" />
    </div>

    <div class="right-section">
        <h2><?php echo $album->getTitle(); ?></h2>
        <p>By <?php echo $artist->getName(); ?></p>
        <p><?php echo $album->getNumberOfSongs(); ?> songs</p>
    </div>

</div>

<div class="track-list-container">
    <ul class="track-list">
        <?php 
            $songIdArray = $album->getSongIds();

            $i = 1;
            foreach($songIdArray as $songId) {
                $song = new Song($conn, $songId);
                $albumArtist = $song->getArtist();
                $id = $song->getId();

                echo "<li class='track-list-row'>
                        <div class='track-count'>
                            <img class='play' src='assets/images/icons/play-white.png' alt='play' onclick='setTrack(\"$id\",tempPlaylist,true)'/>
                            <span class='track-number'>$i</span>
                        </div>

                        <div class='track-info'>
                            <span class='track-name'>" . $song->getTitle() . "</span>
                            <span class='track-artist'>" . $albumArtist->getName() . "</span>
                        </div>

                        <div class='track-options'>
                            <img class='options-button' src='assets/images/icons/more.png' alt='more options' />
                        </div>

                        <div class='track-duration'>
                            <span class='duration'>" . $song->getDuration() . "</span>
                        </div>
                    </li>";

                    $i += 1;
            }
        ?>
        <script>
            let tempSongIds = '<?php echo json_encode($songIdArray); ?>';
            tempPlaylist = JSON.parse(tempSongIds);
            console.log(tempPlaylist);
        </script>
    </ul>
</div>

<?php include('includes/footer.php'); ?>
