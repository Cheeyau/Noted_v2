<?php
    require APPROOT . '/view/head/head.php';
    ?>
    <script src="<?php echo URLROOT ?>/public/js/resetPassword.js" type="module"></script>
    <?php
    require APPROOT . '/view/head/captchaHead.php';
    require APPROOT . '/view/head/nav.php';
?>

<main class="col-sm-6 row align-self-center ">
    <h1 class="col-sm-12 align-self-center H1">Reset your password</h1>
    <p class="col-sm-12 align-self-center">Please fill in the credential to receive a link to reset your password.</p>
    <form id="resetPassword" class="col-sm-12 align-self-center" action="<?php echo URLROOT ?>/LoginController/resetPassword" method="POST">
        <label for="inputName"><strong>User name: </strong></label>
        <input class="form-control" type="text" name="inputName" id="inputUserReset" required>

        <label for="inputEmail"><strong>User email: </strong></label>
        <input class="form-control" type="text" name="inputEmail" id="inputEmailReset" required>

        <label for="inputMail"><strong>New password: </strong></label>
        <label>(The password needs to contain a number, special, capital and at least 8 character long)</label>
        <input class="form-control" type="password" name="inputPassword" id="inputPasswordReset" required>
        
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        <button class="btnLogin col-sm-6 btn-primary btn-sm" type="submit" value="submit">send</button>
        <span class="errorMess " ><?php echo $data["errorMess"] ?></span>
    </form>
</main>