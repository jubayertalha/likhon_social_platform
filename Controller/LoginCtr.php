<?php 
    require_once('DBCtr.php');
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

            if(!$valid) return $data;

            $db = new DBCtr();
            $conn = $db->connection();
            $sql = "SELECT * FROM users WHERE user_name = '".$this->userName."';";
            $result = $conn->query($sql);
            if($result->num_rows==1){
                $pass = "";
                while($row = $result->fetch_assoc()) {
                   $pass = $row["pass"];
                }
                if($pass == $this->pass){
                    $data['status'] = "done";
                }else{
                    $data['passErr'] = " *Password didn't matched.";
                }
            }else{
                $data['userNameErr'] = " *Can not find the user name.";
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