<?php
    require APPROOT . '/view/head/head.php';
    require APPROOT . '/view/head/captchaHead.php';
    require APPROOT . '/view/head/nav.php';
?>

<main class="col-sm-6 row align-self-center ">    
    <h1 class="col-sm-12 align-self-center H1">Register as a new user!</h1>
    <p class="col-sm-12 align-self-center">Please fill in the credential to register.</p>
    <form id="registerUser" class="row col-sm-6 align-self-center" action="<?php echo URLROOT ?>/LoginController/registerUserCon" method="POST">
        <label for="inputUser">User name: </label>
        <input class="row form-control" type="text" name="userName" id="inputUser">
        
        <label for="inputMail">Email: </label>
        <input class="row form-control" type="text" name="userEmail" id="inputPassword">
        
        <label for="inputPassword">Password: </label>
        <input class="row form-control" type="password" name="userPassword" id="inputPassword">

        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        <button class="col-sm-6 btn-primary btn-sm" type="submit" value="submit">Register</button>
        <span class="error " ><?php echo $data["errorMess"] ?></span>
    </form>    
</main>