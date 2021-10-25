<?php 
    require_once('DBCtr.php');
    require_once('../Model/User.php');
    class UserCtr{
        public $userName; 

        public function __construct($userName){
            $this->userName = $userName;
        }

        public function getAllUserInfo(){
            $db = new DBCtr();
            $conn = $db->connection();
            $sql = "SELECT * FROM users WHERE user_name = '".$this->userName."';";
            $result = $conn->query($sql);
            $fullName = "";
            $userName = "";
            $email = "";
            $gender = "";
            $dob = "";
            $pic = "";
            if($result->num_rows==1){
                while($row = $result->fetch_assoc()) {
                   $fullName = $row["full_name"];
                   $userName = $row["user_name"];
                   $email = $row["email"];
                   $gender = $row["gender"];
                   $dob = $row["dob"];
                   $pic = $row["pic"];
                }
            }
            return new User($fullName,$userName,$email,$gender,$dob,"",$pic);
        }
    }
?>