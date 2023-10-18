<?php 

include('includes/config.php');
include('includes/classes/Artist.php');
include('includes/classes/Album.php');
include('includes/classes/Song.php');

// logout session
// session_destroy();

if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

$songQuery = mysqli_query($conn, "SELECT * FROM songs ORDER BY RAND() LIMIT 10");

$resultArray = [];

while ($row = mysqli_fetch_array($songQuery)) {
    array_push($resultArray, $row['id']);
}

$jsonArray = json_encode($resultArray);

?>

<script>
    newPlaylist = <?php echo $jsonArray ?>;
</script>

<html>
<head>
    <title>Spodify</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>
<body>
    <div id="mainContainer">
        <div id="top-container">
            <div id="nav-bar-container">
                <nav class="nav-bar">
                    <a href="index.php" class="logo">
                        <img src="assets/images/icons/owl-logo.png" alt="logo">
                    </a>

                    <div class="group">
                        <div class="nav-item search-container">
                            <a href="search.php" class="nav-item-link">Search
                                <img src="assets/images/icons/search.png" alt="Search" class="icon">
                            </a>
                        </div>
                    </div>

                    <div class="group">
                        <div class="nav-item">
                            <a href="browse.php" class="nav-item-link">Browse</a>
                        </div>
                        <div class="nav-item">
                            <a href="yourMusic.php" class="nav-item-link">Your Music</a>
                        </div>
                        <div class="nav-item">
                            <a href="profile.php" class="nav-item-link">Profile</a>
                        </div>
                    </div>
                </nav>
            </div>

            <div id="main-view-container">
                <div id="main-content">