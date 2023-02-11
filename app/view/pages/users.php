<?php
    require APPROOT . '/view/head/head.php';
    require APPROOT . '/view/head/nav.php';
?>

<main class="row align-self-center ">    
    <section class="row">
        <h1 class="row col-sm-12 align-self-center H1">Here are all the users who are regristrated!</h1>
        <h2 class="row col-sm-12 align-self-center">Search uers by name, email address or registration date.</h2>
        <section class="row col-sm-10 searchBar"> 
            <form action="<?php echo URLROOT ?>/UserController/searchUserCon" method="GET">
                <section class="row">
                    <label class="col-sm-3" for="inputName">Name: </label>
                    <input class="col-sm-3 form-control" type="text" name="inputName" >        
                </section>
                <section class="row">
                    <label class="col-sm-3" for="inputEmail">Email: </label>
                    <input class="col-sm-3 form-control" type="text" name="inputEmail">
                </section>
                <section class="row">
                    <label class="col-sm-2" for="inputRegistration">Registration date: </label>
                    <label class="col-sm-1" for="inputRegistration">Day: </label>
                    <input class="searchDate form-control" type="text" name="inputDay" placeholder="<?php echo date('d'); ?>">
                    
                    <label class="col-sm-1" for="inputRegistration">Month: </label>
                    <input class="searchDate form-control" type="text" name="inputMonth" placeholder="<?php echo date('m'); ?>">
                    
                    <label class="col-sm-1" for="inputRegistration">Year: </label>
                    <input class="searchDateYear form-control" type="text" name="inputYear" placeholder="<?php echo date('Y'); ?>">
                    
                </section>
                <button class="btn-primary btn-sm" type="submit" value="submit">Search</button>
                <span class="error " ><?php echo $data['errorMess'] ?></span>
            </form>
        </section>
        <h2 class="row col-sm-12 align-self-center">Here are the users in the system.</h2>
        <table class="row usersCon col-sm-12">
                <tr class="row col-sm-8">
                    <th class="col-sm-1">Name</th>
                    <th class="col-sm-4">Email address</th>
                    <th class="col-sm-4">Registration date</th>
                    <th class="col-sm-1">Notes</th>
                    <th class="col-sm-2">User Roll</th>
                </tr>
            <?php 
                // loop trough users after checking if array is empty
                if($data['users'] !== '' || !empty($data['users'])) {
                    foreach($data['users'] as $user) {
                
                    ?>
                    <tr class="row col-sm-8">
                        <td class="col-sm-1"><?php echo $user->Name ?></td>
                        <td class="col-sm-4"><?php echo $user->EmailAddress ?></td>
                        <td class="col-sm-4"><?php echo $user->Registration ?></td>
                        <td class="col-sm-1"><?php echo $user->Notes ?></td>
                        <td class="col-sm-2">
                            <?php 
                                // show user roll
                                if($user->UserRoll == 0) {
                                    echo 'User';
                                }
                                if($user->UserRoll == 1) {
                                    echo 'Admin';
                                }
                                if($user->UserRoll == 2) {
                                    echo 'Super admin';
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
            </table>
    </section>
</main>

<script src="<?php echo URLROOT ?>/public/js/user.js"></script>