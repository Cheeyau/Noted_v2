<?php
    require APPROOT . '/view/head/head.php';
    ?>
    <script src="<?php echo URLROOT; ?>/public/js/login.js" type="module"></script>
    <?php
    require APPROOT . '/view/head/captchaHead.php';
    require APPROOT . '/view/head/nav.php';
?>
<main class="col-sm-6 row align-self-center ">    
    <h1 class="col-sm-12 align-self-center H1">Login into Noted!</h1>
    <p class="col-sm-12 align-self-center">Please fill in the credential to log in.</p>
    <form id="loginForm" class="col-sm-12 align-self-center" action="<?php echo URLROOT ?>/LoginController/login" method="POST">
        <label  for="inputUser"><strong>User: </strong></label>
        <input class=" form-control" type="text" name="userName" id="inputUser" required>
        
        <label  for="inputPassword"><strong>Password:</strong></label>
        <input class=" form-control" type="password" name="userPassword" id="inputPassword" required>
        <button class="btnLogin btn-primary btn-sm" type="submit" value="submit">Login</button>
        
        <span class="errorMess"><?php if(!empty($data['errorMess'])) echo $data['errorMess']; ?></span>
        
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
    </form>
    <button type="button" class="col-sm-6 btn-primary btn-sm btnLogin">
        <a href="<?php echo URLROOT; ?>/LoginController/register">Don't have an account? Create one here!</a>
    </button>
    <button type="button" class="col-sm-6 btn-primary btn-sm btnLogin">
        <a href="<?php echo URLROOT; ?>/LoginController/reset">Forgot your password? Reset it here!</a>
    </button>
</main>
