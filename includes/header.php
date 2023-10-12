<?php 

include('includes/config.php');

// logout session
// session_destroy();

if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

?>

<html>
<head>
    <title>Spodify</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
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