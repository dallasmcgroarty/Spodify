<?php 
    include("includes/includedFiles.php");

?>

<div class="user-details">
    <div class="container border-bottom flex aic jcc f-col">
        <h2 class="text-center">Email</h2>
        <input type="text" class="email" name="email" placeholder="Email address..." value="<?php echo $userLoggedIn->getEmail(); ?>"/>
        <span class="message hide"></span>
        <button class="button" onclick="updateEmail('email')">Save</button>
    </div>

    <div class="container flex aic jcc f-col">
        <h2 class="text-center">Password</h2>
        <input type="password" class="old-password" name="oldPassword" placeholder="Enter current password"/>
        <input type="password" class="new-password" name="newPassword" placeholder="Enter new password"/>
        <input type="password" class="new-password2" name="newPassword2" placeholder="Confirm new password"/>

        <span class="message hide"></span>
        <button class="button" onclick="updatePassword('old-password','new-password', 'new-password2')">Save</button>
    </div>
</div>