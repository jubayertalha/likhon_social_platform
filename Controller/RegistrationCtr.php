<?php
    require_once('../Model/User.php');
    class RegistrationCtr{
        public $user; 
        public $cpass;

        public function __construct($user,$cpass){
            $this->user = $user;
            $this->cpass = $cpass;
        }

        public function register(){
            $data = [
                'fullNameErr' => "",
                'userNameErr' => "",
                'emailErr' => "",
                'dobErr' => "",
                'passErr' => "",
                'cpassErr' => "",
                'picErr' => "",
                'status' => "incomplete"
            ];
            $valid = true;
            
            if (empty($this->user->fullName)) {
                $data['fullNameErr'] = " *Full Name is required.";
                $valid = false;
            } else {
                $this->user->fullName = $this->finterInput($this->user->fullName);
                if (!preg_match("/^[a-zA-Z ]*$/",$this->user->fullName)) {
                    $data['fullNameErr'] = " *Only letters and white space allowed";
                    $valid = false;
                }
            }

            if (empty($this->user->userName)) {
                $data['userNameErr'] = " *User Name is required.";
                $valid = false;
            } else {
                $this->user->userName = $this->finterInput($this->user->userName);
                if (!preg_match("/^[a-zA-Z0-9_]*$/",$this->user->userName)) {
                    $data['userNameErr'] = " *Only letters, numbers and _ allowed.";
                    $valid = false;
                }
            }

            if (empty($this->user->email)) {
                $data['emailErr'] = " *Email is required.";
                $valid = false;
            } else {
                $this->user->email = $this->finterInput($this->user->email);
                if (!filter_var($this->user->email, FILTER_VALIDATE_EMAIL)) {
                    $data['emailErr'] = " *Only valid allowed.";
                    $valid = false;
                }
            }

            if (empty($this->user->pass)) {
                $data['passErr'] = " *Password is required.";
                $valid = false;
            } else {
                $this->user->pass = $this->finterInput($this->user->pass);
                if (!preg_match("/^[a-zA-Z0-9]*$/",$this->user->pass)) {
                    $data['passErr'] = " *Only letters and numbers allowed.";
                    $valid = false;
                }else{
                    if(strlen($this->user->pass)<8){
                        $data['passErr'] = " *Only 8 or more charecters allowed.";
                        $valid = false;
                    }
                }
            }

            if (empty($this->cpass)) {
                $data['cpassErr'] = " *Confirm Password is required.";
                $valid = false;
            } else {
                $this->cpass = $this->finterInput($this->cpass);
                if ($this->user->pass!=$this->cpass) {
                    $data['cpassErr'] = " *Password didn't matched.";
                    $valid = false;
                }
            }

            if (empty($this->user->dob)) {
                $data['dobErr'] = " *Date of Birth is required.";
                $valid = false;
            } else {
                $then = strtotime($this->user->dob);
                $min = strtotime('+12 years',$then);
                if(time() < $min){
                    $data['dobErr'] = " *12+ age required.";
                    $valid = false;
                }
            }

            if($valid){
                $data['status'] = "done";
            }

            return $data;
            
        }

        public function finterInput($input) {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }
    }
?>