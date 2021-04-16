<?php
    require APPROOT . '/view/head/head.php';
    require APPROOT . '/view/head/captchaHead.php';
    require APPROOT . '/view/head/nav.php';

    $selector = filter_input(INPUT_GET, 'selector');
    $validator = filter_input(INPUT_GET, 'validator');
    if (false !== ctype_xdigit( $validator )) :
?>
    <main class="container align-self-center ">    
        <p class="row col-sm-6 align-self-center">Please fill in the credential to receive a link to reset your password.</p>
        <form action="/LoginController/confirmPasswordReset" method="POST">
            <input type="hidden" name="validator" value="<?php echo $validator; ?>">
            
            <label class="row " for="inputMail">New Password: </label>
            <input class="row " type="password" name="userPassword" id="inputPassword" required>
            
            <input type="submit" class="submit" value="Submit">
        </form>
    </main>
<?php endif; ?>