<?php 
    // Sanitize and Validate name
    function filterName(string $name) {
        $name = filter_var(trim($name), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if(filter_var($name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
            return $name;
        } else{
            return false;
        }
    }    

    // Sanitize and Validate e-mail address
    function filterEmail(string $email) {
        $field = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        } else{
            return false;
        }
    }
    
    // Sanitize string
    function filterString(string $field) {
        $field = filter_var(trim($field), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if(!empty($field)) {
            return $field;
        } else{
            return false;
        }
    }