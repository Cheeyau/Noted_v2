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
            if($this->checkEmail($userEmail)) {
                $tempDate = new DateTime();
                $tempHash = $this->hashPassword($password.$salt);
                $this->db->query(
                    "INSERT INTO `User` (`Name`, `EmailAddress`, `Password`, `Salt`, `UserRoll`, `Registration`) 
                    VALUES (:userName, :userEmail, :userPassword, :userSalt, :userRoll, :createDate);
                        ");
                $this->db->bindString(':userName', $userName);
                $this->db->bindString(':userEmail', $userEmail);
                $this->db->bindString(':userPassword', $tempHash);
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
        // hash password and salt with sha512
        public function hashPassword(string $passwordAndSalt) {
            return hash('sha512', $passwordAndSalt);
        }
        // check if mail is already used
        private function checkEmail(string $email) {
            $this->db->query("SELECT `EmailAddress` FROM `User` WHERE `EmailAddress` = :userEmail;");   
            $this->db->bindString(':userEmail', $email);
            $row = $this->db->single();
            if($this->db->rowCount() == 0) {
                return true;
            } else {
                return false;
            }
        }
        // update user of token 
        public function updateUserTokenModel(string $userEmail,  $token) {
            if($this->checkEmail($userEmail)) {
                $this->db->query("UPDATE `User` SET `Token` = :token WHERE `EmailAddress` = userEmail; ");
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
    }