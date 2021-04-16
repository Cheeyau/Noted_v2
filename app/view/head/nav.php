</head>
<nav class="row">
    <ul class="nav">
        <?php 
            // check if use login for redirect to login
            if(!isset($_SESSION['userId'])) {
                echo '<li><h1 class="nav-item"><a class="nav-link" href="';
                echo URLROOT . '/LoginController/login';
                echo '">Login</a></h1></li>';
            }
            // check if use login for redirect to dashboard
            if(isset($_SESSION['userId'])) {
                echo '<li class="nav-item"><a class="nav-link" href="';
                echo URLROOT . '/IndexController/index';
                echo '">Home</a></li>';
                
                echo '<li><a class="nav-link" href="';
                echo URLROOT . '/NoteController/index';
                echo '">Notes</a></li>';
                
                // check if use login us admin
                if (isset($_SESSION['userRoll'])) {
                    if ($_SESSION['userRoll'] == 1 || $_SESSION['userRoll'] == 2) {
                        echo '<li class="nav-item"><a class="nav-link" href="';
                        echo URLROOT . '/UserController/getUserCon'. '">Users';
                        echo "</a></li>";
                    }
                }
                echo '<li class="nav-item"><a class="nav-link" href="';
                echo URLROOT . '/UserController/editUser">';
                echo $_SESSION['userName'].'</a></li>';

                // logout button
                echo '<li class="nav-item"><form action="';
                echo URLROOT . '/LoginController/logout" method="POST">';
                echo '<button class="btn-primary btn-sm" type="submit" name="submit">Log out</button></form></li>';
            }
        ?> 
    </ul>
</nav>
<body class="container">