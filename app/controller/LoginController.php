<?php 
    require_once APPROOT . '/lib/mailer.php';    
    class LoginController extends AutoLoader {
        private LoginModel $loginModel;
        
        public function __construct() {
            $this->loginModel = $this->model('LoginModel');
            $data = $this->emptyData();            
        }

        // page for login page
        public function index() {
            $data = $this->emptyData();
            $this->view('/pages/login', $data);
        }

        // page for resetpassword
        public function reset() {
            $data = $this->emptyData();
            $this->view('/pages/resetPassword', $data);
        }

        // page for register
        public function register() {
            $data = $this->emptyData();
            $this->view('/pages/registerUser', $data);
        }

        // Empty array 
        private function emptyData() {
            $data = ['userId' => '', 'userName' => '', 'userPass' => '', 'userEmail' => '', 'userRoll' => '', 'userSalt' => '', 'errorMess' => ''];
            return $data;
        }

        // log out user
        public function logout() {
            $data = $this->emptyData();
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                unset($_SESSION['userId']);
                session_destroy();
            }
            $this->view('/pages/login', $data);
        }

        public function checkLoginAPI() {
            if(empty($data['errorMess'])) {
                // push user to db layer 
                $data['userPass'] = trim($_POST['userPassword']);
                $tempUser = $this->loginModel->checkLoginModel($data['userName'], $data['userPass']);
                
                if ($tempUser !== false || $tempUser === null) {
                    $this->setSession($tempUser);
                } else {
                    $data['errorMess'] = "The password and user combination is not valid.";
                }
            }
        }

        // login validation
        public function login() {
            $data = $this->emptyData();
            if(!$_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['recaptcha_response'])) $data['errorMess'] = "Cant process request, please try again.";
            if(isset($_POST['recaptcha_response'])) $recaptchaCheck = checkRecaptcha($_POST['recaptcha_response']);
            
            if(isset($recaptchaCheck->score)) {
                if($recaptchaCheck->score <= 0.5 && $recaptchaCheck->failed) $data['errorMess'] = "The captcha failed, please try again.";
                
                // sanitize and check of name
                $userName = $this->filterName($_POST['userName']);
                if(empty($userName)) $data['errorMess'] = "Please enter your user name.";
                
                if($userName === false) $data['ErrorMess'] = "Please enter a valid user name.";
                $data['userName'] = trim($userName);
                
                // empty field
                if(empty($_POST["userPassword"])) $data['errorMess'] = "Please enter your password.";
                
                // check sanitize password
                $userPassword = $this->filterString($_POST['userPassword']);
                if($userPassword === false) $data['errorMess'] = "Please enter a valid password.";
                 
                if(empty($data['errorMess'])) {
                    // push user to db layer 
                    $data['userPass'] = trim($_POST['userPassword']);
                    $tempUser = $this->loginModel->checkLoginModel($data['userName'], $data['userPass']);
                    
                    if ($tempUser !== false || $tempUser === null) {
                        $this->setSession($tempUser);
                    } else {
                        $data['errorMess'] = "The password and user combination is not valid.";
                    }
                }
            }
            // redirect login user from login page
            if(isset($_SESSION['userId'])) {
                $this->view('/pages/dashboard', $data);
            } else {
                $this->view('/pages/login', $data);
            }
        }

        // Set user session
        private function setSession($user) {
            $_SESSION["userId"] = $user->UserId;
            $_SESSION["userName"] = $user->Name;
            $_SESSION["userEmail"] = $user->EmailAddress;
            $_SESSION["userPass"] = $user->Password;
            $_SESSION["userSalt"] = $user->Salt;
            $_SESSION["userRoll"] = $user->UserRoll;
            $this->view('/pages/dashboard', $infodata = []);
            // // Working in test environment but not in live  
            // header('location:' . URLROOT . '/IndexController/index');
            die();
        }

        // register user
        public function registerUser() {
            $data = $this->emptyData();
            if (!$_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['recaptcha_response'])) {
                $data['errorMess'] = "Cant process request, please try again.";
            }    
            
            $recaptchaCheck = checkRecaptcha($_POST['recaptcha_response']);
            if(isset($recaptchaCheck->score)) {
                if ($recaptchaCheck->score >= 0.5 && $recaptchaCheck->success) {
                    
                    // check name
                    if(empty($_POST['userName'])) $data['errorMess'] = "Please enter your user name.";
                    $_POST['userName'] = $this->filterName($_POST['userName']);
                    if($_POST['userName'] === false) $data['ErrorMess'] = "Please enter a valid user name.";
                    $data['userName'] = trim($_POST['userName']);
                    
                    //check email
                    if(empty($_POST['userEmail'])) $data['errorMess'] = "Please enter your email."; 
                    $_POST['userEmail'] = $this->filterEmail($_POST['userEmail']);
                    if($_POST['userEmail'] === false) $data['errorMess'] = "Please enter a valid email.";
                    $data['userEmail'] = trim($_POST['userEmail']);

                    //check 
                    if(empty($_POST["userPassword"])) $data['errorMess'] = "Please enter your password.";

                    // check sanitize password
                    $_POST['userPassword'] = $this->filterString($_POST['userPassword']);
                    if($_POST['userPassword'] === false) $data['errorMess'] = "Please enter a valid password.";
                    $data['userPass'] = trim($_POST['userPassword']);
                    
                    if(empty($data['errorMess'])) {
                        // push user to db layer 
                        $tempSalt = $this->saltShaker();
                        $tempHash = $this->hashPassword($data['userPass'].$tempSalt);
                        $tempUser = $this->loginModel->registerUserModel(
                            $data['userName'],
                            $data['userEmail'], 
                            $tempHash,
                            $tempSalt
                        );
                        if ($tempUser !== false || $tempUser !== null) {
                            $this->setSession($tempUser);
                        } else {
                            $data['errorMess'] = "Something went wrong, please try it again";
                        }
                    }
                } else {
                    $data['errorMess'] = "The captcha failed, please try again.";
                }
            }
            $this->view('/pages/registerUser', $data);
        }

        // generate random salt
        private function saltShaker() {
            $rnd = rand(0, 10);
            $salt = "";
            switch ($rnd) {
                case 1:
                    $salt =  "mango";
                    break;
                case 2:
                    $salt =  "banana";
                    break;
                case 3:
                    $salt = "apple";
                    break;
                case 4:
                    $salt = "lemon";
                    break;
                case 5:
                    $salt = "hotdog";
                    break;
                case 6:
                    $salt = "pizza";
                    break;
                case 7:
                    $salt = "candy";
                    break;
                case 8:
                    $salt = "hamburger";
                    break;
                case 9:
                    $salt = "watermelon";
                    break;
                case 10:
                    $salt = "chips";
                    break;
            }
            return $salt;
        }
        
        // reset password
        public function resetPassword() {
            $data = $this->emptyData();
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {
                $recaptchaCheck = checkRecaptcha($_POST['recaptcha_response']);
                if(isset($recaptchaCheck->score)) {
                    if ($recaptchaCheck->score >= 0.5 && $recaptchaCheck->success) {
                        
                        // check name
                        if(empty($_POST['inputName'])) $data['errorMess'] = "Please enter your user name.";
                        $_POST['inputName'] = $this->filterName($_POST['inputName']);
                        if($_POST['inputName'] === false) $data['ErrorMess'] = "Please enter a valid user name.";
                        $data['userName'] = trim($_POST['inputName']);
                        
                        //check email
                        if(empty($_POST['inputEmail'])) $data['errorMess'] = "Please enter your email."; 
                        $_POST['inputEmail'] = $this->filterEmail($_POST['inputEmail']);
                        if($_POST['inputEmail'] === false) $data['errorMess'] = "Please enter a valid email.";
                        $data['userEmail'] = trim($_POST['inputEmail']);

                        // check sanitize password
                        if(empty($_POST["inputPassword"])) $data['errorMess'] = "Please enter your password.";
                        $_POST['inputPassword'] = $this->filterString($_POST['inputPassword']);
                        if($_POST['inputPassword'] === false) $data['errorMess'] = "Please enter a valid password.";
                        $data['userPass'] = trim($_POST['inputPassword']);
                            
                        if(empty($data['errorMess'])) {
                            // push user to db layer 
                            $tempUser = $this->loginModel->updateUserPassword(
                                $data['userName'],
                                $data['userEmail'], 
                                $data['userPass']
                            );
                            if ($tempUser !== false || $tempUser !== null) {
                                $this->setSession($tempUser);
                            } else {
                                $data['errorMess'] = "Something went wrong, please try it again";
                            }
                        }
                        
                        // Should use emailer 
                        // $token = random_bytes(32);
                        // $tempResponse = $this->loginModel->updateUserTokenModel($data['userEmail'], $token);
                        // if($tempResponse === true) {
                        //     $url = sprintf( APPROOT . '/pages/resetPassword', http_build_query([
                        //         'validator' => bin2hex($token)
                        //     ]));    
                        //     // continue
                        //     $mail = new Mailer();
                        //     // $mail->SendMail();
                        //     $data['errorMess'] = "The reset link has been send to the email that is filled in.";
                        // } else {
                        //     $data['errorMess'] = "The email address does not exist.";
                        // }
                    } else {
                        $data['errorMess'] = "The captcha failed, please try again.";
                    }
                }
            }
            $this->view('/pages/resetPassword', $data);
        } 

        private function mailBody() {
            // continue
        }

        public function confirmPasswordReset() {
            // continue
        }
    }