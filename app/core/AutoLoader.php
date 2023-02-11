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
}