<?php
    class UserController extends AutoLoader {

        // search model with para User
        public function __construct() {
            $this->userModel = $this->model('UserModel');            
        }

        // initiate user view with data
        public function index() {
            if(isset($_SESSION['userId'])) {
                $data = [];
                $this->view('pages/index', $data = []);
            } else {
                $this->view('pages/login', $data = []);
            }   
        }
        
        // get users from db
        public function getUserCon() {
            $users = $this->userModel->getUsersModel();
            $data = ['users' => $users, 'errorMess' =>''];
            $this->view('/pages/users', $data);
        }

        // Edit logged in user information
        public function editUser() {
            $data = [
                'userId' => $_SESSION['userId'],
                'userRoll' => $_SESSION['userRoll'],
                'userName' => $_SESSION['userName'],
                'userEmail' => $_SESSION['userEmail'],
                'errorMess' => ''
            ];
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // check name and validation
                if(empty($_POST['inputName'])) {
                    $data['errorMess'] = "Please enter a new name to change.";
                } else {
                    $_POST['inputName'] = filterString($_POST['inputName']);
                    if($_POST['inputName']=== false) {
                        $data['errorMess'] = "Please enter a valid new name to change.";
                    } else {
                        $data['userName'] = trim($_POST['inputName']);
                        // check email and validation
                        if(empty($_POST['inputEmail'])) {
                            $data['errorMess'] = "Please enter a new name to change.";
                        } else {
                            $_POST['inputEmail'] = filterEmail($_POST['inputEmail']);
                            if($_POST['inputEmail']=== false) {
                                $data['errorMess'] = "Please enter a valid new name to change.";
                            } else {
                                $data['userEmail'] = trim($_POST['inputEmail']);
                                // check password and validation
                                if(empty($_POST['inputPassword'])) {
                                    $data['errorMess'] = "Please enter a new password to change.";
                                } else {
                                    $_POST['inputPassword'] = filterString($_POST['inputPassword']);
                                    if($_POST['inputPassword']=== false) {
                                        $data['errorMess'] = "Please enter a valid new password to change.";
                                    } else {
                                        $tempPassword = trim($_POST['inputPassword']);
                                        // hash password and send to db
                                        $hashPassword = $this->hashPassword($tempPassword.$_SESSION['userSalt']);
                                        
                                        $tempEditUser = $this->userModel->updateUserModel($data['userId'], $data['userName'], $data['userEmail'], $hashPassword);
                                        if($tempEditUser === true) {
                                            $data['errorMess'] = "The changes is saved.";
                                            $this->setSession($data, $hashPassword);
                                        } else {
                                            $data['errorMess'] = 'Something went wrong, please try again.';
                                        }
                                    }
                                }

                            }
                        }
                    }
                }
            }
            $this->view('pages/editUser', $data);
        }

        // Set user session
        private function setSession($user, string $hashPassword) {
            $_SESSION["userName"] = $user['userName'];
            $_SESSION["userEmail"] = $user['userEmail'];
            $_SESSION["userPass"] = $hashPassword;
        }

        // hash password and salt with sha512
        public function hashPassword(string $passwordAndSalt) {
            return hash('sha512', $passwordAndSalt);
        }
        
        // search user on input; name, email or registration date
        public function searchUserCon() {
            $data = [ 'users' => '', 'errorMess'=> ''];
            if($_SERVER['REQUEST_METHOD'] === 'GET') { 
                if(
                    empty($_GET['inputEmail']) && 
                    empty($_GET['inputDay']) && 
                    empty($_GET['inputDay']) && 
                    empty($_GET['inputYear']) &&
                    empty($_GET['inputName'])
                ) {
                    $data['users'] = $this->userModel->getUsersModel();
                    if($data['users'] === false || empty($data['users'])) {
                        $data['errorMess'] = 'There are no users found.';
                        $data['users'] = '';
                    }
                }
                
                if(
                    !empty($_GET['inputDay']) && 
                    !empty($_GET['inputDay']) && 
                    !empty($_GET['inputYear']) 
                    ) {
                    $tempMonth = str_pad($_GET['inputMonth'], 2, "0", STR_PAD_LEFT);
                    $tempDay = str_pad($_GET['inputDay'], 2, "0", STR_PAD_LEFT);
                    $tempDate = $_GET['inputYear'] . '-' . $tempMonth . '-' . $tempDay;
                    $tempDate = filterString($tempDate);
                    if($tempDate === false) {
                        $data['errorMess'] = "Please enter a valid date.";
                    } else {
                        $data['users'] = $this->userModel->searchUserRegistrationModel($tempDate);
                        if($data['users'] === false || empty($data['users'])) {
                            $data['errorMess'] = 'There are no users found.';
                            $data['users'] = '';
                        }
                    }
                }
                if(
                    !empty($_GET['inputName']) &&
                    empty($_GET['inputDay']) && 
                    empty($_GET['inputDay']) && 
                    empty($_GET['inputYear']) &&
                    empty($_GET['inputEmail'])
                ) {
                    $tempName = $_GET['inputName'];
                    $tempName = filterString($tempName);
                    if($tempName === false) {
                        $data['errorMess'] = "Please enter a valid name.";
                    } else {
                        $data['users'] = $this->userModel->searchUserNameModel($tempName);
                        if($data['users'] === false || empty($data['users'])) {
                            $data['errorMess'] = 'There are no users found.';
                            $data['users'] = '';
                        }
                    }
                }
                if(
                    !empty($_GET['inputEmail']) && 
                    empty($_GET['inputDay']) && 
                    empty($_GET['inputDay']) && 
                    empty($_GET['inputYear']) &&
                    empty($_GET['inputName'])
                ) {
                    $tempEmail = $_GET['inputEmail'];
                    $tempEmail = filterString($tempEmail);
                    if($tempEmail === false) {
                        $data['errorMess'] = "Please enter a valid Email.";
                    } else {
                        $data['users'] = $this->userModel->searchUserEmailModel($tempEmail);
                        if($data['users'] === false || empty($data['users'])) {
                            $data['errorMess'] = 'There are no users found.';
                            $data['users'] = '';
                        }
                    }
                }  
             }
            $this->view('/pages/users', $data);
        }
    }