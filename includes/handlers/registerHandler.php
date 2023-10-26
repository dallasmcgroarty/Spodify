<?php 
    function sanitizeFormInput($inputText) {
        return str_replace(" ", "", strip_tags(trim($inputText)));
    }

    function sanitizeFormPassword($inputText) {
        return strip_tags($inputText);
    }

    if(isset($_POST['register-button'])) {
        // get and clean form input
        $username = sanitizeFormInput($_POST['username']);
        $firstName = ucfirst(strtolower(sanitizeFormInput($_POST['firstName'])));
        $lastName = sanitizeFormInput($_POST['lastName']);
        $email = sanitizeFormInput($_POST['email']);
        $email2 = sanitizeFormInput($_POST['email2']);
        $password = sanitizeFormPassword($_POST['password']);
        $password2 = sanitizeFormPassword($_POST['password2']);

        $wasSuccessful = $account->register($username,$firstName,$lastName,$email,$email2,$password,$password2);

        if ($wasSuccessful) {
            $_SESSION['userLoggedIn'] = $username;
            $_SESSION['user'] = serialize($account);
            header('location: index.php');
        }
    }
?>