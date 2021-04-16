<?php
    class IndexModel {
        private $db;
        // load index page
        public function __construct() {
            $this->db = new Database;
        }
    }