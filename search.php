<?php 
    include("includes/includedFiles.php");

    if(isset($_GET['term'])) {
        $term = urldecode($_GET['term']);
    } else {
        $term = '';
    }
?>

<script>
    $(document).ready(function() {
        $('.search-input').focus();
        let val = document.querySelector('.search-input').value;
        document.querySelector('.search-input').value = '';
        document.querySelector('.search-input').value = val;

        document.querySelector('.search-input').addEventListener('keyup', function(e) {
            let el = this;
            clearTimeout(timer);
            timer = setTimeout(function() {
                openPage('search.php?term='+el.value);
            }, 2000);
        });
    });

</script>

<div class="search-container">
    <h4>Search for an artist, album or song</h4>
    <input type="text" class="search-input" value="<?php echo $term; ?>" onfocus="this.value=this.value" />
</div>

<?php 
    if (empty($term)) {
        exit();
    } 
?>

<div class="track-list-container border-bottom">
    <h2 class="text-center">Songs</h2>
    <ul class="track-list">
        <?php 

            $songsQuery = mysqli_query($conn, "SELECT id FROM songs WHERE title LIKE '$term%'");
            $songIdArray = array();

            if (mysqli_num_rows($songsQuery) == 0) {
                echo "<span class='no-results'>No songs found matching " . $term . "</span>";
            } else {
                $i = 1;
                while($row = mysqli_fetch_array($songsQuery)) {
                    array_push($songIdArray, $row['id']);
    
                    $song = new Song($conn, $row['id']);
                    $artist = $song->getArtist();
                    $id = $row['id'];

                    echo "<li class='track-list-row'>
                            <div class='track-count'>
                                <img class='play' src='assets/images/icons/play-white.png' alt='play' onclick='setTrack(\"$id\",tempPlaylist,true)'/>
                                <span class='track-number'>$i</span>
                            </div>
    
                            <div class='track-info'>
                                <span class='track-name'>" . $song->getTitle() . "</span>
                                <span class='track-artist'>" . $artist->getName() . "</span>
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
            }
        ?>
        <script>
            tempSongIds = '<?php echo json_encode($songIdArray); ?>';
            tempPlaylist = JSON.parse(tempSongIds);
            console.log(tempPlaylist);
        </script>
    </ul>
</div>

<div class="artists-container border-bottom">
    <h2 class="text-center">Artists</h2>

    <?php 
        $artistQuery = mysqli_query($conn, "SELECT id FROM artists WHERE name LIKE '$term%'");

        if (mysqli_num_rows($artistQuery) == 0) {
            echo "<span class='no-results'>No artists found matching " . $term . "</span>";
        } else {
            while ($row = mysqli_fetch_array($artistQuery)) {
                $artistFound = new Artist($conn, $row['id']);

                echo "<div class='search-result-row'>
                    <div class='artist-name'>
                        <span role='link' tabindex='0' onclick='openPage(\"artist.php?id=". $artistFound->getId() . "\")'>
                            ". $artistFound->getName() . "
                        </span>
                    </div>
                </div>";
            }
        }
    ?>
</div>

<h2 class="text-center">Albums</h2>
<div class="grid-view-container">
    <?php 
        $albumQuery = mysqli_query($conn, "SELECT * FROM albums WHERE title LIKE '$term%'");

        if (mysqli_num_rows($albumQuery) == 0) {
            echo "<span class='no-results'>No albums found matching " . $term . "</span>";
        } else {
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
        }
    ?>
</div>