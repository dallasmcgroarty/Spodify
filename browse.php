<?php 
    include('includes/includedFiles.php');
?>

<h1 class="page-heading-big">You Might Also Like</h1>

<div class="grid-view-container">
    <?php 
        $albumQuery = mysqli_query($conn, "SELECT * FROM albums ORDER BY RAND() LIMIT 10");

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
