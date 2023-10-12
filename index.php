<?php include('includes/header.php'); ?>

<h1 class="page-heading-big">You Might Also Like</h1>

<div class="grid-view-container">
    <?php 
        $albumQuery = mysqli_query($conn, "SELECT * FROM albums ORDER BY RAND() LIMIT 10");

        while ($row = mysqli_fetch_array($albumQuery)) {
            echo "<div class='grid-view-item'>
                <a href='album.php?id=" . $row['id'] . "'>
                    <img src='" . $row['artworkPath'] . "' alt='album art' />
                    <div class='grid-view-info'>" 
                    . $row['title'] . 
                    "</div>
                </a>
            </div>";
        }
    ?>
</div>

<?php include('includes/footer.php'); ?>