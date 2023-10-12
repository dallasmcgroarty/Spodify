<?php 
    include('includes/config.php');

    include('includes/classes/Account.php');
    include('includes/classes/Constants.php');

    $account = new Account($conn);

    include('includes/handlers/registerHandler.php');
    include('includes/handlers/loginHandler.php');

    function getInputValue($name) {
        if (isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>

<html>
    <head>
        <title>Register Page</title>
        <link rel="stylesheet" type="text/css" href="assets/css/register.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <div id="background">
            <div id="login-container">
                <div id="input-container">
                    <form id="login-form" class="hide" action="register.php" method="POST">
                        <h2>Login to your account</h2>
                        <div class="form-input">
                            <?php echo $account->getError(Constants::$loginFailed) ?>
                            <label for="login-username">Username</label>
                            <input id="login-username" name="login-username" type="text" value="<?php getInputValue('login-username') ?>" required/>
                        </div>

                        <div class="form-input">
                            <label for="login-password">Password</label>
                            <input id="login-password" name="login-password" type="password" required/>
                        </div>

                        <button type="submit" id="login-button" name="login-button">Login</button>

                        <div class="hasAccountText">
                            <a href="#" id="hideLogin">Don't have an account yet? Sign up here.</a>
                        </div>
                    </form>

                    <form id="register-form" action="register.php" method="POST">
                        <h2>Create an account</h2>
                        <div class="form-input">
                            <?php echo $account->getError(Constants::$usernameTaken) ?>
                            <?php echo $account->getError(Constants::$usernameLengthLimit) ?>
                            <label for="register-username">Username</label>
                            <input id="register-username" name="username" type="text" value="<?php getInputValue('username') ?>" required/>
                        </div>

                        <div class="form-input">
                            <?php echo $account->getError(Constants::$firstNameLengthLimit) ?>
                            <?php echo $account->getError(Constants::$firstNameInvalid) ?>
                            <label for="register-firstName">First name</label>
                            <input id="register-firstName" name="firstName" type="text" value="<?php getInputValue('firstName') ?>" required/>
                        </div>

                        <div class="form-input">
                            <?php echo $account->getError(Constants::$lastNameLengthLimit) ?>
                            <?php echo $account->getError(Constants::$lastNameInvalid) ?>
                            <label for="register-lastName">Last name</label>
                            <input id="register-lastName" name="lastName" type="text" value="<?php getInputValue('lastName') ?>" required/>
                        </div>

                        <div class="form-input">
                            <?php echo $account->getError(Constants::$emailTaken) ?>
                            <?php echo $account->getError(Constants::$emailsDoNotMatch) ?>
                            <?php echo $account->getError(Constants::$emailInvalid) ?>
                            <label for="register-email">Email</label>
                            <input id="register-email" name="email" type="email" value="<?php getInputValue('email') ?>" required/>
                        </div>

                        <div class="form-input">
                            <label for="register-email2">Confirm Email</label>
                            <input id="register-email2" name="email2" type="email" value="<?php getInputValue('email2') ?>" required/>
                        </div>

                        <div class="form-input">
                            <?php echo $account->getError(Constants::$passwordsDoNotMatch) ?>
                            <?php echo $account->getError(Constants::$passwordLengthLimit) ?>
                            <label for="register-password">Password</label>
                            <input id="register-password" name="password" type="password" value="<?php getInputValue('password') ?>" required/>
                        </div>

                        <div class="form-input">
                            <label for="register-password2">Confirm Password</label>
                            <input id="register-password2" name="password2" type="password" value="<?php getInputValue('password2') ?>" required/>
                        </div>

                        <button type="submit" id="register-button" name="register-button">Sign Up</button>

                        <div class="hasAccountText">
                            <a href="#" id="hideRegister">Already have an account? Log in here.</a>
                        </div>
                    </form>
                </div>

                <div id="login-text">
                    <h1>Get great music, right now!</h1>
                    <h2>Listen to a large library of songs for free.</h2>
                    <ul>
                        <li>Discover music you'll love</li>
                        <li>Create your own playlists</li>
                        <li>Follow artists to keep up with new releases</li>
                    </ul>
                </div>
            </div>
        </div>
    <script src="assets/js/register.js" defer></script>
    <?php 
        if (isset($_POST['register-button'])) {
            echo "<script>document.querySelector('#login-form').classList.add('hide');document.querySelector('#register-form').classList.remove('hide');</script>";
        }
        
        if (isset($_POST['login-button'])){
            echo "<script> document.querySelector('#login-form').classList.remove('hide');document.querySelector('#register-form').classList.add('hide');</script>";
        }

    ?>
    </body>
</html>