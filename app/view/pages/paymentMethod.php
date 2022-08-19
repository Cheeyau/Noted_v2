<?php
    require APPROOT . '/view/head/head.php';
    require APPROOT . '/view/head/nav.php';
?>


<main class="col-sm-6 row align-self-center ">    
    <form class="col-sm-12 align-self-center" name="paymentMethodForm" action="<?php echo URLROOT ?>/PaymentController/checkPaymentMethod" method="POST" onkeyup="checkDonateData()" onsubmit="return validateDonate()" required>
        
        <button type="button" class="paymentSelector btn-sm btn-primary" onclick="paymentSwitch()">
            <input class="paymentSelectorRadio" type="radio" value="ideal" name="payment" checked="checked">
            <img src="<?php echo URLROOT . '/public/img/ideal.png'?>" alt="logo ideal small">
            IDeal
        </button>
        
        <button type="button" class="paymentSelector btn-sm" onclick="paymentSwitch()">
            <input class="paymentSelectorRadio" type="radio" value="ideal" name="payment" >
            <img src="<?php echo URLROOT . '/public/img/paypal.png'?>" alt="logo ideal small">
            PayPal
        </button>
        
        <button type="button" class="paymentSelector btn-sm " onclick="paymentSwitch()">
            <input class="paymentSelectorRadio" type="radio" value="ideal" name="payment">
            <img src="<?php echo URLROOT . '/public/img/master.png'?>" alt="logo master small">
            Credit card
        </button>
        
        </span>
        <label  for="inputPayment">How much do you want to donate?  </label>
        <input class="col-sm-6 form-control" type="text" name="price" id="inputPrice">
        
        <button type="submit" class="col-sm-6  btn-sm btn-primary btnLogin">
            <a href="<?php echo URLROOT ?>/PaymentController/paymentOverview">Donate</a>
        </button>     
        <span id="donateError" class="errorMess" >
        <?php 
            if(!empty($data['errorMess'])) {
                echo $data['errorMess'];
            } 
        ?>
    </form>
</main>
<script src="<?php echo URLROOT ?>/public/js/payment.js"></script>