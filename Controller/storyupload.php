<?php require_once('../Controller/session.php');
    require_once('DBCtr.php');
    require_once('StoryCtr.php');
    require_once('../Model/Story.php');
    $userName = $_SESSION['userName'];
    $targeteLoc = "../Story/$userName/";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = $_POST['title'];
        $story = $_POST['story'];
        $date = new DateTime();
        $d = $date->format('YmdHis');
        $id = $d.$userName;
        $time = date("YmdHis",strtotime($d));
        $fileLoc = $targeteLoc.$id.".json";
        if(!file_exists($targeteLoc)){
            mkdir($targeteLoc,0777,true);
        }
        $post = array('title'=>$title,'story'=>$story);
        $file = fopen($fileLoc, "w");
        fwrite($file, json_encode($post));
        fclose($file);
        $story = new Story($id,$userName,$time,"","");
        $storyctr = new StoryCtr($id);
        $valid = $storyctr->addStory($story);
        if($valid){
            header('location:../View/story.php?id='.$id);
        }else{
            header('location:../View/post.php');
        }
    }
?>