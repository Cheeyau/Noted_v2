<?php

class AutoLoader {
    //load model and view
    public function model($incModel) {
        require_once '../app/model/'. $incModel . '.php';
        // initiate model 
        return new $incModel;
    }

    // load view and data for in the view
    public function view($nameView, $data = []) {
        if (file_exists('../app/view/' . $nameView . '.php')) {
            require_once '../app/view/' . $nameView . '.php';
        } else {
             die("404 - The view has not been found yet ". $nameView );
        }
    }
    
    public function filterName(string $name) {
        $name = filter_var(trim($name), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if(ctype_alnum($name)) {
            return $name;
        } else{
            return false;
        }
    }    

    // Sanitize and Validate e-mail address
    public function filterEmail(string $email) {
        $field = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        } else{
            return false;
        }
    }
    
    // Sanitize string
    public function filterString(string $field) {
        $field = filter_var(trim($field), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if(!empty($field)) {
            return $field;
        } else{
            return false;
        }
    }

    public function hashPassword(string $passwordAndSalt) {
        return hash('sha512', $passwordAndSalt);
    }
}