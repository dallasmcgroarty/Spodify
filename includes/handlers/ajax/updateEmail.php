<?php 
    include('../../config.php');

    if (isset($_POST['email']) && isset($_POST['username']) && $_POST['email'] != '') {
        $email = $_POST['email'];
        $username = $_POST['username'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Error';
            return false;
        }


        $emailCheck = mysqli_query($conn, "SELECT email FROM users WHERE email='$email' AND username !='$username'");

        if (mysqli_num_rows($emailCheck) > 0) {
            echo 'Error';
            return false;
        }

        $query = mysqli_query($conn, "UPDATE users SET email = '$email' WHERE username='$username'");
        return $query;
    } else {
        echo 'Error';
    }
?>