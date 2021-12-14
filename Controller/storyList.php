<?php require_once('../Controller/session.php');
    require_once('../Controller/StoryCtr.php');
    if(isset($_POST['id'])&&!empty($_POST['id'])&&isset($_POST['writer'])&&!empty($_POST['writer'])){
        $id = htmlspecialchars($_POST['id']);
        $pre = htmlspecialchars($_POST['pre']);
        $userName = htmlspecialchars($_POST['writer']);
        $storyController = new StoryCtr($id);
        $storyList = $storyController->getStoryList($userName,$pre);
        echo json_encode($storyList);
    }else{
        header('location:../');
    }
?>