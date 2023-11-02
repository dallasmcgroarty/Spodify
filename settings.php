<?php 
    include("includes/includedFiles.php");
?>

<div class="entity-info">
    <div class="center-section">
        <div class="user-info text-center">
            <h1><?php echo $userLoggedIn->getFirstName() . ' ' . $userLoggedIn->getLastName() ?></h1>
        </div>
    </div>

    <div class="button-items flex aic jcc f-col">
        <button class="button" onclick="openPage('updateDetails.php')">User Details</button>
        <button class="button" onclick="logout()">Logout</button>
    </div>
</div>