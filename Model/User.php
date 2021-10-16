<?php
    class User{
        public $fullName = "";
        public $userName = "";
        public $email = "";
        public $gender = "";
        public $dob = "";
        public $pass = "";
        public $pic = "";

        public function __construct($fullName,$userName,$email,$gender,$dob,$pass,$pic){
            $this->fullName = $fullName;
            $this->userName = $userName;
            $this->email = $email;
            $this->gender = $gender;
            $this->dob = $dob;
            $this->pass = $pass;
            $this->pic = $pic;
        }
    }
?>