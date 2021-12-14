<?php require_once('../Controller/session.php');
    $userName = $_SESSION['userName'];
    require_once('../Controller/StoryCtr.php');
    if(isset($_POST['id'])&&!empty($_POST['id'])&&isset($_POST['type'])&&!empty($_POST['type'])){
        $id = htmlspecialchars($_POST['id']);
        $type = htmlspecialchars($_POST['type']);
        $storyController = new StoryCtr($id);
        if($type=="Like"){
            $storyController->like($userName);
        }else{
            $storyController->unlike($userName);
        }
    }
?>