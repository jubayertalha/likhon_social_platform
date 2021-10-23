<?php
    class DBCtr{
        public $servername = "localhost";
        public $username = "root";
        public $password = "";
        public $dbname = "likhon";

        public function __construct(){
            
        }

        public function connection(){
            return new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        }
    }
?>