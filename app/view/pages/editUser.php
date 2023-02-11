<?php
require APPROOT . '/view/head/head.php';
require APPROOT . '/view/head/nav.php';
// show user roll 
function determineRoll($data) {
    switch($data['userRoll']) {
        case 0:
            echo 'User';
            break;
        case 1:
            echo 'Admin';
            break;
        case 2:
            echo 'Superadmin';
            break;
    }
}

?>
<main class="row align-self-center ">    
    <section class="row">
        <h1 class="col-sm-12 H1">This is you!</h1>
        <h2 class="col-sm-12 align-self-center">Here can you change you personal information.</h2>
        
        <section class="row col-sm-6">
            <section class="col-sm-6">
                <p>User name:</p>
                <p>User Email:</p>
                <p>User Roll:</p>
            </section>
            <section class="col-sm-6">
                <p><?php echo $data['userName']?></p>
                <p><?php echo $data['userEmail']?></p>
                <p>
                    <?php 
                        determineRoll($data);
                    ?>
                </p>
            </section>
        </section>
    </section>

    <section class="row">
        <h2 class="col-sm-12 align-self-center">Here are the options that you change.</h2>
        <form class="col-sm-6 align-self-center" action="<?php echo URLROOT ?>/UserController/editUser" method="POST">
            <label class="row " for="inputUser">New user Name: </label>
            <input class="row form-control" type="text" name="inputName" id="inputUser">
            
            <label class="row " for="inputEmail">New email: </label>
            <input class="row form-control" type="text" name="inputEmail" id="inputPassword">
            
            <label class="row " for="inputEmail">New password: </label>
            <input class="row form-control" type="password" name="inputPassword" id="inputPassword">
            
            <button class="row btn-primary btn-sm" type="submit" value="submit">Save changes</button>
            <span class="error " ><?php echo $data['errorMess'] ?></span>
            
        </form>
    </section>
</main>

<script src="<?php echo URLROOT ?>/public/js/user.js"></script>