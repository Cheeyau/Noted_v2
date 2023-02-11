<?php

class Database
{
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;
    private $statement;
    private $dbHandler;
    private $error;
    
    public function __construct() {
        $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    //Allows us to write queries
    public function query($sql) {
        $this->statement = $this->dbHandler->prepare($sql);
    }

    // Bind Int
    public function bindInt($parameter, int $int) {
        if (is_int($int)) {
            $type = PDO::PARAM_INT;
        }
        $this->statement->bindValue($parameter, $int, $type);
    }
    
    // Bind bool
    public function bindBool($parameter, bool $bool) {
        if (is_bool($bool)) {
            $type = PDO::PARAM_BOOL;
        }
        $this->statement->bindValue($parameter, $bool, $type);
    }
    
    // Bind string
    public function bindString($parameter, string $string) {
        if (is_string($string)) {
            $type = PDO::PARAM_STR;
        }
        $this->statement->bindValue($parameter, $string, $type);
    }
    
    // Bind null
    public function bindNull($parameter, $null) {
        if (is_null($null)) {
            $type = PDO::PARAM_NULL;
        }
        $this->statement->bindValue($parameter, $null, $type);
    }
    // bind datetime as string
    function bindDateTime($parameter, string $date) {
        if (is_string($date)) {
            $type = PDO::PARAM_STR;
        }
        $this->statement->bindValue($parameter, $date, $type);
    }

    //Execute the prepared statement
    public function execute() {
        return $this->statement->execute();
    }

    //Return an array
    public function resultSet() {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    // Return notes of userid
    public function resultSetNotes() {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    //Return a specific row as an object
    public function single() {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    //Get's the row count
    public function rowCount() {
        return $this->statement->rowCount();
    }
}