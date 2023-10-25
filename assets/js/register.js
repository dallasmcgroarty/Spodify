/**
 * Register Page JS
 */

document.addEventListener("DOMContentLoaded", function(){
    document.querySelector('#hideLogin').addEventListener('click', function(e) {
        document.querySelector('#login-form').classList.add('hide');
        document.querySelector('#register-form').classList.remove('hide');
    });

    document.querySelector('#hideRegister').addEventListener('click', function(e) {
        document.querySelector('#login-form').classList.remove('hide');
        document.querySelector('#register-form').classList.add('hide');
    });
});