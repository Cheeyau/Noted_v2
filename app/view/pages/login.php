<?php
    require APPROOT . '/view/head/head.php';
    require APPROOT . '/view/head/captchaHead.php';
    require APPROOT . '/view/head/nav.php';
?>
<main class="col-sm-6 row align-self-center ">    
    <h1 class="col-sm-12 align-self-center H1">Login into Noted!</h1>
    <p class="col-sm-12 align-self-center">Please fill in the credential to log in.</p>
    <form class="col-sm-12 align-self-center" name="loginForm" action="<?php echo URLROOT ?>/LoginController/login" method="POST" onkeyup="checkLoginData()" onsubmit="return validateLogin()" required>
        <label  for="inputUser">User: </label>
        <input class=" form-control" type="text" name="userName" id="inputUser">
        <label  for="inputPassword">Password: </label>
        <input class=" form-control" type="password" name="userPassword" id="inputPassword">
        <button class="btnLogin btn-primary btn-sm" type="submit" value="submit">Login</button>
        <span id="loginError" class="errorMess" >
        <?php 
        if(!empty($data['errorMess'])) {
            echo $data['errorMess'];
        } 
        ?></span>
        
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
    </form>
    <button type="button" class="col-sm-6 btn-primary btn-sm btnLogin">
        <a href="<?php echo URLROOT ?>/LoginController/registerUserPage">Don't have an account? Create one here!</a>
    </button>
    <!-- <button type="button">
        <a href="<?php echo URLROOT ?>/LoginController/resetPasswordPage">Forgot your password? Reset it here!</a>
    </button> -->
</main>