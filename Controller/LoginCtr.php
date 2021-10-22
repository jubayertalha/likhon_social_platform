<?php session_start();
    class LoginCtr{
        public $userName; 
        public $pass;

        public function __construct($userName,$pass){
            $this->userName = $userName;
            $this->pass = $pass;
        }

        public function login(){
            $data = [
                'userNameErr' => "",
                'passErr' => "",
                'status' => "incomplete"
            ];
            $valid = true;

            if (empty($this->userName)) {
                $data['userNameErr'] = " *User Name is required.";
                $valid = false;
            } 

            if(empty($this->pass)){
                $data['passErr'] = " *Password is required.";
                $valid = false;
            }

            if($valid){
                if(isset($_SESSION['userName'])){
                    $this->userName = $this->finterInput($this->userName);
                    if ($this->userName == $_SESSION['userName']) {
                        if($this->pass == $_SESSION['pass']){
                            $data['status'] = "done";
                        }else{
                            $data['passErr'] = " *Password doesn't match.";
                        }
                    }else{
                        $data['userNameErr'] = " *Can not find this user name.";
                    }
                }else{
                    $data['userNameErr'] = " *Can not find this user name.";
                }
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