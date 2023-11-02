<?php 
    include('../../config.php');

    if (!isset($_POST['username'])) {
        echo 'Could not get username!';
        return false;
    }

    if (!isset($_POST['oldPassword']) || !isset($_POST['newPassword']) || !isset($_POST['newPassword2'])) {
        echo 'Not all passwords are set!';
        return false;
    }

    if (empty($_POST['oldPassword']) || empty($_POST['newPassword']) || empty($_POST['newPassword2'])) {
        echo 'Please fill in all fields!';
        return false;
    }

    $username = $_POST['username'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $newPassword2 = $_POST['newPassword2'];

    $oldMd5 = md5($oldPassword);

    $passwordCheck = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$oldMd5'");

    if (mysqli_num_rows($passwordCheck) != 1) {
        echo 'Password is incorrect!';
        return false;
    }

    if ($newPassword != $newPassword2) {
        echo 'New passwords do not match!';
        return false;
    }

    if (strlen($newPassword) > 30 || strlen($newPassword) < 5) {
        echo 'Your new password must be between 5 and 30 characters.';
        return false;
    }

    $newMd5 = md5($newPassword);

    $query = mysqli_query($conn, "UPDATE users SET password = '$newMd5' WHERE username='$username'");

    return $query;
?>