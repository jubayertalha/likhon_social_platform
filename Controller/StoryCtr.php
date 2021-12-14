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

        public function getLikeInfo(){
            $db = new DBCtr();
            $conn = $db->connection();
            $sql = "SELECT user_name FROM react WHERE story_id = '".$this->storyID."';";
            $result = $conn->query($sql);
            $userName = "";
            $reactList = array();
            if($conn->query($sql)){
                while($row = $result->fetch_assoc()) {
                    $userName = $row["user_name"];
                    array_push($reactList,$userName);
                 }
            }
            return $reactList;
        }

        public function getCommentInfo(){
            $db = new DBCtr();
            $conn = $db->connection();
            $sql = "SELECT * FROM comment WHERE story_id = '".$this->storyID."';";
            $result = $conn->query($sql);
            $comment = $result->num_rows;
            return $comment;
        }

        public function like($userName){
            $reactID = $this->storyID.$userName;
            $db = new DBCtr();
            $conn = $db->connection();
            $sql = "INSERT INTO react VALUES ('$reactID', '$this->storyID', '$userName', '');";
            if($conn->query($sql)===TRUE){
                $conn->close();
                return true;
            }else{
                $conn->close();
                return false;
            }
        }

        public function unlike($userName){
            $db = new DBCtr();
            $conn = $db->connection();
            $sql = "DELETE FROM react WHERE user_name = '".$userName."';";
            if($conn->query($sql)===TRUE){
                $conn->close();
                return true;
            }else{
                $conn->close();
                return false;
            }
        }

        public function getStoryList($userName,$pre){
            if($this->storyID=="user"){
                return $this->getStoryListByUser($userName,$pre);
            }else if($this->storyID=="home"){
                return $this->getStoryListForHome($userName,$pre);
            }
            return array();
        }

        public function getStoryListForHome($userName,$pre){
            $db = new DBCtr();
            $conn = $db->connection();
            $sql = "SELECT * FROM `stories` WHERE user_name IN (SELECT writer_user_name FROM follow WHERE reader_user_name = '".$userName."') ORDER BY date DESC LIMIT ".$pre.",10;";
            $result = $conn->query($sql);
            $storyID = "";
            $storyList = array();
            if($conn->query($sql)){
                while($row = $result->fetch_assoc()) {
                    $storyID = $row["sotry_id"];
                    array_push($storyList,$storyID);
                 }
            }
            return $storyList;
        }

        public function getStoryListByUser($userName,$pre){
            $db = new DBCtr();
            $conn = $db->connection();
            $sql = "SELECT * FROM `stories` WHERE user_name = '".$userName."' ORDER BY date DESC LIMIT ".$pre.",5;";
            $result = $conn->query($sql);
            $storyID = "";
            $storyList = array();
            if($conn->query($sql)){
                while($row = $result->fetch_assoc()) {
                    $storyID = $row["sotry_id"];
                    array_push($storyList,$storyID);
                 }
            }
            return $storyList;
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

        function substrwords($text, $maxchar, $end='...') {
            if (strlen($text) > $maxchar || $text == '') {
                $words = preg_split('/\s/', $text);      
                $output = '';
                $i = 0;
                while (1) {
                    $length = strlen($output)+strlen($words[$i]);
                    if ($length > $maxchar) {
                        break;
                    } 
                    else {
                        $output .= " " . $words[$i];
                        ++$i;
                    }
                }
                $output .= $end;
            } 
            else {
                $output = $text;
            }
            return $output;
        }
    }
?>