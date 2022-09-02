<?php 
    class UserModel {
        private Database $db;
        
        public function __construct() {
            $this->db = new Database();
        }
        
        //Get the users and count total notes they got
        public function getUsersModel() {
            $this->db->query("SELECT `Name`, `EmailAddress`, `UserRoll`, `Registration`, count(`Note`.`UserId` = `User`.`UserId`) AS Notes FROM `User`
            LEFT JOIN `Note` ON  `Note`.`UserId` = `User`.`UserId`
            GROUP BY `EmailAddress`;");
            $result = $this->db->resultSet();            
            return $result;
        }

        
        // update user by id
        public function updateUserModel(int $userId, string $userName, string $userEmail, string $userPassword) {
            $this->db->query("UPDATE `User` SET `Name` = :userName, `EmailAddress` = :userEmail, `Password` = :userPassword
            WHERE `userId` = :userId");
            $this->db->bindInt(':userId', $userId);
            $this->db->bindString(':userName', $userName);
            $this->db->bindString(':userEmail', $userEmail);
            $this->db->bindString(':userPassword', $userPassword);
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
        // search by registration date 
        public function searchUserRegistrationModel($date) {
            $this->db->query("SELECT `Name`, `EmailAddress`, `UserRoll`, `Registration`, count(`Note`.`UserId` = `User`.`UserId`) AS Notes 
            FROM `User`
            LEFT JOIN `Note` ON  `Note`.`UserId` = `User`.`UserId`
            WHERE `Registration` LIKE :date 
            GROUP BY `EmailAddress`;");
            $addWildCard = $date . '%';
            $this->db->bindDateTime(':date', $addWildCard);
            $result = $this->db->resultSet();            
            if($this->db->rowCount() > 0 && $result !== null) {
                return $result;
            } else {
                false;
            }
        }
        // search by name
        public function searchUserNameModel($name) {
            $this->db->query("SELECT `Name`, `EmailAddress`, `UserRoll`, `Registration`, count(`Note`.`UserId` = `User`.`UserId`) AS Notes 
            FROM `User`
            LEFT JOIN `Note` ON  `Note`.`UserId` = `User`.`UserId`
            WHERE `Name` LIKE :name 
            GROUP BY `EmailAddress`;");
            $addWildCard = $name . '%';
            $this->db->bindString(':name', $addWildCard);
            $result = $this->db->resultSet();            
            if($this->db->rowCount() > 0 &&  $result !== null) {
                return $result;
            } else {
                false;
            }
        }
        // search by email
        public function searchUserEmailModel($name) {
            $this->db->query("SELECT `Name`, `EmailAddress`, `UserRoll`, `Registration`, count(`Note`.`UserId` = `User`.`UserId`) AS Notes 
            FROM `User`
            LEFT JOIN `Note` ON  `Note`.`UserId` = `User`.`UserId`
            WHERE `EmailAddress` LIKE :email 
            GROUP BY `EmailAddress`;");
            $addWildCard = $name . '%';
            $this->db->bindString(':email', $addWildCard);
            $result = $this->db->resultSet();            
            if($this->db->rowCount() > 0 &&  $result !== null) {
                return $result;
            } else {
                false;
            }
        }
    }