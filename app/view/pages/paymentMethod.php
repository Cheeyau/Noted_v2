<?php
    require APPROOT . '/view/head/head.php';
    require APPROOT . '/view/head/captchaHead.php';
    require APPROOT . '/view/head/nav.php';
?>


<main class="col-sm-6 row align-self-center ">    
    <form class="col-sm-12 align-self-center" name="loginForm" action="<?php echo URLROOT ?>/PaymentController/checkPaymentMethod" method="POST" onkeyup="checkLoginData()" onsubmit="return validateLogin()" required>
        
        <button type="button" class="" onclick="paymentSwitch()">
            <input type="hidden" value="ideal" name="payment" checked="checked">
        </button>

        <span id="loginError" class="errorMess" >
        <?php 
        if(!empty($data['errorMess'])) {
            echo $data['errorMess'];
        } 
        ?></span>
        
    </form>
    
</main>