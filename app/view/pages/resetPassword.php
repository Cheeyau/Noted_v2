<?php
    require APPROOT . '/view/head/head.php';
    require APPROOT . '/view/head/captchaHead.php';
    require APPROOT . '/view/head/nav.php';
?>
<main class="container align-self-center ">    
    <p class="row col-sm-6 align-self-center">Please fill in the credential to receive a link to reset your password.</p>
    <form id="registerUser" class="row col-sm-6 align-self-center" action="<?php echo URLROOT ?>/LoginController/resetPassword" method="POST">
        <label class="row " for="inputMail">Email: </label>
        <input class="row " type="text" name="inputPassword" id="inputPassword">
        
        <span class="error " ><?php echo $data["errorMess"] ?></span>
        <button class="row " type="submit" value="submit">send</button>
        
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
    </form>    
</main>