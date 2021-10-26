<?php 
    require_once('DBCtr.php');
    require_once('../Model/Story.php');
    class StoryCtr{
        public $storyID; 

        public function __construct($storyID){
            $this->storyID = $storyID;
        }

        public function addStory($story){
            $db = new DBCtr();
            $conn = $db->connection();
            $sql = "INSERT INTO stories VALUES ('$story->storyID', '$story->userName', '$story->date', '$story->categoryID','$story->coverPic');";
            if($conn->query($sql)===TRUE){
                $conn->close();
                return true;
            }else{
                $conn->close();
                return false;
            }
            
        }

        public function getStory(){
            $db = new DBCtr();
            $conn = $db->connection();
            $sql = "SELECT * FROM stories WHERE sotry_id = '".$this->storyID."';";
            $result = $conn->query($sql);
            $storyID = "";
            $userName = "";
            $date = "";
            $categoryID = "";
            $coverPic = "";
            if($conn->query($sql)){
                while($row = $result->fetch_assoc()) {
                    $storyID = $row["sotry_id"];
                    $userName = $row["user_name"];
                    $date = $row["date"];
                 }
            }
            $story = new Story($storyID,$userName,$date,$categoryID,$coverPic);
            return $story;
        }

        public function checkStoryID(){
            $db = new DBCtr();
            $conn = $db->connection();
            $sql = "SELECT * FROM stories WHERE sotry_id = '".$this->storyID."';";
            $result = $conn->query($sql);
            if($conn->query($sql)){
                return true;
            }else{
                echo $conn->error;
                return false;
            }
        }
    }
?>