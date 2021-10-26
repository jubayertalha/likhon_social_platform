<?php require_once('../Controller/session.php');
    require_once('DBCtr.php');
    require_once('../Model/Story.php');
    $userName = $_SESSION['userName'];
    $targeteLoc = "../Story/$userName/";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = $_POST['title'];
        $story = $_POST['story'];
        $date = new DateTime();
        $id = $date->format('YmdHis');
        $time = date("Y-m-d",strtotime($id));
        $fileLoc = $targeteLoc.$id.".json";
        if(!file_exists($targeteLoc)){
            mkdir($targeteLoc,0777,true);
        }
        $post = array('title'=>$title,'story'=>$story);
        $file = fopen($fileLoc, "w");
        fwrite($file, json_encode($post));
        fclose($file);
        $story = new Story($id,$userName,$time,"","");
        $db = new DBCtr();
        $conn = $db->connection();
        $sql = "INSERT INTO stories VALUES ('$story->storyID', '$story->userName', '$story->date', '$story->categoryID','$story->coverPic');";
        if($conn->query($sql)===TRUE){
            header('location:../View/profile.php');
        }else{
            header('location:../View/post.php');
        }
        $conn->close();
    }
?>