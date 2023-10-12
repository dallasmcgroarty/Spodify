<?php 
    ob_start();
    session_start();
    
    $timezone = date_default_timezone_set("America/Los_Angeles");

    $conn = mysqli_connect("localhost", "root", "", "spodify");

    if (mysqli_connect_errno()) {
        echo "Failed to connect: " . mysqli_connect_errno();
    }
?>