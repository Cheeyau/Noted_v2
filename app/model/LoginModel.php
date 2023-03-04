<?php 
    class LoginModel {
        private Database $db;
        
        public function __construct() {
            $this->db = new Database();
        }
        
        // verify password with db 
        public function checkLoginModel(string $userName, string $password) {
            $this->db->query("SELECT * FROM `User` WHERE `Name` = :userName;");
            $this->db->bindString(':userName', $userName);
            $row = $this->db->single();
            if($this->db->rowCount() > 0){
                $tempHash = $this->hashPassword($password.$row->Salt);
                if ($tempHash === $row->Password) {
                    return $row;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        // bind and insert into db new user
        public function registerUserModel(string $userName, string $userEmail, string $password, string $salt, int $userRoll = 0) {
            if(!$this->checkEmail($userEmail)) {
                $tempDate = new DateTime();
                $this->db->query(
                    "INSERT INTO `User` (`Name`, `EmailAddress`, `Password`, `Salt`, `UserRoll`, `Registration`) 
                    VALUES (:userName, :userEmail, :userPassword, :userSalt, :userRoll, :createDate);
                        ");
                $this->db->bindString(':userName', $userName);
                $this->db->bindString(':userEmail', $userEmail);
                $this->db->bindString(':userPassword', $password);
                $this->db->bindString(':userSalt', $salt);
                $this->db->bindInt(':userRoll', $userRoll);
                $this->db->bindDateTime(':createDate', $tempDate->format('Y-m-d H:i:s'));
                if($this->db->execute()) {
                    $tempUser = $this->getUserFromDb($userName, $userEmail);
                    return $tempUser;
                } else {
                    return false;
                }
            } else {
                false;
            }
        }
        // return user from db 
        private function getUserFromDb(string $name, string $email) {
            $this->db->query("SELECT * FROM `User` WHERE `EmailAddress` = :userEmail AND `Name` = :userName;");   
            $this->db->bindString(':userName', $name);
            $this->db->bindString(':userEmail', $email);
            $row = $this->db->single();
            if($this->db->rowCount() > 0) {
                return $row;
            } else {
                return false;
            }
        }
        // check if mail is already used
        private function checkEmail(string $email) {
            $this->db->query("SELECT `EmailAddress` FROM `User` WHERE `EmailAddress` = :userEmail;");   
            $this->db->bindString(':userEmail', $email);
            $row = $this->db->single();
            if($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
        // update user of token 
        public function updateUserTokenModel(string $userEmail,  $token) {
            if($this->checkEmail($userEmail)) {
                $this->db->query("UPDATE `User` SET `Token` = :token WHERE `EmailAddress` = :userEmail; ");
                $this->db->bindString(':userEmail', $userEmail);
                $this->db->bindString(':token', $token);
                if($this->db->execute()) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        private function checkName(string $name) {
            $this->db->query("SELECT `Name` FROM `User` WHERE `Name` = :name;");   
            $this->db->bindString(':name', $name);
            $row = $this->db->single();
            if($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
        
        public function updateUserPassword( string $name, string $email, string $password) {
            if($this->checkEmail($email) && $this->checkName($name)) {
                $tempUser = $this->getUserFromDb($name, $email);
                $tempUser->Password = $this->hashPassword($password.$tempUser->Salt);

                $this->db->query("UPDATE `User` SET `Password` = :userPassword WHERE `EmailAddress` = :userEmail AND `Name` = :userName; ");
                $this->db->bindString(':userEmail', $email);
                $this->db->bindString(':userName', $name);
                $this->db->bindString(':userPassword', $tempUser->Password);
                if($this->db->execute()) {
                    return $tempUser;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        private function hashPassword(string $passwordAndSalt) {
            return hash('sha512', $passwordAndSalt);
        }
    }