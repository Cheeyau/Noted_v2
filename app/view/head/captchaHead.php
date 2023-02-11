<!-- captcha head -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo KEYSITECAPTCHA ?>"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('<?php echo KEYSITECAPTCHA ?>', { action: 'login' }).then(function (token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
    });
</script>