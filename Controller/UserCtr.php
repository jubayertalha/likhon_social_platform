<?php 
    require_once('DBCtr.php');
    require_once('../Model/User.php');
    class UserCtr{
        public $userName; 

        public function __construct($userName){
            $this->userName = $userName;
        }

        public function chectUserName(){
            $db = new DBCtr();
            $conn = $db->connection();
            $sql = "SELECT * FROM users WHERE user_name = '".$this->userName."';";
            $result = $conn->query($sql);
            if($result->num_rows==1){
                return true;
            }else{
                return false;
            }
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

        public function search($id){
            $db = new DBCtr();
            $conn = $db->connection();
            $sql = "SELECT * FROM users WHERE user_name LIKE '%".$id."%' OR full_name LIKE '%".$id."%';";
            $result = $conn->query($sql);
            $userList = array();
            if($conn->query($sql)){
                while($row = $result->fetch_assoc()) {
                    $uName = $row["user_name"];
                    $fName = $row["full_name"];
                    $uPic = $row["pic"];
                    if($this->userName != $uName){
                        $user = new User($fName,$uName,"","","","",$uPic);
                        array_push($userList,$user);
                    }
                 }
            }
            return $userList;
        }

        public function getFollowerNo($uName){
            $db = new DBCtr();
            $conn = $db->connection();
            $sql = "SELECT * FROM follow WHERE writer_user_name = '".$uName."';";
            $result = $conn->query($sql);
            return $result->num_rows;
        }

        public function getFollowingNo($uName){
            $db = new DBCtr();
            $conn = $db->connection();
            $sql = "SELECT * FROM follow WHERE reader_user_name = '".$uName."';";
            $result = $conn->query($sql);
            return $result->num_rows;
        }

        public function isFollowing($uName){
            $db = new DBCtr();
            $conn = $db->connection();
            $sql = "SELECT * FROM follow WHERE reader_user_name = '".$this->userName."' AND writer_user_name = '".$uName."';";
            $result = $conn->query($sql);
            if($result->num_rows==1){
                return "Unfollow";
            }else{
                return "Follow";
            }
        }

        public function follow($uName){
            $db = new DBCtr();
            $conn = $db->connection();
            $sql = "INSERT INTO follow VALUES ('$this->userName', '$uName');";
            if($conn->query($sql)===TRUE){
                $conn->close();
                return true;
            }else{
                $conn->close();
                return false;
            }
        }

        public function unfollow($uName){
            $db = new DBCtr();
            $conn = $db->connection();
            $sql = "DELETE FROM follow WHERE reader_user_name = '".$this->userName."' AND writer_user_name = '".$uName."';";
            if($conn->query($sql)===TRUE){
                $conn->close();
                return true;
            }else{
                $conn->close();
                return false;
            }
        }
    }
?>