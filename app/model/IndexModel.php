<?php
    class IndexModel {
        private Database $db;
        
        // load index page
        public function __construct() {
            $this->db = new Database();
        }
    }