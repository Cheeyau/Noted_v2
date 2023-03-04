<?php
    require APPROOT . '/view/head/head.php';
    ?>
    <script src="<?php echo URLROOT ?>/public/js/register.js" type="module"></script>
    <?php
    require APPROOT . '/view/head/captchaHead.php';
    require APPROOT . '/view/head/nav.php';
?>

<main class="col-sm-6 row align-self-center ">    
    <h1 class="col-sm-12 align-self-center H1">Register as a new user!</h1>
    <p class="col-sm-12 align-self-center">Please fill in the credential to register.</p>
    <form id="registerUserForm" class="col-sm-12 align-self-center" action="<?php echo URLROOT ?>/LoginController/registerUser" method="POST">
        <label for="inputUser"><strong>User name: </strong></label>
        <label>(The length of the name must at least be 3 character long)</label>
        <input class="form-control" type="text" name="userName" id="inputUserRegis" required>
        
        <label for="inputMail"><strong>Email: </strong></label>
        <input class="form-control" type="text" name="userEmail" id="inputEmailRegis" required>
        
        <label for="inputPassword"><strong>Password: </strong></label>
        <label>(The password needs to contain a number, special, capital  and at least 8 character long)</label>
        <input class="form-control" type="password" name="userPassword" id="inputPasswordRegis" required>

        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        <button class="btnLogin col-sm-6 btn-primary btn-sm" type="submit" value="submit">Register</button>
        <span id="registerError" class="errorMess " ><?php echo $data["errorMess"] ?></span>
    </form>    
</main>
