<?php 
    if(isset($_POST['login-button'])) {
        // get and clean form input
        $username = $_POST['login-username'];
        $password = $_POST['login-password'];

        $result = $account->login($username, $password);

        if ($result) {
            $_SESSION['userLoggedIn'] = $username;
            $_SESSION['user'] = serialize($account);
            header("location: index.php");
        }
    }
?>