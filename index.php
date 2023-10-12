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
        <div id="now-playing-container">
            <div id="now-playing-bar">
                <div id="now-playing-bar-left"></div>

                <div id="now-playing-bar-center"></div>

                <div id="now-playing-bar-right"></div>
            </div>
        </div>
    </body>
</html>