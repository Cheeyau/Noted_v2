<?php 
    function checkRecaptcha($captchaResponse) {
        $recaptcha_url = URLCAPTCHA;
        $recaptcha_secret = KEYSECRETCAPTCHA;
        $recaptcha_response = $captchaResponse;
        // Make and decode POST request:
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $recaptcha = json_decode($recaptcha);
        // Take action based on the score returned:
        return $recaptcha;
 }