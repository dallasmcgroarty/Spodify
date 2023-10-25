<?php 

include('includes/config.php');
include('includes/classes/Artist.php');
include('includes/classes/Album.php');
include('includes/classes/Song.php');

// logout session
// session_destroy();

if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
    echo "<script>userLoggedIn = '$userLoggedIn'</script>";
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
<?php 
if (isset($_SESSION['userLoggedIn'])) {
    echo "<script>userLoggedIn = '$userLoggedIn'</script>";
}
?>
<body>
    <div id="mainContainer">
        <div id="top-container">
            <div id="nav-bar-container">
                <nav class="nav-bar">
                    <span class="logo" role="link" tabindex="0" onclick="openPage('index.php')">
                        <img src="assets/images/icons/owl-logo.png" alt="logo">
                    </span>

                    <div class="group">
                        <div class="nav-item search-container">
                            <span role="link" tabindex="0" onclick="openPage('search.php')" class="nav-item-link">Search
                                <img src="assets/images/icons/search.png" alt="Search" class="icon">
                            </span>
                        </div>
                    </div>

                    <div class="group">
                        <div class="nav-item">
                            <span role="link" tabindex="0" onclick="openPage('browse.php')" class="nav-item-link">Browse</span>
                        </div>
                        <div class="nav-item">
                            <span role="link" tabindex="0" onclick="openPage('yourMusic.php')" class="nav-item-link">Your Music</span>
                        </div>
                        <div class="nav-item">
                            <span role="link" tabindex="0" onclick="openPage('profile.php')" class="nav-item-link">Profile</span>
                        </div>
                    </div>
                </nav>
            </div>

            <div id="main-view-container">
                <div id="main-content">